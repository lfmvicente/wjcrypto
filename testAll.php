<?php

    require_once "vendor/autoload.php";

    use Wjcrypto\Account\Model\Account;
    use Wjcrypto\Account\Model\ResourceModel\AccountResource;
    use Wjcrypto\Holder\Model\ResourceModel\HolderResource;
    use Wjcrypto\Holder\Model\Holder;
    use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
    use Wjcrypto\Validator\Model\Validator;

    $sql = new Sql();
    $holder = new Holder();
    $validator = new Validator($sql);

    //$validator->userValidation('thaina', '112').PHP_EOL;
    //var_dump($validator);
    $validator->tokenValidation('50ae45b21f92ad84cee480fafd5259f3c5b4fd9f22339944b62c0b3fce1e753a');


    /*$holderRes = new HolderResource($sql, $holder);

    $account = new Account();
    $accountRes = new AccountResource($sql, $account);

    //dados para insert do Holder
    $holder->setName("Caio");
    $holder->setDocument("12345678910");
    $holder->setAdditionalDocument("123456789");
    $holder->setAddress("Rua WK, 1000");
    $holder->setPhone("11984848484");
    $holder->setDtOrigin("2020-05-13");
    $holder->setUsername("caio");
    $holder->setPassword("1114");
    $holder->setAccountNumber($account);

    $holderRes->insert($holder);

    //dados para insert da Account
    $account->generateNumber();
    $account->setHolderId($holder);

    $accountRes->insert($account);*/

