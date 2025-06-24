<?php
session_start();
require '../functions.php';
if (!isUserLoggedin()) {
    header('Location: login.php');
    exit;
}
require '../model/User.php';

$action = getParam('action', '');

switch ($action) {
    case 'delete':
        $id = getParam('id', 0);
        $user = getUserById($id);
        $user = getUserById($id);
        if ($user && $user['avatar']) {
            deleteUserImages($user['avatar']);
        }
        $res = deleteUser($id);
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
            'age' => (int) $_POST['age'],
            'avatar' => null,
            'password' => trim($_POST['password']),
            'roleType' => trim($_POST['roleType'])
        ];
        $oldUser = getUserById($id);
        $avatarPath = $oldUser['avatar'] ?? '';
        if (isset($_FILES['avatar']) && $_FILES['avatar']['name']) {
            $avatarPath = handleAvatarUpload($_FILES['avatar'], $id);
        }
        $userData['avatar'] = $avatarPath;
        $res = updateUser($userData, $id);

        $params = $_GET;
        unset($params['id'], $params['action']);
        $queryString = http_build_query($params);

        header('Location:../index.php?' . $queryString);
        break;

    case 'store':
        $userData = [
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'fiscalCode' => trim($_POST['fiscalCode']),
            'age' => (int) $_POST['age'],
            'avatar' => null,
            'password' => trim($_POST['password']),
            'roleType' => trim($_POST['roleType'])
        ];
        $avatarPath = '';
        if (isset($_FILES['avatar']) && $_FILES['avatar']['name']) {
            $avatarPath = handleAvatarUpload($_FILES['avatar']);
        }
        $userData['avatar'] = $avatarPath;
        $res = storeUser($userData);
        $params = $_GET;
        unset($params['id'], $params['action']);
        $queryString = http_build_query($params);

        header('Location:../index.php?' . $queryString);
        break;
    default:
        break;
}
