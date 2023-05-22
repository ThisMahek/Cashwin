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
                        <h4>Update Matka</h4>
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
                        <?php echo form_open_multipart('admin/matka/update/' . $team['id']); ?>
                        <input type="hidden" name="id" value="<?php echo $team['id']; ?>">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control"
                                    value="<?php echo $team['name']; ?>">
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
                                <input type="date" name="udate" class="form-control"
                                    value="<?php echo date('Y-m-d'); ?>" placeholder="Bid Update Date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Value</label>

                            <div class="col-sm-3">
                                <input type="number" oninput="sum1()" id="snum" name="snum" max="999"
                                    class="form-control" value="<?php echo $team['starting_num']; ?>"
                                    placeholder="Starting Number" <?php echo $team['is_delhi_game'] == 1 ? "disabled" : "" ?>>
                            </div>
                            <div class="col-sm-2">
                                <input type="number" name="num" id="number" max="99" class="form-control"
                                    value="<?php echo $team['number']; ?>" placeholder="Number">
                            </div>
                            <div class="col-sm-3">
                                <input type="number" oninput="sum1()" id="enum" name="enum" max="999"
                                    class="form-control" value="<?php echo $team['end_num']; ?>"
                                    placeholder="End Number" <?php echo $team['is_delhi_game'] == 1 ? "disabled" : "" ?>>

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