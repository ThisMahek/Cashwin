<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/kalyan_vip.jpeg" type="image/x-icon">
    <meta name="description" content="">
    <title>Aryan Games</title>
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
    <script src="https://kit.fontawesome.com/3c4d0cb5a7.js" crossorigin="anonymous"></script>
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
            border-color: #893bff;
            border-style: groove;
            text-shadow: 1px 1px #ffd700;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .d {
            font-size: 25px;
        }

        @media only screen and (max-width: 600px) {

            .table td,
            .table th {
                padding: .0rem !important;
            }

            .table-bordered thead td,
            .table-bordered thead th {
                border-bottom-width: 1px !important;
                font-weight: 600 !important;
                font-size: 8px !important;
            }

            .font-20 {
                font-size: 20px !important;
            }
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary.focus {
            color: #ffffff !important;
            background-color: #111;
            border-color: #111;
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
    </style>


</head>

<body>



    <section class="menu cid-qyXbTBAY8L" once="menu" id="menu3-8p" data-rv-view="3302">
        <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>assets/img/kalyan_vip.jpeg">
                        <!--<h4 class="text-white">Aryan Games</h4>-->
                    </a>

                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-5" href="">
                    </a></span>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                    <li class="nav-item">
                        <a class="nav-link link text-white  display-4" href="<?php echo base_url(); ?>"
                            aria-expanded="false">
                            Home</a>
                    </li>
                    <li>
                        <a class="nav-link link text-white  display-4"
                            href="<?php echo base_url(); ?>Pages/privacy_policy" aria-expanded="false">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a class="nav-link link text-white display-4 btn btn-primary"
                            style="padding: 10px;margin: 5px;background: #111!important; border-color: #111;"
                            href="<?= base_url() ?>app/AryanGames.apk" aria-expanded="false">
                            <i class="fa fa-download"></i> &nbsp; Download App </a>
                    </li>
                </ul>

            </div>
        </nav>
    </section>

    <section>
        <br><br>
        <br><br><br>
        <center>
            <h2 class="font-20" style="color:#C93756;font-weight:bold;"> Starline Chart</h2>
        </center>
        <br>

        <center>
            <div class="container">

                <table class="table table-striped table-bordered table-responsive text-center bg-white">
                    <thead>
                        <tr>
                            <th colspan="13" class="bg-warning text-danger" style="color:white !important;">STARLINE
                                CHART</th>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <?php
                            //print_r($time);
                            foreach ($time as $t) {
                                ?>
                                <th>
                                    <?php echo $t['s_game_time'] ?>
                                </th>
                            <?php }
                            ?>
                        </tr>
                        <?php
                        // print_r($chart);
                        foreach ($chart as $k => $c) {
                            ?>
                            <tr>
                                <th>
                                    <?php echo $k ?><br>
                                    <?php echo date('D', strtotime($k)) ?>
                                </th>
                                <?php
                                foreach ($time as $t1) {
                                    $id = $t1['id'];
                                    $start_numb = $c[$id]['start_num'];
                                    $rest_numb = $c[$id]['rest_num']
                                        ?>
                                    <td>
                                        <?php echo $start_numb ?><br><b>
                                            <?php echo $rest_numb ?>
                                        </b>
                                    </td>
                                <?php }
                                ?>
                            </tr>
                            <?php
                        }
                        ?>
                    </thead>
                </table>
            </div>






        </center>
        <br>
    </section>


    <section class="cid-qz2YU1tayr" id="footer4-8u" data-rv-view="3299" style="background:#5f9ea0">



        <div class="mbr-overlay" style="background-color: rgb(35, 35, 35); opacity: 0.4;"></div>

        <div class="container">
            <h6 class="text-white text-center">&copy; ALL RIGHTS RESERVED</h6>
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