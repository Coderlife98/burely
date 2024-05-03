<?php 
if($tnxDetails->status=='Paid')
{
	$bckclr='background-color:#ace8ac;color:#027302;border:1px solid #96ce96;font-weight: bold;';
	$tnxStatus='Paid';
	}
else if($tnxDetails->status=='Un-Paid')
{
	$bckclr='background-color:#eaea97;color:#48483d;border:1px solid #d0d068;font-weight: bold;';
	$tnxStatus='Unpaid';
	}
else if($tnxDetails->status=='Hold')
{
	$bckclr='background-color:#FFA6A6;color:#970101;border:1px solid #D28888;font-weight: bold;';
	$tnxStatus='Hold';
	}


?>









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
<div class="card">
	<div class="mitbl">
		<i class="bx bxs-group miU"></i> <?php echo $title ?>
		<span>
			   <i class="far fa-file-excel miUexl"></i><i class="far fa-file-pdf miUpdf"></i><i class="fas fa-print miUprint"></i>
			   <a href="<?php echo $backUrl;?>" class="miBack"><i class="bx bx-arrow-back"></i></a>
		</span>
		
	</div>
    <div class="card-body">	
	
	<?php //print_r($tnxDetails); ?>
	  
	  
	  
		 <div class="row">
		    <div class="col-xl-4">
				<div class="card">
					<div class="card-header" style="background-color:#002166;color:#fff;"><i class="bx bxs-user-rectangle"></i> Amount Transaction Details</div>
					<div class="card-body">	
						<div class="text-center"> 
								<img src="<?php echo base_url($memberDet->my_img);?>" alt="Profile Image" class="avatar-xl img-thumbnail rounded-circle mb-3 imgbdr"> 
								<div class="amiRole"><?php if($walletDet){echo 'Availble Balance :<span><i class="bx bx-rupee inrP"></i> '.$walletDet->balance.'</span>';} ?></div>
								<div class="amiRole"><?php if($memberDet->username){echo 'Member Code :<span>'.$memberDet->username.'</span>';}?></div>
								<div class="amiRole"><?php if($memberDet->name){echo $actionCd.' Name :<span>'.$memberDet->name.'</span>';}?></div>
								<div class="amiRole"><?php if($memberDet->mobile){echo 'Mobile Number :<span>'.$memberDet->mobile.'</span>';}?></div>
								<div class="amiRole"><?php if($memberDet->email){echo $actionCd.' Email :<span>'.$memberDet->email.'</span>';}?></div>	
							</div>
					</div>
				</div>	
			</div>
<?php if($senderD)
{
	$divSpan='4';$insideDive='12';$divHeight=' ';
	$emp='';
	if($senderD->department_type=='1'){$emp='Role As :<span>Super Admin</span>';}else if($senderD->department_type=='2'){$emp='Role As :<span>Employee</span>';}
	  
	  ?>
		
			<div class="col-xl-4">
				<div class="card">
				<div class="card-header" style="background-color:#00825D;color:#fff;"><i class="bx bxs-user-rectangle"></i> Payment Sender Details</div>
					<div class="card-body">	
						<div class="text-center"> 
							<img src="<?php echo base_url($senderD->photo);?>" alt="Profile Image" class="avatar-xl img-thumbnail rounded-circle mb-3 imgbdr"> 
							<div class="amiRole"><?php echo $emp; ?></div>
							<div class="amiRole"><?php if($senderD->user_code){echo 'Employee Code :<span>'.$senderD->user_code.'</span>';}?></div>
							<div class="amiRole"><?php if($senderD->name){echo 'Name :<span>'.$senderD->name.'</span>';}?></div>
							<div class="amiRole"><?php if($senderD->mobile){echo 'Mobile Number :<span>'.$senderD->mobile.'</span>';}?></div>
							<div class="amiRole"><?php if($senderD->email){echo 'Email :<span>'.$senderD->email.'</span>';}?></div>
						</div>
					</div>
				</div>	
			</div>
	<?php }else{$divSpan='8';$insideDive='6';$divHeight='style="height:220px"';}?>		
			
<div class="col-xl-<?php echo $divSpan;?> tnxtip" style=" <?php if($senderD){echo 'cursor:pointer;';} ?>">
	<div class="card">
		<div class="card-header ami_cmn" style="height:42px;"><i class="mdi mdi-stack-exchange"></i> Transaction Information
	</div>
            	 <div class="card-body p-4">
				    <?php if($senderD){if($tnxDetails->payment_image){?><span class="tnxTooltext"><img src="<?php echo base_url($tnxDetails->payment_image);?>" ></span> <?php }}?>  
				 <?php //print_r($tnxDetails);?>
				 
                    <div class="row">
                        <div class="col-lg-<?php echo $insideDive;?>">
						   <div class="form-floating mb-3">
                                <span class="form-control"><?php if($tnxDetails->wtnx_id){echo $tnxDetails->wtnx_id;}else{echo 'N/A';} ?></span>
                                <label for="tnxId"><i class="bx bx-transfer fntClr"></i> Transaction Id.</label>
							</div>
                        </div>
						<div class="col-lg-<?php echo $insideDive;?>">
						   <div class="form-floating mb-3">
                                <span class="form-control"><?php  if($tnxDetails->request_date){echo date('h:s:i a d-M-Y',strtotime($tnxDetails->request_date));}else{echo 'N/A';}?></span>
                                <label for="dob"><i class="mdi mdi-calendar-account fntClr"></i> Transaction Date.</label>
							</div>
                        </div>
						<div class="col-lg-<?php echo $insideDive;?>">
                            <div class="form-floating mb-3"><span class="form-control" style=" <?php echo $bckclr;?>"><?php echo $tnxStatus; ?></span>
                                <label for="tnx_typ"><i class="bx bx-transfer fntClr"></i>  Transaction Status</label>
                            </div>
                        </div>
						<div class="col-lg-<?php echo $insideDive;?>">
                            <div class="form-floating mb-3" >
						<span class="form-control" style=" <?php echo $bckgrnd; ?>"><?php echo $tnxDetails->amount;?></span>
                                <label for="amount"><i class="mdi mdi-currency-inr fntClr"></i>  Amount</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mirson" <?php echo $divHeight;?> >
								<label for="reason"><i class="mdi mdi-clipboard-text fntClr"></i> Reason.</label>
								<br />
								<span><?php if($tnxDetails->tid){echo $tnxDetails->tid;}else{echo 'N/A';} ?></span>
                            </div>  
                    </div>
					<!--<div class="col-lg-12">
						<div style="background-color:#999999;height: 133px;margin-top: 15px;">
								dfkjsdhfdksdkfsdhfksd
						</div>
					</div>-->
					
					
					
					
					
						
                </div>
			</div>    
	    </div>
      </div>
   </div>
</div>
