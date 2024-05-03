<?php 
if($getCurrentMember)
{
	if($getCurrentMember['my_img'])
	{
		$curentMemImgLoc=base_url($getCurrentMember['my_img']);
		}
		else
		{
			$curentMemImgLoc=base_url('uploads/member/downline.png');
			}
	$curentMemName=$getCurrentMember['name'];		
	}
?>

<a href="javascript:void(0);">
<div class="member-view-box">
	<div class="member-image">
		<img src="<?php echo $curentMemImgLoc;?>" alt="<?php echo $curentMemName;?>">
		<div class="member-details">
			<h3><?php echo $curentMemName;?></h3>
		</div>
	</div>
</div>
</a>
<?php if($createMydownLine){?>
<ul class="active">
<?php foreach($createMydownLine as $list){
if($list['my_img'])
{
	$imgLoc=base_url($list['my_img']);
	}else{$imgLoc=base_url('uploads/member/downline.png');}
?>
		<li id="<?php echo $list['username'];?>" onclick="create('<?php echo $list['username'];?>')">
			<a href="javascript:void(0);">
				<div class="member-view-box">
					<div class="member-image">
						<img src="<?php echo $imgLoc;?>" alt="<?php echo $list->name;?>">
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
<div id="nTree<?php echo $getCurrentMember['username'];?>" style="display:none;">1</div>
<?php }?>