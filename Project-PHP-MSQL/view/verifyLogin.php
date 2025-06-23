<?php
session_start();
require_once '../functions.php';

if(!empty($_POST)){

    $token = $_POST['_crsf'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = verifyLogin($email, $password, $token);

} else {
    header('Location: login.php');
}