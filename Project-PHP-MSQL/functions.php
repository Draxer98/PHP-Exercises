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

function handleAvatarUpload(array $file, int $userId = null)
{
    $config = require 'config.php';

    $uploadDir = $config['uploadDir'] ?? 'avatar';
    $uploadDirPath = realpath(__DIR__ . '/' . $uploadDir);
    $mimeMap = [
        'images/jpeg' => 'jpg',
        'images/png' => 'png',
        'images/gif' => 'gif'
    ];
    
    $fileInfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $fileInfo->file($file['tmp_name']);

    $extension = $mimeMap[$mimeType];
    $fileName = ($userId ? $userId . '_' : '') . bin2hex(random_bytes(8)) . '.' . $extension;

    $destination = $uploadDirPath . DIRECTORY_SEPARATOR . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new Exception('Failed to move uploaded file');
    }

    return $res ? $uploadDir . '/' . $fileName : null;
}

function validateFileUpload(array $file)
{
    $errors = [];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = getUploadError($file['error']);
        return $errors;
    }
    $config = require 'config.php';

    if (!in_array($mimeType, array_keys($mimeMap))) {
        $errors[] = 'Invalid file type. Allowed types: JPEG, PNG, GIf';
    }

    if ($file['size'] > ($config['maxFileSize'] ?? 2 * 1024 * 1024)) {
        $errorS[] = 'File size exceeds ' . $config['maxFileSize'];
    }

    return $errors;
}

function getUploadError(int $errorCode)
{
    $error = '';
    switch ($errorCode) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            $error = 'File size exceeds the allowed limit.';
            break;
        case UPLOAD_ERR_PARTIAL:
            $error = 'The file was only partially uploaded.';
            break;
        case UPLOAD_ERR_NO_FILE:
            $error = 'No file was uploaded.';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $error = 'Missing temporary folder.';
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $error = 'Failed to write file to disk.';
            break;
        case UPLOAD_ERR_EXTENSION:
            $error = 'File upload stopped by extension.';
            break;
        default:
            $error = 'Unknown file uploaded error.';
            break;
    }

    return $error;
}

function setFlashMessage(string $message, string $type = 'info')
{
    $_SESSION['message'] = $message;
    $_SESSION['messageType'] = $type;
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

//insertRandUser(10, getConnection());
