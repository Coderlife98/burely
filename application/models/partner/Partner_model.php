<?php
class Partner_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
/*-----------------------27.07.2023 start---------------------------------*/
	public function validate_loggedIn($userN,$passW,$userTyp)
	{
		$this->db->from('partners');
		$this->db->where('username',$userN);
		$this->db->where('password',md5($passW));
		$this->db->where('user_typ',$userTyp);				   
		$result=$this->db->get();
		return $result->row();
		}  	
/*-----------------------27.07.2023 end---------------------------------*/		
####################################################################

public function admin_profile($id)
{
	return $this->db->select('u.id,user_code as username,name,photo as my_img,address,state,district,mobile,email,zipcode, s.state_cities as stN, c.state_cities as ctyN')->from('users as u')->where('u.id', $id)->join('states_cities as s', 's.id=u.state', 'left')->join('states_cities as c', 'c.id=u.district', 'left')->get()->row();
	}
	
public function profile_details($id)
{
	return $this->db->select('m.id,m.user_typ,m.assigned_seller,m.username,m.name,m.shop_name,m.gender,m.email,m.mobile,m.address,m.my_img,m.status,m.create_date,m.shw_pass,stt.state_cities as stN,cty.state_cities as ctyN, b.mem_id,b.date_of_birth,b.state,b.district,b.zipcode,b.gst_number,b.pan_nu,b.aadhaar_nu,b.bank_name,b.bank_ac_no,b.bankBrName,b.bank_Ifsc, b.bankBrName,b.btc_address, b.nominee_name,b.nominee_address,b.nominee_relationship,b.pan_img,b.adhar_img,b.passbook_img')->from('partners as m')->where('m.id', $id)->join('partners_basic_manage as b', 'b.mem_id=m.id', 'left')->join('states_cities as stt', 'stt.id=b.state', 'left')->join('states_cities as cty', 'cty.id=b.district', 'left')->get()->row();
	}
public function profile_details_by_username($id)
{
	return $this->db->select('m.id,m.user_typ,m.assigned_seller,m.username,m.name,m.shop_name,m.gender,m.email,m.mobile,m.address,m.my_img,m.status,m.create_date,m.shw_pass,stt.state_cities as stN,cty.state_cities as ctyN, b.mem_id,b.date_of_birth,b.state,b.district,b.zipcode,b.gst_number,b.pan_nu,b.aadhaar_nu,b.bank_name,b.bank_ac_no,b.bankBrName,b.bank_Ifsc, b.bankBrName,b.btc_address, b.nominee_name,b.nominee_address,b.nominee_relationship,b.pan_img,b.adhar_img,b.passbook_img')->from('partners as m')->where('m.username', $id)->join('partners_basic_manage as b', 'b.mem_id=m.id', 'left')->join('states_cities as stt', 'stt.id=b.state', 'left')->join('states_cities as cty', 'cty.id=b.district', 'left')->get()->row();
	}	
	
	
    public function process_shopee_list($where = false, $frenchiseId)
    {
        $field = array('id', 'name', 'email', 'mobile', 'address', 'status', 'username');
        $i = 0;
        foreach ($field as $item) {
            if (!empty($where['search']['value'])) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $where['search']['value']);
                } else {
                    $this->db->or_like($item, $where['search']['value']);
                }
                if (count($field) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        $this->db->select('id,name,email,mobile,address,status,username,my_img')->from('partners')->where('created_type','2')->where('created_by',$frenchiseId);
    /*    if ($uTyp) {
            $this->db->where('user_typ', $uTyp);
        }
        if (!empty($where['userIdA'])) {
            $this->db->where('username', $where['userIdA']);
        }
        if (!empty($where['mobileN'])) {
            $this->db->where('mobile', $where['mobileN']);
        }
        if (!empty($where['emailId'])) {
            $this->db->where('email', $where['emailId']);
        }
        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('create_date >=', $where['strtDt']);
            $this->db->where('create_date <=', $where['endDt']);
        }*/

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }

    public function shopee_data($where = false, $frenchiseId)
    {
        $this->process_shopee_list($where, $frenchiseId);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function shopee_count($frenchiseId)
    {
        $this->process_shopee_list($where = false, $frenchiseId);
        return $this->db->get()->num_rows();
    }
    public function shopee_filter($where = false, $frenchiseId)
    {
        $this->process_shopee_list($where, $frenchiseId);
        return $this->db->get()->num_rows();
    }	
public function getFrenchiseStateWiseDetails($id)
{
	return $this->db->select('p.id,username,name')->from('partners_basic_manage as shopi')->where('shopi.mem_id', $id)->where('p.user_typ', '1')->join('partners_basic_manage as frenBasic', 'frenBasic.state=shopi.state', 'left')->join('partners as p', 'p.id=frenBasic.mem_id', 'left')->join('states_cities as stt', 'stt.id=shopi.state', 'left')->join('states_cities as cty', 'cty.id=frenBasic.district', 'left')->get()->result();
	}	
public function getSelectedFrenchiseStateWiseData($id)
{
return $this->db->select('p.id,username,name,zipcode,address,mobile,email,my_img,stt.state_cities as stN,cty.state_cities as ctyN')->from('partners as p')->where('p.id', $id)->join('partners_basic_manage as basic', 'basic.mem_id=p.id', 'left')->join('states_cities as stt', 'stt.id=basic.state', 'left')->join('states_cities as cty', 'cty.id=basic.district', 'left')->get()->row();
	}	
	
				
}
