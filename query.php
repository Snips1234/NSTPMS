<?php
session_start();
include_once('connection/dsn.php');
include_once('includes/validate.php');
include_once('includes/rules.php');
$pdo = getDatabaseConnection();


// update data
if (isset($_POST['admin-update'])) {
  $data = $_POST;
  // echo "<pre>";
  // var_dump($data);
  // echo "</pre>";
  $errors = validate($data, $edit_rules, $pdo);

  if (count($errors) === 0) {

    $query = "UPDATE tbl_20_columns
                  SET l_name = :last_name, f_name = :first_name, ex_name = :name_extension, 
                      m_name = :middle_name, HEI_name = :HEI_name, type_of_HEI = :type_of_HEI, b_date = :birthday, sex = :gender, 
                      st_brgy = :address_street_barangay, municipality = :address_municipality, 
                      province = :address_province, region = :region, c_status = :civil_status, religion = :religion, 
                      email_add = :email, cp_number = :contact_number, college = :college, 
                      y_level = :year_level, course = :course, major = :major, 
                      cpce = :contact_person_name, cpce_cp_number = :contact_person_number ,nstp_component = :nstp_component , term = :term WHERE std_id = :std_id";

    $params = [
      ':last_name' => ucwords($data['last-name']),
      ':first_name' => ucwords($data['first-name']),
      ':name_extension' => (strcasecmp($data['name-extension'], "N/A")) ?  strToUpper($data['name-extension']) : ucwords($data['name-extension']),
      ':middle_name' => ucwords($data['middle-name']),
      ':HEI_name' => ucwords($data['hei-name']),
      ':type_of_HEI' => ucwords($data['type-of-hei']),
      ':birthday' => ucwords($data['birthday']),
      ':gender' => ucwords($data['gender']),
      ':address_street_barangay' => ucwords($data['address-street-barangay']),
      ':address_municipality' => ucwords($data['address-municipality']),
      ':address_province' => ucwords($data['address-province']),
      ':region' => ucwords($data['region']),
      ':civil_status' => ucwords($data['civil-status']),
      ':religion' => ucwords($data['religion']),
      ':email' => $data['email'],
      ':contact_number' => $data['contact-number'],
      ':college' => ucwords($data['college']),
      ':year_level' => $data['year-level'],
      ':course' => ucwords($data['course']),
      ':major' => ucwords($data['major']),
      ':contact_person_name' => ucwords($data['contact-person-name']),
      ':contact_person_number' => $data['contact-person-number'],
      ':nstp_component' => $data['nstp-component'],
      ':term' => ($data['term'] == 'NSTP1') ? '1' : '2',
      ':std_id' => $data['std_id']
    ];


    // if (!empty($data['password'])) {
    //   $params[':pass'] = password_hash($data['password'], PASSWORD_ARGON2I);
    // }

    try {
      $stmt = $pdo->prepare($query);


      foreach ($params as $param => $value) {
        $stmt->bindValue($param, $value);
      }

      $success = $stmt->execute();

      if ($success) {
        $_SESSION['response']['update'] = "success";
        if $data['term'] == '1'( {
          header('Location: Admin/nstp_1_registration.php');
          exit();
        }else {
          header('Location: Admin/nstp_2_registration.php');
          exit();
        }
        // header('Location: Admin/enrollment.php');
        // exit();
      } else {
        $_SESSION['response']['update'] = "failed";
        header('Location: Admin/update_data.php');
        exit();
      }
    } catch (PDOException $e) {
      error_log("ROTC UPDATE: " . $e->getMessage());
      $_SESSION['response']['update'] = "failed";
      header('Location: Admin/update_data.php');
      exit();
    } finally {
      $stmt = null;
    }
  } else {
    $_SESSION['errors'] = $errors;
    $_SESSION['old-data'] = $data;
    $_SESSION['response']['update'] = "failed";
    header('Location: Admin/update_data.php?std_id=' . $data['std_id']);
    exit();
  }
}

// delete cwts
if (isset($_POST['admin-delete'])) {
  $std_id = $_POST['std_id'];
  $table_name = $_POST['table_name'];


  $sql = "DELETE FROM {$table_name} WHERE std_id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id', $std_id, PDO::PARAM_INT);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $_SESSION['response']['delete'] = "success";
    header('Location: Admin/enrollment.php');
    // $_SESSION['response']['delete'] = "success";
  } else {
    $_SESSION['response']['delete'] = "failed";
    header('Location: Admin/enrollment.php');
    // $_SESSION['response']['delete'] = "failed";
  }
}

// Admin cwts sign up
if (isset($_POST['admin-register'])) {
  $data = $_POST;
  // echo "<pre>";
  // var_dump($_POST);
  // echo "</pre>";

  $errors = validate($data, $register_rules, $pdo);

  if (!count($errors) > 0) {
    $query = "INSERT INTO tbl_20_columns (l_name, f_name, ex_name, m_name, HEI_name, type_of_HEI, b_date, sex, st_brgy, municipality, province, region, c_status, religion, email_add, cp_number, college, y_level, course, major, cpce, cpce_cp_number, nstp_component, term) 
              VALUES (:last_name, :first_name, :name_extension, :middle_name, :HEI_name, :type_of_HEI, :birthday, :gender, :address_street_barangay, :address_municipality, :address_province, :region, :civil_status, :religion, :email, :contact_number, :college, :year_level, :course, :major, :contact_person_name, :contact_person_number, :nstp_component, :term)";

    $params = array(
      ':last_name' => ucwords($data['last-name']),
      ':first_name' => ucwords($data['first-name']),
      ':name_extension' => (strcasecmp($data['name-extension'], "N/A")) ?  strToUpper($data['name-extension']) : ucwords($data['name-extension']),
      ':middle_name' => ucwords($data['middle-name']),
      ':HEI_name' => ucwords($data['hei-name']),
      ':type_of_HEI' => ucwords($data['type-of-hei']),
      ':birthday' => ucwords($data['birthday']),
      ':gender' => ucwords($data['gender']),
      ':address_street_barangay' => ucwords($data['address-street-barangay']),
      ':address_municipality' => ucwords($data['address-municipality']),
      ':address_province' => ucwords($data['address-province']),
      ':region' => ucwords($data['region']),
      ':civil_status' => ucwords($data['civil-status']),
      ':religion' => ucwords($data['religion']),
      ':email' => $data['email'],
      ':contact_number' => $data['contact-number'],
      ':college' => ucwords($data['college']),
      ':year_level' => $data['year-level'],
      ':course' => ucwords($data['course']),
      ':major' => ucwords($data['major']),
      ':contact_person_name' => ucwords($data['contact-person-name']),
      ':contact_person_number' => $data['contact-person-number'],
      ':nstp_component' => $data['nstp-component'],
      ':term' => ($data['term'] == 'NSTP1') ? '1' : '2',
    );

    try {
      $stmt = $pdo->prepare($query);

      foreach ($params as $param => $value) {
        $stmt->bindValue($param, $value);
      }

      $success = $stmt->execute();

      if ($success) {
        $_SESSION['response'] = "success";
        header('Location: Admin/nstp_1_registration.php');
        exit();
      } else {
        $_SESSION['response'] = "failed";
        header('Location: Admin/register.php');
        exit();
      }
    } catch (PDOException $e) {
      error_log("REGISTER: " . $e->getMessage());
      $_SESSION['response'] = "failed";
      header('Location: Admin/register.php');
      exit();
    } finally {
      $stmt = null;
    }
  } else {
    $_SESSION['errors'] = $errors;
    $_SESSION['old-data'] = $data;
    $_SESSION['response'] = "failed";
    header('Location: Admin/register.php');
    exit();
  }
}

// Login 
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = " SELECT `std_id`, `username`, `pass` FROM `tbl_admin` WHERE BINARY `username` = :username";

  $stmt = $pdo->prepare($sql);
  $stmt->execute(['username' => $username]);

  // Fetch the result
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    if (password_verify($password, $user['pass'])) {
      $_SESSION['std_id'] = $user['std_id'];
      $_SESSION['username'] = $user['username'];
      header('Location: Admin/dashboard.php');
      exit();
    } else {
      $_SESSION['response']['login'] = 'failed';
      header('Location: login-page.php');
      exit();
    }
  } else {
    $_SESSION['response']['login'] = 'failed';
    header('Location: login-page.php');
    exit();
  }
}

// update Graduation year and Serial number
// if (isset($_POST['save_gy_sn'])) {
//   if (isset($_POST['id']) && isset($_POST['content'])  && isset($_POST['column'])) {
//     $id = $_POST['id'];
//     $content = $_POST['content'];
//     $column = $_POST['column'];

//     $query = "UPDATE tbl_20_columns SET $column = :content WHERE std_id = :id";

//     $stmt = $pdo->prepare($query);
//     $stmt->bindValue($column, $content);
//     $stmt->bindValue(':id', $id);


//     $stmt->execute();
//   }
// }

if (isset($_POST['save_gy_sn'])) {
  // Check that necessary POST data is set
  if (isset($_POST['id']) && isset($_POST['content']) && isset($_POST['column'])) {
    $id = $_POST['id'];
    $content = $_POST['content'];
    $column = $_POST['column'];

    // Prepare the update query
    $query = "UPDATE tbl_20_columns SET $column = :content WHERE std_id = :id";

    $stmt = $pdo->prepare($query);

    // Bind parameters
    $stmt->bindValue(':content', $content);
    $stmt->bindValue(':id', $id);

    try {
      $stmt->execute();
      echo json_encode(['status' => 'success', 'message' => 'Update successful']);
    } catch (PDOException $e) {
      // Handle error
      echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Missing data']);
  }
}


if (isset($_POST['college'])) {
  $college_id = $_POST['colleges'];

  $stmt = $pdo->prepare("SELECT course_name AS value, course_name AS label, course_id AS data_id FROM tbl_course WHERE college_id = :college_id OR college_id = 6");
  $stmt->execute([':college_id' => $college_id]);

  // Fetch results as an associative array
  $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Return JSON-encoded data
  header('Content-Type: application/json');
  echo json_encode($items);
}

if (isset($_POST['course'])) {
  $course_id = $_POST['courses'];

  $stmt = $pdo->prepare("SELECT major_name AS value, major_name AS label, major_id AS data_id FROM tbl_major WHERE course_id = :course_id OR course_id = 22");
  $stmt->execute([':course_id' => $course_id]);

  // Fetch results as an associative array
  $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Return JSON-encoded data
  header('Content-Type: application/json');
  echo json_encode($items);
}


// udpate grades 
if (isset($_POST['update-grades'])) {
  try {
    $pdo->beginTransaction();

    if (isset($_POST['rows'])) {
      foreach ($_POST['rows'] as $std_id => $data) {
        // Retrieve and sanitize inputs
        $quarter_1_grade_sem_1 = isset($data['quarter_1_grade_sem_1']) ? strtoupper($data['quarter_1_grade_sem_1']) : null;
        $quarter_2_grade_sem_1 = isset($data['quarter_2_grade_sem_1']) ? strtoupper($data['quarter_2_grade_sem_1']) : null;
        $school_year_sem_1 = isset($data['school_year_sem_1']) ? strtoupper($data['school_year_sem_1']) : null;

        $quarter_1_grade_sem_2 = isset($data['quarter_1_grade_sem_2']) ? strtoupper($data['quarter_1_grade_sem_2']) : null;
        $quarter_2_grade_sem_2 = isset($data['quarter_2_grade_sem_2']) ? strtoupper($data['quarter_2_grade_sem_2']) : null;
        $school_year_sem_2 = isset($data['school_year_sem_2']) ? strtoupper($data['school_year_sem_2']) : null;

        $serial_number = isset($data['serial_number']) ? strtoupper($data['serial_number']) : null;

        $remarks_sem_1 = '';
        $remarks_sem_2 = '';
        $average_semester_1 = '';
        $average_semester_2 = '';

        // 1st semester quarter  1 

        if ($quarter_1_grade_sem_1 === 'INC' || strpos($quarter_1_grade_sem_1, '4') !== false) {
          $quarter_1_grade_sem_1 =  "INC";
          $remarks_sem_1 = 'Failed';
        } elseif ($quarter_1_grade_sem_1 === 'DROP' || $quarter_1_grade_sem_1 === 'DRP') {
          $quarter_1_grade_sem_1 = 'DROP';
          $remarks_sem_1 = 'Failed';
        } else {
          if (is_numeric($quarter_1_grade_sem_1)) {
            $quarter_1_grade_sem_1 = (float)$quarter_1_grade_sem_1;
            $quarter_1_grade_sem_1 = number_format($quarter_1_grade_sem_1, 2, ".", '');
          }
        }

        // 1st semester quarter  2 

        if ($quarter_2_grade_sem_1 === 'INC' || strpos($quarter_2_grade_sem_1, '4') !== false) {
          $quarter_2_grade_sem_1 =  "INC";
          $remarks_sem_1 = 'Failed';
        } elseif ($quarter_2_grade_sem_1 === 'DROP' || $quarter_2_grade_sem_1 === 'DRP') {
          $quarter_2_grade_sem_1 = 'DROP';
          $remarks_sem_1 = 'Failed';
        } else {
          if (is_numeric($quarter_2_grade_sem_1)) {
            $quarter_2_grade_sem_1 = (float)$quarter_2_grade_sem_1;
            $quarter_2_grade_sem_1 = number_format($quarter_2_grade_sem_1, 2, ".", '');
          }
        }

        // 2nd semester quarter  1 

        if ($quarter_1_grade_sem_2 === 'INC' || strpos($quarter_1_grade_sem_2, '4') !== false) {
          $quarter_1_grade_sem_2 = "INC";
          $remarks_sem_2 = 'Failed';
        } elseif ($quarter_1_grade_sem_2 === 'DROP' || $quarter_1_grade_sem_2 === 'DRP') {
          $quarter_1_grade_sem_2 = 'DROP';
          $remarks_sem_2 = 'Failed';
        } else {
          if (is_numeric($quarter_1_grade_sem_2)) {
            $quarter_1_grade_sem_2 = (float)$quarter_1_grade_sem_2;
            $quarter_1_grade_sem_2 = number_format($quarter_1_grade_sem_2, 2, ".", '');
          }
        }
        //  2nd semester quarter  2 

        if ($quarter_2_grade_sem_2 === 'INC' || strpos($quarter_2_grade_sem_2, '4') !== false) {
          $quarter_2_grade_sem_2 =  "INC";
          $remarks_sem_2 = 'Failed';
        } elseif ($quarter_2_grade_sem_2 === 'DROP' || $quarter_2_grade_sem_2 === 'DRP') {
          $quarter_2_grade_sem_2 = 'DROP';
          $remarks_sem_2 = 'Failed';
        } else {
          if (is_numeric($quarter_2_grade_sem_2)) {
            $quarter_2_grade_sem_2 = (float)$quarter_2_grade_sem_2;
            $quarter_2_grade_sem_2 = number_format($quarter_2_grade_sem_2, 2, ".", '');
          }
        }

        // //Calculate average grade and determine remarks
        if (!empty($quarter_1_grade_sem_1) && !empty($quarter_2_grade_sem_1) && $remarks_sem_1 !== 'Failed') {
          $average_semester_1 = ((float)$quarter_1_grade_sem_1 + (float)$quarter_2_grade_sem_1) / 2;
          $average_semester_1 = roundToNearestGrade($average_semester_1);
          $remarks_sem_1 = $average_semester_1 > 3.00 ? 'Failed' : 'Passed';
        }

        if (!empty($quarter_1_grade_sem_2) && !empty($quarter_2_grade_sem_2) && $remarks_sem_2 !== 'Failed') {
          $average_semester_2 = ((float)$quarter_1_grade_sem_2 + (float)$quarter_2_grade_sem_2) / 2;
          $average_semester_2 = roundToNearestGrade($average_semester_2);
          $remarks_sem_2 = $average_semester_2 > 3.00 ? 'Failed' : 'Passed';
        }

        echo "quarter  1 sem 1: " . $quarter_1_grade_sem_1 . "<br>";
        echo "quarter  2 sem 1: " . $quarter_2_grade_sem_1 . "<br>";
        echo "quarter  1 sem 2: " . $quarter_1_grade_sem_2 . "<br>";
        echo "quarter  2 sem 2: " . $quarter_2_grade_sem_2 . "<br>";
        echo "average 1: " . $average_semester_1 . "<br>";
        echo "average 2: " . $average_semester_2 . "<br>";

        // Prepare the SQL query to update the database
        $query = "UPDATE tbl_20_columns
                              SET quarter_1_grade_sem_1 = :quarter_1_grade_sem_1, 
                                  quarter_2_grade_sem_1 = :quarter_2_grade_sem_1, 
                                  average_sem_1 = :average_sem_1, 
                                  remarks_sem_1 = :remarks_sem_1, 
                                  school_year_sem_1 = :school_year_sem_1, 
                                  quarter_1_grade_sem_2 = :quarter_1_grade_sem_2, 
                                  quarter_2_grade_sem_2 = :quarter_2_grade_sem_2, 
                                  average_sem_2 = :average_sem_2, 
                                  remarks_sem_2 = :remarks_sem_2, 
                                  school_year_sem_2 = :school_year_sem_2, 
                                  serial_number = :serial_number 
                              WHERE std_id = :std_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':quarter_1_grade_sem_1', $quarter_1_grade_sem_1, PDO::PARAM_STR);
        $stmt->bindValue(':quarter_2_grade_sem_1', $quarter_2_grade_sem_1, PDO::PARAM_STR);
        $stmt->bindValue(':average_sem_1', $average_semester_1, PDO::PARAM_STR);
        $stmt->bindValue(':remarks_sem_1', $remarks_sem_1, PDO::PARAM_STR);
        $stmt->bindValue(':school_year_sem_1', $school_year_sem_1, PDO::PARAM_STR);

        $stmt->bindValue(':quarter_1_grade_sem_2', $quarter_1_grade_sem_2, PDO::PARAM_STR);
        $stmt->bindValue(':quarter_2_grade_sem_2', $quarter_2_grade_sem_2, PDO::PARAM_STR);
        $stmt->bindValue(':average_sem_2', $average_semester_2, PDO::PARAM_STR);
        $stmt->bindValue(':remarks_sem_2', $remarks_sem_2, PDO::PARAM_STR);
        $stmt->bindValue(':school_year_sem_2', $school_year_sem_2, PDO::PARAM_STR);
        $stmt->bindValue(':serial_number', $serial_number, PDO::PARAM_STR);

        $stmt->bindValue(':std_id', $std_id, PDO::PARAM_INT);
        $stmt->execute();
      }

      $pdo->commit();
      $_SESSION['response']['grades'] = 'success';
      header('Location: Admin/grading.php');
      exit();
    } else {
      $_SESSION['response']['grades'] = 'failed';
      header('Location: Admin/grading.php');
      exit();
    }
  } catch (PDOException $e) {
    error_log("GRADE: " . $e->getMessage());
    $pdo->rollBack();
    $_SESSION['response']['grades'] = 'failed';
    header('Location: Admin/grading.php');
    exit();
  }
}

function roundToNearestGrade($average)
{

  if (!is_numeric($average) || empty($average)) {
    return null;
  }

  echo ($average);

  $gradeCategories = ['1.00', '1.25', '1.50', '1.75', '2.00', '2.25', '2.50', '2.75', '3.00', '5.00'];


  $numericCategories = array_map('floatval', $gradeCategories);


  if ($average > 3.00) {
    return '5.00';
  }
  $closestGrade = $gradeCategories[0];
  $smallestDifference = abs($average - $numericCategories[0]);

  foreach ($numericCategories as $index => $grade) {
    $difference = abs($average - $grade);
    if ($difference < $smallestDifference) {
      $smallestDifference = $difference;
      $closestGrade = $gradeCategories[$index];
    }
  }

  return $closestGrade;
}
// Function to convert percentage to grade
function convertPercentageToGrade($percentage)
{
  if ($percentage >= 96) return '1.00';
  if ($percentage >= 94) return '1.25';
  if ($percentage >= 91) return '1.50';
  if ($percentage >= 88) return '1.75';
  if ($percentage >= 85) return '2.00';
  if ($percentage >= 83) return '2.25';
  if ($percentage >= 80) return '2.50';
  if ($percentage >= 78) return '2.75';
  if ($percentage >= 75) return '3.00';
  return '5.00'; // Below 75%
}
