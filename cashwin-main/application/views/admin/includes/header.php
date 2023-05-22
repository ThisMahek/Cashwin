<?php error_reporting(0);?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url()?>assets/img/cash_win.png" type="image/x-icon">
    <title>Cash Win | Admin Panel</title>
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
     <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"> 
    <!-- menu css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css" crossorigin="anonymous">
    <style>
    .dropdown-menu{
        text-align:center!important;
    }
    .desktop-responsive{
        display:block;
        overflow-x:scroll;
    }
    .font-12{
        font-size:12px;
    }
    .bg-soft-primary {
        background-color: rgba(85,110,230,.25)!important;
    }
    .profile-user-wid {
        margin-top: -26px;
    }
    .border-top {
        border-top: 1px solid #eff2f7!important;
    }
    .point-section{
             border-radius: 4px;
              width: 40px;
            height: 40px;
            margin: 10px 20px;
            font-weight: 600;
            text-align:center;
            line-height:33px;
    }
    .light-green-box{
           border: 1px solid #34c38f;
           background-color: rgba(52,195,143,.18);
       }
     .light-red-box{
         border: 1px solid #f46a6a;
          background-color: rgba(244,106,106,.18)
     }
     .game_num_row .col-auto{
         width: 8.333%;
     }
     .cus-mar-top{
         margin-top:9%;
     }
     .select2-container--default .select2-selection--single{
         border-radius: 2px;
        border-color: rgba(0,0,0,.1);
        padding: 0.65rem 1.25rem;
     }
     .select2-container--default .select2-selection--single {
        height: 40px;
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 0px;
        border-color: rgba(0,0,0,.1)!important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 19px;
        }
     @media only screen and (max-width: 600px) {
      .game_num_row .col-auto{
             width: 33.333%;
         }
           .cus-mar-top{
             margin-top:38%;
         }
        .profile-user-wid img{
            height:60px;
        }
      .card .card-title{
          font-size:16px;
      }
    }
   
/*    .text-primary {*/
/*    color: #2f3542!important;*/
/*}*/
/*.header .admin-dropdown-menu .dropdown-header {*/
/*  background-color:black!important;   */
/*}*/
/*.header .admin-dropdown-menu .dropdown-arrow:after {*/
/*    background-color: #2f3542 !important;*/
/*}*/
    
/*    .header .page-brand {*/
/*    background-color: black!important;*/
/*    }*/
    
/*    .side-menu>li a:focus, .side-menu>li a:hover {*/
/*    color: #fff;*/
/*    background-color: goldenrod !important;*/
/*}*/
/*.side-menu>li.active {*/
/*    background-color: #57606f !important;*/
/*}*/
/*.side-menu>li.active>a {*/
/*    color: #fff !important;*/
/*     background-color:goldenrod !important;*/
/*}*/
/*.sidebar-footer {*/
/*    position: fixed;*/
/*    bottom: 0;*/
/*    width: 230px;*/
/*    height: 50px;*/
/*    background-color:goldenrod !important;*/
/*    color: #fff !important;*/
/*}*/
/*.page-sidebar {*/
/*    width: 230px;*/
/*    background-color:black!important;*/
/*}*/
/*.side-menu>li a {*/
/*    white-space: nowrap;*/
/*    overflow: hidden;*/
/*    color:white;*/
/*}*/
/*.sidebar-footer a {*/
/*    width: 25%;*/
/*    text-align: center;*/
/*    font-size: 18px;*/
/*    color: #f0f5fb !important;*/
/*}*/
/*.side-menu li .sidebar-item-icon {*/
/*  color: goldenrod;*/
/*}*/
/*.side-menu>li.active>a .arrow, .side-menu>li.active>a .sidebar-item-icon {*/
/*    color: white;*/
/*}*/
/*.side-menu>li.active {*/
/*    background-color: black!important;*/
/*}*/
/*.side-menu li .arrow{*/
/*    color:white;*/
/*}*/
/*.easypie .easypie-data {*/
/*    color: goldenrod!important;*/
/*    top: -5px;*/
/*}*/
/*.nav-link span{*/
/*    color:black;*/
/*}*/
/*.card {*/
/*    border-radius: 10px;*/
/*     border-top: 3px solid goldenrod;*/
/*}*/
/*.ibox {*/
/*    border-radius: 10px;*/
/*    border-top: 3px solid goldenrod;*/
/*}*/
/*.btn-primary {*/
/*    background-color: black!important;*/
/*    border-color:black!important;*/
/*}*/
/*.thead-default th {*/
    /*background: black;*/
    /*color: white;*/
/*    white-space: nowrap;*/
/*}*/
/*.btn-info{*/
/*    background-color: goldenrod!important;*/
/*    border-color: goldenrod!important;*/
/*}*/
/*.pagination .active>a, .pagination .active>a:focus, .pagination .active>a:hover, .pagination .active>span, .pagination .active>span:focus, .pagination .active>span:hover, .pagination .page-item.active .page-link {*/
/*    background-color: black;*/
/*    border-color: black;*/
/*}*/
/*.header .navbar-toolbar>li>a{*/
/*    display:none;*/
/*}*/
/*.alert{*/
/*    border-radius:10px;*/
/*}*/
/*.btn-success{*/
/*    color:white!important;*/
/*}*/




.card_back{
    background:#f3ad2d;
    padding: 20px;
    box-shadow: 0 0 8px 0 #afa5a5;
}
.card_back1{
    background:#5171c4;
    padding: 20px;
    box-shadow: 0 0 8px 0 #afa5a5;
}
.card_back2{
    background:#e86735;
    padding: 20px;
    box-shadow: 0 0 8px 0 #afa5a5;
}
.card_amount{
    padding: 20px;
    box-shadow: 0 0 8px 0 #afa5a5;  
}
.form_select{
    width:66%;
    margin-right: 9%;
    padding: 8px 3px;
    border-radius:4px;
    border: 1px solid #e0dede;
}
.easypie{
    padding-left: 65px;
}
.padding_right{
    padding:5px;
}


/*------------------start select option issue css--------------------*/

.parent{
  display: flex;
  align-items: center;
  justify-content: space-around;
  height: 100%;
}

/* Select2-Bootstrap-style */

.select2-container--bootstrap .select2-selection {
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 4px;
  color: #555555;
  font-size: 14px;
  outline: 0;
}

.select2-container--bootstrap .select2-search--dropdown .select2-search__field {
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 4px;
  color: #555555;
  font-size: 14px;
}

.select2-container--bootstrap .select2-search__field {
  outline: 0;
}

.select2-container--bootstrap .select2-search__field::-webkit-input-placeholder {
  color: #999;
}

.select2-container--bootstrap .select2-search__field:-moz-placeholder {
  color: #999;
}

.select2-container--bootstrap .select2-search__field::-moz-placeholder {
  color: #999;
  opacity: 1;
}

.select2-container--bootstrap .select2-search__field:-ms-input-placeholder {
  color: #999;
}

.select2-container--bootstrap .select2-results__option {
  padding: 6px 12px;
}

.select2-container--bootstrap .select2-results__option[role=group] {
  padding: 0;
}

.select2-container--bootstrap .select2-results__option[aria-disabled=true] {
  color: #777777;
  cursor: not-allowed;
}

.select2-container--bootstrap .select2-results__option[aria-selected=true] {
  background-color: #f5f5f5;
  color: #262626;
}

.select2-container--bootstrap .select2-results__option--highlighted[aria-selected] {
  background-color: #337ab7;
  color: #fff;
}

.select2-container--bootstrap .select2-results__group {
  color: #777777;
  display: block;
  padding: 6px 12px;
  font-size: 12px;
  line-height: 1.42857143;
  white-space: nowrap;
}

.select2-container--bootstrap.select2-container--focus .select2-selection, .select2-container--bootstrap.select2-container--open .select2-selection {
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
  -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
  -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
  -webkit-transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
  transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
  transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
  transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
  border-color: #66afe9;
}

.select2-container--bootstrap.select2-container--open .select2-selection .select2-selection__arrow b {
  border-color: transparent transparent #999 transparent;
  border-width: 0 4px 4px 4px;
}

.select2-container--bootstrap.select2-container--open.select2-container--below .select2-selection {
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
  border-bottom-color: transparent;
}

.select2-container--bootstrap.select2-container--open.select2-container--above .select2-selection {
  border-top-right-radius: 0;
  border-top-left-radius: 0;
  border-top-color: transparent;
}

.select2-container--bootstrap .select2-dropdown {
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  border-color: #66afe9;
  overflow-y:scroll!important;;
  margin-top: -1px;
  height:150px;
}

.select2-container--bootstrap .select2-selection--single {
  height: 34px;
  line-height: 1.42857143;
  padding: 6px 24px 6px 12px;
}
.select2-container .select2-selection--single{
    height:36px!important;
}

/*------------------End select option issue css--------------------*/


    </style>
</head>
<style>
    @media only screen and (max-width: 600px) {
 /*.ibox-body{*/
 /*   padding-right:0px!important;*/
 /* }*/
  .sidebar-toggler{
    display:flex;
}
.card_amount{
    padding:0px;
    margin-bottom: 3%;
}
.icon{
    display:none!important;
}
.font_s{
    font-size:9px;
}
.easypie{
    padding-left:0px;
}
.card_back{
    padding:0;
}
.card_back1{
    padding:0;  
}
.card_back2{
    padding:0;  
}
.flexbox-b {
    padding:12px;
}
.flex_card{
    padding:0;
}
.card .card-title{
    font-size:10px;
}
.form_select {
    width: 65%!important;
    margin-right: 0;
     font-size: 10px;

}
.submit_mobile{
font-size: 10px;
    padding: 8px;

}
.padding_content{
    padding-top:0!important;
}
.padding_sp{
    padding:7px 8px;
}
.button-style{
    border-bottom: 1px solid rgba(0,0,0,.1);
    padding-top:5px;
    padding-bottom:5px;
}
</style>
<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand" style="">
                <a href="<?= base_url()?>admin/index">
                    <center><img src="<?php echo base_url()?>assets/img/cash_win.png" style="height:50px;">  <span class="panel_logo">Cash Win</span></center>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler" href="javascript:;">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                    </li>
                   
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <span>Admin</span>
                            <img src="<?php echo base_url() ?>assets/resources/img/users/admin-image.png" alt="image" />
                        </a>
                        <div class="dropdown-menu dropdown-arrow dropdown-menu-right admin-dropdown-menu">
                            <div class="dropdown-arrow"></div>
                            <div class="dropdown-header">
                                <div class="admin-avatar">
                                    <img src="<?php echo base_url() ?>assets/resources/img/users/admin-image.png" alt="image" />
                                </div>
                                <div>
                                    <h5 class="font-strong text-white">Super User</h5>
                                    
                                </div>
                            </div>
                           
                            <div class="list">
                               
                                <div class=" align-items-centermt-2 button-style">
                                   
                                    <a class=" align-items-center" href="<?= base_url() ?>admin/update-profile"> Admin profile</a>
                                </div>
                                <div class=" align-items-centermt-2 button-style">
                                   
                                    <a class=" align-items-center" href="<?= base_url() ?>admin/change-password">Change password</a>
                                </div>
                                <div class=" align-items-centermt-2 button-style">
                                   
                                    <a class=" align-items-center" href="<?= base_url() ?>admin/logout">Logout<i class="ti-power-off ml-2 font-20"></i></a>
                                </div>
                                <!--<div class=" align-items-centermt-2">-->
                                   
                                <!--    <a class=" align-items-center" href="<?= base_url() ?>admin/logout">Logout<i class="ti-power-off ml-2 font-20"></i></a>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </li>
                    
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <style>
        .btn-group-sm .btn-icon-only{
            height:25px; width:25px;
        }
         .btn-icon-only.btn-sm{
            height:25px; width:25px;
        }
        </style>