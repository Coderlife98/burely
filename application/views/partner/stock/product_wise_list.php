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
 
 <div class="col-xl-3">
 <?php //print_r($stock);
 	if($stock->pro_img){$proImg=base_url($stock->pro_img);}
 	else{$proImg=base_url('uploads/product/no_img.png');}
 ?>
   <div class="pro_details">
			<img src="<?php echo $proImg;?>" alt="<?php echo $stock->product_name;?>"> 
			<div class="proNm"><?php echo $stock->product_name;?></div>
			<div>MRP <span> <i class="bx bx-rupee inrP"></i> <?php echo $stock->product_mrp;?></span></div> 
			<div>Selling Price <span><i class="bx bx-rupee inrP"></i> <?php echo $stock->product_price;?></span></div>   
			<div>Stock <span><?php echo $stock->product_qty;?></span></div> 
			<div>Create Date <span><?php if($stock->create_date){echo date('d-M-Y',strtotime($stock->create_date));}else{ echo 'N/A';}?></span></div> 
			<div>Last In Stock <span><?php echo $stock->lastInStock;?></span></div> 
			<div>Last Purchase <span><?php if($stock->stockInDate){echo date('d-M-Y',strtotime($stock->stockInDate));}else{echo 'N/A';}?></span></div>  			
		</div>
    </div>
 
 
 
	<div class="col-xl-9">
		<div class="card">
			<div class="mitbl">
				<i class="bx bxl-product-hunt miU"></i>
				<?php echo $stock->product_name;?> <strong>(<?php echo $stock->prod_id;?> )</strong>
				<span>
						<i class="far fa-file-excel miUexl"></i><i class="far fa-file-pdf miUpdf"></i><i class="fas fa-print miUprint"></i>
						<a href="<?php echo base_url('partner/stock');?>" class="miBack"><i class="bx bx-arrow-back"></i></a>
				</span>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<div id="search_data">
					
					<?php 
						//print_r($stock);
					?>
					
					
						<table id="partner_stock_product_wise" class="table table-striped table-hover text-nowrap">
							<thead class="hdr_clr">
								<tr>
									<th style="text-align:center">S No.</th>
									<th>Product Id.</th>
									<th style="text-align:center">Name</th>
									<th>Quantity</th>
									<th>MRP</th>
									<th>Selling Price</th>
									<th>Date of purchase</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="target" value="<?php echo $target;?>">
<script src="<?php echo base_url() ?>media/js/partner.min.js"></script>