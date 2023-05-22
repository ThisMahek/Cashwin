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
        <h4>View Game History</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="<?php echo site_url(); ?>administrator">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo base_url(); ?>administrator/matka/list">Matka List</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#!">View Game History</a>
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
                            <th>Username</th>
                            <th>Game</th>
                            <th>Game ID</th>
                            <th>Matka ID</th>
                            <th>Points</th>
                            <th>Digits</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Bet Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $post): ?>
                            <tr>
                                <td>
                                    <?php echo $post['id']; ?>
                                </td>
                                <td>
                                    <?php echo $post['user_id']; ?>
                                </td>
                                <td>
                                    <?php echo $post['username']; ?>
                                </td>
                                <td>
                                    <?php echo $post['name']; ?>
                                </td>
                                <td>
                                    <?php echo $post['game_id']; ?>
                                </td>
                                <td>
                                    <?php echo $post['matka_id']; ?>
                                </td>
                                <td>
                                    <?php echo $post['points']; ?>
                                </td>
                                <td>
                                    <?php echo $post['digits']; ?>
                                </td>
                                <td>
                                    <?php echo $post['date']; ?>
                                </td>
                                <td>
                                    <?php echo $post['time']; ?>
                                </td>
                                <td>
                                    <?php echo $post['bet_type']; ?>
                                </td>
                                <!-- <td>
                                        <img width="20px;" src="<?php echo site_url(); ?>assets/images/users/<?php echo $post['image']; ?> ">
                                     </td>-->
                                <!--<td><a href="edit-blog.php?id=14"><?php echo $post['name']; ?></a></td>-->
                                <!--<td><?php echo date("M d,Y", strtotime($post['register_date'])); ?></td>-->
                                <!-- <td>
                                     <?php if ($post['status'] == 1) { ?>
                                        <a class="label label-inverse-primary enable" href='<?php echo base_url(); ?>administrator/enable/<?php echo $post['id']; ?>?table=<?php echo base64_encode('user_profile'); ?>'>Enabled</a>
                                     <?php } else { ?>
                                        <a class="label label-inverse-warning desable" href='<?php echo base_url(); ?>administrator/desable/<?php echo $post['id']; ?>?table=<?php echo base64_encode('user_profile'); ?>'>Desabled</a>
                                     <?php } ?>
                                                <a class="label label-inverse-info" href='<?php echo base_url(); ?>administrator/users/update-user/<?php echo $post['id']; ?>'>Edit</a>
                                                <a class="label label-inverse-danger delete" href='<?php echo base_url(); ?>administrator/delete/<?php echo $post['id']; ?>?table=<?php echo base64_encode('user_profile'); ?>'>Delete</a>
                                            
                                        </td>-->
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