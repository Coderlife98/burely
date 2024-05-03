<?php defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('partner/order_model', 'order');
		$this->load->model('partner/partner_model', 'partner');
        ($this->session->userdata('partner_id')== '') ? redirect(base_url().'partner/login', 'refresh') : '';
	    $this->logId=$this->session->userdata('partner_id');
	    $this->u_id=$this->session->userdata('partner_username');
		$this->u_cate=$this->session->userdata('p_cate');
		$this->baseUrl=base_url();
	    error_reporting(0);
    }
    public function index()
    {
		$data['title'] = 'Dashboard';
    	$data['breadcrums'] = 'Dashboard';
    	$data['layout'] = 'order/_list.php';
		$this->load->view('partner/base',$data);
   	 } 
    public function add_kart()
    {
		$tempOrderDetails=NULL;
		$getFrenchise=NULL;$getBuyer=NULL;
		if($this->u_cate=='2')
		{
			$getBuyer=$this->partner->profile_details($this->logId);
			$getFrenchise=$this->partner->profile_details($getBuyer->assigned_seller);
			}
			else{$tempOrderDetails=$this->order->temp_product_list($this->logId,'0','1');}
				
				
		$data['targetUrl']=base_url('partner/order/make_payment/');		
		$data['adminCharge']=$this->common->getRowData('club_income','id','1');
		$data['tempOrderDetails'] = $tempOrderDetails;
		$data['getBuyer'] = $getBuyer;
		$data['getFrenchise'] = $getFrenchise;
		$data['title'] = 'Add Kart';
        $data['breadcrums'] = 'Add Kart';
        $data['layout'] = 'order/order_now.php';
        $this->load->view('partner/base', $data);	
   	 }
    public function my_orders()
	{
		$post_data = $this->input->post();
		$record = $this->order->order_data($post_data,$this->logId);
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		foreach ($record as $row) {
			if ($row->order_status=='0'){$stsTex='Cancelled';$activeCls='ordCancel';} 
			else if ($row->order_status=='1'){$stsTex='Placed';$activeCls='ordPlced';}
			else if ($row->order_status=='2'){$stsTex ='Shipped';$activeCls='ordShipped';}
			else if ($row->order_status=='3'){$stsTex='Delevered';$activeCls='ordDelevered';}
			else {$stsTex='Not Yet';$activeCls='setBtnGr dctive';}
			$getUid = base_url('partner/order/detials/'.urlencode(base64_encode($row->invoice_id)));
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
		$return['recordsFiltered'] = $this->order->filter_count($post_data,$this->logId);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	} 
	public function detials($id)
	{
		$orderDetails=NULL;$sellerData=NULL;
		$invId = base64_decode(urldecode($id));
		$whereInvId=array('invoice_id'=>$invId);
		$data['member']=$this->partner->profile_details($this->logId);
		$orderDetails=$this->common->all_data_con('order_details',$whereInvId,'*');
		$ordHistory=$this->common->get_data('order_history',$whereInvId,'*');
		$data['invId']=$invId;	$data['ordHistory']=$ordHistory;
		
		if($this->u_cate=='2')
		{ if($ordHistory['soldBy']=='1'){$sellerData=$this->partner->profile_details($ordHistory['seller_id']);}
		  else if($ordHistory['soldBy']=='0'){$sellerData=$this->partner->admin_profile($ordHistory['seller_id']);}
			}
		else if($this->u_cate=='1'){if($ordHistory['seller_id']){$sellerData=$this->partner->admin_profile($ordHistory['seller_id']);}else{$sellerData=NULL;}}
		
		$data['sellerData']=$sellerData;
		$data['orderDetails']=$orderDetails;
		$data['title'] = 'Order Details';
        $data['breadcrums'] = 'Order Details';
        $data['layout'] = 'order/_view.php';
        $this->load->view('partner/base', $data);	
		}
	public function get_preview($id)
	{	
		$invId = base64_decode(urldecode($id));
		$whereInvId=array('invoice_id'=>$invId);
		$member=NULL;
		
		$getFrenchise=NULL;
		if($this->u_cate=='1')
		{
			$ordHistory=$this->common->get_data('order_history',$whereInvId,'*');
			$getFrenchise=$this->partner->profile_details($ordHistory['seller_id']);
			$member=$this->partner->profile_details($ordHistory['customer_id']);
			$ordDetails='order_details';
			}
		else if($this->u_cate=='2')
		{
			$ordHistory=$this->common->get_data('sale_history',$whereInvId,'*');
			$getFrenchise=$this->partner->profile_details($ordHistory['seller_id']);
			$member=$this->partner->profile_details($ordHistory['customer_id']);
			$ordDetails='sale_details';
		}
		$data['getFrenchise']=$getFrenchise;
		$data['member']=$member;
		$orderDetails=$this->common->all_data_con($ordDetails,$whereInvId,'*');
		
		$data['ordHistory']=$ordHistory;
		$data['orderDetails']=$orderDetails;
		 $this->load->view('partner/order/_print_preview', $data);			
		}	
	public function product_list()
	{
		$post=$this->input->post('proName');
		$plist=$this->order->product_list($post);
		if($plist){foreach($plist as $list){$onclick="camKart('".$list->id."')";echo '<li onclick="'.$onclick.'" data-id="">'.$list->product_name.'</li>';}}
		else{echo '<li style="color:#e86d00;border-bottom: 1px dashed #324234;"><i class="dripicons-warning"></i> Oops no product available </li>';}
		}	
	public function set_kart_product()
	{
		  $post=$this->input->post('proId');$plist=$this->order->temp_kart_add($post,$this->u_cate,'spAdmn');
		  echo json_encode($plist);
		}
	public function addTempKart()
	{
		 $post=$this->input->post();
		 $plist=$this->order->temp_kart_add($post['proID'],$this->u_cate,$post['soldBy']);
		 if($this->u_cate=='1'){ $btnFnction='delTempKart';}elseif($this->u_cate=='2'){ $btnFnction='delSaleTempKartByShopee';}else{$btnFnction='amiActn';}
		 
		//echo $this->db->last_query();echo '<br>';print_r($plist);die;
		
		 if($plist->quantity < $post['proQty']){$data=array('miResult'=>'error','text'=>"Oops it seems's we have only ".$plist->quantity." in our stock",'adClass'=>'tst_warning');}
		 else{
				$adminCharge=$this->common->getRowData('club_income','id','1');
				$tempProduct=$this->order->temp_product_count($this->logId);
			    $totalNumber=$tempProduct->c+1;		 				
				$tAmt=$post['proQty']*$plist->product_price;
				$priceDis=$tAmt-($tAmt*$plist->discount)/100;
				//$getPriceWithTx=$plist->product_price+($plist->product_price*$plist->productTax/100);
				
				$netAmt=$priceDis+($priceDis*$plist->productTax)/100;
				$isConWhere=array('member_id'=>$this->logId,'product_details_id'=>$post['proID'],'receiver_typ'=>$recVD);
				$isExistData=$this->common->get_data('temp_product_details',$isConWhere,'*');
				if($isExistData)
				{
					$newQty=$post['proQty']+$isExistData['product_qty'];
					$newTamt=$newQty*$isExistData['product_selling_price'];
					$proPriceDis=$newTamt-($newTamt*$isExistData['discount'])/100;
					
					$netAmt=$proPriceDis+($proPriceDis*$isExistData['productTax'])/100;
					$onclick=$btnFnction."('".$isExistData['id']."@@@@".$plist->product_name."')";
					$myRowUpdate=array('qty'=>$newQty,'tAmt'=>'<i class="bx bx-rupee inrP"></i> '.number_format($newTamt,2),'netAmt'=>'<i class="bx bx-rupee inrP"></i> '.number_format($netAmt,2).' <button class="kartTrash" onclick="'.$onclick.'"><i class="bx bx-trash"></i></button>');
					$whereCon=array('id'=>$isExistData['id']);
					$updateTempKart=array('product_qty'=>$newQty,'total_amount'=>$newTamt,'net_amount'=>$netAmt);
					if($this->common->update_data('temp_product_details',$whereCon,$updateTempKart))
					{
						$whereConForGrand=array('member_id'=>$this->logId);
						$grandTotalAmt=$this->common->get_data('temp_product_details',$whereConForGrand,'sum(net_amount) as gTotal');
						$data=array('miResult'=>'miRowUpdate','text'=>$myRowUpdate,'rowUpdate'=>$post['proID'],'grndT'=>$grandTotalAmt['gTotal'],
									'adClass'=>'tst_success','msg'=>'Thank You! You have successfully update details');
										 }
					else{$msg=array('Oops it seems server taking more time please refresh');$data = array('miResult'=>'warning','adClass' => 'tst_warning', 'text' =>$msg);}
					}
				else
				{
					if($this->u_cate=='1'){$soldBy='0';$sellerID=NULL;$recVD='1'; }else{$soldBy='1';$sellerID=$post['soldBy'];$recVD='2'; }	
				
					$addTempArray=array(
										'member_id'=>$this->logId,
										'soldBy'=>$soldBy,
										'seller_id'=>$sellerID,
										'product_details_id'=>$plist->id,
										'product_id'=>$plist->prod_id,
										'p_unit'=>$plist->unit_name,
										'product_name'=>$plist->product_name,
										'product_selling_price'=>$plist->product_price,
										'productBV'=>$plist->productBV,
										'product_mrp'=>$plist->mrp,
										'product_qty'=>$post['proQty'],
										'discount'=>$plist->discount,
										'productTax'=>$plist->productTax,
										'total_amount'=>$tAmt,
										'receiver_typ'=>$recVD,
										'net_amount'=>$netAmt
										);	
				$lastId=$this->common->save_data('temp_product_details',$addTempArray);
				if($lastId)
				{
					$onclick=$btnFnction."('".$lastId."@@@@".$plist->product_name."')";
			        $myRow='<tr>
							<td><strong>'.$totalNumber.'.</strong></td>
					    	<td>'.$plist->product_name.'</td>
							<td id="pQty--'.$plist->id.'">'.$post['proQty'].'</td>
							<td>'.$plist->productBV.'</td>
							<td><i class="bx bx-rupee inrP"></i> '.$plist->mrp.'</td>
							<td><i class="bx bx-rupee inrP"></i> '.$plist->product_price.'</td>
							<td>'.$plist->discount.' <i class="mdi mdi-percent-outline fntClr"></i></td>
							<td  id="tAmt--'.$plist->id.'"> <i class="bx bx-rupee inrP"></i>'. number_format($priceDis,2).'</td>
							
							<td>'.$plist->productTax.' <i class="mdi mdi-percent-outline inrR"></i></td>
							<td id="netAmt--'.$plist->id.'"><span id="tProPrice--'.$plist->id.'"><i class="bx bx-rupee inrP"></i> '.number_format($netAmt,2).'</span><button class="kartTrash" onclick="'.$onclick.'"><i class="bx bx-trash"></i></button></td>
						    </tr>';
					$whereConForGrand=array('member_id'=>$this->logId,'receiver_typ'=>$recVD);
					$grandTotalAmt=$this->common->get_data('temp_product_details',$whereConForGrand,'sum(net_amount) as gTotal');
					
					$msg='Thank You! You have successfully add details';
					$data = array('miResult' => 'success', 'text' => $myRow,'grndT'=>$grandTotalAmt['gTotal'],'adClass'=>'tst_success','msg'=>$msg);
					}
				else{$msg=array('Oops it seems server taking more time please refresh');$data = array('miResult'=>'warning','adClass' => 'tst_warning', 'text' =>$msg);}	
			}	
			}
		  echo json_encode($data);  
		}	
	public function tempProductDelete()
	{
		$post=$this->input->post();
		$whereCon=array('id'=>$post['actn'],'table'=>'temp_product_details');
		$delDetails = $this->common->del_data($whereCon);
		if($delDetails){$data=array('icon'=>'1','text'=>'<i class="bx bx-smile"></i>  Thank You! you have successfully delete');} 
		else {$data=array('icon'=>'2','text'=>'<i class="mdi mdi-alert-outline me-2"></i> Oops it seems error while deleting');}
		echo json_encode($data);	
	}	
	public function make_payment($frID=NULL)
	{
		$tempOrderDetails=NULL;
		if($this->u_cate=='1'){$soldBy='0';$recD='1'; $frTnx=date('dHis'); $shopiTnx=NULL;}
		else if($this->u_cate=='2'){$soldBy='1';$recD='2'; $frTnx=NULL;$shopiTnx=date('dHis');}
		$tempOrderDetails=$this->order->temp_product_list($this->logId,$soldBy,$recD);
		
		/*echo $this->db->last_query();echo '<br>';
		print_r($tempOrderDetails);
		exit;*/
		
		$adminCharge=$this->common->getRowData('club_income','id','1');
		$post=$this->input->post();
		if($post['paybleAmt'])
		{
				$orderDate=date('Y-m-d');
				$ordValArr=explode("@@@@@",base64_decode(urldecode($post['orderID'])));
				if($ordValArr[2]){$sellerID=$ordValArr[2];}else{$sellerID=NULL;}
			   $ord_HistoryArr=array('invoice_id'=>$ordValArr[0],'customer_id'=>$this->logId,'grand_total'=>$ordValArr[1],'paid_amt'=>$post['paybleAmt'],'tax'=>$adminCharge->tax,
								     'shipping_charge'=>$adminCharge->shipping_charges,'order_date'=>$orderDate,'order_status'=>'1','soldBy'=>$ordValArr[3],'seller_id'=>$sellerID,
									 'frenchiseTnx'=>$frTnx,'shopeTnx'=>$shopiTnx
									 );
				if($frTnx==NULL){$tnxNu=$shopiTnx;}else{$tnxNu=$frTnx;}	
		        //print_r($ord_HistoryArr);echo '<br>';						 
				$createOrdHistory=$this->common->save_data('order_history',$ord_HistoryArr);	
				if($createOrdHistory)
				{
					if($tempOrderDetails)
					{	
						$purchaseBV=0;
						foreach($tempOrderDetails as $dList)
						{
							$productBV=$dList->product_qty*$dList->productBV;
							$tAmt=$dList->product_selling_price*$dList->product_qty;
							$amtAftrDiscount=$tAmt-($tAmt*$dList->discount)/100;
							
							$netAmt=$amtAftrDiscount+($amtAftrDiscount*$dList->productTax)/100;
							$orderDetArr=array('order_id'=>$createOrdHistory,'invoice_id'=>$ordValArr[0],'member_id'=>$this->logId,'product_details_id'=>$dList->product_details_id,
											   'product_id'=>$dList->product_id,'product_name'=>$dList->product_name,'product_selling_price'=>$dList->product_selling_price,				                                               'product_mrp'=>$dList->product_mrp,'product_qty'=>$dList->product_qty,'discount'=>$dList->discount,'total_amount'=>$tAmt,
											   'net_amount'=>$netAmt,'productBv'=>$productBV,'productTax'=>$dList->productTax);
				   			//print_r($orderDetArr);echo '<br>';
							
								if($this->common->save_data('order_details',$orderDetArr))
								{$result='1';}else{$result='2';}
								$purchaseBV+=$productBV;
							}
							if($result=='1')
							{
								if($this->u_cate=='2')
								{
								$reason='Amount has been debited after that shopee has purchased';
							$walletCreateArr=array('tnx_id'=>$tnxNu,'tnx_typ'=>'2','user_id'=>$this->u_id,'credit_amt'=>$post['paybleAmt'],'reason'=>$reason,'created_by'=>'1','create_date'=>date('Y-m-d'));
							$this->common->save_data('partner_wallet_transaction',$walletCreateArr);
								}
								
								$whereCon=array('id'=>$createOrdHistory);
								$updateHistry=array('earnedBv'=>$purchaseBV);
								$this->common->update_data('order_history',$whereCon,$updateHistry);
								$delTemp=$this->common->del_data_con('temp_product_details','member_id',$this->logId);
								//print_r($updateHistry);
								if($delTemp)
								{$data=array('adClass'=>'tst_success','text'=>'Thank you ! You have successfully complete your order','targetUrl'=>base_url('partner/order'));}
								   else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems there is an issues while updating stock');}
								}
						  else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems there is an issues while updating stock');}
						}
					}
				    else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems there is an issues while creating order');}	
				echo json_encode($data);	
			}
		else
		{	
			$getFrenchise=NULL;$member=NULL;
			$member=$this->partner->profile_details($this->logId);
			if($this->u_cate=='2')
			{
				$getFrenchise=$this->partner->profile_details(base64_decode(urldecode($frID)));
				}
			
			$ordID='Msdr'.date('his');	
			$data['adminCharge']=$adminCharge;
			$data['getFrenchise']=$getFrenchise;
			$data['member']=$member;
			$data['ordID'] = $ordID;
			$data['tempOrderDetails'] = $tempOrderDetails;
			$data['title'] = 'Make Payment';
        	$data['breadcrums'] = 'Make Payment';
        	$data['layout'] = 'order/make_payment.php';
        	$this->load->view('partner/base', $data);
			}
		}
		
	
	public function trashTempProduct()
	{
		$post=$this->input->post();
       if($post['actn']=='delTempSaleProduct')
		{
			
				$whereCon=array('id'=>$post['dataId'],'table'=>'temp_product_details');
				$delDetails=$this->common->del_data($whereCon);
				//$delDetails ='1';
				if($delDetails)
				{
				 if($this->u_cate=='1'){$soldBy='0';$receivedBy=$this->u_cate;}else if($this->u_cate=='2'){$soldBy='1';$receivedBy=$this->u_cate;}else{$soldBy='0';$receivedBy='1';}
					$whereMultiCon=array('member_id'=>$this->logId,'seller_id'=>base64_decode(urldecode($post['slrID'])),'soldBy'=>$soldBy,'receiver_typ'=>$receivedBy);
					$tempOrderDetails=$this->common->all_data_con('temp_product_details',$whereMultiCon,'*');
					   //print_r($whereMultiCon);echo '<br>';
					$idArr=array();
					if($tempOrderDetails)
					{
						$grandTotal=0;$adminCharge=$this->common->getRowData('club_income','id','1');
						foreach($tempOrderDetails as $miList)
						{	
							$tAmt=$miList['product_selling_price']*$miList['product_qty'];
							$netAmtAftrDiscount=$tAmt-($tAmt*$miList['discount'])/100;
							$netAmt=$netAmtAftrDiscount+($netAmtAftrDiscount*$miList['productTax'])/100;
							$grandTotal+=$netAmt;
							array_push($idArr,$miList['id']);
							}$paybleAmt=$grandTotal;	
						$data=array('adClass'=>'tst_success','text'=>'Thank you! you have successfully delete','id'=>$post['dataId'],'srCnt'=>$idArr,'grandTotal'=>$grandTotal);
						}
					else{$data=array('adClass'=>'tst_danger','text'=>'Please add product in your kart');}
				}
			   else{$data=array('adClass'=>'tst_danger','text'=>'<i class="mdi mdi-alert-outline me-2"></i> Oops it seems error while deleting');}
			}
		   else{$data=array('adClass'=>'tst_danger','text'=>'Oops there is something went wrong while deleting');}
		  echo json_encode($data);  
		}	
	
	
	
		
/*--------------------------------------------*/		
/*	public function TESTINGp()
	{
		$tempOrderDetails=NULL;
		if($this->u_cate=='1'){$soldBy='0';$recD='1';}
		else if($this->u_cate=='2'){$soldBy='1';$recD='2';}
		$tempOrderDetails=$this->order->temp_product_list($this->logId,$soldBy,$recD);
		$adminCharge=$this->common->getRowData('club_income','id','1');
		$post=$this->input->post();
		if($post['paybleAmt'])
		{
				$orderDate=date('Y-m-d');
				$ordValArr=explode("@@@@@",base64_decode(urldecode($post['orderID'])));
				if($ordValArr[2]){$sellerID=$ordValArr[2];}else{$sellerID=NULL;}
			   $ord_HistoryArr=array('invoice_id'=>$ordValArr[0],'customer_id'=>$this->logId,'grand_total'=>$ordValArr[1],'paid_amt'=>$post['paybleAmt'],'tax'=>$adminCharge->tax,
								     'shipping_charge'=>$adminCharge->shipping_charges,'order_date'=>$orderDate,'order_status'=>'1','soldBy'=>$ordValArr[3],'seller_id'=>$sellerID);
				$createOrdHistory=$this->common->save_data('order_history',$ord_HistoryArr);			  
				if($createOrdHistory)
				{
					if($tempOrderDetails)
					{	
						$purchaseBV=0;
						foreach($tempOrderDetails as $dList)
						{
							$productBV=$dList->product_qty*$dList->productBV;
							$tAmt=$dList->product_selling_price*$dList->product_qty;$netAmt=$tAmt-($tAmt*$dList->discount)/100;
							$orderDetArr=array('order_id'=>$createOrdHistory,'invoice_id'=>$ordValArr[0],'member_id'=>$this->logId,'product_details_id'=>$dList->product_details_id,
											   'product_id'=>$dList->product_id,'product_name'=>$dList->product_name,'product_selling_price'=>$dList->product_selling_price,				                                               'product_mrp'=>$dList->product_mrp,'product_qty'=>$dList->product_qty,'discount'=>$dList->discount,'total_amount'=>$tAmt,
											   'net_amount'=>$netAmt,'productBv'=>$productBV);
				   
								if($this->common->save_data('order_details',$orderDetArr))
								{
									$result='1';
									//		$isProWhereCon=array('partner_id'=>$this->logId,'product_details_id'=>$dList->product_details_id);				   
//									$isProductExist=$this->common->get_data('partner_stock',$isProWhereCon,'*');
//									if($isProductExist)
//									{
//										   $totalQty=$dList->product_qty+$isProductExist['product_qty'];$whereConStockUp=array('id'=>$isProductExist['id']);
//										   $stockUpdateArr=array('product_qty'=>$totalQty,'lastInStock'=>$dList->product_qty,'modified_type'=>'1','stockInDate'=>$orderDate,
//																 'modify_date'=>$orderDate,'modified_by'=>$this->logId,'stockIncId'=>$createOrdHistory);				  
//										   if($this->common->update_data('partner_stock',$whereConStockUp,$stockUpdateArr)){$result='1';}else{$result='2';}		  					
//										}				   
//										else
//										{
//										  $stockCreateArr=array('partner_id'=>$this->logId,'product_details_id'=>$dList->product_details_id,
//										 						'product_price'=>$dList->product_selling_price,'product_mrp'=>$dList->product_mrp,
//																'product_qty'=>$dList->product_qty,'lastInStock'=>$dList->product_qty,'created_type'=>'1',
//																'last_purchase_id'=>$createOrdHistory,'stockInDate'=>$orderDate,'create_date'=>$orderDate,
//																'created_by'=>$this->logId,'stockIncId'=>$createOrdHistory);
//											if($this->common->save_data('partner_stock',$stockCreateArr)){$result='1';}
//										else{$result='2';}
//									}			   
								}
								else{$result='2';}
								$purchaseBV+=$productBV;
							}
							if($result=='1')
							{
								$whereCon=array('id'=>$createOrdHistory);
								$updateHistry=array('earnedBv'=>$purchaseBV);
								$this->common->update_data('order_history',$whereCon,$updateHistry);
								if($this->common->del_data_con('temp_product_details','member_id',$this->logId))
								{$data=array('adClass'=>'tst_success','text'=>'Thank you ! You have successfully complete your order','targetUrl'=>base_url('partner/order'));}
								   else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems there is an issues while updating stock');}
								
								}
						  else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems there is an issues while updating stock');}
						}
					}
				    else{$data=array('adClass'=>'tst_danger','text'=>'Oops it seems there is an issues while creating order');}	
				echo json_encode($data);	
			}
		else
		{	
			$getFrenchise=NULL;$member=NULL;
			$member=$this->partner->profile_details($this->logId);
			if($this->u_cate=='2')
			{
				$getFrenchise=$this->partner->profile_details($member->assigned_seller);
				}
			
			$ordID='Msdr'.date('his');	
			$data['adminCharge']=$adminCharge;
			$data['getFrenchise']=$getFrenchise;
			$data['member']=$member;
			$data['ordID'] = $ordID;
			$data['tempOrderDetails'] = $tempOrderDetails;
			$data['title'] = 'Make Payment';
        	$data['breadcrums'] = 'Make Payment';
        	$data['layout'] = 'order/make_payment.php';
        	$this->load->view('partner/base', $data);
			}
		}*/
		
	/*		$isProWhereCon=array('partner_id'=>$this->logId,'product_details_id'=>$dList->product_details_id);				   
			$isProductExist=$this->common->get_data('partner_stock',$isProWhereCon,'*');
			if($isProductExist)
			{
				   $totalQty=$dList->product_qty+$isProductExist['product_qty'];$whereConStockUp=array('id'=>$isProductExist['id']);
				   $stockUpdateArr=array('product_qty'=>$totalQty,'lastInStock'=>$dList->product_qty,'modified_type'=>'1','stockInDate'=>$orderDate,
										 'modify_date'=>$orderDate,'modified_by'=>$this->logId,'stockIncId'=>$createOrdHistory);				  
				   if($this->common->update_data('partner_stock',$whereConStockUp,$stockUpdateArr)){$result='1';}else{$result='2';}		  					
				}				   
				else
				{
				  $stockCreateArr=array('partner_id'=>$this->logId,'product_details_id'=>$dList->product_details_id,
										'product_price'=>$dList->product_selling_price,'product_mrp'=>$dList->product_mrp,
										'product_qty'=>$dList->product_qty,'lastInStock'=>$dList->product_qty,'created_type'=>'1',
										'last_purchase_id'=>$createOrdHistory,'stockInDate'=>$orderDate,'create_date'=>$orderDate,
										'created_by'=>$this->logId,'stockIncId'=>$createOrdHistory);
					if($this->common->save_data('partner_stock',$stockCreateArr)){$result='1';}
				else{$result='2';}
			}	*/			
/*--____________________________________*/		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	public function by_shopee()
	{
		$post=$this->input->post();$plist=$this->order->getProductByFrenchiseStock(base64_decode(urldecode($post['frenID'])),$post['proName']);
		//echo $this->db->last_query();
		if($plist){foreach($plist as $list){$onclick="camKartByShopee('".$list->id."')";echo '<li onclick="'.$onclick.'" data-id="">'.$list->product_name.'</li>';}}
		else{echo '<li style="color:#e86d00;border-bottom: 1px dashed #324234;"><i class="dripicons-warning"></i> Oops no product available</li>';}
		}		
	public function kart_product_by_shopee()
	{
		$post=$this->input->post();
		$plist=$this->order->temp_kart_add_by_shopee(base64_decode(urldecode($post['frenId'])),$post['proId']);
	    //echo $this->db->last_query();
		echo json_encode($plist);
		}	
	
	
	
    public function findSeller()
	{
		$post=$this->input->post();
		if($this->u_cate=='1')
		{
			/*$getBuyer=$this->partner->profile_details_by_username($post['buyerID']);
			if($getBuyer)
			{
				$getTempSaleList=$this->getTempSale($this->logId,$this->u_cate,$getBuyer->id);	
			if($getBuyer->address){$address=$getBuyer->address.',<br>'.$getBuyer->ctyN.','.$getBuyer->stN.','.$getBuyer->zipcode;}else{$address=$getBuyer->address;}
			$data=array('adClass'=>'tst_success','byrPic'=>base_url($getBuyer->my_img),'byrCode'=>$getBuyer->username,'byrName'=>$getBuyer->name,'byrAddr'=>$address,'byrContct'=>$getBuyer->mobile,'byrEmail'=>$getBuyer->email,'msg'=>'Thank You! you have found details','byrID'=>$getBuyer->id,'tempSaleList'=>$getTempSaleList);
			}else{$data=array('adClass'=>'tst_warning','msg'=>'Oops it seems there is no member id exist');}*/
		  }
		  else if($this->u_cate=='2')
  		  {
				$getBuyer=$this->partner->profile_details_by_username($post['buyerID']);
				if($getBuyer)
				{
				   $getTempSaleList=$this->getTempSale($this->logId,$this->u_cate,$getBuyer->id);	
				   if($getBuyer->address){$address=$getBuyer->address.',<br>'.$getBuyer->ctyN.','.$getBuyer->stN.','.$getBuyer->zipcode;}else{$address=$getBuyer->address;}
				$data=array('adClass'=>'tst_success','byrPic'=>base_url($getBuyer->my_img),'byrCode'=>$getBuyer->username,'byrName'=>$getBuyer->name,'byrAddr'=>$address,'byrContct'=>$getBuyer->mobile,'byrEmail'=>$getBuyer->email,'msg'=>'Thank You! you have found details','byrID'=>urlencode(base64_encode($getBuyer->id)),'tempSaleList'=>$getTempSaleList);
				}else{$data=array('adClass'=>'tst_warning','msg'=>'Oops it seems there is no member id exist');}
			}
			//print_r($data);
			echo json_encode($data);
		}
	
	
	
	
	public function getTempSale($buyerId,$sellerCate,$slrID)
	{
		$adminCharge=$this->common->getRowData('club_income','id','1');
		if($sellerCate=='1'){$soldBy=$sellerCate;$receivedBy='2';}else if($sellerCate=='2'){$soldBy='1';$receivedBy='2';}else{$soldBy='0';$receivedBy='1';}
		$whereCon=array('member_id'=>$buyerId,'soldBy'=>$soldBy,'seller_id'=>$slrID,'receiver_typ'=>$receivedBy);
		$tempOrderDetails=$this->common->all_data_con('temp_product_details',$whereCon,'*');//echo $this->db->last_query();
		 if($sellerCate=='1'){ $btnFnction='delSaleTempKart';}elseif($sellerCate=='2'){ $btnFnction='delSaleTempKartByShopee';}else{$btnFnction='amiActn';}
		if($tempOrderDetails)
		{
			$ctr=0;	$grandTotal=0;$content='';	
			foreach($tempOrderDetails as $dList)
			{$ctr++;
			$tAmt=$dList['product_selling_price']*$dList['product_qty'];
			$netAmtAftrDiscount=$tAmt-($tAmt*$dList['discount'])/100;
			
			$netAmt=$netAmtAftrDiscount+($netAmtAftrDiscount*$dList['productTax'])/100;
			$grandTotal+=$netAmt;
			$kartTrash=$btnFnction."('".$dList['id'].'@@@@'.$dList['product_name']."')";//str_replace(" ","-",$dList['product_name'])
			$content.='<tr id="delArv-'.$dList['id'].'">
					      <th id="serial-'.$dList['id'].'">'.$ctr.'.</th>
						  <td>'.$dList['product_name'].'</td>
						  <td id="pQty--'.$dList['product_details_id'].'">'.$dList['product_qty'].'</td>
						  <td>'.$dList['productBV'].'</td>
						  <td><i class="bx bx-rupee inrP"></i> '.$dList['product_mrp'].'</td>
						  <td><i class="bx bx-rupee inrP"></i> '. $dList['product_selling_price'].'</td>
						  <td>'.$dList['discount'].' <i class="mdi mdi-percent-outline inrP"></i></td>
						 
						  <td id="tAmt--'.$dList['product_details_id'].'"><i class="bx bx-rupee inrP"></i> '.number_format($netAmtAftrDiscount,2).'</td>
						 
						  <td>'.$dList['productTax'].' <i class="mdi mdi-percent-outline inrR"></i></td>
						  <td id="netAmt--'.$dList['product_details_id'].'"><i class="bx bx-rupee inrP"></i> '.number_format($netAmt,2).'
						  <button class="kartTrash" onclick="'.$kartTrash.'" type="button"><i class="bx bx-trash"></i></button></td></tr>';
			}
			$paybleAmt=$grandTotal;	
		    $result=array('getOrd'=>$content,'miTxt'=>'success','grandTotal'=>number_format($grandTotal,2),'paybleAmt'=>number_format($paybleAmt,2),'shipInC'=>$adminCharge->shipping_charges,'texPer'=>$adminCharge->tax);
			return $result;
		 }
	  }	
	
	
	
	
	
	
	
	
	
					
	
}
