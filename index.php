<?php

    require_once "vendor/autoload.php";

    use Pecee\Http\Request;
    use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
    use Pecee\SimpleRouter\SimpleRouter;

    $router = new SimpleRouter();
    $router->setDefaultNamespace('Wjcrypto');

    $router->get('/', 'Router\Web@home')->setName('home');

    $router->get('/login', 'Router\Web@login')->setName('login');

    $router->get('/cadastro', 'Router\Web@signUp')->setName('signUp');

    $router->get('/token', 'Token\Model\Token@generateToken')->setName('generateToken');

    $router->get('/not-found', 'Router\Web@notFound')->setName('notFound');

    $router->error(function(Request $request, \Exception $exception) {

        if($exception instanceof NotFoundHttpException && $exception->getCode() === 404) {
            response()->redirect('/not-found');
    }

});

    $router->start();

