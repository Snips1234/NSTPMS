<!-- Main Sidebar Container -->
<aside class="main-sidebar  elevation-4" style="background-color: rgb(32, 85, 67);">
  <!-- Brand Logo -->
  <a href="./dashboard.php" class="brand-link text-white">
    <img src="../Images/school logo-modified.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-2">
    <span class="ml-2 brand-text font-weight-bold">NSTP RMS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="./dashboard.php" class="nav-link text-white">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item ">
          <a href="#" class="nav-link text-white">
            <i class="nav-icon fa fa-users" aria-hidden="true"></i>
            <p>
              Registration
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <ul class="" style="list-style: none;">
              <li class="nav-item">
                <a href="./nstp_not_enrolled_registration.php" class="nav-link text-white">
                  <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                  <p>Not Enrolled</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./nstp_1_registration.php" class="nav-link text-white">
                  <i class="fa fa-users" aria-hidden="true"></i>
                  <p>NSTP 1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./nstp_2_registration.php" class="nav-link text-white">
                  <i class="fa fa-users"></i>
                  <p>NSTP 2</p>
                </a>
              </li>
            </ul>
          </ul>
        </li>
        <li class="nav-item">
          <a href="./grading.php" class="nav-link text-white ml-1">
            <i class="fas fa-chart-line"></i>
            <p class="ml-2">
              Grades
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./serial_number.php" class="nav-link text-white ml-1">
            <i class="fa fa-asterisk" aria-hidden="true"></i>
            <p class="ml-2">
              Serial number
            </p>
          </a>
        </li>
        <li class="nav-item ">
          <a href="#" class="nav-link text-white">
            <i class="nav-icon fa fa-print" aria-hidden="true"></i>
            <p>
              Reports
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <ul style="list-style: none;">
              <li class="nav-item">
                <a href="./nstp_data_field.php" class="nav-link text-white">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <p>NSTP Data Field</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../Admin/report_grades.php" class="nav-link text-white">
                  <i class="fas fa-chart-line"></i>
                  <p>Grades Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../Admin/report_serial_number.php" class="nav-link text-white">
                  <i class="fa fa-asterisk" aria-hidden="true"></i>
                  <p>Serial number</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../Admin/csv_upload.php" class="nav-link text-white">
                  <i class="fa fa fa-print" aria-hidden="true"></i>
                  <p>CSV Upload</p>
                </a>
              </li>
            </ul>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>