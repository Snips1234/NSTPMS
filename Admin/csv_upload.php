<?php
session_start();
require "Partials/header.php";
require "Partials/navbar.php";
require "Partials/sidebar.php";
require "../includes/functions.php";
include_once('../connection/dsn.php');

// Define the expected number of columns
$expectedColumnCount = 20;

// Database connection (ensure you have this in your functions.php or here)
$conn = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['csvFile']['tmp_name'];
    $fileName = $_FILES['csvFile']['name'];

    // Check if the file is a CSV
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    if ($fileExtension === 'csv') {
      if (($handle = fopen($fileTmpPath, 'r')) !== false) {
        $headerRow = fgetcsv($handle, 1000, ','); // Read the header row

        // Check if CSV has exactly 20 columns
        if (count($headerRow) === $expectedColumnCount) {
          // Prepare your SQL insert statement
          $stmt = $conn->prepare("INSERT INTO tbl_temp (seq_no, graduation_year, component, region, serial_no, last_name, first_name, extension_name, middle_name, birthday, sex, street_barangay, town_city, province, hei_name, types_of_heis, program_course, year_level, email_address, contact_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

          // Read and save each row to the database
          while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            if (count($data) === $expectedColumnCount) {
              // Convert each cell to UTF-8
              foreach ($data as &$cell) {
                $cell = mb_convert_encoding($cell, 'UTF-8', 'auto'); // Convert to UTF-8
              }

              // Execute the prepared statement with the current row of data
              $stmt->execute($data);
            }
          }

          // Close the file handle
          fclose($handle);
          echo "<script>toastr.success('Data successfully added!');</script>";
        } else {
          echo "<script>toastr.error('Error: CSV must have exactly 20 columns.');</script>";
        }
      } else {

        echo "<script>toastr.error('Error: Unable to open the file.');</script>";
      }
    } else {

      echo "<script>toastr.error('Error: Only CSV files are allowed.');</script>";
    }
  } else {
    echo "<script>toastr.error('Error: No file uploaded or there was an upload error.');</script>";
  }
}

// Close the database connection
$conn = null; // PDO: Setting the connection to null closes it
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
            <li class="breadcrumb-item">CSV Upload</li>
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
            <form action="<?= htmlentities($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
              <div class="card">
                <div class="card-header">
                  <fieldset>
                    <legend class="text-black-50">Choose CSV File</legend>
                    <div class="row">
                      <div class="col-md-12 mt-1">
                        <div class="control">
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="csvFile" id="csvFile" accept=".csv" required>
                              <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div>
                            <div class="input-group-append">
                              <button class="btn btn-primary " type="submit">Upload</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
                <div class="card-body">

                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>


</div>
<script>
  // JavaScript to update the label with the file name
  document.getElementById("csvFile").addEventListener("change", function() {
    const fileName = this.files[0] ? this.files[0].name : "Choose file";
    const label = this.nextElementSibling; // This gets the label element
    label.textContent = fileName; // Update the label's text with the file name
  });
</script>

<?php
require "Partials/footer.php";
unset($_SESSION['old-data']);
unset($_SESSION['errors']);
unset($_SESSION['response']);
?>