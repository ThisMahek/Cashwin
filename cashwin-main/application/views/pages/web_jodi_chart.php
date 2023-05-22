<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/finalav.png" type="image/x-icon">
    <meta name="description" content="">
    <title>AV Online Games</title>
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <link rel="stylesheet" href="assets/mobirise-gallery/style.css">
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
    <style>
        .text-white {
            color: white !important;
        }

        .RECORD {
            background-color: #fff;
            color: #000;
            font-weight: 700;
            font-style: italic;
            font-size: largeD225972056 border-width: 5px;
            border-color: #5f9ea0;
            border-style: groove;
            text-shadow: 1px 1px #ffd700;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .d {
            font-size: 25px;
        }

        @media only screen and (max-width: 600px) {
            .font-size {
                font-size: 25px;
            }
        }

        @media only screen and (max-width: 600px) {
            .d {
                font-size: 14px !important;
            }
        }

        .navbar-dropdown .navbar-logo img {
            height: 3.125rem;
            transition: all 0.3s ease-in-out;
            transform: scale(1.5);
        }

        .cid-qyXbTBAY8L .navbar {
            min-height: 77px;
            transition: all .3s;
            background: cadetblue;
        }

        .cid-qyXbTBAY8L .navbar.navbar-short {
            background: cadetblue !important;
            min-height: 60px;
        }

        .heading {
            position: absolute;
            top: 200px;
            right: 230px;
            color: white;
        }

        .mytble2 {
            background-color: #5f9ea0 !important;
        }

        .mytble2 tr:nth-child(odd) {
            color: white;
        }

        .table-bordered {
            border: 1px solid #d8bb6c;
        }

        .bg-primary {
            background-color: #5f9ea0 !important;
        }

        .bg-warning {
            background-color: #5f9ea0 !important;
        }

        .table-color {
            border-style: solid;
            border-color: #7d0506;
            background-color: #f9f5a2fc;
            color: #000000;
        }

        .button2 {
            top: 70px;
            right: 10px;
            z-index: 99;
            border: none;
            outline: none;
            background-color: #21b304;
            color: #fff !important;
            cursor: pointer;
            padding: 10px;
            border-radius: 3px;
            text-decoration: none;
        }

        @media only screen and (min-width: 768px) {
            .position-absolute {
                position: absolute;
                left: 50%;

                bottom: -60px;
            }
        }

        @media only screen and (max-width: 600px) {
            .position-absolute {
                position: absolute;
                left: 8rem;

                bottom: -60px;
            }
        }
    </style>
</head>

<body style="background-color: #eeeeee;">
    <section style="margin-top:0px; margin-bottom:0px;">
        <div class="container bg-white table-color">
            <center>
                <h2 style="color:#C93756;font-weight:bold; text-transform:uppercase;padding-top:20px;">
                    <?php echo $chart[0]['name'] . " " . "Chart" ?>
                </h2>
            </center>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="RECORD mb-4" style="width:100%;">
                        <table cellspacing="0" style="text-align: center;width:100%;padding:0px"
                            class="table table-striped">
                            <?php
                            $round = 5;
                            if ($sat)
                                $round = 6;
                            ?>
                            <tbody>
                                <?php
                                //$chartdate = array_reverse($chartdate);
                                foreach ($chartdate as $chs) {
                                    ?>
                                    <tr>
                                        <?php
                                        $date = $chs['s'];
                                        for ($ii = 0; $ii < $round; $ii++):
                                            $ch = $this->Chart_Model->getChartDetailName($chart[0]['name'], $date);
                                            if ($ch == null) { ?>
                                                <td style="padding:10px;"><span class="d" style="color:red">
                                                        <?php echo '**'; ?>
                                                    </span></td>
                                            <?php } else { ?>
                                                <td style="padding:10px;"><span class="d" style="color:">
                                                        <?php echo $ch['result_num']; ?>
                                                    </span></td>
                                            <?php }
                                            if ($date == date('Y-m-d'))
                                                break;
                                            $date = date('Y-m-d', strtotime('+1 days', strtotime($date)));
                                        endfor;
                                }
                                ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
    <script src="assets/web/assets/jquery/jquery.min.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/typed/typed.min.js"></script>
    <script src="assets/smooth-scroll/smooth-scroll.js"></script>
    <script src="assets/mobirise-shop/script.js"></script>
    <script src="assets/dropdown/js/script.min.js"></script>
    <script src="assets/touch-swipe/jquery.touch-swipe.min.js"></script>
    <script src="assets/jarallax/jarallax.min.js"></script>
    <script src="assets/theme/js/script.js"></script>
    <script src="assets/mobirise-gallery/player.min.js"></script>
    <script src="assets/mobirise-gallery/script.js"></script>
</body>

</html>