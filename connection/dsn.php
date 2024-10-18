<?php
function getDatabaseConnection() {
    $dsn = "mysql:host=localhost;dbname=clms_db;port=3307;";
    $username = "root";
    $pass = "";

    try {
        $pdo = new PDO($dsn, $username, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        error_log("Connection failed: " . $e->getMessage(), 3, '/path/to/error.log');
        die("Connection failed. Please try again later."); // Stop script execution with a generic message
    }
}


