<?php

require '../app/DB/dbpdo.php';
require '../app/DB/dbFactory.php';
chdir(dirname(__DIR__));
$data = require 'config/database.php';
try {
    $pdoConn = app\DB\dbFactory::create($data);
    $conn = $pdoConn->getConn();
    $stm = $conn->query('select * from posts', PDO::FETCH_OBJ);

    if ($stm) {
        while ($row = $stm->fetchObject()) {
            print_r($row);
        }
    } else {
        $conn->errorInfo();
    }
} catch (\PDOException $e) {
    echo $e->getMessage();
}

use app\controllers\PostController;

require 'app/controllers/post_controller.php';

$controller = new PostController();
$controller->show(1);
$controller->display();
