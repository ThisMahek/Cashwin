<?php 
	include('includes/header.php');
	include('includes/sidebar.php');
?>
<div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title">Form Layouts</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index-2.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item">Add-Form</li>
                </ol>
            </div>
            <div class="page-content fade-in-up">
 <div class="ibox">
                    <form action="javascript:;">
                        <div class="ibox-head">
                            <div class="ibox-title">Multi Column form</div>
                        </div>
                        <div class="ibox-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Full Name</label>
                                        <input class="form-control" type="text" placeholder="Enter Full Name">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label>Email</label>
                                        <input class="form-control" type="text" placeholder="Enter Email">
                                    </div>
                                    <div class="form-group mb-4">
                                        <label>Date of Birth</label>
                                        <input class="form-control" type="text" placeholder="Enter Date of Birth">
                                        <span class="help-block">Please Enter your date of birth.</span>
                                    </div>
                                     <div class="form-group mb-2">
                              <label class="checkbox checkbox-inline checkbox-success">
                                    <input type="checkbox">
                                    <span class="input-span"></span>Remamber me</label>
                            </div>
                             <div class="form-group">
                                    <label class="form-control-label">Checkmark on selected option</label>
                                    <select class="selectpicker show-tick form-control">
                                        <option>Mustard</option>
                                        <option>Ketchup</option>
                                        <option disabled="">Disabled</option>
                                        <option>Tabasco</option>
                                    </select>
                                </div>
                                 <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">jQuery MiniColors
                                    <a class="btn btn-sm btn-primary ml-2" href="http://labs.abeautifulsite.net/jquery-minicolors/" target="_blank">Official site</a>
                                </div>
                            </div>
                            <div class="ibox-body">
                                <div class="form-group">
                                    <label>Hue (default)</label>
                                    <input class="form-control minicolors" type="text" data-control="hue" value="#F75A5F">
                                </div>
                                <div class="form-group">
                                    <label>Saturation</label>
                                    <input class="form-control minicolors" type="text" data-control="saturation" value="#18C5A9">
                                </div>
                                <div class="form-group">
                                    <label>Brightness</label>
                                    <input class="form-control minicolors" type="text" data-control="brightness" value="#F39C12">
                                </div>
                                <div class="form-group">
                                    <label>Wheel</label>
                                    <input class="form-control minicolors" type="text" data-control="wheel" value="#23B7E5">
                                </div>
                                <div class="form-group">
                                    <label>Hidden input</label>
                                    <input class="form-control minicolors" type="hidden" value="#3498DB">
                                </div>
                                <div class="form-group">
                                    <label>RGB</label>
                                    <input class="form-control minicolors" type="text" data-format="rgb" value="rgb(33, 147, 58)">
                                </div>
                                <div class="form-group">
                                    <label>RGBA</label>
                                    <input class="form-control minicolors" type="text" data-format="rgb" data-opacity="0.50" value="rgba(52, 64, 158, 0.5)">
                                </div>
                                <div class="form-group">
                                    <label>Swatches</label>
                                    <input class="form-control minicolors" type="text" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|#0ff" value="#17e8c9">
                                </div>
                                <div class="form-group">
                                    <label>Swatches and opacity</label>
                                    <input class="form-control minicolors" type="text" data-format="rgb" data-opacity="0.50" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)" value="rgba(14, 206, 235, .5)">
                                </div>
                                <div class="form-group">
                                    <label>bottom right</label>
                                    <input class="form-control minicolors" type="text" data-position="bottom right" value="#6654a8">
                                </div>
                                <p>Valid positions include <code>bottom left</code>, <code>bottom right</code>, <code>top left</code>, and <code>top right</code>.</p>
                            </div>
                        </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label>Location</label>
                                        <div class="input-group-icon input-group-icon-left">
                                            <span class="input-icon input-icon-left"><i class="ti-location-pin font-16"></i></span>
                                            <input class="form-control" type="text" placeholder="Enter Location">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label>Password</label>
                                        <div class="input-group-icon input-group-icon-left">
                                            <span class="input-icon input-icon-left"><i class="ti-lock"></i></span>
                                            <input class="form-control" type="password" placeholder="Enter Password">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label>Phone number</label>
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">+61<i class="fa fa-angle-down ml-1"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:;">+61</a>
                                                    <a class="dropdown-item" href="javascript:;">+1</a>
                                                    <a class="dropdown-item" href="javascript:;">+7</a>
                                                </div>
                                            </div>
                                            <input class="form-control" type="text" placeholder="Enter Phone">
                                        </div>
                                        <span class="help-block">It will be required to verify your account.</span>
                                    </div>
                                    <div class="form-group mb-2">
                                <label>Account Type</label>
                                <div class="mt-1">
                                    <label class="radio radio-inline radio-grey radio-primary">
                                        <input type="radio" name="d" checked>
                                        <span class="input-span"></span>Personal</label>
                                    <label class="radio radio-inline radio-grey radio-primary">
                                        <input type="radio" name="d">
                                        <span class="input-span"></span>Corporate</label>
                                </div>
                              </div>
                              <div class="form-group">
                                    <textarea class="form-control" rows="3" maxlength="75" placeholder="This textarea has a limit of 75 chars."></textarea>
                                </div>
                               <div class="form-group" id="date_1">
                                    <label class="font-normal"></label>
                                    <div class="input-group date">
                                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control" type="text" value="04/12/2017">
                                    </div>
                                </div>
                                <div class="form-group" id="date_2">
                                    <label class="font-normal">One Year view</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input class="form-control" type="text" value="07/11/2017">
                                    </div>
                                </div>
                                  <div class="ibox-body">
                                <div class="form-group mb-4">
                                    <label class="btn btn-info file-input mr-2">
                                        <span class="btn-icon"><i class="la la-upload"></i>Browse file</span>
                                        <input type="file">
                                    </label>
                                    <label class="btn btn-primary file-input mr-2">
                                        <span class="btn-icon"><i class="la la-cloud-upload"></i>Browse file</span>
                                        <input type="file">
                                    </label>
                                    <label class="btn btn-gradient-purple file-input">
                                        <span class="btn-icon"><i class="la la-camera"></i>Browse</span>
                                        <input type="file">
                                    </label>
                                </div>
                            </div>
                           
                                </div>
                            </div>
                            
                        </div>
                        <div class="ibox-footer">
                            <button class="btn btn-primary mr-2" type="button">Submit</button>
                            <button class="btn btn-outline-secondary" type="reset">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      <script src="assets/vendors/jquery/dist/jquery.min.js"></script>
    <script src="assets/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/vendors/metisMenu/dist/metisMenu.min.js"></script>
    <script src="assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/vendors/jquery-idletimer/dist/idle-timer.min.js"></script>
    <script src="assets/vendors/toastr/toastr.min.js"></script>
    <script src="assets/vendors/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="assets/vendors/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="assets/vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="assets/vendors/jquery-knob/dist/jquery.knob.min.js"></script>
    <script src="assets/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
    <script src="assets/vendors/moment/min/moment.min.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/vendors/smalot-bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="assets/vendors/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
    <script src="assets/vendors/jquery-minicolors/jquery.minicolors.min.js"></script>
    
    
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.min.js"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script src="assets/js/scripts/form-plugins.js"></script>

<!-- <?php 
	// include('includes/footer.php');
?> -->