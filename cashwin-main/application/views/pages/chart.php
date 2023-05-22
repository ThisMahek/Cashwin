<!DOCTYPE html>
<html>

<head>
    <title>JANNAT MATKA</title>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo1.png" type="image/x-icon">
    <!--<link rel="stylesheet" href="assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css">-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <!--<link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">-->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="assets/socicon/css/styles.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/theme/css/style.css">
    <!--<link rel="stylesheet" href="assets/mobirise-gallery/style.css">-->
    <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
    <style>
        .RECORD {
            background-color: #fff;
            color: #000;
            font-weight: 700;
            font-style: italic;
            font-size: large;
            /*border-width: 5px;*/
            /*border-color: #893bff;*/
            border-style: groove;
            text-shadow: 1px 1px #ffd700;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        @media only screen and (min-width: 992px) {
            .RECORD {
                background-color: #fff;
                color: #000;
                font-weight: 700;
                font-style: italic;
                font-size: 20px;
                /*border-width: 5px;*/
                /*border-color: #893bff;*/
                border-style: groove;
                text-shadow: 1px 1px #ffd700;
                padding-top: 10px;
                padding-bottom: 10px;
            }

        }

        tr {
            border-bottom: 1px solid gray;
        }

        p {
            text-align: center;
            margin-bottom: 0;
        }
    </style>
</head>

<body style="background-color: #eeeeee;">
    <div class="container-fluid" style="margin-top: 90px;">
        <section class="menu cid-qyXbTBAY8L" once="menu" id="menu3-8p" data-rv-view="3302">
            <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
                <div class="navbar-brand">
                    <span class="navbar-logo">
                        <a href="https://jannatonline.in/">
                            <!--<img src="" alt="JANNAT MATKA" title="JANNAT MATKA" media-simple="true" style="height: 3.8rem;">-->
                            <h2 style="font-size: 16px;">JANNAT MATKA</h2>
                        </a>
                    </span>
                    <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-5" href=""></a></span>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
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
                                aria-expanded="false">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-white  display-4" href="" data-toggle="dropdown-submenu"
                                aria-expanded="false">HOW TO PLAY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-white  display-4" href="game_rates" aria-expanded="false">GAME
                                RATES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link text-white  display-4" href="" data-toggle="dropdown-submenu"
                                aria-expanded="false">NOTICEBOARD/RULES</a>
                        </li>
                        <a class="nav-link link text-white  display-4" target="_blank"
                            href="https://play.google.com/store/apps/details?id=in.games.jannat&hl=en">
                            <li class="nav-item"><img src="img/janntfinallogo.png" style="height:30px;width:175px">
                        </a></li>
                    </ul>
                </div>
            </nav>
        </section>
        <!--<div class="container-fluid" style="background: #eeeeee;">-->
        <section>
            <div class="row mb-4">
                <div class="d-lg-none d-md-none d-xl-none d-block" style="width:100%;">
                    <h2 style="color:#C93756;font-weight:bold; text-align: center;text-transform: uppercase;">
                        <?php echo $chart[0]['name'] . " " . "Chart" ?>
                    </h2>
                    <div class="table-responsive">
                        <table cellspacing="0" class="bg-white RECORD" style="background:white;margin:auto"
                            width="100%">
                            <thead>
                                <tr>
                                    <td>
                                        <p style="text-align: center;">DATE</p>
                                    </td>
                                    <td colspan="3">MON</td>
                                    <td colspan="3">TUE</td>
                                    <td colspan="3">WED</td>
                                    <td colspan="3">THU</td>
                                    <td colspan="3">FRI</td>
                                    <?php $round = 5;
                                    if ($sat): ?>
                                        <td colspan="3">SAT</td>
                                        <?php
                                        $round = 6;
                                        if ($sun):
                                            $round = 7; ?>
                                            <td colspan="3">SUN</td>
                                        <?php endif; endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //$chartdate = array_reverse($chartdate);
                                foreach ($chartdate as $chs) {
                                    ?>
                                    <tr>
                                        <td>
                                            <p style='font-size:10px'>
                                                <?php echo $chs['s']; ?><br>to<br>
                                                <?php echo $chs['e']; ?>
                                            </p>
                                        </td>
                                        <?php
                                        $date = $chs['s'];
                                        for ($ii = 0; $ii < $round; $ii++):
                                            $ch = $this->Chart_Model->getChartDetailName($chart[0]['name'], $date);
                                            //print_r($ch);
                                            $star = 0;
                                            if ($ch == null):
                                                $star = 1;
                                            endif;
                                            $st = $ch['starting_num']; //145
                                            $s = array();
                                            for ($i = 0; $i < strlen($st); $i++):
                                                $s[] = substr($st, $i, 1);
                                            endfor;
                                            $en = $ch['end_num']; //145
                                            $s1 = array();
                                            for ($j = 0; $j < strlen($en); $j++):
                                                $s1[] = substr($en, $j, 1);
                                            endfor;
                                            if ($star == 1) { ?>
                                                <td style="color:red; font-size:10px;">
                                                    <?php echo '*' . '<br>' . '*' . '<br>' . '*'; ?>
                                                </td>
                                                <td><span class="d" style="color:red; font-size:14px;">
                                                        <?php echo '**'; ?>
                                                    </span></td>
                                                <td style="color:red; font-size:10px;">
                                                    <?php echo '*' . '<br>' . '*' . '<br>' . '*'; ?>
                                                </td>
                                            <?php } else { ?>
                                                <td style="font-size:10px;">
                                                    <?php echo $s[0] . '<br>' . $s[1] . '<br>' . $s[2]; ?>
                                                </td>
                                                <td style="font-size:14px;"><span class="d">
                                                        <?php echo $ch['result_num']; ?>
                                                    </span></td>
                                                <td style="font-size:10px;">
                                                    <?php echo $s1[0] . '<br>' . $s1[1] . '<br>' . $s1[2]; ?>
                                                </td>
                                            <?php }
                                            if ($date == date('Y-m-d'))
                                                break;
                                            $date = date('Y-m-d', strtotime('+1 days', strtotime($date)));
                                        endfor;
                                }
                                // if($c<$round)
                                // {
                                //     $c1 = $round-$c;
                                //     for($k=0; $k<$c1; $k++) {
                                //         ?>
                                    <!--<td></td>-->
                                    <!--<td></td>-->
                                    <!--<td></td>-->
                                    <?php
                                    //     }
                                    // }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </section>

        <!--Laptop Menu start-->
        <section class="">
            <div class="row mb-4">
                <div class="d-none d-xs-none d-md-block d-lg-block d-xl-block" style="width:100%;">
                    <h2 style="color:#C93756;font-weight:bold; text-align: center;text-transform: uppercase;">
                        <?php echo $chart[0]['name'] . " " . "Chart" ?>
                    </h2>
                    <div class="table-responsive">
                        <table cellspacing="0" class="bg-white RECORD" style="background:white;margin:auto" width="70%">
                            <thead>
                                <tr>
                                    <td>
                                        <p style="text-align: center;">DATE</p>
                                    </td>
                                    <td colspan="3">MON</td>
                                    <td colspan="3">TUE</td>
                                    <td colspan="3">WED</td>
                                    <td colspan="3">THU</td>
                                    <td colspan="3">FRI</td>
                                    <?php $round = 5;
                                    if ($sat): ?>
                                        <td colspan="3">SAT</td>
                                        <?php
                                        $round = 6;
                                        if ($sun):
                                            $round = 7; ?>
                                            <td colspan="3">SUN</td>
                                        <?php endif; endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //$chartdate = array_reverse($chartdate);
                                foreach ($chartdate as $chs) {
                                    ?>
                                    <tr>
                                        <td>
                                            <p style='font-size:20px'>
                                                <?php echo $chs['s']; ?><br>to<br>
                                                <?php echo $chs['e']; ?>
                                            </p>
                                        </td>
                                        <?php
                                        $date = $chs['s'];
                                        for ($ii = 0; $ii < $round; $ii++):
                                            $ch = $this->Chart_Model->getChartDetailName($chart[0]['name'], $date);
                                            //print_r($ch);
                                            $star = 0;
                                            if ($ch == null):
                                                $star = 1;
                                            endif;
                                            $st = $ch['starting_num']; //145
                                            $s = array();
                                            for ($i = 0; $i < strlen($st); $i++):
                                                $s[] = substr($st, $i, 1);
                                            endfor;
                                            $en = $ch['end_num']; //145
                                            $s1 = array();
                                            for ($j = 0; $j < strlen($en); $j++):
                                                $s1[] = substr($en, $j, 1);
                                            endfor;
                                            if ($star == 1) { ?>
                                                <td style="color:red; font-size:20px;">
                                                    <?php echo '*' . '<br>' . '*' . '<br>' . '*'; ?>
                                                </td>
                                                <td><span class="d" style="color:red; font-size:24px;">
                                                        <?php echo '**'; ?>
                                                    </span></td>
                                                <td style="color:red; font-size:20px;">
                                                    <?php echo '*' . '<br>' . '*' . '<br>' . '*'; ?>
                                                </td>
                                            <?php } else { ?>
                                                <td style="font-size:20px;">
                                                    <?php echo $s[0] . '<br>' . $s[1] . '<br>' . $s[2]; ?>
                                                </td>
                                                <td style="font-size:24px;"><span class="d">
                                                        <?php echo $ch['result_num']; ?>
                                                    </span></td>
                                                <td style="font-size:20px;">
                                                    <?php echo $s1[0] . '<br>' . $s1[1] . '<br>' . $s1[2]; ?>
                                                </td>
                                            <?php }
                                            if ($date == date('Y-m-d'))
                                                break;
                                            $date = date('Y-m-d', strtotime('+1 days', strtotime($date)));
                                        endfor;
                                }
                                // if($c<$round)
                                // {
                                //     $c1 = $round-$c;
                                //     for($k=0; $k<$c1; $k++) {
                                //         ?>
                                    <!--<td></td>-->
                                    <!--<td></td>-->
                                    <!--<td></td>-->
                                    <?php
                                    //     }
                                    // }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </section>
        <!--laptop menu end-->

        <section class="cid-qz2YU1tayr" id="footer4-8u" data-rv-view="3299" style="background: #044F67">
            <div class="mbr-overlay" style="background-color: rgb(35, 35, 35); opacity: 0.4;"></div>
            <div class="container">
                <h6 class="text-white text-center">&copy; ALL RIGHTS RESERVED</h6>
            </div>
        </section>
    </div>
</body>
<script src="assets/web/assets/jquery/jquery.min.js"></script>
<script src="assets/popper/popper.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/typed/typed.min.js"></script>
<script src="assets/smooth-scroll/smooth-scroll.js"></script>
<!--<script src="assets/mobirise-shop/script.js"></script>-->
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/touch-swipe/jquery.touch-swipe.min.js"></script>
<script src="assets/jarallax/jarallax.min.js"></script>
<script src="assets/theme/js/script.js"></script>
<!--<script src="assets/mobirise-gallery/player.min.js"></script>-->
<!--<script src="assets/mobirise-gallery/script.js"></script>-->

</html>