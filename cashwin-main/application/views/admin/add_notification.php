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
                        <h5 class="font-strong mb-4">ADD NOTIFICATION</h5>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <?php echo form_open_multipart('admin/notify2'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Enter New Notification</label>
                            <input type="text" name="noti" class="form-control" value="" required="required">
                        </div>

                    </div>

                </div>

            </div>
            <div class="ibox-footer">
                <button type="submit" name="submitw" class="btn btn-primary">ADD</button>
                <!-- <button class="btn btn-outline-secondary" type="reset">Cancel</button> -->
            </div>
            </form>

        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

<?php include('includes/footer.php') ?>