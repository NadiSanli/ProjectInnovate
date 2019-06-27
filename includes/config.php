<?php

    // Include for database connection.


    $host = 'localhost';
    $db   = 'breedr';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    //Attempts database connection, if not successful, displays an error.
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    try {
        $pdo = new PDO($dsn, $user, $pass);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

?>