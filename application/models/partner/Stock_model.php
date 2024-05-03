<?php
class Stock_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function process_query($where = false,$id)
    {
        $field = array('stock.id', 'p_tbl.prod_id', 'p_tbl.product_name', 'stock.product_qty','stock.create_date');
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
        $this->db->select('stock.id,p_tbl.prod_id,p_tbl.product_name,stock.product_price,stock.product_mrp,stock.product_qty')->from('partner_stock as stock')->join('product_details as p_det', 'p_det.id=stock.product_details_id', 'inner')->join('product_table as p_tbl', 'p_tbl.id=p_det.prod_id','inner')->where('stock.partner_id',$id);
        if (!empty($where['proId'])) { $this->db->where('p_tbl.prod_id', $where['proId']);}
		if (!empty($where['proName'])) { $this->db->where('p_tbl.product_name', $where['proName']);}
        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('stock.create_date >=', $where['strtDt']);
            $this->db->where('stock.create_date <=', $where['endDt']);
        }

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }

    public function stock_data($where = false,$id)
    {
        $this->process_query($where,$id);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function total_count($id)
    {
        $this->process_query($where = false,$id);
        return $this->db->get()->num_rows();
    }
    public function filter_count($where = false,$id)
    {
        $this->process_query($where,$id);
        return $this->db->get()->num_rows();
    }		
public function getProStockData($id)
{
return $this->db->select('stock.id,stock.product_details_id,p_tbl.prod_id,p_tbl.product_name,p_tbl.pro_img,stock.product_price,stock.product_mrp,stock.product_qty,stock.create_date,stockInDate,lastInStock')->from('partner_stock as stock')->join('product_details as p_det','p_det.id=stock.product_details_id','inner')->join('product_table as p_tbl','p_tbl.id=p_det.prod_id','inner')->where('stock.id',$id)->get()->row();
		}	
		
/*--------------------------------------------------------------*/
    public function product_wise_process_query($where = false,$mem_id,$proId)
    {
        $field = array('orDet.invoice_id', 'orDet.product_qty', 'orDet.product_name', 'orDet.discount');
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
		$this->db->select('orDet.invoice_id,orDet.product_name,orDet.product_selling_price,orDet.product_mrp,orDet.product_mrp,orDet.product_qty,orDet.discount,orDet.total_amount,orDet.net_amount')->from('order_details as orDet')/*->join('order_history as orHis','orHis.id=orDet.order_id','left')*/;
		$this->db->where('orDet.product_details_id',$proId);
		$this->db->where('orDet.member_id',$mem_id);
/*        if (!empty($where['proId'])) { $this->db->where('p_tbl.prod_id', $where['proId']);}
		if (!empty($where['proName'])) { $this->db->where('p_tbl.product_name', $where['proName']);}
        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('stock.create_date >=', $where['strtDt']);
            $this->db->where('stock.create_date <=', $where['endDt']);
        }
*/
        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function product_wise_data($where = false,$mem_id,$proId)
    {
        $this->product_wise_process_query($where,$mem_id,$proId);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function product_wise_total_count($mem_id,$proId)
    {
        $this->product_wise_process_query($where = false,$mem_id,$proId);
        return $this->db->get()->num_rows();
    }
    public function product_wise_filter_count($where = false,$mem_id,$proId)
    {
        $this->product_wise_process_query($where,$mem_id,$proId);
        return $this->db->get()->num_rows();
    }	
/*--------------------------------------------------------------*/		

		
		
}
