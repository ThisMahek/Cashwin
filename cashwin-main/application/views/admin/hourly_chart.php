<?php
include('includes/header.php');
include('includes/sidebar.php');
?>
<div class="content-wrapper">
   <div class="page-content fade-in-up">
      <div class="ibox">
         <div class="ibox-body">
            <div class="row" style="padding-bottom: 7px;">
               <div class="col-md-10">
                  <h5 class="font-strong mb-4">Hourly-Market Charts</h5>
               </div>
               <div class="col-md-2">
                  <button class="btn btn-info btn-square" data-toggle="modal"
                     data-target="#exampleModalCenter">+Add</button>
               </div>
            </div>
            <div class="flexbox mb-4">
               <div class="input-group-icon input-group-icon-left mr-3" style="width:100%">
                  <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                  <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text"
                     placeholder="Search ...">
               </div>
            </div>
            <div class="table-responsive row">
               <table class="table table-bordered table-hover" id="datatable">
                  <thead class="thead-default thead-lg">
                     <tr>
                        <th>Sr.no</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Update Numbers</th>

                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $j = 1;
                     foreach ($charts as $chart):
                        ?>
                        <tr>
                           <td>
                              <?= $j; ?>
                           </td>
                           <td>
                              <?= $chart->name ?>
                           </td>
                           <td>
                              <?= $chart->date ?>
                           </td>
                           <td>
                              <?= $chart->starting_num . '-' . $chart->result_num; ?>
                              <!--<button type="button" class="btn btn-info btn-fix btn-sm" data-toggle="modal" data-target="#numbers<?= $chart->id ?>">Declare Numbers</button>-->
                           </td>

                           <td style="display: flex;">

                              <button type="submit" class="btn btn-danger btn-icon-only btn-circle btn-sm btn-air"
                                 name="remove" onclick="return confirm('Are you sure you want to delete?')"> <i
                                    class="la la-trash"></i> </button>
                           </td>
                        </tr>
                        <div class="modal fade" id="numbers<?= $chart->id ?>">
                           <div class="modal-dialog">
                              <form action="" method="post">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLongTitle"> Add Chart Number</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                       </button>
                                    </div>

                                    <div class="modal-body">
                                       <div class="row">
                                          <div class="col-md-12 mt-2">
                                             <label>Time</label>
                                             <select class="form-control" name="s_time" required>
                                                <option value="">Select Time</option>
                                                <?php foreach ($lists as $list):
                                                   $time = json_decode($list->result);
                                                   // print_r($time);
                                                   for ($i = 0; $i < count($time); $i++) {
                                                      ?>
                                                      <option>
                                                         <?= $time[$i][0]->time; ?>
                                                      </option>
                                                   <?php }endforeach; ?>
                                             </select>
                                          </div>
                                          <div class="col-md-12 mt-2">
                                             <label>Starting Number</label>
                                             <input type="text" name="s_no" value="" class="form-control" required>
                                          </div>

                                          <div class="col-md-12 mt-2">
                                             <label>Result-Number</label>
                                             <input type="text" name="r_no" value="" class="form-control" required>
                                          </div>
                                          <input type="hidden" value="<?php echo $chart->name ?>" name="name">
                                          <?php $query = $this->db->select('id')->where('name', $chart->name)->get('hourly_market');
                                          $c_id = $query->row();
                                          ?>
                                          <input type="hidden" value="<?php echo $c_id->id ?>" name="id">

                                       </div>
                                    </div>

                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                       <button type="submit" name="update_Chart" value="<?= $chart->id ?>"
                                          class="btn btn-primary">Submit</button>
                                    </div>

                                 </div>
                              </form>
                           </div>
                        </div>
                        <?php $j++; endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <!-- END PAGE CONTENT-->
   <!-- add Hourly chart model satrt here -->
   <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <form action="" method="post">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle"> Add Hourly Chart</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                  </button>
               </div>

               <div class="modal-body">
                  <div class="row">
                     <div class="col-md-12 mt-2">
                        <label>Name</label>
                        <select class="form-control" name="cid" required>
                           <option value="">Select Market</option>
                           <?php foreach ($lists as $list): ?>
                              <option value="<?= $list->id ?>"><?= $list->name ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="col-md-12 mt-2">
                        <label>Date</label>
                        <input type="date" name="date" value="" class="form-control" required>
                     </div>

                     <div class="col-md-12 mt-2">
                        <label>Time</label>
                        <select class="form-control" name="s_time" id="hourly_chart_time" required>
                           <option value="">Select Time</option>
                           <?php foreach ($lists as $list):
                              $time = json_decode($list->result);
                              for ($i = 0; $i < count($time); $i++) {
                                 ?>
                                 <option>
                                    <?= $time[$i][0]->time; ?>
                                 </option>
                              <?php }endforeach; ?>
                        </select>
                     </div>

                     <div class="col-md-12 mt-2">
                        <label>Starting Number</label>
                        <input type="text" name="s_no" value="" class="form-control" required>
                     </div>

                     <div class="col-md-12 mt-2">
                        <label>Result-Number</label>
                        <input type="text" name="r_no" value="" class="form-control" required>
                     </div>

                     <input type="hidden" name="type" value="Manual" class="form-control" required>


                  </div>
               </div>

               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" name="update_Chart" value="1" class="btn btn-primary">Submit</button>
               </div>

            </div>
         </form>
      </div>
   </div>
   <!-- end  Disclaimer model  -->

   <?php include('includes/footer.php') ?>