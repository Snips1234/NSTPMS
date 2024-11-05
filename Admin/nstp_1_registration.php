<?php
session_start();
require "Partials/header.php";
require "Partials/navbar.php";
require "Partials/sidebar.php";
require "../includes/functions.php";

// Define pagination and search variables
$limit = 10; // Number of entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Handle search query
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Database query with search and pagination
try {
  require_once('../connection/dsn.php');
  $pdo = getDatabaseConnection();

  // Prepare the base query
  $query = "SELECT std_id, (if (ex_name = 'N/A', CONCAT_WS(' ', l_name, f_name,  m_name) , CONCAT_WS(' ', l_name, f_name, ex_name, m_name))) as full_name, b_date, sex, st_brgy, municipality, province, 
              c_status, religion, email_add, cp_number, college, y_level, course, major, 
              cpce, cpce_cp_number, nstp_component, created_at
              FROM tbl_20_columns WHERE 1=1 AND term = 1 ";

  // Add search condition if provided
  if ($search) {
    $query .= " AND CONCAT_WS(' ', l_name, f_name, ex_name, m_name) LIKE :search";
  }

  $query .= " ORDER BY l_name ASC LIMIT :limit OFFSET :offset";

  $stmt = $pdo->prepare($query);

  // Bind search parameter if provided
  if ($search) {
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
  }

  $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
  $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Get total number of entries for pagination
  $countQuery = "SELECT COUNT(*) as total FROM tbl_20_columns WHERE term = 1";
  if ($search) {
    $countQuery .= "  AND CONCAT_WS(' ', l_name, f_name, ex_name, m_name) LIKE :search";
  }

  $countStmt = $pdo->prepare($countQuery);

  // Bind search parameter if provided
  if ($search) {
    $countStmt->bindValue(':search', "%$search", PDO::PARAM_STR);
  }

  $countStmt->execute();
  $totalEntries = $countStmt->fetchColumn();
  $totalPages = ceil($totalEntries / $limit);
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}

?>

<script>
  <?php if (isset($_SESSION['response']) && $_SESSION['response'] === 'success') { ?>
    toastr.success("Data successfully added!");
  <?php } else if (isset($_SESSION['response']) && $_SESSION['response'] === 'failed') { ?>
    toastr.error("Data failed to add!");
  <?php } else if (isset($_SESSION['response']['delete']) && $_SESSION['response']['delete'] === 'success') { ?>
    toastr.success("Data successfully deleted!");
  <?php } else if (isset($_SESSION['response']['delete']) && $_SESSION['response']['delete'] === 'failed') { ?>
    toastr.error("Data failed to delete!");
  <?php } else if (isset($_SESSION['response']['update']) && $_SESSION['response']['update'] === 'success') { ?>
    toastr.success("Data successfully updated!");
  <?php } else if (isset($_SESSION['response']['update']) && $_SESSION['response']['update'] === 'failed') { ?>
    toastr.error("Data failed to update!");
  <?php } ?>
</script>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3 class="m-0">REGISTRATION</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item">Registration</li>
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
                <h3 class="card-title">NSTP 1 Student List</h3>
                <div class="mt-5 d-flex justify-content-between align-items-center">
                  <a href="register.php?term=1" class="btn btn-primary" style="width: 160px !important;">
                    Register
                  </a>
                  <form method="get" action="" class="">
                    <div class="input-group">
                      <input type="text" name="search" class="form-control" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
              <div class="card-body p-0">
                <!-- Search Form -->

                <div class="table-striped table-responsive ">
                  <table class="table m-0">
                    <thead>
                      <tr>
                        <th class="no-wrap f-12">Student ID</th>
                        <th class="no-wrap f-12">Student Name</th>
                        <th class="no-wrap f-12">Year Level</th>
                        <th class="no-wrap f-12">College</th>
                        <th class="no-wrap f-12">Course</th>
                        <th class="no-wrap f-12">Created At</th>
                        <th class="no-wrap f-12">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($results)): ?>
                        <?php foreach ($results as $row): ?>
                          <tr>
                            <td class="no-wrap f-12"><?php echo htmlspecialchars($row['std_id']); ?></td>
                            <td class="no-wrap f-12"><?php echo htmlspecialchars($row['full_name']); ?></td>
                            <td class="no-wrap f-12"><?php echo htmlspecialchars($row['y_level']); ?></td>
                            <td class="no-wrap f-12"><?php echo htmlspecialchars($row['college']); ?></td>
                            <td class="no-wrap f-12"><?php echo htmlspecialchars($row['course']); ?></td>
                            <td class="no-wrap f-12"><?php echo htmlspecialchars($row['created_at']); ?></td>
                            <td class="d-flex flex-row">
                              <a href="javascript:void(0)" class="btn btn-tool open-view-modal" type="button" data-toggle="modal" data-id="<?php echo htmlspecialchars($row['std_id']) ?>" data-table="tbl_20_columns" data-type="view" data-target="#view_modal">
                                <i class="fas fa-eye text-primary"></i>
                              </a>
                              <a href="update_data.php?std_id=<?= htmlspecialchars($row['std_id']) ?>" class="btn btn-tool">
                                <i class="fas fa-pen text-success"></i>
                              </a>
                              <!-- <a href="javascript:void(0)" class="btn btn-tool open-delete-modal" type="button" data-toggle="modal" data-id="<?php echo htmlspecialchars($row['std_id']) ?>" data-table="tbl_20_columns" data-target="#delete_modal" data-type="delete">
                                <i class="fas fa-trash text-danger"></i>
                              </a> -->
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

<?php require "Partials/footer.php"; ?>


<!-- Modal -->

<!-- view modal -->
<div class="modal fade p-0" id="view_modal" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered ">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">View Profile</h4>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body p-0">
      </div>
      <div class="modal-footer justify-content-end">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade p-0" id="delete_modal" style="display: none;" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered ">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title">Delete profile</h4>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body mb-2">

      </div>
      <div class="modal-footer justify-content-end">
        <form action="../query.php" method="post">
          <input type="hidden" id="std_id" name="std_id">
          <input type="hidden" id="table_name" name="table_name">
          <button type="submit" class="btn btn-danger" name="admin-delete" id="admin-delete">Confirm</button>
          <button type=" button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
unset($_SESSION['response']);
unset($_SESSION['response']['delete']);
?>