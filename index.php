<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <?php include("templates/header.php");?>

  <div class="wrapper">
    <div class="container">
      <div class="navbar">
        <ul class="w-100 d-flex justify-content-end">
          <a href="login-page.php" class="btn login_btn w_500 text-white align-self-end px-3">Login</a>
          <div class="btn-group">
            <button type="button" class="btn ms-2 text-white align-self-end px-3 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background-image: none;">
              Sign up
            </button>
            <ul class="dropdown-menu dropdown-menu-lg-end">
              <li><a class="dropdown-item" href="CWTS-sign-up.php">CWTS</a></li>
              <li><a class="dropdown-item" href="LTS-sign-up.php">LTS</a></li>
            </ul>
          </div>
        </ul>
      </div>
    </div>
    <div class="container text-center">
      <h1 class="w_900 text-white display-3">
        CWTS and LTS <br> Records Management System
      </h1>
      <div class="container mt-5">
        <div class="row">
          <div class="col"></div>
          <div class="col">
            <img src="./Images/school logo-modified.png" style="width: 95%; min-width: 4rem; " alt="School logo">
          </div>
          <div class="col">
            <img src="./Images/nstp_logo.png" style="width: 95%; min-width: 4rem;" alt="NSTP School logo">
          </div>
          <div class="col"></div>
        </div>
      </div>
    </div>
  </div>
  <?php include("templates/footer.php"); ?>


  <script>
    // jquery
    
  
  </script>
  
</html>