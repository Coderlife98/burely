<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('super_admin/mlm_software/setting_model', 'setting_model');
        $this->load->model('super_admin/Common_model', 'Common_model');
        ($this->session->userdata('user_id') == '') ? redirect(base_url(), 'refresh') : '';
        $this->logId = $this->session->userdata('user_id');
        $this->lgCat = $this->session->userdata['user_cate'];
        error_reporting(0);
    }

    public function basic_setting()
    {
        $data['title'] = 'MLM Software Basic Setting';
        $data['breadcrums'] = 'MLM Software Basic Setting';
        $data['layout'] = 'mlm_software/setting/basic.php';
        $this->load->view('super_admin/base', $data);
    }

    //Basic Data Update
    public function basic_data($data)
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email ID', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('prefix', 'ID Prefix', 'trim|required|xss_clean');
            $this->form_validation->set_rules('currency_sign', 'Currency Sign', 'trim|required|xss_clean');
            $this->form_validation->set_rules('currency_code', 'Currency ISO Code', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
            if ($this->form_validation->run() == TRUE) {
                $post = $this->input->post();
                $file = '<?php
defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');

    # Basic Setting Details
    $config[\'mlm_company_name\'] = "' . $post['company_name'] . '";
    $config[\'mlm_mobile_number\'] = "' . $post['mobile'] . '";
    $config[\'mlm_email\'] = "' . $post['email'] . '";
    $config[\'mlm_prefix\'] = "' . $post['prefix'] . '";
    $config[\'mlm_currency_sign\'] = "' . $post['currency_sign'] . '";
    $config[\'mlm_currency_code\'] = "' . $post['currency_code'] . '";
    $config[\'mlm_address\'] = "' . $post['address'] . '";
    $config[\'mlm_logo_dark\'] = "' . config_item('mlm_logo_dark') . '";
    $config[\'mlm_logo_sm\'] = "' . config_item('mlm_logo_sm') . '";
    $config[\'mlm_logo_light\'] = "' . config_item('mlm_logo_light') . '";
    $config[\'mlm_logo_sm_light\'] = "' . config_item('mlm_logo_sm_light') . '";
    $config[\'mlm_dev_pass\'] = "' . config_item('mlm_dev_pass') . '";

?>';
                if (file_put_contents(APPPATH . 'config/mlm_software_setting.php', $file)) {
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
                    'prefix'        => form_error('prefix'),
                    'currency_sign' => form_error('currency_sign'),
                    'currency_code' => form_error('currency_code'),
                    'address'       => form_error('address'),
                );

                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);
        }
    }

    // Payout Update
    public function payout_data()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('fund', 'Allow User to Withdraw Fund', 'trim|required|xss_clean');
            $this->form_validation->set_rules('minimum_amt', 'Min amount allowed to Withdraw in(' . config_item('mlm_currency_sign') . ')', 'trim|required|xss_clean');
            $this->form_validation->set_rules('deduction_type', 'Payout Deduction Type', 'trim|required|xss_clean');
            $this->form_validation->set_rules('tds', 'TDS Charge', 'trim|required|xss_clean');
            $this->form_validation->set_rules('admin_charge', 'Admin Charge', 'trim|required|xss_clean');
            if ($this->form_validation->run() == TRUE) {
                $post = $this->input->post();
                $file = '<?php
defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');

    # Basic Setting Details
    $config[\'mlm_withdraw_fund\'] = "' . $post['fund'] . '";
    $config[\'mlm_withdraw_amt\'] = "' . $post['minimum_amt'] . '";
    $config[\'mlm_deduction_type\'] = "' . $post['deduction_type'] . '";
    $config[\'mlm_tds\'] = "' . $post['tds'] . '";
    $config[\'mlm_admin_charge\'] = "' . $post['admin_charge'] . '";

?>';
                if (file_put_contents(APPPATH . 'config/mlm_payout.php', $file)) {
                    $data = array('icon' => 'success', 'text' => 'Data Updated Successfully');
                } else {
                    $msgs = array('Some Error Occur Please Re-Update');
                    $data = array('icon' => 'error', 'text' => $msgs);
                }
            } else {
                $msg =  array(
                    'fund'          => form_error('fund'),
                    'minimum_amt'   => form_error('minimum_amt'),
                    'deduction_type' => form_error('deduction_type'),
                    'tds'           => form_error('tds'),
                    'admin_charge'  => form_error('admin_charge'),
                );

                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);
        }
    }


    // SMTP Update
    public function smtp_data()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('host', 'SMTP Host', 'trim|required|xss_clean');
            $this->form_validation->set_rules('username', 'SMTP User Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'SMTP Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('port', 'SMTP Port (SSl Only)', 'trim|required|xss_clean');
            if ($this->form_validation->run() == TRUE) {
                $post = $this->input->post();
                $file = '<?php
defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');

    # Basic Setting Details
    $config[\'mlm_host\'] = "' . $post['host'] . '";
    $config[\'mlm_username\'] = "' . $post['username'] . '";
    $config[\'mlm_password\'] = "' . $post['password'] . '";
    $config[\'mlm_port\'] = "' . $post['port'] . '";

?>';
                if (file_put_contents(APPPATH . 'config/mlm_smtp.php', $file)) {
                    $data = array('icon' => 'success', 'text' => 'Data Updated Successfully');
                } else {
                    $msgs = array('Some Error Occur Please Re-Update');
                    $data = array('icon' => 'error', 'text' => $msgs);
                }
            } else {
                $msg =  array(
                    'host'      => form_error('host'),
                    'username'  => form_error('username'),
                    'password'  => form_error('password'),
                    'port'      => form_error('port'),
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
                $filename = "mlm-logo-dark";
                $config['upload_path']          = './media/images/';
                $config['allowed_types']        = 'jpg|jpeg|png';
                $config['max_size']             = 2048;
                $config['file_name']            = $filename;

                $this->load->library('upload', $config);

                unlink('media/images/' . config_item('mlm_logo_dark'));
                if (!$this->upload->do_upload('dark_logo')) {
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    echo json_encode($data);
                    die;
                } else {
                    $doc_data = $this->upload->data();
                    $dark_logo = $doc_data['raw_name'] . $doc_data['file_ext'];
                    //print_r($val);die;
                    $data = array('text' => "Dark Logo Updated Successfully !", 'icon' => "success");
                }
                $file = '<?php
defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');

    # Basic Setting Details
    $config[\'mlm_company_name\'] = "' . config_item('mlm_company_name') . '";
    $config[\'mlm_mobile_number\'] = "' . config_item('mlm_mobile') . '";
    $config[\'mlm_email\'] = "' . config_item('mlm_email') . '";
    $config[\'mlm_prefix\'] = "' . config_item('mlm_prefix') . '";
    $config[\'mlm_currency_sign\'] = "' . config_item('mlm_currency_sign') . '";
    $config[\'mlm_currency_code\'] = "' . config_item('mlm_currency_code') . '";
    $config[\'mlm_address\'] = "' . config_item('mlm_address') . '";
    $config[\'mlm_logo_dark\'] = "' . $dark_logo . '";
    $config[\'mlm_logo_sm\'] = "' . config_item('mlm_logo_sm') . '";
    $config[\'mlm_logo_light\'] = "' . config_item('mlm_logo_light') . '";
    $config[\'mlm_logo_sm_light\'] = "' . config_item('mlm_logo_sm_light') . '";
    $config[\'mlm_dev_pass\'] = "' . config_item('mlm_dev_pass') . '";
?>';
                if (file_put_contents(APPPATH . 'config/mlm_software_setting.php', $file)) {
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
                $filename = "mlm-logo-sm";
                $config['upload_path']          = './media/images/';
                $config['allowed_types']        = 'jpg|jpeg|png';
                $config['max_size']             = 2048;
                $config['file_name']            = $filename;

                $this->load->library('upload', $config);

                unlink('media/images/' . config_item('mlm_logo_sm'));
                if (!$this->upload->do_upload('dark_favicon')) {
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    echo json_encode($data);
                    die;
                } else {
                    $doc_data = $this->upload->data();
                    $dark_fav = $doc_data['raw_name'] . $doc_data['file_ext'];
                    //print_r($val);die;
                    $data = array('text' => "Dark Favicon Updated Successfully !", 'icon' => "success");
                }
                $file = '<?php
defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');

    # Basic Setting Details
    $config[\'mlm_company_name\'] = "' . config_item('mlm_company_name') . '";
    $config[\'mlm_mobile_number\'] = "' . config_item('mlm_mobile') . '";
    $config[\'mlm_email\'] = "' . config_item('mlm_email') . '";
    $config[\'mlm_prefix\'] = "' . config_item('mlm_prefix') . '";
    $config[\'mlm_currency_sign\'] = "' . config_item('mlm_currency_sign') . '";
    $config[\'mlm_currency_code\'] = "' . config_item('mlm_currency_code') . '";
    $config[\'mlm_address\'] = "' . config_item('mlm_address') . '";
    $config[\'mlm_logo_dark\'] = "' . config_item('mlm_logo_dark') . '";
    $config[\'mlm_logo_sm\'] = "' . $dark_fav . '";
    $config[\'mlm_logo_light\'] = "' . config_item('mlm_logo_light') . '";
    $config[\'mlm_logo_sm_light\'] = "' . config_item('mlm_logo_sm_light') . '";
    $config[\'mlm_dev_pass\'] = "' . config_item('mlm_dev_pass') . '";
?>';
                if (file_put_contents(APPPATH . 'config/mlm_software_setting.php', $file)) {
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
                $filename = "mlm-logo-light";
                $config['upload_path']          = './media/images/';
                $config['allowed_types']        = 'jpg|jpeg|png';
                $config['max_size']             = 2048;
                $config['file_name']            = $filename;

                $this->load->library('upload', $config);

                unlink('media/images/' . config_item('mlm_logo_light'));
                if (!$this->upload->do_upload('light_logo')) {
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    echo json_encode($data);
                    die;
                } else {
                    $doc_data = $this->upload->data();
                    $light_logo = $doc_data['raw_name'] . $doc_data['file_ext'];
                    //print_r($val);die;
                    $data = array('text' => "Light Logo Updated Successfully !", 'icon' => "success");
                }
                $file = '<?php
defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');
    
    # Basic Setting Details
    $config[\'mlm_company_name\'] = "' . config_item('mlm_company_name') . '";
    $config[\'mlm_mobile_number\'] = "' . config_item('mlm_mobile') . '";
    $config[\'mlm_email\'] = "' . config_item('mlm_email') . '";
    $config[\'mlm_prefix\'] = "' . config_item('mlm_prefix') . '";
    $config[\'mlm_currency_sign\'] = "' . config_item('mlm_currency_sign') . '";
    $config[\'mlm_currency_code\'] = "' . config_item('mlm_currency_code') . '";
    $config[\'mlm_address\'] = "' . config_item('mlm_address') . '";
    $config[\'mlm_logo_dark\'] = "' . config_item('mlm_logo_dark') . '";
    $config[\'mlm_logo_sm\'] = "' . config_item('mlm_logo_sm') . '";
    $config[\'mlm_logo_light\'] = "' . $light_logo . '";
    $config[\'mlm_logo_sm_light\'] = "' . config_item('mlm_logo_sm_light') . '";
    $config[\'mlm_dev_pass\'] = "' . config_item('mlm_dev_pass') . '";
?>';
                if (file_put_contents(APPPATH . 'config/mlm_software_setting.php', $file)) {
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
                $filename = "mlm-logo-sm-light";
                $config['upload_path']          = './media/images/';
                $config['allowed_types']        = 'jpg|jpeg|png';
                $config['max_size']             = 2048;
                $config['file_name']            = $filename;

                $this->load->library('upload', $config);

                unlink('media/images/' . config_item('mlm_logo_sm_light'));
                if (!$this->upload->do_upload('light_favicon')) {
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    echo json_encode($data);
                    die;
                } else {
                    $doc_data = $this->upload->data();
                    $light_favicon = $doc_data['raw_name'] . $doc_data['file_ext'];
                    //print_r($val);die;
                    $data = array('text' => "Light Logo Updated Successfully !", 'icon' => "success");
                }
                $file = '<?php
defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');

    # Basic Setting Details
    $config[\'mlm_company_name\'] = "' . config_item('mlm_company_name') . '";
    $config[\'mlm_mobile_number\'] = "' . config_item('mlm_mobile') . '";
    $config[\'mlm_email\'] = "' . config_item('mlm_email') . '";
    $config[\'mlm_prefix\'] = "' . config_item('mlm_prefix') . '";
    $config[\'mlm_currency_sign\'] = "' . config_item('mlm_currency_sign') . '";
    $config[\'mlm_currency_code\'] = "' . config_item('mlm_currency_code') . '";
    $config[\'mlm_address\'] = "' . config_item('mlm_address') . '";
    $config[\'mlm_logo_dark\'] = "' . config_item('mlm_logo_dark') . '";
    $config[\'mlm_logo_sm\'] = "' . config_item('mlm_logo_sm') . '";
    $config[\'mlm_logo_light\'] = "' . config_item('mlm_logo_light') . '";
    $config[\'mlm_logo_sm_light\'] = "' . $light_favicon . '";
    $config[\'mlm_dev_pass\'] = "' . config_item('mlm_dev_pass') . '";
?>';
                if (file_put_contents(APPPATH . 'config/mlm_software_setting.php', $file)) {
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

    public function advance_setting()
    {
        $whereCon = array('id' => 1);
        $data['title'] = 'MLM Software Advance Setting';
        $data['breadcrums'] = 'MLM Software Advance Setting';
        $data['rank_list'] = $this->Common_model->all_data_list('rank_system', '*'); //Added By
        $data['getFunds'] = $this->Common_model->get_data('club_income', $whereCon, '*'); //Added 


        $data['layout'] = 'mlm_software/setting/advance.php';
        $this->load->view('super_admin/base', $data);
    }

    public function advance_data()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('leg', 'How Many Leg to Show in Tree ? ', 'trim|required|xss_clean');
            $this->form_validation->set_rules('dev_pass', 'Developer Password', 'trim|required|xss_clean');
            if ($this->form_validation->run() == TRUE) {
                $post           = $this->input->post();
                if ($post['dev_pass'] === config_item('mlm_dev_pass')) {
                    $reg_free       = empty($post['reg_free']) ? 0 : $post['reg_free'];
                    $epin           = empty($post['epin']) ? 0 : $post['epin'];
                    $registration   = empty($post['registration']) ? 0 : $post['registration'];
                    $topup          = empty($post['topup']) ? 0 : $post['topup'];
                    $income         = empty($post['income']) ? 0 : $post['income'];
                    $leg_option     = empty($post['leg_option']) ? 0 : $post['leg_option'];
                    $product        = empty($post['product']) ? 0 : $post['product'];
                    $placement      = empty($post['placement']) ? 0 : $post['placement'];
                    $fix_income     = empty($post['fix_income']) ? 0 : $post['fix_income'];
                    $delivered      = empty($post['delivered']) ? 0 : $post['delivered'];
                    $leg            = empty($post['leg']) ? 0 : $post['leg'];

                    $file = '<?php
defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');

    # Advance Setting Details
    $config[\'mlm_registration_free\'] = "' . $reg_free . '";     #Is registration is free ?
    $config[\'mlm_e-pin\'] = "' . $epin . '";                     #Want to enable e-PIN ?
    $config[\'mlm_registration\'] = "' . $registration . '";      #Stop New Member Registration ?
    $config[\'mlm_topup_option\'] = "' . $topup . '";             #Want to enable Top-Up Options ?
    $config[\'mlm_topup_income\'] = "' . $income . '";            #Want to Give Income when Top-Up ?
    $config[\'mlm_leg_option\'] = "' . $leg_option . '";          #Want to show Leg Select Option at Sign Up form ?
    $config[\'mlm_joining_product\'] = "' . $product . '";        #Want to show Joining Products at Registration form ?
    $config[\'mlm_placement_id_option\'] = "' . $placement . '";   #Want to show Placement ID Option at Sign Up form ?
    $config[\'mlm_fix_income\'] = "' . $fix_income . '";          #Give Fix Income (Not Product/Service Based Income) ?
    $config[\'mlm_product_delivered\'] = "' . $delivered . '";    #Automatically mark registration products as Delivered ?
    $config[\'mlm_leg\'] = "' . $leg . '";    #Automatically mark registration products as Delivered ?
    
    #Enable/Disable Module
    $config[\'mlm_survey_module\'] = "' . config_item('mlm_survey_module') . '";                    #Enable Survey ?
    $config[\'mlm_coupon_module\'] = "' . config_item('mlm_coupon_module') . '";                    #Enable Coupon ?
    $config[\'mlm_investment_module\'] = "' . config_item('mlm_investment_module') . '";            #Investment Type ?
    $config[\'mlm_investment_plan_module\'] = "' . config_item('mlm_investment_plan_module') . '";  #Investment Plan ?
    $config[\'mlm_rewards_module\'] = "' . config_item('mlm_rewards_module') . '";                  #Enable Investment Plan ?
    $config[\'mlm_recharge_module\'] = "' . config_item('mlm_recharge_module') . '";                #Enable Rewards Module?
    $config[\'mlm_product_module\'] = "' . config_item('mlm_product_module') . '";                  #Enable Recharge Module ?
    $config[\'mlm_repurchase_module\'] = "' . config_item('mlm_repurchase_module') . '";            #Enable Product & Services ?
    $config[\'mlm_advertisment_module\'] = "' . config_item('mlm_advertisment_module') . '";         #Enable Repurchase System ?
?>';
                    if (file_put_contents(APPPATH . 'config/mlm_software_advance_setting.php', $file)) {
                        $data = array('icon' => 'success', 'text' => 'Data Updated Successfully');
                    } else {
                        $msgs = array('Some Error Occur Please Re-Update');
                        $data = array('icon' => 'error', 'text' => $msgs);
                        echo json_encode($data);
                        die;
                    }
                } else {
                    $msg =  array('!Opps Please Check Developer Password');

                    $data = array('icon' => 'error', 'text' => $msg);
                    echo json_encode($data);
                    die;
                }
            } else {
                $msg =  array(
                    'leg'       => form_error('leg'),
                    'dev_pass'  => form_error('dev_pass'),
                );

                $data = array('icon' => 'error', 'text' => $msg);
            }

            echo json_encode($data);
        }
    }



    public function module_data()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('dev_pass', 'Developer Password', 'trim|required|xss_clean');
            if ($this->form_validation->run() == TRUE) {
                $post           = $this->input->post();
                // print_r($post);die;
                if ($post['dev_pass'] === config_item('mlm_dev_pass')) {
                    $survey         = empty($post['survey']) ? 0 : $post['survey'];
                    $coupon         = empty($post['coupon']) ? 0 : $post['coupon'];
                    $investment     = empty($post['investment']) ? 0 : $post['investment'];
                    $investment_plan = empty($post['investment_plan']) ? 0 : $post['investment_plan'];
                    $rewards        = empty($post['rewards']) ? 0 : $post['rewards'];
                    $recharge       = empty($post['recharge']) ? 0 : $post['recharge'];
                    $product        = empty($post['product']) ? 0 : $post['product'];
                    $repurchase     = empty($post['repurchase']) ? 0 : $post['repurchase'];
                    $advertisement  = empty($post['advertisement']) ? 0 : $post['advertisement'];

                    $file = '<?php
defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');

    # Advance Setting Details
    $config[\'mlm_registration_free\'] = "' . config_item('mlm_registration_free') . '";    #Is registration is free ?
    $config[\'mlm_e-pin\'] = "' . config_item('mlm_e-pin') . '";                            #Want to enable e-PIN ?
    $config[\'mlm_registration\'] = "' . config_item('mlm_registration') . '";              #Stop New Member Registration ?
    $config[\'mlm_topup_option\'] = "' . config_item('mlm_topup_option') . '";              #Want to enable Top-Up Options ?
    $config[\'mlm_topup_income\'] = "' . config_item('mlm_topup_income') . '";              #Want to Give Income when Top-Up ?
    $config[\'mlm_leg_option\'] = "' . config_item('mlm_leg_option') . '";                  #Want to show Leg Select Option at Sign Up form ?
    $config[\'mlm_joining_product\'] = "' . config_item('mlm_joining_product') . '";        #Want to show Joining Products at Registration form ?
    $config[\'mlm_placement_id_option\'] = "' . config_item('mlm_placement_id_option') . '"; #Want to show Placement ID Option at Sign Up form ?
    $config[\'mlm_fix_income\'] = "' . config_item('mlm_fix_income') . '";                  #Give Fix Income (Not Product/Service Based Income) ?
    $config[\'mlm_product_delivered\'] = "' . config_item('mlm_product_delivered') . '";    #Automatically mark registration products as Delivered ?
    $config[\'mlm_leg\'] = "' . config_item('mlm_leg') . '";                                #Automatically mark registration products as Delivered ?
    
    #Enable/Disable Module
    $config[\'mlm_survey_module\'] = "' . $survey . '";                    #Enable Survey ?
    $config[\'mlm_coupon_module\'] = "' . $coupon . '";                    #Enable Coupon ?
    $config[\'mlm_investment_module\'] = "' . $investment . '";            #Investment Type ?
    $config[\'mlm_investment_plan_module\'] = "' . $investment_plan . '";  #Investment Plan ?
    $config[\'mlm_rewards_module\'] = "' . $rewards . '";                  #Enable Investment Plan ?
    $config[\'mlm_recharge_module\'] = "' . $recharge . '";                #Enable Rewards Module?
    $config[\'mlm_product_module\'] = "' . $product . '";                  #Enable Recharge Module ?
    $config[\'mlm_repurchase_module\'] = "' . $repurchase . '";            #Enable Product & Services ?
    $config[\'mlm_advertisment_module\'] = "' . $advertisement . '";        #Enable Repurchase System ?
?>';
                    if (file_put_contents(APPPATH . 'config/mlm_software_advance_setting.php', $file)) {
                        $data = array('icon' => 'success', 'text' => 'Data Updated Successfully');
                    } else {
                        $msgs = array('Some Error Occur Please Re-Update');
                        $data = array('icon' => 'error', 'text' => $msgs);
                        echo json_encode($data);
                        die;
                    }
                } else {
                    $msg =  array('!Opps Please Check Developer Password');

                    $data = array('icon' => 'error', 'text' => $msg);
                    echo json_encode($data);
                    die;
                }
            } else {
                $msg =  array(
                    'dev_pass'  => form_error('dev_pass'),
                );

                $data = array('icon' => 'error', 'text' => $msg);
            }

            echo json_encode($data);
        }
    }
    /*--------------------code By @Mi-------------------------------*/
    public function designation()
    {
        $data['title'] = 'MLM Software Designation Setting';
        $data['breadcrums'] = 'MLM Software Designation Setting';
        $data['layout'] = 'mlm_software/setting/_designation_list.php';
        $this->load->view('super_admin/base', $data);
    }
    public function designation_data()
    {

        $post_data = $this->input->post();
        $record = $this->setting_model->desgination_list($post_data);
        $i = $post_data['start'] + 1;
        $return['data'] = array();
        foreach ($record as $row) {
            $getUid = urlencode(base64_encode($row->id));
            $actionBtn = '<div style="text-align:center;"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#emp_designation" data-id="vwDesig-super_admin/mlm_software/setting/set_designation/-' . $row->id . '"  class="btn btn-outline-warning btn-sm waves-effect btn-padd getAction" title="View"><i class="mdi mdi-eye"></i> </a>
				<a href="javascript:void(0)" class="btn btn-outline-success btn-sm waves-effect btn-padd getAction" data-id="edtDesig-super_admin/mlm_software/setting/set_designation/-' . $row->id . '"  data-bs-toggle="modal" data-bs-target="#emp_designation"  title="Edit">
				<i class="mdi mdi-square-edit-outline me-1"></i> </a>
		<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm waves-effect btn-padd getAction" data-id="delDesig-super_admin/mlm_software/setting/set_designation/-' . $row->id . '"  data-bs-toggle="modal" data-bs-target="#designation_delete" title="Delete">
				<i class="bx bxs-trash"></i> </a></div>';
            $return['data'][] = array(
                '<strong>' . $i++ . '.</strong>',
                $row->des_title,
                $row->payscale,
                $actionBtn
            );
        }
        $return['recordsTotal'] = $this->setting_model->desgination_count();
        $return['recordsFiltered'] = $this->setting_model->desgination_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
    }


    public function set_designation()
    {
        $getDetails = NULL;
        $post = $this->input->post();
        if ($post['id']) {
            $getDetails = $this->setting_model->details_designstion($post['id']);
        }
        if ($post['designActn'] == 'view') {
            if ($getDetails) {
                if ($getDetails->modify_date) {
                    $modifidt = date('H:s:i a d M Y', strtotime($getDetails->modify_date));
                } else {
                    $modifidt = 'N/A';
                }
                $data = array(
                    'des_title' => $getDetails->des_title, 'payscale' => $getDetails->payscale, 'createdBy' => $getDetails->createdBy, 'createCode' => $getDetails->createCode,
                    'modifiedBy' => $getDetails->modifiedBy, 'modifiedId' => $getDetails->modifiedId, 'create_date' => date('H:s:i a d M Y', strtotime($getDetails->create_date)),
                    'modify_date' => $modifidt
                );
            } else {
                $data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is no any designation details found here');
            }
        } else if ($post['designActn'] == 'edit') {
            $conArr = array('id' => $post['id']);
            $upDtArr = array('des_title' => $post['designationN'], 'payscale' => $post['pyscale'], 'modified_by' => $this->logId, 'modify_date' => date('Y-m-d H:i:s'));
            if ($this->common->update_data('employee_designation', $conArr, $upDtArr)) {
                $data = array('icon' => '1', 'text' => '<i class="bx bx-smile"></i> Thank you! You have succesfully update designation details');
            } else {
                $data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while updating details');
            }
        } else if ($post['designActn'] == 'addDesignsn') {
            $createArr = array('des_title' => $post['designationN'], 'payscale' => $post['pyscale'], 'created_by' => $this->logId, 'create_date' => date('Y-m-d H:i:s'));
            if ($this->common->save_data('employee_designation', $createArr)) {
                $data = array('icon' => '1', 'text' => '<i class="bx bx-smile"></i> Thank you! You have succesfully created designation details');
            } else {
                $data = array('icon' => '2', 'text' => '<i class="bx bx-cog bx-spin"></i> Oops it seems there is an error while creating details');
            }
        } else if ($post['designActn'] == 'deleteDesignsn') {
            $data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i>  Are You sure want to delete #' . $getDetails->des_title);
        } else if ($post['designActn'] == 'cnfDeleteDesignsn') {
            $whereCon = array('id' => $post['id'], 'table' => 'employee_designation');
            $delDetails = $this->common->del_data($whereCon);
            if ($delDetails) {
                $data = array('icon' => '1', 'text' => '<i class="bx bx-smile"></i>  Thank You! you have successfully delete #' . $getDetails->des_title);
            } else {
                $data = array('icon' => '2', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems error while deleting #' . $getDetails->des_title);
            }
        }

        echo json_encode($data);
    }


    /*--------------------code By @Mi-------------------------------*/

    // israel
    public function misc_manage()
    {
        $post = $this->input->post();
       
        $whereCon = array('id' => '1'); 
               /*print_r($updateArr);echo '<br>';print_r($post);*/
			   $genInc=$post['first_gen_incom']+$post['second_gen_incom']+$post['third_gen_incom']+$post['four_gen_incom'];
			   $rePurInc=$post['first_repurchase_incom']+$post['second_repurchase_incom']+$post['third_repurchase_incom']+$post['four_repurchase_incom'];
        $updateArr = array(
            'first_repurchase'           => $post['actMsalE'],
            'scnd_repurchase'            => $post['inMsalE'],
            'thrd_repurchase'            => $post['penFE'],
            'forth_repurchase'           => $post['maFE'],
            'withdrableAmt'              => $post['gdwfE'],
            'tax'                        => $post['cw_fE'],
            'admin_fee'                  => $post['admfeeE'],
			'shipping_charges'           => $post['shipInE'],
            'generation_income'          => $genInc,
            'sponsor_income'             => $post['sponsorInc'],
			'first_gen_incom'            => $post['first_gen_incom'],
            'second_gen_incom'           => $post['second_gen_incom'],
            'third_gen_incom'            => $post['third_gen_incom'],
            'four_gen_incom'             => $post['four_gen_incom'],
            'repurchase_incom'           => $rePurInc,
            'first_repurchase_incom'     => $post['first_repurchase_incom'],
            'second_repurchase_incom'    => $post['second_repurchase_incom'],
            'third_repurchase_incom'     => $post['third_repurchase_incom'],
            'four_repurchase_incom'      => $post['four_repurchase_incom'],
            'modified_by'                => $this->logId,
            'modified_date'              => date("Y-m-d H:i:s")
        );
/*         print_r($updateArr);
       die;*/
        $updateR = $this->Common_model->update_data('club_income', $whereCon, $updateArr);
        
       
        if ($updateR) {
            $data['clubI'] = $this->Common_model->get_data('club_income', $whereCon, '*');
           
            $data['msg'] = array('icon' => 'success', 'text' => 'Data Updated Successfully');
        } else {
            $data['msg'] = array('icon' => 'warning', 'text' => "Ooop's Something Wrong While Updatting Date");
        }
       

        echo json_encode($data);
    }



    public function getRanks()
    {
        $id = $this->input->post('id');
        $wehereCon = array('id' => $id);
        $getRecords = $this->Common_model->get_data('rank_system', $wehereCon, '*');
        echo json_encode($getRecords);
    }

    public function setRanks()
    {
        $post = $this->input->post();
        $wehereCon = array('id' => $post['id']);
        $updateArr = array(
            'reward_name'     => $post['rankName'],
            'member_goal'     => $post['memberGoal'],
            'income'          => $post['income'],
            'other_reward'    => $post['otherIncome'],
            'monthly_income'  => $post['monthlyReward'],
            'membership_type'  => $post['membershipTyp'],
            'modify_date'      => date('Y-m-d H:i:s'),
            'modify_by'        => $this->logId
        );
        $getResults = $this->Common_model->update_data('rank_system', $wehereCon, $updateArr);
        if ($getResults) {
            echo '1';
        } else {
            echo '2';
        }
    }
}
