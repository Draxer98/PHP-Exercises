<?php
$params = [
    'orderBy' => $orderBy,
    'recordsPerPage' => $recordsPerPage,
    'orderDir' => $currentOrderDir,
    'search' => $search,
    'page' => $currentPage
];

$orderDirClass = $currentOrderDir;

$pageUrl = "$page?search=$search&recordsPerPage=$recordsPerPage&orderBy=$orderBy&orderDir=$currentOrderDir";
$users = $totalRecords ? getUser($params) : [];

require 'view/userList.php';