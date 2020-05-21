<?php

    require_once "vendor/autoload.php";

    session_start();

    use DI\ContainerBuilder;
    use Pecee\SimpleRouter\SimpleRouter;
    use Wjcrypto\Token\Controller\CreateToken;
    use Wjcrypto\Token\Controller\Testando;
    use Wjcrypto\Account\Controller\Home;
    use Wjcrypto\Account\Controller\Login;

    $container = (new ContainerBuilder())
        ->useAutowiring(true)
        ->build();

    $router = new SimpleRouter();

    $router::enableDependencyInjection($container);

    $router->post('/token', function() use($router, $container) {
        $tokenController = $container->make(CreateToken::class);
        $tokenController->execute($router);
    });

    $router->get('/holders', function() use($router, $container) {
        $testandoController = $container->make(Testando::class);
        $testandoController->execute($router);
    });

    $router->post('/login', function() use($router, $container) {
       $loginController = $container->make(Login::class);
       $loginController->execute($router);
    });

    $router->get('/home', function() use($router, $container) {
        $homeController = $container->make(Home::class);
        $homeController->execute($router);
    });

    $router->get('/jquery/ajax/example', function() use($router, $container) {
        $router::response()->json([
            'username'=>$_SESSION['username']
        ]);
    });

    $router->start();
