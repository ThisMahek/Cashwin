<?php
include('includes/header.php');
include('includes/sidebar.php');
?>
<div class="br-mainpanel">
    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5"> </h4>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="tx-gray-800 mg-b-5">Bidding Report</h4>
            </div>
            <div class="card-body">
                <div class="pd-y-20 bd">
                    <form method="" action="" id="biddingform">
                        <div class="col-md-12">
                            <div class="row">
                                <?php $curr_date = date('Y-m-d') ?>
                                <div class="col-md-3">
                                    <label>Game Name</label>
                                    <br>
                                    <select id="matka" name="matka" class="form-control">
                                        <option value="">All</option>
                                        <?php foreach ($matka as $m): ?>
                                            <option value="<?php echo $m->id ?>" <?php echo ($select_matka == $m->id) ? "selected" : "" ?>><?php echo $m->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Game Type</label>
                                    <br>
                                    <select id="game" name="game" class="form-control">
                                        <option value="">All</option>
                                        <?php foreach ($games as $g): ?>
                                            <option value="<?php echo $g->game_id ?>" <?php echo ($select_game == $g->game_id) ? "selected" : "" ?>><?php echo $g->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Game Session</label>
                                    <br>
                                    <select id="session" name="session" class="form-control">
                                        <option value="">All</option>
                                        <option value="open" <?php echo ($select_session == "open") ? "selected" : "" ?>>Open
                                        </option>
                                        <option value="close" <?php echo ($select_session == "close") ? "selected" : "" ?>>
                                            Close</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Date</label>
                                    <br>
                                    <input type="date" id="select_date" required name="select_date" <?php echo ($select_date != "") ? 'value=' . $select_date : 'value=' . $curr_date ?>
                                        class="form-control" max="<?= $curr_date; ?>">
                                </div>
                                <!--<div class="col-md-3">-->
                                <!--    <label>End Date</label>-->
                                <!--    <br>-->
                                <!--    <input type="date" required name="end_date" <?php echo ($select_edate != "") ? 'value=' . $select_edate : 'value=' . $curr_date ?> class="form-control">-->
                                <!--</div>-->

                                <div class="col-md-12 text-center">
                                    <input type="button" class="btn btn-danger mt-2" name="calcel" value="Cancel"
                                        onClick="window.location.reload();">
                                    <input type="button" onclick="yourJsFunction();" class="btn btn-secondary mt-2"
                                        id="sbmt_btn" name="prof_loss" value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <br>
                <div class="pd-y-20 bd">
                    <div class="table-wrapper">
                        <div id="datatable1_wrapper" class="dataTables_wrapper no-footer"
                            style="overflow-x: scroll!important;">
                            <table id="datatable"
                                class="table-responsive table-bordered table display responsive nowrap dataTable no-footer dtr-inline"
                                role="grid" aria-describedby="datatable1_info" style="width:100% !important;">
                                <thead>
                                    <th>Sr.</th>
                                    <th>Date</th>
                                    <th>Bidding Digit</th>
                                    <th>Biding Points</th>
                                    <th>Winning Points</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var date = $('#select_date').val();
        $('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "searching": true,
            'serverMethod': 'post',
            "ajax": {
                "url": "<?php echo base_url('admin/allbiddingreportdata/'); ?>",
                "type": "POST",
                "data": { "date": date },
            },

            "columns": [
                { data: "#" },
                { data: "date" },
                { data: "bidding_digit" },
                { data: "bidding_points" },
                { data: "winning_points" },


            ],
            "aLengthMenu": [
                [50, 100,],
                [50, 100,]
            ],
            "iDisplayLength": 50
        });
    });


    //get filtered data


    function yourJsFunction() {
        var date = $('#select_date').val();
        var matka = $('#matka').val();
        var game = $('#game').val();
        var session = $('#session').val();
        $('#datatable').html('');
        // alert(date);alert(matka);alert(game);alert(session);
        $('#datatable').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "searching": true,
            'serverMethod': 'post',
            "ajax": {
                "url": "<?php echo base_url('admin/allbiddingreportdata/'); ?>",
                "type": "POST",
                "data": { "sbmt_btn": 1, "date": date, "matka": matka, "game": game, "session": session },
            },

            "columns": [
                { data: "#" },
                { data: "date" },
                { data: "bidding_digit" },
                { data: "bidding_points" },
                { data: "winning_points" },


            ],
            "aLengthMenu": [
                [50, 100,],
                [50, 100,]
            ],
            "iDisplayLength": 50
        });
    }


</script>
<?php include('includes/footer.php'); ?>