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
                        <h5 class="font-strong mb-4">Manage Slider</h5>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#add">Add</button>
                    </div>
                </div>
                <center>
                    <div style="color:green; ">
                        <h5>
                            <?php echo $this->session->flashdata('success'); ?>
                        </h5>
                    </div>
                </center>

                <div class="table-responsive row">
                    <table class="table table-bordered table-hover" id="datatable">
                        <thead class="thead-default thead-lg">
                            <tr>
                                <th>Sr.No.</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($manage_slider as $post): ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                    </td>
                                    <td>
                                        <?php echo $post['title']; ?>
                                    </td>
                                    <td><img src="<?= base_url() ?><?= $post['image'] ?>" width="100px" height="100px"></td>
                                    <td>
                                        <?php if ($post['status'] == "1"): ?>
                                            <button class="btn-sm btn-primary"
                                                onclick="deactivate(<?= $post['id'] ?>)">Active</button>
                                        <?php else: ?>
                                            <button class="btn-sm btn-danger"
                                                onclick="activate(<?= $post['id'] ?>)">Inactive</button>
                                        <?php endif; ?>
                                    </td>
                                    <td><a class="btn btn-success" data-toggle="modal"
                                            data-target="#modaldemo<?php echo $post['id'] ?>">Edit</a></td>

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

                                            <form action="<?= base_url('admin/add_slider') ?>" method="post"
                                                enctype="multipart/form-data">
                                                <div class="modal-body card-body extra-details">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Title</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="title" class="form-control"
                                                                value="<?php echo $post['title'] ?>">
                                                        </div>
                                                    </div>
                                                    <!--<div class="form-group row">-->
                                                    <!--    <label class="col-sm-2 col-form-label">Image</label>-->
                                                    <!--    <div class="col-sm-10">-->
                                                    <!--    <input type="file"  class="" name="image" id="slider0" value="">-->
                                                    <!--    </div>-->
                                                    <!--</div>-->
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Image</label>
                                                        <div class="col-sm-10">
                                                            <input type="file" name="image" id="slider0"
                                                                onchange="preview(this,0)">
                                                            <img src="<?= base_url() ?><?= $post['image'] ?>" alt=""
                                                                id="image0" height="100px">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="slider_id" value="<?php echo $post['id'] ?>">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary" type="submit"
                                                        name="submit">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- modal-dialog -->
                                </div>
                                <?php $i++; endforeach; ?>

                            <!-- <div class="paginate-link">
                                    <?php //echo $this->pagination->create_links(); ?>
                                </div>  -->

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="add" class="modal fade show">
        <div class="modal-dialog" role="document">
            <div class="modal-content bd-0 tx-14">
                <div class="modal-header pd-y-20 pd-x-25">
                    <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/add_slider') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body card-body extra-details">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="" name="image" id="slider0" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                    </div>
                </form>
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
    <script>
        function activate(id) {
            if (confirm('Are you sure to activate this slider ?')) {
                //AJAX method: Activate
                window.location.href = "<?php echo current_url() ?>/activate_slider/" + id;
            } else {
                event.preventDefault();
            }
        }

        function deactivate(id) {
            if (confirm('Are you sure to deactivate this slider ?')) {
                //AJAX method: Deactivate
                window.location.href = "<?php echo current_url() ?>/deactivate_slider/" + id;
            } else {
                event.preventDefault();
            }
        }

    </script>
    <?php include('includes/footer.php') ?>