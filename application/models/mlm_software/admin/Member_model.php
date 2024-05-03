<?php
class Member_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function process_query($where=false,$action)
    {
        $i=0;$field = array('id','name','email','mobile','address','status','username','sponsor');
        foreach($field as $item)
		{
           if(!empty($where['search']['value'])){if($i===0){$this->db->group_start()->like($item, $where['search']['value']);}
		   else{$this->db->or_like($item, $where['search']['value']);}
           if(count($field) -1==$i){$this->db->group_end();}
           }
            $i++;
        }
        $this->db->select('id,username,name,email,mobile,address,status,status,my_img,sponsor,shw_pass')->from('msdr_members');
		if($action)
		{
			if($action=='Active')
			{
            	$this->db->where('topup!=','0');
			}
			else if($action=='Deactive')
			{
            	$this->db->where('topup','0');
			}
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
            $this->db->where('created_at >=', $where['strtDt']);
            $this->db->where('created_at <=', $where['endDt']);
        }






        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }

    public function member_data($where = false,$action)
    {
        $this->process_query($where,$action);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function total_count($action)
    {
        $this->process_query($where = false,$action);
        return $this->db->get()->num_rows();
    }
    public function total_filter_count($where = false)
    {
        $this->process_query($where,$action);
        return $this->db->get()->num_rows();
    }
	public function getCnt_filter($action)
	{
		$this->db->from('msdr_members');
		if($action=='Active'){$this->db->where('topup!=','0');}else if($action=='Deactive'){$this->db->where('topup','0');}
        $result = $this->db->get();
        return $result->num_rows();	
		}
  public function delete_row($id)
 {
		$sql="DELETE msdr_member_basic, msdr_members FROM msdr_members JOIN msdr_member_basic ON msdr_members.id = msdr_member_basic.mem_id WHERE msdr_members.id='".$id."'";
		$result=$this->db->query($sql);
		return $result;
		
    }	
	
public function profile_details($id)
{
	return $this->db->select(' m.id,m.memTitle,m.topup_request,m.topup, m.user_typ, m.username, m.sponsor,spnsr.name as sponsorName, m.name, m.gender, m.email, m.mobile, m.address, m.my_img, m.status, m.create_date, m.shw_pass, stt.state_cities as stN, cty.state_cities as ctyN, b.mem_id, b.date_of_birth, b.state, b.district, b.zipcode, b.gst_number, b.pan_nu, b.aadhaar_nu, b.bank_name, b.bank_ac_no, b.bankBrName, b.bank_Ifsc, b.bankBrName, b.btc_address, b.nominee_name, b.nominee_address, b.nominee_relationship, b.pan_img, b.adhar_img, b.passbook_img')->from('msdr_members as m')->where('m.id', $id)->join('msdr_member_basic as b', 'b.mem_id=m.id', 'left')->join('states_cities as stt', 'stt.id=b.state', 'left')->join('states_cities as cty', 'cty.id=b.district', 'left')->join('msdr_members as spnsr', 'spnsr.username=m.sponsor', 'left')->get()->row();
	}	
	
	
/*    public function get_state_district($id)
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
    }*/
	
	
	
	
/*-----------------------05.10.2023 Start-----------------------------------*/

    public function deposit_query($where = false)
    {

        $field = array('id','tnx_id','amount','tnx_date');
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
		$this->db->from('partner_deposit');
	   /* if(!empty($where['tnxId'])){$this->db->where('tnx_id',$where['tnxId']);}
		if(!empty($where['tnxType'])){$this->db->where('status',$where['tnxType']);}
		if(!(empty($where['strtDt']) && empty($where['endDt']))){$this->db->where('create_date  >=',$where['strtDt'])->where('create_date <=',$where['endDt']);}*/

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function deposit_data($where = false)
    {
        $this->deposit_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function deposit_count()
    {
        $this->deposit_query($where = false);
        return $this->db->get()->num_rows();
    }
    public function deposit_filter_count($where = false)
    {
        $this->deposit_query($where);
        return $this->db->get()->num_rows();
    }

	public function getDepositData($id)
	{return $this->db->select('m.username,md.*')->from('partner_deposit as md')->where('md.id',$id)->join('partners as m', 'm.id=md.mem_id', 'left')->get()->row();}	
	
	public function getWalletWithDepositData($id)
	{
		return $this->db->select('md.id,m.username,md.amount as depAmt,w.balance')->from('partner_deposit as md')->where('md.id',$id)->join('partners as m', 'm.id=md.mem_id', 'left')->join('wallet as w', 'w.userid=m.username', 'left')->get()->row();
		}	
	
		
/*-----------------------05.10.2023 Start-----------------------------------*/			
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
