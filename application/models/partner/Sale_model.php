<?php
class Sale_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function process_query($where = false,$custId,$tblName,$uCat)
    {
        $field = array('id', 'invoice_id', 'grand_total', 'paid_amt');
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

        $this->db->select('*')->from($tblName)->where('seller_id', $custId);
      	if($uCat=='1'){$this->db->where('soldBy', $uCat);}
	    if (!empty($where['orderId'])) { $this->db->where('invoice_id', $where['orderId']);}
		 if(!empty($where['actnType']))
		{ 
			  if($where['actnType']=='delevered'){$this->db->where('order_status','3');}
			  if($where['actnType']=='placed'){$this->db->where('order_status','1');}	
			  if($where['actnType']=='cancelled'){$this->db->where('order_status','0');}			
			}

        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('delevery_date >=', $where['strtDt']);
            $this->db->where('delevery_date <=', $where['endDt']);
        }

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }

    public function sale_data($where = false,$custId,$tblName,$uCat)
    {
        $this->process_query($where,$custId,$tblName,$uCat);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function total_count($custId,$tblName,$uCat)
    {
        $this->process_query($where = false,$custId,$tblName,$uCat);
        return $this->db->get()->num_rows();
    }
    public function filter_count($where = false,$custId,$tblName,$uCat)
    {
        $this->process_query($where,$custId,$tblName,$uCat);
        return $this->db->get()->num_rows();
    }
	
public function temp_product_count_seler_to_buyer($id,$slrId)
{
	return $this->db->select('count(*) as c')->from('temp_product_details')->where('member_id',$id)->where('seller_id',$slrId)->get()->row();	
	}
	
public function getFrenchiseStock($frID,$proID)
{
	$this->db->from('partner_stock');
	$this->db->where('partner_id',$frID);	
	$this->db->where('product_details_id',$proID);				   
	$result=$this->db->get();
	return $result->row();
	}	
public function getSaleHistory($id)
{
	return $this->db->select('mem.username,sHistry.*')->from('sale_history as sHistry')->where('sHistry.id',$id)->join('msdr_members mem', 'mem.id=sHistry.customer_id','inner')->get()->row_array(); 
	}		


  public function pack_query($where = false,$uid)
    {
        $field = array('id', 'tnx_id', 'total_amount', 'pack_amt');
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

        $this->db->select('*')->from('package_purchase')->where('mem_id',$uid);
   /*     if (!empty($where['orderId'])) { $this->db->where('invoice_id', $where['orderId']);}
		 if(!empty($where['actnType']))
		{ 
			  if($where['actnType']=='delevered'){$this->db->where('order_status','3');}
			  if($where['actnType']=='placed'){$this->db->where('order_status','1');}	
			  if($where['actnType']=='cancelled'){$this->db->where('order_status','0');}			
			}

        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('delevery_date >=', $where['strtDt']);
            $this->db->where('delevery_date <=', $where['endDt']);
        }*/

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function package_data($where = false,$uid)
    {
        $this->pack_query($where,$uid);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function packtotal_count($uid)
    {
        $this->pack_query($where = false,$uid);
        return $this->db->get()->num_rows();
    }
    public function packfilter_count($where = false,$uid)
    {
        $this->pack_query($where,$uid);
        return $this->db->get()->num_rows();
    }		
		
		
/****************************************Package Manage ********************************************/	

public function getPackagePurchasedList($pur_id)
{
   return $this->db->select('ppd.id,ppd.pur_id,ppd.pur_type,ppd.pack_id,p.pack_name,ppd.pack_nu,ppd.amount,ppd.pack_bv,ppd.issue_to,ppd.generate_time,ppd.generated_type,ppd.generated_by,ppd.used_by,ppd.used_date,ppd.status')->from('package_purchase_details as ppd')->where('ppd.pur_id',$pur_id)->join('package as p', 'p.id=ppd.pack_id','left')->get()->result_array();
 }		



  public function pack_nu_query($where = false,$uid)
    {
        $field = array('id', 'tnx_id', 'total_amount', 'pack_amt');
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
$this->db->select('ppd.id,ppd.pur_id,ppd.pur_type,ppd.pack_id,p.pack_name,ppd.pack_nu,ppd.amount,ppd.pack_bv,ppd.issue_to,ppd.generate_time,ppd.generated_type,ppd.generated_by,ppd.used_by,ppd.used_date,ppd.status')->from('package_purchase_details as ppd')->where('pp.mem_id',$uid)->join('package as p', 'p.id=ppd.pack_id','left')->join('package_purchase as pp', 'pp.id=ppd.pur_id','left');
   /*     if (!empty($where['orderId'])) { $this->db->where('invoice_id', $where['orderId']);}
		 if(!empty($where['actnType']))
		{ 
			  if($where['actnType']=='delevered'){$this->db->where('order_status','3');}
			  if($where['actnType']=='placed'){$this->db->where('order_status','1');}	
			  if($where['actnType']=='cancelled'){$this->db->where('order_status','0');}			
			}

        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('delevery_date >=', $where['strtDt']);
            $this->db->where('delevery_date <=', $where['endDt']);
        }*/

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function package_nu_data($where = false,$uid)
    {
        $this->pack_nu_query($where,$uid);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function pack_nu_total_count($uid)
    {
        $this->pack_nu_query($where = false,$uid);
        return $this->db->get()->num_rows();
    }
    public function pack_nu_count($where = false,$uid)
    {
        $this->pack_nu_query($where,$uid);
        return $this->db->get()->num_rows();
    }		
		
public function use_package($id)
{
	return $this->db->select('ppd.id,ppd.pur_id,ppd.pur_type,ppd.pack_id,p.pack_name,ppd.pack_nu,ppd.amount,ppd.pack_bv,ppd.issue_to,ppd.generate_time,ppd.generated_type,ppd.generated_by,ppd.used_by,ppd.used_date,ppd.status')->from('package_purchase_details as ppd')->where('ppd.id',$id)->join('package as p', 'p.id=ppd.pack_id','left')->join('package_purchase as pp', 'pp.id=ppd.pur_id','left')->get()->row();
	}		









		
}

  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

