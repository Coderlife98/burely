
 <div class="row mb-4">
	<div class="col-xl-12">
		
		<div class="card">
			<div class="mitbl">
				<i class="bx bxs-group miU"></i>
				R List
				<span><i class="far fa-file-excel miUexl"></i><i class="far fa-file-pdf miUpdf"></i><i class="fas fa-print miUprint"></i>
				</span>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<div id="search_data">
						<table id="my_sale_list" class="table table-striped table-hover">
							<thead class="hdr_clr">
								<tr>
									<th>S No.</th>
									<th>User Id</th>									
									<th>Name</th>									
									<th>Transection Id</th>									
									<th>Amount</th>								
									<th>Date</th>						
									
									<th style=" text-align:center;">Status</th>
									<th style="text-align:center; ">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if(count($wallet_request)){?>
										<?php foreach($wallet_request as $wr):?>
											<tr>
												<td><?php echo ++$i;?></td>
												<td><?php echo $wr['userid'];?></td>
												<td><?php echo $wr['member_name'];?></td>
												<td><?php echo $wr['tansection_id'];?></td>
												<td><?php echo config_item('currency').$wr['amount'];?></td>
												<td><?php echo date('dMY',strtotime($wr['create_date']));?></td>												
												<td><?php echo $wr['status'];?></td>
												<td>
													<a href="javascript:void(0);"><i class="fa fa-eye"></i></a>
												</td>
											</tr>
											<?php endforeach;?>
										<tr></tr>
										<?php }else{?>

											<tr>
												<td colspan="6" class="text-center">Not record find</td>
											</tr>
											<?php }?>

								</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="target" value="<?php echo $target;?>">
