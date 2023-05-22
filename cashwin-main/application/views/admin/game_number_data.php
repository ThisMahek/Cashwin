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
                if ($type == 'half-sangam' || $type == 'full-sangam') {
                    ?>
                    <h6>Open Ank</h6>
                <?php } ?>
                <div class="row game_num_row">
                    <?php
                    foreach ($single_ank as $ank) {
                        ?>


                        <div class="col-auto">
                            <div class="point-section light-green-box">
                                <?= $ank ?>
                            </div>
                        </div>

                    <?php } ?>
                </div>
                <?php
                if ($type == 'half-sangam' || $type == 'full-sangam') {
                    ?>
                    <h6>Close Ank</h6>
                <?php } ?>

                <div class="row game_num_row">
                    <!--<div class="col-auto">-->
                    <!--    <div class="point-section light-green-box">-->
                    <!--        12-->
                    <!--    </div>-->
                    <!--</div>-->
                    <?php
                    foreach ($rang as $row) {
                        if ($type != 'jodi-digit') {
                            $num = $row;
                        } else {
                            $num = ($row > 9) ? $row : $prefix . $row;
                        }

                        ?>
                        <div class="col-auto">
                            <div class="point-section light-green-box">

                                <?= $num ?>
                                <!--<?= ($row > 9) ? $row : $prefix . $row ?>-->
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

</div>
<?php include('includes/footer.php') ?>