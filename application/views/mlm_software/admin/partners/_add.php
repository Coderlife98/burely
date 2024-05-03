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

<!----------------------------Edit Frenchise strt----------------------------->	
<div class="row mb-4">
    <div class="col-xl-12">
       <form id="save_partner" method="post">
	    	<div class="card">
					<div class="card-header ami_cmn">
						<span><i class="mdi mdi-account-circle-outline"></i></span> Basic Information
	<a href="<?php //echo base_url();?>" class="ititle miMr" title="Back to list"><i class="bx bx-arrow-back"></i></a>			
					</div>
            	 <div class="card-body p-4" style="margin-bottom: -10px;">
                    <div class="row">
						<div class="col-lg-4">
							<div class="form-floating mb-3">
					<input type="text" readonly="" name="mem_code" id="mem_code"  value="<?php  if($empId){echo 'F'.$empId;}else{ set_value('mem_code');} ?>" class="form-control" >
								 <label for="MembId" ><i class="bx bx-crown fntClr"></i> <span id="roleIdAsRl">Frenchise Id.</span></label>
						<input type="hidden" id="getMId" value="<?php  if($empId){echo $empId;}else{ set_value('mem_code');} ?>" />
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-floating mb-3">
								<select class="form-select empSelectR" name="roleAs" id="roleAs">
									<option value="">---- Select One ----</option>
									<option value="1" selected="selected">Frenchise</option>
									<option value="2">Shopee</option>
								</select>
								<label for="roleAs"><i class="far fa-registered fntClr"></i> Role As.</label>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-floating mb-3">
								<select class="form-select" name="gender" id="gender">
									<option value="">---- Select One ----</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
								<label for="gender"><i class="fas fa-genderless fntClr"></i> Gender.</label>
							</div>
						</div>
						
						
						
						
													
						<div class="col-lg-6">
							<div class="form-floating mb-3">
	<input type="text" name="mem_name" id="mem_name"  value="<?php if($getEmpDetails['name']){echo $getEmpDetails['name'];}else{ set_value('mem_name');} ?>" class="form-control" >
								 <label for="empN"> <i class="bx bx-user-pin fntClr"></i> Member Name. <span class="text-danger">*</span></label>
							</div>
						</div>	
					    <div class="col-lg-6">
						   <div class="form-floating mb-3">
								<input type="date" value="<?php echo $getEmpDetails['dob'];?>" name="date_of_birth" class="form-control flatpickr-input active" id="date_of_birth" >
								<label for="Name"><i class="mdi mdi-calendar-account fntClr"></i> Date Of Birth</label>
								<input type="hidden" class="form-control" id="id" name="id" value="<?php echo urlencode(base64_encode($getEmpDetails['id'])); ?>">
							 <input type="hidden" class="form-control" id="memImg" name="memImg" value="<?php echo urlencode(base64_encode($getEmpDetails['photo'])); ?>">
							</div>
						</div>					                        
						<div class="col-lg-6">
							<div class="form-floating mb-3">
							<input type="text" value="<?php if($getEmpDetails['mobile']){echo $getEmpDetails['mobile'];}else{set_value('mob_nu');} ?>" class="form-control" id="mob_nu" name="mob_nu" oninput="this.value = this.value.replace(/[^0-9]/g,'').replace(/(\  *?)\  */g, '$1');" maxlength="10">
							 <label for="mob_nu"><i class="bx bx-mobile  fntClr"></i> Mobile Number.<span class="text-danger">*</span></label>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-floating mb-3">
								<input type="text" value="<?php if($getEmpDetails['email']){echo $getEmpDetails['email'];}else{set_value('emailId');} ?>"  class="form-control" id="emailId" name="emailId" <?php if($getEmpDetails['email']){?> disabled="disabled"<?php } ?> >
								<label for="emailId"><i class="bx bx-envelope  fntClr"></i> Email Id <span class="text-danger">*</span></label>
							</div>
						</div>
						<div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" value="<?php if($getEmpDetails['adhar_no']){echo $getEmpDetails['adhar_no'];}else{ set_value('aadhaar_no');} ?>"  class="form-control" name="aadhaar_no" id="aadhaar_no" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')" maxlength="12">
                                <label for="aadhaar_no"><i class="bx bx-id-card fntClr"></i> Aadhar No.</label>
                         	</div>
                        </div>
						<div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="text" value="<?php if($getEmpDetails['adhar_no']){echo $getEmpDetails['pan_no'];}else{ set_value('pan_no');} ?>"  class="form-control" name="pan_no" id="pan_no" maxlength="12">
                                <label for="pan_no"><i class="bx bx-id-card fntClr"></i> PAN No.</label>
                         	</div>
                        </div>
						
					</div>
					</div>
					<div class="card-header ami_cmn"><span><i class="bx bx-home-circle "></i></span> Communication Information</div>	
					<div class="card-body p-4" style="margin-bottom: -10px;">
                    <div class="row">
						<div class="col-lg-12">
							<div class="form-floating mb-3">
			<textarea class="form-control" name="address" id="address"><?php if($getEmpDetails['address']){echo $getEmpDetails['address'];}else{set_value('address');}?></textarea>
								<label for="address"><i class="bx bxs-user-pin fntClr"></i>  Address. <span class="text-danger">*</span></label>
							</div>
						</div>		
						<div class="col-lg-4">
							<div class="form-floating mb-3">
								<select class="form-select empSelectR" name="state" id="state">
									<option value="">--- Select One ---</option>
									<?php if($getState)
										  {
											foreach($getState as $list)
											{?>
					<option value="<?php echo $list->id;?>" <?php if($list->id==$getEmpDetails['state']){ echo 'selected="selected"';}?>><?php echo $list->state_cities;?></option>
											<?php }}?>
								</select>
								<label for="state"><i class="bx bx-area fntClr"></i>  State</label>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-floating mb-3">
								<select class="form-select" name="district" id="district" >
								<option value="">--- Select One ---</option>
									<?php if($getCity)
										  {
										   foreach($getCity as $c_list)
											{?>
								<option value="<?php echo $c_list->id;?>" <?php if($c_list->id==$getEmpDetails['district']){ echo 'selected="selected"';}?>><?php echo $c_list->state_cities;?></option>
											<?php }}?>
								</select>
								<label for="district"><i class="bx bx-area fntClr"></i>  District</label>
							</div>
						</div>
						<div class="col-lg-4">
								<div class="form-floating mb-3">
	<input type="text" value="<?php if($getEmpDetails['zipcode']){echo $getEmpDetails['zipcode'];}else{set_value('zipcode');} ?>"  class="form-control" id="zipcode" name="zipcode">
									<label for="zipcode"><i class="bx bx-target-lock fntClr"></i>  Zipcode.<span class="text-danger">*</span></label>
								</div>
						</div>    	
					</div>
					</div>
					<div class="card-header ami_cmn"><span><i class="bx bx-cog bx-spin"></i></span> Security Information</div>	
					<div class="card-body p-4" style="margin-bottom: -10px;">
					<div class="row">	
						<div class="col-lg-6">
							<div class="form-floating mb-3">
								<input type="password" value="<?php  set_value('password'); ?>"  class="form-control" name="password" id="password" >
								<label for="password"><i class="bx bx-cog fntClr"></i> Password. <span class="text-danger">*</span></label>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-floating mb-3">
								<input type="password" value="<?php  set_value('conf_password');?>"  class="form-control" name="conf_password" id="conf_password" >
								<label for="password"><i class="bx bx-cog fntClr"></i>  Confirm Password. <span class="text-danger">*</span></label>
							</div>
						</div>								
					</div>
				</div>       
	  <div class="card-footer">
	       <a href="<?php echo base_url();?>mlm_software/admin/partners/frenchise" class="btn btn-outline-dark waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
		   <button type="submit" class="btn btn-outline-primary waves-effect waves-light" style="float:right;"><i class="bx bx-save"></i> Submit </button>	 
	  </div>
  </div>
  <input type="hidden" value="<?php echo $target;?>" id="target" >
  		</form>
    </div>
</div>
<!----------------------------edit Frenchise end------------------------------>
<script src="<?php echo base_url() ?>media/js/mlm_software/admin/partners.js"></script>