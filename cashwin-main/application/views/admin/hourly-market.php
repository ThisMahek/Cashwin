<?php
include('includes/header.php');
include('includes/sidebar.php');
?>
        <div class="content-wrapper">
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                        <?php if ($status != "") { ?>
                            <span id="alert_status"><div class="alert alert-success alert-dismissable fade show has-icon"><i class="la la-check alert-icon"></i>
                                        <button class="close" data-dismiss="alert" aria-label="Close"></button><strong>Success!</strong><br><?php echo $status; ?></div></span>
                                    <?php } ?>
                    <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-10">
                          <h5 class="font-strong mb-4">Hourly Market Detail</h5></div>
                          <div class="col-md-2">
                          <button type="button" class="btn btn-info btn-square" data-toggle="modal" data-target="#exampleModalCenter">+Add</button>
                         
                          </div>
                       </div>
                        <div class="flexbox mb-4">
                            
                            <div class="input-group-icon input-group-icon-left mr-3">
                                <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">
                            </div>
                           
                            
                        </div>
                        <div class="table-responsive row">
                            <table class="table table-bordered table-hover" id="datatable">
                                <thead class="thead-default thead-lg">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <!--<th>Is Active </th>-->
                                        <th>Result</th>
                                         <th class="no-sort">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($lists as $list): ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $list->name ?></td>
                                            <!--<td>-->
                                            <!--    <? //php if($list->status=="active"): ?>-->
                                            <!--        <button type="button" class="btn btn-primary btn-sm" onclick="deactivate(<?= $list->id ?>)">Active</button>-->
                                            <!--    <? //php else: ?>-->
                                            <!--        <button type="button" class="btn btn-danger btn-sm" onclick="activate(<?= $list->id ?>)">Inactive</button>-->
                                            <!--    <? //php endif; ?>-->
                                            <!--</td>-->
                                            <td><button type="button" class="btn btn-info btn-fix btn-sm"  data-toggle="modal" data-target="#declearResult<?= $list->id ?>">Declare Result</button></td>
                                            <td>
                                            <!--<a href="" data-toggle="modal" data-target="#exampleModalCenter1"><button type="button" class="btn btn-info btn-icon-only btn-circle btn-sm btn-air"><i class="la la-pencil"></i></button></a>-->
                                            <button class="btn btn-danger btn-icon-only btn-circle btn-sm btn-air" onclick="deletes(<?= $list->id ?>)"><i class="ti-trash"></i></button>
                                            </td>
                                        </tr>
                <!--declear result model start here-->
                <div class="modal fade" id="declearResult<?= $list->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Hourly Result</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                                <input type="hidden" name="market_id" value="1">  
                                                <div class="form-group">
                                                    <label>Select Time</label>
                                                         <select class="form-control" name="start_time" required>
                                                          <option value="">Select Time</option>
                                                          <?php foreach (json_decode($list->result) as $time): ?>
                                                                  <option><?= date("h:i A", strtotime($time[0]->time)); ?></option>
                                                          <?php endforeach; ?>
                                                        </select>
                                                                                                                                                </div>
                                                <div class="form-group">
                                                    <label>Result</label>
                                                    <input type="text" class="form-control" name="result" value="" required>
                                                </div>  
                                            
                                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="DeclareRes" value="<?= $list->id ?>" class="btn btn-primary">Declare</button>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
                                        <?php $i++; endforeach; ?>
                                 
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- END PAGE CONTENT-->

            <!-- addHourly Market model satrt here -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="form-info" action="" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Add Hourly Market</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="">
                                        <div class="ibox-body">
                                            <div class="row">
                                                <div class="col-sm-12 form-group mb-4">
                                                    <label>Name</label>
                                                    <div class="input-group">
                                                       <input type="text" class="form-control" name="name">
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 form-group mb-4">
                                                     <label>Add time</label>
                                                     <div class="row">
                                                    <div class="col-sm-10 form-group mb-4">
                                                       
                                                        <div class="input-group">
                                                           <input type="time" class="form-control" name="time[]">
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 form-group mt-2">
                                                        <button type="button" id="addTime" class="btn btn-primary">+</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" id="appended">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="AddHourlyMarket" value="1" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <!-- end  Marqee model  -->
             <!-- Start edit Hourly Market model satrt here -->
             <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Hourly Market</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                     <form class="form-info" action="">
                    <div class="modal-body">
                        <div class="">
                                   
                                        <div class="ibox-body">
                                            <div class="row">
                                                <div class="col-sm-12 form-group mb-4">
                                                    <label>Name</label>
                                                    <div class="input-group">
                                                       <input type="text" class="form-control" name="name">
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 form-group mb-4">
                                                     <label>Edit</label> time</label>
                                                     <div class="row">
                                                    <div class="col-sm-10 form-group mb-4">
                                                       
                                                        <div class="input-group">
                                                           <input type="time" class="form-control" name="time[]">
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 form-group mt-2">
                                                        <button type="button" id="Edit-Time" class="btn btn-primary">+</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" id="appended_time">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Submit</button>
                    </div>
                    </div>
                </div>
            </div>
            <!-- End edit Marqee model  -->
<script>
function activate(id) {
    if(confirm('Are you sure  to activate?')){
        //AJAX method: Activate
        window.location.href = "<?php echo current_url() ?>/activate/"+id;
    } else {
       event.preventDefault();
    }
}

function deactivate(id) {
    if(confirm('Are you sure to deactivate?')){
        //AJAX method: Deactivate
        window.location.href = "<?php echo current_url() ?>/deactivate/"+id;
    } else {
       event.preventDefault(); 
    }
}
function deletes(id) {
    if(confirm('Are you sure to delete?')){
        //AJAX method: Delete
        window.location.href = "<?php echo current_url() ?>/delete/"+id;
    } else {
       event.preventDefault(); 
    }
}
</script>

<script>
    $(document).ready(function(){
        $('#addTime').click(function(e) {
            $("#appended").append('<div class="col-sm-12 form-group mb-4"><div class="row"><div class="col-sm-10 form-group mb-4"><div class="input-group"><input type="time" class="form-control" name="time[]"></div></div><div class="col-sm-2 form-group mt-2"><button type="button" id="removeTime" class="btn btn-danger">x</button></div></div></div>');
        });
        $('#appended').on('click', '#removeTime', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
        $('#Edit-Time').click(function(e) {
            $("#appended_time").append('<div class="col-sm-12 form-group mb-4"><div class="row"><div class="col-sm-10 form-group mb-4"><div class="input-group"><input type="time" class="form-control" name="time[]"></div></div><div class="col-sm-2 form-group mt-2"><button type="button" id="removeTime_edit" class="btn btn-danger">x</button></div></div></div>');
        });
        $('#appended_time').on('click', '#removeTime_edit', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
        setTimeout(function() {
    $('#alert_status').fadeOut('fast');
}, 3000);
    });
    
</script>
<?php include('includes/footer.php') ?>