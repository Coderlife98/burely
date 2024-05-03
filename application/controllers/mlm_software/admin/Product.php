<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('upload','image_lib','user_agent'));
		$this->load->helper(array('form', 'email'));
		$this->load->model('mlm_software/admin/product_model', 'product');
		($this->session->userdata('user_id') == '') ? redirect(base_url(), 'refresh') : '';
		error_reporting(0);
		$this->baseUrl = base_url();
		$this->logId = $this->session->userdata('user_id');
	}
	public function manage()
	{
		$data['title'] = 'Product Manage Setting';
		$data['breadcrums'] = 'Product Manage Setting';
		$data['target'] = $this->baseUrl.'mlm_software/admin/product/set_product';
		$getMainCat = $this->common->getDataList('category_manage', 'id >', '0');
		$data['getMainCat'] = $getMainCat;
		$data['layout'] = 'mlm_software/admin/product/product_manage.php';
		$this->load->view('mlm_software/base', $data);
	}

	public function product_data()
	{
		$post_data = $this->input->post();
		$record = $this->product->product_data($post_data);
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		foreach ($record as $row) {
			$statusShw = 'statusCh==' . $row->status . '==' . $row->id;
			if ($row->status == '1') {
				$stsTex = 'Active';
				$activeCls = 'setBtn';
			} else {
				$stsTex = 'Deactive';
				$activeCls = 'setBtnGr dctive';
			}
			$getUid = urlencode(base64_encode($row->id));

			$actionBtn = '<div style="text-align:center;">
			<a href="javascript:void(0)" data-id="imgProDet==mlm_software/admin/product/set_product=='.$row->id.'=='.$row->product_name.'=='.$row->pro_img.'" class="btn btn-outline-primary btn-sm waves-effect btn-padd getAction" title="Image Upload"><i class="bx bx-camera"></i> </a>
			
			<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#manage_product" data-id="vwProDet==mlm_software/admin/product/set_product==' . $row->id . '"  class="btn btn-outline-warning btn-sm waves-effect btn-padd getAction" title="View"><i class="mdi mdi-eye"></i> </a>

				<a href="javascript:void(0)" class="btn btn-outline-success btn-sm waves-effect btn-padd getAction" data-id="edtProDet==mlm_software/admin/product/set_product==' . $row->id . '"  data-bs-toggle="modal" data-bs-target="#manage_product" title="Edit">
				<i class="mdi mdi-square-edit-outline me-1"></i> </a>

		<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm waves-effect btn-padd getAction" data-id="delProDetails==mlm_software/admin/product/set_product==' . $row->id . '" data-bs-toggle="modal" data-bs-target="#deleteModel" title="Delete">
				<i class="bx bxs-trash"></i> </a>
				</div>';

			$return['data'][] = array(

				'<strong>' . $i++ . '.</strong>',
				$row->prod_id,
				$row->product_name,
				$row->category,
				'<div class="' . $activeCls . ' getAction" data-id="' . $statusShw . '" id="stsId' . $row->id . '"><span>' . $stsTex . '</span></div>',
				$actionBtn
			);
		}
		$return['recordsTotal'] = $this->product->product_count();
		$return['recordsFiltered'] = $this->product->product_filter($post_data);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}

	
	public function set_product()
	{
		$getDetails=NULL;
		$post=$this->input->post();
		if($post['id']){$getDetails=$this->common->getRowData('product_table','id',$post['id']);}
		if($post['unitActn']=='addProduct')
		{
			
			$isExistDetails=$this->common->getRowData('product_table','product_name',$post['product_name']);
			if($isExistDetails){$data=array('icon'=>'2','text'=>'<i class="bx bx-cog bx-spin"></i> '.$post['product_name'].' is already exist');}
			else
			{
			$proId='MSDRP'.date("ds");
			$createArr = array(
								'prod_id'     => $proId,
								'product_name'=> $post['product_name'],
								'cat_id'      => $post['main_cat'],
								'created_by'  => $this->logId,
								'create_date' => date('Y-m-d H:i:s')
								);
			if ($this->common->save_data('product_table', $createArr))
			{$data=array('icon'=>'1','text'=>'<i class="bx bx-smile"></i> Thank you! You have succesfully created product details');}
			else{$data=array('icon'=>'2','text'=>'<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while creating details');}
				}
		}
		else if($post['unitActn']=='view')
		{
			if($getDetails)
			{
				if($getDetails->modify_date){$modifidt=date('H:i:s a d M Y', strtotime($getDetails->modify_date));} else{$modifidt='N/A';}
				$data=array('cat_id'=>$getDetails->cat_id,'product_name'=>$getDetails->product_name,'createdBy'=>$getDetails->createdBy,'createCode'=>$getDetails->createCode,
							'modifiedBy'=>$getDetails->modifiedBy,'modifiedId'=>$getDetails->modifiedId,'create_date'=>date('H:i:s a d M Y', strtotime($getDetails->create_date)),
							'modify_date' => $modifidt);
			} else {
				$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is no any product details found here');
			}
		} 
		else if ($post['unitActn'] == 'edit')
		{
			$conArr = array('id' => $post['id']);
			$upDtArr = array('product_name' => $post['product_name'], 'cat_id' => $post['main_cat'], 'modified_by' => $this->logId,'modify_date' => date('Y-m-d H:i:s'));
			if ($this->common->update_data('product_table', $conArr, $upDtArr)) {
				$data = array('icon' => '1', 'text' => '<i class="bx bx-smile"></i> Thank you! You have succesfully update product details');
			} else {
				$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while updating details');
			}
		}
		else if($post['unitActn']=='delProDetails')
		{$data=array('icon'=>'2','text'=>'<i class="mdi mdi-alert-outline me-2"></i> Are You sure want to delete # '.$getDetails->product_name);} 
		else if($post['unitActn']=='cnfDeleteProduct')
		{
			$whereCon=array('id'=>$post['id'],'table'=>'product_table');
			$delDetails=$this->common->del_data($whereCon);
			if($delDetails){$data=array('icon'=>'1','text'=>'<i class="bx bx-smile"></i> Thank You! you have successfully delete # '.$getDetails->product_name);}
			else{$data=array('icon'=>'2','text'=>'<i class="mdi mdi-alert-outline me-2"></i> Oops it seems error while deleting # '.$getDetails->product_name);}
		} 
		else if ($post['unitActn']=='imgProDet') 
		{
			$id=$this->input->post('pro_id');
			$getProData=$this->common->getRowData('product_table','id',$id);
			$getImgFl=$this->input->post('proImgFile');	
									
			$image_filename=NULL;
			$config=array('upload_path'=>"uploads/product/",'allowed_types'=>"jpg|png|jpeg|JPEG|JPG",'overwrite'=>FALSE,'encrypt_name'=>TRUE,'max_size'=>"10120000" );
			$this->load->library('upload',$config);$this->upload->initialize($config);	
			if($this->upload->do_upload('file'))
			{$image['image_upload']=array('upload_data' => $this->upload->data());$image_filename=$image['image_upload']['upload_data']['file_name'];}
				if($image_filename)
				{
					$config=NULL;$config['image_library'] = 'gd2';$config['source_image']  = 'uploads/product/'.$image_filename;
					$config['width']='220';$config['height']='180';$this->image_lib->initialize($config);$this->image_lib->resize();
					$updateDataArr=array('pro_img'=>'uploads/product/'.$image_filename,'modified_by'=>$this->logId,'modify_date'=>date('Y-m-d H:i:s'));
					$whereCon = array('id'=>$id);if($getProData->pro_img!='uploads/product/no_img.png'){unlink($getProData->pro_img);}	
					$result=$this->common->update_data('product_table',$whereCon,$updateDataArr);
					if($result)
					{	$msg='Thank you! You have successfully update document details';
						$data = array('class' => 'tst_success','text'=>$msg,'img_loc'=>'uploads/product/'.$image_filename);
						}
					else
					{
						$msg=array('Oops it seems server taking more time please refresh');$data=array('class'=>'tst_danger','text'=>$msg);
						}
						
				}else{$msg=array('Only .jpg,.png,.jpeg are accepted');$data=array('class'=>'tst_danger','text'=>$msg);}
			
			}
		else {$data=array('icon'=>'2','text'=>'<i class="mdi mdi-alert-outline me-2"></i> Oops it seems no data access');}
		echo json_encode($data);
	}


	public function status()
	{
		$post = explode("==", $this->input->post('id'));
		if ($post[0] == 'statusCh') {
			$conArr = array('id' => $post['2']);
			if ($post[1] == '1') {
				$status = '0';
			} else {
				$status = '1';
			}
			$upDtArr = array('status' => $status, 'modified_by' => $this->logId, 'modify_date' => date('Y-m-d H:i:s'));
			if ($this->common->update_data('product_table', $conArr, $upDtArr)) {
				$data = array('icon' => '1', 'text' => 'statusCh==' . $status . '==' . $post['2']);
			} else {
				$data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while updating details');
			}
		} else {
			$data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems no data access');
		}
		echo json_encode($data);
	}

	public function viewDetails($add = NULL)
	{


		if ($add == 'add') {
			$data['title'] = 'Add Product Details';
			$data['breadcrums'] = 'Add Product Details';
			$data['pDetails'] = $this->common->all_data('product_table', 'id,product_name');
			$data['pcategory'] = $this->common->all_data('category_manage', 'id,category');

			$data['unit'] = $this->common->all_data('unit_manage', 'id,unit_name');
			$data['target'] = 'admin/product/viewDetails';
			$data['layout'] = 'mlm_software/admin/product/add_product_details.php';
		} elseif ($add == 'edit') {
			$id = $this->uri->segment(6);
			$data['title'] = 'Edit Product Details';
			$data['breadcrums'] = 'Edit Product Details';
			$data['pDetails'] = $this->common->all_data('product_table', 'id,product_name,cat_id');
			$data['pcategory'] = $this->common->all_data('category_manage', 'id,category');
			$data['unit'] = $this->common->all_data('unit_manage', 'id,unit_name');
			$data['product'] = $this->product->get_product_data($id);
			$data['layout'] = 'mlm_software/admin/product/edit_product_details.php';
		}
		
		 else {
			$data['title'] = 'Product List';
			$data['breadcrums'] = 'Product List';
			// $this->product->get_product();
			$data['layout'] = 'mlm_software/admin/product/product_details.php';
		}
		// echo "hello";
		$this->load->view('mlm_software/base', $data);
	}

	public function product_details_data()
	{

		$post_data = $this->input->post();
		$record = $this->product->product_details_data($post_data);
		// print_r($record);
		// die;
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		foreach ($record as $row) {
			$statusShw = 'statusCh==' . $row->status . '==' . $row->id;
			if ($row->status == '1') {
				$stsTex = 'Active';
				$activeCls = 'setBtn';
			} else {
				$stsTex = 'Deactive';
				$activeCls = 'setBtnGr dctive';
			}
			$getUid = urlencode(base64_encode($row->id));

			$actionBtn = '<div style="text-align:center;">
			<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#manage_product" data-id="' . $row->id . '"  class="btn btn-outline-warning btn-sm waves-effect btn-padd view" onclick="view_pro(' . $row->id . ')" title="View"><i class="mdi mdi-eye"></i> </a>

				<a href="' . base_url() . 'mlm_software/admin/product/viewDetails/edit/' . $row->id . '" class="btn btn-outline-success btn-sm waves-effect btn-padd getAction"   title="Edit">
				<i class="mdi mdi-square-edit-outline me-1"></i> </a>

		<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm waves-effect btn-padd getAction" data-id="delProDetails==mlm_software/admin/product/==' . $row->id . '" data-bs-toggle="modal" data-bs-target="#deleteModel" title="Delete">
				<i class="bx bxs-trash"></i> </a>
				</div>';
				
				
				if($row->quantity < 100){$stock='<span style="color:#ce3000;font-weight: 600;">'.$row->quantity.'</span>';}
				else if($row->quantity < 500){$stock='<span style="color:#d07500;font-weight: 600;">'.$row->quantity.'</span>';}	
				else{$stock='<span style="color:#008e00;font-weight: 600;">'.$row->quantity.'</span>';}
				
			$return['data'][] = array(

				'<strong>' . $i++ . '.</strong>',
				$row->prod_id,
				/*$row->category,*/
				$row->product_name,
				$row->productBV,
				$row->mrp,
				$row->product_price,
				'<strong>'.$row->productTax.'</strong>',
				$stock,
				$actionBtn
			);
		}
		$return['recordsTotal'] = $this->product->product_detail_count();
		$return['recordsFiltered'] = $this->product->product_detail_filter($post_data);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}



	function add_product_data()
	{

		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('cat_id', 'Product Category', 'required');
			$this->form_validation->set_rules('pro_id', 'Product Name', 'required');
			$this->form_validation->set_rules('unit_id', 'Product Unit', 'required');
			$this->form_validation->set_rules('productBV', 'Product Business Volume', 'required');
			$this->form_validation->set_rules('productTax', 'Product Tax', 'required');
			$this->form_validation->set_rules('expDate', 'Expiry date', 'required');
			$this->form_validation->set_rules('mfgDate', 'manufacturing date', 'required');
			$this->form_validation->set_rules('pMrp', 'Mrp', 'required|numeric');
			if ($this->form_validation->run() == true ) {
				
				$val=$this->input->post();
				// uploding image end
			
					$dat = array(
						'prod_id'                  => $val['pro_id'],
						'unit'                     => $val['unit_id'],
						'product_price'            => $val['billing_price'],
						'mrp'                      => $val['pMrp'],
						'quantity'                 => $val['quantity'],
						'productBV'                => $val['productBV'],
						'productTax'               => $val['productTax'],
						'discount'                 => $val['discount'],
						'product_description'      => $val['editor1'],
						'exp_date'                 => $val['expDate'],
						'mfg_date'                 => $val['mfgDate'],
						'created_by'               => $this->session->userdata('user_id'),
						'create_date'              => date('Y-m-d H:m:s'),
						'modified_by'              => $this->session->userdata('user_id')
					);
					// print_r($dat);
					// die;
					$this->common->save_data('product_details', $dat);
					// print_r($dat)
					$data = array('text' => "successfully saved product details", 'icon' => 'success');

			} else {
				$msg = array(
					'cat_id'         => form_error('cat_id'),
					'unit_id'        => form_error('unit_id'),
					'billing_price'  => form_error('billing_price'),
					'pMrp'           => form_error('pMrp'),
					'productBV'      => form_error('productBV'),
					'productTax'     => form_error('productTax'),
					'expDate'        => form_error('expDate'),
					'mfgDate'        => form_error('mfgDate'),
					'image'          => (!empty($image['error'])) ? $image['error'] : '',

				);
				$data = array('text' => $msg, 'icon' => 'error');
			}
		} else {
			$msg = array('Something went wrong');
			$data = array('text' => $msg, 'icon' => 'error');
		}
		echo json_encode($data);
	}

	function update_product_details_data()
	{

		if ($this->input->is_ajax_request()) {

			$this->form_validation->set_rules('cat_id', 'Product Category', 'required');
			$this->form_validation->set_rules('pro_id', 'Product Name', 'required');
			$this->form_validation->set_rules('unit_id', 'Product Unit', 'required');
			$this->form_validation->set_rules('productBV', 'Product Business Volume', 'required');
			$this->form_validation->set_rules('productTax', 'Product Tax', 'required');
			$this->form_validation->set_rules('expDate', 'Expiry date', 'required');
			$this->form_validation->set_rules('mfgDate', 'manufacturing date', 'required');
			$this->form_validation->set_rules('pMrp', 'Mrp', 'required|numeric');

			if ($this->form_validation->run() == true ) {			
				$val = $this->input->post();				
					$dat = array(
						'prod_id'                  => $val['pro_id'],
						'unit'                     => $val['unit_id'],
						'product_price'            => $val['billing_price'],
						'mrp'                      => $val['pMrp'],
						'quantity'                 => $val['quantity'],
						'discount'                 => $val['discount'],
						'productBV'                => $val['productBV'],
						'productTax'               => $val['productTax'],
						'product_description'      => $val['editor1'],
						'exp_date'                 => $val['expDate'],
						'mfg_date'                 => $val['mfgDate'],
						'created_by'               => $this->session->userdata('user_id'),
						'create_date'              => date('Y-m-d H:m:s'),
						'modified_by'              => $this->session->userdata('user_id')
					);
					
				//print_r($dat);
				
					// echo $this->db->last_query();
					if($this->common->update_data('product_details', array('id'=>$val['id']), $dat)==true)
					{
						$data = array('text' => "Thank you! You have successfully update product details", 'icon' => 'success');
					}
					else{
						$msg=array('Oops it seems something went wrong please refresh ');
				   $data = array('text' => $msg, 'icon' => 'error');

					}

				
			} else {
				$msg = array(
					'cat_id'         => form_error('cat_id'),
					'unit_id'        => form_error('unit_id'),
					'billing_price'  => form_error('billing_price'),
					'pMrp'           => form_error('pMrp'),
					'productBV'      => form_error('productBV'),
					'productTax'      => form_error('productTax'),
					'expDate'        => form_error('expDate'),
					'mfgDate'        => form_error('mfgDate'),
					'pro_id'        => form_error('pro_id'),
					'image'          => (!empty($image['error'])) ? $image['error'] : '',

				);
				$data = array('text' => $msg, 'icon' => 'error');
			}
		} else {
			$msg = array('Something went wrong');
			$data = array('text' => $msg, 'icon' => 'error');
		}
		echo json_encode($data);
	}





	function upload_image($subpath,$img=false)
	{
		if(file_exists($img))
		{
          unlink($img);
		}
	   


		$config['upload_path']          = './uploads/' . $subpath;
		$config['allowed_types']        = 'gif|jpg|png';
		// $config['max_size']             = 100;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('image')) {
			$data =  array('error' => $this->upload->display_errors());
		} else {
			$data =  $this->upload->data();
		}
		return $data;
	}

	function delete_product_details($d=NULL)
	{
		if($d=='msg')
		{
			$id=$this->input->post('id');
			$data=$this->common->get_data('product_details',array('id'=>$id),'*');
			$data['text']="are you sure to delete this ".$data['id'];			

		}
		else
		{
			$id=$this->input->post('id');
			if($this->common->del_data_con('product_details',array('id'=>$id),'*'))
			{

				$data['text']="Deleted  data ".$id;	
				$data['icon']=1;		
			}
			else{
				$data['text']="something went wrong ".$id;	
					

			}


		}
		echo json_encode($data);
		

	}

	function get_category_data()
	{
		$cat_id = $this->input->post('cat_id');

		$con = array('cat_id' => $cat_id);
		$product = $this->common->all_data_con('product_table', $con, 'id,product_name');
		echo json_encode($product);
	}

	function get_product()
	{
		$id = $this->input->post('id');
		$data['product'] = $this->product->get_product_data($id);

		$this->load->view('mlm_software/admin/product/_view_product', $data);
	}
}
