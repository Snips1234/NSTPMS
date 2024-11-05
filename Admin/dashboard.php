<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['std_id'])) {
  header('Location: ../login-page.php');
  exit();
}

require "Partials/header.php";
require "Partials/navbar.php";
require "Partials/sidebar.php";
require_once('../connection/dsn.php');
include('../includes/functions.php');

$pdo = getDatabaseConnection();
$count_cwts = getRowCount($pdo, 'tbl_20_columns', "nstp_component = 'CWTS'");
$count_lts = getRowCount($pdo, 'tbl_20_columns', "nstp_component = 'LTS'");
$count_rotc = getRowCount($pdo, 'tbl_20_columns', "nstp_component = 'ROTC'");
$total_students = $count_cwts + $count_lts + $count_rotc;
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="m-0">Dashboard</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <a href="nstp_data_field.php?nstp_component=CWTS">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= htmlspecialchars($count_cwts) ?></h3>
                <p>CWTS Students</p>
              </div>

              <!-- <a href="cwts.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-6">
          <a href="nstp_data_field.php?nstp_component=LTS">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= htmlspecialchars($count_lts) ?></h3>
                <p>LTS Student</p>
              </div>

              <!-- <a href="lts.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-6">
          <a href="nstp_data_field.php?nstp_component=ROTC">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= htmlspecialchars($count_rotc) ?></h3>
                <p>ROTC Student</p>
              </div>

              <!-- <a href="lts.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-6">
          <a href="nstp_data_field.php">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= htmlspecialchars($total_students) ?></h3>
                <p>Total of Students</p>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12">
        <img src="../Images/school logo-modified.png" alt="Descriptive Alt Text" class="img-fluid mx-auto d-block" style="width: 300px; height: auto;">
      </div>
    </div>
  </section>


</div>

<?php

require "Partials/footer.php";
?>