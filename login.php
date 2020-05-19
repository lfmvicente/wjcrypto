<?php

    require_once "vendor/autoload.php";

    use Wjcrypto\Holder\Model\ResourceModel\HolderResource;
    use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
    use Wjcrypto\Holder\Model\Holder;
    use Wjcrypto\Holder\Exception\InvalidLoginException;

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = new Sql();
    $holder = new Holder();
    $holderRes = new HolderResource($sql, $holder);

    $holderRes->login($username, $password);

    if (isset($holderRes)) {
        echo "passou";
    }else{
        echo "errado";
    }
    
