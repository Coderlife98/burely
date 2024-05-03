<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sale extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('mlm_software/admin/sale_model', 'sale');
		$this->load->model('partner/partner_model', 'partner');
        ($this->session->userdata('user_id')== '') ? redirect(base_url(), 'refresh') : '';
	    $this->lgCat=$this->session->userdata['user_cate'];
		$this->logId=$this->session->userdata('user_id');
	    $this->baseUrl=base_url();
	    error_reporting(0);
    }
   public function index($actn=NULL)
   {
		if($actn)
		{
			$post_data = $this->input->post();
			$record = $this->sale->sale_data($post_data);
			$i = $post_data['start'] + 1;
			$return['data'] = array();
			foreach ($record as $row) {
				if ($row->order_status=='0'){$stsTex='Cancelled';$activeCls='ordCancel';} 
				else if ($row->order_status=='1'){$stsTex='Placed';$activeCls='ordPlced';}
				else if ($row->order_status=='2'){$stsTex ='Shipped';$activeCls='ordShipped';}
				else if ($row->order_status=='3'){$stsTex='Delevered';$activeCls='ordDelevered';}
				else {$stsTex='Not Yet';$activeCls='setBtnGr dctive';}
				$getUid = base_url('mlm_software/admin/sale/detials/'.urlencode(base64_encode($row->invoice_id)));
				$actionBtn = '<div style="text-align:center;">
									<a href="'.$getUid.'" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
							  </div>';
				$grandTamt=$row->grand_total;
				if($row->delevery_date){$delivery=date('d-m-Y',strtotime($row->delevery_date));}else{ $delivery='<span style="font-weight:600">N/A</span>';}
				$return['data'][] = array(
											'<strong>' . $i++ . '.</strong>',
											'<strong>'.$row->invoice_id.'</strong>',
											'<i class="bx bx-rupee inrP"></i> '.number_format($grandTamt,2),
											'<i class="bx bx-rupee inrP"></i> '.$row->paid_amt,
											date('d-m-Y',strtotime($row->order_date)),
											$delivery,
											'<div class="' . $activeCls . ' getAction"><span>' . $stsTex . '</span></div>',
											$actionBtn
											);
			}
			$return['recordsTotal'] = $this->sale->total_count();
			$return['recordsFiltered'] = $this->sale->filter_count($post_data);
			$return['draw'] = $post_data['draw'];
			echo json_encode($return);
			}
		else
		{
			$data['title'] = 'Sales Manage';
			$data['breadcrums'] = 'Sales Manage';
			$data['target'] = 'mlm_software/admin/sale/index/1';
			$data['layout'] = 'mlm_software/admin/sale/_list.php';
			$this->load->view('mlm_software/base',$data);
				
				}	
		
		

   	 } 
   public function detials($id)
   {
		$orderDetails=NULL;$member=NULL;
		$invId = base64_decode(urldecode($id));
		$whereInvId=array('invoice_id'=>$invId);
		
		$getFrenchise=NULL;$getBuyer=NULL;
		$ordHistory=$this->common->get_data('order_history',$whereInvId,'*');
		$getBuyer=$this->partner->profile_details($ordHistory['customer_id']);
		$getFrenchise=$this->partner->profile_details($ordHistory['seller_id']);
		$orderDetails=$this->common->all_data_con('order_details',$whereInvId,'*');
			
			
		$data['getBuyer'] = $getBuyer;
		$data['getFrenchise'] = $getFrenchise;
		$data['invId']=$invId;	$data['ordHistory']=$ordHistory;
		$data['orderDetails']=$orderDetails;
		$data['title'] = 'Sale Details';
        $data['breadcrums'] = 'Sale Details';
        $data['layout'] = 'mlm_software/admin/sale/_view.php';
        $this->load->view('mlm_software/base', $data);	
		}
   public function get_preview($id)
   {	
		$invId = base64_decode(urldecode($id));
		$whereInvId=array('invoice_id'=>$invId);
		$member=NULL;
		$getFrenchise=NULL;
		$ordHistory=$this->common->get_data('order_history',$whereInvId,'*');
		$getFrenchise=$this->partner->profile_details($ordHistory['seller_id']);
		$member=$this->partner->profile_details($ordHistory['customer_id']);
		$ordDetails='order_details';

		$data['getFrenchise']=$getFrenchise;
		$data['member']=$member;
		$orderDetails=$this->common->all_data_con($ordDetails,$whereInvId,'*');
		
		$data['ordHistory']=$ordHistory;
		$data['orderDetails']=$orderDetails;
		 $this->load->view('mlm_software/admin/sale/_print_preview', $data);			
		}	
		
   public function approved()
   {
   		$post=$this->input->post();
		$whereCon=array('id'=>$post['orderID']);
		$ordHistoryTbl='order_history'; $detailTbl='order_details';
		//$ordHistory=$this->common->get_data($ordHistoryTbl,$whereCon,'*');
		$ordHistory=$this->sale->order_details($post['orderID']);
if($post['ordSts']=='Cancelled'){$ordSts='0';$adCls='tst_warning';}else if($post['ordSts']=='Delivered'){$ordSts='3';$adCls='tst_success';}else{$ordSts='1';$adCls='tst_default';}
		if($ordHistory['order_status']=='3'){$data=array('adClass'=>'tst_default','text'=>'You have already dilevered this order');}
		else
			{	$tnxNu=date('dHis');
				$updateArr=array('delevery_date'=>date('Y-m-d'),'order_status'=>$ordSts,'approvedBy'=>$this->logId,'admnTnx'=>$tnxNu,'seller_id'=>$this->logId);
				$recordUpdate=$this->common->update_data($ordHistoryTbl,$whereCon,$updateArr);
				if($recordUpdate)
				{
					$creditAmt=$ordHistory['grand_total'];
					$createCompLedger=array(//.$ordHistory['customer_id']
											'tnx_id'=>$tnxNu,'tnx_type'=>'4','user_type'=>'0','reason'=>'Amount credited after repurchase of partner # '.$ordHistory['username'],
											'credit_amt'=>$creditAmt,'created_by'=>$this->logId,'created_date'=>date('Y-m-d H:i:s'),'generated_by'=>'1'
											);
				  $createCompanyInc=$this->common->save_data('company_income',$createCompLedger);
				  if($createCompanyInc)				   
			  	  {
				  	 $walletTnxArr = array('tnx_id'=>$tnxNu,'user_id'=>$ordHistory['username'],'debit_amt'=>$creditAmt,'reason'=>'Amount debited after product purchase',
									  	   'created_by'=>'0','create_date'=>date('Y-m-d H:i:s'));							
					 $createWallTnx=$this->common->save_data('partner_wallet_transaction',$walletTnxArr);
					/* $createWallTnx='1';*/
					  if($createWallTnx)				   
						{
							if($post['ordSts']=='Delivered')
							{
								$ordWhereCon=array('order_id'=>$ordHistory['id'],'member_id'=>$ordHistory['customer_id']);
								$getOrderedDetails=$this->common->all_data_con($detailTbl,$ordWhereCon,'*');
							  if($getOrderedDetails)
							  {
								foreach($getOrderedDetails as $dList)
								{
									$isProWhereCon=array('partner_id'=>$ordHistory['customer_id'],'product_details_id'=>$dList['product_details_id']);				   
									$isProductExist=$this->common->get_data('partner_stock',$isProWhereCon,'*');
									if($isProductExist)
									{
										  $totalQty=$dList['product_qty']+$isProductExist['product_qty'];$whereConStockUp=array('id'=>$isProductExist['id']);
										   $stockUpdateArr=array('product_qty'=>$totalQty,'lastInStock'=>$dList['product_qty'],'modified_type'=>'1','stockInDate'=>date('Y-m-d'),
																 'modify_date'=>date('Y-m-d'),'modified_by'=>$this->logId,'stockIncId'=>$ordHistory['id']);				  
										   if($this->common->update_data('partner_stock',$whereConStockUp,$stockUpdateArr)){$result='1';}else{$result='2';}
										}				   
										else
										{
											  $stockCreateArr=array('partner_id'=>$ordHistory['customer_id'],'product_details_id'=>$dList['product_details_id'],
																	'product_price'=>$dList['product_selling_price'],'product_mrp'=>$dList['product_mrp'],
																	'product_qty'=>$dList['product_qty'],'lastInStock'=>$dList['product_qty'],'created_type'=>'1',
																	'last_purchase_id'=>$ordHistory['id'],'stockInDate'=>date('Y-m-d'),'create_date'=>date('Y-m-d'),
																	'created_by'=>$this->logId,'stockIncId'=>$ordHistory['id']);
											  if($this->common->save_data('partner_stock',$stockCreateArr)){$result='1';}else{$result='2';}
											}			
										}
									}
								 }
								if($result=='1'){$data=array('adClass'=>$adCls,'text'=>'Thank You! You have successfully update order details');}
							else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems server taking time while updating');	}
						  }
					   else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems server taking time while generating wallet tnx');	}
					  }
					 else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems server taking time while generating company income');	}
					}
				  else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems server taking more time please refresh');	}
			   }
		   echo json_encode($data);
		}		
   public function package($actn=NULL)
   {
		
		if($actn)
		{
			if($actn=='view')
			{
				$post_data = $this->input->post();
				$record = $this->sale->package_data($post_data);
				$i = $post_data['start'] + 1;
				$return['data'] = array();
				foreach ($record as $row) {
					if ($row->order_status=='Cancel'){$stsTex='Cancelled';$activeCls='ordCancel';} 
					else if ($row->order_status=='Placed'){$stsTex='Placed';$activeCls='ordPlced';}
					else if ($row->order_status=='Pending'){$stsTex ='Pending';$activeCls='ordShipped';}
					else if ($row->order_status=='Delivered'){$stsTex='Delevered';$activeCls='ordDelevered';}
					else {$stsTex='Not Yet';$activeCls='setBtnGr dctive';}
					$getUid = base_url('mlm_software/admin/sale/pack_details/'.urlencode(base64_encode($row->id)));
					$actionBtn = '<div style="text-align:center;">
										<a href="'.$getUid.'" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
								  </div>';
					if($row->purchase_date){$orderDt=date('d-m-Y',strtotime($row->purchase_date));}else{ $orderDt='<span style="font-weight:600">N/A</span>';}
					if($row->delivery_date){$delivery=date('d-m-Y',strtotime($row->delivery_date));}else{ $delivery='<span style="font-weight:600">N/A</span>';}
					$grndAmt=$row->grndAmt+($row->grndAmt*$row->tax)/100;
					$return['data'][] = array(
												'<strong>' . $i++ . '.</strong>',
												'<strong>'.$row->tnx_id.'</strong>','<strong>'.$row->mem_id.'</strong>',
												'<i class="bx bx-rupee inrP"></i> '.number_format($grndAmt,2),
												'<i class="bx bx-rupee inrP"></i> '.$row->paid_amt,
												$orderDt,
												$delivery,
												'<div class="' . $activeCls . ' getAction"><span>' . $stsTex . '</span></div>',
												$actionBtn
												);
				}
				$return['recordsTotal'] = $this->sale->packtotal_count();
				$return['recordsFiltered'] = $this->sale->packfilter_count($post_data);
				$return['draw'] = $post_data['draw'];
				echo json_encode($return);
			}
			else if($actn=='add')
			{
				
				$data['package']=$this->common->getDataList('package','status','1');
				$data['title'] = 'Pakages Kart ';
				$data['breadcrums'] = 'Pakages Kart';
				$data['target'] = 'mlm_software/admin/sale/package/view';
				$data['layout'] = 'mlm_software/admin/sale/_package_view.php';
				$this->load->view('mlm_software/base',$data);
				}
			else if($actn=='delTemPackage')
			{
				$post=$this->input->post();
				$whereCon=array('id'=>$post['dataId'],'table'=>'temp_package_purchase');
				$delDetails = $this->common->del_data($whereCon);
				//$delDetails=1;
				if($delDetails)
				{
					//print_r($post);echo '<br>';
					$isCheck=array('1'=>'F','2'=>'S','3'=>'M');$usrNm=substr($post['byrUser'],0,1); $pur_type=array_search($usrNm,$isCheck);
					$whereMultiCon=array('member_id'=>$post['byrID'],'pur_type'=>$pur_type);
					//$tempOrderDetails=$this->common->get_data('temp_package_purchase',$whereMultiCon,'sum(grand_total) as grndAmt,tax,GROUP_CONCAT(CONCAT(id) SEPARATOR "==") as tRow');				
					$tempOrderDetails=$this->sale->getPackageData($post['byrID'],$pur_type);
					
				    //echo $this->db->last_query();
				   if($tempOrderDetails)
					{
						$srCnt=explode('==',$tempOrderDetails['tRow']);
						//print_r($srCnt);die;
					    $paybleAmt=$tempOrderDetails['grndAmt']+($tempOrderDetails['grndAmt']*$tempOrderDetails['tax'])/100;
						$data=array('adClass'=>'tst_success',
									'msg'=>'Thank you! you have successfully delete',
									'id'=>$post['dataId'],
									'srCnt'=>$srCnt,
									'grandTotal'=>number_format($tempOrderDetails['grndAmt'],2),
									'paybleAmt'=>number_format($paybleAmt,2));	
						}
					   else{$data=array('adClass'=>'tst_danger','msg'=>'Oops it seems there no package in kart while deleting package');}
					}
					else{$data=array('adClass'=>'tst_warning','msg'=>'Oops it seems there issue while deleting package');}
				echo json_encode($data);	
				}		
			
		}
		else
		{
			$data['title'] = 'Pakages Sales Manage';
			$data['breadcrums'] = 'Pakages Sales Manage';
			$data['target'] = 'mlm_software/admin/sale/package/view';
			$data['layout'] = 'mlm_software/admin/sale/_package_sale_list.php';
			$this->load->view('mlm_software/base',$data);
				
				}	
		}	
	public function pack_details($id)
	{
		$orderDetails=NULL;$member=NULL;$ordHistory=NULL;$getBuyer=NULL;
		$invId = base64_decode(urldecode($id));
		$whereInvId=array('pur_id'=>$invId);
		$ordHistory=$this->common->getRowData('package_purchase','id',$invId);
		$getBuyer=$this->partner->profile_details_by_username($ordHistory->mem_id);
		//$orderDetails=$this->common->all_data_con('package_purchase_details',$whereInvId,'*');
		
		$orderDetails=$this->sale->getPackagePurchasedList($invId);
		//print_r($orderDetails1);
		
		
		$data['orderDetails']=$orderDetails;
		$data['getBuyer'] = $getBuyer;
		$data['ordHistory']=$ordHistory;
		$data['title'] = 'Sale Package Details ';
		$data['breadcrums'] = 'Sale Package Details';
		$data['target'] = 'mlm_software/admin/sale/package/view';
		$data['layout'] = 'mlm_software/admin/sale/_package_data.php';
		$this->load->view('mlm_software/base',$data);
		}	
	public function findBuyer()
	{
		$post=$this->input->post();
		$getBuyer=$this->partner->profile_details_by_username($post['buyerID']);
		if($getBuyer)
		{
			$getTempSaleList=$this->getTempSale($getBuyer->id);	
			if($getBuyer->address){$address=$getBuyer->address.',<br>'.$getBuyer->ctyN.','.$getBuyer->stN.','.$getBuyer->zipcode;}else{$address=$getBuyer->address;}
			$data=array('adClass'=>'tst_success','byrPic'=>base_url($getBuyer->my_img),'byrCode'=>$getBuyer->username,'byrName'=>$getBuyer->name,'byrAddr'=>$address,'byrContct'=>$getBuyer->mobile,'byrEmail'=>$getBuyer->email,'msg'=>'Thank You! you have found details','byrID'=>$getBuyer->id,'tempSaleList'=>$getTempSaleList);
			}else{$data=array('adClass'=>'tst_warning','msg'=>'Oops it seems there is no member id exist');}
			echo json_encode($data);
		}	
		
	public function getTempSale($buyerId)
	{
		$adminCharge=$this->common->getRowData('club_income','id','1');
		$tempOrderDetails=$this->sale->tempPackage($buyerId);
		if($tempOrderDetails)
		{
			$ctr=0;	$grandTotal=0;$content='';	
			foreach($tempOrderDetails as $dList)
			{$ctr++;
				
				//print_r($dList);echo '<br>';
				
				$tAmt=$dList->pack_amt*$dList->pack_qty;$grandTotal+=$tAmt;
				$kartTrash="delPackTempKart('".$dList->id.'@@@@'.$dList->pack_name."')";
				$content.='<tr id="delArv-'.$dList->id.'" class="dynamicRows">
								<th id="serial-'.$dList->id.'">'.$ctr.'.</th><td>'.$dList->pack_name.'</td>
								<td id="pQty--'.$dList->id.'">'.$dList->pack_qty.'</td><td><i class="bx bx-rupee inrP"></i> '.$dList->pack_amt.'</td>
							     <td>'.$dList->pack_bv.'</td>
							    <td id="netAmt--'.$dList->id.'"><i class="bx bx-rupee inrP"></i> '.number_format($tAmt,2).'
							    <button class="kartTrash" onclick="'.$kartTrash.'" type="button"><i class="bx bx-trash"></i></button></td>
						  </tr>';
			}
			//$paybleAmt=$grandTotal+($grandTotal*$adminCharge->tax)/100;	
		   $result=array('getOrd'=>$content,'miTxt'=>'success','grandTotal'=>number_format($grandTotal,2)/*,'paybleAmt'=>number_format($paybleAmt,2),'texPer'=>$adminCharge->tax*/);
			return $result;
		 }
	  }	
public function getPackage()
{
	sleep(1);$post=$this->input->post('id');//print_r($getPack);
	$getPack=$this->common->getRowData('package','id',$post);
	if($getPack){$data=array('adClass'=>'tst_success','pack_price'=>$getPack->pack_price,'pack_bv'=>$getPack->b_volume);}
	else{$data=array('adClass'=>'tst_warning','msg'=>'Oops it seems there is no member id exist');}
	echo json_encode($data);
	}	
public function tempPackKart()
{	
   $post=$this->input->post();
   $whereCon=array('pack_id'=>$post['package'],'member_id'=>$post['buyerID']);
   $isPackExit=$this->common->get_data('temp_package_purchase',$whereCon,'*');
   if($isPackExit)
   {
	 $upPackQty=$isPackExit['pack_qty']+$post['packQty'];$updatedGtotal=$upPackQty*$isPackExit['pack_amt'];
	 $updateTempKart=array('pack_qty'=>$upPackQty,'grand_total'=>$updatedGtotal);
	 if($this->common->update_data('temp_package_purchase',$whereCon,$updateTempKart))
	 {
		
		$grand=$this->common->get_data('temp_package_purchase',array('member_id'=>$post['buyerID']),'sum(grand_total) as totalAmt');
		$netPaybleAmt=$grand['totalAmt']+($grand['totalAmt']*$isPackExit['tax']/100);
		$myRowUpdate=array('qty'=>$upPackQty,'netAmt'=>'<i class="bx bx-rupee inrP"></i> '.number_format($updatedGtotal,2).' <button class="kartTrash" onclick="'.$onclick.'"  type="button"><i class="bx bx-trash"></i></button>');
	 	$data=array('miResult'=>'miRowUpdate','text'=>$myRowUpdate,'rowUpdate'=>$isPackExit['id'],'grndT'=>number_format($grand['totalAmt'],2),
		            'netPay'=>number_format($netPaybleAmt,2),'adClass'=>'tst_success','msg'=>'Thank You! You have successfully update details');
		 }
		else{$msg=array('Oops it seems server taking more time please refresh');$data = array('miResult'=>'warning','adClass' => 'tst_warning', 'text' =>$msg);}
		
   	}
   else
   {
   		$gePack=$this->common->getRowData('package','id',$post['package']);
		if($gePack)
		{
			$getTax=$this->common->getRowData('club_income','id','1');
		    $isCheck=array('1'=>'F','2'=>'S','3'=>'M');$usrNm=substr($post['busr'],0,1); $pur_type=array_search($usrNm,$isCheck);$grndTtl=$post['packQty']*$gePack->pack_price;
		    $createArr=array('member_id'=>$post['buyerID'],'pur_type'=>$pur_type,'pack_id'=>$post['package'],'pack_qty'=>$post['packQty'],'pack_bv'=>$gePack->b_volume,
							 'pack_amt'=>$gePack->pack_price,'tax'=>$getTax->tax,'grand_total'=>$grndTtl);
			$lastId=$this->common->save_data('temp_package_purchase',$createArr);
			//$lastId='1';				  
			if($lastId)
			{
					$whereConRowExist=array('member_id'=>$post['buyerID'],'pur_type'=>$pur_type);
		        	$isPackRowExit=$this->common->get_data('temp_package_purchase',$whereConRowExist,'count(*) as totalRow,sum(grand_total) as grndTotal');
					if($isPackRowExit){$totalNumber=$isPackRowExit['totalRow'];}else{$totalNumber=1;}
				    $onclick="delPackTempKart('".$lastId."@@@@".$gePack->pack_name."')";
			        $myRow='<tr id="delArv-'.$lastId.'" class="dynamicRows">
							<th id="serial-'.$lastId.'">'.$totalNumber.'.</th>
					    	<td>'.$gePack->pack_name.'</td>
							<td id="pQty--'.$lastId.'">'.$post['packQty'].'</td>
							<td><i class="bx bx-rupee inrP"></i> '.$gePack->pack_price.'</td>
							<td>'.$gePack->b_volume.'</td>
							<td id="netAmt--'.$lastId.'"><span id="tProPrice-'.$lastId.'"><i class="bx bx-rupee inrP"></i> '.number_format($grndTtl,2).'</span>
							<button class="kartTrash" onclick="'.$onclick.'" type="button" ><i class="bx bx-trash"></i></button></td>
						    </tr>';
							
					$netPaybleAmt=$isPackRowExit['grndTotal'];/*+($grndTtl*$getTax->tax)/100*/
					$msg='Thank You! You have successfully add details';
					$data = array('miResult' => 'success', 'text' => $myRow,'grndT'=>$netPaybleAmt,/*'netPaybleAmt'=>number_format($netPaybleAmt,2),'tax'=>$getTax->tax,*/
								  'adClass'=>'tst_success','msg'=>$msg);
					//print_r($data);			  
								  					
				}				  
			}
		else{$msg=array('Oops it seems server taking more time please refresh');$data = array('miResult'=>'warning','adClass' => 'tst_warning', 'text' =>$msg);}	
	}
	echo json_encode($data);  
}	
public function package_pay()
{
	$tnxNu=date('Hdis');$purDate=date('y-m-d H:i:s');
	$post=$this->input->post();
	$isCheck=array('1'=>'F','2'=>'S','3'=>'M');$usrNm=substr($post['buyerID'],0,1); $pur_type=array_search($usrNm,$isCheck);
	$whereCon=array('member_id'=>$post['byrID'],'pur_type'=>$pur_type);
	$getDetails=$this->sale->getPackageData($post['byrID'],$pur_type);$tPurchaseAmt=$getDetails['grndAmt']/*+($getDetails['grndAmt']*$getDetails['tax'])/100*/;
	$salePackArr=array('pur_type'=>$pur_type,'tnx_id'=>$tnxNu,'mem_id'=>$post['buyerID'],'grndAmt'=>$getDetails['grndAmt'],'tax'=>'0.00','pur_bv'=>$getDetails['pcBV'],
					   'paid_amt'=>$post['paybleAmt'],'order_status'=>'Delivered','issued_by'=>'0','created_by'=>$this->logId,'purchase_date'=>$purDate,'delivery_date'=>$purDate);				   
	$createPurTnx=$this->common->save_data('package_purchase',$salePackArr);				   
	if($createPurTnx)
	{
		$getTmpPackage=$this->common->all_data_con('temp_package_purchase',$whereCon,'*');
		if($getTmpPackage)
		{
			foreach($getTmpPackage as $vList)
			{
				if($vList['pack_qty'] > 0)
				{
					for($x=1;$x<=$vList['pack_qty'];++$x)
					{
						$packNu = rand(10000, 99999);
						if ($this->common->count_all('package_purchase_details', array('pack_nu' => $packNu)) > 0) {
							$packNu = $packNu + 1;
							if ($this->common->count_all('package_purchase_details', array('pack_nu' => $packNu)) > 0) {
								$packNu = $packNu + 2;
								if ($this->common->count_all('package_purchase_details', array('pack_nu' => $packNu)) > 0) {
									$packNu = $packNu + 3;
								}
							}
						}
						
						$createPackageArr=array('pur_id'=>$createPurTnx,'pur_type'=>$pur_type,'pack_id'=>$vList['pack_id'],'pack_nu'=>'PC'.$packNu,'amount'=>$vList['pack_amt'],
												'pack_password'=>'PS'.($packNu+99),'pack_bv'=>$vList['pack_bv'],'issue_to'=>$post['buyerID'],'generate_time'=>$purDate,
												'generated_type'=>'0','generated_by'=>$this->logId,'status'=>'Un-used');
						$this->common->save_data('package_purchase_details',$createPackageArr);
						}
					}
				}
				$walletTnxFrByrArr=array('tnx_id'=>$tnxNu,'tnx_typ'=>'2','user_id'=>$post['buyerID'],'debit_amt'=>$tPurchaseAmt,'reason'=>'Amount debited after package purchase',
							             'created_by'=>'0','create_date'=>date('Y-m-d H:i:s'));	
				$createWallTnxFrByr=$this->common->save_data('partner_wallet_transaction',$walletTnxFrByrArr);	
				if($createWallTnxFrByr)
				{						 	
					 
					 $createCompLedger=array('tnx_id'=>$tnxNu,'tnx_type'=>'4','user_type'=>'0','reason'=>'Amount credited after package purchase of partner # '.$post['buyerID'],
											 'credit_amt'=>$tPurchaseAmt,'created_by'=>$this->logId,'created_date'=>date('Y-m-d H:i:s'),'generated_by'=>'1');
				     $createCompanyInc=$this->common->save_data('company_income',$createCompLedger);
					 if($createCompanyInc)
					 {
						$cnfDel=$this->common->del_data_multi_con('temp_package_purchase',$whereCon);
						if($cnfDel)
					  	{$data=array('adClass'=>'tst_success','text'=>'Thank You! You have successfully process your order');}
						else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems there is an issues while clearing temporary order');}		
						}
						else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems there is an issues while clearing temporary order');}	
				}
		   else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems there is an issues while creating wallet transaction');}						
	    }
	}
	else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems there is an issues while creating package sale transaction');}
	if($data['adClass']=='tst_success')
	{
		redirect(base_url('mlm_software/admin/sale/package'));
		}
		else
		{
			redirect(base_url('mlm_software/admin/sale/package/add'));
			}		
	
 }		

























			
}
