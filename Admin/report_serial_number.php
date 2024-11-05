<?php
session_start();
require "Partials/header.php";
require "Partials/navbar.php";
require "Partials/sidebar.php";

try {
  require_once('../connection/dsn.php');
  $pdo = getDatabaseConnection();

  $query = "SELECT * FROM `tbl_colleges` WHERE college_id != 6";
  $stmt = $pdo->prepare($query);
  $stmt->execute();

  $colleges = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
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
            <li class="breadcrumb-item">Serial number report</li>
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
            <form id="" action="generate_serial_number_report.php" method="post">
              <div class="card">
                <div class="card-header bg-warning">
                  <h4 class="text-white">Serial number report</h4>
                </div>
                <div class="card-body">
                  <fieldset>
                    <legend class="text-black-50">Query</legend>
                    <div class="row">
                      <div class="col-md-3 mt-1">
                        <div class="control">
                          <label for="nstp-component" class="form-label text-secondary">NTSP Component</label>
                          <select class="custom-select" id="nstp-component" name="nstp-component">
                            <option value="" selected>All</option>
                            <option value="CWTS">CWTS</option>
                            <option value="LTS">LTS</option>
                            <option value="ROTC">ROTC</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3 mt-1">
                        <div class="control">
                          <label for="term" class="form-label text-secondary">Term</label>
                          <select class="custom-select" id="term" name="term">
                            <option value="" selected>All</option>
                            <option value="1">NSTP 1</option>
                            <option value="2">NSTP 2</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 mt-1">
                        <div class="control">
                          <label for="search" class="form-label text-secondary">Search</label>
                          <input type="text" id="search" name="search" class="form-control" placeholder="Search..." value="<?= isset($_GET['search'])  ? $_GET['search'] : ''; ?>">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3 mt-1">
                        <div class="control">
                          <label for="sex" class="form-label text-secondary">Sex</label>
                          <select name="sex" id="sex" class="form-control">
                            <option value="">All</option>
                            <option value="male" <?= isset($_GET['sex']) && $_GET['sex'] ==  'male' ? 'selected' : ''; ?>>Male</option>
                            <option value="female" <?= isset($_GET['sex']) && $_GET['sex'] ==  'female' ? 'selected' : ''; ?>>Female</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3 mt-1">
                        <div class="control">
                          <label for="year_level" class="form-label text-secondary">Year level</label>
                          <select name="year_level" id="year_level" class="form-control">
                            <option value="">All</option>
                            <option value="1" <?= isset($_GET['year_level']) && $_GET['year_level'] ==  '1' ? 'selected' : ''; ?>>1st Year</option>
                            <option value="2" <?= isset($_GET['year_level']) && $_GET['year_level'] ==  '2' ? 'selected' : ''; ?>>2nd Year</option>
                            <option value="3" <?= isset($_GET['year_level']) && $_GET['year_level'] ==  '3' ? 'selected' : ''; ?>>3rd Year</option>
                            <option value="4" <?= isset($_GET['year_level']) && $_GET['year_level'] ==  '4' ? 'selected' : ''; ?>>4th Year</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3 mt-1">
                        <div class="control">
                          <label for="college" class="form-label text-secondary">College</label>
                          <select class="form-control" name="college" id="college">
                            <option value="" selected>All</option>
                            <?php foreach ($colleges as $college): ?>
                              <option value="<?= htmlspecialchars($college['colleges']) ?>" <?= (isset($_GET['college']) && ($_GET['college'] == $college['colleges']) ? 'selected' : ''); ?>>
                                <?= htmlspecialchars($college['colleges']) ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3 align-self-end ">
                        <button type="submit" name="generate-report" class="btn btn-warning  w-100" value="Submit">Generate</button>
                        <!-- <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Cancel</button> -->
                      </div>
                    </div>
                  </fieldset>
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