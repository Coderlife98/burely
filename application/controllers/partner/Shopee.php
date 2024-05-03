<?php defined('BASEPATH') or exit('No direct script access allowed');

class Shopee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->library(array('upload','image_lib'));
		$this->load->helper(array('form','email'));
        ($this->session->userdata('partner_id')== '') ? redirect(base_url().'partner/login', 'refresh') : '';
		$this->load->model('partner/partner_model', 'partner');
	    $this->logId=$this->session->userdata('partner_id');
	    $this->u_id=$this->session->userdata('partner_username');
	    error_reporting(0);
    }
   public function index()
    {
		$data['title'] = 'Shopee List';
    	$data['breadcrums'] = 'Shopee List';
    	$data['layout'] = 'profile/shopee_list.php';
		$this->load->view('partner/base',$data);
   	 } 
	public function create()
	{
		$username = rand(10000, 99999);
		if ($this->common->count_all('partners', array('username' => $username)) > 0) {
			$username = $username + 1;
			if ($this->common->count_all('partners', array('username' => $username)) > 0) {
				$username = $username + 2;
				if ($this->common->count_all('partners', array('username' => $username)) > 0) {
					$username = $username + 3;
				}
			}
		}
		$data['getState'] = $this->common->getDataList('states_cities', 'parent_id', '729');
		$data['username'] = $username;
		$data['title'] = 'Create Shopee';
    	$data['breadcrums'] = 'Create Shopee';
    	$data['layout'] = 'profile/shopee_operation.php';
		$this->load->view('partner/base',$data);
		}  
	public function view_list()
	{
		$post_data = $this->input->post();
		$record = $this->partner->shopee_data($post_data, $this->logId);
		####################### echo $this->db->last_query();die;#######################
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		$amt = 0;
		foreach ($record as $row) {
			$shpeeId = urlencode(base64_encode($row->id));
			$actionBtn = '<div style="text-align:center;">
						   <a href="' .base_url('partner/shopee/operation/'.$shpeeId). '" class="btn btn-outline-primary btn-sm waves-effect btn-padd" title="order Now">
						   <i class="mdi mdi-cart"></i> </a>
						   <a href="' .base_url('partner/shopee/edit/'.$shpeeId).'" class="btn btn-outline-success btn-sm waves-effect btn-padd" title="Edit">
						   <i class="mdi mdi-square-edit-outline me-1"></i> </a>
						   <a href="' .base_url('partner/shopee/view/'.$shpeeId). '" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View">
						   <i class="mdi mdi-eye"></i> </a>
						 </div>';
			if (strlen($row->address) > 20) {
				$address = substr($row->address, 0, 15) . '...';
			} else {
				$address = $row->address;
			}
			if ($row->my_img) {
				$Img = base_url($row->my_img);
			} else {
				$Img = base_url('uploads/user/no_profile12.png');
			}
			$name = '<img src="' . $Img . '" alt="user" class="dsbordImg"><span class="usrNm">' . $row->name . '</span>';
			$return['data'][] = array(
				'<strong>' . $i++ . '.</strong>',
				$row->username,
				$name,
				$row->mobile,
				$row->email,
				$address,
				$actionBtn
			);
		}
		$return['recordsTotal'] = $this->partner->shopee_count($this->logId);
		$return['recordsFiltered'] = $this->partner->shopee_filter($post_data, $this->logId);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}	
	public function operation()
	{
		$post=$this->input->post();
		$miPrefix='Please provide shopee ';
		$isCheckNullArr=array("gender."=>"gender","name."=>"mem_name","date of birth."=>"dob","mobile number."=>"mob_nu","email id."=>"emailId","password."=>"password",
							  "confirm password."=>"confPass","pan number."=>"pan_no","aadhaar number."=>"aadhaar_no","address."=>"address","state."=>"statN",
							  "district."=>"district","zipcode."=>"zipcode","bank name."=>"bName","account number."=>"bankAc","Bank IFSC."=>"bnkIFSC","branch name."=>"brName",			                              "nominee name."=>"nomiName","nominee relationship."=>"nomineeRel","nominee address."=>"NomAddr"
							  );
		$matchPost=array_search($row->month,$isCheckNullArr,true);	
		$hasErrorMsg=array();
		if($post)
		{
			foreach($post as $key=>$list)
			{
				if(!$list)
				{
					$matchPost=array_search($key,$isCheckNullArr,true);	
					array_push($hasErrorMsg,$miPrefix.$matchPost);
					}
				}
			}
			if($hasErrorMsg)
			{
				$data=array('adClass'=>'tst_danger','msg'=>$hasErrorMsg,'icon'=>'<i class="bx bx-cog bx-spin"></i>');
		 		}
				else
				{
					if($post['miAction']=='1')
					{
						if (!filter_var($post['emailId'], FILTER_VALIDATE_EMAIL))
						 {$msg=array(" Oops it seems shopee email in not valid.");$data=array('adClass'=>'tst_warning','msg'=>$msg,'icon'=>'<i class="bx bx-cog bx-spin"></i>');}
						else if($post['password']!=$post['confPass'])
						{
							$msg=array(" Oops it seems password doesn't match confirm password.");
							$data=array('adClass'=>'tst_warning','msg'=>$msg,'icon'=>'<i class="bx bx-cog bx-spin"></i>');
							}
							else
							{
								
									$createArr=array(
													 'user_typ'=>'2','username'=>$post['mem_code'],'gender'=>$post['gender'],'name'=>$post['mem_name'],'email'=>$post['emailId'],
													 'mobile'=>$post['mob_nu'],'password'=>md5($post['password']),'shw_pass'=>$post['confPass'],'create_date'=>date('Y-m-d H:i:s'),
													 'created_type'=>'2','created_by'=>$this->logId,'assigned_seller'=>$this->u_id
													 );
								$getProfile=$this->common->getRowData('partners','username',$post['mem_code']);
								if($getProfile)
								{
									$updateArr=array(
													 'gender'=>$post['gender'],'name'=>$post['mem_name'],'email'=>$post['emailId'],
													 'mobile'=>$post['mob_nu'],'password'=>md5($post['password']),'shw_pass'=>$post['confPass'],'modify_date'=>date('Y-m-d H:i:s'),
													 'modify_typ'=>'2','created_by'=>$this->logId
													 );
									$shopWhere=array('id'=>$getProfile->id);
									$shopUpdate=$this->common->update_data('partners',$shopWhere,$updateArr);
									if($shopUpdate)
									{
										$shopWhere=array('mem_id'=>$getProfile->id);
										$shopeeArr=array('date_of_birth'=>$post['dob']);
										$shopUpdate=$this->common->update_data('partners_basic_manage',$shopWhere,$shopeeArr);
										if($shopUpdate)
										{
											$msg=array('Thank you ! You have successfully complete personal details. ');
											$data=array('adClass'=>'tst_success','msg'=>$msg,'icon'=>'<i class="bx bx-check"></i>','actn'=>'2','shopId'=>$getProfile->id);
											}
											 else
												{
													$msg=array('Oops it seems error.please refresh you page.');
													$data=array('adClass'=>'tst_warning','msg'=>$msg,'icon'=>'<i class="bx bx-cog bx-spin"></i>');
												   }
										}
										else
										{
											$msg=array('Oops it seems error.please refresh you page.');
											$data=array('adClass'=>'tst_warning','msg'=>$msg,'icon'=>'<i class="bx bx-cog bx-spin"></i>');
											}
									
								
									}
								else
								{
								
									$lastId=$this->common->save_data('partners',$createArr);//$lastId='29';				 
									if($lastId)
									{
										$basicDetArr=array('mem_id'=>$lastId,'date_of_birth'=>$post['dob']);
										$basicDetId=$this->common->save_data('partners_basic_manage',$basicDetArr);	//$basicDetId='1';
										if($basicDetId)
										{
											$msg=array('Thank you ! You have successfully complete personal details. ');
											$data=array('adClass'=>'tst_success','msg'=>$msg,'icon'=>'<i class="bx bx-check"></i>','actn'=>'2','shopId'=>$lastId);
											}
											 else
												{
													$msg=array('Oops it seems error.please refresh you page.');
													$data=array('adClass'=>'tst_warning','msg'=>$msg,'icon'=>'<i class="bx bx-cog bx-spin"></i>');
												   }
										}
										 else
										 {
											$msg=array('Oops it seems error.please refresh you page.');
											$data=array('adClass'=>'tst_warning','msg'=>$msg,'icon'=>'<i class="bx bx-cog bx-spin"></i>');
											}
										}
							}		
				  	}
					else if($post['miAction']=='2')
					{
						$shopWhere=array('id'=>$post['shoppId']);
						$shopeeArr=array('address'=>$post['address']);
						$shopUpdate=$this->common->update_data('partners',$shopWhere,$shopeeArr);
						if($shopUpdate)
						{
							$basicWhere=array('mem_id'=>$post['shoppId']);
							$basicDetArr=array(
												'state'=>$post['statN'],'district'=>$post['district'],'zipcode'=>$post['zipcode'],'pan_nu'=>$post['pan_no'],
												'aadhaar_nu'=>$post['aadhaar_no']
												);
						
							$basicUpdate=$this->common->update_data('partners_basic_manage',$basicWhere,$basicDetArr);
							if($basicUpdate)
							{
								$msg=array('You have complete communication details');
								$data=array('adClass'=>'tst_success','msg'=>$msg,'icon'=>'<i class="bx bx-check"></i>','actn'=>'3');
								}
								else
								{
									$msg=array('Oops it seems error while updating communication details.');
									$data=array('adClass'=>'tst_danger','msg'=>$msg,'icon'=>'<i class="bx bx-cog bx-spin"></i>');
									}					
							}
							else
							{
								$msg=array('Oops it seems error while communication details.');
								$data=array('adClass'=>'tst_warning','msg'=>$msg,'icon'=>'<i class="bx bx-cog bx-spin"></i>');	
								}
						}
						else if($post['miAction']=='3')
						{
							$basicWhere=array('mem_id'=>$post['shoppId']);
							$basicDetArr=array('bank_name'=>$post['bName'],'bank_ac_no'=>$post['bankAc'],'bank_Ifsc'=>$post['bnkIFSC'],'bankBrName'=>$post['brName'],
											   'nominee_name'=>$post['nomiName'],'nominee_relationship'=>$post['nomineeRel'],'nominee_address'=>$post['NomAddr']
											   );
							$basicUpdate=$this->common->update_data('partners_basic_manage',$basicWhere,$basicDetArr);
							if($basicUpdate)
							{
								$msg=array('You have complete banking detials.');
								$data=array('adClass'=>'tst_success','msg'=>$msg,'icon'=>'<i class="bx bx-check"></i>','actn'=>'4');
								}
								else
								{
									$msg=array('Oops it seems error while updating banking detials.');
									$data=array('adClass'=>'tst_danger','msg'=>$msg,'icon'=>'<i class="bx bx-cog bx-spin"></i>');
									}	
							}
							else if($post['miAction']=='4')
							{
								$moreWhereCon=array('mem_id'=>$post['shoppId']);
								$getProfile=$this->common->getRowData('partners_basic_manage','mem_id',$post['shoppId']);			
								$prevImg=array($getProfile->pan_img=>"pancard",$getProfile->passbook_img=>"passbook",$getProfile->adhar_img=>"edtAadhar");
								$imgField=array('pan_img'=>"pancard",'passbook_img'=>"passbook",'adhar_img'=>"edtAadhar");
								$imgSaveField=array_search($post['docType'],$imgField);
								$prevImgLoc=array_search($post['docType'],$prevImg);
								$default='uploads/partner_document/no_img.png';
								if($prevImgLoc==$default){$resetImgLoc='';}else{$resetImgLoc=$prevImgLoc;}		
								$getImgFl=$this->input->post('file');
								$image_filename=NULL;
				$config=array('upload_path'=>"uploads/partner_document/",'allowed_types'=>"jpg|png|jpeg|JPEG|JPG",'overwrite'=>FALSE,'encrypt_name'=>TRUE,'max_size'=>"10120000" );
				$this->load->library('upload',$config);$this->upload->initialize($config);	
			if($this->upload->do_upload('file'))
			{$image['image_upload']=array('upload_data' => $this->upload->data());$image_filename=$image['image_upload']['upload_data']['file_name'];}
				if($image_filename)
				{
					$config=NULL;$config['image_library'] = 'gd2';$config['source_image']  = 'uploads/partner_document/'.$image_filename;
					$config['width']='150';$config['height']='150';$this->image_lib->initialize($config);$this->image_lib->resize();
				$updateDataArr=array($imgSaveField=>'uploads/partner_document/'.$image_filename,'modified_type'=>'1','modify_by'=>$this->logId,'modify_date'=>date('Y-m-d H:i:s'));
					if($resetImgLoc){unlink($resetImgLoc);}	
					$result=$this->common->update_data('partners_basic_manage',$moreWhereCon,$updateDataArr);
					if($result)
					{	$msg=array('Thank you! You have successfully update document details');
						$data=array('adClass'=>'tst_success','msg'=>$msg,'img_loc'=>'uploads/partner_document/'.$image_filename,'actn'=>'4','icon'=>'<i class="bx bx-check"></i>');
						}
					else
					{
						$msg=array('Oops it seems server taking more time please refresh');
						$data=array('adClass'=>'tst_danger','msg'=>$msg,'actn'=>'4','icon'=>'<i class="bx bx-cog bx-spin"></i>');
						}
						sleep(1);
				}else{$msg=array('Only .jpg,.png,.jpeg are accepted');$data=array('adClass'=>'tst_warning','msg'=>$msg,'actn'=>'4','icon'=>'<i class="bx bx-cog bx-spin"></i>');}
					}					
			   }	
		//print_r($post);			
		 echo json_encode($data);
		}	
	public function detele($id)
	{
		$post=$this->input->post();
		$getData=explode("/",$post['actn']);
		$moreWhereCon=array('mem_id'=>$getData[1]);
		$getProfile=$this->common->getRowData('partners_basic_manage','mem_id',$getData[1]);
		$imgField=array('pan_img'=>"delPan",'passbook_img'=>"delBankpass",'adhar_img'=>"delAadhar");
		$imgSaveField=array_search($getData[0],$imgField);
		$prevImg=array($getProfile->pan_img=>"delPan",$getProfile->passbook_img=>"delBankpass",$getProfile->adhar_img=>"delAadhar");
		$prevImgLoc=array_search($getData[0],$prevImg);$default='uploads/partner_document/no_img.png';
		if($prevImgLoc==$default){$resetImgLoc='';}else{$resetImgLoc=$prevImgLoc;}	
		$updateArr=array($imgSaveField=>'uploads/partner_document/no_img.png');
		if($resetImgLoc){unlink($resetImgLoc);}	
		$result=$this->common->update_data('partners_basic_manage',$moreWhereCon,$updateArr);
		if($result)
		{	$msg='<i class="bx bx-smile"></i> Thank you! You have successfully update document details';
			$data = array('icon' => '1','text'=>$msg,'img_loc'=>'uploads/partner_document/no_img.png');
			}
			else{$msg=array('<i class="fa fa-cog rotate"></i> Oops it seems server taking more time please refresh');$data=array('icon'=>'2','text'=>$msg);}
			sleep(2);
			echo json_encode($data);	
		}	
	public function edit($id)
	{
		$shpeeId = base64_decode(urldecode($id));
		$getShopee=NULL;
		$getShopee=$this->partner->profile_details($shpeeId);
		$getState=$this->common->getDataList('states_cities', 'parent_id', '729');
		$data['getCity'] = $this->common->getDataList('states_cities', 'parent_id', $getShopee->state);
		$data['getShopee'] = $getShopee;$data['getState'] = $getState;
		$data['username'] = $getShopee->username;
		$data['title'] = 'Edit Shopee';
    	$data['breadcrums'] = 'Edit Shopee';
    	$data['layout'] = 'profile/shopee_operation.php';
		$this->load->view('partner/base',$data);
		}
	public function view($id)
	{
		$shpeeId = base64_decode(urldecode($id));
		$getShopee=$this->partner->profile_details($shpeeId);
		$data['getShopee'] = $getShopee;
		$data['title'] = 'View Shopee';
    	$data['breadcrums'] = 'View Shopee';
    	$data['layout'] = 'profile/shopee.php';
		$this->load->view('partner/base',$data);
		}	
	public function selectedFrenchise()
	{
		$postId=$this->input->post('id');
		$getDetails=$this->partner->getSelectedFrenchiseStateWiseData($postId);
		echo json_encode($getDetails);
		}		
}



