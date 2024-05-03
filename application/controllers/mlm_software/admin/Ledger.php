<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ledger extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('mlm_software/admin/ledger_model', 'ledger');
        ($this->session->userdata('user_id')== '') ? redirect(base_url(), 'refresh') : '';
	    $this->lgCat=$this->session->userdata['user_cate'];
	    $this->baseUrl=base_url();
	    error_reporting(0);
    }
	public function manage()
	{	
		$data['title'] = 'Ledger View';
    	$data['breadcrums'] = 'Ladger View';
		$field='sum(credit_amt) as credit, sum(debit_amt) as debit';
		$data['lBalnce']=$this->ledger->get_income($field,$where=NULL);
		$data['lExpense']=$this->ledger->get_income('sum(debit_amt) as debit',"1");
    	$data['layout'] = 'mlm_software/admin/income/ladger.php';
		$this->load->view('mlm_software/base', $data);
		}
	public function ledger_data()
	{		
	    $post_data = $this->input->post();
        ####################### print_r($post_data);die;#######################
        $record = $this->ledger->ledger_data($post_data);
        ####################### echo $this->db->last_query();die;#######################
	    $i = $post_data['start'] + 1;
        $return['data'] = array();
        $amt = 0;
        foreach ($record as $row) {	
		$getUid=urlencode(base64_encode($row->id));		
		$actionBtn='<a href="'.$this->baseUrl.'mlm_software/admin/ledger/view/'.$getUid.'" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View">
			 <i class="mdi mdi-eye"></i> </a>';
		$createDate=date('H:s:i a d-M-Y',strtotime($row->created_date));
		if($row->debit_amt!='0.00'){$debit='<i class="bx bx-rupee inrP"></i> '.$row->debit_amt;}else{$debit=' ';}
		if($row->credit_amt!='0.00'){$credit='<i class="bx bx-rupee inrP"></i> '.$row->credit_amt;}else{$credit=' ';}
		if(strlen($row->reason)>15){$reason='<div class="amtltip">'.substr($row->reason, 0, 15).'...<div class="tlptext">'.$row->reason.'</div></div>';}else{$reason=$row->reason;}
		 $return['data'][] = array($i++,$row->tnx_id,$debit,$credit,$reason,$createDate,$actionBtn);
        }
        $return['recordsTotal'] = $this->ledger->total_count();
        $return['recordsFiltered'] = $this->ledger->total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
    }
	public function view($id)
	{
		$id = base64_decode(urldecode($id));
	    $whereCon=array('id'=>$id);$memberDet=NULL;$senderD=NULL;
		$data['title'] = 'Transactions View';
    	$data['breadcrums'] = 'Transactions View';
		//$tnxDetails=$this->ledger->get_tnx_data($id);
		$tnxDetails=$this->common->getRowData('company_income','id',$id);
			
		$avBalance=NULL;
		if($tnxDetails->tnx_type=='1')
		{
			$memberDet=$this->ledger->get_mem_wallet($tnxDetails->tnx_id);
			/*echo $this->db->last_query();echo'<br>';
			print_r($memberDet);die;*/
			}
		else if($tnxDetails->tnx_type=='2' || $tnxDetails->tnx_type=='5')
		{
			$memberDet=$this->ledger->get_partner_wallet($tnxDetails->tnx_id);
			echo $this->db->last_query();echo'<br>';
			/*SELECT pwt.id,pwt.tnx_id,p.id,username,name,email,mobile,my_img FROM partner_wallet_transaction as pwt left join partners as p on p.username=pwt.user_id where pwt.tnx_id='15252523' */
			/*print_r($memberDet);die;*/
			}	
		else if($tnxDetails->tnx_type=='3')
		{
			$memberDet=$this->ledger->getSalaryTnxDetails($tnxDetails->tnx_id);
			$avBalance=$this->common->get_data('salary',array('staff_id'=>$memberDet->u_id),'sum(salary) as balance');
			}
		
		
		
		
		
		if($tnxDetails->generated_by=='1')
		{
			$whereConEmp=array('id'=>$tnxDetails->created_by);
			$senderD=$this->common->get_data('users',$whereConEmp,'user_code,department_type,email,name,mobile,photo');
			//$memberDet=$this->ledger->get_mem_wallet($tnxDetails->user_id);
		}
		else if($tnxDetails->generated_by=='0')
		{
			$senderD=NULL;
			//$memberDet=$this->ledger->get_mem_wallet($tnxDetails->created_by);
		}
		$data['senderD']=$senderD;
		$data['memberDet']=$memberDet;
		$data['tnxDetails']=$tnxDetails;
		$data['avBalance']=$avBalance;
		$data['layout'] = 'mlm_software/admin/income/tnxView.php';
		$this->load->view('mlm_software/base', $data);
		}	
	
	/*
	
	SELECT mim.id,mim.tnx_id,wt.user_id,mim.debit_amt,mim.credit_amt,mim.reason,mim.created_by,mim.created_date,generated_by FROM mlm_income_manage as mim LEFT join wallet_transaction as wt ON wt.tnx_id=mim.tnx_id 
	
	*/

	
	
}
