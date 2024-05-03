<!-- start page title -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>media/css/mifire.css" />
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
<div class="col-xl-12">
	<div class="card"><div class="card-header header-green"><i class="mdi mdi-account-circle-outline"></i> Member account topup 
		<a href="<?php echo base_url();?>super_admin/mlm_software/member/manage/without_topup" class="ititle"><i class="bx bx-arrow-back"></i></a>
	</div>
  <div class="card-body p-4" style="margin-bottom:-10px;"><?php //print_r($this->session->userdata); ?>	
       <div class="row">
			<div class="col-lg-6">
				<div class="form-floating mb-3">
					<select class="form-select empSelectR" name="pack_plan" id="pack_plan">
							<option value="">--- Select One ---</option>
							<?php if($pack_plan){foreach($pack_plan as $plan){?>
							<option value="<?php echo $plan['pack_price'];?>"><?php echo $plan['pack_price'];?></option>
						<?php 	}}?>
					</select>
					<label for="pack_plan" style="margin-left:-7px;"><i class="mdi mdi-currency-inr fntClr"></i> Package Plan</label>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-floating mb-3"><input type="text" name="userIdA" id="userIdA" value="" class="form-control" maxlength="8">
					 <label for="userId"><i class="bx bxs-user fntClr"></i> User ID / Franchisee ID(Whom to active)<span class="text-danger">*</span></label>
				</div>
			</div>
	   </div>
	   <div class="row">
			<div class="col-md-12">
				<div class="pyro" id="miFire" style="display:none;"><div class="before"></div><div class="after"></div></div>
					 <div id="userIdAErr" style="display:none;">There is changes here done</div>
						<div id="dGather" style="height:330px; border: 1px solid #f7f7f7;padding: 10px; display:none;">			
<table class="table table-bordered table-striped" style="width:60%; margin-top:15px;" align="center" >
	<thead class="header-green" style="border:1px solid #008288;"><tr><th colspan="2" style="font-weight:bold"><i class="bx bx-user-circle"></i> MEMBER'S DETAILS</th></tr></thead>
	<tbody>
			<tr><td style="width:40%">Member Id <i class="mdi mdi-counter fntClr" style="float:right"></i></td><td id="mId" class="fntbold">&nbsp;</td></tr>
			<tr><td>Member Name <i class="mdi mdi-account-circle-outline fntClr" style="float:right"></i></td><td id="mname" class="fntbold">&nbsp;</td></tr>
			<tr><td>Mobile Number <i class="bx bxl-whatsapp  fntClr" style="float:right"></i></td><td id="mobile" class="fntbold">&nbsp;</td></tr>
			<tr><td>Member Email <i class="bx bx-envelope fntClr" style="float:right"></i></td><td id="eml" class="fntbold">&nbsp;</td></tr>
			<tr><td>Package Price <i class="mdi mdi-currency-inr fntClr" style="float:right"></i></td><td id="packPr" class="fntbold">&nbsp;</td></tr>
	</tbody>
</table>
						</div>
					</div>
				</div>
  </div>   
	<div class="card-footer">
<a href="<?php echo base_url();?>super_admin/mlm_software/member/manage/without_topup" class="btn btn-outline-dark waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
		<button type="button" class="btn btn-outline-primary ActnCmdByAmi" id="miActivate" style=" float:right;"><i class="mdi mdi-account-search"></i> Search </button>	
		<button type="button" class="btn btn-outline-primary ActnCmdByAmi" id="mitopUp" style=" float:right; display:none"><i class="bx bx-lock-open"></i> Topup </button>
	 </div>	    
</div>
</div>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
<script src="<?php echo base_url() ?>media/js/super_admin/mlm_software/ledger.js"></script>

