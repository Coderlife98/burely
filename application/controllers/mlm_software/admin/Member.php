<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'email'));
		$this->load->library(array('upload', 'image_lib', 'email'));
		$this->load->model('mlm_software/admin/member_model', 'member');
		$this->load->model('Plan_model', 'Plan_model');
		$this->load->model('member/income_model', 'income');
		($this->session->userdata('user_id') == '') ? redirect(base_url(), 'refresh') : '';
		error_reporting(0);
		$this->baseUrl = base_url();
		$this->logId = $this->session->userdata('user_id');
		$this->lgCat = $this->session->userdata('user_cate');
	}
	public function lists($action = NULL)
	{
		if ($action) {
			$title = $action . ' Members List';
		} else {
			$title = 'Members List';
		}
		$data['action'] = $action;
		$data['title'] = $title;
		$data['breadcrums'] = $title;
		$data['layout'] = 'mlm_software/admin/members/_list.php';
		$data['target'] = 'mlm_software/admin/member/view_list/' . $action;
		$this->load->view('mlm_software/base', $data);
	}
	public function view_list($action = NULL)
	{
		$post_data = $this->input->post();
		####################### print_r($post_data);die;#######################
		$record = $this->member->member_data($post_data, $action);
		####################### echo $this->db->last_query();die;#######################
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		$amt = 0;
		foreach ($record as $row) {
			$viewUid = base_url('mlm_software/admin/member/operation/' . urlencode(base64_encode('view===' . $row->id)));
			$editUid =  base_url('mlm_software/admin/member/operation/' . urlencode(base64_encode('edit===' . $row->id)));
			$veiwTree =  base_url('mlm_software/admin/member/operation/' . urlencode(base64_encode('tree===' . $row->id)));

			$admnLoggin = base_url('member/login/isCheckLoggedInByAdmin/' . urlencode(base64_encode($row->username . '===' . $row->shw_pass)));


			$actionBtn = '
			<div style="text-align:center;width:170px;">
					  <a href="' . $admnLoggin . '" class="btn btn-outline-dark btn-sm waves-effect btn-padd" target="_blank" title="member login"><i class="bx bx-log-in-circle"></i> </a>
		   			   <a href="' . $veiwTree . '" class="btn btn-outline-primary btn-sm waves-effect btn-padd" title="order Now"><i class="bx bx-sitemap"></i> </a>
				       <a href="' . $editUid . '" class="btn btn-outline-success btn-sm waves-effect btn-padd" title="Edit"><i class="mdi mdi-square-edit-outline me-1"></i></a>
		   			   <a href="' . $viewUid . '" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
		<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm waves-effect btn-padd getAction" data-id="del_member-mlm_software/admin/member/operation-' . $row->id . '"  data-bs-toggle="modal" data-bs-target="#deleteModel" title="Delete">
				<i class="bx bxs-trash"></i> </a></div>';
			if (strlen($row->address) > 20) {
				$address = substr($row->address, 0, 15) . '...';
			} else {
				$address = $row->address;
			}
			if ($row->my_img) {
				$Img = base_url($row->my_img);
			} else {
				$Img = base_url('uploads/member/no_profile12.png');
			}
			$name = '<img src="' . $Img . '" alt="user" class="dsbordImg"><span class="usrNm">' . $row->name . '</span>';

			if ($row->status == 'Active') {
				$stsOn = 'Active';
				$addCls = 'bg-olive';
				$btnIcon = 'fa-upload';
			} else {
				$stsOn = 'Block';
				$addCls = 'bg-orange';
				$btnIcon = 'fa-pause';
			}
			$statusBtn = '<div class="actv-btn ' . $addCls . ' getStatusAction" onclick="pStatus(' . $row->id . ')" id="ms' . $row->id . '"><i class="fa ' . $btnIcon . '" aria-hidden="true"></i> ' . $stsOn . '</div>';
			if ($row->sponsor == '0') {
				$spId = 'N/A';
			} else {
				$spId = $row->sponsor;
			}


			$return['data'][] = array(
				'<strong>' . $i++ . '.</strong>',
				$row->username,
				$name,
				$row->mobile,
				$spId,
				$address,
				$statusBtn,
				$actionBtn
			);
		}
		$return['recordsTotal'] = $this->member->total_count($action);
		if ($action) {
			$return['recordsFiltered'] = $this->member->getCnt_filter($action);
		} else {
			$return['recordsFiltered'] = $this->member->total_filter_count($post_data, $action);
		}
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}
	public function isCheck()
	{
		sleep(2);
		$post = $this->input->post('str');
		$getMemDetails = $this->common->getRowData('msdr_members', 'id', $post);
		if ($getMemDetails) {
			if ($getMemDetails->status == 'Active') {
				$newSts = 'Block';
				$stsMsg = array(
					'adCls' => 'tst_success', 'text' => 'You have successfully blocked ' . $getMemDetails->name,
					'btnCls' => 'bg-orange', 'btnText' => '<i class="fa fa-pause" aria-hidden="true"></i> Block'
				);
			} else {
				$newSts = 'Active';
				$stsMsg = array(
					'adCls' => 'tst_success', 'text' => 'You have successfully Activate ' . $getMemDetails->name,
					'btnCls' => 'bg-olive', 'btnText' => '<i class="fa fa-upload" aria-hidden="true"></i> Active'
				);
			}
			$setStatusArr = array('status' => $newSts);
			$whereCon = array('id' => $post);
			$result = $this->common->update_data('msdr_members', $whereCon, $setStatusArr);
			if ($result) {
				$data = $stsMsg;
			} else {
				$data = array('adCls' => 'tst_danger', 'text' => 'Oops something went wrong while update status.');
			}
		} else {
			$data = array('adCls' => 'tst_danger', 'text' => 'Oops you are going to be wrong way.');
		}
		echo json_encode($data);
	}
	public function operation($id = NULL)
	{
		if ($id) {
			$getId = explode("===", base64_decode(urldecode($id)));
			$data['fmPack'] = $this->common->getRowData('package', 'id', '1');
			$data['package'] = $this->common->all_data('package', '*');
			if ($getId[0] == 'view') {
				$getPro = NULL;
				$getPro = $this->member->profile_details($getId[1]);
				$data['getPro'] = $getPro;
				$data['title'] = 'View Members';
				$data['breadcrums'] = 'View Members';
				$data['layout'] = 'mlm_software/admin/members/_view.php';
				$this->load->view('mlm_software/base', $data);
			} elseif ($getId[0] == 'edit') {
				$getData = $this->member->profile_details($getId[1]);
				$getState = $this->common->getDataList('states_cities', 'parent_id', '729');
				if ($getData->state != '0') {
					$data['getCity'] = $this->common->getDataList('states_cities', 'parent_id', $getData->state);
				}
				$data['getData'] = $getData;
				$data['getState'] = $getState;
				$data['username'] = $getData->username;
				$data['title'] = 'Edit Members';
				$data['breadcrums'] = 'Edit Members';
				$data['layout'] = 'mlm_software/admin/members/member_operation.php';
				$this->load->view('mlm_software/base', $data);
			} else if ($getId[0] == 'tree') {
				$data['title'] = 'Subscriber Tree';
				$data['breadcrums'] = 'Subscriber Tree';
				$getMydownLine = NULL;
				$getMember = $this->common->getRowData('msdr_members', 'id', $getId[1]);
				$whereCon = array('sponsor' => $getMember->username);
				$getMydownLine = $this->common->all_data_con('msdr_members', $whereCon, '*');
				$data['getMember'] = $getMember;
				$data['getMydownLine'] = $getMydownLine;
				$data['layout'] = 'mlm_software/admin/members/downline.php';
				$this->load->view('mlm_software/base', $data);
			}
		} else {
			$post = $this->input->post();
			if ($post['actnMng'] == 'del_member') {
				$getMember = $this->common->getRowData('msdr_members', 'id', $post['id']);
				$data = array(
					'adClass' => 'tst_success', 'text' => 'Are you sure want to delete member #' . $getMember->name,
					'title' => '<i class="bx bx-trash"></i> Delete Member', 'action' => 'confirm_delete-mlm_software/admin/member/operation-' . $post['id']
				);
			} else if ($post['actnMng'] == 'confirm_delete') {
				$getMember = $this->common->getRowData('msdr_members', 'id', $post['id']);
				$delDetails = $this->member->delete_row($post['id']);
				if ($delDetails) {
					$data = array('adClass' => 'tst_success', 'text' => 'Thank You! you have successfully delete #' . $getMember->name);
				} else {
					$data = array('adClass' => 'tst_danger', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems error while deleting');
				}
			} else {
				$data = array('adClass' => 'tst_warning', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems you have on the wrong way');
			}
			echo json_encode($data);
		}
	}
	public function manage()
	{
		$post = $this->input->post();
		$sponsor = config_item('ID_EXT'). substr($post['sponsorId'], 3);
		$miPrefix = 'Please provide member ';
		$isCheckNullArr = array(
			"title." => "salutation", "sponsor id." => "sponsorId", "gender." => "gender", "name." => "mem_name", "date of birth." => "dob", "mobile number." => "mob_nu",
			 "password." => "password", "confirm password." => "confPass", "pan number." => "pan_no", "aadhaar number." => "aadhaar_no",
			"address." => "address", "package." => "package",
			"state." => "statN", "district." => "district", "zipcode." => "zipcode", "bank name." => "bName", "account number." => "bankAc", "Bank IFSC." => "bnkIFSC",
			"branch name." => "brName", "nominee name." => "nomiName", "nominee relationship." => "nomineeRel", "nominee address." => "NomAddr"
		);
		$hasErrorMsg = array();
		// print_r($post);
		if ($post) {
			foreach ($post as $key => $list) {
				if (!$list) {
					if($key!='emailId')
					{
						$matchPost = array_search($key, $isCheckNullArr, true);
						array_push($hasErrorMsg, $miPrefix . $matchPost);
					}
				}
			}
		}

		if ($hasErrorMsg) {
			$data = array('adClass' => 'tst_danger', 'msg' => $hasErrorMsg, 'icon' => '<i class="bx bx-cog bx-spin"></i>');
		} else {

			if ($post['miAction'] == '1') {

				$isExistData = $this->common->getRowData('msdr_members', 'username', $post['sponsorId']);
				$sponsor_count = $this->db->select('*')->where('sponsor', $sponsor)->get('msdr_members')->num_rows();
				if (!$isExistData) {
					$msg = array(" Oops it seems this sponsor doesn't exist.");
					$data = array('adClass' => 'tst_warning', 'msg' => $msg, 'icon' => '<i class="bx bx-cog bx-spin"></i>');
				}  else if ($post['password'] != $post['confPass']) {
					$msg = array(" Oops it seems password doesn't match confirm password.");
					$data = array('adClass' => 'tst_warning', 'msg' => $msg, 'icon' => '<i class="bx bx-cog bx-spin"></i>');
				} else if ($sponsor_count >= 5) {
					$msg = array(" Oops it seems already Sponsor 5 Members please Enter other sponsor Id.");
					$data = array('adClass' => 'tst_warning', 'msg' => $msg, 'icon' => '<i class="bx bx-cog bx-spin"></i>');
				} else {

					$sponsor = config_item('ID_EXT'). substr($post['sponsorId'], 3);

					$createArr = array(
						'user_typ'      => '1',
						'sponsor'       => $sponsor,
						'position'       => $sponsor,
						'username'      => $post['mem_code'],
						'gender'        => $post['gender'],
						'name'          => $post['mem_name'],
						'memTitle'      => $post['salutation'],
						'topup_request' => $post['package'],
						'email'         => $post['emailId'],
						'mobile'        => $post['mob_nu'],
						'password'      => md5($post['password']),
						'shw_pass'      => $post['confPass'],
						'create_date'   => date('Y-m-d H:i:s'),
						'created_type'  => '0',
						'created_by'    => $this->logId
					);

					$createWallet = array(
						'userid' => $post['mem_code']
					);

					$getProfile = $this->common->getRowData('msdr_members', 'username', $post['mem_code']);

					if ($getProfile) {
						if ($getProfile->topup == '0.00') {
							$package = $post['package'];
						} else {
							$package = $getProfile->topup_request;
						}

						$updateArr = array(
							'gender'        => $post['gender'],
							'name'          => $post['mem_name'],
							'email'         => $post['emailId'],
							'memTitle'      => $post['salutation'],
							'password'      => md5($post['password']),
							'shw_pass'      => $post['confPass'],
							'topup_request' => $package,
							'modify_date'   => date('Y-m-d H:i:s'),
							'modify_typ'    => '2',
							'created_by'    => $this->logId
						);

						$memberWhere = array('id' => $getProfile->id);

						$shopUpdate = $this->common->update_data('msdr_members', $memberWhere, $updateArr);

						if ($shopUpdate) {
							$memberWhere = array('mem_id' => $getProfile->id);
							$memberArr = array('date_of_birth' => $post['dob']);
							$shopUpdate = $this->common->update_data('msdr_member_basic', $memberWhere, $memberArr);
							if ($shopUpdate) {
								$msg = array('Thank you ! You have successfully complete personal details. ');
								$data = array('adClass' => 'tst_success', 'msg' => $msg, 'icon' => '<i class="bx bx-check"></i>', 'actn' => '2', 'memId' => $getProfile->id);
							} else {
								$msg = array('Oops it seems error.please refresh you page.');
								$data = array('adClass' => 'tst_warning', 'msg' => $msg, 'icon' => '<i class="bx bx-cog bx-spin"></i>');
							}
						} else {
							$msg = array('Oops it seems error.please refresh you page.');
							$data = array('adClass' => 'tst_warning', 'msg' => $msg, 'icon' => '<i class="bx bx-cog bx-spin"></i>');
						}
					} else {

						$lastId = $this->common->save_data('msdr_members', $createArr);
						$d = $this->Plan_model->find_placement_field($sponsor);
						$data = array(
							$d['leg'] => $lastId
						);

						$this->db->where('id', $d['id'])->update('msdr_members', $data);

						if ($lastId) {

							$email_res = confirmation_mail($post['mem_name'], config_item('company_name'), $post['mem_code'], $post['password']);
							$to_email  = $post['emailId'];
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
							$headers .= 'From: MSDR Global Marketing pvt. ltd. <infomsdr@gmail.com>';
							mail($to_email, "Congratulation for register", $email_res, $headers);

							$walletResult = $this->common->save_data('wallet', $createWallet);
							if ($walletResult) {
								$basicDetArr = array('mem_id' => $lastId, 'date_of_birth' => $post['dob']);
								$basicDetId = $this->common->save_data('msdr_member_basic', $basicDetArr);
								if ($basicDetId) {

									$msg = array('Thank you ! You have successfully complete personal details. ');
									$data = array('adClass' => 'tst_success', 'msg' => $msg, 'icon' => '<i class="bx bx-check"></i>', 'actn' => '2', 'memId' => $lastId);
								} else {
									$msg = array('Oops it seems error.please refresh you page.');
									$data = array('adClass' => 'tst_warning', 'msg' => $msg, 'icon' => '<i class="bx bx-cog bx-spin"></i>');
								}
							} else {
								$msg = array('Oops it seems error.please refresh you page.');
								$data = array('adClass' => 'tst_warning', 'msg' => $msg, 'icon' => '<i class="bx bx-cog bx-spin"></i>');
							}
						} else {
							$msg = array('Oops it seems error.please refresh you page.');
							$data = array('adClass' => 'tst_warning', 'msg' => $msg, 'icon' => '<i class="bx bx-cog bx-spin"></i>');
						}
					}
				}
			} else if ($post['miAction'] == '2') {
				$memberWhere = array('id' => $post['memberId']);
				$memberArr = array('address' => $post['address']);
				$shopUpdate = $this->common->update_data('msdr_members', $memberWhere, $memberArr);
				if ($shopUpdate) {

					$uniqAadhar = $this->common->getRowData('msdr_member_basic', 'aadhaar_nu', $post['aadhaar_no']);
					if ($uniqAadhar) {
						$msg = array("Please input unique aadhaar number");
						$data = array('adClass' => 'tst_warning', 'msg' => $msg, 'icon' => '<i class="bx bx-cog bx-spin"></i>');
					} else {
						$basicWhere = array('mem_id' => $post['memberId']);
						$basicDetArr = array(
							'state' => $post['statN'], 'district' => $post['district'], 'zipcode' => $post['zipcode'], 'pan_nu' => $post['pan_no'],
							'aadhaar_nu' => $post['aadhaar_no']
						);

						$basicUpdate = $this->common->update_data('msdr_member_basic', $basicWhere, $basicDetArr);
						if ($basicUpdate) {
							$msg = array('You have complete communication details');
							$data = array('adClass' => 'tst_success', 'msg' => $msg, 'icon' => '<i class="bx bx-check"></i>', 'actn' => '3');
						} else {
							$msg = array('Oops it seems error while updating communication details.');
							$data = array('adClass' => 'tst_danger', 'msg' => $msg, 'icon' => '<i class="bx bx-cog bx-spin"></i>');
						}
					}
				} else {
					$msg = array('Oops it seems error while communication details.');
					$data = array('adClass' => 'tst_warning', 'msg' => $msg, 'icon' => '<i class="bx bx-cog bx-spin"></i>');
				}
			} else if ($post['miAction'] == '3') {
				$basicWhere = array('mem_id' => $post['memberId']);
				$basicDetArr = array(
					'bank_name' => $post['bName'], 'bank_ac_no' => $post['bankAc'], 'bank_Ifsc' => $post['bnkIFSC'], 'bankBrName' => $post['brName'],
					'nominee_name' => $post['nomiName'], 'nominee_relationship' => $post['nomineeRel'], 'nominee_address' => $post['NomAddr']
				);
				$basicUpdate = $this->common->update_data('msdr_member_basic', $basicWhere, $basicDetArr);
				if ($basicUpdate) {
					$msg = array('You have complete banking detials.');
					$data = array('adClass' => 'tst_success', 'msg' => $msg, 'icon' => '<i class="bx bx-check"></i>', 'actn' => '4');
				} else {
					$msg = array('Oops it seems error while updating banking detials.');
					$data = array('adClass' => 'tst_danger', 'msg' => $msg, 'icon' => '<i class="bx bx-cog bx-spin"></i>');
				}
			} else if ($post['miAction'] == '4') {

				$getProfile = $this->member->profile_details($post['memberId']);
				$prevImg = array($getProfile->my_img => "profileImg", $getProfile->pan_img => "pancard", $getProfile->passbook_img => "passbook", $getProfile->adhar_img => "edtAadhar");
				$imgField = array('pan_img' => "pancard", 'passbook_img' => "passbook", 'adhar_img' => "edtAadhar", 'my_img' => "profileImg");
				$imgSaveField = array_search($post['docType'], $imgField);
				$prevImgLoc = array_search($post['docType'], $prevImg);
				if ($post['docType'] == 'profileImg') {
					$default = 'uploads/member/no_profile.png';
					$tblName = 'msdr_members';
					$uploadPath = "uploads/member/";
					$moreWhereCon = array('id' => $post['memberId']);
				} else {
					$default = 'uploads/member_document/no_img.png';
					$tblName = 'msdr_member_basic ';
					$uploadPath = "uploads/member_document/";
					$moreWhereCon = array('mem_id' => $post['memberId']);
				}


				if ($prevImgLoc == $default) {
					$resetImgLoc = '';
				} else {
					$resetImgLoc = $prevImgLoc;
				}
				$getImgFl = $this->input->post('file');
				$image_filename = NULL;
				$config = array('upload_path' => $uploadPath, 'allowed_types' => "jpg|png|jpeg|JPEG|JPG", 'overwrite' => FALSE, 'encrypt_name' => TRUE, 'max_size' => "10120000");
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$image['image_upload'] = array('upload_data' => $this->upload->data());
					$image_filename = $image['image_upload']['upload_data']['file_name'];
				}
				if ($image_filename) {
					$config = NULL;
					$config['image_library'] = 'gd2';
					$config['source_image']  = $uploadPath . $image_filename;
					$config['width'] = '150';
					$config['height'] = '150';
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					if ($post['docType'] == 'profileImg') {
						$updateDataArr = array($imgSaveField => $uploadPath . $image_filename, 'modify_typ' => '0', 'modified_by' => $this->logId, 'modify_date' => date('Y-m-d H:i:s'));
					} else {
						$updateDataArr = array($imgSaveField => $uploadPath . $image_filename, 'modified_type' => '1', 'modify_by' => $this->logId, 'modify_date' => date('Y-m-d H:i:s'));
					}
					if ($resetImgLoc) {
						unlink($resetImgLoc);
					}
					//echo $this->db->last_query();die;
					$result = $this->common->update_data($tblName, $moreWhereCon, $updateDataArr);

					if ($result) {
						$msg = array('Thank you! You have successfully update document details');
						$data = array('adClass' => 'tst_success', 'msg' => $msg, 'img_loc' => $uploadPath . $image_filename, 'actn' => '4', 'icon' => '<i class="bx bx-check"></i>');
					} else {
						$msg = array('Oops it seems server taking more time please refresh');
						$data = array('adClass' => 'tst_danger', 'msg' => $msg, 'actn' => '4', 'icon' => '<i class="bx bx-cog bx-spin"></i>');
					}
					sleep(1);
				} else {
					$msg = array('Only .jpg,.png,.jpeg are accepted');
					$data = array('adClass' => 'tst_warning', 'msg' => $msg, 'actn' => '4', 'icon' => '<i class="bx bx-cog bx-spin"></i>');
				}
			}
		}

		echo json_encode($data);
	}
	public function delete()
	{
		$post = $this->input->post();
		$moreWhereCon = array('mem_id' => $post['actn']);
		$getProfile = $this->common->getRowData('msdr_member_basic', 'mem_id', $post['actn']);
		$imgField = array('pan_img' => "delPan", 'passbook_img' => "delBankpass", 'adhar_img' => "delAadhar");
		$imgSaveField = array_search($post['docType'], $imgField);
		$prevImg = array($getProfile->pan_img => "delPan", $getProfile->passbook_img => "delBankpass", $getProfile->adhar_img => "delAadhar");
		$prevImgLoc = array_search($post['docType'], $prevImg);
		$default = 'uploads/member_document/no_img.png';
		if ($prevImgLoc == $default) {
			$resetImgLoc = '';
		} else {
			$resetImgLoc = $prevImgLoc;
		}
		$updateArr = array($imgSaveField => 'uploads/member_document/no_img.png');
		if ($resetImgLoc) {
			unlink($resetImgLoc);
		}
		$result = $this->common->update_data('msdr_member_basic', $moreWhereCon, $updateArr);
		if ($result) {
			$msg = '<i class="bx bx-smile"></i> Thank you! You have successfully update document details';
			$data = array('icon' => '1', 'text' => $msg, 'img_loc' => 'uploads/member_document/no_img.png');
		} else {
			$msg = array('<i class="fa fa-cog rotate"></i> Oops it seems server taking more time please refresh');
			$data = array('icon' => '2', 'text' => $msg);
		}
		sleep(2);
		echo json_encode($data);
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
		$data['fmPack']   = $this->common->getRowData('package', 'id', '1');
		$data['package'] = $this->common->all_data('package', '*');
		$data['getState'] = $this->common->getDataList('states_cities', 'parent_id', '729');
		$data['username'] = config_item('ID_EXT'). $username;
		$data['title'] = 'Edit Members';
		$data['breadcrums'] = 'Edit Members';
		$data['layout'] = 'mlm_software/admin/members/member_operation.php';
		$this->load->view('mlm_software/base', $data);
	}


	public function isExistSponsor()
	{
		$postId = $this->input->post('sponsorId');
		$isExistData = $this->common->getRowData('msdr_members', 'username', $postId);
		if ($isExistData) {
			$data = array('spName' => $isExistData->name, 'msg' => 'Sponsor available', 'err' => '#1C9400');
		} else {
			$data = array('spName' => ' ', 'msg' => "Doesn't exist sponsor", 'err' => '#db4832');
		}
		//sleep(2);
		echo json_encode($data);
	}
	public function cityList()
	{
		$id = $this->input->post('id');
		$getCity = $this->common->getDataList('states_cities', 'parent_id', $id);
		sleep(1);
		echo '<option value="">--- Select One ---</option>';
		if ($getCity) {
			foreach ($getCity as $list) {
				echo '<option value="' . $list->id . '">' . $list->state_cities . '</option>';
			}
		}
	}
	public function create_tree()
	{
		$post_id = $this->input->post('id');
		$whereCon = array('username' => $post_id);
		$whereDownLineCon = array('sponsor' => $post_id);
		$getCurrentMember = $this->common->get_data('msdr_members', $whereCon, 'name,my_img,username');
		$createMydownLine = $this->common->all_data_con('msdr_members', $whereDownLineCon, '*');
		$data['createMydownLine'] = $createMydownLine;
		$data['getCurrentMember'] = $getCurrentMember;
		$this->load->view('mlm_software/admin/members/tree', $data);
	}
	public function buy_package()
	{
		$data['title'] = 'Member Buy Package';
		$data['breadcrums'] = 'Member Buy Package';
		$data['pack_plan'] = $this->common->all_data('package', 'id,pack_price');
		$data['layout'] = 'mlm_software/admin/members/activate_account.php';
		$this->load->view('mlm_software/base', $data);
	}
	public function isActivateMember()
	{
		$post = $this->input->post();
		$pack=$this->db->select('id,pack_price')->where('id',$post['pack_plan'])->get('package')->row();

		$whereCon = array('username' => $post['userIdA']);
		$isMember = $this->common->get_data('msdr_members', $whereCon, 'username,name,mobile,email,topup');
		if ($post['amiActn'] == 'arvtpchk') {
			if ($isMember) {
				if ($isMember['topup'] == '0.00') {
					$isMember['pack_price']=$pack->pack_price;
					$data = $isMember;
				} else {
					$data = array('data' => '2', 'text' => "<i class='bx bx-cog bx-spin'></i> Oops it seems this user id #" . $post['userIdA'] . ' is topup already completed');
				}
			} else {
				$data = array('data' => '2', 'text' => "<i class='bx bx-cog bx-spin'></i> Oops it seems there is no member available to this user id #" . $post['userIdA']);
			}
		} else if ($post['amiActn'] == 'arvtpdne') {
			
			$package_id=$pack->id;
			if ($isMember['topup'] == '0.00') {
				$tnxNu = date('dHis');
				$memWallTnxArr = array(
					'tnx_id'        => $tnxNu,
					'user_id'       => $post['userIdA'],
					'debit_amt'     => $pack->pack_price,
					'reason'        => 'Amount debited after topup your account',
					'created_by'    => '0',
					'create_date'   => date('Y-m-d H:i:s'),
					'transfer_id'   => $this->logId
				);
				$mlmIncArr = array(
					'tnx_id'          => $tnxNu,
					'tnx_type'        => '1',
					'credit_amt'      => $pack->pack_price,
					'reason'          => 'Amount credited after topup of account id #' . $post['userIdA'],
					'generated_by'    => '0',
					'created_date'    => date('Y-m-d H:i:s'),
					'created_by'      => $this->logId
				);
				$memWhereCon = array('username' => $post['userIdA']);

				$memberActivate = array('topup' => $pack->pack_price, 'topup_date' => date('Y-m-d H:i:s'));

				$createWalletTnx = $this->common->save_data('wallet_transaction', $memWallTnxArr);

				if ($createWalletTnx) {

					$createCompanyInc = $this->common->save_data('company_income', $mlmIncArr);

					if ($createCompanyInc) {
						$updateMemberAc = $this->common->update_data('msdr_members', $memWhereCon, $memberActivate);

						if ($updateMemberAc) {
							

							// $finalResult = $this->income->activate_plan($post['userIdA'], $post['userIdA'], $pack->pack_price);
							 
							$userid = $post['userIdA'];
							 $mem= $this->db->select('id,username,sponsor,position')->where('username',$userid)->get('msdr_members')->row();
							
							 $this->load->model('Earning_model','Earning_model');
							$finalResult=$this->Earning_model->reg_earning($userid, $mem->sponsor,$mem->position, $package_id);

							if ($finalResult == 'success') {
								$data = array('data' => '1', 'text' => "<i class='bx bx-smile'></i> Thank you! you have successfully topuped to this user id #" . $post['userIdA']);
							} else {
								$msg = "<i class='bx bx-smile'></i> Thank you! you have successfully activate to this user id #" . $post['userIdA'] . " as top of member";
								$data = array('data' => '1', 'text' => $msg);
							}

						} else {
							$data = array('data' => '2', 'text' => "<i class='bx bx-cog bx-spin'></i> oops it seems something get wrong while activating member account");
						}

					} else {
						$data = array('data' => '2', 'text' => "<i class='bx bx-cog bx-spin'></i> oops it seems something get wrong while creating company transaction");
					}

				} else {
					$data = array('data' => '2', 'text' => "<i class='bx bx-cog bx-spin'></i> oops it seems something get wrong while member transaction ");
				}

			} else {
				$data = array('data' => '2', 'text' => "<i class='bx bx-cog bx-spin'></i> Oops it seems this user id #" . $post['userIdA'] . ' is purchase already completed');
			}

		} else {
			$data = array('data' => '2', 'text' => "<i class='bx bx-cog bx-spin'></i> oops it seems like you're going in the wrong direction ");
		}

		echo json_encode($data);
	}

	public function passv()
	{
		$pID = $this->input->post('pID');
		sleep(2);
		$data = array('id' => $pID);
		$getPinDeta = $this->common->get_data('msdr_members', $data, 'shw_pass');
		if ($getPinDeta) {
			echo $getPinDeta['shw_pass'];
		} else {
			echo 'Try Again';
		}
	}









	public function deposit($actn = NULL)
	{
		if ($actn == 'list') {

			$post_data = $this->input->post();
			####################### print_r($post_data);die;#######################
			$record = $this->member->deposit_data($post_data);
			####################### echo $this->db->last_query();die;#######################
			$i = $post_data['start'] + 1;
			$return['data'] = array();
			$amt = 0;
			foreach ($record as $row) {
				if (strlen($row->reason) > 20) {
					$reason = '<div class="amtltip">' . substr($row->reason, 0, 15) . '...<div class="tlptext">' . $row->reason . '</div></div>';
				} else {
					$reason = $row->reason;
				}

				$view = base_url('mlm_software/admin/member/deposit/' . urlencode(base64_encode($row->id)));

				$return['data'][] = array(
					'<strong>' . $i++ . '.</strong>', '<div align="center">' . date('H:i:s d-m-Y', strtotime($row->create_date)) . '</div>', $row->tnx_id,
					$reason, '<span style="font-weight:600">' . $row->amount . '</span>',
					'<div align="center"><span class="' . $row->status . '">' . $row->status . '</span></div>',
					'<div align="center"><a href="' . $view . '" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View">
													 <i class="mdi mdi-eye"></i> 
												 </a>
												</div>'
				);
			}
			$return['recordsTotal'] = $this->member->deposit_count();
			$return['recordsFiltered'] = $this->member->deposit_filter_count($post_data);
			$return['draw'] = $post_data['draw'];
			echo json_encode($return);
		} else {
			if ($actn) {
				$id = base64_decode(urldecode($actn));
				$deposit = NULL;
				$employee = NULL;
				$deposit = $this->member->getDepositData($id);
				if ($deposit->aproved_by) {
					$employee = $this->common->getRowData('users', 'id', $deposit->aproved_by);
				}
				$data['employee'] = $employee;
				$data['deposit'] = $deposit;
				$data['title'] = 'Member deposit details';
				$data['breadcrums'] = 'Member deposit details';
				$data['target'] = base_url('mlm_software/admin/member/approve_deposit');
				$data['layout'] = 'mlm_software/member/deposit_view.php';
				$this->load->view('super_admin/base', $data);
			} else {
				$data['title'] = 'Member deposit request';
				$data['breadcrums'] = 'Member deposit request';
				$data['target'] = 'mlm_software/admin/member/deposit/list';
				$data['layout'] = 'mlm_software/member/deposit_list.php';
				$this->load->view('super_admin/base', $data);
			}
		}
	}
	public function approve_deposit()
	{

		$post = $this->input->post();
		if ($post['trfType'] == 'pin_purchase') {
			$whereCon = array('mem_id' => $post['getMemID']);
			$getResult = $this->common->all_data_con('package_purchase', $whereCon, 'tnx_id');
			if ($getResult) {
				$result = '<select class="form-select" name="admnTnxID" id="admnTnxID"><option value="">---- Select One ----</option>';
				foreach ($getResult as $list) {
					$result .= '<option value="' . $list['tnx_id'] . '">' . $list['tnx_id'] . '</option>';
				}
				$result .= '</select>';
			} else {
				$result = '<input type="text" id="admnTnxID" class="form-control">';
			}
		} else if ($post['trfType'] == 'wallet') {
			$tnxId = date('dHsi');
			$result = '<input type="text"  id="admnTnxID" readonly=""  class="form-control" value="' . $tnxId . '">';
		} else if ($post['trfType'] == 'Security') {
			$whereCon = array('user_id' => $post['getMemID'], 'tnx_typ' => '1');
			$getData = $this->common->get_data('partner_wallet_transaction', $whereCon, 'tnx_id');
			if ($getData) {
				$result = '<input type="text"  id="admnTnxID" readonly=""  class="form-control" value="' . $getData['tnx_id'] . '">';
			} else {
				$result = '<input type="text" id="admnTnxID" class="form-control">';
			}
		} else if ($post['trfType'] == 'purchase') {
			$whereCon = array('user_id' => $post['getMemID'], 'tnx_typ' => '2');
			$getData = $this->common->get_data('partner_wallet_transaction', $whereCon, 'tnx_id');
			if ($getData) {
				$result = '<input type="text"  id="admnTnxID" readonly=""  class="form-control" value="' . $getData['tnx_id'] . '">';
			} else {
				$result = '<input type="text" id="admnTnxID" class="form-control">';
			}
		} else {
			$result = '<input type="text" id="admnTnxID" class="form-control">';
		}
		echo '<div class="form-floating mb-3">' . $result . '<label for="tnxIdForAll"><i class="bx bx-transfer-alt fntClr"></i> Transaction id </label></div>';
	}


	public function approve()
	{
		$post = $this->input->post();
		$whereCon = array('id' => $post['depoID']);
		$createDate = date('Y-m-d H:i:s');
		$updateDataArr = array(
			'aproved_by' => $this->logId, 'approval_date' => $createDate, 'approval_remarks' => $post['tnxRemarksByAdmin'],
			'status' => $post['trAction'], 'admin_tnx_type' => $post['trfType'], 'amt_tnx' => $post['admnTnxID']
		);
		$updateResult = $this->common->update_data('partner_deposit', $whereCon, $updateDataArr);
		if ($updateResult) {
			if ($post['trAction'] == 'Approved') {
				if ($post['trfType'] == 'pin_purchase') {
					$pinPurArr = array('paid_status' => 'paid');
					$updatePinPur = $this->common->update_data('package_purchase', array('tnx_id' => $post['admnTnxID']), $pinPurArr);
					if ($updatePinPur) {
						$data = array('result' => '1', 'msg' => 'Thank you! You have successfully completted');
					} else {
						$data = array('result' => '2', 'msg' => 'Oops it seems there is an error while updating pin purchase transaction');
					}
				} elseif ($post['trfType'] == 'wallet') {
					$getDetails = $this->member->getWalletWithDepositData($post['depoID']);
					$newWalletAmt = $getDetails->depAmt + $getDetails->balance;
					$updateWallet = $this->common->update_data('wallet', array('userid' => $post['getMemID']), array('balance' => $newWalletAmt));
					if ($updateWallet) {
						$reason = 'Amount credit after request approved by company of tnx #' . $post['admnTnxID'];
						$createWalletArr = array(
							'tnx_id' => $post['admnTnxID'], 'user_id' => $post['getMemID'], 'credit_amt' => $getDetails->depAmt, 'reason' => $reason, 'created_by' => '0',
							'create_date' => $createDate, 'transfer_id' => $this->logId, 'trnx_type' => 'wallet'
						);
						$createWalletTnx = $this->common->save_data('partner_wallet_transaction', $createWalletArr);
						if ($createWalletTnx) {
							$data = array('result' => '1', 'msg' => 'Thank you! You have successfully completted');
						} else {
							$data = array('result' => '2', 'msg' => 'Oops it seems there is an error while creating wallet transaction');
						}
					} else {
						$data = array('result' => '2', 'msg' => 'Oops it seems there is an error while updating wallet');
					}
				} elseif ($post['trfType'] == 'topup') {
					$getTopAmt = $this->common->getRowData('partner_wallet_transaction', 'tnx_id', $post['admnTnxID']);
					$topUpAmt = $getTopAmt->debit_amt;
					$getMDetails = $this->Member_model->getWalletWithDepositData($post['depoID']);
					$newWalletAmt = $getMDetails->depAmt + $getMDetails->balance - $topUpAmt;
					$updateWallet = $this->common->update_data('wallet', array('userid' => $post['getMemID']), array('balance' => $newWalletAmt));
					if ($updateWallet) {
						$nWalletAmt = $getMDetails->depAmt - $topUpAmt;
						if ($nWalletAmt > 0) {
							$tnxActn = 'credit';
							$trnxAmt = $nWalletAmt;
						} else {
							$tnxActn = 'debit';
							$trnxAmt = $topUpAmt;
						}
						$reason = 'Amount ' . $tnxActn . ' after request approved by company of tnx #' . $post['admnTnxID'];
						$tnxId = date('dHsi');
						$createWalletArr = array(
							'tnx_id' => $tnxId, 'user_id' => $post['getMemID'], $tnxActn . '_amt' => $trnxAmt, 'reason' => $reason, 'created_by' => '0',
							'create_date' => $createDate, 'transfer_id' => $this->logId, 'trnx_type' => 'wallet'
						);
						$createWalletTnx = $this->common->save_data('partner_wallet_transaction', $createWalletArr);
						if ($createWalletTnx) {
							$data = array('result' => '1', 'msg' => 'Thank you! You have successfully completted');
						} else {
							$data = array('result' => '2', 'msg' => 'Oops it seems there is an error while creating wallet transaction');
						}
					} else {
						$data = array('result' => '2', 'msg' => 'Oops it seems there is an error while creating wallet transaction');
					}
				}
			} else {
				$data = array('result' => '1', 'msg' => 'Thank you! You have successfully change request to ' . $post['trAction']);
			}
		} else {
			$data = array('result' => '2', 'msg' => 'Oops it seems there is an error while updating request');
		}
		echo json_encode($data);
	}
}
