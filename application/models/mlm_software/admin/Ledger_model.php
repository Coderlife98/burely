<?php
class Ledger_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function process_query($where = false)
    {

        $field = array('tnx_id','debit_amt', 'credit_amt', 'reason','created_date','generated_by');
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
        $this->db->select('id,tnx_id,debit_amt,credit_amt,reason,created_date,generated_by')->from('company_income');
        if(!empty($where['tnxId'])){
            $this->db->where('tnx_id',$where['tnxId']);
        }
		  if(!empty($where['actnType']))
		  {
	         if($where['actnType']=='credit'){$this->db->where('credit_amt !=','0.00');}
     		 if($where['actnType']=='debit'){$this->db->where('debit_amt !=','0.00');}
			 }
		
		
		
        if(!(empty($where['strtDt']) && empty($where['endDt'])))
		{
            $this->db->where('created_date  >=',$where['strtDt']);
            $this->db->where('created_date <=',$where['endDt']);
        }

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'ASC');
        }
    }

    public function ledger_data($where = false)
    {
        $this->process_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function total_count($where = false)
    {
        $this->process_query($where);
        return $this->db->get()->num_rows();
    }
    public function total_filter_count($where = false)
    {
        $this->process_query($where);
        return $this->db->get()->num_rows();
    }
	
	public function get_income($field,$where=NULL)
	{
		$this->db->select($field);
		$this->db->from('company_income');
		if($where){$this->db->where('generated_by','1');}
		$result=$this->db->get();
		return $result->row();
		}
	public function get_tnx_data($id)
	{
		$this->db->select('mim.id,mim.tnx_id,wt.user_id,mim.debit_amt,mim.credit_amt,mim.reason,mim.created_by,mim.created_date,generated_by,tnx_type');
		$this->db->from('company_income as mim');
		$this->db->where('mim.id',$id);				   
	 	$this->db->join('wallet_transaction as wt', 'wt.tnx_id=mim.tnx_id', 'left');
		$result=$this->db->get();
		return $result->row();
		
		}
	public function get_mem_wallet($uid)
	{	
		/*SELECT `m`.`id`, `username`, `balance`, `name`, `email`, `mobile`, `my_img` FROM `msdr_members` as `m` LEFT JOIN `wallet` ON `wallet`.`userid`=`m`.`username` left join wallet_transaction as wt on wt.user_id=m.username WHERE wt.tnx_id = '20220231'*/ 
return $this->db->select('m.id,username,balance,name,email,mobile,my_img')->from('msdr_members as m')->where('wt.tnx_id',$uid)->join('wallet', 'wallet.userid=m.username', 'left')->join('wallet_transaction as wt', 'wt.user_id=m.username', 'left')->get()->row();
		
		}
	public function get_partner_wallet($uid)
	{	
return $this->db->select('m.id,username,balance,name,email,mobile,my_img')->from('partners as m')->where('wt.tnx_id',$uid)->join('partner_wallet', 'partner_wallet.userid=m.username', 'left')->join('partner_wallet_transaction as wt', 'wt.user_id=m.username', 'left')->get()->row();
		
		}
/*---------------------------mlm income strt-----------------------------------*/

    public function process_mlm_income_data($where = false)
    {

        $field = array('mlm.id','mlm.tnx_id', 'mlm.credit_amt', 'm.name','created_date','w.user_id');
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
	/*SELECT mlm.id,mlm.tnx_id,mlm.credit_amt,mlm.created_date,m.name FROM company_income as mlm left join wallet_transaction as w on w.tnx_id=mlm.tnx_id left JOIN members as m on m.username=w.user_id*/	
		
		
 $this->db->select('mlm.id,mlm.tnx_id,mlm.credit_amt,mlm.created_date,m.name,w.user_id,m.my_img')->from('company_income as mlm')->join('wallet_transaction as w', 'w.tnx_id=mlm.tnx_id', 'left')->join('members as m', 'm.username=w.user_id', 'left');

        if(!empty($where['tnxId'])){$this->db->where('mlm.tnx_id',$where['tnxId']);}
		if(!empty($where['usrId'])){$this->db->where('w.user_id',$where['usrId']);}
        if(!(empty($where['strtDt']) && empty($where['endDt']))){$this->db->where('created_date  >=',$where['strtDt'])->where('created_date <=',$where['endDt']);}
        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'ASC');
        }
    }

    public function mlm_topup_income_data($where = false)
    {
	    $this->process_mlm_income_data($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function total_mlm_topup_income_count($where = false)
    {
        $this->process_mlm_income_data($where);
        return $this->db->get()->num_rows();
    }
    public function total_mlm_topup_income_filter_count($where = false)
    {
        $this->process_mlm_income_data($where);
        return $this->db->get()->num_rows();
    }
	
	
	public function get_mlm_inc()
	{	
		$this->db->select('*');
		$this->db->from('club_income');
		$this->db->where('id','1');				   
		$result=$this->db->get();
		return $result->row();
		}

	
	
/*---------------------------mlm income end-----------------------------------*/
public function getSalaryTnxDetails($tnxID)
{
return $this->db->select('s.id,users.id as u_id,user_code as username,department_type,email,name,mobile,photo')->from('salary as s')->where('s.tnx_id',$tnxID)->join('users', 'users.id=s.staff_id', 'left')->get()->row();
}


	
	
}
