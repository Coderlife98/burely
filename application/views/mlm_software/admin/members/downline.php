<?php 
$loggedName=$getMember->name;
$loggedImg=$getMember->my_img;
if($loggedImg){$loggedImgLoc=base_url($loggedImg);}else{$loggedImgLoc=base_url('uploads/member/downline.png');}
?>
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

<div class="row mb-4">
	<div class="col-xl-12">
	<div class="card">
		<div class="miArv">
			<i class="bx bxs-group miAr"></i>
			SUBSCRIBER TREE
			<span><a href="<?php echo base_url('mlm_software/admin/member/lists');?>" class="miArvBack"><i class="bx bx-arrow-back"></i></a>
			</span>
		</div>
			<div class="crdDet btm_border">
				<div class="row mi_padd">
				<?php //print_r($getMydownLine);//echo '<br>';echo $this->db->last_query();?>
				<div class="col-md-12">
				    <div class="mi_tree">
						<div class="genealogy-body genealogy-scroll">
							<div class="genealogy-tree">
								<ul>
									<li>
										<a href="javascript:void(0);">
											<div class="member-view-box">
												<div class="member-image">
													<img src="<?php echo $loggedImgLoc;?>" alt="<?php echo $loggedName;?>">
													<div class="member-details">
														<h3><?php echo $loggedName;?></h3>
													</div>
												</div>
											</div>
										</a>
										<?php if($getMydownLine){?>
										<ul class="active">
											<?php foreach($getMydownLine as $list){
											if($list['my_img']){$imgLoc=base_url($list['my_img']);}else{$imgLoc=base_url('uploads/member/downline.png');}
											?>
											<li id="miAr<?php echo $list['username'];?>">
												<a href="javascript:void(0);" class="downami" id="<?php echo $list['username'];?>">
													<div class="member-view-box">
														<div class="member-image">
															<img src="<?php echo $imgLoc;?>" alt="<?php echo $list['name'];?>">
															<div class="member-details">
																<h3><?php echo $list['name'];?></h3>
															</div>
														</div>
													</div>
												</a>
											 </li>
											<?php }?>
										   </ul>
										<?php }else{?>
										
										<ul class="active">
											
											<li class="downami">
												<a href="javascript:void(0);">
													<div class="member-view-box">
														<div class="member-image">
															<img src="<?php echo base_url('uploads/member/no_downline.png');?>" alt="Ami Singh">
															<div class="member-details" style="margin: 10px 0px 0px -20px;text-transform: uppercase;color: #bf0000;">
																<h3>No Member Exist</h3>
															</div>
														</div>
													</div>
												</a>
											 </li>
											</ul>
										<?php }?>
									</li>
								</ul>
							</div>
						</div>
					</div>		
				</div>
			</div>
		</div>
	</div>	
	</div>	
</div>
<input type="hidden" id="target" value="<?php echo base_url('mlm_software/admin/member/create_tree');?>" />
<!------------->
<script src="<?php echo base_url() ?>media/js/mlm_software/admin/members.js"></script>