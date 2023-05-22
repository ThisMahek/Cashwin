<?php 
	include('includes/header.php');
	include('includes/sidebar.php');
?>

<div class="content-wrapper">
            
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="card-header"><h4>Download report</h4></div>
                    <div class="ibox-body">
                      <form action="" method="post">
                          <div class="row">
                              <div class="col-md-3 mt-3">
                                  Select game:<br>
                                    <select class="selectpicker" name="game" class="form-control">
                                        <option value="">Select Game</option>
                                        <option value="">Select Game</option>
                                    </select>
                              </div>
                              <div class="col-md-3 mt-3">
                                    Select date:
                                    <input type="date" name="date" class="form-control">
                              </div>
                              <div class="col-md-3 mt-3">
                                  Select matka:<br>
                                    <select class="selectpicker" name="matka" class="form-control">
                                        <option value="">Matka name</option>
                                        <option value=""></option>
                                    </select>
                              </div>
                              <div class="col-md-3 mt-3"><br>
                                  <button type="submit" class="btn btn-primary" name="submit" value="vv">Download report</button>
                              </div>
                          </div>
                      </form>
                    </div>
                </div>
            </div>
</div>
            <!-- END PAGE CONTENT-->
           
        <?php include('includes/footer.php')?>