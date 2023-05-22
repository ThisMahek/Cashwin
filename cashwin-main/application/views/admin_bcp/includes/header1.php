<?php error_reporting(0);?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Rdgames - Admin dashboard</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?php echo base_url() ?>assets/resources/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/line-awesome/css/line-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/animate.css/animate.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/toastr/toastr.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="<?php echo base_url() ?>assets/resources/vendors/smalot-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/clockpicker/dist/bootstrap-clockpicker.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/jquery-minicolors/jquery.minicolors.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/multiselect/css/multi-select.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="<?php echo base_url() ?>assets/resources/css/main.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/summernote/dist/summernote.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="<?php echo base_url() ?>assets/resources/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link href="<?php echo base_url() ?>assets/resources/vendors/dataTables/datatables.min.css" rel="stylesheet" />
    <!-- menu css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css" crossorigin="anonymous">
    <style>
    .dropdown-menu{
        text-align:center!important;
    }
    </style>
</head>
<style>
    @media only screen and (max-width: 600px) {
 .ibox-body{
    padding-right:0px!important;
  }
}
.button-style{
    border-bottom: 1px solid rgba(0,0,0,.1);
    padding-top:5px;
    padding-bottom:5px;
}
</style>
<body>
    <div class="page-wrapper">
        <style>
        .btn-group-sm .btn-icon-only{
            height:25px; width:25px;
        }
         .btn-icon-only.btn-sm{
            height:25px; width:25px;
        }
        </style>