<?php

[$script, $host, $db, $user, $pass] = $argv;
$pdo = new PDO(
    "mysql:host=$host",
    $user,
    $pass,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
$stmt = $pdo->exec("DROP DATABASE IF EXISTS $db");