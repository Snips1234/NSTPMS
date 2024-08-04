<?php

include('./connection/connection.php');

$conn = connection();
session_start();

if(isset($_POST['cwts-sign-up'])) {
  echo $_POST['last-name'] . "<br>";
  echo $_POST['first-name'] . "<br>";
  echo $_POST['name-extension']. "<br>";
  echo $_POST['middle-name']. "<br>";
  echo $_POST['birthday']. "<br>";
  echo $_POST['gender']. "<br>";
  echo $_POST['address-street-barangay']. "<br>";
  echo $_POST['address-municipality']. "<br>";
  echo $_POST['address-province']. "<br>";
  echo $_POST['civil-status']. "<br>";
  echo $_POST['religion']. "<br>";
  echo $_POST['email']. "<br>";
  echo $_POST['contact-number']. "<br>";
  echo $_POST['college']. "<br>";
  echo $_POST['year-level']. "<br>";
  echo $_POST['course']. "<br>";
  echo $_POST['major']. "<br>";
  echo $_POST['contact-person-name']. "<br>";
  echo $_POST['contact-person-number']. "<br>";
  echo $_POST['username']. "<br>";
  echo $_POST['password']. "<br>";
  echo $_POST['student-type']. "<br>";
}