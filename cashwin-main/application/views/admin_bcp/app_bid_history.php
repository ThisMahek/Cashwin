<?php 
	include('includes/header1.php');
	//include('includes/sidebar.php');
?>
    <style>
        .header,#sidebar{
            visibility:hidden !important;
            height:0px !important;
            width:0px !important;
            margin-top:0px !important;
        }
        .content-wrapper{
            margin-left:0px !important;
            padding-top:0px !important;
            padding: 0 !important;
            min-height: fit-content !important;
        }
    </style>
    <div class="content-wrapper">
            <div class="fade-in-up">
                <div class="ibox" style="margin-bottom: 0px">
                    <div class="ibox-body" style="padding: 1px 5px 1px;">
                       <!--<div class="row" style="padding-bottom: 7px;">-->
                       <!--   <div class="col-md-6">-->
                       <!--   <h5 class="font-strong mb-4">View Game History</h5></div>-->
                       <!--   <div class="col-md-6">-->
                                <!-- <div class="page-heading">
                       <!--             <ol class="breadcrumb">-->
                       <!--                 <li class="breadcrumb-item">-->
                       <!--                     <a href="index-2.html"><i class="la la-home font-20"></i></a>-->
                       <!--                 </li>-->
                       <!--                 <li class="breadcrumb-item">Basic UI</li>-->
                       <!--                 <li class="breadcrumb-item">Typography</li>-->
                       <!--             </ol>-->
                       <!--         </div> -->
                       <!--   </div>-->
                       <!--</div>-->
                        
                        <!--<div class="flexbox mb-4">-->
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
                            <!--<div class="input-group-icon input-group-icon-left mr-3">-->
                            <!--    <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>-->
                            <!--    <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Search ...">-->
                            <!--</div>-->
                        <!--</div>-->
                        <div class="table-responsive row">
                            <table class="table table-bordered table-hover" id="datatable1">
                                <thead>
                                    <tr style="width:100%">
                                        <th>Game</th>
                                       <th>Game Type</th>
                                        <th>Date & Time</th>
                                        <th>Digit</th>
                                         <th>Bid / Won (Points)</th>
                                        
                                        <!--<th>Points</th>-->
                                       <!-- <th>Digits</th>-->
                                       <!--<th>Date</th>-->
                                       <!--<th>Time</th>-->
                                       <!-- <th>Bet Type</th>-->
                                    </tr>
                                </thead>
                                 <tbody>
                                <?php foreach($users as $post) : ?>
                                 <tr>
                                     <td><?php echo $post['matka_name']; ?></td>
                                     <td><?php echo ucwords($post['bet_type']).' '.$post['game_name']; ?></td>
                                     <td><?php echo date('Y-m-d h:i A', strtotime($post['time'])); ?></td>
                                     <td><?php echo $post['digits']; ?></td>
                                     <td><?php echo ($post['status']=='win')?"Won":"Bid"; ?>(<?php echo $post['points']; ?>)</td>
                                    
                                     <!--<td><?php echo $post['digits']; ?></td>-->
                                     <!--<td><?php echo $post['date']; ?></td>-->
                                     <!--<td><?php echo $post['time']; ?></td>-->
                                     <!--<td><?php echo $post['bet_type']; ?></td>-->
                                     <!-- <td>
                                        <img width="20px;" src="<?php echo site_url();?>assets/images/users/<?php echo $post['image']; ?> ">
                                     </td>-->
                                     <!--<td><a href="edit-blog.php?id=14"><?php echo $post['name']; ?></a></td>-->
                                     <!--<td><?php echo date("M d,Y", strtotime($post['register_date'])); ?></td>-->
                                     <!-- <td>
                                     <?php if($post['status'] == 1){ ?>
                                        <a class="label label-inverse-primary enable" href='<?php echo base_url(); ?>admin1/enable/<?php echo $post['id']; ?>?table=<?php echo base64_encode('user_profile'); ?>'>Enabled</a>
                                     <?php }else{ ?>
                                        <a class="label label-inverse-warning desable" href='<?php echo base_url(); ?>admin1/desable/<?php echo $post['id']; ?>?table=<?php echo base64_encode('user_profile'); ?>'>Desabled</a>
                                     <?php } ?>
                                                <a class="label label-inverse-info" href='<?php echo base_url(); ?>admin1/users/update-user/<?php echo $post['id']; ?>'>Edit</a>
                                                <a class="label label-inverse-danger delete" href='<?php echo base_url(); ?>admin1/delete/<?php echo $post['id']; ?>?table=<?php echo base64_encode('user_profile'); ?>'>Delete</a>
                                            
                                        </td>-->
                                    </tr>
                                <?php endforeach; ?>

                                <!-- <div class="paginate-link">
                                    <?php //echo $this->pagination->create_links(); ?>
                                </div>  -->

                                 </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <br>
            <!-- END PAGE CONTENT-->
            <?php if(!isset($no_footer)): ?>
            <footer class="page-footer">
                <div class="font-13">2020 © <b>Chirag Matka</b> All Rights Reserved</div>
                <div></div>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
            <?php endif; ?>
        </div>
</div>
</div>
    <!-- START SEARCH PANEL-->
    <!--<form class="search-top-bar" action="">-->
    <!--    <input class="form-control search-input" type="text" placeholder="Search...">-->
    <!--    <button class="reset input-search-icon"><i class="ti-search"></i></button>-->
    <!--    <button class="reset input-search-close" type="button"><i class="ti-close"></i></button>-->
    <!--</form>-->
   
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    
    <script src="<?php echo base_url() ?>assets/resources/vendors/jquery/dist/jquery.min.js"></script>

  <script src="<?php echo base_url() ?>assets/resources/vendors/dataTables/datatables.min.js"></script>

    <script>
        $(function() {
            $('#datatable1').DataTable({
                pageLength: 15,
                "order": [[ 2, "desc" ]],
                "sDom": 'rtip',
                "autoWidth": true,
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                }]
                
            });

            var table1 = $('#datatable1').DataTable();
            $('#key-search').on('keyup', function() {
                table1.search(this.value).draw();
            });
            $('#type-filter').on('change', function() {
                table1.column(4).search($(this).val()).draw();
            });
        });
    </script>

    <!-- CORE SCRIPTS-->
    <script src="<?php echo base_url() ?>assets/resources/js/app.min.js"></script>


</body>

</html>