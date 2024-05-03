<?php
class Order_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }	

    public function process_query($where = false,$uid)
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
       $this->db->select('*')->from('sale_history')->where('customer_id', $uid)/*->where('soldBy', '2')*/;
     /*   if(!empty($where['refId'])){$this->db->where('ref_id',$where['refId']);}
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
        }*/
        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function my_ordes($where = false,$uid)
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
	
	public function recentOrder($id)
	{
		return $this->db->select('ordH.*,p.username,p.name,p.mobile')->from('sale_history as ordH')->join('msdr_members as p', 'p.id=ordH.customer_id', 'left')->where('customer_id',$id)->where('soldBy','2')->limit(5,0)->get()->result();
		}
public function getProductByFrenchiseStock($FrenchiseID,$proName)
{
return $this->db->select('pt.id,product_name')->from('product_table as pt')->where('ps.partner_id', $FrenchiseID)->like('product_name', $proName)->join('product_details as pd', 'pd.prod_id=pt.id', 'left')->join('partner_stock as ps', 'ps.product_details_id=pd.id', 'left')->get()->result();
	}
public function getProviderDet($id)
{
return $this->db->select('m.id,m.username,m.name,m.email,m.mobile,m.address,stt.state_cities as stN,cty.state_cities as ctyN,b.state,b.district,b.zipcode')->from('partners as m')->where('m.id', $id)->join('partners_basic_manage as b', 'b.mem_id=m.id', 'left')->join('states_cities as stt', 'stt.id=b.state', 'left')->join('states_cities as cty', 'cty.id=b.district', 'left')->get()->row();
	}
public function getBuyerDet($id)
{
return $this->db->select('m.id,m.username,m.name,m.email,m.mobile,m.address,stt.state_cities as stN,cty.state_cities as ctyN,b.state,b.district,b.zipcode')->from('msdr_members as m')->where('m.id', $id)->join('msdr_member_basic as b', 'b.mem_id=m.id', 'left')->join('states_cities as stt', 'stt.id=b.state', 'left')->join('states_cities as cty', 'cty.id=b.district', 'left')->get()->row();
	}	
public function temp_kart_add_by_member($frenId,$proId)
{
	$soldBy=$frenId;
return $this->db->select("ps.product_details_id as id,pt.id as prod_id,ps.product_qty as quantity,pd.unit,product_name,ps.product_price,ps.product_mrp as mrp,pd.discount,pd.productBV,'$soldBy' as soldBy,pd.productTax")->from('product_table as pt')->where('ps.partner_id',$frenId)->where('pt.id',$proId)->join('product_details as pd','pd.prod_id=pt.id','left')->join('partner_stock as ps','ps.product_details_id=pd.id','left')->get()->row();	
	}		

public function temp_kart_add($proId,$sellerID)
{
	 
return $this->db->select("ps.product_details_id as id,pt.id as prod_id,ps.product_qty as quantity,pd.unit,product_name,ps.product_price,ps.product_mrp as mrp,pd.discount,pd.productBV,'$soldBy' as soldBy,unit_name,pd.productTax")->from('product_table as pt')->where('ps.partner_id',$sellerID)->where('pd.id',$proId)->join('product_details as pd','pd.prod_id=pt.id','left')->join('partner_stock as ps','ps.product_details_id=pd.id','left')->join('unit_manage', 'pd.unit=unit_manage.id','left')->get()->row();	
			
	}	


public function temp_product_count_seller_to_buyer($id,$slrId,$slrTyp){return $this->db->select('count(*) as c')->from('temp_product_details')->where('member_id',$id)->where('seller_id',$slrId)->where('soldBy',$slrTyp)->where('receiver_typ','3')->get()->row();}


















}
