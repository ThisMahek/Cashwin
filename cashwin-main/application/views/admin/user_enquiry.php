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
                        <h5 class="font-strong mb-4">Users Query List</h5>
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
                            <th>User Name</th>

                            <th>Email</th>
                            <th>Query</th>
                            <th>Date</th>

                        </thead>
                        <?php
                        $i = 1;
                        foreach ($users as $post) {
                            ?>

                            <td>
                                <?php echo $i++; ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url(); ?>UserDashboard/<?php echo $post['user_id'] ?>"><?php echo fullNamewithMob($post['user_id']); ?></a>
                            </td>

                            <td>
                                <?php echo !empty($post['email']) ? $post['email'] : "___"; ?>
                            </td>
                            <td>
                                <?php echo $post['query']; ?>
                            </td>
                            <td>
                                <?= date("d/m/Y h:i:s A", strtotime($post['created_at'])); ?>
                            </td>

                            </tr>
                        <?php } ?>
                        <tbody>

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