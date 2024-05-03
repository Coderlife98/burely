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
		<?php  //echo $this->db->last_query();
		//print_r(strtotime($getPro->date_of_birth));
		 
		?>	
		<div class="card">
			<div class="mitbl">
				<i class="bx bxs-group miU"></i>View Member 
				<span><a href="<?php echo base_url('mlm_software/admin/member/lists');?>" class="miBack"><i class="bx bx-arrow-back"></i></a></span>
			</div>
			<div class="card-body">
			<!--------------------------------------------------------------------------------->	
				<div id="formLayout">
					<table >
					  <tr>
						<td width="25%"><img id="compy" src="<?php echo base_url('media/images/prime.jpg');?>" alt="doc image"></td>
						<td width="50%">
							<div style=" text-align:center;font-weight: bold;color: #0b3750;">
							<span style="text-transform:uppercase; font-size: 1.3rem;"><?php echo $this->session->userdata('company_name');?></span><br />
							 <?php echo $this->session->userdata('company_address');?><br />
						  website: <?php echo $this->session->userdata('company_url');?>
						  </div></td>
						<td width="25%" rowspan="2"><div class="pass"><div class="miBdrCnr"><img src="<?php echo base_url($getPro->my_img);?>" alt="doc image"></div></div></td>
					  </tr>
					  <tr><td colspan="2" height="50"><span class="shopeInf">Member information details and agreement</span></td></tr>
					  <tr>
							<td  colspan="3">
								<div class="sprInfo">
									<table width="100%" >
										  <tr><td colspan="2" style="text-align:left"><div class="spInfo">SPONSOR INFORMATION</div></td></tr>
										  <tr>
												<td width="13%"><span class="mnBldTxt">Member Id</span></td>
												<td width="87%"><span id="memId" class="container"></span></td>
										  </tr>
										  <tr>
												<td><span class="mnBldTxt">Sponsor Name</span></td>
												<td>
													<span id="sponsorName" class="container"></span>
													<span style="float: left;padding:2px 15px 0px 10px;font-weight: bold;" >Sponsor Id</span>
													<span id="sponsorId" class="container"></span>
												</td>
										  </tr>
									</table>
								</div>
							</td>
						</tr>
					  <tr>
						<td colspan="3">
							<div class="infoContainer">
								<table width="100%">
								  <tr><td colspan="2" style="text-align:left"><div class="spInfo">MEMBER INFORMATION</div></td></tr>
								  <tr>
										<td width="17%"><span class="mnBldTxt">Name of Distributor</span></td>
										<td width="83%"><span id="distributor" class="container"></span></td>
								  </tr>
								  <tr>
										<td><span class="mnBldTxt">Date of Birth</span></td>
										<td>
												<span id="dateOfBirth" class="container"></span>
												<span style="float: left;padding:2px 12px 0px 6px;font-weight: bold;">Gender </span><span id="gender" class="container"></span>
												
										</td>
								  </tr>
								  
									<tr>
										<td><span class="mnBldTxt">Aadhaar Number </span></td>
										<td><span id="aadharNu" class="container"></span></td>
								  </tr>							  
								  
								  
								  
								  <tr>
										<td><span class="mnBldTxt">Nominee Mr./Mrs.</span></td>
										<td>
												<span id="nomiName" class="container"></span>
												
										</td>
								  </tr>
								  
								  
									<tr>
										<td><span class="mnBldTxt">Relationship</span></td>
										<td><span id="nomiRel" class="container"></span></td>
								 	</tr>						  
															  
								  <tr>
									 <td><span class="mnBldTxt">Nominee Address</span></td>
									 <td><span id="nomiAddr" class="container"></span></td>
								  </tr>
								  
								  
							</table>
							</div>
						
						</td>
					  </tr>
					  <tr>
						<td colspan="3">
							<div class="infoContainer">
								<table width="100%">
								  <tr><td colspan="2" style="text-align:left"><div class="spInfo">COMMUNICATION INFORMATION</div></td></tr>
								  <tr>
										<td width="15%"><span class="mnBldTxt">Mailing Address</span></td>
										<td width="85%"><span id="address" class="container"></span></td>
								  </tr>
								  <tr>
										<td><span class="mnBldTxt">District</span></td>
										<td>
												<span id="district" class="container"></span>
												<span style="float: left;padding:2px 15px 0px 10px;font-weight: bold;">Pincode </span><span id="pincode" class="container"></span>
												
										</td>
								  </tr>
								 
								 
							<tr>
										<td><span class="mnBldTxt">State</span></td>
										<td><span id="state" class="container"></span></td>
								  </tr>	 
								 
								 
								 
								  <tr>
										<td><span class="mnBldTxt">Mobile Number.</span></td>
										<td><span id="mobile" class="container"></span></td>
								  </tr>
								  
								  <tr>
										<td><span class="mnBldTxt">Email Id.</span></td>
										<td><span id="emailId" class="container"></span></td>
								  </tr>		  
								  
								  
								  
								  
							</table>
							</div>
						
						</td>
					   
					  </tr>  
					  <tr>
						<td colspan="3">
							<div class="infoContainer">
								<table width="100%">
								  <tr><td colspan="2" style="text-align:left"><div class="spInfo">BANKING INFORMATION</div></td></tr>
								  <tr>
										<td width="15%"><span class="mnBldTxt">Bank Name </span></td>
										<td width="85%"><span id="bName" class="container"></span></td>
								  </tr>
								  <tr>
										<td><span class="mnBldTxt">Account Number</span></td>
										<td>
												<span id="accNumber" class="container"></span>
												
										</td>
								  </tr>
								  <tr>
										<td><span class="mnBldTxt">IFSC Code.</span></td>
										<td><span id="ifscCode" class="container"></span></td>
								  </tr>
								  
								  <tr>
										<td><span class="mnBldTxt">Branch Name.</span></td>
										<td><span id="bnkBrName" class="container"></span></td>
								  </tr>				  
								  
								  
								  
								  
							</table>
							</div>
						
						</td>
					   
					  </tr>
					  <tr>
						<td colspan="3">
							<div class="infoContainer">
								<table width="100%">
								  <tr><td colspan="2" style="text-align:left"><div class="spInfo">PAN INFORMATION</div></td></tr>
								  <tr>
										<td width="19%"><span class="mnBldTxt">Do You Have Pan Card ? </span></td>
										<td width="81%">
										
														<span style="float:left;padding: 2px 0px 0px 0px;font-weight: bold;">
															YES <span class="ysNo <?php if($getPro->pan_nu){ echo 'tick-mark';}?>">&nbsp;</span>
															 NO <span class="ysNo <?php if($getPro->pan_nu==""){ echo 'tick-mark';}?>">&nbsp;</span>
														 </span>
														<span class="pnNu">Pan Card Number. </span><span id="panNU" class="container"></span>
										</td>
								  </tr>
							   </table>
							</div>
						</td>
					  </tr>  
					  <tr>
						<td colspan="3">
							<div class="infoContainer" style="padding-top:15px">
								<table width="100%">
								  <tr>
										<td  height="32"><span class="mnBldTxt">Date :  </span></td>
										 <td width="77%" rowspan="2">
												<span class="signTxt">Member. Sign <span class="signBx"></span></span>
												<span class="signTxt">Company. Sign/Seal <span class="signBx"></span></span>										</td>
								  </tr>
								  <tr><td width="23%" height="32"><span class="mnBldTxt">Place :</span></td>
								  </tr>
							</table>
							</div>
						
						</td>
					  </tr>
					  <tr>
						<td colspan="3">
					<span style="font-weight:bold; ">Note: Please Attach Photocopy of Your PAN Card, Aadhar Card & Bank Passbook / Cancel Cheque with this application form.</span>
						</td>
					  </tr>
					</table>
				</div>	
			<!--------------------------------------------------------------------------------->	
							
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	getBxWithTxt('<?php echo $getPro->username;?>',10,'memId');
	getBxWithTxt('<?php if($getPro->sponsorName){echo $getPro->sponsorName;}else{ echo 'N/A';}?>',20,'sponsorName');
	getBxWithTxt('<?php if($getPro->sponsor){echo $getPro->sponsor;}else{ echo 'N/A';}?>',9,'sponsorId');
	getBxWithTxt('<?php if($getPro->date_of_birth){echo date('d/m/Y',strtotime($getPro->date_of_birth));}?>',10,'dateOfBirth');
	getBxWithTxt('<?php echo $getPro->gender;?>',6,'gender');
	getBxWithTxt('<?php echo $getPro->name;?>',33,'distributor');getBxWithTxt('<?php echo $getPro->nominee_name;?>',33,'nomiName');
	getBxWithTxt('<?php echo $getPro->nominee_relationship;?>',33,'nomiRel');getBxWithTxt('<?php echo $getPro->address;?>',34,'address');
	getBxWithTxt('<?php echo $getPro->ctyN;?>',16,'district');getBxWithTxt('<?php echo $getPro->zipcode;?>',6,'pincode');
	getBxWithTxt('<?php echo $getPro->stN;?>',34,'state');getBxWithTxt('<?php echo $getPro->mobile;?>',10,'mobile');
	getBxWithTxt('<?php echo $getPro->email;?>',34,'emailId');getBxWithTxt('<?php echo $getPro->bank_name;?>',34,'bName');
	getBxWithTxt('<?php echo $getPro->bank_ac_no;?>',34,'accNumber');getBxWithTxt('<?php echo $getPro->pan_nu;?>',10,'panNU');
	getBxWithTxt('<?php echo $getPro->aadhaar_nu;?>',12,'aadharNu');getBxWithTxt('<?php echo $getPro->bank_Ifsc;?>',34,'ifscCode');
	getBxWithTxt('<?php echo $getPro->bankBrName;?>',34,'bnkBrName');getBxWithTxt('<?php echo $getPro->nominee_address;?>',33,'nomiAddr');
});
function getBxWithTxt(memName,strLength,txtContainer)
{
		let valid='';
		for (let i = 0; i < strLength ; i++) {valid +="<div>"+memName.substr(i, 1)+"</div>";}
		$('#'+txtContainer).html(valid);
	}
</script>
<style>
#formLayout{ height:100%; }
table{ width:100%;}
table tr td{ text-align:center;}
table tr td div{ margin:auto;}
#compy{ width:180px; height:120px;}

.shopeInf{text-transform:uppercase; font-weight:900;border-bottom: 1px dashed #004b5b; color:#004b5b;font-size: 20px;float: right;}
.container div{padding: 2px 5px 2px 5px;border: 1px solid #979595;margin: 0px 4px 0px -5px;width: 25px;text-transform: uppercase;float: left;height:27px;text-align: center;font-weight: bold;}
.spInfo{padding:5px 15px 5px 15px;background-color: #004b5b;float: left;font-weight: bold;color: #fff;z-index: 1;position: relative;margin: -2px 0px 5px -2px;}
.infoContainer{padding:0px 0px 15px 0px;border: 2px solid #004b5b;margin: 15px 0px 0px 0px;}
.signBx{padding: 20px 180px 20px 20px;border: 1px solid #000;margin-left: 20px;}
.signTxt{float:left; font-weight:bold;margin-left: 20px;}
.ysNo{padding:2px 12px 2px 12px;border: 1px solid #979595;}
.pnNu{float: left;padding:2px 22px 0px 22px;font-weight: bold;}
.sprInfo{padding:0px 0px 15px 0px;border: 2px solid #004b5b;}
.mnBldTxt{float:left;padding-left: 12px;font-weight: bold;}
.tick-mark {position: relative;display: inline-block;width: 30px;height: 25px;}
.tick-mark::before {position: absolute;left: 0;top: 50%;height: 50%; width: 3px;background-color: #336699;content: "";transform: translateX(10px) rotate(-45deg);transform-origin: left bottom;}
.tick-mark::after {position: absolute;left: 0; bottom: 0;  height: 3px; width: 100%;background-color: #336699; content: "";transform: translateX(10px) rotate(-45deg);
    transform-origin: left bottom;
}


/*.pass{border: 1px solid #b3b0b0;height: 180px;width: 160px;text-align:center;}*/
.pass img{ height:100%; width:100%;}
.miBdrCnr {border: 2px solid #09344d;display: inline-block;/*margin: 25px auto;*/padding:25px 10px 25px 10px;position: relative;width: auto;}
.miBdrCnr img {display: block;height: auto;margin: 0;padding: 0;position: relative;width: 100%;z-index: 5;}
.miBdrCnr::before,.miBdrCnr::after {content: '';position: absolute;background: #fff;}
.miBdrCnr::before {width: calc(100% + 90px + 4px - 120px);height: calc(100% + 4px);top: -2px;left: 50%;transform: translateX(-50%);z-index: 1;}
.miBdrCnr::after {height: calc(100% + 90px + 4px - 120px);width: calc(100% + 4px);left: -2px;top: 50%;transform: translateY(-50%);z-index: 1;}












</style>