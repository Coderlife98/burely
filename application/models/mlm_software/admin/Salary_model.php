<?php
class Salary_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function process_query($where = false)
    {

        $field = array('s.id','s.salary','s.paydate','emp.user_code','emp.name');
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
        $this->db->select('emp.user_code,emp.name,photo,s.* ');
		$this->db->from('salary as s')->join('users as emp', 's.staff_id=emp.id', 'inner');
/*SELECT emp.user_code,emp.name,s.* FROM salary as s inner JOIN users as emp on s.staff_id=emp.id */

		if(!empty($where['empId'])){$this->db->where('emp.user_code',$where['empId']);}
		if(!empty($where['empName'])){$this->db->where('emp.name',$where['empName']);}
        if(!(empty($where['strtDt']) && empty($where['endDt']))){$this->db->where('s.paydate >=',$where['strtDt']);$this->db->where('s.paydate <=',$where['endDt']);}


		
		 if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function salary_data($where = false)
    {
        $this->process_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function total_count($where = false)
    {
        $this->process_query($where = false);
        return $this->db->get()->num_rows();
    }
    public function total_filter_count($where = false)
    {
        $this->process_query($where);
        return $this->db->get()->num_rows();
    }
	public function details_sal($id)
	{
		$this->db->select('emp.user_code,emp.name,s.*,m.name as modifiedBy,m.user_code as modifiedId,c.name as createdBy,c.user_code as createCode');
		$this->db->from('salary as s')->join('users as emp', 's.staff_id=emp.id', 'inner')->join('users as c', 'on c.id=s.created_by', 'left')->join('users as m', 'm.id=s.modified_by', 'left')->where('s.id',$id);	
		$result=$this->db->get();
		return $result->row();
		}
	public function get_emp_sal($id)
	{return $this->db->select('d.payscale')->from('employee_designation as d')->join('users as u', 'u.designation=d.id', 'inner')->where('u.id',$id)->get()->row();}
	function del_data($val,$para)
    {
        if ($val) {
            $this->db->where($para, $val['id']);
            $query = $this->db->delete($val['table']);
            if ($query) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
/*------------------------------------------------------------*/
    public function process_emp_sal($where = false,$id)
    {

        $field = array('id','salary','paydate','tnx_id','month');
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
        $this->db->select('*');
		$this->db->from('salary')->where('staff_id', $id);


		if(!empty($where['tnxId'])){$this->db->where('tnx_id',$where['tnxId']);}
		if(!empty($where['month'])){$this->db->where('month',$where['month']);}
        if(!(empty($where['strtDt']) && empty($where['endDt']))){$this->db->where('created_date >=',$where['strtDt']);$this->db->where('created_date <=',$where['endDt']);}


		
		 if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function emp_salary_data($where = false,$id)
    {
        $this->process_emp_sal($where,$id);
        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function total_emp_sal_count($id)
    {
        $this->process_emp_sal($where = false,$id);
        return $this->db->get()->num_rows();
    }
    public function total_emp_sal_filter_count($where = false,$id)
    {
        $this->process_emp_sal($where,$id);
        return $this->db->get()->num_rows();
    }	
	
	
	
	
	
		
}
