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

		$query = "SELECT l_name, f_name, ex_name, m_name, HEI_name, type_of_HEI, b_date, sex, st_brgy, municipality, province, region, 
                c_status, religion, email_add, cp_number, college, y_level, course, major, 
                serial_number, cpce, cpce_cp_number, nstp_component, nstp_grad_year, created_at
                FROM tbl_20_columns_lts WHERE std_id = :id";

		$stmt = $pdo->prepare($query);
		$stmt->bindParam(':id', $std_id, PDO::PARAM_INT);
		$stmt->execute();
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}
}


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
						<li class="breadcrumb-item"><a href="lts.php">LTS</a></li>
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
						<form id="admin-edit-form" action="../query.php" method="post" novalidate>
							<input type="hidden" id="student-type" name="student-type" value="LTS">
							<input type="hidden" id="std_id" name="std_id" value="<?= htmlspecialchars($_GET['std_id']) ?>">
							<div class="card">
								<div class="card-header bg-success">
									<h4 class="text-white">Update lts student data</h4>
								</div>
								<div class="card-body">
									<fieldset>
										<legend class="text-black-50">Graduation year/Serial number/Region</legend>
										<div class="row">
											<div class="col-lg-4 mb-3">
												<div class="control">
													<label for="graduation-year" class="form-label text-secondary">NSTP graduation year <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['graduation-year']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="graduation-year" name="graduation-year" placeholder="Enter your NSTP graduation year" value="<?= isset($_SESSION['old-data']['graduation-year']) ? htmlspecialchars($_SESSION['old-data']['graduation-year']) : (isset($results['nstp_grad_year']) ? htmlspecialchars($results['nstp_grad_year']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['graduation-year'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['graduation-year']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-lg-4 mb-3">
												<div class="control">
													<label for="serial-number" class="form-label text-secondary">NSTP serial number <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['serial-number']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="serial-number" name="serial-number" placeholder="Enter your NSTP serial number" value="<?= isset($_SESSION['old-data']['serial-number']) ? htmlspecialchars($_SESSION['old-data']['serial-number']) : (isset($results['serial_number']) ? htmlspecialchars($results['serial_number']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['serial-number'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['serial-number']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-lg-4 mb-3">
												<div class="control">
													<label for="region" class="form-label text-secondary">Region <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['region']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="region" name="region" placeholder="Enter you region" value="<?= isset($_SESSION['old-data']['region']) ? htmlspecialchars($_SESSION['old-data']['region']) : (isset($results['region']) ? htmlspecialchars($results['region']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['region'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['region']); ?>
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
													<label for="type-of-hei" class="form-label text-secondary">Type of HEIs <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['type-of-hei']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="type-of-hei" name="type-of-hei" placeholder="Type of HEI" value="<?= isset($_SESSION['old-data']['type-of-hei']) ? htmlspecialchars($_SESSION['old-data']['type-of-hei']) : (isset($results['type_of_HEI']) ? htmlspecialchars($results['type_of_HEI']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['type-of-hei'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['type-of-hei']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
									<!-- <fieldset>
                    <legend class="text-black-50">Birthday and Gender</legend>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <div class="control">
                          <label for="birthday" class="form-label text-secondary">Birthday</label>
                          <input type="date" class="form-control <?= isset($errors['birthday']) ? 'is-invalid' : '' ?>" id="birthday" name="birthday">
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($errors['birthday'])): ?>
                              <?= htmlspecialchars($errors['birthday']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="control">
                          <label for="gender" class="form-label text-secondary">Gender</label>
                          <select class="form-select <?= isset($errors['gender']) ? 'is-invalid' : '' ?>" id="gender" name="gender">
                            <option value="">Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                          </select>
                          <div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
                            <?php if (isset($errors['gender'])): ?>
                              <?= htmlspecialchars($errors['gender']); ?>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset> -->
									<fieldset>
										<legend class="text-black-50">Birthday and Gender</legend>
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
													<label for="gender" class="form-label text-secondary">Gender <span class="text-danger">*</span></label>
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
													<label for="contact-number" class="form-label text-secondary">Contact Number <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['contact-number']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="contact-number" name="contact-number" placeholder="Enter your contact number" value="<?= isset($_SESSION['old-data']['contact-number']) ? htmlspecialchars($_SESSION['old-data']['contact-number']) : (isset($results['cp_number']) ? htmlspecialchars($results['cp_number']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['contact-number'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['contact-number']); ?>
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
										</div>
									</fieldset>
									<fieldset>
										<legend class="text-black-50">College Information</legend>
										<div class="row">
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="college" class="form-label text-secondary">College <span class="text-danger">*</span></label>
													<select class="custom-select <?= isset($_SESSION['errors']['college']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="college" name="college" value="<?= isset($_SESSION['old-data']['college']) ? htmlspecialchars($data['college']) : '' ?>">
														<!-- Make the options dynamic -->
														<option value="" disabled <?= !isset($_SESSION['old-data']['college']) && !isset($results['college']) ? 'selected' : '' ?>>College</option>
														<option value="agriculture" <?= (isset($_SESSION['old-data']['college']) && strtolower($_SESSION['old-data']['college']) === 'agriculture') || (isset($results['college']) && strtolower($results['college']) === 'agriculture') ? 'selected' : '' ?>>AGRICULTURE</option>
														<option value="arts & science" <?= (isset($_SESSION['old-data']['college']) && strtolower($_SESSION['old-data']['college']) === 'arts & science') || (isset($results['college']) && strtolower($results['college']) === 'arts & science') ? 'selected' : '' ?>>ARTS & SCIENCE</option>
														<option value="education" <?= (isset($_SESSION['old-data']['college']) && strtolower($_SESSION['old-data']['college']) === 'education') || (isset($results['college']) && strtolower($results['college']) === 'education') ? 'selected' : '' ?>>EDUCATION</option>
														<option value="engineering" <?= (isset($_SESSION['old-data']['college']) && strtolower($_SESSION['old-data']['college']) === 'engineering') || (isset($results['college']) && strtolower($results['college']) === 'engineering') ? 'selected' : '' ?>>ENGINEERING</option>
														<option value="industrial technology" <?= (isset($_SESSION['old-data']['college']) && strtolower($_SESSION['old-data']['college']) === 'industrial technology') || (isset($results['college']) && strtolower($results['college']) === 'industrial technology') ? 'selected' : '' ?>>INDUSTRIAL TECHNOLOGY</option>
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
										<div class="row">
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="course" class="form-label text-secondary">Program/Course <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['course']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="course" placeholder="Enter your course" name="course" value="<?= isset($_SESSION['old-data']['course']) ? htmlspecialchars($_SESSION['old-data']['course']) : (isset($results['course']) ? htmlspecialchars($results['course']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['course'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['course']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-md-6 mb-3">
												<div class="control">
													<label for="major" class="form-label text-secondary">Major <span class="text-danger">*</span></label>
													<input type="text" class="form-control <?= isset($_SESSION['errors']['major']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="major" placeholder="Enter Major" name="major" value="<?= isset($_SESSION['old-data']['major']) ? htmlspecialchars($_SESSION['old-data']['major']) : (isset($results['major']) ? htmlspecialchars($results['major']) : '') ?>">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['major'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['major']); ?>
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
													<input type="text" class="form-control <?= isset($_SESSION['errors']['contact-person-name']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="contact-person-name" name="contact-person-name" placeholder="Emergency Contact Person Name" value="<?= isset($_SESSION['old-data']['contact-person-name']) ? htmlspecialchars($_SESSION['old-data']['contact-person-name']) : (isset($results['cpce']) ? htmlspecialchars($results['cpce']) : '') ?>">
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
									<fieldset>
										<legend class="text-black-50">Login Credential</legend>
										<div class="row">
											<div class="col-lg-6 mb-3">
												<div class="control">
													<label for="password" class="form-label text-secondary">Password</label>
													<input type="password" class="form-control <?= isset($_SESSION['errors']['password']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="password" name="password" placeholder="Enter your Password (leave empty to keep current)">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['password'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['password']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
											<div class="col-lg-6 mb-3">
												<div class="control">
													<label for="confirm-password" class="form-label text-secondary ">Confirm Password</label>
													<input type="password" class="form-control <?= isset($_SESSION['errors']['confirm-password']) ? 'is-invalid' : (isset($_SESSION['old-data']) ? 'is-valid' : '') ?>" id="confirm-password" name="confirm-password" placeholder="Confirm Password (leave empty to keep current)">
													<div class="error-container fs-6 text-danger" style="font-size: 12px !important;">
														<?php if (isset($_SESSION['errors']['confirm-password'])): ?>
															<?= htmlspecialchars($_SESSION['errors']['confirm-password']); ?>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
									</fieldset>
									<div class="card-footer d-flex justify-content-end">
										<div class="row">
											<div class="col-12">
												<button type="submit" name="admin-edit-lts" class="btn btn-success" value="Submit">Submit</button>
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