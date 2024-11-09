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
$term = isset($_GET['term']) ? $_GET['term'] : '';

try {
	require_once('../connection/dsn.php');
	$pdo = getDatabaseConnection();

	$query = "SELECT * FROM tbl_20_columns WHERE 1=1 ";

	if ($search) {
		$query .= " AND (f_name LIKE CONCAT('%', :search, '%') OR l_name LIKE CONCAT('%', :search, '%') OR m_name LIKE CONCAT('%', :search, '%'))";
	}

	// if the term is empty then check if the component is empty if not then fetch data matching the component
	//if the term is not empty then check if the component is empty if not then fetch data matching the component and the term 
	//but if the component is empty then fetch data matching the term
	//if term and component are both empty the fetch data with term = 1 or term = 2

	if ($term === '' && $component !== '') {
		$query .= " AND ((nstp_component = :nstp_component AND term = 1) OR (nstp_component = :nstp_component AND term = 2))";
	} else if ($term !== '' && $component === '') {
		$query .= " AND term = :term";
	} else  if ($term !== '' && $component !== '') {
		$query .= " AND nstp_component = :nstp_component AND term = :term";
	} else {
		$query .= " AND (term = 1 OR term = 2)";
	}

	if ($component) {
		$query .= " AND nstp_component = :nstp_component";
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

	$query .= " ORDER BY l_name ASC LIMIT $limit OFFSET $offset";

	$stmt = $pdo->prepare($query);

	if ($search) {
		$stmt->bindValue(':search', $search, PDO::PARAM_STR);
	}
	if ($term) {
		$stmt->bindValue(':term', $term, PDO::PARAM_STR);
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

	$countQuery = "SELECT COUNT(*) as total FROM tbl_20_columns WHERE 1=1 ";

	if ($search) {
		$countQuery .= " AND (f_name LIKE CONCAT('%', :search, '%') OR l_name LIKE CONCAT('%', :search, '%') OR m_name LIKE CONCAT('%', :search, '%'))";
	}

	if ($term === '' && $component !== '') {
		$countQuery .= " AND ((nstp_component = :nstp_component AND term = 1) OR (nstp_component = :nstp_component AND term = 2))";
	} else if ($term !== '' && $component === '') {
		$countQuery .= " AND term = :term";
	} else  if ($term !== '' && $component !== '') {
		$countQuery .= " AND nstp_component = :nstp_component AND term = :term";
	} else {
		$countQuery .= " AND (term = 1 OR term = 2)";
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

	$countStmt = $pdo->prepare($countQuery);

	if ($search) {
		$countStmt->bindValue(':search', $search, PDO::PARAM_STR);
	}
	if ($term) {
		$countStmt->bindValue(':term', $term, PDO::PARAM_STR);
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
								<div class="mt-5">
									<div class="row">
										<a href="report.php" class="btn btn-primary" style="width: 160px !important;">
											Report
										</a>
									</div>
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
											<div class="col-md-3 mt-1">
												<div class="control">
													<label for="term" class="form-label text-secondary">Term</label>
													<select name="term" id="term" class="form-control">
														<option value="">All</option>
														<option value="1" <?= isset($_GET['term']) && $_GET['term'] ==  '1' ? 'selected' : ''; ?>>NSTP 1</option>
														<option value="2" <?= isset($_GET['term']) && $_GET['term'] ==  '2' ? 'selected' : ''; ?>>NSTP 2</option>
													</select>
												</div>
											</div>
											<div class="col-md-6 mt-1">
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
											<div class="col-md-3 mt-1 align-self-end">
												<button class="btn btn-primary w-100" type="submit">Filter</button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="card-body p-0">
								<!-- Search Form -->
								<div class="table-striped table-responsive table-bordered">
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
													<?php
													$isPassed = (!empty($row['remarks_sem_1']) && !empty($row['remarks_sem_2'])) ? (($row['remarks_sem_1'] === 'Passed' && $row['remarks_sem_2'] === 'Passed') ? 'table-success' : 'table-danger') : ''; ?>
													<tr>
														<td class="no-wrap f-12 <?= $isPassed ?>"><?php echo htmlspecialchars($row['std_id']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable conditional" data-id="<?= $row['std_id'] ?>" data-column='nstp_grad_year' data-type='input' data-title='NSTP graduation year'><?php echo htmlspecialchars($row['nstp_grad_year']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='nstp_component' data-type='dropdown' data-title='NSTP component'><?php echo htmlspecialchars($row['nstp_component']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='region' data-type='dropdown' data-title='region'><?php echo htmlspecialchars($row['region']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable conditional" data-id="<?= $row['std_id'] ?>" data-column='serial_number' data-type='input' data-title='serial number'><?php echo htmlspecialchars($row['serial_number']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='l_name' data-type='input' data-title='last name'><?php echo htmlspecialchars($row['l_name']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='f_name' data-type='input' data-title='first name'><?php echo htmlspecialchars($row['f_name']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='ex_name' data-type='input' data-title='name extension'><?php echo htmlspecialchars($row['ex_name']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='m_name' data-type='input' data-title='middle name'><?php echo htmlspecialchars($row['m_name']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='b_date' data-type='date_time' data-title='birthday'><?php echo htmlspecialchars($row['b_date']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='sex' data-type='dropdown' data-title='sex'><?php echo htmlspecialchars($row['sex']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='st_brgy' data-type='input' data-title='street/barangay'><?php echo htmlspecialchars($row['st_brgy']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='municipality' data-type='input' data-title='municipality'><?php echo htmlspecialchars($row['municipality']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='province' data-type='input' data-title='province'><?php echo htmlspecialchars($row['province']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='HEI_name' data-type='input' data-title='HEI name'><?php echo htmlspecialchars($row['HEI_name']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='type_of_HEI' data-type='dropdown' data-title='type of HEI'><?php echo htmlspecialchars($row['type_of_HEI']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='course' data-type='dropdown' data-title='course'><?php echo htmlspecialchars($row['course']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='y_level' data-type='dropdown' data-title='year level'><?php echo htmlspecialchars($row['y_level']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='email_add' data-type='input' data-title='email address'><?php echo htmlspecialchars($row['email_add']); ?></td>

														<td class="no-wrap f-12 <?= $isPassed ?> editable" data-id="<?= $row['std_id'] ?>" data-column='cp_number' data-type='input' data-title='contact number'><?php echo htmlspecialchars($row['cp_number']); ?></td>
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
<!-- <div>
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
</div> -->
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


<!-- <script>
	$(document).ready(function() {
		// Handle double-click on table cell
		$('td').click(function() {
			if ($(this).hasClass('editable') && $(this).hasClass('table-success') && $(this).hasClass('conditional')) {
				var cellContent = $(this).text().trim();
				var cellId = $(this).data('id');
				var cellColumn = $(this).data('column');
				var cellIndex = $(this).index();
				var cellTitle = $(this).data('title').toUpperCase();

				$('#cellContent').val(cellContent);
				$('#cellId').val(cellId);
				$('#cellColumn').val(cellColumn);
				$('#editModalLabel').text(cellTitle);

				$('#editModal').modal('show');
			} else if ($(this).hasClass('editable') && $(this).hasClass('conditional')) {
				toastr.error("Can't update this data!");
			} else if ($(this).hasClass('editable')) {
				var cellContent = $(this).text().trim();
				var cellId = $(this).data('id');
				var cellColumn = $(this).data('column');
				var cellIndex = $(this).index();
				var cellTitle = $(this).data('title').toUpperCase();

				$('#cellContent').val(cellContent);
				$('#cellId').val(cellId);
				$('#cellColumn').val(cellColumn);
				$('#editModalLabel').text(cellTitle);

				$('#editModal').modal('show');
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
</script> -->

<!-- <script>
	$(document).ready(function() {
		$('td').click(function() {
			if ($(this).hasClass('editable') && $(this).hasClass('table-success') && $(this).hasClass('conditional')) {
				var cellContent = $(this).text().trim();
				var cellId = $(this).data('id');
				var cellColumn = $(this).data('column');
				var cellTitle = $(this).data('title').toUpperCase();
				var cellType = $(this).data('type');
				var cellIndex = $(this).index();

				// Set hidden fields
				$('#cellId').val(cellId);
				$('#cellColumn').val(cellColumn);
				$('#editModalLabel').text(cellTitle);

				// Handle different input types based on cellType
				if (cellType === 'dropdown') {
					// Show a select element
					if (cellIndex === 2) {
						$('#cellContent').replaceWith(`
								<select id="cellContent" class="form-control">
										<option value="CWTS" ${cellContent === 'CWTS' ? 'selected' : ''}>CWTS</option>
										<option value="LTS" ${cellContent === 'LTS' ? 'selected' : ''}>LTS</option>
										<option value="ROTC" ${cellContent === 'ROTC' ? 'selected' : ''}>ROTC</option>
								</select>
						`);
					} else if (cellIndex === 10) {
						$('#cellContent').replaceWith(`
								<select id="cellContent" class="form-control">
										<option value="Male" ${cellContent === 'Male' ? 'selected' : ''}>Male</option>
										<option value="Female" ${cellContent === 'Female' ? 'selected' : ''}>Female</option>
								</select>
						`);
					} else if (cellIndex === 15) {
						$('#cellContent').replaceWith(`
								<select id="cellContent" class="form-control">
										<option value="SUCs" ${cellContent === 'SUCs' ? 'selected' : ''}>SUCs</option>
										<option value="LUCs" ${cellContent === 'LUCs' ? 'selected' : ''}>LUCs</option>
										<option value="OGs" ${cellContent === 'OGs' ? 'selected' : ''}>OGs</option>
										<option value="Private HEI" ${cellContent === 'Private HEI' ? 'selected' : ''}>Private HEI</option>
								</select>
						`);
					} else if (cellIndex === 17) {
						$('#cellContent').replaceWith(`
								<select id="cellContent" class="form-control">
										<option value="1" ${cellContent === '1' ? 'selected' : ''}>1st Year</option>
										<option value="2" ${cellContent === '2' ? 'selected' : ''}>2nd Year</option>
										<option value="3" ${cellContent === '3' ? 'selected' : ''}>3rd Year</option>
										<option value="4" ${cellContent === '4' ? 'selected' : ''}>4th Year</option>
								</select>
						`);
					} else {
						$('#cellContent').replaceWith('<select id="cellContent" class="form-control"></select>');

						$.ajax({
							url: '../includes/populate.php',
							type: 'POST',
							data: {
								column: cellColumn,
								id: cellId
							},
							success: function(response) {
								// Parse JSON response from PHP
								var options = JSON.parse(response);

								// Clear existing options
								$('#cellContent').empty();

								// Populate the select dropdown
								$.each(options, function(value, text) {
									$('#cellContent').append($('<option>', {
										value: value,
										text: text
									}));
								});

								// Set the selected option to match cellContent
								$('#cellContent').val(cellContent);
							},
							error: function(jqXHR, textStatus, errorThrown) {
								console.error('Error fetching dropdown options:', textStatus, errorThrown);
								alert('Failed to load options. Please try again.');
							}
						});
					}
				} else if (cellType === 'date_time') {
					// Show a date picker input
					$('#cellContent').replaceWith('<input type="date" class="form-control" id="cellContent">');
					$('#cellContent').val(cellContent);

					// Initialize date picker (assuming you're using a date picker plugin like jQuery UI)
					$('#cellContent').datepicker({
						dateFormat: 'yy-mm-dd' // Adjust format as needed
					});
				} else {
					// Default text input for other cases
					$('#cellContent').replaceWith('<input type="text" class="form-control" id="cellContent">');
					$('#cellContent').val(cellContent);
				}

				// Show the modal
				$('#editModal').modal('show');
			} else if ($(this).hasClass('editable') && $(this).hasClass('conditional')) {
				toastr.error("Can't update this data!");
			} else if ($(this).hasClass('editable')) {
				var cellContent = $(this).text().trim();
				var cellId = $(this).data('id');
				var cellColumn = $(this).data('column');
				var cellTitle = $(this).data('title').toUpperCase();
				var cellType = $(this).data('type');
				var cellIndex = $(this).index();

				// Set hidden fields
				$('#cellId').val(cellId);
				$('#cellColumn').val(cellColumn);
				$('#editModalLabel').text(cellTitle);

				// Handle different input types based on cellType
				if (cellType === 'dropdown') {
					// Show a select element
					if (cellIndex === 2) {
						$('#cellContent').replaceWith(`
								<select id="cellContent" class="form-control">
										<option value="CWTS" ${cellContent === 'CWTS' ? 'selected' : ''}>CWTS</option>
										<option value="LTS" ${cellContent === 'LTS' ? 'selected' : ''}>LTS</option>
										<option value="ROTC" ${cellContent === 'ROTC' ? 'selected' : ''}>ROTC</option>
								</select>
						`);
					} else if (cellIndex === 10) {
						$('#cellContent').replaceWith(`
								<select id="cellContent" class="form-control">
										<option value="Male" ${cellContent === 'Male' ? 'selected' : ''}>Male</option>
										<option value="Female" ${cellContent === 'Female' ? 'selected' : ''}>Female</option>
								</select>
						`);
					} else if (cellIndex === 15) {
						$('#cellContent').replaceWith(`
								<select id="cellContent" class="form-control">
										<option value="SUCs" ${cellContent === 'SUCs' ? 'selected' : ''}>SUCs</option>
										<option value="LUCs" ${cellContent === 'LUCs' ? 'selected' : ''}>LUCs</option>
										<option value="OGs" ${cellContent === 'OGs' ? 'selected' : ''}>OGs</option>
										<option value="Private HEI" ${cellContent === 'Private HEI' ? 'selected' : ''}>Private HEI</option>
								</select>
						`);
					} else if (cellIndex === 17) {
						$('#cellContent').replaceWith(`
								<select id="cellContent" class="form-control">
										<option value="1" ${cellContent === '1' ? 'selected' : ''}>1st Year</option>
										<option value="2" ${cellContent === '2' ? 'selected' : ''}>2nd Year</option>
										<option value="3" ${cellContent === '3' ? 'selected' : ''}>3rd Year</option>
										<option value="4" ${cellContent === '4' ? 'selected' : ''}>4th Year</option>
								</select>
						`);
					} else {
						$('#cellContent').replaceWith('<select id="cellContent" class="form-control"></select>');

						$.ajax({
							url: '../includes/populate.php',
							type: 'POST',
							data: {
								column: cellColumn,
								id: cellId
							},
							success: function(response) {
								var options = JSON.parse(response);

								$('#cellContent').empty();

								$.each(options, function(value, text) {
									$('#cellContent').append($('<option>', {
										value: value,
										text: text
									}));
								});

								$('#cellContent').val(cellContent);
							},
							error: function(jqXHR, textStatus, errorThrown) {
								console.error('Error fetching dropdown options:', textStatus, errorThrown);
								alert('Failed to load options. Please try again.');
							}
						});
					}
				} else if (cellType === 'date_time') {
					$('#cellContent').replaceWith('<input type="date" class="form-control" id="cellContent">');
					$('#cellContent').val(cellContent);
					$('#cellContent').datepicker({
						dateFormat: 'yy-mm-dd' // Adjust format as needed
					});
				} else {
					$('#cellContent').replaceWith('<input type="text" class="form-control" id="cellContent">');
					$('#cellContent').val(cellContent);
				}

				// Show the modal
				$('#editModal').modal('show');
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
					var res = JSON.parse(response);
					if (res.status === 'success') {
						$('td[data-id="' + cellId + '"][data-column="' + cellColumn + '"]').text(updatedContent);
						$('#editModal').modal('hide');
						toastr.success('Data successfully updated');
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
</script> -->

<script>
	$(document).ready(function() {
		// Event handler for table cell clicks
		$('td').click(function() {
			if ($(this).hasClass('editable')) {
				let cell = $(this);
				let cellContent = cell.text().trim();
				let cellId = cell.data('id');
				let cellColumn = cell.data('column');
				let cellTitle = cell.data('title').toUpperCase();
				let cellType = cell.data('type');
				let cellIndex = cell.index();

				// If cell is both editable and conditional, show error
				if (cell.hasClass('conditional') && !cell.hasClass('table-success')) {
					toastr.error("Can't update this data!");
					return;
				}

				// Set hidden fields and modal title
				$('#cellId').val(cellId);
				$('#cellColumn').val(cellColumn);
				$('#editModalLabel').text(cellTitle);

				// Configure input based on cellType and cellIndex
				let inputField = '<input type="text" class="form-control" id="cellContent">';
				if (cellType === 'dropdown') {
					let optionsHTML = getOptionsHTML(cellIndex, cellContent);
					if (optionsHTML) {
						inputField = `<select id="cellContent" class="form-control">${optionsHTML}</select>`;
					} else {
						// Load options via AJAX for non-hardcoded dropdowns
						inputField = '<select id="cellContent" class="form-control"></select>';
						populateDropdown(cellColumn, cellId, cellContent);
					}
				} else if (cellType === 'date_time') {
					inputField = '<input type="date" class="form-control" id="cellContent">';
				}

				// Replace #cellContent with the appropriate input field and set value
				$('#cellContent').replaceWith(inputField);
				if (cellType !== 'dropdown') $('#cellContent').val(cellContent);
				$('#editModal').modal('show');
			}
		});

		// Save button handler
		$('#save_gy_sn').click(function() {
			$.ajax({
				url: '../query.php',
				type: 'POST',
				data: {
					id: $('#cellId').val(),
					content: $('#cellContent').val(),
					column: $('#cellColumn').val(),
					'save_gy_sn': true
				},
				success: function(response) {
					let res = JSON.parse(response);
					if (res.status === 'success') {
						$('td[data-id="' + $('#cellId').val() + '"][data-column="' + $('#cellColumn').val() + '"]').text($('#cellContent').val());
						$('#editModal').modal('hide');
						toastr.success('Data successfully updated');
					} else {
						alert(res.message);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.error('Error updating cell:', textStatus, errorThrown);
					alert('Failed to update the cell. Please try again.');
				}
			});
		});

		// Populate dropdown based on AJAX response
		function populateDropdown(column, id, selectedValue) {
			$.ajax({
				url: '../includes/populate.php',
				type: 'POST',
				data: {
					column,
					id
				},
				success: function(response) {
					let options = JSON.parse(response);
					$('#cellContent').empty();
					$.each(options, function(value, text) {
						$('#cellContent').append(`<option value="${value}" ${value === selectedValue ? 'selected' : ''}>${text}</option>`);
					});
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.error('Error fetching dropdown options:', textStatus, errorThrown);
					alert('Failed to load options. Please try again.');
				}
			});
		}

		function getOptionsHTML(index, selected) {
			const optionsMap = {
				2: {
					CWTS: 'CWTS',
					LTS: 'LTS',
					ROTC: 'ROTC'
				},
				10: {
					Male: 'Male',
					Female: 'Female'
				},
				15: {
					SUCs: 'SUCs',
					LUCs: 'LUCs',
					OGs: 'OGs',
					'Private HEI': 'Private HEI'
				},
				17: {
					'1': '1st Year',
					'2': '2nd Year',
					'3': '3rd Year',
					'4': '4th Year'
				}
			};
			if (optionsMap[index]) {
				return Object.entries(optionsMap[index])
					.map(([value, text]) => `<option value="${value}" ${value === selected ? 'selected' : ''}>${text}</option>`)
					.join('');
			}
			return '';
		}
	});
</script>

<?php
unset($_SESSION['response']);
unset($_SESSION['response']['delete']);
?>