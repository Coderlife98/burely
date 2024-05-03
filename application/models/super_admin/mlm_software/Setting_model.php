<?php
class Setting_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
/*-----------------------------Designations Start-------------------------------*/
    public function desgination_query($where = false)
    {
        $field = array('id', 'des_title', 'des_permission','payscale');
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
        $this->db->select('*')->from('employee_designation');

        if(!empty($where['designation'])){
            $this->db->where('des_title',$where['designation']);
        }
        if(!empty($where['payscale'])){
            $this->db->where('payscale',$where['payscale']);
        }
        if(!(empty($where['strtDt']) && empty($where['endDt'])))
		{
            $this->db->where('created_at >=',$where['strtDt']);
            $this->db->where('created_at <=',$where['endDt']);
        }

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function desgination_list($where = false)
    {
        $this->desgination_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function desgination_count($where = false)
    {
        $this->desgination_query();
        return $this->db->get()->num_rows();
    }
    public function desgination_filter_count($where = false)
    {
        $this->desgination_query($where);
        return $this->db->get()->num_rows();
    }
	public function details_designstion($id)
	{
		$this->db->select('e.*,m.name as modifiedBy,m.user_code as modifiedId,c.name as createdBy,c.user_code as createCode');
		$this->db->from('employee_designation as e')->join('users as c', 'on c.id=e.created_by', 'left')->join('users as m', 'm.id=e.modified_by', 'left')->where('e.id',$id);	
		$result=$this->db->get();
		return $result->row();
		}
	
	
	/*SELECT e.*,m.name as modifiedBy,m.user_code modifiedId,c.name as createdBy,c.user_code as createCode  FROM employee_designation as e left join users as c on c.id=e.created_by left join users as m on m.id=e.modified_by*/
/*-----------------------------Unit Manage Start-------------------------------*/	
 	public function details_unit($id)
	{
		$this->db->select('u.*,m.name as modifiedBy,m.user_code as modifiedId,c.name as createdBy,c.user_code as createCode');
		$this->db->from('unit_manage as u')->join('users as c', 'on c.id=u.created_by', 'left')->join('users as m', 'm.id=u.modified_by', 'left')->where('u.id',$id);
		$result=$this->db->get();
		return $result->row();
		}
   public function unit_query($where = false)
    {
        $field = array('id', 'unitId', 'unit_name');
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
        $this->db->select('*')->from('unit_manage');

        if(!empty($where['unit_nm'])){
            $this->db->where('unit_name',$where['unit_nm']);
        }
		 if(!empty($where['actnType'])){
		 	if($where['actnType']=='Deactive'){ $this->db->where('status','0');}
			if($where['actnType']=='Active'){ $this->db->where('status','1');}
        }
        if(!(empty($where['strtDt']) && empty($where['endDt'])))
		{
            $this->db->where('create_date >=',$where['strtDt']);
            $this->db->where('create_date <=',$where['endDt']);
        }

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function unit_list($where = false)
    {
        $this->unit_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function unit_count($where = false)
    {
        $this->unit_query();
        return $this->db->get()->num_rows();
    }
    public function unit_filter_count($where = false)
    {
        $this->unit_query($where);
        return $this->db->get()->num_rows();
    }
/*-----------------------------Category Start-------------------------------*/	
 	public function details_category($id)
	{
		$this->db->select('u.*,m.name as modifiedBy,m.user_code as modifiedId,c.name as createdBy,c.user_code as createCode');
		$this->db->from('category_manage as u')->join('users as c', 'on c.id=u.created_by', 'left')->join('users as m', 'm.id=u.modified_by', 'left')->where('u.id',$id);
		$result=$this->db->get();
		return $result->row();
		}
   public function category_query($where = false)
    {
      
	    $field = array('p.id', 'p.cat_id', 'p.category','p.status');
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
$this->db->select('p.*,sub.category as master_cat')->from('category_manage as p')->join('category_manage as sub', 'p.parent_id=sub.id', 'left')->order_by('parent_id','asc')->order_by('p.id','asc');

/*SELECT p.*,sub.category as master_cat FROM category_manage as p left join category_manage as sub on p.parent_id=sub.id order by parent_id ASC  */


       if(!empty($where['category_na'])){
            $this->db->where('p.category',$where['category_na']);
        }
		 if(!empty($where['actnType'])){
		 	if($where['actnType']=='Deactive'){ $this->db->where('p.status','0');}
			if($where['actnType']=='Active'){ $this->db->where('p.status','1');}
        }
        if(!(empty($where['strtDt']) && empty($where['endDt'])))
		{
            $this->db->where('p.create_date >=',$where['strtDt']);
            $this->db->where('p.create_date <=',$where['endDt']);
        }

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function category_list($where = false)
    {
        $this->category_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function category_count($where = false)
    {
        $this->category_query();
        return $this->db->get()->num_rows();
    }
    public function category_filter_count($where = false)
    {
        $this->category_query($where);
        return $this->db->get()->num_rows();
    }
  
/*-----------------------------Package Start-------------------------------*/	
	
    public function details_package($id)
	{
		$this->db->select('u.*,m.name as modifiedBy,m.user_code as modifiedId,c.name as createdBy,c.user_code as createCode');
		$this->db->from('package as u')->join('users as c', 'on c.id=u.created_by', 'left')->join('users as m', 'm.id=u.modified_by', 'left')->where('u.id',$id);
		$result=$this->db->get();
		return $result->row();
		}
    public function package_query($where = false)
    {
      
	    $field = array('pack_name', 'pack_price','status');
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
		 $this->db->select('*')->from('package');
       if(!empty($where['pack_nm'])){
            $this->db->where('pack_name',$where['pack_nm']);
        }
		 if(!empty($where['actnType'])){
		 	if($where['actnType']=='Deactive'){ $this->db->where('status','0');}
			if($where['actnType']=='Active'){ $this->db->where('status','1');}
        }
        if(!(empty($where['strtDt']) && empty($where['endDt'])))
		{
            $this->db->where('create_date >=',$where['strtDt']);
            $this->db->where('create_date <=',$where['endDt']);
        }

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function package_list($where = false)
    {
        $this->package_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function package_count($where = false)
    {
        $this->package_query();
        return $this->db->get()->num_rows();
    }
    public function package_filter_count($where = false)
    {
        $this->package_query($where);
        return $this->db->get()->num_rows();
    }
	
	
	
	
	
	
	
	
	
	
	
}
//8617037678