<?php
include('includes/header.php');
include('includes/sidebar.php');
?>


<style>
.text-muted{
   text-transform:uppercase!important; 
}


</style>
  <div class="content-wrapper">
       <div class="page-heading">
                <h1 class="page-title">Dashboard</h1>
               
                <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
                <!--  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>-->
                <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
                <!-- <select class="js-example-basic-multiple" name="states[]">-->
                <!--  <option value="AL">Alabama</option>-->
                <!--    ...-->
                <!--  <option value="WY">Wyoming</option>-->
                <!--</select>-->
                <script>
                    // $(document).ready(function() {
                    //     $('.js-example-basic-multiple').select2();
                    // });
                </script>
            </div>
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="row mb-2">

                    <div class="col-lg-4 col-md-4 col-4 padding_right">
                            <div class="card mb-4 card_back">
                            <div class="card-body flexbox-b">
                                <div class="easypie" data-percent="50" data-bar-color="#5c6bc0" data-size="90" data-line-width="10">
                                    <span class="easypie-data text-white icon" style="font-size:32px;"><i class="ti-layout-media-left-alt"></i></span>
                                </div>
                                <div><a href="<?php echo base_url() ?>admin/view_users">
                                    <h3 class="font-strong text-white font_s"><?= $total_users ?></h3>
                                    <div class="text-white font_s">Total User </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4 padding_right">
                            <div class="card mb-4 card_back1">
                            <div class="card-body flexbox-b">
                                <div class="easypie" data-percent="50" data-bar-color="#5c6bc0" data-size="90" data-line-width="10">
                                    <span class="easypie-data text-white icon" style="font-size:32px;"><i class="sidebar-item-icon ti-list"></i></span>
                                </div>
                                <div><a href="<?php echo base_url() ?>admin/matka/list">
                                    <h3 class="font-strong text-white font_s">
                                    <?php
                                    echo count($all_matkas);
                                    ?>
                                </h3>
                                    <div class="text-white font_s">Total Markets</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4 padding_right">
                            <div class="card mb-4 card_back2">
                            <div class="card-body flexbox-b">
                                <div class="easypie" data-percent="50" data-bar-color="#5c6bc0" data-size="90" data-line-width="10">
                                    <span class="easypie-data text-white icon" style="font-size:32px;"><i class="sidebar-item-icon ti-list"></i></span>
                                </div>
                                <div>
                                    <h3 class="font-strong text-white font_s"><?php echo isset($total_bid_amount['bid_amt']) ? $total_bid_amount['bid_amt'] : 0 ?><span style="font-size: 12px;"></span></h3>
                                    <div class="text-white font_s">Total Bid Amount</div>
                                </div>
                            </div>
                        </div>
                    </div>

            <!----        <div class="col-lg-4 col-md-6">
                            <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="50" data-bar-color="#5c6bc0" data-size="90" data-line-width="10">
                                    <span class="easypie-data text-primary" style="font-size:32px;"><i class="sidebar-item-icon ti-list"></i>
                                </div>
                                <div>
                                    <h3 class="font-strong text-primary">
                                    <?php
                                    $with_points = $this->Administrator_Model->totalwithdrawpoint();
                                    $sum = 0;
                                    $t = date('Y-m');

                                    foreach ($with_points as $p) {
                                        $month = explode("-", $p['time']);
                                        $cur_month = $month[0] . "-" . $month[1];
                                        if ($cur_month == $t)
                                            $sum = $sum + $p['request_points'];
                                    }
                                    echo $sum * (-1);
                                    ?>
                                  </h3>
                                    <div class="text-muted">Current Month Withdrawal</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                        <div class="col-lg-4 col-md-6">
                            <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="50" data-bar-color="#5c6bc0" data-size="90" data-line-width="10">
                                    <span class="easypie-data text-primary" style="font-size:32px;"><i class="sidebar-item-icon ti-list"></i>
                                </div>
                                <div>
                                    <h3 class="font-strong text-primary">
                                    <?php
                                    $add_points = $this->Administrator_Model->totaladdpoint();
                                    $sum = 0;
                                    $t = date('Y-m');

                                    foreach ($add_points as $p) {
                                        $month = explode("-", $p['time']);
                                        $cur_month = $month[0] . "-" . $month[1];
                                        if ($cur_month == $t)
                                            $sum = $sum + $p['request_points'];
                                    }
                                    echo $sum;
                                    ?>
                                  </h3>
                                    <div class="text-muted">Current Month cREDIT</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                            <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="50" data-bar-color="#5c6bc0" data-size="90" data-line-width="10">
                                    <span class="easypie-data text-primary" style="font-size:32px;"><i class="sidebar-item-icon ti-list"></i>
                                </div>
                                <div>
                                    <h3 class="font-strong text-primary">
                                        <?php echo $this->Administrator_Model->point_req_count()->withdrawal ?><span style="font-size: 12px;"> (Withdraw)</span>
                                        <?php echo $this->Administrator_Model->point_req_count()->deposit ?><span style="font-size: 12px;"> (Add)</span>
                                    </h3>
                                    <div class="text-muted">POINT REQUESTS(Pending)</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="50" data-bar-color="#5c6bc0" data-size="90" data-line-width="10">
                                    <span class="easypie-data text-primary" style="font-size:32px;"><i class="la la-money"></i></span>
                                </div>
                                <div>
                                    <h3 class="font-strong text-primary"><?php echo count($matkas) ?></h3>
                                    <div class="text-muted">LIVE UPDATES</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="70" data-bar-color="#ff4081" data-size="80" data-line-width="8">
                                    <span class="easypie-data text-primary" style="font-size:32px;"><i class="la la-users"></i></span>
                                </div>
                                <div>
                                    <h3 class="font-strong text-primary"><?php echo $users ?></h3>
                                    <div class="text-muted">TOTAL USERS</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="70" data-bar-color="#ff4081" data-size="80" data-line-width="8">
                                    <span class="easypie-data text-primary" style="font-size:32px;"><i class="la la-users"></i></span>
                                </div>
                                <div>
                                    <h3 class="font-strong text-primary"><?php echo $total_wallet_amt ?></h3>
                                    <div class="text-muted">TOTAL Wallet Amount</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
                
                
                   <!--<div class="col-lg-6 col-md-6 col-7 padding_right">-->
                   <!--   <div class="card card_amount">-->
                   <!--       <div class="padding_sp">-->
                   <!--         <h5 class="card-title card_tit">Market Bid Details</h5>-->
                   <!--         <form method="post" action="" >-->
                   <!--             <select class="form_select mb-3" name="market_id" aria-label=".form-select-lg example">-->
                   <!--               <option value="">All market</option>-->
                   <!--               <?php foreach ($all_matkas as $ma): ?>-->
                       <!--                 <option value="<?= $ma['id'] ?>" <?php echo ($ma['id'] == $selected_matka_id) ? "selected" : "" ?>><?= $ma['name'] ?></option>-->
                       <!--               <?php endforeach; ?>-->
                   <!--             </select>-->
                   <!--             <button class="btn btn-success submit_mobile" name="market_sbmt">Submit</button>-->
                   <!--         </form>-->
                   <!--       </div>-->
                   <!--     </div>-->
                   <!-- </div>-->
                   
                   <div class="col-lg-6 col-md-6 col-7 padding_right">
                         <div class="card card_amount">
                          <div class="padding_sp">
                            <h5 class="card-title card_tit">Market Bid Details</h5>
                               <div class="row">
                           <div class="col-lg-8 col-md-8">
                                <div class="parent">
                                      <select name="select" id="select" class="form-control selectpiker" style="width:100%">
                                           <option value="">All market</option>
                                          <?php foreach ($all_matkas as $ma): ?>
                                                <option value="<?= $ma['id'] ?>" <?php echo ($ma['id'] == $selected_matka_id) ? "selected" : "" ?>><?= $ma['name'] ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                    </div>
                           </div>
                                    <div class="col-lg-4 col-md-4">
                                       <button class="btn btn-success submit_mobile" name="market_sbmt">Submit</button>
                                   </div>
                               </div>
                            </div>
                           </div>
                       </div>
                   
                    
                    <div class="col-lg-6 col-md-6 col-5 padding_right">
                            <div class="card mb-3 card_back2">
                            <div class="card-body text-center padding_sp">
                                <div class="text-white"><?php echo isset($market_amount['0']['matka_bid_amt']) ? $market_amount['0']['matka_bid_amt'] : "0" ?></div>
                                 <p class="text-white">Market Amount</p>
                            </div>
                        </div>
                    </div>
                
               
             </div>
       
       
       <!------------------------un approved user list ------------------->
                   
      <div class="page-content fade-in-up padding_content">
                <div class="ibox">
                    <div class="ibox-body pb-0">
                        
                       <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-6">
                          <h5 class="font-strong mb-4">Un Approved Users List</h5></div>
                         
                       </div>
                            <div class="card-body flex_card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="myTable">
                                        <thead class="thead-default thead-lg">
                                            <tr>
                                                <th>#</th>
                                                <th>User Name</th>
                                                <th>Mobile </th>
                                                <th>Email</th>
                                                <th>Creation Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1; foreach ($users as $post): ?>
                                            <tr>
                                               <td><?php echo $i; ?></td>
                                               <td><?php echo $post['username']; ?></td>
                                               <td><?php echo $post['mobileno']; ?></td>
                                               <td><?php echo $post['email']; ?></td>
                                               <td><?php echo date('d/m/Y h:i:s A', strtotime($post['time'])); ?></td>
                                               <td>
                                                    <?php echo ($post['bank_status'] == 1) ? "Allowed" : "Blocked" ?>
                                                </td>
                                                <td>
                                                    <?php if ($post['bank_status'] == 0): ?>
                                                    <button class="btn-sm btn-primary" onclick="userbank_allow(<?= $post['id'] ?>)">Allow</button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php $i++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                              
                        
                    </div>
                </div>
            </div>
            
            
            
               <!------------------------Result Declaration ------------------->
               
               <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body pb-0">
                        
                       <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-6">
                          <h5 class="font-strong mb-4">Result Declartion</h5></div>
                          <div class="col-md-6">
                          </div>
                       </div>
                         <div class="row">
                            <!-- <div class="col-md-3 col-8">-->
                            <!--    <div class="flexbox mb-4">-->
                            <!--        <div class="input-group-icon input-group-icon-left mr-3">-->
                            <!--            <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>-->
                            <!--            <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--    <div class="col-md-2 col-4">-->
                            <!--        <button class="btn btn-primary form-control-rounded"  type="submit" style="margin-left:5px;"> Search</button>-->
                            <!--    </div>-->
                            <!--</div>-->
                         <div class="card-body flex_card">
                                        <div class="table-responsive row">
                                            <table class="table table-bordered table-hover" id="datatable">
                                                <thead class="thead-default thead-lg">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Games Name</th>
                                                        <th>Open time</th>
                                                        <th>Close time</th>
                                                        <th>Open Result</th>
                                                        <th>Close Result</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($mumbai_matkas as $m): ?>
                                                            <tr>
                                                                <td><?php echo $m['id']; ?></td>
                                                           
                                                                <td><?php echo $m['name']; ?></td>
                                                                <td><?php echo date("h:i A", strtotime($m['bid_start_time'])); ?></td>
                                                                <td><?php echo date("h:i A", strtotime($m['bid_end_time'])); ?></td>
                                                                <td><?php echo $m['starting_num'] . "-" . substr($m['number'], 0, 1); ?></td>
                                                                <td><?php echo substr($m['number'], -1, 1) . "-" . $m['end_num'];
                                                                ; ?></td>
                                                            
                                                            </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                         </div>
                    </div>
                </div>
            </div>
            
            
                           <!------------------------Fund Request Auto Deposit ------------------->
               
               <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body pb-0">
                        
                       <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-6">
                          <h5 class="font-strong mb-4">Fund Request Auto Deposit</h5></div>
                          <div class="col-md-6">
                          </div>
                       </div>
                         <div class="card-body flex_card">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="myTable2">
                                                <thead class="thead-default thead-lg">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>User  Name</th>
                                                        <th>Amount</th>
                                                        <th>Request No</th>
                                                        <th>Txn Id</th>
                                                        <th>Reject Remark</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0; foreach ($pending_req as $post):
                                                        $i++; ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo fullNamewithMob($post['user_id']); ?></a></td>
                                                            <td><?php echo $post['request_points']; ?></td>
                                                            <td><?php echo $post['request_id'] ?></td>
                                                            <td><?php echo isset($post['txn_id']) ? $post['txn_id'] : "-"; ?></td>
                                                            <td><?php echo isset($post['remark']) ? $post['remark'] : "-"; ?></td>
                                                            <td><?php echo $post['time']; ?></td>
                                                            <td><?= ($post['request_status'] == "cancel") ? "Cancelled" : $post['request_status']; ?></td>
                                                            <td>
                                                                <?php if ($post['request_status'] == "pending") { ?>
                                                                    <!--<a href='<?php echo base_url(); ?>admin/add_point_req2/<?php echo $post['request_id']; ?>'>-->
                                                                                <a class="btn btn-success btn-sm" data-toggle="modal" href="#approveModal<?php echo $post['request_id']; ?>">Apporve</a>
                                                                            <!--<a href='<?php echo base_url(); ?>admin/add_point_req_cancel/<?php echo $post['request_id']; ?>'>-->
                                                                                <a class="btn btn-danger btn-sm" data-toggle="modal" href="#cancelModal<?php echo $post['request_id']; ?>">Cancel</a>
                                                                    <?php } else { ?>
                                                                        <span data-toggle="modal" data-target="#viewModal<?php echo $post['request_id']; ?>">
                                                                        <?php if ($post['request_status'] == "cancel")
                                                                            echo "Cancelled";
                                                                        else
                                                                            echo "Approved";
                                                                        ?>
                                                                        </span>
                                                                    <?php } ?>
                                                                </td>
                                                            
                                                            </tr>
                                                            <!-- View Modal -->
                                                            <div class="modal fade" id="viewModal<?php echo $post['request_id']; ?>" role="dialog">
                                                                <div class="modal-dialog">
                                                            
                                                                  <!-- Modal content-->
                                                                  <div class="modal-content">
                                                                    <div class="modal-header">
                                                                      <h4 class="modal-title">Request - Comment (<?= $post['request_id']; ?>)</h4>
                                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                      <strong>Request Comment</strong><hr>
                                                                      <p>
                                                                          <?php
                                                                          if ($post['comment'] == "")
                                                                              echo "<i>No Comments.</i>";
                                                                          else
                                                                              echo $post['comment'];
                                                                          ?>
                                                                      </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                  </div>
                                                              
                                                                </div>
                                                            </div>
                    
                                                            <!-- Approve Modal -->
                                                            <div class="modal fade" id="approveModal<?php echo $post['request_id']; ?>" role="dialog">
                                                                <div class="modal-dialog">
                                                            
                                                                  <!-- Modal content-->
                                                                  <div class="modal-content">
                                                                    <form method="post" action="<?= base_url('admin/add_point_req2/' . $post['request_id']); ?>">
                                                                    <div class="modal-header">
                                                                      <h4 class="modal-title">Request - Approve (<?= $post['request_id']; ?>)</h4>
                                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                      <strong>Any Comments</strong>
                                                                      <textarea type="text" name="approve_comment" class="form-control" placeholder="Any comment for Approval of Request" ></textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                      <input type="submit" class="btn btn-success" value="Update" />
                                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                    </form>
                                                                  </div>
                                                              
                                                                </div>
                                                            </div>
                    
                                                            <!-- Cancel Modal -->
                                                            <div class="modal fade" id="cancelModal<?php echo $post['request_id']; ?>" role="dialog">
                                                                <div class="modal-dialog">
                                                            
                                                                  <!-- Modal content-->
                                                                  <div class="modal-content">
                                                                    <form method="post" action="<?= base_url('admin/add_point_req_cancel/' . $post['request_id']); ?>">
                                                                    <div class="modal-header">
                                                                      <h4 class="modal-title">Request - Cancel (<?= $post['request_id']; ?>)</h4>
                                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                      <strong>Any Comments</strong>
                                                                      <textarea type="text" name="cancel_comment" class="form-control" placeholder="Any comment for Cancel of Request" ></textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                      <input type="submit" class="btn btn-success" value="Update" />
                                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                    </form>
                                                                  </div>
                                                              
                                                                </div>
                                                            </div>
                    
                                                    <?php endforeach; ?>
                                                    </tbody>
                                            </table>
                                        </div>
                         </div>
                    </div>
                </div>
            </div>
               
            <!-- END PAGE CONTENT-->

       
           
    <?php include('includes/footer.php') ?>
    
 <!--select 2    -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
     $("#select").select2({
   tags: true,
// dropdownParent: $('#modal), // if select in modal
   theme: "bootstrap",
});
</script>

<!--select 2-->
 
   
    
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
    <script>
    $(document).ready( function () {
        $('#myTable2').DataTable();
    } );

    function userbank_allow(id) {
        if(confirm('Are you sure to allow deposit, withdraw and add bank account permission ?')){
            //AJAX method: Activate
            window.location.href = "<?php echo current_url() ?>/userbank_allow/"+id;
        } else {
           event.preventDefault();
        }
    }

    </script>