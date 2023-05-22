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
                        <h4>Add Matka</h4>
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

                        <form action="<?= base_url() ?>admin/add_matka" method="post">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Start Time(Mon - Fri)</label>
                                <div class="col-sm-10">
                                    <input type="time" name="stime" class="form-control" placeholder=" Bid Start Time"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">End Time(Mon - Fri)</label>
                                <div class="col-sm-10">
                                    <input type="time" name="etime" class="form-control" placeholder="Bid End Time"
                                        required>
                                </div>
                            </div>
                            <!--<div class="form-group row">-->
                            <!--    <label class="col-sm-2 col-form-label">Set Date</label>-->
                            <!--    <div class="col-sm-10">-->
                            <!--        <input type="date" name="udate" class="form-control"  placeholder="Bid Update Date">-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="form-group row">-->
                            <!--    <label class="col-sm-2 col-form-label">Value</label>-->

                            <!--    <div class="col-sm-3">-->
                            <!--        <input type="number" oninput="sum1()" id="snum" name="snum" max="999" class="form-control" value="<?php echo $team['starting_num']; ?>" placeholder="Starting Number">-->
                            <!--        </div>-->
                            <!--        <div class="col-sm-2">-->
                            <!--        <input type="number" name="num" id="number" max="99" class="form-control" value="<?php echo $team['number']; ?>" placeholder="Number">-->
                            <!--        </div>-->
                            <!--        <div class="col-sm-3">-->
                            <!--        <input type="number" oninput="sum1()" id="enum" name="enum" max="999" class="form-control" value="<?php echo $team['end_num']; ?>" placeholder="End Number">-->

                            <!--    </div>-->
                            <!--</div>-->

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Start Time(Sat)</label>
                                <div class="col-sm-10">
                                    <input type="time" name="sstime" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">End Time(Sat)</label>
                                <div class="col-sm-10">
                                    <input type="time" name="setime" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Start Time(Sun)</label>
                                <div class="col-sm-10">
                                    <input type="time" name="sustime" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">End Time(Sun)</label>
                                <div class="col-sm-10">
                                    <input type="time" name="suetime" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Matka order</label>
                                <div class="col-sm-10">
                                    <input type="text" name="matka_order" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label></label>
                                <div class="col-sm-10">
                                    <button type="submit" name="add_matka2" class="btn btn-primary">Add</button>
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

</div>
<!-- END PAGE CONTENT-->

<?php include('includes/footer.php') ?>