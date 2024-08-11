<?php
// session_start();
function insertData($query, $params, $location)
{
  require_once('connection/dsn.php');

  try {
    $stmt = $pdo->prepare($query);

    foreach ($params as $param => $value) {
      $stmt->bindValue($param, $value);
    }

    $success = $stmt->execute();

    if ($success) {
      $_SESSION['response'] = "success";
      header('Location: ' . $location . '.php');
      exit();
    } else {
      $_SESSION['response'] = "failed";
      header('Location: index.php');
      exit();
    }

    $pdo = null;
    $stmt = null;
  } catch (PDOException $e) {
    echo $e->getMessage();
    // header ('Location: index.php');

  }
}
