<?php foreach ($order_items as $items) : ?>
	<tr>
		<td><?php echo ++$i; ?></td>
		<td><?php echo $items['product_name']; ?></td>
		<td><?php echo $items['product_qty']; ?></td>
		<td><?php echo $items['product_mrp']; ?></td>
		<td><?php echo $items['product_selling_price']; ?></td>
		<td><?php echo $items['discount'].'%'; ?></td>
		<td><?php echo $items['total_amount']; ?></td>
		<td><?php echo $items['net_amount']; ?></td>

	</tr>
<?php endforeach; ?>