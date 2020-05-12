<?php;

    require_once "vendor/autoload.php";

    use Wjcrypto\SqlDb\Model\ResourceModel\Sql;
    use Wjcrypto\Holder\Model\Holder;
    use Wjcrypto\Holder\Model\ResourceModel\HolderResource;

    $sql = new Sql();
    $holder = new Holder();
    $holderResource = new HolderResource($sql, $holder);

    var_dump($holderResource->login("felipe", "felipe"));
