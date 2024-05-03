<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->model('member/member_model', 'Member_model');
	    error_reporting(0);
    }
   public function index()
    {
		$data['target']=base_url().'member/login/isCheckLoggedIn';
		$this->load->view('member/login',$data);
		 } 
	public function isCheckLoggedIn()
	{
		    $data = $this->input->post();	  
			$result =  $this->Member_model->validate_loggedIn($data['username'],$data['passw']);
			
			if($result)
			{
				
				if($result->status=='Active')
				{	
				    $system_configs=$this->common->system_config();
					$sessiondata = array(
                    '_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
                    '_USER_ACCEPT' => $_SERVER['HTTP_ACCEPT'],
                    '_USER_ACCEPT_ENCODING' => $_SERVER['HTTP_ACCEPT_ENCODING'],
                    '_USER_ACCEPT_LANG' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
                    '_USER_LOOSE_IP' => long2ip(ip2long($_SERVER['REMOTE_ADDR']) & ip2long("255.255.0.0")),
                    'REPO_SESSION' => TRUE,
                    'SESSION_START_TIME' => time(),
                    '_USER_LAST_ACTIVITY' => time(),
                    'mem_id' => $result->id,
                    'name' =>$result->name,'u_id' =>$result->username,
                    'email' => $result->email,'register_date'=>$result->create_date,
                    'mem_photo' => $result->my_img,
                    'company_name' => $system_configs[0]['company_name'],
                    'company_address' => $system_configs[0]['company_address'],
                    'company_url' => $system_configs[0]['company_url'],
                    'system_session_timeout' => $system_configs[0]['session_timeout'],
                    'system_inactive_timeout' => $system_configs[0]['inactive_timeout'],
                    'system_max_filesize' => $system_configs[0]['max_file_size'],
                    'system_allowed_file_types' => $system_configs[0]['allowed_file_types'],
                    'system_error_reporting' => $system_configs[0]['error_reporting'],
                    'is_logged_in' => true
                );
                		$this->session->set_userdata($sessiondata);
		$data=array('actn'=>'1','msg'=>'<i class="bx bx-smile"></i> You have successfully logged in to your account ','locate'=>base_url().'member/dashboard','adCls'=>'success');
				}
				else if($result->status=='Block')
				{$data = array('actn'=>'2','msg'=>'<i class="mdi mdi-alert-outline me-2"></i> You account is Block. Please contact to admin','adCls'=>'warning');}
				/*else if($result->status=='Suspend')
				{$data = array('actn'=>'2','msg'=>'<i class="mdi mdi-alert-outline me-2"></i> You account is suspend. Please contact to admin','adCls'=>'warning');}*/
				}
				else
				{$data=array('actn'=>'3','msg'=>'<i class="bx bx-cog bx-spin"></i> Invalid Login Details!! Please Check Username, Password','adCls'=>'danger');}
			 echo json_encode($data);
		}	 
		 
    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url()/*.'member/login'*/);
       /// $this->load->view('mlm_software/member/login');
    }



	public function isCheckLoggedInByAdmin($user_details)
	{
		 $getdata=explode('===',base64_decode(urldecode($user_details)));
/*		 
		 print_r($getdata);*/
		   $result =  $this->Member_model->validate_loggedIn($getdata[0],$getdata[1]);
			if($result)
			{
				
				if($result->status=='Active')
				{	
				    $system_configs=$this->common->system_config();
					$sessiondata = array(
                    '_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
                    '_USER_ACCEPT' => $_SERVER['HTTP_ACCEPT'],
                    '_USER_ACCEPT_ENCODING' => $_SERVER['HTTP_ACCEPT_ENCODING'],
                    '_USER_ACCEPT_LANG' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
                    '_USER_LOOSE_IP' => long2ip(ip2long($_SERVER['REMOTE_ADDR']) & ip2long("255.255.0.0")),
                    'REPO_SESSION' => TRUE,
                    'SESSION_START_TIME' => time(),
                    '_USER_LAST_ACTIVITY' => time(),
                    'mem_id' => $result->id,
                    'name' =>$result->name,'u_id' =>$result->username,
                    'email' => $result->email,'register_date'=>$result->create_date,
                    'mem_photo' => $result->my_img,
                    'company_name' => $system_configs[0]['company_name'],
                    'company_address' => $system_configs[0]['company_address'],
                    'company_url' => $system_configs[0]['company_url'],
                    'system_session_timeout' => $system_configs[0]['session_timeout'],
                    'system_inactive_timeout' => $system_configs[0]['inactive_timeout'],
                    'system_max_filesize' => $system_configs[0]['max_file_size'],
                    'system_allowed_file_types' => $system_configs[0]['allowed_file_types'],
                    'system_error_reporting' => $system_configs[0]['error_reporting'],
                    'is_logged_in' => true
                );
                		$this->session->set_userdata($sessiondata);
					redirect(base_url().'member/dashboard');		
		
					//$data=array('actn'=>'1','msg'=>'<i class="bx bx-smile"></i> You have successfully logged in to your account ','locate'=>,'adCls'=>'success');
				}
				else if($result->status=='Block')
				{$data = array('actn'=>'2','msg'=>'<i class="mdi mdi-alert-outline me-2"></i> You account is Block. Please contact to admin','adCls'=>'warning');}
				}
				else
				{$data=array('actn'=>'3','msg'=>'<i class="bx bx-cog bx-spin"></i> Invalid Login Details!! Please Check Username, Password','adCls'=>'danger');}
			 echo json_encode($data);
		}	









}
