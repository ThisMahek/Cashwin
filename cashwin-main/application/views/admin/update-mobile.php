<?php
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">

    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <div class="row">
                    <div class="col-md-8">

                    </div>
                    <div class="col-md-4">
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    </div>
                </div>
                <!--<center><div style="color:green; "> <h5></h5></div></center>-->
                <div class="row" style="padding-bottom: 7px;">

                    <div class="col-md-6">
                        <h5 class="font-strong mb-4">Update Mobile</h5>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <?php echo form_open_multipart('admin/update_mobile_data'); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Mobile Number</label>
                            <input type="text" name="mobile" max-length="10" value="<?php echo $mob['mobile']; ?>"
                                class="form-control" placeholder="Mobile No.">
                        </div>

                    </div>
                    <div class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>

                </div>

            </div>

            </form>

        </div>
    </div>
</div>
<!-- END PAGE CONTENT-->

<?php include('includes/footer.php') ?>