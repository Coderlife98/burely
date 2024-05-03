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
 <div class="card-header hdr_clr">
 	<div><i class="bx bx-crown"></i> Search Designation</div> 
	<a href="javascript:void(0)"id="addDesignation" class="ititle" title="Add New Designation"><i class="fas fa-plus"></i></a>
 <!--data-bs-toggle="modal" data-bs-target="#emp_designation" -->
 </div>
	<div class="card-body">
	<form method="post" id="search_designation">
		<div class="col-xl-12">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-floating mb-3">
						<input type="text" name="designation" id="designation" value="" class="form-control">
						<label for="designation"><i class="bx bxs-crown fntClr"></i> Designation </label>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-floating mb-3">
						<input type="text" name="payscale" id="payscale" value="" class="form-control">
						<label for="payscale"><i class="bx bx-rupee fntClr"></i> Pay Scale</label>
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
						<label for="endDt"><i class="mdi mdi-calendar-account fntClr"></i> Permanent/Temporary </label>
					</div>
				</div>
			</div>
		   <a href="<?php echo base_url(); ?>mlm_software/admin/employee/manage" class="btn btn-outline-dark  waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
		  
		  <button type="submit" class="btn cstm_btn pull-right" onclick="return get_search(repEmpDesignsn,'#search_designation','#emp_position_tbl')">
		  <i class="mdi mdi-account-search"></i> Search</button>
		  
		  
	    </div>	
     </form>
	</div>
</div>


<div class="card">
    <div class="card-body">	
<!-------------------------------------------->
 <!-- amoli modal dialog -->
<div class="modal fade" id="designation_delete" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		   <div class="modal-body">
			 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float:right;"></button>
				<div class="delMsg"> delete Mesage</div><div class="actnData" >&nbsp; </div>
				   <div id="mdlFtrBtn">
				   <input type="hidden" id="cnfDel_id">
						<a href="javascript:void(0)" class="btn btn-outline-danger waves-effect waves-light pull-right" id="deleteDesignsn">Confirm Delete <i class="bx bx-trash"></i></a>
						<button type="button" class="btn btn-outline-dark pull-right" data-bs-dismiss="modal"><i class="bx bx-arrow-back"></i> Back </button>
				   </div>		
				</div>
		</div>
	</div>
</div>

<div class="modal fade" id="emp_designation" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalToggleLabel"><i class="bx bx-crown miIcn"></i><span class="pgTitle">Add New Designation</span></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div> <input type="hidden" id="py_id"><input type="hidden" id="miActn" value="edit">
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-12"><div id="getMsgSuccess" style="display:none;">&nbsp;</div></div>	
							
							 	<div class="col-lg-12">
									<div class="form-floating mb-3">
										 <input type="text" id="designationN" class="form-control">
										<label for="designation"><i class="bx bxs-crown fntClr"></i> Designation Name <span class="text-danger">*</span></label>
									</div>
								</div>
							
							   <div class="col-lg-12">
									<div class="form-floating mb-3">
										 <input class="form-control" type="text" id="pyscale">
										<label for="pyscale"><i class="bx bx-rupee fntClr"></i> Payscale <span class="text-danger">*</span></label>
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
							<button class="btn btn-outline-primary ActnCmdByAmi" id="proccedDesig"><i class="bx bx-save"></i> Update</button>
					</div>
				</div>
			</div>
	</div>
	
<!-------------------------------------------->	
	<div class="table-responsive">
		<div id="search_data">  
		<table class="table align-middle table-striped table-nowrap mb-0" id="emp_position_tbl">
		<thead class="hdr_clr">
			<tr>
				<th>S.No</th>
				<th>Designation Name</th>
				<th>Pay Scale</th>
				<th style="text-align:center;">Action</th>
			</tr>
		</thead>
		</table>
		</div>
		</div>
    </div>
</div>

<script src="<?php echo base_url() ?>media/js/super_admin/mlm_software/setting.js"></script>