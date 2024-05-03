<?php
class Member_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
		$this->ASarray = array();
		$this->AmiLarray = array();
    }
/*-----------------------14.07.2023 start---------------------------------*/
	public function validate_loggedIn($userN,$passW)
	{
		$this->db->from('msdr_members');
		$this->db->where('username',$userN);
		$this->db->where('password',md5($passW));				   
		$result=$this->db->get();
		return $result->row();
		}  
		
/*-----------------------14.07.2023 end---------------------------------*/		
####################################################################	
public function profile_details($id)
{

return $this->db->select(' m.id, m.user_typ, m.username, m.sponsor,spnsr.name as sponsorName, m.name, m.gender, m.email, m.mobile, m.address, m.my_img, m.status, m.create_date, m.shw_pass,m.topup, stt.state_cities as stN, cty.state_cities as ctyN, b.mem_id, b.date_of_birth, b.state, b.district, b.zipcode, b.gst_number, b.pan_nu, b.aadhaar_nu, b.bank_name, b.bank_ac_no, b.bankBrName, b.bank_Ifsc, b.bankBrName, b.btc_address, b.nominee_name, b.nominee_address, b.nominee_relationship, b.pan_img, b.adhar_img, b.passbook_img')->from('msdr_members as m')->where('m.id', $id)->join('msdr_member_basic as b', 'b.mem_id=m.id', 'left')->join('states_cities as stt', 'stt.id=b.state', 'left')->join('states_cities as cty', 'cty.id=b.district', 'left')->join('msdr_members as spnsr', 'spnsr.username=m.sponsor', 'left')->get()->row();
	/*$this->db->select('m.id,m.user_typ,m.username,m.sponsor,m.sponsor,m.rank,m.name,m.gender,m.email,m.mobile,m.address,m.my_img,m.status,m.create_date,stt.state_cities as stN,cty.state_cities as ctyN, b.mem_id,b.date_of_birth,b.state,b.district,b.zipcode,b.gst_number,b.pan_nu,b.aadhaar_nu,b.bank_name,b.bank_ac_no,b.bankBrName,b.bank_Ifsc,
	b.bankBrName,b.btc_address, b.nominee_name,b.nominee_address,b.nominee_relationship,b.pan_img,b.adhar_img,b.passbook_img');
	$this->db->from('msdr_members as m');
	$this->db->where('m.id', $id);				   
	$this->db->join('msdr_member_basic as b', 'b.mem_id=m.id', 'left');
	$this->db->join('states_cities as stt', 'stt.id=b.state', 'left');
	$this->db->join('states_cities as cty', 'cty.id=b.district', 'left');
	$result=$this->db->get();
	return $result->row();*/
	}	
/*---------------------------------Testing Document Start-----------------------------------*/	
public function profile_details_by_username($id)
{
		$this->db->select('m.id,m.user_typ,m.username,m.sponsor,m.rank,m.name,m.gender,m.email,m.mobile,m.address,m.my_img,m.status,m.create_date,stt.state_cities as stN,cty.state_cities as ctyN, b.mem_id,b.date_of_birth,b.state,b.district,b.zipcode,b.gst_number,b.pan_nu,b.aadhaar_nu,b.bank_name,b.bank_ac_no,b.bankBrName,b.bank_Ifsc,
	b.bankBrName,b.btc_address, b.nominee_name,b.nominee_address,b.nominee_relationship,b.pan_img,b.adhar_img,b.passbook_img');
	$this->db->from('msdr_members as m');
	$this->db->where('m.username', $id);				   
	$this->db->join('msdr_member_basic as b', 'b.mem_id=m.id', 'left');
	$this->db->join('states_cities as stt', 'stt.id=b.state', 'left');
	$this->db->join('states_cities as cty', 'cty.id=b.district', 'left');
	$result=$this->db->get();
	return $result->row();
	}	
	
	
	
    public function process_query($where = false,$uid,$actn)
    {
		// $uId='79263';
        $field = array('id','username', 'name', 'email','mobile','sponsor','status','address','topup');
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
		
		$getAllM=$this->active_subscriber($uid);
        $this->db->select('m.id,username,name,email,mobile,sponsor,m.status,address,topup,b_volume')->from('msdr_members as m')->join('package as p','p.pack_price=m.topup','left');
		$this->db->where_in('m.username',explode(',',$getAllM['getAllId']));
		if($actn)
		{
			 if($actn=='deactive'){$this->db->where('topup','0.00');}
			 else if($actn=='active'){$this->db->where('topup!=','0.00');}
			 
			
			
			}
		
		
		
	  /*
	    if(!empty($where['userId'])){$this->db->where('username',$where['userId']);}
		if(!empty($where['mono'])){$this->db->where('mobile',$where['mono']);}
        if(!empty($where['emailId'])){$this->db->where('email',$where['emailId']);}
		if(!empty($where['sponsorId'])){$this->db->where('sponsor',$where['sponsorId']);}
		if(!(empty($where['strtDt']) && empty($where['endDt'])))
		{
            $this->db->where('create_date  >=',$where['strtDt']);
            $this->db->where('create_date <=',$where['endDt']);
        }
		*/
		
		
		if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function member_data($where = false ,$uId,$actn)
    {
        $this->process_query($where,$uId,$actn);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function total_count($id,$actn)
    {
        $this->process_query($where = false,$id,$actn);
        return $this->db->get()->num_rows();
    }
    public function total_filter_count($where = false,$id,$actn)
    {
        $this->process_query($where,$id,$actn);
        return $this->db->get()->num_rows();
    }	
	
	
	
	
 private function active_subscriber($id,$i=0)
{
		$this->db->select("id,username")->from("msdr_members")->where('sponsor',$id);
		$data = $this->db->get()->result();
		$getAllId='getAllId';
		foreach ($data as $dt) 
		{
			$this->ASarray['PersonCount'] += 1;
			if(isset($this->ASarray[$getAllId])){ $this->ASarray[$getAllId].= ','.$dt->username;}
			else{$this->ASarray[$getAllId] = $dt->username;}
			$this->active_subscriber($dt->username,$i);
		}
		return $this->ASarray;
}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
/*---------------------------------Testing Document End-----------------------------------*/	
}
