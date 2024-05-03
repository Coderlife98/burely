<?php
class Income_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function process_wallet($where = false,$uid)
    {

        $field = array('id','userid','amount','date','type');
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
		$this->db->from('partner_wallet_transaction');
		$this->db->where('user_id',$uid);
        /*if(!empty($where['refId'])){$this->db->where('ref_id',$where['refId']);}
		if(!empty($where['pysts']))
		{
			if($where['pysts']=='1'){$this->db->where('status','Paid');}
			if($where['pysts']=='2'){$this->db->where('status','Hold');}
			if($where['pysts']=='3'){$this->db->where('status','Pending');}		
			}
		if(!(empty($where['strtDt']) && empty($where['endDt'])))
		{
            $this->db->where('create_date  >=',$where['strtDt']);
            $this->db->where('create_date <=',$where['endDt']);
        }*/
        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function wallet_tnx($where = false,$uid)
    {
        $this->process_wallet($where,$uid);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function wallet_count($uid)
    {
        $this->process_wallet($where = false,$uid);
        return $this->db->get()->num_rows();
    }
    public function wallet_filter_count($where = false,$uid)
    {
        $this->process_wallet($where,$uid);
        return $this->db->get()->num_rows();
    }
	
	
	
	public function process_query($where = false,$uid)
    {

        $field = array('id','userid','amount','date','type');
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
		$this->db->from('partner_earning');
		$this->db->where('userid',$uid);
        if(!empty($where['refId'])){$this->db->where('ref_id',$where['refId']);}
		if(!empty($where['pysts']))
		{
			if($where['pysts']=='1'){$this->db->where('status','Paid');}
			if($where['pysts']=='2'){$this->db->where('status','Hold');}
			if($where['pysts']=='3'){$this->db->where('status','Pending');}		
			}
		if(!(empty($where['strtDt']) && empty($where['endDt'])))
		{
            $this->db->where('create_date  >=',$where['strtDt']);
            $this->db->where('create_date <=',$where['endDt']);
        }
        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function income_data($where = false,$uid)
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
        $this->process_query($where,$uid);
        return $this->db->get()->num_rows();
    }
	
	
	public function get_member_wallet($id)
{
	return $this->db->select('mem.id,mem.username,balance,name,my_img,mobile,email,address,topup')->from('partners as mem')->where('mem.id', $id)->join('partner_wallet','partner_wallet.userid=mem.username','left')->get()->row();
}
	
	public function minWithdrawlBal(){return $this->db->select('withdrableAmt')->from('club_income')->where('id', '1')->get()->row();}
	public function withdrawlRequest($id){return $this->db->from('partner_withdraw_request')->where('userid', $id)->where('status','Un-Paid')->order_by('id', 'desc')->get()->result();}
	
/*****************************************************************************/
    public function deposit_query($where = false,$uid)
    {

        $field = array('id','tnx_id','status','create_date');
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
		$this->db->where('mem_id',$uid);

        if(!empty($where['tnx_id'])){$this->db->where('tnx_id',$where['tnx_id']);}
		if(!empty($where['actnType'])){$this->db->where('status',$where['actnType']);}
		if(!(empty($where['strtDt']) && empty($where['endDt']))){$this->db->where('create_date  >=',$where['strtDt'])->where('create_date <=',$where['endDt']);}

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function deposit_data($where = false,$uid)
    {
        $this->deposit_query($where,$uid);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function deposit_count($uid)
    {
        $this->deposit_query($where = false,$uid);
        return $this->db->get()->num_rows();
    }
    public function deposit_filter_count($where = false,$uid)
    {
        $this->deposit_query($where,$uid);
        return $this->db->get()->num_rows();
    }


/*****************************************************************************/	
	
	
}
