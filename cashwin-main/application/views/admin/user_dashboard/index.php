<?php 
	include(__DIR__.'/../includes/header.php');
	include(__DIR__.'/../includes/sidebar.php');
?>
<style>
.text-muted{
  text-transform:uppercase;  
}
</style>
  <div class="content-wrapper">
       <div class="page-heading">
                <h1 class="page-title">User Dashboard : <?= ($users->id>20)?'Starline '.$users->s_game_time:$users->name ?></h1>
            </div>
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="row mb-4">
                    
                    <div class="col-lg-4 col-md-6">
                        <a href="<?= base_url('admin/view_games/'.$users->id);?>">
                            <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="50" data-bar-color="#5c6bc0" data-size="90" data-line-width="10">
                                </div>
                                <div>
                                    <h4 class="font-strong text-primary">View Game-User wise</h4>
                                    <div class="text-muted text-center"><button class="btn btn-primary">Access</button></div>
                                </div>
                            </div>
                        </div></a>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <a href="<?= base_url('admin/view_point_lists/'.$users->id);?>">
                            <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="50" data-bar-color="#5c6bc0" data-size="90" data-line-width="10">
                                </div>
                                <div>
                                    <h4 class="font-strong text-primary">View Matka wise</h4>
                                    <div class="text-muted text-center"><button class="btn btn-primary">Access</button></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <a href="<?= base_url('admin/gamedata?matka_id='.$users->id);?>">
                            <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="50" data-bar-color="#5c6bc0" data-size="90" data-line-width="10">
                                </div>
                                <div>
                                    <h4 class="font-strong text-primary">View GameData</h4>
                                    <div class="text-muted text-center"><button class="btn btn-primary">Access</button></div>
                                </div>
                            </div>
                        </div></a>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <a href="<?= base_url('Game_dashboard/singleGameData/'.$users->id.'/open')?>">
                            <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="50" data-bar-color="#5c6bc0" data-size="90" data-line-width="10">
                                </div>
                                <div>
                                    <h4 class="font-strong text-primary">Game Data - Open</h4>
                                    <div class="text-muted text-center"><button class="btn btn-primary">Access</button></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                    <?php if($users->id<=20): ?>
                    <div class="col-lg-4 col-md-6">
                        <a href="<?= base_url('Game_dashboard/singleGameData/'.$matka->id.'/close')?>">
                            <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="50" data-bar-color="#5c6bc0" data-size="90" data-line-width="10">
                                </div>
                                <div>
                                    <h4 class="font-strong text-primary">Game Data - Close</h4>
                                    <div class="text-muted text-center"><button class="btn btn-primary">Access</button></div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                    <?php endif; ?>

                </div>
               
             </div>
                   
     
            <!-- END PAGE CONTENT-->
           
        <?php include(__DIR__.'/../includes/footer.php')?>