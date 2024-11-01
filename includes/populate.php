<?php
require_once('../connection/dsn.php');

$column = $_POST['column'];
$id = $_POST['id'];

$pdo = getDatabaseConnection();

$query = "SELECT region AS value, region AS display_text FROM tbl_region";
$stmt = $pdo->prepare($query);
$stmt->execute();
$options = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

// Return JSON response
echo json_encode($options);
