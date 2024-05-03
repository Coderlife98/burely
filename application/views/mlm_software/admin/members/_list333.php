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
<input type="hidden" id="target" value="<?php echo $target; ?>" />
<!----------------------------Edit Frenchise strt----------------------------->
<div class="row mb-4">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header ami_cmn">
				<span><i class="mdi mdi-account-circle-outline"></i></span> Search <?php echo $memberTyp; ?> details
				<a href="<?php //echo base_url();
							?>" class="ititle miMr" title="Back to list"><i class="bx bx-arrow-back"></i></a>
			</div>
			<div class="card-body">
				<form method="post" id="search_member">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-lg-4">
								<div class="form-floating mb-3">
									<input type="text" name="userIdA" id="userIdA" class="form-control" maxlength="8">
									<label for="userId"><i class="bx bxs-user fntClr"></i> <?php echo $memberTyp; ?> Id</label>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-floating mb-3">
									<input type="text" name="mobileN" id="mobileN" class="form-control">
									<label for="mobileN"><i class="fas fa-mobile fntClr"></i> Mobile Number</label>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-floating mb-3">
									<input type="text" name="emailId" id="emailId" class="form-control">
									<label for="emailId"><i class="mdi mdi-email fntClr"></i> Email Id </label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="date" name="strtDt" id="strtDt" class="form-control">
									<label for="strtDt"><i class="mdi mdi-calendar-account fntClr"></i> Join Start Date </label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="date" name="endDt" id="endDt" class="form-control">
									<label for="endDt"><i class="mdi mdi-calendar-account fntClr"></i> Join End Date </label>
								</div>
							</div>
						</div>
						<a href="<?php echo base_url(); ?>mlm_software/admin/partners/manage" class="btn btn-outline-dark  waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
						<button type="submit" class="btn btn-outline-primary waves-effect waves-light pull-right" onclick="return get_search(reportMemTable,'#search_member','#member_list')"><i class="mdi mdi-account-search"></i> Search </button>
					</div>
				</form>
			</div>
		</div>

		<div class="card">
			<div class="mitbl">
				<i class="bx bxs-group miU"></i>
				<?php echo $memberTyp; ?> List
				<span><i class="far fa-file-excel miUexl"></i><i class="far fa-file-pdf miUpdf"></i><i class="fas fa-print miUprint"></i>
				</span>

			</div>
			<div class="card-body">
				<div class="table-responsive">
					<div id="search_data">
						<table id="member_list" class="table table-striped table-hover">
							<thead class="hdr_clr">
								<tr>
									<th>S No.</th>
									<th><?php echo $memberTyp; ?> Id.</th>
									<th>Name</th>
									<th>Mobile</th>
									<th>Email</th>
									<th>Address</th>
									<th style="text-align:center;">Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteModel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float:right;"></button>
				<div class="delMsg"> &nbsp;</div>
				<div class="actnData">&nbsp; </div>
				<div id="mdlFtrBtn">
					<input type="hidden" id="cnfDel_id">
					<a href="javascript:void(0)" id="deleteCnfrMtn" class="btn btn-outline-danger waves-effect waves-light pull-right">Confirm Delete <i class="bx bx-trash"></i></a>
					<button type="button" class="btn btn-outline-dark pull-right" data-bs-dismiss="modal"><i class="bx bx-arrow-back"></i> Back </button>
				</div>
			</div>
		</div>
	</div>
</div>










<!----------------------------edit Frenchise end------------------------------>
<script src="<?php echo base_url() ?>media/js/mlm_software/admin/partners.js"></script>