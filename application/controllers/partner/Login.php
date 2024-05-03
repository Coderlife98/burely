<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->model('partner/partner_model', 'partner');
	    error_reporting(0);
    }
   public function index()
    {
		$data['target']=base_url().'partner/login/isCheckLoggedIn';
		$this->load->view('partner/login',$data);
		 } 
	public function isCheckLoggedIn()
	{
		    $data = $this->input->post();	  
			$result =  $this->partner->validate_loggedIn($data['username'],$data['passw']);
			
			if($result)
			{
				
				if($result->status=='Active')
				{	
					$system_configs=$this->common->system_config();
					$sessiondata = array(
										'partner_id' => $result->id,'partner_name' =>$result->name,'partner_username' =>$result->username,'p_cate' => $result->user_typ,
										'partner_email' => $result->email,'partner_register_date'=>$result->create_date,'partner_photo' => $result->my_img,
										'company_name' => $system_configs[0]['company_name'],'company_address' => $system_configs[0]['company_address'],
										'company_url' => $system_configs[0]['company_url'],
										'system_session_timeout' => $system_configs[0]['session_timeout'],
										'system_inactive_timeout' => $system_configs[0]['inactive_timeout'],
										'system_max_filesize' => $system_configs[0]['max_file_size'],
										'system_allowed_file_types' => $system_configs[0]['allowed_file_types'],
										'system_error_reporting' => $system_configs[0]['error_reporting'],
										'is_partner_logged_in' => true
                						);
				//print_r($sessiondata);die;
                		$this->session->set_userdata($sessiondata);
		$data=array('actn'=>'1','msg'=>'<i class="bx bx-smile"></i> You have successfully logged in to your account ','locate'=>base_url().'partner/dashboard','adCls'=>'success');
				}
				else if($result->status=='Block')
				{$data = array('actn'=>'2','msg'=>'<i class="mdi mdi-alert-outline me-2"></i> You account is Block. Please contact to admin','adCls'=>'warning');}
				}
				else
				{$data=array('actn'=>'3','msg'=>'<i class="bx bx-cog bx-spin"></i> Invalid Login Details!! Please Check Username, Password','adCls'=>'danger');}
			 echo json_encode($data);
		}	 
		 
    function logout()
    {
		$sessiondata = array('partner_id' =>'','partner_name' =>'','partner_username' =>'','partner_email' => '','partner_register_date'=>'','partner_photo' => '',
							 'company_name' => '','company_address' =>'','company_url' => '','system_session_timeout' =>'','system_inactive_timeout' =>'',
							 'system_max_filesize' => '','system_allowed_file_types' => '','system_error_reporting' => '','is_partner_logged_in' =>false
							);
		$this->session->sess_destroy($sessiondata);
        redirect(base_url()/*.'partner/login'*/);
    }




	public function isCheckLoggedInByAdmin($user_details)
	{
		    $getdata=explode('===',base64_decode(urldecode($user_details)));
			
			//print_r($getdata);die;
			//print_r($getdata);die;
				  
			$result =  $this->partner->validate_loggedIn($getdata[0],$getdata[1],$getdata[2]);
			
			if($result)
			{
				
				if($result->status=='Active')
				{	
					$system_configs=$this->common->system_config();
					$sessiondata = array(
										'partner_id' => $result->id,'partner_name' =>$result->name,'partner_username' =>$result->username,'p_cate' => $result->user_typ,
										'partner_email' => $result->email,'partner_register_date'=>$result->create_date,'partner_photo' => $result->my_img,
										'company_name' => $system_configs[0]['company_name'],'company_address' => $system_configs[0]['company_address'],
										'company_url' => $system_configs[0]['company_url'],
										'system_session_timeout' => $system_configs[0]['session_timeout'],
										'system_inactive_timeout' => $system_configs[0]['inactive_timeout'],
										'system_max_filesize' => $system_configs[0]['max_file_size'],
										'system_allowed_file_types' => $system_configs[0]['allowed_file_types'],
										'system_error_reporting' => $system_configs[0]['error_reporting'],
										'is_partner_logged_in' => true
                						);
				//print_r($sessiondata);die;
                		$this->session->set_userdata($sessiondata);
						redirect(base_url().'partner/dashboard');	
		//$data=array('actn'=>'1','msg'=>'<i class="bx bx-smile"></i> You have successfully logged in to your account ','locate'=>base_url().'partner/dashboard','adCls'=>'success');
				}
				else if($result->status=='Block')
				{$data = array('actn'=>'2','msg'=>'<i class="mdi mdi-alert-outline me-2"></i> You account is Block. Please contact to admin','adCls'=>'warning');}
				}
				else
				{$data=array('actn'=>'3','msg'=>'<i class="bx bx-cog bx-spin"></i> Invalid Login Details!! Please Check Username, Password','adCls'=>'danger');}
			 echo json_encode($data);
		}	





















}
