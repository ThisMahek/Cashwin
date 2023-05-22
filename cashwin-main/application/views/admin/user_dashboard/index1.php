<?php
include(__DIR__ . '/../includes/header.php');
include(__DIR__ . '/../includes/sidebar.php');
?>
<style>
.custom-design{
    
}
</style>
  <div class="content-wrapper">
    
      <!------->
       <div class="page-heading">
                <!--<h1 class="page-title">User Dashboard :  <?php echo $users->name . " (" . $users->mobileno . ")" ?></h1>-->
                <h4 class="mt-4 mb-4">User Dashboard 2</h4>
               <div class="row">
                   <div class="col-md-4">
                         <div class="card overflow-hidden h100p mb-3">
                           <div class="bg-soft-primary">
                              <div class="row">
                                 <div class="col-7">
                                    <div class="text-primary p-3">
                                       <h5 class="text-primary"><?= $users->name ?></h5>
                                       <p><?= $users->mobileno ?> <a href="tel:<?= $users->mobileno ?>"><i class="fa fa-phone"></i></a>
                                          <a href="https://wa.me/91<?= $users->mobileno ?>" target="blank"><i class="fa fa-whatsapp"></i></a>
                                       </p>
                                    </div>
                                 </div>
                                 <div class="col-5 align-center">
                                    <div class="p-3 text-right font-12">
                                       <div class="mb-2">
                                            Active:
                                            <a role="button" class="activeDeactiveStatus">
                                                <?php if ($users->status == 'active'): ?>
                                                      <span class="badge badge-pill badge-success font-size-12" onclick="deactivate(<?= $users->id ?>)">Yes</span>
                                                <?php else: ?>
                                                      <span class="badge badge-pill badge-danger font-size-12" onclick="activate(<?= $users->id ?>)">No</span>
                                                <?php endif; ?>
                                            </a>
                                       </div>
                                       <div class="mb-2">
                                          Deposit,Withdraw,Add Bank: 
                                            <a role="button" class="activeDeactiveStatus">
                                                <?php if ($users->bank_status == 1): ?>
                                                  <span class="badge badge-pill badge-success font-size-12" onclick="userbank_block(<?= $users->id ?>)">Allowed</span>
                                                <?php else: ?>
                                                  <span class="badge badge-pill badge-danger font-size-12" onclick="userbank_allow(<?= $users->id ?>)">Blocked</span>
                                                <?php endif; ?>
                                            </a>
                                       </div>
                                       <!--<div class="mb-2">-->
                                       <!--   TP: -->
                                       <!--   <a role="button" class="activeDeactiveStatus"><span class="badge badge-pill badge-success font-size-12">Yes</span></a>-->
                                       <!--</div>-->
                                       <!--<div class="mb-2">-->
                                       <!--   Logout Status: -->
                                       <!--   <a role="button"><span class="badge badge-pill badge-success font-size-12">Logout Now</span></a>-->
                                       <!--</div>-->
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="card-body pt-0">
                              <div class="row">
                                 <div class="col-sm-4">
                                    <div class="avatar-md profile-user-wid mb-4">
                                       <img src="<?= base_url() ?>assets/img/user.png" alt="" class="img-thumbnail rounded-circle">
                                    </div>
                                 </div>
                                 <div class="col-sm-8">
                                    <div class="pt-4">
                                       <div class="row">
                                          <div class="col-6">
                                             <p class="text-muted mb-0">Security Pin</p>
                                             <h5 class="font-size-15 mb-0"><?= $users->mid ?></h5>
                                          </div>
                                          <div class="col-6">
                                          <a class="btn btn-primary btn-sm" id="changePin" data-toggle="modal" href="#securityModal<?php echo $userid ?>">Change</a>
                                             <!--<button class="btn btn-primary btn-sm" id="changePin">Change</button>-->
                                          </div>
                                          
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!--start change security pin model---->
                            
                                    <div class="modal fade" id="securityModal<?php echo $userid; ?>" role="dialog">
                                        <div class="modal-dialog">
                                        
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <form method="post" action="<?= base_url('admin/change_security_pin/' . $userid); ?>">
                                         
                                            <div class="modal-header">
                                              <h4 class="modal-title">Change Security PIN</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                              <strong>PIN</strong>
                                              <textarea type="text" name="pin" class="form-control" placeholder="Enter PIN" ><?= $users->mid ?></textarea>
                                            </div>
                                            <div class="modal-footer">
                                              <input type="submit" class="btn btn-success" value="Update" />
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                            </form>
                                          </div>
                                          
                                        </div>
                                    </div>
                           <!---end change security pin model----->
                           <div class="card-body border-top">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <div>
                                       <p class="text-muted mb-2">Available Balance</p>
                                       <h5><?= $users->wallet_points ?></h5>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="mt-3">
                                       <a class="btn btn-success btn-sm w-md btn-block" href="<?= site_url('admin/add_wallet/' . $users->mobileno . '/add') ?>" target="_blank" id="adFund">Add Fund</a>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="mt-3">
                                       <a class="btn btn-danger btn-sm w-md btn-block" href="<?= site_url('admin/add_wallet/' . $users->mobileno . '/withdraw') ?>" target="_blank" id="withdrawFund">Withdraw Fund</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                   </div>
                   <div class="col-md-8">
                      <div class="card h100p mb-3">
                           <div class="card-body">
                              <h5 class="card-title mb-4">Personal Information</h5>
                              <div class="table-responsive">
                                 <table class="table table-nowrap mb-0">
                                    <tbody>
                                       <tr>
                                          <th scope="row">Full Name :</th>
                                          <td><?= $users->name ?></td>
                                          <th scope="row">Email :</th>
                                          <td><?= $users->email ?></td>
                                       </tr>
                                       <tr>
                                          <th scope="row">Mobile :</th>
                                          <td><?= $users->mobileno ?>
                                            <a href="tel:<?= $users->mobileno ?>"><i class="fa fa-phone"></i></a>
                                            <a href="https://wa.me/91<?= $users->mobileno ?>" target="blank"><i class="fa fa-whatsapp"></i></a>
                                          </td>
                                          <th scope="row">Password :</th>
                                          <td><?= $users->password ?></td>
                                       </tr>
                                       <tr>
                                          <th scope="row">District Name :</th>
                                          <td>N/A</td>
                                          <th scope="row">Flat/Plot No. :</th>
                                          <td>N/A</td>
                                       </tr>
                                       <tr>
                                          <th scope="row">Address Lane 1 :</th>
                                          <td>N/A</td>
                                          <th scope="row">Address Lane 2 :</th>
                                          <td>N/A</td>
                                       </tr>
                                       <tr>
                                          <th scope="row">Area :</th>
                                          <td>N/A</td>
                                          <th scope="row">Pin Code :</th>
                                          <td>N/A</td>
                                       </tr>
                                       <tr>
                                          <th scope="row">State Name :</th>
                                          <td>N/A</td>
                                          <th scope="row"></th>
                                          <td></td>
                                       </tr>
                                       <tr>
                                          <th scope="row">Creation Date :</th>
                                          <td><?= date('d M Y h:i:s A', strtotime($users->created_at)) ?></td>
                                          <th scope="row">Last Seen :</th>
                                          <td><?= date('d M Y h:i:s A', strtotime($users->time)) ?></td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                      </div>  
                   </div>
                   <div class="col-md-12">
                       <div class="card mb-3">
                           <div class="card-body">
                              <h5 class="card-title mb-4">Payment Information</h5>
                              <div class="table-responsive">
                                 <table class="table table-nowrap mb-0">
                                    <tbody>
                                       <tr>
                                          <th scope="row">Bank Name :</th>
                                          <td><?= $users->bank_name ?? "N/A" ?></td>
                                          <th scope="row">Branch Address :</th>
                                          <td><?= NULL ?? "N/A" ?></td>
                                          <th scope="row"></th>
                                          <td></td>
                                       </tr>
                                       <tr>
                                          <th scope="row">A/c Holder Name :</th>
                                          <td><?= $users->account_holder_name ?? "N/A" ?></td>
                                          <th scope="row">A/c Number :</th>
                                          <td><?= $users->accountno ?? "N/A" ?></td>
                                          <th scope="row">IFSC Code :</th>
                                          <td><?= $users->ifsc_code ?? "N/A" ?></td>
                                       </tr>
                                       <tr>
                                          <th scope="row">PhonePe No. :</th>
                                          <td><?= $users->phonepay_no ?? "N/A" ?></td>
                                          <th scope="row">Google Pay No. :</th>
                                          <td><?= $users->tez_no ?? "N/A" ?></td>
                                          <th scope="row">Paytm No. :</th>
                                          <td><?= $users->paytm_no ?? "N/A" ?></td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                        <!--add fund list-->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Add Fund Request List</h5>
                                <table class="table table-bordered table-hover table-responsive datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Request Amount</th>
                                            <!--<th>Receipt Image</th>-->
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0;
                                        foreach ($add_point_reqs as $add_point_req):
                                          $i++; ?>
                                          <tr>
                                              <td><?php echo $i; ?></td>
                                              <td><?php echo $add_point_req['request_points']; ?></td>
                                              <td><?php echo $add_point_req['time']; ?></td>
                                              <td><?= ($add_point_req['request_status'] == "cancel") ? "Cancelled" : $add_point_req['request_status']; ?></td>
                                              <td>
                                                  <?php if ($add_point_req['request_status'] == "pending") { ?>
                                                        <!--<a href='<?php echo base_url(); ?>admin/add_point_req2/<?php echo $add_point_req['request_id']; ?>'>-->
                                                            <a class="btn btn-success" data-toggle="modal" href="#approveModal<?php echo $add_point_req['request_id']; ?>">Apporve</a>
                                                        <!--<a href='<?php echo base_url(); ?>admin/add_point_req_cancel/<?php echo $add_point_req['request_id']; ?>'>-->
                                                            <a class="btn btn-danger" data-toggle="modal" href="#cancelModal<?php echo $add_point_req['request_id']; ?>">Cancel</a>
                                                  <?php } else { ?>
                                                    <span data-toggle="modal" data-target="#viewModal<?= $add_point_req['request_id']; ?>">
                                                    <?php if ($add_point_req['request_status'] == "cancel")
                                                      echo "Cancelled";
                                                    else
                                                      echo "Approved";
                                                    ?>
                                                    </span>
                                                  <?php } ?>
                                              </td>
                                          </tr>
                                      <!-- View Modal -->
                                      <div class="modal fade" id="viewModal<?php echo $add_point_req['request_id']; ?>" role="dialog">
                                          <div class="modal-dialog">
                                        
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h4 class="modal-title">Request - Comment (<?= $add_point_req['request_id']; ?>)</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              </div>
                                              <div class="modal-body">
                                                <strong>Request Comment</strong><hr>
                                                <p>
                                                    <?php
                                                    if ($add_point_req['comment'] == "")
                                                      echo "<i>No Comments.</i>";
                                                    else
                                                      echo $add_point_req['comment'];
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
                                      <div class="modal fade" id="approveModal<?php echo $add_point_req['request_id']; ?>" role="dialog">
                                          <div class="modal-dialog">
                                        
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <form method="post" action="<?= base_url('admin/add_point_req2/' . $add_point_req['request_id']); ?>">
                                              <div class="modal-header">
                                                <h4 class="modal-title">Request - Approve (<?= $add_point_req['request_id']; ?>)</h4>
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
                                      <div class="modal fade" id="cancelModal<?php echo $add_point_req['request_id']; ?>" role="dialog">
                                          <div class="modal-dialog">
                                        
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <form method="post" action="<?= base_url('admin/add_point_req_cancel/' . $add_point_req['request_id']); ?>">
                                              <div class="modal-header">
                                                <h4 class="modal-title">Request - Cancel (<?= $add_point_req['request_id']; ?>)</h4>
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
                        <!--add fund list-->
                        <!--Withdraw Fund Request list-->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Withdraw Fund Request List</h5>
                                <table class="table table-bordered table-hover table-responsive datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Request Amount</th>
                                            <th>Request No</th>
                                            <th>Request Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                <?php $i = 0;
                                foreach ($withdraw_request as $post):
                                  $wallet_data = $this->db->where('user_id', $post['user_id'])->get('tblwallet')->row();
                                  // print_r($wallet_data);
                                
                                  $i++; ?>
                                      <!--<tr style='<?= ($post['request_status'] == "cancel") ? "background:red; color:white;" : (($post['request_status'] == "pending") ? "background:yellow;" : ""); ?>'>-->
                                      <tr>
                                          <td><?php echo $i; ?></td>
                                          <td><?php echo $post['request_points']; ?></td>
                                           <td><?php echo $post['request_id']; ?></td>
                                          <td><?= date("d/m/Y h:i:s A", strtotime($post['time'])); ?></td>
                                          <td><?php echo ucfirst($post['request_status']); ?></td>
                                        
                                         <td>
                                              <?php if ($post['request_status'] == "pending") {
                                                $am = $this->Administrator_Model->ch_amt(-$post['request_points'], $post['user_id']);
                                                if ($am >= 0) {
                                                  ?>
                                                   <input type="hidden"  id="vendor_amount2<?= $post['user_id'] ?>" name="amount_data" class="form-control" value="<?= isset($wallet_data->wallet_points) ? $wallet_data->wallet_points : '' ?>"requird>
                                                  <input type="hidden"  id="amount2<?= $post['request_id'] ?>" name="amount2" class="form-control" value="<?= $post['request_points'] ?>"requird>
                                                  <!--<a href='<?php echo base_url(); ?>admin/withdraw_point_req2/<?php echo $post['request_id']; ?>'>-->
                                           
                                                      <a class="btn btn-success" data-toggle="modal" href="#approveModal<?php echo $post['request_id']; ?>" onclick="validateMaxAmount(<?= $post['request_id'] ?>,<?= $post['user_id'] ?>)" id="btn">Apporve</a>
                                                
                                                  <!--<a href='<?php echo base_url(); ?>admin/withdraw_point_req_cancel/<?php echo $post['request_id']; ?>'>-->
                                                      <a class="btn btn-danger" data-toggle="modal" href="#cancelModal<?php echo $post['request_id']; ?>">Cancel</a>
                                                <?php } else {
                                                  echo "<span style='color:red'>Error " . $am . " rs used.</span>";
                                                }
                                                ?>
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
                                              <form method="post" action="<?= base_url('admin/withdraw_point_req2/' . $post['request_id']); ?>">
                                         
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
                                              <form method="post" action="<?= base_url('admin/withdraw_point_req_cancel/' . $post['request_id']); ?>">
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
                        <!--Withdraw Fund Request List-->
                        <!--Bid History-->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Bid History</h5>
                                <table class="table table-bordered table-hover table-responsive datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Game Name</th>
                                            <th>Game Type</th>
                                            <th>Bet Type</th>
                                            <th>Digits</th>
                                            <!--<th>Close Digits</th>-->
                                            <th>Points</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0;
                                        foreach ($user_bid_history as $bid_history):
                                          $i++; ?>
                                          <tr>
                                              <td><?php echo $i; ?></td>
                                              <td><?php
                                              $gamedata = $this->Game->matkabyid($bid_history->matka_id);
                                              if ($game_type == 'starline')
                                                echo $matka_name = $gamedata->s_game_time;
                                              else
                                                echo $matka_name = $gamedata->name;
                                              ?>
                                               </td>
                                               <td>
                                              <?php
                                              $game = $this->Game->gamebyid($bid_history->game_id);
                                              echo $game->name;
                                              ?>
                                          </td>
                                               <td><?= ($bid_history->bet_type == 'close') ? '<h3 class="badge badge-danger">Closed</h3>' : '<h3 class="badge badge-success">Open</h3>' ?></td>
                                               <td><?= $bid_history->digits ?></td>
                                               <td><?= $bid_history->points ?></td>
                                               <td><?= date('d/m/Y H:i:s', strtotime($bid_history->time)) ?></td>
                                            
                                          </tr>
                                   
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--Bid history-->
                        <!--Wallet Transaction History-->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Wallet Transaction History</h5>
                                <nav class="wallet_tabs">
                                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#all" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#credit" role="tab" aria-controls="nav-profile" aria-selected="false">Credit</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#debit" role="tab" aria-controls="nav-contact" aria-selected="false">Debit</a>
                                  </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                  <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <table class="table table-bordered table-hover table-responsive datatable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Amount</th>
                                                    <th>Transaction Note</th>
                                                    <th>Transfer Note</th>
                                                    <th>Date</th>
                                                    <th>Tx Req. No.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 0;
                                                $credits = array();
                                                $debits = array(); foreach ($credit_debit as $c_and_d):

                                                  //  $credit=   $this->db->where('user_id',$user_id)->where('type in ("Add","received")')->order_by('request_id',"desc")->get('tblRequest')->result();
                                                
                                                  if ($c_and_d->type == 'Add' or $c_and_d->type == 'received') {
                                                    $sign = "+";
                                                    $credits[] = $c_and_d;
                                                  } elseif ($c_and_d->type == 'Withdrawal' or $c_and_d->type == 'send') {
                                                    $sign = "-";
                                                    $debits[] = $c_and_d;
                                                  }

                                                  if ($c_and_d->is_admin == '1') {
                                                    $comment_show = "admin";
                                                  } else {
                                                    $comment_show = "user";
                                                  }

                                                  $i++; ?>
                                                  <tr>
                                                      <td><?= $i; ?></td>
                                                      <td>
                                                       
                                                          <?= $sign . $c_and_d->request_points ?> Rs</td>
                                                      <td>Amount Added By <?= $comment_show ?>   </td>
                                                      <td><?= !empty($c_and_d->comment) ? $c_and_d->comment : "___" ?>  </td>
                                                      <td><?= date('d M Y H:i:s', strtotime($c_and_d->time)) ?>  </td>
                                                      <td><?= $c_and_d->request_id ?></td>
                                                  </tr>
                                                 <?php endforeach; ?>
                                            </tbody>
                                            
                                        </table>
                                  </div>
                                  <div class="tab-pane fade" id="credit" role="tabpanel" aria-labelledby="nav-profile-tab">
                                       <table class="table table-bordered table-hover table-responsive datatable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Amount</th>
                                                    <th>Transaction Note</th>
                                                    <th>Transfer Note</th>
                                                    <th>Date</th>
                                                    <th>Tx Req. No.</th>
                                                </tr>
                                            </thead>
                                          <tbody>
                                                <?php $i = 0;
                                                foreach ($credits as $c_and_d):

                                                  if ($c_and_d->type == 'Add' or $c_and_d->type == 'received') {
                                                    $sign = "+";
                                                  } elseif ($c_and_d->type == 'Withdrawal' or $c_and_d->type == 'send') {
                                                    $sign = "-";
                                                  }

                                                  if ($c_and_d->is_admin == '1') {
                                                    $comment_show = "admin";
                                                  } else {
                                                    $comment_show = "user";
                                                  }

                                                  $i++; ?>
                                                  <tr>
                                                      <td><?= $i; ?></td>
                                                      <td>
                                                       
                                                          <?= $sign . $c_and_d->request_points ?> Rs</td>
                                                      <td>Amount Added By <?= $comment_show ?>   </td>
                                                      <td><?= !empty($c_and_d->comment) ? $c_and_d->comment : "___" ?>  </td>
                                                      <td><?= date('d M Y H:i:s', strtotime($c_and_d->time)) ?>  </td>
                                                      <td><?= $c_and_d->request_id ?></td>
                                                  </tr>
                                                 <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                  </div>
                                  <div class="tab-pane fade" id="debit" role="tabpanel" aria-labelledby="nav-contact-tab">
                                       <table class="table table-bordered table-hover table-responsive datatable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Amount</th>
                                                    <th>Transaction Note</th>
                                                    <th>Transfer Note</th>
                                                    <th>Date</th>
                                                    <th>Tx Req. No.</th>
                                                </tr>
                                            </thead>
                                                                                     <tbody>
                                                <?php $i = 0;
                                                foreach ($debits as $c_and_d):

                                                  if ($c_and_d->type == 'Add' or $c_and_d->type == 'received') {
                                                    $sign = "+";
                                                  } elseif ($c_and_d->type == 'Withdrawal' or $c_and_d->type == 'send') {
                                                    $sign = "-";
                                                  }

                                                  if ($c_and_d->is_admin == '1') {
                                                    $comment_show = "admin";
                                                  } else {
                                                    $comment_show = "user";
                                                  }

                                                  $i++; ?>
                                                  <tr>
                                                      <td><?= $i; ?></td>
                                                      <td>
                                                       
                                                          <?= $sign . $c_and_d->request_points ?> Rs</td>
                                                      <td>Amount Added By <?= $comment_show ?>   </td>
                                                      <td><?= !empty($c_and_d->comment) ? $c_and_d->comment : "___" ?>  </td>
                                                      <td><?= date('d M Y H:i:s', strtotime($c_and_d->time)) ?>  </td>
                                                      <td><?= $c_and_d->request_id ?></td>
                                                  </tr>
                                                 <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                  </div>
                                </div>
                                
                               
                            </div>
                        </div>
                        <!--Wallet Transaction History-->
                         <!--Winning History Report-->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Winning History Report</h5>
                                <form style="">
                                <div class="row">
                                    <div class="col-md-4 col-8">
                                        <label for="date">Date</label>
                                        <input type="date" name="from_date" class="form-control mb-2"  value="<?= $from_date ?>">
                                    </div>
                                    <div class="col-md-4 col-4">
                                         <input type="submit" class="btn btn-primary" value="Filter" style="margin-top:21px"/>
                                    </div>
                                </div>
                                </form>
                                <table class="table table-bordered table-hover table-responsive datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Amount(Rs.)</th>
                                            <th>Game Name</th>
                                            <th>Tax id</th>
                                            <th>Tax Date</th>
                                        </tr>
                                    </thead>
                                      <tbody>
                                        <?php $i = 0;
                                        foreach ($user_win_history as $win_history):
                                          $i++; ?>
                                          <tr>
                                              <td><?php echo $i; ?></td>
                                                <td><?php echo $win_history->points; ?></td>
                                            
                                              <td><?php
                                              $gamedata = $this->Game->matkabyid($win_history->matka_id);
                                              if ($game_type == 'starline')
                                                echo $matka_name = $gamedata->s_game_time;
                                              else
                                                echo $matka_name = $gamedata->name;
                                              ?>
                                               </td>
                                               <td><?php echo $win_history->id; ?></td>
                                               <td><?= date('d/m/Y H:i:s', strtotime($win_history->time)) ?></td>
                                            
                                          </tr>
                                   
                                        <?php endforeach; ?>
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                        <!--Winning History Report-->
                    </div>
               </div>
            </div>
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <!--<div class="row mb-4">-->
                    
                <!--    <div class="col-lg-4 col-md-6">-->
                <!--        <div class="card mb-4">-->
                <!--            <div class="card-body flexbox-b">-->
                <!--                <div class="easypie mr-4 pr-4" data-percent="50" data-bar-color="#5c6bc0" data-size="90" data-line-width="10">-->
                <!--                    <span class="easypie-data text-primary" style="font-size:32px;"><i class="la la-money"></i></span>-->
                <!--                </div>-->
                <!--                <div>-->
                <!--                    <h3 class="font-strong text-primary"><?php echo $last_credit->request_points; ?></h3>-->
                <!--                    <div class="text-muted">LAST CREDIT</div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="col-lg-4 col-md-6">-->
                <!--        <div class="card mb-4">-->
                <!--            <div class="card-body flexbox-b">-->
                <!--                <div class="easypie mr-4 pr-4" data-percent="70" data-bar-color="#ff4081" data-size="80" data-line-width="8">-->
                <!--                    <span class="easypie-data text-pink" style="font-size:32px;"><i class="la la-money"></i></span>-->
                <!--                </div>-->
                <!--                <div>-->
                <!--                    <h3 class="font-strong text-pink"><?php echo abs($last_withdrwal->request_points); ?></h3>-->
                <!--                    <div class="text-muted">LAST WITHDRWAL</div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--    <div class="col-lg-4 col-md-6">-->
                <!--        <div class="card mb-4">-->
                <!--            <div class="card-body flexbox-b">-->
                <!--                <div class="easypie mr-4 pr-4" data-percent="70" data-bar-color="#ff4081" data-size="80" data-line-width="8">-->
                <!--                    <span class="easypie-data text-pink" style="font-size:32px;"><i class="la la-money"></i></span>-->
                <!--                </div>-->
                <!--                <div>-->
                <!--                    <h3 class="font-strong text-pink"><?php echo $users->wallet_points; ?></h3>-->
                <!--                    <div class="text-muted">CURRENT WALLET AMOUNT</div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                    
                <!--    <div class="col-lg-4 col-md-6">-->
                <!--        <div class="card mb-4">-->
                <!--            <div class="card-body flexbox-b">-->
                <!--                <div class="easypie mr-4 pr-4" data-percent="70" data-bar-color="#ff4081" data-size="80" data-line-width="8">-->
                <!--                    <span class="easypie-data text-pink" style="font-size:32px;"><i class="la la-money"></i></span>-->
                <!--                </div>-->
                <!--                <div>-->
                <!--                    <h3 class="font-strong text-pink"><?php echo count($total_bids) ?></h3>-->
                <!--                    <div class="text-muted"><a href="<?php echo base_url(); ?>UserDashboard/total_bids/<?php echo $users->id; ?>">TOTAL BIDS</a></div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                    
                <!--    <div class="col-lg-4 col-md-6">-->
                <!--        <div class="card mb-4">-->
                <!--            <div class="card-body flexbox-b">-->
                <!--                <div class="easypie mr-4 pr-4" data-percent="70" data-bar-color="#ff4081" data-size="80" data-line-width="8">-->
                <!--                    <span class="easypie-data text-pink" style="font-size:32px;"><i class="la la-money"></i></span>-->
                <!--                </div>-->
                <!--                <div>-->
                <!--                    <h3 class="font-strong text-pink"><a href="<?php echo base_url(); ?>UserDashboard/debit_credit_details/<?php echo $users->id; ?>">View</a></h3>-->
                <!--                    <div class="text-muted">FULL CREDIT/DEBIT DETAILS</div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
               
             </div>
                   
     
            <!-- END PAGE CONTENT-->
             <script>
 function validateMaxAmount(id,user_id)
      {
          var max_amount = parseInt($("#vendor_amount2"+user_id).val());
         var max_amount2 = parseInt($("#amount2"+id).val());
        // alert(max_amount2);
        // alert(max_amount);
        // alert(id);
          if(max_amount >= max_amount2)
          {
            document.getElementById("btn").disabled=false;
          }
          else
          {
           alert('Invaild amount,amount must be greater than or equal wallet amount!');
        
            document.getElementById("btn").disabled=true;
           
          }
      }
</script>
<?php include(APPPATH . '/views/admin/includes/user_action_script.php') ?>
<?php include(APPPATH . '/views/admin/includes/footer.php') ?>