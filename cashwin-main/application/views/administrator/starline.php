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
        <h4>Starline List</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">Starline</a>
            </li>
            <li class="breadcrumb-item"><a href="#!">List Starline</a>
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
                            <th>Start Time</th>
                            <th>Start Time</th>
                            <th>Edit</th>
                            <th>View Games & Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($users as $post):

                            ?>
                            <tr>
                                <td>
                                    <?php echo $post['id']; ?>
                                </td>
                                <td>
                                    <?php echo $post['s_game_time']; ?>
                                </td>
                                <td>
                                    <?php echo $post['s_game_number']; ?>
                                </td>

                                <td>
                                    <a class="label label-inverse-info"
                                        href='<?php echo base_url(); ?>administrator/starline_update/<?php echo $post['id']; ?>'>Edit</a>
                                </td>

                                <td>
                                    <a class="label label-inverse-info"
                                        href='<?php echo base_url(); ?>administrator/view_games/<?php echo $post['id']; ?>'>Games</a>
                                    <a class="label label-inverse-info"
                                        href='<?php echo base_url(); ?>administrator/view_point_lists/<?php echo $post['id']; ?>'>Points</a>
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