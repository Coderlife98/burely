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
<?php //print_r($getDetails);
if($getDetails->my_img)
{
	$getImg=$this->baseUrl.$getDetails->my_img;
	}
	else
	{		
	$getImg=$this->baseUrl.'uploads/user/no_profile.png';		
		}
if($getDetails->status=='Active')
{
	$statusClr='#049504';
	$backClr='background-color:rgba(179, 227, 179, 0.4)';
	}
elseif($getDetails->status=='Block')
{
	$statusClr='#970000';
	$backClr='background-color:rgba(176, 137, 137,0.4)';
	}
	if($getDetails->status=='Suspend')
{
	$statusClr='#bd7b02';
	$backClr='background-color:rgba(215, 192, 151,0.4)';
	}
?>
<!----------------------------Edit Frenchise strt----------------------------->	
<div class="row mb-4">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div><div class="clearfix"></div>
                    <div class="text-center bg-pattern">
					   <div id="proPic"><img src="<?php echo $getImg; ?>" alt="<?php echo $getDetails->name; ?>" class="avatar-xl rounded-circle mb-3 mi_thumb"></div>	
						<div id="getProfileImageChange" class="imageUploadActn"><i class="icon fa fa-camera"></i></div>
						<h4 class="text-primary mb-2"><?php echo $getDetails->name; ?></h4>
                        <h5 class="text-muted font-size-13 mb-3">ID. <?php echo $getDetails->username; ?></h5>
						 <h6 class="text-muted font-size-13 mb-3" style="margin-top:-10px;"><span style="color:<?php echo $statusClr.';'.$backClr;?>;padding: 0px 10px 2px 10px;"><?php echo $getDetails->status; ?></span></h6>
                        <div class="text-center">
                            <a href="mailto:<?php echo $getDetails->email; ?>" class="btn btn-success me-2 waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-email-outline me-1"></i>Send Mail</a>
                            <a href="tel:<?php echo $getDetails->mobile; ?>" class="btn btn-primary waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-phone-outline me-1"></i>Phone Call</a>
                        </div>
                    </div>
                </div>
            <hr class="my-4">
<!----------------------------------------->

<!---->
<div class="input-group" id="uploadMemberIMg" style="padding: 0px 0px 20px 0px;border-bottom: 1px solid #d7d7d7; display:none;">
	<input type="file" class="form-control" name="file" id="file">
	<input type="button" class="input-group-text memberImgUploadActn" id="Update" value="Upload">
</div>
<!----------------------------------------->      			
			   <div class="table-responsive">
                    <h5 class="font-size-16 mb-3" style="color:#008288;"><i class="bx bx-detail"></i> Personal Information</h5>
		<div><p class="mb-1 text-muted font-size-13"><i class="bx bx-mobile-alt "></i> Member ID :</p> <h5 class="font-size-14"><?php echo $getDetails->username; ?></h5></div>				
				
    <div><p class="mb-1 text-muted font-size-13"><i class="bx bx-calendar "></i> Date Of Joining :</p> <h5 class="font-size-14">
	<?php
	if($getDetails->create_date!='0000-00-00')
	{
	  echo date('d-M-Y',strtotime($getDetails->create_date)); 
	  }else{ echo 'N/A';}?>
	
	
	</h5></div>

<div><p class="mb-1 text-muted font-size-13"><i class="bx bx-envelope "></i>  E-mail :</p> <h5 class="font-size-14"><?php echo $getDetails->email; ?></h5></div>

                </div>
            </div>
        </div>
    </div>
	
	<div class="col-xl-8">
       <form id="profile_data" method="post">
	         <div class="card">
				<div class="card-header ami_cmn">
					<i class="mdi mdi-account-circle-outline"></i> Basic Detail
					<a href="<?php echo $target;?>" class="ititle miMr" title="Back to list"><i class="bx bx-arrow-back"></i></a>
				</div>
            	 <div class="card-body p-4">
                    <div class="row cardBtm"> 
					    <div class="col-lg-6">
                            <div class="form-floating mb-3"><span class="form-control"><?php echo $getDetails->username; ?></span>
                                 <label for="mem_id">Member Id.</label>
                            </div>
                       </div>
					    <div class="col-lg-6">
                            <div class="form-floating mb-3"><span class="form-control"><?php echo $getDetails->email; ?></span>
                                 <label for="emailId">Email Id.</label>
                            </div>
                       </div>
					    <div class="col-lg-4">
                            <div class="form-floating mb-3">
								<select name="gender" id="gender" class="form-select">
								  <option value="">Select One</option>
								  <option value="Male"  <?php if($getDetails->gender=='Male'){ echo 'selected="selected"';}?>>Male</option>
								  <option value="Female" <?php if($getDetails->gender=='Female'){ echo 'selected="selected"';}?>>Female</option>
								</select>
							 <label for="gender">Gender.</label>
                            </div>
                     </div>
					    <div class="col-lg-4">
                            <div class="form-floating mb-3"><input type="text" name="mem_name" id="mem_name" value="<?php echo $getDetails->name; ?>" class="form-control">
                                 <label for="mem_name">Member Name.</label>
                            </div>
                     </div>
					    <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="date" value="<?php echo $getDetails->date_of_birth;?>" name="date_of_birth" class="form-control flatpickr-input active" id="date_of_birth" >
                                <label for="Name">Date Of Birth</label>
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $getDetails->id; ?>">
                             <input type="hidden" class="form-control" id="memImg" name="memImg" value="<?php echo $getDetails->my_img; ?>">
							</div>
                        </div>
					    <div class="col-lg-12">
						<div class="form-floating mb-3">
							 <textarea class="form-control" name="address" id="address"><?php echo $getDetails->address; ?></textarea>
							 <label for="address">Address.</label>
						</div>
                      </div>   
					    <div class="col-lg-4">
                            <div class="form-floating mb-3">
                               <select class="form-select empSelectR" name="state" id="state">
									<option value="">Select</option>
						<?php if($getState)
							 	{
									foreach($getState as $list)
									{
							  ?><option value="<?php echo $list->id;?>" <?php if($list->id==$getDetails->state){ echo 'selected="selected"';}?>><?php echo $list->state_cities;?></option>
							<?php }}?>
								</select>
								<label for="state">State</label>
                            </div>
                        </div>
				        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                              <select class="form-select" name="district" id="district" >
							  <option value="">Select</option>
						      <?php if($getCity)
							 	{
									foreach($getCity as $c_list)
									{
							 		?><option value="<?php echo $c_list->id;?>" <?php if($c_list->id==$getDetails->district){ echo 'selected="selected"';}?>><?php echo $c_list->state_cities;?></option>
							<?php }}?>
								</select>
							  
                                <label for="district">District</label>
                            </div>
                        </div>
					    <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="text" value="<?php if($getDetails->zipcode){echo $getDetails->zipcode;}else{set_value('zipcode');} ?>"  class="form-control" id="zipcode" name="zipcode">
                                <label for="zipcode">Zipcode.</label>
                            </div>
                        </div>	
					    
						<div class="col-lg-4">
                            <div class="form-floating mb-3">
							<input type="text" name="mem_mobile" id="mem_mobile" value="<?php echo $getDetails->mobile; ?>" class="form-control">
                                 <label for="mem_mobile">Mobile Number.</label>
                            </div>
                       </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="text" value="<?php if($getDetails->aadhaar_nu!='0'){echo $getDetails->aadhaar_nu;}else{ echo '';} ?>"  class="form-control" name="aadhaar_no" id="aadhaar_no" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')" maxlength="12">
                                <label for="aadhaar_no">Aadhar No.</label>
                         	</div>
                        </div>
						<div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="text" value="<?php echo $getDetails->pan_nu; ?>"  class="form-control" id="pan_no" name="pan_no">
                                <label for="pan_no">PAN No.</label>
                            </div>
                        </div>
                    </div>
                </div>       
	     	    
				 <div class="card-header ami_cmn" ><i class="bx bx-cog"></i> Password Details</div>
	    	     <div class="card-body p-4">
					<div class="row cardBtm">
					   <div class="col-lg-6">
                            <div class="form-floating mb-3"> 
								<input type="password" value="<?php echo $getDetails->shw_pass; ?>"  class="form-control" id="password" name="password">
								<label for="rank">Password</label>            
                            </div>
                        </div>
					   <div class="col-lg-6">
                            <div class="form-floating mb-3"> 
								<input type="password" value="<?php echo $getDetails->shw_pass; ?>"  class="form-control" id="cnfPassword" name="cnfPassword">
                                <label for="rank">Confirm Password</label>            
                            </div>
                        </div>
					</div>
			  	 </div>
				
				 <div class="card-header ami_cmn" > <i class="mdi mdi-bank-outline"></i> Bank Detail</div>
	    	     <div class="card-body p-4">
			         <div class="row cardBtm">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" value="<?php echo $getDetails->bank_name; ?>"  name="bank_name" class="form-control">
                                <label for="bank_name">Bank Name.</label>            
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" value="<?php echo $getDetails->bank_ac_no; ?>"  class="form-control" id="bank_ac_no" name="bank_ac_no" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')" maxlength="15">
                                <label for="bank_ac_no">Bank A/C No</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" value="<?php echo $getDetails->bank_Ifsc; ?>"  class="form-control" id="bank_Ifsc" name="bank_Ifsc">
                                <label for="bank_Ifsc">Bank IFSC.</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" value="<?php echo $getDetails->bankBrName; ?>"  class="form-control" name="bankBrName" id="bankBrName">
                                <label for="bankBrName">Bank Branch Name.</label>
                            </div>
                        </div>
						<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="btc_address" value="<?php echo $getDetails->btc_address; ?>"  class="form-control" name="btc_address" id="btc_address">
									<label for="btc_address">BTC Address.</label>
								</div>
							</div>
						<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" value="<?php echo $getDetails->nominee_name; ?>"  class="form-control" name="nominee_name" id="nominee_name">
									<label for="nominee_name">Nominee Name.</label>
								</div>
							</div>
						<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" value="<?php echo $getDetails->nominee_address; ?>"  class="form-control" name="nominee_address" id="nominee_address">
									<label for="nominee_address">Nominee Address.</label>
								</div>
							</div>		
						<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" value="<?php echo $getDetails->nominee_relationship; ?>"  class="form-control" name="nominee_relationship" id="nominee_relationship">
									<label for="nominee_relationship">Nominee Relationship.</label>
								</div>
							</div>
					</div>
		        </div>
	   		     <div class="card-footer">
	    			<a href="<?php echo $target;?>" class="btn btn-outline-dark waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
					<button type="submit" class="btn btn-outline-primary waves-effect waves-light" style="float:right;"><i class="bx bx-save"></i> Update</button>
	   				
	  		     </div>
	    	</div>
  		</form>
    </div>
	
	
	
	
	
	
	
	
	
</div>








<!----------------------------edit Frenchise end------------------------------>
<script src="<?php echo base_url() ?>media/js/mlm_software/admin/partners.js"></script>