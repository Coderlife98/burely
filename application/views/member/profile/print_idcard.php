<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $details->name;?></title>
<link href="<?php echo base_url('media/css/bootstrap.min.css');?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('media/libs/jquery/jquery.min.js');?>"></script>
<script src="<?php echo base_url('media/js/html2canvas.js');?>"></script>
<script src="<?php echo base_url('media/js/jspdf.debug.js');?>"></script>
<script>
function print_pdf()
{
let pdf = new jsPDF();
let section=$('body');
let page= function() {
    pdf.save('<?php echo str_replace(' ', '_', strtolower($details->name));?>.pdf');
   
};
pdf.addHTML(section,page);
}
/*onload="print_pdf()"*/
</script>
<style>
	.bgIdCrd{width:440px; height:680px; z-index:10; position:relative;padding: 2px;border:2px dashed #c16565;}
	.datDiv{margin-top: -20rem;margin-bottom: 108px;font-size: 15px;font-weight: 700;margin-left:160px;z-index:11; position:relative;}
	.rnk{text-align: center;font-size: 0.9rem;text-transform: uppercase;margin-bottom: 10px;margin-top: -7px;margin-left: -100px;}
	.sPoint{padding-left:3px; padding-right:3px;font-weight: bold;}
	.memN{color:#004a5b;font-size:2rem;text-transform: uppercase;}
	.prImg{width: 220px;height: 250px;margin-top: -255px; margin-left: -330px;}
</style>
</head>
<body onload="print_pdf()">
<?php 


?>
<div class="row mi_padd"  style="margin: 200px auto auto 0px;">
				<div class="col-md-6">
					<div style="text-align: center">
					
					<img src="<?php echo base_url('uploads/member/memId.png');?>" class="bgIdCrd" />
					<img src="<?php echo base_url($details->my_img);?>" class="prImg" />
					<div class="datDiv">
						<table  align="center" style="text-align:left;">
							<tr><td colspan="2"><div class="memN"> <?php echo $details->name;?></div></td></tr>
							<tr><td colspan="2"><div class="rnk">Star Club</div></td></tr>
							<tr><td width="95">ID</td>
							<td width="194"><span class="sPoint">:</span> <?php echo $details->username;?></td>
							</tr>
							<tr><td>DOB</td><td><span class="sPoint">:</span> <?php if($details->date_of_birth){echo $details->date_of_birth;}else{echo 'DD-MM-YYYY';}?></td></tr>
							<tr><td>Mobile</td><td><span class="sPoint">:</span> +91 <?php echo $details->mobile;?></td></tr>
							<tr><td>Email</td><td><span class="sPoint">:</span> <?php echo $details->email;?></td></tr>
					  </table>
								
					</div>
				  </div>  				
					</div>
				<div class="col-md-6">
				  <div style="text-align:left">
					
					<img src="<?php echo base_url('uploads/member/memIDBack.png');?>" class="bgIdCrd" />
					
					<div class="" style="width: 360px; margin-left: 2.5rem;margin-top: -29.3rem; z-index: 11;position: relative; text-align: left;">
						<div style="text-align:center;font-size:2rem;color: #666464;font-weight: 600;">Terms & Conditions</div>
						<div style="font-size:.8rem;color: #3e3e3e;font-weight: 600;line-height: 100%;margin: 15px 25px 0px 48px;">Please carry card when you are going to repurchase.Please carry card when you are going to repurchase.</div>	
						
						<div style="font-size:0.8rem;color: #3e3e3e;font-weight: 600;line-height: 100%;margin: 8px 25px 0px 48px;">Please carry card when you are going to repurchase.Please carry card when you are going to repurchase.</div>	
						
						<div style="font-size:0.8rem;color: #3e3e3e;font-weight: 600;line-height: 100%;margin: 11px 25px 0px 48px;">Please carry card when you are going to repurchase.Please carry card when you are going to repurchase.</div>
						<div style="font-size:0.8rem;color: #3e3e3e;font-weight: 600;margin: 40px 0px 0px 93px;">
						
						<table style="width:180px;font-size: 14px;">
						  <tr>
							<td>Joined Date</td>
							<td><span class="sPoint">:</span> <?php if($details->create_date){ echo date('d/m/Y',strtotime($details->create_date));}else{ echo 'DD/MM/YYYY';}?></td>
						  </tr>
						 </table>

						</div>		
							
					</div>
				  </div>			
				</div>
				
				
				
			</div>






</body>
</html>