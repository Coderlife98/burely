<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Salary extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'email'));
		$this->load->model('super_admin/common_model', 'Common_model');
		$this->load->model('mlm_software/admin/salary_model', 'salary_model');
		($this->session->userdata('user_id') == '') ? redirect(base_url(), 'refresh') : '';
		error_reporting(0);
		$this->logId = $this->session->userdata('user_id');
		$this->lgCat = $this->session->userdata('user_cate');
	}
	public function pay()
	{

		$data['title'] = 'Pay Salary';
		$data['employee'] = NULL;
		$data['breadcrums'] = 'Pay Salary Of Employee';
		$data['employee'] = $this->Common_model->all_data('users', 'id,user_code,name');
		$data['layout'] = 'mlm_software/admin/hr/_pay_salary.php';
		$this->load->view('mlm_software/base', $data);
	}
	public function r_data()
	{
		$post_data = $this->input->post();
		$record = $this->salary_model->salary_data($post_data);
		
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		$amt = 0;
		foreach ($record as $row) {
			$getUid = urlencode(base64_encode($row->id));
			$actionBtn = '<div style="text-align:center"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#salary_approved" class="btn btn-outline-success btn-sm waves-effect btn-padd getAction" data-id="salaryEdt-mlm_software/admin/salary/manage/-' . $row->id . '" title="Edit Salary"><i class="mdi mdi-square-edit-outline me-1"></i></a> 
		<a href="javascript:void(0)"  data-id="salaryDlt-mlm_software/admin/salary/manage/-' . $row->id . '" class="btn btn-outline-danger btn-sm waves-effect btn-padd getAction" title="Delete Record" data-bs-toggle="modal" data-bs-target="#salary_delete" ><i class="bx bxs-trash"></i> </a> </div>';
			if ($row->photo) {
				$Img = base_url() . $row->photo;
			} else {
				$Img = base_url() . 'uploads/user/no_profile2.png';
			}
			if ($row->name) {
				$name = '<img src="' . $Img . '" alt="user" class="dsbordImg"><span class="usrNm">' . $row->name . '</span>';
			} else {
				$name = '<img src="' . $Img . '" alt="user" class="dsbordImg"><span class="usrNm">N/A</span>';
			}
			$monthArr = array("Jan" => "1", "Feb" => "2", "Mar" => "3", "Apr" => "4", "May" => "5", "Jun" => "6", "Jul" => "7", "Aug" => "8", "Sep" => "9", "Oct" => "10", "Nov" => "11", "Dec" => "12");
			$matchMonth = array_search($row->month, $monthArr, true);

			$return['data'][] = array(
				'<strong>' . $i++ . '.</strong>', $row->tnx_id,
				$row->user_code, $name,
				'<i class="bx bx-rupee fntClr"></i> ' . $row->salary,
				'<span style="text-transform: capitalize;">' . $matchMonth . '</span>',
				date('H:s:i a d M Y', strtotime($row->created_date)),
				$actionBtn
			);
		}
		$return['recordsTotal'] = $this->salary_model->total_count();
		$return['recordsFiltered'] = $this->salary_model->total_filter_count($post_data);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}
	public function manage()
	{
		
		$getDetails = NULL;
		$post = $this->input->post();
		
		if ($post['id']) {
			$getDetails = $this->salary_model->details_sal($post['id']);
		}
		if ($post['designActn'] == 'deleteSalD') {
			$data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i>  Are You sure want to delete #' . $getDetails->name);
		} else if ($post['designActn'] == 'cnfDeleteSalD') {
			$trashSalaryTnx = array('id' => $post['id'], 'table' => 'salary');
			$trashMlmTnx = array('id' => $getDetails->tnx_id, 'table' => 'company_income');
			$delDetails = $this->Common_model->del_data($trashSalaryTnx);
			if ($delDetails) {
				$delMlmTnxDetails = $this->salary_model->del_data($trashMlmTnx, 'tnx_id');
				if ($delMlmTnxDetails) {
					$data = array('icon' => '1', 'text' => '<i class="bx bx-smile"></i>  Thank You! you have successfully delete');
				} else {
					$data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems error while deleting salary details');
				}
			} else {
				$data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems error while deleting salary details');
			}
		}
		if ($post['designActn'] == 'view') {
			if ($getDetails) {
				if ($getDetails->modify_date) {
					$modify_date = date('H:i:s a d M Y', strtotime($getDetails->modify_date));
				} else {
					$modify_date = 'N/A';
				}
				$data = array(
					'id' => $getDetails->id, 'emp_id' => $getDetails->staff_id, 'salary' => $getDetails->salary, 'paydate' => date('Y-m-d', strtotime($getDetails->paydate)),
					'month' => $getDetails->month, 'year' => $getDetails->year, 'createdBy' => $getDetails->createdBy, 'created_date' => date('H:i:s d-M-Y', strtotime($getDetails->created_date)), 'modifiedBy' => $getDetails->modifiedBy, 'modifiedId' => $getDetails->modified_by, 'modify_date' => $modify_date
				);
			} else {
				$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is no any designation details found here');
			}
		} else if ($post['designActn'] == 'edit') {
			$conArr = array('id' => $post['id']);
			$upDtArr = array('staff_id' => $post['empId'], 'salary' => $post['salaryAmt'], 'month' => $post['month'], 'year' => $post['year'], 'paydate' => $post['PaidDt'], 'modified_by' => $this->logId, 'modify_date' => date('Y-m-d H:i:s'));

			$mlmTnxModify = array('debit_amt' => $post['salaryAmt'], 'modified_date' => date('Y-m-d H:s:i'), 'modified_by' => $this->logId);
			if ($this->Common_model->update_data('salary', $conArr, $upDtArr)) {
				$conMlmWhereCon = array('tnx_id' => $getDetails->tnx_id);
				if ($this->Common_model->update_data('company_income', $conMlmWhereCon, $mlmTnxModify)) {
					$data = array('icon' => '1', 'text' => '<i class="bx bx-smile"></i> Thank you! You have succesfully update designation details');
				} else {
					$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while updating details');
				}
			} else {
				$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while updating details');
			}
		} else if ($post['designActn'] == 'addSalaryD') {
			
			$tnxId = date('dHis');
			$createSalary = array('tnx_id' => $tnxId, 'staff_id' => $post['empId'], 'salary' => $post['salaryAmt'], 'month' => $post['month'], 'year' => $post['year'], 'paydate' => $post['PaidDt'], 'created_by' => $this->logId, 'created_date' => date('Y-m-d H:i:s'));
			if ($this->Common_model->save_data('salary', $createSalary)) {
				
				
				$tnx_det = 'Employee salary has given in this transaction';
				$mlmTnxArr = array('tnx_id' => $tnxId,'tnx_type'=>'3', 'debit_amt' => $post['salaryAmt'], 'reason' => $tnx_det, 'generated_by' => '1', 'created_date' => date('Y-m-d H:s:i'), 'created_by' => $this->logId);

				if ($this->Common_model->save_data('company_income', $mlmTnxArr)) {
					$data = array('icon' => '1', 'text' => '<i class="bx bx-smile"></i> Thank you! You have succesfully created salary details');
				} else {
					$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while creating details');
				}
			} else {
				echo "muhammd";
				die;
				$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while creating details');
			}
		}
		echo json_encode($data);
	}
	public function emp_sal()
	{
		$post = $this->input->post();
		$sal = $this->salary_model->get_emp_sal($post['id']);
		if ($post['id'] && $sal) {
			$data = array('icon' => '1', 'text' => $sal->payscale);
		} else {
			$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while getting salary details');
		}
		echo json_encode($data);
	}
	public function emp_sal_data($id)
	{
		$post_data = $this->input->post();
		$record = $this->salary_model->emp_salary_data($post_data, $id);/*echo $this->db->last_query();die;*/
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		$amt = 0;
		foreach ($record as $row) {
			$monthArr = array("Jan" => "1", "Feb" => "2", "Mar" => "3", "Apr" => "4", "May" => "5", "Jun" => "6", "Jul" => "7", "Aug" => "8", "Sep" => "9", "Oct" => "10", "Nov" => "11", "Dec" => "12");
			$matchMonth = array_search($row->month, $monthArr, true);

			$return['data'][] = array(
				'<strong>' . $i++ . '.</strong>', $row->tnx_id,
				'<i class="bx bx-rupee fntClr"></i> ' . $row->salary,
				'<span style="text-transform: capitalize;">' . $matchMonth . '</span>',
				date('H:s:i a d M Y', strtotime($row->created_date))
			);
		}
		$return['recordsTotal'] = $this->salary_model->total_emp_sal_count($id);
		$return['recordsFiltered'] = $this->salary_model->total_emp_sal_filter_count($post_data, $id);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}
}
