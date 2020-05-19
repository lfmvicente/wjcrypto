<?php

    declare(strict_types=1);

    namespace Wjcrypto\Account\Model\ResourceModel;

    use Wjcrypto\Holder\Model\Holder;
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
                $this->account->setHolderId($row['id_holder']);
            }
            return $this->account;
        }

        public function insert(Account $account)
        {
            $results = $this->sql->query(
                "INSERT INTO account (account_number, balance, id_holder)
                    VALUES (:number, :balance, :id_holder)", array(
                        "number"=>uniqid(),
                        "balance"=>$account->getBalance(),
                        "id_holder"=>$account->getHolderId()
            ));
            return $this;
        }

        public function delete($id)
        {
            $results = $this->sql->query("DELETE FROM account WHERE id = :ID",
                array("ID"=>$id));
            return $this;
        }

        public function update(Account $account)
        {
            $results = $this->sql->query(
                "UPDATE account SET account_number = :NUMBER WHERE id = :ID", array(
                ":ID"=>$account->getId(),
                ":NUMBER"=>$account->getNumber()
            ));
        }

        public function linkHolder(Account $account, Holder $holder)
        {
            $idHolder = $holder->getId();
            $this->account->setHolderId($idHolder);
            $id = $this->account->getId();

            $results = $this->sql->query(
                "UPDATE account SET id_holder = :idHolder WHERE id = :ID", array(
                ":ID"=>$id,
                ":idHolder"=>$idHolder
            ));
        }
    }

