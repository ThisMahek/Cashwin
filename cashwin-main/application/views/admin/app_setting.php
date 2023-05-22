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
                        <h5 class="font-strong mb-4">App settings</h5>
                    </div>

                </div>
                <?php echo form_open_multipart(''); ?>
                <div class="row">


                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group mb-4">-->
                    <!--        <label>Tag Line</label>-->
                    <!--        <input type="text" name="tag_line" class="form-control" value="<?= $setting->tag_line ?>" required="required">-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Message(Conatct Us Whatsapp)</label>
                            <input type="text" name="message" class="form-control" value="<?= $setting->message ?>"
                                required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Withdraw Text</label>
                            <input type="text" name="withdraw_text" class="form-control"
                                value="<?= $setting->withdraw_text ?>" required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Home Running Text</label>
                            <input type="text" name="home_text" class="form-control" value="<?= $setting->home_text ?>"
                                required="required">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Min Amount</label>
                            <input type="text" name="min_amount" class="form-control"
                                value="<?= $setting->min_amount ?>" required="required">
                        </div>
                    </div>
                    <!--                 <div class="col-md-6">-->
                    <!--                    <div class="form-group mb-4">-->
                    <!--                        <div class="row mt-5">-->
                    <!--                       <div class="col-md-1 p-0 m-0">-->
                    <!--<input type="checkbox" name="msg_status" class="form-control" value="<?= ($setting->msg_status == 1) ? 1 : 0 ?>"  <?= ($setting->is_show_message == 1) ? 'checked' : '' ?> >-->

                    <!--                        </div>-->
                    <!--                         <div class="col-md-11 p-0 m-0">-->
                    <!--                         <label>Msg Status</label>-->
                    <!--                         </div>-->
                    <!--                         </div>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>App Link</label>
                            <input type="text" name="app_link" class="form-control" value="<?= $setting->app_link ?>"
                                required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Share Link</label>
                            <input type="text" name="share_link" class="form-control"
                                value="<?= $setting->share_link ?>" required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Add Fund Text</label>
                            <input type="text" name="add_fund_text" class="form-control"
                                value="<?= $setting->add_fund_text ?>" required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Chart Url</label>
                            <input type="text" name="chart_url" class="form-control" value="<?= $setting->chart_url ?>"
                                required="required">
                        </div>
                    </div>
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group mb-4">-->
                    <!--        <label>No Chart Msg</label>-->
                    <!--        <input type="text" name="no_chart_msg" class="form-control" value="<?= $setting->no_chart_msg ?>" required="required">-->
                    <!--    </div>-->
                    <!--</div>-->

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Privacy Policy</label>
                            <input type="text" name="privacy_pol" class="form-control"
                                value="<?= $setting->privacy_policy ?>" required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>UPI ID</label>
                            <input type="text" name="upi" class="form-control" value="<?= $setting->upi ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>UPI Name </label>
                            <input type="text" name="upi_name" class="form-control" value="<?= $setting->upi_name ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>UPI Desc</label>
                            <input type="text" name="upi_desc" class="form-control" value="<?= $setting->upi_desc ?>">
                        </div>
                    </div>
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group mb-4">-->
                    <!--        <div class="row">-->
                    <!--            <div class="col-md-4">-->
                    <!--              <label>UPI Status</label>-->
                    <!--              </div>-->
                    <!--              <div class="col-md-4 m-0 p-0">-->
                    <!--   <input type="radio" name="upi_status" class="form-control" value="1" <?= ($setting->upi_status == 1) ? 'checked' : '' ?> >-->
                    <!--    </div>-->
                    <!--   <div class="col-md-4">-->
                    <!--         <input type="radio" name="upi_status" class="form-control" value="0" <?= ($setting->upi_status == 0) ? 'checked' : '' ?> >-->
                    <!--          </div>-->
                    <!--        </div>-->

                    <!--          </div>-->
                    <!--    </div>-->


                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Release Add Point</label>
                            <input type="text" name="r_addpoint" class="form-control"
                                value="<?= $setting->r_addpoint ?>" required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Release Withdraw</label>
                            <input type="text" name="r_withdraw" class="form-control"
                                value="<?= $setting->r_withdraw ?>" required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Release Starline </label>
                            <input type="text" name="r_starline" class="form-control"
                                value="<?= $setting->r_starline ?>" required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Release Game</label>
                            <input type="text" name="r_game" class="form-control" value="<?= $setting->r_game ?>"
                                required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Release Profile</label>
                            <input type="text" name="r_profile" class="form-control" value="<?= $setting->r_profile ?>"
                                required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Release Version</label>
                            <input type="text" name="r_version" class="form-control" value="<?= $setting->r_version ?>"
                                required="required">
                        </div>
                    </div>
                    <!-- <div class="col-md-6">-->
                    <!--    <div class="form-group mb-4">-->
                    <!--        <label>Transfer Fee</label>-->
                    <!--        <input type="text" name="transfer_fee" class="form-control" value="<?= $setting->transfer_fee ?>" required="required">-->
                    <!--    </div>-->
                    <!--</div>-->




                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group mb-4">-->
                    <!--        <label>Add Point Text</label>-->
                    <!--        <input type="text" name="add_fund_text" class="form-control" value="<?= $setting->add_fund_text ?>" required="required">-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group mb-4">-->
                    <!--        <label>Withdraw No.</label>-->
                    <!--        <input type="text" name="withdrawnumber" class="form-control" value="<?= $setting->withdraw_no ?>" required="required">-->
                    <!--    </div>-->
                    <!--</div>-->

                    <!--<hr/>-->
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group mb-4">-->
                    <!--        <label>Mobile No.</label>-->
                    <!--        <input type="text" name="mobile_no" class="form-control" value="<?= $site_setting->mobile ?>" required="required">-->
                    <!--    </div>-->
                    <!--</div><div class="col-md-6">-->
                    <!--    <div class="form-group mb-4">-->
                    <!--        <label>Whatsapp No.</label>-->
                    <!--        <input type="text" name="whatsapp_no" class="form-control" value="<?= $site_setting->whatsapp ?>" required="required">-->
                    <!--    </div>-->
                    <!--</div>-->
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

<?php include('includes/footer.php') ?>