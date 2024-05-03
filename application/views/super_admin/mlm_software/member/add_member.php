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
<div class="card">
   <form id="save_data" method="post">
<?php //echo config_item('mlm_leg_option');?>
<div class="card-header header-green"><i class="mdi mdi-account-circle-outline"></i> Basic Information</div>
    <div class="card-body">
            <div class="row">
               
			  <!--xyz -->
			  
			   <div class="col-lg-6">
				<div class="form-floating mb-3">
					<select class="form-select" name="gender" id="gender" >
						<option value="">--- Select One ---</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
					 <label for="gender">Gender. <span class="text-danger">*</span></label>
				</div>
			</div>
			   
			    <div class="col-lg-6">
                    <div class="form-floating mb-3">
                         <input type="text" class="form-control" name="name" value="<?php set_value('name') ?>">
						<label for="Name" class="form-label">Member Name <span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-floating mb-3">
                       <input type="text" class="form-control" name="mobile" value="<?php set_value('mobile') ?>" oninput="this.value = this.value.replace(/[^0-9]/g,'').replace(/(\  *?)\  */g, '$1');" maxlength="10">
					    <label for="Mobile" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" value="<?php set_value('email') ?>">
						<label for="Email" class="form-label">Email <span class="text-danger">*</span></label>
                    </div>
                </div>    
          </div>
    </div>
<div class="card-header header-green"><i class="mdi mdi-home-outline"></i> Address Information</div>	
 <div class="card-body">
 	<div class="row">
		<div class="col-lg-12">
			<div class="form-floating mb-3">
			   <textarea class="form-control" name="address"><?php set_value('address') ?></textarea>
			   <label for="Address" class="form-label">Address <span class="text-danger">*</span></label>	
			</div>
		</div>
		
	<div class="col-lg-4">
			<div class="form-floating mb-3">
			   <select class="form-select empSelectR select2" name="state" id="state">
					<option value="">--- Select One ---</option>
		<?php if($getState)
				{
					foreach($getState as $list)
					{
			  ?>
		<option value="<?php echo $list->id;?>" <?php if($list->id==$getEmpDetails['state']){ echo 'selected="selected"';}?>><?php echo $list->state_cities;?></option>
			<?php }}?>
				</select>
				<label for="state">State <span class="text-danger">*</span></label>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-floating mb-3">
			  <select class="form-select" name="district" id="district" >
			  <option value="">--- Select One ---</option>
			  <?php if($getCity)
				{
					foreach($getCity as $c_list)
					{
					?>
			<option value="<?php echo $c_list->id;?>" <?php if($c_list->id==$getEmpDetails['district']){ echo 'selected="selected"';}?>><?php echo $c_list->state_cities;?></option>
			<?php }}?>
				</select>
				<label for="district">District</label>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-floating mb-3">
				<input type="text" value="<?php set_value('zipcode'); ?>"  class="form-control" id="zipcode" name="zipcode">
				<label for="zipcode">Zipcode.<span class="text-danger">*</span></label>
			</div>
		</div>
   </div>
</div>
<div class="card-header header-green"><i class="mdi mdi-account-circle-outline"></i> Joining Information</div>	
 <div class="card-body">
 	<div class="row">
	  <div class="col-lg-4">
		<div class="form-floating mb-3">  
		   <input type="text" class="form-control getKeyUp" name="sponsor" id="sponsor" value="<?php if(base64_decode(urldecode($sponser))){echo base64_decode(urldecode($sponser));}else if(set_value('sponsor')){echo set_value('sponsor');} ?>" oninput="this.value = this.value.replace(/[^0-9]/g,'').replace(/(\  *?)\  */g, '$1');" maxlength="6"> 
		   
		  
		   	<label for="Sponsor" class="form-label">Sponsor ID <span class="text-danger">*</span> </label>
		    <span id="spId" class="miMemErr">&nbsp;</span>
		</div>
	</div>
      <div class="col-lg-4">
	<div class="form-floating mb-3">
		<input type="text" class="form-control getKeyUp" name="placement" id="placement" value="<?php if(base64_decode(urldecode($sponser))){echo base64_decode(urldecode($sponser));}else if(set_value('placement')){echo set_value('placement');} ?>" oninput="this.value = this.value.replace(/[^0-9]/g,'').replace(/(\  *?)\  */g, '$1');" maxlength="6"><label for="Placement" class="form-label">Placement ID <span class="text-danger">*</span></label>
		 <span id="plcmntId" class="miMemErr">&nbsp;</span>
	</div>
</div>	
	  <div class="col-lg-4">
		<div class="form-floating mb-3">
		   <select class="form-select" name="placement_leg" >
				<option value="">--- Select One ---</option>
				<option>A</option>
				<option>B</option>
				<option>C</option>
				<option>D</option>
			</select>
		 <label for="Password" class="form-label">Placement Leg <span class="text-danger">*</span></label>
		</div>
	</div>
	</div>
  </div>
	
 <div class="card-header header-green"><i class="bx bx-cog"></i> Security Information</div>	
 <div class="card-body">
 	<div class="row">
	  	<div class="col-lg-6">
			<div class="form-floating mb-3">
				<input type="password" class="form-control" name="password" value="<?php set_value('password') ?>">
				<label for="Password" class="form-label">Password <span class="text-danger">*</span></label>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-floating mb-3">
				<input type="password" class="form-control" name="confirm_password" value="<?php set_value('confirm_password') ?>">
				<label for="Confirm Password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
			</div>
		</div>
 	</div>
 
 </div>
<a href="<?php echo base_url().'super_admin/mlm_software/member/member_list';?>" class="btn btn-outline-dark  waves-effect waves-light" style="margin-left:20px;"><i class="bx bx-arrow-back"></i> Back</a>
 <button class="btn btn-outline-primary waves-effect waves-light pull-right" style="margin:0px 20px 20px 0px;" type="submit"><i class="bx bx-save"></i> Submit</button>

 </form>	
</div>

<script src="<?php echo base_url() ?>media/js/super_admin/mlm_software/member.js"></script>
