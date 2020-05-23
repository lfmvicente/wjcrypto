<?php

    declare(strict_types=1);

    namespace Wjcrypto\Router;

    class Web
    {
        public function home()
        {
            echo "Home web";
        }

        public function login()
        {
            echo "Login Web";
        }

        public function holder()
        {
            echo "Cadastro Holder";
        }

        public function account()
        {
            echo "Cadastro Conta";
        }

        public function notFound()
        {
            echo "Rota não encontrada";
        }


    }

