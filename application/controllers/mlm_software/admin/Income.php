<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Income extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->library(array('upload','image_lib','user_agent'));
		$this->load->helper(array('form','email'));
		$this->load->model('mlm_software/admin/income_model', 'income');
        ($this->session->userdata('user_id')== '') ? redirect(base_url(), 'refresh') : '';
	    $this->logId = $this->session->userdata('user_id');
		$this->lgCat = $this->session->userdata('user_cate');
	    $this->baseUrl=base_url();
	    error_reporting(0);
    }
	public function view_earning($action=NULL)
	{
		$data['action'] = $action;
		$data['title'] = ucfirst($action.' View Earning');
    	$data['breadcrums'] = ucfirst($action.' View Earning');
		$data['layout']='mlm_software/admin/income/earning_list.php';
		$data['target']='mlm_software/admin/income/earning_data/'.$action;
		$this->load->view('mlm_software/base', $data);	
		}
	public function earning_data($action=NULL)
	{		
	    $post_data = $this->input->post();
        $record = $this->income->income_data($post_data,$action);
	  	$i=$post_data['start'] + 1;
        $return['data'] = array();
        $amt = 0;
        foreach ($record as $row) {	
		 if($row->my_img){$Img=base_url().$row->my_img;}else{$Img=base_url().'uploads/user/no_profile12.png';}		
		 $name='<img src="'.$Img.'" alt="user" class="dsbordImg"><span class="usrNm">'.$row->name.'</span>';		
		if(strlen($row->type)>15){$remarks='<div class="amtltip">'.substr($row->type, 0, 15).'...<div class="tlptext">'.$row->type.'</div></div>';}else{$remarks=$row->type;}
		 $return['data'][] = array(
		 							'<strong>'.$i++.'.</strong>',
									$name,
									$row->userid,
									'<i class="bx bx-rupee inrP"></i> '.$row->amount,
									$remarks,
									$row->ref_id,
									$row->create_date
									);
        }
        $return['recordsTotal'] = $this->income->total_count($action);
        $return['recordsFiltered'] = $this->income->total_filter_count($post_data,$action);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
    }
	public function payment($method=NULL,$action=NULL)
	{
		$backUrl='mlm_software/admin/income/payment/1/'.$action;
		$data['backUrl'] = $backUrl;
		$data['action'] = $action;
		$data['method'] = $method;
		$data['title'] = ucfirst('Make Payment for '.$action);
    	$data['breadcrums'] = ucfirst('Make Payment for '.$action);
		$data['layout'] = 'mlm_software/admin/income/make_payment.php';
		$data['target']='mlm_software/admin/income/transaction/'.$method.'/'.$action;
		$this->load->view('mlm_software/base', $data);	
		}	
    public function transaction($memType,$actn)
	{
		    $post_data = $this->input->post();
			$record = $this->income->pay_data($post_data,$memType,$actn);
			$i = $post_data['start'] + 1;
			$return['data'] = array();
			$amt = 0;
			foreach ($record as $row)
			 {	
				$getUid=urlencode(base64_encode($row->id));$getUsername=urlencode(base64_encode($row->userid));
				$getUrl=base_url('mlm_software/admin/income/paid_details/'.urlencode(base64_encode($row->id.'-'.$memType)));
				if($row->status=='Un-Paid')
				{
		$status='<div style="background-color:#eaea97;width:80px;padding:2px 5px 2px 5px;text-align:center;font-weight:600;border:1px solid #d5d586;color:#575753;">Un-Paid</div>';
					}
				else if($row->status=='Paid')
				{
		 $status='<div style="background-color:#ace8ac;width:80px;padding:2px 5px 2px 5px;text-align:center;font-weight:600;border:1px solid #9ad99a;color:#027302;">Paid</div>';
					}
				
				if($row->status=='Hold')
				{
					$status='<div style="background-color:#FFA6A6;width:80px;padding:2px 5px 2px 5px;text-align:center;font-weight:600;border:1px solid #D28888;color:#970101;">Hold</div>';
					$newActionBtn='<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#amiModalAction" class="btn btn-outline-dark btn-sm waves-effect btn-padd amInc" data-id="pYUnhld-mlm_software/admin/income/pay_opration-'.$row->id.'-'.$memType.'" title="Unhold Payment"><i class="far fa-play-circle"></i></a>';
					}
				else{
					$newActionBtn='<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#amiModalAction" class="btn btn-outline-success btn-sm waves-effect btn-padd amInc" data-id="pYhld-mlm_software/admin/income/pay_opration-'.$row->id.'-'.$memType.'" title="Hold Payment"><i class="bx bx-pause-circle"></i></a>';
							}
			if($actn!='paid')
			{	
				$actionBtn='<div style="text-align:center">
								
				<span class="btn btn-outline-info btn-sm waves-effect btn-padd" title="Check to pay">
			<div class="form-check form-check-info" style="margin-bottom: -3px !important;margin-right: -5px;"><input type="checkbox" name="payment_select[]"  class="form-check-input amCheck" value="'.$row->id.'"></div></span>
				<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#firstmodal" class="btn btn-outline-primary btn-sm waves-effect btn-padd amInc" data-id="pYn-'.$row->id.'-'.$memType.'" title="Pay Approved"> <i class="far fa-money-bill-alt"></i></a> '.$newActionBtn.'
				<a href="'.$getUrl.'" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
				
				 <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm waves-effect btn-padd amInc" data-id="pYremve-mlm_software/admin/income/pay_opration-'.$row->id.'-'.$memType.'" data-bs-toggle="modal" data-bs-target="#deleteModel" title="Remove"><i class="bx bxs-trash"></i></a>
		 </div>';	
		 	}
			else
			{
				
				$actionBtn='<div style="text-align:center">
								<a href="'.$getUrl.'" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View">
									<i class="mdi mdi-eye"></i>
								</a>
						    </div>';
				
				}									
		$return['data'][]=array(
								 '<strong>'.$i++.'.</strong>',
								 $row->userid,
								 $row->name,
								 '<i class="bx bx-rupee inrP"></i> '.$row->amount,
								 date('H:i:s a ',strtotime($row->request_date)).'<strong>'.date('d-M-Y',strtotime($row->request_date)).'</strong>',
								 $status,
								 $actionBtn
								 );
				   }
				$return['recordsTotal'] = $this->income->pay_total_count($memType,$actn);
				$return['recordsFiltered'] = $this->income->pay_filter_count($post_data,$memType,$actn);
				$return['draw'] = $post_data['draw'];
				echo json_encode($return);		
		}	
	public function pay_opration()
	{
    	$post=$this->input->post();
		$whereCon=array('id'=>$post['id']);
		if($post['actnMng']=='pYremve')
		{
			$getTnxData=$this->income->getwallet_withdraw_data($post['id'],$post['userTyp']);
			$data=array('adClass'=>'tst_success','text'=>'Are you sure want to delete withdraw request of #'.$getTnxData->name,
						'title'=>'<i class="bx bx-trash"></i> Delete Member','action'=>'cnfDeleteWdrwReq-mlm_software/admin/income/pay_opration-'.$post['id'].'-'.$post['userTyp']);
			}
		else if($post['actnMng']=='cnfWrDelete')
		{
			if($post['userTyp']=='member'){$actnWalletTnx='wallet_transaction';$wallet='wallet';$delTble='withdraw_request';}
			else{$actnWalletTnx='partner_wallet_transaction';$wallet='partner_wallet';$delTble='partner_withdraw_request';}
			$getTnxData=$this->income->getwallet_withdraw_data($post['id'],$post['userTyp']);
			$walletInc=$getTnxData->withdr_amt+$getTnxData->wallet_amt;
			$updateWallDtArr=array('balance'=>$walletInc);
			$walletWhereCon=array('userid'=>$getTnxData->u_id);
			$wtnx=date('dHsi');
			$createWalTnx=array('tnx_id'=>$wtnx,'user_id'=>$getTnxData->u_id,'credit_amt'=>$getTnxData->withdr_amt,
								'reason'=>"Admin has cancelled your withdraw request of tnx #".$getTnxData->tnxId.' and amount is credited in your wallet',
								'created_by'=>'0','create_date'=>date('Y-m-d H:s:i'),'transfer_id'=>$this->logId);
			$resultWallet=$this->common->update_data($wallet,$walletWhereCon,$updateWallDtArr);
			if($resultWallet)
			{
			   $createWalletTnx=$this->common->save_data($actnWalletTnx, $createWalTnx);
			   if($createWalletTnx)
				{
					$delConArr=array('id'=>$post['id'],'table'=>$delTble);		
					if($this->common->del_data($delConArr))
					{$data=array('adClass'=>'tst_success','text'=>'Successfully delete withdraw request of member #'.$getTnxData->name);}
					else{$data=array('adClass'=>'tst_danger','text' =>"Ooop's! Some thing went wrong while processing payment request");}
					}else{$data=array('adClass'=>'tst_danger','text' =>"Ooop's! Some thing went wrong while creating wallet details");}				
				}
			else{$data = array('adClass' =>'tst_danger', 'text' =>"<i class='bx bx-tired'></i> Ooop's! Some thing went wrong while updating wallet");}
			}
		else if($post['actnMng']=='pYhld')
		{	
				if($post['userTyp']=='member'){$ReqstHoldTble='withdraw_request';}else{$ReqstHoldTble='partner_withdraw_request';}
				$updateHoldArr=array('status'=>'Hold','paid_date'=>date('Y-m-d H:s:i'),'tid'=>$post['pYhld_det'],'paid_by'=>$this->logId);
				$holdResult=$this->common->update_data($ReqstHoldTble,$whereCon,$updateHoldArr);
				if($holdResult)
				{$data=array('data' =>'1','text' =>'<i class="bx bx-smile"></i> Thank you! You have succesfully hold payment request');}
				else{$data = array('data' =>'2', 'text' =>"<i class='bx bx-tired'></i> Ooop's! Some thing went wrong while holding payment ");}
			}
		else if($post['actnMng']=='pYUnhld')
		{	
			if($post['userTyp']=='member'){$ReqstHoldTble='withdraw_request';}else{$ReqstHoldTble='partner_withdraw_request';}
			$updateHoldArr=array('status'=>'Un-Paid','paid_date'=>date('Y-m-d H:s:i'),'tid'=>'approved to Un-Paid','paid_by'=>$this->logId);
		    if($this->common->update_data($ReqstHoldTble,$whereCon,$updateHoldArr))
			{$data=array('data' =>'1','text' =>'<i class="bx bx-smile"></i> Thank you! You have succesfully hold payment request');}
			else{$data = array('data' =>'2', 'text' =>"<i class='bx bx-tired'></i> Ooop's! Some thing went wrong while holding payment ");}
			}		
			echo json_encode($data);	
	   }	
	public function payNow()
	{	
		$getImgFl=$this->input->post('file');
		$image_filename=NULL;
		$id=$this->input->post('id');
		$tnx_det=$this->input->post('tnx_det');
		$userTyp=$this->input->post('userTyp');
		$nId=explode(",",$id);
		$config = array('upload_path' => "uploads/tnx/",'allowed_types' => "jpg|png|jpeg|JPEG|JPG",'overwrite' => FALSE,'encrypt_name' => TRUE,'max_size' =>"10120000" );
		$this->load->library('upload',$config);
		$this->upload->initialize($config);	
		if($this->upload->do_upload('file'))
		{	$image['image_upload']=array('upload_data' => $this->upload->data()); //Image Upload
			$image_filename=$image['image_upload']['upload_data']['file_name']; //Image Name
			}
			if($image_filename)
			{
				$config=NULL;
				$config['image_library'] = 'gd2';
				$config['source_image']  = 'uploads/tnx/'.$image_filename;
				$config['width']	 = '590';
				$config['height']	= '360';
				$this->image_lib->initialize($config); 
				$this->image_lib->resize();
				if($userTyp=='member'){$processTble='withdraw_request';}else{$processTble='partner_withdraw_request';}
				$resltMsg='';$result='';
				for($i=0;$i< count($nId); $i++)
				{
					$wTnxId=date('dHsi')+$i;
					$whereCon = array('id'=>$nId[$i]);
				    $getWRDetails=$this->common->get_data($processTble,array('id'=>$nId[$i]),'*');		
					$updateDataArr=array('wtnx_id'=>$wTnxId,'payment_image'=>'uploads/tnx/'.$image_filename,'paid_date'=>date('Y-m-d H:s:i'),
										 'tid'=>$tnx_det,'status'=>'Paid','paid_by'=>$this->logId);		  
					if($getWRDetails['status']!='Paid')
					{
						$crMlmTranx=array('tnx_id'=>$wTnxId,'debit_amt'=>$getWRDetails['amount'],'reason'=>$tnx_det .' in member id #'.$getWRDetails['userid'],
				  				  	      'generated_by'=>'1','created_date'=>date('Y-m-d H:s:i'),'created_by'=>$this->logId);
						if($this->common->save_data('mlm_income_manage',$crMlmTranx))
						{$resltMsg='1';}else{$resltMsg='2';}
						$result=$this->common->update_data($processTble,$whereCon,$updateDataArr);
						}
						else{echo 'You have allready paid of user id #'.$getWRDetails['userid'];}
					}
				if($result)
				{$resltMsg='1';}else{$resltMsg='2';}
				echo $resltMsg;
			}else{echo 'Only .jpg,.png,.jpeg are accepted';}
		}
	public function paid_details($id)
	{
		$getParameter=explode('-',base64_decode(urldecode($id)));
		$backUrl=base_url('mlm_software/admin/income/payment/'.$getParameter[1].'/paid');
		if($getParameter[1]=='member'){$tnxTblName='withdraw_request';$memberTbl='msdr_members'; $walletBalTbl='wallet';}
		else{$tnxTblName='partner_withdraw_request';$memberTbl='partners';$walletBalTbl='partner_wallet';}
		$tnxDetails=$this->common->getRowData($tnxTblName,'id',$getParameter[0]);
		if($tnxDetails->paid_by!='0'){$senderD=$this->common->getRowData('users','id',$tnxDetails->paid_by);}else{$senderD=NULL;}
		$memberDet=$this->common->getRowData($memberTbl,'username',$tnxDetails->userid);
		$walletDet=$this->common->getRowData($walletBalTbl,'userid',$tnxDetails->userid);
		$data['walletDet']=$walletDet;$data['memberDet']=$memberDet;$data['tnxDetails']=$tnxDetails;$data['senderD']=$senderD;$data['backUrl'] = $backUrl;
		$data['title'] = ucwords($getParameter[1].' paid details');
    	$data['breadcrums'] = ucwords($getParameter[1].' paid details');
		$data['layout']='mlm_software/admin/income/paid_details.php';
		$this->load->view('mlm_software/base', $data);	
		
		
		}	
}
