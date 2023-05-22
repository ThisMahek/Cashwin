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
                        <h5 class="font-strong mb-4">Contact settings</h5>
                    </div>

                </div>
                <?php echo form_open_multipart(''); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Mobile Number(Contact Us Whatsapp )</label>
                            <input type="text" name="mobile_number" class="form-control"
                                value="<?= $setting->mobile_number ?>" required="required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Email (Contact Us)</label>
                            <input type="text" name="email_2" class="form-control" value="<?= $setting->email_2 ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Contact Us Mobile(Call Us)</label>
                            <input type="text" name="home_contact" class="form-control"
                                value="<?= $setting->home_contact ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>WhatsApp Number(For Unblock Functionality)</label>
                            <input type="text" name="whatsapp_no" class="form-control"
                                value="<?= $setting->whatsapp_no ?>" required="required">
                        </div>
                    </div>
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group mb-4">-->
                    <!--        <label>Mobile Number 2 (Optional)</label>-->
                    <!--        <input type="text" name="mobile_number_optional" class="form-control" value="<?= $setting->mobile_number_optional ?>" >-->
                    <!--    </div>-->
                    <!--</div>-->

                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group mb-4">-->
                    <!--        <label>Landline 1 (Optional) </label>-->
                    <!--        <input type="text" name="landline_1" class="form-control" value="<?= $setting->landline_1 ?>" >-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group mb-4">-->
                    <!--        <label>Landline 2 (Optional) </label>-->
                    <!--        <input type="text" name="landline_2" class="form-control" value="<?= $setting->landline_2 ?>" >-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="col-md-6">-->
                    <!--    <div class="form-group mb-4">-->
                    <!--        <label>Email 1</label>-->
                    <!--        <input type="text" name="email_1" class="form-control" value="<?= $setting->email_1 ?>" >-->
                    <!--    </div>-->
                    <!--</div>-->

                    <hr />
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Facebook (Optional)</label>
                            <input type="text" name="facebook" class="form-control" value="<?= $setting->facebook ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Twitter (Optional)</label>
                            <input type="text" name="twitter" class="form-control" value="<?= $setting->twitter ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Youtube (Optional)</label>
                            <input type="text" name="youtube" class="form-control" value="<?= $setting->youtube ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Google Plus (Optional)</label>
                            <input type="text" name="google_plus" class="form-control"
                                value="<?= $setting->google_plus ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Instagram (Optional)</label>
                            <input type="text" name="instagram" class="form-control" value="<?= $setting->instagram ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Latitude</label>
                            <input type="text" name="latitude" class="form-control" value="<?= $setting->latitude ?>"
                                required="required">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Longitude</label>
                            <input type="text" name="longitude" class="form-control" value="<?= $setting->longitude ?>"
                                required="required">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="<?= $setting->address ?>"
                                required="required">
                        </div>
                    </div>
                </div>

            </div>
            <div class="ibox-footer">
                <button type="submit" name="submitw" value="1" class="btn btn-primary">Update</button>
                <!-- <button class="btn btn-outline-secondary" type="reset">Cancel</button> -->
            </div>
            </form>

        </div>





    </div>




</div>
<!-- END PAGE CONTENT-->

<?php include('includes/footer.php') ?>