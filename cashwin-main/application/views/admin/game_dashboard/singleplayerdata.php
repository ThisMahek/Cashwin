<?php 
	include(__DIR__.'/../includes/header.php');
	include(__DIR__.'/../includes/sidebar.php');
?>

<style>
    table tr th{
        /*text-align:center;*/
    }
</style>
<div class="content-wrapper">
            
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                       <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-6">
                              <h5 class="font-strong mb-4">Player Data - <?= ($matka->id>20)?"Starline ".$matka->s_game_time:($matka->name.' '.ucwords($type)) ?></h5></div>
                          </div>
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
                        <div class="table-responsive container-fluid">
                            <table class="table table-bordered table-hover" id="datatable">
                                <?php
                                    foreach($gamedata[$game->game_id] as $digit => $game_data):
                                ?>
                                    <tr class="bg-secondary">
                                        <th colspan="2"><?= $game->name ?></th>
                                        <th class="pull-right"><?= str_replace("'", "", $digit); ?></th>
                                    </tr>
                                    <tr>
                                        <th>User</th>
                                        <th>Digit</th>
                                        <th>Points</th>
                                    </tr>
                                    <?php
                                        $total_amt = 0;
                                        foreach($game_data as $singleUserGameData):
                                            $total_amt += $singleUserGameData->total_points;
                                    ?>
                                        <tr>
                                            <td><?= fullname($singleUserGameData->user_id) ?></td>
                                            <td><?= $singleUserGameData->digits ?></td>
                                            <td><?= $singleUserGameData->total_points ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <th colspan="2" class="text-primary">Total amount</th>
                                        <th class="text-primary"><?= $total_amt ?></th>
                                    </tr>
                                    <tr>
                                        <th class="text-danger">Maximum played By</th>
                                        <th class="text-danger">
                                            <?= fullname($maxPlayedBy[$game->game_id]->user_id); ?>
                                        </th>
                                        <th class="text-danger">Rs. <?= $maxPlayedBy[$game->game_id]->points ?></th>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
           
      <?php 
	    include(__DIR__.'/../includes/footer.php');
        ?>