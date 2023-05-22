<?php
include('includes/header.php');
include('includes/sidebar.php');
?>
<style>
    .custom-design {}
</style>
<div class="content-wrapper">
    <!------->
    <div class="card">
        <div class="card-body">
            <h5>Single Pana </h5>
            <h6>Single Ank</h6>
            <div class="row game_num_row">
                <?php
                foreach ($rang as $row) {
                    ?>
                <div class="col-auto">
                    <div class="point-section light-green-box">
                        <?= $row ?>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <!------->

    <!-- END PAGE CONTENT-->

    <?php include('includes/footer') ?>