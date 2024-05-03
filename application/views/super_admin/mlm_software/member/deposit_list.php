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
<form method="post" id="srch_mlm_club_inc">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header ami_cmn">
				<span><i class="mdi mdi-cash-multiple"></i></span> 
			Search <?php echo $breadcrums;?> Details 
			<a href="<?php echo base_url();?>super_admin/dashboard" class="ititle miMr" title="Back to dashboard"><i class="bx bx-arrow-back"></i></a></div>
			<div class="card-body p-4" style="margin-bottom:-10px;">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="text" name="tnxId" id="tnxId" value="" class="form-control">
							<label for="tnxId"><i class="bx bx-transfer-alt fntClr"></i> Transaction Id </label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="text" name="usrId" id="usrId" value="" class="form-control">
							<label for="tnxId"><i class="bx bx-user-pin fntClr"></i> User Id </label>
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
			<button type="submit"  onclick="return get_search(repMlmInc,'#srch_mlm_club_inc','#mi_mlm_inc')"  class="btn btn-outline-primary waves-effect waves-light pull-right" style="float:right;"><i class="mdi mdi-account-search"></i> Search </button>
			</div>
		</div>
	</div>
</form>	

<div class="card">

<div class="mitbl">
	<i class="bx bxs-group miU"></i>
	Transaction List
	<span><i class="far fa-file-excel miUexl"></i><i class="far fa-file-pdf miUpdf"></i><i class="fas fa-print miUprint"></i>
	</span>

</div>


    <div class="card-body">	
		<div class="table-responsive">
		<div id="search_data">  
		<table id="depo_transaction" class="table align-middle table-striped table-nowrap mb-0">
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
<!----------------------------Model bx strt----------------------------->	
<!--/*SELECT mlm.id,mlm.tnx_id,mlm.credit_amt,mlm.created_date,m.name FROM mlm_income_manage as mlm left join wallet_transaction as w on w.tnx_id=mlm.tnx_id left JOIN members as m on m.username=w.user_id */-->
<!----------------------------Model bx end------------------------------>
<input type="hidden" id="target" value="<?php echo $target;?>" />	
<input type="hidden" id="base_url" value="<?php echo base_url();?>" />
<script src="<?php echo base_url() ?>media/js/super_admin/mlm_software/ledger.js"></script>
