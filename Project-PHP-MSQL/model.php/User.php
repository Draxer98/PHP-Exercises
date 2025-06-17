<?php
require_once '../connection.php';
function deleteUser(int $id)
{
    $conn = getConnection();
    $sql = 'DELETE FROM data WHERE id=' . $id;
    $res = $conn->query($sql);
    return $res && $conn->affected_rows;
}
