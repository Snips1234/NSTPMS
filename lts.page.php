<?php
session_start();
require 'connection/dsn.php';
if (!isset($_SESSION['nstp_component']) && ($_SESSION['nstp_component'] !== "LTS")) {
  header('Location: http://localhost/CLMS_/login-page.php');
  exit();
} else {
  if (isset($_SESSION['response']['create']) && $_SESSION['response']['create'] == 'success') {
  }
}

if (isset($_SESSION['username'])) {
  try {
    $username = $_SESSION['username'];
    $pdo = getDatabaseConnection();
    $sql = "SELECT * FROM `tbl_20_columns_lts` WHERE `username` = :username";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="icons/css/all.css">
  <title>CWTS</title>

  <style>
    body {
      background-color: #f0f6ff;
      color: #28384d;

    }

    .social-profile a {
      color: #fff;
    }

    .social-profile {
      position: relative;
      margin-bottom: 150px;
    }

    .social-profile .user-profile {
      position: absolute;
      bottom: -75px;
      width: 150px;
      height: 150px;
      border-radius: 50%;
      left: 50px;
    }


    .social-prof {
      color: #333;
      text-align: center;
    }

    .social-prof .wrapper {
      width: 70%;
      margin: auto;
      margin-top: -50px;
      background-color: white;
    }

    /* .social-prof img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      margin-bottom: 20px;
      border: 5px solid #fff;
      /*border: 10px solid #70b5e6ee;
    } */

    .social-prof h3 {
      font-size: 40px;
      font-weight: 700;
      margin-bottom: 0;
    }
  </style>
</head>

<body class="">
  <main>
    <!-- <div class="row w-100 px-3">
      <div class="col-md-12">
        <div class="top-breadcrumb">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Social</li>
            </ol>
          </nav>
        </div>
      </div>
    </div> -->
    <div class="container">
      <div class="" style="background-image: linear-gradient(150deg, rgba(63, 174, 255, .3)15%, rgba(63, 174, 255, .3)70%, rgba(63, 174, 255, .3)94%), url(Images/bg_img.jpg);height: 350px;background-size: cover;">
      </div>
      <div class="card social-prof pb-5">
        <div class="card-body">
          <div class="wrapper shadow rounded-2 py-2">
            <!-- <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="" class="user-profile"> -->
            <h4>
              <?= htmlspecialchars($data['f_name']) ?>
              <?= htmlspecialchars($data['m_name']) ?>
              <?= htmlspecialchars($data['l_name']) ?>
              <?= htmlspecialchars($data['ex_name']) ?>
            </h4>
            <p>LTS Student</p>
          </div>
          <div class="row ">
            <div class="col-lg-12">
              <!-- <ul class=" nav nav-tabs justify-content-center s-nav">
                <li><a class="active" href="#">Timeline</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Friends</a></li>
                <li><a href="#">Photos</a></li>
                <li><a href="#">Videos</a></li>
              </ul> -->


            </div>
          </div>
        </div>
      </div>
      <div class="card my-2">
        <div class="card-body p-5">
          <div class="d-flex flex-column">
            <div class="nav flex-row justify-content-center nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-user me-2"></i>Information</button>

              <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-book me-2"></i>Education</button>

              <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-nstp" type="button" role="tab" aria-controls="v-pills-nstp" aria-selected="false"><i class="fas fa-bars"></i> NSTP</button>

              <button class="nav-link" id="v-pills-grade-tab" data-bs-toggle="pill" data-bs-target="#v-pills-grade" type="button" role="tab" aria-controls="v-pills-grade" aria-selected="false"><i class="fa fa-list me-2" aria-hidden="true"></i>My Grade</button>

              <button class="nav-link" id="v-pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#v-pills-disabled" type="button" role="tab" aria-controls="v-pills-disabled" aria-selected="false"><i class="fas fa-map-marker-alt me-2"></i>Address</button>

              <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fa fa-phone me-2"></i>Contact Person</button>



              <!-- <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-cog me-2" aria-hidden="true"></i>Settings</button> -->
              <a href="logout.php" class="nav-link">
                <i class="fa fa-sign-out me-2" aria-hidden="true"></i>
                Logout
              </a>
            </div>
            <div class="tab-content my-4 px-5" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                <div class=" table-responsive">
                  <table class="table m-0 table-striped">
                    <thead>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="no-wrap fs-6"><b>Last Name</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['l_name']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>First Name</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['f_name']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Extension Name</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['ex_name']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Middle Name</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['m_name']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Birthday</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['b_date']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Sex</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars(strtoupper($data['sex'])) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Religion</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['religion']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Phone Number</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['cp_number']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Email</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['email_add']) ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>

              </div>

              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                <div class=" table-responsive">
                  <table class="table m-0 table-striped">
                    <thead>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="no-wrap fs-6"><b>HEI Name</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars(strtoupper($data['HEI_name'])) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Type of HEI</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars(strtoupper($data['type_of_HEI'])) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>College</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars(strtoupper($data['college'])) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Year Level</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['y_level']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Course</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['course']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Major</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['major']) ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-nstp" role="tabpanel" aria-labelledby="v-pills-nstp-tab" tabindex="0">
                <div class=" table-responsive">
                  <table class="table m-0 table-striped">
                    <thead>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="no-wrap fs-6"><b>NSTP Component</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars(strtoupper($data['nstp_component'])) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>NSTP Serial Number</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars(strtoupper($data['serial_number'])) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>NSTP Graduation Year</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['nstp_grad_year']) ?></td>
                      </tr>
                      <!-- <tr>
                        <td class="no-wrap fs-6"><b>Course</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['course']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Major</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['major']) ?></td>
                      </tr> -->
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">
                <div class="table-responsive">
                  <table class="table m-0 table-striped ">
                    <thead>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="no-wrap fs-6"><b>Street/Barangay</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['st_brgy']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Town/City/Municipality</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['municipality']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Province</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['province']) ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
                <div class="table-responsive">
                  <table class="table m-0 table-striped ">
                    <thead>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="no-wrap fs-6"><b>Full Name</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['cpce']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Phone Number</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['cpce_cp_number']) ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-grade" role="tabpanel" aria-labelledby="v-pills-grade-tab" tabindex="0">
                <div class="table-responsive">
                  <table class="table m-0 table-bordered">
                    <thead>
                      <tr>
                        <th colspan="5" class="text-center <?= !empty($data['remarks_sem_1']) ? ($data['remarks_sem_1'] === 'Passed' ? 'table-success' : 'table-danger') : 'table-active' ?>">
                          First Semester
                        </th>
                      </tr>
                      <tr>
                        <th class="text-center">
                          Quater 1
                        </th>
                        <th class="text-center">
                          Quater 2
                        </th>
                        <th class="text-center">
                          Average
                        </th>
                        <th class="text-center">
                          Remarks
                        </th>
                        <th class="text-center">
                          School Year
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class=" no-wrap text-center fs-6"><?= htmlspecialchars($data['quarter_1_grade_sem_1']) ?></td>
                        <td class=" no-wrap text-center fs-6"><?= htmlspecialchars($data['quarter_2_grade_sem_1']) ?></td>
                        <td class=" no-wrap text-center fs-6"><?= htmlspecialchars($data['average_sem_1']) ?></td>
                        <td class=" no-wrap text-center fs-6"><?= htmlspecialchars($data['remarks_sem_1']) ?></td>
                        <td class=" no-wrap text-center  fs-6"><?= htmlspecialchars($data['school_year_sem_1']) ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table m-0 table-bordered mt-2 ">
                    <thead>
                      <tr>
                        <th colspan="5" class="text-center <?= !empty($data['remarks_sem_2']) ? ($data['remarks_sem_2'] === 'Passed' ? 'table-success' : 'table-danger') : 'table-active' ?>">
                          Second Semester
                        </th>
                      </tr>
                      <tr>
                        <th class="text-center">
                          Quater 1
                        </th>
                        <th class="text-center">
                          Quater 2
                        </th>
                        <th class="text-center">
                          Average
                        </th>
                        <th class="text-center">
                          Remarks
                        </th>
                        <th class="text-center">
                          School Year
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class=" no-wrap text-center fs-6"><?= htmlspecialchars($data['quarter_1_grade_sem_2']) ?></td>
                        <td class=" no-wrap text-center fs-6"><?= htmlspecialchars($data['quarter_2_grade_sem_2']) ?></td>
                        <td class=" no-wrap text-center fs-6"><?= htmlspecialchars($data['average_sem_2']) ?></td>
                        <td class=" no-wrap text-center fs-6"><?= htmlspecialchars($data['remarks_sem_2']) ?></td>
                        <td class=" no-wrap text-center fs-6"><?= htmlspecialchars($data['school_year_sem_2']) ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
                <div class="table-responsive">
                  <table class="table m-0 table-striped ">
                    <thead>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="no-wrap fs-6"><b>Full Name</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['cpce']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-6"><b>Phone Number</b></td>
                        <td class=" no-wrap fs-6"><?= htmlspecialchars($data['cpce_cp_number']) ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade d-flex justify-content-center" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
                <a href="logout.php" class="btn btn-primary">
                  <i class="fa fa-sign-out me-2" aria-hidden="true"></i>
                  Logout
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.js"></script>

</body>

</html>

<?php unset($_SESSION['response']); ?>