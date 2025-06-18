<?php
require_once 'connection.php';

function getRandName()
{
    $names = ['Davide', 'Giorgia', 'Dennis', 'Asia', 'Noemi', 'Paolo'];

    $lastnames = ['Navarri', 'Basaglia', 'Sescu', 'Laghi', 'Bellini', 'Scorzoni'];

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
//insertRandUser(10, $mysqli);

function getUser(array $params = [])
{

    $connection = getConnection();
    $records = [];
    $limit = $params['recordsPerPage'];
    $orderBy = $params['orderBy'] ?? 'id';
    $orderDir = $params['orderDir'] ?? 'ASC';
    $search = $params['search'] ?? '';
    $page = $params['page'] ?? 1;
    $start = $limit * ($page - 1);
    if ($orderDir !== 'ASC' && $orderDir !== 'DESC') {
        $orderDir = 'ASC';
    }
    $sql = "SELECT * FROM data";
    if ($search) {
        $sql .= ' WHERE';
        if (is_numeric($search)) {
            $sql .= " (id = $search OR age = $search)";
        } else {
            $sql .= " (username like '%$search%' OR email like '%$search%' OR fiscalCode like '%$search%')";
        }
    }
    $sql .= " ORDER BY $orderBy $orderDir LIMIT $start,$limit";
    $res = $connection->query($sql);

    //var_dump($sql);

    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $records[] = $row;
        }
    }

    return $records;
}

function getTotalUserCount(string $search = '')
{

    $connection = getConnection();

    $sql = "SELECT COUNT(*) as total FROM data";
    if ($search) {
        $sql .= ' WHERE';
        if (is_numeric($search)) {
            $sql .= " id = $search OR age = $search";
        } else {
            $search = $connection->real_escape_string($search);
            $sql .= " username like '%$search%' OR email like '%$search%' OR fiscalCode like '%$search%'";
        }
    }

    $res = $connection->query($sql);
    if ($res && $row = $res->fetch_assoc()) {
        return (int) $row['total'];
    }

    return 0;
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

function dd(mixed ...$data)
{
    var_dump($data);
    die;
}

function showSessionMsg()
{
    if (!empty($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        $allertType = $_SESSION['messageType'];
        unset($_SESSION['messageType']);
        require_once 'view/message.php';
    }
}

//insertRandUser(10, getConnection());
