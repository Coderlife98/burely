<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
       $this->load->model('mlm_software/admin/ledger_model', 'ledger');
	    $this->load->model('super_admin/dashboard_model', 'dashboard');
        ($this->session->userdata('user_id')== '') ? redirect(base_url(), 'refresh') : '';
	    $this->lgCat=$this->session->userdata['user_cate'];
	    error_reporting(0);
    }
 public function index()
    {
	    
		$frenchiseBv=NULL;$memberBv=NULL;
		$frenchiseBv=$this->dashboard->frenchiseBv();
		$memberBv=$this->dashboard->memberBv();
		//echo $this->db->last_query();die;
		$data['memberBv']=$memberBv;
		
		$shopeeBv=NULL;
		$shopeeBv=$this->dashboard->shopeeBv();
		
		$data['shopeeBv']=$shopeeBv;
		$data['frenchiseBv']=$frenchiseBv;
		
		
		
		$recentOrder=NULL;
		$recentOrder=$this->dashboard->recentSale();
		$data['recentOrder']=$recentOrder;
		
		$recentMember=NULL;
		$recentMember=$this->dashboard->recent_joint();
		$field='sum(credit_amt) as credit, sum(debit_amt) as debit';
		$data['lBalnce']=$this->ledger->get_income($field,$where=NULL);
		$data['lExpense']=$this->ledger->get_income('sum(debit_amt) as debit',"1");
		$data['recentMember'] = $recentMember;
		$data['title'] = 'Dashboard';
        $data['breadcrumb'] = 'Dashboard';
        $this->load->view('super_admin/base', $data);
    }
}
