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
	<div class="col-12 mitbl">
		<i class="bx bx-crown miU"></i> Add Product Details
		<span><a href="<?php echo base_url(); ?>mlm_software/admin/product/viewDetails" class="miGrtitle" title="Product Details List"><i class="bx bx-arrow-back"></i></a></span>
	</div>
	<div class="card-body">

		<form method="post" id="product_details_form" enctype="multipart/form-data">

			<input type="hidden" id="target" value="<?php echo $target; ?>">

			<div id="setResultMsg" class="ami_warning" style="display:none;">&nbsp;</div>
			
			<div class="col-xl-12">

				<div class="row">

				<div class="col-lg-4">
						<div class="form-floating mb-3">
							<select class="form-select" name="cat_id" id="cat_id" onchange="get_cat_data(this.value)">
								<option value="">---- Select One ----</option>
								<?php if ($pcategory) {
									foreach ($pcategory as $list) { ?><option value="<?php echo $list['id']; ?>"><?php echo $list['category']; ?></option><?php }
																																									} ?>
							</select>
							<label for="unitSts"><i class="bx bx-detail fntClr"></i> Product Category </label>
						</div>
					</div>
					


					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<select class="form-select" name="pro_id" id="pro_id">
								<option value="">---- Select One ----</option>
							</select>
							<label for="unitSts"><i class="bx bx-detail fntClr"></i> Product Name </label>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<select class="form-select" name="unit_id" id="pro_id">
								<option value="">---- Select One ----</option>
								<?php if ($unit) {
									foreach ($unit as $list) { ?>
										<option value="<?php echo $list['id']; ?>"><?php echo $list['unit_name']; ?>
										</option>
								<?php }
								} ?>
							</select>
							<label for="unitSts"><i class="fas fa-balance-scale-left fntClr"></i> Product Unit </label>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<input type="text" name="quantity" id="quantity" class="form-control">
							<label for="designation"><i class="bx bxs-crown fntClr"></i> Product Quantity </label>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<input type="text" name="pMrp" id="pMrp" value="" class="form-control">
							<label for="strtDt"><i class="bx bx-rupee  fntClr"></i> MRP </label>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<input type="text" name="discount" id="discount" class="form-control">
							<label for="strtDt"><i class="mdi mdi-percent-outline inrP fntClr"></i> Discount </label>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<input type="text" name="billing_price" id="billing_price" class="form-control">
							<label for="b_price"><i class="bx bx-rupee fntClr"></i> Billing Price </label>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<input type="text" name="productBV" id="productBV" class="form-control">
							<label for="productBV"><i class="bx bx-rupee fntClr"></i> Product BV </label>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<input type="text" name="productTax" id="productTax" class="form-control">
							<label for="productBV"><i class="mdi mdi-percent-outline inrP fntClr"></i> Product Tax  </label>
						</div>
					</div>
					
					
					
					
					<!--<div class="col-lg-8">
						<div class="form-floating mb-3">
							<input type="file" name="image" id="upload_image" value="" class="form-control">
							<label for="upload_image"><i class="fas fa-image fntClr"></i> Upload Image </label>
						</div>
					</div>-->
				</div>


			



				<div class="row">
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="date" name="mfgDate" id="mfgDate" value="" class="form-control">
							<label for="mfgDt"><i class="bx bx-calendar fntClr"></i> Mfg. Date</label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<input type="date" name="expDate" id="expDate" class="form-control">
							<label for="expDt"><i class="bx bx-calendar fntClr"></i> Exp. Date</label>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="mb-3">
						<label class="form-label"><i class="bx bx-food-menu fntClr"></i> Discription of Product</label>
						<textarea id="editor1" name="editor1" rows="5" cols="80" required><?php echo $product_data->pro_discription; ?></textarea>
					</div>
				</div>

				<a href="<?php echo base_url('mlm_software/admin/product/viewDetails'); ?>" class="btn btn-outline-dark  waves-effect waves-light">
						<i class="bx bx-arrow-back"></i> Back
				</a>
				<button type="submit" class="btn cstm_btn pull-right">
					<i class="bx bx-save"></i> Submit</button>
			</div>

		</form>


	</div>
</div>
<script src="<?php echo base_url(); ?>media/js/ckeditor/ckeditor.js"></script>
<script>
	$(function() {
		CKEDITOR.replace('editor1');
		$(".textarea").wysihtml5();
	});
</script>
<script src="<?php echo base_url() ?>media/js/mlm_software/admin/product_details.js"></script>