<?php
session_start();
require '../functions.php';
require '../model/User.php';

$action = getParam('action', '');

switch ($action) {
    case 'delete':
        $id = getParam('id', 0);
        $res = deleteUser($id);
        $message = $res ? 'USER ' . $id . ' DELETED' : 'ERROR DELETING USER' . $id;
        $_SESSION['message'] = $message;
        $_SESSION['messageType'] = $res ? 'success' : 'danger';
        $params = $_GET;
        unset($params['id'], $params['action']);
        $queryString = http_build_query($params);
        header('Location:../index.php?' . $queryString);
        break;
    case 'edit':
        $id = (int) $_POST['id'];
        $userData = [
            'id' => $id,
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'fiscalCode' => trim($_POST['fiscalCode']),
            'age' => (int) $_POST['age']
        ];

        $res = updateUser($userData, $id);

        $message = $res ? 'USER ' . $id . ' UPDATED' : 'ERROR UPDATING USER ' . $id;
        $_SESSION['message'] = $message;
        $_SESSION['messageType'] = $res ? 'success' : 'danger';

        $params = $_GET;
        unset($params['id'], $params['action']);
        $queryString = http_build_query($params);

        header('Location:../index.php?' . $queryString);
        break;

    default:
        break;
}
