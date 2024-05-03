<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © <?php echo config_item('company_name');?>.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by <?php echo config_item('company_name');?>
                </div>
            </div>
        </div>
    </div>
</footer>



<!----------------------Ami Delete create------------------------->

<div class="modal fade" id="deleteModel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		   <div class="modal-body">
			 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float:right;"></button>
				<div class="delMsg"> &nbsp;</div><div class="actnData" >&nbsp; </div>
				   <div id="mdlFtrBtn">
						 <input type="hidden" id="cnfDel_id">
				<a href="javascript:void(0)" id="deleteCnfrMtn" class="btn btn-outline-danger waves-effect waves-light pull-right">Confirm Delete <i class="bx bx-trash"></i></a>
						<button type="button" class="btn btn-outline-dark pull-right" data-bs-dismiss="modal"><i class="bx bx-arrow-back"></i> Back </button>
				   </div>		
				</div>
		</div>
	</div>
</div>

<!----------------------Ami Delete create------------------------->


















<!----------------------Ami Modal create------------------------->

<div class="modal fade" id="amiModalAction" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="amiModalTitle"></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
						    <div class="col-lg-12">
						        <div id="getMsgAmiModal" class="dangerMsg" style="display:block;">
								</div><input type="hidden" id="py_id_ami">
							</div>
							<div class="col-lg-12" id="hldPayReson" style="display:none;">
									 
							</div>								
						</div>
					</div>
					<div class="modal-footer">
							<span class="btn btn-outline-dark" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-arrow-back"></i> Back</span>
							<button class="btn btn-outline-primary ActnCmdByAmi" id="proccedPyAmiActn"><i class="bx bx-save"></i> Proceed</button>
					</div>
				</div>
			</div>
		</div>
<!----------------------Ami Modal create------------------------->