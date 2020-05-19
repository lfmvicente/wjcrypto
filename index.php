<?php

    require_once "vendor/autoload.php";

    use Pecee\Http\Request;
    use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
    use Pecee\SimpleRouter\SimpleRouter;

    $router = new SimpleRouter();
    $router->setDefaultNamespace('Wjcrypto\Router');

    $router->get('/', 'Web@home')->setName('home');

    $router->get('/login', 'Web@login')->setName('login');

    $router->get('/cadastro', 'Web@signUp')->setName('signUp');

    $router->get('/token', 'Web@token')->setName('token');

    $router->get('/not-found', 'Web@notFound')->setName('notFound');

    $router->error(function(Request $request, \Exception $exception) {

        if($exception instanceof NotFoundHttpException && $exception->getCode() === 404) {
            response()->redirect('/not-found');
    }

});

    $router->start();

