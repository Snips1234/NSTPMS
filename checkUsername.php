<?php

if ($_POST['username']) {
  require_once('connection/dsn.php');

  $query = "SELECT * FROM tbl_20_columns WHERE username = :username";

  $stmt = $pdo->prepare($query);
  $stmt->bindValue(':username', $_POST['username']);

  $stmt->execute();

  $count = $stmt->fetchColumn();

  echo json_encode(['status' => $count > 0 ? 'taken' : 'available']);

  $stmt = null;
  $pdo = null;
}
