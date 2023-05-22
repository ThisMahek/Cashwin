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
                          <h5 class="font-strong mb-4">Matka/Market Load</h5></div>
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
                                         <th>Game</th>
                                         <th>Time</th>
                                         <th>Total bet</th>
                                         <th>Distributed amount</th>
                                         <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $mcounter=0;
                                        $prefix_time = (date('D')!='Sat' || date('D')!='Sun')?'bid_':((date('D')=='Sat')?'sat_':'');
                                        $start_time = $prefix_time.'start_time';
                                        $end_time = $prefix_time.'end_time';
                                        $total_bet = $total_dist_amt = 0;
                                        foreach($matkas as $matka) {
                                            // print_r($matka);
                                            $mcounter++;
                                            $total_bet += ($matka->open_bet+$matka->close_bet);
                                            $total_dist_amt += ($matka->open_dist_amt+$matka->close_dist_amt);
                                    ?>
                                    <tr>
                                        <td rowspan="2"><?= $mcounter ?></td>
                                        <td><?= $matka->name ?> Open </td>
                                        <td><?= $matka->$start_time ?></td>
                                        <td><?= $matka->open_bet ?></td>
                                        <td><?= $matka->open_dist_amt ?></td>
                                        <td><a href="<?= base_url('Game_dashboard/singleGameData/'.$matka->id.'/open')?>"><button class="btn btn-primary btn-sm">Access</button></a></td>
                                    </tr>
                                    <tr>
                                        <td><?= $matka->name ?> Close</td>
                                        <td><?= $matka->$end_time ?></td>
                                        <td><?= $matka->close_bet ?></td>
                                        <td><?= $matka->close_dist_amt ?></td>
                                        <td><a href="<?= base_url('Game_dashboard/singleGameData/'.$matka->id.'/close')?>"><button class="btn btn-primary btn-sm">Access</button></a></td>
                                    </tr>
                                    
                                <?php } if($total_bet>0): ?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <th colspan="2">Sub Total</th>
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
<?php include(__DIR__.'/../includes/footer.php'); ?>