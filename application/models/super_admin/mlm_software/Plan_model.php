<?php
defined("BASEPATH") or exit("No direct script access allowed");
class Plan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function create_leg()
    {
        $leg = config_item("leg");
        if ($leg == "1") {
            return array("A" => "Left");
        }
        if ($leg == "2") {
            return array("A" => "Left", "B" => "Right");
        }
        if ($leg == "3") {
            return array("A" => "A", "B" => "B", "C" => "C");
        }
        if ($leg == "4") {
            return array("A" => "A", "B" => "B", "C" => "C", "D" => "D");
        }
        if ($leg == "5") {
            return array("A" => "A", "B" => "B", "C" => "C", "D" => "D", "E" => "E");
        }
        if ($leg == "6") {
            return array("A" => "A", "B" => "B", "C" => "C", "D" => "D", "E" => "E", "F" => "F");
        }
    }
/*-------------------------Written by Amit start---------------------------*/
public function getMemberDetailsWithChild($id)
{
     $this->db->select('p.id as Pid,A_ch.id as Aid,B_ch.id as Bid,C_ch.id as Cid,D_ch.id as Did,p.position as sponsor,p.username as P_id,A_ch.username as A_id,B_ch.username as 				                        B_id, C_ch.username as C_id,D_ch.username as D_id,p.name as p_name,A_ch.name as Achild,
					    B_ch.name as Bchild,C_ch.name as Cchild,D_ch.name as Dchild ,p.my_img as p_img,A_ch.my_img as A_img,B_ch.my_img as B_img,C_ch.my_img as C_img,
					    D_ch.my_img as D_img,p.status as p_status,A_ch.status as A_status,B_ch.status as B_status,C_ch.status as C_status,D_ch.status as D_status');
	 $this->db->from('members as p')->where('p.username', $id)->join('members as A_ch', 'p.A=A_ch.username', 'left')->join('members as B_ch', 'p.B=B_ch.username', 'left');			
	 $this->db->join('members as C_ch', 'p.C=C_ch.username', 'left')->join('members as D_ch', 'p.D=D_ch.username', 'left');
	 $result=$this->db->get();
	 return $result->row();
}
public function imgBlank($img,$uStatus)
{
	if($uStatus=='Active')
	{
		$imgA_loc=base_url().'uploads/user/thumb_image/tree/green.png';
		}
		else if($uStatus=='Suspend')
		{
			$imgA_loc=base_url().'uploads/user/thumb_image/tree/yellow.png';
			}
		else if($uStatus=='Block')
		{
			$imgA_loc=base_url().'uploads/user/thumb_image/tree/red.png';
			}
	return $imgA_loc;
	}
public function mmeberStatus($uStatus)
{
	if($uStatus=='Active')
	{
		$imgBg='style="border: 2px solid #79BC00;"';
		}
		else if($uStatus=='Suspend')
		{
			$imgBg='style="border: 2px solid #F59404;"';
			}
		else if($uStatus=='Block')
		{
			$imgBg='style="border: 2px solid #DD574C;"';
			}
	return $imgBg;
	}
public function getTooltip($getId)
{
  if($getId->A_id!=0){$fLegAt=1+$this->find_my_legs($getId->A_id);}else{$fLegAt='0';}
  if($getId->B_id!=0){$fLegBt=1+$this->find_my_legs($getId->B_id);}else{$fLegBt='0';}
  if($getId->C_id!=0){$fLegCt=1+$this->find_my_legs($getId->C_id);}else{$fLegCt='0';}
  if($getId->D_id!=0){$fLegDt=1+$this->find_my_legs($getId->D_id);}else{$fLegDt='0';}
  return 'A : '.$fLegAt.' <br> B : '.$fLegBt.' <br> C : '.$fLegCt.' <br> D : '.$fLegDt.' <br> ID : '.$getId->P_id.' <br> Sponsor Id : '.$getId->sponsor.''; 
			
	} 

public function find_my_legs($id)
{
/*	$sql="SELECT mParent.id,mParent.username,mParent.name,mParent.sponsor,mParent.position,GROUP_CONCAT(subChild.username SEPARATOR '==') as sub_child FROM members as mParent left join members as subChild on subChild.position=mParent.username GROUP by mParent.position";*/
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
			$myLeg += $this->find_my_legs($list->username);
			}	
		}
	 return $myLeg;
	}
 public function find_child_position($tblName,$byFldName,$paraMeter)
 {   $this->db->select('id,A,B,C,D,name,sponsor,username,my_img,status');
   	 $this->db->from($tblName);
	 $this->db->where($byFldName,$paraMeter);
	 $result=$this->db->get();	
	 return $result->row_array();
    }
public function allchild($tblName,$id)
{
	$this->db->select('A,B,C,D');
	$this->db->from($tblName);
	$this->db->where_in('username',$id);
	$result=$this->db->get();	
	return $result->result();
	
	}
public function last_member_activity($sponsrId)
{
    $this->db->select('create_date');
	$this->db->from('members');
	$this->db->where('sponsor', $sponsrId);
	/*$this->db->where('topup !=','0.00');*/
	$this->db->order_by('id', 'desc');
	$this->db->limit(4, 0);	 	
	$result=$this->db->get();
	return $result->result();
	}
    public function find_position($id,$existingRnk)
    {
        $this->db->select('username,rank_id,rank')->from("members")->where(array("position" => $id))/*->where("topup !=",'0.00')*/;
        $result = $this->db->get()->result();
		if($result)
		{
			$cnt=0;
			$memArr=array();
			foreach($result as $rnk)
			{	
				if($existingRnk==$rnk->rank_id)
				{	
					$cnt++;
					}
					else{array_push($memArr,$rnk->username);}
					
				}
				if($cnt < 4 && $cnt > 2)
				{
					$result=$this->db->select('name')->from("members")->where(array("username" => $memArr[0]))->get()->row();
					 return 'Please promote '.$result->name. ' of member Id : '.$memArr[0];
					}
					else{ return 'Please promote your dowline';}
			}
    }	
	
/*-------------------------Written by Amit end---------------------------*/
    public function find_extreme_position($id, $leg)
    {
        $this->db->select($leg)->from("members")->where(array("username" => $id));
        $result = $this->db->get()->row();
        if ($result->{$leg} == 0) {
            return $id;
        }
        return $this->find_extreme_position($result->{$leg}, $leg);
    }
    public function check_position($position, $leg)
    {
        $this->db->select($leg)->from("member")->where("id", $position);
        $result = $this->db->get()->row();
        if ($result->{$leg} == 0) {
            return $position;
        }
        return false;
    }
    public function find_autopool_field($sponsor = "")
    {
        if (config_item("leg") == "1") {
            $this->db->select("id,A")->from("member")->where("A", 0)->order_by("secret", "ASC")->limit(1);
            $result = $this->db->get()->row();
            $id = $result->id;
            if (trim($result->A) == "0") {
                $position = "A";
            }
        }
        if (config_item("leg") == "2") {
            $this->db->select("id,A,B")->from("member")->where("A", 0)->or_where("B", 0)->order_by("secret", "ASC")->limit(1);
            $result = $this->db->get()->row();
            $id = $result->id;
            if (trim($result->A) == "0") {
                $position = "A";
            } else {
                $position = "B";
            }
        }
        if (config_item("leg") == "3") {
            $this->db->select("id,A,B,C")->from("member")->where("A", 0)->or_where("B", 0)->or_where("C", 0)->order_by("secret", "ASC")->limit(1);
            $result = $this->db->get()->row();
            $id = $result->id;
            if (trim($result->A) == "0") {
                $position = "A";
            } else {
                if (trim($result->B) == "0") {
                    $position = "B";
                } else {
                    $position = "C";
                }
            }
        }
        if (config_item("leg") == "4") {
            $this->db->select("id,A,B,C,D")->from("member")->where("A", 0)->or_where("B", 0)->or_where("C", 0)->or_where("D", 0)->order_by("secret", "ASC")->limit(1);
            $result = $this->db->get()->row();
            $id = $result->id;
            if (trim($result->A) == "0") {
                $position = "A";
            } else {
                if (trim($result->B) == "0") {
                    $position = "B";
                } else {
                    if (trim($result->C) == "0") {
                        $position = "C";
                    } else {
                        $position = "D";
                    }
                }
            }
        }
        if (config_item("leg") == "5") {
            $this->db->select("id,A,B,C,D,E")->from("member")->where("A", 0)->or_where("B", 0)->or_where("C", 0)->or_where("D", 0)->or_where("E", 0)->order_by("secret", "ASC")->limit(1);
            $result = $this->db->get()->row();
            $id = $result->id;
            if (trim($result->A) == "0") {
                $position = "A";
            } else {
                if (trim($result->B) == "0") {
                    $position = "B";
                } else {
                    if (trim($result->C) == "0") {
                        $position = "C";
                    } else {
                        if (trim($result->D) == "0") {
                            $position = "D";
                        } else {
                            $position = "E";
                        }
                    }
                }
            }
        }
        return array("id" => $id, "position" => $position);
    }

/*-------------------------Written by 28.06.2023 start---------------------------*/
  public function getDownLine($id)
  {
	 	$result= $this->db->select('id,username,name,sponsor,position,my_img,topup,status')->from('members')->where('position',$id)->get()->result();
	 	$newResult=array();
		if($result)
	 	{
			foreach($result as $list)
			{	
				$noLeg=$this->find_my_legs($list->username);
				$miArr=array('id'=>$list->id,'username'=>$list->username,'name'=>$list->name,'sponsor'=>$list->sponsor,'position'=>$list->position,'my_img'=>$list->my_img,'topup'=>$list->topup,'status'=>$list->status,'tDown'=>$noLeg);
				array_push($newResult,$miArr);
				}
				return $newResult;
		  }
	}	
  public function downStatus($uStatus)
  {
	if($uStatus=='Active')
	{
		$imgBg='style="border: 1px solid #79BC00;"';
		}
		else if($uStatus=='Suspend')
		{
			$imgBg='style="border: 1px solid #F59404;"';
			}
		else if($uStatus=='Block')
		{
			$imgBg='style="border: 1px solid #DD574C;"';
			}
	return $imgBg;
	}		
	
}
