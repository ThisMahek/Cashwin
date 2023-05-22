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
                        <h5 class="font-strong mb-4">User Passbook</h5>
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
                    <div class="col-md-3 mb-0">
                        <label class="mb-0 mr-2">Date:</label>
                        <input class="form-control" type="date" name="from_date" value="<?= $from_date ?>">
                    </div>
                    <div class="input-group-icon input-group-icon-right mr-3">
                        <b>Total Amount: &nbsp;</b> <span>
                            <?php echo $curr_wallet ?>
                        </span>
                    </div>
                </div>
                <div class="table-responsive row">
                    <table class="table table-bordered table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User ID</th>
                                <th>Description</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //print_r($details);
                            $bal = $curr_wallet;
                            $i = 0;
                            foreach ($details as $post):
                                $i++;
                                if (($post['Type'] == 'Withdrawal') || (($post['Type'] == 'open') || ($post['Type'] == 'close'))):
                                    $CrDr = abs($post['Point']);
                                else:
                                    $CrDr = -$post['Point'];
                                endif;

                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo fullNamewithMob($post['user_id']); ?></a>
                                    </td>
                                    <td>
                                        <?php echo $post['comment']; ?></a>
                                    </td>
                                    <td>
                                        <?php echo (($post['Type'] == 'Withdrawal') || (($post['Type'] == 'open') || ($post['Type'] == 'close'))) ? abs($post['Point']) : ""; ?>
                                    </td>
                                    <td>
                                        <?php echo (($post['Type'] == 'Add') || ($post['Type'] == 'c')) ? $post['Point'] : ""; ?>
                                    </td>
                                    <td>
                                        <?php echo $bal; ?>
                                    </td>
                                    <td>
                                        <?php echo $post['Date']; ?>
                                    </td>
                                    <!--<td><? php // echo $post['Type']; ?></td>-->

                                </tr>
                                <?php
                                $bal += $CrDr;
                            endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->

    <?php include('includes/footer.php') ?>