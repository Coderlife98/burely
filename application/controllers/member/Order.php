<?php defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('member/order_model', 'order');
		$this->load->model('partner/partner_model', 'partner');
		$this->load->model('member/Member_model', 'member');
        ($this->session->userdata('mem_id')== '') ? redirect(base_url().'member/login', 'refresh') : '';
	    $this->logId=$this->session->userdata('mem_id');
	    $this->u_id=$this->session->userdata('u_id');
		$this->baseUrl=base_url();
	    error_reporting(0);
    }
   public function index($actn=NULL)
    {
		if($actn)
		{		
			$post_data = $this->input->post();
			####################### print_r($post_data);die;#######################
			$record = $this->order->my_ordes($post_data,$this->logId);
			####################### echo $this->db->last_query();die;#######################
			$i = $post_data['start'] + 1;$return['data'] = array();$amt = 0;
			foreach ($record as $row) {
			if ($row->order_status=='0'){$stsTex='Cancelled';$activeCls='ordCancel';} 
			else if ($row->order_status=='1'){$stsTex='Placed';$activeCls='ordPlced';}
			else if ($row->order_status=='2'){$stsTex ='Shipped';$activeCls='ordShipped';}
			else if ($row->order_status=='3'){$stsTex='Delevered';$activeCls='ordDelevered';}
			else {$stsTex='Not Yet';$activeCls='setBtnGr dctive';}
			$getUid = base_url('member/order/detials/'.urlencode(base64_encode($row->invoice_id)));
			$actionBtn = '<div style="text-align:center;">
								<a href="'.$getUid.'" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
						  </div>';
			$grandTamt=$row->grand_total;
			if($row->delevery_date){$delivery=date('d-m-Y',strtotime($row->delevery_date));}else{ $delivery='N/A';}
			$return['data'][] = array(
										'<strong>' . $i++ . '.</strong>',
										$row->invoice_id,
										'<i class="bx bx-rupee inrP"></i> '.number_format($grandTamt,2),
										'<i class="bx bx-rupee inrP"></i> '.$row->paid_amt,
										date('d-m-Y',strtotime($row->order_date)),
										$delivery,
										'<div class="' . $activeCls . ' getAction"><span>' . $stsTex . '</span></div>',
										$actionBtn
										);
		}
			$return['recordsTotal'] = $this->order->total_count($this->logId);
			$return['recordsFiltered'] = $this->order->total_filter_count($post_data,$this->logId);
			$return['draw'] = $post_data['draw'];
			echo json_encode($return);
			
			}
			else
			{
				$data['title'] = 'My orders';
				$data['breadcrums'] = 'My orders';
				$data['target'] = 'member/order/index/1';
				$data['layout'] = 'order/_list.php';
				$this->load->view('member/base',$data);
   	 		}
	 } 
   public function detials($id)
   {
  	 	$orderDetails=NULL;$member=NULL;
		$invId = base64_decode(urldecode($id));
		$whereInvId=array('invoice_id'=>$invId);
		
		$getFrenchise=NULL;$getBuyer=NULL;
		$ordHistory=$this->common->get_data('sale_history',$whereInvId,'*');
		$getFrenchise=$this->partner->profile_details($ordHistory['seller_id']);
		$getBuyer=$this->member->profile_details($ordHistory['customer_id']);
		$orderDetails=$this->common->all_data_con('sale_details',$whereInvId,'*');
		
		$data['getBuyer'] = $getBuyer;
		$data['getFrenchise'] = $getFrenchise;
		$data['invId']=$invId;	$data['ordHistory']=$ordHistory;
		$data['orderDetails']=$orderDetails;
		
		
		$data['title'] = 'My orders';
		$data['breadcrums'] = 'My orders';
		$data['target'] = 'member/order/index/1';
		$data['layout'] = 'order/_view.php';
		$this->load->view('member/base',$data);
		}
   public function get_preview($id)
   {	
		$invId = base64_decode(urldecode($id));
		$whereInvId=array('invoice_id'=>$invId);
		$member=NULL;
		$getFrenchise=NULL;
		$ordHistory=$this->common->get_data('sale_history',$whereInvId,'*');
		$getFrenchise=$this->partner->profile_details($ordHistory['seller_id']);
		$member=$this->member->profile_details($ordHistory['customer_id']);

		
		$ordDetails='sale_details';
		$data['getFrenchise']=$getFrenchise;
		$data['member']=$member;
		$orderDetails=$this->common->all_data_con($ordDetails,$whereInvId,'*');
		
		$data['ordHistory']=$ordHistory;
		$data['orderDetails']=$orderDetails;
		 $this->load->view('partner/order/_print_preview', $data);			
		}		
		
	public function add_kart()
	{
		$data['title'] = 'Add Kart';
		$data['breadcrums'] = 'Add Kart';
		//$data['target'] = 'member/order/index/1';
		$data['layout'] = 'order/order_now.php';
		$this->load->view('member/base',$data);
		
		}		
	public function getPartner()
	{
		$post=$this->input->post();
		if($post['sellerType']=='1' && substr($post['sellerID'],0,1)=='S')
		{$data=array('adClass'=>'tst_danger','msg'=>'Please input valid frenchise id otherwise choose seller type');}
		else if($post['sellerType']=='2' && substr($post['sellerID'],0,1)=='F')
		{$data=array('adClass'=>'tst_danger','msg'=>'Please input valid shopee id otherwise choose seller type');}
		else
		{
			$getFrenchise=$this->partner->profile_details_by_username($post['sellerID']);
			if($getFrenchise)
			{
				$getTempPurList=$this->getTempPurchase($getFrenchise->id,$post['sellerType'],$this->logId);	
				if($getFrenchise->stN){$address=$getFrenchise->address.' <br>'.$getFrenchise->ctyN.','.$getFrenchise->stN.','.$getFrenchise->zipcode;}
				else{if($getFrenchise->address){$address=$getFrenchise->address;}else{$address='N/A';}}
				
				
				if($getFrenchise->email){ $email=$getFrenchise->email;}else{ $email='N/A';}
				$data=array('adClass'=>'tst_success','msg'=>'You have searched details here','slrCode'=>$getFrenchise->username,'slrProp'=>$getFrenchise->shop_name,
							'slrName'=>$getFrenchise->name,'slrAddr'=>$address,
							'slrContct'=>$getFrenchise->mobile,'slrEmail'=>$email,'slrID'=>$getFrenchise->id,'getTempPurList'=>$getTempPurList);
				}
				else{$data=array('adClass'=>'tst_danger','msg'=>'You have already dilevered this order');}
				}
		 echo json_encode($data);
		}	
		
public function search_product()
{
	$post=$this->input->post();
	$plist=$this->order->getProductByFrenchiseStock($post['slrID'],$post['proName']);
	if($plist){foreach($plist as $list){$onclick="camSaleByFrenchise('".$list->id."')";echo '<li onclick="'.$onclick.'" data-id="">'.$list->product_name.'</li>';}}
	else{echo '<li style="color:#e86d00;border-bottom: 1px dashed #324234;"><i class="dripicons-warning"></i> Oops no product available</li>';}
	}	
public function kart_by_frenchise_to_member()
{
	$post=$this->input->post();
	$plist=$this->order->temp_kart_add_by_member($post['slrID'],$post['proId']);
	echo json_encode($plist);
	} 
	
	public function addTempKart()
	{
		 $post=$this->input->post();//print_r($post);die;
		 $plist=$this->order->temp_kart_add($post['proID'],$post['slrID']);
		 if($plist->quantity < $post['proQty']){$data=array('miResult'=>'error','text'=>"Oops it seems's we have only ".$plist->quantity." in our stock",'adClass'=>'tst_warning');}
		 else{
				$adminCharge=$this->common->getRowData('club_income','id','1');
				$tempProduct=$this->order->temp_product_count_seller_to_buyer($this->logId,$post['slrID'],$post['sellerType']);
				$totalNumber=$tempProduct->c+1;		 				
				$tAmt=$post['proQty']*$plist->product_price;
				$netAmtAftrDis=$tAmt-($tAmt*$plist->discount)/100;
				
				$netAmt=$netAmtAftrDis+($netAmtAftrDis*$plist->productTax)/100;
				//if($this->u_cate=='1'){$soldBy=$this->u_cate;$receivedBy='2';}else if($this->u_cate=='2'){$soldBy=$this->u_cate;$receivedBy='3';}else{$soldBy='0';$receivedBy='1';}
				
			    $isConWhere=array('seller_id'=>$post['slrID'],'product_details_id'=>$post['proID'],'member_id'=>$this->logId,'soldBy'=>$post['sellerType'],'receiver_typ'=>'3');
				$isExistData=$this->common->get_data('temp_product_details',$isConWhere,'*');
				if($isExistData)
				{
					
					$newQty=$post['proQty']+$isExistData['product_qty'];
					$newTamt=$newQty*$isExistData['product_selling_price'];
					
					$netAmtAftrDis=$newTamt-($newTamt*$isExistData['discount'])/100;
					
					
					$netAmt=$netAmtAftrDis+($netAmtAftrDis*$isExistData['productTax'])/100;
					$onclick="delSaleTempKart('".$isExistData['id']."@@@@".$plist->product_name."')";
					$myRowUpdate=array('qty'=>$newQty,'tAmt'=>'<i class="bx bx-rupee inrP"></i> '.number_format($newTamt,2),'netAmt'=>'<i class="bx bx-rupee inrP"></i> '.number_format($netAmt,2).' <button class="kartTrash" onclick="'.$onclick.'"  type="button"><i class="bx bx-trash"></i></button>');
					$whereCon=array('id'=>$isExistData['id']);
					$updateTempKart=array('product_qty'=>$newQty,'total_amount'=>$netAmtAftrDis,'net_amount'=>$netAmt);
					if($this->common->update_data('temp_product_details',$whereCon,$updateTempKart))
					{
						$whereConForGrand=array('seller_id'=>$post['slrID'],'member_id'=>$this->logId,'soldBy'=>$post['sellerType'],'receiver_typ'=>'3');
						$grandTotalAmt=$this->common->get_data('temp_product_details',$whereConForGrand,'sum(net_amount) as gTotal');
						$netPaybleAmt=$grandTotalAmt['gTotal']+($grandTotalAmt['gTotal']*$adminCharge->tax)/100+$adminCharge->shipping_charges;
						$data=array('miResult'=>'miRowUpdate','text'=>$myRowUpdate,'rowUpdate'=>$post['proID'],'grndT'=>$grandTotalAmt['gTotal'],
									'netPaybleAmt'=>number_format($netPaybleAmt,2),'adClass'=>'tst_success','msg'=>'Thank You! You have successfully update details',
									'tax'=>$adminCharge->tax,'admn_charge'=>$adminCharge->shipping_charges);
										 }
					else{$msg=array('Oops it seems server taking more time please refresh');$data = array('miResult'=>'warning','adClass' => 'tst_warning', 'text' =>$msg);}
					}
				else
				{
					$addTempArray=array(
										'member_id'=>$this->logId,
										'soldBy'=>$post['sellerType'],
										'seller_id'=>$post['slrID'],
										'product_details_id'=>$plist->id,
										'product_id'=>$plist->prod_id,
										'p_unit'=>$plist->unit_name,'productBV'=>$plist->productBV,
										'product_name'=>$plist->product_name,
										'product_selling_price'=>$plist->product_price,
										'product_mrp'=>$plist->mrp,
										'product_qty'=>$post['proQty'],
										'discount'=>$plist->discount,
										'total_amount'=>$tAmt,'productTax'=>$plist->productTax,
										'net_amount'=>$netAmt,
										'receiver_typ'=>'3'
										);	
			   $lastId=$this->common->save_data('temp_product_details',$addTempArray);
			      // $lastId='1';	
				if($lastId)
				{
					$onclick="delSaleTempKart('".$lastId."@@@@".$plist->product_name."')";
			        $myRow='<tr id="delArv-'.$lastId.'">
							<th id="serial-'.$lastId.'">'.$totalNumber.'.</th>
					    	<td>'.$plist->product_name.'</td>
							<td id="pQty--'.$plist->id.'">'.$post['proQty'].'</td>
							<td>'.$plist->productBV.'</td>
							<td><i class="bx bx-rupee inrP"></i> '.$plist->mrp.'</td>
							<td><i class="bx bx-rupee inrP"></i> '.$plist->product_price.'</td>
							<td>'.$plist->discount.' <i class="mdi mdi-percent-outline inrP"></i></td>
							<td  id="tAmt--'.$plist->id.'"> <i class="bx bx-rupee inrP"></i>'. number_format($netAmtAftrDis,2).'</td>
							<td>'.$plist->productTax.' <i class="mdi mdi-percent-outline inrR"></i></td>
							<td id="netAmt--'.$plist->id.'"><span id="tProPrice-'.$plist->id.'"><i class="bx bx-rupee inrP"></i> '.number_format($netAmt,2).'</span>
							<button class="kartTrash" onclick="'.$onclick.'" type="button" ><i class="bx bx-trash"></i></button></td>
						    </tr>';
					//print_r($myRow);echo '<br>';print_r($plist);		
					$whereConForGrand=array('seller_id'=>$post['slrID'],'member_id'=>$this->logId,'soldBy'=>$post['sellerType'],'receiver_typ'=>'3');
					$grandTotalAmt=$this->common->get_data('temp_product_details',$whereConForGrand,'sum(net_amount) as gTotal');
					$netPaybleAmt=$grandTotalAmt['gTotal'];
					$msg='Thank You! You have successfully add details';
					$data = array('miResult' => 'success', 'text' => $myRow,'grndT'=>$grandTotalAmt['gTotal'],'netPaybleAmt'=>number_format($netPaybleAmt,2),
								  'adClass'=>'tst_success','msg'=>$msg);
					}
				else{$msg=array('Oops it seems server taking more time please refresh');$data = array('miResult'=>'warning','adClass' => 'tst_warning', 'text' =>$msg);}	
			}	
			}
			//print_r($data);
		  echo json_encode($data);  
		}	
	
				
public function getTempPurchase($sellerId,$sellerCate,$buyerId)
{
	$adminCharge=$this->common->getRowData('club_income','id','1');
	if($sellerCate=='1'){$soldBy=$sellerCate;}else if($sellerCate=='2'){$soldBy=$sellerCate;}else{$soldBy='0';}
	$whereCon=array('member_id'=>$buyerId,'seller_id'=>$sellerId,'soldBy'=>$soldBy,'receiver_typ'=>'3');
	$tempOrderDetails=$this->common->all_data_con('temp_product_details',$whereCon,'*');
	if($tempOrderDetails)
	{
		$ctr=0;	$grandTotal=0;$content='';	
		foreach($tempOrderDetails as $dList)
		{$ctr++;$tAmt=$dList['product_selling_price']*$dList['product_qty'];
			    $netAmtAftrDis=$tAmt-($tAmt*$dList['discount'])/100;
				$netAmt=$netAmtAftrDis+($netAmtAftrDis*$dList['productTax'])/100;
				$grandTotal+=$netAmt;
		$kartTrash="delSaleTempKart('".$dList['id'].'@@@@'.$dList['product_name']."')";
		$content.='<tr id="delArv-'.$dList['id'].'">
				<th id="serial-'.$dList['id'].'">'.$ctr.'.</th><td>'.$dList['product_name'].'</td>
				       <td id="pQty--'.$dList['product_details_id'].'">'.$dList['product_qty'].'</td>
					   <td>'.$dList['productBV'].'</td>
					   <td><i class="bx bx-rupee inrP"></i> '.$dList['product_mrp'].'</td>
					   <td><i class="bx bx-rupee inrP"></i> '. $dList['product_selling_price'].'</td>
					    <td>'.number_format($dList['discount'],2).' <i class="mdi mdi-percent-outline inrP"></i></td>
					   <td id="tAmt--'.$dList['product_details_id'].'"><i class="bx bx-rupee inrP"></i> '.number_format($netAmtAftrDis,2).'</td>
					   <td>'.number_format($dList['productTax'],2).' <i class="mdi mdi-percent-outline inrR"></i></td>
					   <td id="netAmt--'.$dList['product_details_id'].'"><i class="bx bx-rupee inrP"></i> '.number_format($netAmt,2).'
					   <button class="kartTrash" onclick="'.$kartTrash.'" type="button"><i class="bx bx-trash"></i></button></td></tr>';
		}
		$paybleAmt=$grandTotal+$adminCharge->shipping_charges+($grandTotal*$adminCharge->tax)/100;	
		$result=array('getOrd'=>$content,'miTxt'=>'success','grandTotal'=>number_format($grandTotal,2),'paybleAmt'=>number_format($paybleAmt,2),'shipInC'=>$adminCharge->shipping_charges,'texPer'=>$adminCharge->tax);
		return $result;
		//print_r($result);
	 }
  }					
public function manage()
{
	$post=$this->input->post();	
	if($post['actn']=='delTempSaleProduct')
	{		
		$proDetails = $this->common->getRowData('temp_product_details','id',$post['dataId']);
		$whereMultiCon=array('member_id'=>$proDetails->member_id,'seller_id'=>$proDetails->seller_id,'soldBy'=>$proDetails->soldBy,'receiver_typ'=>$proDetails->receiver_typ);		
		$whereCon=array('id'=>$post['dataId'],'table'=>'temp_product_details');
	    $delDetails=$this->common->del_data($whereCon);
		if($delDetails)
		{
			$tempOrderDetails=$this->common->all_data_con('temp_product_details',$whereMultiCon,'*');
			$idArr=array();
			if($tempOrderDetails)
			{
				$grandTotal=0;
				$adminCharge=$this->common->getRowData('club_income','id','1');
				foreach($tempOrderDetails as $miList)
				{	
					$tAmt=$miList['product_selling_price']*$miList['product_qty'];$netAmt=$tAmt-($tAmt*$miList['discount'])/100;$grandTotal+=$netAmt;
					array_push($idArr,$miList['id']);
					}
				$paybleAmt=$grandTotal+$adminCharge->shipping_charges+($grandTotal*$adminCharge->tax)/100;	
				$data=array(
							'adClass'=>'tst_success',
							'text'=>'Thank you! you have successfully delete',
							'id'=>$post['dataId'],
							'srCnt'=>$idArr,
							'grandTotal'=>$grandTotal,
							'paybleAmt'=>$paybleAmt
							);
				
				}
			else{$data=array('adClass'=>'tst_danger','text'=>'Please add product to sale');}
		}
	     else{$data=array('adClass'=>'tst_danger','text'=>'<i class="mdi mdi-alert-outline me-2"></i> Oops it seems error while deleting');}
		}
		else{$data=array('adClass'=>'tst_danger','text'=>'Oops there is something went wrong while deleting');}
		echo json_encode($data);  
}	
	
public function makePayment()
{
	$post=$this->input->post();$tempOrderDetails=NULL;$data['ordID'] ='MSDR'.date('his');
	$adminCharge=$this->common->getRowData('club_income','id','1');$data['adminCharge']=$adminCharge;
	if($post['sellerType']=='1'){$oprsnTitle='This order proccess from frenchise';}if($post['sellerType']=='2'){$oprsnTitle='This order proccess from shopee';}
	$whereMultiCon=array('member_id'=>$this->logId,'seller_id'=>$post['slrID'],'soldBy'=>$post['sellerType'],'receiver_typ'=>'3');		
	$tempOrderDetails=$this->common->all_data_con('temp_product_details',$whereMultiCon,'*');
	$data['seller']=$this->order->getProviderDet($post['slrID']);
	$data['buyer']=$this->order->getBuyerDet($this->logId);
	$data['tempOrderDetails'] = $tempOrderDetails;
	$data['provider']=$post;
	$data['oprsnTitle']=$oprsnTitle;
	$data['title'] = 'Make Paymnet';
	$data['breadcrums'] = 'Make Payment';
	$data['target'] = 'member/order/pay_confrim';
	$data['layout'] = 'order/make_payment.php';
	$this->load->view('member/base',$data);
	}		
public function payment_success()
{
	$post=$this->input->post();$saleDate=date('Y-m-d');
	$saleDate=date('Y-m-d');
	$saleData=explode("@@@@@",base64_decode(urldecode($post['saleID'])));
	$whereCon=array('member_id'=>$this->logId,'seller_id'=>$saleData[4],'soldBy'=>$saleData[5],'receiver_typ'=>'3');
	$tempSaleDetails=$this->common->all_data_con('temp_product_details',$whereCon,'*');
	if($tempSaleDetails)
	{
		
		$grandTotalAmt=$saleData[1];
		$ord_HistoryArr=array('invoice_id'=>$saleData[0],'customer_id'=>$this->logId,'grand_total'=>$grandTotalAmt,'paid_amt'=>$post['paybleAmt'],'tax'=>$saleData[3],
							  'shipping_charge'=>$saleData[2],'order_date'=>$saleDate,'order_status'=>'1','soldBy'=>$saleData[5],'seller_id'=>$saleData[4],
							  'delevery_date'=>$saleDate);
							  
		$createSaleHistory=$this->common->save_data('sale_history',$ord_HistoryArr);	
		if($createSaleHistory)
		{						
			$purchasedBV=0;
			foreach($tempSaleDetails as $dList)
			{
				$pBV=$dList['product_qty']*$dList['productBV'];
				$tAmt=$dList['product_selling_price']*$dList['product_qty'];
				$netAmtAftrDis=$tAmt-($tAmt*$dList['discount'])/100;
				
				$netAmt=$netAmtAftrDis+($netAmtAftrDis*$dList['productTax'])/100;
				
				$saleDataArr=array('order_id'=>$createSaleHistory,'invoice_id'=>$saleData[0],'member_id'=>$this->logId,'product_details_id'=>$dList['product_details_id'],
								   'product_id'=>$dList['product_id'],'product_name'=>$dList['product_name'],'product_selling_price'=>$dList['product_selling_price'],				                                   'product_mrp'=>$dList['product_mrp'],'product_qty'=>$dList['product_qty'],'discount'=>$dList['discount'],'total_amount'=>$tAmt,
								   'productTax'=>$dList['productTax'],'productBv'=>$pBV,'net_amount'=>$netAmt);
				  if($this->common->save_data('sale_details',$saleDataArr)){$result='1';$purchasedBV+=$pBV;}else{$result='2';}		   	
				}
			if($result=='1')
			{
				
			  $tnxNu=date('dHis');
			  $tPurchaseAmt=$grandTotalAmt;//+$saleData[3]+($grandTotalAmt*$saleData[4])/100;
			  $earnBvWhere=array('id'=>$createSaleHistory);
			  $updtEarnedBvArr=array('earnedBv'=>$purchasedBV);
			  if($this->common->update_data('sale_history',$earnBvWhere,$updtEarnedBvArr))
			  {
				$walletTnxFrByrArr=array('tnx_id'=>$tnxNu,'user_id'=>$this->u_id,'debit_amt'=>$tPurchaseAmt,'reason'=>'Amount debited after product purchase',
										 'created_by'=>'0','create_date'=>date('Y-m-d H:i:s'));							
			   $createWallTnxFrByr=$this->common->save_data('wallet_transaction',$walletTnxFrByrArr);	
			   if($createWallTnxFrByr)
			   {
				   if($this->common->del_data_multi_con('temp_product_details',$whereCon))
				  {	
					$data=array('adClass'=>'tst_success','text'=>'Thank You! You have successfully process your order','targetUrl'=>base_url('member/order'));
					}
					else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems there is an issues while clearing temporary order');}
					
					}
					else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems there is an issues while creating wallet transaction');}				
			   }
			else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems there is an issues while updating product bv');}
			}
			 else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems there is an issues while creating order');}							
		
		}
		 else{$data=array('adClass'=>'tst_danger','text'=>'There is no data in sale kart');}			
		 echo json_encode($data);
	}		
	}	
		
		
		
		
}
