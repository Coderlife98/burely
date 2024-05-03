<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
            <h4 class="mb-sm-0 font-size-16 fw-bold"><?php echo $title ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active"><?php echo $breadcrums ?></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <p class="alert alert-danger" role="alert">
        <strong><i class="fas fa-exclamation-triangle"></i> Warning!</strong><span style="font-size:11.5px;">  Please donot change any setting here until and unless you know what you are doing. Please
        take support team or developer advice before making any changes at live site.</span>
    </p>
    <div class="col-lg-8">
        <!-- Basic Setting Start -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header dsbrCrdTitle">
                    <h4 class="card-title text-white"><i class="mdi mdi-hospital-building"></i> Company Basic Details</h4>
                </div>
                <div class="card-body">
                    <form id="basic_data">
                        <div class="row">
                            <div class="col-md-6 pt-2">
                                <label for="Company Name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name" value="<?php echo config_item('mlm_company_name') ?>">
                            </div>
                            <div class="col-md-6 pt-2">
                                <label for="Mobile Number" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile Number" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')" maxlength="10" value="<?php echo config_item('mlm_mobile_number') ?>">
                            </div>
                            <div class="col-md-6 pt-2">
                                <label for="Email Id" class="form-label">Email ID <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email ID" value="<?php echo config_item('mlm_email') ?>">
                            </div>
                            <div class="col-md-6 pt-2">
                                <label for="Id Prefix" class="form-label">ID Prefix <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="prefix" placeholder="Enter ID Prefix" value="<?php echo config_item('mlm_prefix') ?>">
                            </div>
                            <div class="col-md-6 pt-2">
                                <label for="Currency Sign" class="form-label">Currency Sign <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="currency_sign" placeholder="Enter Currency Sign" value="<?php echo config_item('mlm_currency_sign') ?>">
                            </div>
                            <div class="col-md-6 pt-2">
                                <label for="Currency ISO Code" class="form-label">Currency ISO Code (3 Character) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="currency_code" placeholder="Enter Currency ISO Code (3 Character)" value="<?php echo config_item('mlm_currency_code') ?>">
                            </div>
                            <div class="col-md-12 pt-2">
                                <label for="Address" class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" placeholder="Enter Address"><?php echo config_item('mlm_address') ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 pt-2">
                            <button type="submit" class="btn btn-outline-primary waves-effect waves-light pull-right"><i class="bx bx-save"></i> Submit</button>
                        </div>
                    </form>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- Basic Setting End -->

        <!-- Payout Setting Start -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header pyout">
                    <h4 class="card-title"><i class="bx bx-money"></i>  Pay Out Setting</h4>
                </div>
                <div class="card-body">
                    <form id="payout_data">
                        <div class="row">
                            <div class="col-md-6 pt-2">
                                <label for="Withdraw Fund" class="form-label">Allow User to Withdraw Fund <span class="text-danger">*</span></label>
                                <select name="fund" class="form-control">
                                    <option value="">----Select One----</option>
                                    <option value="Yes" <?php echo (config_item('mlm_withdraw_fund') == 'Yes') ? "Selected":"" ?>>Yes</option>
                                    <option value="No"  <?php echo (config_item('mlm_withdraw_fund') == 'No') ? "Selected":"" ?>>No</option>
                                </select>
                            </div>
                            <div class="col-md-6 pt-2">
                                <label for="Minimum Withdraw" class="form-label">Min amount allowed to Withdraw (in <?php echo config_item('mlm_currency_sign')?> ) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="minimum_amt" placeholder="Enter Min amount allowed to Withdraw (in <?php echo config_item('mlm_currency_sign')?> )" value="<?php echo config_item('mlm_withdraw_amt') ?>" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                            </div>
                            <div class="col-md-6 pt-2">
                                <label for="Payout Deduction Type" class="form-label">Payout Deduction Type <span class="text-danger">*</span></label>
                                <select name="deduction_type" class="form-control">
                                    <option value="">----Select One----</option>
                                    <option value="1" <?php echo (config_item('mlm_deduction_type') == '1') ? "Selected":"" ?>>Percentage(%)</option>
                                    <option value="2"  <?php echo (config_item('mlm_deduction_type') == '2') ? "Selected":"" ?>>Fixed</option>
                                </select>
                            </div>
                            <div class="col-md-6 pt-2">
                                <label for="TDS Charge" class="form-label">Payout TDS Charge <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="tds" placeholder="Enter Payout TDS Charge" value="<?php echo config_item('mlm_tds') ?>" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                            </div>
                            <div class="col-md-12 pt-2">
                                <label for="Admin Charge" class="form-label">Payout Admin Charge <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="admin_charge" placeholder="Enter Payout Admin Charge " value="<?php echo config_item('mlm_admin_charge') ?>" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                            </div>
                        </div>
                        <div class="col-md-12 pt-2">
                            <button type="submit" class="btn btn-outline-primary waves-effect waves-light pull-right"><i class="bx bx-save"></i> Submit</button>
                        </div>
                    </form>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- Payout Setting End -->

        <!-- SMTP Setting Start -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header smtpEml">
                    <h4 class="card-title"><i class="bx bx-envelope"></i> SMTP Setting</h4>
                </div>
                <div class="card-body">
                    <form id="smtp_data">
                        <div class="row">
                            <div class="col-md-6 pt-2">
                                <label for="Company Name" class="form-label">SMTP Host <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="host" placeholder="Enter SMTP Host" value="<?php echo config_item('mlm_host') ?>">
                            </div>
                            <div class="col-md-6 pt-2">
                                <label for="Mobile Number" class="form-label">SMTP User Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="username" placeholder="Enter User Name"  value="<?php echo config_item('mlm_username') ?>">
                            </div>
                            <div class="col-md-6 pt-2">
                                <label for="Email Id" class="form-label">SMTP Password <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="password" placeholder="Enter Password" value="<?php echo config_item('mlm_password') ?>">
                            </div>
                            <div class="col-md-6 pt-2">
                                <label for="Email Id" class="form-label">SMTP Port (SSL Only) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="port" placeholder="Enter SMTP Port (SSL Only)" value="<?php echo config_item('mlm_port') ?>" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                            </div>
                        </div>
                        <div class="col-md-12 pt-2">
                            <button type="submit" class="btn btn-outline-primary waves-effect waves-light pull-right"><i class="bx bx-save"></i> Submit</button>
                        </div>
                    </form>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- SMTP Setting End -->
    </div>
    <div class="col-lg-4">
        <!-- Dark Logo Start -->
        <div class="card">
            <div class="card-header dsbrCrdTitle_grn">
                <h4 class="card-title text-white"><i class="bx bx-store"></i> Logo Dark </h4>
            </div>
            <div class="card-body">
                <form id="dark_logo_update" enctype="multipart/form-data" method="POST">
                    <div class="input-group">
                        <input type="file" class="form-control" name="dark_logo">
                        <input type="submit" class="input-group-text" value="Update">
                    </div>
                </form>
                <div class="text-center pt-2">
                    <img src="<?php echo base_url('media/images/' . config_item('mlm_logo_dark')) ?>" alt="Dark Logo" width="100%">
                </div>
            </div><!-- end card-body -->
        </div>
        <!-- Dark Logo End -->

        <!-- Dark Favicon Start -->
        <div class="card">
            <div class="card-header crdtitle_ylw">
                <h4 class="card-title"><i class="bx bx-store"></i> Dark Favicon </h4>
            </div>
            <div class="card-body">
                <form id="dark_favicon_update" enctype="multipart/form-data" method="POST">
                    <div class="input-group">
                        <input type="file" class="form-control" name="dark_favicon">
                        <input type="submit" class="input-group-text" value="Update">
                    </div>
                </form>
                <div class="text-center pt-2">
                    <img src="<?php echo base_url('media/images/' . config_item('mlm_logo_sm')) ?>" alt="Small Logo" width="35%">
                </div>
            </div><!-- end card-body -->
        </div>
        <!-- Dark Favicon End -->

        <!-- Light Logo Start -->
        <div class="card">
            <div class="card-header crdtitle_lyt">
                <h4 class="card-title text-white"><i class="bx bx-store"></i> Light Logo </h4>
            </div>
            <div class="card-body">
                <form id="light_logo_update" enctype="multipart/form-data" method="POST">
                    <div class="input-group">
                        <input type="file" class="form-control" name="light_logo">
                        <input type="submit" class="input-group-text" value="Update">
                    </div>
                </form>
                <div class="text-center mt-3 pt-2 bg-danger">
                    <img src="<?php echo base_url('media/images/' . config_item('mlm_logo_light')) ?>" alt="Logo" width="100%">
                </div>
            </div><!-- end card-body -->
        </div>
        <!-- Light Logo End -->

        <!--Light Favicon Start -->
        <div class="card">
            <div class="card-header crdtitle_fabIcn">
                <h4 class="card-title"><i class="bx bx-store"></i> Light Favicon </h4>
            </div>
            <div class="card-body">
                <form id="light_favicon_update" enctype="multipart/form-data" method="POST">
                    <div class="input-group">
                        <input type="file" class="form-control" name="light_favicon">
                        <input type="submit" class="input-group-text" value="Update">
                    </div>
                </form>
                <div class="text-center mt-3 pt-2 bg-danger">
                    <img src="<?php echo base_url('media/images/' . config_item('mlm_logo_sm_light')) ?>" alt="Logo" width="35%">
                </div>
            </div><!-- end card-body -->
        </div>
        <!-- Light Favicon End -->
    </div>
</div>



<!-- end page title -->

<script src="<?php echo base_url() ?>media/js/super_admin/mlm_software/setting.js"></script>