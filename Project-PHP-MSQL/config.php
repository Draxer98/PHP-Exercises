<?php

return [
    'mysql_host' => 'localhost',
    'mysql_user' => 'root',
    'msql_password' => '',
    'msql_db' => 'test',
    'recordsPerPage' => 26,
    'maxLinks' => 10,
    'orderByColumns' => ['id', 'username', 'roleType', 'email', 'fiscalCode', 'age'],
    'recordsPerPageOptions' => [5,10,15,20,50,100],
    'uploadDir' => 'avatar',
    'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
    'maxFileSize' => convertMaxUploadSizeToBytes(),
    'roleType' => ['user', 'editor', 'admin']
];