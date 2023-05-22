<?php
include('includes/header.php');
include('includes/sidebar.php');
?>
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->

    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <form action="">
                        <div class="ibox-head">
                            <div class="ibox-title">Edit Admin profile</div>
                        </div>
                        <div class="ibox-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Name</label>
                                        <input class="form-control" type="text" placeholder="Enter Full Name">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Mobile No</label>
                                        <input class="form-control" type="number" placeholder="Mobile No">
                                        <!-- <span class="help-block">Please Enter your date of birth.</span> -->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <label>Email</label>
                                        <input class="form-control" type="text" placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <label>Address</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="ibox-footer">
                            <a href=""><button class="btn btn-primary mr-2" type="button">Update</button></a>
                            <!-- <button class="btn btn-outline-secondary" type="reset">Cancel</button> -->
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <?php
    include('includes/footer.php');
    ?>