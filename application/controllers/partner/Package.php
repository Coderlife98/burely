<?php defined('BASEPATH') or exit('No direct script access allowed');

class Package extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('partner/sale_model', 'sale');
		$this->load->model('partner/partner_model', 'partner');
		$this->load->model('member/member_model', 'member');
		$this->load->model('member/income_model', 'income');
		($this->session->userdata('partner_id')== '') ? redirect(base_url().'partner/login', 'refresh') : '';
	    $this->logId=$this->session->userdata('partner_id');
	    $this->u_id=$this->session->userdata('partner_username');
		$this->u_cate=$this->session->userdata('p_cate');
		$this->baseUrl=base_url();
	    error_reporting(0);
    }
   public function index($actn=NULL)
    {
		   
		   if($actn)
		   {
				$post_data = $this->input->post();
				$record = $this->sale->package_data($post_data,$this->u_id);
				$i = $post_data['start'] + 1;
				$return['data'] = array();
				foreach ($record as $row) {
					if ($row->order_status=='Cancel'){$stsTex='Cancelled';$activeCls='ordCancel';} 
					else if ($row->order_status=='Placed'){$stsTex='Placed';$activeCls='ordPlced';}
					else if ($row->order_status=='Pending'){$stsTex ='Pending';$activeCls='ordShipped';}
					else if ($row->order_status=='Delivered'){$stsTex='Delevered';$activeCls='ordDelevered';}
					else {$stsTex='Not Yet';$activeCls='setBtnGr dctive';}
					$getUid = base_url('partner/package/pack_details/'.urlencode(base64_encode($row->id)));
					$actionBtn = '<div style="text-align:center;">
										<a href="'.$getUid.'" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
								  </div>';
					if($row->purchase_date){$orderDt=date('d-m-Y',strtotime($row->purchase_date));}else{ $orderDt='<span style="font-weight:600">N/A</span>';}
					if($row->delivery_date){$delivery=date('d-m-Y',strtotime($row->delivery_date));}else{ $delivery='<span style="font-weight:600">N/A</span>';}
					$grndAmt=$row->grndAmt+($row->grndAmt*$row->tax)/100;
					$return['data'][] = array(
												'<strong>' . $i++ . '.</strong>','<strong>'.$row->tnx_id.'</strong>','<i class="bx bx-rupee inrP"></i> '.number_format($grndAmt,2),
												'<i class="bx bx-rupee inrP"></i> '.$row->paid_amt,$orderDt,$delivery,
												'<div class="'.$activeCls.' getAction"><span>'.$stsTex.'</span></div>',$actionBtn
												);
				}
				$return['recordsTotal'] = $this->sale->packtotal_count($this->u_id);
				$return['recordsFiltered'] = $this->sale->packfilter_count($post_data,$this->u_id);
				$return['draw'] = $post_data['draw'];
				echo json_encode($return);
					}
		   else
		   {
		    $data['title'] = 'Pakages Purchase Manage';
			$data['breadcrums'] = 'Pakages Purchase Manage';
			$data['target'] = 'partner/package/index/view';
			$data['layout'] = 'sale/_package_sale_list.php';
			$this->load->view('partner/base',$data);
			}
   	 } 
   public function sale($id)
    {
		$id = base64_decode(urldecode($id));
		$getPackage=$this->sale->use_package($id);
		$data['getPackage'] = $getPackage;
		$data['title'] = 'Package Sale';
        $data['breadcrums'] = 'Package Sale';
        $data['layout'] = 'sale/package.php';
        $this->load->view('partner/base', $data);	
   	 }
  
  public function pack_details($id)
  {
		$orderDetails=NULL;$member=NULL;$ordHistory=NULL;$getBuyer=NULL;
		$invId = base64_decode(urldecode($id));
		$ordHistory=$this->common->getRowData('package_purchase','id',$invId);
		$getBuyer=$this->partner->profile_details_by_username($ordHistory->mem_id);
		$orderDetails=$this->sale->getPackagePurchasedList($invId);
		$data['orderDetails']=$orderDetails;
		$data['getBuyer'] = $getBuyer;
		$data['ordHistory']=$ordHistory;
		$data['title'] = 'Sale Package Details ';
		$data['breadcrums'] = 'Sale Package Details';
		$data['target'] = 'partner/package/package/view';
		$data['layout'] = 'sale/_package_data.php';
		$this->load->view('partner/base',$data);
		}	
  public function manage($actn=NULL)
  {
  	       
		  if($actn)
		   { 
		   			$post_data = $this->input->post();
				$record = $this->sale->package_nu_data($post_data,$this->u_id);
				//print_r($record[0]);die;
				$i = $post_data['start'] + 1;
				$return['data'] = array();
				foreach ($record as $row) {
					if ($row->status=='Un-used')
					{
						$getUid = base_url('partner/package/sale/'.urlencode(base64_encode($row->id)));
						
						$stsTex ='<span style="color:#19b319;font-weight: 600;">UN-USED</span>';
						$actionBtn = '<div style="text-align:center;">
										<a href="'.$getUid.'" class="btn btn-outline-success btn-sm waves-effect btn-padd" title="View"><i class="bx bx-plus"></i></a>
								      </div>';
						}
					else if ($row->status=='Used')
					{
						$stsTex='<span style="color:#e64d02;font-weight: 600">USED</span>';
						$print_bill = base_url('partner/package/receipt/'.urlencode(base64_encode($row->id)));
						$actionBtn = '<div style="text-align:center;">
										<a href="'.$print_bill.'" class="btn btn-outline-primary btn-sm waves-effect btn-padd" target="_blank"><i class="bx bx-printer"></i></a>
								  </div>';
						}
					else {$stsTex='Not Yet';$actionBtn='Not Yet';}
					
					
					
					if($row->used_by){$used_by=$row->used_by;}else{ $used_by='<span style="font-weight:600">N/A</span>';}
					if($row->used_date){$used_date=$row->used_date;}else{ $used_date='<span style="font-weight:600">N/A</span>';}			  
					$return['data'][] = array(
												'<strong>' . $i++ . '.</strong>',
												'<strong>'.$row->pack_name.'</strong>',
												'<i class="bx bx-rupee inrP"></i> '.$row->amount,
												$row->pack_bv,
												$row->pack_nu,
												$used_by,$used_date,
												 $stsTex,
												$actionBtn
												);
				}
				$return['recordsTotal'] = $this->sale->pack_nu_total_count($this->u_id);
				$return['recordsFiltered'] = $this->sale->pack_nu_count($post_data,$this->u_id);
				$return['draw'] = $post_data['draw'];
				echo json_encode($return);
			}
				else
				{
					$data['title'] = 'Pakages List';
					$data['breadcrums'] = 'Pakages list';
					$data['target'] = 'partner/package/manage/view';
					$data['layout'] = 'sale/_package_list.php';
					$this->load->view('partner/base',$data);
					}
		}
  public function findBuyer()
  {
  	$post=$this->input->post();
	$getMember=$this->common->getRowData('msdr_members','username',$post['buyerID']);
	if($getMember)
	{
		if($getMember->topup=='0.00')
		{
			if($getMember->topup_request==$post['packAmt'])
			{$data=array('adClass'=>'tst_success','msg'=>'Thank You! You have successfully find member to activate','username'=>$getMember->username,'name'=>$getMember->name,'email'=>$getMember->email,'mobile'=>$getMember->mobile,'topup_request'=>$getMember->topup_request);}
			else{$data=array('adClass'=>'tst_warning','msg'=>'Oops it seems member has applied other package Rs.'.$getMember->topup_request);}
			}
		  else{$data=array('adClass'=>'tst_warning','msg'=>'This member id is already purchased package');}
		}
	   else{$data=array('adClass'=>'tst_danger','msg'=>'There is no member available to this member id');}
	  echo json_encode($data);
	}	
  public function activate()
  {
  		$post=$this->input->post();$tnxNu=date('dHis');$tnxDt=date('Y-m-d H:i:s');
		$isPcActivated=$this->common->getRowData('package_purchase_details','id',$post['pcId']);
		if($isPcActivated->status=='Used'){$data=array('adClass'=>'tst_danger','msg'=>'Opps this package number is already used by #'.$isPcActivated->used_by);}
		else
			{	
					$upWhereCon=array('id'=>$post['pcId']);
					$packUpdate=array('status'=>'Used','used_by'=>$post['buyerID'],'used_date'=>$tnxDt);
					$pcResult=$this->common->update_data('package_purchase_details',$upWhereCon,$packUpdate);
					//$pcResult=1;
					if($pcResult)
					{
						$data=array('adClass'=>'tst_success','msg'=>'Thank You! You have successfully activate member account');
						$memAcUpdate=array('topup'=>$post['packAmt'],'topup_date'=>$tnxDt);
						$upMemWhereCon=array('username'=>$post['buyerID']);
						
						$memAct=$this->common->update_data('msdr_members',$upMemWhereCon,$memAcUpdate);
						//$memAct=1;
						if($memAct)
						{
							$memTnxArr=array('tnx_id'=>$tnxNu,'user_id'=>$post['buyerID'],'debit_amt'=>$post['packAmt'],
											 'reason'=>'Amount debited after package purchase','created_by'=>'3','create_date'=>$tnxDt);	
							$createWallTnxFrMbr=$this->common->save_data('wallet_transaction',$memTnxArr);	
							//$createWallTnxFrMbr=1;
							if($createWallTnxFrMbr)
							{
								$walletTnxFrSlrArr=array('tnx_id'=>$tnxNu,'tnx_typ'=>'3','user_id'=>$this->u_id,'credit_amt'=>$post['packAmt'],
														 'reason'=>'Amount credited after package purchase # '.$post['buyerID'],'created_by'=>'1','create_date'=>$tnxDt);	
								$createWallTnxFrPrtnr=$this->common->save_data('partner_wallet_transaction',$walletTnxFrSlrArr);	
								//$createWallTnxFrPrtnr=1;
								if($createWallTnxFrPrtnr)
								{
									if($this->u_cate=='1'){$earnBv=$isPcActivated->pack_bv*5/100;}else{$earnBv=$isPcActivated->pack_bv*10/100;}
									 $earningSlrArr=array('userid'=>$this->u_id,'amount'=>$post['packAmt'],'total_bv'=>$isPcActivated->pack_bv,'earnedBv'=>$earnBv,
								                          'type'=>'Amount credited after package sale of member # '.$post['buyerID'],
											              'ref_id'=>'After Sale','create_date'=>$tnxDt);	
						 			 $createEarningFrSlr=$this->common->save_data('partner_earning',$earningSlrArr);
								 //	 $createEarningFrSlr=1; 
									 if($createEarningFrSlr)
									  {
										$spInc=$this->income->activate_plan($post['buyerID'],$post['buyerID'],$post['packAmt']);
										$msg='Thank You! You have successfully activate member with package';
										$data=array('adClass'=>'tst_success','msg'=>$msg,'trgtUrl'=>base_url('partner/package/manage'));
										}
									 else{$data=array('adClass'=>'tst_danger','msg'=>'Oops it seems there is an issues while creating partner earning');}		
									}
								  else{$data=array('adClass'=>'tst_danger','msg'=>'Oops it seems there is an issues while creating wallet transaction');}		
							   }
							else{$data=array('adClass'=>'tst_danger','msg'=>'Oops it seems there is an issues while creating wallet transaction');}	
						 }
					  else{$data=array('adClass'=>'tst_danger','msg'=>'Oops it seems there is an issues while updating member account');}		
					}
				else{$data=array('adClass'=>'tst_danger','msg'=>'Opps there is an issue while activating member account');}
			}
			sleep(2);
		echo json_encode($data);
	}	
  public function receipt($id)
  {
  		$getID=base64_decode(urldecode($id));$getFrenchise=NULL;$member=NULL;
		$getProduct=$this->sale->use_package($getID);/*echo $this->db->last_query();*/
	    $getFrenchise=$this->partner->profile_details_by_username($getProduct->issue_to);	
		$member=$this->member->profile_details_by_username($getProduct->used_by);	
		$data['getProduct']=$getProduct;
		$data['getFrenchise']=$getFrenchise;
		$data['member']=$member;
		 $this->load->view('partner/sale/_print_receipt', $data);	
		
	
	}		
   
}
