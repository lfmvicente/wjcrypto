<html>
<head>
    <meta charset="UTF-8"/>
    <link href="css/Style.css" rel="stylesheet" media="all" />
    <title>WJCrypto - Home</title>
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
    <div id="user">
        <?php
        session_start();
        echo 'Olá ' . $_SESSION['name'] . ', Seu Saldo atual é de R$ ' . $_SESSION['balance'] ;
        ?>
    </div>
</body>
</html>
 