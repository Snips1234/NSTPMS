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
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-users" aria-hidden="true"></i>
            <p>
              Registration
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./nstp_1_registration.php" class="nav-link">
                <i class="fa fa-users" aria-hidden="true"></i>
                <p>NSTP 1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./nstp_2_registration.php" class="nav-link">
                <i class="fa fa-users"></i>
                <p>NSTP 2</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="./grading.php" class="nav-link">
            <i class="fas fa-chart-line"></i>
            <p>
              Grades
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./serial_number.php" class="nav-link">
            <i class="fa fa-asterisk" aria-hidden="true"></i>
            <p>
              Serial number
            </p>
          </a>
        </li>

        <li class="nav-item ">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-print" aria-hidden="true"></i>
            <p>
              Reports
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./nstp_data_field.php" class="nav-link">
                <i class="fa fa-user" aria-hidden="true"></i>
                <p>NSTP Data Field</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../Admin/report_grades.php" class="nav-link">
                <i class="fas fa-chart-line"></i>
                <p>Grades Report</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../Admin/report_serial_number.php" class="nav-link">
                <i class="fa fa-asterisk" aria-hidden="true"></i>
                <p>Serial number</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../Admin/csv_upload.php" class="nav-link">
                <i class="fa fa-asterisk" aria-hidden="true"></i>
                <p>CSV Upload</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>