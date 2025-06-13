<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'functions.php';
$recordsPerPageOptions = getConfig('recordsPerPageOptions', [5, 10, 20]);
$recordsPerPageDefault = getConfig('recordsPerPage', 10);
$recordsPerPage = getParam('recordsPerPage', $recordsPerPageDefault);
$search = getParam('search', '');
$search = strip_tags($search);
require_once 'view/top.php';
require_once 'view/nav.php';
?>

<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
        <h1>User Management System</h1>
        <?php
        $action = getParam('action');
        $page = $_SERVER['PHP_SELF'];
        switch ($action) {

            case 'insert':
                break;

            default:
                $orderDir = getParam('orderDir', 'ASC');
                $orderByColums = getConfig('orderByColums', []);
                $orderBy = getParam('orderBy');
                $orderBy = in_array($orderBy, $orderByColums) ? $orderBy : null;
                $params = ['orderBy' => $orderBy, 'recordsPerPage' => $recordsPerPage, 'orderDir' => $orderDir, 'recordsPerPage' => $recordsPerPage];
                $users = getUser($params);

                require 'view/userList.php';
                break;
        }
        ?>
    </div>
</main>

<?php
require_once 'view/footer.php';
?>