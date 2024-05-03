


<table  class="table table-striped table-hover">
	
	<tr>
		<th rowspan="4"><div class="docAmiImg"><img src="<?php echo base_url($product['pro_img']);?>"></div></th>
		<th>Product Name:</th><td><?php echo $product['product_name'];?></td>
		<th>Product Category:</th><td><?php echo $product['category'];?></td>	
	</tr>
	<tr>
		<th>Product Mrp:</th><td><?php echo $product['mrp'];?></td>
		<th>Product Price:</th><td><?php echo $product['product_price'];?></td>	
	</tr>
	<tr>
		<th>Discount:</th><td><?php echo $product['discount'];?></td>
		<th>Stock:</th><td><?php echo $product['quantity'].$product['unit_name'];?></td>	
	</tr>
	<tr><th>Manufacturing Date:</th><td><?php echo date('d-M-Y',strtotime($product['mfg_date']));?></td>
		<th>Expiry Date:</th><td><?php echo date('d-M-Y',strtotime($product['exp_date'])) ?></td>
	</tr>
</table>


<style>
.docAmiImg {border: 1px solid #eaeaea;position: relative;overflow: hidden;margin: 0 auto; cursor: pointer;width:180px;height: 160px;}
.docAmiImg img{width: 100%;height: 100%;transition: 0.5s all ease-in-out;}
.docAmiImg:hover img {transform: scale(2.5);}
</style>



