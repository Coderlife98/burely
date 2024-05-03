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
<!----------------------------Edit Member strt----------------------------->
<?php 
//if($member['status']=='Active'){$status='text-success';}else if($member['status']=='Block'){$status='text-danger';}else{$status='text-info';}

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
					<a href="<?php echo base_url('partner/sale');?>" class="pull-right"><i class="bx bx-arrow-back"></i></a>
		   </div>		
			<div class="card-body p-4" style="margin-bottom:30px;">
				<div class="row">
				 <?php 
				 // 	print_r($ordHistory);
					/*if($this->u_cate=='1')
					{*/
					 ?>
						<span id="getTargetForFrenchise"><?php echo $targetActn;?></span>
						<div class="col-md-6">	
							<div class="slr_select">
							<div class="slr_title">
								<i class="bx bxl-product-hunt"></i> Seller Details
							 </div>
									<table width="100%">
									  <tr>
									  <td width="22%" rowspan="5">
												<img id="slrPic" src="<?php echo base_url($getFrenchise->my_img);?>"></td>
										  <td width="26%"  class="fright">Provider Code :</td>
										<td width="52%" class="fbold" id="slrCode"><?php echo $getFrenchise->username;?></td>
									  </tr>
											<tr>
												<td class="fright">Provider Name :</td>
												<td class="fbold" id="slrName"><?php echo $getFrenchise->name;?></td>
											</tr>
											<tr>
												<td class="fright">Address :</td>
												<td class="fbold" id="slrAddr">
									<?php echo $getFrenchise->address; if($getFrenchise->stN){ echo ' ,<br>'.$getFrenchise->ctyN.','.$getFrenchise->stN.','.$getFrenchise->zipcode;}?>
												</td>
											</tr>
											<tr>
												<td class="fright">Contact Number :</td>
												<td class="fbold" id="slrContct"><?php echo $getFrenchise->mobile;?></td>
											</tr>
											<tr>
												<td class="fright">Email Id :</td>
												<td class="fbold" id="slrEmail"><?php echo $getFrenchise->email;?></td>
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
						<input type="hidden" id="frenchise" value="<?php echo $getFrenchise->id;?>">
						<?php //}
						
						//print_r($ordHistory);
						
						?>
					<table class="table table-bordered table-striped" align="center" >
						<thead class="hdr_clr" style="border:1px solid #058ba8;">
							<tr>
								<th>S No.</th>
								<th>Product Name</th>
								<th>Quantity</th>
								<th>P. BV</th>
								<th>MRP</th>
								<th>Sell Price</th>
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
								   $netAmtAfterDiscount=$tAmt-($tAmt*$dList['discount'])/100;
								   $netAmt=$netAmtAfterDiscount+($netAmtAfterDiscount*$dList['productTax'])/100;
								?>
								
								<tr>
									<th><?php echo $ctr;?>. </th><td><?php echo $dList['product_name'];?></td><td><?php echo $dList['product_qty'];?></td>
									
									<td><?php echo $dList['productBv'];?></td>
									<td><i class="bx bx-rupee inrP"></i> <?php echo $dList['product_mrp'];?></td>
									<td><i class="bx bx-rupee inrP"></i> <?php echo $dList['product_selling_price'];?></td>
									<td><?php echo $dList['discount'];?> <i class="mdi mdi-percent-outline inrP"></i></td>
									<td><i class="bx bx-rupee inrP"></i> <?php echo number_format($netAmtAfterDiscount,2);?></td>
									<td><?php echo $dList['productTax'];?> <i class="mdi mdi-percent-outline inrR"></i></td>
									<td><i class="bx bx-rupee inrP"></i> <?php echo number_format($netAmt,2);?></td>
								</tr>
								<?php $grandTotal+=$netAmt;} 
									  $paybleAmt=$grandTotal;
									  $duesAmt=$grandTotal-$ordHistory['paid_amt'];
									  ?>
								<tr>
									<td colspan="4" style="text-align:right"><strong>Order Date</strong></td>
									<td><strong><?php echo date('d-m-Y',strtotime($ordHistory['order_date']));?></strong></td>
									<td colspan="4" style="text-align:right"><strong>Grand Total</strong></td><td><i class="bx bx-rupee inrP"></i> <strong><?php echo number_format($grandTotal,2);?></strong></td>
								</tr>
								<tr>
									<td colspan="4"  style="text-align:right"><strong>Delevery/Cancelled  Date</strong></td>
									<td><strong>
												<?php 
														if($ordHistory['delevery_date'])
														{echo date('d-m-Y',strtotime($ordHistory['delevery_date']));}
														else{ echo 'N/A';}
														?></strong></td>
									<td colspan="4" style="text-align:right"><strong>Paid Amt</strong> </td>
									<td><i class="bx bx-rupee inrP"></i> <strong>
												<?php echo number_format($ordHistory['paid_amt'],2);?></strong>
									</td>
								</tr>
								<tr> 
									<td colspan="4"  style="text-align:right"><strong>Order Status</strong></td>
									<td><strong><span id="orderStsDisply"><?php echo $stsTex;?></span></strong></td>
									<td colspan="4" style="text-align:right"><strong>Dues Amt</strong> </td><td><i class="bx bx-rupee inrP"></i> <strong><?php  echo number_format($duesAmt,2);?></strong></td>
								</tr>
								
				<?php if ($ordHistory['order_status']!='3'){?>	
								<tr> 
									
								
									<td colspan="9" style="text-align:right"><strong>Order Status</strong></td>
									<td><span class="mi-select miOPtn">
										<select class="empSelectR" id="ordSts">
											<option value="">--- Select One ---</option>
											  <option value="Cancelled" <?php if($ordHistory['order_status']=='0'){ echo 'selected="selected"';} ?> >Cancelled</option>
											  <option value="Delivered" <?php if($ordHistory['order_status']=='3'){ echo 'selected="selected"';} ?>  >Delivered </option> 
											</select>
									</span></td>
								</tr>
							
								<?php }}else{?>
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
		 <div class="card-footer">		
          <?php if ($ordHistory['order_status']!='3'){?>	 
		     <button type="button" class="btn btn-outline-success waves-effect waves-light memAction" style="float:right; margin-left:10px;" id="saleCnfrm">
			 		<i class="bx bx-save"></i> Submit
			 </button>
			<?php }?> 
<a href="<?php echo base_url('partner/order/get_preview/'.urlencode(base64_encode($invId)));?>" class="btn btn-outline-primary waves-effect waves-light" style="float:right;" target="_blank"><i class="bx bx-printer"></i> Print</a>
			<a href="<?php echo base_url('partner/sale');?>" class="btn btn-outline-dark waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
		 </div>
	</div>	
	</div>
</div>
<input type="hidden" id="orderID" value="<?php echo $ordHistory['id'];?>">
<!----------------------------edit Member end------------------------------>
<script src="<?php echo base_url() ?>media/js/partner.min.js"></script>