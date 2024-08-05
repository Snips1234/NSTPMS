<?php
session_start();

$username = $password = '';
$error = array('username' => '', 'password' => '');

if (isset($_POST['submit'])) {
  //check if username is empty

  if (empty($_POST['username'])) {
    $error['username'] = 'Username is required <br>';
  } else {
    $username = htmlspecialchars($_POST['username']);
  }

  if (empty($_POST['password'])) {
    $error['password'] = 'Password is required <br>';
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>

<div class="position-relative full_h">
  <div class="position-absolute top-50 start-50 translate-middle ">
    <div class="container container-custom shadow p-5 rounded-4">
      <div class="row">
        <div class="col-12 col-md-6">
          <img src="./Images/school logo-modified.png" alt="School logo" width="48px" height="48px">
          <h2 class="mt-2">Sign in</h2>
          <p>Use your account</p>
        </div>
        <div class="col-12 col-md-6">
          <form action="login-page.php" method="POST">
            <!-- username -->
            <div class="form-floating mb-2">
              <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" autocomplete="off">
              <label for="username">Username</label>
            </div>
            <?php if (!empty($error['username'])) : ?>
              <div class="text-danger small mb-2">
                <?php echo '<i class="fa-solid fa-circle-exclamation"></i> ' . $error['username']; ?>
              </div>
            <?php endif; ?>

            <!-- password -->
            <div class="form-floating mb-3 position-relative">
              <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off">
              <label for="password">Password</label>
              <button type="button" class="btn border-0 text-secondary position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePassword()">
                <i class="fas fa-eye" id="togglePasswordIcon"></i>
              </button>
            </div>
            <?php if (!empty($error['password'])) : ?>
              <div class="text-danger small mb-2">
                <?php echo '<i class="fa-solid fa-circle-exclamation"></i> ' . $error['password']; ?>
              </div>
            <?php endif; ?>

            <!-- submit -->
            <input type="submit" name="submit" id="submit" value="submit" class="btn border-0 login_btn text-white w-100 m-0 py-2">
            <div class="w-100 d-flex justify-content-center mt-4 w_500">
              <p>Don't have an account yet? <a href="sign-up-as.php">Sign up</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  function togglePassword() {
    const password = document.getElementById('password');
    const toggleIcon = document.getElementById('togglePasswordIcon');
    const inputType = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', inputType);
    toggleIcon.classList.toggle('fa-eye');
    toggleIcon.classList.toggle('fa-eye-slash');
  }
</script>
<?php include('templates/footer.php'); ?>

</html>