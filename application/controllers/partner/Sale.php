<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sale extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		($this->session->userdata('partner_id') == '') ? redirect(base_url() . 'partner/login', 'refresh') : '';
		$this->load->model('partner/sale_model', 'sale');
		$this->load->model('partner/order_model', 'order');
		$this->load->model('partner/partner_model', 'partner');
		$this->load->model('member/Member_model', 'member');
		$this->load->model('member/Income_model', 'income');
		$this->logId = $this->session->userdata('partner_id');
		$this->u_id = $this->session->userdata('partner_username');
		$this->u_cate = $this->session->userdata('p_cate');
		$this->baseUrl = base_url();
		error_reporting(0);
	}
	public function index()
	{
		$data['title'] = 'Sales Manage';
		$data['breadcrums'] = 'Sales Manage';
		$data['target'] = 'partner/sale/my_sales';
		$data['layout'] = 'sale/_list.php';
		$this->load->view('partner/base', $data);
	}
	public function member($id = NULL)
	{
		if ($id == 'arv') {
			$post_data = $this->input->post();
			$record = $this->sale->sale_data($post_data, $this->logId, 'sale_history', '1');
			$i = $post_data['start'] + 1;
			$return['data'] = array();
			foreach ($record as $row) {
				if ($row->order_status == '0') {
					$stsTex = 'Cancelled';
					$activeCls = 'ordCancel';
				} else if ($row->order_status == '1') {
					$stsTex = 'Placed';
					$activeCls = 'ordPlced';
				} else if ($row->order_status == '2') {
					$stsTex = 'Shipped';
					$activeCls = 'ordShipped';
				} else if ($row->order_status == '3') {
					$stsTex = 'Delevered';
					$activeCls = 'ordDelevered';
				} else {
					$stsTex = 'Not Yet';
					$activeCls = 'setBtnGr dctive';
				}
				$getUid = base_url('partner/sale/member/' . urlencode(base64_encode($row->invoice_id)));
				$actionBtn = '<div style="text-align:center;">
									<a href="' . $getUid . '" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
							  </div>';
				//$grandTamt=$row->grand_total+$row->shipping_charge+($row->grand_total*$row->tax)/100;
				if ($row->delevery_date) {
					$delivery = date('d-m-Y', strtotime($row->delevery_date));
				} else {
					$delivery = 'N/A';
				}
				$earned = $row->earnedBv * 5 / 100;


				$return['data'][] = array(
					'<strong>' . $i++ . '.</strong>', $row->invoice_id, '<i class="bx bx-rupee inrP"></i> ' . number_format($row->grand_total, 2),
					'<i class="bx bx-rupee inrP"></i> ' . $row->paid_amt, $earned, date('d-m-Y', strtotime($row->order_date)), $delivery,
					'<div class="' . $activeCls . ' getAction"><span>' . $stsTex . '</span></div>', $actionBtn
				);
			}
			$return['recordsTotal'] = $this->sale->total_count($this->logId, 'sale_history', '1');
			$return['recordsFiltered'] = $this->sale->filter_count($post_data, $this->logId, 'sale_history', '1');
			$return['draw'] = post_data['draw'];
			echo json_encode($return);
		} else {
			if ($id) {
				$invId = base64_decode(urldecode($id));
				$whereInvId = array('invoice_id' => $invId);
				$ordHistory = $this->common->get_data('sale_history', $whereInvId, '*');
				$getFrenchise = $this->partner->profile_details($ordHistory['seller_id']);
				$getBuyer = $this->member->profile_details($ordHistory['customer_id']);
				$orderDetails = $this->common->all_data_con('sale_details', $whereInvId, '*');
				$data['getBuyer'] = $getBuyer;
				$data['getFrenchise'] = $getFrenchise;
				$data['invId'] = $invId;
				$data['ordHistory'] = $ordHistory;
				$data['orderDetails'] = $orderDetails;
				$data['targetActn'] = 'partner/sale/approvedByFrenchise';
				$data['title'] = 'Member Sale Details';
				$data['breadcrums'] = 'Member Sale Details';
				$data['layout'] = 'sale/_view.php';
				$this->load->view('partner/base', $data);
			} else {
				$data['title'] = 'Member Sale List';
				$data['breadcrums'] = 'Member Sale List';
				$data['target'] = 'partner/sale/member/arv';
				$data['layout'] = 'sale/_list.php';
				$this->load->view('partner/base', $data);
			}
		}
	}
	public function approvedByFrenchise()
	{
		$post = $this->input->post();

		$whereCon = array('id' => $post['orderID']);
		$ordHistory = $this->sale->getSaleHistory($post['orderID']);
		



		if ($ordHistory['order_status'] == '3') {
			$data = array('adClass' => 'tst_default', 'text' => 'You have already dilevered this order');
		} else {
			if ($post['ordSts'] == 'Cancelled') {
				$ordSts = '0';
				$adCls = 'tst_warning';
			} else if ($post['ordSts'] == 'Delivered') {

				$ordSts = '3';
				$adCls = 'tst_success';
			} else {
				$ordSts = '1';
				$adCls = 'tst_default';
			}
			$tnxNu = date('dHis');
			$updateArr = array(
				'delevery_date' => date('Y-m-d'),
				'order_status' => $ordSts,
				'frenchiseTnx' => $tnxNu
			);
			$recordUpdate = $this->common->update_data('sale_history', $whereCon, $updateArr);

			// -------------------------------------------
			$this->load->model('Earning_model');
			$this->load->model('Db_model');
			$username = $ordHistory['username'];
			$grand_total = $ordHistory['grand_total'];

			$sponsor = $this->Db_model->select('sponsor', 'msdr_members', array('username' => $username));
			$position = $sponsor;

			$count_sale_history = $this->db->select('*')->where(array('customer_id' => $ordHistory['customer_id'], 'order_status' => '3'))->get('sale_history')->num_rows();

			if ($count_sale_history > 1) {
				
				$this->Earning_model->repurchase_earning($username, $sponsor, $position, $grand_total);
			} else {
				
				$this->Earning_model->purchase_earning($username, $sponsor, $position, $grand_total);
			}
		

			// -------------------------------------------

			if ($recordUpdate) {
				if ($post['ordSts'] == 'Delivered') {
					$ordWhereCon = array('order_id' => $ordHistory['id'], 'member_id' => $ordHistory['customer_id']);
					$getOrderedDetails = $this->common->all_data_con('sale_details', $ordWhereCon, '*');
					if ($getOrderedDetails) {
						foreach ($getOrderedDetails as $dList) {

							$getFrStock = $this->sale->getFrenchiseStock($this->logId, $dList['product_details_id']);

							$FrTotlQty = $getFrStock->product_qty - $dList['product_qty'];

							$whereConStockDes = array('id' => $getFrStock->id);

							$stockDecArr = array(
								'product_qty'      => $FrTotlQty,
								'lastInStock'      => $dList['product_qty'],
								'modified_type'   => '1',
								'stockInDate'    => date('Y-m-d'),
								'modify_date'      => date('Y-m-d'),
								'modified_by'      => $this->logId,
								'stockIncId'       => $ordHistory['id']
							);


							if ($this->common->update_data('partner_stock', $whereConStockDes, $stockDecArr)) {

								$result = '1';
							} else {
								$result = '2';
							}
						}
						$reason = 'Amount has been credited after that member has purchased';
						$walletCreateArr = array(
							'tnx_id'      => $tnxNu,
							'tnx_typ'     => '2',
							'user_id'     => $this->u_id,
							'credit_amt'  => $ordHistory['paid_amt'],
							'reason'      => $reason,
							'created_by'   => '1',
							'create_date'  => date('Y-m-d')
						);
						if ($this->common->save_data('partner_wallet_transaction', $walletCreateArr)) {
							$result = '1';

							// $this->income->generate_repurchase($ordHistory['username'],$ordHistory['username'],$ordHistory['grand_total'],$ordHistory['earnedBv']);
							/*	$repBV=$ordHistory['earnedBv']*8/100;	
								  		$earningCreateArr=array('userid'=>$ordHistory['username'],'ref_id'=>$tnxNu,'earnedBv'=>$repBV,'status'=>'Pending','earn_type'=>'11',
																'amount'=>$ordHistory['grand_total'],'total_bv'=>$ordHistory['earnedBv'],'create_date'=>date('Y-m-d'),
																'type'=>'Repurchase income of #'.$ordHistory['invoice_id']
																);
										$this->common->save_data('earning',$earningCreateArr);*/
						}
					}
				}
				if ($result == '1') {
					$data = array('adClass' => $adCls, 'text' => 'Thank You! You have successfully update order details');
				} else {
					$data = array('adClass' => 'tst_danger', 'text' => 'Oops it seems server taking more time please refresh');
				}
			} else {
				$data = array('adClass' => 'tst_danger', 'text' => 'Oops it seems server taking more time please refresh');
			}
		}
		echo json_encode($data);
	}

	public function my_sales()
	{
		$post_data = $this->input->post();
		if ($this->u_cate == '1') {
			$tblName = 'order_history';
			$uCat = '1';
		} else {
			$tblName = 'sale_history';
			$uCat = '2';
		}
		$record = $this->sale->sale_data($post_data, $this->logId, $tblName, $uCat);
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		foreach ($record as $row) {
			if ($row->order_status == '0') {
				$stsTex = 'Cancelled';
				$activeCls = 'ordCancel';
			} else if ($row->order_status == '1') {
				$stsTex = 'Placed';
				$activeCls = 'ordPlced';
			} else if ($row->order_status == '2') {
				$stsTex = 'Shipped';
				$activeCls = 'ordShipped';
			} else if ($row->order_status == '3') {
				$stsTex = 'Delevered';
				$activeCls = 'ordDelevered';
			} else {
				$stsTex = 'Not Yet';
				$activeCls = 'setBtnGr dctive';
			}
			$getUid = base_url('partner/sale/detials/' . urlencode(base64_encode($row->invoice_id)));
			$actionBtn = '<div style="text-align:center;">
								<a href="' . $getUid . '" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
						  </div>';
			//$grandTamt=$row->grand_total+$row->shipping_charge+($row->grand_total*$row->tax)/100;
			if ($row->delevery_date) {
				$delivery = date('d-m-Y', strtotime($row->delevery_date));
			} else {
				$delivery = 'N/A';
			}

			if ($this->u_cate == '1') {
				$earned = $row->earnedBv * 5 / 100;
			} else if ($this->u_cate == '2') {
				$earned = $row->earnedBv * 10 / 100;
			}


			$return['data'][] = array(
				'<strong>' . $i++ . '.</strong>',
				$row->invoice_id,
				'<i class="bx bx-rupee inrP"></i> ' . number_format($row->grand_total, 2),
				'<i class="bx bx-rupee inrP"></i> ' . $row->paid_amt, $earned,
				date('d-m-Y', strtotime($row->order_date)),
				$delivery,
				'<div class="' . $activeCls . ' getAction"><span>' . $stsTex . '</span></div>',
				$actionBtn
			);
		}
		$return['recordsTotal'] = $this->sale->total_count($this->logId, $tblName, $uCat);
		$return['recordsFiltered'] = $this->sale->filter_count($post_data, $this->logId, $tblName, $uCat);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}
	public function detials($id)
	{
		$orderDetails = NULL;
		$member = NULL;
		$invId = base64_decode(urldecode($id));
		$whereInvId = array('invoice_id' => $invId);

		$getFrenchise = NULL;
		$getBuyer = NULL;
		if ($this->u_cate == '1') {
			$ordHistory = $this->common->get_data('order_history', $whereInvId, '*');
			$getBuyer = $this->partner->profile_details($ordHistory['customer_id']);
			$getFrenchise = $this->partner->profile_details($ordHistory['seller_id']);
			$orderDetails = $this->common->all_data_con('order_details', $whereInvId, '*');
		} else if ($this->u_cate == '2') {
			$ordHistory = $this->common->get_data('sale_history', $whereInvId, '*');
			$getFrenchise = $this->partner->profile_details($ordHistory['seller_id']);
			$getBuyer = $this->member->profile_details($ordHistory['customer_id']);
			$orderDetails = $this->common->all_data_con('sale_details', $whereInvId, '*');
		}

		$data['getBuyer'] = $getBuyer;
		$data['getFrenchise'] = $getFrenchise;
		$data['invId'] = $invId;
		$data['ordHistory'] = $ordHistory;
		$data['orderDetails'] = $orderDetails;
		$data['targetActn'] = 'partner/sale/approved';
		$data['title'] = 'Sale Details';
		$data['breadcrums'] = 'Sale Details';
		$data['layout'] = 'sale/_view.php';
		$this->load->view('partner/base', $data);
	}
	public function approved()
	{
		$post = $this->input->post();
		$whereCon = array('id' => $post['orderID']);
		if ($this->u_cate == '1') {
			$ordHistoryTbl = 'order_history';
			$detailTbl = 'order_details';
		} else if ($this->u_cate == '2') {
			$ordHistoryTbl = 'sale_history';
			$detailTbl = 'sale_details';
		}
		$ordHistory = $this->common->get_data($ordHistoryTbl, $whereCon, '*');
		if ($post['ordSts'] == 'Cancelled') {
			$ordSts = '0';
			$adCls = 'tst_warning';
		} else if ($post['ordSts'] == 'Delivered') {
			$ordSts = '3';
			$adCls = 'tst_success';
		} else {
			$ordSts = '1';
			$adCls = 'tst_default';
		}
		if ($ordHistory['order_status'] == '3') {
			$data = array('adClass' => 'tst_default', 'text' => 'You have already dilevered this order');
		} else {
			$tnxNu = date('dHis');
			$updateArr = array('delevery_date' => date('Y-m-d'), 'order_status' => $ordSts, 'frenchiseTnx' => $tnxNu);
			$recordUpdate = $this->common->update_data($ordHistoryTbl, $whereCon, $updateArr);
			//$recordUpdate='1';
			if ($recordUpdate) {
				if ($post['ordSts'] == 'Delivered') {
					$ordWhereCon = array('order_id' => $ordHistory['id'], 'member_id' => $ordHistory['customer_id']);
					$getOrderedDetails = $this->common->all_data_con($detailTbl, $ordWhereCon, '*');
					if ($getOrderedDetails) {
						foreach ($getOrderedDetails as $dList) {
							if ($this->u_cate == '1') {
								$getFrStock = $this->sale->getFrenchiseStock($this->logId, $dList['product_details_id']);
								$FrTotlQty = $getFrStock->product_qty - $dList['product_qty'];
								$whereConStockDes = array('id' => $getFrStock->id);
								$stockDecArr = array(
									'product_qty' => $FrTotlQty, 'lastInStock' => $dList['product_qty'], 'modified_type' => '1', 'stockInDate' => date('Y-m-d'),
									'modify_date' => date('Y-m-d'), 'modified_by' => $this->logId, 'stockIncId' => $ordHistory['id']
								);
								$this->common->update_data('partner_stock', $whereConStockDes, $stockDecArr);
								$isProWhereCon = array('partner_id' => $ordHistory['customer_id'], 'product_details_id' => $dList['product_details_id']);
								$isProductExist = $this->common->get_data('partner_stock', $isProWhereCon, '*');
								if ($isProductExist) {
									$totalQty = $dList['product_qty'] + $isProductExist['product_qty'];
									$whereConStockUp = array('id' => $isProductExist['id']);
									$stockUpdateArr = array(
										'product_qty' => $totalQty, 'lastInStock' => $dList['product_qty'], 'modified_type' => '1', 'stockInDate' => date('Y-m-d'),
										'modify_date' => date('Y-m-d'), 'modified_by' => $this->logId, 'stockIncId' => $ordHistory['id']
									);
									if ($this->common->update_data('partner_stock', $whereConStockUp, $stockUpdateArr)) {
										$result = '1';
									} else {
										$result = '2';
									}
								} else {
									$stockCreateArr = array(
										'partner_id' => $ordHistory['customer_id'], 'product_details_id' => $dList['product_details_id'],
										'product_price' => $dList['product_selling_price'], 'product_mrp' => $dList['product_mrp'],
										'product_qty' => $dList['product_qty'], 'lastInStock' => $dList['product_qty'], 'created_type' => '1',
										'last_purchase_id' => $ordHistory['id'], 'stockInDate' => date('Y-m-d'), 'create_date' => date('Y-m-d'),
										'created_by' => $this->logId, 'stockIncId' => $ordHistory['id']
									);
									if ($this->common->save_data('partner_stock', $stockCreateArr)) {
										$result = '1';
									} else {
										$result = '2';
									}
								}
							} else if ($this->u_cate == '2') {
								$isProWhereCon = array('partner_id' => $this->logId, 'product_details_id' => $dList['product_details_id']);
								$isProductExist = $this->common->get_data('partner_stock', $isProWhereCon, '*');
								if ($isProductExist) {
									$totalQty = $isProductExist['product_qty'] - $dList['product_qty'];
									$whereConStockUp = array('id' => $isProductExist['id']);
									$stockUpdateArr = array(
										'product_qty' => $totalQty, 'lastInStock' => $dList['product_qty'], 'modified_type' => '1', 'stockInDate' => date('Y-m-d'),
										'modify_date' => date('Y-m-d'), 'modified_by' => $this->logId, 'stockIncId' => $ordHistory['id']
									);
									if ($this->common->update_data('partner_stock', $whereConStockUp, $stockUpdateArr)) {
										$result = '1';
									} else {
										$result = '2';
									}
								}
							}
						}
						if ($this->u_cate == '1') {
							$reason = 'Amount has been credited after that shopee has purchased';
							$walletCreateArr = array('tnx_id' => $tnxNu, 'tnx_typ' => '2', 'user_id' => $this->u_id, 'credit_amt' => $ordHistory['paid_amt'], 'reason' => $reason, 'created_by' => '1', 'create_date' => date('Y-m-d'));
							$this->common->save_data('partner_wallet_transaction', $walletCreateArr);
						} else if ($this->u_cate == '2') {
							$reason = 'Amount has been credited after that member has purchased';
							$walletCreateArr = array('tnx_id' => $tnxNu, 'tnx_typ' => '2', 'user_id' => $this->u_id, 'credit_amt' => $ordHistory['paid_amt'], 'reason' => $reason, 'created_by' => '1', 'create_date' => date('Y-m-d'));
							$this->common->save_data('partner_wallet_transaction', $walletCreateArr);
						}
					}
				}
				if ($result == '1') {
					$data = array('adClass' => $adCls, 'text' => 'Thank You! You have successfully update order details');
				} else {
					$data = array('adClass' => 'tst_danger', 'text' => 'Oops it seems server taking more time please refresh');
				}
			} else {
				$data = array('adClass' => 'tst_danger', 'text' => 'Oops it seems server taking more time please refresh');
			}
		}
		echo json_encode($data);
	}
	public function create()
	{
		$sellerData = NULL;
		if ($this->u_cate == '2') {
			$getBuyer = $this->partner->profile_details($this->logId);
		}
		$sellerData = $this->partner->profile_details($this->logId);
		$data['sellerData'] = $sellerData;
		$data['title'] = 'Create New Sale';
		$data['breadcrums'] = 'Create New Sale';
		$data['layout'] = 'sale/create_sale.php';
		$this->load->view('partner/base', $data);
	}

	public function findBuyer()
	{
		$post = $this->input->post();
		if ($this->u_cate == '1') {
			$getBuyer = $this->partner->profile_details_by_username($post['buyerID']);
			if ($getBuyer) {
				$getTempSaleList = $this->getTempSale($this->logId, $this->u_cate, $getBuyer->id);
				if ($getBuyer->address) {
					$address = $getBuyer->address . ',<br>' . $getBuyer->ctyN . ',' . $getBuyer->stN . ',' . $getBuyer->zipcode;
				} else {
					$address = $getBuyer->address;
				}
				$data = array('adClass' => 'tst_success', 'byrPic' => base_url($getBuyer->my_img), 'byrCode' => $getBuyer->username, 'byrName' => $getBuyer->name, 'byrAddr' => $address, 'byrContct' => $getBuyer->mobile, 'byrEmail' => $getBuyer->email, 'msg' => 'Thank You! you have found details', 'byrID' => $getBuyer->id, 'tempSaleList' => $getTempSaleList);
			} else {
				$data = array('adClass' => 'tst_warning', 'msg' => 'Oops it seems there is no member id exist');
			}
		} else if ($this->u_cate == '2') {
			$getBuyer = $this->member->profile_details_by_username($post['buyerID']);
			if ($getBuyer) {
				$getTempSaleList = $this->getTempSale($this->logId, $this->u_cate, $getBuyer->id);
				if ($getBuyer->address) {
					$address = $getBuyer->address . ',<br>' . $getBuyer->ctyN . ',' . $getBuyer->stN . ',' . $getBuyer->zipcode;
				} else {
					$address = $getBuyer->address;
				}
				$data = array('adClass' => 'tst_success', 'byrPic' => base_url($getBuyer->my_img), 'byrCode' => $getBuyer->username, 'byrName' => $getBuyer->name, 'byrAddr' => $address, 'byrContct' => $getBuyer->mobile, 'byrEmail' => $getBuyer->email, 'msg' => 'Thank You! you have found details', 'byrID' => $getBuyer->id, 'tempSaleList' => $getTempSaleList);
			} else {
				$data = array('adClass' => 'tst_warning', 'msg' => 'Oops it seems there is no member id exist');
			}
		}
		//print_r($data);
		echo json_encode($data);
	}
	public function by_frenchise()
	{
		$post = $this->input->post();
		$plist = $this->order->getProductByFrenchiseStock($this->logId, $post['proName']);
		if ($plist) {
			foreach ($plist as $list) {
				$onclick = "camSaleByFrenchise('" . $list->id . "')";
				echo '<li onclick="' . $onclick . '" data-id="">' . $list->product_name . '</li>';
			}
		} else {
			echo '<li style="color:#e86d00;border-bottom: 1px dashed #324234;"><i class="dripicons-warning"></i> Oops no product available</li>';
		}
	}
	public function kart_by_frenchise_to_shopee()
	{
		$post = $this->input->post();
		$plist = $this->order->temp_kart_add_by_shopee($this->logId, $post['proId']);
		echo json_encode($plist);
	}
	public function addTempKart()
	{
		$post = $this->input->post();
		$plist = $this->order->temp_kart_add($post['proID'], $this->u_cate, $this->logId);
		if ($plist->quantity < $post['proQty']) {
			$data = array('miResult' => 'error', 'text' => "Oops it seems's we have only " . $plist->quantity . " in our stock", 'adClass' => 'tst_warning');
		} else {
			$adminCharge = $this->common->getRowData('club_income', 'id', '1');
			$tempProduct = $this->sale->temp_product_count_seler_to_buyer($post['buyerID'], $this->logId);
			$totalNumber = $tempProduct->c + 1;
			$tAmt = $post['proQty'] * $plist->product_price;
			$netAmtAftrDiscount = $tAmt - ($tAmt * $plist->discount) / 100;
			$netAmt = $netAmtAftrDiscount + ($netAmtAftrDiscount * $plist->productTax) / 100;
			if ($this->u_cate == '1') {
				$soldBy = $this->u_cate;
				$receivedBy = '2';
			} else if ($this->u_cate == '2') {
				$soldBy = $this->u_cate;
				$receivedBy = '3';
			} else {
				$soldBy = '0';
				$receivedBy = '1';
			}

			$isConWhere = array('seller_id' => $this->logId, 'product_details_id' => $post['proID'], 'member_id' => $post['buyerID'], 'soldBy' => $soldBy, 'receiver_typ' => $receivedBy);
			$isExistData = $this->common->get_data('temp_product_details', $isConWhere, '*');
			if ($isExistData) {

				$newQty = $post['proQty'] + $isExistData['product_qty'];
				$newTamt = $newQty * $isExistData['product_selling_price'];

				$netAmtAfterDis = $newTamt - ($newTamt * $isExistData['discount']) / 100;

				$netAmt = $netAmtAfterDis + ($netAmtAfterDis * $isExistData['productTax']) / 100;
				$onclick = "delSaleTempKart('" . $isExistData['id'] . "@@@@" . $plist->product_name . "')";
				$myRowUpdate = array('qty' => $newQty, 'tAmt' => '<i class="bx bx-rupee inrP"></i> ' . number_format($newTamt, 2), 'netAmt' => '<i class="bx bx-rupee inrP"></i> ' . number_format($netAmt, 2) . ' <button class="kartTrash" onclick="' . $onclick . '"  type="button"><i class="bx bx-trash"></i></button>');
				$whereCon = array('id' => $isExistData['id']);
				$updateTempKart = array('product_qty' => $newQty, 'total_amount' => $netAmtAfterDis, 'net_amount' => $netAmt);
				if ($this->common->update_data('temp_product_details', $whereCon, $updateTempKart)) {
					$whereConForGrand = array('seller_id' => $this->logId, 'member_id' => $post['buyerID'], 'soldBy' => $soldBy, 'receiver_typ' => $receivedBy);
					$grandTotalAmt = $this->common->get_data('temp_product_details', $whereConForGrand, 'sum(net_amount) as gTotal');
					$netPaybleAmt = $grandTotalAmt['gTotal'];
					$data = array(
						'miResult' => 'miRowUpdate', 'text' => $myRowUpdate, 'rowUpdate' => $post['proID'], 'grndT' => $grandTotalAmt['gTotal'],
						'adClass' => 'tst_success', 'msg' => 'Thank You! You have successfully update details',
					);
				} else {
					$msg = array('Oops it seems server taking more time please refresh');
					$data = array('miResult' => 'warning', 'adClass' => 'tst_warning', 'text' => $msg);
				}
			} else {
				$addTempArray = array(
					'member_id' => $post['buyerID'],
					'soldBy' => $soldBy,
					'seller_id' => $this->logId,
					'product_details_id' => $plist->id,
					'product_id' => $plist->prod_id,
					'p_unit' => $plist->unit, 'productBV' => $plist->productBV,
					'product_name' => $plist->product_name,
					'product_selling_price' => $plist->product_price,
					'product_mrp' => $plist->mrp,
					'product_qty' => $post['proQty'],
					'discount' => $plist->discount, 'productTax' => $plist->productTax,
					'total_amount' => $tAmt,
					'net_amount' => $netAmt,
					'receiver_typ' => $receivedBy
				);
				$lastId = $this->common->save_data('temp_product_details', $addTempArray);
				if ($lastId) {
					$onclick = "delSaleTempKart('" . $lastId . "@@@@" . $plist->product_name . "')";
					$myRow = '<tr id="delArv-' . $lastId . '">
							<th id="serial-' . $lastId . '">' . $totalNumber . '.</th>
					    	<td>' . $plist->product_name . '</td>
							<td id="pQty--' . $plist->id . '">' . $post['proQty'] . '</td>
							<td>' . $plist->productBV . '</td><td><i class="bx bx-rupee inrP"></i> ' . $plist->mrp . '</td>
							<td><i class="bx bx-rupee inrP"></i> ' . $plist->product_price . '</td>
							<td>' . $plist->discount . ' <i class="mdi mdi-percent-outline fntClr"></i></td>
							<td  id="tAmt--' . $plist->id . '"> <i class="bx bx-rupee inrP"></i>' . number_format($netAmtAftrDiscount, 2) . '</td>
							<td>' . $plist->productTax . ' <i class="mdi mdi-percent-outline inrR"></i></td>
							<td id="netAmt--' . $plist->id . '"><span id="tProPrice-' . $plist->id . '"><i class="bx bx-rupee inrP"></i> ' . number_format($netAmt, 2) . '</span>
							<button class="kartTrash" onclick="' . $onclick . '" type="button" ><i class="bx bx-trash"></i></button></td>
						    </tr>';
					$whereConForGrand = array('seller_id' => $this->logId, 'member_id' => $post['buyerID'], 'soldBy' => $soldBy, 'receiver_typ' => $receivedBy);
					$grandTotalAmt = $this->common->get_data('temp_product_details', $whereConForGrand, 'sum(net_amount) as gTotal');
					$netPaybleAmt = $grandTotalAmt['gTotal'];
					$msg = 'Thank You! You have successfully add details';
					$data = array(
						'miResult' => 'success', 'text' => $myRow, 'grndT' => $grandTotalAmt['gTotal'],
						'adClass' => 'tst_success', 'msg' => $msg
					);
				} else {
					$msg = array('Oops it seems server taking more time please refresh');
					$data = array('miResult' => 'warning', 'adClass' => 'tst_warning', 'text' => $msg);
				}
			}
		}
		//print_r($data);
		echo json_encode($data);
	}
	public function getTempSale($sellerId, $sellerCate, $buyerId)
	{
		$adminCharge = $this->common->getRowData('club_income', 'id', '1');
		if ($sellerCate == '1') {
			$soldBy = $sellerCate;
			$receivedBy = '2';
		} else if ($sellerCate == '2') {
			$soldBy = $sellerCate;
			$receivedBy = '3';
		} else {
			$soldBy = '0';
			$receivedBy = '1';
		}
		$whereCon = array('member_id' => $buyerId, 'seller_id' => $sellerId, 'soldBy' => $soldBy, 'receiver_typ' => $receivedBy);
		$tempOrderDetails = $this->common->all_data_con('temp_product_details', $whereCon, '*');
		if ($tempOrderDetails) {
			$ctr = 0;
			$grandTotal = 0;
			$content = '';
			foreach ($tempOrderDetails as $dList) {
				$ctr++;
				$tAmt = $dList['product_selling_price'] * $dList['product_qty'];
				$netAmtAftrDis = $tAmt - ($tAmt * $dList['discount']) / 100;

				$netAmt = $netAmtAftrDis + ($netAmtAftrDis * $dList['productTax']) / 100;
				$grandTotal += $netAmt;
				$kartTrash = "delSaleTempKart('" . $dList['id'] . '@@@@' . $dList['product_name'] . "')";
				$content .= '<tr id="delArv-' . $dList['id'] . '">
					      <th id="serial-' . $dList['id'] . '">' . $ctr . '.</th>
						  <td>' . $dList['product_name'] . '</td>
						  <td id="pQty--' . $dList['product_details_id'] . '">' . $dList['product_qty'] . '</td>
						  <td>' . $dList['productBV'] . '</td>
						  <td><i class="bx bx-rupee inrP"></i> ' . $dList['product_mrp'] . '</td>
						  <td><i class="bx bx-rupee inrP"></i> ' . $dList['product_selling_price'] . '</td>
						  <td>' . $dList['discount'] . ' <i class="mdi mdi-percent-outline inrP"></i></td>
						  <td id="tAmt--' . $dList['product_details_id'] . '"><i class="bx bx-rupee inrP"></i> ' . number_format($netAmtAftrDis, 2) . '</td>
						  <td>' . $dList['productTax'] . ' <i class="mdi mdi-percent-outline inrR"></i></td>
						  <td id="netAmt--' . $dList['product_details_id'] . '"><i class="bx bx-rupee inrP"></i> ' . number_format($netAmt, 2) . '
						  <button class="kartTrash" onclick="' . $kartTrash . '" type="button"><i class="bx bx-trash"></i></button></td>
						</tr>';
			}
			$paybleAmt = $grandTotal;
			$result = array('getOrd' => $content, 'miTxt' => 'success', 'grandTotal' => number_format($grandTotal, 2));
			return $result;
		}
	}
	public function make_payment()
	{
		$post = $this->input->post();
		$seller = NULL;
		$buyer = NULL;
		$byUserName = NULL;
		$adminCharge = $this->common->getRowData('club_income', 'id', '1');
		if ($this->u_cate == '1') {
			$oprsnTitle = 'This sale is generated by frenchise to shoppee';
			$buyer = $this->partner->profile_details($post['byrID']);
			$seller = $this->partner->profile_details($this->logId);
			$soldBy = $this->u_cate;
			$receivedBy = '2';
		} else if ($this->u_cate == '2') {
			$oprsnTitle = 'This sale is generated by shopee to member';
			$seller = $this->partner->profile_details($this->logId);
			$buyer = $this->member->profile_details_by_username($post['buyerID']);
			$soldBy = $this->u_cate;
			$receivedBy = '3';
		} else {
			$oprsnTitle = 'This sale is generated by admin to frenchise';
			$soldBy = '0';
			$receivedBy = '1';
		}
		$byUserName = $post['buyerID'];
		$whereCon = array('member_id' => $post['byrID'], 'seller_id' => $this->logId, 'soldBy' => $soldBy, 'receiver_typ' => $receivedBy);
		$tempSaleDetails = $this->common->all_data_con('temp_product_details', $whereCon, '*');
		$data['ordID'] = 'Msdr' . date('his');
		$data['buyer'] = $buyer;
		$data['seller'] = $seller;
		$data['oprsnTitle'] = $oprsnTitle;
		$data['tempSaleDetails'] = $tempSaleDetails;
		$data['adminCharge'] = $adminCharge;
		$data['byUserName'] = $byUserName;
		$data['title'] = 'Make Payment';
		$data['breadcrums'] = 'Make Payment';
		$data['layout'] = 'sale/make_payment.php';
		$this->load->view('partner/base', $data);
	}
	public function payment_success()
	{
		$post = $this->input->post();
		$saleDate = date('Y-m-d');
		$saleData = explode("@@@@@", base64_decode(urldecode($post['saleID'])));
		if ($this->u_cate == '1') {
			$soldBy = $this->u_cate;
			$receivedBy = '2';
			$saleDetails = 'order_details';
			$saleHistory = 'order_history';
			$wallTnx = 'partner_wallet_transaction';
		} else if ($this->u_cate == '2') {
			$soldBy = $this->u_cate;
			$receivedBy = '3';
			$saleDetails = 'sale_details';
			$saleHistory = 'sale_history';
			$wallTnx = 'wallet_transaction';
		} else {
			$soldBy = '0';
			$receivedBy = '1';
			$saleDetails = 'order_details';
			$saleHistory = 'order_history';
		}
		$whereCon = array('member_id' => $saleData[2], 'seller_id' => $this->logId, 'soldBy' => $soldBy, 'receiver_typ' => $receivedBy);
		$tempSaleDetails = $this->common->all_data_con('temp_product_details', $whereCon, '*');
		if ($tempSaleDetails) {

			$grandTotalAmt = $saleData[1] + $saleData[3] + ($saleData[1] * $saleData[4]) / 100;
			$sale_HistoryArr = array(
				'invoice_id' => $saleData[0], 'customer_id' => $saleData[2], 'grand_total' => $grandTotalAmt, 'paid_amt' => $post['paybleAmt'], 'tax' => $saleData[4],
				'shipping_charge' => $saleData[3], 'order_date' => $saleDate, 'order_status' => '3', 'soldBy' => $soldBy, 'seller_id' => $this->logId,
				'delevery_date' => $saleDate
			);

			/*print_r($grandTotalAmt);echo '<br>';
			$data=array('adClass'=>'tst_danger','text'=>'There is no data in sale kart');
			die;*/

			$createSaleHistory = $this->common->save_data($saleHistory, $sale_HistoryArr);
			if ($createSaleHistory) {
				$purchasedBV = 0;
				foreach ($tempSaleDetails as $dList) {
					$pBV = $dList['product_qty'] * $dList['productBV'];
					$tAmt = $dList['product_selling_price'] * $dList['product_qty'];
					$netAmt = $tAmt - ($tAmt * $dList['discount']) / 100;
					$saleDataArr = array(
						'order_id' => $createSaleHistory, 'invoice_id' => $saleData[0], 'member_id' => $saleData[2], 'product_details_id' => $dList['product_details_id'],
						'product_id' => $dList['product_id'], 'product_name' => $dList['product_name'], 'product_selling_price' => $dList['product_selling_price'],				                                           'product_mrp' => $dList['product_mrp'], 'product_qty' => $dList['product_qty'], 'discount' => $dList['discount'], 'total_amount' => $tAmt,
						'net_amount' => $netAmt, 'productBv' => $dList['productBV'], 'productTax' => $dList['productTax']
					);
					if ($this->common->save_data($saleDetails, $saleDataArr)) {
						$isStockWhereCon = array('partner_id' => $this->logId, 'product_details_id' => $dList['product_details_id']);
						$isProductStock = $this->common->get_data('partner_stock', $isStockWhereCon, '*');
						$totalQtyForPartnerStock = $isProductStock['product_qty'] - $dList['product_qty'];
						$whereConStockUpForPartner = array('id' => $isProductStock['id']);
						$stockForPartnerUpdateArr = array(
							'product_qty' => $totalQtyForPartnerStock, 'lastInStock' => $dList['product_qty'],
							'modified_type' => '1', 'stockInDate' => $saleDate, 'modify_date' => $saleDate, 'modified_by' => $this->logId,
							'stockDescId' => $createSaleHistory
						);
						if ($this->common->update_data('partner_stock', $whereConStockUpForPartner, $stockForPartnerUpdateArr)) {

							$isProWhereCon = array('partner_id' => $saleData[2], 'product_details_id' => $dList['product_details_id']);
							$isProductExist = $this->common->get_data('partner_stock', $isProWhereCon, '*');
							if ($isProductExist) {
								$totalQty = $dList['product_qty'] + $isProductExist['product_qty'];
								$whereConStockUp = array('id' => $isProductExist['id']);
								$stockUpdateArr = array(
									'product_qty' => $totalQty, 'lastInStock' => $dList['product_qty'], 'modified_type' => '1', 'stockInDate' => $saleDate,
									'modify_date' => $saleDate, 'modified_by' => $this->logId, 'stockIncId' => $createSaleHistory
								);
								if ($this->common->update_data('partner_stock', $whereConStockUp, $stockUpdateArr)) {
									$result = '1';
								} else {
									$result = '2';
								}
							} else {
								$stockCreateArr = array(
									'partner_id' => $saleData[2], 'product_details_id' => $dList['product_details_id'],
									'product_price' => $dList['product_selling_price'], 'product_mrp' => $dList['product_mrp'],
									'product_qty' => $dList['product_qty'], 'lastInStock' => $dList['product_qty'], 'created_type' => '1',
									'last_purchase_id' => $createSaleHistory, 'stockInDate' => $saleDate, 'create_date' => $saleDate,
									'created_by' => $this->logId, 'stockIncId' => $createSaleHistory
								);
								if ($this->common->save_data('partner_stock', $stockCreateArr)) {
									$result = '1';
								} else {
									$result = '2';
								}
							}
						} else {
							$result = '2';
						}
					} else {
						$result = '2';
					}
					$purchasedBV += $pBV;
				}
				if ($result == '1') {

					$tnxNu = date('dHis');
					$tPurchaseAmt = $grandTotalAmt; //+$saleData[3]+($grandTotalAmt*$saleData[4])/100;
					$earnBvWhere = array('id' => $createSaleHistory);
					$updtEarnedBvArr = array('earnedBv' => $purchasedBV, 'approvedBy' => $this->logId, 'admnTnx' => $tnxNu);
					$this->common->update_data($saleHistory, $earnBvWhere, $updtEarnedBvArr);

					$walletTnxFrByrArr = array(
						'tnx_id' => $tnxNu, 'user_id' => $saleData[5], 'debit_amt' => $tPurchaseAmt, 'reason' => 'Amount debited after product purchase',
						'created_by' => '0', 'create_date' => date('Y-m-d H:i:s')
					);
					$createWallTnxFrByr = $this->common->save_data($wallTnx, $walletTnxFrByrArr);

					$walletTnxFrSlrArr = array(
						'tnx_id' => $tnxNu, 'user_id' => $this->u_id, 'credit_amt' => $post['paybleAmt'],
						'reason' => 'Amount credited after product purchase of member # ' . $saleData[5],
						'created_by' => '0', 'create_date' => date('Y-m-d H:i:s')
					);
					$createWallTnxFrSlr = $this->common->save_data('partner_wallet_transaction', $walletTnxFrSlrArr);
					if ($this->u_cate == '2') {
						$earningArr = array(
							'userid' => $saleData[5], 'amount' => $tPurchaseAmt, 'earnedBv' => $purchasedBV,
							'type' => 'Amount credited after product purchase of member # ' . $this->u_id,
							'ref_id' => 'After Purchase', 'create_date' => date('Y-m-d H:i:s')
						);
						$createEarningFrByr = $this->common->save_data('earning', $earningArr);
					}

					$earningSlrArr = array(
						'userid' => $this->u_id, 'amount' => $post['paybleAmt'], 'earnedBv' => $purchasedBV,
						'type' => 'Amount credited after product sale of member # ' . $saleData[5],
						'ref_id' => 'After Sale', 'create_date' => date('Y-m-d H:i:s')
					);
					$createEarningFrSlr = $this->common->save_data('partner_earning', $earningSlrArr);
					$whereMultiCon = array('member_id' => $saleData[2], 'seller_id' => $this->logId, 'soldBy' => $soldBy, 'receiver_typ' => $receivedBy);
					if ($this->common->del_data_multi_con('temp_product_details', $whereMultiCon)) {
						$data = array('adClass' => 'tst_success', 'text' => 'Thank you ! You have successfully complete your order', 'targetUrl' => base_url('partner/sale'));
					} else {
						$data = array('adClass' => 'tst_danger', 'text' => 'Oops it seems there is an issues while updating stock');
					}
				}
			} else {
				$data = array('adClass' => 'tst_danger', 'text' => 'Oops it seems there is an issues while creating order');
			}
		} else {
			$data = array('adClass' => 'tst_danger', 'text' => 'There is no data in sale kart');
		}
		echo json_encode($data);
	}
	public function manage()
	{
		$post = $this->input->post();
		if ($post['actn'] == 'delTempSaleProduct') {

			$whereCon = array('id' => $post['dataId'], 'table' => 'temp_product_details');
			$delDetails = $this->common->del_data($whereCon);
			//$delDetails ='1';
			if ($delDetails) {
				if ($this->u_cate == '1') {
					$soldBy = $this->u_cate;
					$receivedBy = '2';
				} else if ($this->u_cate == '2') {
					$soldBy = $this->u_cate;
					$receivedBy = '3';
				} else {
					$soldBy = '0';
					$receivedBy = '1';
				}
				$whereMultiCon = array('member_id' => $post['byrID'], 'seller_id' => $this->logId, 'soldBy' => $soldBy, 'receiver_typ' => $receivedBy);
				$tempOrderDetails = $this->common->all_data_con('temp_product_details', $whereMultiCon, '*');
				$idArr = array();
				if ($tempOrderDetails) {
					$grandTotal = 0;
					$adminCharge = $this->common->getRowData('club_income', 'id', '1');
					foreach ($tempOrderDetails as $miList) {
						$tAmt = $miList['product_selling_price'] * $miList['product_qty'];
						$netAmtAftrDiscount = $tAmt - ($tAmt * $miList['discount']) / 100;
						$netAmt = $netAmtAftrDiscount + ($netAmtAftrDiscount * $miList['productTax']) / 100;
						$grandTotal += $netAmt;
						array_push($idArr, $miList['id']);
					}
					$paybleAmt = $grandTotal;
					$data = array('adClass' => 'tst_success', 'text' => 'Thank you! you have successfully delete', 'id' => $post['dataId'], 'srCnt' => $idArr, 'grandTotal' => $grandTotal);
				} else {
					$data = array('adClass' => 'tst_danger', 'text' => 'Please add product to sale');
				}
			} else {
				$data = array('adClass' => 'tst_danger', 'text' => '<i class="mdi mdi-alert-outline me-2"></i> Oops it seems error while deleting');
			}
		} else {
			$data = array('adClass' => 'tst_danger', 'text' => 'Oops there is something went wrong while deleting');
		}
		//print_r($data);
		echo json_encode($data);
	}

	public function by_shopee()
	{
		$post = $this->input->post();
		$plist = $this->order->getProductByFrenchiseStock($this->logId, $post['proName']); //echo $this->db->last_query();
		if ($plist) {
			foreach ($plist as $list) {
				$onclick = "camSaleByShopee('" . $list->id . "')";
				echo '<li onclick="' . $onclick . '" data-id="">' . $list->product_name . '</li>';
			}
		} else {
			echo '<li style="color:#e86d00;border-bottom: 1px dashed #324234;"><i class="dripicons-warning"></i> Oops no product available</li>';
		}
	}
	public function kart_product_by_shopee()
	{
		$post = $this->input->post();
		$plist = $this->order->temp_kart_add_by_shopee($this->logId, $post['proId']);
		echo json_encode($plist);
	}
}
