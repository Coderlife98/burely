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
<?php //print_r($getMemberDetails);
if($getMemberDetails['my_img'])
{
	$getImg=$this->baseUrl.$getMemberDetails['my_img'];
	}
	else
	{		
	$getImg=$this->baseUrl.'uploads/user/no_profile.png';		
		}
if($getMemberDetails['status']=='Active')
{
	$statusClr='#049504';
	$backClr='background-color:rgba(179, 227, 179, 0.4)';
	}
elseif($getMemberDetails['status']=='Block')
{
	$statusClr='#970000';
	$backClr='background-color:rgba(176, 137, 137,0.4)';
	}
	if($getMemberDetails['status']=='Suspend')
{
	$statusClr='#bd7b02';
	$backClr='background-color:rgba(215, 192, 151,0.4)';
	}
?>

<!----------------------------Edit Member strt----------------------------->	
<div class="row mb-4">
    <div class="col-xl-4">

        <div class="card">

            <div class="card-body">
                <div>
                    <div class="clearfix"></div>

                    <div class="text-center bg-pattern">
			
                        <img src="<?php echo $getImg; ?>" alt="Profile Image" class="avatar-xl img-thumbnail rounded-circle mb-3" style="border:1px solid #bbcfdb;">
				
						
						<h4 class="text-primary mb-2"><?php echo $getMemberDetails['name']; ?></h4>
                        <h5 class="text-muted font-size-13 mb-3">ID. <?php echo $getMemberDetails['username']; ?></h5>
						 <h6 class="text-muted font-size-13 mb-3" style="margin-top:-10px;"><span style="color:<?php echo $statusClr.';'.$backClr;?>;padding: 0px 10px 2px 10px;"><?php echo $getMemberDetails['status']; ?></span></h6>
                        <div class="text-center">
                            <a href="mailto:<?php echo $getMemberDetails['email'] ?>" class="btn btn-success me-2 waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-email-outline me-1"></i>Send Mail</a>
                            <a href="tel:<?php echo $getMemberDetails['mobile'] ?>" class="btn btn-primary waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-phone-outline me-1"></i>Phone Call</a>
                        </div>
                    </div>
                </div>
            <hr class="my-4">     			
			   <div class="table-responsive">
                    <h5 class="font-size-16 mb-3" style="color:#008288;"><i class="bx bx-detail"></i> Personal Information</h5>
	<div><p class="mb-1 text-muted font-size-13"><i class="bx bx-mobile-alt "></i> Member ID :</p> <h5 class="font-size-14"><?php echo $getMemberDetails['username'] ?></h5></div>				
	<div><p class="mb-1 text-muted font-size-13"><i class="bx bx-calendar "></i> Rank Position :</p> <h5 class="font-size-14"><?php echo $getMemberDetails['rank']; ?></h5></div>				
    <div><p class="mb-1 text-muted font-size-13"><i class="bx bx-calendar "></i> Date Of Joining :</p> <h5 class="font-size-14"><?php echo date('d-M-Y',strtotime($getMemberDetails['create_date'])); ?></h5></div>
	
<div class="mt-3"><p class="mb-1 text-muted font-size-13"><i class="bx bx-envelope "></i>  E-mail :</p> <h5 class="font-size-14"><?php echo $getMemberDetails['email'] ?></h5></div>
  <div class="mt-3"><p class="mb-1 text-muted font-size-13"><i class=" bx bxs-map-pin "></i> Sponsor Id :</p><h5 class="font-size-14">
  <?php if($getMemberDetails['position']){echo $getMemberDetails['position'];}else{echo 'N/A';} ?></h5></div>
                </div>
			 </div>
        </div>
		
		<div class="docImg" style="">
		
		<?php if($getMemberBasicDetails['pan_img']){?><img src="<?php echo base_url().$getMemberBasicDetails['pan_img'];?>" class="card-img-top" alt="Aadhaar Documents"><?php }?>
<?php if($getMemberBasicDetails['pan_img']){?><img src="<?php echo base_url().$getMemberBasicDetails['adhar_img'];?>" class="card-img-top" alt="Pan Documents"><?php }?>
	<?php //print_r($getMemberBasicDetails);?>
		</div>	
	<!--	<div class="docDet"><span>Aadaar Document</span><span>Pan Document</span>
		</div>	-->
		
		
		
    </div>
    <div class="col-xl-8">
	    	<?php 
					$dob=date('d/m/Y',strtotime($getMemberBasicDetails['date_of_birth']));
				if($getMemberBasicDetails['gender']=='male')
				{
				  $signIndicator='<i class="bx bx-male-sign fntClr"></i>';
				  }	
				  else
				  {
				  	 $signIndicator='<i class="bx bx-female-sign fntClr"></i>';
						}
						
					//print_r($getMemberBasicDetails);
					//print_r($getStateCity);
					
			?>
			
			
			<div class="card"><div class="card-header header-green"><i class="mdi mdi-account-circle-outline"></i> Basic Information</div>
            	 <div class="card-body p-4">
                    <div class="row">
					   <div class="col-lg-4">
						   <div class="form-floating mb-3">
<span class="form-control" style="text-transform:capitalize"><?php if($getMemberBasicDetails['gender']){echo $getMemberBasicDetails['gender'];}else{echo 'N/A';}?></span>
                                <label for="gender"><?php echo $signIndicator;?> Gender</label>
							</div>
                        </div>
					   <div class="col-lg-4">
						   <div class="form-floating mb-3">
                                <span class="form-control"><?php echo $getMemberDetails['name'];?></span>
                                <label for="uName"><i class="bx bx-user-pin fntClr"></i>  Name</label>
							</div>
                         </div>
					   <div class="col-lg-4">
						   <div class="form-floating mb-3">
                                <span class="form-control"><?php if($dob=='01/01/1970'){echo 'N/A';}else{echo $dob;}?></span>
                                <label for="Name"><i class="bx bx-calendar fntClr"></i> Date Of Birth</label>
							</div>
                        </div>
						
						<div class="col-lg-12">
						   <div class="form-floating mb-3">
                                <span class="form-control" style="height:120px;"><?php echo $getMemberDetails['address'];?></span>
                                <label for="address"><i class="far fa-address-card fntClr"></i> Address</label>
							</div>
                        </div>
						
						
						<div class="col-lg-4">
                            <div class="form-floating mb-3">
							<span class="form-control"><?php if($getStateCity){echo $getStateCity->st_name;}else{echo 'N/A';} ?></span>
                                <label for="state"><i class="fab fa-stripe-s fntClr"></i> State</label>
                            </div>
                        </div>
						<div class="col-lg-4">
                            <div class="form-floating mb-3">
							<span class="form-control"><?php if($getStateCity){echo $getStateCity->dist_name;}else{echo 'N/A';} ?></span>
                                <label for="gst_nu"><i class="fab fa-rev fntClr"></i> District</label>
                            </div>
                        </div>
						<div class="col-lg-4">
                            <div class="form-floating mb-3">
							<span class="form-control"><?php if($getMemberBasicDetails['zipcode']){echo $getMemberBasicDetails['zipcode'];}else{echo 'N/A';} ?></span>
                                <label for="zipcode"><i class="fas fa-ankh fntClr"></i> Zipcode</label>
                            </div>
                        </div>
						
						
						
						
						
						
						
						
						<div class="col-lg-6">
                            <div class="form-floating mb-3">
							<span class="form-control"><?php if($getMemberDetails['mobile']){echo $getMemberDetails['mobile'];}else{echo 'N/A';} ?></span>
                                <label for="mobileNu"><i class="fas fa-mobile-alt fntClr"></i> Mobile Number</label>
                            </div>
                        </div>
						
						
						
						
						
						
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
							<span class="form-control"><?php if($getMemberBasicDetails['gst_number']){echo $getMemberBasicDetails['gst_number'];}else{echo 'N/A';} ?></span>
                                <label for="gst_nu"><i class="fas fa-ankh fntClr"></i> GST Number</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3"><span class="form-control"><?php if($getMemberBasicDetails['pan_nu']){echo $getMemberBasicDetails['pan_nu'];}else{echo 'N/A';} ?></span>
                                <label for="pan_no"><i class="fab fa-elementor fntClr"></i> PAN / Tax Reg No.</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
							<span class="form-control"><?php if($getMemberBasicDetails['aadhaar_nu']){echo $getMemberBasicDetails['aadhaar_nu'];}else{echo 'N/A';} ?></span>
                                <label for="aadhaar_no"><i class="fas fa-address-card fntClr"></i> Aadhar No.</label>
                         	</div>
                        </div>
                    </div>
            </div>    
			  <div class="card-header header-green" ><i class="bx bx-crown"></i> Sponsor Information</div>
				<div class="card-body p-4">
				<?php //print_r($getSponsorDetails);?>
				
					  <div class="row">
                       <div class="col-lg-6">
						<div class="form-floating mb-3"> 
							<span class="form-control"><?php if($getMemberDetails['position']){echo $getMemberDetails['position'];}else{echo 'N/A';} ?></span>
							<label for="spId">Sponsor Id</label>            
						</div>
					</div>
					   <div class="col-lg-6">
                            <div class="form-floating mb-3"> 
							<span class="form-control"><?php if($getSponsorDetails){echo $getSponsorDetails['name'];}else{echo 'N/A';} ?></span>
                                <label for="spName">Sponsor Name.</label>            
                            </div>
                        </div>	
					</div>
				</div>
			  <div class="card-header header-green" ><i class="mdi mdi-login-variant"></i> Login Information</div>
	    	     <div class="card-body p-4">
					<div class="row">
                       <div class="col-lg-6">
						<div class="form-floating mb-3"> 
						<span class="form-control">
		<?php  if(date('d-M-Y',strtotime($getMemberDetails['create_date']))=='01/01/1970'){echo 'N/A';}else{echo date('d-M-Y',strtotime($getMemberDetails['create_date']));} ?>
						</span>
							<label for="regData">Registration Date</label>            
						</div>
					</div>
					   <div class="col-lg-6">
                            <div class="form-floating mb-3"> 
							<span class="form-control"><?php if($getMemberDetails['username']){echo $getMemberDetails['username'];}else{echo 'N/A';} ?></span>
                                <label for="rank">Member Id.</label>            
                            </div>
                        </div>
					   <div class="col-lg-6">
                            <div class="form-floating mb-3"> 
							<span class="form-control"><?php if($getMemberDetails['rank']){echo $getMemberDetails['rank'];}else{echo 'N/A';} ?></span>
                                <label for="rank">Rank.</label>            
                            </div>
                        </div>
					   
					<div class="col-lg-6">
                            <div class="form-floating mb-3"> 
							<span class="form-control">
			<div class="showPass" onclick="visiblePass('<?php echo $getMemberDetails['id']?>')" id="pass<?php echo $getMemberDetails['id']?>"><div class="passwrd"></div></div>
							</span>
                                <label for="pass">Password.</label>            
                            </div>
                        </div>	
						
					</div>
				 </div>
	     	     <div class="card-header header-green" > <i class="mdi mdi-bank-outline"></i> Bank Information</div>
	    	     <div class="card-body p-4">
			<div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3"> 
							<span class="form-control"><?php if($getMemberBasicDetails['bank_name']){echo $getMemberBasicDetails['bank_name'];}else{echo 'N/A';} ?></span>
                                <label for="bank_name">Bank Name.</label>            
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
							<span class="form-control"><?php if($getMemberBasicDetails['bank_ac_no']){echo $getMemberBasicDetails['bank_ac_no'];}else{echo 'N/A';} ?></span>
                                <label for="bank_ac_no">Bank A/C No</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
							<span class="form-control"><?php if($getMemberBasicDetails['bank_Ifsc']){echo $getMemberBasicDetails['bank_Ifsc'];}else{echo 'N/A';} ?></span>
                                <label for="bank_Ifsc">Bank IFSC.</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
							<span class="form-control"><?php if($getMemberBasicDetails['bankBrName']){echo $getMemberBasicDetails['bankBrName']; }else{echo 'N/A';}?></span>
                                <label for="bankBrName">Bank Branch Name.</label>
                            </div>
                        </div>
                    <div class="col-lg-6">
                            <div class="form-floating mb-3">
							<span class="form-control"><?php if($getMemberBasicDetails['btc_address']){echo $getMemberBasicDetails['btc_address'];}else{echo 'N/A';} ?></span>
                                <label for="btc_address">BTC Address.</label>
                            </div>
                        </div>
					<div class="col-lg-6">
                            <div class="form-floating mb-3"> 
							<span class="form-control"><?php if($getMemberBasicDetails['nominee_name']){echo $getMemberBasicDetails['nominee_name'];}else{echo 'N/A';} ?></span>
                                <label for="nominee_name">Nominee Name.</label>
                            </div>
                        </div>
					<div class="col-lg-6">
                            <div class="form-floating mb-3">
						<span class="form-control"><?php if($getMemberBasicDetails['nominee_address']){echo $getMemberBasicDetails['nominee_address']; }else{echo 'N/A';}?></span>
                                <label for="nominee_address">Nominee Address.</label>
                            </div>
                        </div>		
					
					<div class="col-lg-6">
                            <div class="form-floating mb-3">
				<span class="form-control"><?php if($getMemberBasicDetails['nominee_relationship']){echo $getMemberBasicDetails['nominee_relationship'];}else{echo 'N/A';} ?></span>
                             		<label for="nominee_relationship">Nominee Relationship.</label>
                            </div>
                        </div>					
					</div>
	  			 </div>
	   		     <div class="card-footer">
	   <a href="<?php echo base_url();?>super_admin/mlm_software/member/member_list" class="btn btn-outline-dark waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
	<a href="<?php echo base_url();?>super_admin/mlm_software/member/edit/<?php echo urlencode(base64_encode($getMemberDetails['id'])); ?>" class="btn btn-outline-primary waves-effect waves-light" style="float:right;"><i class="bx bx-edit"></i> Edit</a>
	  		     </div>
	    	</div>
    </div>
</div>
<!----------------------------edit Member end------------------------------>

<script src="<?php echo base_url() ?>media/js/super_admin/mlm_software/member.js"></script>
