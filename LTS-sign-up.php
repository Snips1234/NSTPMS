<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-eval';">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="icons/css/all.css">
  <link rel="stylesheet" href="css/styles.css">
  <title>LTS Sign up</title>
  <style>
    .min-width {
      min-width: 360px;
    }
  </style>
</head>

<body>
  <header class="min-width">
    <div class="container mb-3">
      <div class="row">
        <div class="col-12">
          <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid p-0">
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
    <form id="sign-up-form" action="query.php" method="post" novalidate>
      <input type="hidden" name="student-type" value="LTS">
      <div class="card">
        <div class="card-header bg-success">
          <h3 class="fs-4 text-white">Create an account</h3>
        </div>
        <div class="card-body">
          <fieldset>
            <legend class="text-black-50">Full Name</legend>
            <div class="row">
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="last-name" class="form-label text-secondary">Last Name</label>
                  <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Enter your last name">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="first-name" class="form-label text-secondary">First Name</label>
                  <input type="text" class="form-control" id="first-name" name="first-name" placeholder="Enter your first name">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="name-extension" class="form-label text-secondary">Name Extension</label>
                  <input type="text" class="form-control" id="name-extension" name="name-extension" placeholder="Enter your name extension">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="middle-name" class="form-label text-secondary">Middle Name</label>
                  <input type="text" class="form-control" id="middle-name" name="middle-name" placeholder="Enter your middle name">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
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
                  <input type="date" class="form-control" id="birthday" name="birthday">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="control">
                  <label for="gender" class="form-label text-secondary">Gender</label>
                  <select class="form-select" id="gender" name="gender">
                    <option selected disabled>Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
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
                  <input type="text" class="form-control" id="address-street-barangay" name="address-street-barangay" placeholder="Enter your Street/Barangay">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="address-municipality" class="form-label text-secondary">Municipality</label>
                  <input type="text" class="form-control" id="address-municipality" name="address-municipality" placeholder="Enter your Municipality">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="address-province" class="form-label text-secondary">Province</label>
                  <input type="text" class="form-control" id="address-province" name="address-province" placeholder="Enter you Province">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
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
                  <select class="form-select" id="civil-status" name="civil-status">
                    <option selected disabled>Civil Status</option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                  </select>
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="religion" class="form-label text-secondary">Religion</label>
                  <input type="text" class="form-control" id="religion" name="religion" placeholder="Enter your religion">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="contact-number" class="form-label text-secondary">Contact Number</label>
                  <input type="text" class="form-control" id="contact-number" name="contact-number" placeholder="Enter your contact number">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <div class="control">
                  <label for="email" class="form-label text-secondary">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
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
                  <select class="form-select" id="college" name="college">
                    <option selected disabled>College</option>
                    <option value="agriculture">AGRICULTURE</option>
                    <option value="arts & science">ARTS & SCIENCE</option>
                    <option value="education">EDUCATION</option>
                    <option value="engineering">ENGINEERING</option>
                    <option value="industrial technology">INDUSTRIAL TECHNOLOGY</option>
                  </select>
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="control">
                  <label for="year-level" class="form-label text-secondary">Year Level</label>
                  <select class="form-select" id="year-level" name="year-level">
                    <option selected disabled>Year level</option>
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                  </select>
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <div class="control">
                  <label for="course" class="form-label text-secondary">Course</label>
                  <input type="text" class="form-control" id="course" placeholder="Enter your course" name="course">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="control">
                  <label for="major" class="form-label text-secondary">Major</label>
                  <input type="text" class="form-control" id="major" placeholder="Enter Major" name="major">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
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
                  <input type="text" class="form-control" id="contact-person-name" name="contact-person-name" placeholder="Emergency Contact Person Name">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="control">
                  <label for="contact-person-number" class="form-label text-secondary">Contact Mobile Number</label>
                  <input type="text" class="form-control" id="contact-person-number" name="contact-person-number" placeholder="Emergency Contact Person Number">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
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
                  <input type="text" class="form-control" id="username" name="username" placeholder="Enter your Username">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="password" class="form-label text-secondary">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
              <div class="col-lg-4 mb-3">
                <div class="control">
                  <label for="confirm-password" class="form-label text-secondary ">Confirm Password</label>
                  <input type="password" class="form-control " id="confirm-password" name="confirm-password" placeholder="Confirm Password">
                  <div class="error-container fs-6 text-danger" style="font-size: 12px !important;"></div>
                </div>
              </div>
            </div>
          </fieldset>
          <div class="card-footer d-flex justify-content-end">
            <div class="row">
              <div class="col-12">
                <button type="submit" name="lts-sign-up" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
        </div>
    </form>
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