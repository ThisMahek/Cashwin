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
                          <h5 class="font-strong mb-4">Starline Load</h5></div>
                       </div>
                        
                        <div class="flexbox mb-4">
                            <div class="input-group-icon input-group-icon-left mr-3">
                                <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
                            </div>
                            <div class="input-group-icon input-group-icon-left mr-3">
                                <span class="input-icon input-icon-right font-16"><i class="ti-filter"></i></span>
                                <form method="post">
                                    <input onchange="submit()" class="form-control form-control-rounded form-control-solid" name="load_date" type="date" value="<?= $date ?>" placeholder="Select Date ...">
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive row">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead class="thead-default thead-lg">
                                    <tr>
                                         <th>#</th>
                                         <th>Time</th>
                                         <th>Total bet</th>
                                         <th>Distributed amount</th>
                                         <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $mcounter=0;
                                        $start_time = 's_game_time';
                                        $total_bet = $total_dist_amt = 0;
                                        foreach($starlines as $starline) {
                                            $mcounter++;
                                            $total_bet += $starline->open_bet;
                                            $total_dist_amt += $starline->open_dist_amt;
                                    ?>
                                    <tr>
                                        <td><?= $mcounter ?></td>
                                        <td><?= $starline->$start_time ?></td>
                                        <td><?= $starline->open_bet ?></td>
                                        <td><?= $starline->open_dist_amt ?></td>
                                        <td><a href="<?= base_url('Game_dashboard/singleGameData/'.$starline->id.'/open')?>"><button class="btn btn-primary btn-sm">Access</button></a></td>
                                    </tr>
                                <?php } if($total_bet>0): ?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <th>Sub Total</th>
                                        <td><?= $total_bet ?></td>
                                        <td><?= $total_dist_amt ?></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                <?php endif; ?>  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
           
        <?php 
            include(__DIR__.'/../includes/footer.php');
        ?>