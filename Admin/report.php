<?php
session_start();
require "Partials/header.php";
require "Partials/navbar.php";
require "Partials/sidebar.php";
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
						<li class="breadcrumb-item">Report</li>
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
						<form id="" action="generate_report.php" method="post">
							<div class="card">
								<div class="card-header bg-warning">
									<h4 class="text-white">Generate reports</h4>
								</div>
								<div class="card-body">
									<!-- <fieldset>
										<legend class="text-black-50">File name & Title</legend>
										<div class="row">
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="file-name" class="form-label text-secondary">File name</label>
													<input type="text" class="form-control" id="file-name" name="file-name" placeholder="Enter file name">
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="report-title" class="form-label text-secondary">Report title</label>
													<input type="text" class="form-control" id="report-title" name="report-title" placeholder="Enter report title">
												</div>
											</div>
									</fieldset> -->
									<fieldset>
										<legend class="text-black-50">Query</legend>
										<div class="row">
											<div class="col-md-4 mb-3">
												<div class="control">
													<label for="college" class="form-label text-secondary">College</label>
													<select class="custom-select" id="college" name="college">
														<option value="all" selected>All</option>
														<option value="agriculture">AGRICULTURE</option>
														<option value="arts & science">ARTS & SCIENCE</option>
														<option value="education">EDUCATION</option>
														<option value="engineering">ENGINEERING</option>
														<option value="industrial technology">INDUSTRIAL TECHNOLOGY</option>
													</select>
												</div>
											</div>
											<div class="col-md-4 mb-3">
												<div class="control">
													<label for="year-level" class="form-label text-secondary">Year Level</label>
													<select class="custom-select" id="year-level" name="year-level">
														<option value="all">All</option>
														<option value="1">1st Year</option>
														<option value="2">2nd Year</option>
														<option value="3">3rd Year</option>
														<option value="4">4th Year</option>
													</select>
												</div>
											</div>
											<div class="col-md-4 mb-3">
												<div class="control">
													<label for="nstp-component" class="form-label text-secondary">NTSP Component</label>
													<select class="custom-select" id="nstp-component" name="nstp-component">
														<option disabled selected>Nstp Component</option>
														<option value="cwts">CWTS</option>
														<option value="lts">LTS</option>
														<option value="rotc">ROTC</option>
													</select>
												</div>
											</div>
										</div>
									</fieldset>
									<div class="card-footer d-flex justify-content-end px-0 bg-white">
										<div class="row">
											<div class="col-12">
												<button type="submit" name="generate-report" class="btn btn-warning px-5" value="Submit">Generate</button>
												<!-- <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Cancel</button> -->
											</div>
										</div>
									</div>
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>


</div>


<?php
require "Partials/footer.php";
unset($_SESSION['old-data']);
unset($_SESSION['errors']);
unset($_SESSION['response']);
?>