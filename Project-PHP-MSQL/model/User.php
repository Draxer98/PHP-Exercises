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
    $sql = 'UPDATE data SET username = ?, email = ?, fiscalCode = ?, age = ?, avatar = ? WHERE id =?';
    $stm = $conn->prepare($sql);
    $stm->bind_param('sssisi', $data['username'], $data['email'], $data['fiscalCode'], $data['age'], $data['avatar'], $id);
    $stm->execute();
    $res = $stm->execute();
    $stm->close();
    return $res;
}

function storeUser(array $data)
{
    $conn = getConnection();
    $sql = 'INSERT INTO data (username, email, fiscalCode, age, avatar) VALUE (?, ?, ?, ?, ?)';
    $stm = $conn->prepare($sql);
    $stm->bind_param('sssis', $data['username'], $data['email'], $data['fiscalCode'], $data['age'], $data['avatar']);
    $stm->execute();
    $stm->close();
    return $conn->insert_id;
}
