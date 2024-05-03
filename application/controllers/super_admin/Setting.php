<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('super_admin/mlm_software/setting_model', 'setting');
        ($this->session->userdata('user_id') == '') ? redirect(base_url(), 'refresh') : '';
		error_reporting(0);
		$this->logId=$this->session->userdata('user_id');
		$this->lgCat=$this->session->userdata('user_cate');
    }

    public function basic_setting()
    {
        $data['title'] = 'Basic Setting';
        $data['breadcrums'] = 'Basic Setting';
        $data['layout'] = 'setting/basic.php';
        $this->load->view('super_admin/base', $data);
    }

    //Basic Data Update
    public function basic_data()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email ID', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
            if ($this->form_validation->run() == TRUE) {
                $post = $this->input->post();
                $file = '<?php
defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');

    # Basic Setting Details
    $config[\'company_name\'] = "' . $post['company_name'] . '";
    $config[\'mobile_number\'] = "' . $post['mobile'] . '";
    $config[\'email\'] = "' . $post['email'] . '";
    $config[\'address\'] = "' . $post['address'] . '";
    $config[\'logo_dark\'] = "' . config_item('logo_dark') . '";
    $config[\'logo_sm\'] = "' . config_item('logo_sm') . '";
    $config[\'logo_light\'] = "' . config_item('logo_light') . '";
    $config[\'logo_sm_light\'] = "' . config_item('logo_sm_light') . '";

?>';
                if (file_put_contents(APPPATH . 'config/global.php', $file)) {
                    $data = array('icon' => 'success', 'text' => 'Data Updated Successfully');
                } else {
                    $msgs = array('Some Error Occur Please Re-Update');
                    $data = array('icon' => 'error', 'text' => $msgs);
                }
            } else {
                $msg =  array(
                    'company_name'  => form_error('company_name'),
                    'mobile'        => form_error('mobile'),
                    'email'         => form_error('email'),
                    'address'       => form_error('address'),
                );

                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);
        }
    }

    // Dark Logo Data
    public function dark_logo_data()
    {
        if ($this->input->is_ajax_request()) {
            // echo $_FILES['dark_favicon']['name'];die;
            if (trim($_FILES['dark_logo']['name'] !== "")) {
                $filename = "logo-dark";
                $config['upload_path']          = './media/images/';
                $config['allowed_types']        = 'jpg|jpeg|png';
                $config['max_size']             = 2048;
                $config['file_name']            = $filename;

                $this->load->library('upload', $config);

                unlink('media/images/' . config_item('logo_dark'));
                if (!$this->upload->do_upload('dark_logo')) {
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    echo json_encode($data);die;
                } else {
                    $doc_data = $this->upload->data();
                    $dark_logo = $doc_data['raw_name'] . $doc_data['file_ext'];
                    //print_r($val);die;
                    $data = array('text' => "Dark Logo Updated Successfully !", 'icon' => "success");
                }
                $file = '<?php
defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');

    # Basic Setting Details
    $config[\'company_name\'] = "' . config_item('company_name') . '";
    $config[\'mobile_number\'] = "' . config_item('mobile_number') . '";
    $config[\'email\'] = "' . config_item('email') . '";
    $config[\'address\'] = "' . config_item('address') . '";
    $config[\'logo_dark\'] = "' . $dark_logo . '";
    $config[\'logo_sm\'] = "' . config_item('logo_sm') . '";
    $config[\'logo_light\'] = "' . config_item('logo_light') . '";
    $config[\'logo_sm_light\'] = "' . config_item('logo_sm_light') . '";
?>';
                if (file_put_contents(APPPATH . 'config/global.php', $file)) {
                    $data = array('icon' => 'success', 'text' => 'Dark Logo Updated Successfully !');
                } else {
                    $msgs = array('Some Error Occur Please Re-Update');
                    $data = array('icon' => 'error', 'text' => $msgs);
                }
            } else {
                $msg = array('Please Select File To Upload');
                $data = array('icon' => 'error', 'text' => $msg);
            }



            echo json_encode($data);
        }
    }



    // Dark Favicon Data
    public function dark_favicon_data()
    {
        if ($this->input->is_ajax_request()) {
            // echo $_FILES['dark_favicon']['name'];die;
            if (trim($_FILES['dark_favicon']['name'] !== "")) {
                $filename = "logo-sm";
                $config['upload_path']          = './media/images/';
                $config['allowed_types']        = 'jpg|jpeg|png';
                $config['max_size']             = 2048;
                $config['file_name']            = $filename;

                $this->load->library('upload', $config);

                unlink('media/images/' . config_item('logo_sm'));
                if (!$this->upload->do_upload('dark_favicon')) {
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    echo json_encode($data);die;
                } else {
                    $doc_data = $this->upload->data();
                    $dark_fav = $doc_data['raw_name'] . $doc_data['file_ext'];
                    //print_r($val);die;
                    $data = array('text' => "Dark Favicon Updated Successfully !", 'icon' => "success");
                }
                $file = '<?php
defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');

    # Basic Setting Details
    $config[\'company_name\'] = "' . config_item('company_name') . '";
    $config[\'mobile_number\'] = "' . config_item('mobile_number') . '";
    $config[\'email\'] = "' . config_item('email') . '";
    $config[\'address\'] = "' . config_item('address') . '";
    $config[\'logo_dark\'] = "' . config_item('logo_dark') . '";
    $config[\'logo_sm\'] = "' . $dark_fav . '";
    $config[\'logo_light\'] = "' . config_item('logo_light') . '";
    $config[\'logo_sm_light\'] = "' . config_item('logo_sm_light') . '";
?>';
                if (file_put_contents(APPPATH . 'config/global.php', $file)) {
                    $data = array('icon' => 'success', 'text' => 'Dark Favicon Updated Successfully !');
                } else {
                    $msgs = array('Some Error Occur Please Re-Update');
                    $data = array('icon' => 'error', 'text' => $msgs);
                }
            } else {
                $msg = array('Please Select File To Upload');
                $data = array('icon' => 'error', 'text' => $msg);
            }



            echo json_encode($data);
        }
    }


    // Light Logo Data
    public function light_logo_data()
    {
        if ($this->input->is_ajax_request()) {
            // echo $_FILES['dark_favicon']['name'];die;
            if (trim($_FILES['light_logo']['name'] !== "")) {
                $filename = "logo-light";
                $config['upload_path']          = './media/images/';
                $config['allowed_types']        = 'jpg|jpeg|png';
                $config['max_size']             = 2048;
                $config['file_name']            = $filename;

                $this->load->library('upload', $config);

                unlink('media/images/' . config_item('logo_light'));
                if (!$this->upload->do_upload('light_logo')) {
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    echo json_encode($data);die;
                } else {
                    $doc_data = $this->upload->data();
                    $light_logo = $doc_data['raw_name'] . $doc_data['file_ext'];
                    //print_r($val);die;
                    $data = array('text' => "Light Logo Updated Successfully !", 'icon' => "success");
                }
                $file = '<?php
    defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');
    
        # Basic Setting Details
        $config[\'company_name\'] = "' . config_item('company_name') . '";
        $config[\'mobile_number\'] = "' . config_item('mobile_number') . '";
        $config[\'email\'] = "' . config_item('email') . '";
        $config[\'address\'] = "' . config_item('address') . '";
        $config[\'logo_dark\'] = "' . config_item('logo_dark') . '";
        $config[\'logo_sm\'] = "' . config_item('logo_sm') . '";
        $config[\'logo_light\'] = "' . $light_logo . '";
        $config[\'logo_sm_light\'] = "' . config_item('logo_sm_light') . '";
    ?>';
                if (file_put_contents(APPPATH . 'config/global.php', $file)) {
                    $data = array('icon' => 'success', 'text' => 'Light Logo Updated Successfully !');
                } else {
                    $msgs = array('Some Error Occur Please Re-Update');
                    $data = array('icon' => 'error', 'text' => $msgs);
                }
            } else {
                $msg = array('Please Select File To Upload');
                $data = array('icon' => 'error', 'text' => $msg);
            }



            echo json_encode($data);
        }
    }


    // Light Favicon Data
    public function light_favicon_data()
    {
        if ($this->input->is_ajax_request()) {
            // echo $_FILES['dark_favicon']['name'];die;
            if (trim($_FILES['light_favicon']['name'] !== "")) {
                $filename = "logo-sm-light";
                $config['upload_path']          = './media/images/';
                $config['allowed_types']        = 'jpg|jpeg|png';
                $config['max_size']             = 2048;
                $config['file_name']            = $filename;

                $this->load->library('upload', $config);

                unlink('media/images/' . config_item('logo_sm_light'));
                if (!$this->upload->do_upload('light_favicon')) {
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    echo json_encode($data);die;
                } else {
                    $doc_data = $this->upload->data();
                    $light_favicon = $doc_data['raw_name'] . $doc_data['file_ext'];
                    //print_r($val);die;
                    $data = array('text' => "Light Logo Updated Successfully !", 'icon' => "success");
                }
                $file = '<?php
    defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');
    
        # Basic Setting Details
        $config[\'company_name\'] = "' . config_item('company_name') . '";
        $config[\'mobile_number\'] = "' . config_item('mobile_number') . '";
        $config[\'email\'] = "' . config_item('email') . '";
        $config[\'address\'] = "' . config_item('address') . '";
        $config[\'logo_dark\'] = "' . config_item('logo_dark') . '";
        $config[\'logo_sm\'] = "' . config_item('logo_sm') . '";
        $config[\'logo_light\'] = "' . config_item('logo_light') . '";
        $config[\'logo_sm_light\'] = "' . $light_favicon . '";
    ?>';
                if (file_put_contents(APPPATH . 'config/global.php', $file)) {
                    $data = array('icon' => 'success', 'text' => 'Light Favicon Updated Successfully !');
                } else {
                    $msgs = array('Some Error Occur Please Re-Update');
                    $data = array('icon' => 'error', 'text' => $msgs);
                }
            } else {
                $msg = array('Please Select File To Upload');
                $data = array('icon' => 'error', 'text' => $msg);
            }



            echo json_encode($data);
        }
    }
/***************************@mit Start*******************************/
public function unit_manage()
{
	  $data['title'] = 'Unit Manage';
        $data['breadcrums'] = 'Unit Manage';
        $data['layout'] = 'setting/unit_manage.php';
        $this->load->view('super_admin/base', $data);
	}
public function category_manage()
{
	  $data['title'] = 'Basic Setting';
        $data['breadcrums'] = 'Basic Setting';
        $data['layout'] = 'setting/category_manage.php';
		$getMainCat=$this->common->getDataList('category_manage','parent_id','0');
		$data['getMainCat']=$getMainCat;
        $this->load->view('super_admin/base', $data);
	}
	
   public function unit_data()
   {	
        $post_data = $this->input->post();
        $record = $this->setting->unit_list($post_data);
	    $i = $post_data['start'] + 1;
        $return['data'] = array();
        foreach ($record as $row) {	
				$statusShw='statusCh=='.$row->status.'=='.$row->id;
				if($row->status=='1'){$stsTex='Active'; $activeCls='setBtn'; }else{$stsTex='Deactive';$activeCls='setBtnGr dctive'; }
					$getUid=urlencode(base64_encode($row->id));
			$actionBtn='<div style="text-align:center;"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#manage_unit" data-id="vwUnitDet==super_admin/setting/set_unit=='.$row->id.'"  class="btn btn-outline-warning btn-sm waves-effect btn-padd getAction" title="View"><i class="mdi mdi-eye"></i> </a>
				<a href="javascript:void(0)" class="btn btn-outline-success btn-sm waves-effect btn-padd getAction" data-id="edtUnitDet==super_admin/setting/set_unit=='.$row->id.'"  data-bs-toggle="modal" data-bs-target="#manage_unit"  title="Edit">
				<i class="mdi mdi-square-edit-outline me-1"></i> </a>
		<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm waves-effect btn-padd getAction" data-id="delUnitDetails==super_admin/setting/set_unit=='.$row->id.'"  data-bs-toggle="modal" data-bs-target="#deleteModel" title="Delete">
				<i class="bx bxs-trash"></i> </a></div>';	
		    $return['data'][] = array(
                '<strong>'.$i++.'.</strong>',
                $row->unitId,$row->unit_name,
               '<div class="'.$activeCls.' getAction" data-id="'.$statusShw.'" id="stsId'.$row->id.'"><span>'.$stsTex.'</span></div>',
				$actionBtn
            );
        
	 }	
        $return['recordsTotal'] = $this->setting->unit_count();
        $return['recordsFiltered'] = $this->setting->unit_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
   		}		
   public function set_unit()
   {
        $getDetails=NULL;$post=$this->input->post();
	
		if($post['id']){$getDetails=$this->setting->details_unit($post['id']);}
	    if($post['unitActn']=='addUnit')
		 {
			 $unitId='MSDRU'.date("ds");
			$createArr=array('unit_name'=>$post['unit_name'],'unitId'=>$unitId,'created_by'=>$this->logId,'create_date'=>date('Y-m-d H:i:s'));
			if($this->common->save_data('unit_manage', $createArr))
			{$data = array('icon' => '1', 'text' =>'<i class="bx bx-smile"></i> Thank you! You have succesfully created unit details');}
			else{$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while creating details');}
			}	
	   else if($post['unitActn']=='view')
		{   
		    if($getDetails)
			{	
				if($getDetails->modify_date){$modifidt=date('H:i:s a d M Y',strtotime($getDetails->modify_date));}else{$modifidt='N/A';}
				$data=array('unit_name'=>$getDetails->unit_name,'createdBy'=>$getDetails->createdBy,'createCode'=>$getDetails->createCode,
							'modifiedBy'=>$getDetails->modifiedBy,'modifiedId'=>$getDetails->modifiedId,'create_date'=>date('H:i:s a d M Y',strtotime($getDetails->create_date)),
							'modify_date'=>$modifidt);
				}
			else{$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is no any designation details found here');}
			}				
	else if($post['unitActn']=='edit')
		{
			$conArr=array('id'=>$post['id']);
			$upDtArr=array('unit_name'=>$post['unit_name'],'modified_by'=>$this->logId,'modify_date'=>date('Y-m-d H:i:s'));
			if($this->common->update_data('unit_manage',$conArr,$upDtArr))
			{$data = array('icon' => '1', 'text' =>'<i class="bx bx-smile"></i> Thank you! You have succesfully update designation details');}
			else{$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while updating details');}
			
			}	
		else if($post['unitActn']=='deleteUnitDet')
		{$data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i>  Are You sure want to delete #'.$getDetails->unit_name);}		
		else if($post['unitActn']=='cnfDeleteCategory')
		{
		     $whereCon=array('id'=>$post['id'],'table'=>'unit_manage');
			 $delDetails=$this->common->del_data($whereCon);
			 if($delDetails){$data = array('icon' => '1', 'text' => '<i class="bx bx-smile"></i>  Thank You! you have successfully delete #'.$getDetails->unit_name);}
			 else{$data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems error while deleting #'.$getDetails->unit_name);}			
			}
			else
			{
				$data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems no data access');
				}	
			
				
		echo json_encode($data);
		} 		
	public function unit_status()
	{
		$post=explode("==",$this->input->post('id'));
		if($post[0]=='statusCh')
		{
			$conArr=array('id'=>$post['2']);if($post[1]=='1'){$status='0';}else{$status='1';}	
			$upDtArr=array('status'=>$status,'modified_by'=>$this->logId,'modify_date'=>date('Y-m-d H:i:s'));
			if($this->common->update_data('unit_manage',$conArr,$upDtArr)){$data = array('icon' => '1', 'text' => 'statusCh=='.$status.'=='.$post['2']);}
			else{$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while updating details');}
			}
			else if($post[0]=='statusCat')
		{
			$conArr=array('id'=>$post['2']);if($post[1]=='1'){$status='0';}else{$status='1';}	
			$upDtArr=array('status'=>$status,'modified_by'=>$this->logId,'modify_date'=>date('Y-m-d H:i:s'));
			if($this->common->update_data('category_manage',$conArr,$upDtArr)){$data = array('icon' => '1', 'text' => 'statusCat=='.$status.'=='.$post['2']);}
			else{$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while updating details');}
			}
		else if($post[0]=='statusPack')
		{
			$conArr=array('id'=>$post['2']);if($post[1]=='1'){$status='0';}else{$status='1';}	
			$upDtArr=array('status'=>$status,'modified_by'=>$this->logId,'modify_date'=>date('Y-m-d H:i:s'));
			if($this->common->update_data('package',$conArr,$upDtArr)){$data = array('icon' => '1', 'text' => 'statusPack=='.$status.'=='.$post['2']);}
			else{$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while updating details');}
			}
			
			
			
			
			else{$data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems no data access');}
			echo json_encode($data);	
		}
   public function category_data()
   {	
        $post_data = $this->input->post();
        $record = $this->setting->category_list($post_data);
	    $i = $post_data['start'] + 1;
        $return['data'] = array();
        foreach ($record as $row) {	
				$statusShw='statusCat=='.$row->status.'=='.$row->id;
				if($row->status=='1'){$stsTex='Active'; $activeCls='setBtn'; }else{$stsTex='Deactive';$activeCls='setBtnGr dctive'; }
					$getUid=urlencode(base64_encode($row->id));
			$actionBtn='<div style="text-align:center;"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#manage_category" data-id="vwCatDet==super_admin/setting/set_category=='.$row->id.'"  class="btn btn-outline-warning btn-sm waves-effect btn-padd getAction" title="View"><i class="mdi mdi-eye"></i> </a>
				<a href="javascript:void(0)" class="btn btn-outline-success btn-sm waves-effect btn-padd getAction" data-id="edtCatDet==super_admin/setting/set_category=='.$row->id.'"  data-bs-toggle="modal" data-bs-target="#manage_category"  title="Edit">
				<i class="mdi mdi-square-edit-outline me-1"></i> </a>
		<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm waves-effect btn-padd getAction" data-id="delCatDetails==super_admin/setting/set_category=='.$row->id.'"  data-bs-toggle="modal" data-bs-target="#deleteModel" title="Delete">
				<i class="bx bxs-trash"></i> </a></div>';
			if($row->master_cat){$master=$row->master_cat;$sub_cat=$row->category;}
			else{$master=$row->category;$sub_cat='<div class="blnk">&nbsp;</div>';}
			 $return['data'][] = array(
                '<strong>'.$i++.'.</strong>',
                $row->cat_id,$master,$sub_cat,
               '<div class="'.$activeCls.' getAction" data-id="'.$statusShw.'" id="stsId'.$row->id.'"><span>'.$stsTex.'</span></div>',
				$actionBtn
            );
        
	 }	
        $return['recordsTotal'] = $this->setting->category_count();
        $return['recordsFiltered'] = $this->setting->category_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
   		}	
   public function set_category()
   {
        $getDetails=NULL;$post=$this->input->post();
		if($post['id']){$getDetails=$this->setting->details_category($post['id']);}
		if($post['category_typ']=='1'){$parentId='0';}else{$parentId=$post['main_cat'];}
	    if($post['unitActn']=='addCategory')
		 {
			 $cat_id='MSDRC'.date("ds");
			$createArr=array('parent_id'=>$parentId,'category'=>$post['cat_name'],'cat_id'=>$cat_id,'created_by'=>$this->logId,'create_date'=>date('Y-m-d H:i:s'));
			if($this->common->save_data('category_manage', $createArr))
			{$data = array('icon' => '1', 'text' =>'<i class="bx bx-smile"></i> Thank you! You have succesfully created unit details');}
			else{$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while creating details');}
			}	
	   else if($post['unitActn']=='view')
		{   
		    if($getDetails)
			{	
				if($getDetails->modify_date){$modifidt=date('H:i:s a d M Y',strtotime($getDetails->modify_date));}else{$modifidt='N/A';}
				$data=array('category'=>$getDetails->category,'createdBy'=>$getDetails->createdBy,'createCode'=>$getDetails->createCode,'catTyp'=>$getDetails->parent_id,
							'modifiedBy'=>$getDetails->modifiedBy,'modifiedId'=>$getDetails->modifiedId,'create_date'=>date('H:i:s a d M Y',strtotime($getDetails->create_date)),
							'modify_date'=>$modifidt);
				}
			else{$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is no any designation details found here');}
			}				
	else if($post['unitActn']=='edit')
		{
			$conArr=array('id'=>$post['id']);
			if($post['category_typ']=='1'){$parent_id='0';}else if($post['category_typ']=='2'){$parent_id=$post['main_cat'];}else{$parent_id=$post['main_cat'];}
			$upDtArr=array('category'=>$post['cat_name'],'parent_id'=>$parent_id,'modified_by'=>$this->logId,'modify_date'=>date('Y-m-d H:i:s'));
			if($this->common->update_data('category_manage',$conArr,$upDtArr))
			{$data = array('icon' => '1', 'text' =>'<i class="bx bx-smile"></i> Thank you! You have succesfully update designation details');}
			else{$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while updating details');}
			
			}	
	else if($post['unitActn']=='deleteCatDet')
   {
      if($getDetails->parent_id=='0')
       {$data=array('icon'=>'2','text'=>'<i class="mdi mdi-alert-outline me-2"></i> Are you sure want to delete #'.$getDetails->category.' then all sub category would be delete');}
	    else{$data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i>  Are You sure want to delete #'.$getDetails->category);}
		}		
		else if($post['unitActn']=='cnfDeleteCategory')
		{
		     $whereCon=array('id'=>$post['id'],'table'=>'category_manage');
			 $delDetails=$this->common->del_data($whereCon);
			 if($delDetails)
			 {
				 if($getDetails->parent_id=='0')
				{ 
					$delSubDetails=$this->common->del_data_con('category_manage','parent_id',$getDetails->id);
	 if($delSubDetails){$data=array('icon'=>'1','text'=>'<i class="bx bx-smile"></i> Thank You! you have successfully delete #'.$getDetails->category.' with all sub category');}
			        else{$data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems error while deleting #'.$getDetails->category);}	
				 	}
				  else{$data = array('icon' => '1', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Thank You! you have successfully delete #'.$getDetails->category);}
				 }
			 else{$data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems error while deleting #'.$getDetails->category);}			
			}
			else{$data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems no data access');}			
		  echo json_encode($data);
		} 	


public function package()
{
	    $data['title'] = 'Package Setting';
        $data['breadcrums'] = 'Package Setting';
        $data['layout'] = 'setting/package_manage.php';
        $this->load->view('super_admin/base', $data);
	}
public function package_data()
   {	
        $post_data = $this->input->post();
        $record = $this->setting->package_list($post_data);
	    $i = $post_data['start'] + 1;
        $return['data'] = array();
        foreach ($record as $row) {	
				$statusShw='statusPack=='.$row->status.'=='.$row->id;
				if($row->status=='1'){$stsTex='Active'; $activeCls='setBtn'; }else{$stsTex='Deactive';$activeCls='setBtnGr dctive'; }
					$getUid=urlencode(base64_encode($row->id));
			$actionBtn='<div style="text-align:center;"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#manage_package" data-id="vwPackDet==super_admin/setting/set_pack=='.$row->id.'"  class="btn btn-outline-warning btn-sm waves-effect btn-padd getAction" title="View"><i class="mdi mdi-eye"></i> </a>
				<a href="javascript:void(0)" class="btn btn-outline-success btn-sm waves-effect btn-padd getAction" data-id="edtPackDet==super_admin/setting/set_pack=='.$row->id.'"  data-bs-toggle="modal" data-bs-target="#manage_package"  title="Edit">
				<i class="mdi mdi-square-edit-outline me-1"></i> </a>
		<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm waves-effect btn-padd getAction" data-id="delPackDetails==super_admin/setting/set_pack=='.$row->id.'"  data-bs-toggle="modal" data-bs-target="#deleteModel" title="Delete">
				<i class="bx bxs-trash"></i> </a></div>';	
		    $return['data'][] = array(
                '<strong>'.$i++.'.</strong>',
                $row->pack_name,$row->pack_price,$row->b_volume,
               '<div class="'.$activeCls.' getAction" data-id="'.$statusShw.'" id="stsId'.$row->id.'"><span>'.$stsTex.'</span></div>',
				$actionBtn
            );
        
	 }	
        $return['recordsTotal'] = $this->setting->package_count();
        $return['recordsFiltered'] = $this->setting->package_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
   		}		


   public function set_pack()
   {
        $getDetails=NULL;$post=$this->input->post();
		if($post['id']){$getDetails=$this->setting->details_package($post['id']);}
	    if($post['unitActn']=='addPackage')
		 {
	$createArr=array('pack_name'=>$post['pack_name'],'pack_price'=>$post['pack_price'],'b_volume'=>$post['b_vol'],'created_by'=>$this->logId,'create_date'=>date('Y-m-d H:i:s'));
			if($this->common->save_data('package', $createArr))
			{$data = array('icon' => '1', 'text' =>'<i class="bx bx-smile"></i> Thank you! You have succesfully created package details');}
			else{$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while creating details');}
			}	
	   else if($post['unitActn']=='view')
		{   
		    if($getDetails)
			{	
				if($getDetails->modify_date){$modifidt=date('H:i:s a d M Y',strtotime($getDetails->modify_date));}else{$modifidt='N/A';}
				$data=array('pack_name'=>$getDetails->pack_name,'pack_price'=>$getDetails->pack_price,'createdBy'=>$getDetails->createdBy,'createCode'=>$getDetails->createCode,
							'modifiedBy'=>$getDetails->modifiedBy,'modifiedId'=>$getDetails->modifiedId,'create_date'=>date('H:i:s a d M Y',strtotime($getDetails->create_date)),
							'modify_date'=>$modifidt,'b_volume'=>$getDetails->b_volume);
				}
			else{$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is no any designation details found here');}
			}				
	else if($post['unitActn']=='edit')
		{
			$conArr=array('id'=>$post['id']);
		$upDtArr=array('pack_name'=>$post['pack_name'],'pack_price'=>$post['pack_price'],'b_volume'=>$post['b_vol'],'modified_by'=>$this->logId,'modify_date'=>date('Y-m-d H:i:s'));
			if($this->common->update_data('package',$conArr,$upDtArr))
			{$data = array('icon' => '1', 'text' =>'<i class="bx bx-smile"></i> Thank you! You have succesfully update package details');}
			else{$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while updating details');}
			
			}	
else if($post['unitActn']=='delPackDetails'){$data=array('icon'=>'2','text'=>'<i class="mdi mdi-alert-outline me-2"></i> Are You sure want to delete #'.$getDetails->pack_name);}		
		else if($post['unitActn']=='cnfDeleteCategory')
		{
		     $whereCon=array('id'=>$post['id'],'table'=>'package');
			 $delDetails=$this->common->del_data($whereCon);
			 if($delDetails){$data = array('icon' => '1', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Thank You! you have successfully delete #'.$getDetails->pack_name);}
			 else{$data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems error while deleting #'.$getDetails->pack_name);}			
			}
			else{$data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems no data access');}			
		  echo json_encode($data);
		} 



				
/***************************@mit End*******************************/	
	
	
}
