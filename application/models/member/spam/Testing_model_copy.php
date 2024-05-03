<?php
class Testing_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
		$this->ASarray = array();
		$this->miASarray = array();
    }		
/*-----------------------29.06.2023 Testing Start-----------------------------------*/
 public function get_upline_subscriber($id)
 {
 		$frLeg=NULL;
		$frLeg=$this->miDownLine($id);
		if($frLeg){$this->ASarray[$id]=$frLeg;}$result='';/*$this->ASarray[$id]=$frLeg;*/
		$this->active_subscriber($id,$i=0);
		if($this->ASarray)
		{  $sp=0;
		   foreach($this->ASarray as $key=>$list)
		   {
		   		$sp++;
				$newArr=explode(",",$list);$nMem=count($newArr);
				$getDownLine=$this->find_active_child($key);
				$existing_rnk=$this->get_member($key);
				
				if($nMem > 3)
				{	
					$newRnk='Promotted';
					$setMyChildRnk=$this->getDownLinRank($key,$existing_rnk->rank_id);
					}	
				$result='<tr>
							<th>'.$sp.'.</th>
							<td>'.$getDownLine.'</td>
							<td>'.$key.'</td>
							<td>'.$list.'</td>
							<td>'.$existing_rnk->rank.'</td>
							<td>'.$newRnk.'</td><td>'.$setMyChildRnk.'</td>
						 </tr>';	
					
				print_r($result);	
					
		   		
			}
		 }
		// else{$result='Oops it seems there no member is available to this user id'; print_r($result);}
		
		
	}
 private function active_subscriber($id,$i=0)
 {
      $this->db->select("id,username,position,topup")->from("members")->where('username', (int)$id); $data = $this->db->get()->result();
	  foreach ($data as $dt){if($dt->position!='0'){$this->ASarray[$dt->position].= $this->miDownLine($dt->position);}$this->active_subscriber($dt->position,$i);}
	  return $this->ASarray;
    }
private function miDownLine($id)
{$nDline=$this->db->select('GROUP_CONCAT(username SEPARATOR ",") as child')->from('members')->where('position',(int)$id)->get()->row();return $nDline->child;}		
/* public function active_subscriber111($id,$i=0)
{
            $this->db->select("id,username,topup")->from("members")->where('position', (int)$id);
            $data = $this->db->get()->result();
            foreach ($data as $dt) 
			{   //$this->ASarray['PersonCount'] += 1;  //For Counting all downline member 
				if(isset($this->ASarray[$id])){ $this->ASarray[$id].= ','.$dt->username;}
				else{$this->ASarray[$id] = $dt->username;}
               	$this->active_subscriber($dt->username,$i);
            }
            return $this->ASarray;
    }	*/
public function get_package($sel){ return  $this->db->select($sel)->from('package')->get()->row();}		
public function get_member($id){return $this->db->select('id,rank_id,rank')->from('members')->where('username',$id)->get()->row();}	
public function get_nextRank($tblName,$sel,$whereCon,$id){ return  $this->db->select($sel)->from($tblName)->where($whereCon,$id)->get()->row();}
public function get_panMemInc(){return $this->db->select('id,dev_mem_frm,dev_mem_to,inc_profit')->from('panchayat_member_income')->get()->result(); }
public function update_record($tblName,$whereCon,$updateArr){$this->db->where($whereCon);if($this->db->update($tblName,$updateArr)){return true;}else{return false;}}	
/*public function getChildRank($childId,$rnkId)
{
	$getResult=$this->db->select('id,topup,name,username,position,rank,rank_id')->from('members')->where_in('username',$childId)->where('topup!=','0.00')->order_by('rank_id', 'desc')->limit('4')->get()->result();
	$getParentCurrentRank=$this->get_nextRank('rank_system','id,reward_name','id > ',$rnkId);
	if($getResult)
	{$x=0;
		foreach($getResult as $nList)
		{
			 if($rnkId==$nList->rank_id){ $x++;}
			 if($x=='4')
			 {
			 	$whereCon=array('username'=>$nList->position);$updateArr=array('rank_id'=>$getParentCurrentRank->id,'rank'=>$getParentCurrentRank->reward_name);
				$this->update_record('members',$whereCon,$updateArr);
				//if($this->update_record('members',$whereCon,$updateArr)){return 'Rank will Promote from '.$getResult->rank.' to '.$getParentCurrentRank->reward_name;}
				}
			}
		}
}*/	
public function find_active_parent($id,$refID,$i=0)
{
	$this->db->select('members.id,A,B,C,D,username,name,sponsor,position,total_downline,rank_id,members.rank,reward_name,member_goal,income,other_reward,monthly_income,
					   membership_type')->from('members');$this->db->join('rank_system', 'rank_system.id=members.rank_id', 'left');$this->db->where('username',$id);
	/*$this->db->where('topup','1000');*/
	$result=$this->db->get();$getresult=$result->result();
    $packagePrice=$this->get_package('pack_price');
	$rewards=$this->get_panMemInc();
	if($result->num_rows() > 0)
	{
	  foreach($getresult as $list)
		{   ++$i;
			$getDownLine=$this->find_active_child($list->username);
############################# Rnk Update Upto developer menber strt########################################		
	  		
############################# Rnk Update Upto developer menber end#########################################			
$nArr=array('level'=>$i,'id'=>$list->id,'username'=>$list->username,'name'=>$list->name,'position'=>$list->position,'rank_id'=>$list->rank_id,'rank'=>$list->rank,
			'total_downline'=>$getDownLine,'member_goal'=>$list->member_goal,'income'=>$list->income,'other_reward'=>$list->other_reward,'monthly_income'=>$list->monthly_income);
	        array_push($this->miASarray,$nArr);
############################# Regular Income Create Start #############################	##################
/*	if(0 < $getDownLine && $getDownLine < 16)
	{		
	    if($getDownLine=='4'){$freshIncome=($packagePrice->pack_price/100)* 15;$this->create_earning($list->username,$refID,$list->rank.' level income', $freshIncome);}
		else if($getDownLine >= $rewards[1]->dev_mem_frm && $getDownLine <= $rewards[1]->dev_mem_to)
		{$freshIncome=$rewards[1]->inc_profit;$this->create_earning($list->username,$refID,$list->rank.' level income', $freshIncome);}
		else if($getDownLine >= $rewards[2]->dev_mem_frm && $getDownLine <= $rewards[2]->dev_mem_to)
		{$freshIncome=$rewards[2]->inc_profit;$this->create_earning($list->username,$refID,$list->rank.' level income', $freshIncome);}
	   }
	else
	{if($getDownLine > 0){$freshIncome=($packagePrice->pack_price/100)* $list->income;$this->create_earning($list->username,$refID,$list->rank.' level income', $freshIncome);}}*/				
############################# Regular Income Create End ############################# ##################
			//$rankUpdated=$this->getDownLinRank($list->position,$list->rank_id);		
			$this->find_active_parent($list->position,$refID,$i);
			}
			
		 return $this->miASarray;
		}
	}
public function getDownLinRank($userId,$rnkId)
{
	$getResult=$this->db->select('id,topup,name,username,position,rank,rank_id')->from('members')->where('position',$userId)/*->where('topup!=','0.00')*/->order_by('rank_id', 'desc')->limit('4')->get()->result();
	return $getResult;
/*	$getNextRankUpto=$this->get_nextRank('rank_system','id,reward_name','id > ',$rnkId);
	if($getResult)
	{   $x=0;
		foreach($getResult as $nList)
		{
			 if($rnkId==$nList->rank_id){ $x++;}
			 if($x=='4')
			 {
			 	$whereCon=array('username'=>$nList->position);$updateArr=array('rank_id'=>$getNextRankUpto->id,'rank'=>$getNextRankUpto->reward_name);
				$this->update_record('members',$whereCon,$updateArr);
				//if($this->update_record('members',$whereCon,$updateArr)){return 'Rank will Promote from '.$getResult->rank.' to '.$getParentCurrentRank->reward_name;}
				}
			}
		}*/
}		
private function find_active_child($id)
{
	$this->db->select('id,username,name,sponsor,position,A,B,C,D')->from('members')->where('position',$id);$result=$this->db->get();$getresult=$result->result();$myLeg=0;
	if($result->num_rows() > 0){foreach($getresult as $list){++ $myLeg;$myLeg += $this->find_active_child($list->username);}} return $myLeg;
	}	
public function create_earning($userid,$ref_id,$income_name,$amount)
{
    $data = array('userid'=> $userid,'amount'=>$amount,'type'=>$income_name,'ref_id'=>$ref_id,'create_date'=> date('Y-m-d H:s:i'));
	return $data;
/*	if($userid!=$ref_id)
	{
		if($this->db->insert('earning',$data)){return true;}else{return false;}
    	}*/
	}	
/*-----------------------29.06.2023 Testing End-----------------------------------*/
/*public function find_active_parent($id,$refID,$i=0)
{
	$this->db->select('members.id,A,B,C,D,username,name,sponsor,position,total_downline,rank_id,members.rank,reward_name,member_goal,income,other_reward,monthly_income,
					   membership_type')->from('members');$this->db->join('rank_system', 'rank_system.id=members.rank_id', 'left');$this->db->where('username',$id);
	//$this->db->where('topup','1000');
	$result=$this->db->get();$getresult=$result->result();
    $packagePrice=$this->get_package('pack_price');
	$rewards=$this->get_panMemInc();
	if($result->num_rows() > 0)
	{
	  foreach($getresult as $list)
		{   ++$i;
			$getDownLine=$this->find_active_child($list->username);
			$getNextRankUpto=$this->get_nextRank('rank_system','id,reward_name','id > ',$list->rank_id);
			$rnkUpdate=$this->getDownLinRank($list->username,$list->rank_id);
############################# Rnk Update Upto developer menber strt########################################		
	  		
############################# Rnk Update Upto developer menber end#########################################			
$nArr=array('level'=>$i,'id'=>$list->id,'username'=>$list->username,'name'=>$list->name,'position'=>$list->position,'rank_id'=>$list->rank_id,'rank'=>$list->rank,
			'total_downline'=>$getDownLine,'member_goal'=>$list->member_goal,'income'=>$list->income,'other_reward'=>$list->other_reward,'monthly_income'=>$list->monthly_income,
			'nextRnk'=>$getNextRankUpto->reward_name,'miRnk'=>$rnkUpdate);
	        array_push($this->miASarray,$nArr);
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
			//$rankUpdated=$this->getDownLinRank($list->position,$list->rank_id);		
			$this->find_active_parent($list->position,$refID,$i);
			}
			
		 return $this->miASarray;
		}
	}*/



}
