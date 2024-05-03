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
		<div class="card">
			<div class="card-body">
				<div class="float-end">
					<div class="avatar-sm mx-auto mb-4">
						<span class="avatar-title rounded-circle bg-light font-size-24">
							<i class="mdi mdi-cash-multiple text-primary"></i>
						</span>
					</div>
				</div>
				<div>
					<p class="text-muted text-uppercase fw-semibold font-size-13">Available Revenue</p>
					<h4 class="mb-1 mt-1"><i class="bx bx-rupee"></i><span class="counter-value" data-target="<?php echo $availableB;?>">0</span></h4>
				</div>
			  
			</div>
		</div>
	</div> 
	<div class="col-md-6 col-xl-3">
		<div class="card">
			<div class="card-body">
				<div class="float-end">
					<div class="avatar-sm mx-auto mb-4">
						<span class="avatar-title rounded-circle bg-light font-size-24">
							<i class="mdi mdi-cash-multiple text-primary"></i>
						</span>
					</div>
				</div>
				<div>
					<p class="text-muted text-uppercase fw-semibold font-size-13">All Debit</p>
					<h4 class="mb-1 mt-1"><i class="bx bx-rupee"></i><span class="counter-value" data-target="<?php echo $avDebit;?>">0</span></h4>
				</div>
			   
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-3">
		<div class="card">
			<div class="card-body">
				<div class="float-end">
					<div class="avatar-sm mx-auto mb-4">
						<span class="avatar-title rounded-circle bg-light font-size-24">
							<i class="mdi mdi-cash-multiple text-primary"></i>
						</span>
					</div>
				</div>
				<div>
					<p class="text-muted text-uppercase fw-semibold font-size-13">All Credit</p>
					<h4 class="mb-1 mt-1"><i class="bx bx-rupee"></i><span class="counter-value" data-target="<?php echo $avCredit;?>">0</span></h4>
				</div>
			   
			</div>
		</div>
	</div> 
	<div class="col-md-6 col-xl-3">
		<div class="card">
			 <div class="card-body">
				<div class="float-end">
					<div class="avatar-sm mx-auto mb-4">
						<span class="avatar-title rounded-circle bg-light font-size-24">
							<i class="mdi mdi-cash-multiple text-primary"></i>
						</span>
					</div>
				</div>
				<div>
					<p class="text-muted text-uppercase fw-semibold font-size-13">All Expense</p>
					<h4 class="mb-1 mt-1"><i class="bx bx-rupee"></i><span class="counter-value" data-target="<?php if($lExpense->debit){echo $lExpense->debit;}?>">0</span></h4>
				</div>   
			</div>
		</div>
	</div> 
</div>

<form method="post" id="search">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header header-green"><i class="mdi mdi-cash-multiple"></i> Search Transaction Details</div>
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
			<button type="submit" class="btn btn-outline-primary waves-effect waves-light pull-right" style="float:right;"><i class="mdi mdi-account-search"></i> Search </button>
			</div>
		</div>
	</div>
</form>	

<div class="card">
    <div class="card-body">	
		<div class="table-responsive">
		<div id="search_data">  
		<table id="ledger_table" class="table align-middle table-striped table-nowrap mb-0">
		<thead class="header-green">
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
<input type="hidden" id="base_url" value="<?php echo base_url();?>" />
<script src="<?php echo base_url() ?>media/js/super_admin/mlm_software/ledger.js"></script>
