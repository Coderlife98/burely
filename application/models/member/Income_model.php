<?php
class Income_model  extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->Dptharray = array();
		$this->ASarray = array();
		$this->miASarray = array();
	}
	public function process_mng_query($where = false, $uid, $actn)
	{
		/*	$actnArr=array("1"=>"spInc","Generation Income"=>"genInc","Star Club Income"=>"stcInc","Gold Star Club Income"=>"gstcInc","MSDR Star Club Income"=>"mstcInc","MSDR Super Star Club Income"=>"msstcInc","Top Level Royalty Income"=>"tlrInc","Bike Fund"=>"bkfInc","Car Fund"=>"crfInc","House Fund"=>"hfInc","Repurchase Income"=>"repInc");
		$matchTitle=array_search($actn,$actnArr,true);	*/
		/*print_r($matchTitle);
		die;*/
		if ($actn == 'spInc') {
			$matchTitle = '1';
		} else if ($actn == 'genInc') {
			$matchTitle = '2';
		} else {
			$matchTitle = NULL;
		}
		$field = array('id', 'userid', 'amount', 'date', 'type', 'earnedBv');
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
		$this->db->select('*')->from('earning')->where('userid', $uid);
		if ($matchTitle) {
			$this->db->where('earn_type', $matchTitle);
		}
		if (!empty($where['refId'])) {
			$this->db->where('ref_id', $where['refId']);
		}
		if (!empty($where['pysts'])) {
			if ($where['pysts'] == '1') {
				$this->db->where('status', 'Paid');
			}
			if ($where['pysts'] == '2') {
				$this->db->where('status', 'Hold');
			}
			if ($where['pysts'] == '3') {
				$this->db->where('status', 'Pending');
			}
		}
		if (!(empty($where['strtDt']) && empty($where['endDt']))) {
			$this->db->where('create_date  >=', $where['strtDt']);
			$this->db->where('create_date <=', $where['endDt']);
		}
		if (isset($where['order']) && !empty($where['order'])) {
			$this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
		} else {
			$this->db->order_by('id', 'desc');
		}
	}
	public function manage_data($where = false, $uid, $actn)
	{
		$this->process_mng_query($where, $uid, $actn);

		if ($where['length'] != -1) {
			$this->db->limit($where['length'], $where['start']);
		}
		return $this->db->get()->result();
	}
	public function total_mng_count($uid, $actn)
	{
		$this->process_mng_query($where = false, $uid, $actn);
		return $this->db->get()->num_rows();
	}
	public function total_filter_mng_count($where = false, $uid, $actn)
	{
		$this->process_mng_query($where, $uid, $actn);
		return $this->db->get()->num_rows();
	}


	/*-----------------------02.05.2023 start---------------------------------*/
	public function process_query($where = false, $uid)
	{

		$field = array('id', 'userid', 'amount', 'date', 'type', 'earnedBv');
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
		$this->db->from('earning');
		$this->db->where('userid', $uid);
		if (!empty($where['refId'])) {
			$this->db->where('ref_id', $where['refId']);
		}
		if (!empty($where['pysts'])) {
			if ($where['pysts'] == '1') {
				$this->db->where('status', 'Paid');
			}
			if ($where['pysts'] == '2') {
				$this->db->where('status', 'Hold');
			}
			if ($where['pysts'] == '3') {
				$this->db->where('status', 'Pending');
			}
		}
		if (!(empty($where['strtDt']) && empty($where['endDt']))) {
			$this->db->where('create_date  >=', $where['strtDt']);
			$this->db->where('create_date <=', $where['endDt']);
		}
		if (isset($where['order']) && !empty($where['order'])) {
			$this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
		} else {
			$this->db->order_by('id', 'desc');
		}
	}
	public function income_data($where = false, $uid)
	{
		$this->process_query($where, $uid);

		if ($where['length'] != -1) {
			$this->db->limit($where['length'], $where['start']);
		}
		return $this->db->get()->result();
	}
	public function total_count($uid)
	{
		$this->process_query($where = false, $uid);
		return $this->db->get()->num_rows();
	}
	public function total_filter_count($where = false, $uid)
	{
		$this->process_query($where, $uid);
		return $this->db->get()->num_rows();
	}

	public function process_wallet($where = false, $uid)
	{

		$field = array('id', 'userid', 'amount', 'date', 'type');
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
		$this->db->where('user_id', $uid);
		/*if(!empty($where['refId'])){$this->db->where('ref_id',$where['refId']);}
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
	public function wallet_tnx($where = false, $uid)
	{
		$this->process_wallet($where, $uid);

		if ($where['length'] != -1) {
			$this->db->limit($where['length'], $where['start']);
		}
		return $this->db->get()->result();
	}
	public function wallet_count($uid)
	{
		$this->process_wallet($where = false, $uid);
		return $this->db->get()->num_rows();
	}
	public function wallet_filter_count($where = false, $uid)
	{
		$this->process_wallet($where, $uid);
		return $this->db->get()->num_rows();
	}






	##########################@mi Regular Income Start####################################	
	private function miDownLine($id)
	{
		$nDline = $this->db->select('GROUP_CONCAT(username SEPARATOR ",") as child')->from('msdr_members')->where('sponsor', $id)->get()->row();
		return $nDline->child;
	}
	private function get_allTypeInc()
	{
		return $this->db->select('*')->from('club_income')->where('id', '1')->get()->row();
	}
	public function get_package($pPrice)
	{
		return  $this->db->select('b_volume')->from('package')->where('pack_price', $pPrice)->get()->row();
	}
	public function active_subscriber($id, $i = 0)
	{
		$this->db->select("id,username,sponsor,topup")->from("msdr_members")->where('username', $id);
		$data = $this->db->get()->result();
		foreach ($data as $dt) {
			if ($dt->sponsor != '0') {
				$this->ASarray[$dt->sponsor] .= $this->miDownLine($dt->sponsor);
			}
			$this->active_subscriber($dt->sponsor, $i);
		}
		return $this->ASarray;
	}
	public function create_earning($userid, $ref_id, $income_name, $earnedBv, $amount, $total_bv, $incTyp)
	{
		$data = array('earn_type' => $incTyp, 'userid' => $userid, 'amount' => $amount, 'total_bv' => $total_bv, 'earnedBv' => $earnedBv, 'type' => $income_name, 'ref_id' => $ref_id, 'create_date' => date('Y-m-d H:s:i'));
		if ($userid != $ref_id) {
			if ($this->db->insert('earning', $data)) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function activate_plan($id, $refID, $pPrice)
	{
		$amount = $this->get_package($pPrice);
		$rewards = $this->get_allTypeInc();
		$frLeg = NULL;
		$frLeg = $this->miDownLine($id);
		if ($frLeg) {
			$this->ASarray[$id] = $frLeg;
		}
		$result = '';
		$incPer = array($rewards->sponsor_income, $rewards->first_repurchase_incom, $rewards->second_repurchase_incom, $rewards->third_repurchase_incom, $rewards->four_repurchase_incom);
		$this->active_subscriber($id, $i = 0);
		if ($this->ASarray) {
			$sp = 0;
			foreach ($this->ASarray as $key => $list) {
				if ($key != $refID) {
					$sp++;
					if ($sp == 1) {
						$incomeBv = $amount->b_volume * $incPer[0] / 100;
						$generateIncome = $this->create_earning($key, $refID, 'Sponsor income after activate package of user id # ' . $refID, $incomeBv, $pPrice, $amount->b_volume, '1');
						$result = '1';
					} else if (1 < $sp && $sp <= 5) {
						$myInc = $sp - 1;
						$link = $myInc - 1;
						$linkIcn = array('st', 'nd', 'rd', 'th');
						$incomeBv = $amount->b_volume * $incPer[$myInc] / 100;
						$generateIncome = $this->create_earning($key, $refID, $myInc . '<sup>' . $linkIcn[$link] . '</sup> level income of user id # ' . $refID, $incomeBv, $pPrice, $amount->b_volume, '2');
						$result = '1';
					}
					if ($sp == 5) {
						break;
					}
				}
			}
			// return $result;
			if ($result == '1') {
				return 'success';
			} else {
				return 'error';
			}
		}
	}
	
	##########################@mi Regular Income End######################################
	public function get_member_wallet($id)
	{
		return $this->db->select('mem.id,mem.username,balance,name,my_img,mobile,email,address,topup,rank')->from('msdr_members as mem')->where('mem.id', $id)->join('wallet', 'wallet.userid=mem.username', 'left')->get()->row();
	}
	public function get_incomingEarned($id)
	{
		$this->db->select('sum(earnedBv) as incomeEarnend ');
		$this->db->from('earning');
		$this->db->where('userid', $id);
		$this->db->where('status', 'Pending');
		$result = $this->db->get();
		return $result->row();
	}
	public function minWithdrawlBal()
	{
		return $this->db->select('withdrableAmt')->from('club_income')->where('id', '1')->get()->row();
	}
	public function withdrawlRequest($id)
	{
		return $this->db->from('withdraw_request')->where('userid', $id)->where('status', 'Un-Paid')->order_by('id', 'desc')->get()->result();
	}
	public function getTotalIncome($id)
	{
		return $this->db->select('sum(amount) as tIncome')->from('earning')->where('userid', $id)->get()->row();
	}
	public function getLatestEarning($id)
	{
		return $this->db->select('*')->from('earning')->where('userid', $id)->limit(5, 0)->get()->result();
	}
	/*--------------------Reward Section start-------------------------------*/
	public function isCheckReward($id)
	{
		return $this->db->select('r.*,other_reward')->from('rewards as r')->join('rank_system', 'rank_system.id=r.reward_id', 'inner')->where('r.userid', $id)->get()->result();
	}
	/*--------------------Reward Section End-------------------------------*/
	public function isCheckforDeveloperMeberEarnCount($userId, $limit, $amount)
	{
		return $this->db->select('sum(amount) as earnAmount')->from('earning')->where('userid', $userId)->where('amount', $amount)->limit($limit, 0)->get()->row();
	}


	/****************************************Sponsor Income Start********************************************/
	public function generate_repurchase($id, $refID, $tAmt, $repurBV)
	{
		$rewards = $this->get_allTypeInc();
		$frLeg = NULL;
		$frLeg = $this->miDownLine($id);
		if ($frLeg) {
			$this->ASarray[$id] = $frLeg;
		}
		$result = '';
		$incPer = array($rewards->first_gen_incom, $rewards->second_repurchase_incom, $rewards->third_repurchase_incom, $rewards->four_repurchase_incom);
		$this->active_subscriber($id, $i = 0);
		if ($this->ASarray) {
			$sp = 0;
			foreach ($this->ASarray as $key => $list) {
				if ($key != $refID) {
					$sp++;
					if ($sp == 1) {
						$result = '1';
						$incomeBv = $repurBV * $incPer[0] / 100;
						$generateIncome = $this->create_earning($key, $refID, 'Income generated after product repurchase of user id #' . $refID, $incomeBv, $tAmt, $repurBV, '11');
					} else if (1 < $sp && $sp <= 5) {
						$result = '1';
						$myInc = $sp - 1;
						$link = $myInc - 1;
						$linkIcn = array('st', 'nd', 'rd', 'th');
						$incomeBv = $repurBV * $incPer[$myInc] / 100;
						$generateIncome = $this->create_earning($key, $refID, $myInc . '<sup>' . $linkIcn[$link] . '</sup> level repurchase income of user id #' . $refID, $incomeBv, $tAmt, $repurBV, '11');
					}
					if ($sp == 5) {
						break;
					}
				}
			}
			if ($result == '1') {
				return true;
			} else {
				return false;
			}
		}
	}
	/*****************************************Sponsor Income End*********************************************/
	public function isExistChild($id)
	{
		$isChild = $this->db->select('username')->from('msdr_members')->where('sponsor', $id)->get()->result();
		$incWthMember = array();
		if ($isChild) {
			foreach ($isChild as $child) {
				$this->dnLine = array();
				$getDownline = $this->income->downline_subscriber($child->username);
				if ($getDownline) {
					foreach ($getDownline as $key => $cIncome) {
						$cAsArr = explode(',', $cIncome);
						$downLinePV = $this->getAllDowlinePV($cAsArr);
						if ($downLinePV) {
							$getMemDet = $this->db->select('name,username,rank')->from('msdr_members')->where('username', $key)->get()->row();
							$incWthMember[$key] = array('name' => $getMemDet->name, 'username' => $getMemDet->username, 'rank' => $getMemDet->rank, 'ernBV' => $downLinePV);
						}
					}
				} else {
					$downLinePV = $this->getAllDowlinePV($child->username);
					if ($downLinePV) {
						$getMemDet = $this->db->select('name,username,rank')->from('msdr_members')->where('username', $child->username)->get()->row();
						$incWthMember[$child->username] = array('name' => $getMemDet->name, 'username' => $getMemDet->username, 'rank' => $getMemDet->rank, 'ernBV' => $downLinePV);
					}
				}
			}
		}
		return $incWthMember;
	}
	public function downline_subscriber($id, $i = 0)
	{

		$this->db->select("id,username,sponsor")->from("msdr_members")->where('sponsor', $id);
		$data = $this->db->get()->result();
		foreach ($data as $dt) {
			//if(isset($this->dnLine[$id])){ $this->dnLine[$id].= ','.$dt->username;}else{$this->dnLine[$id] = $dt->username;}
			$this->dnLine[$id] = $this->dnLine[$id] ? $this->dnLine[$id] . ',' . $dt->username : $dt->username;
			$this->downline_subscriber($dt->username, $i);
		}
		return $this->dnLine;
	}
	public function getAllDowlinePV($ar)
	{
		$reInc = $this->db->select('sum(earnedBv) as total_bv')->from('earning')->where('status', 'Pending')->where_in('userid', $ar)->get()->row();
		$reInc = $reInc->total_bv ? $reInc->total_bv : 0;
		//SELECT sum(b_volume) as topupBV FROM msdr_members as ms INNER join package as p on p.pack_price=ms.topup where ms.username='MSD44142'
		$topupPack = $this->db->select('sum(b_volume) as total_bv')->from('msdr_members as ms')->join('package as p', 'p.pack_price=ms.topup', 'inner')->where_in('ms.username', $ar)->get()->row();
		$topupPack = $topupPack->total_bv ? $topupPack->total_bv : 0;
		$totalEarnBv = $topupPack + $reInc;
		return $totalEarnBv;
	}
}
