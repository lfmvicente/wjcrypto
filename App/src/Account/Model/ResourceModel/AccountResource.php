<?php

    declare(strict_types=1);

    namespace Wjcrypto\Account\Model\ResourceModel;

    use Wjcrypto\Account\Exception\InvalidAmountException;
    use Wjcrypto\Account\Exception\InvalidTransferException;
    use Wjcrypto\Account\Exception\NoFundsException;
    use Wjcrypto\Account\Exception\NotFoundAccountException;
    use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
    use Wjcrypto\Account\Model\Account;

    class AccountResource 
    {

        private $sql;
        private $account;

        public function __construct(Sql $sql, Account $account)
        {
            $this->sql = $sql;
            $this->account = $account;
        }

        public function getById($id)
        {
            $results = $this->sql->select("SELECT * FROM account WHERE id = :ID", array(
                ":ID"=>$id
            ));

            if (count($results) > 0) {
                $row = $results[0];

                $this->account->setId($row['id']);
                $this->account->setNumber($row['account_number']);
                $this->account->setBalance($row['balance']);
            }
            return $this->account;
        }

        public function insert(Account $account)
        {
            $this->sql->query(
                "INSERT INTO account (account_number, balance)
                    VALUES (:number, :balance)", array(
                        "number"=>$account->getNumber(),
                        "balance"=>$account->getBalance()
            ));
            return $this;
        }

        public function update(Account $account)
        {
            $this->sql->query(
                "UPDATE account SET account_number = :NUMBER WHERE id = :ID", array(
                ":ID"=>$account->getId(),
                ":NUMBER"=>$account->getNumber()
            ));
        }

        public function delete($id)
        {
            $this->sql->query("DELETE FROM account WHERE id = :ID",
                array("ID"=>$id));
            return $this;
        }

        public function deposit($amount, $accountNumber)
        {
            $results = $this->sql->select("SELECT balance, account_number FROM account WHERE account_number = :ACCOUNT",
                ["ACCOUNT"=>$accountNumber]);

            if ($amount <= 0) {
                throw new InvalidAmountException('Invalid Amount');
            }

            $results[0]['balance'] += $amount;

            $this->sql->query("UPDATE account SET balance = :BALANCE WHERE account_number = :ACCOUNT",
            [
              "BALANCE"=>$results[0]['balance'],
              "ACCOUNT"=>$accountNumber
            ]);
            $_SESSION['balance'] = $results[0]['balance'];
            return $this;
        }

        public function withdraw($amount, $accountNumber)
        {
            $results = $this->sql->select("SELECT balance, account_number FROM account WHERE account_number = :ACCOUNT",
                ["ACCOUNT"=>$accountNumber]);

            if ($amount > $results[0]['balance'] || $amount <= 0) {
                throw new InvalidAmountException('Invalid Amount');
            }
            if ($results[0]['balance'] <= 0) {
                throw new NoFundsException('No Funds');
            }

            $results[0]['balance'] -= $amount;

            $update = $this->sql->query("UPDATE account SET balance = :BALANCE WHERE account_number = :ACCOUNT",
            [
               "BALANCE"=>$results[0]['balance'],
               "ACCOUNT"=>$accountNumber
            ]);
            $_SESSION['balance'] = $results[0]['balance'];
            return $this;
        }

        public function transfer($amount, $accountDestination, $accountOrigin)
        {
            $origin = $this->sql->select(
                "SELECT * FROM account WHERE account_number = :ORIGIN",
                [
                    "ORIGIN"=>$accountOrigin
                ]
            );

            $destination = $this->sql->select(
                "SELECT * FROM account WHERE account_number = :DESTINATION",
                [
                   "DESTINATION"=>$accountDestination
                ]
            );

            if (count($destination) < 0) {
                return false;
            }

            $origin[0]['balance'] = $origin[0]['balance'] - $amount;
            $destination[0]['balance'] = $destination[0]['balance'] + $amount;

            $_SESSION['balance'] = $origin[0]['balance'];
            try{
                $this->sql->query(
                    "UPDATE account SET balance = :BALANCE WHERE account_number = :ORIGIN",
                [
                    "BALANCE"=>$origin[0]['balance'],
                    "ORIGIN"=>$origin[0]['account_number']
                ]);

                $this->sql->query(
                    "UPDATE account SET balance = :BALANCE WHERE account_number = :DESTINATION",
                    [
                        "BALANCE"=>$destination[0]['balance'],
                        "DESTINATION"=>$destination[0]['account_number']
                    ]);
            } catch (\Exception $exception) {
                die($exception->getMessage());
            }
            return $this;
        }

        public function getAll()
        {
            $results = $this->sql->select("SELECT * FROM account");
            return $results;
        }
    }
