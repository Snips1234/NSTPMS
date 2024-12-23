<?php
session_start();
require "Partials/header.php";
require "Partials/navbar.php";
require "Partials/sidebar.php";
require "../includes/functions.php";

// Define pagination and search variables
// Define variables for pagination and filters
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$year_level = isset($_GET['year_level']) ? $_GET['year_level'] : '';
$college = isset($_GET['college']) ? $_GET['college'] : '';
$sex = isset($_GET['sex']) ? $_GET['sex'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';
$component = isset($_GET['nstp_component']) ? $_GET['nstp_component'] : '';
try {
  require_once('../connection/dsn.php');
  $pdo = getDatabaseConnection();


  $query = "SELECT * FROM tbl_20_columns WHERE 1=1 AND (term = 1 OR term =2)";


  if ($search) {
    $query .= " AND (f_name LIKE CONCAT('%', :search, '%') OR l_name LIKE CONCAT('%', :search, '%') OR m_name LIKE CONCAT('%', :search, '%'))";
  }
  if ($year_level) {
    $query .= " AND y_level = :year_level";
  }
  if ($college) {
    $query .= " AND college = :college";
  }
  if ($sex) {
    $query .= " AND sex = :sex";
  }
  if ($component) {
    $query .= " AND nstp_component = :nstp_component";
  }
  // if ($year) {
  //   $query .= " AND (school_year_sem_1 LIKE :year OR school_year_sem_2 LIKE :year)";
  // }

  // Add order and limit clauses
  $query .= " ORDER BY l_name ASC LIMIT $limit OFFSET $offset";
  $stmt = $pdo->prepare($query);

  // Bind values for the main query
  if ($search) {
    $stmt->bindValue(':search', $search, PDO::PARAM_STR);
  }
  if ($year_level) {
    $stmt->bindValue(':year_level', $year_level, PDO::PARAM_STR);
  }
  if ($college) {
    $stmt->bindValue(':college', $college, PDO::PARAM_STR);
  }
  if ($sex) {
    $stmt->bindValue(':sex', $sex, PDO::PARAM_STR);
  }
  if ($component) {
    $stmt->bindValue(':nstp_component', $component, PDO::PARAM_STR);
  }
  // if ($year) {
  //   $stmt->bindValue(':year', '%' . $year . '%', PDO::PARAM_STR);
  // }

  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Count query to get total number of entries
  $countQuery = "SELECT COUNT(*) as total FROM tbl_20_columns WHERE 1=1 AND (term = 1 OR term =2)";
  if ($search) {
    $countQuery .= " AND (f_name LIKE CONCAT('%', :search, '%') OR l_name LIKE CONCAT('%', :search, '%') OR m_name LIKE CONCAT('%', :search, '%'))";
  }
  if ($year_level) {
    $countQuery .= " AND y_level = :year_level";
  }
  if ($college) {
    $countQuery .= " AND college = :college";
  }
  if ($sex) {
    $countQuery .= " AND sex = :sex";
  }
  if ($component) {
    $countQuery .= " AND nstp_component = :nstp_component";
  }
  // if ($year) {
  //   $countQuery .= " AND (school_year_sem_1 LIKE :year OR school_year_sem_2 LIKE :year)";
  // }

  $countStmt = $pdo->prepare($countQuery);

  // Bind values for the count query
  if ($search) {
    $countStmt->bindValue(':search', $search, PDO::PARAM_STR);
  }
  if ($year_level) {
    $countStmt->bindValue(':year_level', $year_level, PDO::PARAM_STR);
  }
  if ($college) {
    $countStmt->bindValue(':college', $college, PDO::PARAM_STR);
  }
  if ($sex) {
    $countStmt->bindValue(':sex', $sex, PDO::PARAM_STR);
  }
  if ($component) {
    $countStmt->bindValue(':nstp_component', $component, PDO::PARAM_STR);
  }
  // if ($year) {
  //   $countStmt->bindValue(':year', '%' . $year . '%', PDO::PARAM_STR);
  // }

  $countStmt->execute();
  $totalEntries = $countStmt->fetchColumn();
  $totalPages = ceil($totalEntries / $limit);
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}
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

<script>
  <?php if (isset($_SESSION['response']['serial_number']) && $_SESSION['response']['serial_number'] === 'success') { ?>
    toastr.success("Serial number successfully updated!");
  <?php } else if (isset($_SESSION['response']['serial_number']) && $_SESSION['response']['serial_number'] === 'failed') { ?>
    toastr.error("Serial number failed to update!");
  <?php } ?>
</script>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="m-0">SERIAL NUMBER </h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item">Serial number</li>
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
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- <h3 class="card-title">CWTS Student Grades</h3> -->
                <div class="mt-5">
                  <form method="get" action="" class="">
                    <div class="row">
                      <div class="col-md-3 mt-1">
                        <div class="control">
                          <label for="nstp_component" class="form-label text-secondary">NSTP Component</label>
                          <select name="nstp_component" id="nstp_component" class="form-control">
                            <option value="">All</option>
                            <option value="CWTS" <?= isset($_GET['nstp_component']) && $_GET['nstp_component'] ==  'CWTS' ? 'selected' : ''; ?>>CWTS</option>
                            <option value="LTS" <?= isset($_GET['nstp_component']) && $_GET['nstp_component'] ==  'LTS' ? 'selected' : ''; ?>>LTS</option>
                            <option value="ROTC" <?= isset($_GET['nstp_component']) && $_GET['nstp_component'] ==  'ROTC' ? 'selected' : ''; ?>>ROTC</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-9 mt-1">
                        <label for="search" class="form-label text-secondary">Search</label>
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3 mt-1">
                        <label for="sex" class="form-label text-secondary">Sex</label>
                        <select name="sex" id="sex" class="form-control">
                          <option value="">All</option>
                          <option value="male" <?= isset($_GET['sex']) && $_GET['sex'] ==  'male' ? 'selected' : ''; ?>>Male</option>
                          <option value="female" <?= isset($_GET['sex']) && $_GET['sex'] ==  'female' ? 'selected' : ''; ?>>Female</option>
                        </select>
                      </div>
                      <div class="col-md-3 mt-1">
                        <label for="year_level" class="form-label text-secondary">Year level</label>
                        <select name="year_level" id="year_level" class="form-control">
                          <option value="">All</option>
                          <option value="1" <?= isset($_GET['year_level']) && $_GET['year_level'] ==  '1' ? 'selected' : ''; ?>>1st Year</option>
                          <option value="2" <?= isset($_GET['year_level']) && $_GET['year_level'] ==  '2' ? 'selected' : ''; ?>>2nd Year</option>
                          <option value="3" <?= isset($_GET['year_level']) && $_GET['year_level'] ==  '3' ? 'selected' : ''; ?>>3rd Year</option>
                          <option value="4" <?= isset($_GET['year_level']) && $_GET['year_level'] ==  '4' ? 'selected' : ''; ?>>4th Year</option>
                        </select>
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
                      <div class="col-md-3 mt-1 align-self-end">
                        <button class="btn btn-primary w-100" type="submit">Filter</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="card-body p-0">
                <!-- Search Form -->

                <div class="table-striped table-responsive">
                  <table class="table m-0 table-bordered">
                    <thead>
                      <tr>
                        <th class="no-wrap f-12 text-center align-middle">SEQ No.</th>
                        <th class="no-wrap f-12 text-center align-middle">Student Name</th>
                        <th class="no-wrap f-12 text-center align-middle">Year Level</th>
                        <th class="no-wrap f-12 text-center align-middle">Course</th>
                        <th class="no-wrap f-12 text-center align-middle">Graduation Year</th>
                        <th class="no-wrap f-12 text-center align-middle">Serial number</th>
                      </tr>

                    </thead>
                    <tbody>
                      <?php if (!empty($results)): ?>
                        <?php foreach ($results as $row): ?>
                          <tr>
                            <td class="no-wrap f-12 text-center  <?= (!empty($row['remarks_sem_1']) && !empty($row['remarks_sem_2'])) ? (($row['remarks_sem_1'] === 'Passed' && $row['remarks_sem_2'] === 'Passed') ? 'table-success' : 'table-danger') : '' ?> "><?php echo htmlspecialchars($row['std_id']); ?></td>

                            <td class="no-wrap f-12   <?= (!empty($row['remarks_sem_1']) && !empty($row['remarks_sem_2'])) ? (($row['remarks_sem_1'] === 'Passed' && $row['remarks_sem_2'] === 'Passed') ? 'table-success' : 'table-danger') : '' ?> "><?php echo htmlspecialchars($row['l_name'] . " " . $row['f_name'] . " " . $row['ex_name'] . " " . $row['m_name']); ?></td>

                            <td class="no-wrap f-12 text-center <?= (!empty($row['remarks_sem_1']) && !empty($row['remarks_sem_2'])) ? (($row['remarks_sem_1'] === 'Passed' && $row['remarks_sem_2'] === 'Passed') ? 'table-success' : 'table-danger') : '' ?> "><?php echo htmlspecialchars($row['y_level']); ?></td>

                            <td class="no-wrap f-12 text-center  <?= (!empty($row['remarks_sem_1']) && !empty($row['remarks_sem_2'])) ? (($row['remarks_sem_1'] === 'Passed' && $row['remarks_sem_2'] === 'Passed') ? 'table-success' : 'table-danger') : '' ?> "><?php echo htmlspecialchars(strtoupper($row['college'])); ?></td>
                            <!-- Graduation year -->
                            <td class="no-wrap f-12 text-center <?= (!empty($row['remarks_sem_1']) && !empty($row['remarks_sem_2'])) ? (($row['remarks_sem_1'] === 'Passed' && $row['remarks_sem_2'] === 'Passed') ? 'table-success' : 'table-danger') : '' ?> editable" data-id="<?= $row['std_id'] ?>" data-column='nstp_grad_year'>
                              <?= htmlspecialchars(strtoupper($row['nstp_grad_year'])); ?>
                            </td>

                            <!-- Serial number -->
                            <td class="no-wrap f-12 text-center <?= (!empty($row['remarks_sem_1']) && !empty($row['remarks_sem_2'])) ? (($row['remarks_sem_1'] === 'Passed' && $row['remarks_sem_2'] === 'Passed') ? 'table-success' : 'table-danger') : '' ?> editable" data-id="<?= $row['std_id'] ?>" data-column='serial_number'>
                              <?= htmlspecialchars(strtoupper($row['serial_number'])); ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td class="text-center " colspan="10">No entries found</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                      <?php if ($totalEntries > 0): ?>
                        Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $limit, $totalEntries); ?> of <?php echo $totalEntries; ?> entries
                      <?php else: ?>
                        No entries found
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                      <ul class="pagination float-right">
                        <!-- Previous Button -->
                        <li class="paginate_button pagination-sm page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                          <a href="?search=<?php echo htmlspecialchars($search); ?>&page=<?php echo max($page - 1, 1); ?>" class="page-link">Previous</a>
                        </li>

                        <?php
                        // Determine the range of pages to show
                        $pageCount = 5; // Total pages to show
                        $startPage = max(1, $page - floor($pageCount / 2)); // Start page
                        $endPage = min($totalPages, $startPage + $pageCount - 1); // End page

                        // Adjust startPage if we are near the end
                        if ($endPage - $startPage < $pageCount - 1) {
                          $startPage = max(1, $endPage - $pageCount + 1);
                        }
                        ?>

                        <!-- Page Numbers -->
                        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                          <li class="paginate_button pagination-sm page-item <?php echo ($i === $page) ? 'active' : ''; ?>">
                            <a href="?search=<?php echo htmlspecialchars($search); ?>&page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                          </li>
                        <?php endfor; ?>

                        <!-- Next Button -->
                        <li class="paginate_button pagination-sm page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                          <a href="?search=<?php echo htmlspecialchars($search); ?>&page=<?php echo min($page + 1, $totalPages); ?>" class="page-link">Next</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Update NTSP Graduation year</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" id="cellContent">
        <input type="hidden" id="cellId">
        <input type="hidden" id="cellColumn">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save_gy_sn" name="save_gy_sn">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
    // Handle double-click on table cell
    $('td').click(function() {
      if ($(this).hasClass('editable') && $(this).hasClass('table-success')) {
        var cellContent = $(this).text().trim();
        var cellId = $(this).data('id');
        var cellColumn = $(this).data('column');
        var cellIndex = $(this).index();

        $('#cellContent').val(cellContent);
        $('#cellId').val(cellId);
        $('#cellColumn').val(cellColumn);

        var modalTitle = '';
        if (cellIndex === 4) {
          modalTitle = 'Update NTSP Graduation year';
        } else {
          modalTitle = 'Update Serial number';
        }

        $('#editModalLabel').text(modalTitle);
        $('#editModal').modal('show');
      } else if ($(this).hasClass('editable')) {
        toastr.error("Can't update this data!");
      }
    });

    // Handle save button click
    $('#save_gy_sn').click(function() {
      var updatedContent = $('#cellContent').val();
      var cellId = $('#cellId').val();
      var cellColumn = $('#cellColumn').val();
      $.ajax({
        url: '../query.php', // PHP file to process the update
        type: 'POST',
        data: {
          id: cellId,
          content: updatedContent,
          column: cellColumn,
          'save_gy_sn': true
        },
        success: function(response) {
          // Update the cell in the table with new content
          var res = JSON.parse(response);
          if (res.status === 'success') {
            $('td[data-id="' + cellId + '"][data-column="' + cellColumn + '"]').text(updatedContent);
            $('#editModal').modal('hide');
            toastr.success('Data successfully updated')
          } else {
            alert(res.message); // Show error message from the server
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('Error updating cell:', textStatus, errorThrown);
          alert('Failed to update the cell. Please try again.');
        }
      });
    });
  });
</script>

<?php require "Partials/footer.php";
unset($_SESSION['response']['grades']);
?>