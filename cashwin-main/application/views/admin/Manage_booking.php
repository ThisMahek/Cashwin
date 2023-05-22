<?php
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">

    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <div class="row" style="padding-bottom: 7px;">
                    <div class="col-md-10">
                        <h5 class="font-strong mb-4">Manage Booking</h5>
                    </div>
                    <div class="col-md-2">
                        <a href="add-booking.php"><button class="btn btn-info btn-square">+Add</button></a>
                    </div>
                </div>

                <div class="flexbox mb-4">
                    <div class="flexbox">
                        <label class="mb-0 mr-2">Type:</label>
                        <select class="selectpicker show-tick form-control" id="type-filter" title="Please select"
                            data-style="btn-solid" data-width="150px">
                            <option value="">All</option>
                            <option>Shipped</option>
                            <option>Completed</option>
                            <option>Pending</option>
                            <option>Canceled</option>
                        </select>
                    </div>
                    <div class="input-group-icon input-group-icon-left mr-3">
                        <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                        <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text"
                            placeholder="Search ...">
                    </div>
                </div>
                <div class="table-responsive row">
                    <table class="table table-bordered table-hover" id="datatable">
                        <thead class="thead-default thead-lg">
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th class="no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>2</td>
                                <td>
                                    344
                                </td>
                                <td>Emma Johnson</td>
                                <td><a href="mailto:user@gmail.com">user@gmail.com</a></td>

                                <td>abc</td>
                                <td>3000</td>
                                <td>02-02-20</td>
                                <td>
                                    <a href="edit-booking.php"><button
                                            class="btn btn-info btn-icon-only btn-circle btn-sm btn-air"><i
                                                class="la la-pencil"></i></button></a><a href=""><button
                                            class="btn btn-danger btn-icon-only btn-circle btn-sm btn-air"><i
                                                class="ti-trash"></i></button></a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->

    <?php include('includes/footer.php') ?>