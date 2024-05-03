<style>.table-responsive{ min-height:400px;}</style>
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
<input type="hidden" id="target" value="<?php echo $target; ?>" />
<div class="row mb-4">
	<div class="col-xl-12">
		<div class="ami_title"><i class="bx bx-detail  miU"></i> My Earning List
		<span><a href="<?php echo base_url('member/dashboard');?>" class="miBack"><i class="bx bx-arrow-back"></i></a></span>
		
		
		</div>
			<div class="crdDet btm_border">
			  <div class="row mi_padd">
				<div class="col-md-12">
				   <div class="table-responsive">
					<?php if($getOprAct=='spInc' || $getOprAct=='genInc'){?>
					
					<div id="search_data">
						<table id="member_earning" class="table table-striped table-hover">
							<thead class="hdr_clr">
								<tr>
									<th>S No.</th>
									<th>Amount</th>
									<th>Total B.V</th>
									<th>Earn B.V</th>
									<th>Type</th>
									<th>Ref ID</th>
									<th>Date</th>
									<th style="text-align:center;">Status</th>
								</tr>
							</thead>
						</table>
					</div>
					<?php }else{
					
					// echo'<br>'.$target.'<br>';
					?>
                    
 <!------------------------------------------------------------------------------------->                   
          <?php 
			if($getOprAct=='stcInc')
			{
				if(count($isChild)<=2)
				{
					$spEarnBV=0;
					$qalifiy=0;
					$return='<div class="branch lv1">';$notAvailable=NULL;$result='Yes';
					foreach($isChild as $det)
					{
						$return.='<div class="entry"><span class="label"><ul><li>'.$det['name'].'</li><li>'.$det['username'].'</li>
								  <li>'.($det['rank']?$det['rank']:'normal Member').'</li><li>Earned Bv : <span>'.$det['ernBV'].'</span></li></ul></span></div>';
						$spEarnBV+=$det['ernBV'];
						//if($det['ernBV']>='8000'){$qalifiy++;}else if(($det['ernBV']<='5000') && ($det['ernBV']<='8000')){$qalifiy++;}
						}
						$return.='</div>';	
					}
					else{$notAvailable='1';$result='';}
				}
			else if($getOprAct=='gstcInc')
			{
				if((count($isChild) >2 )&&(count($isChild)<=3))
				{
					$spEarnBV=0;
					$return='<div class="branch lv1">';$notAvailable=NULL;$result='Yes';
					foreach($isChild as $det)
					{
						$return.='<div class="entry"><span class="label"><ul><li>'.$det['name'].'</li><li>'.$det['username'].'</li>
								  <li>'.($det['rank']?$det['rank']:'normal Member').'</li><li>Earned Bv : <span>'.$det['ernBV'].'</span></li></ul></span></div>';
						$spEarnBV+=$det['ernBV'];
						}
						$return.='</div>';	
					}
					else{$notAvailable='1';$result=NULL;}
				}
			else if($getOprAct=='mstcInc')
			{
				if((count($isChild) >3 )&&(count($isChild)<=4))
				{
					$spEarnBV=0;
					$return='<div class="branch lv1">';$notAvailable=NULL;$result='Yes';
					foreach($isChild as $det)
					{
						$return.='<div class="entry"><span class="label"><ul><li>'.$det['name'].'</li><li>'.$det['username'].'</li>
								  <li>'.($det['rank']?$det['rank']:'normal Member').'</li><li>Earned Bv : <span>'.$det['ernBV'].'</span></li></ul></span></div>';
						$spEarnBV+=$det['ernBV'];
						}
						$return.='</div>';	
					}
					else{$notAvailable='1';$result=NULL;}
				}
			else if($getOprAct=='msstcInc')
			{
				if((count($isChild) >4 )&&(count($isChild)<=6))
				{
					$spEarnBV=0;
					$return='<div class="branch lv1">';$notAvailable=NULL;$result='Yes';
					foreach($isChild as $det)
					{
						$return.='<div class="entry"><span class="label"><ul><li>'.$det['name'].'</li><li>'.$det['username'].'</li>
								  <li>'.($det['rank']?$det['rank']:'normal Member').'</li><li>Earned Bv : <span>'.$det['ernBV'].'</span></li></ul></span></div>';
						$spEarnBV+=$det['ernBV'];
						}
						$return.='</div>';	
					}
					else{$notAvailable='1';$result=NULL;}
				}	
				//echo $getOprAct;
			 if($notAvailable)
			 {
			 	?>	
                	<div class="memIncDet">
                    	<i class="bx bx-search-alt"></i> You are not eligible for <?php echo $title ?>
                    	<br />
                        		Because you have only <?php if(count($isChild) < 1){echo count($isChild).'downline member ';}else{echo count($isChild).'downline members';} ?> just below earned BV.   
                    </div>	
                    <?php }
					{
				
						if($result)
						{
							if(count($isChild)>0)
							{
							?>	
            <div id="prMember">
                <span class="label">
                    <ul class="mbcCl">
                            <li><?php echo $parent->name;?></li>
                            <li><?php echo $parent->username;?></li>
                            <li><?php echo $parent->rank?$parent->rank:'Normal Member';?></li>
                            <li>Earned Bv :<span>
													<?php //if($earnedInc->incomeEarnend){echo $earnedInc->incomeEarnend;}else{echo '0.00';}
															echo $spEarnBV;//.'==='.$qalifiy
														?>
                                            </span>
                            </li>
                    </ul>
                </span>
                <?php echo $return;?>
            </div>                
                    
                    
                    
<style>
#prMember {position: relative;}.branch {position: relative;margin-left: 250px;}.branch:before {content: "";width: 50px;border-top: 2px solid #b7870a;position: absolute;left:10px;top: 50%;margin-top: 1px;}.entry {position: relative;min-height: 200px;}.entry:before {content: "";height: 100%;border-left: 2px solid #b7870a;position: absolute;left:60px;}.entry:after {content: "";width: 50px;border-top: 2px solid #b7870a;position: absolute;left: 10px;top: 50%;margin-top: 1px;}.entry:first-child:before{width: 10px;height: 50%;top: 50%;margin-top: 2px;border-radius: 10px 0 0 0;left: 60px;}.entry:first-child:after {height: 10px;border-radius: 10px 0 0 0;left: 60px;}.entry:last-child:before{width: 10px;height: 50%;border-radius: 0 0 0 10px;left: 60px;}.entry:last-child:after{height: 10px;border-top: none;border-bottom: 2px solid #b7870a;border-radius: 0 0 0 10px;margin-top: -9px;left: 60px;}.label{display:block;min-width:260px;border:2px solid #eee9dc;border-radius:5px;position:absolute;left:0;top:38%;margin-top: -15px;}
.label ul{ list-style:none;margin-left:0px;margin-bottom: 0rem;background-color: #00a6d9;border-radius: 3px;padding-left: 0px;color:#fff;}
.label ul li{ padding: 5px 5px 5px 5px;border-bottom: 1px dashed #075973;}
.label ul li:last-child{ border-bottom:0px; }
.entry  .label{ top:26% !important;left: 15.25%;}
.mbcCl{ background-color:#b35401 !important;}
.mbcCl li{ border-bottom:1px solid #fff !important;}
.mbcCl li span{font-weight:700;padding-left: 20px;}

</style>                

<!------------------------------------------------------------------------------------->                              
				
					<?php }else{
					?><div class="memIncDet">
                    	<i class="bx bx-search-alt"></i> You are not eligible for <?php echo $title ?>
                    	<br />
                        		Because you have only <?php if(count($isChild) < 1){echo count($isChild).'  downline member ';}else{echo count($isChild).' downline members';} ?> just below earned BV.   
                    </div>	<?php } }}}?>
				</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<!------------->
