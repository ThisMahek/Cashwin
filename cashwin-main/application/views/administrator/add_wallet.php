<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
<!-- Date-range picker css  -->
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.css" />
<!-- Date-Dropper css -->
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.css" />
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css" />
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
</style>

<div class="page-header">
    <div class="page-header-title">
        <h4>Add Points</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="index-2.html">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>

            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>administrator/add_wallet">Add Points</a>
            </li>
        </ul>
    </div>
</div>
<!-- Page header end -->
<!-- Page body start -->
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <!-- Basic Form Inputs card start -->
            <div class="card">
                <div class="card-header">
                    <h5>Add Points</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="col-sm-8">
                        <div class="validation_errors_alert"
                            style="font-size: 20px; color: green; text-align: center; margin-top: -15px; margin-bottom: 5px;">
                            <?= $this->session->flashdata("point_st"); ?>
                        </div>
                    </div>
                    <!-- <div class="col-sm-8"> -->
                    <?php echo form_open_multipart('administrator/add_wallet2'); ?>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Enter Mobile Number</label>
                        <div class="col-sm-10">
                            <input type="text" name="no" class="form-control" value="" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Points to be Added</label>
                        <div class="col-sm-10">
                            <input type="text" name="wa" class="form-control" value="" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label></label>
                        <div class="col-sm-10">
                            <button type="submit" name="submitw" class="btn btn-primary">ADD</button>
                        </div>
                    </div>
                    <textarea id="description" style="visibility: hidden;"></textarea>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Basic Form Inputs card end -->

    <script type="text/javascript"
        src="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript"
        src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/swithces.js"></script>
    <script type="text/javascript"
        src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/moment-with-locales.min.js"></script>
    <script type="text/javascript"
        src="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript"
        src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>
    <!-- Date-range picker js -->
    <script type="text/javascript"
        src="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript"
        src="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.js"></script>


    <!-- ck editor -->
    <script src="<?php echo base_url(); ?>admintemplate/bower_components/ckeditor/ckeditor.js"></script>
    <!-- echart js -->

    <script src="<?php echo base_url(); ?>admintemplate/assets/pages/user-profile.js"></script>