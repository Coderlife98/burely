<?php
class Employee_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function process_query($where = false)
    {

        $field = array('id', 'name', 'email', 'mobile', 'address', 'status','user_code');
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

        $this->db->select('id,name,email,mobile,address,status,department_type,photo,user_code')->from('users');

        if (!empty($where['userIdA'])) {
            $this->db->where('user_code', $where['userIdA']);
        }
        if (!empty($where['mobileN'])) {
            $this->db->where('mobile', $where['mobileN']);
        }
        if (!empty($where['emailId'])) {
            $this->db->where('email', $where['emailId']);
        }
        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('created_at >=', $where['strtDt']);
            $this->db->where('created_at <=', $where['endDt']);
        }






        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }

    public function employee_data($where = false)
    {
        $this->process_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function total_count($where = false)
    {
        $this->process_query();
        return $this->db->get()->num_rows();
    }
    public function total_filter_count($where = false)
    {
        $this->process_query($where);
        return $this->db->get()->num_rows();
    }
    public function get_state_district($id)
    {
        $this->db->select('s.state_cities as st_name,d.state_cities as dist_name');
        $this->db->from('users');
        $this->db->where('users.id', $id);
        $this->db->join('states_cities as s', 'users.state=s.id', 'left');
        $this->db->join('states_cities d', 'users.district=d.id', 'left');
        $result = $this->db->get();
        return $result->row();
    }
    public function getDataList($tblName, $cond, $id)
    {
        $this->db->from($tblName);
        $this->db->where($cond, $id);
        $result = $this->db->get();
        return $result->result();
    }
}
