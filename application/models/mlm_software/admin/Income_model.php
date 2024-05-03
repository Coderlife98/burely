<?php
/***************************************************************************************************
 * Copyright (c) 2020. by Camwel Corporate Solution PVT LTD
 * This project is developed and maintained by Camwel Corporate Solution PVT LTD.
 * Nobody is permitted to modify the source or any part of the project without permission.
 * Project Developer: Camwel Corporate Solution PVT LTD
 * Developed for: Camwel Corporate Solution PVT LTD
 *Created:@mi $ingh
 **************************************************************************************************/
class Income_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
		$this->ASarray = array();
    }	
    public function process_query($where=false,$action)
    {
        $i=0;$field=array('e.id','e.userid','e.amount','e.create_date','e.type');
        foreach ($field as $item) {
            if (!empty($where['search']['value'])) 
			{
                if($i===0){$this->db->group_start()->like($item, $where['search']['value']);}else{$this->db->or_like($item,$where['search']['value']);}
                if (count($field) -1==$i){$this->db->group_end();
                }
            }
            $i++;
        }
        $this->db->select('e.id,e.userid,e.ref_id,e.amount,e.create_date,e.type,m.name,m.my_img');
		if($action=='member')
		{
			$this->db->from('earning as e')->join('msdr_members as m', 'e.userid=m.username', 'left');
			}
			else
			{
			   $this->db->from('partner_earning as e')->join('partners as m', 'e.userid=m.username', 'left');
			   if($action=='frenchise'){$this->db->where('m.user_typ','1');}else if($action=='shopee'){$this->db->where('m.user_typ','2');}
			   }
		if(!empty($where['userId'])){$this->db->where('e.userid',$where['userId']);}
        if(!empty($where['paymntSts']))
		{
			if($where['paymntSts']=='Paid'){$this->db->where('e.status','Paid');}
			if($where['paymntSts']=='Un-Paid'){$this->db->where('e.status','Pending');} 
			if($where['paymntSts']=='Hold'){$this->db->where('e.status','Hold');} 
			 }
        if(!(empty($where['strtDt']) && empty($where['endDt']))){$this->db->where('e.create_date >=',$where['strtDt']);$this->db->where('e.create_date <=',$where['endDt']);}
	    if (isset($where['order']) && !empty($where['order'])){$this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);} 
		else{$this->db->order_by('id','desc');}
    }
    public function income_data($where=false,$action)
    {
        $this->process_query($where,$action);
        if ($where['length']!=-1){$this->db->limit($where['length'], $where['start']);}
        return $this->db->get()->result();
    }
    public function total_count($action)
    {
        $this->process_query($where=false,$action);
        return $this->db->get()->num_rows();
    }
    public function total_filter_count($where=false,$action)
    {
        $this->process_query($where,$action);
        return $this->db->get()->num_rows();
    }
/*-------------------------PAYMENT OPERATION START--------------------------------*/
    public function pay_process($where=false,$memType,$actn)
    {
		$payMode=array('Hold'=>'hold','Un-Paid'=>'unpaid','Paid'=>'paid',''=>'create');
		$optedPayMode = array_search($actn,$payMode,true);
		$field = array('wr.id','wr.userid','wr.amount','wr.request_date','m.name');
        $i = 0;
        foreach ($field as $item)
		{
		   if(!empty($where['search']['value'])){if($i===0){$this->db->group_start();$this->db->like($item,$where['search']['value']);}
		   else{$this->db->or_like($item, $where['search']['value']);}if(count($field)-1==$i){$this->db->group_end();}}
            $i++;
        }

		if($memType=='member'){$this->db->select('wr.*,m.status as member_status,m.name')->from('withdraw_request as wr');}
		else{
				$this->db->select('wr.*,m.status as member_status,m.name')->from('partner_withdraw_request as wr');
				if($memType=='shopee'){$this->db->where('m.user_typ ','2');}
				else if($memType=='frenchise'){$this->db->where('m.user_typ ','1');}
				
				}
		
		if($optedPayMode){$this->db->where('wr.status',$optedPayMode);}
		/*
		if(!empty($where['userId'])){$this->db->where('wr.userid',$where['userId']);}
        if(!empty($where['paymntSts']))
		{
			if($where['paymntSts']=='Paid'){$this->db->where('wr.status','Paid');}
			if($where['paymntSts']=='Un-Paid'){$this->db->where('wr.status','Un-Paid');} 
			if($where['paymntSts']=='Hold'){$this->db->where('wr.status','Hold');} 
			 }
        if(!(empty($where['strtDt']) && empty($where['endDt']))){$this->db->where('wr.request_date >=',$where['strtDt']);$this->db->where('wr.request_date <=',$where['endDt']);}*/
	
		if($memType=='member'){$this->db->join('msdr_members as m', 'wr.userid=m.username', 'left');}
		else{$this->db->join('partners as m', 'wr.userid=m.username', 'left');}

		if (isset($where['order']) && !empty($where['order'])){$this->db->order_by($field[$where['order']['0']['column']],$where['order']['0']['dir']);}
		else{$this->db->order_by('id', 'desc');}
		
    }
    public function pay_data($where = false,$memType,$actn)
    {
		$this->pay_process($where,$memType,$actn);
        if($where['length']!= -1){$this->db->limit($where['length'],$where['start']);}
        return $this->db->get()->result();
    }
    public function pay_total_count($memType,$actn)
    {
		$this->pay_process($where = false,$memType,$actn);return $this->db->get()->num_rows();
    	}	
	public function pay_filter_count($where = false,$memType,$actn)
    {
        $this->pay_process($where,$memType,$actn);return $this->db->get()->num_rows();
      }
/*-------------------------PAYMENT OPERATION END----------------------------------*/

public function getwallet_withdraw_data($id,$userType)
{
	if($userType=='member'){return $this->db->select('wr.id,wr.userid as u_id,amount as withdr_amt, balance as wallet_amt,mem.name')->from('withdraw_request as wr')->where('wr.id', $id)->join('wallet', 'wallet.userid=wr.userid', 'left')->join('msdr_members as mem', 'mem.username=wr.userid', 'left')->get()->row();}else{return $this->db->select('wr.id,wr.userid as u_id,amount as withdr_amt, balance as wallet_amt,mem.name')->from('partner_withdraw_request as wr')->where('wr.id', $id)->join('partner_wallet', 'partner_wallet.userid=wr.userid', 'left')->join('partners as mem', 'mem.username=wr.userid', 'left')->get()->row();}
	}  

public function generateEarningPayout()
{
	return $this->db->select('e.userid,sum(e.earnedBv) as earnAmt,w.balance')->from('earning as e')->where('e.status','Pending')->join('wallet as w','w.userid=e.userid','left')->group_by('userid')->get()->result();				
	}

public function generateEarningPayoutFrPartner()
{
	return $this->db->select('e.userid,sum(e.earnedBv) as earnAmt,w.balance')->from('partner_earning as e')->where('e.status','Pending')->join('partner_wallet as w','w.userid=e.userid','left')->group_by('userid')->get()->result();				
	
	}


/*----------------------------------@mi changes end----------------------------------------------*/	
}
