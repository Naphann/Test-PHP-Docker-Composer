<?php
function db_connect() {
    try {
        $config = parse_ini_file('../../config/database-config.ini');
        $pdo = new PDO('mysql:host=' . $config['servername'] . ';dbname=' . $config['dbname'] . ';charset=utf8mb4',
            $config['username'], $config['password']);
        return $pdo;
    } catch (PDOException $e) {
        die();
    }
}
