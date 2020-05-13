<?php

require_once "vendor/autoload.php";

use Wjcrypto\Account\Model\ResourceModel\AccountResource;
use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
use Wjcrypto\Account\Model\Account;
use Wjcrypto\Holder\Model\Holder;

$sql = new Sql();

$holder = new Holder();
$holder->setId(6);

$account = new Account();
$accountRes = new AccountResource($sql, $account);
$account->setId(12);
$account->setHolderId($holder);
//$account->generateNumber($holder);
//$account->setHolderId($holder);

$accountRes->insert($account);
var_dump($accountRes);
