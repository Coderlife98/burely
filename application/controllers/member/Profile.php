<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->library(array('upload','image_lib','user_agent'));
		$this->load->helper(array('form','email'));
        ($this->session->userdata('mem_id')== '') ? redirect(base_url().'member/login', 'refresh') : '';
		$this->load->model('member/member_model', 'member');
	    $this->logId=$this->session->userdata('mem_id');
	    $this->u_id=$this->session->userdata('u_id');
		$this->baseUrl=base_url();
	    error_reporting(0);
    }
   public function index()
    {
		$member=$this->member->profile_details($this->logId);
		$data['getState'] =$this->common->getDataList('states_cities','parent_id','729');
		$data['getCity'] =$this->common->getDataList('states_cities','parent_id',$member->state);
		$data['member']=$member;
		$data['title'] = 'Profile';
    	$data['breadcrums'] = 'Profile';
    	$data['layout'] = 'profile/profile.php';
		$this->load->view('member/base',$data);
   	 } 
    public function change_password()
    {
		$post=$this->input->post();
		if($post)
		{
			$whereCon=array('id'=>$this->logId);
			$getPassword=$this->common->get_data('msdr_members',$whereCon,'password');
			if($getPassword['password']==md5($post['pre_pass']))
			{
				
		$moreDetArr=array('password'=>md5($post['pre_pass']),'shw_pass'=>$post['pre_pass'],'modified_by'=>$this->logId,'modify_typ'=>'1','modify_date'=>date('Y-m-d H:i:s'));
						if($this->common->update_data('msdr_members',$whereCon,$moreDetArr))
						{$msg=array("Thank you! You have successfully changed your password");$data=array('class'=>'tst_success','text'=>$msg);}
					    else{$msg=array('Oops it seems server taking more time please refresh');$data=array('class'=>'tst_danger','text'=>$msg);}
						/*echo $this->db->last_query();*/
				
				}
				else
				{ $msg=array("Oops it seems previous password doesn't match");$data=array('class'=>'tst_warning','text'=>$msg);
				   }
			  echo json_encode($data);	
			}
			else
			{
				$data['title'] = 'Proifle Reset Password';
    			$data['breadcrums'] = 'Reset Password';
				$data['layout'] = 'profile/change_password.php';
				$this->load->view('member/base',$data);
				}
   	 }
	 public function edit()
	 {
	 	$post=$this->input->post();
		$moreWhereCon=array('mem_id'=>$this->logId);
		$getProfile=$this->common->getRowData('msdr_member_basic','mem_id',$this->logId);
		if($post['actn']=='prInfo')
		{
			$whereCon=array('id'=>$this->logId);
			$basicArr=array('name'=>$post['pNameE'],'gender'=>$post['genderE'],'mobile'=>$post['mobileE'],'email'=>$post['emailTE'],'address'=>$post['addrrE'],
							'modified_by'=>$this->logId,'modify_typ'=>'1','modify_date'=>date('Y-m-d H:i:s'));
			if($this->common->update_data('msdr_members',$whereCon,$basicArr))
			{
				if($getProfile)
				{
					
					$moreDetArr=array('date_of_birth'=>$post['dobE'],'state'=>$post['stateE'],'district'=>$post['districtE'],'zipcode'=>$post['zipcodeE'],'pan_nu'=>$post['panE'],				                                      'aadhaar_nu'=>$post['aadharE'],'modify_by'=>$this->logId,'modified_type'=>'1','modify_date'=>date('Y-m-d H:i:s'));
						if($this->common->update_data('msdr_member_basic',$moreWhereCon,$moreDetArr))
						{$data = array('class' => 'tst_success', 'text' =>'Thank you! You have successfully updated your details');}
					    else{$msg=array('Oops it seems server taking more time please refresh');$data=array('class'=>'tst_danger','text'=>$msg);}
					}
					else
					{
						$crtDtArr=array('mem_id'=>$this->logId,'date_of_birth'=>$post['dobE'],'state'=>$post['stateE'],'district'=>$post['districtE'],'zipcode'=>$post['zipcodeE'],
										'pan_nu'=>$post['panE'],'aadhaar_nu'=>$post['aadharE'],'created_by'=>$this->logId,'created_type'=>'1','created_date'=>date('Y-m-d H:i:s'));
							if($this->common->save_data('msdr_member_basic', $crtDtArr))
							{$data = array('class' => 'tst_success', 'text' =>'Thank you! You have successfully create details');}
						else{$msg=array('Oops it seems server taking more time please refresh');$data=array('class'=>'tst_danger','text'=>$msg);}
						}	
				}
				else{$msg=array('Oops it seems server taking more time please refresh');$data = array('class' => 'tst_danger', 'text' =>$msg);}									
		  }
		 else if($post['actn']=='bnkInfo')
		 {
			if($getProfile)
				{$bnkDetArr=array('bank_name'=>$this->isCheckNull('bName'),'bank_ac_no'=>$this->isCheckNull('acNumber'),'bank_Ifsc'=>$this->isCheckNull('brName'),
			                         'bankBrName'=>$this->isCheckNull('brName'),'modify_by'=>$this->logId,'modified_type'=>'1','modify_date'=>date('Y-m-d H:i:s'));
						if($this->common->update_data('msdr_member_basic',$moreWhereCon,$bnkDetArr))
						{$data = array('class' => 'tst_success', 'text' =>'Thank you! You have successfully updated your bank details');}
					    else{$msg=array('Oops it seems server taking more time please refresh');$data=array('class'=>'tst_danger','text'=>$msg);}
					}
					else
					{
			$crtDtArr=array('mem_id'=>$this->logId,'bank_name'=>$this->isCheckNull('bName'),'bank_ac_no'=>$this->isCheckNull('acNumber'),'bank_Ifsc'=>$this->isCheckNull('brName'),			                            'bankBrName'=>$this->isCheckNull('brName'),'created_by'=>$this->logId,'created_type'=>'1','created_date'=>date('Y-m-d H:i:s'));
							if($this->common->save_data('msdr_member_basic', $crtDtArr))
							{$data = array('class' => 'tst_success', 'text' =>'Thank you! You have successfully create bank details');}
						else{$msg=array('Oops it seems server taking more time please refresh');$data=array('class'=>'tst_danger','text'=>$msg);}
						}	
			
			} 
		 else if($post['actn']=='nomineeInfo')
		 {
			if($getProfile)
				{
					$nomineeDetArr=array('nominee_name'=>$this->isCheckNull('nomineeName'),'nominee_relationship'=>$this->isCheckNull('nomineeRelation'),
			                             'nominee_address'=>$this->isCheckNull('nomineeAddr'),'modify_by'=>$this->logId,'modified_type'=>'1','modify_date'=>date('Y-m-d H:i:s'));
					  if($this->common->update_data('msdr_member_basic',$moreWhereCon,$nomineeDetArr))
						{$data = array('class' => 'tst_success', 'text' =>'Thank you! You have successfully updated your nominee details');}
					    else{$msg=array('Oops it seems server taking more time please refresh');$data=array('class'=>'tst_danger','text'=>$msg);}
					}
					else
					{
			$crtDtArr=array('mem_id'=>$this->logId,'nominee_name'=>$this->isCheckNull('nomineeName'),'nominee_relationship'=>$this->isCheckNull('nomineeRelation'),
			                'nominee_address'=>$this->isCheckNull('nomineeAddr'),'created_by'=>$this->logId,'created_type'=>'1','created_date'=>date('Y-m-d H:i:s'));
							if($this->common->save_data('msdr_member_basic', $crtDtArr))
							{$data = array('class' =>'tst_success', 'text' =>'Thank you! You have successfully create nominee details');}
						else{$msg=array('Oops it seems server taking more time please refresh');$data=array('class'=>'tst_danger','text'=>$msg);}
						}	
			} 
		  else if($post['actn']=='midoc')
		  {
		  		$prevImg=array($getProfile->pan_img=>"pancard",$getProfile->passbook_img=>"passbook",$getProfile->adhar_img=>"edtAadhar");
				$imgField=array('pan_img'=>"pancard",'passbook_img'=>"passbook",'adhar_img'=>"edtAadhar");
				$imgSaveField=array_search($post['docType'],$imgField);
				$prevImgLoc=array_search($post['docType'],$prevImg);
				$default='uploads/member_document/no_img.png';
				if($prevImgLoc==$default){$resetImgLoc='';}else{$resetImgLoc=$prevImgLoc;}		
				$getImgFl=$this->input->post('file');
				$id=$this->input->post('id');
				$image_filename=NULL;
				$config=array('upload_path'=>"uploads/member_document/",'allowed_types'=>"jpg|png|jpeg|JPEG|JPG",'overwrite'=>FALSE,'encrypt_name'=>TRUE,'max_size'=>"10120000" );
				$this->load->library('upload',$config);$this->upload->initialize($config);	
			if($this->upload->do_upload('file'))
			{$image['image_upload']=array('upload_data' => $this->upload->data());$image_filename=$image['image_upload']['upload_data']['file_name'];}
				if($image_filename)
				{
					$config=NULL;$config['image_library'] = 'gd2';$config['source_image']  = 'uploads/member_document/'.$image_filename;
					$config['width']='150';$config['height']='150';$this->image_lib->initialize($config);$this->image_lib->resize();
				$updateDataArr=array($imgSaveField=>'uploads/member_document/'.$image_filename,'modified_type'=>'1','modify_by'=>$this->logId,'modify_date'=>date('Y-m-d H:i:s'));
					$whereCon = array('mem_id'=>$id);if($resetImgLoc){unlink($resetImgLoc);}	
					$result=$this->common->update_data('msdr_member_basic',$whereCon,$updateDataArr);
					if($result)
					{	$msg='Thank you! You have successfully update document details';
						$data = array('class' => 'tst_success','text'=>$msg,'img_loc'=>'uploads/member_document/'.$image_filename);
						}
					else
					{
						$msg=array(' Oops it seems server taking more time please refresh');$data=array('class'=>'tst_danger','text'=>$msg);
						}
						sleep(1);
				}else{$msg=array('<i class="fa fa-cog rotate"></i> Only .jpg,.png,.jpeg are accepted');$data=array('class'=>'tst_danger','text'=>$msg);}
				
						
						}
		  else if($post['actn']=='cnfrmDelete')
		  {
		  	    $imgField=array('pan_img'=>"delPan",'passbook_img'=>"delBankpass",'adhar_img'=>"delAadhar");
				$imgSaveField=array_search($post['docType'],$imgField);
				$prevImg=array($getProfile->pan_img=>"delPan",$getProfile->passbook_img=>"delBankpass",$getProfile->adhar_img=>"delAadhar");
				$prevImgLoc=array_search($post['docType'],$prevImg);$default='uploads/member_document/no_img.png';
				if($prevImgLoc==$default){$resetImgLoc='';}else{$resetImgLoc=$prevImgLoc;}	
				$updateArr=array($imgSaveField=>'uploads/member_document/no_img.png');
				if($resetImgLoc){unlink($resetImgLoc);}	
				$result=$this->common->update_data('msdr_member_basic',$moreWhereCon,$updateArr);
				if($result)
				{	$msg='<i class="bx bx-smile"></i> Thank you! You have successfully update document details';
					$data = array('class' => 'ami_success','text'=>$msg,'img_loc'=>'uploads/member_document/no_img.png');
					}
					else{$msg=array('<i class="fa fa-cog rotate"></i> Oops it seems server taking more time please refresh');$data=array('class'=>'ami_danger','text'=>$msg);}
			}
		   else if($post['actn']=='profileImg')
		   {
		   		//print_r($post);
				$getProfile=$this->common->getRowData('msdr_members','id',$this->logId);
				$getImgFl=$this->input->post('file');
				$id=$this->input->post('id');
				$image_filename=NULL;
				$config=array('upload_path'=>"uploads/member/",'allowed_types'=>"jpg|png|jpeg|JPEG|JPG",'overwrite'=>FALSE,'encrypt_name'=>TRUE,'max_size'=>"10120000" );
				$this->load->library('upload',$config);$this->upload->initialize($config);	
			if($this->upload->do_upload('file'))
			{$image['image_upload']=array('upload_data' => $this->upload->data());$image_filename=$image['image_upload']['upload_data']['file_name'];}
				if($image_filename)
				{
					$config=NULL;$config['image_library'] = 'gd2';$config['source_image']  = 'uploads/member/'.$image_filename;
					$config['width']='150';$config['height']='150';$this->image_lib->initialize($config);$this->image_lib->resize();
				    $updateDataArr=array('my_img'=>'uploads/member/'.$image_filename,'modify_typ'=>'1','modified_by'=>$this->logId,'modify_date'=>date('Y-m-d H:i:s'));
					$whereCon = array('id'=>$this->logId);if($getProfile->my_img!='uploads/member/no_img.png'){unlink($getProfile->my_img);}	
				$result=$this->common->update_data('msdr_members',$whereCon,$updateDataArr);
					if($result)
					{	$msg='Thank you! You have successfully update document details';
						$data = array('class' => 'tst_success','text'=>$msg,'img_loc'=>'uploads/member/'.$image_filename);
						$sessiondata = array('mem_photo'=>'uploads/member/'.$image_filename);$this->session->set_userdata($sessiondata);
						}
					else
					{
						$msg=array('Oops it seems server taking more time please refresh');$data=array('class'=>'tst_danger','text'=>$msg);
						}
						
				}else{$msg=array('Only .jpg,.png,.jpeg are accepted');$data=array('class'=>'tst_danger','text'=>$msg);}
				
		   		}	
			sleep(2);
		  echo json_encode($data);	
		} 
    public function cityList()
    {
   	 $id = $this->input->post('id');	
	$getCity=$this->common->getDataList('states_cities','parent_id',$id);
	 sleep(1);
	 echo '<option value=" ">--- Select One ---</option>';
	 if($getCity)
	 {
	   foreach($getCity as $list)
	   {
		 echo '<option value="'.$list->id.'">'.$list->state_cities.'</option>';
 		  }
	   }
	 
	}
	private function isCheckNull($field){$post=$this->input->post($field);if($post=='N/A'){return '';}else{return $post;}}	
 
}
