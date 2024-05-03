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
<input type="hidden" id="target" value="<?php echo $target; ?>" />
<!----------------------------Edit Frenchise strt----------------------------->
<div class="row mb-4">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header ami_cmn">
				<span><i class="mdi mdi-account-circle-outline"></i></span> Search Product details
				<a href="<?php echo base_url(); ?>mlm_software/admin/product/viewDetails/add" class="ititle miMr" title="Add Product Details"><i class="bx bx-plus"></i>Add Product</a>
			</div>
			<div class="card-body">
				<form method="post" id="search">
					<div class="col-xl-12">
						<div class="row">
							
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" name="cat_name" id="cat_name" class="form-control">
									<label for="cat_name"><i class=" fntClr"></i>Category Name</label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" name="p_name" id="" class="form-control">
									<label for="emailId"><i class=" fntClr"></i> Product Name </label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" name="Mrp" id="Mrp" class="form-control">
									<label for="strtDt"><i class=" fntClr"></i>Product Mrp </label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" name="price" id="price" class="form-control">
									<label for="price"><i class=" fntClr"></i> Product Price </label>
								</div>
							</div>
						</div>
						<a href="<?php echo base_url(); ?>mlm_software/admin/partners/manage" class="btn btn-outline-dark  waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
						<button type="submit" class="btn btn-outline-primary waves-effect waves-light pull-right" onclick="return get_search(reportMemTable,'#search_member','#member_list')"><i class="mdi mdi-account-search"></i> Search </button>
					</div>
				</form>
			</div>
		</div>

		<div class="card">
			<div class="mitbl">
				<i class="bx bxs-group miU"></i>
				<?php echo $memberTyp; ?> List
				<span><i class="far fa-file-excel miUexl"></i><i class="far fa-file-pdf miUpdf"></i><i class="fas fa-print miUprint"></i>
				</span>

			</div>
			<div class="card-body">
				<div class="table-responsive">
					<div id="search_data">
						<table id="product_list" class="table table-striped table-hover  text-nowrap">
							<thead class="hdr_clr">
								<tr>
									<th>S No.</th>
									<th>Product Id.</th>
									<!--<th>Category Name</th>-->
									<th>Product Name</th>
									<th>Product B.V.</th>
									<th>MRP</th>
									<th>Selling Price</th>
									<th>Tax</th>
									<th>In Stock</th>
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




<!-- modal section end -->

<div class="modal fade" id="manage_product" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel"> Product Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div id="view_product_details"></div>

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->










<div class="modal fade" id="deleteModel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float:right;"></button>
				<div class="delMsg"> &nbsp;</div>
				<div class="actnData">&nbsp; </div>
				<div id="mdlFtrBtn">
					<input type="hidden" id="cnfDel_id">
					<a href="javascript:void(0)" id="deleteCnfrMtn" class="btn btn-outline-danger waves-effect waves-light pull-right">Confirm Delete <i class="bx bx-trash"></i></a>
					<button type="button" class="btn btn-outline-dark pull-right" data-bs-dismiss="modal"><i class="bx bx-arrow-back"></i> Back </button>
				</div>
			</div>
		</div>
	</div>
</div>










<!----------------------------edit Frenchise end------------------------------>
<script src="<?php echo base_url() ?>media/js/mlm_software/admin/product_details.js"></script>