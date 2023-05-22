<?php
include(__DIR__ . '/includes/header.php');
include(__DIR__ . '/includes/sidebar.php');
?>
<style>
    .btn-no {
        padding: 0;
        border: none;
        outline: none;
        font: inherit;
        color: inherit;
        background: none
    }
</style>
<div class="content-wrapper">

    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <?= $this->session->flashdata('delete') ?>
                <div class="row" style="padding-bottom: 7px;">
                    <div class="col-md-6 col-6">
                        <h5 class="font-strong mb-4">
                            <?= $name ?>
                        </h5>
                    </div>
                    <div class="col-md-6 col-6">
                        <form action="" method="get">
                            <button class="btn-no text-right float-right"><i class="fa fa-filter"></i> Reset
                                Filter</button>
                        </form>
                    </div>
                </div>

                <div class="">
                    <!--<div class="input-group-icon input-group-icon-left mr-3">-->
                    <!--    <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>-->
                    <!--    <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">-->
                    <!--</div>-->
                    <div class="">
                        <form style="">
                            <!--<select class="selectpicker" id="byuser" name="user_id" title="Please select" data-style="btn-solid" data-width="150px">-->
                            <!--    <option value="">Select user</option>-->
                            <?php
                            // foreach($gamedata as $gamedata1) {
                            //$matka1= $this->Game->userbyid($gamedata1->user_id);
                            //echo $matka1->name.'<br>';
                            ?>
                            <!--    <option value="<?= $matka1->name ?>"><?= $matka1->name; ?></option>-->
                            <?php //} ?>
                            <!--</select>-->
                            <div class="row">
                                <div class="col-md-3 mb-0">
                                    <label class="mb-0 mr-2">Date:</label>
                                    <input class="form-control" type="date" name="from_date" value="<?= $from_date ?>">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="mb-0 mr-2 mb-2">Matka Name:</label>
                                    <select id="matka" name="matka_id" class="selectpicker show-tick form-control">
                                        <option value="">All</option>
                                        <?php foreach ($matka as $m): ?>
                                            <option value="<?php echo $m->id ?>" <?php echo ($select_matka == $m->id) ? "selected" : "" ?>><?php echo $m->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


                                <div class="col-md-1">
                                    <label class="mb-2"></label>
                                    <input type="submit" class="btn btn-primary" value="Filter"
                                        style="margin-top:5px" />
                                </div>
                            </div>


                            <!--</div>-->
                            <!--<div class="flexbox">-->
                            <!--<label class="mb-0 mr-2">Status:</label>-->
                            <!--<select class="selectpicker show-tick form-control" id="type-status" name="status" title="Please select" data-style="btn-solid" data-width="150px">-->
                            <!--    <option value="">All</option>-->
                            <!--    <option>Win</option>-->
                            <!--    <option>Loss</option>-->
                            <!--    <option>Pending</option>-->
                            <!--</select> &nbsp;-->

                            <!--<input type="date" name="to_date" value="<?= $to_date ?>">&nbsp;-->
                            <!--<input type="submit" class="btn btn-primary" value="Filter" />-->
                        </form>
                    </div>
                </div>

                <div class="clearfix"></div>




                <!-- Modal -->
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Bid History</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <table class="table-responsive table-hover table-bordered" id="datatable">
                                        <thead class="thead-default thead-lg ">
                                            <tr>
                                                <th>#</th>
                                                <th>User</th>
                                                <th>Matka </th>
                                                <th>points</th>
                                                <th>Bet type</th>
                                                <!--<th>Date</th>-->
                                                <th>Date - Time</th>
                                                <th>Digits</th>
                                                <th>Game</th>
                                                <th>Status</th>
                                                <!--<th>Action</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0; foreach ($userbid_history as $gamedatas):
                                                $i++;
                                                $gm = $gamedatas->game_id;
                                                $bid_amount += $gamedatas->points;


                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $i ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $user = $this->Game->userbyid($gamedatas->user_id);
                                                        $username = $user->name;
                                                        ?>
                                                        <form action="" method="get">
                                                            <input type="hidden" name="user_id"
                                                                value="<?= $gamedatas->user_id ?>">
                                                            <input type="hidden" name="bettype"
                                                                value="<?= $_GET['bettype'] ?>">
                                                            <input type="hidden" name="status"
                                                                value="<?= $_GET['status'] ?>">
                                                            <input type="hidden" name="from_date"
                                                                value="<?= $_GET['from_date'] ?>">
                                                            <input type="hidden" name="to_date"
                                                                value="<?= $_GET['to_date'] ?>">
                                                            <input type="hidden" name="matka_id"
                                                                value="<?= $_GET['matka_id'] ?>">
                                                            <!--<button class="btn-no" type="submit"><?= $username ?></button>-->
                                                            <button class="btn-no" type="submit"> <a
                                                                    href="<?php echo base_url(); ?>UserDashboard/<?php echo $gamedatas->user_id ?>">
                                                                    <?= $username ?></a></button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $gamedata = $this->Game->matkabyid($gamedatas->matka_id);
                                                        if ($game_type == 'starline')
                                                            $matka_name = $gamedata->s_game_time;
                                                        else
                                                            $matka_name = $gamedata->name;
                                                        ?>
                                                        <form action="" method="get">
                                                            <input type="hidden" name="user_id"
                                                                value="<?= $_GET['user_id'] ?>">
                                                            <input type="hidden" name="bettype"
                                                                value="<?= $_GET['bettype'] ?>">
                                                            <input type="hidden" name="status"
                                                                value="<?= $_GET['status'] ?>">
                                                            <input type="hidden" name="from_date"
                                                                value="<?= $_GET['from_date'] ?>">
                                                            <input type="hidden" name="to_date"
                                                                value="<?= $_GET['to_date'] ?>">
                                                            <input type="hidden" name="matka_id"
                                                                value="<?= $gamedatas->matka_id ?>">
                                                            <button class="btn-no" type="submit">
                                                                <?= $matka_name ?>
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <?= $gamedatas->points ?>
                                                    </td>
                                                    <td>
                                                        <?= ($gamedatas->bet_type == 'close') ? '<h3 class="badge badge-danger">Closed</h3>' : '<h3 class="badge badge-success">Open</h3>' ?>
                                                    </td>
                                                    <!--<td><?= $gamedatas->date ?></td>-->
                                                    <td>
                                                        <?= date('d/m/Y H:i:s', strtotime($gamedatas->time)) ?>
                                                    </td>
                                                    <td>
                                                        <?= $gamedatas->digits ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $game = $this->Game->gamebyid($gamedatas->game_id);
                                                        echo $game->name;
                                                        ?>
                                                    <td>
                                                        <?php
                                                        $status = $gamedatas->status;
                                                        if ($status == 'loss') {
                                                            $class = 'danger';
                                                            $name = "Loss";
                                                        } elseif ($status == 'pending') {
                                                            $class = 'warning';
                                                            $name = "Pending";
                                                        } else {
                                                            $class = 'success';
                                                            $name = "Win";
                                                        }
                                                        ?>
                                                        <h3 class="badge badge-<?= $class ?>"><?= $name ?></h3>
                                                    </td>
                                                    <!--<td>-->
                                                    <!--    <a class="btn btn-danger delete" href='<?php echo base_url(); ?>admin/delete/<?= $gamedatas->id ?>?table=<?php echo base64_encode('tblgamedata'); ?>' onclick="return (confirm('Are you sure to delete?'))?true:false;"><i class="fa fa-trash"></i></a>-->
                                                    <!--</td>-->


                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!--<div class="modal-footer">-->
                                <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end modal--->



                <!-- Modal -->
                <div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Winning History</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table-responsive table-hover table-bordered" id="datatable">
                                    <thead class="thead-default thead-lg">
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Matka </th>
                                            <th>points</th>
                                            <th>Bet type</th>
                                            <!--<th>Date</th>-->
                                            <th>Date - Time</th>
                                            <th>Digits</th>
                                            <th>Game</th>
                                            <th>Status</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($winning_report as $gamedatas):
                                            $i++;
                                            $gm = $gamedatas->game_id;
                                            $bid_amount2 += $gamedatas->points;
                                            $gt = $this->db->select('game_id,points')->where('game_id', $gm)->
                                                get('tblgame')->result_array(); foreach ($gt as $gtt) {
                                                $pot += $gtt['points'] * $bid_amount2;
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $i ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $user = $this->Game->userbyid($gamedatas->user_id);
                                                    $username = $user->name;
                                                    ?>
                                                    <a
                                                        href="<?php echo base_url(); ?>UserDashboard/<?php echo $gamedatas->user_id ?>">
                                                        <?= $username ?></a>
                                                </td>
                                                <td>
                                                    <?php
                                                    $gamedata = $this->Game->matkabyid($gamedatas->matka_id);
                                                    if ($game_type == 'starline')
                                                        echo $matka_name = $gamedata->s_game_time;
                                                    else
                                                        echo $matka_name = $gamedata->name;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?= $gamedatas->points ?>
                                                </td>
                                                <td>
                                                    <?= ($gamedatas->bet_type == 'close') ? '<h3 class="badge badge-danger">Closed</h3>' : '<h3 class="badge badge-success">Open</h3>' ?>
                                                </td>
                                                <!--<td><?= $gamedatas->date ?></td>-->
                                                <td>
                                                    <?= date('d/m/Y H:i:s', strtotime($gamedatas->time)) ?>
                                                </td>
                                                <td>
                                                    <?= $gamedatas->digits ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $game = $this->Game->gamebyid($gamedatas->game_id);
                                                    echo $game->name;
                                                    ?>
                                                <td>
                                                    <?php
                                                    $status = $gamedatas->status;
                                                    if ($status == 'loss') {
                                                        $class = 'danger';
                                                        $name = "Loss";
                                                    } elseif ($status == 'pending') {
                                                        $class = 'warning';
                                                        $name = "Pending";
                                                    } else {
                                                        $class = 'success';
                                                        $name = "Win";
                                                    }
                                                    ?>
                                                    <h3 class="badge badge-<?= $class ?>"><?= $name ?></h3>
                                                </td>
                                                <!--<td>-->
                                                <!--    <a class="btn btn-danger delete" href='<?php echo base_url(); ?>admin/delete/<?= $gamedatas->id ?>?table=<?php echo base64_encode('tblgamedata'); ?>' onclick="return (confirm('Are you sure to delete?'))?true:false;"><i class="fa fa-trash"></i></a>-->
                                                <!--</td>-->


                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!--<div class="modal-footer">-->
                            <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                            <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>

                <!--end modal-->
                <div class="col-12">
                    <button class="btn btn-default" data-toggle="modal" data-target="#exampleModalLong">Total Bid Amount
                        : Rs.
                        <?= isset($bid_amount) ? $bid_amount : "0"; ?> View
                    </button><br /><br />
                    <button class="btn btn-default" data-toggle="modal" data-target="#exampleModalLong2">Total Winning
                        Amount : Rs.
                        <?= isset($pot) ? $pot : "0"; ?> View
                    </button>
                </div>


            </div>
        </div>
    </div>
    <!-- Button trigger modal -->




    <!-- END PAGE CONTENT-->
    <script>
        function selectpana(str) {
            if (str == 'Close') {
                document.getElementById('close').style.display = 'block';
                document.getElementById('open').style.display = 'none';
            }
            if (str == 'Open') {
                document.getElementById('open').style.display = 'block';
                document.getElementById('close').style.display = 'none';

            }

        }

    </script>
    <?php include(__DIR__ . '/includes/footer.php') ?>