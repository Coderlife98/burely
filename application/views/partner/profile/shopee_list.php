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
			<div class="mitbl">
				<i class="bx bxs-group miU"></i>
				Shopee Manage
				<span><i class="far fa-file-excel miUexl"></i><i class="far fa-file-pdf miUpdf"></i><i class="fas fa-print miUprint"></i>
				<a href="<?php echo base_url('partner/shopee/create');?>" class="miBack"><i class="bx bx-plus-medical "></i></a>
				</span>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<div id="search_data">
						<table id="shopee_list" class="table table-striped table-hover">
							<thead class="hdr_clr">
								<tr>
									<th style="width:50px;">S No.</th>
									<th style="width:75px;">Shopee Id.</th>
									<th>Name</th>
									<th>Mobile</th>
									<th>Email</th>
									<th>Address</th>
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
<input type="hidden" id="target" value="partner/shopee/view_list">
<script src="<?php echo base_url() ?>media/js/partner.min.js"></script>