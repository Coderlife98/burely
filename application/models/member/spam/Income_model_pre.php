<?php
class Income_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
		$this->Dptharray = array();	
    }	
/*-----------------------02.05.2023 start---------------------------------*/
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
		$this->db->from('earning');
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

##########################@mi Regular Income Start####################################	
public function get_panMemInc()
{
	$this->db->select('id,dev_mem_frm,dev_mem_to,inc_profit');
	$this->db->from('panchayat_member_income');
	$result=$this->db->get();
	return $result->result();
	}	
public function create_earning($userid,$ref_id,$income_name,$amount)
{
    $data = array('userid'=> $userid,'amount'=>$amount,'type'=>$income_name,'ref_id'=>$ref_id,'create_date'=> date('Y-m-d H:s:i'));
	if($userid!=$ref_id)
	{
		if($this->db->insert('earning',$data)){return true;}else{return false;}
    	}
	}			
public function find_active_parent($id,$refID,$i=0)
{
	$this->db->select('members.id,A,B,C,D,username,name,sponsor,position,total_downline,rank_id,members.rank,reward_name,member_goal,income,other_reward,monthly_income,membership_type');
   	$this->db->from('members');$this->db->join('rank_system', 'rank_system.id=members.rank_id', 'left');$this->db->where('username',$id);
	/*$this->db->where('topup','1000');*/
	$result=$this->db->get();
	$getresult=$result->result();
	$packagePrice=$this->get_package('pack_price');
	$rewards=$this->get_panMemInc();
	if($result->num_rows() > 0)
	{
	  foreach($getresult as $list)
		{
			++$i;
			$getDownLine=$this->find_active_child($list->username);
############################# Rnk Update Upto developer menber strt########################################		
			if($list->A&&$list->B&&$list->C&&$list->D)	
			{	
				$getExistingRank=$this->get_nextRank('rank_system','id,reward_name','id > ',$list->rank_id);
				$getMyChildIdArr=array($list->A,$list->B,$list->C,$list->D);
			  	$setMyChildRnk=$this->getChildRank($getMyChildIdArr,$list->rank_id);	
			  }			  	
############################# Rnk Update Upto developer menber end#########################################			
$nArr=array('level'=>$i,'id'=>$list->id,'username'=>$list->username,'name'=>$list->name,'position'=>$list->position,'rank_id'=>$list->rank_id,'rank'=>$list->rank,
			'total_downline'=>$getDownLine,'member_goal'=>$list->member_goal,'income'=>$list->income,'other_reward'=>$list->other_reward,'monthly_income'=>$list->monthly_income);
	        array_push($this->ASarray,$nArr);
############################# Regular Income Create Start #############################	##################
	if(0 < $getDownLine && $getDownLine < 16)
	{		
	    if($getDownLine=='4'){$freshIncome=($packagePrice->pack_price/100)* 15;$this->create_earning($list->username,$refID,$list->rank.' level income', $freshIncome);}
		else if($getDownLine >= $rewards[1]->dev_mem_frm && $getDownLine <= $rewards[1]->dev_mem_to)
		{$freshIncome=$rewards[1]->inc_profit;$this->create_earning($list->username,$refID,$list->rank.' level income', $freshIncome);}
		else if($getDownLine >= $rewards[2]->dev_mem_frm && $getDownLine <= $rewards[2]->dev_mem_to)
		{$freshIncome=$rewards[2]->inc_profit;$this->create_earning($list->username,$refID,$list->rank.' level income', $freshIncome);}
	   }
	else
	{if($getDownLine > 0){$freshIncome=($packagePrice->pack_price/100)* $list->income;$this->create_earning($list->username,$refID,$list->rank.' level income', $freshIncome);}}				
############################# Regular Income Create End ############################# ##################	
			$this->find_active_parent($list->position,$refID,$i);
			}	
		 return $this->ASarray;
		}
	}
public function getChildRank($childId,$rnkId)
{
/*	$getResult=$this->db->select('id,username,name,sponsor,position,A,B,C,D')->from('members')->where_in('username',$childId)->get()->result();return $getResult;*/
	$getParentCurrentRank=$this->get_nextRank('rank_system','id,reward_name','id > ',$rnkId);
	if($childId)
	{   $x=0;
		foreach($childId as $list)	
		{
			$getResult=$this->db->select('id,username,name,position,A,B,C,D,rank,rank_id')->from('members')->where('username',$list)->get()->row();
			//print_r($getResult);echo '<br>';
			if($getResult->A && $getResult->B && $getResult->C && $getResult->D)
			{
				  if($rnkId==$getResult->rank_id){ $x++;}
				  if($x=='4')
				  { 
					$whereCon=array('username'=>$getResult->position);
					$updateArr=array('rank_id'=>$getParentCurrentRank->id,'rank'=>$getParentCurrentRank->reward_name);
					$this->update_record('members',$whereCon,$updateArr);
					/*if($this->update_record('members',$whereCon,$updateArr)){echo 'Rank will Promote from '.$getResult->rank.' to '.$getParentCurrentRank->reward_name;}*/
					}
				}
				else
				{
					if($rnkId==$getResult->rank_id){ $x++;}
					if($x=='4')
					{ 
						$whereCon=array('username'=>$getResult->position);
						$updateArr=array('rank_id'=>$getParentCurrentRank->id,'rank'=>$getParentCurrentRank->reward_name);
						$this->update_record('members',$whereCon,$updateArr);
						/*if($this->update_record('members',$whereCon,$updateArr)){echo 'Rank will Promote from '.$getResult->rank.' to '.$getParentCurrentRank->reward_name;}*/
						}
				  }
			
			}
	 }	
}	
public function get_package($sel){ return  $this->db->select($sel)->from('package')->get()->row();}	
public function update_record($tblName,$whereCon,$updateArr){$this->db->where($whereCon);if($this->db->update($tblName,$updateArr)){return true;}else{return false;}}			
public function get_nextRank($tblName,$sel,$whereCon,$id){ return  $this->db->select($sel)->from($tblName)->where($whereCon,$id)->get()->row();}
private function find_active_child($id)
{
	$this->db->select('id,username,name,sponsor,position,A,B,C,D');
   	$this->db->from('members');
	$this->db->where('position',$id);
	$result=$this->db->get();
	$getresult=$result->result();
	$myLeg=0;
	if($result->num_rows() > 0)
	{	
		foreach($getresult as $list)
		{
			++ $myLeg;
			$myLeg += $this->find_active_child($list->username);
			}	
		}
	 return $myLeg;
	}	
##########################@mi Regular Income End######################################
public function get_member_wallet($id)
{
	$this->db->select('members.id,members.username,balance,name,rank,rank_id,my_img,mobile,email,address,total_downline,topup');
	$this->db->from('members');
	$this->db->where('members.id', $id);				   
	$this->db->join('wallet', 'wallet.userid=members.username', 'left');
	$result=$this->db->get();
	return $result->row();
	
	}
public function get_incomingEarned($id)
{
    $this->db->select('sum(amount) as incomeEarnend ');
	$this->db->from('earning');
	$this->db->where('userid', $id);
	$this->db->where('status','Pending');	
	$result=$this->db->get();
	return $result->row();
	}
public function minWithdrawlBal()
{
	$this->db->select('min_payout,pack_price');
	$this->db->from('package');
	$this->db->where('id', '1');
	$result=$this->db->get();
	return $result->row();
	}
public function withdrawlRequest($id)
{
	$this->db->from('withdraw_request');
	$this->db->where('userid', $id);
	$this->db->where('status','Un-Paid');	
	 $this->db->order_by('id', 'desc');
	$result=$this->db->get();
	return $result->result();
	}	
public function getTotalIncome($id)
{
	$this->db->select('sum(amount) as tIncome');
	$this->db->from('earning');
	$this->db->where('userid', $id);
	$result=$this->db->get();
	return $result->row();
	}
public function getLatestEarning($id)
{
	$this->db->select('*');
	$this->db->from('earning');
	$this->db->where('userid', $id);
	 $this->db->limit(5, 0);
	$result=$this->db->get();
	return $result->result();
	}
/*--------------------Reward Section start-------------------------------*/
public function isCheckReward($id)
{return $this->db->select('r.*,other_reward')->from('rewards as r')->join('rank_system', 'rank_system.id=r.reward_id', 'inner')->where('r.userid',$id)->get()->result();}

/*--------------------Reward Section End-------------------------------*/
	
}
