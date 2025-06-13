<?php
require_once 'connection.php';

function getRandName()
{
    $names = ['Giovanni', 'Roberto', 'Luca', 'Mario', 'Marco', 'Giulia'];

    $lastnames = ['Rossi', 'Bianchi', 'Previato', 'Rizzieri', 'Albieri', 'Guerra'];

    $randNames = mt_rand(0, count($names) - 1);
    $randLastNames = mt_rand(0, count($lastnames) - 1);

    return $names[$randNames] . ' ' . $lastnames[$randLastNames];
}
//echo getRandName();

function getRandEmail(string $name)
{
    $domain = ['google.com', 'yahoo.com', 'hotmail.it', 'libero.it'];


    $randEmail = mt_rand(0, count($domain) - 1);
    return strtolower(str_replace(' ', '.', $name) . mt_rand(10, 99) . '@' . $domain[$randEmail]);
}
//echo getRandEmail(getRandName());

function getRandFiscalCode()
{

    $i = 16;
    $res = '';
    $random = 0;

    while ($i > 0) {
        $random = mt_rand(1, 2);
        if ($random === 1) {
            $res .= chr(mt_rand(65, 90));
        } else {
            $res .= mt_rand(1, 9);
        }

        $i--;
    }

    return $res;
}

//echo getRandFiscalCode();
function getRandAge()
{
    return mt_rand(18, 99);
}

function insertRandUser($total, mysqli $connection)
{
    while ($total > 0) {
        $username = getRandName();
        $email = getRandEmail($username);
        $fiscalCode = getRandFiscalCode();
        $age = getRandAge();
        $sql = 'INSERT INTO data (username, email, fiscalCode, age) VALUES ';
        $sql .= "('$username', '$email', '$fiscalCode', $age) ";

        echo $total . ' ' . $sql . "<br>";

        $res = $connection->query($sql);
        if (!$res) {
            echo $connection->error . '<br>';
        } else {
            $total--;
        }
    }
}
//insertRandUser(9, $mysqli);

function getUser(array $params = [])
{

    $connection = $GLOBALS['mysqli'];
    $records = [];
    $limit = $params['recordsPerPage'] ?? 10; 
    $orderBy = $params['orderBy'] ?? 'id';
    $orderDir = $params['orderDir'] ?? 'ASC';
    $search = $params['search'] ?? '';
    if ($orderDir !== 'ASC' && $orderDir !== 'DESC') {
        $orderDir = 'ASC';
    }
    $sql = "SELECT * FROM data ORDER BY $orderBy $orderDir LIMIT 0,$limit";

    $res = $connection->query($sql);
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $records[] = $row;
        }
    }

    return $records;
}

function getConfig($param, $default = null)
{
    $config = require 'config.php';
    //var_dump($config);
    return $config[$param] ?? $default;
}
//var_dump(getUser());

function getParam($param, $default = '')
{
    return $_REQUEST[$param] ?? $default;
}

function dd(mixed $data = null)
{
    var_dump($data);
    die;
}
