<?php defined('BASEPATH') or exit('No direct script access allowed');

class Income extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('partner/income_model', 'income');
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
				####################### print_r($post_data);die;#######################
				$record = $this->income->income_data($post_data,$this->u_id);
				####################### echo $this->db->last_query();die;#######################
				$i = $post_data['start'] + 1;$return['data'] = array();$amt = 0;
				foreach ($record as $row) {	
			if($row->status=='Paid'){$status='<span style="color:green;text-transform: uppercase;font-weight: bold;">  <i class="md md-check-box"></i> '.$row->status.'</span>';}
	else if($row->status=='Pending'){$status='<span style="color:#b57706;text-transform: uppercase;font-weight: bold;"><i class="fa fa-cog rotate"></i> '.$row->status.'</span>';}
    else if($row->status=='Hold'){$status='<span style="color:#c10202;text-transform: uppercase;font-weight: bold;"> <i class="md-pause-circle-fill"></i> '.$row->status.'</span>';}
		   else{$status='<span style="color:#000;"> '.$row->status.'</span>';}	
		   
		   if(strlen($row->type) >20){$reasonN=substr($row->type, 0, 17).'...';}else{$reasonN=$row->type;}	
		   
		   		if($this->u_cate=='1'){$earned=$row->earnedBv;}else if($this->u_cate=='2'){$earned=$row->earnedBv;}	
		   
				$return['data'][] = array(
											'<strong>'.$i++.'.</strong>','<span style="color:#048B44;font-weight:600;"><i class="bx bx-rupee"></i> '.$row->amount.'</span>',
											$row->total_bv,'<span style="color:#048B44;font-weight:600;"><i class="bx bx-rupee"></i> '.$earned.'</span>',
											'<span class="amtltip">'.$reasonN.' <span class="tlptext">'.$row->type.'</span></span>',
											$row->ref_id,$row->create_date,$status
											);
				}
				$return['recordsTotal'] = $this->income->total_count($this->u_id);
				$return['recordsFiltered'] = $this->income->total_filter_count($post_data,$this->u_id);
				$return['draw'] = $post_data['draw'];
				echo json_encode($return);
			}
			else
			{
				$data['title'] = 'Dashboard';
    			$data['breadcrums'] = 'Dashboard';
				$data['target'] = 'partner/income/index/1';
    			$data['layout'] = 'earning/_list.php';
				$this->load->view('partner/base',$data);
   	 			}
	 } 
	public function transaction($actn=NULL)
	{
		if($actn)
		{		
				$post_data = $this->input->post();
				####################### print_r($post_data);die;#######################
				$record = $this->income->wallet_tnx($post_data,$this->u_id);
				####################### echo $this->db->last_query();die;#######################
				$i = $post_data['start'] + 1;
				$return['data'] = array();
				$amt = 0;
				foreach ($record as $row) 
				{	
					$date=date('H:i:s a d-M-Y',strtotime($row->create_date));
					if($row->created_by=='0'){if($row->debit_amt){$reason=$row->reason;}
					else if($row->credit_amt){$reason=$row->reason;}}else{$reason=$row->reason;}	
					if(strlen($reason) >20){$reasonN=substr($reason, 0, 17).'...';}else{$reasonN=$reason;}	
					if($row->debit_amt!='0.0'){$debit='<span style="color:#a44c3b;font-weight:600;"><i class="bx bx-rupee"></i> '.$row->debit_amt.'</span>';}else{$debit='';}
			if($row->credit_amt!='0.0'){$credit='<span style="color:#048B44;font-weight:600;"><i class="bx bx-rupee"></i> '.$row->credit_amt.'</span>';}else{$credit='';}
					$return['data'][]=array(
											  '<strong>'.$i++.'.</strong>',
											  '<strong>'.$row->tnx_id.'</strong>',
											  $debit,
											  $credit,
											  '<span class="amtltip">'.$reasonN.' <span class="tlptext">'.$reason.'</span></span>',
											  $date
											  );
				}
				$return['recordsTotal'] = $this->income->wallet_count($this->u_id);
				$return['recordsFiltered'] = $this->income->wallet_filter_count($post_data,$this->u_id);
				$return['draw'] = $post_data['draw'];
				echo json_encode($return);
			}
			else
			{
				$data['title'] = 'My Transaction';
				$data['breadcrums'] = 'My Transaction';
				$data['target'] = 'partner/income/transaction/1';
				$data['layout'] = 'earning/wallet_tnx.php';
				$this->load->view('partner/base',$data);
				}
			
		}
	public function withdraw($actn=NULL)
	{
			if($actn)
			{	
				$minWthdrawal=$this->income->minWithdrawlBal();$getWallet=$this->income->get_member_wallet($this->logId);
				$wthdr_amt=$this->input->post('amt');$walletBal=$getWallet->balance;
				if($minWthdrawal->withdrableAmt > number_format((float)$wthdr_amt, 2, '.', ''))
				{$data = array('adClass' => 'tst_danger', 'msg' =>'Please input more than from Rs. '.$minWthdrawal->withdrableAmt);}
				else
				{
					if($walletBal < number_format((float)$wthdr_amt, 2, '.', ''))
					  {$data = array('adClass' => 'tst_danger', 'msg' =>'Please input upto to wallet balance Rs. '.$getWallet->balance);}	
						else
						{
								$wtnx=date('dHsi');$createRequest=array('wtnx_id'=>$wtnx,'userid'=>$this->u_id,'amount'=>$wthdr_amt,'request_date'=>date('Y-m-d H:i:s'));
								$createWalTnx=array('tnx_id'=>$wtnx,'user_id'=>$this->u_id,'debit_amt'=>$wthdr_amt,'reason'=>"Member has sen't withdraw request for payment",
													'created_by'=>'1','create_date'=>date('Y-m-d H:s:i'),'transfer_id'=>$this->u_id);
		//						$crMlmTranx=array('tnx_id'=>$wtnx,'debit_amt'=>$wthdr_amt,'reason'=>"Member has sen't withdraw request for payment",
		//										  'generated_by'=>'1','created_date'=>date('Y-m-d H:s:i'),'created_by'=>$this->logId);
								if($this->common->save_data('partner_withdraw_request', $createRequest))
								{
									$restBalance=$walletBal-$wthdr_amt;
									$upDtWallet=array('balance'=>$restBalance);$whereUpWallArr=array('userid'=>$this->u_id);
									if($this->common->update_data('wallet',$whereUpWallArr,$upDtWallet))
									{
										if($this->common->save_data('partner_wallet_transaction', $createWalTnx))
										{
					$data=array('adClass'=>'tst_success','msg'=>"Thank you! You have successfully sen't your withdraw request.",'avlBal'=>'<i class="bx bx-rupee"></i> '.$restBalance);
			//								if($this->Common_model->save_data('mlm_income_manage', $crMlmTranx))
			//								{$data = array('data' => '1', 'text' =>"<i class='fa fa-smile-o'></i> Thank you! You have successfully sen't your withdraw request ");}
			//								else{$data = array('data' => '2', 'text' =>"<i class='fa fa-cog rotate'></i> Ooop's something went wrong please re update. ");}
											}
											else{$data = array('adClass' => 'tst_danger', 'msg' =>" Ooop's something went wrong please re update. ");}
										}
									else{$data = array('adClass' => 'tst_danger', 'msg' =>" Ooop's something went wrong please re update. ");}
								}
								else{$data = array('adClass' => 'tst_danger', 'msg' =>" Ooop's something went wrong while creating. ");}			
							}
						}
					echo json_encode($data);	
				}
			else
			{	
				$data['usrDetails']=$this->income->get_member_wallet($this->logId);
				$data['minWthdrawal']=$this->income->minWithdrawlBal();
				$data['wthdrawalRqst']=$this->income->withdrawlRequest($this->u_id);
				
				$data['title'] = 'My Transaction';
				$data['breadcrums'] = 'My Transaction';
				$data['target'] = base_url('partner/income/withdraw/1');
				$data['layout'] = 'earning/withdraw.php';
				$this->load->view('partner/base',$data);
				}
		}		
}
