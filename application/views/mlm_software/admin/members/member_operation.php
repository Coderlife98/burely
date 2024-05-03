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
		<?php //print_r($getData);
		?>
		<div class="card">
			<div class="miArv">
				<i class="bx bxs-group miAr"></i>
				Member Manage
				<span><a href="<?php echo base_url('mlm_software/admin/member/lists'); ?>" class="miArvBack"><i class="bx bx-arrow-back"></i></a>
				</span>
			</div>
			<div class="card-body">

				<?php //print_r($getData);
				?>

				<div class="col-xl-12">
					<div class="row">
						<ul class="mi_base_vizard">
							<li class="cmpltVzrd"><i class="bx bx-notepad"></i> Personal Details </li>
							<li id="commDet"><i class="bx bx-home-circle"></i> Communication Details </li>
							<li id="bnkDet"><i class="bx bxs-bank"></i> Banking Details </li>
							<li id="docDet"><i class="bx bx-user-circle"></i> Document Details </li>
						</ul>
					</div>
					<!-- personol information  end-->

					<div id="personalInfo">
						<div class="row">
							<input type="hidden" id="fmPackage" value="<?php if ($fmPack) {
																			echo $fmPack->pack_price . '@@@@' . $fmPack->pack_name;
																		} ?>">
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" readonly="" name="mem_code" id="mem_code" value="<?php echo $username; ?>" class="form-control">
									<label for="MembId"><i class="bx bx-crown fntClr"></i> Member Id</label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="date" name="date_of_birth" class="form-control flatpickr-input active" id="date_of_birth" value="<?php if ($getData) {
																																						echo $getData->date_of_birth;
																																					} ?>">
									<label for="Name"><i class="mdi mdi-calendar-account fntClr"></i> Date of birth</label>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-floating mb-3">
									<select id="salutation" class="form-select">
										<option value="">---Select One---</option>
										<option value="Mr." <?php if ($getData) {
																if ($getData->memTitle == "Mr.") {
																	echo 'selected="selected"';
																}
															} ?>>Mr.</option>
										<option value="Mrs." <?php if ($getData) {
																	if ($getData->memTitle == "Mrs.") {
																		echo 'selected="selected"';
																	}
																} ?>>Mrs.</option>
										<option value="Miss" <?php if ($getData) {
																	if ($getData->memTitle == "Miss") {
																		echo 'selected="selected"';
																	}
																} ?>>Miss</option>
										<option value="M/S" <?php if ($getData) {
																if ($getData->memTitle == "M/S") {
																	echo 'selected="selected"';
																}
															} ?>>M/S</option>
									</select>
									<label for="memTitle"> <i class="bx bx-user-pin fntClr"></i> Title. <span class="text-danger">*</span></label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" name="mem_name" id="mem_name" class="form-control" value="<?php if ($getData) {
																														echo $getData->name;
																													} ?>">
									<label for="empN"> <i class="bx bx-user-pin fntClr"></i> Member Name. <span class="text-danger">*</span></label>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-floating mb-3">
									<select class="form-select memSelectR" name="gender" id="gender">
										<option value="">---- Select One ----</option>
										<option value="Male" <?php if ($getData) {
																	if ($getData->gender == "Male") {
																		echo 'selected="selected"';
																	}
																} ?>>Male</option>
										<option value="Female" <?php if ($getData) {
																	if ($getData->gender == "Female") {
																		echo 'selected="selected"';
																	}
																} ?>>Female</option>
										<option value="Transgender" <?php if ($getData) {
																		if ($getData->gender == "Transgender") {
																			echo 'selected="selected"';
																		}
																	} ?>>Transgender</option>
									</select>
									<label for="gender"><i class="fas fa-genderless fntClr"></i> Gender.</label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" class="form-control" id="mob_nu" name="mob_nu" oninput="this.value = this.value.replace(/[^0-9]/g,'').replace(/(\  *?)\  */g, '$1');" maxlength="10" value="<?php if ($getData) {
																																																						echo $getData->mobile;
																																																					} ?>">
									<label for="mob_nu"><i class="bx bx-mobile  fntClr"></i> Mobile Number.<span class="text-danger">*</span></label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" class="form-control" id="emailId" name="emailId" value="<?php if ($getData) {
																													echo $getData->email;
																												} ?>">
									<label for="emailId"><i class="bx bx-envelope  fntClr"></i> Email Id </label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="password" class="form-control" name="password" id="password" value="<?php if ($getData) {
																															echo $getData->shw_pass;
																														} ?>">
									<label for="password"><i class="bx bx-cog fntClr"></i> Password.</label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="password" class="form-control" name="confPass" id="confPass" value="<?php if ($getData) {
																															echo $getData->shw_pass;
																														} ?>">
									<label for="cnfPass"><i class="bx bx-cog fntClr"></i> Confirm Password.</label>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="form-floating mb-3">
									<?php /*if($getData->topup=='0.00')
									{*/
									?>
									<select class="form-select" name="package" id="package">
										<option value="">---- Select One ----</option>
										<?php if ($package) {
											foreach ($package as $pack) {	?>
												<option value="<?php echo $pack['pack_price']; ?>" <?php if ($getData) {
																										if ($getData->topup == $pack['pack_price']) {
																											echo 'selected="selected"';
																										} else if ($getData->topup_request == $pack['pack_price']) {
																											echo 'selected="selected"';
																										}
																									} ?>>
													<?php echo $pack['pack_name']; ?>
												</option>
										<?php }
										} ?>
									</select>
									<?php //}else{
									?>
									<!--<span class="form-control"><?php //echo $getData->topup;
																	?></span>-->
									<?php //}
									?>
									<label for="gender"><i class="bx bx-money fntClr"></i> Package.</label>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-floating mb-3">
									<input type="text" name="sponsorId" id="sponsorId" value="<?php if ($getData) {
																									echo $getData->sponsor;
																								} ?>" <?php if ($getData) {
																																					echo 'readonly=""';
																																				} ?> class="form-control partAction">
									<label for="MembId"><i class="bx bx-crown fntClr"></i> Sponsor Id</label>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-floating mb-3"><span id="spErr">&nbsp;</span>
									<span id="sponsorName" class="form-control"><?php if ($getData) {
																					echo $getData->sponsorName;
																				} ?></span>
									<label for="sponsorName"><i class="bx bx-user-pin fntClr"></i> Sponsor Name </label>

								</div>
							</div>


						</div>
					</div>

					<!-- personol information  end-->
					<!-- Comunication start-->
					<div id="communicationInfo">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-floating mb-3">
									<textarea class="form-control" name="address" id="address"><?php if ($getData) {
																									echo $getData->address;
																								} ?></textarea>
									<label for="MembId"><i class="bx bx-crown fntClr"></i> Address</label>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-floating mb-3">
									<select class="form-select empSelectR" name="statN" id="statN">
										<option value="">--- Select One ---</option>
										<?php if ($getState) {
											foreach ($getState as $list) { ?>
												<option value="<?php echo $list->id; ?>" <?php if ($list->id == $getData->state) {
																							echo 'selected="selected"';
																						} ?>><?php echo $list->state_cities; ?></option>
										<?php }
										} ?>
									</select>
									<label for="state"><i class="bx bx-area fntClr"></i> State</label>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-floating mb-3">
									<select class="form-select" name="district" id="district">
										<option value="">--- Select One ---</option>
										<?php if ($getCity) {
											foreach ($getCity as $c_list) { ?>
												<option value="<?php echo $c_list->id; ?>" <?php if ($c_list->id == $getData->district) {
																								echo 'selected="selected"';
																							} ?>><?php echo $c_list->state_cities; ?></option>
										<?php }
										} ?>
									</select>
									<label for="district"><i class="bx bx-area fntClr"></i> District</label>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-floating mb-3">
									<input type="text" value="<?php if ($getData) {
																	echo $getData->zipcode;
																} ?>" class="form-control" id="zipcode" name="zipcode">
									<label for="zipcode"><i class="bx bx-target-lock fntClr"></i> Zipcode.<span class="text-danger">*</span></label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" class="form-control" name="aadhaar_no" id="aadhaar_no" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')" maxlength="12" value="<?php if ($getData) {
																																																												echo $getData->aadhaar_nu;
																																																											} ?>">
									<label for="aadhaar_no"><i class="bx bx-id-card fntClr"></i> Aadhar No.</label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" value="<?php if ($getData) {
																	echo $getData->pan_nu;
																} ?>" class="form-control" name="pan_no" id="pan_no" maxlength="12">
									<label for="pan_no"><i class="bx bx-id-card fntClr"></i> PAN No.</label>
								</div>
							</div>
						</div>
					</div>
					<!-- Comunication end-->

					<!-- Bank Info start-->   
					<div id="bankingInfo">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" name="bName" id="bName" class="form-control" value="<?php if ($getData) {
																												echo $getData->bank_name;
																											} ?>">
									<label for="bname"><i class="mdi mdi-bank-outline fntClr"></i> Bank Name <span class="text-danger">*</span></label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" name="bankAc" id="bankAc" class="form-control" value="<?php if ($getData) {
																													echo $getData->bank_ac_no;
																												} ?>">
									<label for="bankAc"> <i class="mdi mdi-format-list-numbered fntClr"></i> Bank A/C No. <span class="text-danger">*</span></label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" value="<?php if ($getData) {
																	echo $getData->bank_Ifsc;
																} ?>" name="bnkIFSC" class="form-control flatpickr-input active" id="bnkIFSC">
									<label for="bnkIFSC"><i class=" bx bx-code-block  fntClr"></i>Bank IFSC. <span class="text-danger">*</span></label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" class="form-control" id="brName" name="brName" value="<?php if ($getData) {
																													echo $getData->bankBrName;
																												} ?>">
									<label for="brName"><i class="bx bx-git-branch fntClr"></i> Branch Name.<span class="text-danger">*</span></label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" class="form-control" id="nomiName" name="nomiName" value="<?php if ($getData) {
																														echo $getData->nominee_name;
																													} ?>">
									<label for="nomiName"><i class="bx bx-user-circle fntClr"></i> Nominee Name <span class="text-danger">*</span></label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" class="form-control" name="nomineeRel" id="nomineeRel" value="<?php if ($getData) {
																															echo $getData->nominee_relationship;
																														} ?>">
									<label for="nomineeRel"><i class="bx bx-group fntClr"></i> Nominee Relationship.</label>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-floating mb-3">
									<textarea class="form-control" name="NomAddr" id="NomAddr"><?php if ($getData) {
																									echo $getData->nominee_address;
																								} ?></textarea>
									<label for="nomAddr"><i class="bx bx-home-alt fntClr"></i> Nominee Address.</label>
								</div>
							</div>
						</div>
					</div>
					<!-- Bank Info end-->

					<!-- Document Info start-->
					<div id="docInfo">
						<div class="row" style="margin-bottom:20px;">
							<div class="col-md-3">
								<div class="memDocImg">
									<img id="profileImg" src="<?php if ($getData) {
																	echo base_url($getData->my_img);
																} else {
																	echo base_url('uploads/member/no_profile.png');
																} ?>" alt="doc image">
								</div>
								<div class="memText"> Profile Image
									<span>
										<i class="bx bx-trash memActn" data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="memberDoc-mlm_software/admin/member/delete-profileImg"></i>
										<i class="bx bx-image memActn" data-id="midoc-profileImg-mlm_software/admin/member/manage"></i>
									</span>
								</div>
							</div>


							<div class="col-md-3">
								<div class="memDocImg">
									<img id="adrImg" src="<?php if ($getData) {
																echo base_url($getData->adhar_img);
															} else {
																echo base_url('uploads/member_document/no_img.png');
															} ?>" alt="doc image">
								</div>
								<div class="memText"> Aadhaar Card
									<span><i class="bx bx-trash memActn" data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="memberDoc-mlm_software/admin/member/delete-delAadhar"></i>
										<i class="bx bx-image memActn" data-id="midoc-edtAadhar-mlm_software/admin/member/manage"></i>
									</span>
								</div>
							</div>
							<div class="col-md-3">
								<div class="memDocImg">
									<img id="panImg" src="<?php if ($getData) {
																echo base_url($getData->pan_img);
															} else {
																echo base_url('uploads/member_document/no_img.png');
															} ?>" alt="doc image">
								</div>
								<div class="memText"> Pan Card
									<span><i class="bx bx-trash memActn" data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="memberDoc-mlm_software/admin/member/delete-delPan"></i>
										<i class="bx bx-image memActn" data-id="midoc-pancard-mlm_software/admin/member/manage"></i>
									</span>
								</div>
							</div>
							<div class="col-md-3">
								<div class="memDocImg">
									<img id="passBookImg" src="<?php if ($getData) {
																	echo base_url($getData->passbook_img);
																} else {
																	echo base_url('uploads/member_document/no_img.png');
																} ?>" alt="doc image">
								</div>
								<div class="memText"> Bankpass Book
									<span>
										<i class="bx bx-trash memActn" data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="memberDoc-mlm_software/admin/member/delete-delBankpass"></i>
										<i class="bx bx-image memActn" data-id="midoc-passbook-mlm_software/admin/member/manage"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="col-md-12" id="memDocFileUpload"> <span id="docUrlActn" style="display:none;"></span>
							<div for="images" class="drop-container updocImg" style="">
								<span class="drop-title">Drop files here</span>or
								<div style="width: 382.px; margin:0 auto auto auto;">
									<div class="mi_group">
										<input type="file" class="mi_form" name="file" id="docfile">
										<button type="button" class="mibtn memberImgUploadActn" id="Update"><i class="bx bx-save"></i> Upload</button>
									</div>
									<div id="imgMsgS">&nbsp;</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Document Info end-->

					<input type="hidden" id="miAction" value="1" /> <input type="hidden" id="memberId" value="<?php if ($getData) {
																													echo $getData->id;
																												} ?>" />
					<?php if ($getData) { ?>
						<span onclick="visiblePass('<?php echo $getData->id; ?>')">View Password :
							<span id="vsblPass" style="font-weight:600;padding-left: 5px;">
								<div class="passwrd"></div>
							</span>
						</span>
					<?php } ?>
					<button type="button" class="btn btn-outline-primary waves-effect waves-light pull-right memAction" id="getNext"> Next <i class="fas fa-arrow-right "></i></button>
					<button type="button" class="btn btn-outline-primary waves-effect waves-light pull-right memAction" id="getPrevious"><i class="fas fa-arrow-left"></i> Previous</button>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="target" value="<?php echo base_url('mlm_software/admin/member/manage'); ?>">
<script src="<?php echo base_url() ?>media/js/mlm_software/admin/members.js"></script>