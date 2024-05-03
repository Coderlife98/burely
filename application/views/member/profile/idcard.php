
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
<style>
	.bgIdCrd{width:225px; height:350px; z-index:10; position:relative;padding: 2px;border: 1px dashed #bbb;}
	.datDiv{margin-top: -166px;margin-bottom: 108px;font-size: 9px;font-weight: 700;margin-left: 70px;z-index:11; position:relative;}
	.rnk{text-align: center;font-size: 0.6rem;text-transform: uppercase;margin-bottom: 10px;margin-top: -7px;margin-left: -20px;}
	.sPoint{padding-left:3px; padding-right:3px;font-weight: bold;}
	.memN{color:#004a5b;font-size:1.15rem;text-transform: uppercase;}
	.prImg{width:110px; height:110px;margin-top: -150px; margin-left: -170px;}
	.trmc{width:220px;margin-left: 8.7rem;margin-top:-15rem;z-index:11;position:relative; text-align:left;}
	.fln{font-size:0.4rem;color: #3e3e3e;font-weight: 600;line-height: 100%;margin: 15px 25px 0px 44px;}
	.scnd{font-size:0.4rem;color: #3e3e3e;font-weight: 600;line-height: 100%;margin: 5px 25px 0px 44px;}
	.thrdln{font-size:0.4rem;color: #3e3e3e;font-weight: 600;line-height: 100%;margin: 5px 25px 0px 44px;}
@media (max-width: 768px) 
{	
	.bgIdCrd
	{
		margin-left:-60px;}
		.mia{ margin-left:0px !important;}
		.trmc{ margin-left:10px;}
		.datDiv{ margin-left:0px;}
		.dvUp{ margin-top:-40px;margin-bottom: 120px;}
		.fln{font-size:7px;margin: 10px 25px 0px 60px;}
		.scnd{font-size:7px;margin: 5px 25px 0px 60px;}
		.thrdln{font-size:7px;margin: 5px 25px 0px 60px;color: #1a1717;}
	}
</style>	
<div class="row mb-4">
	<div class="col-xl-12">
		<div class="ami_title"><i class="bx bx-id-card"></i>  ID CARD of <?php if($details->name!='MSDR Global Marketting Pvt. Ltd.'){echo $details->name; } else { echo 'Shivesh Patel';}?></div>
			<div class="crdDet btm_border">
			
			<?php //print_r($details->create_date);?>
			<div class="row mi_padd">
				<div class="col-md-6">
					<div style="text-align: center">
					
					<img src="<?php echo base_url('uploads/member/memId.png');?>" class="bgIdCrd" />
					<img src="<?php echo base_url($details->my_img);?>" class="prImg" />
					<div class="datDiv">
						<table style="text-align:left;" align="center">
							<tr><td colspan="2"><div class="memN"> <?php if($details->name!='MSDR Global Marketting Pvt. Ltd.'){echo $details->name; } else { echo 'Shivesh Patel';}?></div></td></tr>
							<tr><td colspan="2"><div class="rnk">Normal Member</div></td></tr>
							<tr><td>ID</td><td><span class="sPoint">:</span> <?php echo $details->username;?></td></tr>
							<tr><td>DOB</td><td><span class="sPoint">:</span> <?php if($details->date_of_birth){echo $details->date_of_birth;}else{echo 'DD-MM-YYYY';}?></td></tr>
							<tr><td>Mobile</td><td><span class="sPoint">:</span> +91 <?php echo $details->mobile;?></td></tr>
							<tr><td>Email</td><td><span class="sPoint">:</span> <?php echo $details->email;?></td></tr>
						</table>
								
					</div>
				  </div>  				
					</div>
				<div class="col-md-6">
				  <div style="text-align:center" class="dvUp">
					
					<img src="<?php echo base_url('uploads/member/memIDBack.png');?>" class="bgIdCrd mia" />
					
					<div class="trmc">
						<div style="text-align:center;font-size:0.65rem;color: #666464;font-weight: 600;">Terms & Conditions</div>
						<div class="fln">Please carry card when you are going to repurchase.Please carry card when you are going to repurchase.</div>	
						
						<div class="scnd">Please carry card when you are going to repurchase.Please carry card when you are going to repurchase.</div>	
						
						<div class="thrdln">Please carry card when you are going to repurchase.Please carry card when you are going to repurchase.</div>
						<div style="font-size:0.4rem;color: #3e3e3e;font-weight: 600;margin: 21px 0px 0px 45px;">
						
						<table style="width:120px;font-size: 8px;">
						  <tr>
							<td>Joined Date</td>
							<td><span class="sPoint">:</span> <?php if($details->create_date){ echo date('d/m/Y',strtotime($details->create_date));}else{ echo 'DD/MM/YYYY';}?></td>
						  </tr>
						 </table>

						</div>		
							
					</div>
				  </div>			
				</div>
				
				<div class="col-md-12" align="center">
					<a href="<?php echo base_url('member/dashboard/print_pdf');?>" target="_blank" class="btn btn-outline-dark waves-effect waves-light"><i class="bx bx-printer"></i> Print</a>
				</div>
				
			</div>
			
		</div>
	</div>	
</div>