<?php

if (!empty($_POST['username']) && !empty($_POST['student-type'])) {
  require_once('connection/dsn.php');

  $tableName = ($_POST['student-type'] === 'CWTS') ? 'tbl_20_columns_cwts' : 'tbl_20_columns_lts';

  $query = "SELECT COUNT(*) FROM $tableName WHERE username = :username";
  
  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
  $stmt->execute();

  $count = $stmt->fetchColumn();


  error_log("Username: {$_POST['username']}, Student Type: {$_POST['student-type']}, Count: {$count}");


  echo json_encode(['status' => $count > 0 ? 'taken' : 'available']);
} else {
  echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
}
