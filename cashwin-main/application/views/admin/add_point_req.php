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
            <h5 class="font-strong mb-4">Add Points</h5>
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
        <div class="table-responsive row">
          <table class="table table-bordered table-hover" id="datatable">
            <!--<table id="dom-jqry" class="table table-striped table-bordered nowrap">-->
            <thead>
              <tr>
                <th>Id</th>
                <th>User ID</th>
                <th>Request Points</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 0;
              foreach ($users as $post):
                $i++; ?>
                <tr
                  style='<?= ($post['request_status'] == "cancel") ? "background:red; color:white;" : (($post['request_status'] == "pending") ? "background:yellow;" : ""); ?>'>
                  <td>
                    <?php echo $i; ?>
                  </td>
                  <td>
                    <?php echo fullNamewithMob($post['user_id']); ?></a>
                  </td>
                  <td>
                    <?php echo $post['request_points']; ?>
                  </td>
                  <td>
                    <?php echo $post['time']; ?>
                  </td>
                  <td>
                    <?= ($post['request_status'] == "cancel") ? "Cancelled" : $post['request_status']; ?>
                  </td>
                  <td>
                    <?php if ($post['request_status'] == "pending") { ?>
                      <!--<a href='<?php echo base_url(); ?>admin/add_point_req2/<?php echo $post['request_id']; ?>'>-->
                      <a class="btn btn-success" data-toggle="modal"
                        href="#approveModal<?php echo $post['request_id']; ?>">Apporve</a>
                      <!--<a href='<?php echo base_url(); ?>admin/add_point_req_cancel/<?php echo $post['request_id']; ?>'>-->
                      <a class="btn btn-danger" data-toggle="modal"
                        href="#cancelModal<?php echo $post['request_id']; ?>">Cancel</a>
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
                      <form method="post" action="<?= base_url('admin/add_point_req2/' . $post['request_id']); ?>">
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
                      <form method="post" action="<?= base_url('admin/add_point_req_cancel/' . $post['request_id']); ?>">
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
      </div>
    </div>
  </div>
  <!-- END PAGE CONTENT-->

  <?php include('includes/footer.php') ?>