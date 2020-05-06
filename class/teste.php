<?php

    require "Account.php";
    require "Holder.php";

    $umaConta = new Account();
    $outraConta = new Account();

    $umaConta->balance = 1000;
    $outraConta->balance = 1000;

    $umaConta->deposit(100);
    $umaConta->withdraw(100);

    $umaConta->transfer(50, $outraConta);

    echo "uma conta: " . $umaConta->getBalance();
    echo "outra conta: " . $outraConta->getBalance();

