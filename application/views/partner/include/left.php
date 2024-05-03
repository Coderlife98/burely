<?php $this->user_cate=$this->session->userdata('p_cate');?>
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <a href="<?php echo base_url('partner/dashboard'); ?>" class="waves-effect">
                        <i class='bx bxs-dashboard'></i><span key="t-dashboard">Dashboards</span>
                    </a>
                </li>	
				<li>
                    <a href="<?php echo base_url('partner/dashboard/welcome'); ?>" class="waves-effect">
                        <i class='bx bx-detail'></i><span key="t-dashboard">Welcome Letter</span>
                    </a>
                </li>
			<?php //if($this->user_cate=='1'){?>
				<!--<li>
					<a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
						<i class="bx bx-user-pin"></i>
						<span key="t-dashboard">Shopee Manage</span>
					</a>
					<ul class="sub-menu mm-collapse" aria-expanded="false" style="">
						<li><a href="<?php //echo base_url('partner/shopee/create'); ?>"><span key="t-crypto">Add New</span></a></li>
						<li><a href="<?php //echo base_url('partner/shopee'); ?>"><span key="t-calendar">View List</span></a></li>
					</ul>
				</li>-->
			<?php //}?>	
				<li>
					<a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
						<i class="bx bx-basket"></i>
						<span key="t-dashboard">Order Manage</span>
					</a>
					<ul class="sub-menu mm-collapse" aria-expanded="false" style="">
						<li><a href="<?php echo base_url('partner/order'); ?>"><span key="t-calendar">My Orders</span></a></li>
						<li><a href="<?php echo base_url('partner/order/add_kart'); ?>"><span key="t-crypto">Order Now</span></a></li>
					</ul>
				</li>
				
				<li>
                    <a href="<?php echo base_url('partner/stock'); ?>" class="waves-effect">
                        <i class='bx bx-food-menu'></i><span key="t-dashboard">Stock Manage</span>
                    </a>
                </li>
				
				<li>
					<a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
						<i class="bx bxs-shopping-bag-alt"></i>
						<span key="t-dashboard">Package Manage</span>
					</a>
					<ul class="sub-menu mm-collapse" aria-expanded="false" style="">
						<li><a href="<?php echo base_url('partner/package'); ?>"><span key="t-calendar">Purchase Package</span></a></li>
						<li><a href="<?php echo base_url('partner/package/manage'); ?>"><span key="t-crypto">Package list</span></a></li>
					</ul>
				</li>
				
				<li>
					<a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
						<i class="bx bx-money"></i>
						<span key="t-dashboard">Deposit Manage</span>
					</a>
					<ul class="sub-menu mm-collapse" aria-expanded="false" style="">
						<li><a href="<?php echo base_url('partner/deposit/manage'); ?>"><span key="t-calendar">Create Deposit</span></a></li>
						<li><a href="<?php echo base_url('partner/deposit/view'); ?>"><span key="t-crypto">View Deposit</span></a></li>
					</ul>
				</li>
				
				
				
				
				
				<li>
					<a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
						<i class="bx bx-shopping-bag"></i>
						<span key="t-dashboard">Sales Manage</span>
					</a>
					<ul class="sub-menu mm-collapse" aria-expanded="false" style="">
						<li><a href="<?php echo base_url('partner/sale/create'); ?>"><span key="t-crypto">Sale Now</span></a></li>
						
						
						<li><a href="<?php echo base_url('partner/sale'); ?>">
								<span key="t-calendar"><?php if($this->u_cate=='1'){echo 'Shopee Sale List';}else{echo 'Member Sale List';}?></span>
							</a>
						</li>
						<?php 
							  if($this->u_cate=='1')
							  {
								?>
							<li><a href="<?php echo base_url('partner/sale/member'); ?>">
									<span key="t-calendar">Member Sale List</span>
								</a>
							</li>
								<?php }?>
					</ul>
				</li>
				
				<li>
                    <a href="<?php echo base_url('partner/income/transaction'); ?>" class="waves-effect">
                        <i class='bx bx-food-menu'></i><span key="t-dashboard">My Transaction</span>
                    </a>
                </li>
				<li>
					<a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="true">
						<i class="bx bx-book-content"></i>
						<span key="t-dashboard">Earning & Payout</span>
					</a>
					<ul class="sub-menu mm-collapse" aria-expanded="false" style="">
						<li><a href="<?php echo base_url('partner/income'); ?>"><span key="t-crypto">View Earning</span></a></li>
						<li><a href="<?php echo base_url('partner/income/withdraw'); ?>"><span key="t-calendar">Withdraw Payment</span></a></li>
					</ul>
				</li>	
				
				
				
<li>
	<a href="<?php echo base_url('partner/profile'); ?>" class="waves-effect">
		<i class='bx bx-user-circle'></i><span key="t-dashboard">Profile</span>
	</a>
</li>
<li>
	<a href="<?php echo base_url('partner/profile/change_password'); ?>" class="waves-effect">
		<i class='bx bx-cog'></i><span key="t-dashboard">Change Password</span>
	</a>
</li>
<li>
	<a href="<?php echo base_url('partner/login/logout'); ?>" class="waves-effect">
		<i class='mdi mdi-logout'></i><span key="t-dashboard">Logout</span>
	</a>
</li>
				
				
				
				
				
				
				
				
				
				
					
            </ul>
        </div>
    </div>
</div>