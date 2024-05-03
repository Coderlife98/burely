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
				<span><i class="mdi mdi-account-circle-outline"></i></span> Search details
				<a href="<?php //echo base_url();
							?>" class="ititle miMr" title="Back to list"><i class="bx bx-arrow-back"></i></a>
			</div>
			<div class="card-body">
				<form method="post" id="search_stock_list">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" name="proId" id="proId" class="form-control" >
									<label for="userId"><i class="bx bx-transfer fntClr"></i> Product Id</label>
								</div>
							</div>
							
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" name="proName" id="proName" class="form-control" >
									<label for="userId"><i class="bx bx-transfer fntClr"></i> Product Name</label>
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
						<button type="submit" class="btn btn-outline-primary waves-effect waves-light pull-right" onclick="return get_search(repStockManage,'#search_stock_list','#partner_stock_list')"><i class="mdi mdi-account-search"></i> Search </button>
					</div>
				</form>
			</div>
		</div>
		<div class="card">
			<div class="mitbl">
				<i class="bx bxs-group miU"></i>
				Stock List
				<span><i class="far fa-file-excel miUexl"></i><i class="far fa-file-pdf miUpdf"></i><i class="fas fa-print miUprint"></i>
				</span>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<div id="search_data">
						<table id="partner_stock_list" class="table table-striped table-hover text-nowrap">
							<thead class="hdr_clr">
								<tr>
									<th>S No.</th>
									<th>Product Id.</th>
									<th>Name</th>
									
									<th>MRP</th>
									<th>Selling Price</th>
									<th style="text-align:center">Quantity</th>
									<th style="text-align:center; ">Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="target" value="partner/stock/details">
<script src="<?php echo base_url() ?>media/js/partner.min.js"></script>