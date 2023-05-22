<?php 
	include(__DIR__.'/../includes/header.php');
	include(__DIR__.'/../includes/sidebar.php');
	$games = $this->Administrator_Model->games();
	$users = $this->Administrator_Model->all_users();
	$matkas = $this->Administrator_Model->all_matka();
	
?>
<div class="content-wrapper">
            
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                       <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-4">
                          <h5 class="font-strong mb-4">View Game History</h5></div>
                          <div class="col-md-8">



                            Filter by: <form action="" method="get">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select name="matka_id" class="form-control">
                                                <option value="">Select Matka</option>
                                                <?php
                                                    foreach($matkas as $matka){
                                                ?>
                                                <option value="<?= $matka->id ?>"><?= $matka->name ?></option>
                                                <?php } ?>
                                            </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="game_id" class="form-control">
                                                <option value="">Select game</option>
                                                <?php
                                                    foreach($games as $game){
                                                ?>
                                                <option value="<?= $game->game_id ?>"><?= $game->name ?></option>
                                                <?php } ?>
                                            </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="user_id" class="form-control">
                                                <option value="">Select User</option>
                                                <?php
                                                    foreach($users as $user){
                                                ?>
                                                <option value="<?= $user->id ?>"><?= $user->name ?></option>
                                                <?php } ?>
                                            </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                                            
                                            
                                            
                                        </form>
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
                                <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
                            </div>
                        </div>
                        <div class="table-responsive row">
                            <table class="table table-bordered table-hover" id="datatable1">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Game</th>
                                        <th>Matka ID</th>
                                        <th>Total Points</th>
                                        <th>Digits</th>
                                       <th>Date</th>
                                        <th>Bet Type</th>
                                        <!--<th>Action</th>-->
                                    </tr>
                                </thead>
                                 <tbody>
                                     
                                <?php foreach($users as $post) : ?>
                                 <tr>
                                     <td><?php echo $post['id']; ?></td>
                                     <!--<td><?php echo $post['username'].' ('.$post['user_id'].')'; ?></td>-->
                                     <td><?php echo $post['name'].' ('.$post['game_id'].')'; ?></td>
                                     <td><?php echo $post['matka_id']; ?></td>
                                     <td><?php echo $post['sum_points']; ?></td>
                                     <td><?php echo $post['digits']; ?></td>
                                     <td><?php echo $post['date']; ?></td>
                                     <!--<td><?php echo $post['time']; ?></td>-->
                                     <td><?php echo $post['bet_type']; ?></td>
                                     <!-- <td>
                                        <img width="20px;" src="<?php echo site_url();?>assets/images/users/<?php echo $post['image']; ?> ">
                                     </td>-->
                                     <!--<td><a href="edit-blog.php?id=14"><?php echo $post['name']; ?></a></td>-->
                                     <!--<td><?php echo date("M d,Y", strtotime($post['register_date'])); ?></td>-->
                                      <!--<td>-->
                                      <!--  <a class="btn btn-danger delete" href='<?php echo base_url(); ?>admin/delete/<?php echo $post['id']; ?>?table=<?php echo base64_encode('tblgamedata'); ?>' onclick="return (confirm('Are you sure to delete?'))?true:false;">Delete</a>-->
                                      <!--</td>-->
                                    </tr>
                                <?php endforeach; ?>

                                <!-- <div class="paginate-link">
                                    <?php //echo $this->pagination->create_links(); ?>
                                </div>  -->

                                 </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
           
        <?php include(__DIR__.'/../includes/footer.php') ?>