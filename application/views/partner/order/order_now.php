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
					<div class="col-md-6">	
						<div class="slr_select">
						<div class="slr_title">
					 		<i class="bx bxl-product-hunt"></i> Seller Details
							<span class="srchToggle memAction" id="buy_saller"><i class="bx bx-plus"></i></span>
						 </div>
								
							<div style="padding: 65px;" id="searchByr">
								<div class="row">
									<div class="col-md-3"><span style="float:right; font-weight:bold;"><i class="bx bx-user-circle"></i> Seller Id</span></div>
									<div class="col-md-9"><span id="getTargetForBuyr">partner/order/findSeller</span>
											<input type="text" class="edtBltxt buyr" id="sellerID" name="sellerID">
											<input type="hidden" id="slrID" name="slrID">
											<button type="button" class="kartBtn byr_search memAction" id="findSeller" style="padding:2px 10px 2px 10px;">Search</button>
									</div>
								</div>
						  </div>	
								<table width="100%"  id="slrDetails" style="display:none;">
								  <tr>
								  <td width="22%" rowspan="5">
											<img id="slrPic" src="<?php echo base_url('uploads/user/no_image.png');?>"></td>
									  <td width="26%"  class="fright">Provider Code :</td>
									<td width="52%" class="fbold" id="slrCode"></td>
								  </tr>
										<tr>
											<td class="fright">Provider Name :</td>
											<td class="fbold" id="slrName"></td>
										</tr>
										<tr>
											<td class="fright">Address :</td>
											<td class="fbold" id="slrAddr">
								
											</td>
										</tr>
										<tr>
											<td class="fright">Contact Number :</td>
											<td class="fbold" id="slrContct"></td>
										</tr>
										<tr>
											<td class="fright">Email Id :</td>
											<td class="fbold" id="slrEmail"></td>
										</tr>
						  </table>
					  </div>
						
					</div>
					<div class="col-md-6">
						<div class="slr_select">
							<div class="slr_title">
								<i class="bx bxl-product-hunt"></i> Buyer Details
						  </div>
								<table width="100%">
								  <tr>
								  <td width="22%" rowspan="5">
											<img id="slrPic" src="<?php echo base_url($getBuyer->my_img);?>"></td>
									  <td width="26%"  class="fright">Provider Code :</td>
									<td width="52%" class="fbold" id="slrCode"><?php echo $getBuyer->username;?></td>
									
								  </tr>
										<tr>
											<td class="fright">Provider Name :</td>
											<td class="fbold" id="slrName"><?php echo $getBuyer->name;?></td>
										</tr>
										<tr>
											<td class="fright">Address :</td>
											<td class="fbold" id="slrAddr">
								<?php echo $getBuyer->address; if($getBuyer->stN){ echo ' ,<br>'.$getBuyer->ctyN.','.$getBuyer->stN.','.$getBuyer->zipcode;}?>
											</td>
										</tr>
										<tr>
											<td class="fright">Contact Number :</td>
											<td class="fbold" id="slrContct"><?php echo $getBuyer->mobile;?></td>
										</tr>
										<tr>
											<td class="fright">Email Id :</td>
											<td class="fbold" id="slrEmail"><?php echo $getBuyer->email;?></td>
										</tr>
						  </table>
					  </div>
					</div>
					<?php }else{?>
					<input type="hidden" id="slrID" value="<?php echo urlencode(base64_encode('spAdmn'));?>">
					<?php }?>
					<input type="hidden" id="soldBy" value="spAdmn">
					
					<!-- <div id="myResultShow"> </div>-->
					
					
					
					 <table class="table table-bordered table-striped text-nowrap" align="center" id="tempKartTble" >
						<thead class="hdr_clr" style="border:1px solid #058ba8;">
							<tr>
								<th>S No.</th>
								<th>Product Name</th>
								<th>Quantity</th>
								<th>B.V</th>
								<th>MRP</th>
								
								<th>Sell Price</th>
								<th>Discount</th>
								<th>Total Amount</th>
								
								<th>Tax</th>
								<th>Net Amount</th>
							</tr>
						</thead>
							<tbody>
								<?php if($this->u_cate=='1'){?>
								<tr>
									<td><strong>#</strong><input type="hidden" id="proID"></td>
									<td><input type="text" class="edtBltxt partAction" id="proName"><div id="proList" class="proList"><ul id="setProductList"></ul></div></td>
									<td><input class="ordBlTxt partAction" type="text" id="proQty"></td>
									<td id="bv"></td>
									<td id="mrp"></td>
									
									<td id="p_price"></td>
									<td id="tDiscount"></td>
									<td id="tAmt"></td>
									
									<td id="tTax"></td>
									<td><span id="tProPrice"></span><button class="kartBtn" onclick="addTempKart()"><i class="bx bx-plus"></i></button>
									</td>
								</tr>
								<?php }else{?>
								<tr>
									<td><strong>#</strong><input type="hidden" id="proID"></td>
									<td><input type="text" class="edtBltxt partAction" id="proNameByShop"><div id="proList" class="proList"><ul id="setProductList"></ul></div></td>
									<td><input class="ordBlTxt partAction" type="text" id="proQty"></td>
									<td id="bv"></td>
									<td id="mrp"></td>
									<td id="p_price"></td>
									<td id="tDiscount"></td>
									<td id="tAmt"></td>
									<td id="tTax"></td>
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
									$proPriceAfterDiscount=$tAmt-($tAmt*$dList->discount)/100;
									$netAmt=$proPriceAfterDiscount+($proPriceAfterDiscount*$dList->productTax)/100;
									
									?>
									
									<tr>
										<th><?php echo $ctr;?>. </th><td><?php echo $dList->product_name;?></td>
										<td id="pQty--<?php echo $dList->product_details_id;?>"><?php echo $dList->product_qty;?></td>
										<td><?php echo $dList->productBV;?></td>
										<td><i class="bx bx-rupee inrP"></i> <?php echo $dList->product_mrp;?></td>
										
										<td><i class="bx bx-rupee inrP"></i> <?php echo $dList->product_selling_price;?></td>
										<td><?php echo number_format($dList->discount,2);?> <i class="mdi mdi-percent-outline inrP"></i></td>
								<td id="tAmt--<?php echo $dList->product_details_id;?>"><i class="bx bx-rupee inrP"></i> <?php echo number_format($proPriceAfterDiscount,2);?></td>
										<td><?php echo $dList->productTax;?> <i class="mdi mdi-percent-outline inrR"></i></td>
										<td id="netAmt--<?php echo $dList->product_details_id;?>"><i class="bx bx-rupee inrP"></i> <?php echo number_format($netAmt,2);?>
										
									<button class="kartTrash" onclick="delTempKart('<?php echo $dList->id.'@@@@'.$dList->product_name; ?>')"><i class="bx bx-trash"></i></button>
										</td>
									</tr>
									<?php $grandTotal+=$netAmt;} ?>
								
									<?php }else{?>
									<tr id="data_not_found"><td colspan="9" align="center"><code>Ooop's there is no data found</code><br />
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
								
							</tbody>
						</table>
				 </div>
			</div>       
		 <div class="card-footer">
			<!--<a href="<?php //echo base_url('partner/order/make_payment/');?>" class="btn btn-outline-success waves-effect waves-light" style="float:right; margin-left:10px;">
			<i class="bx bx-save"></i> Proceed</a>-->
			<button type="button" id="makePay" class="btn btn-outline-success waves-effect waves-light actionCmd" style="float:right; margin-left:10px;">
			<i class="bx bx-save"></i> Proceed</button>
			<input type="hidden" id="targetUrl" value="<?php echo $targetUrl;?>" />
			<a href="<?php echo base_url('partner/order');?>" class="btn btn-outline-dark waves-effect waves-light" style="float:right;"><i class="bx bx-arrow-back"></i> Back</a>
		 </div>
	</div>	
     
	</div>
</div>


<div class="modal fade" id="deleteOrdModelByShopee" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		   <div class="modal-body">
			 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float:right;"></button>
				<div class="delMsg" id="saleMsg"> &nbsp;</div><div class="actnData" id="delSaleData">&nbsp; </div>
				   <div id="mdlFtrBtn">
						 <input type="hidden" id="cnfOrdDel_idByShopee">
				         <a href="javascript:void(0)" id="cnfOrdItemDeleteByShopee" class="btn btn-outline-danger waves-effect waves-light pull-right">
						    Confirm Delete <i class="bx bx-trash"></i>
						</a>
						<button type="button" class="btn btn-outline-dark pull-right" data-bs-dismiss="modal"><i class="bx bx-arrow-back"></i> Back </button>
				   </div>		
				</div>
		</div>
	</div>
</div>


<!----------------------------edit order end------------------------------>
<script src="<?php echo base_url() ?>media/js/partner.min.js"></script>