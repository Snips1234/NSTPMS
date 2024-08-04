<?php
function connection() {
  $host = 'localhost';
  $username = 'root';
  $password = '';
  $db_name = 'clms_db';


  $conn = new mysqli($host, $username, $password, $db_name);
  
  if($conn->connect_error) {
    echo $conn->connect_error;
  }else {
    return $conn;
  }
}

?>