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
//print_r($ordHistory);

//if($member['status']=='Active'){$status='text-success';}else if($member['status']=='Block'){$status='text-danger';}else{$status='text-info';}
if($ordHistory)
{
		 if ($ordHistory->order_status=='Cancel'){$stsTex='<spna style="color:#db3e1c">Cancelled</span>';} 
	else if ($ordHistory->order_status=='Placed'){$stsTex='<spna style="color:#d0a600">Placed</span>';}
	else if ($ordHistory->order_status=='Pending'){$stsTex ='<spna style="color:#f89c1d">Pending</span>';}
	else if ($ordHistory->order_status=='Delivered'){$stsTex='<spna style="color:#00997b">Delevered</span>';}
	else {$stsTex='Not Yet';}
}
?>

<form method="post" action="<?php echo base_url('mlm_software/admin/sale/package_pay');?>">
<div class="row mb-4">

	<div class="col-xl-12">
	   <div class="card">
		   <div class="card-title amiCrdTitle">
					<i class="bx bx-notepad"></i> Invoice Id # <strong><?php echo $ordHistory->tnx_id;?></strong> 
					<a href="<?php echo base_url('mlm_software/admin/sale');?>" class="pull-right"><i class="bx bx-arrow-back"></i></a>
		   </div>		
			<div class="card-body p-4" style="margin-bottom:30px;">
				<div class="row">
				 <?php 
				 //	print_r($this->logId);
					 ?>
						<span id="getTargetForFrenchise">mlm_software/admin/sale/approved</span>
						<div class="col-md-6">	
							<div class="slr_select">
							<div class="slr_title">
								<i class="bx bx-buildings cmpmy" ></i> Company Details
							 </div>
									<table width="100%">
									  <tr>
									  <td width="22%" rowspan="2">
												<img id="slrPic" src="<?php echo base_url('media/images/'.config_item('mlm_logo_dark')); ?>"></td>
										  <td width="26%"  class="fright">Company Name :</td>
										<td width="52%" class="fbold" id="slrCode"><?php echo $this->session->userdata['company_name'];?></td>
									  </tr>
											<tr>
												<td class="fright">Address :</td>
												<td class="fbold" id="slrName"><?php echo $this->session->userdata['company_address'];?></td>
											</tr>
											
										</table>
								 </div>
							
						</div>
						<div class="col-md-6">
							<div class="slr_select">
								<div class="slr_title">
									<i class="bx bxl-product-hunt cmpmy"></i> Buyer Details
									<span class="srchToggle memAction" id="buy_saller"><i class="bx bx-plus"></i></span>
								 </div>
									 <div style="padding: 65px;" id="searchByr">
										<div class="row">
											<div class="col-md-3"><span style="float:right; font-weight:bold;"><i class="bx bx-user-circle"></i> Buyer Id</span></div>
											<div class="col-md-9"><span id="getTargetForBuyr">mlm_software/admin/sale/findBuyer</span>
													<input type="text" class="edtBltxt buyr" id="buyerID" name="buyerID">
													<input type="hidden" id="byrID" name="byrID">
													<button type="button" class="kartBtn byr_search memAction" id="findBuyerForPackage">Search</button>
											</div>
										</div>
									 </div>
									<table width="100%" id="byrDetails" style="display:none;">
									  <tr>
									  <td width="22%" rowspan="5">
												<img id="byrPic" src="<?php if($getBuyer){echo base_url($getBuyer->my_img);}?>"></td>
										  <td width="26%"  class="fright">Provider Code :</td>
										<td width="52%" class="fbold" id="byrCode"><?php if($getBuyer){echo $getBuyer->username;}?></td>
										
									  </tr>
											<tr>
												<td class="fright">Provider Name :</td>
												<td class="fbold" id="byrName"><?php if($getBuyer){echo $getBuyer->name;}?></td>
											</tr>
											<tr>
												<td class="fright">Address :</td>
												<td class="fbold" id="byrAddr">
									<?php if($getBuyer){echo $getBuyer->address; if($getBuyer->stN){ echo ' ,<br>'.$getBuyer->ctyN.','.$getBuyer->stN.','.$getBuyer->zipcode;}}?>
												</td>
											</tr>
											<tr>
												<td class="fright">Contact Number :</td>
												<td class="fbold" id="byrContct"><?php if($getBuyer){echo $getBuyer->mobile;}?></td>
											</tr>
											<tr>
												<td class="fright">Email Id :</td>
												<td class="fbold" id="byrEmail"><?php if($getBuyer){echo $getBuyer->email;}?></td>
											</tr>
										</table>
								 </div>
						</div>
						
						<!--<div id="myResultShow">Change here</div>-->
						
						
						<?php
						
						//print_r($ordHistory);
						
						?>
					<table class="table table-bordered table-striped" align="center" id="tempKartTble" >
						<thead class="hdr_clr" style="border:1px solid #914b00;">
							<tr>
								<th>S No.</th>
								<th>Package Name</th>
								<th>Quantity</th>
								<th>Amount</th>
								<th>Pacakge B.V</th>
								<th>Net Amount</th>
							</tr>
						</thead>
						<tbody>
						<tr class="dynamicRows arvDi" >
								<td>#</td>
								<td class="mi-select">
									<select id="package" class="empSelectR">
									    <option value="">--- Select One ---</option>
										<?php 
											  if($package)
												{
												foreach($package as $list)
												{
											?>
												<option value="<?php echo $list->id;?>"><?php echo $list->pack_name;?></option>
												<?php }}?>
									</select>
								</td>
								<td><input class="ordBlTxt partAction" type="text" id="packQty"><input type="hidden" id="txVl"></td>
								<td id="pcAmt"></td>
								<td id="pcBv"></td>
								<td>
								
								<span id="pcNetAmt"></span>
								<button class="kartBtn" type="button" onclick="createPackageSale()"><i class="bx bx-plus"></i></button>
								</td>
								</tr>
						
							<?php if($orderDetails)
							{ 
							$ctr=0;	$grandTotal=0;	
								foreach($orderDetails as $dList)
								{$ctr++;
								 //  $tAmt=$dList['product_selling_price']*$dList['product_qty'];
								   //$netAmt=$tAmt-($tAmt*$dList['discount'])/100;
								?>
								
								<tr>
									<th><?php echo $ctr;?>. </th><td><?php echo $dList['pack_nu'];?></td><td><i class="bx bx-rupee inrP"></i><?php echo $dList['amount'];?></td>
									<td><?php if($dList['status']=='Used'){echo '<span style="color:red">USED</span>';}else{echo '<span style="color:green">UN-USED</span>';}?></td>
									<td><?php if($dList['used_by']){echo $dList['used_by'];}else{echo 'N/A';}?></td>
									<td><i class="bx bx-rupee inrP"></i> 
										<?php if($dList['used_date']){echo date('d-m-Y',strtotime($dList['used_date']));}else{echo 'N/A';}?>
									</td>
									<td><i class="bx bx-rupee inrP"></i> <?php echo number_format($netAmt,2);?></td>
								</tr>
								<?php $grandTotal+=$netAmt;} //$paybleAmt=$grandTotal+$ordHistory['shipping_charge']+($grandTotal*$ordHistory['tax'])/100;?>
								<tr>
									
								
									<td colspan="6" style="text-align:right"><strong>Grand Total</strong> </td><td><i class="bx bx-rupee inrP"></i> <strong><?php echo number_format($grandTotal,2);?></strong></td>
								</tr>
								<tr>
									<td colspan="6" style="text-align:right"><strong>Tax</strong> </td><td><i class="mdi mdi-percent-outline inrP"></i> <strong>
									<?php //echo number_format($ordHistory['tax'],2);?></strong></td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:right"><strong>Order Date</strong></td>
									<td><strong><?php echo date('d-m-Y',strtotime($ordHistory->purchase_date));?></strong></td>
									<td colspan="3" style="text-align:right"><strong>Shipping Charges</strong> </td><td><i class="bx bx-rupee inrP"></i> <strong>
									<?php //echo number_format($ordHistory['shipping_charge'],2);?></strong></td>
								</tr>
								<tr>
									<td colspan="2"  style="text-align:right"><strong>Delevery/Cancelled  Date</strong></td>
									<td><strong>
												<?php 
														if($ordHistory->delivery_date)
														{echo date('d-m-Y',strtotime($ordHistory->delivery_date));}
														else{ echo 'N/A';}
														?></strong></td>
									<td colspan="3" style="text-align:right"><strong>Payble Amount</strong> </td>
									<td><i class="bx bx-rupee inrP"></i> <strong><?php echo number_format($paybleAmt,2);?></strong></td>
								</tr>
								<tr> 
									<td colspan="2"  style="text-align:right"><strong>Order Status</strong></td>
									<td><strong><span id="orderStsDisply"><?php echo $stsTex;?></span></strong></td>
									<td colspan="3" style="text-align:right"><strong>Paid Amt</strong> </td><td><i class="bx bx-rupee inrP"></i> <strong>
									<?php //echo number_format($ordHistory['paid_amt'],2);?></strong></td>
								</tr>
								<tr> 
									<td colspan="6" style="text-align:right"><strong>Order Status</strong></td>
									<td><span class="mi-select miOPtn">
										<select class="empSelectR" id="ordSts">
											<option value="">--- Select One ---</option>
											  <option value="Cancelled" <?php if($ordHistory->order_status=='Cancel'){ echo 'selected="selected"';} ?> >Cancelled</option>
											  <option value="Delivered" <?php if($ordHistory->order_status=='Delivered'){ echo 'selected="selected"';} ?>  >Delivered </option> 
											</select>
									</span></td>
								</tr>
								<?php }else{?>
								<tr id="data_not_found"><td colspan="7" align="center"><code>Ooop's there is no data found</code><br />
								<img src="<?php echo base_url('uploads/addnewitem.svg');?>" style="height:200px;"><br /><br />
								<a href="<?php echo base_url('partner/order/add_kart');?>" class="text-success bolds">
								<i class="bx bx-shopping-bag"></i> Do you want o order now.
								</a>
								<br /><br />
								</td></tr>
							<?php 
							}?>
							
							<tr style="display:none" class="amisingh">
									<td colspan="5" style="text-align:right"><strong>Grand Total</strong> </td>
									<td><i class="bx bx-rupee inrP"></i> <strong id="grantTotalAmt">0.00</strong></td>
								</tr>
								<!--<tr style="display:none" class="amisingh">
									<td colspan="5" style="text-align:right"><strong>Tax</strong> </td>
									<td><i class="mdi mdi-percent-outline inrP"></i> <strong id="texPer">0.00</strong></td>
								</tr>
								<tr style="display:none" class="amisingh">
									<td colspan="5" style="text-align:right"><strong>Total Amount after tax</strong> </td>
									<td><i class="bx bx-rupee inrP"></i> <strong id="netPaybleAmt">0.00</strong></td>
								</tr>-->
								
								<tr style="display:none" class="mkPaym">
									<td colspan="5" style="text-align:right"><strong>Payble Amount</strong> </td>
									<td><i class="bx bx-rupee inrP"></i> <input class="ordBlTxt" type="text" id="paybleAmt" name="paybleAmt"></td>
								</tr>
								
								
								
								
								
							</tbody>
					</table>
				</div>
			</div>       
		 <div class="card-footer">		
             <button type="button" class="btn btn-outline-success waves-effect waves-light actionCmd amisingh mid" id="packageSaleProceed">
			 	<i class="bx bx-money"></i> Make Payment
			</button>
		    <button type="submit" class="btn btn-outline-success waves-effect waves-light mid" id="packageSale" onclick="return makePayPackage()">
				<i class="bx bx-save"></i> Submit 
			</button>			 
			 
			 
			 
			 
<!--<a href="<?php //echo base_url('mlm_software/admin/sale/get_preview/'.urlencode(base64_encode($invId)));?>" class="btn btn-outline-primary waves-effect waves-light" style="float:right;" target="_blank"><i class="bx bx-printer"></i> Print</a>-->
			<a href="<?php echo base_url('mlm_software/admin/sale/package');?>" class="btn btn-outline-dark waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
		 </div>
	</div>	
	</div>
</div>
</form>



<div class="modal fade" id="deleteSaleModel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		   <div class="modal-body">
			 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float:right;"></button>
				<div class="delMsg" id="saleMsg"> &nbsp;</div><div class="actnData" id="delSaleData">&nbsp; </div>
				   <div id="mdlFtrBtn">
						 <input type="hidden" id="cnfSaleDel_id">
				         <a href="javascript:void(0)" id="cnfPackageItemDelete" class="btn btn-outline-danger waves-effect waves-light pull-right actionCmd">
						    Confirm Delete <i class="bx bx-trash"></i>
						</a>
						<button type="button" class="btn btn-outline-dark pull-right" data-bs-dismiss="modal"><i class="bx bx-arrow-back"></i> Back </button>
				   </div>		
				</div>
		</div>
	</div>
</div>
<!----------------------------edit Member end------------------------------>
<script src="<?php echo base_url() ?>media/js/partner.min.js"></script>