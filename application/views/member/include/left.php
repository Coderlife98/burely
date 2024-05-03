<?php $this->user_cate = $this->session->userdata('user_cate'); ?>
<div class="vertical-menu">
	<div data-simplebar class="h-100">
		<!--- Sidemenu -->
		<div id="sidebar-menu">
			<!-- Left Menu Start -->
			<ul class="metismenu list-unstyled" id="side-menu">
				<li class="menu-title" key="t-menu">Menu</li>
				<li>
					<a href="<?php echo base_url(); ?>member/dashboard" class="waves-effect">
						<i class='bx bxs-dashboard'></i>
						<span key="t-dashboard">Dashboards</span>
					</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>member/dashboard/welcome" class="waves-effect">
						<i class='bx bx-detail'></i>
						<span key="t-dashboard">Welcome Letter</span>
					</a>
				</li>
				<li><a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-wallet-alt"></i><span key="t-Diposit">e-Wallet Manage</span></a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="<?php echo base_url('member/wallet/'); ?>" key="t-login"> My wallet</a></li>
						<li><a href="<?php echo base_url('member/wallet/manage'); ?>" key="t-login">Request for Topup Wallet</a></li>
						

					</ul>
				</li>



				<li><a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-sitemap"></i><span key="t-Ewallet">Manage Subscriber</span></a>
					<ul class="sub-menu" aria-expanded="false">

						<li><a href="<?php echo base_url('member/subscriber/view/active'); ?>" key="t-login"> Active List</a></li>
						<li><a href="<?php echo base_url('member/subscriber/view/deactive'); ?>" key="t-login"> Deactive List</a></li>
						<li><a href="<?php echo base_url('member/subscriber/view'); ?>" key="t-login"> View All Downline</a></li>
						<li> <a href="<?php echo base_url('member/subscriber/downline'); ?>" key="t-login"> My DownLine Tree</a></li>

					</ul>
				</li>
				<li><a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-book-content"></i><span key="t-Ewallet">Earning & Payout</span></a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="<?php echo base_url('member/income/manage/' . urlencode(base64_encode('spInc'))); ?>" key="t-level-2-2">Sponsor Income</a></li>
						<li><a href="<?php echo base_url('member/income/manage/' . urlencode(base64_encode('genInc'))); ?>" key="t-level-2-2">Generation Income</a></li>
					</ul>
				</li>

				<!-- <li><a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-store"></i><span key="t-Ewallet">Earning & Payout Club</span></a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="<?php echo base_url('member/income/manage/' . urlencode(base64_encode('stcInc'))); ?>" key="t-level-2-2">Star Club Income</a></li>
						<li><a href="<?php echo base_url('member/income/manage/' . urlencode(base64_encode('gstcInc'))); ?>" key="t-level-2-2">Gold Star Club</a></li>
						<li><a href="<?php echo base_url('member/income/manage/' . urlencode(base64_encode('mstcInc'))); ?>" key="t-level-2-2">MSDR Star Club</a></li>
						<li><a href="<?php echo base_url('member/income/manage/' . urlencode(base64_encode('msstcInc'))); ?>" key="t-level-2-2">MSDR Super Star Club</a></li>
					</ul>
				</li> -->
				<!-- <li>
					<a href="<?php echo base_url('member/income/manage/' . urlencode(base64_encode('tlrInc'))); ?>" class="waves-effect">
						<i class='bx bx-crown'></i>
						<span key="t-dashboard">Top Level Royalty</span>
					</a>
				</li> -->

				<!-- <li><a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-book-content"></i><span key="t-Ewallet">Earning & Payout Funds</span></a>
					<ul class="sub-menu" aria-expanded="false">
						<li><a href="<?php echo base_url('member/income/manage/' . urlencode(base64_encode('bkfInc'))); ?>" key="t-level-2-2">Bike Fund Income</a></li>
						<li><a href="<?php echo base_url('member/income/manage/' . urlencode(base64_encode('crfInc'))); ?>" key="t-level-2-2">Car Fund Income</a></li>
						<li><a href="<?php echo base_url('member/income/manage/' . urlencode(base64_encode('hfInc'))); ?>" key="t-level-2-2">House Fund Income</a></li>
						<li><a href="<?php echo base_url('member/income/manage/' . urlencode(base64_encode('repInc'))); ?>" key="t-level-2-2">Tour Fund</a></li>
					</ul>
				</li> -->
				<li>
					<a href="<?php echo base_url('member/income/manage/' . urlencode(base64_encode('repInc'))); ?>" class="waves-effect">
						<i class='bx bx-shopping-bag'></i>
						<span key="t-dashboard">Repurchase Income</span>
					</a>
				</li>


				<li>
					<a href="<?php echo base_url('member/income'); ?>" class="waves-effect">
						<i class='mdi mdi-cash-multiple'></i>
						<span key="t-dashboard">View All Income</span>
					</a>
				</li>

				<li>
					<a href="<?php echo base_url('member/income/transaction'); ?>" class="waves-effect">
						<i class='bx bx-briefcase-alt-2'></i>
						<span key="t-dashboard">My Transaction</span>
					</a>
				</li>

				<li>
					<a href="<?php echo base_url('member/income/reward'); ?>" class="waves-effect">
						<i class='bx bx-gift'></i>
						<span key="t-dashboard">Earn Rewards</span>
					</a>
				</li>
				<li>
					<a href="<?php echo base_url('member/income/withdraw'); ?>" class="waves-effect">
						<i class='mdi mdi-cash-multiple'></i>
						<span key="t-dashboard"> Withdraw Payment</span>
					</a>
				</li>


				<li><a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-shopping-bag"></i><span key="t-Ewallet">Manage Order</span></a>
					<ul class="sub-menu" aria-expanded="false">
						<li> <a href="<?php echo base_url('member/order'); ?>" key="t-login"> My orders </a></li>
						<li><a href="<?php echo base_url('member/order/add_kart'); ?>" key="t-login"> Order Now </a></li>
					</ul>
				</li>

				<li>
					<a href="<?php echo base_url('member/profile'); ?>" class="waves-effect">
						<i class='bx bx-user-circle'></i><span key="t-dashboard">Profile</span>
					</a>
				</li>
				<li>
					<a href="<?php echo base_url('member/dashboard/id_card'); ?>" class="waves-effect">
						<i class='bx bx-id-card'></i><span key="t-dashboard">I Card</span>
					</a>
				</li>

				<!--<li><a href="<?php echo base_url('member/profile/change_password'); ?>" class="waves-effect">
		<i class='bx bx-cog'></i><span key="t-dashboard">Change Password</span>
	</a>
</li>-->
				<li>
					<a href="<?php echo base_url('member/login/logout'); ?>" class="waves-effect">
						<i class='mdi mdi-logout'></i><span key="t-dashboard">Logout</span>
					</a>
				</li>







				<!--<li>
		<a href="<?php echo base_url('member/demo'); ?>"class="waves-effect">
			<i class="mdi mdi-account-box-outline"></i><span key="t-payout"> Testing Panel</span>
	    </a>		
	</li>
-->

				<!--


	-->






				<!--	<li>
		<a href="<?php echo base_url('mlm_software/admin/payout'); ?>"class="waves-effect"><i class="mdi mdi-account-box-outline"></i><span key="t-payout"> Manage Payout</span></a>		    </li>-->
			</ul>
		</div>
	</div>
</div>