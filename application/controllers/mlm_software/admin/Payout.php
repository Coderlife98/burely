<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Payout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->helper(array('form','email'));
        $this->load->model('super_admin/common_model','Common_model');
		$this->load->model('mlm_software/admin/income_model', 'income');
        ($this->session->userdata('user_id')== '') ? redirect(base_url(), 'refresh') : '';//$this->session->userdata('user_id') != '')
        //($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
	    error_reporting(0);
      	$this->logId=$this->session->userdata('user_id');
		$this->user_cate=$this->session->userdata('user_cate');
	  }
		

public function index()
{
	$data['member_list']=NULL;
	//$data['member_list']=$this->rank_model->getList();
	$data['title'] = 'Generate Payout';
	$data['breadcrums'] = 'Generate Payout';
	$data['layout'] = 'mlm_software/admin/payout/payout_list.php';
	$this->load->view('mlm_software/base', $data);
}
public function generate()
{	
	$member_list=NULL;$amiActnTp=NULL;
	
	$adminPass=$this->input->post('admnPass');
	if($adminPass==config_item('mlm_dev_pass'))
	{	
	  /*SELECT e.userid,sum(e.earnedBv),w.balance FROM earning as e left join wallet as w on w.userid=e.userid where status='pending' GROUP by userid*/	
	  $getIncome=$this->income->generateEarningPayout();
	 
	  if($getIncome)
	  {	
			$ct=0;
			$tnx_time=date('Y-m-d H:s:i');
			foreach($getIncome as $list)
			{   
				$ct++;
				$currentWallet=$list->earnAmt+$list->balance;
				$whereConUp=array('userid'=>$list->userid,'status'=>'Pending');
				$updateEarning=array('status'=>'Paid','approve_date'=>$tnx_time,'approved_by'=>'0','approval_id'=>$this->logId);
				$inWalletArr=array('balance'=>$currentWallet);
				$whereCon=array('userid'=>$list->userid);
				if($this->common->update_data('wallet',$whereCon,$inWalletArr))
				{
					$tnxNu=date('dHis')+$ct;$reason='Earned payout genrated by system';
				   $monthlySal=array('tnx_id'=>$tnxNu,'user_id'=>$list->userid,'credit_amt'=>$list->earnAmt,'reason'=>$reason,'created_by'=>'0','create_date'=>date('Y-m-d H:s:i'));			
				   $createWallMonthlyTnx=$this->Common_model->save_data('wallet_transaction',$monthlySal);
					/*echo $this->db->last_query();echo '<br>';print_r($createWallMonthlyTnx);	echo '<br>';*/		   
						if($createWallMonthlyTnx)
					  {$createErng=$this->common->update_data('earning',$whereConUp,$updateEarning);if($createErng){$result='1';}else{$result='2';}}else{$result='2';}
					}
				else{$result='2';}
			 }
		/*	if($result=='1'){$data = array('icon' => '1', 'text' =>'Thank You! you have successfully update wallet balance as monthly payout');}
		  else{$data = array('icon' => '2', 'text' =>'Error while updating wallet balance as monthly payout');}		*/
		}
	  else{$result='2';}
	 $getForPartnerIncome=$this->income->generateEarningPayoutFrPartner();
	  if($getForPartnerIncome)
	  {	
			$ct=0;
			$tnx_time=date('Y-m-d H:s:i');
			foreach($getForPartnerIncome as $list)
			{   
				$ct++;
				$currentWallet=$list->earnAmt+$list->balance;
				$whereConUp=array('userid'=>$list->userid,'status'=>'Pending');
				$updateEarning=array('status'=>'Paid','approve_date'=>$tnx_time,'approved_by'=>'0','approval_id'=>$this->logId);
				$inWalletArr=array('balance'=>$currentWallet);
				$whereCon=array('userid'=>$list->userid);
				if($this->common->update_data('partner_wallet',$whereCon,$inWalletArr))
				{
					$tnxNu=date('dHis')+$ct;$reason='Earned payout genrated by system';
				   $monthlySal=array('tnx_id'=>$tnxNu,'user_id'=>$list->userid,'credit_amt'=>$list->earnAmt,'reason'=>$reason,'created_by'=>'0','create_date'=>date('Y-m-d H:s:i'));			
				   $createWallMonthlyTnx=$this->Common_model->save_data('partner_wallet_transaction',$monthlySal);   
						if($createWallMonthlyTnx)
					  {$createErng=$this->common->update_data('partner_earning',$whereConUp,$updateEarning);if($createErng){$result='1';}else{$result='2';}}else{$result='2';}
					}
				else{$result='2';}
			 }
		}
	  else{$result='2';}	
		
		if($result=='1'){$data = array('icon' => '1', 'text' =>'Thank You! you have successfully update wallet balance as monthly payout');}
		  else{$data = array('icon' => '2', 'text' =>'You have already generate monthly payout for this time');}	
		}
		else{$data = array('icon' => '3', 'text' =>'<i class="bx bx-cog bx-spin"></i> Oops it seems admin password does not match. Please enter valid password.');}
		 echo json_encode($data);		
	}
				
  
}
