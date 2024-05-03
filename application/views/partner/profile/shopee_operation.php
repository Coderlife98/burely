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
		
		<?php //print_r($getShopee);?>
		
		<div class="card">
			<div class="mitbl">
				<i class="bx bxs-group miU"></i>
				Shopee Manage
				<span><a href="<?php echo base_url('partner/shopee');?>" class="miBack"><i class="bx bx-arrow-back"></i></a>
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
							<div class="row">
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										 <input type="text" readonly="" name="mem_code" id="mem_code" value="<?php echo $username;?>" class="form-control">
										 <label for="MembId"><i class="bx bx-crown fntClr"></i> Shopee Id</label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<select class="form-select" name="gender" id="gender">
											<option value="">---- Select One ----</option>
											<option value="Male" <?php if($getShopee){if($getShopee->gender=="Male"){echo 'selected="selected"';}} ?>>Male</option>
											<option value="Female" <?php if($getShopee){if($getShopee->gender=="Female"){echo 'selected="selected"';}} ?>>Female</option>
										</select>
										<label for="gender"><i class="fas fa-genderless fntClr"></i> Gender.</label>
									</div>
								</div>							
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										 <input type="text" name="mem_name" id="mem_name" class="form-control" value="<?php if($getShopee){echo $getShopee->name;} ?>">
										 <label for="empN"> <i class="bx bx-user-pin fntClr"></i> Member Name. <span class="text-danger">*</span></label>
									</div>
								</div>	
								<div class="col-lg-6">
								   <div class="form-floating mb-3">
			<input type="date" name="date_of_birth" class="form-control flatpickr-input active" id="date_of_birth"  value="<?php if($getShopee){echo $getShopee->date_of_birth;}?>">
										<label for="Name"><i class="mdi mdi-calendar-account fntClr"></i> Date of birth</label>
									</div>
								</div>					                        
								<div class="col-lg-6">
									<div class="form-floating mb-3">
									<input type="text" class="form-control" id="mob_nu" name="mob_nu" oninput="this.value = this.value.replace(/[^0-9]/g,'').replace(/(\  *?)\  */g, '$1');" maxlength="10" value="<?php if($getShopee){echo $getShopee->mobile;}?>">
									 <label for="mob_nu"><i class="bx bx-mobile  fntClr"></i> Mobile Number.<span class="text-danger">*</span></label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
									<input type="text" class="form-control" id="emailId" name="emailId" value="<?php if($getShopee){echo $getShopee->email;}?>">
										<label for="emailId"><i class="bx bx-envelope  fntClr"></i> Email Id <span class="text-danger">*</span></label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<input type="password" class="form-control" name="password" id="password" value="<?php if($getShopee){echo $getShopee->shw_pass;}?>">
										<label for="password"><i class="bx bx-cog fntClr"></i> Password.</label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<input type="password" class="form-control" name="confPass" id="confPass" value="<?php if($getShopee){echo $getShopee->shw_pass;}?>">
										<label for="cnfPass"><i class="bx bx-cog fntClr"></i> Confirm Password.</label>
									</div>
								</div>
							</div>
						</div>
						<div id="communicationInfo">						
						    <div class="row">
								<div class="col-lg-12">
									<div class="form-floating mb-3">
										<textarea class="form-control" name="address" id="address"><?php if($getShopee){echo $getShopee->address;}?></textarea>
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
					<option value="<?php echo $list->id;?>" <?php if($list->id==$getShopee->state){ echo 'selected="selected"';}?>><?php echo $list->state_cities;?></option>
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
		<option value="<?php echo $c_list->id;?>" <?php if($c_list->id==$getShopee->district){ echo 'selected="selected"';}?>><?php echo $c_list->state_cities;?></option>
													<?php }}?>
										</select>
										<label for="district"><i class="bx bx-area fntClr"></i>  District</label>
									</div>
							</div>
								<div class="col-lg-4">
									<div class="form-floating mb-3">
	<input type="text" value="<?php if($getShopee){echo $getShopee->zipcode;}?>" class="form-control" id="zipcode"name="zipcode">
										<label for="zipcode"><i class="bx bx-target-lock fntClr"></i>  Zipcode.<span class="text-danger">*</span></label>
									</div>
							</div>   
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<input type="text" class="form-control" name="aadhaar_no" id="aadhaar_no" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')" maxlength="12" value="<?php if($getShopee){echo $getShopee->aadhaar_nu;}?>">
										<label for="aadhaar_no"><i class="bx bx-id-card fntClr"></i> Aadhar No.</label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<input type="text" value="<?php if($getShopee){echo $getShopee->pan_nu;}?>" class="form-control" name="pan_no" id="pan_no" maxlength="12">
										<label for="pan_no"><i class="bx bx-id-card fntClr"></i> PAN No.</label>
									</div>
								</div>
							</div>
						</div>
						<div id="bankingInfo">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										 <input type="text" name="bName" id="bName" class="form-control" value="<?php if($getShopee){echo $getShopee->bank_name;}?>" >
										 <label for="bname"><i class="mdi mdi-bank-outline fntClr"></i> Bank Name <span class="text-danger">*</span></label>
									</div>
								</div>							
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<input type="text" name="bankAc" id="bankAc" class="form-control" value="<?php if($getShopee){echo $getShopee->bank_ac_no;}?>" >
										 <label for="bankAc"> <i class="mdi mdi-format-list-numbered fntClr"></i> Bank A/C No. <span class="text-danger">*</span></label>
									</div>
								</div>	
								<div class="col-lg-6">
								   <div class="form-floating mb-3">
							<input type="text" value="<?php if($getShopee){echo $getShopee->bank_Ifsc;}?>" name="bnkIFSC" class="form-control flatpickr-input active" id="bnkIFSC">
										<label for="bnkIFSC"><i class=" bx bx-code-block  fntClr"></i>Bank IFSC. <span class="text-danger">*</span></label>
									</div>
								</div>					                        
								<div class="col-lg-6">
									<div class="form-floating mb-3">
						  <input type="text" class="form-control" id="brName" name="brName"  value="<?php if($getShopee){echo $getShopee->bankBrName;}?>" >
									 	<label for="brName"><i class="bx bx-git-branch fntClr"></i> Branch Name.<span class="text-danger">*</span></label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<input type="text" class="form-control" id="nomiName" name="nomiName"  value="<?php if($getShopee){echo $getShopee->nominee_name;}?>" >
										<label for="nomiName"><i class="bx bx-user-circle fntClr"></i> Nominee Name <span class="text-danger">*</span></label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
								<input type="text" class="form-control" name="nomineeRel" id="nomineeRel"  value="<?php if($getShopee){echo $getShopee->nominee_relationship;}?>" >
										<label for="nomineeRel"><i class="bx bx-group fntClr"></i> Nominee Relationship.</label>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-floating mb-3">
										<textarea class="form-control" name="NomAddr" id="NomAddr"><?php if($getShopee){echo $getShopee->nominee_address;}?></textarea>
										<label for="nomAddr"><i class="bx bx-home-alt fntClr"></i> Nominee Address.</label>
									</div>
								</div>
							</div>
						</div>
						<div id="docInfo">
							<div class="row" style="margin-bottom:20px;">	
							   <div class="col-md-4">
									<div class="shopeDocImg">
					<img id="adrImg" src="<?php if($getShopee){echo base_url($getShopee->adhar_img);}else{echo base_url('uploads/partner_document/no_img.png');}?>" alt="doc image">
									</div>
									<div class="shopeText"> Aadhaar Card
									  <span><i class="bx bx-trash shopiActn" data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="shopee-partner/shopee/detele-delAadhar"></i>
											<i class="bx bx-image shopiActn" data-id="midoc-edtAadhar-partner/shopee/operation"></i>
										</span>
									</div>
								</div>
							   <div class="col-md-4">
									<div class="shopeDocImg">
					<img id="panImg" src="<?php if($getShopee){echo base_url($getShopee->pan_img);}else{echo base_url('uploads/partner_document/no_img.png');}?>" alt="doc image">
									</div>
									<div class="shopeText"> Pan Card
										<span><i class="bx bx-trash shopiActn" data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="shopee-partner/shopee/detele-delPan"></i>
											  <i class="bx bx-image shopiActn" data-id="midoc-pancard-partner/shopee/operation"></i>
										</span>
									</div>
								</div>
							   <div class="col-md-4">
									<div class="shopeDocImg">
			<img id="passBookImg" src="<?php if($getShopee){echo base_url($getShopee->passbook_img);}else{echo base_url('uploads/partner_document/no_img.png');}?>" alt="doc image">
									</div>
									<div class="shopeText"> Bankpass Book
										<span>
										   <i class="bx bx-trash shopiActn" data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="shopee-partner/shopee/detele-delBankpass"></i>	
										   <i class="bx bx-image shopiActn" data-id="midoc-passbook-partner/shopee/operation"></i>
									</span>
									</div>
								</div>
							</div>
							<div class="col-md-12" id="shopiDocFileUpload"> <span id="docUrlActn" style="display:none;"></span>
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
				<button type="button" class="btn btn-outline-primary waves-effect waves-light pull-right memAction" id="getNext"> Next <i class="fas fa-arrow-right "></i></button>
			<button type="button" class="btn btn-outline-primary waves-effect waves-light pull-right memAction" id="getPrevious"><i class="fas fa-arrow-left"></i> Previous</button>
			</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="target" value="<?php echo base_url('partner/shopee/operation');?>">
<script src="<?php echo base_url() ?>media/js/partner.min.js"></script>