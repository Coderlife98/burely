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
		<?php //print_r($getShopee); ?>	
		<div class="card">
			<div class="mitbl">
				<i class="bx bxs-group miU"></i>View Shopee <span><a href="<?php echo base_url('partner/shopee');?>" class="miBack"><i class="bx bx-arrow-back"></i></a></span>
			</div>
			<div class="card-body">
			<!--------------------------------------------------------------------------------->	
				<div id="formLayout">
					<table >
					  <tr>
						<td width="25%"><img id="compy" src="<?php echo base_url('media/images/prime.jpg');?>" alt="doc image"></td>
						<td width="50%">
							<div style=" text-align:left;font-weight: bold;color: #0b3750;">
							<span style="text-transform:uppercase; font-size: 1.3rem;"><?php echo $this->session->userdata('company_name');?></span><br />
							 <?php echo $this->session->userdata('company_address');?><br />
						  website: <?php echo $this->session->userdata('company_url');?>
						  </div></td>
						<td width="25%" rowspan="2"><div class="pass"><img src="<?php echo base_url($getShopee->my_img);?>" alt="doc image"></div></td>
					  </tr>
					  <tr><td colspan="2" height="50"><span class="shopeInf">Shopee information details and agreement</span></td></tr>
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
								  <tr><td colspan="2" style="text-align:left"><div class="spInfo">DISTRIBUTOR INFORMATION</div></td></tr>
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
															YES <span class="ysNo <?php if($getShopee->pan_nu){ echo 'tick-mark';}?>">&nbsp;</span>
															 NO <span class="ysNo <?php if($getShopee->pan_nu==""){ echo 'tick-mark';}?>">&nbsp;</span>
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
												<span class="signTxt">Dist. Signature <span class="signBx"></span></span>
												<span class="signTxt">Company. Signature <span class="signBx"></span></span>										</td>
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

  	let myStr=' ';
	let spId='';
	getBxWithTxt('<?php echo $getShopee->username;?>',10,'memId');
	getBxWithTxt(myStr,20,'sponsorName');
	getBxWithTxt(spId,9,'sponsorId');
	getBxWithTxt('<?php if($getShopee->date_of_birth){echo date('d/m/Y',strtotime($getShopee->date_of_birth));}?>',10,'dateOfBirth');
	getBxWithTxt('<?php echo $getShopee->gender;?>',6,'gender');
	getBxWithTxt('<?php echo $getShopee->name;?>',33,'distributor');getBxWithTxt('<?php echo $getShopee->nominee_name;?>',33,'nomiName');
	getBxWithTxt('<?php echo $getShopee->nominee_relationship;?>',33,'nomiRel');getBxWithTxt('<?php echo $getShopee->address;?>',34,'address');
	getBxWithTxt('<?php echo $getShopee->ctyN;?>',16,'district');getBxWithTxt('<?php echo $getShopee->zipcode;?>',6,'pincode');
	getBxWithTxt('<?php echo $getShopee->stN;?>',34,'state');getBxWithTxt('<?php echo $getShopee->mobile;?>',10,'mobile');
	getBxWithTxt('<?php echo $getShopee->email;?>',34,'emailId');getBxWithTxt('<?php echo $getShopee->bank_name;?>',34,'bName');
	getBxWithTxt('<?php echo $getShopee->bank_ac_no;?>',34,'accNumber');getBxWithTxt('<?php echo $getShopee->pan_nu;?>',10,'panNU');
	getBxWithTxt('<?php echo $getShopee->aadhaar_nu;?>',12,'aadharNu');getBxWithTxt('<?php echo $getShopee->bank_Ifsc;?>',34,'ifscCode');
	getBxWithTxt('<?php echo $getShopee->bankBrName;?>',34,'bnkBrName');getBxWithTxt('<?php echo $getShopee->nominee_address;?>',33,'nomiAddr');
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
.pass{border: 1px solid #b3b0b0;height: 180px;width: 160px;}
.pass img{ height:100%; width:100%;}
.shopeInf{text-transform:uppercase; font-weight:900;border-bottom: 2px solid #121e2d; color:#121e2d;font-size: 20px;}
.container div{padding: 2px 5px 2px 5px;border: 1px solid #979595;margin: 0px 4px 0px -5px;width: 25px;text-transform: uppercase;float: left;height:27px;text-align: center;font-weight: bold;}
.spInfo{padding:5px 15px 5px 15px;background-color: #121e2d;float: left;font-weight: bold;color: #fff;z-index: 1;position: relative;margin: -2px 0px 5px -2px;}
.infoContainer{padding:0px 0px 15px 0px;border: 2px solid #121e2d;margin: 15px 0px 0px 0px;}
.signBx{padding: 20px 180px 20px 20px;border: 1px solid #000;margin-left: 20px;}
.signTxt{float:left; font-weight:bold;margin-left: 20px;}
.ysNo{padding:2px 12px 2px 12px;border: 1px solid #979595;}
.pnNu{float: left;padding:2px 22px 0px 22px;font-weight: bold;}
.sprInfo{padding:0px 0px 15px 0px;border: 2px solid #121e2d;}
.mnBldTxt{float:left;padding-left: 12px;font-weight: bold;}
.tick-mark {position: relative;display: inline-block;width: 30px;height: 25px;}
.tick-mark::before {position: absolute;left: 0;top: 50%;height: 50%; width: 3px;background-color: #336699;content: "";transform: translateX(10px) rotate(-45deg);transform-origin: left bottom;}
.tick-mark::after {position: absolute;left: 0; bottom: 0;  height: 3px; width: 100%;background-color: #336699; content: "";transform: translateX(10px) rotate(-45deg);
    transform-origin: left bottom;
}




















</style>