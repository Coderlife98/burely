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
<!----------------------------Edit  strt----------------------------->
<?php 
//if($['status']=='Active'){$status='text-success';}else if($['status']=='Block'){$status='text-danger';}else{$status='text-info';}

if ($ordHistory['order_status']=='0'){$stsTex='<spna style="color:#db3e1c">Cancelled</span>';} 
else if ($ordHistory['order_status']=='1'){$stsTex='<spna style="color:#aca100">Placed</span>';}
else if ($ordHistory['order_status']=='2'){$stsTex ='<spna style="color:#b1ece0">Shipped</span>';}
else if ($ordHistory['order_status']=='3'){$stsTex='<spna style="color:#00997b">Delevered</span>';}
else {$stsTex='Not Yet';}

?>
<div class="row mb-4">
	<div class="col-xl-12">
	   <div class="card">
		   <div class="card-title amiCrdTitle">
					<i class="bx bx-notepad"></i> Invoice Id #<strong><?php echo $invId;?></strong> 
					<a href="<?php echo base_url('partner/order');?>" class="pull-right"><i class="bx bx-arrow-back"></i></a>
		   </div>		
			<div class="card-body p-4" style="margin-bottom:30px;">
				<div class="row">
					<?php 
							//print_r($ordHistory); 
							if($ordHistory['soldBy']=='0'){echo '<div class="col-md-12"><div class="ordrPrcss"><i class="bx bx-shopping-bag"></i> Order processed by Admin</div></div>';}
							else{echo '<div class="col-md-12"><div class="frmFrenchise"><i class="bx bx-shopping-bag"></i> Order processed by Frenchise</div></div>';}
					?>		
				</div>
				
				
				<div class="row">
					<div class="col-md-6">	
					  <div class="slr_select">
						<div class="slr_title">
					 		<i class="bx bxl-product-hunt"></i> Seller Details
					    </div>
							<?php if($sellerData){?>
								<table width="100%">
								  <tr>
								  <td width="22%" rowspan="5">
											<img id="slrPic" src="<?php echo base_url($sellerData->my_img);?>"></td>
									  <td width="26%"  class="fright">Provider Code :</td>
									<td width="52%" class="fbold" id="slrCode"><?php echo $sellerData->username;?></td>
								  </tr>
										<tr>
											<td class="fright">Provider Name :</td>
											<td class="fbold" id="slrName"><?php echo $sellerData->name;?></td>
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
							 <?php }else{?>
							 <table width="100%">
								  <tr>
								  <td width="30%">
											<img id="slrPic" style="width:150px;" src="<?php echo base_url('media/images/cmpny_logo.png');?>"></td>
									  <td colspan="2" style="text-align:center;">
									  <strong><?php echo $this->session->userdata('company_name');?></strong>
											<br><?php echo $this->session->userdata('company_address');?>
									  </td>
								  </tr>
									</table>
							 <?php }?>
					  </div>
						
					</div>	
						<div class="col-md-6">
						<div class="slr_select">
							<div class="slr_title">
								<i class="bx bxl-product-hunt"></i> Buyer Details
							 </div>
								<table width="100%">
								  <tbody><tr>
								  <td width="22%" rowspan="5">
											<img id="slrPic" src="<?php echo base_url($member->my_img);?>"></td>
									  <td width="26%" class="fright">Provider Code :</td>
									<td width="52%" class="fbold" id="slrCode"><?php echo $member->username;?></td>
									
								  </tr>
										<tr>
											<td class="fright">Provider Name :</td>
											<td class="fbold" id="slrName"><?php echo $member->name;?></td>
										</tr>
										<tr>
											<td class="fright">Address :</td>
											<td class="fbold" id="slrAddr">
								<?php echo $member->address; if($member->stN){ echo ' ,<br>'.$member->ctyN.','.$member->stN.','.$member->zipcode;}?>								</td>
										</tr>
										<tr>
											<td class="fright">Contact Number :</td>
											<td class="fbold" id="slrContct"><?php echo $member->mobile;?></td>
										</tr>
										<tr>
											<td class="fright">Email Id :</td>
											<td class="fbold" id="slrEmail"><?php echo $member->email;?></td>
										</tr>
									</tbody></table>
							 </div>
					</div>
					
					<div class="col-md-12">
						<table class="table table-bordered table-striped" align="center" >
						<thead class="hdr_clr" style="border:1px solid #058ba8;">
							<tr>
								<th>S No.</th>
								<th>Product Name</th>
								<th>P. B.V</th>
								<th>MRP</th>
								<th>Sell Price</th>
								<th>Quantity</th>
								<th>Discount</th>
								<th>Total Amount</th>
								<th>Tax</th>
								<th>Net Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php if($orderDetails)
							{ 
							$ctr=0;	$grandTotal=0;	
								foreach($orderDetails as $dList)
								{$ctr++;
								   $tAmt=$dList['product_selling_price']*$dList['product_qty'];
								   //$netAmt=$tAmt-($tAmt*$dList['discount'])/100;
								   
								  $amtAfterDiscount=$tAmt-($tAmt*$dList['discount'])/100;
								  $netAmt=$amtAfterDiscount+($amtAfterDiscount*$dList['productTax'])/100; 
								   
								   
								   
								   
								?>
								
								<tr>
									<th><?php echo $ctr;?>. </th><td><?php echo $dList['product_name'];?></td>
									<td><?php echo $dList['productBv'];?></td>
									<td><i class="bx bx-rupee inrP"></i> <?php echo $dList['product_mrp'];?></td>
									<td><i class="bx bx-rupee inrP"></i> <?php echo $dList['product_selling_price'];?></td>
									<td><?php echo $dList['product_qty'];?></td>
									<td><?php echo number_format($dList['discount'],2);?> <i class="mdi mdi-percent-outline inrP"></i></td>
									<td><i class="bx bx-rupee inrP"></i> <?php echo number_format($amtAfterDiscount,2);?></td>
									<td><?php echo $dList['productTax'];?> <i class="mdi mdi-percent-outline inrR"></i></td>
									<td><i class="bx bx-rupee inrP"></i> <?php echo number_format($netAmt,2);?></td>
								</tr>
								<?php $grandTotal+=$netAmt;} 
								
								$duesAmt=$grandTotal-$ordHistory['paid_amt'];
								
								?>
								
								<tr>
									<td colspan="3" style="text-align:right"><strong>Order Date</strong></td>
									<td><strong><?php echo date('d-m-Y',strtotime($ordHistory['order_date']));?></strong></td>
									<td colspan="5" style="text-align:right"><strong>Grand Total</strong> </td><td><i class="bx bx-rupee inrP"></i><strong><?php echo number_format($grandTotal,2);?></strong></td>
								</tr>
								<tr>
									<td colspan="3"  style="text-align:right"><strong>Delevery/Cancelled  Date</strong></td>
									<td><strong>
												<?php 
														if($ordHistory['delevery_date'])
														{echo date('d-m-Y',strtotime($ordHistory['delevery_date']));}
														else{ echo 'N/A';}
														?></strong></td>
									<td colspan="5" style="text-align:right"><strong>Paid Amt</strong> </td><td><i class="bx bx-rupee inrP"></i><strong><?php echo number_format($ordHistory['paid_amt'],2);?></strong></td>
								</tr>
								<tr> 
									<td colspan="3"  style="text-align:right"><strong>Order Status</strong></td>
									<td><strong><?php echo $stsTex;?></strong></td>
									<td colspan="5" style="text-align:right"><strong>Dues Amount</strong> </td>
									<td>
											<i class="bx bx-rupee inrP"></i>
											<strong><?php echo number_format($duesAmt,2);?></strong>
									</td>
								</tr>								
								<?php }else{?>
								<tr><td colspan="10" align="center"><code>Ooop's there is no data found</code><br />
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
					</div>
				</div>
			</div>       
		 <div class="card-footer">
			<a href="<?php echo base_url('partner/order/get_preview/'.urlencode(base64_encode($invId)));?>" class="btn btn-outline-success waves-effect waves-light" style="float:right; margin-left:10px;" target="_blank">
			<i class="bx bx-printer"></i> Print</a>
			<a href="<?php echo base_url('partner/order');?>" class="btn btn-outline-dark waves-effect waves-light" style="float:right;"><i class="bx bx-arrow-back"></i> Back</a>
		 </div>
	</div>	
	</div>
</div>
<input type="hidden" id="target" value="partner/order/my_orders">
<!----------------------------edit  end------------------------------>
<script src="<?php echo base_url() ?>media/js/partner.min.js"></script>