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
	$query = "SELECT std_id, l_name, f_name, ex_name, m_name, b_date, sex, st_brgy, municipality, province, c_status, religion, email_add, cp_number, college, y_level, course, major, quarter_1_grade_sem_1, quarter_1_percent_sem_1, quarter_2_grade_sem_1, quarter_2_percent_sem_1, average_sem_1, average_percent_sem_1, remarks_sem_1,school_year_sem_1, quarter_1_grade_sem_2, quarter_1_percent_sem_2, quarter_2_grade_sem_2, quarter_2_percent_sem_2, average_sem_2, average_percent_sem_2, remarks_sem_2,school_year_sem_2,serial_number,cpce, cpce_cp_number, nstp_component, created_at FROM tbl_20_columns_cwts";

	// Add search condition if provided
	if ($search) {
		$query .= " WHERE CONCAT_WS(' ', l_name, f_name, ex_name, m_name) LIKE :search";
	}

	$query .= " ORDER BY std_id DESC LIMIT :limit OFFSET :offset";

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
	$countQuery = "SELECT COUNT(*) as total FROM tbl_20_columns_cwts";
	if ($search) {
		$countQuery .= " WHERE CONCAT_WS(' ', l_name, f_name, ex_name, m_name) LIKE :search";
	}

	$countStmt = $pdo->prepare($countQuery);

	// Bind search parameter if provided
	if ($search) {
		$countStmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
	}

	$countStmt->execute();
	$totalEntries = $countStmt->fetchColumn();
	$totalPages = ceil($totalEntries / $limit);
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}

?>

<script>
	<?php if (isset($_SESSION['response']['grades']) && $_SESSION['response']['grades'] === 'success') { ?>
		toastr.success("Grades successfully updated!");
	<?php } else if (isset($_SESSION['response']['grades']) && $_SESSION['response']['grades'] === 'failed') { ?>
		toastr.error("Grades failed to update!");
	<?php } ?>
</script>

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h3 class="m-0">CWTS Grades</h3>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
						<li class="breadcrumb-item">CWTS Grades</li>
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
								<div class="mt-5 d-flex justify-content-between align-items-center">
									<div>
										<a href="grade_report.php" class="btn btn-primary" style="width: 160px !important;">
											Report
										</a>
										<a href="cwts_make_grade.php" class="btn btn-primary" style="width: 160px !important;">
											Grading sheet
										</a>
									</div>
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
									<table class="table m-0 table-bordered">
										<thead>
											<tr>
												<th class="no-wrap f-12 text-center align-middle" rowspan="2">SEQ No.</th>
												<th class="no-wrap f-12 text-center align-middle" rowspan="1" colspan="4">Student Name</th>
												<th class="no-wrap f-12 text-center align-middle" rowspan="2">Year Level</th>
												<th class="no-wrap f-12 text-center align-middle" rowspan="2">Course</th>
												<th class="no-wrap f-12 text-center" colspan="5">First Semester</th>
												<th class="no-wrap f-12  text-center" colspan="5">Second Semester</th>
												<th class="no-wrap f-12 align-middle" rowspan="2">Serial number</th>
											</tr>
											<tr>
												<th class="no-wrap f-12 text-center">Last Name</th>
												<th class="no-wrap f-12 text-center">First Name</th>
												<th class="no-wrap f-12 text-center">Extension Name</th>
												<th class="no-wrap f-12 text-center">Middle Name</th>
												<!-- Sem 1 -->
												<th class="no-wrap f-12 text-center">Quarter 1</th>
												<th class="no-wrap f-12">Quarter 2</th>
												<th class="no-wrap f-12">Average</th>
												<th class="no-wrap f-12">Remarks</th>
												<th class="no-wrap f-12">School Year</th>
												<!-- Sem 2 -->
												<th class="no-wrap f-12 text-center">Quarter 1</th>
												<th class="no-wrap f-12  text-center">Quarter 2</th>
												<th class="no-wrap f-12  text-center">Average</th>
												<th class="no-wrap f-12  text-center">Remarks</th>
												<th class="no-wrap f-12">School Year</th>
											</tr>
										</thead>
										<tbody>
											<?php if (!empty($results)): ?>
												<?php foreach ($results as $row): ?>
													<tr>
														<td class="no-wrap f-12 text-center  <?= !empty($row['remarks_sem_1']) ? ($row['remarks_sem_1'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars($row['std_id']); ?></td>

														<td class="no-wrap f-12   <?= !empty($row['remarks_sem_1']) ? ($row['remarks_sem_1'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars($row['l_name']); ?></td>

														<td class="no-wrap f-12   <?= !empty($row['remarks_sem_1']) ? ($row['remarks_sem_1'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars($row['f_name']); ?></td>

														<td class="no-wrap f-12   <?= !empty($row['remarks_sem_1']) ? ($row['remarks_sem_1'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars($row['ex_name']); ?></td>

														<td class="no-wrap f-12   <?= !empty($row['remarks_sem_1']) ? ($row['remarks_sem_1'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars($row['m_name']); ?></td>

														<td class="no-wrap f-12 text-center  <?= !empty($row['remarks_sem_1']) ? ($row['remarks_sem_1'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars($row['y_level']); ?></td>

														<td class="no-wrap f-12  <?= !empty($row['remarks_sem_1']) ? ($row['remarks_sem_1'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars(strtoupper($row['college'])); ?></td>

														<!-- 1st Semester -->
														<td class="no-wrap f-12 text-center  <?= !empty($row['remarks_sem_1']) ? ($row['remarks_sem_1'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars($row['quarter_1_grade_sem_1']); ?></td>

														<td class="no-wrap f-12 text-center  <?= !empty($row['remarks_sem_1']) ? ($row['remarks_sem_1'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars($row['quarter_2_grade_sem_1']); ?></td>

														<td class="no-wrap f-12 text-center  <?= !empty($row['remarks_sem_1']) ? ($row['remarks_sem_1'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars(strtoupper($row['average_sem_1'])); ?></td>

														<td class="no-wrap f-12 text-center   <?= !empty($row['remarks_sem_1']) ? ($row['remarks_sem_1'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars(strtoupper($row['remarks_sem_1'])); ?></td>

														<td class="no-wrap f-12 text-center   <?= !empty($row['remarks_sem_1']) ? ($row['remarks_sem_1'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars(strtoupper($row['school_year_sem_1'])); ?></td>

														<!-- 2nd Semester -->
														<td class="no-wrap f-12  text-center  <?= !empty($row['remarks_sem_2']) ? ($row['remarks_sem_2'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars($row['quarter_1_grade_sem_2']); ?></td>

														<td class="no-wrap f-12  text-center <?= !empty($row['remarks_sem_2']) ? ($row['remarks_sem_2'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars($row['quarter_2_grade_sem_2']); ?></td>

														<td class="no-wrap f-12  text-center <?= !empty($row['remarks_sem_2']) ? ($row['remarks_sem_2'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars(strtoupper($row['average_sem_2'])); ?></td>

														<td class="no-wrap f-12  text-center <?= !empty($row['remarks_sem_2']) ? ($row['remarks_sem_2'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars(strtoupper($row['remarks_sem_2'])); ?></td>

														<td class="no-wrap f-12  text-center <?= !empty($row['remarks_sem_2']) ? ($row['remarks_sem_2'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars(strtoupper($row['school_year_sem_2'])); ?></td>

														<!-- Serial number -->
														<td class="no-wrap f-12 text-center <?= !empty($row['remarks_sem_2']) ? ($row['remarks_sem_2'] === 'Passed' ? 'table-success' : 'table-danger') : '' ?>"><?php echo htmlspecialchars(strtoupper($row['serial_number'])); ?></td>
													</tr>
												<?php endforeach; ?>
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

<?php require "Partials/footer.php";
unset($_SESSION['response']['grades']);
?>