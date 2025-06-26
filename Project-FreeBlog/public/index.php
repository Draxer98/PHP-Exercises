<?php

use app\controllers\PostController;

require '../app/DB/dbpdo.php';
require '../app/DB/dbFactory.php';
require '../app/controllers/post_controller.php';

chdir(dirname(__DIR__));
$data = require 'config/database.php';
try {
    $controller = new PostController((app\DB\dbFactory::create($data))->getConn());
    $controller->show();
    $controller->display();
} catch (\PDOException $e) {
    echo $e->getMessage();
}
