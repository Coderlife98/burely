<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('member/order_model', 'order');
		 $this->load->model('member/member_model', 'member');
	    ($this->session->userdata('mem_id')== '') ? redirect(base_url().'member/login', 'refresh') : '';
	    $this->logId=$this->session->userdata('mem_id');
	    $this->u_id=$this->session->userdata('u_id');
		$this->baseUrl=base_url();
	    error_reporting(0);
    }
   public function index()
    {
		$tRepurchase=NULL;$upCommingEarned=NULL;$upCommingEarned=NULL;$totalEarned=NULL;
		$tRepurchase=$this->common->get_data('sale_history',array('soldBy'=>'2','customer_id'=>$this->logId),'sum(grand_total) as amt');
		$upCommingEarned=$this->common->get_data('earning',array('status'=>'Pending','userid'=>$this->u_id,'status'=>'Pending'),'sum(earnedBv) as amt');
		$totalEarned=$this->common->get_data('earning',array('userid'=>$this->u_id),'sum(total_bv) as amt');
		
		$getMember=$this->member->profile_details($this->logId);
		if($getMember->topup=='0.00'){$reminder='1';}else if($getMember->bank_ac_no==NULL){$reminder='2';}else{$reminder=NULL;}
			
		$recentOrder=NULL;
		
		$data['accDetails'] = $this->common->getRowData('bank_details','id','1');
		$data['notifDetails'] = $this->common->all_data_con('notification_manage',array('status'=>'active'),'*');
		
		
		$data['getMember'] = $getMember;
		$data['wallet']=$this->common->get_data('wallet',array('userid'=>$this->u_id),'sum(balance) as amt');

		
		$data['reminder'] = $reminder;
		$recentOrder=$this->order->recentOrder($this->logId);
		$data['recentOrder']=$recentOrder;
		$data['title'] = 'Dashboard';
    	$data['breadcrums'] = 'Dashboard';
		$data['totalEarned']=$totalEarned;
		$data['tRepurchase']=$tRepurchase;
		$data['upCommingEarned']=$upCommingEarned;
		$this->load->view('member/base',$data);
   	 } 
   public function welcome()
    {
		$data['title'] = 'Welcome Letter';
        $data['breadcrums'] = 'Welcome Letter';
        $data['layout'] = 'profile/welcome-letter.php';
        $this->load->view('member/base', $data);	
   	 }
	 
	public function id_card()
	{
		
		$data['details'] = $this->member->profile_details($this->logId);
		$data['title'] = 'Member ID Card';
        $data['breadcrums'] = 'Member ID Card';
        $data['layout'] = 'profile/idcard.php';
        $this->load->view('member/base', $data);	
		} 
	public function print_pdf()
	{
		$data['details'] = $this->member->profile_details($this->logId);
		$data['title'] = 'Member ID Card';
        $data['breadcrums'] = 'Member ID Card';
        $this->load->view('member/profile/print_idcard', $data);
		}	
	 
}
