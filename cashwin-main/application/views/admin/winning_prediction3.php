<?php
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-body">
                <h5>
                    <?= ucwords(str_replace("-", " ", $type)) ?> Numbers
                </h5>
                <?php
                if ($game_type == 'pana') {
                    ?>
                    <h6>Single Ank</h6>
                    <div class="row game_num_row">
                        <div class="col-auto">
                            <div class="point-section light-red-box">
                                12
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row game_num_row">
                    <!--<div class="col-auto">-->
                    <!--    <div class="point-section light-green-box">-->
                    <!--        12-->
                    <!--    </div>-->
                    <!--</div>-->
                    <?php
                    foreach ($rang as $row) {
                        // print_r($row);
                    
                        ?>
                        <div class="col-auto">
                            <div class="point-section light-green-box">
                                <?= ($row > 9) ? $row : $prefix . $row ?>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

</div>
<?php include('includes/footer.php') ?>