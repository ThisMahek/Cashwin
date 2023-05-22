<?php
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">

    <div class="row">
        <div class="col-sm-12">
            <!-- Basic Form Inputs card start -->
            <div class="ibox" style="margin-top:50px;">
                <div class="ibox-body">
                    <div class="" style="margin-bottom:12px;">
                        <h5>Set Winner</h5>
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
                        <?php echo form_open_multipart('admin/update_matka_point/' . $team['id']); ?>
                        <input type="hidden" name="id" value="<?php echo $team['id']; ?>">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <?php echo $team['name']; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Set Date</label>
                            <div class="col-sm-10">
                                <input type="date" name="udate" class="form-control"
                                    value="<?php echo date('Y-m-d'); ?>" placeholder="Bid Update Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Value</label>
                            <div class="col-sm-3">
                                <?php echo $team['starting_num']; ?>
                            </div>
                            <div class="col-sm-2">
                                <?php echo $team['number']; ?>
                            </div>
                            <div class="col-sm-3">
                                <?php echo $team['end_num']; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label></label>
                            <div class="col-sm-10">
                                <button type="submit" name="submit" class="btn btn-primary">Set Winner</button>
                            </div>
                        </div>
                        <textarea id="description" style="visibility: hidden;"></textarea>
                        <input type="hidden" name="name" value="<?php echo $team['name']; ?>">
                        <input type="hidden" name="fstime" value="<?php echo $team['bid_start_time']; ?>">
                        <input type="hidden" name="fetime" value="<?php echo $team['bid_end_time']; ?>">

                        <input type="hidden" name="snum" value="<?php echo $team['starting_num']; ?>">
                        <input type="hidden" name="num" value="<?php echo $team['number']; ?>">
                        <input type="hidden" name="enum" value="<?php echo $team['end_num']; ?>">

                        <input type="hidden" name="sstime" value="<?php echo $team['sat_start_time']; ?>">
                        <input type="hidden" name="setime" value="<?php echo $team['sat_end_time']; ?>">

                        <input type="hidden" name="stime" value="<?php echo $team['start_time']; ?>">
                        <input type="hidden" name="etime" value="<?php echo $team['end_time']; ?>">
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
    </div>
    <!-- END PAGE CONTENT-->

    <?php include('includes/footer.php') ?>