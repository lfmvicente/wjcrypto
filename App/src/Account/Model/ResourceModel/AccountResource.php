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
            $results = $this->sql->select(
                "SELECT balance, account_number FROM account WHERE account_number in (:ORIGIN, :DESTINATION)",
                [
                    "ORIGIN"=>$accountOrigin,
                    "DESTINATION"=>$accountDestination
                ]);

            $results[0]['balance'] += $amount;
            $results[1]['balance'] -= $amount;

            $this->sql->query(
                "UPDATE account SET balance = :BALANCE WHERE account_number = :ORIGIN",
            [
                "BALANCE"=>$results[1]['balance'],
                "ORIGIN"=>$results[1]['account_number']
            ]);

            $this->sql->query(
                "UPDATE account SET balance = :BALANCE WHERE account_number = :DESTINATION",
                [
                    "BALANCE"=>$results[0]['balance'],
                    "DESTINATION"=>$results[0]['account_number']
                ]);
            $_SESSION['balance'] = $results[1]['balance'];
            return $this;
        }

        public function getAll()
        {
            $results = $this->sql->select("SELECT * FROM account");
            return $results;
        }
    }
