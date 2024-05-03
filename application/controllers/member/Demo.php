<?php defined('BASEPATH') or exit('No direct script access allowed');

class Demo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('member/demo_model', 'demo');
		$this->load->helper(array('form','email'));
		
		
        ($this->session->userdata('mem_id')== '') ? redirect(base_url().'member/login', 'refresh') : '';
	    $this->logId=$this->session->userdata('mem_id');
	    $this->u_id=$this->session->userdata('u_id');
		$this->baseUrl=base_url();
	    error_reporting(0);
    }
   public function index()
    {
		$data['title'] = 'Dashboard';
    	$data['breadcrums'] = 'Dashboard';
    	$data['layout'] = 'demo/testing.php';
		$this->load->view('member/base',$data);
   	 } 
	 
	 public function mail_send()
	 {
	 
	           
            // 	$config = array(
            //         'protocol' => "smtp", // make sure this is set as SMTP to enable connections to SMTP servers, else it will send via inbuilt php mail.
            //         'smtp_host' => "mail.caplus.in ", // use double-quotes'smtp_port' => YOUR-PORT (as number),'smtp_user' => "YOUR-EMAIL-ADDRESS" 'smtp_pass' => "YOUR-EMAIL-PASSWORD",
            //         'mailtype'  => "html",
            //         'charset'   => "utf-8",
            //         'wordwrap'  => true,
            //         'wrapchars' => 50,
            //         'crlf' => "/r/n",
            //         'newline' => "/r/n"            
            //     );
                
				$this->load->library('email');
			//	$this->email->initialize($config);
			    $to_email = "anyposible@gmail.com";
		        $email_res =confirmation_mail('Amit Kumar',config_item('company_name'),'amisingh143','12345');
				$this->email->from('no-reply@msdr.live', 'New Registration Confirmation');
				$this->email->to($to_email);
				$this->email->subject('Form MSDR Global Marketting Private Limited');
				$this->email->message($email_res);
				
				//print_r($this->email->print_debugger());
				
			    if($this->email->send())
				{
					echo 'Success';
					
					}
					else
					{
						echo 'Not Send mail';
						
						}
				//$return=array('result'=>'1','name'=>$post['name'],'sponsor'=>$post['sponsor'],'username'=>$username);
				
		
		
		}
	 
   public function email_send()
   {
	    $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n"; 
	    
	    
	    $headers .= 'From: MSDR Global Marketing pvt. ltd. <infomsdr@gmail.com>'; 
	    
	    $email_res =confirmation_mail('Amit Kumar',config_item('company_name'),'amisingh143','12345');
	
//	print_r($email_res);
	
	
		if(mail("anyposible@gmail.com","Congratulation for register",$email_res,$headers))
		{
		        
		        echo 'Mail successfully sent';
		}
        else
        {
              echo 'Mail successfully not sent';    
        }
   	
	}
   public function mailFrmt()
   {
       
        $email_res =confirmation_mail('Amit Kumar',config_item('company_name'),'amisingh143','12345');
	
	    print_r($email_res);
       
   }
	
	
}
