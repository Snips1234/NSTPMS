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

	// Prepare the base query with UNION ALL
	$query = "
    SELECT std_id, nstp_grad_year, serial_number, HEI_name, type_of_HEI, region, l_name, f_name, ex_name, m_name, b_date, sex, st_brgy, municipality, province,
           c_status, religion, email_add, cp_number, college, y_level, course, major, 
           cpce, cpce_cp_number, nstp_component, username, pass
    FROM tbl_20_columns_cwts
    WHERE CONCAT_WS(' ', l_name, f_name, ex_name, m_name) LIKE :search

    UNION ALL

    SELECT std_id, nstp_grad_year, serial_number, HEI_name, type_of_HEI, region, l_name, f_name, ex_name, m_name, b_date, sex, st_brgy, municipality, province,
           c_status, religion, email_add, cp_number, college, y_level, course, major, 
           cpce, cpce_cp_number, nstp_component, username, pass
    FROM tbl_20_columns_lts
    WHERE CONCAT_WS(' ', l_name, f_name, ex_name, m_name) LIKE :search

    UNION ALL

    SELECT std_id, nstp_grad_year, serial_number, HEI_name, type_of_HEI, region, l_name, f_name, ex_name, m_name, b_date, sex, st_brgy, municipality, province,
           c_status, religion, email_add, cp_number, college, y_level, course, major, 
           cpce, cpce_cp_number, nstp_component, username, pass
    FROM tbl_20_columns_rotc
    WHERE CONCAT_WS(' ', l_name, f_name, ex_name, m_name) LIKE :search

    ORDER BY l_name DESC
    LIMIT :limit OFFSET :offset
";

	$stmt = $pdo->prepare($query);

	// Bind search parameter if provided
	$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
	$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
	$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();

	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	// Get total number of entries for pagination
	$countQuery = "
    SELECT COUNT(*) as total FROM (
        SELECT l_name, f_name, ex_name, m_name, b_date, sex, st_brgy, municipality, province,
               c_status, religion, email_add, cp_number, college, y_level, course, major, 
               cpce, cpce_cp_number, nstp_component, username, pass
        FROM tbl_20_columns_cwts
        WHERE CONCAT_WS(' ', l_name, f_name, ex_name, m_name) LIKE :search

        UNION ALL

        SELECT l_name, f_name, ex_name, m_name, b_date, sex, st_brgy, municipality, province,
               c_status, religion, email_add, cp_number, college, y_level, course, major, 
               cpce, cpce_cp_number, nstp_component, username, pass
        FROM tbl_20_columns_lts
        WHERE CONCAT_WS(' ', l_name, f_name, ex_name, m_name) LIKE :search

        UNION ALL

        SELECT l_name, f_name, ex_name, m_name, b_date, sex, st_brgy, municipality, province,
               c_status, religion, email_add, cp_number, college, y_level, course, major, 
               cpce, cpce_cp_number, nstp_component, username, pass
        FROM tbl_20_columns_rotc
        WHERE CONCAT_WS(' ', l_name, f_name, ex_name, m_name) LIKE :search
    ) AS combined
";


	$countStmt = $pdo->prepare($countQuery);

	// Bind search parameter if provided
	$countStmt->bindValue(':search', "%$search%", PDO::PARAM_STR);

	$countStmt->execute();
	$totalEntries = $countStmt->fetchColumn();
	$totalPages = ceil($totalEntries / $limit);
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}

?>


<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h3 class="m-0">NSTP Data Field</h3>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
						<li class="breadcrumb-item">NSTP Data Field</li>
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
								<h3 class="card-title">NSTP Data Field</h3>
								<div class="mt-5 ">
									<!-- d-flex justify-content-end align-items-center -->
									<!-- <a href="add_cwts.php" class="btn btn-primary" style="width: 160px !important;">
										Registration
									</a> -->
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
								<div class="table-striped table-responsive">
									<table class="table m-0">
										<thead>
											<tr>
												<th class="no-wrap f-12">SEQ NO.</th>
												<th class="no-wrap f-12">NSTP Graduation Year</th>
												<th class="no-wrap f-12">NSTP Component</th>
												<th class="no-wrap f-12">Region</th>
												<th class="no-wrap f-12">NSTP Serial Number</th>
												<th class="no-wrap f-12">Last Name</th>
												<th class="no-wrap f-12">First Name</th>
												<th class="no-wrap f-12">Extension Name</th>
												<th class="no-wrap f-12">Middle Name</th>
												<th class="no-wrap f-12">Birthday</th>
												<th class="no-wrap f-12">Sex</th>
												<th class="no-wrap f-12">Street/Barangay</th>
												<th class="no-wrap f-12">Town/City/Municipality</th>
												<th class="no-wrap f-12">Province</th>
												<th class="no-wrap f-12">HEI Name</th>
												<th class="no-wrap f-12">TYPE of HEI</th>
												<th class="no-wrap f-12">Program/Course</th>
												<th class="no-wrap f-12">Year Level</th>
												<th class="no-wrap f-12">Email</th>
												<th class="no-wrap f-12">Contact Number</th>
												<!-- <th class="no-wrap f-12">Civil Status</th>
												<th class="no-wrap f-12">Religion</th>
												<th class="no-wrap f-12">College</th>
												<th class="no-wrap f-12">Major</th>
												<th class="no-wrap f-12">Contact Person Name</th>
												<th class="no-wrap f-12">Cp Number</th> -->
											</tr>
										</thead>
										<tbody>
											<?php if (!empty($results)): ?>
												<?php foreach ($results as $row): ?>
													<tr>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['std_id']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['nstp_grad_year']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['nstp_component']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['region']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['serial_number']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['l_name']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['f_name']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['ex_name']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['m_name']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['b_date']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['sex']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['st_brgy']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['municipality']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['province']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['HEI_name']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['type_of_HEI']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['course']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['y_level']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['email_add']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['cp_number']); ?></td>
														<!-- <td class="no-wrap f-12"><?php echo htmlspecialchars($row['c_status']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['religion']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['college']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['major']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['cpce']); ?></td>
														<td class="no-wrap f-12"><?php echo htmlspecialchars($row['cpce_cp_number']); ?></td> -->
													</tr>
												<?php endforeach; ?>
											<?php else: ?>
												<tr>
													<td colspan="20" class="text-center">No records found</td>
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
											Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $limit, $totalEntries); ?> of <?php echo $totalEntries; ?> entries
										</div>
									</div>
									<div class="col-sm-12 col-md-7">
										<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
											<ul class="pagination float-right">
												<!-- Previous Button -->
												<li class="paginate_button pagination-sm page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
													<a href="?search=<?php echo htmlspecialchars($search); ?>&page=<?php echo max($page - 1, 1); ?>" class="page-link">Previous</a>
												</li>
												<!-- Page Numbers -->
												<?php for ($i = 1; $i <= $totalPages; $i++): ?>
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
				<h4>Are you sure you want to delete this profile?</h4>
			</div>
			<div class="modal-footer justify-content-end">
				<form action="../query.php" method="post">
					<input type="hidden" id="std_id" name="std_id">
					<input type="hidden" id="table_name" name="table_name">
					<button type="submit" class="btn btn-danger" name="admin-delete-cwts" id="admin-delete-cwts">Confirm</button>
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