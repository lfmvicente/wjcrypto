<?php

require_once "vendor/autoload.php";

use Wjcrypto\Holder\Model\ResourceModel\HolderResource;
use Wjcrypto\Holder\Model\Holder;
use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
use Wjcrypto\Account\Model\Account;

$sql = new Sql();
$holder = new Holder();
$holderRes = new HolderResource($sql, $holder);

//$account = new Account();
//$account->generateNumber($holder);

$holder->setName("Luis");
$holder->setDocument("12345678910");
$holder->setAdditionalDocument("123456789");
$holder->setAddress("Rua WK, 1000");
$holder->setPhone("11984848484");
$holder->setDtOrigin("2020-05-13");
$holder->setUsername("luis");
$holder->setPassword("4321");
$holder->setAccountNumber("$account");


//$holderRes->insert($holder);
$holderRes->getById(1);
var_dump($holderRes);