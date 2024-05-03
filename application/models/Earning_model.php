<?php
defined("BASEPATH") or exit("No direct script access allowed");
class Earning_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function pay_earning($userid, $ref_id, $income_name, $amount,$earn_type=0)
	{

		$data = array(
			'userid'     => $userid,
			'amount'     => $amount,
			'earn_type'    => $earn_type,
			'type'       => $income_name,
			'ref_id'     => $ref_id,
			'create_date'       => date('Y-m-d'),

		);

		$this->db->insert('earning', $data);


		return true;
	}


	public function pay_earning1($userid, $ref_id, $income_name, $amount,$earn_type)
	{	

		$data = array(
			'userid'     => $userid,
			'amount'     => $amount,
			'earn_type'    => $earn_type,
			'type'       => $income_name,
			'ref_id'     => $ref_id,
			'create_date'       => date('Y-m-d'),

		);

		$this->db->insert('earning', $data);


		return true;
	}



	function reg_earning($userid, $sponsor, $position, $packageid)
	{

		$get_topup = $this->Db_model->select('topup', 'msdr_members', array('username' => $userid));
		// echo $position;
		// // print_r($get_topup);
		// die;
		if ($get_topup > 0) :

			###############################################################
			#
			# Direct or Referal Income First
			#
			##############################################################
			$data = $this->Db_model->select_multi('pack_price, direct_income, level_income,', 'package', array('id' => $packageid));


			if ($data->direct_income > "0.00" && trim($sponsor) !== '') {
				$this->pay_earning($sponsor, $userid, 'Referral Income', $data->direct_income,'1');
			}

			## NOW Level Income
			if (trim($data->level_income) !== "") {
				$ex = explode(',', $data->level_income);
				$i  = 0;
				foreach ($ex as $e) {
					$e = trim($e);
					if ($i == 0) {
						$pay_position = $position;
					} else {
						$pay_position = $this->find_level_position($position, $i);
					}
					if ($pay_position  != '' && $e > 0) {

						if ($i == 2) {
							$sponsor_count = $this->db->select('*')->where('sponsor', $pay_position)->where('topup>', 0)->get('msdr_members')->num_rows();
							if ($sponsor_count >= 5) {
								$this->pay_earning($pay_position, $userid, 'Level Income', $e,'2');
							}
						} else {

							$this->pay_earning($pay_position, $userid, 'Level Income', $e,'2');
						}
					}
					$i++;
				}
			}

		endif;

		return true;
	}

	function purchase_earning($userid, $sponsor, $position, $total_amount)
	{
		
		

		$get_topup = $this->Db_model->select('topup', 'msdr_members', array('username' => $userid));
		// echo $position;
		// // print_r($get_topup);
		// die;
		if ($get_topup > 0) :

			###############################################################
			#
			# Direct or Referal Income First
			#
			##############################################################
			// $data = $this->Db_model->select_multi('pack_price, direct_income, level_income,', 'package', array('id' => $packageid));
             $direct_income=5;
             $level_income=1;
           
			if ($direct_income > "0.00" && trim($sponsor) !== '') {
				$direct_income_amount=($total_amount*$direct_income)/100;
				$this->pay_earning1($sponsor, $userid, 'Referral Income', $direct_income_amount,'1');
			}

			## NOW Level Income
			if ($level_income) {
				// $ex = explode(',', $data['level_income']);
				$ex=array(20,10,5,3,2,2,1,1,1,0.5,0.5);
				$i  = 0;
				foreach ($ex as $e) {
					$e =  trim($e);
					$e=($total_amount * $e)/100;
					// echo "1.userid=".$userid."position=".$position."total_amount=".$total_amount."percent=".$e."amount=".$amount."<br>";
					if ($i == 0) {						
						$pay_position = $position;
					} else {
						
						$pay_position = $this->find_level_position($position, $i);
					}
					if ($pay_position  != '' && $e > 0) {
						if ($i == 2) {						
							$sponsor_count = $this->db->select('*')->where('sponsor', $pay_position)->where('topup>', 0)->get('msdr_members')->num_rows();
							if ($sponsor_count >= 5) {
								$this->pay_earning1($pay_position, $userid, ' Level Income', $e,'2');
							}
						} else {
							$this->pay_earning1($pay_position, $userid, ' Level Income', $e,'2');
						}
					}
					$i++;
				}
			}

		endif;

		return true;
	}


	function repurchase_earning($userid, $sponsor, $position, $total_amount)
	{
		

		$get_topup = $this->Db_model->select('topup', 'msdr_members', array('username' => $userid));
		// echo $position;
		// // print_r($get_topup);
		// die;
		if ($get_topup > 0) :

			###############################################################
			#
			# Direct or Referal Income First
			#
			##############################################################
			// $data = $this->Db_model->select_multi('pack_price, direct_income, level_income,', 'package', array('id' => $packageid));
              $data=array(
				'direct_income'  =>0,
				'level_income'	=>15,10,5,3,2,1,1,1,1,1,1,
			  );
           
			if ($data['direct_income'] > "0.00" && trim($sponsor) !== '') {
				$this->pay_earning1($sponsor, $userid, 'Repurchase Referral Income', $data['direct_income'],'11');
			}

			## NOW Level Income
			if (trim($data['level_income']) !== "") {
				// $ex = explode(',', $data['level_income']);
				$ex=array(15,10,5,3,2,1,1,1,1,1,1);
				$i  = 0;
				foreach ($ex as $e) {
					$e =  trim($e);
					$e=($total_amount * $e)/100;
					// echo "1.userid=".$userid."position=".$position."total_amount=".$total_amount."percent=".$e."amount=".$amount."<br>";
					if ($i == 0) {						
						$pay_position = $position;
					} else {
						
						$pay_position = $this->find_level_position($position, $i);
					}
					if ($pay_position  != '' && $e > 0) {
						if ($i == 2) {						
							$sponsor_count = $this->db->select('*')->where('sponsor', $pay_position)->where('topup>', 0)->get('msdr_members')->num_rows();
							if ($sponsor_count >= 5) {
								$this->pay_earning1($pay_position, $userid, 'Repurchase Level Income', $e,'11');
							}
						} else {
							$this->pay_earning1($pay_position, $userid, 'Repurchase Level Income', $e,'11');
						}
					}
					$i++;
				}
			}

		endif;

		return true;
	}




	private function find_level_position($position, $i)
	{
		if ($i > 0) {
			$this->db->select('position')->from('msdr_members')->where(array('username' => $position));
			$result = $this->db->get()->row();
			if (!$result) {
				return false;
			} else {
				$i = ($i - 1);

				return $this->find_level_position($result->position, $i);
			}
		} else {
			return $position;
		}
	}
}
