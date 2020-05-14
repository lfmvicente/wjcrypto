<?php

require_once "vendor/autoload.php";

    use Pecee\SimpleRouter\SimpleRouter;

    SimpleRouter::setDefaultNamespace( "Wjcrypto\Routes");

    SimpleRouter::get('/admin',function($data) {
        echo 'Route';
        var_dump($data);
    });

    SimpleRouter::start();






