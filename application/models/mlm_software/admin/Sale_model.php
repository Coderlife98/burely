<?php
class Sale_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function process_query($where = false)
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

        $this->db->select('*')->from('order_history')->where('soldBy','0');
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
    public function sale_data($where = false)
    {
        $this->process_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function total_count()
    {
        $this->process_query($where = false);
        return $this->db->get()->num_rows();
    }
    public function filter_count($where = false)
    {
        $this->process_query($where);
        return $this->db->get()->num_rows();
    }
	public function order_details($id)
	{
	 	return $this->db->select('p.username,orH.*')->from('order_history as orH')->where('orH.id',$id)->where('soldBy','0')->join('partners as p', 'p.id=orH.customer_id','inner')->get()->row_array();
  	}
		
/****************************************Package Manage ********************************************/		
		
    public function pack_query($where = false)
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

        $this->db->select('*')->from('package_purchase');
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
    public function package_data($where = false)
    {
        $this->pack_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function packtotal_count()
    {
        $this->pack_query($where = false);
        return $this->db->get()->num_rows();
    }
    public function packfilter_count($where = false)
    {
        $this->pack_query($where);
        return $this->db->get()->num_rows();
    }		
		
		
/****************************************Package Manage ********************************************/		
public function tempPackage($id)
{
   return $this->db->select('pack_name,tpp.*')->from('temp_package_purchase as tpp')->where('tpp.member_id',$id)->join('package as p', 'p.id=tpp.pack_id','inner')->get()->result();
 }		
		
		
public function getPackageData($id,$purTyp)
{
   //SELECT sum(grand_total) as grndAmt,tax,GROUP_CONCAT(CONCAT(id) SEPARATOR "==") as tRow FROM `temp_package_purchase` WHERE `member_id` = '1' AND `pur_type` = 1 GROUP by member_id
   return $this->db->select('sum(grand_total) as grndAmt,tax,GROUP_CONCAT(CONCAT(id) SEPARATOR "==") as tRow,sum(pack_qty*pack_bv) as pcBV')->from('temp_package_purchase')->where('member_id',$id)->where('pur_type',$purTyp)->group_by('member_id')->get()->row_array();
 }			
public function getPackagePurchasedList($pur_id)
{
   return $this->db->select('ppd.id,ppd.pur_id,ppd.pur_type,ppd.pack_id,p.pack_name,ppd.pack_nu,ppd.amount,ppd.pack_bv,ppd.issue_to,ppd.generate_time,ppd.generated_type,ppd.generated_by,ppd.used_by,ppd.used_date,ppd.status')->from('package_purchase_details as ppd')->where('ppd.pur_id',$pur_id)->join('package as p', 'p.id=ppd.pack_id','left')->get()->result_array();
 }		

		
		
	
 
}
