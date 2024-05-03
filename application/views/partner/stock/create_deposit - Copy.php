<form method="post" class="form" role="form">
<div class="card-body">
<?php if($actnType==NULL){?>

	<div class="row">
		<div  class="col-sm-4">
			<div class="getNotifiy">
				<span><?php echo $this->session->userdata('name');?></span>,<br />
				<p>
					If you have scanned the QR code or deposited the amount in the bank account of Gesva Micro Care Foundation, please send the deposit slip to the bank account. So that the company ensures that the amount deposited has been deposited successfully.
					</p>
			</div>
		</div>
		
		
		<div class="col-sm-8">
			<!--<div id="errorMsgShow">Result show</div>-->
			 <div class="col-sm-6">
				<div class="form-group">
					<div class="input-group date">
						<span class="input-group-addon"><i class="fa fa-inr"></i></span>
						<div class="input-group-content">
							<input type="text" class="form-control" id="depositedAmt">
							<label>Deposited amount:</label>
						</div>	
					</div>
				  </div>
			   </div>
			 <div class="col-sm-6">
					<div class="form-group">
						<div class="input-group date" id="demo-date">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<div class="input-group-content">
								<input type="text" class="form-control" id="depositedDate" readonly="">
								<label>Deposited Date:</label>
							</div>	
						</div>
					</div>
			   </div>   
			   
			  <div class="col-sm-12">
				<div class="form-group">
					<div class="input-group date">
						<span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
						<div class="input-group-content">
							<textarea name="textarea1" id="remarks" class="form-control" rows="2"></textarea>
							<label>Remarks :</label>
						</div>	
					</div>
				  </div>
			   </div> 
			   
			   <div class="col-sm-6">
					<div class="form-group">
						<div class="input-group date">
							<span class="input-group-addon"><i class="fa fa-picture-o"></i></span>
							<div class="input-group-content">
								<select id="payMode" name="payMode" class="form-control" style="margin-top:15px;">
									<option value="">-----Select One-----</option>
									<option value="By cash">By Cash</option>
									<option value="By upi">By UPI</option>
									<option value="By cheque">By Cheque</option>
									<option value="By deposit">By Depost</option>
								
								</select>
								<label>Payment Mode :</label>
							</div>	
						</div>
					</div>
			   </div>
			   
			   
			    <div class="col-sm-6">
					<div class="form-group">
						<div class="input-group date">
							<span class="input-group-addon"><i class="fa fa-picture-o"></i></span>
							<div class="input-group-content">
								<input type="file" class="form-control" id="depositedSlip">
								<label>Deposited Slip:</label>
							</div>	
						</div>
					</div>
			   </div>    
		</div>	
	</div>	
<?php }else{
//print_r($deposit);
?>	
<div class="row">
		<div  class="col-sm-4">
			<div style=" background-color:#eaeaea; padding:10px;">
				<div class="docAmiImg" style="height:300px; width:360px;">
					<img id="paySlip" src="<?php echo base_url($deposit->tnx_slip);?>" alt="pay slip">
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			 <div class="col-sm-6">
				<div class="form-group">
					<div class="input-group date">
						<span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
						<div class="input-group-content">
							<span class="form-control"><?php echo $deposit->tnx_id;?></span>
							<label>Transaction Id:</label>
						</div>	
					</div>
				  </div>
			   </div>			
			 <div class="col-sm-6">
				<div class="form-group">
					<div class="input-group date">
						<span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
						<div class="input-group-content">
							<span class="form-control <?php echo strtolower($deposit->status);?> sts"><?php echo $deposit->status;?></span>
							<label>Transaction Status:</label>
						</div>	
					</div>
				  </div>
			   </div>
			 <div class="col-sm-6">
				<div class="form-group">
					<div class="input-group date">
						<span class="input-group-addon"><i class="fa fa-inr"></i></span>
						<div class="input-group-content">
							<span class="form-control"><?php echo $deposit->amount;?></span>
							<label>Deposited amount:</label>
						</div>	
					</div>
				  </div>
			   </div>
			 <div class="col-sm-6">
					<div class="form-group">
						<div class="input-group date">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<div class="input-group-content">
								<span class="form-control"><?php echo date('d-m-Y',strtotime($deposit->tnx_date));?></span>
								<label>Deposited Date:</label>
							</div>	
						</div>
					</div>
			   </div>     
			 <div class="col-sm-12">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
						<div class="input-group-content">
							<textarea name="textarea1" id="remarks" class="form-control" rows="2" readonly="readonly"><?php echo $deposit->reason;?></textarea>
							<label>Remarks :</label>
						</div>	
					</div>
				  </div>
			   </div> 
			 <div class="col-sm-4">
					<div class="form-group">
						<div class="input-group date">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<div class="input-group-content">
								<span class="form-control"><?php echo date('H:i:s d-m-Y',strtotime($deposit->create_date));?></span>
								<label>Request Date:</label>
							</div>	
						</div>
					</div>
			   </div> 
			    <div class="col-sm-4">
					<div class="form-group">
						<div class="input-group date">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<div class="input-group-content">
								<span class="form-control"><?php echo $deposit->pay_mode;?></span>
								<label>Payment Mode:</label>
							</div>	
						</div>
					</div>
			   </div>  
			   
			   <div class="col-sm-4">
					<div class="form-group">
						<div class="input-group date">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<div class="input-group-content">
								<span class="form-control"><?php if($deposit->approval_date){echo date('d-m-Y',strtotime($deposit->approval_date));}else{ echo 'N/A';}?></span>
								<label>Approval Date:</label>
							</div>	
						</div>
					</div>
			   </div>	
		</div>	
	</div>
<?php }?>		
</div>
<div class="card-actionbar-row" style="margin-bottom: 50px;">
		<?php if($actnType==NULL){?><button type="button" class="btn btn-raised btn-primary-dark pull-right editPrUser" id="proceedDeposit" style="margin-right:20px;"> <i class="fa fa-check"></i> Submit</button><?php }?>
		<a href="<?php echo base_url('mlm_software/member/deposit/view');?>" class="btn btn-raised ink-reaction btn-default-light pull-right" >
		<i class="md md-arrow-back"></i>  Back</a>		
</div>
</form>







