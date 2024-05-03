<?php
class Pin_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	public function getDataList($tblName,$cond,$id)
	{
		$this->db->from($tblName);
		$this->db->where($cond,$id);				   
		$result=$this->db->get();
		return $result->result();
		}		
/*-----------------------02.05.2023 start---------------------------------*/

    public function process_query($where = false,$uid)
    {

        $field = array(
            'id','epin','amount','status'
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
		$this->db->select('member_purchase.mem_id,epin.*');
		$this->db->from('member_purchase');
		$this->db->join('epin', 'member_purchase.id=epin.epin_pur_id', 'left');
		$this->db->where('mem_id',$uid);



        if(!empty($where['pinCode'])){
            $this->db->where('epin.epin',$where['pinCode']);
        }
        if(!empty($where['used_by'])){
            $this->db->where('used_by',$where['used_by']);
        }
        if(!empty($where['pinsts'])){
			if($where['pinsts']=='1')
			{
            	$this->db->where('status','Cancelled');
					}
			if($where['pinsts']=='2')
			{
            	$this->db->where('status','Used');
					}
			if($where['pinsts']=='3')
			{
            	$this->db->where('status','Un-used');
					}				
        }
        if(!(empty($where['startDate']) && empty($where['endDate'])))
		{
            $this->db->where('generate_time >=',$where['startDate']);
            $this->db->where('generate_time <=',$where['endDate']);
        }








        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }

    public function pin_data($where = false,$uid)
    {
        $this->process_query($where,$uid);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function total_count($uid)
    {
        $this->process_query($where = false,$uid);
        return $this->db->get()->num_rows();
    }
    public function total_filter_count($where = false,$uid)
    {
        $this->process_query($where = false,$uid);
        return $this->db->get()->num_rows();
    }
/*-----------------------02.05.2023 End-----------------------------------*/
public function getUnusedPin($id)
{
   	    $this->db->select('epin.id,issue_to,epin.epin,pin_password,name');
		$this->db->from('epin');
		$this->db->where('epin.epin', $id);	
		$this->db->where('epin.status', 'Un-used');			   
	 	$this->db->join('members', 'members.username=epin.issue_to', 'left');
		$result=$this->db->get();
		return $result->row();
	}
public function search_epin($u_id,$frmDate,$toDate)
{
   	    $this->db->select('epin.*,name');
		$this->db->from('epin');		   
	 	$this->db->join('members', 'members.username=epin.issue_to', 'left');
		$this->db->where('epin.issue_to', $u_id);	
		$this->db->where("generate_time BETWEEN '" . $frmDate . "' AND '" .$toDate."'");
		$result=$this->db->get();
		return $result->result();
		
	}
	
	
	
public function getUnusedPinList($id)
{
   	    $this->db->select('epin.id,issue_to,epin.epin,pin_password,status');
		$this->db->from('epin');
		$this->db->where('member_purchase.mem_id', $id);	
		$this->db->where('epin.status', 'Un-used');			   
	 	$this->db->join('member_purchase', 'epin.epin_pur_id=member_purchase.id', 'left');
		$result=$this->db->get();
		return $result->result();
	}	
	
	
	
	
	
/*-----------------------05.05.2023 End-----------------------------------*/}
