

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
 <div class="row mb-4">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header ami_cmn">
				<span><i class="mdi mdi-account-circle-outline"></i></span> Search deposit details
				<a href="<?php echo base_url('partner/deposit/manage');?>" class="ititle miMr" title="Back to list"><i class="bx bx-arrow-back"></i></a>
			</div>
			<div class="card-body">
				<form method="post" id="search_depo_list">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" name="tnx_id" id="tnx_id" class="form-control" >
									<label for="userId"><i class="bx bx-transfer fntClr"></i> Tnx Id</label>
								</div>
							</div>
							
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<select class="form-select" name="actnType" id="actnType">
											<option value="">---- Select One ----</option>
											<option value="">All</option>
											<option value="Hold">Hold</option>
											<option value="Cancel">Cancel</option>
											<option value="Pending">Pending</option>
											<option value="Approved">Approved</option>
										</select>
									<label for="userId"><i class="bx bx-transfer fntClr"></i> Transaction Type</label>
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
						<a href="<?php echo base_url('partner/dashboard'); ?>" class="btn btn-outline-dark  waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
						<button type="submit" class="btn btn-outline-primary waves-effect waves-light pull-right" onclick="return get_search(reportDepo,'#search_depo_list','#depo_transaction')"><i class="mdi mdi-account-search"></i> Search </button>
					</div>
				</form>
			</div>
		</div>
		<div class="card">
			<div class="mitbl">
				<i class="bx bx-money miU"></i>
				Deposit Manage List
				<span><i class="far fa-file-excel miUexl"></i><i class="far fa-file-pdf miUpdf"></i><i class="fas fa-print miUprint"></i>
				</span>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<div id="search_data">
						<table id="depo_transaction" class="table table-striped table-hover text-nowrap">
							<thead class="hdr_clr">
								<tr>
									<th>S No.</th>
									<th style="text-align:center;">Date</th>
									<th>Tnx Id</th>
									<th>Description</th>
									<th>Amount</th>
									<th style="text-align:center;">Status</th>
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
<input type="hidden" value="<?php echo $target;?>" id="target" />	
<script src="<?php echo base_url() ?>media/js/partner.min.js"></script>







<div class="modal fade" id="delDepoDtMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
    		 <span id="actnUrl" style="display:none;"></span>
	 			 <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
					 <div class="delMsg"><i class="fa fa-trash"></i> &nbsp;</div><div class="actnData">&nbsp;</div>	 
	  					<div id="deleteCnfMsg">&nbsp;</div>
							<div id="mdlFtrBtn">
								<button type="button" class="btn ink-reaction btn-danger pull-right" id="cnfDelDepoData"> <i class="fa fa-trash"></i> Confirm Delete</button>
						   <button type="button" class="btn ink-reaction btn-default-bright" data-dismiss="modal" aria-label="Close"><i class="fa fa-arrow-left"></i> Back </button>
							</div>	
      </div>
    </div>
  </div>
</div>







