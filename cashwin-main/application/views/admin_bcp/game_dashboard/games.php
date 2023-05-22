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
                          <h5 class="font-strong mb-4"> Games</h5></div>
                        </div>
                        
                        <div class="flexbox mb-4">
                            <div class="input-group-icon input-group-icon-left mr-3">
                                <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
                            </div>
                        </div>
                        <div class="table-responsive row">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead class="thead-default thead-lg">
                                    <tr>
                                        <th>#</th>
                                        <th>game_name</th>
                                        <th>name</th>
                                        <th>points</th>
                                        <th>is_close</th>
                                        <th>is_deleted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $i=0;
                                foreach($games as $game) : 
                                $i++;
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $game->game_name ?></td>
                                        <td><?= $game->name ?></td>
                                        <td><?= $game->points ?></td>
                                        <td><?= ($game->is_close==1)?'<h3 class="badge badge-danger">Close</h3>':'<h3 class="badge badge-success">Open</h3>' ?></td>
                                        <td><?= ($game->is_deleted==1)?'<h3 class="badge badge-danger">Deleted</h3>':'<h3 class="badge badge-success">Not deleted</h3>' ?></td>
                                        
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