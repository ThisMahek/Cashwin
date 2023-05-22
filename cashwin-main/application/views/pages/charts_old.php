<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Binplus Technologies (P) Limited">

  <title>CR MUMBAI Matka</title>

  <!-- Bootstrap core CSS -->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137278248-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-137278248-1');
</script>

  <!-- Custom fonts for this template -->
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/freelancer.min.css" rel="stylesheet">
  
<style>
.RECORD {
background-color: #fff;
color: #000;
font-weight: 700;
font-style: italic;
font-size: largeD225972056
border-width: 5px;
border-color: #893bff;
border-style: groove;
text-shadow: 1px 1px #ffd700;
padding-top: 10px;
padding-bottom: 10px;
}
.d{
	font-size: 25px;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #fff;
}
.margin-top{
    margin-top:20px;
}
.subh{
    height:60px;
    width:60px;
    border-radius:50%;
    padding:20px;
    background:red;
    color:white;
    text-align:center;
}
</style>
</head>
<div class="container" style="max-width:1500px;">
<section>
<br>
<center><h2><?php echo $chart[0]['name']. " ". "Chart"?></h2></center>
<br>

<center>
<div class="RECORD" style="width:70%;">
<table cellspacing="0" style="width:90%;" class="table table-responsive">
<thead>
       <tr>
            <td>
            <p align="center"><font size="4">DATE</font> </p> </td>
            <td colspan="3" align="center" ><font size="4">MON</font></td>
            <td align="center" colspan="3"><font size="4">TUE</font></td>
            <td align="center" colspan="3"><font size="4">WED</font></td>
            <td align="center" colspan="3"><font size="4">THU</font></td>
            <td align="center" colspan="3"><font size="4">FRI</font></td>
            <td align="center" colspan="3"><font size="4">SAT</font></td>
            <?php 
            $round = 6;
            if($chart[0]['name']=='DHANLAXMI'): 
            $round = 7; ?>
            <td align="center" colspan="3"><font size="4">SUN</font></td>
            <?php endif; ?>
        </tr>
</thead>
    <tbody>
            <?php
    // print_r($chart);
    // print_r($chartdate);
    foreach($chartdate as $chs) {
        ?>
        <tr>
            <td><p><?php echo $chs['s'];  ?><br>to<br><?php echo $chs['e']; ?></p></td>
            <?php
            $date=$chs['s'];
            
        for($ii=0; $ii<$round;$ii++):
            $ch = $this->Chart_Model->getChartDetailName($chart[0]['name'],$date);
            //print_r($ch);
            $st= $ch['starting_num']; //145
                $s=array();
                for($i=0;$i<strlen($st);$i++):
                    $s[] = substr($st, $i, 1);
                endfor;
                
                $en= $ch['end_num']; //145
                $s1=array();
                for($j=0;$j<strlen($en);$j++):
                    $s1[] = substr($en, $j, 1);
                endfor;
        ?>
            <td><?php echo $s[0].'<br>'. $s[1].'<br>'.$s[2];  ?></td>
            <td><span class="d" style="color:"><?php echo $ch['result_num']; ?></span></td>
            <td><?php echo $s1[0].'<br>'. $s1[1].'<br>'.$s1[2];  ?></td>
    <?php 
    $date= date('Y-m-d',strtotime('+1 days',strtotime($date)));
    
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
<br>
</section>

  <footer class="footer text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-5 mb-lg-0">
          <h4 class="mb-4">Location</h4>
          <p class="lead mb-0" style="font-size:14px;">Shivaji Nagar Jhansi
           Uttar Pradesh 284001 </p>
        </div>
        <div class="col-md-4 mb-5 mb-lg-0">
          <h4 class=" mb-4">Social Links</h4>
          <ul class="list-inline mb-0" style="background-color: transparent; margin-left:40px;">
            <li class="list-inline-item">
              <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                <i class="fab fa-fw fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                <i class="fab fa-fw fa-google-plus-g"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                <i class="fab fa-fw fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                <i class="fab fa-fw fa-linkedin-in"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                <i class="fab fa-fw fa-dribbble"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-4 mb-lg-0">
          <h4 class=" mb-4">About CR MUMBAI Matka</h4>
          <p class="lead mb-0" style="font-size:14px;">CR MUMBAI is one of the most visited janta site amongst people engaged in Dhanlaxmi, CR Mumbai, Kuber Night, Sridevi Night.
           </p>
        </div>
      </div>
    </div>
  </footer>

  <div class="copyright py-4 text-center text-white">
    <div class="container">
      <small>Copyright &copy; All Right Resereved Powered By CR Mumbai Matka</small>
    </div>
  </div>

  <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
  <div class="scroll-to-top d-lg-none position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
      <i class="fa fa-chevron-up"></i>
    </a>
  </div>
</div>

