<?php

require_once "vendor/autoload.php";

session_start();

use DI\ContainerBuilder;
use Pecee\SimpleRouter\SimpleRouter;
use Wjcrypto\Account\Controller\IndexController;
use Wjcrypto\Account\Controller\Logout;
use Wjcrypto\Account\Controller\Transfer;
use Wjcrypto\Account\Controller\Withdraw;
use Wjcrypto\Holder\Controller\SignUp;
use Wjcrypto\Token\Controller\CreateToken;
use Wjcrypto\Account\Controller\Home;
use Wjcrypto\Account\Controller\Login;
use Wjcrypto\Account\Controller\Deposit;
use Wjcrypto\Account\Controller\Welcome;
use Wjcrypto\WebApi\Controller\RestfullDeposit;
use Wjcrypto\WebApi\Controller\RestfullTransfer;
use Wjcrypto\WebApi\Controller\RestfullWithdraw;

$container = (new ContainerBuilder())
    ->useAutowiring(true)
    ->build();

$router = new SimpleRouter();

$router::enableDependencyInjection($container);

$router->get('/', function() use($router, $container) {
    $indexController = $container->make(IndexController::class);
    $indexController->execute($router);

});

$router->post('/token', function() use($router, $container) {
    $tokenController = $container->make(CreateToken::class);
    $tokenController->execute($router);
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

$router->post('/signup', function() use($router, $container) {
    $signUpController = $container->make(SignUp::class);
    $signUpController->execute($router);
});

$router->get('/logout', function() use($router, $container) {
    $logoutController = $container->make(Logout::class);
    $logoutController->execute($router);
});

$router->get('/welcome', function() use($router, $container) {
    $welcomeController = $container->make(Welcome::class);
    $welcomeController->execute($router);
});

$router->post('/rest/deposit', function() use($router, $container) {
    $depositRestController = $container->make(RestfullDeposit::class);
    $depositRestController->execute($router);
});

$router->post('/rest/withdraw', function() use($router, $container) {
    $withdrawRestController = $container->make(RestfullWithdraw::class);
    $withdrawRestController->execute($router);
});

$router->post('/rest/transfer', function() use($router, $container) {
    $transferRestController = $container->make(RestfullTransfer::class);
    $transferRestController->execute($router);
});

$router->start();
