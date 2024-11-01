<?php
session_start();
require "Partials/header.php";
require "Partials/navbar.php";
require "Partials/sidebar.php";
require "../includes/functions.php";

$limit = 10; // Number of entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$year_level = isset($_GET['year_level']) ? $_GET['year_level'] : '';
$college = isset($_GET['college']) ? $_GET['college'] : '';
$sex = isset($_GET['sex']) ? $_GET['sex'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$component = isset($_GET['nstp_component']) ? $_GET['nstp_component'] : '';

try {
	require_once('../connection/dsn.php');
	$pdo = getDatabaseConnection();

	$query = "SELECT std_id, CONCAT_WS(' ', l_name, f_name, ex_name, m_name) as full_name, b_date, sex, st_brgy, municipality, province, c_status, religion, email_add, cp_number, college, y_level, course, major, quarter_1_grade_sem_1, quarter_1_percent_sem_1, quarter_2_grade_sem_1, quarter_2_percent_sem_1, average_sem_1, average_percent_sem_1, remarks_sem_1, school_year_sem_1, quarter_1_grade_sem_2, quarter_1_percent_sem_2, quarter_2_grade_sem_2, quarter_2_percent_sem_2, average_sem_2, average_percent_sem_2, remarks_sem_2, school_year_sem_2, serial_number, cpce, cpce_cp_number, nstp_component, created_at FROM tbl_20_columns WHERE 1=1";

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

	$query .= " ORDER BY l_name ASC LIMIT $limit OFFSET $offset";

	$stmt = $pdo->prepare($query);

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

	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$countQuery = "SELECT COUNT(*) as total FROM tbl_20_columns WHERE 1=1";

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

	$countStmt = $pdo->prepare($countQuery);

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
					<h3 class="m-0">Grading sheet</h3>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
						<li class="breadcrumb-item"><a href="grading.php">Grades</a></li>
						<li class="breadcrumb-item">Grades sheet</li>
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
								<div class="col-lg-12">
									<form method="get" action="" class="">
										<div class="form-row">
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
												<div class="control">
													<label for="search" class="form-label text-secondary">Search</label>
													<input type="text" id="search" name="search" class="form-control" placeholder="Search..." value="<?= isset($_GET['search'])  ? $_GET['search'] : ''; ?>">
												</div>
											</div>
											<div class="col-md-3 mt-1">
												<div class="control">
													<label for="sex" class="form-label text-secondary">Sex</label>
													<select name="sex" id="sex" class="form-control">
														<option value="">All</option>
														<option value="male" <?= isset($_GET['sex']) && $_GET['sex'] ==  'male' ? 'selected' : ''; ?>>Male</option>
														<option value="female" <?= isset($_GET['sex']) && $_GET['sex'] ==  'female' ? 'selected' : ''; ?>>Female</option>
													</select>
												</div>
											</div>
											<div class="col-md-3 mt-1">
												<div class="control">
													<label for="year_level" class="form-label text-secondary">Year level</label>
													<select name="year_level" id="year_level" class="form-control">
														<option value="">All</option>
														<option value="1" <?= isset($_GET['year_level']) && $_GET['year_level'] ==  '1' ? 'selected' : ''; ?>>1st Year</option>
														<option value="2" <?= isset($_GET['year_level']) && $_GET['year_level'] ==  '2' ? 'selected' : ''; ?>>2nd Year</option>
														<option value="3" <?= isset($_GET['year_level']) && $_GET['year_level'] ==  '3' ? 'selected' : ''; ?>>3rd Year</option>
														<option value="4" <?= isset($_GET['year_level']) && $_GET['year_level'] ==  '4' ? 'selected' : ''; ?>>4th Year</option>
													</select>
												</div>
											</div>
											<div class="col-md-3 mt-1">
												<div class="control">
													<label for="college" class="form-label text-secondary">College</label>
													<select name="college" id="college" class="form-control">
														<option value="">All</option>
														<option value="agriculture" <?= isset($_GET['college']) && $_GET['college'] ==  'agriculture' ? 'selected' : ''; ?>>AGRICULTURE</option>
														<option value="arts & science" <?= isset($_GET['college']) && $_GET['college'] ==  'arts & science' ? 'selected' : ''; ?>>ARTS & SCIENCE</option>
														<option value="education" <?= isset($_GET['college']) && $_GET['college'] ==  'education' ? 'selected' : ''; ?>>EDUCATION</option>
														<option value="engineering" <?= isset($_GET['college']) && $_GET['college'] ==  'engineering' ? 'selected' : ''; ?>>ENGINEERING</option>
														<option value="industrial technology" <?= isset($_GET['college']) && $_GET['college'] ==  'industrial technology' ? 'selected' : ''; ?>>INDUSTRIAL TECHNOLOGY</option>
														<!-- Add more course options as needed -->
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
								<form action="../query.php" method="post">
									<div class="table-striped table-responsive">
										<table class="table m-0 table-bordered">
											<thead>
												<tr>
													<th class="no-wrap f-12 text-center align-middle" rowspan="2">Student Name</th>
													<th class="no-wrap f-12 text-center align-middle" rowspan="2">Year Level</th>
													<th class="no-wrap f-12 text-center align-middle" rowspan="2">Course</th>
													<th class="no-wrap f-12 text-center align-middle" colspan="3">First semester</th>
													<th class="no-wrap f-12 text-center align-middle" colspan="3">Second semester</th>
													<th class="no-wrap f-12 text-center align-middle" rowspan="2">Serial number</th>
												</tr>
												<tr>
													<th class="no-wrap f-12 text-center align-middle">Midterm grade</th>
													<th class="no-wrap f-12 text-center align-middle">Final grade</th>
													<th class="no-wrap f-12 text-center align-middle">School Year</th>
													<th class="no-wrap f-12 text-center align-middle">Midterm grade</th>
													<th class="no-wrap f-12 text-center align-middle">Final grade</th>
													<th class="no-wrap f-12 text-center align-middle">School Year</th>
												</tr>
											</thead>
											<tbody>
												<?php if (!empty($results)): ?>
													<?php foreach ($results as $row): ?>
														<tr>
															<td class="no-wrap f-12"><?= htmlspecialchars($row['full_name']); ?></td>
															<td class="no-wrap f-12 text-center"><?= htmlspecialchars($row['y_level']); ?></td>
															<td class="no-wrap f-12"><?= htmlspecialchars(strtoupper($row['college'])); ?></td>
															<input type="hidden" name="rows[<?= $row['std_id'] ?>][std_id]" value="<?= $row['std_id']; ?>">
															<!-- 1st semester -->
															<td>
																<input type="text" name="rows[<?= $row['std_id'] ?>][quarter_1_grade_sem_1]" value="<?= $row['quarter_1_grade_sem_1'] ?>">
															</td>

															<td>
																<input type="text" name="rows[<?= $row['std_id'] ?>][quarter_2_grade_sem_1]" value="<?= $row['quarter_2_grade_sem_1'] ?>">
															</td>
															<td>
																<input type="text" name="rows[<?= $row['std_id'] ?>][school_year_sem_1]" value="<?= $row['school_year_sem_1'] ?>">
															</td>

															<!-- 2nd  Semester -->

															<td>
																<input type="text" name="rows[<?= $row['std_id'] ?>][quarter_1_grade_sem_2]" value="<?= $row['quarter_1_grade_sem_2'] ?>">
															</td>

															<td>
																<input type="text" name="rows[<?= $row['std_id'] ?>][quarter_2_grade_sem_2]" value="<?= $row['quarter_2_grade_sem_2'] ?>">
															</td>
															<td>
																<input type="text" name="rows[<?= $row['std_id'] ?>][school_year_sem_2]" value="<?= $row['school_year_sem_2'] ?>">
															</td>
															<!-- Serial number -->
															<td>
																<input type="text" name="rows[<?= $row['std_id'] ?>][serial_number]" value="<?= $row['serial_number'] ?>" <?= (isset($row['remarks_sem_1']) && isset($row['remarks_sem_2'])) && ($row['remarks_sem_1'] == 'Passed' && $row['remarks_sem_2'] == 'Passed') ?  '' : 'disabled' ?>>
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
									<div class="card-footer">
										<div class="row  d-flex justify-content-between">
											<div class="col-sm-12 col-md-4">
												<div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
													<!-- Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $limit, $totalEntries); ?> of <?php echo $totalEntries; ?> entries -->

													<?php if ($totalEntries > 0): ?>
														Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $limit, $totalEntries); ?> of <?php echo $totalEntries; ?> entries
													<?php else: ?>
														No entries found
													<?php endif; ?>
												</div>
											</div>
											<div class="col-sm-12 col-md-4">
												<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
													<ul class="pagination ">
														<!-- Previous Button -->
														<li class="paginate_button pagination-sm page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">

															<a href="?search=<?php echo htmlspecialchars($search); ?>&year_level=<?php echo htmlspecialchars($year_level); ?>&college=<?php echo htmlspecialchars($college); ?>&sex=<?php echo htmlspecialchars($sex); ?>&nstp_component=<?php echo htmlspecialchars($component); ?>&page=<?php echo max($page - 1, 1); ?>" class="page-link">Previous</a>

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
											<div class="col-sm-12 col-md-4 ">
												<button type="submit" name="update-grades" class="btn btn-sm btn-primary float-right" value="Submit">
													Update grades
												</button>
											</div>
										</div>
									</div>
								</form>
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
<?php
unset($_SESSION['response']);
unset($_SESSION['response']['delete']);
?>