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

<script type="text/javascript">
    $(document).ready(function () {
        $(".delete").click(function (e) {
            alert('as');
            $this = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function (r) {
                if (r.success) {
                    $this.closest("tr").remove();
                }
            })
        });
    });
    $(document).ready(function () {
        $(".enable").click(function (e) {
            alert('as');
            $this = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function (r) {
                if (r.success) {
                    $this.closest("tr").remove();
                }
            })
        });
    });
    $(document).ready(function () {
        $(".desable").click(function (e) {
            alert('as');
            $this = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function (r) {
                if (r.success) {
                    $this.closest("tr").remove();
                }
            })
        });
    });
</script>



<div class="page-header">
    <div class="page-header-title">
        <h4>List
            <?php echo $title; ?>
        </h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="index-2.html">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">
                    <?php echo $title; ?>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">List
                    <?php echo $title; ?>
                </a>
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sliders as $post): ?>
                            <tr>
                                <td>
                                    <?php echo $post['id']; ?>
                                </td>
                                <td>
                                    <img width="20px;"
                                        src="<?php echo site_url(); ?>assets/images/sliders/<?php echo $post['image']; ?> ">
                                </td>
                                <td><a href="">
                                        <?php echo $post['title']; ?>
                                    </a></td>
                                <td>
                                    <?php if ($post['status'] == 1) { ?>
                                        <a class="label label-inverse-primary enable"
                                            href='<?php echo base_url(); ?>administrator/enable/<?php echo $post['id']; ?>?table=<?php echo base64_encode('sliders_img'); ?>'>Enabled</a>
                                    <?php } else { ?>
                                        <a class="label label-inverse-warning desable"
                                            href='<?php echo base_url(); ?>administrator/desable/<?php echo $post['id']; ?>?table=<?php echo base64_encode('sliders_img'); ?>'>Desabled</a>
                                    <?php } ?>
                                    <a class="label label-inverse-info"
                                        href='<?php echo base_url(); ?>administrator/users/update-user/<?php echo $post['id']; ?>'>Edit</a>
                                    <a class="label label-inverse-danger delete"
                                        href='<?php echo base_url(); ?>administrator/delete/<?php echo $post['id']; ?>?table=<?php echo base64_encode('sliders_img'); ?>'>Delete</a>

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