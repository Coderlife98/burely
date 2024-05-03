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
	<form method="post" action="<?php echo base_url('partner/sale/make_payment');?>">	   	   		
		 <div class="card-body p-4" style="margin-bottom:-15px;">
				  <div class="row">
					 <?php //print_r($sellerData); ?>
					<div class="col-md-6">	
						<div class="slr_select">
						<div class="slr_title">
					 		<i class="bx bxl-product-hunt"></i> Seller Details
						 </div>
                         	<?php 
									if($this->u_cate=='1'){$prVdr='Frenchise ';}else if($this->u_cate=='2'){ $prVdr='Shopee';}else{$prVdr='Provider';}
								    if($this->u_cate=='1'){$purchaser='Shopee ';}else if($this->u_cate=='2'){ $purchaser='Member';}else{$purchaser='Provider';}	
								
								?>
								<table width="100%">
								  <tr>
								  <td width="22%" rowspan="5">
											<img id="slrPic" src="<?php echo base_url($sellerData->my_img);?>"></td>
									  <td width="26%"  class="fright"><?php echo $prVdr;?> Code :</td>
									<td width="52%" class="fbold" id="slrCode"><?php echo $sellerData->username;?></td>
								  </tr>
										<tr>
											<td class="fright">
												<?php echo $prVdr;?> Name :
                                            </td>
											<td class="fbold" id="slrName"><?php echo $sellerData->shop_name;?></td>
										</tr>
										<tr>
											<td class="fright">Address :</td>
											<td class="fbold" id="slrAddr">
								<?php echo $sellerData->address; if($sellerData->stN){ echo ' ,<br>'.$sellerData->ctyN.','.$sellerData->stN.','.$sellerData->zipcode;}?>
											</td>
										</tr>
										<tr>
											<td class="fright">Contact Number :</td>
											<td class="fbold" id="slrContct"><?php echo $sellerData->mobile;?></td>
										</tr>
										<tr>
											<td class="fright">Email Id :</td>
											<td class="fbold" id="slrEmail"><?php echo $sellerData->email;?></td>
										</tr>
									</table>
							 </div>
						
					</div>
					<div class="col-md-6">
						<div class="slr_select">
							<div class="slr_title">
								<i class="bx bxl-product-hunt"></i> Buyer Details
								<span class="srchToggle memAction" id="buy_saller"><i class="bx bx-plus"></i></span>
							 </div>
							 <div style="padding: 65px;" id="searchByr">
							 		<div class="row">
										<div class="col-md-3"><span style="float:right; font-weight:bold;"><i class="bx bx-user-circle"></i> Buyer Id</span></div>
										<div class="col-md-9"><span id="getTargetForBuyr">partner/sale/findBuyer</span>
												<input type="text" class="edtBltxt buyr" id="buyerID" name="buyerID">
												<input type="hidden" id="byrID" name="byrID">
												<button type="button" class="kartBtn byr_search memAction" id="findBuyer"  style="padding:2px 10px 2px 10px;">Search</button>
										</div>
									</div>
							 </div>
								<table width="100%" id="byrDetails" style="display:none;">
								  <tr>
								  <td width="22%" rowspan="5">
											<img id="byrPic" src="<?php echo base_url('uploads/user/no_image.png');?>"></td>
									  <td width="26%"  class="fright"><?php echo $purchaser;?> Code :</td>
									<td width="52%" class="fbold" id="byrCode">Put value here</td>
									
								  </tr>
										<tr>
											<td class="fright"><?php echo $purchaser;?> Name :</td>
											<td class="fbold" id="byrName"></td>
										</tr>
										<tr>
											<td class="fright">Address :</td>
											<td class="fbold" id="byrAddr"></td>
										</tr>
										<tr>
											<td class="fright">Contact Number :</td>
											<td class="fbold" id="byrContct"></td>
										</tr>
										<tr>
											<td class="fright">Email Id :</td>
											<td class="fbold" id="byrEmail"></td>
										</tr>
									</table>
							 </div>
							 
					</div>
<!---------------------------------------------------------->
					 <div id="myResultShow">
					 </div>				 
<!---------------------------------------------------------->					 
					 <input type="hidden" id="proNa" value=""><input type="hidden" id="avlPrQty">
					 <table class="table table-bordered table-striped" align="center" id="tempKartTble" >
						<thead class="hdr_clr" style="border:1px solid #058ba8;">
							<tr>
								<th>S No.</th>
								<th>Product Name</th>
								<th>Quantity</th>
								<th>B.V.</th>
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
									<td>
										 <input type="text" class="edtBltxt partAction tFull" id="proNameSaleByFrenchise" palaceholder="Find Product">
										 <div id="proList" class="proList"><ul id="setProductList"></ul></div>
									</td>
									<td><input class="ordBlTxt partAction" type="text" id="proQty"></td>
									<td id="pBV"></td><td id="mrp"></td>
									<td id="p_price"></td>
									
									<td id="tDiscount"></td>
									<td id="tAmt"></td>
									<td id="tTax"></td>
									<td><span id="tProPrice"></span><button class="kartBtn" type="button" onclick="createSale()"><i class="bx bx-plus"></i></button>
									</td>
								</tr>
								<?php }else{?>
								<tr>
									<td><strong>#</strong><input type="hidden" id="proID"><input type="hidden" id="frenchise" value="<?php echo $this->logId;?>"></td>
									<td>
										 <input type="text" class="edtBltxt partAction tFull" id="proNameSaleByShop"  palaceholder="Find Product">
										 <div id="proList" class="proList"><ul id="setProductList"></ul></div>
									</td>
									<td><input class="ordBlTxt partAction" type="text" id="proQty"></td>
									<td id="pBV"></td><td id="mrp"></td>
									<td id="p_price"></td>
									<td id="tDiscount"></td>
									<td id="tAmt"></td>
									<td id="tTax"></td>
									<td><span id="tProPrice"></span><button class="kartBtn" type="button" onclick="createSale()"><i class="bx bx-plus"></i></button>
									</td>
								</tr>
								<?php }?>
									<tr id="data_not_found"><td colspan="9" align="center"><code>Ooop's there is no data found</code><br />
									<img src="<?php echo base_url('uploads/addnewitem.svg');?>" style="height:200px;"><br /><br />
									<a href="<?php echo base_url('partner/order/add_kart');?>" class="text-success bolds">
									<i class="bx bx-shopping-bag"></i> Do you want o order now.
									</a>
									<br /><br />
									</td></tr>
							</tbody>
						</table>
					 <table class="table table-bordered table-striped" align="center" style="margin-top:-17px;">
							<tbody>
								<tr>
									<td id="miWidth"><strong>Grand Total</strong> </td>
									<td>
										 <i class="bx bx-rupee inrP"></i> 
										 <strong><span id="grantTotalAmt">0.00</span></strong></td>
								</tr>	
								
							</tbody>
						</table>
				 </div>
			</div>       
	
		<button type="submit" onclick="return makepayment()" class="btn btn-outline-success waves-effect waves-light" style="float:right; margin:0px 15px 30px 10px;">
			<i class="bx bx-save"></i> Proceed</button>
			<a href="<?php echo base_url('partner/sale');?>" class="btn btn-outline-dark waves-effect waves-light" style="float:right;"><i class="bx bx-arrow-back"></i> Back</a>
		
	</form>	 
	</div>	
     
	</div>
</div>





<div class="modal fade" id="deleteSaleModel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		   <div class="modal-body">
			 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float:right;"></button>
				<div class="delMsg" id="saleMsg"> &nbsp;</div><div class="actnData" id="delSaleData">&nbsp; </div>
				   <div id="mdlFtrBtn">
						 <input type="hidden" id="cnfSaleDel_id">
				         <a href="javascript:void(0)" id="cnfSaleItemDelete" class="btn btn-outline-danger waves-effect waves-light pull-right">
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