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
 <div class="row mb-4">
	<div class="col-xl-12">
		<div class="card">
			<div class="mitbl">
				<i class="bx bxs-shopping-bag-alt miU"></i>
				Package Kart
				<span><i class="far fa-file-excel miUexl"></i><i class="far fa-file-pdf miUpdf"></i><i class="fas fa-print miUprint"></i>
				</span>
			</div>
			<div class="card-body">
			  <div class="row">
				<div class="col-md-6">
					<div class="getPackage">
						<ul>
							<li>Package Details</li>
							<li> Name<span><?php echo $getPackage->pack_name;?></span></li>
							<li> Price<span><?php echo $getPackage->amount;?></span></li>
							<li> BV<span><?php echo $getPackage->pack_bv;?></span></li>
							<li>Package Number<span><?php echo $getPackage->pack_nu;?></span></li>
							<li>Purchase Date<span><?php echo date('d-m-Y',strtotime($getPackage->generate_time));?></span></li>
						</ul>
					</div>
				</div>
					<div class="col-md-6">
					   <div class="getPackage" id="memberD">
							<ul>
									<li>Member Details <span id="memMin" class="mns actionCmd"><i class="bx bx-minus"></i></span></li>
									<li> Name<span id="memN"></span></li>
									<li> Member id<span id="memID"></span></li>
									<li> Mobile Number<span id="memMobile"></span></li>
									<li>Email Id<span id="emailID"></span></li>
									<li style="text-align:center">
										<button type="button" id="actvtBtn" class="btn btn-outline-primary waves-effect waves-light actionCmd">
											Activate Account
										</button> 
									</li>
							</ul>
						</div>
						<div style="padding: 65px; margin: 69px auto; " id="searchByr">
								<div class="row">
									<div class="col-md-4"><span style="float:right; font-weight:bold;"><i class="bx bx-user-circle"></i> Member Id</span></div>
									<div class="col-md-8"><span id="getTargetForBuyr">partner/package/findBuyer</span>
											<input type="text" class="edtBltxt buyr" id="buyerID" name="buyerID">
											<input type="hidden" id="pcId" value="<?php echo $getPackage->id;?>">
											<input type="hidden" id="packAmt" value="<?php echo $getPackage->amount;?>">
											<button type="button" class="kartBtn byr_search actionCmd" id="findFrPackageBuyer">Search</button>
									</div>
								</div>
						 </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url() ?>media/js/partner.min.js"></script>