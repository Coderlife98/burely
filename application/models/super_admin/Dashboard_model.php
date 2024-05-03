<?php
class Dashboard_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
public  function recent_joint(){ return $this->db->select('*')->from('msdr_members')->limit(5,0)->order_by('id', 'desc')->get()->result();}


public  function memberBv(){ return $this->db->select('sum(earnedBV) as earnBV ')->from('earning')->get()->row();}








public function recentSale()
{
	return $this->db->select('ordH.*,p.username,p.name,p.mobile')->from('order_history as ordH')->join('partners as p', 'p.id=ordH.customer_id', 'left')->where('soldBy','0')->limit(5,0)->order_by('id', 'desc')->get()->result();
		
	}
	
	
public function frenchiseBv()
{
	$proSale=$this->db->select('sum(earnedBv) as Bv')->from('order_history')->where('order_status','3')->where('soldBy','1')->get()->row();
	$packSale=$this->db->select('sum(pack_bv) as Bv')->from('package_purchase_details')->where('status','Used')->where('pur_type','1')->get()->row();
	$earnBV=0;
	if($proSale){$earnBV=$proSale->Bv;}
	if($packSale){$earnBV+=$packSale->Bv;}
		return $earnBV;
	
	}	
public function shopeeBv()
{
	$proSale=$this->db->select('sum(earnedBv) as Bv')->from('order_history')->where('order_status','3')->where('soldBy','2')->get()->row();
	$packSale=$this->db->select('sum(pack_bv) as Bv')->from('package_purchase_details')->where('status','Used')->where('pur_type','2')->get()->row();
	$earnBV=0;
	if($proSale){$earnBV=$proSale->Bv;}
	if($packSale){$earnBV+=$packSale->Bv;}
		return $earnBV;
	
	
	
		
	}		

}
