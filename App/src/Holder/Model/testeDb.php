<?php

    //namespace wjcrypto\Model;

    require "../config.php";

    /*$sql = new Sql();
    $result = $sql->select("SELECT * FROM holder");
    echo json_encode($result);*/

    /*$user = new Holder;
    $user->loadById(1);
    echo $user;*/

    

    $holder = new Holder();
    $holder->login("felipe", "felipe");
    echo $holder;