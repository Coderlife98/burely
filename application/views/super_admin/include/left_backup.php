<?php $this->user_cate=$this->session->userdata('user_cate');?>
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <a href="<?php echo base_url(); ?>super_admin/dashboard" class="waves-effect">
                        <i class='bx bxs-dashboard'></i>
                        <span key="t-dashboard">Dashboards</span>
                    </a>
                </li>
<?php if($this->session->userdata('user_cate')=='1'){?>
<!-- MLM Software Admin Section Start Here -->
                <li><a href="javascript: void(0);" class="has-arrow waves-effect"><i class='bx bx-cog'></i><span key="t-apps"> Software Settings</span></a>
                    <ul class="sub-menu" aria-expanded="false">
					<li><a href="<?php echo base_url('super_admin/setting/basic_setting'); ?>"><span>Basic Setting</span></a></li>
					<li><a href="<?php echo base_url('super_admin/setting/unit_manage'); ?>"><span>Unit Manage</span></a></li>
					<li><a href="<?php echo base_url('super_admin/setting/category_manage'); ?>"><span>Category Manage</span></a></li>
					<li><a href="<?php echo base_url('super_admin/setting/package'); ?>">Package Setting</a></li> 
					</ul>
                </li>
                <li class="menu-title mt-3" key="t-adminkit">MLM Software</li>
                <li><a href="javascript: void(0);" class="has-arrow waves-effect"><i class='bx bx-sitemap'></i><span key="t-authentication">MLM Software Setting</span></a>
                   <ul class="sub-menu" aria-expanded="false">
                      <li><a href="<?php echo base_url('super_admin/mlm_software/setting/basic_setting'); ?>" key="t-login"> Basic Setting</a></li>
                      <li><a href="<?php echo base_url('super_admin/mlm_software/setting/advance_setting'); ?>" key="t-login">Advance Setting</a></li>
					  <li><a href="<?php echo base_url('super_admin/mlm_software/setting/designation'); ?>">Designation Setting</a></li> 
					  
                    </ul>
                </li>
				
				<!--<li><a href="javascript: void(0);" class="has-arrow waves-effect"><i class='bx bx-folder-open'></i><span key="t-authentication">MSDR Ladger </span></a>
                   <ul class="sub-menu" aria-expanded="false">
                      <li><a href="<?php echo base_url('super_admin/mlm_software/ledger/manage'); ?>" key="t-login"> View Ledger</a></li>
                     
                    </ul>
                </li>
				
				-->
				
				
				
				
				
				
<!-- MLM Software Admin Section End Here -->
<?php }
if($this->session->userdata('user_cate')=='1' || $this->session->userdata('user_cate')=='2'){ ?>
<!--<li><a href="javascript: void(0);" class="has-arrow waves-effect"><i class='bx bxs-user-rectangle'></i><span key="t-authentication">MLM Employee</span></a>
	<ul class="sub-menu" aria-expanded="false">
	    <li><a href="<?php echo base_url('mlm_software/admin/employee/add'); ?>">Add New</a></li>
		<li><a href="<?php echo base_url('mlm_software/admin/employee/manage'); ?>">Manage List</a></li>
		<li><a href="<?php echo base_url('mlm_software/admin/salary/pay'); ?>">Pay Salary</a></li>
	</ul>
</li>-->
<?php }?>
<!---------------------------------------->
 	
<li><a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-money"></i><span key="t-Ewallet">Manage Partners</span></a>
	<ul class="sub-menu" aria-expanded="false"><li> <a href="<?php echo base_url('mlm_software/admin/partners/manage'); ?>" key="t-login"> Add New </a></li>
		<li><a href="<?php echo base_url('mlm_software/admin/partners/shopee'); ?>" key="t-login"> Shopee List</a></li>	
		<li><a href="<?php echo base_url('mlm_software/admin/partners/frenchise'); ?>" key="t-login"> Frenchise List</a></li>	
	</ul>
</li>
<li><a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-book-content"></i><span key="t-Ewallet">Manage Product</span></a>
	<ul class="sub-menu" aria-expanded="false"><li> <a href="<?php echo base_url('mlm_software/admin/product/manage'); ?>" key="t-login"> View Product </a></li>
		<li><a href="<?php echo base_url('mlm_software/admin/product/viewDetails'); ?>" key="t-login"> Product Details List</a></li>	
	</ul>
</li>

<li><a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-book-content"></i><span key="t-Ewallet">Manage Member</span></a>
	<ul class="sub-menu" aria-expanded="false"><li> <a href="<?php echo base_url('mlm_software/admin/product/manage'); ?>" key="t-login"> View Product </a></li>
		<li><a href="<?php echo base_url('mlm_software/admin/product/viewDetails'); ?>" key="t-login"> Product Details List</a></li>	
	</ul>
</li>

	
	
	
	
		
	
	
<!--	<li>
		<a href="<?php echo base_url('mlm_software/admin/payout');?>"class="waves-effect"><i class="mdi mdi-account-box-outline"></i><span key="t-payout"> Manage Payout</span></a>		    </li>-->		
            </ul>
        </div>
    </div>
</div>