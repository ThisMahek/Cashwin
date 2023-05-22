<!DOCTYPE html>
<?php
error_reporting(0);
?>
<html>

<head>
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="shortcut icon" href="<?= base_url() ?>assets/img/finalav.png" type="image/x-icon">
   <meta name="description" content="">
   <title>AV Online Game</title>
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
      table thead {
         background: #ffc107 !important;
      }



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
         padding-top: 0px;
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

      @media only screen and (max-width: 600px) {
         td {
            font-size: 10px !important;
         }
      }

      @media only screen and (max-width: 600px) {
         .mobile-view {
            display: none;
         }
      }

      .margin-top {
         margin-top: 20px;
      }

      td {
         font-size: 12px !important;
      }

      span {
         font-size: 16px !important;
         margin-top: 5px;
      }

      tr {
         border-bottom: 1px solid gray;
      }

      .subh {
         height: 60px;
         width: 60px;
         border-radius: 50%;
         padding: 20px;
         background: red;
         color: white;
         text-align: center;
      }

      .container {
         margin-bottom: 80px;
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
   </style>

</head>

<body style="background-color: #eeeeee;">
   <section>
      <div class="container" style="margin-top:50px;">
         <div class="d-lg-none d-md-none d-xs-block d-sm-block d-block table-color">
            <center>
               <h2 style="color:#C93756;font-weight:bold;text-transform:uppercase;">
                  <?php echo $chart[0]['name'] . " " . "Chart" ?>
               </h2>
               <br>
            </center>
            <div class="row ">
               <div class="col-md-2"></div>
               <div class="col-md-8">
                  <center>
                     <div class="RECORD">
                        <table style="width:100%;">
                           <thead>
                              <tr>
                                 <td style="">
                                    <font size="4" style="font-size:15px;">DATE </font>
                                 </td>
                                 <td colspan="3" align="center" style="padding:5px;">
                                    <font size="4" style="font-size:15px;">MON</font>
                                 </td>
                                 <td align="center" colspan="3" style="padding:5px;">
                                    <font size="4" style="font-size:15px;">TUE</font>
                                 </td>
                                 <td align="center" colspan="3" style="padding:5px;">
                                    <font size="4" style="font-size:15px;">WED</font>
                                 </td>
                                 <td align="center" colspan="3" style="padding:5px;">
                                    <font size="4" style="font-size:15px;">THU</font>
                                 </td>
                                 <td align="center" colspan="3" style="padding:5px;">
                                    <font size="4" style="font-size:15px;">FRI</font>
                                 </td>
                                 <?php
                                 $round = 5;
                                 if ($sat):
                                    $round = 6;
                                    ?>
                                    <td align="center" colspan="3">
                                       <font size="4" style="font-size:15px;">SAT</font>
                                    </td>
                                 <?php endif; ?>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              //$chartdate = array_reverse($chartdate);
                              foreach ($chartdate as $chs) {
                                 ?>
                                 <tr>
                                    <td>
                                       <p style="font-size:10px">
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
                                          <td style="color:red">
                                             <?php echo '*' . '<br>' . '*' . '<br>' . '*'; ?>
                                          </td>
                                          <td><span class="d" style="color:red">
                                                <?php echo '**'; ?>
                                             </span></td>
                                          <td style="color:red">
                                             <?php echo '*' . '<br>' . '*' . '<br>' . '*'; ?>
                                          </td>
                                       <?php } else { ?>
                                          <td>
                                             <?php echo $s[0] . '<br>' . $s[1] . '<br>' . $s[2]; ?>
                                          </td>
                                          <td><span class="d" style="color:">
                                                <?php echo $ch['result_num']; ?>
                                             </span></td>
                                          <td>
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
                  </center>
               </div>
               <div class="col-md-2"></div>
            </div>
         </div>
      </div>
   </section>
   <!--mobile view table-->
   <section>
      <div class="container" style="margin-top:0px; margin-bottom:00px;">
         <div class="d-lg-block d-md-block d-xs-none d-sm-none mobile-view table-color">
            <center>
               <h2 style="color:#C93756;font-weight:bold;text-transform:uppercase;">
                  <?php echo $chart[0]['name'] . " " . "Chart" ?>
               </h2>
               <br>
            </center>
            <div class="row">
               <div class="col-md-1"></div>
               <div class="col-md-10">
                  <center>
                     <div class="RECORD">
                        <table style="width:100%;">
                           <thead>
                              <tr>
                                 <td style="padding:10px;">
                                    <font size="4">DATE </font>
                                 </td>
                                 <td colspan="3" align="center" style="padding:10px;">
                                    <font size="4">MON</font>
                                 </td>
                                 <td align="center" colspan="3" style="padding:10px;">
                                    <font size="4">TUE</font>
                                 </td>
                                 <td align="center" colspan="3" style="padding:10px;">
                                    <font size="4">WED</font>
                                 </td>
                                 <td align="center" colspan="3" style="padding:10px;">
                                    <font size="4">THU</font>
                                 </td>
                                 <td align="center" colspan="3" style="padding:10px;">
                                    <font size="4">FRI</font>
                                 </td>
                                 <?php
                                 $round = 5;
                                 if ($sat):
                                    $round = 6;
                                    ?>
                                    <td align="center" colspan="3" style="padding:10px;">
                                       <font size="4">SAT</font>
                                    </td>
                                 <?php endif; ?>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              //$chartdate = array_reverse($chartdate);
                              foreach ($chartdate as $chs) {
                                 ?>
                                 <tr>
                                    <td style="padding:10px;">
                                       <p style="font-size:20px!important;">
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
                                          <td style="color:red;padding:10px;font-size:20px !important;">
                                             <?php echo '*' . '<br>' . '*' . '<br>' . '*'; ?>
                                          </td>
                                          <td style="padding:10px;"><span class="d" style="color:red;font-size:24px !important;">
                                                <?php echo '**'; ?>
                                             </span></td>
                                          <td style="color:red;padding:10px;font-size:20px !important;">
                                             <?php echo '*' . '<br>' . '*' . '<br>' . '*'; ?>
                                          </td>
                                       <?php } else { ?>
                                          <td style="padding:10px;font-size:20px !important;">
                                             <?php echo $s[0] . '<br>' . $s[1] . '<br>' . $s[2]; ?>
                                          </td>
                                          <td style="padding:10px;"><span class="d" style="font-size:24px !important;">
                                                <?php echo $ch['result_num']; ?>
                                             </span></td>
                                          <td style="padding:10px;font-size:20px!important;">
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
                  </center>
               </div>
               <div class="col-md-2"></div>
            </div>
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