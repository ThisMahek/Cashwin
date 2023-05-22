<?php 
	include('includes/header.php');
	include('includes/sidebar.php');
?>

<style>
@media only screen and (max-width: 600px) {
    .form-control-rounded{
        margin-bottom:10px;
    }
}

label{
    margin-top: 8px;
    margin-right: 5px
}
</style>
<div class="content-wrapper">
            
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body pb-0">
                        
                        <?= $this->session->flashdata('delete') ?>
                        
                       <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-6">
                          <h5 class="font-strong mb-4">Games data</h5></div>
                          <div class="col-md-6">
                          </div>
                       </div>
                         <div class="row">
                             <div class="col-md-3">
                        <div class="flexbox mb-4">
                            <div class="input-group-icon input-group-icon-left mr-3">
                                <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
                            </div>
                        </div>
                        </div>
                         <div class="col-md-9">
                            
                        <form action="" method="get">
                             
                             <!--<div class="flexbox mb-4" style="display:inline-flex;">-->
                                 <div class="row">
                                <div class="col-md-5" style="display:inline-flex;">
                                <label>From</label>
                                <input class="form-control form-control-rounded form-control-solid" name="from" type="date" value="<?= ($from)?:date('Y-m-d'); ?>" min="2020-01-01" max="2040-12-31"  required>
                                </div>
                                <div class="col-md-5" style="display:inline-flex;">
                                <label style="margin-left:10px;">To</label>
                                <input class="form-control form-control-rounded form-control-solid" name="to" type="date"  value="<?= ($to)?:date('Y-m-d'); ?>" min="2020-01-01" max="2040-12-31"  required>
                                </div>
                               <div class="col-md-2">
                                <button class="btn btn-primary form-control-rounded"  type="submit" style="margin-left:5px;"> Search</button>
                                </div>
                            </div>
                            </div>
                             <!--</div>-->
                             </form>
                            
                             </div>
                             </div>
                         <div class="card-body">
                                                     <div class="table-responsive row">
                                            <table class="table table-bordered table-hover" id="datatable">
                                                <thead class="thead-default thead-lg">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>User</th>
                                                        <th>Matka </th>
                                                        <th>points</th>
                                                        <th>Bet type</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Digits</th>
                                                        <th>Game</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                $i=0;
                                                foreach($gamedata as $gamedatas) :
                                                $i++;
                                                ?>
                                                    <tr>
                                                        <td><?= $i ?></td>
                                                        <td>
                                                            <?php
                                                                $matka= $this->Administrator_Model->userbyid($gamedatas->user_id);
                                                                echo $matka->name;
                                                             ?>
                                                        </td>
                                                        <td><?php
                                                                $matka_name= "";
                                                                if($gamedatas->matka_id <= 50){
                                                                    $gamedata = $this->Administrator_Model->matkabyid($gamedatas->matka_id);
                                                                    $matka_name = $gamedata->name;
                                                                }else{
                                                                    $gamedata = $this->Administrator_Model->starlinebyid($gamedatas->matka_id);  
                                                                    $matka_name = $gamedata->s_game_time;
                                                                }
                                                                echo $matka_name;
                                                             ?>
                                                        </td>
                                                        <td><?= $gamedatas->points ?></td>
                                                        <td><?= ($gamedatas->bet_type=='close')?'<h3 class="badge badge-danger">Closed</h3>':'<h3 class="badge badge-success">Open</h3>' ?></td>
                                                        <td><?= $gamedatas->date ?></td>
                                                        <td><?= date('d/m/Y H:i:s',strtotime($gamedatas->time)) ?></td>
                                                        <td><?= $gamedatas->digits ?></td>
                                                        <td>
                                                            <?php
                                                                $game= $this->Administrator_Model->gamebyid($gamedatas->game_id);
                                                                echo $game->name;
                                                             ?>
                                                        </td>     
                                                        <td>
                                                            <?php
                                                            $status= $gamedatas->status;
                                                            if($status=='loss'){
                                                                $class='danger';
                                                                $name="Loss";
                                                            }elseif($status=='pending'){
                                                                $class='warning';
                                                                $name="Pending";
                                                            }
                                                            else{
                                                                $class='success';
                                                                $name="Win";
                                                            }
                                                            ?>
                                                        <h3 class="badge badge-<?= $class ?>"><?= $name ?></h3>
                                                        </td>
                                                        <td><a href="deletegamedata/<?= $gamedatas->id ?>" onclick="confirm('are you sure you want to delete this')"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a></td>
                
                
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                         </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
           <script>
               $('#datatable').dataTable( {
    "paging": false
} );
           </script>
        <?php include('includes/footer.php')?>