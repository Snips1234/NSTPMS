<?php
require_once('../connection/dsn.php');

$column = $_POST['column'];
$id = $_POST['id'];

$pdo = getDatabaseConnection();

if ($column == 'region') {
  $query = "SELECT region AS value, region AS display_text FROM tbl_region";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $options = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);


  echo json_encode($options);
} else {

  $query = "SELECT course_name AS value, course_name AS display_text FROM tbl_course";
  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $options = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);


  echo json_encode($options);
}
