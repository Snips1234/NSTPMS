<?php
include '../connection/dsn.php';

if (isset($_POST['type'])) {
  $std_id = $_POST['std_id'];
  $table_name = $_POST['table_name'];
  $type = $_POST['type'];

  $response = [];
  try {
    // SQL query to fetch data
    if ($type === "view") {
      $pdo = getDatabaseConnection();
      $sql = "SELECT * FROM {$table_name} WHERE std_id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':id', $std_id, PDO::PARAM_INT);
      $stmt->execute();

      // Fetch the result
      $data = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($data) {
?>
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active btn-sm" href="#information" data-toggle="tab"><i class="fa fa-user mr-1"></i>Personal Information</a></li>
              <li class="nav-item"><a class="nav-link  btn-sm" href="#education" data-toggle="tab"><i class="fas fa-book mr-1"></i>Education Background</a></li>
              <li class="nav-item"><a class="nav-link  btn-sm" href="#address" data-toggle="tab"><i class="fas fa-map-marker-alt mr-1"></i>Address</a></li>
              <li class="nav-item"><a class="nav-link  btn-sm" href="#nstp" data-toggle="tab"><i class="fas fa-bars"></i> NSTP Database</a></li>
              <li class="nav-item"><a class="nav-link  btn-sm" href="#contact" data-toggle="tab"><i class="fa fa-phone mr-1"></i>Contact Person</a></li>
            </ul>
          </div>
          <div class="card-body p-0">
            <div class="tab-content">
              <div class="active tab-pane" id="information">
                <div class="table-striped table-responsive">
                  <table class="table m-0">
                    <thead>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="no-wrap fs-4"><b>Last Name</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['l_name']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>First Name</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['f_name']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Extension Name</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['ex_name']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Middle Name</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['m_name']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Birthday</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['b_date']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Gender</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['sex']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Religion</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['religion']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Phone Number</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['cp_number']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Email</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['email_add']) ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane" id="address">
                <div class="table-striped table-responsive">
                  <table class="table m-0">
                    <thead>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="no-wrap fs-4"><b>Street/Barangay</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['st_brgy']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Town/City/Municipality</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['municipality']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Province</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['province']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Region</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['region']) ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane" id="education">
                <div class="table-striped ">
                  <table class="table m-0 ">
                    <thead>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="no-wrap fs-4"><b>HEI Name</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['HEI_name']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>TYPE of HEI</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['type_of_HEI']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Program/College</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['college']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Year Level</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['y_level']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Course</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['course']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Major</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['major']) ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane" id="nstp">
                <div class="table-striped table-responsive">
                  <table class="table m-0">
                    <thead>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="no-wrap fs-4"><b>NSTP Component</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['nstp_component']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>NSTP Graduation Year</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['nstp_grad_year']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Serial Number</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['serial_number']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Final Rating (1st sem)</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['average_sem_1']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Final Rating (2nd sem)</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['average_sem_2']) ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane" id="contact">
                <div class="table-striped table-responsive">
                  <table class="table m-0">
                    <thead>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="no-wrap fs-4"><b>Full Name</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['cpce']) ?></td>
                      </tr>
                      <tr>
                        <td class="no-wrap fs-4"><b>Phone Number</b></td>
                        <td class=" no-wrap fs-4"><?= htmlspecialchars($data['cpce_cp_number']) ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>

          </div>
        </div>
<?php
      } else {
        echo "<p>No data found for this student.</p>";
      }
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}
