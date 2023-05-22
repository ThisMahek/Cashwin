<?php
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="alert alert-primary alert-bordered">
            <h4>jQuery Validation Plugin</h4>
            <p>This jQuery plugin makes simple clientside form validation easy, whilst still offering plenty of
                customization options. For more info please check out</p>
            <p>
                <a class="btn btn-primary" href="https://jqueryvalidation.org/" target="_blank">Official Site</a>
            </p>
        </div>
        <div class="ibox">
            <div class="ibox-head">
                <div class="ibox-title">Basic Validation</div>
                <div class="ibox-tools">
                    <a class="ibox-collapse"><i class="ti-angle-down"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
                    <div class="form-group row has-error">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input name="name" class="form-control" aria-invalid="true" type="text"><label
                                class="help-block error" id="name-error" for="name">This field is required.</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input name="email" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group row has-error">
                        <label class="col-sm-2 col-form-label">Website</label>
                        <div class="col-sm-10">
                            <input name="url" class="form-control" aria-invalid="true" type="text"><label
                                class="help-block error" id="url-error" for="url">This field is required.</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Number</label>
                        <div class="col-sm-10">
                            <input name="number" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Min length</label>
                        <div class="col-sm-10">
                            <input name="min" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Max length</label>
                        <div class="col-sm-10">
                            <input name="max" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">EqualTo (confirm)</label>
                        <div class="col-sm-10">
                            <input name="password" class="form-control" id="password" type="text"
                                placeholder="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 ml-sm-auto">
                            <input name="password_confirmation" class="form-control" type="text"
                                placeholder="confirm password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 ml-sm-auto">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT-->
    <footer class="page-footer">
        <div class="font-13">2018 © <b>Adminca</b> - Save your time, choose the best</div>
        <div>
            <a class="px-3 pl-4"
                href="http://themeforest.net/item/adminca-responsive-bootstrap-4-3-angular-4-admin-dashboard-template/20912589"
                target="_blank">Purchase</a>
            <a class="px-3" href="http://admincast.com/adminca/documentation.html" target="_blank">Docs</a>
        </div>
        <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
    </footer>
</div>
<script>
    $("#form-sample-1").validate({
        rules: {
            name: {
                minlength: 2,
                required: !0
            },
            email: {
                required: !0,
                email: !0
            },
            url: {
                required: !0,
                url: !0
            },
            number: {
                required: !0,
                number: !0
            },
            min: {
                required: !0,
                minlength: 3
            },
            max: {
                required: !0,
                maxlength: 4
            },
            password: {
                required: !0
            },
            password_confirmation: {
                required: !0,
                equalTo: "#password"
            }
        },
        errorClass: "help-block error",
        highlight: function (e) {
            $(e).closest(".form-group.row").addClass("has-error")
        },
        unhighlight: function (e) {
            $(e).closest(".form-group.row").removeClass("has-error")
        },
    });
</script>
<?php include('includes/footer.php') ?>