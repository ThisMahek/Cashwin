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
                        <h5 class="font-strong mb-4">Bid Revert</h5>
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
                        <form style="" method="GET" action="">
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
                                    <!--selectpicker show-tick-->
                                    <select id="matka" name="matka_id" class=" form-control" required>
                                        <option value="">Select</option>
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
            </div>
        </div>
        <div class="ibox">
            <div class="ibox-body">
                <h4 class="card-title">Bid Revert List
                    <?php if (!empty($bid_revert_data)): ?>
                        <button type="button" class="btn btn-sm btn-primary waves-light  ml-1"
                            onclick="reverse_win_amt('<?= $from_date ?>','<?= $select_matka ?>','both','bet_amt','0','1','0');">Clear
                            &amp; Refund All</button>
                    <?php endif; ?>
                </h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover datatable" id="">
                        <thead class="thead-default thead-lg">
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Bid Points</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="" method="get">
                                <input type="hidden" name="user_id" value="<?= $gamedatas->user_id ?>">

                                <input type="hidden" name="from_date" value="<?= $_GET['from_date'] ?>">
                                <input type="hidden" name="to_date" value="<?= $_GET['to_date'] ?>">
                                <input type="hidden" name="matka_id" value="<?= $_GET['matka_id'] ?>">
                                <button class="hidden" type="submit">
                                    <?= $username ?>
                                </button>
                            </form>
                            <?php
                            if (!empty($bid_revert_data)):
                                $i = 1; foreach ($bid_revert_data as $gamedatas):
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
                                            <a href="<?php echo base_url(); ?>UserDashboard/<?php echo $gamedatas->user_id ?>">
                                                <?= $username ?></a>
                                        </td>
                                        <td>
                                            <?= $gamedatas->points ?>
                                        </td>
                                        <td>
                                            <?= $gamedatas->bet_type ?>
                                        </td>
                                    </tr>
                                    <?php $i++; endforeach; endif; ?>
                        </tbody>
                    </table>
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