<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/assets/pages/data-table/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/bower_components/ekko-lightbox/dist/ekko-lightbox.css">
<link rel="stylesheet" type="text/css"
    href="<?php echo base_url(); ?>admintemplate/bower_components/lightbox2/dist/css/lightbox.css">

<div class="page-header">
    <div class="page-header-title">
        <h4>List Users</h4>
    </div>
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
                <a href="index-2.html">
                    <i class="icofont icofont-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">Users</a>
            </li>
            <li class="breadcrumb-item"><a href="#!">List Users</a>
            </li>
        </ul>
    </div>
</div>

<!-- Page-header end -->
<!-- Page-body start -->
<div class="page-body">
    <!-- DOM/Jquery table start -->

    <div class="card">
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <!-- <th>Image</th>-->
                            <th>Name</th>
                            <th>Username</th>
                            <th>Wallet Points</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Address</th>
                            <th>City</th>

                            <th>Account No.</th>
                            <th>Bank Name</th>
                            <th>IFSC Code</th>
                            <th>Account Holder Name</th>
                            <th>PayTM no.</th>
                            <th>Tez no.</th>
                            <th>PhonePe no.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $post): ?>
                            <tr>
                                <td>
                                    <?php echo $post['id']; ?>
                                </td>
                                <td>
                                    <?php echo $post['username']; ?>
                                </td>
                                <td>
                                    <?php echo $post['name']; ?>
                                </td>
                                <td>
                                    <?php echo $post['wallet_points']; ?>
                                </td>
                                <td>
                                    <?php echo $post['mobileno']; ?>
                                </td>
                                <td>
                                    <?php echo $post['email']; ?>
                                </td>
                                <td><button id="btn<?php echo $post['id']; ?>"
                                        onclick="showPass(<?php echo $post['id']; ?>)">Show Password</button>
                                    <p style="display:none" id="pass<?php echo $post['id']; ?>"><?php echo $post['password']; ?></p>
                                </td>
                                <td>
                                    <?php echo $post['address']; ?>
                                </td>
                                <td>
                                    <?php echo $post['city']; ?>
                                </td>
                                <td>
                                    <?php echo $post['accountno']; ?>
                                </td>
                                <td>
                                    <?php echo $post['bank_name']; ?>
                                </td>
                                <td>
                                    <?php echo $post['ifsc_code']; ?>
                                </td>
                                <td>
                                    <?php echo $post['account_holder_name']; ?>
                                </td>
                                <td>
                                    <?php echo $post['paytm_no']; ?>
                                </td>
                                <td>
                                    <?php echo $post['tez_no']; ?>
                                </td>
                                <td>
                                    <?php echo $post['phonepay_no']; ?>
                                </td>
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
    <!-- DOM/Jquery table end -->
</div>

<script>
    function showPass(id) {
        var txt = $("#btn" + id).text();
        if (txt === 'Show Password')
            $("#btn" + id).text('Hide Password');
        else
            $("#btn" + id).text('Show Password');
        $("#pass" + id).toggle();
    }
</script>