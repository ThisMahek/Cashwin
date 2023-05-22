

 

<div class="br-mainpanel">
      <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5"> </h4>
      </div>
    <div class="container-fluid">
    <div class="card">
    <div class="card-header">      
    <h4 class="tx-gray-800 mg-b-5"> <?= $title ?></h4> </div>
    <div class="card-body">
    <div class="pd-y-20 bd">
    <div class="row">
        <div class="col-md-6">
            <form method="post" id="form_submit" action="market_profit_loss">
       <div class="col-md-12">
           <div class="row">
               <?php $curr_date=date('Y-m-d') ?>
               <!--<div class="col-md-4">-->
               <!--    <label>Start Date</label>-->
               <!--    <br>-->
               <!--    <input type="date" name="start_date" <?php echo ($select_date!="")?'value='.$select_date:'value='.$curr_date ?> class="form-control">-->
               <!--</div>-->
               <div class="col-md-6">
                   <label>Player Name</label>
                    <br>
                    <input type="text" required class="form-control" name="player_name" id="player_name" value="<?php if($select_user!= ''){ echo $select_user;} else {  } ?>" placeholder="Type Username" >
                    <div class="list-group" id="userdata">
                        
                    </div>
               </div>
               <div class="col-md-6">
                   <label>Market</label>
                    <br>
                   <select name="matka" class="form-control" id="matka">
                       <?php foreach($matka as $m): ?>
                       <option value="<?php echo $m->id ?>" <?php echo ($select_matka==$m->id)?"selected":""?>><?php echo $m->name;?></option>
                       <?php endforeach; ?>
                   </select>
               </div>
               
               <!--<div class="col-md-4">-->
               <!--    <label>Game Session</label>-->
               <!--     <br>-->
               <!--    <select name="session" class="form-control">-->
               <!--        <option value="all" <?php echo ($select_session=="all")?"selected":"" ?>>All</option>-->
               <!--        <option value="open" <?php echo ($select_session=="open")?"selected":"" ?>>Open</option>-->
               <!--        <option value="close" <?php echo ($select_session=="close")?"selected":"" ?>>Close</option>-->
               <!--    </select>-->
               <!--</div>-->
               
           </div>
           <div class="row text-center">
               <div class="col-6" style="margin-top:10px;">
                <input type="hidden" class="form-control" name="hide_player_id" id="hide_player_id" value="" >
                <input type="submit" class="form-control btb btn-success mb-2" id="sbmtbtn" name="prof_loss" value="Submit">
               </div>
           </div>
       </div> 
    </form> 
        </div>
        <div class="col-md-6">
            <?php //print_r($game_bids); ?>
            <table class="table table-striped table-bordered">
                <thead class="bg-primary" style="color:white!important">
                    <tr class="text-white" >
                        <th class="text-white" >#</th>
                        <th class="text-white" >Type</th>
                        <th class="text-white" >bid</th>
                        <th class="text-white" >Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(empty($game_bids)){
                        $n=1;
                        foreach($games as $g): ?>
                        <tr>
                            <td><?php echo $n; ?></td>
                            <td><?php echo $g->name; ?></td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <?php $n++;
                        endforeach; 
                        ?>
                        <tr class="bg-secondary">
                        <td  class="text-white" colspan="2">Grand total</td>
                        <td class="text-white" >0</td>
                        <td class="text-white" >0</td>
                        
                    </tr>
                    <?php
                    }
                    else{
                        $n=1;
                        $tot_bids = $tot_amt = 0;
                        foreach($game_bids as $gb): 
                        $tot_bids = $tot_bids+$gb->amt;
                        $tot_amt = $tot_amt+($gb->amt*$gb->starline_points);
                        ?>
                        <tr>
                            <td><?php echo $n; ?></td>
                            <td><?php echo $gb->name; ?></td>
                            <td><?php echo $gb->amt; ?></td>
                            <td><?php echo ($gb->amt*$gb->starline_points) ?></td>
                        </tr>
                        <?php $n++;
                        endforeach;
                        ?>
                        <tr class="bg-secondary">
                            <td  class="text-white" colspan="2">Grand total</td>
                            <td class="text-white" ><?php echo $tot_bids ?></td>
                            <td class="text-white" ><?php echo $tot_amt ?></td>
                        </tr>
                    <?php
                    }?>
                    
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <?php  {
    ?>
    <div class="card-body">
        
        <!--<h4 class="tx-gray-800 mg-b-5"> Total Amount Bidded : -->
        <?php 
        $tot = 0;
        foreach($record as $rs):
            $tot += $rs->amt;
        endforeach;
        // echo $tot;
        ?>
        <!--</h4>-->
        <?php
        foreach($game_bids as $gbid): 
        ?>
            <table class=" datatable11 table-bordered table-responsive table display responsive nowrap dataTable no-footer dtr-inline" role="grid" aria-describedby="datatable1_info" style="width:100% !important;">
            <!--<h4><?php echo $gbid->name ?></h4>-->
            <thead>
                <!--<th>Digits</th>-->
                <!--<th>Game ID</th>-->
                <!--<th>Total Bids</th>-->
                <!--<th>Amount To Pay</th>-->
                <!--<th>Profit</th>-->
                <!--<th>Loss</th>-->
                <th  >Sr.</th>
                <th >Bracket</th>
                <th >Amount</th>
                <th >Provider</th>
                <th >Type</th>
                <th >Session</th>
                <th >Game Date</th>
                <th >Played On</th>
                <th >Win Status</th>
            </thead>
            <tbody>
                <?php
                $sr = 1;
                foreach($record as $r): 
                if($gbid->game_id!=$r->game_id){
                    continue;
                }            
                $pro_loss= $tot - ($r->amt*$r->p);
                $profit=0;
                $loss=0;
                if($pro_loss>0){
                    $profit=$pro_loss;
                }
                else if($pro_loss<0){
                  $loss = $pro_loss;
                }
                ?>
                <tr>
                    <td><?php echo $sr ?></td>
                    <td><?php echo $r->digits ?></td>
                    <td><?php echo ($r->amt*$r->p) ?></td>
                    <td><?php echo marketname($r->matka_id)?></td>
                    <td><?php echo ucwords(gamebyid($r->game_id)) ?></td>
                    <td><?php echo ucfirst($r->bet_type) ?></td>
                    <td><?php echo date('d/m/Y',strtotime($r->date)); ?></td>
                    <td><?php echo date('d/m/y H:i:s A',strtotime($r->time)) ?></td>
                    <td><?php echo ucfirst($r->status) ?></td>
                    
                </tr>
                
                <?php 
                $sr = $sr+1;
                endforeach; ?>
            </tbody>
        </table>
        <hr>
        <?php endforeach;?>
    </div>
    <?php } ?>
    </div>
    </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        
        //get user on typing in inputbox
        $('#player_name').on('input',function(){
         var name = $('#player_name').val();
         $('#datatable').html('');
         $('#hide_player_id').val('');
         
         if(name != '')
         {
          $.ajax({
           url:"<?php echo base_url(); ?>admin/get_user_name",
           method:"POST",
           dataType:'json',
           data:{searchvalue:name},
           success:function(record)
           {
                // console.log(record);
                $('#userdata').html('');
                $.each(record.record, function (key, val) {
                    // console.log(val.name);
                    $('#userdata').append('<button type="button" class="list-group-item list-group-item-action" data-id="'+val.id+'">'+val.name+'</button>');
                });
           }
          });
         }
         else
         {
          $('#userdata').html('');
         }
        });
    })
    
    $(document).on('click','button',function(){
        var player_id=$(this).data('id');
        var player_name=$(this).text();
        
        $('#player_name').val();
        $('#player_name').val(player_name);
        $('#hide_player_id').val(player_id);
        $('#userdata').html('');
        
        var sdate = $('#start_date').val();
        var edate = $('#end_date').val();
        var matka = $('#matka').val();
        
        $('#datatable').html('');

            
    });
    
    // $(document).on('click','input[id="sbmtbtn"]',function(){
        
    //     var player_name = $('#player_name').val();
    //     // alert(player_name);
    //     if(player_name == ''){
           
    //       $("form").submit(function(e){
    //             e.preventDefault();
    //         });
    //     }
    //     else{
             
    //         $('#form_submit').submit();
    //     }
    // })
</script>
