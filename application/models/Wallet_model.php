<?php
class Wallet_model extends CI_Model
{


    function get_wallet_request()
    {
        $this->db->select('m.name as member_name,wtr.*');
        $this->db->where('wtr.status','Pending');
        $this->db->join('msdr_members as m','m.username=wtr.userid','left');
        return $this->db->get('wallet_topup_request as wtr')->result_array();
    }
}

?>