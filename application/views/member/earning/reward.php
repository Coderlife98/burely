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
<input type="hidden" id="target" value="<?php echo $target; ?>" />
<div class="row mb-4">
	<div class="col-xl-12">
		<div class="ami_title"><i class="bx bx-detail  miU"></i> My Acheivement List
		<span><a href="<?php echo base_url('member/dashboard');?>" class="miBack"><i class="bx bx-arrow-back"></i></a></span>
		
		
		</div>
			<div class="crdDet btm_border">
			  <div class="row mi_padd">
				<div class="col-md-12">
				   <div class="table-responsive">
					<div id="search_data">
						<table id="view_rewards" class="table table-striped table-hover">
			<thead class="hdr_clr">
				<tr>
					<th>S No.</th>
					<th>Reward Name</th>
					<th>Acheive Date</th>
					<th>Status</th>
					<th>Delivery Date</th>
					<th>Remarks</th>
				</tr>
			</thead>
			<tbody>
			<?php
		/*	echo $this->db->last_query();*/
			if($isRewardList)
			{ $ct=0;
			foreach($isRewardList as $list)
			{$ct++;
			if($list->status=='Pending'){$status='<span style="color:#305A8F;"><i class="fa fa-cog rotate"></i> Pending</span>';}
			else{$status='<span style="color:#319D00;"><i class="fa fa-check-circle"></i> '.$list->status.'</span>';}
			if($list->paid_date){$paidDate=date('H:s:i a d M Y',strtotime($list->paid_date));}else{$paidDate='N/A';}
			if($list->tid){$tid=$list->tid;}else{$tid='N/A';}
			?>			
						
						<tr>
							<th><?php echo $ct;?></th>
							<td><?php echo $list->other_reward;?></td>
							<td><?php echo $list->create_date;?></td>
							<td><?php echo $status;?></td>
							<td><?php echo $paidDate;?></td>
							<td><?php echo $tid;?></td>
						</tr>
				<?php }}else{?>
				<tr>
					<td colspan="6" style="text-align:center; background-color:#FFF;">
					
					<div style="color:#f46f6f;text-transform:uppercase;font-weight:bold;">No data available</div>
					 <img src="<?php echo base_url('uploads/addnewitem.svg'); ?>">
					<a href="<?php echo base_url('member/income');?>" class="miBack"><div><i class="md md-arrow-back"></i> Back</div></a>
					</td>
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
</div>
<!------------->
