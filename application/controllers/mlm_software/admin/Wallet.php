<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wallet extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mlm_software/admin/Common_model', 'Common_model');
        $this->load->model('Wallet_model', 'Wallet_model');      
        ($this->session->userdata('user_id') == '') ? redirect(base_url(), 'refresh') : '';
        $this->lgCat = $this->session->userdata['user_cate'];
        $this->logId = $this->session->userdata('user_id');
        $this->baseUrl = base_url();
        error_reporting(0);
    }
    function request()
    {
        $data['title'] = 'User Request';
        $data['breadcrums'] = 'User Request';
        $data['wallet_request'] = $this->Wallet_model->get_wallet_request(); 
        // echo "<pre>";
        // print_r($data);
        // die;     
       
        $data['layout'] = 'mlm_software/admin/wallet/request.php';        
        $this->load->view('mlm_software/base', $data);
    }
}
