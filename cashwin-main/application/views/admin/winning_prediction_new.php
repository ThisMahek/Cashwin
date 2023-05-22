<?php 
	include(__DIR__.'/includes/header.php');
	include(__DIR__.'/includes/sidebar.php');
?>
<style>
    .btn-no{
        padding: 0;
  border: none;
  outline: none;
  font: inherit;
  color: inherit;
  background: none
    }
    
</style>
<div class="content-wrapper">
            
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                        <?= $this->session->flashdata('delete') ?>
                       <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-6 col-6">
                          <h5 class="font-strong mb-4"><?=$name?></h5></div>
                          <div class="col-md-6 col-6">
                              <form action="" method="get">
                                  <button class="btn-no text-right float-right"><i class="fa fa-filter"></i> Reset Filter</button>
                              </form>
                          </div>
                       </div>

                        <div class="">
                            <div class="">
                                <form style="" method="get" action=""> 
                                    <!--<select class="selectpicker" id="byuser" name="user_id" title="Please select" data-style="btn-solid" data-width="150px">-->
                                    <!--    <option value="">Select user</option>-->
                                        <?php
                                            // foreach($gamedata as $gamedata1) {
                                                //$matka1= $this->Game->userbyid($gamedata1->user_id);
                                                //echo $matka1->name.'<br>';
                                        ?>
                                    <!--    <option value="<?= $matka1->name ?>"><?= $matka1->name; ?></option>-->
                                        <?php //} ?>
                                    <!--</select>-->
                                <div class="row">
                                <div class="col-md- mb-0">
                                          <label class="mb-0 mr-2">Date:</label>
                                          <input class="form-control" type="date" name="from_date" value="<?= $from_date ?>" required="">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                         <label class="mb-0 mr-2 mb-2">Matka Name:</label>
                                        <select id="matka" name="matka_id"  class="form-control selectpiker mb-2" style="width:100%" onchange="show_hide_data(this.value)" required>
                                               <option value="">All</option>
                                            <?php foreach($matka as $m): ?>
                                            <option value="<?php echo $m->id ?>" <?php echo ($select_matka==$m->id)?"selected":"" ?>  ><?php echo $m->name;?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                     <!----end for hide data----->
                                    <!--<div id="show_hide" >-->
                                <?php
                                    if($game_type =='dmatka'){ ?>      
                                        <div class="col-md-2 mb-2" id="">
                                             <label class="mb-0 mr-2 mb-2">Number</label>
                                            <select id="matka" name="open_pana"  class="form-control selectpiker mb-2" style="width:100%" required>
                                                   <option value="">Select Digit </option>
                                                        <?php
                                                        foreach($pana_digit as $row)
                                                        { 
                                                            $prefix='0';
                                                        $num=($row>9)?$row:$prefix.$row; ?>
                                                        <option value="<?= $num ?>" <?= ($open_pana==$num)?"selected":"" ?>> <?= $num;?></option>
                                                       <?php }?>
                                                   
                                           
                                            </select>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                    if($game_type =='matka'){ ?>
                                        <div class="col-md-2 mb-2">
                                                <label class="mb-2 mr-2">Session Time:</label>
                                                <select class="selectpicker show-tick form-control w-100" id="type-bettype" 
                                                name="bettype" title="Please select" onclick="selectpana(this.value)" onchange="selectpana(this.value)" data-style="btn-solid" data-width="150px" required>
                                                    
                                                    <option <?= ($type=="Open")?"selected":"" ?>>Open</option>
                                                    <option <?= ($type=="Close")?"selected":"" ?>>Close</option>
                                                </select> 
                                        </div>
                                              
                                        
                                    <?php
                                        }
                                    ?>
                                    <?php
                                    if($game_type =='matka' || $game_type =='starline'){ ?>
                                    <div class="col-md-2 mb-2" id="open">
                                             <label class="mb-0 mr-2 mb-2">Open Pana:</label>
                                            <select id="matka" name="open_pana"  class="form-control selectpiker mb-2" style="width:100%" required>
                                                  <option value="">Select Pana </option>
                                                     <?php foreach($pana_digit as $p): ?>
                                                <option value="<?php echo $p?>" <?php echo ($open_pana==$p)?"selected":"" ?>><?php echo $p;?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                         <?php
                                        }
                                    ?>
                                 <?php
                                 if($bettype='Close'){
                                 ?>
                                    <div class="col-md-2 mb-2" id="close" style="display:none;">
                                        <label class="mb-0 mr-2 mb-2">Close Pana:</label>
                                        <select id="matka" name="close_pana"  class="form-control selectpiker mb-2" style="width:100%">
                                              <option value="">Select Pana </option>
                                              <?php foreach($pana_digit as $p): ?>
                                      <option value="<?php echo $p?>" <?php echo ($close_pana==$p)?"selected":"" ?>><?php echo $p;?></option>
                                      <?php endforeach; ?>
                                        </select>
                                    </div>
                               <?php }?>
                                    <div class="col-md-1">
                                        <label class="mb-2"></label>
                                         <input type="submit" class="btn btn-primary" value="Filter"
                                          style="margin-top:5px"/>
                                    </div>
                                </div>
                                <!----end for hide data----->
                                <!--</div>-->
                                  
                                 
                                <!--</div>-->
                                <!--<div class="flexbox">-->
                                    <!--<label class="mb-0 mr-2">Status:</label>-->
                                    <!--<select class="selectpicker show-tick form-control" id="type-status" name="status" title="Please select" data-style="btn-solid" data-width="150px">-->
                                    <!--    <option value="">All</option>-->
                                    <!--    <option>Win</option>-->
                                    <!--    <option>Loss</option>-->
                                    <!--    <option>Pending</option>-->
                                    <!--</select> &nbsp;-->
                                   
                                    <!--<input type="date" name="to_date" value="<?= $to_date ?>">&nbsp;-->
                                    <!--<input type="submit" class="btn btn-primary" value="Filter" />-->
                                </form>
                            </div>
                        </div>

<div class="clearfix"></div>
                        <div class="table-responsive row">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead class="thead-default thead-lg">
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Matka </th>
                                        <th>points</th>
                                        <th>Bet type</th>
                                        <!--<th>Date</th>-->
                                        <th>Date - Time</th>
                                        <th>Digits</th>
                                        <th>Game</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 0;
                                foreach($gamedata as $gamedatas):
                              
                                $i++;
                                $gm=$gamedatas->game_id;
                                $bid_amount += $gamedatas->points;
                                
                                  $gt=$this->db->select('game_id,points')->where('game_id',$gm)->
                                  get('tblgame')->result_array();
                                
                                  foreach($gt as $gtt)
                                  {
                                        $pot += $gtt['points']*$gamedatas->points;
                                  }
                                
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td>
                                            <?php
                                                $user = $this->Game->userbyid($gamedatas->user_id);
                                               $username = $user->name;
                                                
                                                
                                             ?>
                                         
                                             <form action="" method="get">
                                                 <input type="hidden" name="user_id" value="<?= $gamedatas->user_id ?>">
                                                 <input type="hidden" name="bettype" value="<?= $_GET['bettype'] ?>">
                                                 <input type="hidden" name="status" value="<?= $_GET['status'] ?>">
                                                 <input type="hidden" name="from_date" value="<?= $_GET['from_date'] ?>">
                                                 <input type="hidden" name="to_date" value="<?= $_GET['to_date'] ?>">
                                                 <input type="hidden" name="matka_id" value="<?= $_GET['matka_id'] ?>">
                                               <!--<a href="<?php echo base_url(); ?>UserDashboard/dashboard/<?php echo $gamedatas->user_id ?>/1"> <?= $username ?>  </a>-->
                                               <button class="btn-no" type="submit">  <a href="<?php echo base_url(); ?>UserDashboard/<?php echo $gamedatas->user_id ?>"> <?= $username ?></a></button>
                                             </form>
                                        
                                        </td>
                                        <td><?php
                                                $gamedata= $this->Game->matkabyid($gamedatas->matka_id);
                                            
                                                if($game_type=='starline')
                                                $matka_name=$gamedata->s_game_time; 
                                                else
                                                $matka_name=$gamedata->name; 
                                             ?>
                                              <form action="" method="get">
                                                  <input type="hidden" name="user_id" value="<?= $_GET['user_id'] ?>">
                                                 <input type="hidden" name="bettype" value="<?= $_GET['bettype'] ?>">
                                                 <input type="hidden" name="status" value="<?= $_GET['status'] ?>">
                                                 <input type="hidden" name="from_date" value="<?= $_GET['from_date'] ?>">
                                                 <input type="hidden" name="to_date" value="<?= $_GET['to_date'] ?>">
                                                 <input type="hidden" name="matka_id" value="<?= $gamedatas->matka_id ?>">
                                                 <button class="btn-no" type="submit"><?= $matka_name ?></button>
                                             </form>
                                        </td>
                                        <td><?= $gamedatas->points ?></td>
                                        <td><?= ($gamedatas->bet_type=='close')?'<h3 class="badge badge-danger">Closed</h3>':'<h3 class="badge badge-success">Open</h3>' ?></td>
                                        <!--<td><?= $gamedatas->date ?></td>-->
                                        <td><?= date('d/m/Y H:i:s',strtotime($gamedatas->time)) ?></td>
                                        <td><?= $gamedatas->digits ?></td>
                                        <td>
                                            <?php
                                            
                                            
                                                $game= $this->Game->gamebyid($gamedatas->game_id);
                                                echo $game->name;
                                             ?>
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
                                       <td>
                                           <?php
                                           if($status=='pending'){
                                             
                                          
                                           ?>
                                          
                                           <a class="btn btn-success" data-toggle="modal" data-target="#modaldemo<?=$gamedatas->id?>" >Edit</a>
                                           <?php }?>
                                           </td>


                                    </tr>
                                   
                                     <div id="modaldemo<?=$gamedatas->id?>" class="modal fade show" >
                                <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content bd-0 tx-14">
                                <div class="modal-header pd-y-20 pd-x-25">
                                  <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Update Bid</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                            
                                    <div class="modal-body card-body extra-details">
                                         <form  action="<?=base_url()?>Report/update_winning_prediction" method="post">
                                            <div class="form-group row">
                                                <input type="hidden" name="game_id_data"  value="<?=$gamedatas->id?>">
                                                     <input type="hidden" name="game_id"  value="<?=$gm?>">
                                                
                                                <label class="col-sm-2 col-form-label">Digit</label>
                                                <div class="col-sm-10">
                                                
                                                    <select id="digit" name="digit"  class="form-control selectpiker mb-2" style="width:100%" required>
                                                                <?php
                                                                if($gm==13){
                                                                  $game_number='all'; 
                                                                }
                                                                else{
                                                                    $game_number=$gm;
                                                                }
                                                                $rang= $this->Game_model->pana_digits($game_number);
                                                                foreach($rang as $row)
                                                                {
                                                                    // echo $game_number;
                                                                if($gm!=3){
                                                                $num=$row;
                                                                $prefix="0";
                                                                }else{
                                                                $num=($row>9)?$row:$prefix.$row;
                                                                }
                                                                 if($gm==12 || $gm==13){ 
                                                               $x= explode("-",$gamedatas->digits);
                                                               $digits=$x[0];
                                                                 }
                                                                 else{
                                                                   $digits= $gamedatas->digits; 
                                                                 }
                                                                ?>
                                                        <option value="<?=$num?>" <?= ($digits==$num)?"selected":"" ?>> <?=$num;?></option>
                                                     <?php }?>
                                            </select>
                                                    <!--<input type="text"  name="address" class="form-control"  value="<?=$gamedatas->digits?>">-->
                                                </div>
                                                <?php
                                                if($gm==12 || $gm==13){
                                                ?>
                                                <label class="col-sm-2 col-form-label">Close Digit</label>
                                                <div class="col-sm-10">
                                                    <select id="matka" name="close_digit"  class="form-control selectpiker mb-2" style="width:100%" required>
                                                                <?php
                                                                $rang= $this->Game_model->pana_digits('all');
                                                                foreach($rang as $row)
                                                                {
                                                                if($gm!=3){
                                                                $num=$row;
                                                                }else{
                                                                $num=($row>9)?$row:$prefix.$row;
                                                                }
                                                                if($gm==12 || $gm==13){ 
                                                               $x= explode("-",$gamedatas->digits);
                                                               $digits=$x[1];
                                                                 }
                                                                 else{
                                                                   $digits= $gamedatas->digits; 
                                                                 }
                                                                ?>
                                                        <option value="<?= $num ?>" <?= ($digits==$num)?"selected":"" ?>> <?= $num;?></option>
                                                     <?php }?>
                                            </select>
                                                    <!--<input type="text"  name="address" class="form-control"  value="<?=$gamedatas->digits?>">-->
                                                </div>
                                                <?php }?>
                                                
                                                
                                            </div>
                                             <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <button type="submit" name="update_data" class="btn btn-primary">Update</button>
                                                   
                                                </div>
                                            </div>
                                              </form>
                                            </div>
                                 
                                    </div>
                                   
                                </div>
                                
                                </div><!-- modal-dialog -->
                                </div>
                              
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                 
<div class="col-12">
<button class="btn btn-default">Total Bid Amount :  Rs. <?= isset($bid_amount)?$bid_amount:"0";?></button>
<button class="btn btn-default">Total Winning Amount : Rs. <?= isset($pot)?$pot:"0";?> </button>

</div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
          
           <script>
            if('<?= $bettype ?>'=='Close'){
                document.getElementById('type-bettype').click()
            }
            function selectpana(str)
            {
                //alert(str);
                // var id=str;
                // if(!v)
                // {
                // id = $('#close2').val();
                // }
                    if(str == 'Close')
                    {
                    document.getElementById('close').style.display='block';
                    //   document.getElementById('open').style.display='none';
                    }
                    if(str == 'Open')
                    {
                   document.getElementById('open').style.display='block';
                     document.getElementById('close').style.display='none';
                   }

            }
// function show_hide_data(val)
// {
// if(val!=""){
//   document.getElementById('OPENshow_hidetyle.display='block'; 
// }
// }
  </script>
<?php include(__DIR__.'/includes/footer.php')?>