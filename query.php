<?php
session_start();


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


if (isset($_POST['cwts-sign-up'])) {
  $query = "INSERT INTO tbl_20_columns (l_name, f_name, ex_name, m_name, b_date, sex, st_brgy, municipality, province, c_status, religion, email_add, cp_number, college, y_level, course, major, cpce, cpce_cp_number, nstp_component, username, pass) VALUES (:last_name, :first_name, :name_extension, :middle_name, :birthday, :gender, :address_street_barangay, :address_municipality, :address_province, :civil_status, :religion, :email, :contact_number, :college, :year_level, :course, :major, :contact_person_name, :contact_person_number, :student_type, :username, :pass)";


  $params = array(
    ':last_name' => strtoupper($_POST['last-name']),
    ':first_name' => strtoupper($_POST['first-name']),
    ':name_extension' => strtoupper($_POST['name-extension']),
    ':middle_name' => strtoupper($_POST['middle-name']),
    ':birthday' => strtoupper($_POST['birthday']),
    ':gender' => strtoupper($_POST['gender']),
    ':address_street_barangay' => strtoupper($_POST['address-street-barangay']),
    ':address_municipality' => strtoupper($_POST['address-municipality']),
    ':address_province' => strtoupper($_POST['address-province']),
    ':civil_status' => strtoupper($_POST['civil-status']),
    ':religion' => strtoupper($_POST['religion']),
    ':email' => $_POST['email'],
    ':contact_number' => strtoupper($_POST['contact-number']),
    ':college' => strtoupper($_POST['college']),
    ':year_level' => strtoupper($_POST['year-level']),
    ':course' => strtoupper($_POST['course']),
    ':major' => strtoupper($_POST['major']),
    ':contact_person_name' => strtoupper($_POST['contact-person-name']),
    ':contact_person_number' => strtoupper($_POST['contact-person-number']),
    ':student_type' => strtoupper($_POST['student-type']),
    ':username' => $_POST['username'],
    ':pass' => password_hash($_POST['password'], PASSWORD_ARGON2I),
  );

  insertData($query, $params, 'cwts.page');
}


if (isset($_POST['lts-sign-up'])) {
  $query = "INSERT INTO tbl_20_columns (l_name, f_name, ex_name, m_name, b_date, sex, st_brgy, municipality, province, c_status, religion, email_add, cp_number, college, y_level, course, major, cpce, cpce_cp_number, nstp_component, username, pass) VALUES (:last_name, :first_name, :name_extension, :middle_name, :birthday, :gender, :address_street_barangay, :address_municipality, :address_province, :civil_status, :religion, :email, :contact_number, :college, :year_level, :course, :major, :contact_person_name, :contact_person_number, :student_type, :username, :pass)";


  $params = array(
    ':last_name' => strtoupper($_POST['last-name']),
    ':first_name' => strtoupper($_POST['first-name']),
    ':name_extension' => strtoupper($_POST['name-extension']),
    ':middle_name' => strtoupper($_POST['middle-name']),
    ':birthday' => strtoupper($_POST['birthday']),
    ':gender' => strtoupper($_POST['gender']),
    ':address_street_barangay' => strtoupper($_POST['address-street-barangay']),
    ':address_municipality' => strtoupper($_POST['address-municipality']),
    ':address_province' => strtoupper($_POST['address-province']),
    ':civil_status' => strtoupper($_POST['civil-status']),
    ':religion' => strtoupper($_POST['religion']),
    ':email' => $_POST['email'],
    ':contact_number' => strtoupper($_POST['contact-number']),
    ':college' => strtoupper($_POST['college']),
    ':year_level' => strtoupper($_POST['year-level']),
    ':course' => strtoupper($_POST['course']),
    ':major' => strtoupper($_POST['major']),
    ':contact_person_name' => strtoupper($_POST['contact-person-name']),
    ':contact_person_number' => strtoupper($_POST['contact-person-number']),
    ':student_type' => strtoupper($_POST['student-type']),
    ':username' => $_POST['username'],
    ':pass' => password_hash($_POST['password'], PASSWORD_ARGON2I),
  );

  insertData($query, $params, 'lts.page');
}

function logError($message)
{
  $logFile = 'error_log.txt';
  $timestamp = date('Y-m-d H:i:s');
  file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}


if (isset($_POST['login-form'])) {
  try {
    require_once('connection/dsn.php');


    $query = "SELECT * FROM tbl_20_columns WHERE `username` = :username";

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':username', $_POST['username']);
    $result = $stmt->execute();

    if ($result) {
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if (password_verify($_POST['password'], $user['pass'])) {
        $_SESSION['user'] = $user['l_name'] . ' ' . $user['f_name'] . ' ' . $user['m_name'] . ' ' . $user['ex_name'];
        if ($user['nstp_component'] == 'CWTS') {
          header('Location: cwts.page.php');
          exit();
        } else {
          header('Location: lts.page.php');
          exit();
        }
      } else {
        $_SESSION['response'] = "failed";
        header('Location: login-page.php');
        exit();
      }
    } else {
      $_SESSION['response'] = "failed";
      header('Location: login-page.php');
      exit();
    }
  } catch (PDOException $e) {
    $_SESSION['response'] = $e->getMessage();
    header('Location: login-page.php');
    exit();
  }
}
