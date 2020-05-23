<?php

require_once "vendor/autoload.php";

use Wjcrypto\Account\Model\ResourceModel\AccountResource;
use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
use Wjcrypto\Account\Model\Account;
use Wjcrypto\Holder\Model\Holder;

$sql = new Sql();

$holder = new Holder();
$holder->setId(11);

$account = new Account();
$account->setId(28);

$accountRes = new AccountResource($sql, $account);

//$account->setId(21);
//$account->setHolderId($holder);
//$account->generateNumber($holder);
//$account->setHolderId($holder);

$accountRes->linkHolder($account, $holder);
//$accountRes->insert($account);
//$accountRes->update($account);
var_dump($accountRes);
