<?php

declare(strict_types=1);

namespace Wjcrypto\SqlDb\Model\ResourceModel;

class Sql
{

    const HOST = 'localhost';
    const DB = 'wjcrypto';
    const USER = 'webjump-nb138';
    const PWD = 'root';

    private $conn;

	public function __construct()
    {
        try {

            $this->conn = new \PDO (
                "mysql:host=" . Sql::HOST . ";
            dbname=" . Sql::DB,
                Sql::USER,
                Sql::PWD
            );
        } catch(\Exception $e) {
            die($e->getMessage());
        }
	}

	private function setParams($statement, $parameters = array())
    {
		foreach ($parameters as $key => $value) {
			$this->setParam($statement, $key, $value);
		}
	}

	private function setParam($statement, $key, $value)
    {
		$statement->bindParam($key, $value);
	}

	public function query($rawQuery, $params = array())
    {
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt;
	}

	public function select($rawQuery, $params = array()):array
    {
		$stmt = $this->query($rawQuery, $params);
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
}

