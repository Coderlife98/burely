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
<div class="row">
	<div class="col-lg-12">
		<p class="alert alert-danger" role="alert">
			<strong><i class="fas fa-exclamation-triangle"></i> Warning! </strong> <span style="font-size:11.5px;"> Please don't change any setting here until and unless you know what you are doing. Please take support team or developer advice before making any changes at live site.</span>
		</p>
	</div>
	<div class="col-lg-12">
		<!----------------------Ami Advance Settings Start-------------------------------->
		<div class="accordion accordion-flush" id="accordionFlushExample">

			<div class="accordion-item">

				<h2 class="accordion-header" id="company-headingOne">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#company-adv-settings" aria-expanded="false" aria-controls="flush-collapseOne"><span class="miMlmIcn"><i class="mdi mdi-hospital-building advFntClr"></i></span> Company Advance Setting</button>
				</h2>

				<div id="company-adv-settings" class="accordion-collapse collapse" aria-labelledby="company-headingOne" data-bs-parent="#accordionFlushExample">
					<div class="accordion-body">
						<h3 class="card-title mb-4 headingClr"><i class="mdi mdi-factory"></i> MLM Company Setting</h3>
						<!-- Basic Setting Start -->
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<form id="advance_data">
										<div class="row">
											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="RegistrationFree">Is registration is free ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="reg_free" value="1" <?php echo (config_item('mlm_registration_free') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="EnableE-pin">Want to enable e-PIN ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="epin" value="1" <?php echo (config_item('mlm_e-pin') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="MemberRegistration">Stop New Member Registration ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="registration" value="1" <?php echo (config_item('mlm_registration') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="EnableTopup">Want to enable Top-Up Options ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="topup" value="1" <?php echo (config_item('mlm_topup_option') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="TopupIncome">Want to Give Income when Top-Up ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="income" value="1" <?php echo (config_item('mlm_topup_income') == 1) ? "checked" : "" ?>>
												</div>
											</div>


											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="ShowLeg">Want to show Leg Select Option at Sign Up form ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="leg_option" value="1" <?php echo (config_item('mlm_leg_option') == 1) ? "checked" : "" ?>>
												</div>
											</div>


											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="ShowProduct">Want to show Joining Products at Registration form ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="product" value="1" <?php echo (config_item('mlm_joining_product') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="ShowPlacement">Want to show Placement ID Option at Sign Up form ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="placement" value="1" <?php echo (config_item('mlm_placement_id_option') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="FixIncome">Give Fix Income (Not Product/Service Based Income) ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="fix_income" value="1" <?php echo (config_item('mlm_fix_income') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="ProductRegistration">Automatically mark registration products as Delivered ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="delivered" value="1" <?php echo (config_item('mlm_product_delivered') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-6 pt-2">
												<label for="Leg" class="form-label">How Many Leg to Show in Tree ? <span class="text-danger">*</span></label>
												<select class="form-control" name="leg">
													<option value=" ">----Select One----</option>
													<option value="1" <?php echo (config_item('mlm_leg') == 1) ? "selected" : "" ?>>1</option>
													<option value="2" <?php echo (config_item('mlm_leg') == 2) ? "selected" : "" ?>>2</option>
													<option value="3" <?php echo (config_item('mlm_leg') == 3) ? "selected" : "" ?>>3</option>
													<option value="4" <?php echo (config_item('mlm_leg') == 4) ? "selected" : "" ?>>4</option>
													<option value="5" <?php echo (config_item('mlm_leg') == 5) ? "selected" : "" ?>>5</option>
													<option value="6" <?php echo (config_item('mlm_leg') == 6) ? "selected" : "" ?>>6</option>
													<option value="7" <?php echo (config_item('mlm_leg') == 7) ? "selected" : "" ?>>7</option>
													<option value="8" <?php echo (config_item('mlm_leg') == 8) ? "selected" : "" ?>>8</option>
													<option value="9" <?php echo (config_item('mlm_leg') == 9) ? "selected" : "" ?>>9</option>
													<option value="10" <?php echo (config_item('mlm_leg') == 10) ? "selected" : "" ?>>10</option>
												</select>
											</div>

											<div class="col-md-6 pt-2">
												<label for="Leg" class="form-label">Developer Password <span class="text-danger">*</span></label>
												<input type="password" name="dev_pass" class="form-control" placeholder="Enter Developer Password">
											</div>

										</div>
										<div class="col-md-12 pt-2">
											<button type="submit" class="btn btn-outline-primary pull-right" style="margin-top:10px;"><i class="bx bx-save"></i> Update</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Basic Setting End -->
					</div>
				</div>

			</div>

			<div class="accordion-item">

				<h2 class="accordion-header" id="flush-headingTwo">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#enable-disable-module" aria-expanded="false" aria-controls="enable-disable-module"><span class="miMlmIcn"><i class="fas fa-adjust advFntClr"></i></span> Enable/Disable Module </button>
				</h2>

				<div id="enable-disable-module" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
					<div class="accordion-body">
						<h3 class="card-title mb-4 headingClr"><i class="mdi mdi-gamepad-up"></i> Setting Enable/Disable</h3>
						<!-- Payout Setting Start -->
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<form id="module_data">
										<div class="row">

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="EnableSurvey">Enable Survey ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="survey" value="1" <?php echo (config_item('mlm_survey_module') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="EnableCoupon">Enable Coupon ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="coupon" value="1" <?php echo (config_item('mlm_coupon_module') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="InvestmentType">Investment Type ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="investment" value="1" <?php echo (config_item('mlm_investment_module') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="InvestmentPlan">Enable Investment Plan ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="investment_plan" value="1" <?php echo (config_item('mlm_investment_plan_module') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="RewardsModule">Enable Rewards Module?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="rewards" value="1" <?php echo (config_item('mlm_rewards_module') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="RechargeModule">Enable Recharge Module ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="recharge" value="1" <?php echo (config_item('mlm_recharge_module') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="Product&Service">Enable Product & Services ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="product" value="1" <?php echo (config_item('mlm_product_module') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="RepurchaseSystem">Enable Repurchase System ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="repurchase" value="1" <?php echo (config_item('mlm_repurchase_module') == 1) ? "checked" : "" ?>>
												</div>
											</div>

											<div class="col-md-11 pt-2">
												<label class="form-check-label" for="EnableAdvertisement">Enable Advertisement Income ?</label>
											</div>
											<div class="col-md-1 pt-2">
												<div class="form-check form-switch form-switch-lg mb-lg-3" dir="ltr">
													<input class="form-check-input" type="checkbox" name="advertisement" value="1" <?php echo (config_item('mlm_advertisment_module') == 1) ? "checked" : "" ?>>
												</div>
											</div>


											<div class="col-md-6 pt-2">
												<label for="Leg" class="form-label">Developer Password <span class="text-danger">*</span></label>
												<input type="password" name="dev_pass" class="form-control" placeholder="Enter Developer Password">
											</div>
										</div>
										<div class="col-md-12 pt-2">
											<button type="submit" class="btn btn-outline-primary pull-right" style="margin-top:10px;"><i class="bx bx-save"></i> Update</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Payout Setting End -->
					</div>
				</div>

			</div>
<!-----------------Rank Manage Start-------------------->
			<!--<div class="accordion-item">
				<h2 class="accordion-header" id="flush-headingThree">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree"><span class="miMlmIcn"><i class="fas fa-chess-king advFntClr"></i> </span>Rank Manage </button>
				</h2>
				<div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
					<div class="accordion-body">
						<h3 class="card-title mb-4 headingClr rankManage"><i class="mdi mdi-clipboard-list-outline"></i> Membership Rank List For Permanant/Temprory Member</h3>
						
						<div class="table-responsive" id="listTbl">
							<div id="search_data">
								<table id="temp_reward_table" class="table align-middle table-striped table-nowrap mb-0">
									<thead class="header-green">
										<tr>
											<th>S No.</th>
											<th> Membership Name</th>
											<th>Member Goal</th>
											<th>Income</th>
											<th>Other Rewards</th>
											<th> Monthly Rewards</th>
											<th> Type</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($rank_list) {
											$ct = 0;
											foreach ($rank_list as $list) {
												$ct++;
												if ($list['monthly_income'] != 0.00) {
													$monthly = '<i class="bx bx-rupee fntClr"></i> ' . $list['monthly_income'];
												} else {
													$monthly = 'N/A';
												}
												if ($list['other_reward'] == '0') {
													$otherRewards = 'N/A';
												} else if ($list['other_reward'] !== 'false') {
													$otherRewards = '<i class="bx bx-gift fntClr"></i> ' . $list['other_reward'];
												} else {
													$otherRewards = 'N/A';
												}
												if ($list['member_goal'] != 0) {
													$member_goal = $list['member_goal'];
												} else {
													$member_goal = 'N/A';
												}
												if ($list['income'] != 0) {
													$income = $list['income'] . ' <i class="mdi mdi-percent-outline fntClr"></i> ';
												} else {
													$income = 'N/A';
												}
												if ($list['membership_type'] == '1') {
													$mType = 'Permanent';
												} else {
													$mType = 'Temporary';
												}
										?>
												<tr>
													<th><?php echo $ct; ?>.</th>
													<td id="re-<?php echo $list['id']; ?>"><?php echo $list['reward_name']; ?></td>
													<td id="mg-<?php echo $list['id']; ?>"><?php echo $member_goal; ?></td>
													<td id="ic-<?php echo $list['id']; ?>"><?php echo $income; ?></td>
													<td id="othR-<?php echo $list['id']; ?>"><?php echo $otherRewards; ?></td>
													<td id="mn-<?php echo $list['id']; ?>"><?php echo $monthly; ?></td>
													<td id="mntype-<?php echo $list['id']; ?>"><?php echo $mType; ?></td>
													<td class=""><span class="actnCmd edtBtn " data-id="eRank--<?php echo $list['id']; ?>"><i class="mdi mdi-comment-edit-outline "></i> Edit</span></td>
												</tr>
											<?php }
										} else { ?>
											<tr>
												<td colspan="7" style="text-align:center;text-transform: uppercase;color: #a42f01;"><i class="mdi mdi-flask-empty-outline"></i> Ooop's There is no data availble</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div id="editSect" style="display:none;">
							<div id="dataMsg" style="display:none;">&nbsp;</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<input type="text" name="rankName" class="form-control flatpickr-input active" id="rankName">
										<label for="rankName" style="margin-left:-7px;"><i class="bx bxs-user-badge fntClr"></i> Rank Name</label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<input type="text" name="memberGoal" class="form-control flatpickr-input active" id="memberGoal">
										<label for="memberGoal"><i class="mdi mdi-shopping fntClr"></i> Member Goal </label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3"><input type="text" name="income" id="income" class="form-control" maxlength="8">
										<label for="userId"><i class="mdi mdi-percent-outline fntClr"></i> Income <span class="text-danger">*</span></label>
									</div>
								</div>


								<div class="col-lg-6">
									<div class="form-floating mb-3"><input type="text" name="otherIncome" id="otherIncome" class="form-control" maxlength="8">
										<label for="otherIncome"><i class="bx bx-gift fntClr"></i> Other Rewards </label>
									</div>
								</div>

								<div class="col-lg-6">
									<div class="form-floating mb-3"><input type="text" name="monthlyReward" id="monthlyReward" class="form-control" maxlength="8">
										<label for="monthlyReward"><i class="bx bx-rupee fntClr"></i> Monthly Rewards </label>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-floating mb-3">
										<select class="form-select" name="membershipTyp" id="membershipTyp">
											<option value="">Select One</option>
											<option value="0">Temporary</option>
											<option value="1">Permanent</option>
										</select>
										<label for="membershipTyp"><i class="bx bx-user-pin fntClr"></i> Membership Type <span class="text-danger">*</span></label>
									</div>
								</div>



								<input type="hidden" id="id">
							</div>
							<div class="card-footer">
								<span class="btn btn-outline-dark actnCmd" data-id="eR_back--0"><i class="bx bx-arrow-back"></i> Back</span>
								<button type="button" class="btn btn-outline-primary ActnCmdByAmi" id="edtRnkDet" style="float:right;"><i class="bx bx-save"></i> Update </button>
							</div>
						</div>
						
					</div>
				</div>
			</div>-->
<!-----------------Rank Manage End---------------------->
			<div class="accordion-item">
				<h2 class="accordion-header" id="incDevelopmentManage-heading">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#incDevelopmentManage" aria-expanded="flase" aria-controls="incDevelopmentManage">
						<span class="miMlmIcn"><i class="bx bx-rupee advFntClr"></i> </span> Miscellaneous Income Manage</button>
				</h2>
				<div id="incDevelopmentManage" class="accordion-collapse collapse " aria-labelledby="incDevelopmentManage-heading" data-bs-parent="#accordionFlushExample">
					<div class="accordion-body">
						<h3 class="card-title mb-4 headingClr"><i class="mdi mdi-wallet-outline"></i> Income Manage List Of Miscellaneous </h3>
						<!-- miscelniuos Setting Start -->
						<div class="col-lg-12">
							<div id="search_data1">

								<?php //print_r($getFunds);
								?>
								<!--<div id="incMember1">Hello</div> -->
								<table class="table align-middle table-striped table-nowrap mb-0">
									<thead class="header-green">
										<tr>
											<th>S No.</th>
											<th> Miscellaneous Income Type</th>
											<th><i class="mdi mdi-percent-outline"></i> Income</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th>1.</th>
											<td>Admin Fee</td>
											<td id="admfee"><?php echo $getFunds['admin_fee']; ?></td>
										</tr>
										<tr>
											<th>2.</th>
											<td>Tax Deduction</td>
											<td id="cw_f"><?php echo $getFunds['tax']; ?></td>
										</tr>
										<tr>
											<th>3.</th>
											<td>Withdrawable Limit <span style="float:right;"><i class="bx bx-rupee fntClr"></i></span></td>
											<td id="gdwf"><?php echo $getFunds['withdrableAmt']; ?></td>
										</tr>
										<tr>
											<th>4.</th>
											<td>Shipping Charges <span style="float:right;"><i class="bx bx-rupee fntClr"></i></span></td>
											<td id="shipIn"><?php echo $getFunds['shipping_charges']; ?></td>
										</tr>
										
										<tr>
											<th>5.</th>
											<td>Sponsor Income</td>
											<td id="sponsorInc"><?php echo $getFunds['sponsor_income']; ?></td>
										</tr>
										
										
										
										
										
										<tr>
											<th>6.</th>
											<td>Testing Income purpose</td>
											<td id="devclb"><?php //echo $getFunds['dev_fund']; ?></td>
										</tr>
										<tr>
											<th>&nbsp;</th>
											<td colspan="2">
												<table class="table table-striped getStrip align-middle table-nowrap mb-0" id="setTble" style="width:100%;">
													<tbody>
														<tr>
															<th>1.</th>
															<td>1<sup>st.</sup> Level </td>
															<td id="actMsal"> <?php echo $getFunds['first_repurchase']; ?> </td>
														</tr>
														<tr>
															<th>2.</th>
															<td>2<sup>nd</sup> Level</td>
															<td id="inMsal"> <?php echo $getFunds['scnd_repurchase']; ?> </td>
														</tr>
														<tr>
															<th>3.</th>
															<td>3<sup>rd</sup> Level</td>
															<td id="penF"> <?php echo $getFunds['thrd_repurchase']; ?> </td>
														</tr>
														<tr>
															<th>4.</th>
															<td>4<sup>th</sup> Level</td>
															<td id="maF"><?php echo $getFunds['forth_repurchase']; ?> </td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>

										<tr>
											<th>7.</th>
											<td>Generation Income</td>
											<td id="generation_income"><?php echo $getFunds['generation_income']; ?></td>
										</tr>
										<tr>
											<th>&nbsp;</th>
											<td colspan="2">
												<table class="table table-striped getStrip align-middle table-nowrap mb-0" id="setgen" style="width:99%">
													<tbody>
														
														
														
														<tr>
															<th>1.</th>
															<td>1<sup>st</sup> Level</td>
															<td id="first_gen_incom"> <?php echo $getFunds['first_gen_incom']; ?> </td>
														</tr>
														<tr>
															<th>2.</th>
															<td>2<sup>nd</sup> Level</td>
															<td id="second_gen_incom"> <?php echo $getFunds['second_gen_incom']; ?> </td>
														</tr>
														<tr>
															<th>3.</th>
															<td>3<sup>rd</sup> Level </td>
															<td id="third_gen_incom"> <?php echo $getFunds['third_gen_incom']; ?> </td>
														</tr>
														<tr>
															<th>4.</th>
															<td>4<sup>th</sup> Level</td>
															<td id="four_gen_incom"><?php echo $getFunds['four_gen_incom']; ?> </td>
														</tr>
														
													</tbody>
												</table>
											</td>
										</tr>

										<tr>
											<th>8.</th>
											<td>Repurchase Income</td>
											<td id="repurchase_incom"><?php echo $getFunds['repurchase_incom']; ?></td>
										</tr>
										<tr>
											<th>&nbsp;</th>
											<td colspan="2">
												<table class="table table-striped getStrip align-middle table-nowrap mb-0" id="reit"  style="width:99%">
													<tbody>
														<tr>
															<th>1.</th>
															<td>1<sup>st</sup> Level</td>
															<td id="first_repurchase_incom"> <?php echo $getFunds['first_repurchase_incom']; ?> </td>
														</tr>
														<tr>
															<th>2.</th>
															<td>2<sup>nd</sup> Level</td>
															<td id="second_repurchase_incom"> <?php echo $getFunds['second_repurchase_incom']; ?> </td>
														</tr>
														<tr>
															<th>3.</th>
															<td>3<sup>rd</sup> Level</td>
															<td id="third_repurchase_incom"> <?php echo $getFunds['third_repurchase_incom']; ?> </td>
														</tr>
														<tr>
															<th>4.</th>
															<td>4<sup>th</sup> Level</td>
															<td id="four_repurchase_incom"><?php echo $getFunds['four_repurchase_incom']; ?> </td>
														</tr>
														
													</tbody>
												</table>
											</td>
										</tr>


										<tr>
											<td colspan="3" id="edtIncActn">
												<span class="edtBtn btnIncR" onclick="incManage(1)"><i class="mdi mdi-comment-edit-outline "></i> Edit</span>
											</td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
						<!-- miscelniuos Setting End -->
					</div>
				</div>
			</div>






		</div>
		<!----------------------Ami Advance Settings End-------------------------------->
	</div>
</div>



<!-- end page title -->
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
<script src="<?php echo base_url() ?>media/js/super_admin/mlm_software/setting.js"></script>