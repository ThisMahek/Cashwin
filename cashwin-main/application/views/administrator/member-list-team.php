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
        $(".disable").click(function (e) {
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
        <h4>Matka</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="<?php echo site_url(); ?>administrator">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>administrator/matka/list">Matka</a>
            </li>
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>administrator/matka/add">Add matka</a>
            </li>
        </ul>
    </div>
</div>
<!-- Page header end -->
<!-- Page body start -->
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <!-- Basic Form Inputs card start -->
            <div class="card">
                <div class="card-header">
                    <h5>Matka</h5>
                    <div class="card-header-right">
                        <i class="icofont icofont-rounded-down"></i>
                        <i class="icofont icofont-refresh"></i>
                        <i class="icofont icofont-close-circled"></i>
                    </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive dt-responsive">
                        <table id="dom-jqry" class="table table-striped table-responsive table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <!--<th>Image</th> -->
                                    <th>Matka Name</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Result</th>
                                    <th>Fake Start Time</th>
                                    <th>Fake End Time</th>
                                    <th>Assigned User</th>
                                    <th>Chart Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($teams as $team): ?>
                                    <tr>
                                        <td>
                                            <?php echo $team['id']; ?>
                                        </td>
                                        <!-- <td>
                                            <img width="20px;" src="<?php echo site_url(); ?>assets/images/teams/<?php echo $team['image']; ?> ">                                           
                                        </td> -->
                                        <td><a
                                                href="<?php echo base_url(); ?>administrator/update_matka/<?php echo $team['id']; ?>"><?php echo $team['name']; ?></a></td>

                                        <td>
                                            <?php echo $team['start_time']; ?>
                                        </td>
                                        <td>
                                            <?php echo $team['end_time']; ?>
                                        </td>
                                        <td>
                                            <?php echo $team['starting_num'] . "-" . $team['number'] . "-" . $team['end_num']; ?>
                                        </td>
                                        <td>
                                            <?php echo $team['fake_start_time']; ?>
                                        </td>
                                        <td>
                                            <?php echo $team['fake_end_time']; ?>
                                        </td>
                                        <td>
                                            <?php echo $team['assigned_user']; ?>
                                        </td>
                                        <td>
                                            <?php echo date("M d,Y", strtotime($team['created_at'])); ?>
                                        </td>
                                        <td>
                                            <?php /* if($team['status'] == 1){ ?>
                                             <a class="label label-inverse-primary enable" href='<?php echo base_url(); ?>administrator/disable/<?php echo $team['id']; ?>?table=<?php echo base64_encode('matka'); ?>'>Enabled</a> 
                                             <?php }else{ ?> 
                                             <a class="label label-inverse-warning disable" href='<?php echo base_url(); ?>administrator/enable/<?php echo $team['id']; ?>?table=<?php echo base64_encode('matka'); ?>'>Disabled</a>
                                             <?php } */?>
                                            <!-- Edit Button -->
                                            <a class="label label-inverse-info"
                                                href='<?php echo base_url(); ?>administrator/update_matka/<?php echo $team['id']; ?>'>Edit</a>
                                            <!-- Delete Button -->
                                            <!--   <a class="label label-inverse-danger delete" href='<?php /* echo base_url(); ?>administrator/delete/<?php echo $team['id']; */?>?table=<?php /*echo base64_encode('matka');*/?>'>Delete</a>  -->

                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Basic Form Inputs card end -->


    <script type="text/javascript"
        src="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript"
        src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/swithces.js"></script>
    <script type="text/javascript"
        src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/moment-with-locales.min.js"></script>
    <script type="text/javascript"
        src="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript"
        src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>
    <!-- Date-range picker js -->
    <script type="text/javascript"
        src="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript"
        src="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.js"></script>


    <!-- ck editor -->
    <script src="<?php echo base_url(); ?>admintemplate/bower_components/ckeditor/ckeditor.js"></script>
    <!-- echart js -->

    <script src="<?php echo base_url(); ?>admintemplate/assets/pages/user-profile.js"></script>