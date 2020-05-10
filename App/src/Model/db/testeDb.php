<?php

    require "Sql.php";

    $sql = new Sql();

    $result = $sql->select("SELECT * FROM holder");

    echo json_encode($result);