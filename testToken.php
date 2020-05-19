<?php

require_once "vendor/autoload.php";

use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
use Wjcrypto\Token\Model\ResourceModel\TokenResource;
use Wjcrypto\Token\Model\Token;

$sql = new Sql();
$token = new Token();

$tokenRes = new TokenResource($sql, $token);

$token->generateToken(true);

$tokenRes->save($token);
var_dump($tokenRes);
