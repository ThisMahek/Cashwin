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
        <h4>Matka</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="<?php echo site_url(); ?>administrator">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a>Chart</a>
            </li>
            <li class="breadcrumb-item"><a>Update Chart</a>
            </li>
        </ul>
    </div>
</div>
<!-- Page header end -->
<!-- Page body start -->
<div class="page-body">
    <div style="color:green; ">
        <h5>
            <?php echo $this->session->flashdata('fail'); ?>
        </h5>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <!-- Basic Form Inputs card start -->
            <div class="card">
                <div class="card-header">
                    <h5>Add Matka</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="col-sm-8">
                        <div class="validation_errors_alert">

                        </div>
                    </div>
                    <!-- <div class="col-sm-8"> -->
                    <?php echo form_open_multipart('administrator/chart_update'); ?>
                    <?php foreach ($transactions as $transaction): ?>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Matka Name</label>
                            <div class="col-sm-10">

                                <input type="text" name="name" value="<?php echo $transaction['name'] ?>"
                                    class="form-control" placeholder="Chart Name">

                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="date" value="<?php echo $transaction['date'] ?>"
                                    class="form-control" placeholder="Enter Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Value</label>

                            <div class="col-sm-3">
                                <input type="number" oninput="sum1()" id="snum"
                                    value="<?php echo $transaction['starting_num'] ?>" name="snum" max="999"
                                    class="form-control" placeholder="Starting Number">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" name="num" id="number" max="99"
                                    value="<?php echo $transaction['result_num'] ?>" class="form-control"
                                    placeholder="Number">
                            </div>
                            <div class="col-sm-3">
                                <input type="number" oninput="sum1()" value="<?php echo $transaction['end_num'] ?>"
                                    id="enum" name="enum" max="999" class="form-control" placeholder="End Number">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        <textarea id="description" style="visibility: hidden;"></textarea>
                    <?php endforeach ?>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Basic Form Inputs card end -->
    <script>
        function sum1() {
            var sum = 0;
            var sum1 = 0;
            var n = "";
            var n1 = ""
            var a = parseInt(document.getElementById("snum").value);
            var en = parseInt(document.getElementById("enum").value);
            var b = document.getElementById("number");
            while (a) {
                sum += a % 10;
                a = Math.floor(a / 10);
            }
            var res = sum % 10;
            var n = res.toString();
            while (en) {
                sum1 += en % 10;
                en = Math.floor(en / 10);
            }
            var res1 = sum1 % 10;
            var n1 = res1.toString();
            if (n1 == 0) {
                n1 = "";
            }
            if (n == 0) {
                n = "";
            }
            b.value = n + n1;

            //console.log(res);
        }

    </script>

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
    <!-- <script src="<?php echo base_url(); ?>admintemplate/bower_components/ckeditor/ckeditor.js"></script> -->
    <!-- echart js -->

    <script src="<?php echo base_url(); ?>admintemplate/assets/pages/user-profile.js"></script>