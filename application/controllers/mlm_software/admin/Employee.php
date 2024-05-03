<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('upload', 'image_lib'));
		$this->load->model('super_admin/common_model', 'Common_model');
		$this->load->model('mlm_software/admin/employee_model', 'Employee_model');
		//($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
		($this->session->userdata('user_id') == '') ? redirect(base_url(), 'refresh') : '';
		error_reporting(0);
		$this->baseUrl = base_url();
		$this->logId = $this->session->userdata['user_id'];
		$this->lgCat = $this->session->userdata['user_cate'];
	}
	public function manage()
	{
		$data['title'] = 'Employee List';
		$data['breadcrums'] = 'Employee List';
		$data['layout'] = 'mlm_software/admin/employee/_list.php';
		$this->load->view('mlm_software/base', $data);
	}

	public function add()
	{
		$data['empId'] = 'MSDREMP' . rand(10, 100000);
		$data['title'] = 'New Employee Add';
		$data['breadcrums'] = 'Employee Add';
		$data['designation'] = $this->Common_model->all_data('employee_designation', 'id,des_title');
		$data['getState'] = $this->Employee_model->getDataList('states_cities', 'parent_id', '729');
		$data['layout'] = 'mlm_software/admin/employee/_add.php';
		$this->load->view('mlm_software/base', $data);
	}
	public function veiw_all()
	{

		$post_data = $this->input->post();
		####################### print_r($post_data);die;#######################
		$record = $this->Employee_model->employee_data($post_data);
		####################### echo $this->db->last_query();die;#######################
		$i = $post_data['start'] + 1;

		$return['data'] = array();
		$amt = 0;
		foreach ($record as $row) {
			if ($row->department_type == '2') {
				if ($row->status == '1') {
					$stsOn = 'Active';
					$addCls = 'bg-olive';
					$btnIcon = 'fa-upload';
				} else {
					$stsOn = 'Deactive';
					$addCls = 'bg-orange';
					$btnIcon = 'fa-pause';
				}	//
				$statusBtn = '<div class="actv-btn ' . $addCls . ' getStatusAction" onclick="mStatus(' . $row->id . ')" id="ms' . $row->id . '"> <i class="fa ' . $btnIcon . '" aria-hidden="true"></i> ' . $stsOn . '</div>';
				$getUid = urlencode(base64_encode($row->id));
				$getUsername = urlencode(base64_encode($row->name));
				$actionBtn = '<a href="' . $this->baseUrl . 'mlm_software/admin/employee/view/' . $getUid . '" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View">
			 <i class="mdi mdi-eye"></i> </a>
				<a href="' . $this->baseUrl . 'mlm_software/admin/employee/edit/' . $getUid . '" class="btn btn-outline-success btn-sm waves-effect btn-padd" title="Edit">
				<i class="mdi mdi-square-edit-outline me-1"></i> </a>
		<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm waves-effect btn-padd getAction" data-id="del-mlm_software/admin/employee/-' . $row->id . '"  data-bs-toggle="modal" data-bs-target="#deleteModel" title="Delete">
				<i class="bx bxs-trash"></i> </a>';
				if (strlen($row->address) > 20) {
					$address = substr($row->address, 0, 15) . '...';
				} else {
					$address = $row->address;
				}
				if ($row->photo) {
					$Img = base_url() . $row->photo;
				} else {
					$Img = base_url() . 'uploads/user/no_profile12.png';
				}
				$name = '<img src="' . $Img . '" alt="user" class="dsbordImg"><span class="usrNm">' . $row->name . '</span>';
				$return['data'][] = array(
					'<strong>' . $i++ . '.</strong>',
					$row->user_code,
					$name,
					$row->email,
					$row->mobile,
					$address,
					$statusBtn,
					$actionBtn
				);
			}
		}
		$return['recordsTotal'] = $this->Employee_model->total_count();
		$return['recordsFiltered'] = $this->Employee_model->total_filter_count($post_data);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}
	public function cStatus()
	{
		// echo $this->db->last_query();
		$getParamtr = $this->input->post('getParamtr');
		$conArr = array('id' => $getParamtr);
		$record = $this->Common_model->get_data('users', $conArr, 'status');
		if ($record['status'] == '1') {
			$newSts = '0';
		} else {
			$newSts = '1';
		}
		$updateArr = array('status' => $newSts); //print_r($updateArr);
		sleep(1);
		$updateR = $this->Common_model->update_data('users', $conArr, $updateArr);
		if ($updateR) {
			echo $newSts;
		} else {
			echo '3';
		}
	}
	public function view($id)
	{
		$id = base64_decode(urldecode($id));
		$data = array('id' => $id);
		$getEmpDetails = $this->Common_model->get_data('users', $data, '*');
		$data['getStateCity'] = $this->Employee_model->get_state_district($id);
		$data['getEmpDetails'] = $getEmpDetails;
		$getCreaterId = array('id' => $getEmpDetails['created_by_user_id']);
		$desigWherCon = array('id' => $getEmpDetails['designation']);
		$data['design'] = $this->Common_model->get_data('employee_designation', $desigWherCon, 'des_title');
		$data['getCreatedBy'] = $this->Common_model->get_data('users', $getCreaterId, 'name,user_code');
		$data['title'] = 'View Employee';
		$data['breadcrums'] = 'Employee View';
		$data['layout'] = 'mlm_software/admin/employee/_view.php';
		$this->load->view('mlm_software/base', $data);
	}
	public function edit($id)
	{
		$id = base64_decode(urldecode($id));
		$data = array('id' => $id);
		$getEmpDetails = $this->Common_model->get_data('users', $data, '*');
		$data['getStateCity'] = $this->Employee_model->get_state_district($id);
		$data['getEmpDetails'] = $getEmpDetails;
		$getCreaterId = array('id' => $getEmpDetails['created_by_user_id']);
		$data['getState'] = $this->Employee_model->getDataList('states_cities', 'parent_id', '729');
		$data['getCity'] = $this->Employee_model->getDataList('states_cities', 'parent_id', $getEmpDetails['state']);
		$data['getCreatedBy'] = $this->Common_model->get_data('users', $getCreaterId, 'name');
		$data['designation'] = $this->Common_model->all_data('employee_designation', 'id,des_title');

		$data['title'] = 'View Employee';
		$data['breadcrums'] = 'Employee View';
		$data['layout'] = 'mlm_software/admin/employee/_edit.php';
		$this->load->view('mlm_software/base', $data);
	}
	public function delete()
	{
		$id = $this->input->post('id');
		$conArr = array('id' => $id);
		$record = $this->Common_model->get_data('users', $conArr, '*');
		$cnfDelete = $this->baseUrl . 'mlm_software/admin/employee/empDelete/' . urlencode(base64_encode($id));
		$data = '<i class="mdi mdi-alert-outline me-2"></i>  Are You sure want to delete # ' . $record['name'];
		$cnfBtn = '<a href="' . $cnfDelete . '" class="btn btn-outline-danger waves-effect waves-light pull-right">Confirm Delete <i class="bx bx-trash"></i></a>
	<button type="button" class="btn btn-outline-dark pull-right" data-bs-dismiss="modal"><i class="bx bx-arrow-back"></i> Back </button>';
		$myDataArr = array('actn_msg' => '<i class="bx bx-trash"></i> Delete Employee', 'actn_dt' => $data, 'cnfActnBtn' => $cnfBtn);
		echo json_encode($myDataArr);
	}
	public function empDelete($id)
	{
	
		$conArr = array('id' => base64_decode(urldecode($id)));
		$updateArr = array('is_deleted_at' => date('Y-m-d h:i:s'), 'IsDeleted' => 'Y', 'isDeletedBy' => $this->logId);
		$updateR = $this->Common_model->update_data('users', $conArr, $updateArr);
		
		if ($updateR) {
			redirect(base_url() . 'mlm_software/admin/employee/manage');
		} else {
			echo 'failed';
		}
	}
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('emp_name', 'Employee Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'trim|required|xss_clean');
			$this->form_validation->set_rules('mob_nu', 'Mobile Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
			$this->form_validation->set_rules('district', 'District', 'trim|required|xss_clean');
			$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required|xss_clean');
			$this->form_validation->set_rules('aadhaar_no', 'Aadhaar Number', 'trim|required|xss_clean|max_length[12]|is_unique[member_basic_manage.aadhaar_nu]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('cnfPassword', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
			if ($this->form_validation->run() == TRUE) {
				$post = $this->input->post();
				$id = $post['id'];
				$date_of_birth = $post['date_of_birth'];
				$empN = $post['emp_name'];
				$mob_nu = $post['mob_nu'];
				$aadhaar_no = $post['aadhaar_no'];
				$address = $post['address'];
				$state = $post['state'];
				$district = $post['district'];
				$zipcode = $post['zipcode'];
				$password = $post['password'];
				$conArr = array('id' => base64_decode(urldecode($id)));
				$updateDataArr = array(
					'dob' => $date_of_birth, 'name' => $empN, 'address' => $address, 'adhar_no' => $aadhaar_no, 'password' => md5($password), 'show_ps' => $password,
					'mobile' => $mob_nu, 'state' => $state, 'district' => $district, 'update_at' => date('Y-m-d h:i:s'), 'zipcode' => $zipcode, 'modified_by' => $this->logId, 'designation' => $post['designsn'], 'pan_no' => $post['pan_no']
				);
				/*	$this->Common_model->update_data('users',$conArr,$updateDataArr);
			 echo $this->db->last_query();
			exit;*/
				if ($this->Common_model->update_data('users', $conArr, $updateDataArr)) {
					$data = array('icon' => 'success', 'text' => 'You have successfully upddated');
				} else {
					$msgs = array('Some Error Occur Please Re-Create');
					$data = array('icon' => 'error', 'text' => $msgs);
				}
			} else {
				$msg =  array(
					'date_of_birth' => form_error('date_of_birth'),
					'emp_name' => form_error('emp_name'),
					'mob_nu' => form_error('mob_nu'),
					'address' => form_error('address'),
					'state' => form_error('state'),
					'district' => form_error('district'), 'zipcode' => form_error('zipcode'),
					'aadhaar_no' => form_error('aadhaar_no'),
					'password' => form_error('password'),
					'cnfPassword' => form_error('cnfPassword')
				);
				$data = array('icon' => 'error', 'text' => $msg);
			}
			echo json_encode($data);
		}
	}
	public function upload_image()
	{
		$getImgFl = $this->input->post('file');
		$id = base64_decode(urldecode($this->input->post('id')));
		$getPreviousImage = base64_decode(urldecode($this->input->post('memImg')));
		$image_filename = NULL;
		$config = array('upload_path' => "uploads/emp/", 'allowed_types' => "jpg|png|jpeg|JPEG|JPG", 'overwrite' => FALSE, 'encrypt_name' => TRUE, 'max_size' => "10120000");
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload('file')) {
			$image['image_upload'] = array('upload_data' => $this->upload->data()); //Image Upload
			$image_filename = $image['image_upload']['upload_data']['file_name']; //Image Name
		}
		if ($image_filename) {
			$config = NULL;
			$config['image_library'] = 'gd2';
			$config['source_image']  = 'uploads/emp/' . $image_filename;
			//	$config['new_image']  = 'uploads/emp/thumb/'.$image_filename;
			$config['width']	 = '150';
			$config['height']	= '150';
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$updateDataArr = array('photo' => 'uploads/emp/' . $image_filename);
			$whereCon = array('id' => $id);
			$resltMsg = '';
			if ($getPreviousImage) {
				unlink($getPreviousImage);
				//unlink('uploads/emp/thumb/'.$getPreviousImage);
				$resltMsg = '1====' . $image_filename;
				if (($this->logId == $id) && ($this->session->userdata('user_cate') == '2')) {
					$sessiondata = array('photo' => $image_filename);
					$this->session->set_userdata($sessiondata);
				}
			} else {
				$resltMsg = '2';
			}
			$result = $this->Common_model->update_data('users', $whereCon, $updateDataArr);
			if ($result) {
				$resltMsg = '1====' . $image_filename;
			} else {
				$resltMsg = '2';
			}
			echo $resltMsg;
		} else {
			echo 'Only .jpg,.png,.jpeg are accepted';
		}
	}
	public function save_data()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('roleAs', 'Role As', 'trim|required|xss_clean');
			$this->form_validation->set_rules('emp_code', 'Employee Code', 'trim|required|xss_clean|is_unique[users.user_code]');
			$this->form_validation->set_rules('emp_name', 'Employee Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'trim|required|xss_clean');
			$this->form_validation->set_rules('mob_nu', 'Mobile Number', 'trim|required|xss_clean|max_length[12]');
			$this->form_validation->set_rules('emailId', 'Email Id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
			$this->form_validation->set_rules('district', 'District', 'trim|required|xss_clean');
			$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required|xss_clean');
			$this->form_validation->set_rules('aadhaar_no', 'Aadhaar Number', 'trim|required|xss_clean|max_length[12]|is_unique[users.adhar_no]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('conf_password', 'Confirm Passowrd', 'trim|required|xss_clean|matches[password]');


			if ($this->form_validation->run() == TRUE) {
				$post = $this->input->post();
				$createArr = array('department_type' => $post['roleAs'], 'user_code' => $post['emp_code'], 'email' => $post['emailId'], 'password' => md5($post['password']), 'show_ps' => $post['password'], 'name' => $post['emp_name'], 'address' => $post['address'], 'mobile' => $post['mob_nu'], 'state' => $post['state'], 'district' => $post['district'], 'zipcode' => $post['zipcode'], 'dob' => $post['date_of_birth'], 'adhar_no' => $post['aadhaar_no'], 'created_by_user_id' => $this->logId, 'created_at' => date('Y-m-d'), 'designation' => $post['designsn'], 'pan_no' => $post['pan_no']);
				if ($this->Common_model->save_data('users', $createArr)) {
					$data = array('icon' => 'success', 'text' => 'Data Updated Successfully');
				} else {
					$msgs = array('Some Error Occur Please Re-Update');
					$data = array('icon' => 'error', 'text' => $msgs);
				}
			} else {
				$msg =  array(
					'roleAs' => form_error('roleAs'),
					'emp_code' => form_error('emp_code'),
					'emp_name' => form_error('emp_name'),
					'date_of_birth' => form_error('date_of_birth'),
					'mob_nu' => form_error('mob_nu'),
					'emailId' => form_error('emailId'),
					'address' => form_error('address'),
					'state' => form_error('state'),
					'district' => form_error('district'),
					'zipcode' => form_error('zipcode'),
					'aadhaar_no' => form_error('aadhaar_no'),
					'password' => form_error('password'),
					'conf_password' => form_error('conf_password')
				);
				$data = array('icon' => 'error', 'text' => $msg);
			}
			echo json_encode($data);
		}
	}
	public function cityList()
	{
		$id = $this->input->post('id');
		$getCity = $this->Employee_model->getDataList('states_cities', 'parent_id', $id);
		sleep(1);
		echo '<option value=" ">--- Select One ---</option>';
		if ($getCity) {
			foreach ($getCity as $list) {
				echo '<option value="' . $list->id . '">' . $list->state_cities . '</option>';
			}
		}
	}
	public function passv()
	{
		$pID = $this->input->post('pID');
		sleep(2);
		$data = array('id' => $pID);
		$getPinDeta = $this->Common_model->get_data('users', $data, 'show_ps');
		if ($getPinDeta) {
			echo $getPinDeta['show_ps'];
		} else {
			echo 'Try Again';
		}
	}
}
