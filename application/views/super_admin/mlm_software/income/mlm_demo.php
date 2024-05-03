
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
		<div class="row mi_tree">	
		 	<div class="timeline" style="margin-left:-35%;">
				<div class="timeline-item timeline-left">
					<div class="timeline-block">
						<div class="time-show-btn">
							<div class="milistFrst"><img src="http://localhost/hcp/uploads/user/no_profile.png">Amit Kumar
						  </div>
						</div>
					</div>
				</div>
	
<?php for ($x = 0; $x <= 20; $x++) {?>	
	<div class="timeline-item">
		<div class="timeline-block" style=" width:40%">
			<div class="timeline-box card">
				<div class="card-body" >
					<span class="timeline-icon"></span>
					<div class="timeline-date">
						<i class="mdi mdi-circle-medium circle-dot"></i> 
		<img src="http://localhost/hcp/uploads/user/no_profile.png" class="miMg">Amit Kumar
					</div>
					<h6 class="mt-3 foont-size-15"> Timeline event One</h6>
					<div class="text-muted">
						<p class="mb-0">It will be as simple as occidental </p>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }?>	
	
</div>	
		</div>
    </div>
</div>

