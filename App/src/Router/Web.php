<?php

    declare(strict_types=1);

    namespace Wjcrypto\Router;


    use DI\Container;

    class Web
    {
        public function home()
        {
            echo "Home Web";
        }

        public function login()
        {
            echo $_GET['username'].PHP_EOL;
            echo $_GET['password'];
        }

        public function signUp()
        {
            echo "Cadastro Web";
        }

        public function token()
        {
            echo "Token";
        }

        public function notFound()
        {
            echo "Rota não encontrada";
        }


    }

