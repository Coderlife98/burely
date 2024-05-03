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
    <div class="card-body">	
		<h3 class="card-title mb-4"><i class="mdi mdi-clipboard-list-outline"></i> Monthly Payout Generate</h3>
		<div class="mipayOt">
		    <div class="miPwarning">	
					<strong>Warning!</strong> If you click on generate button below, then all the earning of members will be transfered to wallet balance. This is not fully reversible. So if you want to generate payout for one user then proceed now.
			</div>
			<div id="report_gen" class="ami_default"><i class="mdi mdi-clipboard-list-outline"></i> Are you sure want to generate monthly payout</div>
			
		  <div class="row">
			   <div class="col-lg-12">
                    <div class="form-floating mb-3">
                         <input type="password" class="form-control" name="admnPass" id="admnPass">
						<label for="admnPass" class="form-label">Admin Password <span class="text-danger">*</span></label>
                    </div>
                </div>
				<div class="col-lg-12">
					<button type="button" class="btn btn-outline-primary ActnCmdByAmi" id="generate_pay" style="margin-top:10px; float:right"><i class="bx bx-save"></i> Generate payout  </button>
				</div>
		 </div>
	 </div>	
  </div>
</div>

<script src="<?php echo base_url() ?>media/js/mlm_software/admin/employee.js"></script>
