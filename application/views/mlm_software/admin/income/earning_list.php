
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


<?php 
	if($action)
	{
	  ?>
<form method="post" id="search_earning">
	<div class="col-xl-12">
		<div class="card">
			
			
			<div class="miArv">
				<i class="mdi mdi-cash-multiple miAr"></i><?php echo ucfirst($action);?> Search Earning
				<span><a href="<?php echo base_url('mlm_software/admin/income/view_earning')?>" class="miArvBack"><i class="bx bx-arrow-back"></i></a></span>
			</div>
			
			<div class="card-body p-4" style="margin-bottom:-10px;">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="text" name="userId" id="userId" value="" class="form-control">
							<label for="tnxId"><i class="bx bx-user-pin fntClr"></i> User Id </label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<select class="form-select" name="paymntSts" id="paymntSts">
								<option value="">---- Select One ----</option>
								<option>ALL</option>
								<option>Paid</option>
								<option>Un-Paid</option>
								<option>Hold</option>
							</select>	
							<label for="paymntSts"><i class="mdi mdi-contactless-payment-circle fntClr"></i> Payment Status</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="date" name="strtDt" id="strtDt" value="" class="form-control">
							<label for="strtDt"><i class="mdi mdi-calendar-account fntClr"></i> Start Date </label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="date" name="endDt" id="endDt" value="" class="form-control">
							<label for="endDt"><i class="mdi mdi-calendar-account fntClr"></i> End Date </label>
						</div>
					</div>
				</div>
			<a href="<?php echo base_url('mlm_software/admin/income/view_earning'); ?>" class="btn btn-outline-dark  waves-effect waves-light">
				<i class="bx bx-arrow-back"></i> Back
			</a>
<button type="submit" class="btn btn-outline-primary waves-effect waves-light pull-right" onclick="return get_search(reportIncTable,'#search_earning','#view_earning')"  style="float:right;"><i class="mdi mdi-account-search"></i> Search </button>
			</div>
		</div>
	</div>
</form>
<input type="hidden" id="target" value="<?php echo $target;?>" />
<div class="card">
	<div class="mitbl">
		<i class="bx bxs-group miU"></i><?php echo ucfirst($action);?> Earning List
		<span><i class="far fa-file-excel miUexl"></i><i class="far fa-file-pdf miUpdf"></i><i class="fas fa-print miUprint"></i></span>
	</div>
    <div class="card-body">	
	<div id="defaultMsg" class="alert alert-warning" role="alert" style="display:none;">&nbsp;</div>	
	<div class="table-responsive">
		<div id="search_data">  
		<table id="view_earning" class="table align-middle table-striped table-nowrap mb-0">
		<thead class="hdr_clr">
				<tr>
					<th>S No.</th>
					<th>Name</th>
					<th>Member Id.</th>
					<th>Amount</th>
					<th>Type</th>
					<th>Ref ID</th>
					<th>Date</th>
				</tr>
			</thead>
		</table>
		</div>
		</div>
    </div>
</div>
<?php }else{?>
<div class="card">
    <div class="card-body">	
		<h3 class="card-title mb-4 crdHeading">
			<span class="crdIcn"><i class="mdi mdi-clipboard-list-outline"></i></span> Welcome to view earning section
			<span class="arvBack"><a href="<?php echo base_url('super_admin/dashboard');?>"><i class="bx bx-arrow-back"></i></a></span>
			
			</h3>
		<div class="mipayOt">
		    <div class="miPwarning">	
					<strong>Attention!</strong> If you click on proceed button below, then all the earnings will be visible according to selection. So if you want to view earning details of members/partners then proceed now.
			</div>
			<div id="report_gen" class="ami_default"><i class="mdi mdi-clipboard-list-outline"></i> Are you sure want to earning details</div>
			
		  <div class="row">
			   <div class="col-lg-12">
                    <div class="form-floating mb-3">
                         <select class="form-select " name="earnings" id="earnings">
							<option value="">---- Select One----</option>
							<option value="frenchise">Frenchise</option>
							<option value="shopee">Shopee</option>
							<option value="member">Member</option>
						</select>
						<label for="earnings" class="form-label">Earning <span class="text-danger">*</span></label>
                    </div>
                </div>
			<div class="col-lg-12">	
				<button type="button" class="btn cstm_btn ActnCmdByAmi" id="proceedEarningList" style="margin-top:10px; float:right"><i class="bx bx-save"></i> Proceed Now</button>
				<input type="hidden" id="target" value="<?php echo base_url('mlm_software/admin/income/view_earning/');?>" />	
			</div>
		 </div>
	 </div>	
  </div>
</div>
<?php }?>
<script src="<?php echo base_url() ?>media/js/mlm_software/admin/employee.js"></script>
