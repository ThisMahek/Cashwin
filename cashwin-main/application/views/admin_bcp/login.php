<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url()?>assets/img/cash_win.png" type="image/x-icon">
    <title>Cash Win | Admin dashboard</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?php echo base_url() ?>assets/resources/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/line-awesome/css/line-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/animate.css/animate.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/toastr/toastr.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>assets/resources/vendors/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <!-- THEME STYLES-->
    <link href="<?php echo base_url() ?>assets/resources/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <style>
        body {
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url('<?= base_url()?>assets/img/bg.gif');
        }
        .btn-primary {
            background-color:goldenrod!important;
            border-color:goldenrod!important;
        }
        .auth-head-icon {
         color: goldenrod;
        }
        .cover {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(117, 54, 230, .1);
        }

        .login-content {
            max-width: 400px;
            margin: 100px auto 50px;
        }

        .auth-head-icon {
            position: relative;
            height: 60px;
            width: 60px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            background-color: #fff;
            color:goldenrod ;
            box-shadow: 0 5px 20px #d6dee4;
            border-radius: 50%;
            transform: translateY(-50%);
            z-index: 2;
            
        }
        .form-control-line {
            padding-left: 10px;
        }
    </style>
</head>

<body>
    <div class="cover"></div>
    <div class="ibox login-content">
        <div class="text-center">
            <span class="auth-head-icon"><i class="la la-user"></i></span>
        </div>
        <form class="ibox-body" id="login-form" action="" method="POST">
            <h4 class="font-strong text-center mb-5">LOG IN</h4>
            <div class="form-group mb-4">
                <input class="form-control form-control-line" type="text" name="email" placeholder="Email">
            </div>
            <div class="form-group mb-4">
                <input class="form-control form-control-line" type="password" name="password" placeholder="Password">
            </div>
            <div class="flexbox mb-5" style="display:none">
                <!--<span>-->
                <!--    <label class="ui-switch switch-icon mr-2 mb-0">-->
                <!--        <input type="checkbox" checked="">-->
                <!--        <span></span>-->
                <!--    </label>Remember</span>-->
                <!--<a class="text-primary" href="<?php echo base_url() ?>Admin1/forgot_password">Forgot password?</a>-->
            </div>
            <div class="text-center mb-4">
                <button class="btn btn-primary btn-rounded btn-block">LOGIN</button>
            </div>
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- CORE PLUGINS-->
    <script src="<?php echo base_url() ?>assets/resources/vendors/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/resources/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/resources/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/resources/vendors/metisMenu/dist/metisMenu.min.js"></script>
    <script src="<?php echo base_url() ?>assets/resources/vendors/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url() ?>assets/resources/vendors/jquery-idletimer/dist/idle-timer.min.js"></script>
    <script src="<?php echo base_url() ?>assets/resources/vendors/toastr/toastr.min.js"></script>
    <script src="<?php echo base_url() ?>assets/resources/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo base_url() ?>assets/resources/vendors/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <!-- CORE SCRIPTS-->
    <script src="<?php echo base_url() ?>assets/resources/js/app.min.js"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script>
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script>
</body>


</html>