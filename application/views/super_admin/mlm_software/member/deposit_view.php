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
<?php //print_r($employee);?>
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header header-green"><i class="mdi mdi-cash-multiple"></i>  <?php echo $breadcrums;?>
			<a href="<?php echo base_url('super_admin/mlm_software/member/deposit');?>" class="ititle" title="Back"><i class="bx bx-arrow-back"></i></a></div>
			<div class="card-body p-4" style="margin-bottom:-10px;">
			   <div class="row">
			   
			   <div class="col-lg-4">
					<div style=" background-color:#eaeaea; padding:10px;">
						<div class="docAmiImg" style="height:280px; width:305px;">
							<img id="paySlip" src="<?php echo base_url($deposit->tnx_slip);?>" alt="pay slip">
						</div>
					</div>
				</div>
			   <div class="col-lg-8">
				 <div class="row">	
					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<span class="form-control"><?php echo $deposit->username;?></span>
							<label for="tnxId"><i class="bx bx-id-card fntClr"></i> Member Id </label>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<span class="form-control"><?php echo $deposit->tnx_id;?></span>
							<label for="tnxId"><i class="bx bx-transfer-alt fntClr"></i> Transaction Id </label>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<span class="form-control"><?php echo date('H:i:s d-m-Y',strtotime($deposit->create_date));?></span>
							<label for="endDt"><i class="bx bx-calendar fntClr"></i> Request Date </label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<span class="form-control"><?php echo $deposit->amount;?></span>
							<label for="depoAmt"><i class="bx bx-rupee fntClr"></i> Deposited Amount </label>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-floating mb-3">
							<span class="form-control"><?php echo date('d-m-Y',strtotime($deposit->tnx_date));?></span>
							<label for="endDt"><i class="mdi mdi-calendar-account fntClr"></i> Deposit Date </label>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-floating mb-3">
							<span class="form-control" style=" height:80px;"><?php echo $deposit->reason;?></span>
							<label for="endDt"><i class="bx bx-detail fntClr"></i> Remarks By Member </label>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<span class="form-control <?php echo strtolower($deposit->status);?> sts"><?php echo $deposit->status;?></span>
							<label for="tnxId"><i class="bx bx-detail fntClr"></i> Transaction Status</label>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<span class="form-control"><?php echo $deposit->pay_mode;?></span>
							<label for="endDt"><i class="bx bx-credit-card-alt fntClr"></i> Payment Mode </label>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<span class="form-control"><?php if($deposit->approval_date){echo date('d-m-Y',strtotime($deposit->approval_date));}else{ echo 'N/A';}?></span>
							<label for="endDt"><i class="bx bx-calendar fntClr"></i> Approval Date: </label>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<?php if($deposit->status=='Approved'){?><span class="form-control"><?php echo $deposit->status;?></span> <?php }else{?>
							<select class="form-select" name="trAction" id="trAction">
								<option value="">---- Select One ----</option>
								<option value="Hold" <?php if($deposit->status=='Hold'){echo 'selected="selected"';}?> >Hold</option>	
								<option value="Cancel" <?php if($deposit->status=='Cancel'){echo 'selected="selected"';}?> >Cancel</option>	
								<option value="Pending" <?php if($deposit->status=='Pending'){echo 'selected="selected"';}?> >Pending</option>
								<option value="Approved" <?php if($deposit->status=='Approved'){echo 'selected="selected"';}?> >Approved</option>
							</select>
							<?php }?>
							<label for="endDt"><i class="bx bx-calendar fntClr"></i> Transaction Action </label>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="form-floating mb-3">
							<?php if($deposit->status=='Approved'){?><span class="form-control">N/A</span> <?php }else{?>
							<select class="form-select empSelectR" name="trfType" id="trfType">
								<option value="">---- Select One ----</option>
								<option value="wallet" <?php //if($deposit->status=='wallet'){echo 'selected="selected"';}?> >Wallet</option>	
								<option value="pin_purchase" <?php //if($deposit->status=='Pin Purchase'){echo 'selected="selected"';}?> >Pin Purchase</option>	
								<option value="Security" <?php //if($deposit->status=='Topup'){echo 'selected="selected"';}?> >Security</option>
								<option value="purchase" <?php //if($deposit->status=='Topup'){echo 'selected="selected"';}?> >Purchase</option>
								
							</select>
							<?php }?>
							<label for="endDt"><i class="bx bx-calendar fntClr"></i> Transfer Type </label>
						</div>
					</div>
					<div class="col-lg-4" id="tnxActnID">
						<div class="form-floating mb-3">
							<span class="form-control"><?php echo $deposit->amt_tnx;?></span>
							<label for="tnxIdForAll"><i class="bx bx-transfer-alt fntClr"></i> Transaction id </label>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-floating mb-3">
							<textarea name="tnxRemarksByAdmin" id="tnxRemarksByAdmin" class="form-control" <?php if($deposit->status=='Approved'){echo 'readonly="readonly"';}?> rows="3"><?php echo $deposit->approval_remarks;?></textarea>
							<label for="tnxRemarksByAdmin"><i class="bx bx-calendar fntClr"></i> Transaction Remarks By Admin </label>
						</div>
					</div>
					
				<?php if($employee){?>	
				<div class="col-lg-6">
						<div class="form-floating mb-3">
							<span class="form-control miCrt"><?php echo $employee->user_code;?></span>
							<label for="tnxId"><i class="bx bx-id-card fntClr"></i> Employee Code </label>
						</div>
					</div>	
				<div class="col-lg-6">
						<div class="form-floating mb-3">
							<span class="form-control miCrt"><?php echo $employee->name;?></span>
							<label for="tnxId"><i class="bx bx-id-card fntClr"></i> Employee Name </label>
						</div>
					</div>	
					
					
				<?php }?>	
					
				   </div>
			   </div>
			</div>
			<div style="margin-top:20px;">	
			<a href="<?php echo base_url('super_admin/mlm_software/member/deposit'); ?>" class="btn btn-outline-dark  waves-effect waves-light">
				<i class="bx bx-arrow-back"></i> Back
			</a>
			
	<?php if($deposit->status!='Approved'){?>
			<button type="button" id="depActivate" class="btn btn-outline-primary waves-effect waves-light pull-right ActnCmdByAmi" style="float:right;"><i class="bx bx-save"></i> Submit </button>
			<?php }?>
			</div>
			</div>
		</div>
	</div>
<input type="hidden" id="depoID" value="<?php echo $deposit->id;?>"/>	
<input type="hidden" id="getMemID" value="<?php echo $deposit->username;?>"/>
<input type="hidden" id="target" value="<?php echo $target;?>" />	
<script src="<?php echo base_url() ?>media/js/super_admin/mlm_software/ledger.js"></script>
