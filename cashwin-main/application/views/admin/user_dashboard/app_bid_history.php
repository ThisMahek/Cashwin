<?php 
    include "$_SERVER[DOCUMENT_ROOT]/application/views/admin/includes/header.php";
    include "$_SERVER[DOCUMENT_ROOT]/application/views/admin/includes/sidebar.php";
	
?>
    <div class="content-wrapper">
        <br>
            <div class="page-heading">
                <div class="ibox">
                    <br>
                    <h6 class="page-title">User : <?php echo $user->name." (".$user->mobileno.")"  ?></h6>
                    <h6><a href="<?php echo base_url(); ?>UserDashboard/<?php echo $uid; ?>" style="float:right; color:#1abc9c">BACK TO DASHBOARD</a></h6>
                    
                    <div class="ibox-body">
                        
                        
                        <div class="table-responsive row">
                            <table class="table table-bordered table-hover" id="datatable" style="width:100% !important">
                                <thead>
                                    <tr style="width:100%">
                                        <th>Game</th>
                                       <th>Game Type</th>
                                        <th>Date & Time</th>
                                        <th>Digit</th>
                                         <th>Bid/Won</th>
                                        <th>Points</th>
                                        <th>Bet Type</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                <?php foreach($users as $post) : ?>
                                 <tr>
                                     <td><?php echo $post['matka_name']; ?></td>
                                     <td><?php echo ucwords($post['bet_type']).' '.$post['game_name']; ?></td>
                                     <td><?php echo date('Y-m-d h:i A', strtotime($post['time'])); ?></td>
                                     <td><?php echo $post['digits']; ?></td>
                                     <td><?php echo ($post['status']=='win')?"Won":"Bid"; ?></td>
                                     <td><?php echo $post['points']; ?></td>
                                     <td><?php echo $post['bet_type']; ?></td>
                                    </tr>
                                <?php endforeach; ?>

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
<?php //$no_footer=true; include('includes/footer.php'); ?>

<?php include "$_SERVER[DOCUMENT_ROOT]/application/views/admin/includes/footer.php"; ?>