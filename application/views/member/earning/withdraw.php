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
		<div class="ami_title"><i class="bx bx-money  miU"></i> <?php echo $breadcrums ?>
		<span><a href="<?php echo base_url('member/dashboard');?>" class="miBack"><i class="bx bx-arrow-back"></i></a></span>
		
		
		</div>
			<div class="crdDet btm_border">
			  <div class="row mi_padd">
				<div class="col-md-12">
                <?php //print_r($usrDetails);?>
				   <div class="row">	
		<div class="col-md-4">
			<div class="card-type-pricing text-center">
				<div class="card-body style-custom">
					<h2 class="rewardN"><?php echo ($usrDetails->name=='MSDR Global Marketting Pvt. Ltd.')?'<span style=" font-size:1rem;">'.$usrDetails->name.'</span>':$usrDetails->name;?></h2>
					<div class="price">
						<img src="<?php echo $usrDetails->my_img?base_url($usrDetails->my_img):base_url('uploads/member/no_profile.png');?>" alt="<?php echo $usrDetails->name;?>" class="avatar-lg rounded-circle mb-3">
					</div>
					<p class="amiWallet"><em><?php echo $usrDetails->rank;?></em></p>
				</div>
		<div class="card-body no-padding" style="border:1px solid rgba(157, 157, 157, 0.2)">
			<ul class="rewaList text-left amiWallet">
			<li><i class="bx bxs-wallet-alt"></i> Wallet <span class="pull-right amiWalletSp"> <i class="bx bx-rupee"></i> <?php echo $usrDetails->balance;?></span></li>
			<li><i class="fa fa-phone-square"></i> Mobile Number <span class="pull-right amiWalletSp">  <?php echo $usrDetails->mobile;?></span></li>
			<li><i class="bx bxs-envelope "></i> Email <span class="pull-right amiWalletSp">  <?php echo $usrDetails->email;?></span></li>
			<!--<li><i class="bx bx-sitemap"></i> Total Inside Members 
				<span class="pull-right amiWalletSp"> <i class="fa fa-users"></i> 110<?php //echo $usrDetails->total_downline;?></span></li>-->
			<li><i class="fa fa-home"></i> Address <span class="pull-right amiWalletSp">  <?php echo $usrDetails->address;?></span></li>	
			</ul>
		</div>
			</div>
		</div>
<!------------------------------------->	
		<div class="col-md-8">
			
<div class="mt-4">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs nav-tabs-custom nav-left" role="tablist">
		<li class="nav-item" role="presentation">
			<a class="nav-link active" data-bs-toggle="tab" href="#earnedInc" role="tab" aria-selected="false" tabindex="-1">
				<span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
				<span class="d-none d-sm-block"> <i class="bx bx-money mIcn" aria-hidden="true"></i>
 Earned Income</span>                                                                        
			</a>
		</li>
		<li class="nav-item" role="presentation">
			<a class="nav-link " data-bs-toggle="tab" href="#withdrawalRequest" role="tab" aria-selected="false" tabindex="-1">
				<span class="d-block d-sm-none"><i class="far fa-user"></i></span>
				<span class="d-none d-sm-block"><i class="bx bx-money mIcn" aria-hidden="true"></i>
 withdrawal request</span>                                                                        
			</a>
		</li>
		
	</ul>

	<!-- Tab panes -->
	<div class="tab-content p-3 text-muted">
		<div class="tab-pane active" id="earnedInc" role="tabpanel">
			<p class="mb-0">
				<div class="row">
				<div class="col-md-12">
					<div class="amiPayRequest">
						You have to withdraw minimum : 
						<span><i class="bx bx-rupee"></i> <?php if($minWthdrawal->withdrableAmt){echo $minWthdrawal->withdrableAmt;}else{echo '0.00';}?></span>
					</div>
				</div>
			</div>
				<div class="row">
				<div class="col-md-6">	
					<div class="amiwall">
						Available Wallet  : <span id="avlBal"><i class="bx bx-rupee"></i> <?php if($usrDetails->balance){echo $usrDetails->balance;}else{echo '0.00';}?></span>									                    </div>
				</div>
				<div class="col-md-6">
					<div class="amiEarnedBal">
						Incoming Earned  : <span><i class="bx bx-rupee"></i> <?php if($earnedInc->incomeEarnend){echo $earnedInc->incomeEarnend;}else{echo '0.00';}?></span>						                    </div>
				</div>		
			</div>
				<div id="getMsg" class="amiSuccess" style="display:none;">&nbsp;</div>		
				<form class="form" role="form">	
					<div class="form-group has-success has-feedback">
					<div>
						<label for="warningfeedback7">Enter Amount to withdraw:</label>
						<span class="bx bx-rupee form-control-feedback"></span>
					   </div> 
						 <input type="text" class="edtBltxt txt_width" id="wthdr_amt">
					</div>
					<button class="edtBtn pull-right actionCmd" id="amiWthDrw" type="button"><i class="fa fa-check"></i> Withdraw</button>
				</form>	
			</p>
		</div>
		<div class="tab-pane" id="withdrawalRequest" role="tabpanel">
			<p class="mb-0">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead class="hdr_clr"><tr><th>S No.</th><th>Amount</th><th>Date</th><th>Status</th></tr></thead>
						<tbody>
						<?php if($wthdrawalRqst){ $cnt=0; foreach($wthdrawalRqst as $list){++$cnt;?>
							<tr><th><?php echo $cnt;?>.</th>
							<td><i class="bx bx-rupee amiInr"></i> <?php echo $list->amount;?></td><td><?php echo date('h:i:s a ,d-M-Y',strtotime($list->request_date));?></td>
							<td><span style="color:#006495;"><i class='fa fa-cog rotate'></i> <?php if($list->status=='Un-Paid'){echo 'Processing..';}?></span></td></tr>
						<?php }}else{?>
						<tr>
								<!--<td colspan="4" class="dTables_empty"><i class='fa fa-cog rotate'></i> Ooop's there is no request found</td>-->
								<td colspan="4" style="text-align:center; background-color:#FFF;">
					
					<div style="color:#f46f6f;text-transform:uppercase;font-weight:bold;">Ooop's there is no request found</div>
					 <img src="<?php echo base_url('uploads/addnewitem.svg');?>">
					<a href="<?php echo base_url('member/income');?>" class="miBack"><div><i class="md md-arrow-back"></i> Back</div></a>
					</td>
						</tr>
						<?php }?>
						</tbody>
					</table>
				</div>
		    </p>
		</div>
		
	</div>
  </div>			
</div>	    
<!------------------------------------->		
	</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<!------------->
