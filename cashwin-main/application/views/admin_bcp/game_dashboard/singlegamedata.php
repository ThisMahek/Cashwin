<?php 
	include(__DIR__.'/../includes/header.php');
	include(__DIR__.'/../includes/sidebar.php');
?>
<style>
    /*table tr th{*/
    /*    text-align:center;*/
    /*}*/
</style>
<div class="content-wrapper">
            
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                       <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-6">
                          <h5 class="font-strong mb-4">Game Data - <?= ($matka->id>20)?"Starline ".$matka->s_game_time:($matka->name.' '.ucwords($type)) ?></h5></div>
                          <div class="col-md-6">
                                
                          </div>
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
                                <?php
                                    if(!empty($gamedata)):
                                        foreach($games as $game) {
                                            if(!isset($gamedata[$game->game_id])) continue;
                                            $singlePlayerDataURL = base_url('Game_dashboard/singlePlayerData/'.$matka->id.'/'.$type.'/'.$game->game_name);
                                    ?>
                                        <tr>
                                            <th colspan="2" class="bg-secondary"><a href="<?= $singlePlayerDataURL?>"><?= $game->name ?></a></th>
                                        </tr>
                                        <tr>
                                            <th>Digit </th>
                                            <th>Points</th>
                                        </tr>
                                        <?php
                                            $total_amt = 0;
                                            foreach($gamedata[$game->game_id] as $singleGameData):
                                                $total_amt += $singleGameData->total_points;
                                        ?>
                                            <tr>
                                                <td><a href="<?= $singlePlayerDataURL.'/'.$singleGameData->digits ?>"><?= $singleGameData->digits; ?></td>
                                                <td><?= $singleGameData->total_points; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <th class="text-primary">Total Amount</th>
                                            <th class="text-primary">Rs <?= $total_amt ?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="2" class="text-danger">Maximum Played by: <?= fullname($maxPlayedBy[$game->game_id]->user_id); ?></th>
                                        </tr>
                                        <tr>
                                            <th class="text-danger">
                                                <?= $maxPlayedBy[$game->game_id]->digits; ?>
                                            </th>
                                            <th class="text-danger">Rs. <?= $maxPlayedBy[$game->game_id]->points ?></th>
                                        </tr>
                                        <tr><th colspan="2"></th></tr>
                                <?php } else: ?>
                                        <tr>
                                            <th colspan="2" class="bg-secondary"> No Game Data found.</th>
                                        </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
           
    <?php 
	    include(__DIR__.'/../includes/footer.php');
    ?>