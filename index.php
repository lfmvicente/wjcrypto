<?php

    require_once "vendor/autoload.php";

    session_start();

    use DI\ContainerBuilder;
    use Pecee\SimpleRouter\SimpleRouter;
    use Wjcrypto\Account\Controller\AccountController;
    use Wjcrypto\Account\Controller\Transfer;
    use Wjcrypto\Account\Controller\Withdraw;
    use Wjcrypto\Token\Controller\CreateToken;
    use Wjcrypto\Account\Controller\Home;
    use Wjcrypto\Account\Controller\Login;
    use Wjcrypto\Account\Controller\Deposit;
    use Wjcrypto\Holder\Controller\HolderController;

    $container = (new ContainerBuilder())
        ->useAutowiring(true)
        ->build();

    $router = new SimpleRouter();

    $router::enableDependencyInjection($container);

    $router->get('/', function() use($router, $container) {

    });

    $router->post('/token', function() use($router, $container) {
        $tokenController = $container->make(CreateToken::class);
        $tokenController->execute($router);
    });

    $router->get('/holders', function() use($router, $container) {
        $holderController = $container->make(HolderController::class);
        $holderController->execute($router);
    });

    $router->get('/accounts', function() use($router, $container) {
        $accountController = $container->make(AccountController::class);
        $accountController->execute($router);
    });

    $router->post('/login', function() use($router, $container) {
       $loginController = $container->make(Login::class);
       $loginController->execute($router);
    });

    $router->get('/home', function() use($router, $container) {
        $homeController = $container->make(Home::class);
        $homeController->execute($router);
    });

    $router->post('/deposit', function() use($router, $container) {
        $depositController = $container->make(Deposit::class);
        $depositController->execute($router);
    });

    $router->post('/withdraw', function() use($router, $container) {
       $withdrawController = $container->make(Withdraw::class);
       $withdrawController->execute($router);
    });

    $router->post('/transfer', function() use($router, $container) {
        $transferController = $container->make(Transfer::class);
        $transferController->execute($router);
    });

    $router->get('/jquery/ajax/example', function() use($router, $container) {
        $router::response()->json([
            'username'=>$_SESSION['username']
        ]);
    });

    $router->start();
