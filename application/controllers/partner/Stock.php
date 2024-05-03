<?php defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('partner/stock_model', 'stock');
        ($this->session->userdata('partner_id')== '') ? redirect(base_url().'partner/login', 'refresh') : '';
	    $this->logId=$this->session->userdata('partner_id');
	    $this->u_id=$this->session->userdata('partner_username');
		$this->baseUrl=base_url();
	    error_reporting(0);
    }
   public function index()
    {
		$data['title'] = 'My Stock';
    	$data['breadcrums'] = 'My Stock ';
    	$data['layout'] = 'stock/_list.php';
		$this->load->view('partner/base',$data);
   	 } 
	public function details()
	{
		$post_data = $this->input->post();
		$record = $this->stock->stock_data($post_data,$this->logId);
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		foreach ($record as $row) {
		
		       if($row->product_qty<10){$stock='<div style="color:#ce3000;font-weight: 600;text-align: center;">'.$row->product_qty.'</div>';}
				else if($row->product_qty < 50){$stock='<div style="color:#d07500;font-weight: 600;text-align: center;">'.$row->product_qty.'</div>';}	
				else{$stock='<div style="color:#008e00;font-weight: 600;text-align: center;">'.$row->product_qty.'</div>';}
		

			$getUid = base_url('partner/stock/product_wise/'.urlencode(base64_encode($row->id)));
			$actionBtn = '<div style="text-align:center;">
								<a href="'.$getUid.'" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
						  </div>';
			$return['data'][] = array(
										'<strong>' . $i++ . '.</strong>',
										$row->prod_id,
										$row->product_name,
										
										'<i class="bx bx-rupee inrP"></i> '.$row->product_mrp,
										'<i class="bx bx-rupee inrP"></i> '.$row->product_price,
										$stock,$actionBtn
										);
		}
		$return['recordsTotal'] = $this->stock->total_count($this->logId);
		$return['recordsFiltered'] = $this->stock->filter_count($post_data,$this->logId);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}

	public function product_wise($id)
	{
		$id=base64_decode(urldecode($id));
		$stock=$this->stock->getProStockData($id);
		$data['title'] = 'My Stock';
    	$data['breadcrums'] = 'My Stock ';
    	$data['layout'] = 'stock/product_wise_list.php';
		$data['target'] = 'partner/stock/product_wise_details/'.urlencode(base64_encode($stock->product_details_id));
		$data['stock']=$stock;
		$this->load->view('partner/base',$data);
		}
	public function product_wise_details($id)
	{
		$proId=base64_decode(urldecode($id));
		$post_data = $this->input->post();
		$record = $this->stock->product_wise_data($post_data,$this->logId,$proId);
		/* echo $this->db->last_query();echo die;*/
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		foreach ($record as $row) {
			$date=$this->common->getRowData('order_history','invoice_id',$row->invoice_id);
			if($date->delevery_date){$delivery=date('d-m-Y',strtotime($date->delevery_date));}else{$delivery='N/A';}
			$return['data'][] = array(
										'<div style=" text-align:center;font-weight:900;">' . $i++ . '.</div>',
										$row->invoice_id,$row->product_name,$row->product_qty,
										'<i class="bx bx-rupee inrP"></i> '.$row->product_mrp,
										'<i class="bx bx-rupee inrP"></i> '.$row->product_selling_price,
										$delivery
										);
		}
		$return['recordsTotal'] = $this->stock->product_wise_total_count($this->logId,$proId);
		$return['recordsFiltered'] = $this->stock->product_wise_filter_count($post_data,$this->logId,$proId);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}
}
