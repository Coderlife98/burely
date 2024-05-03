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

<style>

.getNotifiy {
  background-color: #FFC780;
  padding: 45px 35px 45px 35px;
  border: 1px solid #e6e6e6;
  margin-bottom:20px;
}.getNotifiy span {
  font-size: 16px;
  font-weight: 900;
  color: #663900;
}#depositedSlip {
  margin: 15px 0px 0px 0px;
}#depositedSlip::file-selector-button {margin: 0px 10px 0px -5px ;  padding: 5px 15px 5px 15px;border-radius: 5px;background: #039d94; color:#fff}
</style>


<div class="row mb-4">
	
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header ami_cmn">
				<span><i class="mdi mdi-account-circle-outline"></i></span> Search details
				<a href="<?php echo base_url('partner/deposit/view');?>" class="ititle miMr" title="Back to list"><i class="bx bx-arrow-back"></i></a>
			</div>
			<div class="card-body">
			  <form method="post" id="search_stock_list">
				<div class="row">
				 <?php if($actnType==NULL){?>  
				   <div class="col-xl-4">
				     <div class="getNotifiy">
							<span><?php echo $this->session->userdata('partner_name');?></span>,<br />
<p>If you have scanned the QR code or deposited the amount in the bank account of Gesva Micro Care Foundation, please send the deposit slip to the bank account. So that the company ensures that the amount deposited has been deposited successfully.</p>
						</div>
				   </div>
				   <div class="col-xl-8">
					 
						<div class="row">
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="text" id="depositedAmt" class="form-control" >
									<label for="userId"><i class="bx bx-rupee fntClr"></i> Deposited amount</label>
								</div>
							</div>
							
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input type="date" id="depositedDate" class="form-control" >
									<label for="userId"><i class="mdi mdi-calendar-account fntClr"></i> Deposited Date</label>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-floating mb-3">
									<textarea name="textarea1" id="remarks" class="form-control" rows="4"></textarea>
									<label for="strtDt"><i class="bx bx-notepad fntClr"></i> Remarks </label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<select id="payMode" name="payMode" class="form-control" style="margin-top:15px;">
									    <option value="">-----Select One-----</option>
									    <option value="By upi">By UPI</option>
									    <option value="By cash">By Cash</option>
										<option value="By cheque">By Cheque</option>
									    <option value="By deposit">By Deposit</option>
								    </select>
									<label for="payMode"><i class="bx bx-book-content fntClr"></i> Payment Mode </label>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-floating mb-3">
									<input  type="file" class="form-control" id="depositedSlip" />
									<label for="endDt"><i class="bx bx-image fntClr"></i> Deposited Slip </label>
								</div>
							</div>
						</div>	
				    </div>
				 <?php }else{ ?>
				<div class="row">
		<div  class="col-xl-4">
			<div style=" background-color:#eaeaea; padding:10px;">
				<div class="docAmiImg" style="height:300px; width:300px;">
					<img id="paySlip" src="<?php echo base_url($deposit->tnx_slip);?>" alt="pay slip">
				</div>
			</div>
		</div>
		<div class="col-xl-8">
			<div class="row">			
				<div class="col-lg-6">
					<div class="form-floating mb-3">
						<span class="form-control"><?php echo $deposit->tnx_id;?></span>
						<label for="tnxID"><i class="mdi mdi-calendar-account fntClr"></i> Transaction Id</label>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-floating mb-3">
						<span class="form-control <?php echo strtolower($deposit->status);?> sts"><?php echo $deposit->status;?></span>
						<label for="userId"><i class="mdi mdi-calendar-account fntClr"></i> Transaction Status</label>
					</div>
				</div>
				
				
				<div class="col-lg-6">
					<div class="form-floating mb-3">
						<span class="form-control"><?php echo $deposit->amount;?></span>
						<label for="userId"><i class="bx bx-rupee fntClr"></i> Deposited amount</label>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-floating mb-3">
						<span class="form-control"><?php echo date('d-m-Y',strtotime($deposit->tnx_date));?></span>
						<label for="userId"><i class="mdi mdi-calendar-account fntClr"></i> Deposited Date</label>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-floating mb-3">
						<textarea name="textarea1" id="remarks" class="form-control" rows="2" readonly="readonly"><?php echo $deposit->reason;?></textarea>
						<label for="userId"><i class="bx bx-file fntClr"></i> Remarks</label>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-floating mb-3">
						<span class="form-control"><?php echo date('H:i:s d-m-Y',strtotime($deposit->create_date));?></span>
						<label for="requestDt"><i class="mdi mdi-calendar-account fntClr"></i> Request Date</label>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-floating mb-3">
						<span class="form-control"><?php echo $deposit->pay_mode;?></span>
						<label for="requestDt"><i class="bx bx-credit-card fntClr"></i> Payment Mode</label>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-floating mb-3">
						<span class="form-control"><?php if($deposit->approval_date){echo date('d-m-Y',strtotime($deposit->approval_date));}else{ echo 'N/A';}?></span>
						<label for="requestDt"><i class="mdi mdi-calendar-account fntClr"></i> Approval Date</label>
					</div>
				</div>
		   </div>
			   
			   	
		</div>	
	</div>
				 <?php }?>
				<div class="col-xl-12">
				    <a href="<?php echo base_url('partner/deposit/view'); ?>" class="btn btn-outline-dark waves-effect waves-light" <?php if($actnType){?> style="margin-top:20px;"<?php }?> ><i class="bx bx-arrow-back"></i> Back</a>
				  <?php if($actnType==NULL){?>
				    <button type="button" class="btn btn-outline-primary waves-effect waves-light pull-right" id="proceedDeposit"><i class="bx bx-save"></i> Submit </button>
					<?php }?>
				</div>
				
				
				<input type="hidden" id="target" value="<?php echo base_url('partner/deposit/manage/create');?>" />	
			    </div>
		    </form> 
			</div>
		</div>
	</div>
</div>


