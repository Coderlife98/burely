<?php
class Product_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }



    public function process_query($where = false)
    {
        $field = array('id', 'product_name', 'cat_id');
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
	 $this->db->select('p.id,p.product_name,c.category,p.status,p.prod_id,p.pro_img')->from('product_table as p')->join('category_manage as c', 'c.id=p.cat_id', 'inner');
/*SELECT p.id,p.product_name,c.category,p.status,p.prod_id FROM product_table as p inner join category_manage as c on c.id=p.cat_id */	
	
		/*
        if(!empty($where['userIdA'])){
            $this->db->where('username',$where['userIdA']);
        }
        if(!empty($where['mobileN'])){
            $this->db->where('mobile',$where['mobileN']);
        }
        if(!empty($where['emailId'])){
            $this->db->where('email',$where['emailId']);
        }
        if(!(empty($where['strtDt']) && empty($where['endDt'])))
		{
            $this->db->where('create_date >=',$where['strtDt']);
            $this->db->where('create_date <=',$where['endDt']);
        }*/

  if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }

    public function product_data($where = false)
    {
        $this->process_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function product_count()
    {
        $this->process_query($where = false);
        return $this->db->get()->num_rows();
    }
    public function product_filter($where = false)
    {
        $this->process_query($where);
        return $this->db->get()->num_rows();
    }


    // product details table
    public function process_detail_query($where = false)
    {
        $field = array('pd.id', 'p.product_name', 'c.category','pd.productBV');
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
	 $this->db->select('pd.id,p.product_name,c.category,p.status,p.prod_id,pd.mrp,pd.product_price,pd.productBV,pd.quantity,pd.productTax')->from('product_table as p');
     $this->db->join('category_manage as c', 'c.id=p.cat_id', 'inner');
     $this->db->join('product_details as pd', 'p.id=pd.prod_id');


        if(!empty($where['p_name'])){
            $this->db->where('p.product_name',$where['p_name']);
        }
        if(!empty($where['cat_name'])){
            $this->db->where('c.category',$where['cat_name']);
        }
        if(!empty($where['Mrp'])){
            $this->db->where('pd.mrp',$where['Mrp']);
        }
        if(!empty($where['price'])){
            $this->db->where('pd.product_price',$where['price']);
        }
       

  if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('p.id', 'desc');
        }
    }

    public function product_details_data($where = false)
    {
        $this->process_detail_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function product_detail_count()
    {
        $this->process_detail_query($where = false);
        return $this->db->get()->num_rows();
    }
    public function product_detail_filter($where = false)
    {
        $this->process_detail_query($where);
        return $this->db->get()->num_rows();
    }


    function get_product_data($id)
    {
        $this->db->select('pd.*,p.product_name,p.cat_id,p.pro_img,c.category,um.unit_name');
        $this->db->from('product_details as pd');
        $this->db->where('pd.id',$id);
        $this->db->join('product_table as p','p.id = pd.prod_id','left');
        $this->db->join('category_manage as c','c.id = p.cat_id','left');
        $this->db->join('unit_manage as um','um.id = pd.unit','left');

        return $this->db->get()->row_array();

    }
	
	
	





		
}


