<?php
include('includes/header.php');
include('includes/sidebar.php');
?>
<style>
   .heading-border{
   border: 2px dotted black;
   text-align: center;
   padding: 5px 0px;
   color: #9B5B82;
   font-weight: 600;
   margin-bottom: 10px;
   }
   .text-center th{
   text-align:center;
   }
   .text-center td{
   text-align:center;
   }
   .points {
   background: #F46A6A;
   color: white;
   border-radius: 5px;
   }
   .points-table .table{
   display: block;
   border:0px!important;
   overflow-x: scroll;
   }
   .points-custum-table tr{
   display:flex;
   }
   .points-custum-table td {
   width: 120px;
   display: inline-block;
   font-weight:600;
   }
   .custum-responsive{
   display: block;
   /*overflow-x: scroll;*/
   }
   .custum-responsive tr{
   /*display:block;*/
   /*display:flex;*/
   }
   /*.custum-responsive th {*/
   /*width: 120px;*/
   /*display: inline-block;*/
   /*font-weight:600;*/
   /*}*/
   .text-center th{
   text-align:center;
   }
   .points-custum-table>tbody>tr:nth-of-type(even){
   margin-bottom:20px;
   }
   /*scrollbar css*/
   .points-custum-table::-webkit-scrollbar {
   width: 10px;
   height:5px;
   }
   /* Track */
   .points-custum-table::-webkit-scrollbar-track {
   background: #f1f1f1;
   }
   /* Handle */
   .points-custum-table::-webkit-scrollbar-thumb {
   background: #888;
   }
   /* Handle on hover */
   .points-custum-table::-webkit-scrollbar-thumb:hover {
   background: #555;
   }
   .custum-responsive::-webkit-scrollbar {
   width: 10px;
   height:5px;
   }
   /* Track */
   .custum-responsive::-webkit-scrollbar-track {
   background: #f1f1f1;
   }
   /* Handle */
   .custum-responsive::-webkit-scrollbar-thumb {
   background: #888;
   }
   /* Handle on hover */
   .custum-responsive::-webkit-scrollbar-thumb:hover {
   background: #555;
   }
   /*scrollbar css*/
   /*css added by 10/06*/
   .break-table{
           box-sizing: initial;
   }
.custum-responsive th {
        /*width: 8.139%;*/
        width: 72px;
  display: inline-block;
   font-weight:600;
   padding:0px!important;
   margin-bottom:15px;
   border-left:0px!important;
   border-color:black!important;
   }
   .custum-responsive .border-left-1{
    border-left: 1px solid black!important;
   }
   .break-table .digit{
       text-align:center;
       padding:8px 10px;
        border-bottom: 1px solid black;
        border-top: 1px solid black;
   }
   .break-table .point{
       text-align:center;
        padding:8px 10px;
   }
   .break-table table{
       border:0px!important;
   }
   /*css added by 10/06*/
</style>
<div class="content-wrapper">
   <div class="pd-30">
      <h4 class="tx-gray-800 mg-b-5"> </h4>
   </div>
   <div class="container-fluid">
      <div class="card">
         <div class="card-header">
            <h4 class="tx-gray-800 mg-b-5">Customer Sale Report</h4>
         </div>
         <div class="card-body">
            <div class="pd-y-20 bd">
               <form method="post" action="customer_sale_report" id="biddingform">
                  <div class="col-md-12">
                     <div class="row">
                        <?php $curr_date = date('Y-m-d') ?>
                        <div class="col-md-3">
                           <label>Game Name</label>
                           <br>
                           <select id="matka" name="matka" class="form-control">
                              <?php foreach ($matka as $m): ?>
                                 <option value="<?php echo $m->id ?>" <?php echo ($select_matka == $m->id) ? "selected" : "" ?>><?php echo $m->name; ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="col-md-3">
                           <label>Game Type</label>
                           <br>
                           <select id="game" name="game" class="form-control">
                              <?php foreach ($games as $g): ?>
                                 <option value="<?php echo $g->game_id ?>" <?php echo ($select_game == $g->game_id) ? "selected" : "" ?>><?php echo $g->name; ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                        <div class="col-md-3">
                           <label>Game Session</label>
                           <br>
                           <select id="session" name="session" class="form-control">
                              <option value="open" <?php echo ($select_session == "open") ? "selected" : "" ?>>Open</option>
                              <option value="close" <?php echo ($select_session == "close") ? "selected" : "" ?>>Close</option>
                           </select>
                        </div>
                        <div class="col-md-3">
                           <label>Date</label>
                           <br>
                           <input type="date" id="select_date" required name="select_date" <?php echo ($select_date != "") ? 'value=' . $select_date : 'value=' . $curr_date ?> class="form-control" max="<?= $curr_date; ?>">
                        </div>
                        <div class="col-md-12 text-center">
                           <input type="button" class="btn btn-danger mt-2" name="calcel" value="Cancel" onClick="window.location.reload();">
                           <input type="submit"  class="btn btn-secondary mt-2" id="sbmt_btn" name="sbmt_btn" value="Submit">
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <br>
            <?php
            $sd_arr = array(); foreach ($single_digit as $sd) {
               array_push($sd_arr, $sd->digits);
            }
            // print_r($sd_arr);
            
            $jd_arr = array();
            foreach ($jodi_digit as $jd) {
               array_push($jd_arr, $jd->digits);
            }
            // print_r($jd_arr);
            $sp_arr = array();
            foreach ($single_pana as $sp) {
               array_push($sp_arr, $sp->digits);
            }
            // print_r($sp_arr);
            $dp_arr = array();
            foreach ($double_pana as $dp) {
               array_push($dp_arr, $dp->digits);
            }
            // print_r($dp_arr);
            $tp_arr = array();
            foreach ($triple_pana as $tp) {
               array_push($tp_arr, $tp->digits);
            }
            // print_r($tp_arr);
            ?>
            <!--pana logic start-->
            <?php
            function check($str)
            {
               $my_array = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
               $arr = explode(",", $str);

               if (array_search($arr[0], $my_array) <= array_search($arr[1], $my_array)) {

                  if (array_search($arr[1], $my_array) <= array_search($arr[2], $my_array)) {

                     if (array_search($arr[0], $my_array) <= array_search($arr[2], $my_array)) {


                        return $arr;
                     } else {
                        return false;
                     }
                  } else {
                     return false;
                  }
               } else {
                  return false;
               }

            }
            $str = "";
            $single_pana_array = array();
            $double_pana_array = array();
            $triple_pana_array = array();
            for ($i = 0; $i <= 9; $i++) {
               for ($j = 0; $j <= 9; $j++) {
                  for ($k = 0; $k <= 9; $k++) {
                     $str = $i . ',' . $j . ',' . $k;

                     $abc = check($str);
                     // echo '<pre>';
            
                     if (
                        ($abc[0] != $abc[1]) && ($abc[1] != $abc[2])
                        && ($abc[0] != $abc[2])
                     ) {
                        $single_pana_array[] = $abc;
                     }
                     if (
                        (($abc[0] == $abc[1]) && ($abc[1] != $abc[2]) && ($abc[0] != $abc[2])) ||
                        (($abc[0] == $abc[2]) && ($abc[0] != $abc[1]) && ($abc[1] != $abc[2])) ||
                        (($abc[1] == $abc[2]) && ($abc[0] != $abc[1]) && ($abc[0] != $abc[2]))
                     ) {
                        $double_pana_array[] = $abc;
                     }
                     if (
                        ($abc[0] == $abc[1]) && ($abc[1] == $abc[2])
                        && ($abc[0] == $abc[2])
                     ) {
                        if (!empty($abc)) {
                           $triple_pana_array[] = $abc;
                        }
                     }

                  }
               }
            }
            ?> 
            <!--pana logic end-->
            <?php if (isset($single_digit) && $single_digit != "") { ?>
               <h4 class="heading-border">Single Digit</h4>
               <div class="table-responsive">
                  <table class="table table-bordered text-center">
                     <thead>
                        <tr>
                           <th>Digit</th>
                           <?php
                           $single_digit_array = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                           foreach ($single_digit_array as $sda) { ?>
                              <th scope="col"><?= $sda; ?></th>
                           <?php } ?>
                        </tr>
                     </thead>
                     <tbody>
                        <th>Point</th>
                        <?php foreach ($single_digit_array as $sda) {
                           if (in_array($sda, $sd_arr)) {
                              foreach ($single_digit as $sdrr) {
                                 if ($sda == $sdrr->digits) { ?>
                                    <th scope="col">
                                       <div class="points"><?= $sdrr->points; ?></div>
                                    </th>
                                 <?php }
                              }
                           } else { ?>
                              <th scope="col">
                                 <div class="points"><?= 0; ?></div>
                              </th>
                           <?php } ?>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            <?php } ?>
            <?php if (isset($jodi_digit) && $jodi_digit != "") { ?>
               <h4 class="heading-border">Jodi Digit</h4>
               <div class="break-table" >
                  <table class="table table-bordered custum-responsive">
                     <thead>
                        <tr>
                           <th class="border-left-1">
                                <div class="digit"> Digit</div>
                               <div class="point">Point</div>
                           </th>
                           <!--digit point section-->
                           <?php
                           $jodi_digit_array = array();
                           for ($i = 0; $i < 10; $i++) {
                              for ($j = 0; $j < 10; $j++) {
                                 $jodi_digit_formation = $i . $j;
                                 array_push($jodi_digit_array, $jodi_digit_formation);
                                 ?>
                                 <th>
                                     <div class="digit"><?= $jodi_digit_formation; ?></div>
                                     <div class="point">
                                         <!--point button-->
                                        <div class="points">0</div>
                                          <!--point button-->
                                     </div>
                                 </th>
                                 <?php
                              }
                           } ?>
                              <!--digit point section-->
                        </tr>
                     </thead>
                 
                  </table>
                
                  <table class="table table-bordered custum-responsive text-center d-none">
                     <thead>
                        <tr>
                           <th>Digit</th>
                           <?php
                           $jodi_digit_array = array();
                           for ($i = 0; $i < 10; $i++) {
                              for ($j = 0; $j < 10; $j++) {
                                 $jodi_digit_formation = $i . $j;
                                 array_push($jodi_digit_array, $jodi_digit_formation);
                                 ?>
                                 <th scope="col"><?= $jodi_digit_formation; ?></th>
                                 <?php
                              }
                           } ?>
                        </tr>
                     </thead>
                     <tbody>
                        <th>Point</th>
                        <?php foreach ($jodi_digit_array as $jda) {
                           if (in_array($jda, $jd_arr)) {

                              foreach ($jodi_digit as $jdrr) {

                                 if ($jda == $jdrr->digits) { ?>
                                    <th scope="col">
                                       <div class="points"><?= $jdrr->points; ?></div>
                                    </th>
                                 <?php }
                              }
                           } else { ?>
                              <th scope="col">
                                 <div class="points"><?= 0; ?></div>
                              </th>
                           <?php } ?>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            <?php } ?>
            <?php if (isset($single_pana) && $single_pana != "") { ?>
               <h4 class="heading-border d-none">Single Pana</h4>
               <div class="table-responsive d-none" >
                  <table class="table table-bordered custum-responsive text-center">
                     <thead>
                        <tr>
                           <th>Digit</th>
                           <?php foreach ($single_pana_array as $spa) {
                              $digit = implode("", $spa); ?>
                              <th scope="col"><?= $digit; ?></th>
                           <?php } ?>
                        </tr>
                     </thead>
                     <tbody>
                        <th>Point</th>
                        <?php foreach ($single_pana_array as $spa) {
                           $digit = implode("", $spa);

                           if (in_array($digit, $sp_arr)) {

                              foreach ($single_pana as $sprr) {

                                 if ($digit == $sprr->digits) { ?>
                                    <th scope="col">
                                       <div class="points"><?= $sprr->points; ?></div>
                                    </th>
                                 <?php }
                              }
                           } else { ?>
                              <th scope="col">
                                 <div class="points"><?= 0; ?></div>
                              </th>
                           <?php } ?>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            <?php } ?>
            <?php if (isset($double_pana) && $double_pana != "") { ?>
               <h4 class="heading-border d-none">Double Pana</h4>
               <div class="table-responsive d-none" >
                  <table class="table table-bordered custum-responsive text-center">
                     <thead>
                        <tr>
                           <th>Digit</th>
                           <?php foreach ($double_pana_array as $dpa) {
                              $digit = implode("", $dpa); ?>
                              <th scope="col"><?= $digit; ?></th>
                           <?php } ?>
                        </tr>
                     </thead>
                     <tbody>
                        <th>Point</th>
                        <?php foreach ($double_pana_array as $dpa) {
                           $digit = implode("", $dpa);

                           if (in_array($digit, $dp_arr)) {

                              foreach ($double_pana as $dprr) {

                                 if ($digit == $dprr->digits) { ?>
                                    <th scope="col">
                                       <div class="points"><?= $dprr->points; ?></div>
                                    </th>
                                 <?php }
                              }
                           } else { ?>
                              <th scope="col">
                                 <div class="points"><?= 0; ?></div>
                              </th>
                           <?php } ?>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            <?php } ?>
            <?php if (isset($triple_pana) && $triple_pana != "") { ?>
               <h4 class="heading-border d-none">Triple Pana</h4>
               <div class="table-responsive d-none" >
                  <table class="table table-bordered custum-responsive text-center">
                     <thead>
                        <tr>
                           <th>Digit</th>
                           <?php foreach ($triple_pana_array as $tpa) {
                              $digit = implode("", $tpa); ?>
                              <th scope="col"><?= $digit; ?></th>
                           <?php } ?>
                        </tr>
                     </thead>
                     <tbody>
                        <th>Point</th>
                        <?php foreach ($triple_pana_array as $tpa) {
                           $digit = implode("", $tpa);

                           if (in_array($digit, $tp_arr)) {

                              foreach ($triple_pana as $tprr) {

                                 if ($digit == $tprr->digits) { ?>
                                    <th scope="col">
                                       <div class="points"><?= $tprr->points; ?></div>
                                    </th>
                                 <?php }
                              }
                           } else { ?>
                              <th scope="col">
                                 <div class="points"><?= 0; ?></div>
                              </th>
                           <?php } ?>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            <?php } ?>
         </div>
      </div>
   </div>
</div>
<script>
   //     $(document).ready(function(){
   //     var date = $('#select_date').val();
   //     $('#datatable').DataTable({
   //             "processing": true,
   //             "serverSide": true,
   //             "ordering":false,
   //              "searching": true,
   //              'serverMethod': 'post',
   //         "ajax": {
   //             "url": "<?php echo base_url('admin/allbiddingreportdata/'); ?>",
   //             "type": "POST",
   //             "data": {"date":date},
   //         },
             
   //          "columns": [
   //              {data:"#"},
   //              {data: "date"}, 
   //              {data: "bidding_digit"}, 
   //              {data: "bidding_points"},
   //              {data: "winning_points"},
                
                
   //              ],
   //               "aLengthMenu": [
   //                 [50, 100,],
   //                 [50, 100,]
   //             ],
   //             "iDisplayLength": 50
   //     });
   //   });
     
     
   //   //get filtered data
   
   
   //     function yourJsFunction(){
   //     var date = $('#select_date').val();
   //     var matka = $('#matka').val();
   //     var game = $('#game').val();
   //     var session = $('#session').val();
   //     $('#datatable').html('');
   //     // alert(date);alert(matka);alert(game);alert(session);
   //     $('#datatable').DataTable({
   //              "destroy": true,
   //             "processing": true,
   //             "serverSide": true,
   //             "ordering":false,
   //              "searching": true,
   //              'serverMethod': 'post',
   //         "ajax": {
   //             "url": "<?php echo base_url('admin/allbiddingreportdata/'); ?>",
   //             "type": "POST",
   //             "data": {"sbmt_btn":1,"date":date,"matka":matka,"game":game,"session":session},
   //         },
             
   //          "columns": [
   //              {data:"#"},
   //              {data: "date"}, 
   //              {data: "bidding_digit"}, 
   //              {data: "bidding_points"},
   //              {data: "winning_points"},
                
                
   //              ],
   //               "aLengthMenu": [
   //                 [50, 100,],
   //                 [50, 100,]
   //             ],
   //             "iDisplayLength": 50
   //     });
   //   }
     
     
</script>
<?php include('includes/footer.php'); ?>