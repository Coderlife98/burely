<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $title ?> | <?php echo config_item('company_name') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?php echo config_item('company_name') ?>" name="description" />
    <meta content="<?php echo config_item('company_name') ?>" name="author" />
    <?php $this->load->view('partner/include/css') ?>
	<style>
		.getcAccP{margin-top: 20px;padding: 5px 0px 5px 5px; background-color:#e8e8e8;border: 1px solid #058ba8;}
	.getcAcc{margin-top: -180px;margin-left: 10rem;}
	.getcAcc ul{ list-style:none;}
	.getcAcc ul li{ padding:10px 0px 10px 0px;border-bottom: 1px dashed #454545;}
	.getcAcc ul li:last-child{border-bottom:0px;}
	.getcAcc ul li span{ font-weight:600;padding-left: 10px;}
	.getNotify{border: 1px solid #058ba8;/*padding: 28% 1% 28% 1%;*/background-color: #ddf0f4;color: #075464;}
	.getNotify ul{ list-style:none;margin-left: -2rem;}
	.getNotify ul li:first-child{ background-color: #058ba8;height: 50px;padding: 8px 0px 0px 10px;font-weight: bold;color: #f9f9f9;}
	.getNotify ul li{ height:99px;padding: 5px 0px 0px 10px;}
	.ntfy{ padding:10px; background-color:#005062;border-radius: 20px;}
	
	
	
	
#scroll-container{border-radius: 5px;height: 112px;overflow: hidden;margin: -3px 0px 0px 0px;}
#mi-scroll {height: 100%;-moz-transform: translateY(100%);-webkit-transform: translateY(100%);transform: translateY(100%);-moz-animation: my-animation 10s linear infinite;-webkit-animation: my-animation 10s linear infinite;animation: my-animation 10s linear infinite;}
#mi-scroll:hover {-moz-animation-play-state: paused;-webkit-animation-play-state: paused;animation-play-state: paused;cursor:pointer;}
@-moz-keyframes my-animation {from { -moz-transform: translateY(100%); }to { -moz-transform: translateY(-100%); }}
@-webkit-keyframes my-animation {from { -webkit-transform: translateY(100%); }to { -webkit-transform: translateY(-100%); }}
@keyframes my-animation {from {-moz-transform: translateY(100%);-webkit-transform: translateY(100%);transform: translateY(100%);}
to{-moz-transform: translateY(-100%);-webkit-transform: translateY(-100%);transform: translateY(-100%);}}
	</style>
</head>

<body data-sidebar="dark" data-sidebar-size="lg" class="sidebar-enable" data-topbar="dark">
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->   
    <!-- Loader   #005c71 -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php $this->load->view('partner/include/header') ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php $this->load->view('partner/include/left') ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
				     <div class="ami_toast tst_warning"><i class="bx bx-error"></i> ami popup notification</div>
					<?php //print_r($this->session->userdata);?>
                    <?php
					 if (!empty($layout) && trim($layout) !== "") {
                       require_once($layout);
                    } else { ?>
                        <!-- start page title -->
                        <div class="row">
						 <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
                                    <h4 class="mb-sm-0 font-size-16 fw-bold">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
						<!-- end page title -->
						<div class="row">
						<?php //print_r($totalSale);
						
						
						?>
						</div>
						
						
						
						
					    <div class="row">
                       	<div class="col-md-6">
						<div class="row">
							<div class="col-md-6 col-xl-6">
                                <div class="card bg-danger border-danger">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-cash-multiple text-danger"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-uppercase fw-semibold font-size-13 font_clr">Total Purchase</p>
                                            <h4 class="mb-1 mt-1 font_clr"><i class="bx bx-rupee"></i>
												<span class="counter-value " data-target="<?php if($totalPurchase){ echo $totalPurchase;}?>" >0</span>
											</h4>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-6 col-xl-6">
                                <div class="card bg-success border-success">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-cash-multiple text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font_clr text-uppercase fw-semibold font-size-13">Total Sale</p>
                                            <h4 class="mb-1 mt-1 font_clr"><i class="bx bx-rupee"></i>
												<span class="counter-value " data-target="<?php if($totalSale){ echo $totalSale;}?>">0</span>
											</h4>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
							<div class="col-md-6 col-xl-6">
                                <div class="card bg-danger border-danger">
								  <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-cash-multiple text-danger"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font_clr text-uppercase fw-semibold font-size-13">Security Amount</p>
                                            <h4 class="font_clr mb-1 mt-1"><i class="bx bx-rupee"></i> 
												<span class="counter-value" data-target="<?php if($securityAmt){ echo $securityAmt->amount;}?>">0</span>
											</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="card bg-success border-success">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-cash-multiple text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font_clr text-uppercase fw-semibold font-size-13">Earned Rs </p>
                                            <h4 class="font_clr mb-1 mt-1"><i class="bx bx-rupee"></i>
<span class="counter-value" data-target="<?php if($earnedBV->Bv){if($this->u_cate=='1'){echo $earnedBV->Bv*5/100;}else if($this->u_cate=='2'){echo $earnedBV->Bv*10/100;}}?>">0</span>
											</h4>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            
							<div class="col-md-12 col-xl-12">
                                <div class="card bg-dark border-dark">
								  <div class="card-body">
                                        <div class="float-end">
                                            <div class="avatar-sm mx-auto mb-4">
                                                <span class="avatar-title rounded-circle bg-light font-size-24">
                                                    <i class="mdi mdi-cash-multiple text-dark"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font_clr text-uppercase fw-semibold font-size-13">Total Eran B.V</p>
                                            <h4 class="font_clr mb-1 mt-1"><i class="bx bx-star"></i> 
												<span class="counter-value" data-target="<?php if($earnedBV->Bv){if($this->u_cate=='1'){echo $earnedBV->Bv;}else if($this->u_cate=='2'){echo $earnedBV->Bv;}}?>">0</span>
											</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
							 
						</div>	
						</div>	
							
						<div class="col-md-6">	
							    <div class="getNotify">
									<ul>
										 <li><i class="bx bx-news ntfy"></i> Latest Updates</li>
									     <li>
										 
												 <div id="scroll-container">
												  <div id="mi-scroll">
											<?php 
												if($notifDetails)
												{
													foreach($notifDetails as $listv)
													{?>      
													<div style=" font-weight:600; font-size:16px; "><?php echo $listv['subject'];?></div>
													<div style="font-size:14px; margin-bottom:10px;padding-left: 10px;"><?php echo $listv['message'];?></div>
												 <?php }}?>
												  </div>
												</div>
										 
										 
										 
										 </li>
									</ul>
									</div>
						    	<div class="getcAccP">
								<img src="<?php echo base_url();?>media/images/msdr_qrcd.png" alt="paymentQr">
								<div class="getcAcc">
										<ul>
											<li>Bank Name: <span><?php echo $accDetails->bank_name;?></span></li>
											<li>Account Number:<span><?php echo $accDetails->acc_number;?></span></li>
											<li>IFSC Code:<span><?php echo $accDetails->ifsc_code;?></span></li>
											<li>Branch:<span><?php echo $accDetails->branch;?></span></li>
										</ul>
								</div>
								</div>
						</div>	
						</div> <!-- end row-->
						 <?php 
						 //print_r($this->u_cate);
						 //print_r($totalSale);//echo '<br>'.$this->db->last_query();?>
					   <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4 dbTitle"><i class="bx bx-basket dbIcn"></i> Recent purchage history</h4>
                                        <div class="table-responsive">
										<table class="table table-hover table-striped align-middle table-centered table-nowrap mb-0">
                                           <thead class="hdr_clr">
										   <tr>
										   		<th>ID</th>
												<th>Invoice Id</th>
												<th><?php if($this->u_cate=='1'){echo 'Purchase By';}else{echo 'Frenchise Id';}?></th> 
												<th>Name</th> 
												<th>Mobile Number</th>
												<th>Total Amount</th>
												<th>Order Date</th>
												<th>Status</th>
										   		<th style="text-align: center !important">Action</th>
										   </tr></thead>
                                             <tbody>
                                             <?php 
											 
											 	//print_r($recentPurchase);
											 		if($recentPurchase)
											 		{
											 			$ct='0';
														foreach($recentPurchase as $recent)
														{ $ct++;
														//print_r($recent);
														$grandTotal=$recent->grand_total;
														if ($recent->order_status=='0'){$stsTex='Cancelled';$activeCls='ordCancel';} 
															else if ($recent->order_status=='1'){$stsTex='Placed';$activeCls='ordPlced';}
															else if ($recent->order_status=='2'){$stsTex ='Shipped';$activeCls='ordShipped';}
															else if ($recent->order_status=='3'){$stsTex='Delevered';$activeCls='ordDelevered';}
															else {$stsTex='Not Yet';$activeCls='setBtnGr dctive';}
															$getUid = base_url('partner/order/detials/'.urlencode(base64_encode($recent->invoice_id)));
															if($recent->soldBy=='1')
															{
																$purchaseBy=$this->common->getRowData('partners','id',$recent->seller_id);
																}
																else if($recent->soldBy=='0')
															{
																$purchaseBy=$this->dashboard->getEmpDet($recent->seller_id);
																}
													
													?>
														 <tr>
														 	  <th><?php echo $ct;?>.</th>
															  <td><?php  echo $recent->invoice_id;?></td>
															  <td><?php if($recent->soldBy=='1'){echo $purchaseBy->username;}else{echo 'Admin';}?></td>
															   <td style="text-transform:capitalize;"><?php echo $purchaseBy->name;?></td>
															    <td><?php echo $recent->mobile;?></td>
															  <td><i class="bx bx-rupee inrP"></i> <?php echo number_format($grandTotal,2);?></td>
															  <td><?php echo date('d-m-Y',strtotime($recent->order_date));?></td>
															  <td><div class="<?php echo $activeCls;?>"><?php echo $stsTex;?></div></td>
															  <td>
															  		<div style="text-align:center;">
										<a href="<?php echo $getUid;?>" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
											 						</div>
															 </td>
														</tr>
												  <?php }}else{?>
														       <tr><td colspan="9"><div class="noData">
																   <i class="bx bx-loader-circle bx-spin"></i> There is no recent purchase history
																   </div>
															   </td></tr>
														<?php }?>
											 
											 
                                                </tbody>
                                            </table>
                                       <span class="vwAll"><a href="<?php echo base_url('partner/order');?>">View All <i class="bx bx-right-arrow-alt"></i></a></span>		
                                        </div>
                                        <!--end table-responsive-->
                                    </div>
                                </div>
                            </div>
                        </div>  
					   <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4 dbTitle"><i class="bx bx-shopping-bag dbIcn"></i> Recent sale history</h4>
                                        <div class="table-responsive">
											<?php //print_r($recentSale);?>
											<table class="table table-hover table-striped align-middle table-centered table-nowrap mb-0">
											   <thead class="hdr_clr">
											   <tr>
													<th>ID</th>
													<th>Invoice Id</th>
													<th>Member Id</th> 
													<th>Name</th> 
													<th>Mobile Number</th>
													<th>Total Amount</th>
													<th>Sale Date</th>
													<th>Status</th>
													<th style="text-align: center !important">Action</th>
											   </tr></thead>
												 <tbody>
												 <?php 
														if($recentSale)
														{
															$ct='0';
															foreach($recentSale as $recent)
															{ $ct++;
															//print_r($recent);
															$grandTotal=$recent->grand_total;
															if ($recent->order_status=='0'){$stsTex='Cancelled';$activeCls='ordCancel';} 
																else if ($recent->order_status=='1'){$stsTex='Placed';$activeCls='ordPlced';}
																else if ($recent->order_status=='2'){$stsTex ='Shipped';$activeCls='ordShipped';}
																else if ($recent->order_status=='3'){$stsTex='Delevered';$activeCls='ordDelevered';}
																else {$stsTex='Not Yet';$activeCls='setBtnGr dctive';}
																$getUid = base_url('partner/sale/detials/'.urlencode(base64_encode($recent->invoice_id)));
														?>
															 <tr>
																  <th><?php echo $ct;?>.</th>
																  <td><?php  echo $recent->invoice_id;?></td>
																  <td><?php echo $recent->username;?></td>
																   <td style="text-transform:capitalize;"><?php echo $recent->name;?></td>
																	<td><?php echo $recent->mobile;?></td>
																  <td><i class="bx bx-rupee inrP"></i> <?php echo number_format($grandTotal,2);?></td>
																  <td><?php echo date('d-m-Y',strtotime($recent->order_date));?></td>
																  <td><div class="<?php echo $activeCls;?>"><?php echo $stsTex;?></div></td>
																  <td>
																		<div style="text-align:center;">
											<a href="<?php echo $getUid;?>" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
																		</div>
																 </td>
															</tr>
													  <?php }}else{?>
																   <tr><td colspan="9"><div class="noData"><i class="bx bx-loader-circle bx-spin"></i> 
																   							There is no recent purchase history</div>
																	</td></tr>
															<?php }?>
												 
												 
													</tbody>
												</table>
												
										<span class="vwAll"><a href="<?php echo base_url('partner/sale');?>">View All <i class="bx bx-right-arrow-alt"></i></a></span>		
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
					<div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4 dbTitle"><i class="bx bxs-shopping-bag-alt dbIcn"></i> Recent package sale history</h4>
                                        <div class="table-responsive">
											<?php //print_r($recentSale);?>
											<table class="table table-hover table-striped align-middle table-centered table-nowrap mb-0">
											   <thead class="hdr_clr">
											   <tr>
													<th>S No.</th>
													<th>Package Number</th>
													<th>Package Name</th>
													
													<th>Price</th> 
													<th>Pack B.V</th>
													<th>Member Id</th> 
													
													<th>Sale Date</th>
													
													<!--<th style="text-align: center !important">Action</th>-->
											   </tr></thead>
												 <tbody>
												 <?php 
														if($packageSale)
														{
															$ct='0';
															foreach($packageSale as $pack)
															{ $ct++;
															//print_r($recent);
/*															$grandTotal=$recent->grand_total+$recent->shipping_charge+($recent->grand_total*$recent->tax)/100;
															if ($recent->order_status=='0'){$stsTex='Cancelled';$activeCls='ordCancel';} 
																else if ($recent->order_status=='1'){$stsTex='Placed';$activeCls='ordPlced';}
																else if ($recent->order_status=='2'){$stsTex ='Shipped';$activeCls='ordShipped';}
																else if ($recent->order_status=='3'){$stsTex='Delevered';$activeCls='ordDelevered';}
																else {$stsTex='Not Yet';$activeCls='setBtnGr dctive';}
																$getUid = base_url('partner/sale/detials/'.urlencode(base64_encode($recent->invoice_id)));*/
																//print_r($pack);
														?>
															 <tr>
																  <th><?php echo $ct;?>.</th>
																  <td><?php echo $pack->pack_nu; ?></td>
																  <td><?php echo $pack->pack_name;?></td>
																   
																	 <td><i class="bx bx-rupee inrP"></i> <?php echo $pack->amount;?></td>
																	<td><?php echo $pack->pack_bv;?></td>
																 <td style="text-transform:capitalize;"><?php echo $pack->used_by;?></td>
																  <td><?php echo date('d-m-Y',strtotime($pack->used_date));?></td>
																 
																  <!--<td>
																		<div style="text-align:center;">
											<a href="<?php //echo $getUid;?>" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
																		</div>
																 </td>-->
															</tr>
													  <?php }}else{?>
																   <tr><td colspan="9"><div class="noData"><i class="bx bx-loader-circle bx-spin"></i> 
																   							There is no recent package sale history</div>
																	</td></tr>
															<?php }?>
												 
												 
													</tbody>
												</table>
												
										<span class="vwAll"><a href="<?php echo base_url('partner/package/manage');?>">View All <i class="bx bx-right-arrow-alt"></i></a></span>		
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>	
						
						
						
						
						
					<?php } ?>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
			<input type="hidden" id="base_url" value="<?php echo base_url();?>">
            <?php $this->load->view('partner/include/footer') ?>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <?php $this->load->view('partner/include/js') ?>
  </body>
</html>