<?php
require_once 'connection.php';

function verifyLogin($email, $password, $token)
{
    require_once 'model/User.php';
    $result = ['message' => 'USER LOGGED IN', 'success' => true];

    if ($token !== ($_SESSION['_csrf'] ?? '')) {
        return ['message' => 'TOKEN MISMATCH', 'success' => false];
    }

    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
        return ['message' => 'INVALID EMAIL', 'success' => false];
    }

    if (strlen($password) < 6) {
        return ['message' => 'PASSWORD TOO SMALL', 'success' => false];
    }

    $user = getUserByEmail($email);
    if (!$user) {
        return ['message' => 'USER NOT FOUND', 'success' => false];
    }

    if (!password_verify($password, $user['password'])) {
        return ['message' => 'WRONG PASSWORD', 'success' => false];
    }

    $result['user'] = $user;
    return $result;
}

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
            $sql .= " (username like '%$search%' OR email like '%$search%' OR fiscalCode like '%$search%' OR roleType like '%$search%')";
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

function getUserByEmail(string $email)
{
    $connection = getConnection();
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
        return null;
    }
    $email = mysqli_real_escape_string($connection, $email);
    $sql = "SELECT * FROM data WHERE email = '$email' LIMIT 1";
    $res = $connection->query($sql);

    if ($res && $row = $res->fetch_assoc()) {
        return $row;
    }

    return null;
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

function handleAvatarUpload(array $file, int $userId = null)
{
    $config = require 'config.php';

    $uploadDir = $config['uploadDir'] ?? 'avatar';
    $uploadDirPath = __DIR__ . '/' . $uploadDir;
    if (!is_dir($uploadDirPath)) {
        mkdir($uploadDirPath, 0777, true);
    }
    $mimeMap = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif'
    ];
    $fileInfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $fileInfo->file($file['tmp_name']);

    if (!isset($mimeMap[$mimeType])) {
        throw new Exception('Invalid file type');
    }

    $extension = $mimeMap[$mimeType];
    $fileName = ($userId ? $userId . '_' : '') . bin2hex(random_bytes(8)) . '.' . $extension;
    $destination = $uploadDirPath . DIRECTORY_SEPARATOR . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new Exception('Failed to move uploaded file');
    }

    return $uploadDir . '/' . $fileName;
}

function redirectWithParams()
{
    $params = $_GET;
    if (isset($param['id'])) {
        unset($params['id']);
    }
    if (isset($param['action'])) {
        unset($params['action']);
    }
    $queryString = http_build_query($params);
    header('Location:../index.php?' . $queryString);
    exit;
}

function convertMaxUploadSizeToBytes()
{
    $val = ini_get('upload_max_filesize');
    $val = trim($val);
    $last = strtolower($val[strlen($val) - 1]);
    $val = (int)$val;
    switch ($last) {
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }
    return $val;
}

function formatBytes(int $bytes)
{
    if ($bytes < 1) {
        return 0;
    }
    $units = [
        'Bytes',
        'Kilobytes',
        'Megabytes',
        'Gigabytes'
    ];
    $power = floor(log($bytes, 1024));
    $number = round($bytes / 1024 ** $power, 2);

    return $number . ' ' . $units[$power];
}

function deleteUserImages(string $avatarPath)
{
    if (!$avatarPath) return;
    $filePath = __DIR__ . '/' . $avatarPath;
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

function isUserLoggedin()
{
    return $_SESSION['loggedin'] ?? false;
}

function getUserLoggedInFullname()
{
    return $_SESSION['userData']['username'] ?? '';
}

function getUserRole()
{
    return $_SESSION['userData']['roleType'] ?? '';
}

function isUserAdmin()
{
    return getUserRole() === 'admin';
}

function userCanUpdate()
{
    $role = getUserRole();
    return ($role === 'admin' || $role === 'editor');
}

function userCanDelete()
{
    return isUserAdmin();
}
//insertRandUser(10, getConnection());
