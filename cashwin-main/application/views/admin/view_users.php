\
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
                        <h5 class="font-strong mb-4">List Users</h5>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
                <center>
                    <div style="color:green; ">
                        <h5>
                            <?php echo $this->session->flashdata('success'); ?>
                        </h5>
                    </div>
                </center>
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
                    <!--<div class="input-group-icon input-group-icon-left mr-3">-->
                    <!--    <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>-->
                    <!--    <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">-->
                    <!--</div>-->
                </div>
                <div class="table-responsive row">
                    <table class="table table-bordered table-hover" id="example">
                        <thead class="thead-default thead-lg">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Balance</th>
                                <!--<th>password</th>-->
                                <th>Profile</th>
                                <th>status</th>
                                <th>Status<br><small>(Deposit,Withdraw,Add Bank)</small></th>
                                <th>Active</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $post):

                                ?>
                                <tr>
                                    <td>
                                        <?php echo $post['id']; ?>
                                    </td>
                                    <td><a
                                            href="<?php echo base_url(); ?>UserDashboard/dashboard/<?php echo $post['id'] ?>"><?php echo $post['username']; ?></a></td>
                                    <td>
                                        <?php echo $post['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $post['mobileno']; ?>
                                    </td>
                                    <td>
                                        <?php echo $post['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo date('d M Y', strtotime($post['time'])) ?>
                                    </td>
                                    <td>
                                        <?php echo $post['wallet_points']; ?>
                                    </td>
                                    <!--<td><button id="btn<?php echo $post['id']; ?>" onclick="showPass(<?php echo $post['id']; ?>)">Show Password</button>-->
                                    <!--<p style="display:none" id="pass<?php echo $post['id']; ?>"><?php echo $post['password']; ?></p>-->
                                    <!--</td>-->
                                    <td><a class="btn btn-success" data-toggle="modal"
                                            data-target="#modaldemo<?php echo $post['id'] ?>"><i class="fa fa-user"></i></a>
                                    </td>
                                    <td>
                                        <?php if ($post['status'] == "active"): ?>
                                            <button class="btn-sm btn-primary"
                                                onclick="deactivate(<?= $post['id'] ?>)">Yes</button>
                                        <?php else: ?>
                                            <button class="btn-sm btn-danger" onclick="activate(<?= $post['id'] ?>)">No</button>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($post['bank_status'] == 1): ?>
                                            <button class="btn-sm btn-primary"
                                                onclick="userbank_block(<?= $post['id'] ?>)">Allowed</button>
                                        <?php else: ?>
                                            <button class="btn-sm btn-danger"
                                                onclick="userbank_allow(<?= $post['id'] ?>)">Blocked</button>
                                        <?php endif; ?>
                                    </td>

                                    <td><a class="btn-sm btn-success"
                                            href="<?php echo base_url(); ?>UserDashboard/<?php echo $post['id'] ?>">
                                            Dashboard</a>
                                        <!--</br></br>-->
                                        <!--<a href="<?= site_url('Admin/delete_user/delete/' . $post['id'] . '/' . $post['mobileno']); ?>" class="btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')?true:false">Delete</a>-->
                                    </td>
                                </tr>

                                <div id="modaldemo<?php echo $post['id'] ?>" class="modal fade show">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content bd-0 tx-14">
                                            <div class="modal-header pd-y-20 pd-x-25">
                                                <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">User Detail</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <form action="" method="post">
                                                <input type="hidden" name="id" class="form-control"
                                                    value="<?= $post['id'] ?>">
                                                <div class="modal-body card-body extra-details">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Address</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="address" class="form-control"
                                                                value="<?= $post['address'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">City</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="city" class="form-control"
                                                                value="<?= $post['city'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Pincode</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="pincode" class="form-control"
                                                                value="<?= $post['pincode'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Account No</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="accountno" class="form-control"
                                                                value="<?= $post['accountno'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Bank Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="bank_name" class="form-control"
                                                                value="<?= $post['bank_name'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">IfSC code</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="ifsc_code" class="form-control"
                                                                value="<?= $post['ifsc_code'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Account holder name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="account_holder_name"
                                                                class="form-control"
                                                                value="<?= $post['account_holder_name'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Paytm No</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="paytm_no" class="form-control"
                                                                value="<?= $post['paytm_no'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Tez No</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="tez_no" class="form-control"
                                                                value="<?= $post['tez_no'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Phonepay No</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="phonepay_no" class="form-control"
                                                                value="<?= $post['phonepay_no'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">MPIN</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="mid" class="form-control"
                                                                value="<?= $post['mid'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">DOB</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="dob" class="form-control"
                                                                value="<?= $post['dob'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-10">
                                                            <button type="submit" name="update_user"
                                                                class="btn btn-primary">Update</button>

                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- modal-dialog -->
                                </div>
                            <?php endforeach; ?>

                            <!-- <div class="paginate-link">
                                    <?php //echo $this->pagination->create_links(); ?>
                                </div>  -->

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
    <script>
        function showPass(id) {
            var txt = $("#btn" + id).text();
            if (txt === 'Show Password')
                $("#btn" + id).text('Hide Password');
            else
                $("#btn" + id).text('Show Password');
            $("#pass" + id).toggle();
        }
    </script>
    <?php include('includes/user_action_script.php') ?>
    <?php include('includes/footer.php') ?>