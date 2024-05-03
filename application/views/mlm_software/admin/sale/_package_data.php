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
<div class="row mb-4">

	<div class="col-xl-12">
	   <div class="card">
		   <div class="card-title amiCrdTitle">
					<i class="bx bx-notepad"></i> Invoice Id # <strong><?php echo $ordHistory->tnx_id;?></strong> 
					<a href="<?php echo base_url('mlm_software/admin/sale/package');?>" class="pull-right"><i class="bx bx-arrow-back"></i></a>
		   </div>		
			<div class="card-body p-4" style="margin-bottom:30px;">
				<div class="row">
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
								</div>			 
									<table width="100%" id="byrDetails">
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
						<?php //print_r($orderDetails[0]);?>
					<table class="table table-bordered table-striped" align="center" id="tempKartTble" >
						<thead class="hdr_clr" style="border:1px solid #914b00;">
							<tr>
								<th>S No.</th>
								<th>Package Name</th>
								<th>Package Number</th>
								<th>Status</th>
								<th>Sell By</th>
								<th>Sale Date</th>
								<th>Pacakge B.V</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
						<?php if($orderDetails)
							{ 
							$ctr=0;	$grandTotal=0;	
								foreach($orderDetails as $dList)
								{$ctr++;
								?>
								<tr>
									<th><?php echo $ctr;?>. </th>
									<td><?php echo $dList['pack_name'];?></td>
									<td><?php echo $dList['pack_nu'];?></td>
									<td><?php if($dList['status']=='Used'){echo '<span style="color:red;font-weight:600; ">USED</span>';}
											  else{echo '<span style="color:green;font-weight:600;">UN-USED</span>';}?></td>
									<td><?php if($dList['used_by']){echo $dList['used_by'];}else{echo 'N/A';}?></td>
									<td> <?php if($dList['used_date']){echo date('d-m-Y',strtotime($dList['used_date']));}else{echo 'N/A';}?></td>
									<td><?php echo $dList['pack_bv'];?></td><td><i class="bx bx-rupee inrP"></i><?php echo $dList['amount'];?></td>
								</tr>
								<?php $grandTotal+=$dList['amount'];} //$paybleAmt=$grandTotal+$ordHistory['shipping_charge']+($grandTotal*$ordHistory['tax'])/100;?>
								<tr>
									<td colspan="7" style="text-align:right"><strong>Grand Total</strong> </td>
									<td><i class="bx bx-rupee inrP"></i> <strong><?php echo number_format($grandTotal,2);?></strong></td>
								</tr>
								<tr>
									<td colspan="3" style="text-align:right"><strong>Order Date</strong></td>
									<td><strong><?php echo date('d-m-Y',strtotime($ordHistory->purchase_date));?></strong></td>
									<td colspan="3" style="text-align:right"><strong>Tax</strong></td>
									<td><i class="mdi mdi-percent-outline inrP"></i><strong> <?php if($ordHistory){echo $ordHistory->tax;}?></strong></td>
								</tr>
								<tr>
									<td colspan="3"  style="text-align:right"><strong>Delevery/Cancelled  Date</strong></td>
									<td><strong>
												<?php 
														if($ordHistory->delivery_date)
														{echo date('d-m-Y',strtotime($ordHistory->delivery_date));}
														else{ echo 'N/A';}
														
														$txblAmt=$grandTotal+($grandTotal*$ordHistory->tax)/100; 
														
														?></strong></td>
									<td colspan="3" style="text-align:right"><strong>Payble Amount After tax</strong> </td>
									<td><i class="bx bx-rupee inrP"></i> <strong><?php echo number_format($txblAmt,2);?></strong></td>
								</tr>
								<tr> 
									<td colspan="3"  style="text-align:right"><strong>Order Status</strong></td>
									<td><strong><span id="orderStsDisply"><?php echo $stsTex;?></span></strong></td>
									<td colspan="3" style="text-align:right"><strong>Paid Amt</strong> </td>
									<td><i class="bx bx-rupee inrP"></i> <strong><?php echo number_format($ordHistory->paid_amt,2);?></strong></td>
								</tr>
								
								<?php }else{?>
								<tr id="data_not_found"><td colspan="8" align="center"><code>Ooop's there is no data found</code><br />
								<img src="<?php echo base_url('uploads/addnewitem.svg');?>" style="height:200px;"><br /><br />
								<a href="<?php echo base_url('mlm_software/admin/sale/package/add');?>" class="text-success bolds">
								<i class="bx bx-shopping-bag"></i> Do you want o order now.
								</a>
								<br /><br />
								</td></tr>
							<?php }?>
							</tbody>
					</table>
				</div>
			</div>       
		 <div class="card-footer">		
          	 
<!--<a href="<?php //echo base_url('mlm_software/admin/sale/get_preview/'.urlencode(base64_encode($invId)));?>" class="btn btn-outline-primary waves-effect waves-light" style="float:right;" target="_blank"><i class="bx bx-printer"></i> Print</a>-->
			<a href="<?php echo base_url('mlm_software/admin/sale/package');?>" class="btn btn-outline-dark waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
		 </div>
	</div>	
	</div>
</div>
<!----------------------------edit Member end------------------------------>
<script src="<?php echo base_url() ?>media/js/partner.min.js"></script>