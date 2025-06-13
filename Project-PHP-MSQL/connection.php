<?php
$config = require 'config.php';

$mysqli = new mysqli($config['mysql_host'], $config['mysql_user'], $config['msql_password'], $config['msql_db']);

if($mysqli->connect_error) {
    die($mysqli->connect_error);
}