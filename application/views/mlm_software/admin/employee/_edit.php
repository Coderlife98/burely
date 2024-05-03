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
<?php //print_r($getEmpDetails);
if ($getEmpDetails['photo']) {
    $getImg = $this->baseUrl . $getEmpDetails['photo'];
} else {
    $getImg = $this->baseUrl . 'uploads/emp/no_profile.png';
}
if ($getEmpDetails['status'] == '1') {
    $statusClr = '#049504';
    $flshMsg = 'Active';
    $backClr = 'background-color:rgba(179, 227, 179, 0.4)';
} else {
    $statusClr = '#970000';
    $flshMsg = 'Deactive';
    $backClr = 'background-color:rgba(176, 137, 137,0.4)';
}

//print_r($getEmpDetails['show_ps']);

?>
<!----------------------------Edit Employee strt----------------------------->
<div class="row mb-4">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="clearfix"></div>
                    <div class="text-center bg-pattern">
                        <div id="proPic"><img src="<?php echo $getImg; ?>" alt="Profile Image" class="avatar-xl img-thumbnail rounded-circle mb-3" style="border:1px solid #bbcfdb;">
                        </div>
                        <div id="getProfileImageChange" class="imageUploadActn"><i class="icon fa fa-camera"></i></div>
                        <h4 class="text-primary mb-2"><?php echo $getEmpDetails['name']; ?></h4>
                        <h5 class="text-muted font-size-13 mb-3">ID. <?php echo $getEmpDetails['user_code']; ?></h5>
                        <h6 class="text-muted font-size-13 mb-3" style="margin-top:-10px;"><span style="color:<?php echo $statusClr . ';' . $backClr; ?>;padding: 0px 10px 2px 10px;"><?php echo $flshMsg; ?></span></h6>
                        <div class="text-center">
                            <a href="mailto:<?php echo $getEmpDetails['email'] ?>" class="btn btn-success me-2 waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-email-outline me-1"></i>Send Mail</a>
                            <a href="tel:<?php echo $getEmpDetails['mobile'] ?>" class="btn btn-primary waves-effect waves-light btn-sm" target="_blank"><i class="mdi mdi-phone-outline me-1"></i>Phone Call</a>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="input-group" id="uploadMemberIMg" style="padding: 0px 0px 20px 0px;border-bottom: 1px solid #d7d7d7; display:none;">
                    <input type="file" class="form-control" name="file" id="file">
                    <input type="button" class="input-group-text memberImgUploadActn" id="Update" value="Update">
                </div>
                <!----------------------------------------->
                <div class="table-responsive" style=" <?php if ($this->lgCat == '1') {
                                                            echo 'margin-bottom: 18px';
                                                        } else {
                                                            echo 'margin-bottom: 67px';
                                                        } ?> ">
                    <h5 class="font-size-16 mb-3" style="color:#008288;"><i class="bx bx-detail"></i> Personal Information</h5>
                    <div>
                        <p class="mb-1 text-muted font-size-13"><i class="bx bx-calendar "></i> Date of joining :</p>
                        <h5 class="font-size-14"><?php echo date('d-M-Y', strtotime($getEmpDetails['created_at'])); ?></h5>
                    </div>
                    <?php if ($this->lgCat == '1') { ?>
                        <div>
                            <p class="mb-1 text-muted font-size-13"><i class="bx  bx bx-user-pin "></i> Created By :</p>
                            <h5 class="font-size-14"><?php echo $getCreatedBy['name']; ?></h5>
                        </div><?php } ?>
                    <div class="mt-3">
                        <p class="mb-1 text-muted font-size-13"><i class="bx bx-calendar "></i> Last Modified On :</p>
                        <h5 class="font-size-14"><?php echo $getEmpDetails['update_at'] ?></h5>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <?php //print_r($getEmpDetails);
        ?>
        <form id="emp_profile_data" method="post">
            <div class="card">
                <div class="card-header header-green"><i class="mdi mdi-account-circle-outline"></i> Basic Detail</div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="designsn" id="designsn">
                                    <option value="">---- Select One ----</option>
                                    <?php
                                    if ($designation) {
                                        foreach ($designation as $desig) {
                                    ?>
                                            <option value="<?php echo $desig['id']; ?>" <?php if ($getEmpDetails['designation'] == $desig['id']) {
                                                                                            echo 'selected="selected"';
                                                                                        } ?>><?php echo $desig['des_title']; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                                <label for="designsn">Designation As.</label>
                            </div>
                        </div>



                        <div class="col-lg-6">
                            <div class="form-floating mb-3"><input type="text" name="emp_name" id="emp_name" value="<?php if ($getEmpDetails['name']) {
                                                                                                                        echo $getEmpDetails['name'];
                                                                                                                    } else {
                                                                                                                        set_value('emp_name');
                                                                                                                    } ?>" class="form-control">
                                <label for="empN">Employee Name.</label>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="date" value="<?php echo $getEmpDetails['dob']; ?>" name="date_of_birth" class="form-control flatpickr-input active" id="date_of_birth">
                                <label for="Name">Date Of Birth</label>
                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo urlencode(base64_encode($getEmpDetails['id'])); ?>">
                                <input type="hidden" class="form-control" id="memImg" name="memImg" value="<?php echo urlencode(base64_encode($getEmpDetails['photo'])); ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3"><input type="text" value="<?php if ($getEmpDetails['mobile']) {
                                                                                            echo $getEmpDetails['mobile'];
                                                                                        } else {
                                                                                            set_value('mob_nu');
                                                                                        } ?>" class="form-control" id="mob_nu" name="mob_nu" oninput="this.value = this.value.replace(/[^0-9]/g,'').replace(/(\  *?)\  */g, '$1');" maxlength="10">
                                <label for="mob_nu">Mobile Number.</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="text" value="<?php if ($getEmpDetails['email']) {
                                                                echo $getEmpDetails['email'];
                                                            } else {
                                                                set_value('emailId');
                                                            } ?>" class="form-control" id="emailId" name="emailId" <?php if ($getEmpDetails['email']) { ?> disabled="disabled" <?php } ?>>
                                <label for="emailId">Email Id</label>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="text" value="<?php if ($getEmpDetails['adhar_no']) {
                                                                echo $getEmpDetails['adhar_no'];
                                                            } else {
                                                                set_value('aadhaar_no');
                                                            } ?>" class="form-control" name="aadhaar_no" id="aadhaar_no" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')" maxlength="12">
                                <label for="aadhaar_no">Aadhar No.</label>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="text" value="<?php if ($getEmpDetails['pan_no']) {
                                                                echo $getEmpDetails['pan_no'];
                                                            } else {
                                                                set_value('pan_no');
                                                            } ?>" class="form-control" name="pan_no" id="pan_no" maxlength="12">
                                <label for="pan_no">PAN No.</label>
                            </div>
                        </div>



                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="address" id="address" placeholder="Enter Address"><?php if ($getEmpDetails['address']) {
                                                                                                                            echo $getEmpDetails['address'];
                                                                                                                        } else {
                                                                                                                            set_value('address');
                                                                                                                        } ?></textarea>
                                <label for="address">Address.</label>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <select class="form-select empSelectR" name="state" id="state">
                                    <option value="">Select</option>
                                    <?php if ($getState) {
                                        foreach ($getState as $list) {
                                    ?><option value="<?php echo $list->id; ?>" <?php if ($list->id == $getEmpDetails['state']) {
                                                                            echo 'selected="selected"';
                                                                        } ?>><?php echo $list->state_cities; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                                <label for="state">State</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="district" id="district">
                                    <option value="">Select</option>
                                    <?php if ($getCity) {
                                        foreach ($getCity as $c_list) {
                                    ?><option value="<?php echo $c_list->id; ?>" <?php if ($c_list->id == $getEmpDetails['district']) {
                                                                                        echo 'selected="selected"';
                                                                                    } ?>><?php echo $c_list->state_cities; ?></option>
                                    <?php }
                                    } ?>
                                </select>

                                <label for="district">District</label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="text" value="<?php if ($getEmpDetails['zipcode']) {
                                                                echo $getEmpDetails['zipcode'];
                                                            } else {
                                                                set_value('zipcode');
                                                            } ?>" class="form-control" id="zipcode" name="zipcode">
                                <label for="zipcode">Zipcode.</label>
                            </div>
                        </div>



                    </div>
                </div>

                <div class="card-header header-green"><i class="bx bx-cog"></i> Password Details</div>
                <div class="card-body p-4">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-floating mb-3">

                                <input type="password" value="<?php echo $getEmpDetails['show_ps']; ?>" class="form-control" id="password" name="password">

                                <label for="rank">Password</label>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" value="<?php echo $getEmpDetails['show_ps']; ?>" class="form-control" id="cnfPassword" name="cnfPassword">
                                <label for="rank">Confirm Password</label>
                            </div>
                        </div>
                    </div>
                </div>






                <div class="card-footer">
                    <a href="<?php echo base_url(); ?>mlm_software/admin/employee/manage" class="btn btn-outline-dark waves-effect waves-light"><i class="bx bx-arrow-back"></i> Back</a>
                    <button type="submit" class="btn btn-outline-primary waves-effect waves-light " style="float:right;"><i class="bx bx-save"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!----------------------------edit Employee end------------------------------>

<script src="<?php echo base_url() ?>media/js/mlm_software/admin/employee/employee.js"></script>