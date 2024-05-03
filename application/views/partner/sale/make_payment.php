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
<!----------------------------Edit make_payment strt----------------------------->
<div class="row mb-4">
	<div class="col-xl-12">
	   <div class="card">
		   <div class="card-title amiCrdTitle">
			    <i class="bx bx-shopping-bag"></i> <?php echo $oprsnTitle;?>
				<a href="<?php echo base_url('partner/sale/create');?>" class="pull-right"><i class="bx bx-arrow-back"></i></a>
		   </div>
			<div class="card-body p-4" style="margin-bottom:30px;margin-top: -10px;">
			  <?php //print_r($buyer);?>
			  
			  
			   <div class="row">	
					  <div class="col-xl-4">
						<div style="padding:0px 0px 20px 15px; color:#403f3f;">
						   <h4>From</h4>
						    <?php if($seller){ ?>
							<strong><span class="shoppingN"><?php echo $seller->name;?></span></strong><br>
							 Member Id :<strong><?php echo $seller->username;?></strong><br>
							 <?php echo $seller->address;?>,<br>
					  		 <?php echo $seller->ctyN.' ,'.$seller->stN;?>,<br>
							 Contact Number: <?php echo $seller->mobile;?><br>
							 Zipcode:  <?php echo $seller->zipcode;?><br>
							<?php }else{?>
						<strong><?php echo $this->session->userdata('company_name');?></strong>
							<br><?php echo $this->session->userdata('company_address');
							}?>
						</div>
					  </div>	
					  <div class="col-xl-4">
						<div style="padding:1px 0px 4px 20px; color:#403f3f;">
						<h4>To</h4>
			       			 <strong><span class="shoppingN"><?php echo $buyer->name;?></span></strong><br>
							 Member Id :<strong><?php echo $buyer->username;?></strong><br>
							 <?php if($buyer->address){ echo $buyer->address;?>,<br>
					  		 <?php }if($buyer->stN) {echo $buyer->ctyN.' ,'.$buyer->stN.',<br>';}?>
							 Contact Number: <?php echo $buyer->mobile;?><br>
							 Zipcode:  <?php echo $buyer->zipcode;?><br>
						</div>
					  </div>	
					  <div class="col-xl-4">
					 		<div style="text-align:center;height:100%;padding-top:15%;"> 
									Order Id : <strong>#<?php echo $ordID;?></strong><br />
					 		 		Order Date : <strong><?php echo date('d-m-Y');?></strong>
									<br />
					  		</div>
					  </div>
					
				</div>	
				  <div class="row">
					 <?php //print_r($tempSaleDetails);?>
					 <table class="table table-bordered table-striped" align="center" id="tempKartTble" >
						<thead class="hdr_clr" style="border:1px solid #058ba8;">
							<tr>
								<th>S No.</th>
								<th>Product Name</th>
								<th>Quantity</th>
								<th>BV</th>
								<th>MRP</th>
								<th>Sell Price</th>
								<th>Discount</th>
								<th>Total Amount</th>
								<th>Tax</th>
								<th>Net Amount</th>
							</tr>
						</thead>
							<tbody>
								<?php if($tempSaleDetails)
								{ 
								$ctr=0;	$grandTotal=0;	
									foreach($tempSaleDetails as $dList)
									{$ctr++;
									$tAmt=$dList['product_selling_price']*$dList['product_qty'];
									$netAmtAftrDis=$tAmt-($tAmt*$dList['discount'])/100;
									$netAmt=$netAmtAftrDis+($netAmtAftrDis*$dList['productTax'])/100;
									?>
									<tr>
										<th><?php echo $ctr;?>. </th><td><?php echo $dList['product_name'];?></td>
										<td><?php echo $dList['product_qty'];?></td>
										<td><?php echo $dList['productBV'];?></td>
										<td><i class="bx bx-rupee inrP"></i> <?php echo $dList['product_mrp'];?></td>
										<td><i class="bx bx-rupee inrP"></i> <?php echo $dList['product_selling_price'];?></td>
										<td><?php echo $dList['discount'];?> <i class="mdi mdi-percent-outline inrP"></i></td>
										<td><i class="bx bx-rupee inrP"></i> <?php echo number_format($netAmtAftrDis,2);?></td>
										<td><?php echo $dList['productTax'];?> <i class="mdi mdi-percent-outline inrR"></i></td>
										<td><i class="bx bx-rupee inrP"></i> <?php echo number_format($netAmt,2);?>
										</td>
									</tr>
									<?php $grandTotal+=$netAmt; $soldBy=$dList['soldBy'];$seller_id=$dList['seller_id'];}?>
									<tr>
										<td colspan="9" style="text-align:right"><strong>Grand Total</strong> </td>
										<td><i class="bx bx-rupee inrP"></i> <strong><?php echo number_format($grandTotal,2);?></strong></td>
									</tr>	
									
									<tr>
										<td colspan="9" style="text-align:right"><strong>Payble Amount</strong> </td>
										<td><i class="bx bx-rupee inrP"></i> <input class="ordBlTxt" type="text" id="paybleAmt"></td>
									</tr>
									
										
									<?php }else{?>
									<tr id="data_not_found"><td colspan="10" align="center"><code>Ooop's there is no data found</code><br />
									<img src="<?php echo base_url('uploads/addnewitem.svg');?>" style="height:200px;"><br /><br />
									<a href="<?php echo base_url('partner/order/add_kart');?>" class="text-success bolds">
									<i class="bx bx-shopping-bag"></i> Do you want o order now.
									</a>
									<br /><br />
									</td></tr>
								<?php 
								}
					            $saleID=urlencode(base64_encode($ordID.'@@@@@'.$grandTotal.'@@@@@'.$buyer->id.'@@@@@'.$adminCharge->shipping_charges.'@@@@@'.$adminCharge->tax.'@@@@@'.$byUserName));
								?>	
							</tbody>
						</table>
						
				<!--	<div id="checkMiResult">Texting Check</div>	-->
						
						
				 </div>	
			</div>       
		 <div class="card-footer">
			<button type="button" class="btn btn-outline-success waves-effect waves-light memAction" id="proceedToPayment" style="float:right; margin-left:10px;">
			<i class="bx bx-save"></i> Make Payment</button>
			<a href="<?php echo base_url('partner/sale/create');?>" class="btn btn-outline-dark waves-effect waves-light" style="float:right;"><i class="bx bx-arrow-back"></i> Back</a>
		 </div>
	</div>		
	</div>
</div>
<input type="hidden" id="saleID" value="<?php echo $saleID;?>">
<input type="hidden" id="target" value="<?php echo base_url('partner/sale/payment_success'); ?>">
<!----------------------------edit make_payment end------------------------------>
<script src="<?php echo base_url() ?>media/js/partner.min.js"></script>