<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $title ?> | <?php echo config_item('company_name') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?php echo config_item('company_name') ?>" name="description" />
    <meta content="<?php echo config_item('company_name') ?>" name="author" />
    <?php $this->load->view('super_admin/include/css') ?>
</head>

<body data-sidebar="brand">
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
        <?php $this->load->view('super_admin/include/header') ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php $this->load->view('super_admin/include/left') ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
				<div class="ami_toast tst_warning"><i class="bx bx-error"></i> ami popup notification</div>
				
				
					<?php //print_r($this->session->userdata);?>
                    <?php if (!empty($layout) && trim($layout) !== "") {
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
                        <?php //print_r($tRevenue->val);?>
					    <div class="row">
                       		<?php
									
									if($lBalnce)
									{
										$availableB=$lBalnce->credit-$lBalnce->debit;
										$avDebit=$lBalnce->debit;
										$avCredit=$lBalnce->credit;
										}
									else
									{
									$availableB='0';
									$avDebit='0';
									$avCredit='0';
										}
									?>
							<div class="col-md-6 col-xl-3">
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
											<p class="text-uppercase fw-semibold font-size-13 font_clr">Balance Amount</p>
											<h4 class="mb-1 mt-1 font_clr"><i class="bx bx-rupee"></i><span class="counter-value" data-target="<?php echo $availableB;?>">0</span></h4>
										</div>
									  
									</div>
								</div>
							</div> 
							<div class="col-md-6 col-xl-3">
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
											<p class="text-uppercase fw-semibold font-size-13 font_clr">All Debit</p>
											<h4 class="mb-1 mt-1 font_clr"><i class="bx bx-rupee"></i><span class="counter-value" data-target="<?php echo $avDebit;?>">0</span></h4>
										</div>
									   
									</div>
								</div>
							</div>
							<div class="col-md-6 col-xl-3">
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
											<p class="text-uppercase fw-semibold font-size-13 font_clr">T.Business Amount</p>
											<h4 class="mb-1 mt-1 font_clr"><i class="bx bx-rupee"></i><span class="counter-value" data-target="<?php echo $avCredit;?>">0</span></h4>
										</div>
									   
									</div>
								</div>
							</div> 
							<div class="col-md-6 col-xl-3">
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
											<p class="text-uppercase fw-semibold font-size-13 font_clr">All Expense</p>
											<h4 class="mb-1 mt-1 font_clr"><i class="bx bx-rupee"></i><span class="counter-value" data-target="<?php if($lExpense->debit){echo $lExpense->debit;}?>">0</span></h4>
										</div>   
									</div>
								</div>
							</div>  
                        </div> <!-- end row-->
						
						<?php 
								//print_r($frenchiseBv);echo '<br>';
								
						?>
						
<div class="col-lg-12">
<!--<div class="ami_dev"><i class="fab fa-dev"></i> Earned Business Volume</div>-->
<div class="row g-0" style=" margin-bottom:20px;background-color: #fff;">
	<div class="col-xl-4 col-md-6">
		<div class="card bg-primary  plan-box rounded-start rounded-0">
			<div class="card-body p-4">
				<div class="d-flex">
					<div class="flex-shrink-0 me-3"><i class="bx bxs-briefcase h1" style="color:#fff;"></i></div>
					<div class="flex-grow-1"><h5 class="mb-1" style="color:#fff;">Frenchise</h5><p style="color:#fff;">Earned Business Volume</p></div>
				</div>
				<div class="dev-py"><h3><sup><small><i class="bx bx-star"></i></small></sup> <?php if($frenchiseBv){ echo $frenchiseBv;}else{echo '0';}?></h3></div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-md-6">
		<div class="card plan-box rounded-0 dev_left">
			<div class="card-body bg-primary bg-warning p-4">
				<div class="d-flex">
					<div class="flex-shrink-0 me-3"><i class="bx bxs-briefcase-alt h1" style="color:#bf3600;"></i></div>
					<div class="flex-grow-1"><h5 class="mb-1" style="color:#bf3600;">Shopee</h5><p style="color:#bf3600;">Earned Business Volume</p></div>
				</div>
				<div class="dev-pymi"><h3><sup><small><i class="bx bx-star"></i></small></sup><?php if($shopeeBv){ echo $shopeeBv;}else{echo '0';}?></h3></div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-md-6">
		<div class="card plan-box rounded-0 dev_left">
			<div class="card-body p-4 bg-secondary ">
				<div class="d-flex">
					<div class="flex-shrink-0 me-3"><i class="mdi mdi-layers-triple-outline h1" style="color:#fff;"></i></div>
					<div class="flex-grow-1"><h5 class="mb-1" style="color:#fff;">Member</h5><p style="color:#fff;"> Earned Business Volume</p></div>
				</div><div class="dev-py"><h3><sup><small><i class="bx bx-star"></i></small></sup> <?php if($memberBv){ echo number_format($memberBv->earnBV);}else{echo '0';}?></h3></div>	
			</div>
		</div>
	</div>
		
	<div class="othrDev" style="background-color:#95D28C;">
	
	
		<span><i class="mdi mdi-safe-square-outline h1 text-primary"></i> Earned Business Volume</span>
			<br><h3><sup><i class="bx bx-star"></i></sup><?php if($shopeeBv->Bv){ echo $shopeeBv->Bv;}else{echo '0';}?></h3>
	</div>	
</div>

</div>
					   
					   <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
									<div class="mitbl">
										<i class="bx bxs-group miU"></i>Recent Joined Member
										<span><i class="far fa-file-excel miUexl"></i><i class="far fa-file-pdf miUpdf"></i><i class="fas fa-print miUprint"></i></span>
									</div>
								    <div class="card-body">
                                        <div class="table-responsive">
										
										<?php //print_r($recentMember[0]);?>
										
										
											<table class="table table-hover table-striped align-middle table-centered table-nowrap mb-0">
											   <thead class="hdr_clr">
													<tr><th>S No.</th><th>ID</th><th>Name</th><th>Sponsor Id</th><th>Phone</th><th style="text-align:center !important">Status</th>
													<th style="text-align: center !important">Action</th></tr>
											   </thead>
											   <tbody>
											   <?php 
											   	if($recentMember)
											   	 {	$ct=0;
											   		foreach($recentMember as $mem)
											  		{
														$ct++;
														$viewUid = base_url('mlm_software/admin/member/operation/'.urlencode(base64_encode('view==='.$mem->id)));
														$editUid =  base_url('mlm_software/admin/member/operation/'.urlencode(base64_encode('edit==='.$mem->id)));
													$actionBtn = '<div style="text-align:center;">
				       <a href="'.$editUid.'" class="btn btn-outline-success btn-sm waves-effect btn-padd" title="Edit"><i class="mdi mdi-square-edit-outline me-1"></i></a>
		   			   <a href="'.$viewUid.'" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
		<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm waves-effect btn-padd getAction" data-id="del_member-mlm_software/admin/member/operation-'.$mem->id.'"  data-bs-toggle="modal" data-bs-target="#deleteModel" title="Delete">
				<i class="bx bxs-trash"></i> </a></div>';
					if($mem->topup=='0.00'){$acSts='<span style="color:#d08c0e;font-weight: 600;">New Registration</span>';}
					else{$acSts='<span style="color:#068006;font-weight: 600;">Active</span>';}
													
					if($mem->sponsor=='0'){$sponsor='<span style="color:#09937f;font-weight: 600;">Top Member</span>';}
					else{$sponsor=$mem->sponsor;}								 
													 
													 
													 ?>
											   <tr>
											   			<th><?php echo $ct;?>.</th>
											   			<td><?php echo $mem->username;?></td>
														<td><?php echo $mem->name;?></td>
														<td><?php echo $sponsor;?></td>
														<td><?php echo $mem->mobile;?></td>
														<td style="text-align: center !important"><?php echo $acSts;?></td>
													<td style="text-align: center !important"><?php echo $actionBtn;?></td></tr>
											   
											   <?php }}else{?>
											   		<tr>
														<td colspan="7" style="text-align:center;color: #b02900;text-transform: uppercase;font-weight: 600;">
															<i class="bx bx-loader-circle bx-spin"></i> Oops there is no recent member available
														</td>
													</tr>
												<?php }?>	
											   </tbody>
											</table>
                                       </div>
									   <span class="vwAll">
									   		<a href="<?php echo base_url('mlm_software/admin/member/lists');?>">View All <i class="bx bx-right-arrow-alt"></i></a>
										</span>
                                    </div>
                                </div>
                            </div>
                        </div>
					   <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
									<div class="mitbl">
										<i class="bx bx-shopping-bag miU"></i>Recent Order 
										<span><i class="far fa-file-excel miUexl"></i><i class="far fa-file-pdf miUpdf"></i><i class="fas fa-print miUprint"></i></span>
									</div>
								    <div class="card-body">
                                        <div class="table-responsive">
										
										<?php //print_r($recentOrder[0]);?>
										
										
											<table class="table table-hover table-striped align-middle table-centered table-nowrap mb-0">
											   <thead class="hdr_clr">
													<tr>
														<th>S No.</th>
														<th>Invoice Id</th>
														<th>Member Id</th> 
														<th>Name</th> 
														<th>Mobile Number</th>
														<th>Total Amount</th>
														<th>Order Date</th>
														<th>Status</th>
														<th style="text-align: center !important">Action</th>
													</tr>
											   </thead>
											   <tbody>
											   <?php 
											   	if($recentOrder)
											   	 {	$ct=0;
											   		foreach($recentOrder as $order)
											  		{
														$ct++;
													
													$grandTotal=$order->grand_total+$order->shipping_charge+($order->grand_total*$order->tax)/100;
													if ($order->order_status=='0'){$stsTex='Cancelled';$activeCls='ordCancel';} 
													else if ($order->order_status=='1'){$stsTex='Placed';$activeCls='ordPlced';}
													else if ($order->order_status=='2'){$stsTex ='Shipped';$activeCls='ordShipped';}
													else if ($order->order_status=='3'){$stsTex='Delevered';$activeCls='ordDelevered';}
													else {$stsTex='Not Yet';$activeCls='setBtnGr dctive';}
													$getUid = base_url('mlm_software/admin/sale/detials/'.urlencode(base64_encode($order->invoice_id)));
													 ?>
											   <tr>
											   			<th><?php echo $ct;?>.</th>
											   			<td><strong><?php echo $order->invoice_id;?></strong></td>
														<td><?php echo $order->username;?></td>
														<td><?php echo $order->name;?></td>
														<td><?php echo $order->mobile;?></td>
														<td style="text-align: center !important; font-weight:600;">
																<i class="bx bx-rupee inrP"></i> <?php echo $order->grand_total;?>
														</td>
														
														<td><strong><?php echo date('d-M-Y',strtotime($order->order_date));?></strong></td>
													
														<td><div class="<?php echo $activeCls;?>"><?php echo $stsTex;?></td>
														<td style="text-align: center !important">
														<div style="text-align:center;">
											<a href="<?php echo $getUid;?>" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
																		</div>
														</td>
													</tr>
											   
											   <?php }}else{?>
											   		<tr>
														<td colspan="9" style="text-align:center;color: #b02900;text-transform: uppercase;font-weight: 600;">
															<i class="bx bx-loader-circle bx-spin"></i> Oops there is no recent order available
														</td>
													</tr>
											   
											   <?php }?>
											   </tbody>
											</table>
                                       </div>
									   <span class="vwAll">
									   		<a href="<?php echo base_url('mlm_software/admin/sale');?>">View All <i class="bx bx-right-arrow-alt"></i></a>
										</span>
                                    </div>
                                </div>
                            </div>
                        </div>   
					    
<!--<input type="hidden" id="base_url" value="<?php //echo base_url();?>super_admin/dashboard/" />-->
					
                    <?php } ?>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <?php $this->load->view('super_admin/include/footer') ?>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <?php $this->load->view('super_admin/include/js') ?>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
</body>


</html>