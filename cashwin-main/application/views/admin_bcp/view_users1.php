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
                          <h5 class="font-strong mb-4">List Users</h5></div>
                          <div class="col-md-6">
                              <?php
                                if($this->session->flashdata("success"))
                                    echo "<p class='alert alert-danger'>".$this->session->flashdata("success")."<p>";
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
                                <thead class="thead-default thead-lg">
                                    <tr>
                                         <th>ID</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Wallet Points</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>password</th>
                                        <th>Address</th>
                                        <th>City</th>
                                         <th>Account No</th>
                                         <th>Bank Name</th>
                                         <th>IFSC code</th>
                                         <th>Account Holder Name</th>
                                         <th>payTM no</th>
                                         <th>tez No</th>
                                         <th>PhonePe no</th>
                                         <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($users as $post) : ?>
                                 <tr>
                                   <td><?php echo $post['id']; ?></td>
                                   <td><?php echo $post['username']; ?></td>
                                   <td><?php echo $post['name']; ?></td>
                                   <td><?php echo $post['wallet_points']; ?></td>                                   
                                   <td><?php echo $post['mobileno']; ?></td>
                                   <td><?php echo $post['email']; ?></td>
                                   <td><button id="btn<?php echo $post['id']; ?>" onclick="showPass(<?php echo $post['id']; ?>)">Show Password</button>
                                   <p style="display:none" id="pass<?php echo $post['id']; ?>"><?php echo $post['password']; ?></p>
                                   </td>
                                   <td><?php echo $post['address']; ?></td>
                                   <td><?php echo $post['city']; ?></td>
                                   <td><?php echo $post['accountno']; ?></td>
                                   <td><?php echo $post['bank_name']; ?></td>
                                   <td><?php echo $post['ifsc_code']; ?></td>
                                   <td><?php echo $post['account_holder_name']; ?></td>
                                   <td><?php echo $post['paytm_no']; ?></td>
                                   <td><?php echo $post['tez_no']; ?></td>
                                   <td><?php echo $post['phonepay_no']; ?></td>
                                   <td><a href="<?= site_url('Admin/view_users/delete/'.$post['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')?true:false">Delete</a></td>
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