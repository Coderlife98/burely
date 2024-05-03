<div class="card-body">

<div class="row">
		<form method="post" id="search_tnx">
			<div class="col-md-12">
					<div class="ami_title"><i class="md md-search"></i> Search Transaction Details</div>
				<div class="search_pnl">  
					   <div class="row">			
							<div class="col-md-6">
									<div class="srchBx"><i class="fa fa-user-secret"></i>
										<div class="amisrDspn1">Transaction Id</div>
											<div class="srchM1 mitext"><input type="text" name="tnxId"></div>
									</div>
							</div>
							<div class="col-md-6">
									<div class="srchBx">
										<div class="amisrDspn1">Transaction Type </div>
										<div class="srchM1 mitext mi-select">
											<select name="tnxType">
												<option value="">----- Select One -----</option>
											    <option selected="selected" value="0">All</option>
												<option value="1">Debit</option>
												<option value="2">Credit</option>
											</select>
										</div>
									</div>
							</div>
					   </div>
					   <div class="row">			
							<div class="col-md-6">
								<div class="srchBx">
									<div class="amisrDspn1">Start Date </div>
									<div class="srchM1 mitext"><input type="date" name="strtDt"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="srchBx">
									<div class="amisrDspn1">End Date </div>
									<div class="srchM1 mitext"><input type="date" name="endDt"></div>
								</div>
							</div>
					   </div>
					   <div class="col-md-12">
							 <button type="submit" class="btn btn-raised btn-primary srchBtn" onclick="return get_search(reportwaltTable,'#search_tnx','#wall_transaction')"><i class="md md-search"></i> Search</button>
					  </div> 
					   
					   
				</div>
				
			</div>	
		</form>	
	</div>

	<div class="table-responsive">
		<div id="search_data"> 	
		<table id="wall_transaction" class="table table-striped table-hover text-nowrap">
			<thead class="list_header">
				<tr>
					<th>S No.</th>
					<th>Tnx Id</th>
					<th>Debit</th>
					<th>Credit</th>
					<th>Description</th>
					<th>Date</th>
					<!--<th>Ref ID</th>-->
				</tr>
			</thead>
		</table>
		</div>
		</div>
	
	
</div>

