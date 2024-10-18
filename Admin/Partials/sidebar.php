<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="./dashboard.php" class="brand-link">
    <img src="../Images/school logo-modified.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">NSTP MS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="./dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item ">
          <a href="./enrollment.php" class="nav-link">
            <i class="nav-icon fa fa-users" aria-hidden="true"></i>
            <p>
              Enrollment
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./nstp_data_field.php" class="nav-link">
            <i class="fa fa-list" aria-hidden="true"></i>
            <p>
              NSTP Data Field
            </p>
          </a>
        </li>
        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="fas fa-chart-line"></i>
            <p>
              Grading
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../Admin/cwts_grading.php" class="nav-link">
                <i class="far fa-chart-bar"></i>
                <p>Cwts Grades</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../Admin/lts_grading.php" class="nav-link">
                <i class="far fa-chart-bar"></i>
                <p>Lts Grades</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../Admin/rotc_grading.php" class="nav-link">
                <i class="far fa-chart-bar"></i>
                <p>ROTC Grades</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="./report.php" class="nav-link">
            <i class="fa fa-print" aria-hidden="true"></i>
            <p>
              Reports
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>