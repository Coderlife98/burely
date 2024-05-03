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
<div class="row mb-4">
	<div class="col-xl-12">
		<div class="card-title amiCrdTitle">
			<i class="bx bx-detail"></i>  My Earning List
			<a href="<?php echo base_url('partner/dashboard');?>" class="pull-right"><i class="bx bx-arrow-back"></i></a>
   		</div>
		
			<div class="crdDet btm_border">
			  <div class="row mi_padd">
				<div class="col-md-12">
				   <div class="table-responsive">
					<div id="search_data">
						<table id="member_earning" class="table table-striped table-hover">
							<thead class="hdr_clr">
								<tr>
									<th>S No.</th>
									<th>Amount</th>
									<th>Total B.V</th>
									<th>Earned Rs.</th>
									<th style="text-align:center;">Type</th>
									<th style="text-align:center;">Ref ID</th>
									<th style="text-align:center;">Date</th>
									<th style="text-align:center;">Status</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<!------------->
