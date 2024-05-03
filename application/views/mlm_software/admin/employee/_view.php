<!-- start page title -->
<div class="row">
	<div class="col-12">
		<div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
			<h4 class="mb-sm-0 font-size-16 fw-bold"><?php echo $title ?></h4>
			<div class="page-title-right">
				<ol class="breadcrumb m-0">
					<li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
					<li class="breadcrumb-item active"><?php echo $breadcrums ?></li>
				</ol>
			</div>
		</div>
	</div>
</div>
<?php //print_r($getCreatedBy);
if ($getEmpDetails['photo']) {
	$getImg = $this->baseUrl . $getEmpDetails['photo'];
} else {
	$getImg = $this->baseUrl . 'uploads/emp/no_profile.png';
}
if ($getEmpDetails['status'] == '1') {
	$statusClr = '#049504';
	$flshMsg = 'Active';
	$backClr = 'background-color:rgba(179, 227, 179, 0.4)';
} else {
	$statusClr = '#970000';
	$flshMsg = 'Deactive';
	$backClr = 'background-color:rgba(176, 137, 137,0.4)';
}

?>

<!----------------------------Edit Member strt----------------------------->
<div class="row mb-4">
	<div class="col-xl-4">
		<div class="card">
			<div class="card-body">
				<div>
					<div class="clearfix"></div>

					<div class="text-center bg-pattern">

						<img src="<?php echo $getImg; ?>" alt="Profile Image" class="avatar-xl img-thumbnail rounded-circle mb-3" style="border:1px solid #bbcfdb;">


						<h4 class="text-primary mb-2"><?php echo $getEmpDetails['name']; ?></h4>
						<h5 class="text-muted font-size-13 mb-3">ID. <?php echo $getEmpDetails['user_code']; ?></h5>
						<h6 class="text-muted font-size-13 mb-3" style="margin-top:-10px;"><span style="color:<?php echo $statusClr . ';' . $backClr; ?>;padding: 0px 10px 2px 10px;"><?php echo $flshMsg; ?></span></h6>
						<div class="text-center">
							<a href="mailto:<?php echo $getEmpDetails['email'] ?>" class="btn btn-success me-2 waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-email-outline me-1"></i>Send Mail</a>
							<a href="tel:<?php echo $getEmpDetails['mobile'] ?>" class="btn btn-primary waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-phone-outline me-1"></i>Phone Call</a>
						</div>
					</div>
				</div>
				<hr class="my-4">
				<div class="table-responsive" style=" <?php if ($this->lgCat == '1') {
															echo 'margin-bottom: 18px';
														} else {
															echo 'margin-bottom: 67px';
														} ?> ">
					<h5 class="font-size-16 mb-3" style="color:#008288;"><i class="bx bx-detail"></i> Personal Information</h5>

					<div class="mi_pos">
						<p class="mb-1 text-muted font-size-13"><i class="bx bx-calendar "></i> Designation :
							<span><?php print_r($design['des_title']); ?></span>
						</p>
					</div>



					<div>
						<p class="mb-1 text-muted font-size-13"><i class="bx bx-calendar "></i> Date of joining :</p>
						<h5 class="font-size-14"><?php echo date('d-M-Y', strtotime($getEmpDetails['created_at'])); ?></h5>
					</div>
					<?php if ($this->lgCat == '1') { ?>
						<div>
							<p class="mb-1 text-muted font-size-13"><i class="bx  bx bx-user-pin "></i> Created By :</p>
							<h5 class="font-size-14"><?php echo $getCreatedBy['name']; ?></h5>
						</div><?php } ?>
					<div class="mt-3">
						<p class="mb-1 text-muted font-size-13"><i class="bx bx-calendar "></i> Last Modified On :</p>
						<h5 class="font-size-14"><?php echo $getEmpDetails['update_at'] ?></h5>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-8">
		<div class="card">
			<div class="mt-4">
				<ul class="nav nav-tabs nav-tabs-custom" role="tablist" style="margin-top: -25px;padding: 10px 0px 0px 10px;">
					<li class="nav-item" role="presentation">
						<a class="nav-link active" data-bs-toggle="tab" href="#profile_det" role="tab" aria-selected="true">
							<span class="d-block d-sm-none"><i class="bx bx-user-circle"></i></span><span class="d-none d-sm-block">
								<!--<span class="miprIcn"><i class="bx bx-user-circle"></i></span>--> Profile</span>
						</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" data-bs-toggle="tab" href="#payroll_det" role="tab" aria-selected="false" tabindex="-1">
							<span class="d-block d-sm-none"><i class="bx bx-money"></i></span>
							<span class="d-none d-sm-block"> <!--<span class="miprIcn"><i class="bx bx-money"></i></span> -->Payroll</span>
						</a>
					</li>
				</ul>
				<div class="tab-content p-3 text-muted">
					<div class="tab-pane active" id="profile_det" role="tabpanel">
						<div class="amiCrdTitle"><i class="mdi mdi-account-circle-outline"></i> Basic Information</div>
						<div class="card-body p-4">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<span class="form-control"><?php echo $getEmpDetails['name']; ?></span>
										<label for="Name">Name.</label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<span class="form-control"><?php echo date('d-M-Y', strtotime($getEmpDetails['dob'])); ?></span>
										<label for="dob">Date Of Birth.</label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<span class="form-control"><?php if ($getEmpDetails['mobile']) {
																		echo $getEmpDetails['mobile'];
																	} else {
																		echo 'N/A';
																	} ?></span>
										<label for="mo_nu">Mobile Number.</label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3"><span class="form-control"><?php if ($getEmpDetails['email']) {
																									echo $getEmpDetails['email'];
																								} else {
																									echo 'N/A';
																								} ?></span>
										<label for="pan_no">Email Id.</label>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<span class="form-control"><?php if ($getEmpDetails['adhar_no']) {
																		echo $getEmpDetails['adhar_no'];
																	} else {
																		echo 'N/A';
																	} ?></span>
										<label for="aadhaar_no">Aadhar No.</label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<span class="form-control"><?php if ($getEmpDetails['pan_no']) {
																		echo $getEmpDetails['pan_no'];
																	} else {
																		echo 'N/A';
																	} ?></span>
										<label for="pan_no">PAN No.</label>
									</div>
								</div>

								<div class="col-lg-12">
									<div class="form-floating mb-3">
										<span class="form-control" style="height:85px;"><?php if ($getEmpDetails['address']) {
																							echo $getEmpDetails['address'];
																						} else {
																							echo 'N/A';
																						} ?></span>
										<label for="State">Address.</label>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-floating mb-3"><span class="form-control">
											<?php if ($getStateCity->st_name) {
												echo $getStateCity->st_name;
											} else {
												echo 'N/A';
											} ?>
										</span><label for="State">State.</label>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-floating mb-3">
										<span class="form-control"><?php if ($getStateCity->dist_name) {
																		echo $getStateCity->dist_name;
																	} else {
																		echo 'N/A';
																	} ?></span>
										<label for="district">District.</label>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-floating mb-3">
										<span class="form-control"><?php if ($getEmpDetails['zipcode']) {
																		echo $getEmpDetails['zipcode'];
																	} else {
																		echo 'N/A';
																	} ?></span>
										<label for="zipCode">Zipcode.</label>
									</div>
								</div>
							</div>
						</div>
						<?php if ($this->lgCat == '1') { ?>
							<div class="card-header amiCrdTitle"><i class="bx bx-cog"></i> Security Information</div>
							<div class="card-body p-4">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-floating mb-3">
											<span class="form-control"><?php echo $getCreatedBy['user_code']; ?></span>
											<label for="crtedBy">Created Employee Code</label>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-floating mb-3">
											<span class="form-control"><?php echo $getCreatedBy['name']; ?></span>
											<label for="crtedBy">Created By</label>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-floating mb-3">
											<span class="form-control"><?php echo date('d-M-Y', strtotime($getEmpDetails['created_at'])); ?></span>
											<label for="dob">Create Date</label>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-floating mb-3">
											<span class="form-control">
												<div class="showPass" onclick="visiblePass('<?php echo $getEmpDetails['id'] ?>')" id="pass<?php echo $getEmpDetails['id'] ?>">
													<div class="passwrd"></div>
												</div>
											</span>
											<label for="passw">Password.</label>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
						<a href="<?php echo base_url(); ?>mlm_software/admin/employee/manage" class="btn btn-outline-dark waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
						<a href="<?php echo base_url(); ?>mlm_software/admin/employee/edit/<?php echo urlencode(base64_encode($getEmpDetails['id'])); ?>" class="btn btn-outline-primary waves-effect waves-light" style="float:right;"><i class="bx bx-edit"></i> Edit</a>


					</div>
					<div class="tab-pane" id="payroll_det" role="tabpanel">

						<div class="row">
							<form method="post" id="search_emp_salary">
								<div class="col-xl-12">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-floating mb-3">
												<input type="text" name="tnxId" id="tnxId" class="form-control"><label for="empId"><i class="bx bx-transfer-alt fntClr"></i> Transaction Id </label>
											</div>
										</div>
										<div class="col-lg-6">
											<?php $monthArr = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"); ?>
											<div class="form-floating mb-3">
												<select class="form-select" name="month" id="month">
													<option value="">---- Select One ----</option>
													<?php $ct = 0;
													foreach ($monthArr as $key) {
														++$ct; ?>
														<option value="<?php echo $ct; ?>"><?php echo $key; ?></option>
													<?php  } ?>
												</select>
												<label for="month"><i class="mdi mdi-calendar-arrow-left fntClr"></i> Month</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-floating mb-3">
												<input type="date" name="strtDt" id="strtDt" class="form-control"><label for="strtDt"><i class="mdi mdi-calendar-account fntClr"></i> Start Date</label>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-floating mb-3">
												<input type="date" name="endDt" id="endDt" class="form-control"><label for="endDt"><i class="mdi mdi-calendar-account fntClr"></i> End Date </label>
											</div>
										</div>
									</div>
									<a href="<?php echo base_url(); ?>mlm_software/admin/employee/manage" class="btn btn-outline-dark  waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
									<button type="submit" class="btn btn-raised btn-outline-primary srchBtn pull-right" onclick="return get_search(repEmpSalDetails,'#search_emp_salary','#emp_salary_list')">
										<i class="mdi mdi-account-search"></i> Search</button>
								</div>
							</form>
						</div>
						<div class="row" style="margin-top:20px;">
							<div class="table-responsive1">
								<div id="search_data">
									<table class="table align-middle table-striped table-nowrap mb-0" id="emp_salary_list" style="width:100%;">
										<thead class="amiCrdTitle">
											<tr>
												<th>S.No</th>
												<th>Tnx Id</th>
												<th>Salary</th>
												<th>Month</th>
												<th>Pay Date</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>


						<input id="miId" type="hidden" value="<?php echo $getEmpDetails['id']; ?>" />

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!----------------------------edit Member end------------------------------>
<script src="<?php echo base_url() ?>media/js/mlm_software/admin/employee/employee.js"></script>