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
<input type="hidden" id="target" value="<?php echo $target;?>" />
<?php 

print_r($getDetails);

if($getDetails->my_img)
{
	$getImg=$this->baseUrl.$getDetails->my_img;
	}
	else
	{		
	$getImg=$this->baseUrl.'uploads/user/no_img.png';		
		}


?>
<!----------------------------Edit Frenchise strt----------------------------->	
<div class="row mb-4">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="clearfix"></div>

                    <div class="text-center bg-pattern">
			
                        <img src="<?php echo $getImg; ?>" alt="Profile Image" class="avatar-xl rounded-circle mb-3 mi_thumb" style="border:1px solid #bbcfdb;">
				
						
						<h4 class="text-primary mb-2"><?php echo $getDetails->name; ?></h4>
                        <h5 class="text-muted font-size-13 mb-3">ID. <?php echo $getDetails->username; ?></h5>
						 <h6 class="text-muted font-size-13 mb-3" style="margin-top:-10px;"><span style="color:<?php echo $statusClr.';'.$backClr;?>;padding: 0px 10px 2px 10px;"><?php echo $flshMsg; ?></span></h6>
                        <div class="text-center">
                            <a href="mailto:<?php echo $getDetails->email ?>" class="btn btn-success me-2 waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-email-outline me-1"></i>Send Mail</a>
                            <a href="tel:<?php echo $getDetails->mobile ?>" class="btn btn-primary waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-phone-outline me-1"></i>Phone Call</a>
                        </div>
                    </div>
                </div>
            <hr class="my-4">      			
			   <div class="table-responsive" style=" <?php if($this->lgCat=='1'){echo 'margin-bottom: 18px';}else {echo 'margin-bottom: 67px';}?> ">
                    <h5 class="font-size-16 mb-3" style="color:#008288;"><i class="bx bx-detail"></i> Personal Information</h5>
                    	<div>
							<p class="mb-1 text-muted font-size-13"><i class="bx bx-calendar "></i> Date of joining :</p> 
							<h5 class="font-size-14"><?php echo date('d-M-Y',strtotime($getDetails->create_date)); ?></h5>
					  </div>         
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
		<div class="card">
			<div class="mt-4">
				<ul class="nav nav-tabs nav-tabs-custom" role="tablist" style="margin-top: -25px;padding: 10px 0px 0px 10px;">
					<li class="nav-item" role="presentation">
					   <a class="nav-link active" data-bs-toggle="tab" href="#profile_det" role="tab" aria-selected="true">
						  <span class="d-block d-sm-none"><i class="bx bx-user-circle"></i></span><span class="d-none d-sm-block">
						  <!--<span class="miprIcn"><i class="bx bx-user-circle"></i></span>--> Profile</span>       
					   </a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" data-bs-toggle="tab" href="#payroll_det" role="tab" aria-selected="false" tabindex="-1">
							<span class="d-block d-sm-none"><i class="bx bx-money"></i></span>
							<span class="d-none d-sm-block"> <!--<span class="miprIcn"><i class="bx bx-money"></i></span> -->Business</span>
						</a>
					</li>
				</ul>
					<div class="tab-content p-3 text-muted">
						<div class="tab-pane active" id="profile_det" role="tabpanel">
							<div class="amiCrdTitle">
								<i class="mdi mdi-account-circle-outline"></i> Basic Information
								<a href="<?php echo $target;?>" class="grintitle miMr" title="Back to list"><i class="bx bx-arrow-back"></i></a>
							</div>
							 <div class="card-body p-4">
								<div class="row">
								<div class="col-lg-6">
									   <div class="form-floating mb-3">
											<span class="form-control"><?php echo $getDetails->name;?></span>
											<label for="Name"><i class="bx bx-user-pin fntClr"></i> Name.</label>
										</div>
									</div>
								<div class="col-lg-6">
									   <div class="form-floating mb-3">
											<span class="form-control">
												<?php if($getDetails->date_of_birth){echo date('d-M-Y',strtotime($getDetails->date_of_birth));}else{ echo 'N/A';}?>
											</span>
											<label for="dob"><i class="mdi mdi-calendar-account fntClr"></i> Date Of Birth.</label>
										</div>
									</div>
							    <div class="col-lg-6">
										<div class="form-floating mb-3">
										<span class="form-control"><?php if($getDetails->mobile){echo $getDetails->mobile;}else{echo 'N/A';} ?></span>
											<label for="mo_nu"><i class="bx bx-mobile  fntClr"></i> Mobile Number.</label>
										</div>
									</div>
						        <div class="col-lg-6">
										<div class="form-floating mb-3"><span class="form-control"><?php if($getDetails->email){echo $getDetails->email;}else{echo 'N/A';} ?></span>
											<label for="pan_no"><i class="bx bx-envelope  fntClr"></i> Email Id.</label>
										</div>
									</div>	
								<div class="col-lg-6">
									<div class="form-floating mb-3">
									<span class="form-control"><?php if($getDetails->aadhaar_nu){echo $getDetails->aadhaar_nu;}else{echo 'N/A';} ?></span>
										<label for="aadhaar_no"><i class="bx bx-id-card fntClr"></i> Aadhar No.</label>
									</div>
								</div>
								<div class="col-lg-6">
										<div class="form-floating mb-3">
										<span class="form-control"><?php if($getDetails->pan_no){echo $getDetails->pan_nu;}else{echo 'N/A';} ?></span>
											<label for="pan_no"><i class="bx bx-id-card fntClr"></i> PAN No.</label>
										</div>
									</div>
								<div class="col-lg-12">
										<div class="form-floating mb-3">
										<span class="form-control" style="height:85px;"><?php if($getDetails->address){echo $getDetails->address;}else{echo 'N/A';} ?></span>
											<label for="State"><i class="bx bxs-user-pin fntClr"></i> Address.</label>
										</div>
									</div>
								<div class="col-lg-4">
								    <div class="form-floating mb-3"><span class="form-control">
									 		<?php if($getStateCity->st_name){echo $getStateCity->stateN;}else{echo 'N/A';} ?>
											</span><label for="State"><i class="bx bx-area fntClr"></i> State.</label>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-floating mb-3">
									<span class="form-control"><?php if($getStateCity->dist_name){echo $getStateCity->cityN;}else{echo 'N/A';} ?></span>
										<label for="district"><i class="bx bx-area fntClr"></i> District.</label>
									</div>
								</div>	
								<div class="col-lg-4">
									<div class="form-floating mb-3">
									<span class="form-control"><?php if($getDetails->zipcode){echo $getDetails->zipcode;}else{echo 'N/A';} ?></span>
										<label for="zipCode"><i class="bx bx-target-lock fntClr"></i> Zipcode.</label>
									</div>
								</div>
								</div>
							 </div>    
							<div class="amiCrdTitle"><i class="mdi mdi-bank-outline"></i> Banking Information</div> 
							 
							 <div class="card-body p-4">
			         <div class="row cardBtm">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                              <span class="form-control"><?php if($getDetails->bank_name){echo $getDetails->bank_name;}else{echo 'N/A';} ?></span>
                                <label for="bank_name"><i class="mdi mdi-bank-outline fntClr"></i> Bank Name.</label>            
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <span class="form-control"><?php if($getDetails->bank_ac_no){echo $getDetails->bank_ac_no;}else{echo 'N/A';} ?></span>
                                <label for="bank_ac_no"><i class="mdi mdi-format-list-numbered fntClr"></i> Bank A/C No</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <span class="form-control"><?php if($getDetails->bank_Ifsc){echo $getDetails->bank_Ifsc;}else{echo 'N/A';}?></span>
                                <label for="bank_Ifsc"><i class=" bx bx-code-block  fntClr"></i> Bank IFSC.</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <span class="form-control"><?php if($getDetails->bankBrName){echo $getDetails->bankBrName;}else{echo 'N/A';} ?></span>
                                <label for="bankBrName"><i class="bx bx-git-branch fntClr"></i> Bank Branch Name.</label>
                            </div>
                        </div>
						<div class="col-lg-6">
								<div class="form-floating mb-3">
									<span class="form-control"><?php if($getDetails->btc_address){echo $getDetails->btc_address;}else{echo 'N/A';} ?></span>
									<label for="btc_address"><i class="bx bx-home-circle fntClr"></i> BTC Address.</label>
								</div>
							</div>
						<div class="col-lg-6">
								<div class="form-floating mb-3">
									<span class="form-control"><?php if($getDetails->nominee_name){echo $getDetails->nominee_name;}else{echo 'N/A';} ?></span>
									<label for="nominee_name"><i class="bx bx-user-circle fntClr"></i> Nominee Name.</label>
								</div>
							</div>
						<div class="col-lg-6">
								<div class="form-floating mb-3">
									<span class="form-control"><?php if($getDetails->nominee_address){echo $getDetails->nominee_address;}else{echo 'N/A';} ?></span>
									<label for="nominee_address"><i class="bx bx-home-alt fntClr"></i> Nominee Address.</label>
								</div>
							</div>		
						<div class="col-lg-6">
								<div class="form-floating mb-3">
									<span class="form-control"><?php if($getDetails->nominee_relationship){echo $getDetails->nominee_relationship;}else{echo 'N/A';} ?></span>
									<label for="nominee_relationship"><i class="bx bx-group fntClr"></i> Nominee Relationship.</label>
								</div>
							</div>
					</div>
		        </div>
							 
							 
							 
							 
							 
							 
							 
							 
							 
							 
							 
						   <?php if($this->lgCat=='1'){?>
						   <div class="card-header amiCrdTitle"><i class="bx bx-cog"></i> Create/Modify Information</div> 
						   <div class="card-body p-4">
							   <div class="row">
								  <div class="col-lg-4">
									   <div class="form-floating mb-3">
											<span class="form-control"><?php echo $getCreatedBy->user_code;?></span>
											<label for="crtedBy"><i class="bx bx-user-pin fntClr"></i> Employee Code</label>
										</div>
									</div>
								  <div class="col-lg-4">
									   <div class="form-floating mb-3">
											<span class="form-control"><?php echo $getCreatedBy->name;?></span>
											<label for="crtedBy"><i class="bx bx-user-pin fntClr"></i> Created By</label>
										</div>
									</div>
									<div class="col-lg-4">
									   <div class="form-floating mb-3">
											<span class="form-control"><?php echo date('d-M-Y',strtotime($getDetails->create_date));?></span>
											<label for="dob">Create Date</label>
										</div>
									</div>
								  
							  </div>
							  <div class="row">
								  <div class="col-lg-4">
									   <div class="form-floating mb-3">
											<span class="form-control"><?php echo $getCreatedBy->user_code;?></span>
											<label for="crtedBy"><i class="bx bx-user-pin fntClr"></i> Employee Code</label>
										</div>
									</div>
								  <div class="col-lg-4">
									   <div class="form-floating mb-3">
											<span class="form-control"><?php echo $getCreatedBy->name;?></span>
											<label for="crtedBy"><i class="bx bx-user-pin fntClr"></i> Modified By</label>
										</div>
									</div>
									<div class="col-lg-4">
									   <div class="form-floating mb-3">
											<span class="form-control"><?php echo date('d-M-Y',strtotime($getDetails->create_date));?></span>
											<label for="dob">Modified Date</label>
										</div>
									</div>
								  
							  </div>
						   </div>
						   
						   
						
						   
						   
						   <?php }?>
				<a href="<?php echo $target;?>" class="btn btn-outline-dark waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
				<a href="<?php echo base_url();?>mlm_software/admin/partners/operation/<?php echo $edturl; ?>" class="btn btn-outline-primary waves-effect waves-light" style="float:right;"><i class="bx bx-edit"></i> Edit</a>
						  
					
						</div>
<div class="tab-pane" id="payroll_det" role="tabpanel">				
		<div class="row">
			<form method="post" id="search_emp_salary">
				<div class="col-xl-12">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-floating mb-3">
								<input type="text" name="tnxId" id="tnxId"  class="form-control"><label for="empId"><i class="bx bx-transfer-alt fntClr"></i> Transaction Id </label>
							</div>
						</div>
						<div class="col-lg-6">
						<?php  $monthArr=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");?>
							<div class="form-floating mb-3" >
								<select class="form-select" name="month" id="month">
									<option value="">---- Select One ----</option>
									<?php $ct=0;  foreach ($monthArr as $key) {++$ct;?>
									<option value="<?php echo $ct;?>"><?php echo $key;?></option>
									<?php  }?>
								</select>	
								<label for="month"><i class="mdi mdi-calendar-arrow-left fntClr"></i> Month</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-floating mb-3">
							   <input type="date" name="strtDt" id="strtDt" class="form-control"><label for="strtDt"><i class="mdi mdi-calendar-account fntClr"></i> Start Date</label>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-floating mb-3">
								<input type="date" name="endDt" id="endDt" class="form-control"><label for="endDt"><i class="mdi mdi-calendar-account fntClr"></i> End Date </label>
							</div>
						</div>
					</div>
					<a href="<?php echo base_url(); ?>mlm_software/admin/employee/manage" class="btn btn-outline-dark  waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
				<button type="submit" class="btn btn-raised btn-outline-primary srchBtn pull-right" onclick="return get_search(repEmpSalDetails,'#search_emp_salary','#emp_salary_list')">
					<i class="mdi mdi-account-search"></i> Search</button>
				</div>	
			</form>
		</div>	
		<div class="row" style="margin-top:20px;">	
							<div class="table-responsive1">
								<div id="search_data">  
									<table class="table align-middle table-striped table-nowrap mb-0" id="emp_salary_list" style="width:100%;">
										<thead class="amiCrdTitle">
											<tr>
												<th>S.No</th>
												<th>Tnx Id</th>
												<th>Salary</th>
												<th>Month</th>
												<th>Pay Date</th>	
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>	
		<input id="miId" type="hidden" value="<?php echo $getDetails->id;?>" />							
</div>
					</div>
				</div>
	    </div>
    </div>
</div>










<!----------------------------edit Frenchise end------------------------------>
<script src="<?php echo base_url() ?>media/js/mlm_software/admin/partners.js"></script>