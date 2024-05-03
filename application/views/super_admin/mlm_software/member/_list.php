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
<form method="post" id="search">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header header-green"><i class="mdi mdi-account-search-outline"></i> Search Member</div>
			<div class="card-body p-4" style="margin-bottom:-10px;">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="text" name="userIdA" id="userIdA" value="" class="form-control" maxlength="8">
							<label for="userId"><i class="bx bxs-user fntClr"></i> User ID / Franchisee ID(Whom to issue)</label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="text" name="mobileN" id="mobileN" value="" class="form-control">
							<label for="mobileN"><i class="fas fa-mobile fntClr"></i> Mobile Number ( Registered )</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="text" name="emailId" id="emailId" value="" class="form-control">
							<label for="emailId"><i class="mdi mdi-email fntClr"></i> Email Id </label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="text" name="spId" id="spId" value="" class="form-control">
							<label for="emailId"><i class="mdi mdi-crown fntClr"></i> Sponsor Id </label>
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
		<a href="<?php echo base_url(); ?>mlm_software/admin/pin/manage" class="btn btn-outline-dark  waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
		<button type="submit" class="btn btn-outline-primary waves-effect waves-light pull-right" style="float:right;"><i class="mdi mdi-account-search"></i> Search </button>
			</div>
		</div>

	</div>
</form>
<div class="card">
    <div class="card-body">	
	  <div class="table-responsive">
		<div id="search_data">  
		<table id="member_table" class="table align-middle table-striped table-nowrap mb-0">
		<thead class="header-green">
				<tr>
					<!--<th>S.No</th>-->
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Sponser Id</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>
		</div>
		</div>
    </div>
</div>
<script src="<?php echo base_url() ?>media/js/super_admin/mlm_software/member.js"></script>
