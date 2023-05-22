<?php
include('includes/header.php');
include('includes/sidebar.php');
?>
<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-header">
        <div class="ibox flex-1">
            <div class="ibox-body">
                <div class="flexbox">
                    <div class="flexbox-b">
                        <div class="ml-5 mr-5">
                            <a data-toggle="modal" data-target="#exampleModal"><img class="img-circle"
                                    src="<?php echo base_url() ?>assets/resources/img/users/u7.jpg"
                                    title="click to edit profile" alt="image" width="110" /></a>
                        </div>
                        <div>
                            <h4>Admin Name</h4>
                            <div class="text-muted font-13 mb-3">
                                <span class="mr-3"><i class="ti-user mr-2"></i>designation</span>

                            </div>
                            <!-- <div>
                                        <span class="mr-3">
                                            <span class="badge badge-primary badge-circle mr-2 font-14" style="height:30px;width:30px;"><i class="ti-briefcase"></i></span>Partner</span>
                                        <span>
                                            <span class="badge badge-pink badge-circle mr-2 font-14" style="height:30px;width:30px;"><i class="ti-cup"></i></span>Vip Status</span>
                                    </div> -->
                        </div>
                    </div>
                    <!-- <div class="d-inline-flex">
                                <div class="px-4 text-center">
                                    <div class="text-muted font-13">ARTICLES</div>
                                    <div class="h2 mt-2">134</div>
                                </div>
                                <div class="px-4 text-center">
                                    <div class="text-muted font-13">FOLLOWERS</div>
                                    <div class="h2 mt-2">540</div>
                                </div>
                            </div> -->
                </div>
            </div>
            <!-- <ul class="nav nav-tabs tabs-line m-0 pl-5 pr-3">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab">Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab">Activity</a>
                        </li>
                    </ul> -->
        </div>
    </div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <form action="">
                        <div class="ibox-head">
                            <div class="ibox-title">Admin profile</div>
                        </div>
                        <div class="ibox-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Name</label>
                                        <input class="form-control" type="text" placeholder="Enter Full Name" readonly>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Mobile No</label>
                                        <input class="form-control" type="number" placeholder="Mobile No" readonly>
                                        <!-- <span class="help-block">Please Enter your date of birth.</span> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Email</label>
                                        <input class="form-control" type="text" placeholder="Enter Email" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Address</label>
                                        <input class="form-control" type="text" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="ibox-footer">
                            <a href="<?php echo base_url() ?>/Admin1/edit_profile"><button class="btn btn-danger mr-2"
                                    type="button">Edit</button></a>
                            <!-- <button class="btn btn-outline-secondary" type="reset">Cancel</button> -->
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change profile image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <from>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label>Image</label>
                                    <input class="form-control" type="file" name="image" id="file"
                                        onchange="return fileValidation()" required>
                                </div>

                            </div>

                        </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="button" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('includes/footer.php');
    ?>