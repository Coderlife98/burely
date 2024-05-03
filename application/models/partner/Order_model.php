<?php
class Order_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function process_query($where = false,$custId)
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

        $this->db->select('*')->from('order_history')->where('customer_id', $custId);
        if (!empty($where['orderId'])) { $this->db->where('invoice_id', $where['orderId']);}
		 if(!empty($where['actnType']))
		{ 
			  if($where['actnType']=='delevered'){$this->db->where('order_status','3');}
			  if($where['actnType']=='undelevered'){$this->db->where('order_status','2');}	
			  if($where['actnType']=='cancelled'){$this->db->where('order_status','1');}			
			}

        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('order_date >=', $where['strtDt']);
            $this->db->where('order_date <=', $where['endDt']);
        }

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }

    public function order_data($where = false,$custId)
    {
        $this->process_query($where,$custId);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function total_count($custId)
    {
        $this->process_query($where = false,$custId);
        return $this->db->get()->num_rows();
    }
    public function filter_count($where = false,$custId)
    {
        $this->process_query($where,$custId);
        return $this->db->get()->num_rows();
    }
public function product_list($searchedData)
	{
		return $this->db->select('p_det.id,p_tbl.product_name,p_det.product_price,p_det.mrp,p_det.discount')->from('product_details as p_det')->like('p_tbl.product_name',$searchedData)->join('product_table as p_tbl', 'p_det.prod_id=p_tbl.id','inner')->get()->result();	
	}
public function temp_kart_add($proId,$usrCate,$soldBy)
	{
	  if($usrCate=='1')
	  {return $this->db->select('p_det.id,p_det.prod_id,p_det.quantity,p_det.unit,p_tbl.product_name,p_det.product_price,p_det.mrp,p_det.discount,p_det.productBV,unit_name,p_det.productTax')->from('product_details as p_det')->where('p_det.id',$proId)->join('product_table as p_tbl', 'p_det.prod_id=p_tbl.id','inner')->join('unit_manage', 'p_det.unit=unit_manage.id','left')->get()->row();	
		
		}
		else
		{
return $this->db->select("ps.product_details_id as id,pt.id as prod_id,ps.product_qty as quantity,pd.unit,product_name,ps.product_price,ps.product_mrp as mrp,pd.discount,pd.productBV,'$soldBy' as soldBy,,unit_name,pd.productTax")->from('product_table as pt')->where('ps.partner_id',$soldBy)->where('pd.id',$proId)->join('product_details as pd','pd.prod_id=pt.id','left')->join('partner_stock as ps','ps.product_details_id=pd.id','left')->join('unit_manage', 'pd.unit=unit_manage.id','left')->get()->row();	
			}
	}	
public function temp_product_count($id)
	{
		return $this->db->select('count(*) as c')->from('temp_product_details')->where('member_id',$id)->get()->row();	
	}	
public function temp_product_list($id,$soldBy,$recvD)
{
	return $this->db->select('*')->from('temp_product_details')->where('member_id',$id)->where('soldBy',$soldBy)->where('receiver_typ',$recvD)->get()->result();
	}
	
public function getProductByFrenchiseStock($FrenchiseID,$proName)
{
return $this->db->select('ps.id,product_name')->from('product_table as pt')->where('ps.partner_id', $FrenchiseID)->like('product_name', $proName)->join('product_details as pd', 'pd.prod_id=pt.id', 'left')->join('partner_stock as ps', 'ps.product_details_id=pd.id', 'left')->get()->result();
	}			
public function temp_kart_add_by_shopee($frenId,$proId)
{
	$soldBy=$frenId;
return $this->db->select("ps.product_details_id as id,pt.id as prod_id,ps.product_qty as quantity,pd.unit,product_name,ps.product_price,ps.product_mrp as mrp,pd.discount,pd.productTax,pd.productBV,'$soldBy' as soldBy")->from('product_table as pt')->where('ps.partner_id',$frenId)->where('ps.id',$proId)->join('product_details as pd','pd.prod_id=pt.id','left')->join('partner_stock as ps','ps.product_details_id=pd.id','left')->get()->row();	
	}	
	
}

  
  
  
  
  

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

