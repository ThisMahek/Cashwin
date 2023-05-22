<?php 
	include('includes/header.php');
	include('includes/sidebar.php');
?>

<div class="content-wrapper">
            
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                       <div class="row" style="padding-bottom: 7px;">
                          <div class="col-md-6">
                          <h5 class="font-strong mb-4">View Point Lists</h5></div>
                          <div class="col-md-6">
                                <!-- <div class="page-heading">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="index-2.html"><i class="la la-home font-20"></i></a>
                                        </li>
                                        <li class="breadcrumb-item">Basic UI</li>
                                        <li class="breadcrumb-item">Typography</li>
                                    </ol>
                                </div> -->
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
                                <thead class="thead-default thead-lg">
                                    <tr>
                                         <th>Sr No.</th>
                                        <th>Game</th>
                                        <th>Bet Type</th>
                                         <th>Date</th>
                                         <th>Digit</th>
                                         <th>Point</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $i =1;
                                foreach($users as $post) : 
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $post[0]; ?></td>
                                    <td><?php echo $post[1]; ?></td>
                                    <td><?php echo $post[2]; ?></td>
                                    <td><?php echo $post[3]; ?></td>
                                    <td><?php echo $post[4]; ?></td>
                                </tr>
                                <?php
                                    $i++;
                                    endforeach;
                                ?>

                                <!-- <div class="paginate-link">
                                    <?php //echo $this->pagination->create_links(); ?>
                                </div>  -->

                                 </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
           
        <?php include('includes/footer.php')?>