<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'email'));
		$this->load->library(array('upload', 'email'));
		$this->load->model('partner/partner_model', 'partner');
		$this->load->model('member/member_model', 'Member_model');
		$this->load->model('Plan_model', 'Plan_model');

		//$this->load->model('super_admin/common_model', 'common');	
		$this->load->library(array('form_validation', 'user_agent'));
		error_reporting(0);
	}

	public function index()
	{
		// echo "<center><h3 style='margin-top: 70px; font-family: serif;'>Due to the Software payment this website and Software have closed.</br> Please Contact Administrator to Continue the Software service!</h3></center>";
		$layout['title'] = "Home";
		$layout['layout'] = "website/home.php";
		$this->load->view('base', $layout);
	}
	public function about()
	{
		// echo "<center><h3 style='margin-top: 70px; font-family: serif;'>Due to the Software payment this website and Software have closed.</br> Please Contact Administrator to Continue the Software service!</h3></center>";
		$layout['title'] = "About";
		$layout['layout'] = "website/about.php";
		$this->load->view('base', $layout);
	}

	public function product()
	{
		// echo "<center><h3 style='margin-top: 70px; font-family: serif;'>Due to the Software payment this website and Software have closed.</br> Please Contact Administrator to Continue the Software service!</h3></center>";
		$layout['title'] = "services";
		$layout['layout'] = "website/services.php";
		$this->load->view('base', $layout);
	}

	// skull added start
    public function gallery(){
		// echo "<center><h3 style='margin-top: 70px; font-family: serif;'>Due to the Software payment this website and Software have closed.</br> Please Contact Administrator to Continue the Software service!</h3></center>";
		$layout['title'] ="Gallery";
		$layout['layout'] ="website/gallery.php";
		$this->load->view('base', $layout);
	}

	public function team(){
		// echo "<center><h3 style='margin-top: 70px; font-family: serif;'>Due to the Software payment this website and Software have closed.</br> Please Contact Administrator to Continue the Software service!</h3></center>";
		$layout['title'] ="Team";
		$layout['layout'] ="website/team.php";
		$this->load->view('base',$layout);
	}
	public function legal(){
		// echo "<center><h3 style='margin-top: 70px; font-family: serif;'>Due to the Software payment this website and Software have closed.</br> Please Contact Administrator to Continue the Software service!</h3></center>";
		$layout['title'] ="Legal";
		$layout['layout'] ="website/legal.php";
		$this->load->view('base',$layout);
	}
	// skull added end

	public function contact()
	{
		// echo "<center><h3 style='margin-top: 70px; font-family: serif;'>Due to the Software payment this website and Software have closed.</br> Please Contact Administrator to Continue the Software service!</h3></center>";
		$layout['title'] = "contact";
		$layout['layout'] = "website/contact.php";

		$this->load->view('base', $layout);
	}

	public function contact_us()
	{
		// echo "<center><h3 style='margin-top: 70px; font-family: serif;'>Due to the Software payment this website and Software have closed.</br> Please Contact Administrator to Continue the Software service!</h3></center>";

		$dat = $this->input->post();
		$name = $dat['name'];
		$email = $dat['email'];
		$phone = $dat['phone'];
		$address = $dat['address'];
		$message = $dat['message'];

		$to = "info@camwel.com";
		$subject = "Enquiry from " . $email;
		$headers = 'from ' . $email . "\r\n";
		$headers .= 'content-type:text/html;charset=iso-8859-1' . "\r\n";
		$full_message = "<html> <head> <title>Enquiry Data </title> </head><body><table><tr><td>Name</td><td>&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td><td>" . $name . "</td></tr><tr><td>Email Id</td><td>&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td><td>" . $email . "</td></tr><tr><td>Phone Number</td><td>&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td><td>" . $phone . "</td></tr><tr><td>Address</td><td>&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td><td>" . $address . "</td></tr><tr><td>Message</td><td>&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td><td>" . $message . "</td></tr></table></body></html>";

		$user = $email;
		$user_subject = "Thank You $name";
		$user_headers = 'From: ' . "\r\n";
		$user_message = "Dear " . $name . "\nWelcome to company name \n We have got your query. we will reach you soon. \n Thank You";

		if (mail($to, $subject, $full_message, $headers)) {

			mail($user, $user_subject, $user_message, $user_headers);

			$layout["response"] = "<h3>Dear <span style='color:black;'>" . $name . "</span>,</h3><blockquote><p>We have got your query. We will contact you soon.<br/>For Quick Enquiry<span style='color:#e70780;'>Call Us</span>at <span><i class='fa-solid fa-phone px-2 text-dark'></i><a style='text-decoration:none;color:black' href='tel:+91 7003762445'> 7003762445</a></span></p><p>Thank You!</p></blockquote>";
		} else {
			$layout["response"] = "<h3>Dear <span style='color:#e70780;'>" . $name . "</span>,</h3><blockquote><p>Something is wrong. It seems like the internet is not working well.<br/>For Quick Enquiry <span style='color:#e70780;'>Call Us<span> at <span><i class='fa-solid fa-phone px-2 text-dark'></i><a style='text-decoration:none;color:black' href='tel:+91 7003762445'> 7003762445</a></span></p><p>Please, try again!</p><p>Thank You!</p></blockquote>";
		}



		$layout['title'] = "Thank you";
		$layout['layout'] = "website/thanku.php";
		$this->load->view('base', $layout);
	}

	public function login()
	{
		$layout['title'] = "Sign in";
		$layout['layout'] = "website/login.php";
		$this->load->view('base', $layout);
	}

	public function register()
	{
		$layout['title']  = 'Register Now';
		$layout['package']  = $this->common->all_data('package', '*');
		$layout['package']  = $this->db->select('*')->from('package')->get()->result_array();
		$layout['getState'] = $this->common->getDataList('states_cities', 'parent_id', '729');
		//$layout['layout']   = "website/register.php";
		// $this->load->view('website/register', $layout);
		$layout['layout'] = "website/register.php";
		$this->load->view('base', $layout);
	}

	public function isCheckLoggedIn()
	{
		$post = $this->input->post();/*print_r($post);echo'<br>';*/
		if ($post['memberTyp'] == '1' || $post['memberTyp'] == '2') {
			$result =  $this->partner->validate_loggedIn($post['username'], $post['passw'], $post['memberTyp']);
			if ($result) {
				if ($result->status == 'Active') {
					$system_configs = $this->common->system_config();
					$sessiondata = array(
						'partner_id' => $result->id, 'partner_name' => $result->name, 'partner_username' => $result->username, 'p_cate' => $result->user_typ,
						'partner_email' => $result->email, 'partner_register_date' => $result->create_date, 'partner_photo' => $result->my_img,
						'company_name' => $system_configs[0]['company_name'], 'company_address' => $system_configs[0]['company_address'],
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
					$data = array('msg' => '<i class="fa fa-smile-o"></i> You have successfully logged in to your account ', 'locate' => base_url('partner/dashboard'), 'adCls' => 'success');
				} else if ($result->status == 'Block') {
					$data = array('msg' => '<i class="fa fa-power-off"></i> You account is Block. Please contact to admin', 'adCls' => 'warning');
				}
			} else {
				$data = array('msg' => '<i class="fa fa-cog mi-spin"></i> Invalid Login Details!! Please Check Username, Password', 'adCls' => 'danger');
			}
		} else if ($post['memberTyp'] == '3') {
			$result =  $this->Member_model->validate_loggedIn($post['username'], $post['passw']);
			if ($result) {
				if ($result->status == 'Active') {
					$system_configs = $this->common->system_config();
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
						'name' => $result->name, 'u_id' => $result->username,
						'email' => $result->email, 'register_date' => $result->create_date,
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
					$data = array('msg' => '<i class="fa fa-smile-o"></i> You have successfully logged in to your account ', 'locate' => base_url('member/dashboard'), 'adCls' => 'success');
				} else if ($result->status == 'Block') {
					$data = array('msg' => '<i class="fa fa-power-off"></i> You account is Block. Please contact to admin', 'adCls' => 'warning');
				}
				/*else if($result->status=='Suspend')
					{$data = array('actn'=>'2','msg'=>'<i class="mdi mdi-alert-outline me-2"></i> You account is suspend. Please contact to admin','adCls'=>'warning');}*/
			} else {
				$data = array('actn' => '3', 'msg' => '<i class="fa fa-cog mi-spin"></i> Invalid Login Details!! Please Check Username, Password', 'adCls' => 'danger');
			}
		} else {
			$data = array('msg' => '<i class="fa fa-cog mi-spin"></i> You have choosen wrong way', 'adCls' => 'default');
		}

		echo json_encode($data);
	}

	public function cityList()
	{
		$id = $this->input->post('id');
		$getCity = $this->common->getDataList('states_cities', 'parent_id', $id);
		sleep(1);
		echo '<option value="">--- Select One ---</option>';
		if ($getCity) {
			foreach ($getCity as $list) {
				echo '<option value="' . $list->id . '">' . $list->state_cities . '</option>';
			}
		}
	}
	public function isCheckSponsor()
	{
		$post = $this->input->post('id');
		$result = $this->common->getRowData('msdr_members', 'username', $post);
		if ($result) {
			$return = array('result' => '1', "msg" => "Available", "name" => $result->name, "adCls" => "success");
		} else {
			$return = array('result' => '2', "msg" => "Doesn't exist", "adCls" => "danger");
		}
		echo json_encode($return);
	}

	public function createNew()
	{
		$username = config_item('ID_EXT').rand(10000, 99999);
		if ($this->common->count_all('msdr_members', array('username' => $username)) > 0) {
			$username = $username + 1;
			if ($this->common->count_all('msdr_members', array('username' => $username)) > 0) {
				$username = $username + 2;
				if ($this->common->count_all('msdr_members', array('username' => $username)) > 0) {
					$username = $username + 3;
				}
			}
		}
		$post = $this->input->post();
		$sponsor = config_item('ID_EXT').substr($post['sponsor'], 3);
		$sponsor_count = $this->db->select('*')->where('sponsor', $sponsor)->get('msdr_members')->num_rows();

		$isCheckMobile = $this->common->getRowData('msdr_members', 'mobile', $post['mobileN']);
		$isCheckEmail = $this->common->getRowData('msdr_members', 'email', $post['email']);
		if ($isCheckMobile) {
			$return = array('result' => '2', 'msg' => $post['salutation'] . ' ' . $post['name'] . ' this mobile number is already exist.');
		} else if ($isCheckEmail) {
			$return = array('result' => '2', 'msg' => $post['salutation'] . ' ' . $post['name'] . ' this email id is already exist.');
		} else if ($sponsor_count >= 5) {
			$return = array('result' => '2', 'msg' => 'Oops it seems already Sponsor 5 Members please Enter other sponsor Id.');
		} else {
			$createArr = array(
				'user_typ'      => '1',
				'memTitle'      => $post['salutation'],
				'username'      => $username,
				'sponsor'       => $sponsor,
				'position'      => $sponsor,
				'name'          => $post['name'],
				'gender'        => $post['memGender'],
				'email'         => $post['email'],
				'mobile'        => $post['mobileN'],
				'password'      => md5($post['password']),
				'shw_pass'      => $post['password'],
				'address'        => $post['address'],
				'created_type'  => '2',
				'create_date'   => date('Y-m-d H:i:s'),
				'created_by'    => '1',
				'topup_request' => $post['package']
			);
			$lastID = $this->common->save_data('msdr_members', $createArr);
			if ($lastID) {

				$d = $this->Plan_model->find_placement_field($sponsor);
				$data = array(
					$d['leg'] => $lastID
				);
				$this->db->where('id', $d['id'])->update('msdr_members', $data);


				$basicArr = array(
					'mem_id'     => $lastID,
					'state'      => $post['state'],
					'district'   => $post['district'],
					'zipcode'    => $post['zipcode']
				);

				$basicLastID = $this->common->save_data('msdr_member_basic', $basicArr);

				if ($basicLastID) {
					$walletArr = array('userid' => $username);
					$createWallet = $this->common->save_data('wallet', $walletArr);

					if ($createWallet) {
						$email_res = confirmation_mail($post['name'], config_item('company_name'), $username, $post['password']);
						$to_email  = $post['email'];
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
						$headers .= 'From: '.config_item('company_name').' <'.config_item('email').'>';

						 mail($to_email, "Congratulation for register", $email_res, $headers);
						
							$return = array('result' => '1', 'name' => $post['name'], 'sponsor' => $post['sponsor'], 'username' => $username);
						
					} else {
						$return = array('result' => '2', 'msg' => 'Opps something gets wrong ' . $post['salutation'] . ' ' . $post['name']);
					}
					//$return=array('result'=>'1','name'=>$post['name'],'sponsor'=>$post['sponsor'],'username'=>$username);
				} else {
					$return = array('result' => '2', 'msg' => 'Opps something gets wrong ' . $post['salutation'] . ' ' . $post['name']);
				}
			} else {
				$return = array('result' => '2', 'msg' => 'Opps something gets wrong ' . $post['salutation'] . ' ' . $post['name']);
			}
		}
		sleep(2);
		echo json_encode($return);
	}

	public function page($actn)
	{
		$layout['layout'] = "website/" . $actn . ".php";
		$this->load->view('base', $layout);
	}
}
