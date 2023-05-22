<?php 
    include "$_SERVER[DOCUMENT_ROOT]/application/views/admin/includes/header.php";
    include "$_SERVER[DOCUMENT_ROOT]/application/views/admin/includes/sidebar.php";
	
?>
<style>
.custom-design{
    
}
</style>
  <div class="content-wrapper">
       <div class="page-heading">
                <h1 class="page-title">User Dashboard : <?php echo $users->name." (".$users->mobileno.")"  ?></h1>
               
            </div>
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="row mb-4">
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="50" data-bar-color="#5c6bc0" data-size="90" data-line-width="10">
                                    <span class="easypie-data text-primary" style="font-size:32px;"><i class="la la-money"></i></span>
                                </div>
                                <div>
                                    <h3 class="font-strong text-primary"><?php echo $last_credit->request_points; ?></h3>
                                    <div class="text-muted">LAST CREDIT</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="70" data-bar-color="#ff4081" data-size="80" data-line-width="8">
                                    <span class="easypie-data text-pink" style="font-size:32px;"><i class="la la-money"></i></span>
                                </div>
                                <div>
                                    <h3 class="font-strong text-pink"><?php echo abs($last_withdrwal->request_points); ?></h3>
                                    <div class="text-muted">LAST WITHDRWAL</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="70" data-bar-color="#ff4081" data-size="80" data-line-width="8">
                                    <span class="easypie-data text-pink" style="font-size:32px;"><i class="la la-money"></i></span>
                                </div>
                                <div>
                                    <h3 class="font-strong text-pink"><?php echo $users->wallet_points; ?></h3>
                                    <div class="text-muted">CURRENT WALLET AMOUNT</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="70" data-bar-color="#ff4081" data-size="80" data-line-width="8">
                                    <span class="easypie-data text-pink" style="font-size:32px;"><i class="la la-money"></i></span>
                                </div>
                                <div>
                                    <h3 class="font-strong text-pink"><?php echo count($total_bids) ?></h3>
                                    <div class="text-muted"><a href="<?php echo base_url(); ?>UserDashboard/total_bids/<?php echo $users->id; ?>">TOTAL BIDS</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body flexbox-b">
                                <div class="easypie mr-4 pr-4" data-percent="70" data-bar-color="#ff4081" data-size="80" data-line-width="8">
                                    <span class="easypie-data text-pink" style="font-size:32px;"><i class="la la-money"></i></span>
                                </div>
                                <div>
                                    <h3 class="font-strong text-pink"><a href="<?php echo base_url(); ?>UserDashboard/debit_credit_details/<?php echo $users->id; ?>">View</a></h3>
                                    <div class="text-muted">FULL CREDIT/DEBIT DETAILS</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
             </div>
                   
     
            <!-- END PAGE CONTENT-->
           
        <?php include "$_SERVER[DOCUMENT_ROOT]/application/views/admin/includes/footer.php";
        ?>