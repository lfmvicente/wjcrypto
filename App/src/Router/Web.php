<?php

    declare(strict_types=1);

    namespace Wjcrypto\Router;

    class Web
    {
        public function home()
        {
            echo "Home Web";
        }

        public function login()
        {
            echo $_GET['username'];
            echo $_GET['password'];
        }

        public function signUp()
        {
            echo "Cadastro Web";
        }

        public function notFound()
        {
            echo "Rota não encontrada";
        }


    }

