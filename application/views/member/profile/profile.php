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






<?php //print_r($member);
if($member->my_img)
{
	$getImg=$this->baseUrl.$member->my_img;
	}
	else
	{		
	$getImg=$this->baseUrl.'uploads/member/no_profile.png';		
		}
if($member->status=='Active')
{
	$statusClr='#049504';
	$backClr='background-color:rgba(179, 227, 179, 0.4)';
	}
elseif($member->status=='Block')
{
	$statusClr='#970000';
	$backClr='background-color:rgba(176, 137, 137,0.4)';
	}
	if($member->status=='Suspend')
{
	$statusClr='#bd7b02';
	$backClr='background-color:rgba(215, 192, 151,0.4)';
	}
	
	//print_r($member);
	//echo $this->db->last_query();

//print_r($member);
?>
<input type="hidden" id="id" value="<?php echo $member->id; ?>" />
<div class="row mb-4">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div><div class="clearfix"></div>
                    <div class="text-center bg-pattern">
					   <div id="proPic"><img id="setPrImg" src="<?php echo $getImg; ?>" alt="<?php echo $member->name; ?>" class="avatar-xl rounded-circle mb-3 mi_thumb"></div>	
						<div id="getProfileImageChange" class="imageUploadActn"><i class="icon fa fa-camera"></i></div>
						<h4 class="text-primary mb-2"><?php echo $member->name; ?></h4>
                        <h5 class="text-muted font-size-13 mb-3">ID. <?php echo $member->username; ?></h5>
						 <h6 class="text-muted font-size-13 mb-3" style="margin-top:-10px;"><span style="color:<?php echo $statusClr.';'.$backClr;?>;padding: 0px 10px 2px 10px;"><?php echo $member->status; ?></span></h6>
                        <div class="text-center">
                            <a href="mailto:<?php echo $member->email; ?>" class="btn btn-success me-2 waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-email-outline me-1"></i>Send Mail</a>
                            <a href="tel:<?php echo $member->mobile; ?>" class="btn btn-primary waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-phone-outline me-1"></i>Phone Call</a>
                        </div>
                    </div>
                </div>
            <hr class="my-4">
<!----------------------------------------->


<div class="input-group" id="uploadMemberIMg" style="padding: 0px 0px 20px 0px;border-bottom: 1px solid #d7d7d7; display:none;">
	<input type="file" class="form-control" name="file" id="mem_file">
	<button type="button" class="input-group-text memberImgUploadActn" id="proBtnUpload"><i class="bx bx-save"></i> Upload</button>
</div>
<!----------------------------------------->      			
			   <div class="table-responsive">
                    <h5 class="font-size-16 mb-3" style="color:#008288;"><i class="bx bx-detail"></i> Personal Information</h5>
		<div><p class="mb-1 text-muted font-size-13"><i class="bx bx-mobile-alt "></i> Member ID :</p> <h5 class="font-size-14"><?php echo $member->username; ?></h5></div>					
    <div><p class="mb-1 text-muted font-size-13"><i class="bx bx-calendar "></i> Date Of Joining :</p> <h5 class="font-size-14">
	<?php if($member->create_date!=NULL){ echo date('d-M-Y',strtotime($member->create_date)); }else{ echo 'N/A';}?>
	</h5></div>
<div><p class="mb-1 text-muted font-size-13"><i class="bx bx-envelope "></i>  E-mail :</p> <h5 class="font-size-14"><?php echo $member->email; ?></h5></div>
                </div>
            </div>
        </div>
    </div>
	<div class="col-xl-8">
			<div class="ami_title">
				<i class="bx bx-detail"></i> Joining Info 
				<div class="amiBtnTgle amiBtnUp" id="jnfo"> <i class="fas fa-angle-down"></i> </div>
			</div>
			<div class="crdDet" id="jnfoTr">
				<div class="row">
				     <div class="col-md-6">
							<div class="amiprD"><i class="bx bx-export"></i>
								<span class="amiprDspn">Sponsor ID :</span>
								<span class="joinM"><?php if($member->sponsor){ echo $member->sponsor;}else{ echo 'N/A';}?></span>
							</div>
						</div>
					 <div class="col-md-6">
							<div class="amiprD"><i class="bx bx-user-pin"></i>
								<span class="amiprDspn">Member ID :</span>
								<span class="joinM"><?php if($member->username){ echo $member->username;}else{ echo 'N/A';}?></span>
							</div>
						</div>
					 <div class="col-md-6">
							<div class="amiprD"><i class="bx bx-crown"></i>
								<span class="amiprDspn">Member Rank :</span>
								<span class="joinM"><?php if($member->rank){ echo $member->rank;}else{ echo 'N/A';}?></span>
							</div>
						</div>
					 <div class="col-md-6">
							<div class="amiprD"><i class="bx bx-calendar"></i>
								<span class="amiprDspn">Joining Date :</span>
								<span class="joinM"><?php if($member->create_date){ echo date('H:i:s d-M-Y',strtotime($member->create_date));}else{ echo 'N/A';}?></span>
							</div>
						</div>
				</div>
			</div>
			<div class="ami_title crdBrdr">
				<i class="bx bx-notepad"></i> PERSONAL INFORMATION 
				<div class="amiBtnTgle amiBtnDown" id="perInfo"> <i class="fas fa-angle-up"></i> </div>
			</div>
			<div class="crdDet" id="perInfoTr">
				<div class="row" id="vwPrfo">
						<div class="col-md-6">
							<div class="amiprD"><i class="bx bx-user-circle"></i>
								<span class="amiprDspn">Name :</span>
								<span class="joinM mitext" id="pName"><?php if($member->name){ echo $member->name;}else{ echo 'N/A';}?></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="amiprD"><i class="fas fa-genderless amiInr jficn"></i>
								<span class="amiprDspn">Gender : </span>
								<span class="joinM mitext" id="gender"><?php if($member->gender){ echo $member->gender;}else{ echo 'N/A';}?></span>
								<span class="joinM mi-select" id="genderT" style="display:none;">
									<select id="genderE"><option value="">--- Select One ---</option>
										<option value="Male" <?php if($member->gender=='Male'){ echo 'selected="selected"';}?>>Male</option>
										<option value="Female" <?php if($member->gender=='Female'){ echo 'selected="selected"';}?>>Female</option>
									</select>
								</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="amiprD"><i class="bx bx-mobile-alt "></i>
								<span class="amiprDspn">Mobile Number :</span>
								<span class="joinM" id="mobile"><?php if($member->mobile){ echo $member->mobile;}else{ echo 'N/A';}?></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="amiprD">
								<span class="amiprDspn">Email Id:</span>
									<i class="bx bx-envelope amiInr jficn"></i> 
									<span class="joinM" id="emailT"><?php if($member->email){ echo $member->email;}else{ echo 'N/A';}?></span>
							</div>
						</div>
						<div class="col-md-6">
						<input type="hidden" id="dob_t" value="<?php if($member->date_of_birth!=NULL){ echo $member->date_of_birth;}else{ echo 'N/A';}?>" >
						  <div class="amiprD">
								<span class="amiprDspn">Date of Birth:</span>	
				<span class="joinM" id="dob"><?php if($member->date_of_birth!=NULL){ echo date('d / m / Y',strtotime($member->date_of_birth));}else{ echo 'N/A';}?></span>
							</div>
						</div>	
						<div class="col-md-6">
							<div class="amiprD">
								<span class="amiprDspn">Aadhaar Number:</span>
									<i class="bx bx-id-card"></i> 
									<span class="joinM" id="aadhar"><?php if($member->aadhaar_nu){ echo $member->aadhaar_nu;}else{ echo 'N/A';}?></span>
							</div>
						</div>
						<div class="col-md-12">
							<div class="amiprD mitext"><i class="bx bx-home-circle"></i>
								<div class="amiprDspn">Address : </div>
							<div style="margin-left: 70px;margin-top: -20px;" id="addrr"><?php if($member->address){ echo $member->address;}else{ echo 'N/A';}?></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="amiprD"><i class="bx bx-certification"></i>
								<span class="amiprDspn">State :</span>
								<span class="joinM" id="state"><?php if($member->stN){ echo $member->stN;}else{ echo 'N/A';}?></span>
								<span class="joinM mi-select" id="stateE">
									<select class="empSelectR"  id="statN">
									<option value="">--- Select One ---</option>
										<?php if($getState){foreach($getState as $stt){?>
								<option value="<?php echo $stt->id;?>" <?php if($member->state==$stt->id){ echo 'selected="selected"';}?>><?php echo $stt->state_cities;?></option>
										<?php }}?>
									</select>
								</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="amiprD"><i class="bx bx-crosshair"></i>
								<span class="amiprDspn">District :</span>
								<span class="joinM" id="distrt"><?php if($member->ctyN){ echo $member->ctyN;}else{ echo 'N/A';}?></span>	
								<span class="joinM mi-select" id="districtE">
									<select id="district">
									<option value="">--- Select One ---</option>
						<?php if($getCity){foreach($getCity as $city){?>
						<option value="<?php echo $city->id;?>" <?php if($member->district==$city->id){ echo 'selected="selected"';}?>><?php echo $city->state_cities;?></option>
						<?php }}?>
									</select>
								</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="amiprD"><i class="bx bx-target-lock"></i>
								<span class="amiprDspn">Zipcode :</span>
								<span class="joinM" id="zipcode"><?php if($member->zipcode){ echo $member->zipcode;}else{ echo 'N/A';}?></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="amiprD"><i class="bx bx-target-lock"></i>
								<span class="amiprDspn">Pan Number :</span>
								<span class="joinM" id="pan"><?php if($member->pan_nu){ echo $member->pan_nu;}else{ echo 'N/A';}?></span>
							</div>
						</div>
						<div class="col-md-12" id="prInf">
							<button class="edtBtn btnIncR" onclick="proManage(2,'personalInfo')"><i class="mdi mdi-comment-edit-outline"></i> Edit</button>
						</div>
					</div>
			</div>
			<div class="ami_title crdBrdr">
				<i class="bx bxs-bank"></i> BANKING INFORMATION 
				<div class="amiBtnTgle amiBtnUp" id="bnkInfo"> <i class="fas fa-angle-down"></i> </div>
			</div>
		   <div class="crdDet" id="bnkInfoTr">
		   		<div class="row">
					<div class="col-md-6">
						<div class="amiprD"><i class="bx bxs-bank"></i>
						   <span class="amiprDspn">Bank Name :</span>
						   <span class="joinM mitext" id="bName"><?php if($member->bank_name){ echo $member->bank_name;}else{ echo 'N/A';}?></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="amiprD"><i class="bx bxs-bank"></i>
						   <span class="amiprDspn">A/C Number :</span>
						   <span class="joinM mitext" id="acNumber"><?php if($member->bank_ac_no){ echo $member->bank_ac_no;}else{ echo 'N/A';}?></span>
						</div>
					</div><div class="col-md-6">
						<div class="amiprD"><i class="bx bxs-bank"></i>
						   <span class="amiprDspn">IFSC Code :</span>
						   <span class="joinM mitext" id="ifsc"><?php if($member->bank_Ifsc){ echo $member->bank_Ifsc;}else{ echo 'N/A';}?></span>
						</div>
					</div><div class="col-md-6">
						<div class="amiprD"><i class="bx bxs-bank"></i>
						   <span class="amiprDspn">Branch Name :</span>
						   <span class="joinM mitext" id="brName"><?php if($member->bankBrName){ echo $member->bankBrName;}else{ echo 'N/A';}?></span>
						</div>
					</div>
					<div class="col-md-12" id="bnkInf">
							<button class="edtBtn btnIncR" onclick="proManage(2,'bankingInfor')"><i class="mdi mdi-comment-edit-outline"></i> Edit</button>
					</div>
		   		</div>
		   </div>

			<div class="ami_title crdBrdr">
				<i class="bx bxs-bank"></i> NOMMINEE INFORMATION 
				<div class="amiBtnTgle amiBtnUp" id="nomineeInfo"> <i class="fas fa-angle-down"></i> </div>
			</div>
			<div class="crdDet" id="nomineeInfoTr">
				<div class="row">
					<div class="col-md-6">
						<div class="amiprD"><i class="bx bxs-bank"></i>
						   <span class="amiprDspn">Name :</span>
						   <span class="joinM mitext" id="nomineeName"><?php if($member->nominee_name){ echo $member->nominee_name;}else{ echo 'N/A';}?></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="amiprD"><i class="bx bxs-bank"></i>
						   <span class="amiprDspn">Relationship :</span>
						   <span class="joinM mitext" id="nomineeRelation"><?php if($member->nominee_relationship){ echo $member->nominee_relationship;}else{ echo 'N/A';}?></span>
						</div>
					</div><div class="col-md-12">
						<div class="amiprD"><i class="bx bxs-bank"></i>
						   <span class="amiprDspn">Address :</span>
						   <span class="joinM mitext" id="nomineeAddr"><?php if($member->nominee_address){ echo $member->nominee_address;}else{ echo 'N/A';}?></span>
						</div>
					</div>
					<div class="col-md-12" id="nomineeInf">
							<button class="edtBtn btnIncR" onclick="proManage(2,'nomineeInfor')"><i class="mdi mdi-comment-edit-outline"></i> Edit</button>
					</div>
				</div>
			</div>
			<div class="ami_title crdBrdr">
				<i class="bx bx-image-alt"></i> DOCUMENTS INFORMATION 
				<div class="amiBtnTgle amiBtnUp" id="documentInfo"> <i class="fas fa-angle-down"></i> </div>
			</div>
			
			
			<div class="crdDet btm_border" id="memDocument">
				<div class="row">	
					<div class="col-md-4">
						<div class="docAmiImg"><img id="adrImg" src="<?php echo base_url().$member->adhar_img;?>" alt="doc image"></div>
						<div class="docText"> Aadhaar Card
							<span><i class="bx bx-trash delAction" data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="delAadhar-member/profile/edit"></i>
								  <i class="bx bx-image delAction" data-id="midoc-edtAadhar-member/profile/edit"></i>
							</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="docAmiImg"><img id="panImg" src="<?php echo base_url().$member->pan_img;?>" alt="doc image"></div>
						<div class="docText"> Pan Card
							<span><i class="bx bx-trash delAction" data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="delPan-member/profile/edit"></i>
								  <i class="bx bx-image delAction" data-id="midoc-pancard-member/profile/edit"></i>
							</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="docAmiImg"><img id="passBookImg" src="<?php echo base_url().$member->passbook_img;?>" alt="doc image"></div>
						<div class="docText"> Bankpass Book
							<span>
							    <i class="bx bx-trash delAction" data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="delBankpass-member/profile/edit"></i>	
								<i class="bx bx-image delAction" data-id="midoc-passbook-member/profile/edit"></i>
						</span>
						</div>
					</div>
				</div>		
			<div class="col-md-12" id="docfileUpload"> <span id="docUrlActn" style="display:none;"></span>
				<div for="images" class="drop-container updocImg" style="">
						<span class="drop-title">Drop files here</span>or
						<div style="width: 382px; margin:0 auto auto auto;">
							<div class="mi_group">
								<input type="file" class="mi_form" name="file" id="docfile">
								<button type="button" class="mibtn imgUploadActn" id="Update"><i class="bx bx-save"></i> Upload</button>
							</div>
							<div id="imgMsgS">&nbsp;</div>
						</div>
				</div>
			</div>
		</div>
    </div>
</div>

