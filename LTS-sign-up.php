<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-eval';">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="icons/css/all.css">
  <title>CWTS Sign up</title>
  <style>
    .min-width {
      min-width: 360px;
    }

    .back-color {
      background-color: #f4f6f9 !important;
    }
  </style>
</head>

<body class="back-color">
  <?php include('confirmation.modal.php'); ?>
  <header class="min-width">
    <div class="container mb-3">
      <div class="row">
        <div class="col-12">
          <nav class=" navbar navbar-expand-lg navbar-light back-color">
            <div class="back-color container-fluid p-0">
              <a class="navbar-brand" href="index.php">
                <img src="Images/school logo-modified.png" alt="School logo" width="48px" height="48px">
              </a>
              <h2>LTS Student Registration</h2>
              <ul class="navbar-nav">
                <li>
                  <a href="index.php" class="btn login_btn w_500 text-white align-self-end">
                    Home
                  </a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <div class="container mb-5 min-width">
    <form id="lts-sign-up-form" action="query.php" method="post" novalidate>
      <input type="hidden" id="student-type" name="student-type" value="LTS">
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="fs-4 text-white">Create an account</h3>
        </div>
        <div class="card-body">
          <fieldset>
            <legend class="text-black-50">Graduation Year/Serial Number/Region</legend>
            <div class="row">
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="graduation-year" class="form-label text-secondary">NSTP Graduation Year <span class="text-danger">*</span></label>
                  <input type="text" class="form-control <?= isset($_SESSION['errors']['graduation-year']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="graduation-year" name="graduation-year" placeholder="Enter your graduation year" value="<?= isset($_SESSION['old-data']['graduation-year']) ? htmlspecialchars($_SESSION['old-data']['graduation-year']) : '' ?>">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($_SESSION['errors']['graduation-year'])): ?>
                      <?= htmlspecialchars($_SESSION['errors']['graduation-year']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="serial-number" class="form-label text-secondary">NSTP Serial Number <span class="text-danger">*</span></label>
                  <input type="text" class="form-control <?= isset($_SESSION['errors']['serial-number']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="serial-number" name="serial-number" placeholder="Enter you serial number" value="<?= isset($_SESSION['old-data']['serial-number']) ? htmlspecialchars($_SESSION['old-data']['serial-number']) : '' ?>">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($_SESSION['errors']['serial-number'])): ?>
                      <?= htmlspecialchars($_SESSION['errors']['serial-number']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="region" class="form-label text-secondary">Region <span class="text-danger">*</span></label>
                  <input type="text" class="form-control <?= isset($_SESSION['errors']['region']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="region" name="region" placeholder="Enter your region" value="<?= isset($_SESSION['old-data']['region']) ? htmlspecialchars($_SESSION['old-data']['region']) : '' ?>">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($_SESSION['errors']['region'])): ?>
                      <?= htmlspecialchars($_SESSION['errors']['region']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
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
            <legend class="text-black-50">HEI Name/Types of HEIS</legend>
            <div class="row">
              <div class="col-md-6 mb-3">
                <div class="control">
                  <label for="hei-name" class="form-label text-secondary">HEI Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control <?= isset($_SESSION['errors']['hei-name']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="hei-name" name="hei-name" placeholder="HEI Name" value="<?= isset($_SESSION['old-data']['hei-name']) ? htmlspecialchars($_SESSION['old-data']['hei-name']) : '' ?>">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($_SESSION['errors']['hei-name'])): ?>
                      <?= htmlspecialchars($_SESSION['errors']['hei-name']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="control">
                  <label for="type-of-hei" class="form-label text-secondary">Type of HEIs <span class="text-danger">*</span></label>
                  <input type="text" class="form-control <?= isset($_SESSION['errors']['type-of-hei']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="type-of-hei" name="type-of-hei" placeholder="Type of HEIs" value="<?= isset($_SESSION['old-data']['type-of-hei']) ? htmlspecialchars($_SESSION['old-data']['type-of-hei']) : '' ?>">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($_SESSION['errors']['type-of-hei'])): ?>
                      <?= htmlspecialchars($_SESSION['errors']['type-of-hei']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
          <!-- <fieldset>
            <legend class="text-black-50">Birthday and Gender</legend>
            <div class="row">
              <div class="col-md-6 mb-3">
                <div class="control">
                  <label for="birthday" class="form-label text-secondary">Birthday</label>
                  <input type="date" class="form-control <?= isset($errors['birthday']) ? 'is-invalid' : '' ?>" id="birthday" name="birthday">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['birthday'])): ?>
                      <?= htmlspecialchars($errors['birthday']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="control">
                  <label for="gender" class="form-label text-secondary">Gender</label>
                  <select class="form-select <?= isset($errors['gender']) ? 'is-invalid' : '' ?>" id="gender" name="gender">
                    <option value="">Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['gender'])): ?>
                      <?= htmlspecialchars($errors['gender']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </fieldset> -->
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
                  <select class="form-select <?= isset($_SESSION['errors']['gender']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="gender" name="gender">
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
          </fieldset>
          <fieldset>
            <legend class="text-black-50">Others</legend>
            <div class="row">
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="civil-status" class="form-label text-secondary">Civil Status <span class="text-danger">*</span></label>
                  <select class="form-select <?= isset($_SESSION['errors']['civil-status']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="civil-status" name="civil-status" value="<?= isset($data['civil-status']) ? htmlspecialchars($data['civil-status']) : '' ?>">
                    <option value="">Civil Status <span class="text-danger">*</span></option>
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
              <div class="col-md-6 mb-3">
                <div class="control">
                  <label for="college" class="form-label text-secondary">College <span class="text-danger">*</span></label>
                  <select class="form-select <?= isset($_SESSION['errors']['college']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="college" name="college" value="<?= isset($_SESSION['old-data']['college']) ? htmlspecialchars($data['college']) : '' ?>">
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
                  <select class="form-select <?= isset($_SESSION['errors']['year-level']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="year-level" name="year-level" value="<?= isset($data['year-level']) ? htmlspecialchars($data['year-level']) : '' ?>">
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
          <fieldset>
            <legend class="text-black-50">Login Credential</legend>
            <div class="row">
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="username" class="form-label text-secondary">Username <span class="text-danger">*</span></label>
                  <input type="text" class="form-control <?= isset($_SESSION['errors']['username']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="username" name="username" placeholder="Enter your Username" value="<?= isset($_SESSION['old-data']['username']) ? htmlspecialchars($_SESSION['old-data']['username']) : '' ?>">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($_SESSION['errors']['username'])): ?>
                      <?= htmlspecialchars($_SESSION['errors']['username']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="password" class="form-label text-secondary">Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control <?= isset($_SESSION['errors']['password']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="password" name="password" placeholder="Enter your Password" value="<?= isset($_SESSION['old-data']['password']) ? htmlspecialchars($_SESSION['old-data']['password']) : '' ?>">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($_SESSION['errors']['password'])): ?>
                      <?= htmlspecialchars($_SESSION['errors']['password']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="confirm-password" class="form-label text-secondary ">Confirm Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control <?= isset($_SESSION['errors']['confirm-password']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="confirm-password" name="confirm-password" placeholder="Confirm Password" value="<?= isset($_SESSION['old-data']['confirm-password']) ? htmlspecialchars($_SESSION['old-data']['confirm-password']) : '' ?>">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($_SESSION['errors']['confirm-password'])): ?>
                      <?= htmlspecialchars($_SESSION['errors']['confirm-password']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
          <div class="card-footer d-flex justify-content-end">
            <div class="row">
              <div class="col-12">
                <button type="submit" name="lts-sign-up" class="btn btn-primary" value="Submit">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
    </form>
  </div>
  <footer class="min-width">
    <div class="container">
      <div class="row">
        <div class="col-12 mt-5">
          <p class="text-center">&copy; 2024 NSTP Management System.</p>

        </div>
      </div>
    </div>
  </footer>
  <?php
  unset($_SESSION['errors']);
  unset($_SESSION['old-data']);
  unset($_SESSION['response']);
  ?>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.js"></script>
</body>

</html>