<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="icons/css/all.css">
  <link rel="stylesheet" href="css/styles.css">
  <title>Sign up</title>

  <style>
    .container-custom {
      min-width: 350px;
    }

    @media (min-width: 992px) {
      .container-custom {
        width: 40rem;
      }
    }

    @media (max-width: 576px) {
      .container-custom {
        border-radius: 0 !important;
        box-shadow: none !important;
      }

    }
  </style>
</head>

<body class="wrapper">


  <div class="position-relative full_h">
    <div class="position-absolute top-50 start-50 translate-middle ">
      <div class="bg-white container container-custom shadow p-5 rounded-4">
        <div class="row">
          <div class="col-12 col-md-6">
            <a href="index.php" type="button" class="d-block mb-3 text-black">
              <i class="fa fa-arrow-left fs-5" aria-hidden="true"></i>
            </a>
            <img src="./Images/school logo-modified.png" alt="School logo" width="48px" height="48px">
            <h2 class="mt-2">Sign up</h2>
            <p>Choose what is appropriate for you</p>
          </div>
          <div class="col-12 col-md-6 d-flex justify-content-center flex-column">
            <a href="CWTS-sign-up.php" class="btn sign-up-btn w_500 text-white w-100 mb-3">CWTS student</a>
            <a href="LTS-sign-up.php" class="btn sign-up-btn w_500 text-white w-100 mb-3">LTS Student</a>
            <a href="ROTC-sign-up.php" class="btn sign-up-btn w_500 text-white w-100 mb-3">ROTC Student</a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/form.validation.js"></script>
</body>

</html>