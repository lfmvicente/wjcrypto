<?php

require_once "vendor/autoload.php";

use Wjcrypto\Account\Model\ResourceModel\AccountResource;
use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
use Wjcrypto\Account\Model\Account;
use Wjcrypto\Holder\Model\Holder;

$sql = new Sql();

$holder = new Holder();
$holder->setId(5);

$account = new Account($holder);
$accountRes = new AccountResource($sql, $account);

$account->setHolderId($holder);
$account->generateNumber($holder);
$account->setHolderId($holder);

$accountRes->delete(11);
//var_dump($account);
