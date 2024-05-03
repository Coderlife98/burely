<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Partners extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'email'));
		$this->load->library(array('upload', 'image_lib','email'));
		$this->load->model('mlm_software/admin/partners_model', 'partners_model');
		$this->load->model('partner/sale_model', 'sale');
		$this->load->model('super_admin/common_model', 'Common_model');
		($this->session->userdata('user_id') == '') ? redirect(base_url(), 'refresh') : '';
		error_reporting(0);
		$this->baseUrl = base_url();
		$this->logId = $this->session->userdata('user_id');
		$this->lgCat = $this->session->userdata('user_cate');
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
		$data['title'] = 'Create New Partner';
		$data['breadcrums'] = 'Create New Partner';
		$data['memberTyp'] = 'Frenchise';
		$data['target'] = 'mlm_software/admin/partners/view_list/frenchise';
		$data['layout'] = 'mlm_software/admin/partners/partner_operation.php';
		$this->load->view('mlm_software/base', $data);
		}
	public function manage()
	{
		$post=$this->input->post();
		$miPrefix='Please provide partner ';
		$isCheckNullArr=array(
								"role."=>"roleAs",
								"title."=>"frTitle",
								"gender."=>"gender",
								"name."=>"mem_name",
								"date of birth."=>"dob",
								"mobile number."=>"mob_nu",
								"email id."=>"emailId",
								"password."=>"password",
	     						"confirm password."=>"confPass",
								"pan number."=>"pan_no",
								"aadhaar number."=>"aadhaar_no",
								"address."=>"address",
								"state."=>"statN",
								"district."=>"district",
								"zipcode."=>"zipcode",
								"bank name."=>"bName",
								"account number."=>"bankAc",
								"Bank IFSC."=>"bnkIFSC",
								"branch name."=>"brName",
								"nominee name."=>"nomiName",
								"nominee relationship."=>"nomineeRel",
								"nominee address."=>"NomAddr"
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
									$tnxDate=date('Y-m-d H:i:s');
									if($post['roleAs']=='1'){$securityAmt='25000';}else{$securityAmt='10000';}
									$createArr=array(
													 'user_typ'=>$post['roleAs'],'p_title'=>$post['frTitle'],'username'=>$post['mem_code'],'gender'=>$post['gender'],
													 'name'=>$post['mem_name'],'email'=>$post['emailId'],'topup'=>$securityAmt,'topup_date'=>$tnxDate,
													 'shop_name'=>$post['partnerName'],'mobile'=>$post['mob_nu'],'password'=>md5($post['password']),
													 'shw_pass'=>$post['password'],'create_date'=>$tnxDate,'created_type'=>'0','created_by'=>$this->logId
													 );
								$getProfile=$this->common->getRowData('partners','username',$post['mem_code']);
								if($getProfile)
								{
									$updateArr=array(
													 'p_title'=>$post['frTitle'],'gender'=>$post['gender'],'name'=>$post['mem_name'],'email'=>$post['emailId'],'modify_typ'=>'2',
													 'mobile'=>$post['mob_nu'],'shop_name'=>$post['partnerName'],
													 'password'=>md5($post['password']),'shw_pass'=>$post['confPass'],'modify_date'=>$tnxDate,'created_by'=>$this->logId
													 );
									$shopWhere=array('id'=>$getProfile->id);
									$shopUpdate=$this->common->update_data('partners',$shopWhere,$updateArr);
									if($shopUpdate)
									{
										$isCheckBasic=$this->common->getRowData('partners_basic_manage','mem_id',$getProfile->id);
										if($isCheckBasic)
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
													$createBasicArr=array('date_of_birth'=>$post['dob'],'mem_id'=>$getProfile->id,'created_by'=>$this->logId,
																	 'created_type'=>'0','created_date'=>date('Y-m-d H:i:s'));
													if($this->common->save_data('partners_basic_manage',$createBasicArr))
													{
														$msg=array('Thank you ! You have successfully complete personal details. ');
														$data=array('adClass'=>'tst_success','msg'=>$msg,'icon'=>'<i class="bx bx-check"></i>','actn'=>'2',
																	'shopId'=>$getProfile->id);
														}
														else
														{
															$msg=array('Oops it seems error.please refresh you page.');
															$data=array('adClass'=>'tst_warning','msg'=>$msg,'icon'=>'<i class="bx bx-cog bx-spin"></i>');
														}
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
										$email_res =confirmation_mail($post['mem_name'],config_item('company_name'),$post['mem_code'],$post['password']);
										 $to_email  = $post['emailId'];
										 $headers = "MIME-Version: 1.0" . "\r\n"; 
										 $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n"; 
										 $headers .= 'From: MSDR Global Marketing pvt. ltd. <infomsdr@gmail.com>';
										 mail($to_email,"Congratulation for register as partner",$email_res,$headers); 
										
										$partnerWallet=$this->common->save_data('partner_wallet',array('userid'=>$post['mem_code']));	
										
										$tnxNu=date('Hdis');
										$mlmCreateTnxArr=array(
																'tnx_id'=>$tnxNu,'tnx_type'=>'5','user_type'=>'1','credit_amt'=>$securityAmt,'reason'=>'Security Money',
															    'created_by'=>$this->logId,'generated_by'=>'1','created_date'=>$tnxDate
																);													
	                                    $partnerCreateTnx=array(
																 'tnx_id'=>$tnxNu,'tnx_typ'=>'1','user_id'=>$post['mem_code'],'debit_amt'=>$securityAmt,'reason'=>'Security Money',
																 'created_by'=>'0','create_date'=>$tnxDate);												
										$mlmInc=$this->common->save_data('company_income',$mlmCreateTnxArr);	
										if($mlmInc)
										{
											$partTnx=$this->common->save_data('partner_wallet_transaction',$partnerCreateTnx);
											if($partTnx)
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
													$msg=array('Oops it seems error while creating partner tnx.');
													$data=array('adClass'=>'tst_warning','msg'=>$msg,'icon'=>'<i class="bx bx-cog bx-spin"></i>');
												   }
													   
										  }
											else
												{
												   $msg=array('Oops it seems error. while creating company income.');
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
								
								
								if($post['docType']=='profileImg'){$imgPath='uploads/user/';$whereFld='id';$tblNm='partners';}
								else{$imgPath='uploads/partner_document/';$whereFld='mem_id';$tblNm='partners_basic_manage';}
								$moreWhereCon=array($whereFld=>$post['shoppId']);
								$getProfile=$this->partners_model->getPartnerImg($post['shoppId']);			
					    $prevImg=array($getProfile->pan_img=>"pancard",$getProfile->passbook_img=>"passbook",$getProfile->adhar_img=>"edtAadhar",$getProfile->my_img=>"profileImg");
							    $imgField=array('pan_img'=>"pancard",'passbook_img'=>"passbook",'adhar_img'=>"edtAadhar",'my_img'=>"profileImg");
								$imgSaveField=array_search($post['docType'],$imgField);
								$prevImgLoc=array_search($post['docType'],$prevImg);
								$default='uploads/partner_document/no_img.png';$profileImg='uploads/user/no_profile.png';
								if($prevImgLoc==$default){$resetImgLoc='';}elseif($prevImgLoc==$profileImg){$resetImgLoc='';}else{$resetImgLoc=$prevImgLoc;}		
								$getImgFl=$this->input->post('file');
								$image_filename=NULL;
				$config=array('upload_path'=>$imgPath,'allowed_types'=>"jpg|png|jpeg|JPEG|JPG",'overwrite'=>FALSE,'encrypt_name'=>TRUE,'max_size'=>"10120000" );
				$this->load->library('upload',$config);$this->upload->initialize($config);	
			if($this->upload->do_upload('file'))
			{$image['image_upload']=array('upload_data' => $this->upload->data());$image_filename=$image['image_upload']['upload_data']['file_name'];}
				if($image_filename)
				{
					$config=NULL;$config['image_library'] = 'gd2';$config['source_image']  = $imgPath.$image_filename;
					$config['width']='150';$config['height']='150';$this->image_lib->initialize($config);$this->image_lib->resize();
					$updateDataArr=array($imgSaveField=>$imgPath.$image_filename);/*,'modified_type'=>'1','modify_by'=>$this->logId,'modify_date'=>date('Y-m-d H:i:s')*/
					if($resetImgLoc){unlink($resetImgLoc);}	
					$result=$this->common->update_data($tblNm,$moreWhereCon,$updateDataArr);
					if($result)
					{	$msg=array('Thank you! You have successfully update document details');
						$data=array('adClass'=>'tst_success','msg'=>$msg,'img_loc'=>$imgPath.$image_filename,'actn'=>'4','icon'=>'<i class="bx bx-check"></i>');
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
	public function frenchise()
	{
		$data['title'] = 'Frenchise List';
		$data['breadcrums'] = 'Frenchise List';
		$data['memberTyp'] = 'Frenchise';
		$data['target'] = 'mlm_software/admin/partners/view_list/frenchise';
		$data['layout'] = 'mlm_software/admin/partners/_list.php';
		$this->load->view('mlm_software/base', $data);
	}

	public function shopee()
	{
		$data['title'] = 'Shopee List';
		$data['breadcrums'] = 'Shopee list';
		$data['memberTyp'] = 'Shopee';
		$data['target'] = 'mlm_software/admin/partners/view_list/shopee';
		$data['layout'] = 'mlm_software/admin/partners/_list.php';
		$this->load->view('mlm_software/base', $data);
	}


	public function add_member()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('roleAs', 'Role As', 'trim|required|xss_clean');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
			$this->form_validation->set_rules('mem_name', 'Member Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'trim|required|xss_clean');
			$this->form_validation->set_rules('mob_nu', 'Mobile Number', 'trim|required|xss_clean|max_length[12]');
			$this->form_validation->set_rules('emailId', 'Email Id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('aadhaar_no', 'Aadhaar Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pan_no', 'Pan Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
			$this->form_validation->set_rules('district', 'District', 'trim|required|xss_clean');
			$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('conf_password', 'Confirm Passowrd', 'trim|required|xss_clean|matches[password]');
			if ($this->form_validation->run() == TRUE) {
				$post = $this->input->post();
				$array = array(
					'user_typ'      => $post['roleAs'],
					'gender'        => $post['gender'],
					'name'          => $post['mem_name'],
					'email'         => $post['emailId'],
					'mobile'        => $post['mob_nu'],
					'username'      => $post['mem_code'],
					'password'      => md5($post['password']),
					'shw_pass'      => $post['password'],
					'address'       => $post['address'],
					'created_by' => $this->logId,
					'create_date'   => date('Y-m-d H:i:s')
				);
				$addNewMember = $this->common->save_data('partners', $array);
				if ($addNewMember) {
					$addrInsert = array(
						'mem_id' => $addNewMember,
						'state' => $post['state'],
						'district' => $post['district'],
						'zipcode' => $post['zipcode'],
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => $this->logId
					);
					if ($this->common->save_data('partners_basic_manage', $addrInsert)) 
					{
						$createWallet=array('userid'=>$post['mem_code']);	
						if ($this->common->save_data('partner_wallet', $createWallet)) 
						{$data = array('icon' => 'success', 'text' => 'Thank you! You have successfully create details');} 
						else{$msg = array('Oops it seems server taking more time please refresh');$data = array('icon' => 'error', 'text' => $msg);}
					} 
					else{$msg=array('Oops it seems server taking more time please refresh');$data=array('icon'=>'error','text'=>$msg);}
				  } 
				else{$msg=array('Some Error Occur Please Re-Create');$data=array('icon'=>'error','text'=>$msg);
			  }
			} else {
				$errorMsg = array(
					'roleAs'         => form_error('roleAs'),
					'gender'         => form_error('gender'),
					'mem_name'       => form_error('mem_name'),
					'date_of_birth'  => form_error('date_of_birth'),
					'mob_nu'         => form_error('mob_nu'),
					'emailId'        => form_error('emailId'),
					'aadhaar_no'     => form_error('aadhaar_no'),
					'pan_no'         => form_error('pan_no'),
					'address'        => form_error('address'),
					'state'          => form_error('state'),
					'district'       => form_error('district'),
					'zipcode'        => form_error('zipcode'),
					'password'       => form_error('password'),
					'conf_password'  => form_error('conf_password')
				);
				$data = array('icon' => 'error', 'text' => $errorMsg);
			}
			echo json_encode($data);
		}
	}
	public function view_list($actn = NULL)
	{
		//print_r($actn);
		$post_data = $this->input->post();
		####################### print_r($post_data);die;#######################
		$record = $this->partners_model->member_data($post_data, $actn);
		####################### echo $this->db->last_query();die;#######################
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		$amt = 0;
		foreach ($record as $row) {
			$viewUid = urlencode(base64_encode('view===' . $row->id . '===' . $actn));
			$editUid = urlencode(base64_encode('edit===' . $row->id . '===' . $actn));
			$orderUid = urlencode(base64_encode('order==='.$row->id.'==='.$actn.'==='.$row->user_typ));
			$admnLoggin= base_url('partner/login/isCheckLoggedInByAdmin/'.urlencode(base64_encode($row->username.'==='.$row->shw_pass.'==='.$row->user_typ)));
			$actionBtn = '
			<div style="text-align:center;">
			       <a href="'.$admnLoggin.'" class="btn btn-outline-dark btn-sm waves-effect btn-padd" target="_blank" title="partner login"><i class="bx bx-log-in-circle"></i> </a>
		   			   <a href="' . $this->baseUrl . 'mlm_software/admin/partners/operation/' . $orderUid . '" class="btn btn-outline-primary btn-sm waves-effect btn-padd" title="order Now">
			           <i class="mdi mdi-cart"></i> </a>

				       <a href="' . $this->baseUrl . 'mlm_software/admin/partners/operation/' . $editUid . '" class="btn btn-outline-success btn-sm waves-effect btn-padd" title="Edit">
				       <i class="mdi mdi-square-edit-outline me-1"></i> </a>

			
		   			   <a href="' . $this->baseUrl . 'mlm_software/admin/partners/operation/' . $viewUid . '" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View">
			           <i class="mdi mdi-eye"></i> </a>
		<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm waves-effect btn-padd getAction" data-id="del_mstr-mlm_software/admin/partners/operation-' . $row->id . '"  data-bs-toggle="modal" data-bs-target="#deleteModel" title="Delete">
				<i class="bx bxs-trash"></i> </a></div>';
			if (strlen($row->address) > 20) {
				$address = substr($row->address, 0, 15) . '...';
			} else {
				$address = $row->address;
			}
			if ($row->my_img) {
				$Img = base_url() . $row->my_img;
			} else {
				$Img = base_url() . 'uploads/user/no_profile12.png';
			}
			$name = '<img src="' . $Img . '" alt="user" class="dsbordImg"><span class="usrNm">' . $row->name . '</span>';
			
			
				if($row->status=='Active'){$stsOn='Active';$addCls='bg-olive';$btnIcon='fa-upload';}else{$stsOn='Block';$addCls='bg-orange';$btnIcon='fa-pause';}
				$statusBtn='<div class="actv-btn '.$addCls.' getStatusAction" onclick="pStatus('.$row->id.')" id="ms'.$row->id.'"> <i class="fa '.$btnIcon.'" aria-hidden="true"></i> '.$stsOn.'</div>';
			
			
			
			
			
			
			$return['data'][] = array(
				'<strong>' . $i++ . '.</strong>',
				$row->username,
				$row->shop_name,
				$name,
				$row->mobile,
				$row->email,
				$address,
				$statusBtn,
				$actionBtn
			);
		}
		$return['recordsTotal'] = $this->partners_model->total_count($actn);
		$return['recordsFiltered'] = $this->partners_model->total_filter_count($post_data, $actn);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}
	public function operation($id = NULL)
	{

		if ($id) {
			$actn = explode('===', base64_decode(urldecode($id)));

            $active_tab=NULL;
			$getDetails=NULL;
			$getDetails=$this->partners_model->user_data($actn[1]);
			if($actn[0]=='edit')
			{
				$title='Edit '.$actn[2];$breadcrums=$actn[2].' Edit';$memberTyp=$actn[2];$target=base_url().'mlm_software/admin/partners/'.$actn[2];
				$layout='mlm_software/admin/partners/partner_operation.php';
				} 
			else if($actn[0]=='view') 
			{
				$title='View '.$actn[2];$breadcrums=$actn[2].' View';$memberTyp=$actn[2];$target=base_url().'mlm_software/admin/partners/'.$actn[2];
				$data['orders_det'] = $this->Common_model->all_data_con('order_history', array('customer_id' => $actn[1]), '*');$layout='mlm_software/admin/partners/_view.php';
				}
				else if($actn[0]=='order')
				{
					$title='order '.$actn[2];$breadcrums=$actn[2].' order';$memberTyp=$actn[2];$target=base_url().'mlm_software/admin/partners/'.$actn[2];
					$data['cart']=$this->common->all_data_con('temp_product_details',array('member_id'=>$actn[1],'receiver_typ'=>$actn[3]), '*');
					$data['pcategory']=$this->common->all_data_con('category_manage',array('status'=>'1'), '*');
					$layout='mlm_software/admin/partners/order.php';
					}
					$data['active_tab'] = $active_tab;
					$data['getState'] = $this->common->getDataList('states_cities', 'parent_id', '729');
					$data['getCity'] = $this->common->getDataList('states_cities', 'parent_id', $getDetails->state);
					$data['title'] = ucwords($title);
					$data['edturl'] = urlencode(base64_encode('edit===' . $getDetails->id . '===' . $actn[2]));
					$data['breadcrums'] = ucwords($breadcrums);
					$data['target'] = $target;
					$data['layout'] = $layout;
					$data['getDetails'] = $getDetails;
					$this->load->view('mlm_software/base', $data);
		} 
		else {
		       $post = $this->input->post();
			if($post)
			{
				
				$getDetails = NULL;
				if ($post['id']) {
					$whereCon = array('id' => $post['id']);
					$getDetails = $this->common->get_data('partners', $whereCon, 'name,username');
				}
				if ($post['actnMng'] == 'deleteMstr') {
					$msg = '<i class="mdi mdi-alert-outline me-2"></i>  Are you sure want to delete ' . $getDetails['name'] . ' of member id #' . $getDetails['username'];
					$data = array('icon' => '2', 'text' => $msg);
				} else if ($post['actnMng'] == 'cnfDeleteOpr') {
					$whereCon = array('id' => $post['id'], 'table' => 'partners');
					$delDetails = $this->Common_model->del_data($whereCon);
					if ($delDetails) {
						$msg = '<i class="bx bx-smile"></i>  Thank You! you have successfully delete ' . $getDetails['name'] . ' of member id #' . $getDetails['username'];
						$data = array('icon' => '1', 'text' => $msg);
					} else {
						$msg = '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems error while deleting ' . $getDetails['name'] . ' of member id #' . $getDetails['username'];
						$data = array('icon' => '2', 'text' => $msg);
					}
				}
				echo json_encode($data);
			} else {
				echo '<div style="text-align:center;height: 100%;width: 100%;position:absolute;top:0px;right:0px;bottom:0px;left:0px;">
							  		<img src="' . $this->baseUrl . 'uploads/404.png" style="height:100%">
							  </div>';
			}
		}
	}

	function get_product_data()
	{
		$cat_id = $this->input->post('cat_id');
		$product = $this->Common_model->all_data_con('product_table', array('cat_id'=>$cat_id), '*');
		echo json_encode($product);
	}


	function get_product_details_data()
	{
		$prod_id = $this->input->post('prod_id');
		$product = $this->partners_model->get_product_details_data($prod_id);
		echo json_encode($product);
	}

	function test()
	{
		echo $a=113*(5/100);
	}
	function add_order_form_data()
	{
		if ($this->input->is_ajax_request()) {
			$val = $this->input->post();
			$prod = $this->Common_model->get_data('product_table', array('id' => $val['prod_id']), 'product_name');
			$this->form_validation->set_rules('pbquantity', 'Product Qty', 'required|greater_than[0]');
			$this->form_validation->set_rules('prod_id', 'Product', 'required');
			if ($this->form_validation->run() == true) 
			{
				$isWhereKart=array('member_id'=>$val['member_id'],'product_details_id'=>$val['prod_details_id'],'soldBy'=>'0');
				$isProductInKart=$this->Common_model->get_data('temp_product_details',$isWhereKart, '*');
				if($isProductInKart)
				{
					$pTqty=$val['pbquantity']+$isProductInKart['product_qty'];
					$tPbv=$pTqty*$val['productBv'];
					$totalAmt=$pTqty*$isProductInKart['product_selling_price'];
					$amtAftrDiscount=$totalAmt-($totalAmt*$isProductInKart['discount'])/100;
					$netAmt=$amtAftrDiscount+($amtAftrDiscount*$isProductInKart['productTax'])/100;
					$kartUpdateArr=array('productBV'=>$tPbv,'product_qty'=>$pTqty,'total_amount'=>$totalAmt,'net_amount'=>$netAmt,'productTax'=>$isProductInKart['productTax']);
					$whereUpdtArr=array('id'=>$isProductInKart['id']);
					if($this->Common_model->update_data('temp_product_details',$whereUpdtArr,$kartUpdateArr))
					{$data = array("text" => "You have successfully update product in kart", "icon" => "success");}
					else{$msg=array("You have successfully update product in kart");$data = array("text" => $msg, "icon" => "error");}
				 }
				else
				{

					$discount_amt=$val['total_amount']*($val['discount']/100);
					$aftrDisAmt=$val['total_amount']-$discount_amt;
					$netamount=$aftrDisAmt+($aftrDisAmt*$val['prodTax'])/100;
					$dat = array( 'member_id'             => $val['member_id'],
								  'product_details_id'    => $val['prod_details_id'],
								  'product_id'            => $val['prod_id'],
								  'product_name'          => $prod['product_name'],
								  'productBV'             => $val['productBv'],
								  'p_unit'                => $val['punit'],
								  'product_mrp'           => $val['pprice'],
								  'product_selling_price' => $val['sprice'],
								  'discount'              => $val['discount'],
								  'product_qty'           => $val['pbquantity'],
								  'productTax'           => $val['prodTax'],
								  'total_amount'          => $val['total_amount'],
								  'receiver_typ'          => $val['recevrTyp'],
								  'net_amount'            => $netamount,
								);
						$this->Common_model->save_data('temp_product_details', $dat);						
						$data = array("text" => "You have successfully add product to kart", "icon" => "success");
				}
			} 
			else {$msg=array('pbquantity'=>form_error('pbquantity'),'prod_id'=>form_error('prod_id'),);$data = array("text" => $msg, "icon" => "error");}
		} 
		else{$msg = array("something went Wrong");$data = array("text" => $msg, "icon" => "error");}
		echo json_encode($data);
	}
	function delete_cart_item()
	{
		if ($this->input->is_ajax_request()) {
			$cart_id = $this->input->post('id');
			$del_data = array(
				'id'   => $cart_id,
				'table'   => 'temp_product_details',
			);
			$this->Common_model->del_data($del_data);
			$data = array('text' => "You have successfully remove product from kart", "icon" => "success");
		} else {
			$msg = array("something went wrong");
			$data = array('text' => $msg, "icon" => "success");
		}
		echo json_encode($data);
	}
	function payment()
	{
		$member_id = $this->input->post('id');
		$pyblAmt = $this->input->post('pyblAmt');
		$recevrTyp = $this->input->post('recevrTyp');
		$payment = 1;
		$getAdminCharge=$this->Common_model->getRowData('club_income','id','1');
		$getMemDetails=$this->Common_model->getRowData('partners','id',$member_id);
		if ($payment == 1 && !empty($member_id)) 
		{
			$kartWhereCon=array('member_id'=>$member_id,'soldBy'=>'0','receiver_typ'=>$recevrTyp);		
			$cart=$this->Common_model->all_data_con('temp_product_details',$kartWhereCon ,"*");
			$da=date('Y-m-d');
			$order=array(
						 'customer_id'=>$member_id,
						 'soldBy'=>'0','paid_amt'=>$pyblAmt,
						 'seller_id'=>$this->logId,
						 'order_date'=>date('Y-m-d'),
						 'delevery_date'=>date('Y-m-d',strtotime($da .'+10days')),
						 'IsOrdered'=>'yes'
						 );

			if (!empty($cart))
			{
				$last_order_id =$this->Common_model->save_data('order_history', $order);
				//$last_order_id = $this->Common_model->get_last('order_history', 'id');									
				$payble_amount = 0;$earnedBv=0;
				foreach ($cart as $item) {
					$data = array(
									'order_id'              => $last_order_id,
									'invoice_id'            => 'MsdrOrd'.$last_order_id,
									'product_name'          => $item['product_name'],
									'member_id'             => $item['member_id'],
									'product_details_id'    => $item['product_details_id'],
									'product_id'            => $item['product_id'],
									'product_selling_price' => $item['product_selling_price'],
									'product_mrp'           => $item['product_mrp'],
									'product_qty'           => $item['product_qty'],
									'productBv'             => $item['productBV'],
									'discount'              => $item['discount'],
									'total_amount'          => $item['total_amount'],
									'net_amount'            => $item['net_amount'],
									'product_details_id'    => $item['product_details_id'],
									'IsDeleted'             => 'yes'
								);
					$product = $this->Common_model->get_data('product_details', array('prod_id' => $item['product_id']), 'quantity');
					$left_stock = $product['quantity'] - $item['product_qty'];
					$this->Common_model->update_data('product_details', array('prod_id' => $item['product_id']), array('quantity' => $left_stock));
					$payble_amount += $item['net_amount'];
					$earnedBv+=$item['productBV']*$item['product_qty'];
					if($this->Common_model->save_data('order_details',$data))
					{
					    $stockWhere=array('partner_id'=>$member_id,'product_details_id'=>$item['product_details_id']);		
						$getStock=$this->Common_model->get_data('partner_stock',$stockWhere ,"*");
						if($getStock)
						{
							$stockQty=$item['product_qty']+$getStock['product_qty'];
							$updateStockArr=array(
												   'product_price'=>$item['product_selling_price'],
												   'product_mrp'=>$item['product_mrp'],
												   'product_qty'=>$stockQty,
												   'productBV'=>$item['productBV'],
												   'productTax'=>$item['productTax'],
												   'lastInStock'=>$item['product_qty'],
												   'last_purchase_id'=>$last_order_id,
												   'stockInDate'=>date('Y-m-d')
												   );
								$this->Common_model->update_data('partner_stock',$stockWhere,$updateStockArr);
							}
							else
							{
								
								$createStockArr=array(
													   'partner_id'=>$item['member_id'],
													   'product_details_id'=>$item['product_details_id'],
													   'product_price'=>$item['product_selling_price'],
													   'product_mrp'=>$item['product_mrp'],
													   'product_qty'=>$item['product_qty'],
													   'productBV'=>$item['productBV'],
													   'productTax'=>$item['productTax'],
													   'lastInStock'=>$item['product_qty'],
													   'last_purchase_id'=>$last_order_id,
													   'stockInDate'=>date('Y-m-d'),
													   'created_type'=>'0',
													   'created_by'=>$this->logId,
													   'create_date'=>date('Y-m-d'),
													   );
								$getPstockId=$this->Common_model->save_data('partner_stock', $createStockArr);
								
								}						   
						}		
				}
				$tnxNu=date('dHis');
				$updtOrdHistoryArr = array('invoice_id'=>'MsdrOrd'.$last_order_id,'grand_total'=>$payble_amount,'earnedBv'=>$earnedBv,
										   'tax'=>$getAdminCharge->tax,'shipping_charge' =>$getAdminCharge->shipping_charges,'admnTnx'=>$tnxNu,'order_status'=>'3');
				$this->Common_model->update_data('order_history', array('id'=>$last_order_id), $updtOrdHistoryArr);							
				$walletTnxArr = array('tnx_id'=>$tnxNu,'user_id'=>$getMemDetails->username,'debit_amt'=>$payble_amount,'reason'=>'Amount debited after product purchase',
									  'created_by'=>'0','create_date'=>date('Y-m-d H:i:s'));							
				$createWallTnx=$this->common->save_data('partner_wallet_transaction',$walletTnxArr);							
				$mlmIncArr=array('tnx_id'=>$tnxNu,'tnx_type'=>'1','credit_amt'=>$payble_amount,'reason'=>'Amount credited after purchase of account id #'.$getMemDetails->username,
						  	     'generated_by'=>'0','created_date'=>date('Y-m-d H:i:s'),'created_by'=>$this->logId);							
				$createCompanyInc=$this->common->save_data('company_income',$mlmIncArr);													
				
				$this->Common_model->del_data_multi_con('temp_product_details', $kartWhereCon);
				$data = array('text' => 'Thank you you have successfully proceed order', 'icon' => 'success');
			} 
		   else {$msg = array('Your cart is empty! Please add product in kart');$data = array('text' => $msg, 'icon' => 'error');}
		} 
		else{$msg=array('Oops it seems something went wrong while ordering');$data = array('text' => $msg, 'icon' => 'error');}

		echo json_encode($data);
	}
	function order_list()
	{
		$order_id = $this->input->post('order_id');

		$data['order_items'] = $this->Common_model->all_data_con('order_details', array('order_id' => $order_id), '*');
		$this->load->view('mlm_software/admin/partners/view_order_list', $data);
	}
	function cancel_order()
	{
		
		if ($this->input->is_ajax_request()) {
			$order_id = $this->input->post('order_id');
			$cancel_order = $this->Common_model->all_data_con('order_details', array('order_id' => $order_id), 'product_id,product_qty');
			$order = $this->Common_model->get_data('order_history', array('id' => $order_id), 'paid_amt');

			$vals=array(
				'order_id'    =>$order_id,
				'cancel_date' =>date('Y-m-d H:i:s'),
				'paid_amount' =>$order['paid_amt'],
			);
			
			$this->Common_model->save_data('order_cancel',$vals);			
		
			foreach ($cancel_order as $i=>$co) {
				$prod_details = $this->Common_model->get_data('product_details', array('prod_id' => $co['product_id']), 'quantity');
				$net_quantity = $co['product_qty'] + $prod_details['quantity'];				
				$this->Common_model->update_data('product_details', array('prod_id' => $co['product_id']), array('quantity' => $net_quantity));
			}
			$this->Common_model->update_data('order_history',array('id' => $order_id), array('order_status' => 0));
			

			$data = array('text' => "order Cancel Successfully", "icon" => "success");
		} else {
			$msg = array('something went wrong');
			$data = array('text' => $msg, "icon" => 'error');
		}
		echo json_encode($data);
	}
	// order end
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
			$this->form_validation->set_rules('mem_name', 'Member Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('date_of_birth', 'Date of birth', 'trim|required|xss_clean');
			$this->form_validation->set_rules('mem_mobile', 'Mobile Number', 'trim|required|xss_clean|max_length[12]');
			$this->form_validation->set_rules('aadhaar_no', 'Aadhaar Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pan_no', 'Pan Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
			$this->form_validation->set_rules('district', 'District', 'trim|required|xss_clean');
			$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('cnfPassword', 'Confirm Passowrd', 'trim|required|xss_clean|matches[password]');


			$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('bank_ac_no', 'Bank Account Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('bank_Ifsc', 'IFSC Code', 'trim|required|xss_clean');
			$this->form_validation->set_rules('bankBrName', 'Bank Branch Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('btc_address', 'BTC Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nominee_name', 'nominee Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nominee_address', 'Nominee Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nominee_relationship', 'Nominee Relationship', 'trim|required|xss_clean');
			if ($this->form_validation->run() == TRUE) {
				$post = $this->input->post();
				$whereCon = array('id' => $post['id']);
				$array = array(
					'gender'        => $post['gender'],
					'name'          => $post['mem_name'],
					'mobile'        => $post['mem_mobile'],
					'password'      => md5($post['password']),
					'shw_pass'      => $post['password'],
					'address'       => $post['address'],
					'modified_by' => $this->logId, 'modified_by' => '0',
					'modify_date'   => date('Y-m-d H:i:s')
				);
				$updateArr = array(
					'state' => $post['state'], 'district' => $post['district'], 'zipcode' => $post['zipcode'], 'date_of_birth' => $post['date_of_birth'],
					'bank_name' => $post['bank_name'], 'bank_ac_no' => $post['bank_ac_no'], 'bank_Ifsc' => $post['bank_Ifsc'],
					'bankBrName' => $post['bankBrName'], 'btc_address' => $post['btc_address'], 'nominee_name' => $post['nominee_name'],
					'nominee_address' => $post['nominee_address'], ' 	nominee_relationship' => $post['nominee_relationship'],
					'modify_date' => date('Y-m-d H:i:s'), 'modified_type' => '0',
					'modify_by' => $this->logId
				);
				//	print_r($array);		
				$addNewMember = $this->common->update_data('partners', $whereCon, $array);
				if ($addNewMember) {
					$whereCon = array('mem_id' => $post['id']);
					if ($this->common->update_data('partners_basic_manage', $whereCon, $updateArr)) {
						$data = array('icon' => 'success', 'text' => 'Thank you! You have successfully updated details');
					} else {
						$msg = array('Oops it seems server taking more time please refresh');
						$data = array('icon' => 'error', 'text' => $msg);
					}
				} else {
					$msg = array('Some Error Occur Please Re-Update');
					$data = array('icon' => 'error', 'text' => $msg);
				}
			} else {
				$errorMsg = array(
					'gender'         => form_error('gender'),
					'mem_name'       => form_error('mem_name'),
					'date_of_birth'  => form_error('date_of_birth'),
					'mob_nu'         => form_error('mem_mobile'),
					'aadhaar_no'     => form_error('aadhaar_no'),
					'pan_no'         => form_error('pan_no'),
					'address'        => form_error('address'),
					'state'          => form_error('state'),
					'district'       => form_error('district'),
					'zipcode'        => form_error('zipcode'),
					'password'       => form_error('password'),
					'cnfPassword'    => form_error('cnfPassword'),

					'bank_name'           => form_error('bank_name'),
					'bank_ac_no'          => form_error('bank_ac_no'),
					'bank_Ifsc'           => form_error('bank_Ifsc'),
					'bankBrName'          => form_error('bankBrName'),
					'btc_address'         => form_error('btc_address'),
					'nominee_name'        => form_error('nominee_name'),
					'nominee_address'     => form_error('nominee_address'),
					'nominee_relationship' => form_error('nominee_relationship')
				);
				$data = array('icon' => 'error', 'text' => $errorMsg);
			}
			echo json_encode($data);
		}
	}
	public function upload_image()
	{
		$getImgFl = $this->input->post('file');
		$id = $this->input->post('id');
		$getPreviousImage = $this->input->post('memImg');
		$image_filename = NULL;
		$config = array('upload_path' => "uploads/user/", 'allowed_types' => "jpg|png|jpeg|JPEG|JPG", 'overwrite' => FALSE, 'encrypt_name' => TRUE, 'max_size' => "10120000");
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ($this->upload->do_upload('file')) {
			$image['image_upload'] = array('upload_data' => $this->upload->data());
			$image_filename = $image['image_upload']['upload_data']['file_name'];
		}
		if ($image_filename) {
			$config = NULL;
			$config['image_library'] = 'gd2';
			$config['source_image']  = 'uploads/user/' . $image_filename;
			$config['width']	 = '150';
			$config['height']	= '150';
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$updateDataArr = array('my_img' => 'uploads/user/' . $image_filename);
			$whereCon = array('id' => $id);
			$resltMsg = '';
			if ($getPreviousImage) {
				unlink($getPreviousImage);
				$resltMsg = '1====' . $image_filename;
			} else {
				$resltMsg = '2';
			}
			$result = $this->common->update_data('partners', $whereCon, $updateDataArr);
			if ($result) {
				$resltMsg = '1====' . $image_filename;
			} else {
				$resltMsg = '2';
			}
			echo $resltMsg;
		} else {
			echo 'Only .jpg,.png,.jpeg are accepted';
		}
	}
	
   public function sale($id)
   {
		$post_data = $this->input->post();
		$tblName='order_history';
		//if($this->u_cate=='1'){$tblName='order_history';}else{$tblName='sale_history';}
		$record = $this->sale->sale_data($post_data,$id,$tblName);
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		foreach ($record as $row) {
			if ($row->order_status=='0'){$stsTex='Cancelled';$activeCls='ordCancel';} 
			else if ($row->order_status=='1'){$stsTex='Placed';$activeCls='ordPlced';}
			else if ($row->order_status=='2'){$stsTex ='Shipped';$activeCls='ordShipped';}
			else if ($row->order_status=='3'){$stsTex='Delevered';$activeCls='ordDelevered';}
			else {$stsTex='Not Yet';$activeCls='setBtnGr dctive';}
			$getUid = base_url('partner/sale/detials/'.urlencode(base64_encode($row->invoice_id)));
			$actionBtn = '<div style="text-align:center;">
								<a href="'.$getUid.'" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
						  </div>';
			$grandTamt=$row->grand_total+$row->shipping_charge+($row->grand_total*$row->tax)/100;
			if($row->delevery_date){$delivery=date('d-m-Y',strtotime($row->delevery_date));}else{ $delivery='N/A';}
			$return['data'][] = array(
										'<strong>' . $i++ . '.</strong>',
										$row->invoice_id,
										'<i class="bx bx-rupee inrP"></i> '.number_format($grandTamt,2),
										'<i class="bx bx-rupee inrP"></i> '.$row->paid_amt,
										date('d-m-Y',strtotime($row->order_date)),
										$delivery,
										'<div class="' . $activeCls . ' getAction"><span>' . $stsTex . '</span></div>',
										$actionBtn
										);
		}
		$return['recordsTotal'] = $this->sale->total_count($id,$tblName);
		$return['recordsFiltered'] = $this->sale->filter_count($post_data,$id,$tblName);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	} 
	
	public function isCheck()
	{
		sleep(2);
		$post=$this->input->post('str');
		$getMemDetails=$this->Common_model->getRowData('partners','id',$post);
		if($getMemDetails)
		{
			if($getMemDetails->status=='Active')
			{
					$newSts='Block';  
					$stsMsg=array('adCls'=>'tst_success','text'=>'You have successfully blocked '.$getMemDetails->name,
								'btnCls'=>'bg-orange','btnText'=>'<i class="fa fa-pause" aria-hidden="true"></i> Block');
					}
					else
					{
						$newSts='Active';
						$stsMsg=array('adCls'=>'tst_success','text'=>'You have successfully Activate '.$getMemDetails->name,
								    'btnCls'=>'bg-olive','btnText'=>'<i class="fa fa-upload" aria-hidden="true"></i> Active');
						
						}
			$setStatusArr=array('status'=>$newSts);$whereCon=array('id'=>$post);
			$result = $this->common->update_data('partners',$whereCon,$setStatusArr);
			if($result)
			{
				$data=$stsMsg;
				}
				else{$data=array('adCls'=>'tst_danger','text'=>'Oops something went wrong while update status.');}
			}
			else{$data=array('adCls'=>'tst_danger','text'=>'Oops you are going to be wrong way.');}
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
		
	public function passv()
	{
		$pID=$this->input->post('pID');
	    sleep(2);
		$data=array('id'=>$pID);
		$getPinDeta=$this->common->get_data('partners',$data,'shw_pass');
		if($getPinDeta){echo $getPinDeta['shw_pass'];}
		else{echo 'Try Again';}	
		}
					
			
	
}
