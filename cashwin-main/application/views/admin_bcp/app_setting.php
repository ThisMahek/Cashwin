<?php 
	include('includes/header.php');
	include('includes/sidebar.php');
?>

    <div class="content-wrapper">

        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="ibox-body">
                    <div class="row" style="padding-bottom: 7px;">
                        <div class="col-md-6">
                            <h5 class="font-strong mb-4">App setings</h5></div>
                        
                    </div>
                    <?php echo form_open_multipart(''); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>Message</label>
                                    <input type="text" name="message" class="form-control" value="<?= $setting->message ?>" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>Home Text</label>
                                    <input type="text" name="hometext" class="form-control" value="<?= $setting->home_text ?>" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>Privacy Policy</label>
                                    <input type="text" name="privacy_pol" class="form-control" value="<?= $setting->privacy_policy ?>" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>Withdraw Text</label>
                                    <input type="text" name="withdrawtext" class="form-control" value="<?= $setting->withdraw_text ?>" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>Add Point Text</label>
                                    <input type="text" name="add_fund_text" class="form-control" value="<?= $setting->add_fund_text ?>" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>Withdraw No.</label>
                                    <input type="text" name="withdrawnumber" class="form-control" value="<?= $setting->withdraw_no ?>" required="required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>UPI ID</label>
                                    <input type="text" name="upi" class="form-control" value="<?= $setting->upi ?>">
                                </div>
                            </div>
                            <hr/>
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>Mobile No.</label>
                                    <input type="text" name="mobile_no" class="form-control" value="<?= $site_setting->mobile ?>" required="required">
                                </div>
                            </div><div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>Whatsapp No.</label>
                                    <input type="text" name="whatsapp_no" class="form-control" value="<?= $site_setting->whatsapp ?>" required="required">
                                </div>
                            </div>
                        </div>

                </div>
                <div class="ibox-footer">
                    <button type="submit" name="submitw" class="btn btn-primary">Update</button>
                    <!-- <button class="btn btn-outline-secondary" type="reset">Cancel</button> -->
                </div>
                </form>

            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->

    <?php include('includes/footer.php')?>