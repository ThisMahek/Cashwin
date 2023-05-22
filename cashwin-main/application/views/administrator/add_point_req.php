<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/assets/pages/data-table/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/bower_components/ekko-lightbox/dist/ekko-lightbox.css">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/bower_components/lightbox2/dist/css/lightbox.css">





<div class="page-header">
    <div class="page-header-title">
        <h4>Add Points</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="index-2.html">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>

            <li class="breadcrumb-item"><a href="#!">Add Points</a>
            </li>
        </ul>
    </div>
</div>

<!-- Page-header end -->
<!-- Page-body start -->
<div class="page-body">
    <!-- DOM/Jquery table start -->

    <div class="card">
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
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
                        <?php foreach ($users as $post): ?>
                            <tr>
                                <td>
                                    <?php echo $post['request_id']; ?>
                                </td>

                                <td>
                                    <?php echo $post['user_id']; ?></a>
                                </td>
                                <td>
                                    <?php echo $post['request_points']; ?>
                                </td>
                                <td>
                                    <?php echo $post['time']; ?>
                                </td>
                                <td>
                                    <?php echo $post['request_status']; ?>
                                </td>
                                <td>
                                    <?php
                                    if ($post['request_status'] == "pending") {
                                        ?>
                                        <a class="label label-inverse-danger delete"
                                            href='<?php echo base_url(); ?>administrator/add_point_req2/<?php echo $post['request_id']; ?>'>Approve</a>
                                    <?php
                                    } else { ?>
                                        Approved
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <!-- <div class="paginate-link">
                                    <?php //echo $this->pagination->create_links(); ?>
                                </div>  -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- DOM/Jquery table end -->
</div>