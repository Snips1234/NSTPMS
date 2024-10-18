<?php
session_start();
require "Partials/header.php";
require "Partials/navbar.php";
require "Partials/sidebar.php";
require "../includes/functions.php";


$year_level = isset($_GET['year_level']) ? $_GET['year_level'] : '';
$college = isset($_GET['college']) ? $_GET['college'] : '';

try {
	require_once('../connection/dsn.php');
	$pdo = getDatabaseConnection();

	$query = "SELECT std_id, CONCAT_WS(' ', l_name, f_name, ex_name, m_name) as full_name, b_date, sex,st_brgy, municipality, province, c_status, religion, email_add, cp_number, college, y_level, course, major, quarter_1_grade_sem_1, quarter_1_percent_sem_1, quarter_2_grade_sem_1, quarter_2_percent_sem_1, average_sem_1, average_percent_sem_1, remarks_sem_1,school_year_sem_1, quarter_1_grade_sem_2, quarter_1_percent_sem_2, quarter_2_grade_sem_2, quarter_2_percent_sem_2, average_sem_2, average_percent_sem_2, remarks_sem_2,school_year_sem_2, serial_number, cpce, cpce_cp_number, nstp_component, created_at FROM tbl_20_columns_rotc WHERE 1=1";

	if ($year_level) {
		$query .= " AND y_level = :year_level";
	}

	if ($college) {
		$query .= " AND college = :college";
	}

	$stmt = $pdo->prepare($query);

	if ($year_level) {
		$stmt->bindValue(':year_level', $year_level, PDO::PARAM_STR);
	}

	if ($college) {
		$stmt->bindValue(':college', $college, PDO::PARAM_STR);
	}

	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$countQuery = "SELECT COUNT(*) as total FROM tbl_20_columns_rotc WHERE 1=1";

	if ($year_level) {
		$countQuery .= " AND y_level = :year_level";
	}

	if ($college) {
		$countQuery .= " AND college = :college";
	}

	$countStmt = $pdo->prepare($countQuery);


	if ($year_level) {
		$countStmt->bindValue(':year_level', $year_level, PDO::PARAM_STR);
	}

	if ($college) {
		$countStmt->bindValue(':college', $college, PDO::PARAM_STR);
	}

	$countStmt->execute();
	$totalEntries = $countStmt->fetchColumn();
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}
?>

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h3 class="m-0">ROTC Grading sheet</h3>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
						<li class="breadcrumb-item"><a href="rotc_grading.php">ROTC Grades</a></li>
						<li class="breadcrumb-item">Grades</li>
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
								<h3 class="card-title">
									<!-- <i class="fa fa-info-circle" aria-hidden="true"></i>
									Use 1-100 grading system -->
								</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-card-widget="collapse">
										<i class="fas fa-minus"></i>
									</button>
								</div>
								<div class="mt-5 r">
									<form method="get" action="" class="">
										<div class="form-row">
											<div class="col-md-5 mt-1">
												<select name="year_level" class="form-control">
													<option value="">Select Year Level</option>
													<option value="1" <?php echo $year_level == '1' ? 'selected' : ''; ?>>1st Year</option>
													<option value="2" <?php echo $year_level == '2' ? 'selected' : ''; ?>>2nd Year</option>
													<option value="3" <?php echo $year_level == '3' ? 'selected' : ''; ?>>3rd Year</option>
													<option value="4" <?php echo $year_level == '4' ? 'selected' : ''; ?>>4th Year</option>
												</select>
											</div>
											<div class="col-md-5 mt-1">
												<select name="college" class="form-control">
													<option value="" disabled selected>Select College</option>
													<option value="agriculture">AGRICULTURE</option>
													<option value="arts & science">ARTS & SCIENCE</option>
													<option value="education">EDUCATION</option>
													<option value="engineering">ENGINEERING</option>
													<option value="industrial technology">INDUSTRIAL TECHNOLOGY</option>
													<!-- Add more course options as needed -->
												</select>
											</div>
											<div class="col-md-2 mt-1">
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
													<th class="no-wrap f-12 text-center align-middle">Quarter 1</th>
													<th class="no-wrap f-12 text-center align-middle">Quarter 2</th>
													<th class="no-wrap f-12 text-center align-middle">School Year</th>
													<th class="no-wrap f-12 text-center align-middle">Quarter 1</th>
													<th class="no-wrap f-12 text-center align-middle">Quarter 2</th>
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
																<input type="text" name="rows[<?= $row['std_id'] ?>][serial_number]" value="<?= $row['serial_number'] ?>">
															</td>
														</tr>
													<?php endforeach; ?>
												<?php endif; ?>
											</tbody>
										</table>
									</div>
									<div class="card-footer d-flex justify-content-end">
										<button type="submit" name="rotc-update-grades" class="btn btn-primary my-3" value="Submit">Update grades</button>
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
?>