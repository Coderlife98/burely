<?php
class Testing_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
		$this->ASarray = array();
		$this->miASarray = array();
    }
private function miDownLine($id)
{$nDline=$this->db->select('GROUP_CONCAT(username SEPARATOR ",") as child')->from('members')->where('position',(int)$id)->get()->row();return $nDline->child;}		
private function find_active_child($id)
{	
	$this->db->select('id,username,name,sponsor,position,A,B,C,D')->from('members')->where('position',$id);$result=$this->db->get();$getresult=$result->result();$myLeg=0;
	if($result->num_rows() > 0){foreach($getresult as $list){++ $myLeg;$myLeg += $this->find_active_child($list->username);}} return $myLeg;
	}		
private function get_member_rank($id)
{return $this->db->select('m.id, rank_id, rank,income,other_reward,monthly_income')->from('members as m')->join('rank_system', 'rank_system.id=m.rank_id', 'inner')->where('username',$id)->get()->row();}
public function getDownLinRank($userId,$rnkId)
{
	$getResult=$this->db->select('id,topup,name,username,position,rank,rank_id')->from('members')->where('position',$userId)/*->where('topup!=','0.00')*/->order_by('rank_id', 'desc')->limit('4')->get()->result();//return  $this->db->last_query();
	$getNextRankUpto=$this->get_data('rank_system','id,reward_name','id > ',$rnkId); $x=0;
	if($getResult)
	{
		foreach($getResult as $nList){if($rnkId==$nList->rank_id){$x++;}if($getNextRankUpto->id==$nList->rank_id){$x=$x+1;}}
		if($x=='4')
		{
			$whereCon=array('username'=>$nList->position);$updateArr=array('rank_id'=>$getNextRankUpto->id,'rank'=>$getNextRankUpto->reward_name);
			$nrUpdate=$this->update_record('members',$whereCon,$updateArr);
			return $nrUpdate;
			}
		}
}	
 public function active_subscriber($id,$i=0)
 {
      $this->db->select("id,username,position,topup")->from("members")->where('username', (int)$id); $data = $this->db->get()->result();
	  foreach ($data as $dt){if($dt->position!='0'){$this->ASarray[$dt->position].= $this->miDownLine($dt->position);}$this->active_subscriber($dt->position,$i);}
	  return $this->ASarray;
    }	
public function update_record($tblName,$whereCon,$updateArr){$this->db->where($whereCon);if($this->db->update($tblName,$updateArr)){return true;}else{return false;}}
public function get_data($tblName,$sel,$whereCon,$id){ return  $this->db->select($sel)->from($tblName)->where($whereCon,$id)->get()->row();}
public function get_package($sel){ return  $this->db->select($sel)->from('package')->get()->row();}		
public function rank_income($id){ return  $this->db->select('income,other_reward,monthly_income')->from('rank_system')->where('id',$id)->get()->row();}		
public function get_panMemInc(){return $this->db->select('id,dev_mem_frm,dev_mem_to,inc_profit')->from('panchayat_member_income')->get()->result(); }
		
/*-----------------------29.06.2023 Testing Start-----------------------------------*/
 public function get_upline_subscriber($id,$refID)
 {
 		$frLeg=NULL;$frLeg=$this->miDownLine($id);if($frLeg){$this->ASarray[$id]=$frLeg;}$result='';//$this->ASarray[$id]=$frLeg;
		$amount=$this->get_package('pack_price');
		$rewards=$this->get_panMemInc();
		$this->active_subscriber($id,$i=0);
		if($this->ASarray)
		{  $sp=0;
		   foreach($this->ASarray as $key=>$list)
		   {
		   		$sp++;$isMemberCnt=NULL;$updateRank=$this->get_member_rank($key);
				$newArr=explode(",",$list);$nMem=count($newArr);$getDownLine=$this->find_active_child($key);$existing_rnk=$this->get_member_rank($key);
				if($nMem >= 4){$this->getDownLinRank($key,$existing_rnk->rank_id);$isMemberCnt=$this->isCheckFrPanchytDeveloper($key);}
				if($sp=='1')
				{
					if($key!=$refID)
					{
						  #####################################Sponsor Income Start#############################################################
							$percentage=$this->rank_income('2');$freshIncome=($amount->pack_price/100)*$percentage->income;
							$fristGenIncome=$this->create_earning($key,$refID,'Income generated after top up of user id #'.$refID,$freshIncome);
						  #####################################Sponsor Income End###############################################################
						}
					}
			else
			{
				if(5 < $isMemberCnt && $isMemberCnt < 16)			
				{	
					$incMsg='Income from member developer to panchayat member developer of user id #'.$refID;
					if($isMemberCnt >= $rewards[1]->dev_mem_frm && $isMemberCnt <= $rewards[1]->dev_mem_to)
					   {$freshIncome=$rewards[1]->inc_profit;$this->create_earning($key,$refID,$incMsg,$freshIncome);}
						else if($isMemberCnt >= $rewards[2]->dev_mem_frm && $isMemberCnt <= $rewards[2]->dev_mem_to)
							{$freshIncome=$rewards[2]->inc_profit;$this->create_earning($key,$refID,$incMsg, $freshIncome);}
				   }			
					else
					{
						if($existing_rnk->rank_id >=3)
						{
							$freshIncome=($amount->pack_price/100)*$existing_rnk->income;$this->create_earning($list->username,$refID,$list->rank.' level income', $freshIncome);	
							/*if($existing_rnk->rank_id >=7){$freshIncome='Monthly Pay='.$existing_rnk->income.'=='.$existing_rnk->monthly_income;}
							  else{$freshIncome=$existing_rnk->income.'=='.$existing_rnk->other_reward;}*/
							} /*else{$freshIncome='0.00';}*/
						}		
						
						
						
							
				}
/*				$result='<tr>
							 <th>'.$sp.'.</th><td>'.$getDownLine.'</td><td>'.$key.'</td><td>'.$list.'</td><td>'.$existing_rnk->rank.'</td>
							 <td>'.$existing_rnk->rank_id.'=='.$freshIncome.'</td><td>'.$updateRank->rank.'</td>
						 </tr>';						
				print_r($result);*/	
			}
		 }
		// else{$result='Oops it seems there no member is available to this user id'; print_r($result);}	
	}
	
public function isCheckFrPanchytDeveloper($userId)
{
	 $getResult=$this->isCheckMatrix($userId);$isMemberCnt='0';	 
	 if($getResult){foreach($getResult as $val){$getInsideMember=$this->isCheckMatrix($val->username);$isMemberCnt=$isMemberCnt+count($getInsideMember);}return $isMemberCnt;}
	}
public function isCheckMatrix($userId)
{
 return $this->db->select('id,topup,name,username,position,rank,rank_id')->from('members')->where('position',$userId)/*->where('topup!=','0.00')*/->order_by('rank_id', 'desc')->limit('4')->get()->result();	
	}
	


/*-----------------------29.06.2023 Testing End-----------------------------------*/	
public function create_earning($userid,$ref_id,$income_name,$amount)
{   $data = array('userid'=> $userid,'amount'=>$amount,'type'=>$income_name,'ref_id'=>$ref_id,'create_date'=> date('Y-m-d H:s:i'));
	return $data;/*	if($userid!=$ref_id){if($this->db->insert('earning',$data)){return true;}else{return false;}}*/
	}	













}
