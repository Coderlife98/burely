<?php $this->load->view('mlm_software/member/include/login_header') ?>
<body class="menubar-hoverable header-fixed"> <!--menubar-pin menubar-visible-->     
<?php $this->load->view('mlm_software/member/include/top_bar'); ?>
<div id="content">
<section>
<div class="section-body">		
<div class="row">
<div class="col-lg-12">
<!--------------------------------------------->
<div id="loader_con">
	<div class="load_container">
         <div class="wrapper">
            <div class="loader">
               <div class="dot"></div>
            </div>
            <div class="loader">
               <div class="dot"></div>
            </div>
            <div class="loader">
               <div class="dot"></div>
            </div>
            <div class="loader">
               <div class="dot"></div>
            </div>
            <div class="loader">
               <div class="dot"></div>
            </div>
            <div class="loader">
               <div class="dot"></div>
            </div>
         </div>
         <div class="text">
            Please wait
         </div>
      </div>
</div>
<!---------------------------------------------->
<div class="card card-underline" id="cardLoad">
		<div class="card-head ">
				<header class="headerClr"><div style="margin-bottom:-15px;font-weight: bold;"><?php echo $pgTitle;?></div></header>	
					<div class="tools">
						<div class="btn-group">
							<a href="javascript:void(0)" class="btn btn-icon-toggle ink-reaction btn-danger"><i class="fa fa-file-excel-o" style="width:20px"></i></a>
							<a href="javascript:void(0)" class="btn btn-icon-toggle btn-primary"><i class="fa fa-file-pdf-o" style="width:20px"></i></a>
							<a href="javascript:void(0)" class="btn btn-icon-toggle btn-warning"><i class="fa fa-print" style="width:20px"></i></a>	
							<a href="<?php echo $backUrl;?>" class="btn btn-icon-toggle headerClr"><i class="fa fa-arrow-left" style="width:20px"></i></a>
						</div>
					</div>	
		</div>
   <?php if (!empty($layout) && trim($layout) !== ""){$this->load->view($layout);} else { ?>				
	<div class="card-body">
		<div class="col-lg-12 text-center">
			<h2><i class="md md-settings rotate"></i></h2>
			<h1><span class="text-xxxl text-light"> 500 <i class="fa fa-exclamation-circle text-danger"></i></span></h1>
			<h2 class="text-light">Ooooop's ! Something went wrong</h2>
		</div>
	</div>
	<div class="card-footer tpBorder">
		<div class="pull-right amiShareLink" style="padding:0px 20px 10px 0px; "><a href="https://www.facebook.com/amisingh143" target="_blank">Er. @mit Kumar</a></div>
	</div>			
	<?php } ?>			
</div>
</div>			
</div>		





<!----------------------------------->		

</div><!--end .section-body -->
</section>
</div><!--end #content-->
        <?php $this->load->view('mlm_software/member/include/left_bar');?>
		 <?php //$this->load->view('common/top_right');?>
		 <?php $this->load->view('mlm_software/member/include/model_data');?>
		</div>
<?php $this->load->view('mlm_software/member/include/login_footer') ?>