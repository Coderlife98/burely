<?php
class Partners_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function process_query($where = false, $memTyp)
    {
        if ($memTyp == 'frenchise') {
            $uTyp = '1';
        } else if ($memTyp == 'shopee') {
            $uTyp = '2';
        } else {
            $uTyp = NULL;
        }
        $field = array(
            'id', 'name', 'email', 'mobile', 'address', 'status', 'username','shop_name'
        );
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

        $this->db->select('id,name,email,mobile,address,status,username,my_img,shw_pass,user_typ,shop_name')->from('partners');
        if ($uTyp) {
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
        }

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }

    public function member_data($where = false, $memTyp)
    {
        $this->process_query($where, $memTyp);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function total_count($memTyp)
    {
        $this->process_query($where = false, $memTyp);
        return $this->db->get()->num_rows();
    }
    public function total_filter_count($where = false, $memTyp)
    {
        $this->process_query($where, $memTyp);
        return $this->db->get()->num_rows();
    }

    function get_product_details_data($prod_id)
    {
        $this->db->select('um.unit_name,pd.*')->from('product_details as pd');
        $this->db->where('pd.prod_id',$prod_id);
        $this->db->join('unit_manage as um', 'um.id=pd.unit','left');
        return $this->db->get()->row_array();
    }


  
 public function getPartnerImg($id)
    {
        //SELECT p.my_img,b.adhar_img,b.passbook_img,b.pan_img FROM partners as p left join partners_basic_manage as b on b.mem_id=p.id where p.id='1' 
	    $this->db->select('p.my_img,b.adhar_img,b.passbook_img,b.pan_img')->from('partners as p')->where('p.id', $id)->join('partners_basic_manage as b', 'b.mem_id=p.id', 'left');
        $result = $this->db->get();
        return $result->row();
    }



    /*SELECT m.*,more.*,s.state_cities as stateN,c.state_cities as cityN FROM partners as m left join partners_basic_manage as more on more.mem_id=m.id left join states_cities as s on more.state=s.id left join states_cities as c on c.id=more.district where m.id='21'*/
    public function user_data($id)
    {
        $this->db->select('m.*,more.mem_id,date_of_birth,state,district,zipcode,gst_number,pan_nu,pan_img,aadhaar_nu,adhar_img,passbook_img,bank_name,bank_ac_no,bank_Ifsc,
		bankBrName,btc_address,nominee_name,nominee_address,nominee_relationship, s.state_cities as stateN, c.state_cities as cityN')->from('partners as m')->where('m.id', $id);
        $this->db->join('partners_basic_manage as more', 'more.mem_id=m.id', 'left')->join('states_cities as s', 'more.state=s.id', 'left');
        $this->db->join('states_cities as c', 'c.id=more.district', 'left');
        $result = $this->db->get();
        return $result->row();
    }
}
