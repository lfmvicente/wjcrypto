<?php

require_once "vendor/autoload.php";

use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
use Wjcrypto\Token\Model\ResourceModel\TokenResource;
use Wjcrypto\Token\Model\Token;
use Wjcrypto\Validator\Model\Validator;

$sql = new Sql();
$token = new Token();

$tokenRes = new TokenResource($sql, $token);

$token->generateToken(true);
$token->setToken('9a4acbd6e0913b0a59f23431439343591bd172e5a5854927bf91e849af4839b6');
$tokenRes->delete($token);
//$tokenRes->save($token);

//var_dump($tokenRes);