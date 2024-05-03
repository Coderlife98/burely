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
		<div class="ami_title"><i class="bx bx-wallet-alt   miU"></i> <?php echo $breadcrums ?>
		<span><a href="<?php echo base_url('member/dashboard');?>" class="miBack"><i class="bx bx-arrow-back"></i></a></span>
		
		
		</div>
			<div class="crdDet btm_border">
			  <div class="row mi_padd">
				<div class="col-md-12">
				   <div class="table-responsive">
					<div id="search_data">
						<table id="member_wallet" class="table table-striped table-hover">
							<thead class="hdr_clr">
								<tr>
									<th>S No.</th>
									<th>Tnx Id</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Description</th>
									<th>Date</th>
									<!--<th>Ref ID</th>-->
								</tr>
							</thead>
						</table>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<!------------->
