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

<?php //print_r($getEmpDetails);
if ($getEmpDetails['photo']) {
	$getImg = $this->baseUrl . 'uploads/emp/thumb/' . $getEmpDetails['photo'];
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

<!----------------------------Edit Employee strt----------------------------->
<div class="row mb-4">

	<div class="col-xl-12">
		<form id="save_data" method="post">
			<div class="card">		
	<div class="miArv">
		<i class="mdi mdi-account-circle-outline miAr"></i> Basic Information
		<span><a href="<?php echo base_url('super_admin/dashboard')?>" class="miArvBack"><i class="bx bx-arrow-back"></i></a></span>
	</div>
				
				
				<div class="card-body p-4" style="margin-bottom: -10px;">
					<div class="row">
						<div class="col-lg-4">
							<div class="form-floating mb-3"><input type="text" readonly="" name="emp_code" id="emp_code" value="<?php if ($empId) {
																																	echo $empId;
																																} else {
																																	set_value('emp_code');
																																} ?>" class="form-control">
								<label for="empIdAsRl" id="empIdAsRl">Employee Id.</label>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-floating mb-3">
								<select class="form-select empSelectR" name="roleAs" id="roleAs">
									<option value="">---- Select One ----</option>
									<option value="2">Employee</option>
									<?php if ($this->lgCat == '1') { ?><option value="1">Super Admin</option><?php } ?>
								</select>
								<label for="roleAs">Role As.</label>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-floating mb-3">
								<select class="form-select" name="designsn" id="designsn">
									<option value="">---- Select One ----</option>
									<?php
									if ($designation) {
										foreach ($designation as $desig) {
									?>
											<option value="<?php echo $desig['id']; ?>"><?php echo $desig['des_title']; ?></option>
									<?php }
									} ?>
								</select>
								<label for="designsn">Designation As.</label>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-floating mb-3"><input type="text" name="emp_name" id="emp_name" value="<?php if ($getEmpDetails['name']) {
																														echo $getEmpDetails['name'];
																													} else {
																														set_value('emp_name');
																													} ?>" class="form-control">
								<label for="empN">Employee Name. <span class="text-danger">*</span></label>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-floating mb-3">
								<input type="date" value="<?php echo $getEmpDetails['dob']; ?>" name="date_of_birth" class="form-control flatpickr-input active" id="date_of_birth">
								<label for="Name">Date Of Birth</label>
								<input type="hidden" class="form-control" id="id" name="id" value="<?php echo urlencode(base64_encode($getEmpDetails['id'])); ?>">
								<input type="hidden" class="form-control" id="memImg" name="memImg" value="<?php echo urlencode(base64_encode($getEmpDetails['photo'])); ?>">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-floating mb-3">
								<input type="text" value="<?php if ($getEmpDetails['mobile']) {
																echo $getEmpDetails['mobile'];
															} else {
																set_value('mob_nu');
															} ?>" class="form-control" id="mob_nu" name="mob_nu" oninput="this.value = this.value.replace(/[^0-9]/g,'').replace(/(\  *?)\  */g, '$1');" maxlength="10">
								<label for="mob_nu">Mobile Number.<span class="text-danger">*</span></label>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-floating mb-3">
								<input type="text" value="<?php if ($getEmpDetails['email']) {
																echo $getEmpDetails['email'];
															} else {
																set_value('emailId');
															} ?>" class="form-control" id="emailId" name="emailId" <?php if ($getEmpDetails['email']) { ?> disabled="disabled" <?php } ?>>
								<label for="emailId">Email Id <span class="text-danger">*</span></label>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-floating mb-3">
								<input type="text" value="<?php if ($getEmpDetails['adhar_no']) {
																echo $getEmpDetails['adhar_no'];
															} else {
																set_value('aadhaar_no');
															} ?>" class="form-control" name="aadhaar_no" id="aadhaar_no" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')" maxlength="12">
								<label for="aadhaar_no">Aadhar No.</label>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-floating mb-3">
								<input type="text" value="<?php if ($getEmpDetails['adhar_no']) {
																echo $getEmpDetails['pan_no'];
															} else {
																set_value('pan_no');
															} ?>" class="form-control" name="pan_no" id="pan_no" maxlength="12">
								<label for="pan_no">PAN No.</label>
							</div>
						</div>

					</div>
				</div>
				<div class="miArv"><i class="bx bx-cog miAr"></i> Communication Information</div>
				<div class="card-body p-4" style="margin-bottom: -10px;">
					<div class="row">

						<div class="col-lg-12">
							<div class="form-floating mb-3">
								<textarea class="form-control" name="address" id="address"><?php if ($getEmpDetails['address']) {
																								echo $getEmpDetails['address'];
																							} else {
																								set_value('address');
																							} ?></textarea>
								<label for="address">Address. <span class="text-danger">*</span></label>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-floating mb-3">
								<select class="form-select empSelectR" name="state" id="state">
									<option value="">--- Select One ---</option>
									<?php if ($getState) {
										foreach ($getState as $list) {
									?><option value="<?php echo $list->id; ?>" <?php if ($list->id == $getEmpDetails['state']) {
																				echo 'selected="selected"';
																			} ?>><?php echo $list->state_cities; ?></option>
									<?php }
									} ?>
								</select>
								<label for="state">State</label>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-floating mb-3">
								<select class="form-select" name="district" id="district">
									<option value="">--- Select One ---</option>
									<?php if ($getCity) {
										foreach ($getCity as $c_list) {
									?><option value="<?php echo $c_list->id; ?>" <?php if ($c_list->id == $getEmpDetails['district']) {
																						echo 'selected="selected"';
																					} ?>><?php echo $c_list->state_cities; ?></option>
									<?php }
									} ?>
								</select>

								<label for="district">District</label>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-floating mb-3">
								<input type="text" value="<?php if ($getEmpDetails['zipcode']) {
																echo $getEmpDetails['zipcode'];
															} else {
																set_value('zipcode');
															} ?>" class="form-control" id="zipcode" name="zipcode">
								<label for="zipcode">Zipcode.<span class="text-danger">*</span></label>
							</div>
						</div>

					</div>
				</div>
				<div class="miArv"><i class="bx bx-cog miAr"></i> Security Information</div>
				<div class="card-body p-4" style="margin-bottom: -10px;">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-floating mb-3">
								<input type="password" value="<?php set_value('password'); ?>" class="form-control" name="password" id="password">
								<label for="password">Password. <span class="text-danger">*</span></label>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-floating mb-3">
								<input type="password" value="<?php set_value('conf_password'); ?>" class="form-control" name="conf_password" id="conf_password">
								<label for="password">Confirm Password. <span class="text-danger">*</span></label>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<a href="<?php echo base_url(); ?>mlm_software/admin/employee/manage" class="btn btn-outline-dark waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
					<button type="submit" class="btn btn-outline-primary waves-effect waves-light" style="float:right;"><i class="bx bx-save"></i> Submit </button>
				</div>
			</div>
		</form>
	</div>
</div>
<!----------------------------edit Employee end------------------------------>

<script src="<?php echo base_url() ?>media/js/mlm_software/admin/employee/employee.js"></script>