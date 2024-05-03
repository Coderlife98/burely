<?php
class Demo_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
		$this->ASarray = array();
		$this->miASarray = array();
    }	
private function miDownLine($id)
{$nDline=$this->db->select('GROUP_CONCAT(username SEPARATOR ",") as child')->from('msdr_members')->where('sponsor',$id)->get()->row();return $nDline->child;}		
private function get_allTypeInc(){return $this->db->select('*')->from('club_income')->where('id','1')->get()->row(); }
public function get_package($pPrice){ return  $this->db->select('b_volume')->from('package')->where('pack_price',$pPrice)->get()->row();}
public function active_subscriber($id,$i=0)
{
      $this->db->select("id,username,sponsor,topup")->from("msdr_members")->where('username', $id); $data = $this->db->get()->result();
	  foreach ($data as $dt)
	  {
	  	if($dt->sponsor!='0')
		{
			$this->ASarray[$dt->sponsor].= $this->miDownLine($dt->sponsor);
			}
			$this->active_subscriber($dt->sponsor,$i);
			}
	  return $this->ASarray;
    }	
public function create_earning($userid,$ref_id,$income_name,$earnedBv,$amount,$total_bv,$incTyp)
{   $data=array('earn_type'=>$incTyp,'userid'=>$userid,'amount'=>$amount,'total_bv'=>$total_bv,'earnedBv'=>$earnedBv,'type'=>$income_name,'ref_id'=>$ref_id,'create_date'=>date('Y-m-d H:s:i'));
	return $data;	
	//if($userid!=$ref_id){if($this->db->insert('earning',$data)){return true;}else{return false;}}
	}
 public function get_upline_subscriber($id,$refID,$pPrice)
 {
		$amount=$this->get_package($pPrice);$rewards=$this->get_allTypeInc();
		$frLeg=NULL;$frLeg=$this->miDownLine($id);if($frLeg){$this->ASarray[$id]=$frLeg;}$result='';
	    $incPer=array($rewards->sponsor_income,$rewards->first_repurchase_incom,$rewards->second_repurchase_incom,$rewards->third_repurchase_incom,$rewards->four_repurchase_incom);
		$this->active_subscriber($id,$i=0);
		if($this->ASarray)
		{  $sp=0;$getResult='';
		   foreach($this->ASarray as $key=>$list)
		   {
		   		
				
				
			if($key!=$refID)
			{	
				$sp++;
				if($sp==1)
				{
					$incomeBv=$amount->b_volume*$incPer[0]/100;
					$income='<span style="color:#016799">Sponsor Income-'.$incomeBv.'</span>';
					$pecentage=$incPer[0];
					$generateIncome=$this->create_earning($key,$refID,'Sponsor income after activate package of user id #'.$refID,$incomeBv,$pPrice,$amount->b_volume);
					}
				else if(1 < $sp && $sp <= 5)
				{  
		          	$myInc=$sp-1;
					$link=$myInc-1;
					$linkIcn=array('st','nd','rd','th');
					$incomeBv=$amount->b_volume*$incPer[$myInc]/100;
					$income='<span style="color:#016799">Level Income-'.$incomeBv.'</span>';	
					$pecentage=$incPer[$myInc];
					$generateIncome=$this->create_earning($key,$refID,$myInc.'<sup>'.$linkIcn[$link].'</sup> level income of user id #'.$refID,$incomeBv,$pPrice,$amount->b_volume);
					}
					/*else{$income='<span style="color:#b70c0c;font-weight: 700;">Cross Level</span>';	}*/
			//print_r($generateIncome);	echo '<br>';		
			$getResult.='<tr>
							  <th>'.$sp.'.</th>
							  <td>'.$sp.'</td>
							  <td>'.$list.'</td>
							  <td>'.$key.'</td>
							  <td>'.$amount->b_volume.'</td>
							  <td>'.$pecentage.'</td>
							  <td>'.$income.'</td>
						</tr>';
		  
		  if ($sp==5){break;}
		  }
		   }
		  return $getResult;
		}
		else
		{     
		  return '<tr><td colspan="5" style="text-transform:uppercase; color:#9D0000;text-align: center;font-weight: 600;">There is no parrent available here</td></tr>';
		}
	}	
 public function activate_plan($id,$refID,$pPrice)
 {
		$amount=$this->get_package($pPrice);$rewards=$this->get_allTypeInc();
		$frLeg=NULL;$frLeg=$this->miDownLine($id);if($frLeg){$this->ASarray[$id]=$frLeg;}$result='';
	    $incPer=array($rewards->sponsor_income,$rewards->first_repurchase_incom,$rewards->second_repurchase_incom,$rewards->third_repurchase_incom,$rewards->four_repurchase_incom);
		$this->active_subscriber($id,$i=0);
		if($this->ASarray)
		{  $sp=0;
		   foreach($this->ASarray as $key=>$list)
		   {
		   	if($key!=$refID)
			{	
				$sp++;
				if($sp==1)
				{   
					$result='1';$incomeBv=$amount->b_volume*$incPer[0]/100;
					$generateIncome=$this->create_earning($key,$refID,'Sponsor income after activate package of user id #'.$refID,$incomeBv,$pPrice,$amount->b_volume);
					print_r($generateIncome);echo '<br>';
					}
				else if(1 < $sp && $sp <= 5)
				{  
		          	$result='1';$myInc=$sp-1;$link=$myInc-1;$linkIcn=array('st','nd','rd','th');$incomeBv=$amount->b_volume*$incPer[$myInc]/100;
					$generateIncome=$this->create_earning($key,$refID,$myInc.'<sup>'.$linkIcn[$link].'</sup> level income of user id #'.$refID,$incomeBv,$pPrice,$amount->b_volume);
					print_r($generateIncome);echo '<br>';
					}
		 		  if($sp==5){break;}
			   }
		   }
		  /* if($result=='1')
		   {
		   		return 'Successfully generate income';
		   }
		   else
		   {
		   		return 'Ooops it seems there no income generate';
				
				}*/
		   
		}
		
	}	

/*---------------------------------------------------------------*/	

public function active_child($id)
{/*
      $this->db->select("id,username,sponsor,topup")->from("msdr_members")->where('sponsor',$id); $data = $this->db->get()->result();
	  $cnt=0;
	  foreach ($data as $dt)
	  { ++$cnt;
	  	if($dt->sponsor!='0')
		{
			if($cnt=='1')
			{
				$this->ASarray[$id].=$dt->username;
				}
				else
				{
					$this->ASarray[$id].= ','.$dt->username;
					}
			
			
			}
			$this->active_child($dt->username,$i);
			}
	  return $this->ASarray;*/
	  $this->db->select("id,username")->from("msdr_members")->where('sponsor',$id);
		$data = $this->db->get()->result();
		$getAllId='getChild';
		foreach ($data as $dt) 
		{
			//$this->ASarray['PersonCount'] += 1;
			if(isset($this->ASarray[$getAllId])){ $this->ASarray[$getAllId].= ','.$dt->username;}
			else{$this->ASarray[$getAllId] = $dt->username;}
			$this->active_child($dt->username,$i);
		}
		return $this->ASarray;
}	
/****************************************Sponsor Income Start********************************************/
 public function generate_repurchase($id,$refID,$tAmt,$repurBV)
 {
	   $rewards=$this->get_allTypeInc();
	   $frLeg=NULL;$frLeg=$this->miDownLine($id);if($frLeg){$this->ASarray[$id]=$frLeg;}$result='';
	   $incPer=array($rewards->first_gen_incom,$rewards->second_repurchase_incom,$rewards->third_repurchase_incom,$rewards->four_repurchase_incom);
	   $this->active_subscriber($id,$i=0);
		if($this->ASarray)
		{  $sp=0;
		   foreach($this->ASarray as $key=>$list)
		   {
		   	if($key!=$refID)
			{	
				$sp++;
				if($sp==1)
				{   
					$result='1';$incomeBv=$repurBV*$incPer[0]/100;
				$generateIncome=$this->create_earning($key,$refID,'Income generated after product repurchase of user id #'.$refID,$incomeBv,$tAmt,$repurBV,'11');
					print_r($generateIncome);
					}
				else if(1 < $sp && $sp <= 5)
				{  
		          	$result='1';$myInc=$sp-1;$link=$myInc-1;$linkIcn=array('st','nd','rd','th');$incomeBv=$repurBV*$incPer[$myInc]/100;
				$generateIncome=$this->create_earning($key,$refID,$myInc.'<sup>'.$linkIcn[$link].'</sup> level repurchase income of user id #'.$refID,$incomeBv,$tAmt,$repurBV,'11');
					echo '<br>';print_r($generateIncome);
					}
		 		  if($sp==5){break;}
			   }
		   }
		  // if($result=='1'){return 'Successfully generate income';}else{return 'Ooops it seems there no income generate';}
		   
		}
		
	}	
/*****************************************Sponsor Income End*********************************************/
/*public function getIncomeOfDownline($id)
{
	$getMember=$this->active_child($id);
	if($getMember)
	{
		if($this->ASarray['getChild'])
		{
			$getIDinArr=explode(",",$this->ASarray['getChild']);
				$getResult='';$sp=0;
				$totalEarnig=0;
			foreach($getIDinArr as $list)
			{++$sp;
			  $income=$this->getRecentIncome($list);
			  if($income->earnBv){ $earning=$income->earnBv;}else{$earning=0;}
			  $totalEarnig+=$earning;
			  $getResult.='<tr>
							  <th>'.$sp.'.</th>
							  <td>'.$list.'</td>
							  <td>'.$earning.'</td>
							  <td>'.$sp.'</td>
							  <td>'.$sp.'</td>
						  </tr>'; 
			   
			   }
			   $getResult.='<tr>
							  <td colspan="2"></td>
							  <td>'.$totalEarnig.'</td>
							  <td colspan="2"></td>
							  
						  </tr>'; 
		 		return $getResult;
			}
		
		
		
		}
}*/

public function getIncomeOfDownline($id)
{
	$getMember=$this->active_child($id);
	if($getMember)
	{
		if($this->ASarray['getChild'])
		{
			$getIDinArr=explode(",",$this->ASarray['getChild']);$totalEarnig=0;
			foreach($getIDinArr as $list){$income=$this->getRecentIncome($list);if($income->earnBv){$earning=$income->earnBv;}else{$earning=0;}$totalEarnig+=$earning;}
			return $totalEarnig;
			}
	}
}
private function getRecentIncome($uid){return  $this->db->select("sum(earnedBv) as earnBv")->from("earning")->where('userid',$uid)->where('status','Pending')->get()->row();}
public function isCheckChildIncome($id)
{
	$this->db->select("*")->from("earning")->where('userid',$uid)->where('status','Pending')->get()->row();
	}






}
