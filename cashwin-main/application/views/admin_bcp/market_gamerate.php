<?php 
	include('includes/header.php');
	include('includes/sidebar.php');
?>

<div class="content-wrapper">
            
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                       <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-8">
                          <h5 class="font-strong mb-4">List Market Game Rate</h5></div>
                          <div class="col-md-4">
                              <?php
                                if($this->session->flashdata("success"))
                                    echo "<p class='alert alert-success'>".$this->session->flashdata("success")."<p>";
                              ?>
                          </div>
                       </div>
                        
                        <div class="flexbox mb-4">
                            <!--<div class="flexbox">-->
                            <!--    <label class="mb-0 mr-2">Type:</label>-->
                            <!--    <select class="selectpicker show-tick form-control" id="type-filter" title="Please select" data-style="btn-solid" data-width="150px">-->
                            <!--        <option value="">All</option>-->
                            <!--        <option>Shipped</option>-->
                            <!--        <option>Completed</option>-->
                            <!--        <option>Pending</option>-->
                            <!--        <option>Canceled</option>-->
                            <!--    </select>-->
                            <!--</div>-->
                            <div class="input-group-icon input-group-icon-left mr-3">
                                <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
                            </div>
                        </div>
                        <div class="table-responsive row">
                            <table class="table table-bordered table-hover" id="datatable">
                            <thead>
                                <th>Sr. No.</th>
                                <th>Game Name</th>
                                <th>Game Rate</th>
                                <th>Action</th>
                            </thead>
                        <tbody>
                            <?php 
                            $i=1;
                            foreach($games as $g):
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $g->name ?></td>
                                <td><?php echo $g->points ?></td>
                                <td><a class="btn btn-success" data-toggle="modal" data-target="#modaldemo<?=$g->game_id;?>" >Edit</a></td>
                            </tr>
                            
                            <div id="modaldemo<?=$g->game_id;?>" class="modal fade show">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content bd-0 tx-14">
                                    <div class="modal-header pd-y-20 pd-x-25">
                                      <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Update Game Rate</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                                        <form method="post" action="">
                                        <div class="modal-body">
                                            <div class="form-layout form-layout-4">
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="Enter Game Rate" name="rate" value="<?php echo $g->points;?>">
                                            </div><!-- row -->
                                                                                      <button type="submit" onclick="return confirm('Are you sure to update game rate?');" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" name="update" value="<?=$g->game_id;?>">Update</button>
                                          ` </div>
                                        </div>
                                        <!--<div class="modal-footer">-->

                                        <!--  <button type="reset" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>-->
                                        <!--</div>-->
                                        </form>
                                  </div>
                                </div><!-- modal-dialog -->
                            </div>
                            <?php 
                            $i++;
                            endforeach; ?>
                        </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
           <script>
function showPass(id) {
    var txt = $("#btn"+id).text();
    if(txt==='Show Password')
        $("#btn"+id).text('Hide Password');
    else
        $("#btn"+id).text('Show Password');
    $("#pass"+id).toggle();
}
</script>
        <?php include('includes/footer.php')?>