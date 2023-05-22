<?php 
	include(__DIR__.'/../includes/header.php');
	include(__DIR__.'/../includes/sidebar.php');
?>

<div class="content-wrapper">
            
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                       <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-6">
                          <h5 class="font-strong mb-4">List Player</h5></div>
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
                                <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
                            </div>
                        </div>
                        <div class="table-responsive row">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead class="thead-default thead-lg">
                                    <tr>
                                         <th>ID</th>
                                        <th>Username</th>
                                        <th>History</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $post) : ?>
                                    <tr>
                                        <td><?php echo $post['id']; ?></td>
                                        <td><?php echo $post['username']; ?></td>
                                        <td><a href='<?php echo base_url(); ?>admin/view_history/?matka_id=<?php echo $matka_id; ?>&game_id=<?php echo $game_id; ?>&user_id=<?php echo $post['id']; ?>'><span class="badge badge-success">See history</span></a></td>
                                        
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
           
        <?php include(__DIR__.'/../includes/footer.php')?>