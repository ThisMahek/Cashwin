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
            <h5>Jodi Digit</h5>
            <h6>Single Ank</h6>
            <!--<div class="row game_num_row">-->
            <!--    <div class="col-auto">-->
            <!--        <div class="point-section light-red-box">-->
            <!--            12-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="row game_num_row">
                <!--<div class="col-auto">-->
                <!--    <div class="point-section light-green-box">-->
                <!--        12-->
                <!--    </div>-->
                <!--</div>-->
                <?php
                for ($i = 0; $i <= 9; $i++) {
                    for ($j = 0; $j <= 9; $j++) {


                        ?>
                        <div class="col-auto">
                            <div class="point-section light-green-box">
                                <?= $i . "" . $j ?>
                            </div>
                        </div>
                    <?php }
                } ?>
                <!--<div class="col-auto">-->
                <!--    <div class="point-section light-green-box">-->
                <!--        12-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-auto">-->
                <!--    <div class="point-section light-green-box">-->
                <!--        12-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-auto">-->
                <!--    <div class="point-section light-green-box">-->
                <!--        12-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-auto">-->
                <!--    <div class="point-section light-green-box">-->
                <!--        12-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-auto">-->
                <!--    <div class="point-section light-green-box">-->
                <!--        12-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-auto">-->
                <!--    <div class="point-section light-green-box">-->
                <!--        12-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-auto">-->
                <!--    <div class="point-section light-green-box">-->
                <!--        12-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-auto">-->
                <!--    <div class="point-section light-green-box">-->
                <!--        12-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-auto">-->
                <!--    <div class="point-section light-green-box">-->
                <!--        12-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-auto">-->
                <!--    <div class="point-section light-green-box">-->
                <!--        12-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-auto">-->
                <!--    <div class="point-section light-green-box">-->
                <!--        12-->
                <!--    </div>-->
                <!--</div>-->

            </div>
        </div>
    </div>
    <!------->

    <!-- END PAGE CONTENT-->

    <?php include('includes/footer') ?>