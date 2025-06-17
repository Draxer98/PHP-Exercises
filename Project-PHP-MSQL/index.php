<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'functions.php';
$page = $_SERVER['PHP_SELF'];
$updateUrl = 'controller/updateRecord.php';

$recordsPerPageOptions = getConfig('recordsPerPageOptions', [5, 10, 15, 20, 50, 100]);
$recordsPerPageDefault = getParam('recordsPerPage', 10);
$recordsPerPage = (int) getParam('recordsPerPage', $recordsPerPageDefault);

$search = getParam('search', '');
$search = strip_tags(trim($search));

$orderByColumns = getConfig('orderByColumns', ['id', 'username', 'email', 'fiscalCode', 'age']);
$maxLinks = getConfig('maxLinks', 10);

$orderBy = getParam('orderBy', 'id');
$currentOrderDir = getParam('orderDir', 'ASC');
$currentPage = getParam('page', 1);

$orderBy = in_array($orderBy, $orderByColumns) ? $orderBy : 'id';

$totalRecords = getTotalUserCount($search);

require_once 'view/top.php';
require_once 'view/nav.php';
?>

<main class="flex-shrink-0">
    <div class="container">
        <h1>User Management System</h1>
        <?php
        if(!empty($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
            $success = $_SESSION['success'] ?? true;
            $allertType = $success ? 'success' : 'danger';
            require_once 'view/message.php';
        }
        $action = getParam('action');
        $page = $_SERVER['PHP_SELF'];

        require_once 'controller/displayUsers.php';
        ?>
    </div>
</main>

<?php
require_once 'view/footer.php';
?>
