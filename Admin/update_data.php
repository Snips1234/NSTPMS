<?php
session_start();
require "Partials/header.php";
require "Partials/navbar.php";
require "Partials/sidebar.php";
require "../includes/functions.php";

if (isset($_GET['std_id'])) {
	$std_id =  htmlspecialchars($_GET['std_id']);
	try {
		require_once('../connection/dsn.php');
		$pdo = getDatabaseConnection();

		$query = "SELECT * FROM tbl_20_columns WHERE std_id = :id";

		$stmt = $pdo->prepare($query);
		$stmt->bindParam(':id', $std_id, PDO::PARAM_INT);
		$stmt->execute();
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}
}

// echo "<pre>";
// var_dump($results);
// echo "</pre>";

try {
	require_once('../connection/dsn.php');
	$pdo = getDatabaseConnection();

	$query = "SELECT * FROM `tbl_region`";

	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$regions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}

try {
	require_once('../connection/dsn.php');
	$pdo = getDatabaseConnection();

	$query = "SELECT * FROM `tbl_colleges`";

	$stmt = $pdo->prepare($query);
	$stmt->execute();
	$colleges = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}
$selectedCollege = $results['college'] ?? null;
$selectedCourse = $results['course'] ?? null;
$selectedMajor = $results['major'] ?? null;
?>

<div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h3 class="m-0">UPDATE DATA</h3>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
						<li class="breadcrumb-item">Update Data</li>
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
						<form id="admin-edit" action="../query.php?term=<?= isset($_GET['term']) ? $_GET['term'] : '' ?>" method="post" novalidate>
							<input type="hidden" id="student-type" name="student-type" value="CWTS">
							<input type="hidden" id="std_id" name="std_id" value="<?= htmlspecialchars($_GET['std_id']) ?>">
							<div class="card">
								<div class="card-header" style="background-color: rgb(32, 85, 67);">
									<h4 class="text-white">Update student data</h4>
								</div>
								<div class="card-body">
									<fieldset>
										<legend class="text-black-50">NSTP Component/Region/Term</legend>
										<div class="row">
											<div class="col-lg-4 mb-3">
												<div class="control">
													<label for="nstp-component" class="form-label text-secondary">NSTP Component <span class="text-danger">*</span></label>
													<select class="custom-select <?= isset($_SESSION['errors']['nstp-component']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="nstp-component" name="nstp-component" value="<?= isset($data['nstp-component']) ? htmlspecialchars($data['nstp-component']) : '' ?>">
														<option value="CWTS" <?= (isset($_SESSION['old-data']['nstp-component']) && $_SESSION['old-data']['nstp-component'] == 'CWTS') || (isset($results['nstp_component']) && $results['nstp_component'] == 'CWTS')  ? 'selected' : '' ?>>CWTS</option>
														<option value="LTS" <?= (isset($_SESSION['old-data']['nstp-component']) && $_SESSION['old-data']['nstp-component'] == 'LTS') || (isset($results['nstp_component']) && $results['nstp_component'] == 'LTS') ? 'selected' : '' ?>>LTS</option>
														<option value="ROTC" <?= (isset($_SESSION['old-data']['nstp-component']) && $_SESSION['old-data']['nstp-component'] == 'ROTC') || (isset($results['nstp_component']) && $results['nstp_component'] == 'ROTC') ? 'selected' : '' ?>>ROTC</option>
													</select>
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['nstp-component'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['nstp-component']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-lg-4 mb-3">
												<div class="control">
													<?php $selectedRegion = $_SESSION['old-data']['region'] ?? $results['region'] ?? null ?>
													<label for="region" class="form-label text-secondary">Region <span class="text-danger">*</span></label>
													<select class="custom-select <?= isset($_SESSION['errors']['region']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="region" name="region">
														<!-- <option selected disabled>-- Select region --</option> -->
														<?php foreach ($regions as $region): ?>
															<option value="<?= htmlspecialchars($region['region']); ?>"
																<?= ($selectedRegion == $region['region']) ? 'selected' : '' ?>>
																<?= htmlspecialchars($region['region']); ?>
															</option>
														<?php endforeach; ?>
													</select>
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['gender'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['gender']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-lg-4 mb-3">
												<div class="control">
													<label for="term" class="form-label text-secondary">Term<span class="text-danger">*</span></label>
													<select class="custom-select <?= isset($_SESSION['errors']['term']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="term" name="term" value="<?= isset($data['term']) ? htmlspecialchars($data['term']) : '' ?>">
														<option value="" <?= (isset($_SESSION['old-data']['term']) && $_SESSION['old-data']['term'] == '') || (isset($results['term']) && $results['term'] == '')  ? 'selected' : '' ?>>-- select term --</option>
														<option value="NSTP1" <?= (isset($_SESSION['old-data']['term']) && $_SESSION['old-data']['term'] == 'NSTP1') || (isset($results['term']) && $results['term'] == '1')  ? 'selected' : '' ?>>NSTP 1</option>


														<option value="NSTP2" <?= (isset($_SESSION['old-data']['term']) && $_SESSION['old-data']['term'] == 'NSTP2') || (isset($results['term']) && $results['term'] == '2') ? 'selected' : '' ?>>NSTP 2</option>
													</select>
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['term'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['term']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>

									</fieldset>
									<fieldset>
										<legend class="text-black-50">Full Name</legend>
										<div class="row">
											<div class="col-md-3 mb-3">
												<div class="control">
													<label for="last-name" class="form-label text-secondary">Last Name <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['last-name']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="last-name" name="last-name" placeholder="Enter your last name" value="<?= isset($_SESSION['old-data']['last-name']) ? htmlspecialchars($_SESSION['old-data']['last-name']) : (isset($results['l_name']) ? htmlspecialchars($results['l_name']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['last-name'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['last-name']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="control">
													<label for="first-name" class="form-label text-secondary">First Name <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['first-name']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="first-name" name="first-name" placeholder="Enter your first name" value="<?= isset($_SESSION['old-data']['first-name']) ? htmlspecialchars($_SESSION['old-data']['first-name']) : (isset($results['f_name']) ? htmlspecialchars($results['f_name']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['first-name'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['first-name']) ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="control">
													<label for="name-extension" class="form-label text-secondary">Name Extension</label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['name-extension']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="name-extension" name="name-extension" placeholder="Enter your name extension" value="<?= isset($_SESSION['old-data']['name-extension']) ? htmlspecialchars($_SESSION['old-data']['name-extension']) : (isset($results['ex_name']) ? htmlspecialchars($results['ex_name']) : '') ?>">
													<div class=" error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['name-extension'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['name-extension']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="control">
													<label for="middle-name" class="form-label text-secondary">Middle Name <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['middle-name']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="middle-name" name="middle-name" placeholder="Enter your middle name" value="<?= isset($_SESSION['old-data']['middle-name']) ? htmlspecialchars($_SESSION['old-data']['middle-name']) : (isset($results['m_name']) ? htmlspecialchars($results['m_name']) : '') ?>">
													<div class=" error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['middle-name'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['middle-name']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
									<fieldset>
										<legend class="text-black-50">Birthday and Sex</legend>
										<div class="row">
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="birthday" class="form-label text-secondary">Birthday <span class="text-danger">*</span></label>
													<input type="date" class="form-control <?= isset($_SESSION['errors']['birthday']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="birthday" name="birthday" value="<?= isset($_SESSION['old-data']['birthday']) ? htmlspecialchars($_SESSION['old-data']['birthday']) : (isset($results['b_date']) ? htmlspecialchars($results['b_date']) : '') ?>">
													<div class=" error-container fs-6 text-danger" style="font-size: 12px !important;">
													</div>
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="gender" class="form-label text-secondary">Sex <span class="text-danger">*</span></label>
													<select class="custom-select <?= isset($_SESSION['errors']['gender']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="gender" name="gender">
														<option value="" disabled <?= !isset($_SESSION['old-data']['gender']) && !isset($results['sex']) ? 'selected' : '' ?>>Gender</option>
														<option value="male" <?= (isset($_SESSION['old-data']['gender']) && strtolower($_SESSION['old-data']['gender']) === 'male') || (isset($results['sex']) && strtolower($results['sex']) === 'male') ? 'selected' : '' ?>>Male</option>
														<option value="female" <?= (isset($_SESSION['old-data']['gender']) && strtolower($_SESSION['old-data']['gender']) === 'female') || (isset($results['sex']) && strtolower($results['sex']) === 'female') ? 'selected' : '' ?>>Female</option>
													</select>
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['gender'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['gender']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
									<fieldset>
										<legend class="text-black-50">Address</legend>
										<div class="row">
											<div class="col-lg-4 mb-3">
												<div class="control">
													<label for="address-street-barangay" class="form-label text-secondary">Street/Barangay <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['address-street-barangay']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="address-street-barangay" name="address-street-barangay" placeholder="Enter your Street/Barangay" value="<?= isset($_SESSION['old-data']['address-street-barangay']) ? htmlspecialchars($_SESSION['old-data']['address-street-barangay']) : (isset($results['st_brgy']) ? htmlspecialchars($results['st_brgy']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['address-street-barangay'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['address-street-barangay']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-lg-4 mb-3">
												<div class="control">
													<label for="address-municipality" class="form-label text-secondary">Town/City/Municipality <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['address-municipality']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="address-municipality" name="address-municipality" placeholder="Enter your Municipality" value="<?= isset($_SESSION['old-data']['address-municipality']) ? htmlspecialchars($_SESSION['old-data']['address-municipality']) : (isset($results['municipality']) ? htmlspecialchars($results['municipality']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['address-municipality'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['address-municipality']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-lg-4 mb-3">
												<div class="control">
													<label for="address-province" class="form-label text-secondary">Province <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['address-province']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="address-province" name="address-province" placeholder="Enter you Province" value="<?= isset($_SESSION['old-data']['address-province']) ? htmlspecialchars($_SESSION['old-data']['address-province']) : (isset($results['province']) ? htmlspecialchars($results['province']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['address-province'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['address-province']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
									<fieldset>
										<legend class="text-black-50">HEI name/Type of HEIs</legend>
										<div class="row">
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="hei-name" class="form-label text-secondary">HEI name <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['hei-name']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="hei-name" name="hei-name" placeholder="Enter your HEI name" value="<?= isset($_SESSION['old-data']['hei-name']) ? htmlspecialchars($_SESSION['old-data']['hei-name']) : (isset($results['HEI_name']) ? htmlspecialchars($results['HEI_name']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['hei-name'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['hei-name']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="type-of-hei" class="form-label text-secondary">Types of HEIs <span class="text-danger">*</span></label>
													<select class="custom-select <?= isset($_SESSION['errors']['type-of-hei']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="type-of-hei" name="type-of-hei">
														<option value="SUCs"
															<?= (isset($_SESSION['old-data']['type-of-hei']) && $_SESSION['old-data']['type-of-hei'] == 'SUCs')
																|| (isset($results['type_of_HEI']) && $results['type_of_HEI']  == 'SUCs') ? 'selected' : '' ?>>SUCs
														</option>
														<option value="LUCs" <?= (isset($_SESSION['old-data']['type-of-hei']) && $_SESSION['old-data']['type-of-hei'] == 'LUCs') || (isset($results['type_of_HEI']) && $results['type_of_HEI'] == 'LUCs')  ? 'selected' : '' ?>>
															LUCs
														</option>
														<option value="OGs" <?= (isset($_SESSION['old-data']['type-of-hei']) && $_SESSION['old-data']['type-of-hei'] == 'OGS') || (isset($results['type_of_HEI']) && $results['type_of_HEI'] == 'OGS') ? 'selected' : '' ?>>
															OGs
														</option>
														<option value="Private HEI" <?= (isset($_SESSION['old-data']['type-of-hei']) && $_SESSION['old-data']['type-of-hei'] == 'PHE') || (isset($results['type_of_HEI']) && $results['type_of_HEI'] == 'PHE') ? 'selected' : '' ?>>
															Private HEI
														</option>
													</select>
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['type-of-hei'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['type-of-hei']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
									</fieldset>
									<fieldset>
										<legend class="text-black-50">College Information</legend>
										<div class="row">
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="college" class="form-label text-secondary">College <span class="text-danger">*</span></label>
													<select class="custom-select <?= isset($_SESSION['errors']['college']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="college" name="college">
														<option value="" disabled selected>-- select college --</option>
														<?php foreach ($colleges as $college): ?>
															<option value="<?= htmlspecialchars($college['colleges']) ?>"
																<?= (isset($_SESSION['old-data']['college']) && $_SESSION['old-data']['college'] === $college['colleges'])
																	|| (isset($results['college']) && $results['college'] === $college['colleges']) ? 'selected' : '' ?> data-id='<?= $college['college_id'] ?>'>
																<?= htmlspecialchars($college['colleges']) ?>
															</option>
														<?php endforeach; ?>
													</select>
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['college'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['college']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="course" class="form-label text-secondary">Program/Course <span class="text-danger">*</span></label>
													<select class="custom-select <?= isset($_SESSION['errors']['course']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="course" name="course">
													</select>
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['course'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['course']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="major" class="form-label text-secondary">Major <span class="text-danger">*</span></label>
													<select class="custom-select <?= isset($_SESSION['errors']['major']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="major" name="major">

													</select>
													<div class=" error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['major'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['major']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="year-level" class="form-label text-secondary">Year Level <span class="text-danger">*</span></label>
													<select class="custom-select <?= isset($_SESSION['errors']['year-level']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="year-level" name="year-level" value="<?= isset($data['year-level']) ? htmlspecialchars($data['year-level']) : '' ?>">
														<option value="" disabled <?= !isset($_SESSION['old-data']['year-level']) && !isset($results['y_level']) ? 'selected' : '' ?>>Year level</option>
														<option value="1" <?= (isset($_SESSION['old-data']['year-level']) && $_SESSION['old-data']['year-level'] == '1') || (isset($results['y_level']) && $results['y_level'] == '1') ? 'selected' : '' ?>>1st Year</option>
														<option value="2" <?= (isset($_SESSION['old-data']['year-level']) && $_SESSION['old-data']['year-level'] == '2') || (isset($results['y_level']) && $results['y_level'] == '2') ? 'selected' : '' ?>>2nd Year</option>
														<option value="3" <?= (isset($_SESSION['old-data']['year-level']) && $_SESSION['old-data']['year-level'] == '3') || (isset($results['y_level']) && $results['y_level'] == '3') ? 'selected' : '' ?>>3rd Year</option>
														<option value="4" <?= (isset($_SESSION['old-data']['year-level']) && $_SESSION['old-data']['year-level'] == '4') || (isset($results['y_level']) && $results['y_level'] == '4') ? 'selected' : '' ?>>4th Year</option>
													</select>
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['year-level'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['year-level']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
									<fieldset>
										<legend class="text-black-50">Others</legend>
										<div class="row">
											<div class="col-md-3 mb-3">
												<div class="control">
													<label for="civil-status" class="form-label text-secondary">Civil Status <span class="text-danger">*</span></label>
													<select class="custom-select <?= isset($_SESSION['errors']['civil-status']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="civil-status" name="civil-status" value="<?= isset($data['civil-status']) ? htmlspecialchars($data['civil-status']) : '' ?>">
														<option value="" disabled <?= !isset($_SESSION['old-data']['civil-status']) && !isset($results['c_status']) ? 'selected' : '' ?>>Civil Status</option>
														<option value="single" <?= (isset($_SESSION['old-data']['civil-status']) && strtolower($_SESSION['old-data']['civil-status']) === 'single') || (isset($results['c_status']) && strtolower($results['c_status']) === 'single') ? 'selected' : '' ?>>Single</option>
														<option value="married" <?= (isset($_SESSION['old-data']['civil-status']) && strtolower($_SESSION['old-data']['civil-status']) === 'married') || (isset($results['c_status']) && strtolower($results['c_status']) === 'married') ? 'selected' : '' ?>>Married</option>
													</select>
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['civil-status'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['civil-status']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="control">
													<label for="religion" class="form-label text-secondary">Religion <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['religion']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="religion" name="religion" placeholder="Enter your religion" value="<?= isset($_SESSION['old-data']['religion']) ? htmlspecialchars($_SESSION['old-data']['religion']) : (isset($results['religion']) ? htmlspecialchars($results['religion']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['religion'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['religion']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="control">
													<label for="email" class="form-label text-secondary">Email <span class="text-danger">*</span></label>
													<input type="email" class="form-control <?= isset($_SESSION['errors']['email']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="email" name="email" placeholder="Enter your email" value="<?= isset($_SESSION['old-data']['email']) ? htmlspecialchars($_SESSION['old-data']['email']) : (isset($results['email_add']) ? htmlspecialchars($results['email_add']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['email'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['email']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-md-3 mb-3">
												<div class="control">
													<label for="contact-number" class="form-label text-secondary">Contact Number <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['contact-number']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="contact-number" name="contact-number" placeholder="Enter your contact number" value="<?= isset($_SESSION['old-data']['contact-number']) ? htmlspecialchars($_SESSION['old-data']['contact-number']) : (isset($results['cp_number']) ? htmlspecialchars($results['cp_number']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['contact-number'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['contact-number']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
									<fieldset>
										<legend class="text-black-50">Emergency Contact Person</legend>
										<div class="row">
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="contact-person-name" class="form-label text-secondary">Contact Name <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['contact-person-name']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="contact-person-name" name="contact-person-name" placeholder="Enter your  contact person name" value="<?= isset($_SESSION['old-data']['contact-person-name']) ? htmlspecialchars($_SESSION['old-data']['contact-person-name']) : (isset($results['cpce']) ? htmlspecialchars($results['cpce']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['contact-person-name'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['contact-person-name']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="contact-person-number" class="form-label text-secondary">Contact Mobile Number <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['contact-person-number']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="contact-person-number" name="contact-person-number" placeholder="Emergency Contact Person Number" value="<?= isset($_SESSION['old-data']['contact-person-number']) ? htmlspecialchars($_SESSION['old-data']['contact-person-number']) : (isset($results['cpce_cp_number']) ? htmlspecialchars($results['cpce_cp_number']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['contact-person-number'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['contact-person-number']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
									<div class="card-footer d-flex justify-content-end">
										<div class="row">
											<div class="col-12">
												<button type="submit" name="admin-update" class="btn text-white" style="background-color: rgb(32, 85, 67);" value="Submit">Submit</button>
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

<script>
	const selectedCollege = <?= json_encode($selectedCollege); ?>;
	const selectedCourse = <?= json_encode($selectedCourse); ?>;
	const selectedMajor = <?= json_encode($selectedMajor); ?>;

	$(document).ready(function() {
		const collegeDropdown = $('#college');
		const courseDropdown = $('#course');
		const majorDropdown = $('#major');

		// Function to populate courses based on selected college
		function populateCourses() {
			const college = collegeDropdown.find(':selected').data('id');
			courseDropdown.html('<option value="" disabled selected>-- select course --</option>'); // Clear previous options

			if (college) {
				$.ajax({
					url: '../query.php',
					type: 'POST',
					data: {
						colleges: college,
						college: true
					},
					dataType: 'json',
					success: function(data) {
						$.each(data, function(index, item) {
							const option = new Option(item.label, item.value);
							$(option).attr('data-id', item.data_id);

							// Check if this option matches the selectedCourse
							if (item.value == selectedCourse) {
								$(option).prop('selected', true);
							}
							courseDropdown.append(option);
						});

						// Trigger change on course dropdown if there's a pre-selected course
						if (selectedCourse) {
							courseDropdown.trigger('change');
						}
					},
					error: function(xhr, status, error) {
						console.error('Error fetching courses:', error);
					}
				});
			}
		}

		// Function to populate majors based on selected course
		function populateMajors() {
			const course = courseDropdown.find(':selected').data('id');
			majorDropdown.html('<option value="" disabled selected>-- select major --</option>'); // Clear previous options

			if (course) {
				$.ajax({
					url: '../query.php',
					type: 'POST',
					data: {
						courses: course,
						course: true
					},
					dataType: 'json',
					success: function(data) {
						$.each(data, function(index, item) {
							const option = new Option(item.label, item.value);
							$(option).attr('data-id', item.data_id);

							// Check if this option matches the selectedMajor
							if (item.value == selectedMajor) {
								$(option).prop('selected', true);
							}
							majorDropdown.append(option);
						});
					},
					error: function(xhr, status, error) {
						console.error('Error fetching majors:', error);
					}
				});
			}
		}

		// Populate courses when college changes
		collegeDropdown.on('change', populateCourses);

		// Populate majors when course changes
		courseDropdown.on('change', populateMajors);

		// Trigger college dropdown to load courses on page load if there's a selected college
		if (selectedCollege) {
			collegeDropdown.val(selectedCollege).trigger('change');
		}
	});
</script>

<?php
require "Partials/footer.php";
unset($_SESSION['old-data']);
unset($_SESSION['errors']);
unset($_SESSION['response']);
?>