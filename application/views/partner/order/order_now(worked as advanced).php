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
<!----------------------------Edit order strt----------------------------->
<div class="row mb-4">
	<div class="col-xl-12">
	 
	   <div class="card">
		   <div class="card-title amiCrdTitle">
					<i class="bx bx-basket"></i> Dear member you can add kart </strong> 
					<a href="<?php echo base_url('partner/order');?>" class="pull-right"><i class="bx bx-arrow-back"></i></a>
		   </div>		
			<div class="card-body p-4" style="margin-bottom:30px;">
				  <div class="row">
		 <?php 
				//print_r($getFrenchise);
				if($this->u_cate=='2')
				{
					 ?>
					 <span id="getTargetForFrenchise">partner/shopee/selectedFrenchise</span>
					 <div class="selr">
					 <div class="slr_title">
					 		<i class="bx bxl-product-hunt"></i> Seller Details
					 </div>
					    <div class="frenchiseOptn">
								<div class="frenSlice"> Choose frenchise</div> 
									<span class="mi-select miOPtn">
										<select class="empSelectR" id="frenchise">
											<option value="">--- Select One ---</option>
											<?php 
											if($getFrenchise)
											{
												foreach($getFrenchise as $frenchise)
												{
											?>
											<option value="<?php echo $frenchise->id;?>"><?php echo $frenchise->name;?></option>
											<?php }}?>
											
										</select>
									</span>
								 </div>
							 <div class="slr_select">
								<table width="100%">
								  <tr>
									  <td width="22%" class="fright">Provider Code :</td>
									<td width="49%" class="fbold" id="slrCode">-------</td>
									<td width="29%" rowspan="5">
											<img id="slrPic" src="<?php echo base_url('uploads/user/no_image1.png');?>" >                                            
									</td>
								  </tr>
										<tr>
											<td class="fright">Provider Name :</td>
											<td class="fbold" id="slrName">-------</td>
										</tr>
										<tr>
											<td class="fright">Address :</td>
											<td class="fbold" id="slrAddr">-------</td>
										</tr>
										<tr>
											<td class="fright">Contact Number :</td>
											<td class="fbold" id="slrContct">-------</td>
										</tr>
										<tr>
											<td class="fright">Email Id :</td>
											<td class="fbold" id="slrEmail">-------</td>
										</tr>
									</table>
							 </div>
					</div>
					 <?php }?>
					 <div id="myResultShow">
					 </div>
					 
					 
					 
					 
					 
					 <table class="table table-bordered table-striped" align="center" id="tempKartTble" >
						<thead class="hdr_clr" style="border:1px solid #058ba8;">
							<tr>
								<th>S No.</th>
								<th>Product Name</th>
								<th>Quantity</th>
								<th>MRP</th>
								<th>Sell Price</th>
								<th>Total Amount</th>
								<th>Discount</th>
								<th>Net Amount</th>
							</tr>
						</thead>
							<tbody>
								<?php if($this->u_cate=='1'){?>
								<tr>
									<td><strong>#</strong><input type="hidden" id="proID"></td>
									<td><input type="text" class="edtBltxt partAction" id="proName"><div id="proList" class="proList"><ul id="setProductList"></ul></div></td>
									<td><input class="ordBlTxt partAction" type="text" id="proQty"></td>
									<td id="mrp"></td>
									<td id="p_price"></td>
									<td id="tAmt"></td>
									<td id="tDiscount"></td>
									<td><span id="tProPrice"></span><button class="kartBtn" onclick="addTempKart()"><i class="bx bx-plus"></i></button>
									</td>
								</tr>
								<?php }else{?>
								<tr>
									<td><strong>#</strong><input type="hidden" id="proID"></td>
									<td><input type="text" class="edtBltxt partAction" id="proNameByShop"><div id="proList" class="proList"><ul id="setProductList"></ul></div></td>
									<td><input class="ordBlTxt partAction" type="text" id="proQty"></td>
									<td id="mrp"></td>
									<td id="p_price"></td>
									<td id="tAmt"></td>
									<td id="tDiscount"></td>
									<td><span id="tProPrice"></span><button class="kartBtn" onclick="addTempKart()"><i class="bx bx-plus"></i></button>
									</td>
								</tr>
								<?php }
										if($tempOrderDetails)
								{ 
								$ctr=0;	$grandTotal=0;	
									foreach($tempOrderDetails as $dList)
									{$ctr++;
									$tAmt=$dList->product_selling_price*$dList->product_qty;
									$netAmt=$tAmt-($tAmt*$dList->discount)/100;
									
									?>
									
									<tr>
										<th><?php echo $ctr;?>. </th><td><?php echo $dList->product_name;?></td>
										<td id="pQty--<?php echo $dList->product_details_id;?>"><?php echo $dList->product_qty;?></td>
										<td><i class="bx bx-rupee inrP"></i> <?php echo $dList->product_mrp;?></td>
										<td><i class="bx bx-rupee inrP"></i> <?php echo $dList->product_selling_price;?></td>
										<td id="tAmt--<?php echo $dList->product_details_id;?>"><i class="bx bx-rupee inrP"></i> <?php echo number_format($tAmt,2);?></td>
										<td><?php echo $dList->discount;?> <i class="mdi mdi-percent-outline inrP"></i></td>
										<td id="netAmt--<?php echo $dList->product_details_id;?>"><i class="bx bx-rupee inrP"></i> <?php echo number_format($netAmt,2);?>
										
										<button class="kartTrash" onclick="delTempKart('<?php echo $dList->id.'@@@@'.$dList->product_name; ?>')"><i class="bx bx-trash"></i></button>
										</td>
									</tr>
									<?php $grandTotal+=$netAmt;} $paybleAmt=$grandTotal+$adminCharge->shipping_charges+($grandTotal*$adminCharge->tax)/100;?>
								
									<?php }else{?>
									<tr id="data_not_found"><td colspan="8" align="center"><code>Ooop's there is no data found</code><br />
									<img src="<?php echo base_url('uploads/addnewitem.svg');?>" style="height:200px;"><br /><br />
									<a href="<?php echo base_url('partner/order/add_kart');?>" class="text-success bolds">
									<i class="bx bx-shopping-bag"></i> Do you want o order now.
									</a>
									<br /><br />
									</td></tr>
								<?php 
								}?>	
							</tbody>
						</table>
					 <table class="table table-bordered table-striped" align="center" style="margin-top:-17px;">
							<tbody>
								<tr>
									<td id="miWidth"><strong>Grand Total</strong> </td>
									<td>
										 <i class="bx bx-rupee inrP"></i> 
										 <strong><span id="grantTotalAmt"><?php echo number_format($grandTotal,2);?></span></strong></td>
								</tr>	
								<tr>
									<td  style="text-align:right"><strong>Tax</strong> </td><td><i class="mdi mdi-percent-outline inrP"></i> <strong><?php echo number_format($adminCharge->tax,2);?></strong></td>
								</tr>
								<tr>
								
								<td style="text-align:right"><strong>Shipping Charges</strong> </td><td><i class="bx bx-rupee inrP"></i> <strong><?php echo number_format($adminCharge->shipping_charges,2);?></strong></td>
							</tr>
								<tr>
									
									<td style="text-align:right"><strong>Payble Amount</strong> </td>
									<td><i class="bx bx-rupee inrP"></i> <strong><span id="netPaybleAmt"><?php echo number_format($paybleAmt,2);?></span></strong></td>
								</tr>	
							</tbody>
						</table>
				 </div>
			</div>       
		 <div class="card-footer">
			<a href="<?php echo base_url('partner/order/make_payment/');?>" class="btn btn-outline-success waves-effect waves-light" style="float:right; margin-left:10px;">
			<i class="bx bx-save"></i> Proceed</a>
			<a href="<?php echo base_url('partner/order');?>" class="btn btn-outline-dark waves-effect waves-light" style="float:right;"><i class="bx bx-arrow-back"></i> Back</a>
		 </div>
	</div>	
     
	</div>
</div>
<!----------------------------edit order end------------------------------>
<script src="<?php echo base_url() ?>media/js/partner.min.js"></script>