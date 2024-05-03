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
 <div class="row mb-4">
	<div class="col-xl-12">
		
		<?php //print_r($getDetails);?>
		
		<div class="card">
			<div class="mitbl">
				<i class="bx bxs-group miU"></i>
				 Manage Partner
				<span><a href="<?php echo base_url('super_admin/dashboard');?>" class="miBack"><i class="bx bx-arrow-back"></i></a>
				</span>
			</div>
			<div class="card-body">
				<div class="col-xl-12">
					<div class="row">
						<ul class="mi_base_vizard">
							<li class="cmpltVzrd"><i class="bx bx-notepad"></i> Personal Details </li>
							<li id="commDet"><i class="bx bx-home-circle"></i> Communication Details </li>
							<li id="bnkDet"><i class="bx bxs-bank"></i> Banking Details </li>
							<li id="docDet"><i class="bx bx-user-circle"></i> Document Details </li>
						</ul>	
					</div>
					
						<div id="personalInfo">
						<?php //print_r($getDetails);?>
						
							<div class="row">
							
								<div class="col-lg-4">
									<div class="form-floating mb-3">
										<?php if($getDetails){?>
										<span class="form-control"><?php if($getDetails->user_typ=='2'){echo 'Shopee';}else{echo 'Frenchise';}?></span>
										<?php }else{?>
										<select class="form-select empSelectR" name="roleAs" id="roleAs">
											<option value="">---- Select One ----</option>
											<option value="1">Frenchise</option>
											<option value="2">Shopee</option>
										</select>
										<?php }?>
										<label for="roleAs"><i class="far fa-registered fntClr"></i> Role As.</label>
									</div>
								</div>							
								<div class="col-lg-4">			
									<div class="form-floating mb-3">
				<input type="text" readonly="" name="mem_code" id="mem_code" value="<?php  if($getDetails){echo $getDetails->username;}?>" class="form-control">
										<label for="MembId" ><i class="bx bx-crown fntClr"></i> <span id="roleIdAsRl">Frenchise Id.</span></label>
										<input type="hidden" id="getMId" value="<?php  if($username){echo $username;}?>" />
									</div>	
								</div>							
								<div class="col-lg-4">			
									<div class="form-floating mb-3">
							<input type="text" readonly="" name="securityMny" id="securityMny" class="form-control"  value="<?php if($getDetails){echo $getDetails->topup;}?>" >
										<label for="securityMny" ><i class="bx bx-rupee fntClr"></i> <span id="secAmt">Security Amount.</span></label>	
									</div>	
								</div>
								
								<div class="col-lg-4">			
									<div class="form-floating mb-3">
				            <input type="text" name="partnerName" id="partnerName" value="<?php  if($getDetails){echo $getDetails->shop_name;}?>" class="form-control">
                            <label for="MembId21" ><i class="bx bx-crown fntClr"></i> <span id="shpName">Frenchise Name.</span></label>
									</div>	
								</div>
								<div class="col-lg-4">
									<div class="form-floating mb-3">
										<select class="form-select" name="frTitle" id="frTitle">
											<option value="">---Select One---</option>
											<option value="Mr." <?php if($getDetails){if($getDetails->p_title=="Mr."){echo 'selected="selected"';}} ?> >Mr.</option>
											<option value="Mrs."<?php if($getDetails){if($getDetails->p_title=="Mrs."){echo 'selected="selected"';}}?> >Mrs.</option>
											<option value="Miss"<?php if($getDetails){if($getDetails->p_title=="Miss"){echo 'selected="selected"';}}?> >Miss</option>
											<option value="M/S" <?php if($getDetails){if($getDetails->p_title=="M/S"){echo 'selected="selected"';}} ?> >M/S</option>
										</select>
										<label for="gender"><i class="fas fa-genderless fntClr"></i> Title.</label>
									</div>
								</div>							
								<div class="col-lg-4">
									<div class="form-floating mb-3">
										 <input type="text" name="mem_name" id="mem_name" class="form-control" value="<?php if($getDetails){echo $getDetails->name;} ?>">
										 <label for="empN"> <i class="bx bx-user-pin fntClr"></i> Member Name. <span class="text-danger">*</span></label>
									</div>
								</div>	
								
								<div class="col-lg-4">
									<div class="form-floating mb-3">
										<select class="form-select" name="gender" id="gender">
											<option value="">---- Select One ----</option>
											<option value="Male" <?php if($getDetails){if($getDetails->gender=="Male"){echo 'selected="selected"';}} ?>>Male</option>
											<option value="Female" <?php if($getDetails){if($getDetails->gender=="Female"){echo 'selected="selected"';}} ?>>Female</option>
											<option value="Transgender" <?php if($getDetails){if($getDetails->gender=="Transgender"){echo 'selected="selected"';}} ?>>Transgender</option>
											
											
										</select>
										<label for="gender"><i class="fas fa-genderless fntClr"></i> Gender.</label>
									</div>
								</div>
								
								
								<div class="col-lg-4">
								   <div class="form-floating mb-3">
			<input type="date" name="date_of_birth" class="form-control flatpickr-input active" id="date_of_birth"  value="<?php if($getDetails){echo $getDetails->date_of_birth;}?>">
										<label for="Name"><i class="mdi mdi-calendar-account fntClr"></i> Date of birth</label>
									</div>
								</div>					                        
								<div class="col-lg-4">
									<div class="form-floating mb-3">
									<input type="text" class="form-control" id="mob_nu" name="mob_nu" oninput="this.value = this.value.replace(/[^0-9]/g,'').replace(/(\  *?)\  */g, '$1');" maxlength="10" value="<?php if($getDetails){echo $getDetails->mobile;}?>">
									 <label for="mob_nu"><i class="bx bx-mobile  fntClr"></i> Mobile Number.<span class="text-danger">*</span></label>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-floating mb-3">
									<input type="text" class="form-control" id="emailId" name="emailId" value="<?php if($getDetails){echo $getDetails->email;}?>">
										<label for="emailId"><i class="bx bx-envelope  fntClr"></i> Email Id <span class="text-danger">*</span></label>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-floating mb-3">
										<input type="password" class="form-control" name="password" id="password" value="<?php if($getDetails){echo $getDetails->shw_pass;}?>">
										<label for="password"><i class="bx bx-cog fntClr"></i> Password.</label>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-floating mb-3">
										<input type="password" class="form-control" name="confPass" id="confPass" value="<?php if($getDetails){echo $getDetails->shw_pass;}?>">
										<label for="cnfPass"><i class="bx bx-cog fntClr"></i> Confirm Password.</label>
									</div>
								</div>
							</div>
						</div>
						<div id="communicationInfo">						
						    <div class="row">
								<div class="col-lg-12">
									<div class="form-floating mb-3">
										<textarea class="form-control" name="address" id="address"><?php if($getDetails){echo $getDetails->address;}?></textarea>
										 <label for="MembId"><i class="bx bx-crown fntClr"></i> Address</label>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-floating mb-3">
										<select class="form-select empSelectR" name="statN" id="statN">
											<option value="">--- Select One ---</option>
											<?php if($getState)
												  {
													foreach($getState as $list)
													{?>
					<option value="<?php echo $list->id;?>" <?php if($list->id==$getDetails->state){ echo 'selected="selected"';}?>><?php echo $list->state_cities;?></option>
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
		<option value="<?php echo $c_list->id;?>" <?php if($c_list->id==$getDetails->district){ echo 'selected="selected"';}?>><?php echo $c_list->state_cities;?></option>
													<?php }}?>
										</select>
										<label for="district"><i class="bx bx-area fntClr"></i>  District</label>
									</div>
							</div>
								<div class="col-lg-4">
									<div class="form-floating mb-3">
	<input type="text" value="<?php if($getDetails){echo $getDetails->zipcode;}?>" class="form-control" id="zipcode"name="zipcode">
										<label for="zipcode"><i class="bx bx-target-lock fntClr"></i>  Zipcode.<span class="text-danger">*</span></label>
									</div>
							</div>   
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<input type="text" class="form-control" name="aadhaar_no" id="aadhaar_no" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')" maxlength="12" value="<?php if($getDetails){echo $getDetails->aadhaar_nu;}?>">
										<label for="aadhaar_no"><i class="bx bx-id-card fntClr"></i> Aadhar No.</label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<input type="text" value="<?php if($getDetails){echo $getDetails->pan_nu;}?>" class="form-control" name="pan_no" id="pan_no" maxlength="12">
										<label for="pan_no"><i class="bx bx-id-card fntClr"></i> PAN No.</label>
									</div>
								</div>
							</div>
						</div>
						<div id="bankingInfo">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										 <input type="text" name="bName" id="bName" class="form-control" value="<?php if($getDetails){echo $getDetails->bank_name;}?>" >
										 <label for="bname"><i class="mdi mdi-bank-outline fntClr"></i> Bank Name <span class="text-danger">*</span></label>
									</div>
								</div>							
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<input type="text" name="bankAc" id="bankAc" class="form-control" value="<?php if($getDetails){echo $getDetails->bank_ac_no;}?>" >
										 <label for="bankAc"> <i class="mdi mdi-format-list-numbered fntClr"></i> Bank A/C No. <span class="text-danger">*</span></label>
									</div>
								</div>	
								<div class="col-lg-6">
								   <div class="form-floating mb-3">
							<input type="text" value="<?php if($getDetails){echo $getDetails->bank_Ifsc;}?>" name="bnkIFSC" class="form-control flatpickr-input active" id="bnkIFSC">
										<label for="bnkIFSC"><i class=" bx bx-code-block  fntClr"></i>Bank IFSC. <span class="text-danger">*</span></label>
									</div>
								</div>					                        
								<div class="col-lg-6">
									<div class="form-floating mb-3">
						  <input type="text" class="form-control" id="brName" name="brName"  value="<?php if($getDetails){echo $getDetails->bankBrName;}?>" >
									 	<label for="brName"><i class="bx bx-git-branch fntClr"></i> Branch Name.<span class="text-danger">*</span></label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<input type="text" class="form-control" id="nomiName" name="nomiName"  value="<?php if($getDetails){echo $getDetails->nominee_name;}?>" >
										<label for="nomiName"><i class="bx bx-user-circle fntClr"></i> Nominee Name <span class="text-danger">*</span></label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
								<input type="text" class="form-control" name="nomineeRel" id="nomineeRel"  value="<?php if($getDetails){echo $getDetails->nominee_relationship;}?>" >
										<label for="nomineeRel"><i class="bx bx-group fntClr"></i> Nominee Relationship.</label>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-floating mb-3">
										<textarea class="form-control" name="NomAddr" id="NomAddr"><?php if($getDetails){echo $getDetails->nominee_address;}?></textarea>
										<label for="nomAddr"><i class="bx bx-home-alt fntClr"></i> Nominee Address.</label>
									</div>
								</div>
							</div>
						</div>
						<div id="docInfo"><!--style="display:none;"-->
							<div class="row" style="margin-bottom:20px;">	
							 
							 
							 <div class="col-md-3">
									<div class="memDocImg">
					<img id="profileImg" src="<?php if($getDetails){echo base_url($getDetails->my_img);}else{echo base_url('uploads/user/no_image1.png');}?>" alt="doc image">
									</div>
									<div class="memText"> Profile Image 
									  <span><i class="bx bx-trash shopiActn" data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="shopee-mlm_software/admin/partners/detele-delAadhar"></i>
											<i class="bx bx-image shopiActn" data-id="midoc-profileImg-mlm_software/admin/partners/manage"></i>
										</span>
									</div>
								</div>
							 
							 
							 
							     <div class="col-md-3">
									<div class="memDocImg">
					<img id="adrImg" src="<?php if($getDetails){echo base_url($getDetails->adhar_img);}else{echo base_url('uploads/partner_document/no_img.png');}?>" alt="doc image">
									</div>
									<div class="memText"> Aadhaar Card
									  <span><i class="bx bx-trash shopiActn" data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="shopee-mlm_software/admin/partners/detele-delAadhar"></i>
											<i class="bx bx-image shopiActn" data-id="midoc-edtAadhar-mlm_software/admin/partners/manage"></i>
										</span>
									</div>
								</div>
							   <div class="col-md-3">
									<div class="memDocImg">
					<img id="panImg" src="<?php if($getDetails){echo base_url($getDetails->pan_img);}else{echo base_url('uploads/partner_document/no_img.png');}?>" alt="doc image">
									</div>
									<div class="memText"> Pan Card
										<span><i class="bx bx-trash shopiActn" data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="shopee-mlm_software/admin/partners/detele-delPan"></i>
											  <i class="bx bx-image shopiActn" data-id="midoc-pancard-mlm_software/admin/partners/manage"></i>
										</span>
									</div>
								</div>
							   <div class="col-md-3">
									<div class="memDocImg">
			<img id="passBookImg" src="<?php if($getDetails){echo base_url($getDetails->passbook_img);}else{echo base_url('uploads/partner_document/no_img.png');}?>" alt="doc image">
									</div>
									<div class="memText"> Bankpass Book
										<span>
										   <i class="bx bx-trash shopiActn" data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="shopee-mlm_software/admin/partners/detele-delBankpass"></i>	
										   <i class="bx bx-image shopiActn" data-id="midoc-passbook-mlm_software/admin/partners/manage"></i>
									</span>
									</div>
								</div>
							</div>
							<?php //print_r($getDetails);?>
							<div class="col-md-12" id="shopiDocFileUpload" style="display:none;"> <span id="docUrlActn" style="display:none;"></span>
								<div for="images" class="drop-container updocImg" style="">
										<span class="drop-title">Drop files here</span>or
										<div style="width: 382.px; margin:0 auto auto auto;">
											<div class="mi_group">
												<input type="file" class="mi_form" name="file" id="docfile">
												<button type="button" class="mibtn shopeeImgUploadActn" id="Update"><i class="bx bx-save"></i> Upload</button>
											</div>
											<div id="imgMsgS">&nbsp;</div>
										</div>
								</div>
							</div>
						</div>
					<input type="hidden" id="miAction"  value="1"/>	<input type="hidden" id="shoppId" />		
				
				<?php if($getDetails){?>
				      <span onclick="visiblePass('<?php echo $getDetails->id;?>')">View Password : 
					  		<span id="vsblPass" style="font-weight:600;padding-left: 5px;"><div class="passwrd"></div></span>
					  </span>
				<?php }?>	
				
				
				<button type="button" class="btn btn-outline-primary waves-effect waves-light pull-right memAction" id="getNext"> Next <i class="fas fa-arrow-right "></i></button>
			<button type="button" class="btn btn-outline-primary waves-effect waves-light pull-right memAction" id="getPrevious"><i class="fas fa-arrow-left"></i> Previous</button>
			</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="target" value="<?php echo base_url('mlm_software/admin/partners/manage');?>">
<script src="<?php echo base_url('media/js/mlm_software/admin/partners.js'); ?>"></script>