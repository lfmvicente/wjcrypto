<?php
session_start();
?>
<html>
<head>
    <meta charset="UTF-8"/>
    <link href="css/Style.css" rel="stylesheet" media="all" />
    <title>WJCrypto - Deposito</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div id="banner">
    <img src=images/wjcrypto_logo.png></img>
</div>
<nav id="menu">
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="deposit.php">Depositar</a></li>
        <li><a href="withdraw.php">Sacar</a></li>
        <li><a href="transfer.php">Transferir</a></li>
        <li><a href="/logout">Sair</a></li>
    </ul>
</nav>
<main>
    <form action="/deposit" method="post">
        <label for="Deposit" class="label">Valor a Depositar:</label>
        <div>
            <input type="text" name="amount" />
            <p>
                <input type="submit" value="Depositar"/>
            </p>
        </div>
    </form>
</main>
</body>
</html>