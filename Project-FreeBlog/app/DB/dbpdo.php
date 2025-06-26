<?php

namespace app\DB;

class DBPDO
{
    protected $conn;
    protected static $instance;

    protected function __construct(array $option)
    {
        $this->conn = new \PDO($option['dsn'], $option['user'], $option['password'], $option['pdooptions']);
    }

    public static function getInstance(array $option)
    {
        if (!static::$instance) {
            static::$instance = new static($option);
        }
        return static::$instance;
    }

    public function getConn()
    {
        return $this->conn;
    }
}
