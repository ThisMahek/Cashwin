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
        <h4>Live Update</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="index-2.html">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>administrator/matka/list">Matka</a>
            </li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>administrator/matka/add">Add Matka</a>
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
                    <h5>Update Matka</h5>
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
                    <?php echo form_open_multipart('administrator/matka/update/' . $team['id']); ?>
                    <input type="hidden" name="id" value="<?php echo $team['id']; ?>">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="<?php echo $team['name']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Start Time(Mon - Fri)</label>
                        <div class="col-sm-10">
                            <input type="time" name="fstime" class="form-control"
                                value="<?php echo $team['bid_start_time']; ?>" placeholder=" Bid Start Time">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">End Time(Mon - Fri)</label>
                        <div class="col-sm-10">
                            <input type="time" name="fetime" class="form-control"
                                value="<?php echo $team['bid_end_time']; ?>" placeholder="Bid End Time">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Set Date</label>
                        <div class="col-sm-10">
                            <input type="date" name="udate" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                                placeholder="Bid Update Date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Value</label>

                        <div class="col-sm-3">
                            <input type="number" oninput="sum1()" id="snum" name="snum" max="999" class="form-control"
                                value="<?php echo $team['starting_num']; ?>" placeholder="Starting Number">
                        </div>
                        <div class="col-sm-2">
                            <input type="number" name="num" id="number" max="99" class="form-control"
                                value="<?php echo $team['number']; ?>" placeholder="Number">
                        </div>
                        <div class="col-sm-3">
                            <input type="number" oninput="sum1()" id="enum" name="enum" max="999" class="form-control"
                                value="<?php echo $team['end_num']; ?>" placeholder="End Number">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Start Time(Sat)</label>
                        <div class="col-sm-10">
                            <input type="text" name="sstime" class="form-control"
                                value="<?php echo $team['sat_start_time']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">End Time(Sat)</label>
                        <div class="col-sm-10">
                            <input type="text" name="setime" class="form-control"
                                value="<?php echo $team['sat_end_time']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Start Time(Sun)</label>
                        <div class="col-sm-10">
                            <input type="text" name="stime" class="form-control"
                                value="<?php echo $team['start_time']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">End Time(Sun)</label>
                        <div class="col-sm-10">
                            <input type="text" name="etime" class="form-control"
                                value="<?php echo $team['end_time']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label></label>
                        <div class="col-sm-10">
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    <textarea id="description" style="visibility: hidden;"></textarea>

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
            if (sum1 != 10 || sum1 != 20) {
                if (n1 == 0) {
                    n1 = "";
                }
            }
            if (sum1 != 10 || sum1 != 20) {
                if (n == 0) {
                    n = "";
                }
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
    <script src="<?php echo base_url(); ?>admintemplate/bower_components/ckeditor/ckeditor.js"></script>
    <!-- echart js -->

    <script src="<?php echo base_url(); ?>admintemplate/assets/pages/user-profile.js"></script>