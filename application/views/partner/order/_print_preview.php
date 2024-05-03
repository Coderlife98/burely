<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $member->name;?></title>
<script src="<?php echo base_url('media/libs/jquery/jquery.min.js');?>"></script>
<script src="<?php echo base_url('media/js/html2canvas.js');?>"></script>
<script src="<?php echo base_url('media/js/jspdf.debug.js');?>"></script>
<script>
function print_pdf()
{
let pdf = new jsPDF();
let section=$('body');
let page= function() {
    pdf.save('<?php echo str_replace(' ', '_', strtolower($member->name));?>.pdf');
   
};
pdf.addHTML(section,page);
}
/*

 onload="print_pdf()" 
*/
</script>
<style>
#mi_ordTble {font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 90%;}
#mi_ordTble td, #mi_ordTble th {/* border: 1px solid #ddd;*/padding: 8px;}
/*#mi_ordTble tr:nth-child(even){background-color: #f2f2f2;}#mi_ordTble tr:hover {background-color: #ddd;}*/
#mi_ordTble th {padding-top: 12px;padding-bottom: 12px;text-align: left; background-color: #058ba8; border:1px solid #058ba8; color: white;}
</style>
</head>
<body >
<?php 
if ($ordHistory['order_status']=='0'){$stsTex='<spna style="color:#db3e1c">Cancelled</span>';} 
else if ($ordHistory['order_status']=='1'){$stsTex='<spna style="color:#aca100">Placed</span>';}
else if ($ordHistory['order_status']=='2'){$stsTex ='<spna style="color:#b1ece0">Shipped</span>';}
else if ($ordHistory['order_status']=='3'){$stsTex='<spna style="color:#00997b">Delevered</span>';}
else {$stsTex='Not Yet';}
//echo $this->db->last_query();die;
//print_r($ordHistory);

?>
<table align="center" style="width:90%;">
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr><td><strong>From</strong></td><td><strong>To</strong></td><td>&nbsp;</td></tr>
  <tr>
    <td><div style="padding:0px 0px 4px 15px;font-size: 18px; color:#403f3f;">
		<?php if($getFrenchise){ ?>
			<span style="text-transform:uppercase; font-weight:bold"><?php echo $getFrenchise->name;?></span><br>
			 Member Id :<strong><?php echo $getFrenchise->username;?></strong><br>
			 <?php echo $getFrenchise->address;?>,<br>
			 <?php echo $getFrenchise->ctyN.' ,'.$getFrenchise->stN;?>,<br>
			 Contact Number: <?php echo $getFrenchise->mobile;?><br>
			 Zipcode:  <?php echo $getFrenchise->zipcode;?><br>
			<?php }else{?>
		<strong><?php echo $this->session->userdata('company_name');?></strong>
			<br><?php echo $this->session->userdata('company_address');
			}?>	
		</div></td>
    <td><div style="padding:1px 0px 4px 20px;font-size: 18px; color:#403f3f;">
	<span style="text-transform:uppercase; font-weight:bold"><?php echo $member->name;?></span><br>
	 Member Id :<strong><?php echo $member->username;?></strong><br>
		  	 <?php echo $member->address;?>,<br>
			  <?php echo $member->ctyN.' ,'.$member->stN;?>,<br>
         Contact Number: <?php echo $member->mobile;?><br>
            Zipcode:  <?php echo $member->zipcode;?><br>
	</div></td>
	 <td>
	 	<div style="color:#403f3f;">
	 		<strong>Order Date</strong> : <strong><?php echo date('d-m-Y',strtotime($ordHistory['order_date']));?></strong><br />
			<strong>Delevery/Cancelled  Date</strong> : 
			<strong><?php  if($ordHistory['delevery_date']){echo date('d-m-Y',strtotime($ordHistory['delevery_date']));}else{ echo 'N/A';}?></strong><br />
			<strong>Order Status</strong> : <strong><?php echo $stsTex;?></strong><br />
	 	</div>
	 </td>
  </tr>
  
</table>

<table align="center" id="mi_ordTble">
<thead >
	<tr>
		<th>S No.</th>
		<th>Product Name</th>
		<th>P. B.V</th>
		<th>MRP</th>
		<th>Sell Price</th>
		<th>Quantity</th>
		<th>Discount</th>
		<th>Total Amount</th>
		<th>Tax</th>
		<th>Net Amount</th>
	</tr>
</thead>
<tbody>
	<?php if($orderDetails)
	{ 
	$ctr=0;	$grandTotal=0;	
		foreach($orderDetails as $dList)
		{$ctr++;
		$tAmt=$dList['product_selling_price']*$dList['product_qty'];
		$netAmtAftrDis=$tAmt-($tAmt*$dList['discount'])/100;
		$netAmt=$netAmtAftrDis+($netAmtAftrDis*$dList['productTax'])/100;
		?>
		<tr>
			<td><?php echo $ctr;?>. </td><td><?php echo $dList['product_name'];?></td>
			<td> <?php echo $dList['productBv'];?></td>
			<td> <?php echo $dList['product_mrp'];?></td>
			<td> <?php echo $dList['product_selling_price'];?></td>
			<td><?php echo $dList['product_qty'];?></td>
			<td><?php echo $dList['discount'];?> %</td>
			<td> <?php echo number_format($netAmtAftrDis,2);?></td>
			<td><?php echo $dList['productTax'];?> %</td>
			<td> <?php echo number_format($netAmt,2);?></td>
		</tr>
		<?php $grandTotal+=$netAmt;}$duesAmt=$grandTotal-$ordHistory['paid_amt'];?>
		<tr><td colspan="9" style="text-align:right"><strong>Grand Total</strong> </td><td> <strong><?php echo number_format($grandTotal,2);?></strong></td></tr>
		
	<tr><td colspan="9" style="text-align:right"><strong>Paid Amt</strong> </td><td> <strong><?php echo number_format($ordHistory['paid_amt'],2);?></strong></td></tr>
	<tr><td colspan="9" style="text-align:right"><strong>Dues Amt</strong> </td><td> <strong><?php echo number_format($duesAmt,2);?></strong></td></tr>								
<?php }else{?>
	<tr>
		<td colspan="10" align="center"><code>Ooop's there is no data found</code><br />
			<img src="<?php echo base_url('uploads/addnewitem.svg');?>" style="height:200px;"><br /><br />
			<a href="<?php echo base_url('partner/order/add_kart');?>" class="text-success bolds">
			<i class="bx bx-shopping-bag"></i> Do you want o order now.
			</a>
			<br /><br />
		</td>
	</tr>
	<?php 
	}?>	
</tbody>
</table>
</body>
</html>