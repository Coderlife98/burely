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
		
		<div class="ami_title">
			<i class="bx bx-user-circle miU"></i> Only for testing purpose
		    <span><a href="<?php echo base_url('member/dashboard');?>" class="miBack"><i class="bx bx-arrow-back"></i></a></span>
		</div>
			<div class="crdDet btm_border" >
				<div class="row mi_padd">
					<div class="col-md-12">	
<?php 
	    $getParent=NULL;
	    //$getParent=$this->demo->generate_repurchase('MSD21781','MSD21781','2999','100');
	      $getParent=$this->demo->activate_plan('MSD17751','MSD17751','199');
	       // $getParent=$this->demo->isCheckChildIncome('MSD44142');
		//echo $this->db->last_query().'<br>';
		
	   print_r($getParent);
?>


<table id="demo" class="table table-striped table-hover" style="display:none;">
<thead class="btlHeader">
	<tr>
		<th>S No.</th>
		<th>User Id</th>
		<th>Package B.V</th>
		<th>Benifit (%)</th>
		<th>Income</th>
	</tr>
</thead>
<tbody>
		<?php 
			/*if($getParent)
			{
			foreach($getParent as $list)
			{	*/
				?>
	<tr>
			<td>S No.</td>
			<td>User Id</td>
			<td>Package B.V</td>
			<td>Benifit (%)</td>
			<td>Income</td>
		</tr>
			<?php //}}?>
</tbody>
</table>













					
				<table id="demo" class="table table-striped table-hover" style="display:none;">
					<thead class="btlHeader">
						<tr>
							<th>S No.</th>
							<th>User Id</th>
							<th>Package B.V</th>
							<th>Benifit (%)</th>
							<th>Income</th>
						</tr>
					</thead>
					<tbody>
					
					<?php //print_r($getParent);?>
					<!--<?php  /*if(!$getParent)
							 {  
								$sp=0;
								foreach($getParent as $pList)
								{
									$sp++;*/
									?>
								<tr>
										<th><?php //echo $sp;?>.</th>
										<td><?php //echo $pList['level'];?></td>
										<td><?php //echo $pList['total_downline'];?></td>
										<td><?php ///echo $pList['username'];?></td>
										<td><?php //echo $pList['position'];?></td>
										<td><?php //echo $pList['rank'];?></td>
										<td><?php //print_r($pList);?></td>
										<td><?php  //print_r($setMyChildRnk);?></td>
								</tr>					
				  		   <?php //}}else {?>	
		<tr><td colspan="8" style="text-transform:uppercase; color:#9D0000;text-align: center;font-weight: 600;">There is no parrent available here</td></tr>
						   <?php //}?>-->
					</tbody>
				</table>
					</div>		
			    </div>		
		    </div>
	</div>
</div>