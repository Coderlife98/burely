<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function __construct()
    {
       
	    parent::__construct();
		$this->load->library(array('upload','image_lib'));
		$this->load->helper(array('form','email'));
        $this->load->model('super_admin/common_model', 'Common_model');
        $this->load->model('super_admin/mlm_software/plan_model', 'Plan_model');
		$this->load->model('super_admin/mlm_software/member_model', 'Member_model');
		$this->load->model('mlm_software/member/income_model', 'income_model');
       // ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
       ($this->session->userdata('user_id') == '') ? redirect(base_url(), 'refresh') : '';
	    error_reporting(1);
		$this->baseUrl=base_url();
		$this->logId=$this->session->userdata('user_id');
    }
    public function add_member($sponser=NULL)
    {
       	$data['sponser'] = $sponser;
	    $data['title'] = 'Add Member';
        $data['breadcrums'] = 'Add Member';
		$data['getState'] =$this->Member_model->getDataList('states_cities','parent_id','729');
        $data['layout'] = 'mlm_software/member/add_member.php';
        $this->load->view('super_admin/base', $data);
    }
    public function save_data()
    {
        if ($this->input->is_ajax_request()) {
			
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean'); 
			$this->form_validation->set_rules('name', 'Member Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|xss_clean|max_length[10]|is_unique[members.mobile]');
            $this->form_validation->set_rules('email', 'Email ID', 'trim|required|xss_clean|valid_email|is_unique[members.email]');
            $this->form_validation->set_rules('sponsor', 'Sponsor ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('placement', 'Placement ID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('placement_leg', 'Placement Leg', 'trim|required|xss_clean');			
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('confirm_password', 'Confirm Passowrd', 'trim|required|xss_clean|matches[password]');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
            if ($this->form_validation->run() == TRUE) {
                $post = $this->input->post();
				
                $gender        = $post['gender'];
				$name          = $post['name'];
                $email         = $post['email'];
                $mobile        = $post['mobile'];
                $address       = $post['address'];
				$state         = $post['state'];
			    $district      = $post['district'];
				$zipcode       = $post['zipcode']; 
				$sponsor       = $post['sponsor'];
				$position      = $post['placement'];
				$placement_leg = $post['placement_leg'];
                $leg           = $post['leg'] ? $post['leg']  : 'A';
                $password      = $post['password'];
                ##############################################################################
                #
                # ID Generate 
                #
                ##############################################################################
                $username = rand(10000, 99999);
				/*echo $this->db->last_query();*/			 
			    if ($this->Common_model->count_all('members', array('username' => $username)) > 0) {
                    $username = $username + 1;
                    if ($this->Common_model->count_all('members', array('username' => $username)) > 0) {
                        $username = $username + 2;
                        if ($this->Common_model->count_all('members', array('username' => $username)) > 0) {
                            $username = $username + 3;
                        }
                    }
                }			
                ###############################################################################
                #
                # Now get selected blank Leg (eg: A, B, C, D) of position ID
                # If Position id is blank, sponsor ID will become position ID
                # If selected leg of position is not blank, will return error.
                #
                ###############################################################################
                if (trim($position) == ""){ $position = $sponsor;}
                #######################Written by Amit start#######################
				$createMember='';
				 if(!$this->isExistMember($sponsor))
				{
					$msg = array('It seems this member id does not exist for sponsor id');
					$data = array('icon' => 'error', 'text' => $msg);}
				else if(!$this->isExistMember($position))
				{
					$msg = array('It seems this member id does not exist for placement id');
					$data = array('icon' => 'error', 'text' => $msg);
					}
				else if($position==$sponsor) 
				{
                  	 $getSponserPosition=$this->Plan_model->find_child_position('members','username',$sponsor);
					 unset($getSponserPosition['sponsor']); 
					 $key = array_search('0', $getSponserPosition);
					 $spLegFill=array();
					 if($key)
					 {  $createMember='1';$setConditionForSponser=array('username'=>$sponsor);$spLegFill=array($key=>$username);
						$updateNewLegForSponser=$this->Common_model->update_data('members',$setConditionForSponser,$spLegFill);
						//if($updateNewLegForSponser){echo 'Data Updated for sponser ';}else{echo 'Not data Update sponser';}
						}
					  else
					  {
					  	/*$msg = array('The selected Position of Placement ID is Already filled..');$data = array('icon' => 'error', 'text' => $msg);*/
						$createMember='1';
						}
				} 
				else {
							
							$getSponserPosition=$this->Plan_model->find_child_position('members','username',$sponsor);
							if($getSponserPosition['sponsor']=='0')
							{
							 unset($getSponserPosition['sponsor']); 
								}
							 $key = array_search('0', $getSponserPosition); $spLegFill=array();
							 $getPlacementPosition=$this->Plan_model->find_child_position('members','username',$position);
							 $keyForPlacementRole = array_search('0', $getPlacementPosition);
							 if($key)
							 {  $setConditionForSponser=array('username'=>$sponsor);$spLegFill=array($key=>$username);
								$updateNewLegForSponser=$this->Common_model->update_data('members',$setConditionForSponser,$spLegFill);
								//if($updateNewLegForSponser){echo 'Data Updated for sponser <br>';}else{echo 'Not data Update sponser';}
								$createMember='1';
								}
							else if($keyForPlacementRole)
							{	
								$createMember='1';$setConditionForPlacement=array('username'=>$position);$placementLegFill=array($keyForPlacementRole=>$username);
								$updateNewLegForPlacement=$this->Common_model->update_data('members',$setConditionForPlacement,$placementLegFill);
						/*if($updateNewLegForPlacement){echo 'Placement Leg fill update position on '.$keyForPlacementRole;}else{echo 'Error at placement leg filling time';}*/
								}
							else
							{
								$createMember='1';
								/*$msg=array('The selected Position of Placement ID is Already filled.');$data = array('icon' => 'error', 'text' => $msg);*/
								/*echo 'Already Filled';*/
								}
				         }		 		   
                    #######################Written by Amit start#######################	
				$getFirstInc=$this->Common_model->get_first('rank_system','*');		   
		        $array = array( 'gender'        => $gender,
								'name'          => $name,
								'email'         => $email,
								'mobile'        => $mobile,
								'username'      => $username,
								'sponsor'       => $sponsor,
								'position'      => $position,
								'placement_leg' => $placement_leg,
								'password'      => md5($password),
								'shw_pass'      => $password,
								'address'       => $address,
								'rank'      	=> $getFirstInc->reward_name,
								'rank_id'       => $getFirstInc->id,
								'create_date'   => date('Y-m-d'),
								'join_time'     => date('Y-m-d H:i:s'));
			    if($createMember=='1')	  
				{ 
						$addNewMember=$this->Common_model->save_data('members', $array);
						if($addNewMember)
						  {		
								$ewalletArr=array('userid'=>$username,'balance'=>'0.00');
								$addrInsert=array('mem_id'=>$addNewMember,'state'=>$state,'district'=>$district,'zipcode'=>$zipcode);
								if($this->Common_model->save_data('wallet', $ewalletArr))
								{
									if($this->Common_model->save_data('member_basic_manage', $addrInsert))
									{
										$data = array('icon' => 'success', 'text' =>'Data Updated Successfully');
										}
									else{$data = array('icon' => 'warning', 'text' =>'Some Error Occure While Creating Ewallet');}
									}
								else{$data = array('icon' => 'warning', 'text' =>'Some Error Occure While Creating Ewallet');}
						 } 
						 else{$data = array('icon' => 'error', 'text' => 'Some Error Occur Please Re-Update');}	
					 }
            } else {
                $msg =  array(
								'gender'          => form_error('gender'),
								'name'            => form_error('name'),
								'mobile'          => form_error('mobile'),
								'email'           => form_error('email'),
								'address'         => form_error('address'),
								'state'           => form_error('state'),
								'district'        => form_error('district'),
								'zipcode'         => form_error('zipcode'),
								'sponsor'         => form_error('sponsor'),
								'placement'       => form_error('placement'),
								'placement_leg'   => form_error('placement_leg'),	
								'password'        => form_error('password'),
								'confirm_password'=> form_error('confirm_password'),
								
                );
                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);
			
        }
    }
	public function member_list()
	{
        $data['title'] = 'Member List';
        $data['breadcrums'] = 'Member List';
        $data['layout'] = 'mlm_software/member/_list.php';
        $this->load->view('super_admin/base', $data);
		}
    public function member_data()
    {
        $post_data = $this->input->post();
    //    print_r($post_data);die;
	    ####################### print_r($post_data);die;#######################
        $record = $this->Member_model->member_data($post_data);
        ####################### echo $this->db->last_query();die;#######################
        $i = $post_data['start'] + 1;

        $return['data'] = array();
        $amt = 0;
        foreach ($record as $row) {		
if($row->status=='Active'){
	$status = '<div class="btn-group getNbtn"><button type="button" id="shwBtnVal-'.$row->id.'" class="btn btn-success dropdown-toggle btn-pad show" data-bs-toggle="dropdown" aria-expanded="true">'.$row->status.'<i class="mdi mdi-chevron-down"></i></button>
		<div class="dropdown-menu " style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
			<a class="dropdown-item getActn" data-id="Active-'.$row->id.'" href="javascript: void(0);">Active</a>
			<a class="dropdown-item getActn" data-id="Block-'.$row->id.'" href="javascript: void(0);">Block</a>
			<a class="dropdown-item getActn" data-id="Suspend-'.$row->id.'" href="javascript: void(0);">Suspend</a>
		</div>
	</div>';
}elseif($row->status=='Block'){
	$status = '<div class="btn-group getNbtn"><button type="button" id="shwBtnVal-'.$row->id.'" class="btn btn-danger dropdown-toggle btn-pad show" data-bs-toggle="dropdown" aria-expanded="true">'.$row->status.'<i class="mdi mdi-chevron-down"></i></button>
		<div class="dropdown-menu " style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
			<a class="dropdown-item getActn" data-id="Active-'.$row->id.'" href="javascript: void(0);">Active</a>
			<a class="dropdown-item getActn" data-id="Block-'.$row->id.'" href="javascript: void(0);">Block</a>
			<a class="dropdown-item getActn" data-id="Suspend-'.$row->id.'" href="javascript: void(0);">Suspend</a>
		</div>
	</div>';
}
elseif($row->status=='Suspend'){
	$status = '<div class="btn-group getNbtn"><button type="button" id="shwBtnVal-'.$row->id.'" class="btn btn-warning dropdown-toggle btn-pad show" data-bs-toggle="dropdown" aria-expanded="true">'.$row->status.'<i class="mdi mdi-chevron-down"></i></button>
		<div class="dropdown-menu " style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
			<a class="dropdown-item getActn" data-id="Active-'.$row->id.'" href="javascript: void(0);">Active</a>
			<a class="dropdown-item getActn" data-id="Block-'.$row->id.'" href="javascript: void(0);">Block</a>
			<a class="dropdown-item getActn" data-id="Suspend-'.$row->id.'" href="javascript: void(0);">Suspend</a>
		</div>
	</div>';
}
			if($row->position=='0')
			{	
				$position='N/A';
				}
				else{$position=$row->position;}	
				$getUid=urlencode(base64_encode($row->id));
				$getUsername=urlencode(base64_encode($row->username));	
			$actionBtn='<a href="'.$this->baseUrl.'super_admin/mlm_software/member/view/'.$getUid.'" class="btn btn-outline-primary btn-sm waves-effect btn-padd" title="View">
			 <i class="bx bxs-show"></i> </a>
			<a href="'.$this->baseUrl.'super_admin/mlm_software/member/tree/'.$getUid.'" class="btn btn-outline-warning btn-sm waves-effect righM btn-padd" title="Family Member">
			<span class="avatar-title bg-transparent text-reset"> <i class="mdi mdi-family-tree"></i> </span></a>
				<a href="'.$this->baseUrl.'super_admin/mlm_software/member/edit/'.$getUid.'" class="btn btn-outline-success btn-sm waves-effect btn-padd" title="Edit">
				<i class="mdi mdi-square-edit-outline me-1"></i> </a>
				<a href="'.$this->baseUrl.'super_admin/mlm_software/member/add_member/'.$getUsername.'" class="btn btn-outline-dark btn-sm waves-effect btn-padd" title="Share">
				<i class="bx bx-share-alt"></i> </a>';				
           if($row->my_img){$Img=base_url().$row->my_img;}else{$Img=base_url().'uploads/user/no_profile12.png';}		
			$name='<img src="'.$Img.'" alt="user" class="dsbordImg"><span class="usrNm">'.$row->name.'</span>';		
		   
		   
		    $return['data'][] = array(
                /*$i++,*/
				$row->username,
                $name,
				$row->email,
                $row->mobile,
				$position,
				$status,
				$actionBtn
            );
        }
        $return['recordsTotal'] = $this->Member_model->total_count();
        $return['recordsFiltered'] = $this->Member_model->total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
    }
	public function get_status()
	{
		 $get_id = $this->input->post('id');
		$memberSts=explode('-',$get_id);
		$setConditionForMember=array('id'=>$memberSts[1]);
		$updateDataArr=array('status'=>$memberSts[0]);
		$updateStausForMember=$this->Common_model->update_data('members',$setConditionForMember,$updateDataArr);
		if($updateStausForMember)
		{	
			echo $get_id;
			}
		}
	public function edit($id)
	{
		$id = base64_decode(urldecode($id));
		$data=array('id'=>$id);
		$mem_id=array('mem_id'=>$id);
		$getMemberDetails=$this->Common_model->get_data('members',$data,'*');
		$data['getMemberBasicDetails'] = $this->Common_model->get_data('member_basic_manage',$mem_id,'*');
		$data['getState'] =$this->Member_model->getDataList('states_cities','parent_id','729');
		$data['getCity']=$this->Member_model->getDataList('states_cities','parent_id',$data['getMemberBasicDetails']['state']);
		$data['getMemberDetails'] = $getMemberDetails;
		$data['title'] = 'Edit Member';
        $data['breadcrums'] ='Edit Member';
        $data['layout'] = 'mlm_software/member/_edit.php';
        $this->load->view('super_admin/base', $data);
		
		}	
	public function update()
	{
	if ($this->input->is_ajax_request())
	{
		$post = $this->input->post();
		$id= $post['id'];
		$mem_id=array('mem_id'=>$id);					 
		$getMemberBasicDetails = $this->Common_model->get_data('member_basic_manage',$mem_id,'*');
		if($getMemberBasicDetails)
		{
			$addrUniq='trim|required|xss_clean|max_length[12]';
			$panUniq='trim|required|xss_clean|max_length[12]';
			}else
			{
					$addrUniq='trim|required|xss_clean|max_length[12]|is_unique[member_basic_manage.aadhaar_nu]';
					$panUniq='trim|required|xss_clean|max_length[12]|is_unique[member_basic_manage.gst_number]';
						}
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('district', 'District', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('gst_nu', 'GST Number', $panUniq);	
		$this->form_validation->set_rules('pan_no', 'Pan Number', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('aadhaar_no', 'Aadhaar Number', $addrUniq);	

		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('cnfPassword', 'Confirm Password', 'trim|required|xss_clean|matches[password]');	


		$this->form_validation->set_rules('bank_name', 'Date of Birth', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('bank_ac_no', 'Bank Account Number', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('bank_Ifsc', 'Bank IFSC code', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('bankBrName', 'Bank Name', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('btc_address', 'BTC Address', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('nominee_name', 'Nominee Name', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('nominee_address', 'Nominee Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('nominee_relationship', 'Nominee Relationship', 'trim|required|xss_clean');			
		if ($this->form_validation->run() == TRUE) 
		{	
			$mem_name= $post['mem_name'];
			$address= $post['address'];
			$mem_mobile= $post['mem_mobile'];
			
			$gender= $post['gender'];
			$date_of_birth= $post['date_of_birth'];
			$state= $post['state'];
			$district= $post['district'];
			$zipcode= $post['zipcode'];
			$gst_nu= $post['gst_nu'];
			$pan_no= $post['pan_no'];
			$aadhaar_no= $post['aadhaar_no'];$password= $post['password'];
			$bank_name= $post['bank_name'];
			$bank_ac_no= $post['bank_ac_no'];
			$bank_Ifsc= $post['bank_Ifsc'];
			$bankBrName= $post['bankBrName'];
			$btc_address= $post['btc_address'];
			$nominee_name= $post['nominee_name'];
			$nominee_address= $post['nominee_address'];
			$nominee_relationship= $post['nominee_relationship'];
			$memBasicDetails=array('name'=>$mem_name,'address'=>$address,'mobile'=>$mem_mobile,'password'=>md5($password),'shw_pass'=>$password);
			$whereBasicCon=array('id'=>$id);
			$createDataArr=array('mem_id'=>$id,'gender'=>$gender,'date_of_birth'=>$date_of_birth,'state'=>$state,'district'=>$district,'zipcode'=>$zipcode,
			                     'gst_number'=>$gst_nu,'pan_nu'=>$pan_no,'aadhaar_nu'=>$aadhaar_no,
								 'bank_name'=>$bank_name,'bank_ac_no'=>$bank_ac_no,'bank_Ifsc'=>$bank_Ifsc,'bankBrName'=>$bankBrName,
								 'btc_address'=>$btc_address,'nominee_name'=>$nominee_name,'nominee_address'=>$nominee_address,
								 'nominee_relationship'=>$nominee_relationship,'created_date'=>date('Y-M-d')
								 );
			if($this->Common_model->update_data('members',$whereBasicCon,$memBasicDetails))
			{
			if($getMemberBasicDetails)
			{
				$updateDataArr=array('gender'=>$gender,'date_of_birth'=>$date_of_birth,'state'=>$state,'district'=>$district,'zipcode'=>$zipcode,'gst_number'=>$gst_nu,
									 'pan_nu'=>$pan_no,'aadhaar_nu'=>$aadhaar_no,'bank_name'=>$bank_name,
									 'bank_ac_no'=>$bank_ac_no,'bank_Ifsc'=>$bank_Ifsc,'bankBrName'=>$bankBrName,'btc_address'=>$btc_address,'nominee_name'=>$nominee_name,	
									 'nominee_address'=>$nominee_address,'nominee_relationship'=>$nominee_relationship,'modify_date'=>date('Y-M-d'),'modify_by'=>$this->logId);
					$resultUp=$this->Common_model->update_data('member_basic_manage',$mem_id,$updateDataArr);
					
					if($resultUp)
					{$data = array('icon' => 'success', 'text' =>'Thank You ! You have Successfully Update Data ');}
						else
						{$msgs = array('Some Error Occur Please Re-Create');$data = array('icon' => 'error', 'text' => $msgs);}
					
				
				
				
				}
			else
			{
				if($this->Common_model->save_data('member_basic_manage', $createDataArr))
				{$data = array('icon' => 'success', 'text' =>'Data Created Successfully');}
					else
					{$msgs = array('Some Error Occur Please Re-Create');$data = array('icon' => 'error', 'text' => $msgs);}
				 }
			}
			else
			{$msgs = array('Some Error Occur Please  Re-Create Basic Details');$data = array('icon' => 'error', 'text' => $msgs);}	 
		}
		else
		{
			 $msg =  array( 'gender'=> form_error('gender'),
							'date_of_birth'=> form_error('date_of_birth'),
							'state'=>form_error('state'),
							'district'=>form_error('district'),
							'zipcode'=>form_error('zipcode'),
							'gst_nu'=>form_error('gst_nu'),
							'aadhaar_no'=>form_error('aadhaar_no'),
							'password'=>form_error('password'),
							'cnfPassword'=>form_error('cnfPassword'),
							
							'bank_name'=>form_error('bank_name'),
							'bank_ac_no'=>form_error('bank_ac_no'),
							'bank_Ifsc'=>form_error('bank_Ifsc'),
							'bankBrName'=>form_error('bankBrName'),
							'btc_address'=>form_error('btc_address'),
							'nominee_name'=>form_error('nominee_name'),
							'nominee_address'=>form_error('nominee_address'),
							'nominee_relationship'=>form_error('nominee_relationship'));
			 $data = array('icon' => 'error', 'text' => $msg);
				}
		  echo json_encode($data);
		}	
		}		
	public function upload_image()
	{
	$getImgFl=$this->input->post('file');
	$id=$this->input->post('id');
	$getPreviousImage=$this->input->post('memImg');
	$image_filename=NULL;
	$config = array('upload_path' => "uploads/user/",'allowed_types' => "jpg|png|jpeg|JPEG|JPG",'overwrite' => FALSE,'encrypt_name' => TRUE,'max_size' =>"10120000" );
    $this->load->library('upload',$config);
	$this->upload->initialize($config);	
	if($this->upload->do_upload('file'))
    {		$image['image_upload']=array('upload_data' => $this->upload->data()); //Image Upload
			$image_filename=$image['image_upload']['upload_data']['file_name']; //Image Name
		}
		if($image_filename)
		{
	 		$config=NULL;
			$config['image_library'] = 'gd2';
			$config['source_image']  = 'uploads/user/'.$image_filename;
		/*	$config['new_image']  = 'uploads/user/thumb_image/'.$image_filename;*/
			$config['width']	 = '150';
			$config['height']	= '150';
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			$updateDataArr = array('my_img'=>'uploads/user/'.$image_filename);
			$whereCon = array('id'=>$id);
			$resltMsg='';
			if($getPreviousImage)
			{
				//$imgLocation='uploads/user/'.$getPreviousImage;
				unlink($getPreviousImage);
				//unlink('uploads/user/thumb_image/'.$getPreviousImage);
				$resltMsg='1===='.$image_filename;
				}	
				else
				{
					$resltMsg='2';
					}
			$result=$this->Common_model->update_data('members',$whereCon,$updateDataArr);
			if($result)
			{
				$resltMsg='1===='.$image_filename;
			}
				else
				{	
					$resltMsg='2';
					}
				echo $resltMsg;
		}
			else
			{
				echo 'Only .jpg,.png,.jpeg are accepted';
					}
		}
    public function view($id)
    {
        $id = base64_decode(urldecode($id));
	    $data=array('id'=>$id);
		$mem_id=array('mem_id'=>$id);
		$getMemberDetails=$this->Common_model->get_data('members',$data,'*');
		$spWhereCon=array('username'=>$getMemberDetails['position']);
		$getSponsorDetails=$this->Common_model->get_data('members',$spWhereCon,'name');
		
		$data['getMemberBasicDetails'] = $this->Common_model->get_data('member_basic_manage',$mem_id,'*');
		$data['getStateCity']= $this->Member_model->get_state_district($id);
		$data['getMemberDetails'] = $getMemberDetails;
		$data['getSponsorDetails'] = $getSponsorDetails;
		$data['title'] = 'View Member';
        $data['breadcrums'] = 'View Member';
        $data['layout'] = 'mlm_software/member/_view.php';
        $this->load->view('super_admin/base', $data);
    }	
	public function tree($id)
	{
		
		$id = base64_decode(urldecode($id));
		$data['id']=$id;
		$data['title']='Member Tree';
        $data['breadcrums']='Member Tree';
        $data['layout']='mlm_software/member/_tree.php';
		$firstLeg=$this->Plan_model->find_child_position('members','id',$id);
		$whereConSponsor=array('username'=>$firstLeg['sponsor']);
		$spId=$this->Common_model->get_data('members',$whereConSponsor,'id');
		$data['spId']=urlencode(base64_encode($spId['id']));
		$data['firstLeg']=$firstLeg;
		$this->load->view('super_admin/base', $data);
		}		
    public function passv()
	{
		$pID=$this->input->post('pID');
		sleep(2);
		$data=array('id'=>$pID);
		$getPinDeta=$this->Common_model->get_data('members',$data,'shw_pass');
		if($getPinDeta)
		{
			echo $getPinDeta['shw_pass'];
			}
			else
			{
				echo 'Try Again';
				}	
		}
	public function manage($actn)
	{
	 	if($actn=='without_topup')
		{
			$actn_url='super_admin/mlm_software/member/mi_list/without_topup';
			}
		else if($actn=='topup')
		{
			$actn_url='super_admin/mlm_software/member/mi_list/topup';
			}
		$data['actn_url']=$actn_url;
	    $data['title'] = 'Member List';
        $data['breadcrums'] = 'Member List';
        $data['layout'] = 'mlm_software/member/_manage.php';
        $this->load->view('super_admin/base', $data);	
		}
	public function mi_list($actn)
	{
        $post_data = $this->input->post();
        ####################### print_r($post_data);die;#######################
        $record = $this->Member_model->member_manage($post_data,$actn);
        ####################### echo $this->db->last_query();die;#######################
        $i = $post_data['start'] + 1;
        $return['data'] = array();
        $amt = 0;
        foreach ($record as $row) {		
if($row->status=='Active'){
	$status = '<div class="btn-group getNbtn"><button type="button" id="shwBtnVal-'.$row->id.'" class="btn btn-success dropdown-toggle btn-pad show" data-bs-toggle="dropdown" aria-expanded="true">'.$row->status.'<i class="mdi mdi-chevron-down"></i></button>
		<div class="dropdown-menu " style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
			<a class="dropdown-item getActn" data-id="Active-'.$row->id.'" href="javascript: void(0);">Active</a>
			<a class="dropdown-item getActn" data-id="Block-'.$row->id.'" href="javascript: void(0);">Block</a>
			<a class="dropdown-item getActn" data-id="Suspend-'.$row->id.'" href="javascript: void(0);">Suspend</a>
		</div>
	</div>';
}elseif($row->status=='Block'){
	$status = '<div class="btn-group getNbtn"><button type="button" id="shwBtnVal-'.$row->id.'" class="btn btn-danger dropdown-toggle btn-pad show" data-bs-toggle="dropdown" aria-expanded="true">'.$row->status.'<i class="mdi mdi-chevron-down"></i></button>
		<div class="dropdown-menu " style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
			<a class="dropdown-item getActn" data-id="Active-'.$row->id.'" href="javascript: void(0);">Active</a>
			<a class="dropdown-item getActn" data-id="Block-'.$row->id.'" href="javascript: void(0);">Block</a>
			<a class="dropdown-item getActn" data-id="Suspend-'.$row->id.'" href="javascript: void(0);">Suspend</a>
		</div>
	</div>';
}
elseif($row->status=='Suspend'){
	$status = '<div class="btn-group getNbtn"><button type="button" id="shwBtnVal-'.$row->id.'" class="btn btn-warning dropdown-toggle btn-pad show" data-bs-toggle="dropdown" aria-expanded="true">'.$row->status.'<i class="mdi mdi-chevron-down"></i></button>
		<div class="dropdown-menu " style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);" data-popper-placement="bottom-start">
			<a class="dropdown-item getActn" data-id="Active-'.$row->id.'" href="javascript: void(0);">Active</a>
			<a class="dropdown-item getActn" data-id="Block-'.$row->id.'" href="javascript: void(0);">Block</a>
			<a class="dropdown-item getActn" data-id="Suspend-'.$row->id.'" href="javascript: void(0);">Suspend</a>
		</div>
	</div>';
}
			if($row->sponsor=='0')
			{	
				$sponser='N/A';
				}
				else{$sponser=$row->sponsor;}	
				$getUid=urlencode(base64_encode($row->id));
				$getUsername=urlencode(base64_encode($row->username));	
			$actionBtn='<a href="'.$this->baseUrl.'super_admin/mlm_software/member/view/'.$getUid.'" class="btn btn-outline-primary btn-sm waves-effect btn-padd" title="View">
			 <i class="bx bxs-show"></i> </a>
			<a href="'.$this->baseUrl.'super_admin/mlm_software/member/tree/'.$getUid.'" class="btn btn-outline-warning btn-sm waves-effect righM btn-padd" title="Family Member">
			<span class="avatar-title bg-transparent text-reset"> <i class="mdi mdi-family-tree"></i> </span></a>
				<a href="'.$this->baseUrl.'super_admin/mlm_software/member/edit/'.$getUid.'" class="btn btn-outline-success btn-sm waves-effect btn-padd" title="Edit">
				<i class="mdi mdi-square-edit-outline me-1"></i> </a>
				<a href="'.$this->baseUrl.'super_admin/mlm_software/member/add_member/'.$getUsername.'" class="btn btn-outline-dark btn-sm waves-effect btn-padd" title="Share">
				<i class="bx bx-share-alt"></i> </a>';				
            if($row->my_img){$Img=base_url().$row->my_img;}else{$Img=base_url().'uploads/user/no_profile12.png';}		
			$name='<img src="'.$Img.'" alt="user" class="dsbordImg"><span class="usrNm">'.$row->name.'</span>';		
		   
		   
		    $return['data'][] = array(
                /*$i++,*/
				$row->username,
                $name,
				$row->email,
                $row->mobile,
				$sponser,
				$status,
				$actionBtn
            );
        }
        $return['recordsTotal'] = $this->Member_model->total_count_mi($actn);
        $return['recordsFiltered'] = $this->Member_model->total_filter_count_mi($actn);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
		}
	public function account_topup()
	{
		$data['title'] = 'Top Up Member';
        $data['breadcrums'] = 'Top Up Member';
		$data['pack_plan']=$this->Common_model->all_data('package','id,pack_price');
        $data['layout'] = 'mlm_software/member/activate_account.php';
        $this->load->view('super_admin/base', $data);
	 }
    public function is_exist()
    {
  	$post=$this->input->post();
/*	print_r($post);*/
		 if($post['strtDt']=='' && $post['endDt']==''){$data = array('data' => '2', 'text' =>"<i class='bx bx-calendar-event'></i> Please input start date and end date");}
	else if($post['strtDt']==''){$data = array('data' => '2', 'text' =>"<i class='bx bx-calendar-event'></i> Please input start date");	}
	else if($post['endDt']==''){$data = array('data' => '2', 'text' =>"<i class='bx bx-calendar-event'></i> Please input end date");}
	else if($post['strtDt'] > date('Y-m-d')){$data = array('data' => '2', 'text' =>"<i class='bx bx-calendar-event'></i> Please input start date below to current date");}
	else if($post['endDt'] > date('Y-m-d')){$data = array('data' => '2', 'text' =>"<i class='bx bx-calendar-event'></i> Please input end date below to current date");}
	else if($post['strtDt'] > $post['endDt']){$data = array('data' => '2', 'text' =>"<i class='bx bx-calendar-event'></i> Please input start date below to end date");}
	else{
			//$data = array('data' => '1', 'text' =>"<i class='bx bx-smile'></i> Thank you! We have got some data here");
			
			//$record = $this->Member_model->member_search($post);
			
			}
			
		print_r($record);
			
		//echo json_encode($data);		
			
	 }	
    public function is_data_exist()
    {	
  	$post=$this->input->post();	
	$isExit=NULL;$data=NULL;
	if($post['sponsor'])
	{	
		$isExit=$this->Member_model->getData('members','username',$post['sponsor']);
		if($isExit){$data=$isExit->name;}else{$data='err';}
		}
		echo $data;
	 }		 
    private function isExistMember($id)
    {$isExit=NULL;$data=NULL;if($id){$isExit=$this->Member_model->getData('members','username',$id);if($isExit){$data=$isExit->name;}else{$data='';}}return $data;}	
    public function isTopupMember()
    {
  	$post=$this->input->post();/*'pack_plan'*/
	$whereCon=array('username'=>$post['userIdA']);
	$isMember=$this->Common_model->get_data('members',$whereCon,'username,name,mobile,email,topup');
	if($post['amiActn']=='arvtpchk')
	{
		if($isMember)
		{ 
			if($isMember['topup']=='0.00')
			{	
				$data=$isMember;
				}
				else{ $data = array('data' =>'2', 'text' =>"<i class='bx bx-cog bx-spin'></i> Oops it seems this user id #".$post['userIdA'].' is topup already completed');}
			}
		else{ $data = array('data' =>'2', 'text' =>"<i class='bx bx-cog bx-spin'></i> Oops it seems there is no member available to this user id #".$post['userIdA']);}
		}	
		else if($post['amiActn']=='arvtpdne')
		{			
			if($isMember['topup']=='0.00')
			{	
			  $tnxNu=date('dHis');
			  $memWallTnxArr=array('tnx_id'=>$tnxNu,'user_id'=>$post['userIdA'],'debit_amt'=>$post['pack_plan'],'reason'=>'Amount debited after topup your account',
			  					   'created_by'=>'0','create_date'=>date('Y-m-d H:i:s'),'transfer_id'=>$this->logId);
			  $mlmIncArr=array('tnx_id'=>$tnxNu,'tnx_type'=>'0','credit_amt'=>$post['pack_plan'],'reason'=>'Amount credited after topup of account id #'.$post['userIdA'],
						  	   'generated_by'=>'0','created_date'=>date('Y-m-d H:i:s'),'created_by'=>$this->logId);
			  $memWhereCon=array('username'=>$post['userIdA']);
			  $memberActivate=array('topup'=>$post['pack_plan'],'topup_date'=>date('Y-m-d H:i:s'));			   			   
			  if($this->Common_model->save_data('wallet_transaction',$memWallTnxArr))				   
			  {
				 if($this->Common_model->save_data('mlm_income_manage',$mlmIncArr))				   
			  	{
					 if($this->Common_model->update_data('members',$memWhereCon,$memberActivate))
					 {
					    $this->income_model->get_upline_subscriber($post['userIdA'],$post['userIdA']);
					    $data=array('data' =>'1', 'text' =>"<i class='bx bx-smile'></i> Thank you! you have successfully topuped to this user id #".$post['userIdA']);	
						}
					  else{$data = array('data' =>'2', 'text' =>"<i class='bx bx-cog bx-spin'></i> oops it seems something get wrong while activating member account");}	
					}				   
				  else{$data = array('data' =>'2', 'text' =>"<i class='bx bx-cog bx-spin'></i> oops it seems something get wrong while creating company transaction");}		
				}				   
			   else{$data = array('data' =>'2', 'text' =>"<i class='bx bx-cog bx-spin'></i> oops it seems something get wrong while member transaction ");}		   
			 }
			else{ $data = array('data' =>'2', 'text' =>"<i class='bx bx-cog bx-spin'></i> Oops it seems this user id #".$post['userIdA'].' is topup already completed');}	
		  }
		  else{$data = array('data' =>'2', 'text' =>"<i class='bx bx-cog bx-spin'></i> oops it seems like you're going in the wrong direction ");}
				echo json_encode($data);	
			   /*  print_r($data);*/
	}
	
/*************************************************************/

	
	
	
	
			
}
