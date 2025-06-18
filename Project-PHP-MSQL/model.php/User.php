<?php
function deleteUser(int $id)
{
    $conn = getConnection();
    $sql = 'DELETE FROM data WHERE id=' . $id;
    $res = $conn->query($sql);
    return $res && $conn->affected_rows;
}

function getUserById(int $id)
{
    $conn = getConnection();
    $sql = 'SELECT * FROM data WHERE id =?';
    $stm = $conn->prepare($sql);
    $stm->bind_param('i', $id);
    $stm->execute();
    $result = $stm->get_result();
    $user = $result->fetch_assoc();
    $stm->close();
    return $user;
}

function updateUser(array $data, int $id)
{
    $conn = getConnection();
    $sql = 'UPDATE data SET username = ?, email = ?, fiscalCode = ?, age = ? WHERE id =?';
    $stm = $conn->prepare($sql);
    $stm->bind_param('sssii', $data['username'], $data['email'], $data['fiscalCode'], $data['age'], $id);
    $stm->execute();
    $res = $stm->execute();
    $stm->close();
    return $res;
}
