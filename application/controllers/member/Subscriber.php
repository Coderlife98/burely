<?php defined('BASEPATH') or exit('No direct script access allowed');

class Subscriber extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('member/member_model', 'member');
        ($this->session->userdata('mem_id')== '') ? redirect(base_url().'member/login', 'refresh') : '';
	    $this->logId=$this->session->userdata('mem_id');
	    $this->u_id=$this->session->userdata('u_id');
		$this->baseUrl=base_url();
	    error_reporting(0);
    }
   public function downline($id=NULL)
    {
		if($id){$memberID=base64_decode(urldecode($id));}else{$memberID=$this->u_id;}		
	/*	print_r($memberID);
		exit;*/
		$parent_details=$this->common->getRowData('msdr_members','username',$memberID);
		$data['title'] = 'Subscriber Tree';
        $data['breadcrums'] = 'Subscriber Tree';
		$getMydownLine=NULL;
		$whereCon=array('sponsor'=>$memberID);
		$getMydownLine=$this->common->all_data_con('msdr_members',$whereCon,'*');
		$data['getMydownLine'] = $getMydownLine;
		$data['parent_details'] = $parent_details;
        $data['layout'] = 'subscriber/downline.php';
        $this->load->view('member/base', $data);	
   	 }
	public function view($actn=NULL)
    {
		$data['title'] = 'Subscriber Tree';
        $data['breadcrums'] = 'Subscriber Tree';
		$data['target'] = 'member/subscriber/child/'.$actn;
        $data['layout'] = 'subscriber/view.php';
        $this->load->view('member/base', $data);	
   	 }
	 public function create_tree()
	 {
	 	$post_id=$this->input->post('id');
		$whereCon=array('username'=>$post_id);
		$whereDownLineCon=array('sponsor'=>$post_id);
		$getCurrentMember=$this->common->get_data('msdr_members',$whereCon,'name,my_img,username');
		$createMydownLine=$this->common->all_data_con('msdr_members',$whereDownLineCon,'*');
		$data['createMydownLine'] = $createMydownLine;
		$data['getCurrentMember'] = $getCurrentMember;
		$this->load->view('member/subscriber/tree', $data);	
		}
	public function child($actn=NULL)
	{ 
		$post_data = $this->input->post();
		$record = $this->member->member_data($post_data,$this->u_id,$actn);
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		$amt = 0;
		foreach ($record as $row) 
		{		
			    if($row->sponsor=='0'){$sponser='N/A';}else{$sponser=$row->sponsor;}	
				$details=base_url('member/subscriber/details/'.urlencode(base64_encode($row->id)));
				$downLine=base_url('member/subscriber/downline/'.urlencode(base64_encode($row->username)));
		$actionBtn='<a href="'.$details.'" class="btn btn-outline-primary btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i> </a>
					<a href="'.$downLine.'" class="btn btn-outline-dark waves-effect waves-light btn-sm" title="Family Member"><i class="bx bx-sitemap"></i></a>';				
		   if($row->username!=$this->u_id){
		   
		   if($row->topup=='0.00') 
		   {$topup='<span style="color:#d22700;font-weight: 600;">0.00</span>'; $pbv='<span style="color:#d22700;font-weight: 600;">N/A</span>';}
		   else{ $topup='<span style="color:#1d8441;font-weight: 600;">'.$row->topup.'</span>';$pbv='<span style="color:#1d8441;font-weight: 600;">'.$row->b_volume.'</span>';}
		   
		   
			$return['data'][] = array(
				'<strong>'.$i++.'.</strong>',
				$row->username,
				$row->name,
				$row->mobile,
				$sponser,$row->address,$topup,$pbv,
				$actionBtn
			);
			}
		}
		$return['recordsTotal'] = $this->member->total_count($this->u_id,$actn);
		$return['recordsFiltered'] = $this->member->total_filter_count($post_data,$this->u_id,$actn);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
      }
	public function details($id)
	{
		$id=base64_decode(urldecode($id));
		$getPro=NULL;
		$getPro=$this->member->profile_details($id);
		$data['getPro'] = $getPro;
	    $data['title'] = 'View Details Downline';
        $data['breadcrums'] = 'View Details Downline';
        $data['layout'] = 'subscriber/details.php';
        $this->load->view('member/base', $data);
		}		
	 
}
