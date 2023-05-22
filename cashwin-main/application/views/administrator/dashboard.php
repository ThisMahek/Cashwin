            <div class="page-header">
                <div class="page-header-title">
                    <h4>Dashboard</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Pages</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-body">
                <div class="row">

                 <div class="col-md-12 col-xl-4">
                        
                        <div class="card table-card">
                            <div class="">
                                <div class="row-table">
                                    <div class="col-sm-6 card-block-big br">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i class="icofont icofont-home text-info"></i>
                                            </div>
                                            <div class="col-sm-8 text-center">  
                                            <span> <a style="text-decoration:none; color:black" href="<?php echo base_url(); ?>" target="_blank">Home </a> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 card-block-big">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i class="icofont icofont-logout text-warning"></i>
                                            </div>
                                            <div class="col-sm-8 text-center">
                                            <span> <a style="text-decoration:none; color:black" href="<?php echo base_url(); ?>administrator/logout">Logout </a> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                 </div>
                 
                 <div class="col-md-12 col-xl-4">
                        <!-- table card start -->
                        <div class="card table-card">
                            <div class="">
                                <div class="row-table">
                                    <div class="col-sm-6 card-block-big br">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i class="icofont icofont-ui-user text-primary"></i>
                                            </div>
                                            <div class="col-sm-8 text-center">
                                            <span> <a style="text-decoration:none; color:black" href="<?php echo base_url(); ?>administrator/update-profile">Profile </a> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 card-block-big">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i class="icofont icofont-ui-password text-danger"></i>
                                            </div>
                                            <div class="col-sm-8 text-center">
                                            <span> <a style="text-decoration:none; color:black" href="<?php echo base_url(); ?>administrator/change-password">Change Password </a> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- table card end -->
                 </div>

                 <div class="col-md-12 col-xl-4">
                        <!-- table card start -->
                        <div class="card table-card widget-primary-card">
                            <div class="">
                                <div class="row-table">
                                    <div class="col-sm-6 card-block-big br">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i class="icofont icofont-database text-danger"></i>
                                            </div>
                                            <div class="col-sm-8 text-center">
                                                <h5><?php echo count($matkas) ?></h5>
                                               <span>Live Updates</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 card-block-big">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <i class="icofont icofont-users-alt-5 text-success"></i>
                                            </div>
                                            <div class="col-sm-8 text-center">
                                                <h5><?php echo count($users) ?></h5>
                                                <span>Members</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                         
                        </div>
                        <!-- table card end -->
                 </div>
                 
               
                </div>
            </div>
       