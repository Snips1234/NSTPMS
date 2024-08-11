<?php
session_start();


$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();

unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-eval';">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="icons/css/all.css">
  <link rel="stylesheet" href="css/styles.css">
  <title>CWTS Sign up</title>
  <style>
    .min-width {
      min-width: 360px;
    }
  </style>
</head>

<body>
  <?php include('confirmation.modal.php'); ?>
  <header class="min-width">
    <div class="container mb-3">
      <div class="row">
        <div class="col-12">
          <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid p-0">
              <a class="navbar-brand" href="index.php">
                <img src="Images/school logo-modified.png" alt="School logo" width="48px" height="48px">
              </a>
              <h2>CWTS Student Registration</h2>
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
    <form id="sign-up-form" action="query.php" method="post" novalidate>
      <input type="hidden" name="student-type" value="CWTS">
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="fs-4 text-white">Create an account</h3>
        </div>
        <div class="card-body">
          <fieldset>
            <legend class="text-black-50">Full Name</legend>
            <div class="row">
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="last-name" class="form-label text-secondary">Last Name</label>
                  <input type="text" class="form-control <?= isset($errors['last-name']) ? 'is-invalid' : '' ?>" id="last-name" name="last-name" placeholder="Enter your last name">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['last-name'])): ?>
                      <?= htmlspecialchars($errors['last-name']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="first-name" class="form-label text-secondary">First Name</label>
                  <input type="text" class="form-control <?= isset($errors['first-name']) ? 'is-invalid' : '' ?>" id="first-name" name="first-name" placeholder="Enter your first name">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['first-name'])): ?>
                      <?= htmlspecialchars($errors['first-name']) ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="name-extension" class="form-label text-secondary">Name Extension</label>
                  <input type="text" class="form-control <?= isset($errors['name-extension']) ? 'is-invalid' : '' ?>" id="name-extension" name="name-extension" placeholder="Enter your name extension">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['name-extension'])): ?>
                      <?= htmlspecialchars($errors['name-extension']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="middle-name" class="form-label text-secondary">Middle Name</label>
                  <input type="text" class="form-control <?= isset($errors['middle-name']) ? 'is-invalid' : '' ?>" id="middle-name" name="middle-name" placeholder="Enter your middle name">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['middle-name'])): ?>
                      <?= htmlspecialchars($errors['middle-name']); ?>
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
          </fieldset>
          <fieldset>
            <legend class="text-black-50">Address</legend>
            <div class="row">
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="address-street-barangay" class="form-label text-secondary">Street/Barangay</label>
                  <input type="text" class="form-control <?= isset($errors['address-street-barangay']) ? 'is-invalid' : '' ?>" id="address-street-barangay" name="address-street-barangay" placeholder="Enter your Street/Barangay">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['address-street-barangay'])): ?>
                      <?= htmlspecialchars($errors['address-street-barangay']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="address-municipality" class="form-label text-secondary">Municipality</label>
                  <input type="text" class="form-control <?= isset($errors['address-municipality']) ? 'is-invalid' : '' ?>" id="address-municipality" name="address-municipality" placeholder="Enter your Municipality">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['address-municipality'])): ?>
                      <?= htmlspecialchars($errors['address-municipality']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="address-province" class="form-label text-secondary">Province</label>
                  <input type="text" class="form-control <?= isset($errors['address-province']) ? 'is-invalid' : '' ?>" id="address-province" name="address-province" placeholder="Enter you Province">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['address-province'])): ?>
                      <?= htmlspecialchars($errors['address-province']); ?>
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
                  <label for="civil-status" class="form-label text-secondary">Civil Status</label>
                  <select class="form-select <?= isset($errors['civil-status']) ? 'is-invalid' : '' ?>" id="civil-status" name="civil-status">
                    <option value="">Civil Status</option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                  </select>
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['civil-status'])): ?>
                      <?= htmlspecialchars($errors['civil-status']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="religion" class="form-label text-secondary">Religion</label>
                  <input type="text" class="form-control <?= isset($errors['religion']) ? 'is-invalid' : '' ?>" id="religion" name="religion" placeholder="Enter your religion">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['religion'])): ?>
                      <?= htmlspecialchars($errors['religion']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="contact-number" class="form-label text-secondary">Contact Number</label>
                  <input type="text" class="form-control <?= isset($errors['contact-number']) ? 'is-invalid' : '' ?>" id="contact-number" name="contact-number" placeholder="Enter your contact number">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['contact-number'])): ?>
                      <?= htmlspecialchars($errors['contact-number']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="email" class="form-label text-secondary">Email</label>
                  <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Enter your email">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['email'])): ?>
                      <?= htmlspecialchars($errors['email']); ?>
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
                  <label for="college" class="form-label text-secondary">College</label>
                  <select class="form-select <?= isset($errors['college']) ? 'is-invalid' : '' ?>" id="college" name="college">
                    <!-- Make the options dynamic -->
                    <option value="">College</option>
                    <option value="agriculture">AGRICULTURE</option>
                    <option value="arts & science">ARTS & SCIENCE</option>
                    <option value="education">EDUCATION</option>
                    <option value="engineering">ENGINEERING</option>
                    <option value="industrial technology">INDUSTRIAL TECHNOLOGY</option>
                  </select>
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['college'])): ?>
                      <?= htmlspecialchars($errors['college']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="control">
                  <label for="year-level" class="form-label text-secondary">Year Level</label>
                  <select class="form-select <?= isset($errors['year-level']) ? 'is-invalid' : '' ?>" id="year-level" name="year-level">
                    <option value="">Year level</option>
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                  </select>
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['year-level'])): ?>
                      <?= htmlspecialchars($errors['year-level']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <div class="control">
                  <label for="course" class="form-label text-secondary">Course</label>
                  <input type="text" class="form-control <?= isset($errors['course']) ? 'is-invalid' : '' ?>" id="course" placeholder="Enter your course" name="course">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['course'])): ?>
                      <?= htmlspecialchars($errors['course']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="control">
                  <label for="major" class="form-label text-secondary">Major</label>
                  <input type="text" class="form-control <?= isset($errors['major']) ? 'is-invalid' : '' ?>" id="major" placeholder="Enter Major" name="major">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['major'])): ?>
                      <?= htmlspecialchars($errors['major']); ?>
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
                  <label for="contact-person-name" class="form-label text-secondary">Contact Name</label>
                  <input type="text" class="form-control <?= isset($errors['contact-person-name']) ? 'is-invalid' : '' ?>" id="contact-person-name" name="contact-person-name" placeholder="Emergency Contact Person Name">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['contact-person-name'])): ?>
                      <?= htmlspecialchars($errors['contact-person-name']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="control">
                  <label for="contact-person-number" class="form-label text-secondary">Contact Mobile Number</label>
                  <input type="text" class="form-control <?= isset($errors['contact-person-number']) ? 'is-invalid' : '' ?>" id="contact-person-number" name="contact-person-number" placeholder="Emergency Contact Person Number">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['contact-person-number'])): ?>
                      <?= htmlspecialchars($errors['contact-person-number']); ?>
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
                  <label for="username" class="form-label text-secondary">Username</label>
                  <input type="text" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>" id="username" name="username" placeholder="Enter your Username">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['username'])): ?>
                      <?= htmlspecialchars($errors['username']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="password" class="form-label text-secondary">Password</label>
                  <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Enter your Password">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['password'])): ?>
                      <?= htmlspecialchars($errors['password']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="confirm-password" class="form-label text-secondary ">Confirm Password</label>
                  <input type="password" class="form-control <?= isset($errors['confirm-password']) ? 'is-invalid' : '' ?>" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                    <?php if (isset($errors['confirm-password'])): ?>
                      <?= htmlspecialchars($errors['confirm-password']); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
          <div class="card-footer d-flex justify-content-end">
            <div class="row">
              <div class="col-12">
                <button type="submit" name="cwts-sign-up" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
    </form>
  </div>
  <div class="row">
    <div class="col-sm-6 col-lg-5 mb-3 mb-sm-0">
      <div data-coreui-locale="en-US" data-coreui-toggle="date-picker"></div>
    </div>
    <div class="col-sm-6 col-lg-5">
      <div data-coreui-date="2023/03/15" data-coreui-locale="en-US" data-coreui-toggle="date-picker"></div>
    </div>
  </div>
  <footer class="min-width">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <p class="text-center">&copy; 2024 CWTS and LTS Recording Management System.</p>
        </div>
      </div>
    </div>
  </footer>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/form.validation.js"></script>
</body>

</html>