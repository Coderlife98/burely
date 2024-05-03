<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('partner/dashboard_model', 'dashboard');
        ($this->session->userdata('partner_id')== '') ? redirect(base_url().'partner/login', 'refresh') : '';
	    $this->logId=$this->session->userdata('partner_id');
	    $this->u_id=$this->session->userdata('partner_username');
		$this->u_cate=$this->session->userdata('p_cate');
		$this->baseUrl=base_url();
	    error_reporting(0);
    }
   public function index()
    {
		if($this->u_cate=='1'){$purTblName='order_history';}else if($this->u_cate=='2'){$purTblName='sale_history';}
		$totalPurchase=NULL;$totalSale=NULL;$securityAmt=NULL;$recentPurchase=NULL;$recentSale=NULL;$earnedBV=NULL;
		
		$packageSale=NULL;$tEarnBV=NULL;
		
		
		
		$recentSale=$this->dashboard->recentSale($this->logId,$this->u_cate);
		$recentPurchase=$this->dashboard->recentPurchase($this->logId,$this->u_cate);
		$totalPurchase=$this->dashboard->purchase($this->u_id,$this->logId,$this->u_cate);
		$totalSale=$this->dashboard->sale($this->logId,$purTblName,$this->u_cate,$this->u_id);
		$earnedBV=$this->dashboard->earnBV($this->logId,$purTblName,$this->u_cate);
		
		$packageSale=$this->dashboard->recentPackageSale($this->u_id,$this->u_cate);
		$securityAmt=$this->dashboard->securityAmt($this->u_id);
		$data['packageSale']=$packageSale;
		$data['earnedBV']=$earnedBV;
		
		$data['accDetails'] = $this->common->getRowData('bank_details','id','1');
		$data['notifDetails'] = $this->common->all_data_con('notification_manage',array('status'=>'active'),'*');
		$data['recentSale']=$recentSale;
		$data['recentPurchase']=$recentPurchase;
		$data['securityAmt']=$securityAmt;
		$data['totalSale']=$totalSale;
		$data['totalPurchase']=$totalPurchase;
		$data['title'] = 'Dashboard';
    	$data['breadcrums'] = 'Dashboard';
		//$data['purTblName']=$purTblName;
		$this->load->view('partner/base',$data);
   	 } 
   public function welcome()
    {
		$data['title'] = 'Welcome Letter';
        $data['breadcrums'] = 'Welcome Letter';
        $data['layout'] = 'profile/welcome-letter.php';
        $this->load->view('partner/base', $data);	
   	 }
}
