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
  <div class="col-12 mitbl">
			<i class="bx bx-crown miU"></i> Search Category Details
			<span><a  href="javascript:void(0)"id="addCategory" class="miGrtitle" title="Add New"><i class="bx bx-plus"></i></a></span>
     </div>
	<div class="card-body">
	<form method="post" id="search_category">
		<div class="col-xl-12">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-floating mb-3">
						<input type="text" name="category_na" id="category_na" value="" class="form-control">
						<label for="designation"><i class="bx bxs-crown fntClr"></i> Category Name </label>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-floating mb-3">
						<select class="form-select" name="actnType" id="actnType">
							<option value="">---- Select One ----</option>
							<option value="all">ALL</option>
							<option value="Active">Active</option>
							<option value="Deactive">Deactive</option>
						</select>
						<label for="unitSts"><i class="bx bx-transfer fntClr"></i> Status </label>
					</div>
				</div>	
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-floating mb-3">
						<input type="date" name="strtDt" id="strtDt" value="" class="form-control">
						<label for="strtDt"><i class="mdi mdi-calendar-account fntClr"></i> Join Start Date </label>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-floating mb-3">
						<input type="date" name="endDt" id="endDt" value="" class="form-control">
						<label for="endDt"><i class="mdi mdi-calendar-account fntClr"></i> Join End Date </label>
					</div>
				</div>
			</div>
		   <a href="<?php echo base_url(); ?>mlm_software/admin/employee/manage" class="btn btn-outline-dark  waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
		  <button type="submit" class="btn cstm_btn pull-right" onclick="return get_search(repCatManage,'#search_category','#category_detbl')">
		  <i class="mdi mdi-account-search"></i> Search</button>		  
	    </div>	
     </form>
	</div>
</div>
<div class="card">
    <div class="card-body">
	<?php //echo $this->db->last_query().'<br>';print_r($getDetails);?>	
<!-------------------------------------------->
<div class="modal fade" id="manage_category" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalToggleLabel"><i class="bx bx-crown miIcn"></i><span class="pgTitle">Add New</span></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div> <input type="hidden" id="py_id"><input type="hidden" id="miActn" value="edit">
					<input type="hidden" id="miCtdt" value="1">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
							
							<?php //print_r($getMainCat);?>
							
							<div id="getMsgSuccess" style="display:none;">&nbsp;</div></div>	
							 	<div class="col-lg-6">
										 <input type="radio" name="category_typ" id="catIds1" class="amiRadi" value="1" checked="checked">
										<label for="cat_type"> Main Category <span class="text-danger">*</span></label>
								</div>
								<div class="col-lg-6">
										<input type="radio" name="category_typ" id="catIds2" class="amiRadi" value="2">
										<label for="cat_type"> Sub Category <span class="text-danger">*</span></label>
								</div>
								<div class="col-lg-12" id="mnCt" style="display:none;">
									<div class="form-floating mb-3">
									<select class="form-select" name="main_cat" id="main_cat">
										<option value="">---- Select One ----</option>
										<?php if($getMainCat)
										{
											foreach($getMainCat as $cList)
											{
											?>
										<option value="<?php echo $cList->id;?>"><?php echo $cList->category;?></option>
										<?php }}?>
									</select>	
									<label for="main_cat"><i class="bx bx-user-pin fntClr"></i> Main Category</label>
								</div>
								</div>
								
								<div class="col-lg-12">
									<div class="form-floating mb-3">
										 <input type="text" id="cat_name" class="form-control">
										<label for="cat_name"><i class="bx bxs-crown fntClr"></i> <span id="nmCat">Category Name</span> <span class="text-danger">*</span></label>
									</div>
								</div>  
						<?php if($this->lgCat=='1'){?>	
						        <div class="col-lg-6 createB">
									<div class="form-floating mb-3" >
										 <span class="form-control miCrt" id="createBy">&nbsp;</span>
										<label for="createBy" ><i class="bx bxs-user fntClr"></i> Created By  </label>
									</div>
								</div>
							    <div class="col-lg-6 createB">
									<div class="form-floating mb-3">
										 <span class="form-control miCrt" id="createDt">&nbsp;</span>
										<label for="createDt"><i class="mdi mdi-calendar-account fntClr"></i> Create Date  </label>
									</div>
								</div>
								<div class="col-lg-6 mdfy">
									<div class="form-floating mb-3">
										 <span class="form-control miDfy" id="modifiedBy">&nbsp;</span>
										<label for="modifiedBy"><i class="bx bxs-user fntClr"></i> Modified By  </label>
									</div>
								</div>
								<div class="col-lg-6 mdfy">
									<div class="form-floating mb-3">
										 <span class="form-control miDfy" id="modifyDt">&nbsp;</span>
										<label for="modifyDt"><i class="mdi mdi-calendar-account fntClr"></i> Modified Date  </label>
									</div>
								</div>
							<?php }?>	
						</div>
					</div>
					<div class="modal-footer">
						<span class="btn btn-outline-dark" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-arrow-back"></i> Back</span>
						<button class="btn btn-outline-primary ActnCmdByAmi" id="proceedCat"><i class="bx bx-save"></i> Update</button>
					</div>
				</div>
			</div>
	</div>	
<!-------------------------------------------->	
	<div class="table-responsive">
		<div id="search_data">  
		<table class="table align-middle table-striped table-nowrap mb-0" id="category_detbl">
		<thead class="hdr_clr">
			<tr>
				<th>S.No</th>
				<th>Category Id</th>
				<th>Category Name</th>
				<th>Sub Category Name</th>
				<th>Status</th>
				<th style="text-align:center;">Action</th>
			</tr>
		</thead>
		</table>
		</div>
		</div>
    </div>
</div>

<script src="<?php echo base_url() ?>media/js/super_admin/setting.js"></script>