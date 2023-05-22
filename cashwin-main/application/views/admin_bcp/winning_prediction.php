<?php 
	include('includes/header.php');
	include('includes/sidebar.php');
?>

<div class="content-wrapper"> 
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                        <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-12">
                            <h5 class="font-strong mb-4">Winning Prediction</h5>
                          </div>
                         <div class="col-md-2 mb-2">
                             <label>Date</label>
                             <input type="date" class="form-control">
                         </div>
                         <div class="col-md-2 mb-2">
                             <label>Game Name</label>
                               <select class="form-control">
                                   <option value="1">Rajdhani Day</option>
                                  <option value="2">Time Bazar</option>
                                  <option value="3">Kalyan</option>
                                </select>
                         </div>
                         <div class="col-md-2 mb-2">
                             <label>Session Time</label>
                               <select class="form-control">
                                   <option value="1">Select Market Time</option>
                                  <option value="2">Open Market</option>
                                  <option value="3">Close Market</option>
                                </select>
                         </div>
                         <div class="col-md-2 mb-2">
                             <label>Open Pana </label>
                               <select class="form-control">
                                   <option value="1">Select Market Time</option>
                                  <option value="2">Open Market</option>
                                  <option value="3">Close Market</option>
                                </select>
                         </div>
                         <div class="col-md-2 mb-2">
                             <label></label>
                             <div class="btn btn-primary" style="margin-top:25px">Submit</div>
                         </div>
                       </div>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-body">
                       <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-6">
                          <h5 class="font-strong mb-4">Winning Prediction List</h5></div>
                          <div class="col-md-6">
                             <button class="btn btn-primary float-right"  data-toggle="modal" data-target="#add">+ Add</button>
                          </div>
                       </div>
                        <center><div style="color:green; "> <h5><?php echo $this->session->flashdata('success'); ?></h5></div></center>
                        
                        <div class="table-responsive row">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead class="thead-default thead-lg">
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Bid Points</th>
                                        <th>Winning Amount</th>
                                        <th>Type</th>
                                        <th>Bid TX ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                     </tr>
                                 </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
 <?php include('includes/footer.php')?>