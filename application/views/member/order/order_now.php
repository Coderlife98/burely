<style>
.kartTrash{
margin-top: -25px;
  margin-left: 80px;
  }
 .kartBtn{margin-top: -5px;} 
  
</style>



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
					<a href="<?php echo base_url('member/order');?>" class="pull-right"><i class="bx bx-arrow-back"></i></a>
		   </div>		
	    <form method="post" action="<?php echo base_url('member/order/makePayment'); ?>">
			<div class="card-body p-4" style="margin-bottom:30px;">
				  <div class="row">
		 <?php 
				//print_r($getFrenchise);
				
					 ?>
					<span id="getTargetForFrenchise">member/order/getPartner</span>
					<div class="col-md-12">	
						<div class="slr_select">
						  <div class="slr_title"><i class="bx bxl-product-hunt"></i> Seller Details</div>	
							<div style="padding: 65px;" id="searchByr">
								<div class="row">
									<div class="col-md-2"><span style="float:right; font-weight:bold;"><i class="bx bx-user-circle"></i> Seller Type</span></div>
									<div class="col-md-4 mi-select">
											<select class="empSelectR" id="sellerType" name="sellerType">
												<option value="">--- Select One ---</option>
												<option value="1">Frenchise</option>
												<option value="2">Shopee</option>
											</select>
									</div>
									<div class="col-md-2"><span style="float:right; font-weight:bold;"><i class="bx bx-user-circle"></i> Seller Id</span></div>
									<div class="col-md-4"><span id="getTargetForBuyr">partner/order/findSeller</span>
											<input type="text" class="edtBltxt buyr" id="sellerID" name="sellerID" style="height:28px;margin: -2px 0px -8px -2px;">
											<input type="hidden" id="slrID" name="slrID"><button type="button" class="kartBtn byr_search memAction" id="findSeller">Search</button>
									</div>
								</div>
								<div class="partNr" id="selrDet">
									<ul>
										<li><span id="ptCode">Partner Code</span><span class="pcbc">:</span><span class="cntnt" id="slrCode">&nbsp;</span></li>
										<li><span id="ptNm">Partner Name</span><span class="pnbc">:</span><span class="cntnt" id="slrName">&nbsp;</span></li>
										<li><span>Properitor Name</span><span class="pnbc">:</span><span class="cntnt" id="slrProp">&nbsp;</span></li>
                                        <li><div>Address</div><div class="slrAddrbc">:</div><div class="cntnt" id="slrAddr">&nbsp;</div></li>
										<li><span>Email</span><span class="embc">:</span><span class="cntnt" id="slrEmail">&nbsp;</span></li>
										<li><span>Mobile</span><span class="mbc">:</span><span class="cntnt" id="slrContct">&nbsp;</span></li>
									</ul>
								</div>
						   </div>	
						</div>
					</div>
					<!-- <div id="myResultShow"></div>-->
				<div class="table-responsive">
				  <div id="search_data">
					 <table class="table table-bordered table-striped text-nowrap" align="center" id="tempKartTble" >
						<thead class="hdr_clr" style="border:1px solid #0576b9;">
							<tr>
								<th>S No.</th>
								<th>Product Name</th>
								<th>Quantity</th>
								<th>B.V</th>
								<th>MRP</th>
								<th>Product Price</th>
								<th>Discount</th>
								<th>Total Amount</th>
								<th>Tax</th>
								<th>Net Amount</th>
							</tr>
						</thead>
							<tbody>
								<tr>
									<td><strong>#</strong><input type="hidden" id="proID"></td>
									<td><input type="text" class="edtBltxt partAction" id="proNameByShop" style="width:100%;">
										<div id="proList" class="proList"><ul id="setProductList"></ul></div>
									</td>
									<td>
											<input class="ordBlTxt partAction" type="text" id="proQty">
									</td>
									<td id="bv"></td><td id="mrp"></td>
									<td id="p_price"></td>
									<td id="tDiscount"></td>
									<td id="tAmt"></td>
									<td id="tTax"></td>
									<td><span id="tProPrice"></span><button type="button" id="miKrtBtn" class="kartBtn" onclick="addTempKart()"><i class="bx bx-plus"></i></button>
									</td>
								</tr>
								
									<tr id="data_not_found"><td colspan="10" align="center"><code>Ooop's there is no data found</code><br />
									<img src="<?php echo base_url('uploads/addnewitem.svg');?>" style="height:200px;"><br /><br />
									<a href="<?php echo base_url('member/order/add_kart');?>" class="text-success bolds">
									<i class="bx bx-shopping-bag"></i> Do you want o order now.
									</a>
									<br /><br />
									</td></tr>
								
							</tbody>
						</table>
					 <table class="table table-bordered table-striped" align="center" style="margin-top:-17px;width: 100.9%;">
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
				 </div>
			</div>       
		    <div class="card-footer">
			<!--<a href="<?php //echo base_url('partner/order/make_payment/');?>" class="btn btn-outline-success waves-effect waves-light" style="float:right; margin-left:10px;">
			<i class="bx bx-save"></i> Proceed</a>-->
			<button type="submit" id="makePay" class="btn btn-outline-success waves-effect waves-light actionCmd" style="float:right; margin-left:10px;">
			<i class="bx bx-save"></i> Proceed</button>
			<input type="hidden" id="targetUrl" value="<?php echo $targetUrl;?>" />
			<a href="<?php echo base_url('partner/order');?>" class="btn btn-outline-dark waves-effect waves-light" style="float:right;"><i class="bx bx-arrow-back"></i> Back</a>
		 </div>
		 </form>
	</div>	
     
	</div>
</div>
<!----------------------------edit order end------------------------------>



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

<script src="<?php echo base_url() ?>media/js/msdr_member.min.js"></script>