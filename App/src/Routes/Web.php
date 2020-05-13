<?php

declare(strict_types=1);

namespace Wjcrypto\Routes;


    class Web
    {
        public function home($data)
        {
            echo "Home";
            var_dump($data);
        }

        public function deposit($data)
        {
            echo "Deposit";
        }

        public function withdrawl($data)
        {
            echo "Withdrawl";
        }

        public function transfer($data)
        {
            echo "transfer";
        }

    }
