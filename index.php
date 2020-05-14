<?php

    require_once "vendor/autoload.php";

    use Pecee\SimpleRouter\SimpleRouter;

    $router = new SimpleRouter();
    $router->setDefaultNamespace('Wjcrypto\Router');

    $router->get('/', 'Web@home')->setName('home');

    $router->get('/login', 'Web@login')->setName('login');

    $router->get('/cadastro', 'Web@signUp')->setName('signUp');

    $router->start();






