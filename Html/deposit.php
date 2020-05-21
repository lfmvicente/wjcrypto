<?php session_start()?>
<html>
<head>
    <meta charset="UTF-8"/>
    <link href="css/Style.css" rel="stylesheet" media="all" />
    <title>WJCrypto - Depositar</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div id="banner">
    <img src=images/wjcrypto_logo.png></img>
</div>
<div id="user">
    <?php
    echo 'Olá ' . $_SESSION['name'];
    ?>
</div>
<nav id="menu">
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="deposit.php">Depositar</a></li>
        <li><a href="withdraw.php">Sacar</a></li>
        <li><a href="#">Transferir</a></li>
        <li><a href="../logout.php">Sair</a></li>
    </ul>
</nav>
<main>
    <form action="/deposit" method="post">
        <div>
            <label for="Deposit" class="label">Valor Depósito:</label>
            <input type="text" name="amount" />
            <p>
                <input type="submit" value="Depositar"/>
            </p>
        </div>

</main>
</body>
</html>