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

    $currentUser = getUserById($id);

    $username = $data['username'] ?? $currentUser['username'];
    $email = $data['email'] ?? $currentUser['email'];
    $fiscalCode = $data['fiscalCode'] ?? $currentUser['fiscalCode'];
    $age = $data['age'] ?? $currentUser['age'];

    $avatar = isset($data['avatar']) && $data['avatar'] ? $data['avatar'] : $currentUser['avatar'];

    if (empty($data['password'])) {
        $passwordHash = $currentUser['password'];
    } else {
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
    }

    $roleType = isset($data['roleType']) && in_array($data['roleType'], getConfig('roleType', []))
        ? $data['roleType']
        : $currentUser['roleType'];

    $sql = 'UPDATE data SET username = ?, email = ?, fiscalCode = ?, age = ?, avatar = ?, password = ?, roleType = ? WHERE id = ?';
    $stm = $conn->prepare($sql);
    $stm->bind_param(
        'sssisssi',
        $username,
        $email,
        $fiscalCode,
        $age,
        $avatar,
        $passwordHash,
        $roleType,
        $id
    );
    $res = $stm->execute();
    $stm->close();
    return $res;
}

function storeUser(array $data)
{
    $conn = getConnection();

    $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

    $roleType = isset($data['roleType']) && in_array($data['roleType'], getConfig('roleType', []))
        ? $data['roleType']
        : 'user';

    $sql = 'INSERT INTO data (username, email, fiscalCode, age, avatar, password, roleType) VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stm = $conn->prepare($sql);
    $stm->bind_param(
        'sssisss',
        $data['username'],
        $data['email'],
        $data['fiscalCode'],
        $data['age'],
        $data['avatar'],
        $passwordHash,
        $roleType
    );
    $stm->execute();
    $stm->close();
    return $conn->insert_id;
}
