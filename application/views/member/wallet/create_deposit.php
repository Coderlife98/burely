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
		border: 1px solid #e6e6e6;
		margin-bottom: 20px;
	}

	.getNotifiy img {
		width: 100%;
		height: 260px;
	}


	.getNotifiy span {
		font-size: 16px;
		font-weight: 900;
		color: #663900;
	}

	#depositedSlip {
		margin: 15px 0px 0px 0px;
	}

	#depositedSlip::file-selector-button {
		margin: 0px 10px 0px -5px;
		padding: 5px 15px 5px 15px;
		border-radius: 5px;
		background: #039d94;
		color: #fff
	}
</style>

<div class="row mb-4">
	<div class="col-xl-12">
		<div class="ami_title"><i class="bx bx-wallet-alt  miU"></i> Topup My Wallet
			<span><a href="<?php echo base_url('member/dashboard'); ?>" class="miBack"><i class="bx bx-arrow-back"></i></a></span>
		</div>
		<div class="crdDet btm_border">
			<div class="row mi_padd">

				<div class="col-md-12">
					<form method="post" id="search_stock_list">
						<div class="row">
							<?php if ($actnType == NULL) { ?>
								<div class="col-xl-4">
									<div class="getNotifiy">
										<img src="<?php echo base_url($accDetails->qr_code); ?>" alt="paymentQr">

									</div>
								</div>
								<div class="col-xl-8">

									<div class="row">
										<div class="col-lg-6">
											<div class="form-floating mb-3">
												<input type="text" id="depositedAmt" class="form-control">
												<label for="userId"><i class="bx bx-rupee fntClr"></i> Deposited amount</label>
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-floating mb-3">
												<input type="date" id="depositedDate" class="form-control">
												<label for="userId"><i class="mdi mdi-calendar-account fntClr"></i> Deposited Date</label>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-floating mb-3">
												<input type="text" id="tansection_id" name="tansection_id" class="form-control">
												<label for="strtDt"><i class="bx bx-notepad fntClr"></i> Transection Id </label>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-floating mb-3">
												<select id="payMode" name="payMode" class="form-control" style="margin-top:15px;">
													<option value="">-----Select One-----</option>
													<option value="By upi">By UPI/QR Code</option>

												</select>
												<label for="payMode"><i class="bx bx-book-content fntClr"></i> Payment Mode </label>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-floating mb-3">
												<input type="file" class="form-control" id="depositedSlip" />
												<label for="endDt"><i class="bx bx-image fntClr"></i> Deposited Slip </label>
											</div>
										</div>
									</div>

								</div>
							<?php } ?>
							<div class="col-xl-12">
								<a href="<?php echo base_url('member/deposit/view'); ?>" class="btn btn-outline-dark waves-effect waves-light" <?php if ($actnType) { ?> style="margin-top:20px;" <?php } ?>><i class="bx bx-arrow-back"></i> Back</a>
								<?php if ($actnType == NULL) { ?>
									<button type="button" class="btn btn-outline-primary waves-effect waves-light pull-right" id="proceedDeposit"><i class="bx bx-save"></i> Request </button>
								<?php } ?>
							</div>


							<input type="hidden" id="target" value="<?php echo base_url('member/wallet/manage/create'); ?>" />
						</div>
					</form>
				</div>
				
				<div class="col-md-12">
					<br>
					
				<div class="table-responsive">
						<div id="search_data">
							<table id="depo_transaction" class="table table-striped table-hover text-nowrap">
								<thead class="hdr_clr">
									
									<tr>
										<th>S No.</th>
										<th style="text-align:center;">Date</th>
										<th>Tnx Id</th>
										<th>Amount</th>
										<th>Description</th>
										<th style="text-align:center;">Status</th>
										<th style="text-align:center;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if(count($wallet_request)){?>
										<?php foreach($wallet_request as $wr):?>
											<tr>
												<td><?php echo ++$i;?></td>
												<td><?php echo date('dMY',strtotime($wr['create_date']));?></td>
												<td><?php echo $wr['tansection_id'];?></td>
												<td><?php echo config_item('currency').$wr['amount'];?></td>
												<td><?php echo $wr['remark'];?></td>
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
</div>

<script>
	/***********************wallet Start********************************/
	$(document).ready(function() {
		$("#proceedDeposit").click(function() {
			let depositAmt = $('#depositedAmt').val();
			let depositedDate = $('#depositedDate').val();
			let imgFile = $('#depositedSlip').val();
			let tansection_id = $('#tansection_id').val();
			if (depositAmt == "") {
				toast('tst_danger', 'Please input deposit amount');
			} else if (isNaN(isCheck('depositedAmt'))) {
				toast('tst_danger', 'Please input deposit valid amount');
			} else if (depositedDate == "") {
				toast('tst_danger', 'Please input deposited date');
			} else if (tansection_id == "") {
				toast('tst_danger', 'Please input Transection Id ');
			} else if (!isCheck('payMode')) {
				toast('tst_danger', 'Please select payment deposit mode');
			} else if (imgFile == "") {
				toast('tst_danger', 'Please Provide valid slip image');
			} else {
				$('#proceedDeposit').html('<i class="bx bx-cog bx-spin"></i> Please Wait');
				var name = document.getElementById("depositedSlip").files[0].name;
				var form_data = new FormData();
				var ext = name.split('.').pop().toLowerCase();
				if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
					toast('tst_danger', 'Please Provide Valid Image Format');
				}
				var oFReader = new FileReader();
				oFReader.readAsDataURL(document.getElementById("depositedSlip").files[0]);
				var f = document.getElementById("depositedSlip").files[0];
				var fsize = f.size || f.fileSize;
				if (fsize > 2000000) {
					toast('tst_danger', 'Image File Size is very big');
				} else {
					var NwUrl = isCheck('target');
					form_data.append("depositedSlip", document.getElementById('depositedSlip').files[0]);
					form_data.append("depositAmt", depositAmt);
					form_data.append("depositedDate", depositedDate);
					form_data.append("remarks", remarks);
					form_data.append("payMode", isCheck('payMode'));
					$.ajax({
						url: NwUrl,
						method: "POST",
						data: form_data,
						dataType: "json",
						contentType: false,
						cache: false,
						processData: false,
						beforeSend: function() {
							$('#Update').html('<i class="bx bx-cog bx-spin"></i> Please Wait...');
						},
						success: function(dataAmi) {
							$('#proceedDeposit').html('<i class="bx bx-save"></i> Submit');
							if (dataAmi.result == 'tst_success') {
								setTimeout(function() {
									window.location.reload(1);
								});
							}
							toast(dataAmi.result, dataAmi.msg);

						}
					});
				}
			}
		});
		$("#depo_transaction").on("click", ".amInc", function() {
			var actNbtn = $(this).attr('data-id');
			var actnstr = actNbtn.split('-');
			if (actnstr[0] == 'delDepo') {
				$('.delMsg').html('<i class="fa fa-trash"></i> Delete Deposit Details');
				$('.actnData').html('<i class="fa fa-exclamation-triangle"></i> Are you sure want to delete deposited details');
				$('#cnfDel_id').val(actNbtn);
			}
		});

		$("#cnfDelDepoData").click(function() {
			var actNbtn = $('#actnUrl').text();
			var actnstr = actNbtn.split('-');
			var url = isCheckUrl(actnstr[1]);
			$('#cnfDelDepoData').html('<i class="fa fa-spinner rotate"></i> Please Wait.....');

			$.post(url, {
					oprType: actnstr[2]
				},
				function(htmlAmi) {
					$('#cnfDelDepoData').html(' <i class="fa fa-trash"></i> Confirm Delete');
					if (htmlAmi.icon == '1') {
						$(".actnData").html(htmlAmi.msg).fadeIn('slow').css('color', 'green');
						setTimeout(function() {
							window.location.reload(1);
						}, 1500);
					} else {
						$(".actnData").html(htmlAmi.msg).fadeIn('slow').css('color', 'red');
					}
				}, 'json');

		});

	});




	/***********************wallet End********************************/
</script>