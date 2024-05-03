<?php
class Dashboard_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }	
public function purchase($uid,$id,$uCat)
{	
	if($uCat=='1'){ $soldBy='0';}else{$soldBy='1';}$earnBV=0;
	$proSale=$this->db->select('sum(paid_amt) as price')->from('order_history')->where('order_status','3')->where('customer_id',$id)->where('soldBy',$soldBy)->get()->row();
	$packSale=$this->db->select('sum(grndAmt) as price')->from('package_purchase')->where('order_status','Delivered')->where('mem_id',$uid)->where('pur_type',$uCat)->get()->row();
	if($proSale){$earnBV=$proSale->price;}if($packSale){$earnBV+=$packSale->price;}
		return $earnBV;
	
	}
	public function sale($id,$purTblName,$u_cate,$uid)
{
	$earnBV=0;
	$proSale=$this->db->select('sum(paid_amt) as price')->from($purTblName)->where('seller_id',$id)->where('soldBy',$u_cate)->where('order_status','3')->get()->row();	
	$packSale=$this->db->select('sum(amount) as price')->from('package_purchase_details')->where('status','Used')->where('issue_to',$uid)->where('pur_type',$u_cate)->get()->row();
	if($proSale){$earnBV=$proSale->price;}if($packSale){$earnBV+=$packSale->price;}
		return $earnBV;
	
	}
	
public function earnBV($id,$purTblName,$u_cate)
{
	return $this->db->select('sum(earnedBv) as Bv')->from($purTblName)->where('seller_id',$id)->where('soldBy',$u_cate)->where('order_status','3')->get()->row();	
	}
	
public function securityAmt($id)
{
	return $this->db->select('debit_amt as amount')->from('partner_wallet_transaction')->where('user_id',$id)->where('tnx_typ','1')->get()->row();
	//return $this->db->select('topup as amount')->from('partners')->where('username',$id)->get()->row();	
		
	}	
	
public function recentPurchase($id,$catTyp)
{
	if($catTyp=='1'){$soldBy='0';}elseif($catTyp=='2'){$soldBy='1';}
return $this->db->select('ordH.*,p.username,p.name,p.mobile')->from('order_history as ordH')->join('partners as p', 'p.id=ordH.customer_id', 'left')->where('customer_id',$id)->where('soldBy',$soldBy)->limit(5,0)->get()->result();
	}
	
public function recentSale($id,$catTyp)
{
	if($catTyp=='1')
	{
	return $this->db->select('ordH.*,p.username,p.name,p.mobile')->from('order_history as ordH')->join('partners as p', 'p.id=ordH.customer_id', 'left')->where('seller_id',$id)->where('soldBy','1')->limit(5,0)->get()->result();
		}
		elseif($catTyp=='2')
		{
			return $this->db->select('ordH.*,p.username,p.name,p.mobile')->from('sale_history as ordH')->join('msdr_members as p', 'p.id=ordH.customer_id', 'left')->where('seller_id',$id)->limit(5,0)->get()->result();
			}
	}		
public function getEmpDet($id)
{
	return $this->db->select('user_code as username,name')->from('users')->where('id',$id)->get()->row();
	
	}	
	
	
public function recentPackageSale($id,$catTyp)
{
/*SELECT ppd.id,ppd.amount,ppd.pack_bv,used_by,used_date,p.pack_name FROM package_purchase_details as ppd left join package as p on p.pack_price=ppd.amount where ppd.issue_to='F28782' and ppd.pur_type='1' and ppd.status='Used' order by id desc */




return $this->db->select('ppd.id,pack_nu,ppd.amount,ppd.pack_bv,used_by,used_date,p.pack_name')->from('package_purchase_details as ppd')->join('package as p', 'p.pack_price=ppd.amount', 'left')->where('ppd.issue_to',$id)->where('ppd.pur_type',$catTyp)->where('ppd.status','Used')->limit(5,0)->get()->result();
	}	
	
			
}

  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

