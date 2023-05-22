<?php
    include ('includes/header.php');
    include ('includes/sidebar.php');
?>
<style>
    .search-field{
        width:80px;
    }
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    tfoot {
        display: table-row-group!important;
        vertical-align: middle!important;
        border-color: inherit!important;
    }
    
</style>
    <div class="content-wrapper">
      <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5"> </h4>
      </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">      
                    <h4 class="tx-gray-800 mg-b-5">Bid History List</h4> 
                </div>
                <div class="card-body">
                    <div class="pd-y-20 bd">
                        <div class="table-wrapper">
                            <div id="datatable1_wrapper" class="dataTables_wrapper no-footer" style="overflow-x: scroll!important;">
                                <table id="myTable" class="table-responsive table-bordered table display responsive nowrap dataTable no-footer dtr-inline" role="grid" aria-describedby="datatable1_info" >
                                    <thead>
                                         <tr>
                                                <th>Date</th><br>
                                                <th>User Name</th>
                                                <th>Game Name</th>
                                                <th>Game Type</th>
                                                <th>Session</th>
                                                <th>Open Pana</th>
                                                <th>Open Result</th>
                                                <th>Close Pana</th>
                                                <th>Close Result</th>
                                         </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="search">
                                                <th>Date</th><br>
                                                <th>User Name</th>
                                                <th>Game Name</th>
                                                <th>Game Type</th>
                                                <th>Session</th>
                                                <th>Open Pana</th>
                                                <th>Open Result</th>
                                                <th>Close Pana</th>
                                                <th>Close Result</th>
                                        </tr>
                                    </tfoot>
                                   <tbody>
                                        <!--<tr class="search">-->
                                        <!--    <th>Date</th><br>-->
                                        <!--    <th>User Name</th>-->
                                        <!--    <th>Game Name</th>-->
                                        <!--    <th>Game Type</th>-->
                                        <!--    <th>Session</th>-->
                                        <!--    <th>Open Pana</th>-->
                                        <!--    <th>Open Result</th>-->
                                        <!--    <th>Close Pana</th>-->
                                        <!--    <th>Close Result</th>-->
                                        <!--</tr>-->

                                       <!--seacrh row-->
                                       <!--<tr class="search">-->
                                       <!--     <td><input type="text" name="date_search" class="date_search form-control search-field" id="date_search" placeholder="search"></td>-->
                                       <!--     <td><input type="text" name="" id="txt_name" class="form-control search-field" id="" placeholder="search"></td>-->
                                       <!--     <td><input type="text" name="" class="form-control search-field" id="" placeholder="search"></td>-->
                                       <!--     <td><input type="text" name="" class="form-control search-field" id="" placeholder="search"></td>-->
                                       <!--     <td><input type="text" name="" class="form-control search-field" id="" placeholder="search"></td>-->
                                       <!--     <td><input type="text" name="" class="form-control search-field" id="" placeholder="search"></td>-->
                                       <!--     <td><input type="text" name="" class="form-control search-field" id="" placeholder="search"></td>-->
                                       <!--     <td><input type="text" name="" class="form-control search-field" id="" placeholder="search"></td>-->
                                       <!--     <td><input type="text" name="" class="form-control search-field" id="" placeholder="search"></td>-->
                                       <!-- </tr>-->
                                       <!--seacrh row-->
                                        <?php foreach($record as $r) { ?>
                                        <tr class="datafields">
                                           <td><?= $r->date; ?></td> 
                                           <td><?= $r->username; ?></td> 
                                           <td><?= $r->name; ?></td> 
                                           <td><?= $r->game_type; ?></td> 
                                           <td><?= $r->bet_type; ?></td> 
                                           <td><?= NA; ?></td> 
                                           <td><?php if($r->bet_type == open ){echo $r->digits;} else{echo NA;} ?></td> 
                                           <td><?= NA; ?></td> 
                                           <td><?php if($r->bet_type == close ){echo $r->digits;} else{echo NA;} ?></td> 
                                        </tr>
                                        
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </div>
    
<script>
    $(document).ready(function(){

    // Setup - add a text input to each footer cell
    $('#myTable tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });
 
    // DataTable
    var table = $('#myTable').DataTable({
        initComplete: function () {
            // Apply the search
            this.api()
                .columns()
                .every(function () {
                    var that = this;
 
                    $('input', this.footer()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
        },
    });

        
        // $('#myTable').DataTable();
        
    // var date = $('#select_date').val();
    // $('#datatable').DataTable({
    //         "processing": true,
    //         "serverSide": true,
    //         "ordering":false,
    //          "searching": true,
    //          'serverMethod': 'post',
    //     "ajax": {
    //         "url": "<?php echo base_url('admin/allbiddingreportdata/'); ?>",
    //         "type": "POST",
    //         "data": {"date":date},
    //     },
          
    //      "columns": [
    //          {data:"#"},
    //          {data: "date"}, 
    //          {data: "bidding_digit"}, 
    //          {data: "bidding_points"},
    //          {data: "winning_points"},
             
             
    //          ],
    //           "aLengthMenu": [
    //             [50, 100,],
    //             [50, 100,]
    //         ],
    //         "iDisplayLength": 50
    // });
  });
  
  
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
<?php include ('includes/footer.php');?>