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

<div class="row">

<?php

if($lBalnce)
{
	$availableB=$lBalnce->credit-$lBalnce->debit;
	$avDebit=$lBalnce->debit;
	$avCredit=$lBalnce->credit;
	}
else
{
$availableB='0';
$avDebit='0';
$avCredit='0';
	}
?>
	<div class="col-md-6 col-xl-3">
		<div class="card bg-success border-success">
			<div class="card-body">
				<div class="float-end">
					<div class="avatar-sm mx-auto mb-4">
						<span class="avatar-title rounded-circle bg-light font-size-24">
							<i class="mdi mdi-cash-multiple text-success"></i>
						</span>
					</div>
				</div>
				<div>
					<p class="text-uppercase fw-semibold font-size-13 font_clr">Available Revenue</p>
					<h4 class="mb-1 mt-1 font_clr"><i class="bx bx-rupee"></i><span class="counter-value" data-target="<?php echo $availableB;?>">0</span></h4>
				</div>
			  
			</div>
		</div>
	</div> 
	<div class="col-md-6 col-xl-3">
		<div class="card bg-danger border-danger">
			<div class="card-body">
				<div class="float-end">
					<div class="avatar-sm mx-auto mb-4">
						<span class="avatar-title rounded-circle bg-light font-size-24">
							<i class="mdi mdi-cash-multiple text-danger"></i>
						</span>
					</div>
				</div>
				<div>
					<p class="text-uppercase fw-semibold font-size-13 font_clr">All Debit</p>
					<h4 class="mb-1 mt-1 font_clr"><i class="bx bx-rupee"></i><span class="counter-value" data-target="<?php echo $avDebit;?>">0</span></h4>
				</div>
			   
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-3">
		<div class="card bg-success border-success">
			<div class="card-body">
				<div class="float-end">
					<div class="avatar-sm mx-auto mb-4">
						<span class="avatar-title rounded-circle bg-light font-size-24">
							<i class="mdi mdi-cash-multiple text-success"></i>
						</span>
					</div>
				</div>
				<div>
					<p class="text-uppercase fw-semibold font-size-13 font_clr">All Credit</p>
					<h4 class="mb-1 mt-1 font_clr"><i class="bx bx-rupee"></i><span class="counter-value" data-target="<?php echo $avCredit;?>">0</span></h4>
				</div>
			   
			</div>
		</div>
	</div> 
	<div class="col-md-6 col-xl-3">
		<div class="card bg-danger border-danger">
			 <div class="card-body">
				<div class="float-end">
					<div class="avatar-sm mx-auto mb-4">
						<span class="avatar-title rounded-circle bg-light font-size-24">
							<i class="mdi mdi-cash-multiple text-danger"></i>
						</span>
					</div>
				</div>
				<div>
					<p class="text-uppercase fw-semibold font-size-13 font_clr">All Expense</p>
					<h4 class="mb-1 mt-1 font_clr"><i class="bx bx-rupee"></i><span class="counter-value" data-target="<?php if($lExpense->debit){echo $lExpense->debit;}?>">0</span></h4>
				</div>   
			</div>
		</div>
	</div> 
</div>


	<div class="col-xl-12">
		<div class="card">
			<div class="card-header ami_cmn"><span><i class="mdi mdi-cash-multiple"></i></span> Search Transaction Details
			
			<a href="<?php echo base_url('super_admin/dashboard');?>" class="ititle miMr" title="Back to list"><i class="bx bx-arrow-back"></i></a>
			
			</div>
			<div class="card-body p-4" style="margin-bottom:-10px;">
		    <form method="post" id="search_ledger">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="text" name="tnxId" id="tnxId" value="" class="form-control">
							<label for="tnxId"><i class="bx bx-transfer-alt fntClr"></i> Transaction Id </label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<select class="form-select" name="actnType" id="actnType">
								<option value="">---- Select One ----</option>
								<option value="all">ALL</option>
								<option value="credit">Credit</option>
								<option value="debit">Debit</option>
							</select>
							
							<label for="tnx_typ"><i class="bx bx-transfer fntClr"></i> Transaction Type </label>
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
			<button type="submit" class="btn btn-outline-primary waves-effect waves-light pull-right" style="float:right;" onclick="return get_search(repLedgerTable,'#search_ledger','#ledger_table')"><i class="mdi mdi-account-search"></i> Search </button>
			
			</form>
			</div>
		</div>
	</div>
	

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
		<table id="ledger_table" class="table align-middle table-striped table-nowrap mb-0">
		<thead class="hdr_clr">
				<tr>
					<th>S.No</th>
					<th>Tnx. Id</th>
					<th>Debit</th>
					<th>Credit</th>
					<th>Reason</th>
					<th>Tnx. Date</th>
					<th>Action</th>

				</tr>
			</thead>
		</table>
		</div>
		</div>
    </div>
</div>
<!----------------------------Model bx strt----------------------------->	

<!----------------------------Model bx end------------------------------>
<script src="<?php echo base_url() ?>media/js/mlm_software/admin/ledger.js"></script>
