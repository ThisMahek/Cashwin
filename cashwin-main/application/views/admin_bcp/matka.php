<?php 
	include('includes/header.php');
	include('includes/sidebar.php');
?>
<style>
    .desktop-responsive{
        overflow-x:scroll;
        display:block;
    }
</style>
         <div class="content-wrapper">
            
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                       <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-6 col-8">
                          <h5 class="font-strong mb-4">Market Lists</h5></div>
                          <div class="col-md-6 col-4">
                                 <!--<a class="pull-right btn btn-info btn-square" href='<?php echo base_url(); ?>admin/matka/add'> +Add</a>-->
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
                        <table id="myTable2" class="table table-striped table-responsive table-bordered nowrap desktop-responsive" >
                                <thead>
                                    <tr>
                                       <th>Id</th>
                                        <!--<th>Image</th> -->
                                        <th>Matka Name</th>
                                        <th>Time (Mon-Fri)</th>
                                        <th>Result</th>
                                        <th>Time (Sat)</th>
                                        <th>Time (Sun)</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                        <!--<th>View Games & Points</th>-->
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($teams as $team) : ?>
                                 <tr>
                                        <td><?php echo $team['id']; ?></td>
                                       <!-- <td>
                                            <img width="20px;" src="<?php echo site_url();?>assets/images/teams/<?php echo $team['image']; ?> ">                                           
                                        </td> -->
                                        <td><a href="<?php echo base_url(); ?>admin/update_matka/<?php echo $team['id']; ?>"><?php echo $team['name']; ?></a></td>
                                        
                                        <td><?php echo ($team['bid_start_time']=="00:00:00" && $team['bid_end_time']=="00:00:00")?"<b style='color: red'>Closed</b>":$team['bid_start_time'].'-'.$team['bid_end_time']; ?></td>
                                        <td><?php echo $team['starting_num']."-".$team['number']."-".$team['end_num']; ?></td>
                                        <td><?php echo ($team['sat_start_time']=="00:00:00" && $team['sat_end_time']=="00:00:00")?"<b style='color: red'>Closed</b>":$team['sat_start_time'].'-'.$team['sat_end_time']; ?></td>
                                        <td><?php echo ($team['start_time']=="00:00:00" && $team['end_time']=="00:00:00")?"<b style='color: red'>Closed</b>":$team['start_time'].'-'.$team['end_time']; ?></td>
                                        <td><?php echo date("M d,Y", strtotime($team['created_at'])); ?></td>
                                        <td><?php echo date("M d,Y", strtotime($team['updated_at'])); ?></td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a class="" href='<?php echo base_url(); ?>admin/update_matka/<?php echo $team['id']; ?>'><button class="btn btn-danger">Edit</button></a>
                                            <?php
                                            $setWinner = strtotime(date("Y-m-d"), strtotime("-30 minutes"))-strtotime(date("Y-m-d", strtotime($team['updated_at'])));
                                            if($setWinner<=0): ?>
                                                <!-- SetWinner Button -->
                                                <a class="label label-inverse-info" href='<?php echo base_url(); ?>admin/update_matka_point/<?php echo $team['id']; ?>'><button class="btn btn-success">Set Winner</button></a>
                                            <?php endif; ?>
                                            <!-- Delete Button -->
                                            <!--<a class="label label-inverse-danger delete" href='<?php echo base_url(); ?>admin/delete/<?php echo $team['id']; ?>?table=<?php echo base64_encode('matka'); ?>'>Delete</a>-->
                                            <a class="" href='<?php echo base_url(); ?>admin/view_games/<?php echo $team['id']; ?>'><button class="btn btn-primary">View Games</button></a>
                                            <a class="" href='<?php echo base_url(); ?>admin/view_point_lists/<?php echo $team['id']; ?>'><button class="btn btn-warning">View Points</button></a>
                                            <!--<a class="" href='<?php echo base_url(); ?>excel_export/matka/<?php echo $team['id']; ?>'><button class="btn btn-primary">Download report</button></a>-->

                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                 </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        
        <?php include('includes/footer.php')?>
         <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">  
        <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
                <script>
                     $(document).ready( function () {
                        $('#myTable2').DataTable();
                    } );
                </script>