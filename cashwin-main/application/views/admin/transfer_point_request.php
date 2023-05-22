<?php
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">

  <div class="page-content fade-in-up">
    <div class="ibox">
      <div class="ibox-body">
        <div class="row" style="padding-bottom: 7px;">
          <div class="col-md-6">
            <h5 class="font-strong mb-4">Transfer Point Report</h5>
          </div>
          <div class="col-md-6">
            <?php if ($this->session->flashdata("status")): ?>
              <h3 style="color:green">
                <?= $this->session->flashdata("status"); ?>
              </h3>
            <?php endif; ?>
            <!-- <div class="page-heading">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="index-2.html"><i class="la la-home font-20"></i></a>
                                        </li>
                                        <li class="breadcrumb-item">Basic UI</li>
                                        <li class="breadcrumb-item">Typography</li>
                                    </ol>
                                </div> -->
          </div>
        </div>

        <div class="flexbox mb-4">
          <!--<div class="flexbox">-->
          <!--    <label class="mb-0 mr-2">Type:</label>-->
          <!--    <select class="selectpicker show-tick form-control" id="type-filter" title="Please select" data-style="btn-solid" data-width="150px">-->
          <!--        <option value="">All</option>-->
          <!--        <option>Shipped</option>-->
          <!--        <option>Completed</option>-->
          <!--        <option>Pending</option>-->
          <!--        <option>Canceled</option>-->
          <!--    </select>-->
          <!--</div>-->
          <div class="input-group-icon input-group-icon-left mr-3">
            <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
            <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text"
              placeholder="Search ...">
          </div>
        </div>
        <div class="">
          <div class="">
            <form style="" method="get" action="">
              <div class="row">
                <div class="col-md-4 mb-0">
                  <label class="mb-0 mr-2">Date:</label>
                  <input class="form-control" type="date" name="from_date" value="<?= $from_date ?>" required="">
                </div>
                <div class="col-md-1">
                  <label class="mb-2"></label>
                  <input type="submit" class="btn btn-primary" value="Filter" style="margin-buttom:5px" />
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="table-responsive row">
          <table class="table table-bordered table-hover" id="datatable">
            <thead>
              <tr>
                <th>Id</th>
                <th>Sender Name</th>
                <th>Receiver Name</th>
                <th>Amount</th>
                <th>Date</th>

              </tr>
            </thead>
            <tbody>
              <?php $i = 0;

              foreach ($transfer_data as $post):
                $i++;
                $amount += $post['request_points'];
                ?>
                <tr>
                  <td>
                    <?php echo $i; ?>
                  </td>
                  <td><a href="<?php echo base_url(); ?>UserDashboard/<?php echo $post['sender_id'] ?>"><?php echo fullNamewithMob($post['sender_id']); ?></a></td>
                  <td><a href="<?php echo base_url(); ?>UserDashboard/<?php echo $post['receiver_id'] ?>"><?php echo fullNamewithMob($post['receiver_id']); ?></a></td>
                  <td>
                    <?php echo $post['request_points']; ?>
                  </td>
                  <td>
                    <?= date("d/m/Y h:i:s A", strtotime($post['time'])); ?>
                  </td>

                </tr>

                <!-- View Modal -->
                <div class="modal fade" id="viewModal<?php echo $post['request_id']; ?>" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Request - Comment (
                          <?= $post['request_id']; ?>)
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <strong>Request Comment</strong>
                        <hr>
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
                          <h4 class="modal-title">Request - Approve (
                            <?= $post['request_id']; ?>)
                          </h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <strong>Any Comments</strong>
                          <textarea type="text" name="approve_comment" class="form-control"
                            placeholder="Any comment for Approval of Request"></textarea>
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
                      <form method="post"
                        action="<?= base_url('admin/withdraw_point_req_cancel/' . $post['request_id']); ?>">
                        <div class="modal-header">
                          <h4 class="modal-title">Request - Cancel (
                            <?= $post['request_id']; ?>)
                          </h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <strong>Any Comments</strong>
                          <textarea type="text" name="cancel_comment" class="form-control"
                            placeholder="Any comment for Cancel of Request"></textarea>
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
        <div class="col-12">
          <button class="btn btn-default">Total Transfer Amount: Rs.
            <?= isset($amount) ? $amount : "0"; ?>
          </button>
        </div>

      </div>
    </div>
  </div>
  <!-- END PAGE CONTENT-->

  <?php include('includes/footer.php') ?>