<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deposit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('partner/Income_model', 'income');
        ($this->session->userdata('partner_id')== '') ? redirect(base_url().'partner/login', 'refresh') : '';
	    $this->logId=$this->session->userdata('partner_id');
	    $this->u_id=$this->session->userdata('partner_username');
		$this->u_cate=$this->session->userdata('p_cate');
	    error_reporting(0);
    }
	public function manage($actn=NULL)
	{
		if($actn=='create')
		{
			$this->load->library(array('upload','image_lib'));
			$post=$this->input->post();$image_filename=NULL;
			$config=array('upload_path'=>"uploads/tnx/",'allowed_types' =>"jpg|png|jpeg|JPEG|JPG",'overwrite'=>FALSE,'encrypt_name'=>TRUE,'max_size'=>"10120000");
            $this->load->library('upload',$config);$this->upload->initialize($config);	
			if($this->upload->do_upload('depositedSlip'))
			{$image['image_upload']=array('upload_data'=>$this->upload->data());$image_filename=$image['image_upload']['upload_data']['file_name'];}
			if($image_filename)
			{
				$config=NULL;
				$config['image_library'] = 'gd2';
				$config['source_image']  = 'uploads/tnx/'.$image_filename;
				$config['width']	 = '600';
				$config['height']	= '600';
				$this->image_lib->initialize($config); 
				$this->image_lib->resize();
				$createDataArr=array(
									  'mem_id'=>$this->logId,'tnx_id'=>date('Hdsi'),'amount'=>$post['depositAmt'],'reason'=>$post['remarks'],'pay_mode'=>$post['payMode'],
									  'tnx_date'=>date('Y-m-d',strtotime($post['depositedDate'])),'create_date'=>date('Y-m-d H:i:s'),'tnx_slip'=>'uploads/tnx/'.$image_filename
									  );			  
				$result=$this->common->save_data('partner_deposit',$createDataArr);
				if($result){$data=array('result'=>'success','msg'=>"Thank you! You have successfully submit your request");}
				else{$data=array('result'=>'error','msg'=>"Opps it seems error while sending your request");}
			}
				else{$data=array('result'=>'error','msg'=>'Oops only .jpg,.png,.jpeg are accepted');}
			sleep(5);	
			echo json_encode($data);
			}
		else if($actn=='delete')
		{
			$post=$this->input->post('actn');
			$getDeposit=$this->common->getRowData('partner_deposit','id',$post);
			
			$trashDepositTnx=array('id'=>$post,'table'=>'partner_deposit');
		     $delDetails=$this->common->del_data($trashDepositTnx);
			 if($delDetails)
			 {
			 	if($getDeposit->tnx_slip!='uploads/tnx/no_tnx.png'){unlink($getDeposit->tnx_slip);}
				$data= array('icon'=>'1','msg'=>'<i class="fa fa-smile-o"></i> Thank You! you have successfully delete');
				}
			 else{$data=array('icon'=>'2','msg'=>'<i class="fa fa-exclamation-triangle"></i> Oops it seems error while deleting deposit details');}	
				sleep(3);
				echo json_encode($data);
			}	
		else
		{
			$data['title'] = 'Create Deposite to Company';$data['actnType']=NULL;
			$data['breadcrums'] = 'Create Deposite to Company';
			$data['layout'] = 'stock/create_deposit.php';
			$this->load->view('partner/base',$data);
			
			}
		}
	public function view($actn=NULL)
	{
			if($actn=='getList')	
			{
				  $post_data = $this->input->post();
				  ####################### print_r($post_data);die;#######################
				  $record = $this->income->deposit_data($post_data,$this->logId);
				  ####################### echo $this->db->last_query();die;#######################
				  $i = $post_data['start'] + 1;
				  $return['data'] = array();$amt = 0;
				  foreach ($record as $row) 
				 {	
				 	$view=base_url('partner/deposit/view/'.urlencode(base64_encode($row->id)));
				 
				 	$return['data'][] = array(
												$i++,'<div align="center">'.date('H:i:s d-m-Y',strtotime($row->create_date)).'</div>',$row->tnx_id,$row->reason,
												'<span style="font-weight:600">'.$row->amount.'</span>',
												'<div align="center"><span class="'.$row->status.'">'.$row->status.'</span></div>',
												'<div align="center">
													<a href="'.$view.'" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View">
													 <i class="mdi mdi-eye"></i> 
													</a>
<div data-bs-toggle="modal" data-bs-target="#deleteModel" data-id="delDepo-partner/deposit/manage/delete-'.$row->id.'" class="btn btn-outline-danger btn-sm waves-effect btn-padd amInc" title="Delete">
													 <i class="bx bxs-trash"></i> 
													</div>
												</div>'
											);
					}
				$return['recordsTotal'] = $this->income->deposit_count($this->logId);
				$return['recordsFiltered'] = $this->income->deposit_filter_count($post_data,$this->logId);
				$return['draw'] = $post_data['draw'];
				echo json_encode($return);
    
				}
				
				else
				{
					if($actn)
					{
							$id=base64_decode(urldecode($actn));
							$data['deposit']=$this->common->getRowData('partner_deposit','id',$id);
							$data['title'] = 'View Deposited Details';$data['actnType']='viewData';
							$data['breadcrums'] = 'View Deposited Details';
							$data['layout'] = 'stock/create_deposit.php';
							$this->load->view('partner/base', $data);
						
						}
					else
					{
						$data['title'] = 'Create Deposite to Company';
						$data['breadcrums'] = 'Create Deposite to Company';
						$data['target'] = 'partner/deposit/view/getList';
						$data['layout'] = 'stock/deposit_list.php';
						$this->load->view('partner/base',$data);
						
						
						
						}
					}
		}

}
