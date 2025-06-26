<?php

return [
    'drivers' => 'mysql',
    'host' => 'localHost',
    'user' => 'root',
    'password' => '',
    'database' => 'freeblog',
    'dsn' => '',
    'pdooptions' => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
];
