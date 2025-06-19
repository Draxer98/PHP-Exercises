<?php
session_start();

if(!empty($_POST)){
    echo $_SESSION['csrf'];
    print_r($_POST);
}