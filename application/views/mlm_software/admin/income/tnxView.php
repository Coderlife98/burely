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
<?php 
	//print_r($tnxDetails);
	
if($tnxDetails->credit_amt!='0.00')
{
	$bckgrnd='background-color:#e9fbe9';$amt=$tnxDetails->credit_amt;$tnxTyp='Credit';
	 if($tnxDetails->user_id!=NULL)
	 {
	  $flshMsg="<span class='creditM'><i class='bx bx-folder-plus'></i></span> This amount has been deducted from ".$memberDet->name."'s account and credited to our company .";	
		}
	 else
	 {
	 
$flshMsg="<span class='creditM'><i class='bx bx-folder-plus'></i></span> This amount has been taken from <strong>".$memberDet->name."</strong> due to member transaction and has been credited to the company.";
		}
	 $msgClr='color:green';
	 }
else if($tnxDetails->debit_amt!='0.00')
{
	
	 $bckgrnd='background-color:#ffe4e4';$amt=$tnxDetails->debit_amt;$tnxTyp='Debit';
	$flshMsg="<span  class='debitM'><i class='bx bx-folder-minus'></i></span> This amount has been deducted from the company and credited to ".$memberDet->name."'s account.";
	$msgClr='color:#c10e1a';
	}
else{$bckgrnd='background-color:#fff';$amt='0.00';$tnxTyp='N/A';}	



/*


if($tnxDetails->tnx_type!='6')
{
	
}else if($tnxDetails->tnx_type=='6')
{$flshMsg="<span class='debitM'><i class='bx bx-folder-minus'></i></span> This amount has been deducted and employee account and credited to our company .";$msgClr='color:#c10e1a';}*/
?>
<div class="row mb-4">
	<div class="col-xl-12">
		<div class="ami_inc" style=" <?php echo $msgClr;?>">
		<?php echo $flshMsg;?>
		</div>
	</div>
</div>

<div><?php 
/*print_r($tnxDetails);
echo '<br>';
print_r($memberDet);*/
//echo $this->db->last_query();
//print_r($memberDet);
if($tnxDetails->tnx_type=='3')
{
	$memberImg=base_url($memberDet->photo);
	$actionCd='Employee';
	$wallet='Total Given';
	$balance=$avBalance['balance'];
	}
	else if($tnxDetails->tnx_type=='2' || $tnxDetails->tnx_type=='5')
{
	$memberImg=base_url($memberDet->my_img);
	$actionCd='Frenchise';
	$wallet='Frenchise Wallet';
	$balance=$memberDet->balance;
	}
else if($tnxDetails->tnx_type=='1')
{
	$memberImg=base_url($memberDet->my_img);
	$actionCd='Member';
	$wallet='Member Wallet';
	$balance=$memberDet->balance;
	}


?></div>




<div class="row mb-4">  
  <?php if($tnxDetails->tnx_type!='6'){?>
	<div class="col-xl-4">
		<div class="card">
			<div class="card-header" style="background-color:#002166;color:#fff;"><i class="bx bxs-user-rectangle"></i> Amount Transaction Details</div>
			<div class="card-body">	
				<div class="text-center"> 
						<img src="<?php echo $memberImg;?>" alt="Profile Image" class="avatar-xl img-thumbnail rounded-circle mb-3 imgbdr"> 
						<div class="amiRole"><?php echo $wallet.' :<span><i class="bx bx-rupee inrP"></i> '.$balance.'</span>'; ?></div>
						<div class="amiRole"><?php if($memberDet->username){echo $actionCd.' Code :<span>'.$memberDet->username.'</span>';}?></div>
						<div class="amiRole"><?php if($memberDet->name){echo $actionCd.' Name :<span>'.$memberDet->name.'</span>';}?></div>
						<div class="amiRole"><?php if($memberDet->mobile){echo 'Mobile Number :<span>'.$memberDet->mobile.'</span>';}?></div>
						<div class="amiRole"><?php if($memberDet->email){echo $actionCd.' Email :<span>'.$memberDet->email.'</span>';}?></div>	
					</div>
			</div>
		</div>	
	</div>
<?php }
if($tnxDetails->generated_by=='1'){?>
<div class="col-xl-4">
	<div class="card">
	<?php 
	if($senderD)
	{
	$emp='';
	if($senderD['department_type']=='1'){$emp='Role As :<span>Super Admin</span>';}else if($senderD['department_type']=='2'){$emp='Role As :<span>Employee</span>';}
		
	?>	
	<div class="card-header" style="background-color:#00825D;color:#fff;"><i class="bx bxs-user-rectangle"></i> Payment Sender Details</div>
		<div class="card-body">	
			<div class="text-center"> 
				<img src="<?php echo base_url($senderD['photo']);?>" alt="Profile Image" class="avatar-xl img-thumbnail rounded-circle mb-3 imgbdr"> 
				<div class="amiRole"><?php echo $emp; ?></div>
				<div class="amiRole"><?php if($senderD['user_code']){echo 'Employee Code :<span>'.$senderD['user_code'].'</span>';}?></div>
				<div class="amiRole"><?php if($senderD['name']){echo 'Employee Name :<span>'.$senderD['name'].'</span>';}?></div>
				<div class="amiRole"><?php if($senderD['mobile']){echo 'Mobile Number :<span>'.$senderD['mobile'].'</span>';}?></div>
				<div class="amiRole"><?php if($senderD['email']){echo 'Employee Email :<span>'.$senderD['email'].'</span>';}?></div>
			</div>
		</div>
	<?php }?>	
    </div>	
</div>	  
<?php $design='4';$miDiv='12';}else{$design='8';$miDiv='6';}?>
<div class="col-xl-<?php echo $design;?>">
	<div class="card"><div class="card-header ami_cmn" style="height:42px;"><i class="mdi mdi-stack-exchange"></i> Transaction Information
	
	<a href="<?php echo base_url('mlm_software/admin/ledger/manage');?>" class="ititle pull-right miMr" style="margin-top:-3px;"><i class="bx bx-arrow-back"></i></a>
	</div>
            	 <div class="card-body p-4">
				 
				 <?php //print_r($tnxDetails);?>
				 
                    <div class="row">
                        <div class="col-lg-<?php echo $miDiv;?>">
						   <div class="form-floating mb-3">
                                <span class="form-control"><?php if($tnxDetails->tnx_id){echo $tnxDetails->tnx_id;}else{echo 'N/A';} ?></span>
                                <label for="tnxId"><i class="bx bx-transfer fntClr"></i> Transaction Id.</label>
							</div>
                        </div>
						<div class="col-lg-<?php echo $miDiv;?>">
						   <div class="form-floating mb-3">
                                <span class="form-control"><?php  if($tnxDetails->created_date){echo date('h:s:i a d-M-Y',strtotime($tnxDetails->created_date));}else{echo 'N/A';}?></span>
                                <label for="dob"><i class="mdi mdi-calendar-account fntClr"></i> Transaction Date.</label>
							</div>
                        </div>
						<div class="col-lg-<?php echo $miDiv;?>">
                            <div class="form-floating mb-3"><span class="form-control"><?php echo $tnxTyp; ?></span>
                                <label for="tnx_typ"><i class="bx bx-transfer fntClr"></i>  Transaction Type</label>
                            </div>
                        </div>
                        <div class="col-lg-<?php echo $miDiv;?>">
                            <div class="form-floating mb-3" >
						<span class="form-control" style=" <?php echo $bckgrnd; ?>"><?php echo $amt;?></span>
                                <label for="amount"><i class="mdi mdi-currency-inr fntClr"></i>  Amount</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mirson">
							<label for="reason"><i class="mdi mdi-clipboard-text fntClr"></i> Reason.</label>
							<br />
							<span><?php if($tnxDetails->reason){echo $tnxDetails->reason;}else{echo 'N/A';} ?></span>
                           </div>
                            
                        </div>
						
                   </div>
			 </div>    
	    </div>
    </div>	
<div class="col-xl-12">	
<a href="<?php echo base_url('mlm_software/admin/ledger/manage');?>" class="btn btn-outline-dark  waves-effect waves-light pull-right"><i class="bx bx-arrow-back"></i> Back</a>	
	
</div>		
</div>

<!--<script src="<?php echo base_url() ?>media/js/super_admin/mlm_software/ledger.js"></script>-->
