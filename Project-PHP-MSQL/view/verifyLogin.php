<?php
session_start();
require_once '../functions.php';

if(!empty($_POST)){
    if(!empty($_POST['action']) && !empty($_POST['action']) === 'logout'){
        $_SESSION = [];
        header('Location: login.php');
        exit;
    }
    $token = $_POST['_csrf'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = verifyLogin($email, $password, $token); 
    unset($_SESSION['_csrf']);
    if($result['success']) {
        session_regenerate_id(true);
        $_SESSION['loggedin'] = true;
        unset($result['user']['password']);
        $_SESSION['userData'] = $result['user'];
        header('Location: ../index.php');
        exit;
    } else {
        $_SESSION['userData'] = $result['message'];
        header('Location: ../login.php');
    }

} else {
    header('Location: ../login.php');
}