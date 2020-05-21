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
    <div id="user">
    <?php
    session_start();
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
</body>
</html>
 