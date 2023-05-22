<?php
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">

    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <div class="row" style="padding-bottom: 7px;">
                    <div class="col-md-8">
                        <h5 class="font-strong mb-4">Notice Managment</h5>
                    </div>
                    <div class="col-md-4">
                        <?php
                        if ($this->session->flashdata("success"))
                            echo "<p class='alert alert-success'>" . $this->session->flashdata("success") . "<p>";
                        ?>
                    </div>
                </div>


                <div class="table-responsive row">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <th>Sr. No.</th>
                            <th>Notice Title</th>
                            <th>Notice Date</th>
                            <!--<th>Action</th>-->
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($notification as $row) {
                                ?>
                                <tr>

                                    <td>
                                        <?= $i++; ?>
                                    </td>
                                    <td><?= $row->notification ?></td>
                                    <td>
                                        <?= date('d M Y', strtotime($row->time)) ?>
                                    </td>

                                    <!--<td>Edit</td>-->
                                    <tr />
                                <?php } ?>
                        </tbody>
                    </table>
                </div>
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
    <?php include('includes/footer.php') ?>