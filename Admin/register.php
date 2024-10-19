<?php
session_start();
require "Partials/header.php";
require "Partials/navbar.php";
require "Partials/sidebar.php";
require "../includes/functions.php";

try {
  require_once('../connection/dsn.php'); 
  $pdo = getDatabaseConnection();

  $query = "SELECT * FROM `tbl_region`";

  $stmt = $pdo->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="m-0"></h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="enrollment.php">Enrollment</a></li>
            <li class="breadcrumb-item">Register</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <form id="admin-sign-up-form" action="../query.php" method="post" novalidate>
              <div class="card">
                <div class="card-header bg-primary">
                  <h4 class="text-white">Register student</h4>
                </div>
                <div class="card-body">
                  <fieldset>
                    <legend class="text-black-50">Full Name</legend>
                    <div class="row">
                      <div class="col-md-3 mb-3">
                        <div class="control">
                          <label for="last-name" class="form-label text-secondary">Last Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control <?= isset($_SESSION['errors']['last-name']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="last-name" name="last-name" placeholder="Enter your last name" value="<?= isset($_SESSION['old-data']['last-name']) ? htmlspecialchars($_SESSION['old-data']['last-name']) : '' ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['last-name'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['last-name']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="control">
                          <label for="first-name" class="form-label text-secondary">First Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control <?= isset($_SESSION['errors']['first-name']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="first-name" name="first-name" placeholder="Enter your first name" value="<?php echo htmlspecialchars($_SESSION['old-data']['first-name'] ?? '', ENT_QUOTES); ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['first-name'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['first-name']) ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="control">
                          <label for="name-extension" class="form-label text-secondary">Name Extension</label>
                          <input type="text" class="form-control <?= isset($_SESSION['errors']['name-extension']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="name-extension" name="name-extension" placeholder="Enter your name extension" value="<?= isset($_SESSION['old-data']['name-extension']) ? htmlspecialchars($_SESSION['old-data']['name-extension']) : '' ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['name-extension'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['name-extension']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="control">
                          <label for="middle-name" class="form-label text-secondary">Middle Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control <?= isset($_SESSION['errors']['middle-name']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="middle-name" name="middle-name" placeholder="Enter your middle name" value="<?= isset($_SESSION['old-data']['middle-name']) ? htmlspecialchars($_SESSION['old-data']['middle-name']) : '' ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['middle-name'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['middle-name']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  <fieldset>
                    <legend class="text-black-50">HEI name/Type of HEIs</legend>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <div class="control">
                          <label for="hei-name" class="form-label text-secondary">HEI name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control <?= isset($_SESSION['errors']['hei-name']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="hei-name" name="hei-name" placeholder="Enter your HEI name" value="<?= isset($_SESSION['old-data']['hei-name']) ? htmlspecialchars($_SESSION['old-data']['hei-name']) : (isset($results['HEI_name']) ? htmlspecialchars($results['HEI_name']) : '') ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['hei-name'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['hei-name']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                         <div class="col-md-6 mb-3">
                        <div class="control">
                          <label for="type-of-hei" class="form-label text-secondary">Types of HEIs <span class="text-danger">*</span></label>
                          <select class="custom-select <?= isset($_SESSION['errors']['type-of-hei']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="type-of-hei" name="type-of-hei">
                            <option selected disabled>Type of HEI</option>
                            <option value="SUCs" <?= (isset($_SESSION['old-data']['type-of-hei']) && $_SESSION['old-data']['type-of-hei'] == 'SUCs') ? 'selected' : '' ?>>
                              SUCs
                            </option>
                            <option value="LUCs" <?= (isset($_SESSION['old-data']['type-of-hei']) && $_SESSION['old-data']['type-of-hei'] == 'LUCs') ? 'selected' : '' ?>>
                              LUCs
                            </option>
                             <option value="OGS" <?= (isset($_SESSION['old-data']['type-of-hei']) && $_SESSION['old-data']['type-of-hei'] == 'OGS') ? 'selected' : '' ?>>
                              OGS
                            </option>
                             <option value="PHE" <?= (isset($_SESSION['old-data']['type-of-hei']) && $_SESSION['old-data']['type-of-hei'] == 'PHE') ? 'selected' : '' ?>>
                              PHE
                            </option>
                          </select>
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['type-of-hei'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['type-of-hei']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  <fieldset>
                    <legend class="text-black-50">Birthday and Gender</legend>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <div class="control">
                          <label for="birthday" class="form-label text-secondary">Birthday <span class="text-danger">*</span></label>
                          <input type="date" class="form-control <?= isset($_SESSION['errors']['birthday']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="birthday" name="birthday" value="<?= isset($_SESSION['old-data']['birthday']) ? htmlspecialchars($_SESSION['old-data']['birthday']) : '' ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="control">
                          <label for="gender" class="form-label text-secondary">Sex <span class="text-danger">*</span></label>
                          <select class="custom-select <?= isset($_SESSION['errors']['gender']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="gender" name="gender">
                            <option selected disabled>Sex</option>
                            <option value="male" <?= (isset($_SESSION['old-data']['gender']) && $_SESSION['old-data']['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?= (isset($_SESSION['old-data']['gender']) && $_SESSION['old-data']['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                          </select>
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['gender'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['gender']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  <fieldset>
                    <legend class="text-black-50">Address</legend>
                    <div class="row">
                      <div class="col-lg-4 mb-3">
                        <div class="control">
                          <label for="address-street-barangay" class="form-label text-secondary">Street/Barangay <span class="text-danger">*</span></label>
                          <input type="text" class="form-control <?= isset($_SESSION['errors']['address-street-barangay']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="address-street-barangay" name="address-street-barangay" placeholder="Enter your Street/Barangay" value="<?= isset($_SESSION['old-data']['address-street-barangay']) ? htmlspecialchars($_SESSION['old-data']['address-street-barangay']) : '' ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['address-street-barangay'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['address-street-barangay']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 mb-3">
                        <div class="control">
                          <label for="address-municipality" class="form-label text-secondary">Town/City/Municipality <span class="text-danger">*</span></label>
                          <input type="text" class="form-control <?= isset($_SESSION['errors']['address-municipality']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="address-municipality" name="address-municipality" placeholder="Enter your Municipality" value="<?= isset($_SESSION['old-data']['address-municipality']) ? htmlspecialchars($_SESSION['old-data']['address-municipality']) : '' ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['address-municipality'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['address-municipality']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 mb-3">
                        <div class="control">
                          <label for="address-province" class="form-label text-secondary">Province <span class="text-danger">*</span></label>
                          <input type="text" class="form-control <?= isset($_SESSION['errors']['address-province']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="address-province" name="address-province" placeholder="Enter you Province" value="<?= isset($_SESSION['old-data']['address-province']) ? htmlspecialchars($_SESSION['old-data']['address-province']) : '' ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['address-province'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['address-province']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 mb-3">
                         <div class="control">
                          <label for="region" class="form-label text-secondary">Region <span class="text-danger">*</span></label>
                          <select class="custom-select <?= isset($_SESSION['errors']['region']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="region" name="region">
                            <option selected disabled>Select region</option>
                            <?php foreach($result as $row):?>
                                <option value="<?= htmlspecialchars($row['region']); ?>" <?= (isset($_SESSION['old-data']['region']) && $_SESSION['old-data']['region'] == $row['region']) ? 'selected' : '' ?>>
                                  <?= htmlspecialchars($row['region']); ?>
                                </option>
                            <?php endforeach;?>   
                          </select>
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['gender'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['gender']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  <fieldset>
                    <legend class="text-black-50">Others</legend>
                    <div class="row">
                      <div class="col-md-3 mb-3">
                        <div class="control">
                          <label for="civil-status" class="form-label text-secondary">Civil Status <span class="text-danger">*</span></label>
                          <select class="custom-select <?= isset($_SESSION['errors']['civil-status']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="civil-status" name="civil-status" value="<?= isset($data['civil-status']) ? htmlspecialchars($data['civil-status']) : '' ?>">
                            <option value="">Civil Status</option>
                            <option value="single" <?= (isset($_SESSION['old-data']['civil-status']) && $_SESSION['old-data']['civil-status'] == 'single') ? 'selected' : '' ?>>Single</option>
                            <option value="married" <?= (isset($_SESSION['old-data']['civil-status']) && $_SESSION['old-data']['civil-status'] == 'married') ? 'selected' : '' ?>>Married</option>
                          </select>
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['civil-status'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['civil-status']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="control">
                          <label for="religion" class="form-label text-secondary">Religion <span class="text-danger">*</span></label>
                          <input type="text" class="form-control <?= isset($_SESSION['errors']['religion']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="religion" name="religion" placeholder="Enter your religion" value="<?= isset($_SESSION['old-data']['religion']) ? htmlspecialchars($_SESSION['old-data']['religion']) : '' ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['religion'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['religion']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="control">
                          <label for="contact-number" class="form-label text-secondary">Contact Number <span class="text-danger">*</span></label>
                          <input type="text" class="form-control <?= isset($_SESSION['errors']['contact-number']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="contact-number" name="contact-number" placeholder="Enter your contact number" value="<?= isset($_SESSION['old-data']['contact-number']) ? htmlspecialchars($_SESSION['old-data']['contact-number']) : '' ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['contact-number'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['contact-number']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <div class="control">
                          <label for="email" class="form-label text-secondary">Email <span class="text-danger">*</span></label>
                          <input type="email" class="form-control <?= isset($_SESSION['errors']['email']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="email" name="email" placeholder="Enter your email" value="<?= isset($_SESSION['old-data']['email']) ? htmlspecialchars($_SESSION['old-data']['email']) : '' ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['email'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['email']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  <fieldset> 
                    <legend class="text-black-50">College Information</legend>
                     <div class="row">
                      <div class="col-12 mb-3">
                         <div class="control">
                          <label for="year-level" class="form-label text-secondary">NSTP Component <span class="text-danger">*</span></label>
                          <select class="custom-select <?= isset($_SESSION['errors']['student-type']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="student-type" name="student-type" value="<?= isset($data['student-type']) ? htmlspecialchars($data['student-type']) : '' ?>">
                            <option value="" selected disabled>Select component</option>
                            <option value="CWTS" <?= (isset($_SESSION['old-data']['student-type']) && $_SESSION['old-data']['student-type'] == 'CWTS') ? 'selected' : '' ?>>CWTS</option>
                             <option value="LTS" <?= (isset($_SESSION['old-data']['student-type']) && $_SESSION['old-data']['student-type'] == 'LTS') ? 'selected' : '' ?>>LTS</option>
                              <option value="ROTC" <?= (isset($_SESSION['old-data']['student-type']) && $_SESSION['old-data']['student-type'] == 'ROTC') ? 'selected' : '' ?>>ROTC</option>
                          </select>
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['year-level'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['year-level']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <div class="control">
                          <label for="college" class="form-label text-secondary">College <span class="text-danger">*</span></label>
                          <select class="custom-select <?= isset($_SESSION['errors']['college']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="college" name="college" value="<?= isset($_SESSION['old-data']['college']) ? htmlspecialchars($data['college']) : '' ?>">
                            <!-- Make the options dynamic -->
                            <option value="">College</option>
                            <option value="agriculture" <?= (isset($_SESSION['old-data']['college']) && $_SESSION['old-data']['college'] == 'agriculture') ? 'selected' : '' ?>>AGRICULTURE</option>
                            <option value="arts & science" <?= (isset($_SESSION['old-data']['college']) && $_SESSION['old-data']['college'] == 'arts & science ') ? 'selected' : '' ?>>ARTS & SCIENCE</option>
                            <option value="education" <?= (isset($_SESSION['old-data']['college']) && $_SESSION['old-data']['college'] == 'education') ? 'selected' : '' ?>>EDUCATION</option>
                            <option value="engineering" <?= (isset($_SESSION['old-data']['college']) && $_SESSION['old-data']['college'] == 'engineering') ? 'selected' : '' ?>>ENGINEERING</option>
                            <option value="industrial technology" <?= (isset($_SESSION['old-data']['college']) && $_SESSION['old-data']['college'] == 'industrial technology') ? 'selected' : '' ?>>INDUSTRIAL TECHNOLOGY</option>
                          </select>
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['college'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['college']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="control">
                          <label for="year-level" class="form-label text-secondary">Year Level <span class="text-danger">*</span></label>
                          <select class="custom-select <?= isset($_SESSION['errors']['year-level']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="year-level" name="year-level" value="<?= isset($data['year-level']) ? htmlspecialchars($data['year-level']) : '' ?>">
                            <option value="">Year level</option>
                            <option value="1" <?= (isset($_SESSION['old-data']['year-level']) && $_SESSION['old-data']['year-level'] == '1') ? 'selected' : '' ?>>1st Year</option>
                            <option value="2" <?= (isset($_SESSION['old-data']['year-level']) && $_SESSION['old-data']['year-level'] == '2') ? 'selected' : '' ?>>2nd Year</option>
                            <option value="3" <?= (isset($_SESSION['old-data']['year-level']) && $_SESSION['old-data']['year-level'] == '3') ? 'selected' : '' ?>>3rd Year</option>
                            <option value="4" <?= (isset($_SESSION['old-data']['year-level']) && $_SESSION['old-data']['year-level'] == '4') ? 'selected' : '' ?>>4th Year</option>
                          </select>
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['year-level'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['year-level']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                   
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <div class="control">
                          <label for="course" class="form-label text-secondary">Program/Course <span class="text-danger">*</span></label>
                          <input type="text" class="form-control <?= isset($_SESSION['errors']['course']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="course" placeholder="Enter your course" name="course" value="<?= isset($_SESSION['old-data']['course']) ? htmlspecialchars($_SESSION['old-data']['course']) : '' ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['course'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['course']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="control">
                          <label for="major" class="form-label text-secondary">Major <span class="text-danger">*</span></label>
                          <input type="text" class="form-control <?= isset($_SESSION['errors']['major']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="major" placeholder="Enter Major" name="major" value="<?= isset($_SESSION['old-data']['major']) ? htmlspecialchars($_SESSION['old-data']['major']) : '' ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['major'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['major']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  <fieldset>
                    <legend class="text-black-50">Emergency Contact Person</legend>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <div class="control">
                          <label for="contact-person-name" class="form-label text-secondary">Contact Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control <?= isset($_SESSION['errors']['contact-person-name']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="contact-person-name" name="contact-person-name" placeholder="Emergency Contact Person Name" value="<?= isset($_SESSION['old-data']['contact-person-name']) ? htmlspecialchars($_SESSION['old-data']['contact-person-name']) : '' ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['contact-person-name'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['contact-person-name']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="control">
                          <label for="contact-person-number" class="form-label text-secondary">Contact Mobile Number <span class="text-danger">*</span></label>
                          <input type="text" class="form-control <?= isset($_SESSION['errors']['contact-person-number']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="contact-person-number" name="contact-person-number" placeholder="Emergency Contact Person Number" value="<?= isset($_SESSION['old-data']['contact-person-number']) ? htmlspecialchars($_SESSION['old-data']['contact-person-number']) : '' ?>">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($_SESSION['errors']['contact-person-number'])): ?>
                              <?= htmlspecialchars($_SESSION['errors']['contact-person-number']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  <div class="card-footer d-flex justify-content-end">
                    <div class="row">
                      <div class="col-12">
                        <button type="submit" name="admin-register" class="btn btn-primary" value="Submit">Submit</button>
                        <!-- <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Cancel</button> -->
                      </div>
                    </div>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>


</div>


<?php
require "Partials/footer.php";
unset($_SESSION['old-data']);
unset($_SESSION['errors']);
unset($_SESSION['response']);
?>