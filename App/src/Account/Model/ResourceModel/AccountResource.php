<?php

    declare(strict_types=1);

    namespace Wjcrypto\Account\Model\ResourceModel;

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
    }
