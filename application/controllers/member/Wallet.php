<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wallet extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member/Income_model', 'income');
	
		($this->session->userdata('mem_id') == '') ? redirect(base_url() . 'member/login', 'refresh') : '';
		$this->logId = $this->session->userdata('mem_id');
		$this->u_id = $this->session->userdata('u_id');
		error_reporting(0);
	}

	function index()
	{

		$data['accDetails'] = $this->common->getRowData('bank_details', 'id', '1');
		$data['title'] = 'My Wallet';
		$data['actnType'] = NULL;
		$data['breadcrums'] = 'My Wallet';
		$data['wallet'] = $this->common->sum_all('balance', 'wallet', array('userid' => $this->u_id));
		$data['layout'] = 'wallet/wallet.php';
		$this->load->view('member/base', $data);
	}

	public function manage($actn = NULL)
	{
		if ($actn == 'create') {
			$this->load->library(array('upload', 'image_lib'));
			$post = $this->input->post();
			$image_filename = NULL;
			$config = array('upload_path' => "uploads/wallet_request_bill/", 'allowed_types' => "jpg|png|jpeg|JPEG|JPG", 'overwrite' => FALSE, 'encrypt_name' => TRUE, 'max_size' => "10120000");
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('depositedSlip')) {
				$image['image_upload'] = array('upload_data' => $this->upload->data());
				$image_filename = $image['image_upload']['upload_data']['file_name'];
			}

			if ($image_filename) {
				$config = NULL;
				$config['image_library'] = 'gd2';
				$config['source_image']  = 'uploads/wallet_request_bill/' . $image_filename;
				$config['width']	 = '600';
				$config['height']	= '600';
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$createDataArr = array(
					'mem_id'         => $this->logId,
					'userid'         => $this->u_id,
					'tnx_id'         => date('Hdsi'),
					'amount'         => $post['depositAmt'],
					'tansection_id'         => $post['tansection_id'],
					'pay_mode'       => $post['payMode'],
					'tnx_date'       => date('Y-m-d', strtotime($post['depositedDate'])),
					'create_date'    => date('Y-m-d H:i:s'),
					'tnx_slip'      => 'uploads/tnx/' . $image_filename
				);
				$result = $this->common->save_data('wallet_topup_request', $createDataArr);
				if ($result) {
					$data = array('result' => 'tst_success', 'msg' => "Thank you! You have successfully submit your request");
				} else {
					$data = array('result' => 'tst_danger', 'msg' => "Opps it seems error while sending your request");
				}
			} else {
				$data = array('result' => 'tst_danger', 'msg' => 'Oops only .jpg,.png,.jpeg are accepted');
			}
			sleep(2);
			echo json_encode($data);
		} else if ($actn == 'delete') {
			$post = $this->input->post('actn');
			$getDeposit = $this->common->getRowData('wallet_topup_request', 'id', $post);

			$trashDepositTnx = array('id' => $post, 'table' => 'wallet_topup_request');
			$delDetails = $this->common->del_data($trashDepositTnx);
			if ($delDetails) {
				if ($getDeposit->tnx_slip != 'uploads/tnx/no_tnx.png') {
					unlink($getDeposit->tnx_slip);
				}
				$data = array('icon' => '1', 'msg' => '<i class="fa fa-smile-o"></i> Thank You! you have successfully delete');
			} else {
				$data = array('icon' => '2', 'msg' => '<i class="fa fa-exclamation-triangle"></i> Oops it seems error while deleting deposit details');
			}
			sleep(3);
			echo json_encode($data);
		} else {
			$data['accDetails'] = $this->common->getRowData('bank_details', 'id', '1');
			$data['wallet_request'] = $this->common->all_data_con('wallet_topup_request',array('userid'=>$this->u_id),'*');
			$data['title'] = 'Request For Wallet Topup';
			$data['actnType'] = NULL;
			$data['breadcrums'] = 'Request For Wallet Topup';
			$data['layout'] = 'wallet/create_deposit.php';
			$this->load->view('member/base', $data);
		}
	}

	function wallet_transection()
	{
		echo "wait for some time to view details";
	}

	
}
