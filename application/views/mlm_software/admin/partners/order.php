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




<?php
if($getDetails->my_img){$getImg=base_url($getDetails->my_img);}else{$getImg=base_url('uploads/user/no_img.png');}

if($getDetails->user_typ=='1'){$bcLink='frenchise';}
elseif($getDetails->user_typ=='2'){$bcLink='shopee';}
else{$bcLink='create';}
?>


<!----------------------------Edit Frenchise strt----------------------------->
<div class="row mb-4">
 <?php //print_r($getDetails); 

 ?> 

	<div class="col-xl-12">
		<div class="card">
		<div style="padding:10px;">	
			<div class="mi_ordHead"><span><i class="bx bx-globe"></i> <?php echo $getDetails->name?></span></div>
			<div class="row">
				<div class="col-sm-4">
						<div style="padding-left:40px;">
							 <address>
					From :<br>	
					<strong><?php echo $this->session->userdata('company_name');?></strong>
					<br><?php echo $this->session->userdata('company_address');?>
						<!--<span><strong><?php echo $getDetails->name?></strong></span><br>
						<span><?php echo $getDetails->address?>, <?php echo $getDetails->zipcode?></span><br />
						<span>Mobile&nbsp; :<?php echo $getDetails->mobile?></span><br />
						<span>Email&nbsp;:<?php echo $getDetails->email?></span>-->
			   </address>
			   			</div>
				</div>
				<div class="col-sm-4">
					<address>
					 To : <br>
						<span>ID : <strong><?php echo $getDetails->username;?></strong></span><br>
						<span><strong><?php echo $getDetails->name?></strong></span><br>
						<span><?php echo $getDetails->address?>,</span><br />
						<?php if($getDetails->stateN){echo '<span>'.$getDetails->stateN.' ,'.$getDetails->cityN.' ,'.$getDetails->zipcode.'</span><br />';}?>
						<span>Mobile&nbsp; :<?php echo $getDetails->mobile?></span><br />
						<span>Email&nbsp;:<?php echo $getDetails->email?></span>
					
			   </address>
				</div>
				<div class="col-sm-4">
				
			 <!-- <b>Invoice #BO264056</b>--><br>
			  <br>
			 <!-- <b>Order ID:</b> 4F3S8J<br>-->
			  <b>Order Date : </b>   <?php echo date('Y-m-d');?><br>
			  <b>Customer Id : </b> <?php echo $getDetails->username;?>        
			  </div>
		 	 </div>
		</div>	
		</div>
	</div>


	<div class="col-xl-12">
		<div class="card">
			
		
		
		
			<div class="col-12 mitbl"><i class="bx bx-basket miU"></i> Make An Order 
			<span><a href="<?php echo base_url('mlm_software/admin/partners/'.$bcLink);?>" class="miGrtitle" title="Add New"><i class="bx bx-arrow-back "></i></a></span></div>
			<!-- form start -->
			<div class="card-body">
				<form id="add_order" method="post">
				
				<?php //print_r($getDetails->user_typ);?>
				
					<div class="row">
	
						<div class="col-lg-2">
							<div class="mb-3">
								<input type="hidden" name="member_id" value="<?php echo $getDetails->id; ?>">
								<input type="hidden" name="recevrTyp" id="recevrTyp" value="<?php echo $getDetails->user_typ; ?>">
								<input type="hidden" name="prod_details_id" id="prod_details_id">
	
								<label class="form-label mi_bld">Select Category</label>
								<select class="form-select" name="pcat_id" onchange="get_product(this.value)">
									<option value="">---Select One---</option>
									<?php foreach ($pcategory as $pcat) { ?>
										<option value="<?php echo $pcat['id'] ?>"><?php echo $pcat['category']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
	
						<div class="col-lg-2">
							<div class="mb-3">
								<label class="form-label mi_bld">Select Product</label>
								<select class="form-select" name="prod_id" id="prod_id" onchange="get_product_details(this.value)">
									<option value="">---Select One---</option>
	
								</select>
							</div>
						</div>
						<div class="col-lg-1">
							<div class="mb-3">
								<label for="example-text-input" class="form-label mi_bld">Unit</label>
								<input class="form-control" type="text" value="" name="punit" id="punit" readonly>
							</div>
						</div>
	
	
	
						<div class="col-lg-2">
							<div class="mb-3">
								<label for="example-text-input" class="form-label mi_bld">Price</label>
								<input class="form-control" type="hidden" name="pprice" value="" id="pprice" readonly>
								<input class="form-control" type="text" name="sprice" value="" id="sprice" readonly>
								<input class="form-control" type="hidden" name="discount" value="" id="discount" readonly>
	                            <input type="hidden" name="productBv" id="productBv" >
								<input type="hidden" name="prodTax" id="prodTax">
	
							</div>
						</div>
						<div class="col-lg-1">
							<div class="mb-3">
								<label for="example-text-input" class="form-label mi_bld">Stock</label>
								<input class="form-control" type="hidden" name="lstock" value="" id="lstock" readonly>
								<input class="form-control" type="text" value="" id="accu_stock" readonly>
	
							</div>
						</div>
	
						<div class="col-lg-1">
							<div class="mb-3">
								<label for="example-text-input" class="form-label mi_bld">Qty</label>
								<input class="form-control" type="number" name="pbquantity"  id="pbquantity">
							</div>
						</div>
						<div class="col-lg-2">
							<div class="mb-3">
								<label for="example-text-input" class="form-label mi_bld">Total Amt.</label>
								<input class="form-control" type="text" value="0" name="total_amount" id="total_amount" readonly>
							</div>
						</div>
	
	
	
						<div class="col-lg-1">
							<div class="mb-3">
								<label for="example-text-input" class="form-label">&nbsp;&nbsp;</label>
								<button type="submit" class="form-control btn btn-outline-primary"><i class="bx bx-plus"></i>Add</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- form end -->
			<div class="card-body">
				
				<div class="table-responsive">
					<div id="search_data">
						<table id="ajax_list" class="table table-striped table-hover  text-nowrap">
							<thead class="hdr_clr">
								<tr>
									<th>S No.</th>
									<th>Product Name</th>
									<th>Product B.V</th>
									<th style="text-align:center;">Mrp</th>
									<th style="text-align:center;">Selling Price</th>
									<th>Qty.</th><th>Discount</th>
									<th class="mi_text">Total amount</th>
									<th>Tax</th>
									<th style="text-align:center;">Net amount</th>
									
		
		
								</tr>
							</thead>
							<tbody>
		
								<?php
								$total_qty = 0;
								$total_amt = 0;
								$payble_amt = 0;
								if (!empty($cart)) :
									foreach ($cart as $i => $cart) :
										$total_qty += $cart['product_qty'];
										$payble_amt += $cart['net_amount'];
										$total_amt += $cart['total_amount'];
		
										$aftrDiscountAmt=$cart['total_amount']-($cart['total_amount']*$cart['discount'])/100;
		
								?>
		
										<tr>
											<td><strong><?php echo ++$i ?>.</strong></td>
											<td><?php echo $cart['product_name']; ?></td>
											<td style="text-align:center;"><?php echo $cart['productBV']; ?></td>
											<td><?php echo $cart['product_mrp']; ?></td>
											<td style="text-align:center;"><?php echo $cart['product_selling_price']; ?></td>
											<td><?php echo $cart['product_qty']; ?></td>
											<td style="text-align:center;"><?php echo $cart['discount']; ?> <i class="mdi mdi-percent-outline inrP"></i></td>
											
											<td style="text-align:center;"><?php echo $aftrDiscountAmt; ?></td>
											<td><?php echo $cart['productTax']; ?> <i class="mdi mdi-percent-outline inrP"></i></td>
											<td>
												<span style="padding-left: 5rem;"><?php echo $cart['net_amount']; ?></span> 
											<span class="mi_right"><a href="javascript:void(0);" onclick="delete_cart_item(<?php echo $cart['id']; ?>)" class="text-danger" title="Remove from cart"><i class="bx bx-trash"></i></a></span></td>
		
											
		
										</tr>
								<?php
								 endforeach;
								
								?>
		
								<tr class="order_hr">
									<td colspan="5"> <span class="mi_bld">No. of Items :</span> <?php echo $i; ?></td>
									<td></td>
									<td></td>
									<td class="mi_text mi_bld">Total Qty :</td>
									<td><?php echo $total_qty ?></td>
									<td ><span class="mi_bld"> Net T.amt : </span><span ><!--class="mi_payble"--><?php echo number_format($payble_amt, 2); ?></span></td>
									
								</tr>
								<tr>
									<td colspan="9"></td>
									<td><span class="mi_bld"> Pay Amt : </span> 
									    <input class="form-control" style="width:94px;margin:-28px 0px 0px 80px;" type="text" name="pyblAmt" id="pyblAmt">
									</td>
								</tr>
								<tr>
									<td colspan="9"></td>
									<td  class="mi_text"><a href="javascript:void(0);" id="make_payment"  data-member_id="<?php echo $getDetails->id; ?>" class="btn btn-outline-success waves-effect waves-light"><i class="bx bx-money"></i> Make Payment</a></td>
								</tr>
								<?php else:?>
									<tr>
										<td colspan="10" class="text-center text-danger">
											<code>Ooop's there is no data found</code><br>
												<img src="<?php echo base_url('uploads/addnewitem.svg');?>" style="height:200px;"><br><br>
												<a href="<?php echo base_url('mlm_software/admin/partners/'.$bcLink);?>" class="text-success bolds">
														<i class="bx bx-shopping-bag"></i> Do you want o order new.
												</a>
												<br><br>
										</td>
									</tr>
									<?php endif;?>
		
							</tbody>
		
		
						</table>
					</div>
				</div>
				
			</div>	
		</div>
	</div>


</div>










<!----------------------------edit Frenchise end------------------------------>
<script src="<?php echo base_url() ?>media/js/mlm_software/admin/shopee/order.js"></script>