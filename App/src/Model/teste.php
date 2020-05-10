<?php

    require 'vendor/autoload.php';

    $umaConta = new wjcrypto\Account();
    $outraConta = new wjcrypto\Account();

    $umaConta->deposit(100);
    $umaConta->withdraw(100);
    $umaConta->transfer(50, $outraConta);

    echo "uma conta: " . $umaConta->getBalance();
    echo "outra conta: " . $outraConta->getBalance();

