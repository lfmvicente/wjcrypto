<?php

declare(strict_types=1);

namespace Wjcrypto\Encryptor\Model;

define('SECRET_IV', pack('a16', 'wjcrypto'));
define('SECRET', pack('a16', 'wjcrypto'));

class Encryptor{

    public function encrypt($data)
    {
        return openssl_encrypt($data,'AES-128-CBC','SECRET', 0, 'SECRET_IV');
    }

    public function decrypt($data)
    {
        return openssl_decrypt($data,'AES-128-CBC','SECRET', 0, 'SECRET_IV');
    }
}
