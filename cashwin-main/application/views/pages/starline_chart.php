<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="shortcut icon" href="assets/images/logo2.png" type="image/x-icon">-->
    <meta name="description" content="">
    <title>JANNAT MATKA </title>
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
    </style>


</head>

<body>



    <section class="menu cid-qyXbTBAY8L" once="menu" id="menu3-8p" data-rv-view="3302">




        <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="https://jannatonline.in/">
                        <!--<img src="" alt="JANNAT MATKA" title="JANNAT MATKA" media-simple="true" style="height: 3.8rem;">-->
                        <H2>JANNAT MATKA</H2>
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
                        <a class="nav-link link text-white  display-4" href="https://jannatonline.in/"
                            aria-expanded="false">
                            HOME</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-white  display-4" href="" data-toggle="dropdown-submenu"
                            aria-expanded="false">
                            HOW TO PLAY</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-white  display-4" href="game_rates" aria-expanded="false">
                            GAME RATES</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-white  display-4" href="" data-toggle="dropdown-submenu"
                            aria-expanded="false">
                            NOTICEBOARD/RULES</a>

                    </li>
                    </li>
                    <a class="nav-link link text-white  display-4" target="_blank"
                        href="https://play.google.com/store/apps/details?id=in.games.jannat&hl=en">
                        <li class="nav-item"><img src="img/janntfinallogo.png" style="height:30px;width:175px">
                    </a></li>
                </ul>

            </div>
        </nav>
    </section>

    <section>
        <br><br>
        <br><br><br>
        <center>
            <h2 style="color:#C93756;font-weight:bold;">
                <?= $chart[0]['name'] . " Chart"; ?>
            </h2>
        </center>
        <br>

        <center>
            <div class="RECORD" style="width:50%;">
                <table cellspacing="0" style="text-align: center;width:100%;padding:0" class="table table-striped">
                    <?php
                    $round = 6;
                    if ($sun)
                        $round = 7;
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
                                    //$ch = "Starline Chart ".$chart[0]['name'];
                                    $ch = $this->Chart_Model->getChartDetailName($chart[0]['name'], $date);
                                    if ($ch == null) { ?>
                                        <td style="padding:0"><span class="d" style="color:red">
                                                <?php echo '**'; ?>
                                            </span></td>
                                    <?php } else { ?>
                                        <td style="padding:0"><span class="d" style="color:">
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
        </center>
        <br>
    </section>


    <section class="cid-qz2YU1tayr" id="footer4-8u" data-rv-view="3299" style="background: #044F67">



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