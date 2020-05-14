<?php

    define('SECRET_IV', pack('a16', 'felipe'));
    define('SECRET', pack('a16', 'felipe'));

    $senha = "senhas";

    $open = openssl_encrypt($senha,'AES-128-CBC','SECRET', 0, 'SECRET_IV');

    echo $open.PHP_EOL;

    $open = openssl_encrypt($senha,'AES-128-CBC','SECRET', 0, 'SECRET_IV');

    echo $open.PHP_EOL;

    $dec = openssl_decrypt($open, 'AES-128-CBC', 'SECRET', 0, 'SECRET_IV');

    echo $dec.PHP_EOL;

