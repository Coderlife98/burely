<?php $imgUrl=base_url();
if($firstLeg['sponsor']=='0'){$nBackUrl=base_url().'super_admin/mlm_software/member/member_list';}else{$nBackUrl=base_url().'super_admin/mlm_software/member/tree/'.$spId;}

?>
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
    <div class="card-body">
		<div class="card-title mb-4" style="border-bottom:1px solid #f2f1f2;">
			<ul class="member_indication"><li class="miActv">Active</li><li class="miBlck">Block</li><li class="miSuspnd">Suspend</li></ul>
			<a href="<?php echo $nBackUrl;?>" class="btn btn-light waves-effect waves-light miBck"><i class="bx bx-arrow-back" style="margin-top:2px;"></i> Back </a>
		</div>
<!------------------------------------------->
  <?php 
  		$addMemberUrl=base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($firstLeg['username']));
		if($firstLeg['my_img']==''){$img_loc=$this->Plan_model->imgBlank($firstLeg['my_img'],$firstLeg['status']);}else{$img_loc=$imgUrl.$firstLeg['my_img'];
        $p_imgBg=$this->Plan_model->mmeberStatus($firstLeg['status']);}  
  		if(config_item('mlm_leg') == "1")
		{ 
			$getDown=$this->Plan_model->getDownLine($firstLeg['username']); 		
	   ?>
 	<div class="row mi_tree" >	
		<div class="timeline" style="margin-left:-35%;"><!--bottom: 115px; -->
			<div class="timeline-item timeline-left">
				<div class="timeline-block">
					<div class="time-show-btn">
						<div class="milistFrst"><img src="<?php echo $img_loc;?>" <?php echo $p_imgBg;?> > <?php echo $firstLeg['name'];?>
					  </div>
					</div>
				</div>
			</div>
		  <?php if($getDown){foreach($getDown as $fdLine)
		  {
		  	if($fdLine['my_img']==''){$img_Dloc=$this->Plan_model->imgBlank($fdLine['my_img'],$fdLine['status']);}
			else{$img_Dloc=$imgUrl.$fdLine['my_img'];$p_DimgBg=$this->Plan_model->downStatus($fdLine['status']);}  
		  	?>	
			<div class="timeline-item">
				<div class="timeline-block" style=" width:45%">
					<div class="timeline-box card">
						<div class="card-body" >
							<span class="timeline-icon"></span>
							<div class="timeline-date">
								<i class="mdi mdi-circle-medium circle-dot"></i> 
								<img src="<?php echo $img_Dloc;?>" <?php echo $p_DimgBg ?> class="miMg"><?php echo $fdLine['name'];?>
							</div>
							<!--<h6 class="mt-3 foont-size-15"></h6>-->
							<p class="miv">Id : <span><?php echo $fdLine['username'];?></span>
							<div class="miv_d">
								<a href="<?php echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($fdLine['id']));?>" title="View More"><i class="mdi mdi-arrow-right"></i></a>
							</div></p>
	<div class="miAll"><ul><li>Sponsor Id:<span><?php echo $fdLine['position'];?></span></li><li>Total Downline:<span><?php echo $fdLine['tDown'];?></span></li></ul>	</div>
						</div>
					</div>
				</div>
			</div>
		  <?php }?>
		  <div class="timeline-item">
				<div class="timeline-block" style=" width:45%">
					<div class="timeline-box card">
						<div class="card-body" >
							<span class="timeline-icon"></span>
							<div class="timeline-date" style="background-color:#999999;">
								<i class="mdi mdi-circle-medium circle-dot"></i> 
								<img src="<?php echo base_url().'uploads/user/no_profile.png';?>"class="miMg">Add New
							</div>
							<p class="miv">Id : <span>N/A</span>
							<div class="miv_dP">
								<a href="<?php echo $addMemberUrl;?>" title="Add New Member">
									<i class="bx bx-plus"></i>
								</a>
							</div></p>
	<!--<div class="miAll"><ul><li>Want to Add</li><li>New Member</li></ul>	</div>-->
						</div>
					</div>
				</div>
			</div>
		 <?php }else {?>
		 <div class="timeline-item">
				<div class="timeline-block" style=" width:45%">
					<div class="timeline-box card">
						<div class="card-body" >
							<span class="timeline-icon"></span>
							<div class="timeline-date" style="background-color:#999999;">
								<i class="mdi mdi-circle-medium circle-dot"></i> 
								<img src="<?php echo base_url().'uploads/user/no_profile.png';?>"class="miMg">Add New
							</div>
							<p class="miv">Id : <span>N/A</span>
							<div class="miv_dP">
								<a href="<?php echo $addMemberUrl;?>" title="Add New Member">
									<i class="bx bx-plus"></i>
								</a>
							</div></p>
	<!--<div class="miAll"><ul><li>Want to Add</li><li>New Member</li></ul>	</div>-->
						</div>
					</div>
				</div>
			</div>
		<?php }?>		
	   </div>	
	</div>
  <?php } ?>
  <?php if (config_item('mlm_leg') == "2") { ?>
  Only two leg
  <?php } ?>
  <?php if (config_item('mlm_leg') == "3") { ?>
  Only three leg
  <?php } ?>
  <?php if (config_item('mlm_leg') == "4") { 
/*---------------------------memBr Count------------------------------------*/
 if($firstLeg['A']!=0){$fLegAt=1+$this->Plan_model->find_my_legs($firstLeg['A']);}else{$fLegAt='0';}
 if($firstLeg['B']!=0){$fLegBt=1+$this->Plan_model->find_my_legs($firstLeg['B']);}else{$fLegBt='0';}
 if($firstLeg['C']!=0){$fLegCt=1+$this->Plan_model->find_my_legs($firstLeg['C']);}else{$fLegCt='0';} 
 if($firstLeg['D']!=0){$fLegDt=1+$this->Plan_model->find_my_legs($firstLeg['D']);}else{$fLegDt='0';}  
 /*---------------------------memBr Count------------------------------------*/ 
 if($firstLeg['sponsor']=='0'){$getSponsr="Sponser Id : N/A";}else{$getSponsr="Sponser Id : ".$firstLeg['sponsor'];}
 $getTooltips='A : '.$fLegAt.'<br>'.'B : '.$fLegBt.'<br> C : '.$fLegCt.'<br> D: '.$fLegDt.'<br>ID :'.$firstLeg['username'].'<br>'.$getSponsr;
/*------------------All Legs Details---------------------*/
$getLegA=$this->Plan_model->getMemberDetailsWithChild($firstLeg['A']);	
$getLegB=$this->Plan_model->getMemberDetailsWithChild($firstLeg['B']);	
$getLegC=$this->Plan_model->getMemberDetailsWithChild($firstLeg['C']);	
$getLegD=$this->Plan_model->getMemberDetailsWithChild($firstLeg['D']);
/*print_r($getLegD);*/
$toolTipA=$this->Plan_model->getTooltip($getLegA);
$toolTipB=$this->Plan_model->getTooltip($getLegB);
$toolTipC=$this->Plan_model->getTooltip($getLegC);
$toolTipD=$this->Plan_model->getTooltip($getLegD); 
if($getLegA->p_img==''){$imgA_loc=$this->Plan_model->imgBlank($getLegA->p_img,$getLegA->p_status);}
else{$imgA_loc=$imgUrl.$getLegA->p_img;$imgBg=$this->Plan_model->mmeberStatus($getLegA->p_status);}
if($getLegA->A_img==''){$imgA_Achild=$this->Plan_model->imgBlank($getLegA->A_img,$getLegA->A_status);}
else{$imgA_Achild=$imgUrl.$getLegA->A_img;$imgAchildBg=$this->Plan_model->mmeberStatus($getLegA->A_status);}
if($getLegA->B_img==''){$imgA_B_img=$this->Plan_model->imgBlank($getLegA->B_img,$getLegA->B_status);}
else{$imgA_B_img=$imgUrl.$getLegA->B_img;$B_imgBg=$this->Plan_model->mmeberStatus($getLegA->B_status);}
if($getLegA->C_img==''){$imgA_C_img=$this->Plan_model->imgBlank($getLegA->C_img,$getLegA->C_status);}
else{$imgA_C_img=$imgUrl.$getLegA->C_img;$C_imgBg=$this->Plan_model->mmeberStatus($getLegA->C_status);}
if($getLegA->D_img==''){$imgA_D_img=$this->Plan_model->imgBlank($getLegA->D_img,$getLegA->D_status);}
else{$imgA_D_img=$imgUrl.$getLegA->D_img;$D_imgBg=$this->Plan_model->mmeberStatus($getLegA->D_status);}


if($getLegB->p_img==''){$imgB_loc=$this->Plan_model->imgBlank($getLegB->p_img,$getLegB->p_status);}
else{$imgB_loc=$imgUrl.$getLegB->p_img;$img_B_Bg=$this->Plan_model->mmeberStatus($getLegB->p_status);}
if($getLegB->A_img==''){$imgB_Achild=$this->Plan_model->imgBlank($getLegB->A_img,$getLegB->A_status);}
else{$imgB_Achild=$imgUrl.$getLegB->A_img;$imgBAchildBg=$this->Plan_model->mmeberStatus($getLegB->A_status);} 
 if($getLegB->B_img==''){$imgB_Bchild=$this->Plan_model->imgBlank($getLegB->B_img,$getLegB->B_status);}
else{$imgB_Bchild=$imgUrl.$getLegB->B_img;$imgBBchildBg=$this->Plan_model->mmeberStatus($getLegB->B_status);} 
if($getLegB->C_img==''){$imgB_Cchild=$this->Plan_model->imgBlank($getLegB->C_img,$getLegB->C_status);}
else{$imgB_Cchild=$imgUrl.$getLegB->C_img;$imgBCchildBg=$this->Plan_model->mmeberStatus($getLegB->C_status);} 
if($getLegB->D_img==''){$imgB_Dchild=$this->Plan_model->imgBlank($getLegB->D_img,$getLegB->D_status);}
else{$imgB_Dchild=$imgUrl.$getLegB->D_img;$imgBDchildBg=$this->Plan_model->mmeberStatus($getLegB->D_status);}


if($getLegC->p_img==''){$imgC_loc=$this->Plan_model->imgBlank($getLegC->p_img,$getLegC->p_status);}
else{$imgC_loc=$imgUrl.$getLegC->p_img;$img_C_Bg=$this->Plan_model->mmeberStatus($getLegC->p_status);}
if($getLegC->A_img==''){$imgC_Achild=$this->Plan_model->imgBlank($getLegC->A_img,$getLegC->A_status);}
else{$imgC_Achild=$imgUrl.$getLegC->A_img;$imgCAchildBg=$this->Plan_model->mmeberStatus($getLegC->A_status);} 			
if($getLegC->B_img==''){$imgC_Bchild=$this->Plan_model->imgBlank($getLegC->B_img,$getLegC->B_status);}
else{$imgC_Bchild=$imgUrl.$getLegC->B_img;$imgCBchildBg=$this->Plan_model->mmeberStatus($getLegC->B_status);} 			
if($getLegC->C_img==''){$imgC_Cchild=$this->Plan_model->imgBlank($getLegC->C_img,$getLegC->C_status);}
else{$imgC_Cchild=$imgUrl.$getLegC->C_img;$imgCCchildBg=$this->Plan_model->mmeberStatus($getLegC->C_status);} 			
if($getLegC->D_img==''){$imgC_Dchild=$this->Plan_model->imgBlank($getLegC->D_img,$getLegC->D_status);}
else{$imgC_Dchild=$imgUrl.$getLegC->D_img;$imgCDchildBg=$this->Plan_model->mmeberStatus($getLegC->D_status);} 			
			
			
if($getLegD->p_img==''){$imgD_loc=$this->Plan_model->imgBlank($getLegD->p_img,$getLegD->p_status);}
else{$imgD_loc=$imgUrl.$getLegD->p_img;$img_D_Bg=$this->Plan_model->mmeberStatus($getLegD->p_status);}
if($getLegD->A_img==''){$imgD_Achild=$this->Plan_model->imgBlank($getLegD->A_img,$getLegD->A_status);}
else{$imgD_Achild=$imgUrl.$getLegD->A_img;$imgDAchildBg=$this->Plan_model->mmeberStatus($getLegD->A_status);} 	
if($getLegD->B_img==''){$imgD_Bchild=$this->Plan_model->imgBlank($getLegB->B_img,$getLegD->B_status);}
else{$imgD_Bchild=$imgUrl.$getLegD->B_img;$imgDBchildBg=$this->Plan_model->mmeberStatus($getLegD->B_status);}
if($getLegD->C_img==''){$imgD_Cchild=$this->Plan_model->imgBlank($getLegB->C_img,$getLegD->C_status);}
else{$imgD_Cchild=$imgUrl.$getLegD->C_img;$imgDCchildBg=$this->Plan_model->mmeberStatus($getLegD->C_status);} 
if($getLegD->D_img==''){$imgD_Dchild=$this->Plan_model->imgBlank($getLegB->D_img,$getLegD->D_status);}
else{$imgD_Dchild=$imgUrl.$getLegD->D_img;$imgDDchildBg=$this->Plan_model->mmeberStatus($getLegD->D_status);} 
if($firstLeg['sponsor']=='0'){$nBackUrl=base_url().'super_admin/mlm_software/member/member_list';}else{$nBackUrl=base_url().'super_admin/mlm_software/member/tree/'.$spId;}
?>			
	<div class="col-sm-12">
		<div class="genealogy-body genealogy-scroll">
		<div class="genealogy-tree">
			<ul>
				<li>
					<a href="javascript:void(0);">
						<div class="member-view-box">
							<div class="member-image">
					  <img src="<?php echo $img_loc;?>" <?php echo $p_imgBg;?> class="img-responsive" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="<?php echo $getTooltips; ?>">
								<div class="member-details">
									<span><?php  echo $firstLeg['name']; ?></span>
								</div>
							</div>
						</div>
					</a>
					<ul class="active">
			<?php if($firstLeg['A']!='0'){?>   
						<li>
							<a href="javascript:void(0);">
								<div class="member-view-box">
									<div class="member-image">			
					 <img  src="<?php echo $imgA_loc;?>" <?php echo $imgBg; ?> data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="<?php echo $toolTipA;?>">
										<div class="member-details">
											<span><?php if($getLegA->p_name!=' '){echo $getLegA->p_name;}else{echo 'N/A';} ?></span>
										</div>
									</div>
								</div>
							</a>
							<ul>
								<li>
									<a href="<?php if($getLegA->A_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegA->Aid)); }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegA->P_id));}?>">
										<div class="member-view-box">
											<div class="member-image">
											<?php if($getLegA->A_id){ ?>                    
												<img src="<?php echo $imgA_Achild;?>" <?php echo $imgAchildBg;?>   data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="<?php if($getLegA->A_id){echo $getLegA->A_id;}else{echo 'Add Member';}?>">
												<div class="member-details">
												  <span><?php if($getLegA->Achild!=' '){echo $getLegA->Achild;}else{echo 'N/A';} ?></span>
												</div>
										   <?php }else{?>
										  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
												<div class="member-details" style="margin-left:-20px;">
													<span>Add Member</span>
												</div> 
											<?php }?>
											</div>     
										</div>
									</a>					
								</li>
								<li>
									<a href="<?php if($getLegA->B_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegA->Bid));  }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegA->P_id));}?>">
										<div class="member-view-box">
										   <div class="member-image">
											<?php if($getLegA->B_id){ ?>                    
												<img src="<?php echo $imgA_B_img;?>" <?php echo $B_imgBg;?>  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="<?php if($getLegA->B_id){echo $getLegA->B_id;}else{echo 'Add Member';}?>">
												<div class="member-details">
													<span><?php if($getLegA->Bchild!=' '){echo $getLegA->Bchild;}else{echo 'N/A';} ?></span>
												</div>
										   <?php }else{?>
										  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
												<div class="member-details" style="margin-left:-20px;">
													<span>Add Member</span>
												</div> 
											<?php }?>
											</div> 
										</div>
									</a>
								</li>
								<li>
									<a href="<?php if($getLegA->C_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegA->Cid));  }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegA->P_id));}?>">
										<div class="member-view-box">
											<div class="member-image">
											  <?php if($getLegA->C_id){ ?>    
												<img src="<?php echo $imgA_C_img;?>" <?php echo $C_imgBg;?> >
												<div class="member-details">
													<span><?php if($getLegA->Cchild!=' '){echo $getLegA->Cchild;}else{echo 'N/A';} ?></span>
												</div>
											<?php }else{?>
											  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
													<div class="member-details" style="margin-left:-20px;">
														<span>Add Member</span>
													</div> 
												<?php }?>		
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="<?php if($getLegA->C_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegA->Did));  }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegA->P_id));}?>">
										<div class="member-view-box">
											<div class="member-image">
											  <?php if($getLegA->D_id){ ?> 
												<img src="<?php echo $imgA_D_img;?>" <?php echo $D_imgBg;?> >
												<div class="member-details">
													<span><?php if($getLegA->Dchild!=' '){echo $getLegA->Dchild;}else{echo 'N/A';} ?></span>
												</div>
												<?php }else{?>
											  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
													<div class="member-details" style="margin-left:-20px;">
														<span>Add Member</span>
													</div> 
												<?php }?>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</li>
			<?php }else{?>	
					   <li>
							<a href="<?php echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($firstLeg['username']));?>">
								<div class="member-view-box">
									<div class="member-image">
										<img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
										<div class="member-details" style="margin-left:-20px;">
											<span>Add Member</span>
										</div>
									</div>
								</div>
							</a>        
						  </li>
			<?php }if($firstLeg['B']!='0'){?>
						<li>
							<a href="javascript:void(0);">
								<div class="member-view-box">
									<div class="member-image">
										<img src="<?php echo $imgB_loc;?>" data-bs-toggle="tooltip"  data-bs-placement="top" data-bs-html="true" title="<?php echo $toolTipB;?>">
										<div class="member-details">
											<span><?php if($getLegB->p_name!=' '){echo $getLegB->p_name;}else{echo 'N/A';} ?></span>
										</div>
									</div>
								</div>
							</a>
							<ul class="active">
								<li>
									<a href="<?php if($getLegB->A_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegB->Aid)); }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegB->P_id));}?>">
										<div class="member-view-box">
											<div class="member-image">
											<?php if($getLegB->A_id){ ?>                    
												<img src="<?php echo $imgB_Achild;?>" <?php echo $imgBAchildBg;?> >
												<div class="member-details">
													<span><?php if($getLegB->Achild!=' '){echo $getLegB->Achild;}else{echo 'N/A';} ?></span>
												</div>
										   <?php }else{?>
										  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
												<div class="member-details" style="margin-left:-20px;">
												   <span>Add Member</span>
												</div> 
											<?php }?>
											</div>
										</div>
									</a>
								  
								</li>
								<li>
	<a href="<?php if($getLegB->B_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegB->Bid)); }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegB->P_id));}?>">
									<div class="member-view-box">
										<div class="member-image">
											<?php if($getLegB->B_id){ ?>                    
											<img src="<?php echo $imgB_Bchild;?>" <?php echo $imgBBchildBg;?> >
											<div class="member-details">
												<span><?php if($getLegB->Bchild!=' '){echo $getLegB->Bchild;}else{echo 'N/A';} ?></span>
											</div>
										   <?php }else{?>
										  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
												<div class="member-details" style="margin-left:-20px;">
													<span>Add Member</span>
												</div> 
											<?php }?>
										</div>
									</div>
								</a>	
										</li>
								<li>
									<a href="<?php if($getLegB->C_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegB->Cid)); }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegB->P_id));}?>">
										<div class="member-view-box">
											<div class="member-image">
												<?php if($getLegB->C_id){ ?>                    
												<img src="<?php echo $imgB_Cchild;?>" <?php echo $imgBCchildBg;?> >
												<div class="member-details">
													<span><?php if($getLegB->Cchild!=' '){echo $getLegB->Cchild;}else{echo 'N/A';} ?></span>
												</div>
											   <?php }else{?>
											  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
													<div class="member-details" style="margin-left:-20px;">
														<span>Add Member</span>
													</div> 
												<?php }?>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="<?php if($getLegB->D_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegB->Did)); }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegB->P_id));}?>">
										<div class="member-view-box">
											<div class="member-image">
												<?php if($getLegB->D_id){ ?>                    
												<img src="<?php echo $imgB_Dchild;?>" <?php echo $imgBDchildBg;?> >
												<div class="member-details">
													<span><?php if($getLegB->Dchild!=' '){echo $getLegB->Dchild;}else{echo 'N/A';} ?></span>
												</div>
											   <?php }else{?>
											  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
													<div class="member-details" style="margin-left:-20px;">
														<span>Add Member</span>
													</div> 
												<?php }?>
											</div>
										</div>
									</a>
								  
								</li>
							</ul>
						</li>
				 <?php }else{?>	
					   <li>
							<a href="<?php echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($firstLeg['username']));?>">
								<div class="member-view-box">
									<div class="member-image">
										<img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
										<div class="member-details" style="margin-left:-20px;">
											<span>Add Member</span>
										</div>
									</div>
								</div>
							</a>        
						  </li>
		   <?php }if($firstLeg['C']!='0'){?>
						<li>
							<a href="javascript:void(0);">
								<div class="member-view-box">
									<div class="member-image">
					  <img src="<?php echo $imgC_loc;?>" <?php echo $img_C_Bg; ?> data-bs-toggle="tooltip"  data-bs-placement="top" data-bs-html="true" title="<?php echo $toolTipC;?>">
										<div class="member-details">
											<span><?php if($getLegC->p_name!=' '){echo $getLegC->p_name;}else{echo 'N/A';} ?></span>
										</div>
									</div>
								</div>
							</a>
							<ul>
								<li>
									<a href="<?php if($getLegC->A_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegC->Aid)); }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegC->P_id));}?>">
										<div class="member-view-box">
											<div class="member-image">
											<?php if($getLegC->A_id){ ?>                    
												<img src="<?php echo $imgC_Achild;?>" <?php echo $imgCAchildBg;?> >
												<div class="member-details">
													<span><?php if($getLegC->Achild!=' '){echo $getLegC->Achild;}else{echo 'N/A';} ?></span>
												</div>
										   <?php }else{?>
										  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
												<div class="member-details" style="margin-left:-20px;">
													<span>Add Member</span>
												</div> 
											<?php }?>
										   </div>
										</div>
									</a>
								  
								</li>
								<li>
									<a href="<?php if($getLegC->B_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegC->Bid));  }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegC->P_id));}?>">
										<div class="member-view-box">
											<div class="member-image">
											<?php if($getLegC->B_id){ ?>                    
												<img src="<?php echo $imgC_Bchild;?>" <?php echo $imgCBchildBg;?> >
												<div class="member-details">
													<span><?php if($getLegC->Bchild!=' '){echo $getLegC->Bchild;}else{echo 'N/A';} ?></span>
												</div>
										   <?php }else{?>
										  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
												<div class="member-details" style="margin-left:-20px;">
													<span>Add Member</span>
												</div> 
											<?php }?>
										   </div>
										</div>
									</a>
									
								</li>
								<li>
									<a href="<?php if($getLegC->C_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegC->Cid));  }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegC->P_id));}?>">
										<div class="member-view-box">
											<div class="member-image">
											<?php if($getLegC->C_id){ ?>                    
												<img src="<?php echo $imgC_Cchild;?>" <?php echo $imgCCchildBg;?> >
												<div class="member-details">
													<span><?php if($getLegC->Cchild!=' '){echo $getLegC->Cchild;}else{echo 'N/A';} ?></span>
												</div>
										   <?php }else{?>
										  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
												<div class="member-details" style="margin-left:-20px;">
													<span>Add Member</span>
												</div> 
											<?php }?>
										   </div>
										</div>
									</a>
								  
								</li>
								<li>
									<a href="<?php if($getLegC->D_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegC->Did));  }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegC->P_id));}?>">
										<div class="member-view-box">
											<div class="member-image">
											<?php if($getLegC->D_id){ ?>                    
												<img src="<?php echo $imgC_Dchild;?>" <?php echo $imgCDchildBg;?> >
												<div class="member-details">
													<span><?php if($getLegC->Dchild!=' '){echo $getLegC->Dchild;}else{echo 'N/A';} ?></span>
												</div>
										   <?php }else{?>
										  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
												<div class="member-details" style="margin-left:-20px;">
													<span>Add Member</span>
												</div> 
											<?php }?>
										   </div>
										</div>
									</a>
								  
								</li>
							</ul>
						</li>
				 <?php }else{?>	
					   <li>
							<a href="<?php echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($firstLeg['username']));?>">
								<div class="member-view-box">
									<div class="member-image">
										<img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
										<div class="member-details" style="margin-left:-20px;">
											<span>Add Member</span>
										</div>
									</div>
								</div>
							</a>        
						  </li>
		   <?php }if($firstLeg['D']!='0'){?>
						<li>
							<a href="javascript:void(0);">
								<div class="member-view-box">
									<div class="member-image">
				   <img src="<?php echo $imgD_loc;?>" <?php echo $img_D_Bg; ?>   data-bs-toggle="tooltip"  data-bs-placement="top" data-bs-html="true" title="<?php echo $toolTipD;?>">
										<div class="member-details">
											<span><?php if($getLegD->p_name!=' '){echo $getLegD->p_name;}else{echo 'N/A';} ?></span>
										</div>
									</div>
								</div>
							</a>
							<ul>
								<li>
									<a href="<?php if($getLegD->A_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegD->Aid));  }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegD->P_id));}?>">
										<div class="member-view-box">
											<div class="member-image">
											<?php if($getLegD->A_id){ ?>                    
												<img src="<?php echo $imgD_Achild;?>" <?php echo $imgDAchildBg;?> >
												<div class="member-details">
													<span><?php if($getLegD->Achild!=' '){echo $getLegD->Achild;}else{echo 'N/A';} ?></span>
												</div>
										   <?php }else{?>
										  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
												<div class="member-details" style="margin-left:-20px;">
													<span>Add Member</span>
												</div> 
											<?php }?>
										   </div>
										</div>
									</a>
								</li>
								<li>
									<a href="<?php if($getLegD->B_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegD->Bid));  }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegD->P_id));}?>">
										<div class="member-view-box">
											<div class="member-image">
											<?php if($getLegD->B_id){ ?>                    
												<img src="<?php echo $imgD_Bchild;?>" <?php echo $imgDBchildBg;?> >
												<div class="member-details">
													<span><?php if($getLegD->Bchild!=' '){echo $getLegD->Bchild;}else{echo 'N/A';} ?></span>
												</div>
										   <?php }else{?>
										  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
												<div class="member-details" style="margin-left:-20px;">
													<span>Add Member</span>
												</div> 
											<?php }?>
										   </div>
										</div>
									</a>     
								</li>
								<li>
									<a href="<?php if($getLegD->C_id){ echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegD->Cid));  }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegD->P_id));}?>">
										<div class="member-view-box">
											<div class="member-image">
											<?php if($getLegD->C_id){ ?>                    
												<img src="<?php echo $imgD_Cchild;?>" <?php echo $imgDCchildBg;?> >
												<div class="member-details">
													<span><?php if($getLegD->Cchild!=' '){echo $getLegD->Cchild;}else{echo 'N/A';} ?></span>
												</div>
										   <?php }else{?>
										  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
												<div class="member-details" style="margin-left:-20px;">
													<span>Add Member</span>
												</div> 
											<?php }?>
										   </div>
										</div>
									</a>
								</li>
								<li>
									<a href="<?php if($getLegD->D_id){echo base_url().'super_admin/mlm_software/member/tree/'.urlencode(base64_encode($getLegD->Did));  }else { echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($getLegD->P_id));}?>">
										<div class="member-view-box">
											<div class="member-image">
											<?php if($getLegD->D_id){ ?>                    
												<img src="<?php echo $imgD_Dchild;?>" <?php echo $imgDDchildBg;?> >
												<div class="member-details">
													<span><?php if($getLegD->Dchild!=' '){echo $getLegD->Dchild;}else{echo 'N/A';} ?></span>
												</div>
										   <?php }else{?>
										  <img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
												<div class="member-details" style="margin-left:-20px;">
													<span>Add Member</span>
												</div> 
											<?php }?>
										   </div>
										</div>
									</a>
								</li>
							</ul>
						</li>
					 <?php }else{?>	
					   <li>
							<a href="<?php echo base_url().'super_admin/mlm_software/member/add_member/'.urlencode(base64_encode($firstLeg['username']));?>">
								<div class="member-view-box">
									<div class="member-image">
										<img src="<?php echo base_url();?>uploads/user/thumb_image/tree/new.png" alt="Add New Member">
										<div class="member-details" style="margin-left:-20px;">
											<span>Add Member</span>
										</div>
									</div>
								</div>
							</a>        
						  </li>
						<?php }?>  			
					</ul>
				</li>
			</ul>
		</div>
	</div>
	</div>	
  <?php } ?>
    </div>
</div>


<script src="<?php echo base_url() ?>media/js/super_admin/mlm_software/member.js"></script>
