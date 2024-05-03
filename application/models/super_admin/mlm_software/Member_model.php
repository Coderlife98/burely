<?php
class Member_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function process_query($where = false)
    {
        $field = array('id','username', 'name', 'email','mobile','status','position');//,'sponsor'
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

        $this->db->select('id,username,name,email,mobile,sponsor,status,my_img,position')->from('members');

        if(!empty($where['userIdA'])){
            $this->db->where('username',$where['userIdA']);
        }
        if(!empty($where['mobileN'])){
            $this->db->where('mobile',$where['mobileN']);
        }
        if(!empty($where['emailId'])){
            $this->db->where('email',$where['emailId']);
        }
        if(!empty($where['spId'])){
            $this->db->where('sponsor',$where['spId']);
        }
        if(!(empty($where['strtDt']) && empty($where['endDt'])))
		{
            $this->db->where('create_date  >=',$where['strtDt']);
            $this->db->where('create_date <=',$where['endDt']);
        }



        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'ASC');
        }
    }

    public function member_data($where = false)
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

/*-------------------------------------------------------------------*/
    public function manage_mi($where = false,$actn)
    {

        $field = array('id','username', 'name', 'email','mobile','sponsor','status');
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
        $this->db->select('id,username,name,email,mobile,sponsor,status,my_img');
		$this->db->from('members');
		
		if(!empty($where['userIdA'])){ $this->db->where('username',$where['userIdA']); }
        if(!empty($where['mobileN'])){$this->db->where('mobile',$where['mobileN']);}
        if(!empty($where['emailId'])){ $this->db->where('email',$where['emailId']); }
        if(!empty($where['spId'])){$this->db->where('sponsor',$where['spId']);}
        if(!(empty($where['strtDt']) && empty($where['endDt'])))
		{$this->db->where('create_date  >=',$where['strtDt']);$this->db->where('create_date <=',$where['endDt']);}
		if($actn=='topup'){$this->db->where('topup >','0.00');}
		else if($actn=='without_topup'){$this->db->where('topup ','0.00');}
        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'ASC');
        }
    }

    public function member_manage($where = false,$actn)
    {
        $this->manage_mi($where,$actn);
        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function total_count_mi($actn)
    {
        $this->manage_mi($where=false,$actn);
        return $this->db->get()->num_rows();
    }
    public function total_filter_count_mi($actn)
    {
        $this->manage_mi($where = false,$actn);
        return $this->db->get()->num_rows();
    }
	

	public function getDataList($tblName,$cond,$id)
	{
		$this->db->from($tblName);
		$this->db->where($cond,$id);				   
		$result=$this->db->get();
		return $result->result();
		}	
	public function get_state_district($id)
	{
    	$this->db->select('s.state_cities as st_name,d.state_cities as dist_name');
		$this->db->from('member_basic_manage');
		$this->db->where('member_basic_manage.mem_id', $id);				   
	 	$this->db->join('states_cities as s', 'member_basic_manage.state=s.id', 'left');
		$this->db->join('states_cities d', 'member_basic_manage.district=d.id', 'left');
		$result=$this->db->get();
		return $result->row();
		}	
	public function getData($tblName,$cond,$id)
	{
		$this->db->select('name');
		$this->db->from($tblName);
		$this->db->where($cond,$id);				   
		$result=$this->db->get();
		return $result->row();
		}	
}
