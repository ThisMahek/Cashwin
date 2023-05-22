<?php
include('includes/header.php');
include('includes/sidebar.php');
?>
<style>
    .desktop-responsive {
        overflow-x: scroll;
        display: block;
    }

    .top_btn {
        margin-top: 11%;
        padding: 9px 44px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding: 0;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        position: absolute;
        top: 14px !important;
        width: 25px !important;
    }

    .select2-container--default .select2-selection--single {
        border-radius: 2px;
        border-color: rgba(0, 0, 0, .1);
        padding: 0.65rem 1.25rem;
    }

    .select2-container--default .select2-selection--single {
        height: 40px !important;
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 0px;
        border-color: rgba(0, 0, 0, .1) !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 19px !important;
    }
</style>
<div class="content-wrapper">
    <div class="page-content fade-in-up">
        <?php echo ($this->session->flashdata('success')) ?? "" ?>
        <?php echo ($this->session->flashdata('error')) ?? "" ?>
        <div id="show_message"></div>
        <form action="" id="declare_result_form" method="post">

            <div class="ibox">
                <div class="ibox-body">


                    <h5 class="mb-3">Select Game</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="mb-2">Result Date</label>
                            <input type="date" id="udate" class="form-control" name="udate"
                                value="<?php echo date('Y-m-d'); ?>" max="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="mb-2">Game Name</label>
                            <br>
                            <select id="id" name="id" class="form-control" required onchange="selectpana()">
                                <?php foreach ($matka as $m): ?>
                                    <option value="<?php echo $m->id ?>" <?php echo ($select_matka == $m->id) ? "selected" : "" ?>><?php echo $m->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-3" style="<?= $game_type == 'matka' ? 'display:inline' : "display:none" ?>">
                            <label class="mb-2">Session</label>
                            <select class="form-control" id="type-filter" name="bettype" title="Please select"
                                data-style="btn-solid" data-width="150px" required>
                                <option value="">Select Session</option>
                                <?php
                                if ($game_type == 'starline' || $game_type == 'dmatka') {
                                    ?>
                                    <option <?= ($bettype == "Open" || $game_type != 'matka') ? "selected" : "" ?>>Open</option>
                                <?php } else { ?>
                                    <option <?= ($bettype == "Open") ? "selected" : "" ?>>Open</option>
                                    <option <?= ($bettype == "Close") ? "selected" : "" ?>>Close</option>
                                <?php } ?>


                            </select>
                        </div>

                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary top_btn" id="select_pana_submit_button"
                                onclick="selectpana()">Go</button>
                        </div>
                    </div>

                </div>
            </div>
            <!--</form>-->
            <!--<form action="<?= base_url() ?>Admin/declare_result_ajax2" method="post" >-->
            <div class="ibox">
                <div class="ibox-body" style="display:none" id="declare_res">
                    <h5 class="mb-3">Declare Result</h5>
                    <div class="row">
                        <?php
                        if ($game_type == 'matka' || $game_type == 'starline') {
                            ?>
                            <div class="col-md-3">
                                <!--<label class="mb-2">Panna</label><br>-->
                                <label class="mb-0 mr-2 mb-2">
                                    <?= $bettype ?> Pana:
                                </label>

                                <select id="type-filter_pana" name="snum" onchange="sum1()"
                                    class="form-control selectpiker mb-2" style="width:100%" required>
                                    <!--<select class="js-example-basic-single"  name="snum" onchange="sum1()" id="type-filter_pana" title="Please select" data-style="btn-solid" data-width="250px">-->
                                    <option value="">Select Pana </option>
                                    <?php foreach ($pana_digit as $p): ?>
                                        <option value="<?php echo $p ?>"><?php echo $p; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        <?php } ?>
                        <div class="col-md-3">
                            <label class="mb-2">Digit</label>
                            <input type="text" class="form-control" name="num" id="number_num">
                        </div>
                        <div class="col-md-2 p-0 mt-2">
                            <button type="submit" class="btn btn-primary top_btn" value="Save" id="update_result"
                                name="update_result">Save</button>
                        </div>
                        <div class="col-md-2 p-0  mt-2" id="winner_list_button">
                        </div>
                        <div class="col-md-2 p-0  mt-2" id="set_winner_button">
                        </div>
                        <!--<div class="col-md-2 p-0  mt-2" style="display:none">-->
                        <!--    <button type="submit" class="btn btn-success top_btn" name="update_result">Save</button>-->
                        <!--</div>-->
                    </div>
                </div>

            </div>
        </form>

        <div class="ibox">
            <div class="ibox-body">
                <!--<form action="" method="post">-->
                <div class="row" style="padding-bottom: 7px;">
                    <div class="col-md-12 col-8">
                        <h5 class="font-strong mb-4">Game Result History</h5>
                    </div>
                    <div class="col-md-6 col-4">
                        <form method="get">
                            <label class="">Result Date</label>
                            <input type="date" id="date_val" class="form-control" name="date_val"
                                max="<?= date('Y-m-d') ?>" data-filter='date_filter' onchange="show_chart_data()" required
                                value="<?= $date_val ?>">
                            <!--<a class="pull-right btn btn-info btn-square" href='<?php echo base_url(); ?>admin/matka/add'> +Add</a>-->
                            <!--<input type="submit" class="btn btn-primary" value="Filter" style="margin-top:5px"/>-->
                            <!--        </form>-->
                    </div>
                </div>
            </div>
            <div class="flexbox mb-4">
                <div class="col-md-1 col-1">

                </div>


                <!--<div class="flexbox">-->
                <!--    <label class="mb-0 mr-2">Type:</label>-->
                <!--    <select class="selectpicker show-tick form-control" id="type-filter" title="Please select" data-style="btn-solid" data-width="150px">-->
                <!--        <option value="">All</option>-->
                <!--        <option>Shipped</option>-->
                <!--        <option>Completed</option>-->
                <!--        <option>Pending</option>-->
                <!--        <option>Canceled</option>-->
                <!--    </select>-->
                <!--</div>-->
                <!--<div class="input-group-icon input-group-icon-left mr-3">-->
                <!--    <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>-->
                <!--    <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">-->
                <!--</div>-->
            </div>
            <div class="">
                <table class="table" id="myTable_2">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Matka Name</th>
                            <th>Result Date</th>
                            <!--  <th>Open Declare Date</th>-->
                            <!--<th>Close Declare Date</th>-->
                            <!-- <th>Open Pana</th>-->
                            <!--<th>Close Pana</th>-->
                            <?php
                            if ($game_type == 'matka') {
                                ?>
                                <th>Open Declare Date</th>
                                <th>Close Declare Date</th>
                                <th>Open Pana</th>
                                <th>Close Pana</th>
                            <?php } ?>

                            <?php
                            if ($game_type == 'starline' || $game_type == 'dmatka') {
                                ?>
                                <th>Declare Date</th>
                                <th>Number</th>

                            <?php } ?>
                        </tr>
                    </thead>

                    <tbody id="show_table">
                    </tbody>



                </table>

            </div>
        </div>
    </div>
</div>

<!--winnerlist modal-->
<div class="modal fade" id="winnerlist_modal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content fn_slider_data">

        </div>

    </div>
</div>
<!-- END PAGE CONTENT-->
<script>
    $(document).ready(() => {
        // $(`#declare_result_form`).submit(function (e) { 
        //     e.preventDefault();

        // });
    })
    function sum1() {
        var a = parseInt(document.getElementById("type-filter_pana").value);
        var b = document.getElementById("number_num");
        console.log(a);
        var sum = 0;
        while (a) {
            sum += a % 10;
            a = Math.floor(a / 10);
        }
        var res = sum % 10;
        var n = res.toString();
        if (a == "") {
            b.value = n;
        } else {
            b.value = "";
        }
        //b.value= (a==""?n:"");
        //  alert(n);
        // alert(b.value);
        return true;
    }
    function set_winner_result(val) {
        // alert(val);
        var name = $('#id').val();
        var sum = $('#type-filter_pana').val();
        var num = $('#number_num').val();
        var id = val;
        // var udate = new Date().toJSON().slice(0, 10);
        var udate = document.getElementById("udate").value;

        $.ajax({
            url: "<?php echo base_url() ?>admin/update_matka_point/" + id,
            method: "POST",
            data: { name: name, id: id, sum: sum, num: num, udate: udate },
            success: function (data) {
                // window.location.reload();
                setTimeout(function () {
                    selectpana();
                    show_chart_data();
                }, 1000);
            }
        });
    }
    selectpana();
    function selectpana() {
        var a = document.getElementById("id").value;
        var b = document.getElementById("type-filter").value;
        var c = document.getElementById("udate").value;
        var set_winner_button = document.getElementById("set_winner_button");
        var winner_list_button = document.getElementById("winner_list_button");
        var game_type = '<?= $this->uri->segment(3) ?>';
        if (game_type == 'dmatka' || game_type == 'starline') {
            if (a != "" && c != "" && b != "") {
                document.getElementById('declare_res').style.display = 'block';
            }
        }
        if (game_type == 'matka' || game_type == 'starline') {
            if (a != "" && c != "" && b != "") {
                document.getElementById('declare_res').style.display = 'block';
            }
        }
        $.ajax({
            url: '<?= base_url("Admin/check_declare_result") ?>',
            method: "POST",
            data: { matkaid: a, date: c, bet_type: b },
            dataType: 'json',
            async: true,
            success: function (response) {
                $.ajax({
                    url: '<?= base_url("Admin/fetch_matka_data") ?>',
                    method: "POST",
                    data: { a: a, game_type: game_type, c: c },
                    dataType: 'json',
                    async: true,
                    success: function (data) {
                        var n = 24;
                        var date1 = new Date(data?.updated_at);
                        var date2 = new Date();
                        date2.setMinutes(date2.getMinutes() - 30);
                        var diffTime = Math.abs(date2 - date1);
                        var set_winner = (diffTime) / (1000 * 60 * 60 * date2.getHours());
                        $('#type-filter_pana option:selected').prop("selected", false);
                        if (game_type == 'matka' || game_type == 'starline') {
                            if (b == 'Open') {
                                var selected_start_num = data ? data.starting_num : '""';
                                if (selected_start_num != "") {
                                    $('#type-filter_pana option[value=' + selected_start_num + ']').prop('selected', true);
                                } else {
                                    $('#type-filter_pana option:selected').prop('selected', false);

                                }

                            }
                            if (b == 'Close') {
                                var selected_end_num = data ? data.end_num : '""';
                                if (selected_start_num != "") {
                                    $('#type-filter_pana option[value=' + selected_end_num + ']').prop('selected', true);
                                } else {
                                    $('#type-filter_pana option:selected').prop('selected', false);

                                }
                                // var test = $('#type-filter_pana option[value='+selected_end_num+']').val();
                                //   $('#type-filter_pana option[value='+selected_end_num+']').prop('selected',true); 

                            }
                        }
                        var open_declare_date = (data?.open_declare_date === null) ? 1 : 0;
                        var result_num = (data?.result_num != "") ? 1 : 0;
                        var close_declare_date = (data?.close_declare_date === null) ? 1 : 0;
                        var end_num = (data?.end_num != null) ? 1 : 0;
                        // console.log(data?.close_declare_date);
                        if (b == 'Close' && (close_declare_date == 1) && (end_num == 1)) {
                            //formtarget="_blank"
                            set_winner_button.innerHTML = '<a class="label label-inverse-info" onclick="set_winner_result(' + data.cid + ')" ><button type="submit" class="btn btn-success top_btn" formtarget="_blank" >Declare</button></a>';
                            winner_list_button.innerHTML = '<button type="button" class="btn btn-success top_btn" onclick="get_winner_list()" >Show Winner</button>';
                        }
                        else if (b == 'Open' && (open_declare_date == 1) && (result_num == 1)) {
                            set_winner_button.innerHTML = '<a class="label label-inverse-info" onclick="set_winner_result(' + data.cid + ')" > <button type="submit" class="btn btn-success top_btn"  formtarget="_blank">Declare</button></a>';
                            winner_list_button.innerHTML = '<button type="button" class="btn btn-success top_btn" onclick="get_winner_list()" >Show Winner</button>';
                        }
                        else {
                            set_winner_button.innerHTML = "";
                            winner_list_button.innerHTML = "";
                        }
                        if (game_type == 'dmatka') {
                            $('#number_num').val(data?.result_num);
                        }
                        sum1();
                    }
                });
            }
        });
    }

    function get_winner_list() {
        var matkaid = document.getElementById("id").value;
        var bet_type = document.getElementById("type-filter").value;
        var searchdate = document.getElementById("udate").value;
        $('.fn_slider_data').html('');
        $.ajax({
            method: "POST",
            url: "<?= base_url(); ?>admin/winner_list",
            data: { matkaid: matkaid, udate: searchdate, bet_type: bet_type },
            success: function (data) {
                if (data) {
                    $('.fn_slider_data').html();
                    $('.fn_slider_data').html(data);
                    $('#winnerlist_modal').modal('show');
                }
            }
        });
    }

    function updateResult(val) {
        //  $("#update_result").val(val);
    }
</script>

<script>
    show_chart_data();
    function show_chart_data() {
        let filter = '';
        //console.log('dfdfd',event)
        // if(event){
        //     let filter = $(event.target).attr(`[data-filter]`);
        //     if(filter == 'date_filter'){
        //         filter = '?date_filter='+$(event.target).val();
        //     }
        // }
        var date_val = $('#date_val').val();
        var type = '<?= $this->uri->segment(3) ?>';
        setTimeout(function () {
            $.ajax({
                url: "<?php echo base_url() ?>admin/show_chart_data" + filter,
                method: "POST",
                async: false,
                data: { date_val: date_val, type: type },
                success: function (reponse) {

                    $('#show_table').html(reponse);
                    // if(reponse==1){
                    // }else if(reponse==2)
                    // {
                    //     $('#show_message').html('<div>First declare open result.</div>').show(); 
                    // }
                }
            });
        }, 1000);
    }
    $(document).ready(function () {
        $("#update_result").click(function () {
            selectpana();
            show_chart_data();
            event.preventDefault();
            var type = '<?= $this->uri->segment(3) ?>';
            var snum = $('#type-filter_pana').val();
            var num = $('#number_num').val();
            var bettype = $('#type-filter').val();
            var id = $('#id').val();
            var udate = $('#udate').val();
            var update_result = $('#update_result').val();
            $.ajax({
                url: "<?php echo base_url() ?>admin/declare_result_ajax",
                method: "POST",
                async: false,
                data: { id: id, snum: snum, num: num, udate: udate, bettype: bettype, update_result: update_result, type: type },
                success: function (reponse) {
                    if (reponse == 1) {
                    } else if (reponse == 2) {
                        $('#show_message').html('<div>First declare open result.</div>').show();
                    }
                }
            });
        });
    });

</script>

<?php include('includes/footer.php') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#myTable2').DataTable();
        $('.js-example-basic-single').select2();
    });
</script>