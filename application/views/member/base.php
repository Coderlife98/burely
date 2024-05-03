<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $title ?> | <?php echo config_item('company_name') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="<?php echo config_item('company_name') ?>" name="description" />
    <meta content="<?php echo config_item('company_name') ?>" name="author" />
    <?php $this->load->view('member/include/css') ?>
    <style>
        .vertical-menu {
            width: 275px
                /* !important*/
            ;
        }

        .main-content {
            margin-left: 275px;
        }

        .getcAccP {
            margin-top: 20px;
            padding: 5px 0px 5px 5px;
            background-color: #e8e8e8;
            border: 1px solid #cecece;
        }

        .getcAcc {
            margin-top: -180px;
            margin-left: 10rem;
        }

        .getcAcc ul {
            list-style: none;
        }

        .getcAcc ul li {
            padding: 10px 0px 10px 0px;
            border-bottom: 1px dashed #454545;
        }

        .getcAcc ul li:last-child {
            border-bottom: 0px;
        }

        .getcAcc ul li span {
            font-weight: 600;
            padding-left: 10px;
        }

        .getNotify {
            border: 1px solid #ce76a3;
            /*padding: 28% 1% 28% 1%;*/
            background-color: #f0a0c9;
            color: #73033c;
        }

        .getNotify ul {
            list-style: none;
            margin-left: -2rem;
        }

        .getNotify ul li:first-child {
            background-color: #e762a6;
            height: 50px;
            padding: 8px 0px 0px 10px;
            font-weight: bold;
            color: #f9f9f9;
        }

        .getNotify ul li {
            height: 232px;
            padding: 5px 0px 0px 10px;
        }

        .ntfy {
            padding: 10px;
            background-color: #ae3473;
            border-radius: 20px;
        }

        @media (max-width: 768px) {
            .getcAcc {
                margin-top: 0px;
                margin-left: -35px;
                text-align: left;
            }

            .getcAccP {
                text-align: center
            }

            .getcAccP img {
                height: 280px;
                margin-left: -5px;
                margin-top: 3px;
            }
        }

        .getcAcc ul li {
            padding-left: 10px;
        }


        #scroll-container {
            border-radius: 5px;
            height: 108%;
            overflow: hidden;
            margin: -3px 0px 0px 0px;
        }

        #mi-scroll {
            height: 100%;
            -moz-transform: translateY(100%);
            -webkit-transform: translateY(100%);
            transform: translateY(100%);
            -moz-animation: my-animation 10s linear infinite;
            -webkit-animation: my-animation 10s linear infinite;
            animation: my-animation 10s linear infinite;
        }

        #mi-scroll:hover {
            -moz-animation-play-state: paused;
            -webkit-animation-play-state: paused;
            animation-play-state: paused;
            cursor: pointer;
        }

        @-moz-keyframes my-animation {
            from {
                -moz-transform: translateY(100%);
            }

            to {
                -moz-transform: translateY(-100%);
            }
        }

        @-webkit-keyframes my-animation {
            from {
                -webkit-transform: translateY(100%);
            }

            to {
                -webkit-transform: translateY(-100%);
            }
        }

        @keyframes my-animation {
            from {
                -moz-transform: translateY(100%);
                -webkit-transform: translateY(100%);
                transform: translateY(100%);
            }

            to {
                -moz-transform: translateY(-100%);
                -webkit-transform: translateY(-100%);
                transform: translateY(-100%);
            }
        }

        #mi-scroll {}
    </style>
</head>

<body data-sidebar="light" data-topbar="dark">
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->
    <!-- Loader   #005c71 -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php $this->load->view('member/include/header') ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php $this->load->view('member/include/left') ?>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="ami_toast tst_warning"><i class="bx bx-error"></i> ami popup notification</div>



                    <?php //print_r($this->session->userdata);
                    ?>
                    <?php
                    if (!empty($layout) && trim($layout) !== "") {
                        require_once($layout);
                    } else { ?>
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
                                    <h4 class="mb-sm-0 font-size-16 fw-bold">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <div class="row">

                            <?php

                            if ($reminder) {
                            ?>
                                <div class="col-lg-12">
                                    <div style="background-color: #b54400;padding: 20px;color: #fff;margin-bottom: 20px;font-weight: bold;font-size: 16px;border: 1px dashed white;">
                                        <?php
                                        if ($reminder == '1') {
                                            echo 'आपके खाते में कोई सक्रिय पैकेज नहीं है इसलिए कृपया निकटतम कार्यालय से पैकेज खरीदें |';
                                        }
                                        if ($reminder == '2') {
                                            echo 'आपका केवाईसी अपडेट नहीं है कृपया लेनदेन करने के लिए अपना केवाईसी अपडेट करें |';
                                        }


                                        ?>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>


                        <div class="row">

                            <div class="col-md-6">
                                <div class="row">

                                    <div class="col-md-6 col-xl-6">
                                        <div class="card bg-danger border-danger">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <div class="avatar-sm mx-auto mb-4">
                                                        <span class="avatar-title rounded-circle bg-light font-size-24">
                                                            <i class="mdi mdi-cash-multiple text-danger"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="text-uppercase fw-semibold font-size-13 font_clr">Total Purchase</p>
                                                    <h4 class="mb-1 mt-1 font_clr"><i class="bx bx-rupee"></i>
                                                        <span class="counter-value " data-target="<?php if ($tRepurchase) {
                                                                                                        echo $tRepurchase['amt'];
                                                                                                    } ?>">0</span>
                                                    </h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>





                                    <div class="col-md-6 col-xl-6">
                                        <div class="card bg-danger border-danger">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <div class="avatar-sm mx-auto mb-4">
                                                        <span class="avatar-title rounded-circle bg-light font-size-24">
                                                            <i class="mdi mdi-cart-check text-danger"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="font_clr text-uppercase fw-semibold font-size-13">Self Purchase</p>
                                                    <h4 class="font_clr mb-1 mt-1"><i class="bx bx-rupee"></i>
                                                        <span class="counter-value" data-target="<?php if ($tRepurchase) {
                                                                                                        echo $tRepurchase['amt'];
                                                                                                    } ?>">0</span>
                                                    </h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-xl-6">
                                        <div class="card bg-primary border-primary">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <div class="avatar-sm mx-auto mb-4">
                                                        <span class="avatar-title rounded-circle bg-light font-size-24">
                                                            <i class="mdi mdi-refresh-circle text-primary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="font_clr text-uppercase fw-semibold font-size-13">Total Refunds</p>
                                                    <h4 class="mb-1 mt-1 font_clr"><i class="bx bx-rupee"></i><span class="counter-value " data-target="0">0</span></h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                   
                                    <div class="col-md-6 col-xl-6">
                                        <div class="card bg-success border-success">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <div class="avatar-sm mx-auto mb-4">
                                                        <span class="avatar-title rounded-circle bg-light font-size-24">
                                                            <i class="mdi mdi-cart-check text-success"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="font_clr text-uppercase fw-semibold font-size-13">UpComing Earning</p>
                                                    <h4 class="font_clr mb-1 mt-1"><i class="bx bx-rupee"></i>
                                                        <span class="counter-value" data-target="<?php if ($upCommingEarned) {
                                                                                                        echo $upCommingEarned['amt'];
                                                                                                    } ?>">0</span>
                                                    </h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-xl-6">
                                        <div class="card <?php if ($reminder == '1') { ?>bg-danger border-danger<?php } else { ?>bg-success border-success<?php } ?>">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <div class="avatar-sm mx-auto mb-4">
                                                        <span class="avatar-title rounded-circle bg-light font-size-24">
                                                            <i class="mdi mdi-account-group <?php if ($reminder == '1') { ?>text-danger<?php } else { ?>text-success<?php } ?>"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="font_clr text-uppercase fw-semibold font-size-13">Current Status</p>
                                                    <div style="color:#fff;font-weight: bold;"><?php if ($reminder == '1') { ?>Deactive<?php } else { ?>Active<?php } ?></div>


                                                    <!-- <h4 class="font_clr mb-1 mt-1"><i class="bx bx-star"></i>
											<span class="counter-value" data-target="<?php //if($totalEarned){echo $totalEarned['amt'];}
                                                                                        ?>">aCTIVE</span></h4>-->
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xl-6">
                                        <div class="card bg-dark border-dark">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <div class="avatar-sm mx-auto mb-4">
                                                        <span class="avatar-title rounded-circle bg-light font-size-24">
                                                            <i class="mdi mdi-cash-multiple text-dark"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="text-uppercase fw-semibold font-size-13 font_clr"> Active Package </p>
                                                    <h4 class="mb-1 mt-1 font_clr"><i class="bx bx-rupee"></i>
                                                        <span class="counter-value " data-target="<?php if ($getMember) {
                                                                                                        echo $getMember->topup;
                                                                                                    } ?>">0</span>
                                                    </h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-xl-6">
                                        <div class="card bg-dark border-dark">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <div class="avatar-sm mx-auto mb-4">
                                                        <span class="avatar-title rounded-circle bg-light font-size-24">
                                                            <i class="mdi mdi-refresh-circle text-dark"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="font_clr text-uppercase fw-semibold font-size-13">Current level</p>
                                                    <div style="color:#fff;font-weight: bold;">Normal </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xl-6">
                                        <div class="card bg-success border-success">
                                            <div class="card-body">
                                                <div class="float-end">
                                                    <div class="avatar-sm mx-auto mb-4">
                                                        <span class="avatar-title rounded-circle bg-light font-size-24">
                                                            <i class="mdi mdi-wallet text-primary"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <p class="font_clr text-uppercase fw-semibold font-size-13">Wallet</p>
                                                    <h4 class="font_clr mb-1 mt-1"><i class="bx bx-rupee"></i>
                                                        <span class="counter-value" data-target="<?php if ($wallet) {
                                                                                                        echo $wallet['amt'];
                                                                                                    } ?>">0</span>
                                                    </h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>





                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="getNotify">
                                    <ul>
                                        <li><i class="bx bx-news ntfy"></i> Latest Updates</li>
                                        <li>


                                            <div id="scroll-container">
                                                <div id="mi-scroll">
                                                    <?php
                                                    if ($notifDetails) {
                                                        foreach ($notifDetails as $listv) {
                                                    ?>



                                                            <div style=" font-weight:600; font-size:16px; "><?php echo $listv['subject']; ?></div>
                                                            <div style="font-size:14px; margin-bottom:10px;padding-left: 10px;"><?php echo $listv['message']; ?></div>

                                                    <?php }
                                                    } ?>

                                                </div>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                                <div class="getcAccP">
                                    <img src="<?php echo base_url($accDetails->qr_code); ?>" alt="paymentQr">
                                    <div class="getcAcc">
                                        <ul>
                                            <li>Bank Name: <span><?php echo $accDetails->bank_name; ?></span>

                                                <?php //print_r($accDetails);
                                                ?>



                                            </li>
                                            <li>Account Number:<span><?php echo $accDetails->acc_number; ?></span></li>
                                            <li>IFSC Code:<span><?php echo $accDetails->ifsc_code; ?></span></li>
                                            <li>Branch:<span><?php echo $accDetails->branch; ?></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="row">

                            <div class="col-lg-12">
                                <div class="card">
                                    <h4 class="card-title mb-4 dbTitle"><i class="bx bx-basket dbIcn"></i> RECENT PURCHAGE HISTORY</h4>
                                    <div class="card-body">
                                        <div class="table-responsive">

                                            <?php //print_r($recentOrder);
                                            ?>
                                            <table class="table table-hover table-striped align-middle table-centered table-nowrap mb-0">
                                                <thead class="btlHeader">
                                                    <tr>
                                                        <th>S No.</th>
                                                        <th>Invoice Id</th>
                                                        <th>Amount</th>

                                                        <th>Order Date</th>
                                                        <th>Delivery Date</th>

                                                        <th>Status</th>
                                                        <th style="text-align: center !important">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($recentOrder) {
                                                        $cnt = 0;
                                                        foreach ($recentOrder as $recent) {
                                                            $cnt++;

                                                            $tAmt = $recent->grand_total + $recent->shipping_charge + ($recent->grand_total * $recent->tax) / 100;
                                                            $getUid = base_url('member/order/detials/' . urlencode(base64_encode($recent->invoice_id)));

                                                            if ($recent->order_status == '0') {
                                                                $stsTex = 'Cancelled';
                                                                $activeCls = 'ordCancel';
                                                            } else if ($recent->order_status == '1') {
                                                                $stsTex = 'Placed';
                                                                $activeCls = 'ordPlced';
                                                            } else if ($recent->order_status == '2') {
                                                                $stsTex = 'Shipped';
                                                                $activeCls = 'ordShipped';
                                                            } else if ($recent->order_status == '3') {
                                                                $stsTex = 'Delevered';
                                                                $activeCls = 'ordDelevered';
                                                            } else {
                                                                $stsTex = 'Not Yet';
                                                                $activeCls = 'setBtnGr dctive';
                                                            }

                                                    ?>
                                                            <tr>
                                                                <th><?php echo $cnt; ?>.</th>
                                                                <td><?php echo $recent->invoice_id; ?></td>
                                                                <td><i class="bx bx-rupee inrP"></i> <?php echo number_format($tAmt, 2); ?></td>
                                                                <td><?php echo date('d-M-Y', strtotime($recent->order_date)); ?></td>
                                                                <td><?php echo date('d-M-Y', strtotime($recent->delevery_date)); ?></td>
                                                                <td>
                                                                    <div class="<?php echo $activeCls; ?> getAction"><span><?php echo $stsTex; ?></span></div>
                                                                </td>
                                                                <td>
                                                                    <div style="text-align:center;">
                                                                        <a href=" <?php echo $getUid; ?>" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                            <!-- end table -->

                                        </div>
                                        <!--end table-responsive-->
                                    </div>
                                </div>
                            </div>
                        </div>


                        <input type="hidden" id="base_url" value="<?php echo base_url(); ?>member/dashboard/" />

                    <?php } ?>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <?php $this->load->view('member/include/footer') ?>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <?php $this->load->view('member/include/js') ?>
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
</body>


</html>