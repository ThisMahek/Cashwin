<?php
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">

    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <div class="row" style="padding-bottom: 7px;">
                    <div class="col-md-6">
                        <h5 class="font-strong mb-4">Starline List</h5>
                    </div>
                    <div class="col-md-6">
                        <!-- <div class="page-heading">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="index-2.html"><i class="la la-home font-20"></i></a>
                                        </li>
                                        <li class="breadcrumb-item">Basic UI</li>
                                        <li class="breadcrumb-item">Typography</li>
                                    </ol>
                                </div> -->
                    </div>
                </div>

                <div class="flexbox mb-4">
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
                    <div class="input-group-icon input-group-icon-left mr-3">
                        <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                        <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text"
                            placeholder="Search ...">
                    </div>
                </div>
                <div class="table-responsive row">

                    <table class="table table-bordered table-hover" id="datatablestar">
                        <thead class="thead-default thead-lg">
                            <tr>
                                <th>ID</th>
                                <th>Start Time</th>
                                <th>Bid Time</th>
                                <th>Result</th>
                                <th> Edit</th>
                                <!--<th>View Games & Points</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            foreach ($users as $post):

                                ?>
                                <tr>
                                    <td>
                                        <?php echo $post['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $post['s_game_time']; ?>
                                    </td>
                                    <td>
                                        <?php echo $post['s_game_end_time']; ?>
                                    </td>
                                    <td>
                                        <?php echo $post['s_game_number']; ?>
                                    </td>

                                    <td>
                                        <a class="btn btn-primary"
                                            href='<?php echo base_url(); ?>admin/starline_update/<?php echo $post['id']; ?>'>Edit</a>
                                    </td>

                                    <!--<td>-->
                                    <!--    <a class="btn btn-success" href='<?php echo base_url(); ?>admin/view_games/<?php echo $post['id']; ?>'>Games</a>-->
                                    <!--    <a class="btn btn-danger" href='<?php echo base_url(); ?>admin/view_point_lists/<?php echo $post['id']; ?>'>Points</a>-->
                                    <!--<a class="btn btn-primary" href='<?php echo base_url(); ?>excel_export/starline/<?php echo $post['id']; ?>'>Download report</a>-->
                                    <!--</td>-->
                                </tr>
                            <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->

    <?php include('includes/footer.php') ?>