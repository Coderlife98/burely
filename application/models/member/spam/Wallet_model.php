<?php
class Wallet_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }		
/*-----------------------02.05.2023 start---------------------------------*/
    public function process_query($where = false,$uid)
    {

        $field = array('id','debit_amt','credit_amt','create_date');
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
        $this->db->select('*');
		$this->db->from('wallet_transaction');
		$this->db->where('user_id',$uid);

        if(!empty($where['tnxId'])){$this->db->where('tnx_id',$where['tnxId']);}
		if(!empty($where['tnxType']))
		{
			if($where['tnxType']=='1'){$this->db->where('debit_amt !=','0.00');}
			if($where['tnxType']=='2'){$this->db->where('credit_amt !=','0.00');}
			}
		
		if(!(empty($where['strtDt']) && empty($where['endDt'])))
		{
            $this->db->where('create_date  >=',$where['strtDt']);
            $this->db->where('create_date <=',$where['endDt']);
        }







        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }
    public function transaction_data($where = false,$uid)
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
/*-----------------------02.05.2023 End-----------------------------------*/
/*C:\Users\Camwel Solution PC\AppData\Local\Android\Sdk*/



}
