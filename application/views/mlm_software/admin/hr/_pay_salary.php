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
<div class="card">
	<div class="card-header ami_cmn">
		<span><i class="bx bx-rupee"></i></span> Search Employe For Salary
		
		<a href="javascript:void(0)" class="ititle miMr" id="addEmpSalry"  title="Add New Designation"><i class="fas fa-plus"></i></a>
	</div>
	<div class="card-body">
		<form method="post" id="search_salary">
			<div class="col-xl-12">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="text" name="empId" id="empId" value="" class="form-control">
							<label for="empId"><i class="bx bxs-user fntClr"></i> Employee Id </label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="text" name="empName" id="empName" value="" class="form-control">
							<label for="empName"><i class="bx bxs-user fntClr"></i> Employee Name</label>
						</div>
					</div>

				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="date" name="strtDt" id="strtDt" value="" class="form-control">
							<label for="strtDt"><i class="mdi mdi-calendar-account fntClr"></i> Join Start Date </label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="date" name="endDt" id="endDt" value="" class="form-control">
							<label for="endDt"><i class="mdi mdi-calendar-account fntClr"></i> Join End Date </label>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url(); ?>mlm_software/admin/employee/manage" class="btn btn-outline-dark  waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>

				<button type="submit" class="btn btn-raised btn-outline-primary srchBtn pull-right" onclick="return get_search(repEmpSal,'#search_salary','#emp_salary')">
					<i class="mdi mdi-account-search"></i> Search</button>


			</div>
		</form>
	</div>
</div>
<div class="card">
<div class="mitbl">
	<i class="bx bx-money miU"></i>
	Salary Transaction List
	<span><i class="far fa-file-excel miUexl"></i><i class="far fa-file-pdf miUpdf"></i><i class="fas fa-print miUprint"></i>
	</span>
</div>
	<div class="card-body">
		<!-------------------------------------------->
		<!-- amoli modal dialog -->
		<div class="modal fade" id="salary_delete" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float:right;"></button>
						<div class="delMsg"> delete Mesage</div>
						<div class="actnData">&nbsp; </div>
						<div id="mdlFtrBtn">
							<input type="hidden" id="cnfDel_id">
							<a href="javascript:void(0)" class="btn btn-outline-danger waves-effect waves-light pull-right" id="deleteEmpSal">Confirm Delete <i class="bx bx-trash"></i></a>
							<button type="button" class="btn btn-outline-dark pull-right" data-bs-dismiss="modal"><i class="bx bx-arrow-back"></i> Back </button>
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="modal fade" id="salary_approved" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalToggleLabel">
							<span style="background-color: #008288;padding: 5px 8px 3px 8px;border-radius: 25px; color:#fff;"><i class="bx bx-user-pin"></i></span>
							<span class="pgTitle" style="color:#008288">Add New Designation</span>
						</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div> <input type="hidden" id="py_id"><input type="hidden" id="miActn" value="edit">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div id="getMsgSuccess" style="display:none;"> Mesage</div>
							</div>

							<div class="col-lg-12">
								<div class="form-floating mb-3">
									<select class="form-select empSelectR" name="empId" id="empId">
										<option value="">---- Select One ----</option>
										<?php if ($employee) {
											foreach ($employee as $list) { ?>
												<option value="<?php echo $list['id']; ?>"><?php echo $list['user_code'] . ' ( ' . $list['name'] . ' )'; ?></option>
										<?php }
										} ?>
									</select>
									<label for="paymntSts"><i class="bx bx-user-pin fntClr"></i> Employee</label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3" id="userErr"><input type="text" name="salaryAmt" class="form-control flatpickr-input active" id="salaryAmt">
									<label for="salaryAmt"><i class="bx bx-rupee fntClr"></i> Salary Amount</label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3"><input type="date" name="PaidDt" class="form-control flatpickr-input active" id="PaidDt">
									<label for="strtPyDt"><i class="mdi mdi-calendar-arrow-left fntClr"></i> Salary Pay Date</label>
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
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<select class="form-select" name="year" id="year">
										<option value="">---- Select One ----</option>
										<?php $frYr = date('Y');
										$toYr = date('Y') + 5;
										for ($x = $frYr; $x <= $toYr; $x++) {
											echo '<option value="' . $x . '">' . $x . '</option>';
										} ?>
									</select>
									<label for="month"><i class="mdi mdi-calendar-arrow-left fntClr"></i> Salary Year</label>
								</div>
							</div>
							<?php if ($this->lgCat == '1') { ?>
								<div class="col-lg-6 createB">
									<div class="form-floating mb-3">
										<span class="form-control miCrt" id="createBy">&nbsp;</span>
										<label for="createBy"><i class="bx bxs-user fntClr"></i> Created By </label>
									</div>
								</div>
								<div class="col-lg-6 createB">
									<div class="form-floating mb-3">
										<span class="form-control miCrt" id="createDt">&nbsp;</span>
										<label for="createDt"><i class="mdi mdi-calendar-account fntClr"></i> Create Date </label>
									</div>
								</div>
								<div class="col-lg-6 mdfy">
									<div class="form-floating mb-3">
										<span class="form-control miDfy" id="modifiedBy">&nbsp;</span>
										<label for="modifiedBy"><i class="bx bxs-user fntClr"></i> Modified By </label>
									</div>
								</div>
								<div class="col-lg-6 mdfy">
									<div class="form-floating mb-3">
										<span class="form-control miDfy" id="modifyDt">&nbsp;</span>
										<label for="modifyDt"><i class="mdi mdi-calendar-account fntClr"></i> Modified Date </label>
									</div>
								</div>
							<?php } ?>






						</div>
					</div>
					<div class="modal-footer">
						<span class="btn btn-outline-dark" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-arrow-back"></i> Back</span>
						<button class="btn btn-outline-primary ActnCmdByAmi" id="proccedSal"><i class="bx bx-save"></i> Update</button>
					</div>
				</div>
			</div>
		</div>

		<!-------------------------------------------->
		<div class="table-responsive">
			<div id="search_data">
				<table class="table align-middle table-striped table-nowrap mb-0" id="emp_salary">
					<thead class="hdr_clr">
						<tr>
							<th>S.No</th>
							<th>Tnx Id</th>
							<th>Emp Id</th>
							<th>Employee Name</th>
							<th>Salary</th>
							<th>Month</th>
							<th>Pay Date</th>
							<th style="text-align:center;">Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>




<script src="<?php echo base_url() ?>media/js/mlm_software/admin/employee/employee.js"></script>