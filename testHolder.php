<?php

require_once "vendor/autoload.php";

use Wjcrypto\Holder\Model\ResourceModel\HolderResource;
use Wjcrypto\Holder\Model\Holder;
use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
use Wjcrypto\Account\Model\Account;
use Wjcrypto\Account\Model\ResourceModel\AccountResource;

$sql = new Sql();
$holder = new Holder();
$holderRes = new HolderResource($sql, $holder);


$account = new Account();


//$holder->setId(7);
$holder->setName("Thaina");
$holder->setDocument("12345678910");
$holder->setAdditionalDocument("123456789");
$holder->setAddress("Rua WK, 1000");
$holder->setPhone("11984848489");
$holder->setDtOrigin("2020-05-14");
$holder->setUsername("thaina");
$holder->setPassword('112');
$holder->setAccountNumber($account);


$holderRes->insert($holder);
//holderRes->update($holder);
var_dump($holderRes);