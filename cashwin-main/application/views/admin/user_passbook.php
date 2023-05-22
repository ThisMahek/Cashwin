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
                        <h5 class="font-strong mb-4">SELECT USER</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="validation_errors_alert" style="font-size: 20px; color: green; text-align: center;">
                            <?= $this->session->flashdata("point_st"); ?>
                        </div>
                    </div>
                </div>
                <?php echo form_open_multipart('admin/passbook'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Select User</label>
                            <select class="form-control" name="user">
                                <option value="">Select User</option>
                                <?php foreach ($users as $u) { ?>
                                    <option value="<?php echo $u->id ?>"><?php echo $u->name ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                </div>

            </div>
            <div class="ibox-footer">
                <button type="submit" name="submitw" class="btn btn-primary">Select</button>
                <!-- <button class="btn btn-outline-secondary" type="reset">Cancel</button> -->
            </div>
            </form>

        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

<?php include('includes/footer.php') ?>