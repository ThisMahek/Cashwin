 <!-- START SIDEBAR-->
 <nav class="page-sidebar" id="sidebar" >
            <div id="sidebar-collapse">
                <ul class="side-menu metismenu">
                    <li class="active">
                        <a href="<?= base_url() ?>admin/index"><i class="sidebar-item-icon ti-admin1"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
          
                    <li>
                        <a href="<?= base_url() ?>admin/starline"><i class="sidebar-item-icon ti-widget"></i>
                            <span class="nav-label">Starline</span>
                        </a>
                    </li>
                    <!--<li style="">-->
                    <!--    <a href="<?= base_url() ?>Starline/hourly_market"><i class="sidebar-item-icon ti-widget"></i>-->
                    <!--        <span class="nav-label">Hourly Market</span>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li  style="">-->
                    <!--    <a href="<?= base_url() ?>Starline/hourly_chart"><i class="sidebar-item-icon ti-widget"></i>-->
                    <!--        <span class="nav-label">Hourly Charts</span>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <li>
                        <a href="javascript:void(0)"><i class="sidebar-item-icon ti-list"></i>
                            <span class="nav-label">Declare Result</span><i class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-2-level collapse">
                                <li>
                                    <a href="<?= base_url() ?>admin/matka/list">Live Updates</a>
                                </li>
                                <!-- <li>-->
                                <!--    <a href="<?= base_url() ?>admin/result_declartion">Result Declaration </a>-->
                                <!--</li>-->
                           </ul>  
                    </li>
                    <li>
                        
                        <a href="<?= base_url() ?>admin/view_users"><i class="sidebar-item-icon ti-widget"></i>
                            <span class="nav-label">View Users</span>
                        </a>
                    </li>
                    <!--<li>-->
                        
                    <!--    <a href="<?php echo base_url(); ?>admin/report/"><i class="sidebar-item-icon ti-widget"></i>-->
                    <!--        <span class="nav-label">Download report</span>-->
                    <!--    </a>-->
                    <!--</li>-->
                    
                    <li>
                        <a href="<?= base_url() ?>admin/gamedata"><i class="sidebar-item-icon ti-widget"></i>
                            <span class="nav-label">Report Management</span><i class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-2-level collapse">
                                <li>
                                    <a href="<?= base_url() ?>admin/gamedata">Game Data</a>
                                </li>
                                <li>
                                <!--    <a href="<?= base_url() ?>admin/user_bid_history">User Bid History</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <a href="<?= base_url() ?>admin/customer_sale_report">Customer Sale Report</a>-->
                                <!--</li>-->
                                
                                <!--<li>-->
                                <!--    <a href="#">Winning Report</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <a href="#">Transfer Point Report</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <a href="#">Bid Win Report</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <a href="#">Withdraw Report</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <a href="#">Auto Deposit History</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <a href="#">Add Fund Report</a>-->
                                <!--</li>-->
                            </ul>
                        
                    </li>
                    
                    <li>
                        <a href="javascript:void(0)"><i class="sidebar-item-icon ti-list"></i>
                            <span class="nav-label">Wallet Management</span><i class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-2-level collapse">
                                <li>
                                    <a href="<?= base_url() ?>admin/add_wallet">Add Points</a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>admin/add_point_req">Add Points Request</a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>admin/withdraw_point_req">Withdraw Point Request</a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>admin/user_passbook">User Passbook</a>
                                </li>
                            </ul>  
                    </li>
                    
                    <li>
                        <a href="javascript:void(0)"><i class="sidebar-item-icon ti-widget"></i>
                            <span class="nav-label">Game Management</span><i class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-2-level collapse">
                                <li>
                                    <a href="<?= base_url() ?>admin/market_gamerate">Market Game Rates</a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>admin/starline_gamerate">Starline Game Rates</a>
                                </li>
                            </ul>  
                    </li>
                    
                    <li>
                        <a href="javascript:void(0)">
                            <i class="sidebar-item-icon ti-widget"></i>
                            <span class="nav-label">Game & Numbers</span><i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="<?= base_url() ?>Game_dashboard/market_load">
                                    <span class="nav-label">Market Load</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>Game_dashboard/starline_load">
                                    <span class="nav-label">Starline Load</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0)"><i class="sidebar-item-icon ti-list"></i>
                            <span class="nav-label">Update Mobile</span><i class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-2-level collapse">
                            <li>
                                <a href="<?= base_url() ?>admin/update_mobile">Update Mobile</a>
                            </li>
                            
                           
                           </ul>  
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="sidebar-item-icon ti-list"></i>
                            <span class="nav-label">Setting</span><i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="nav-2-level collapse">
                            <li><a href="<?= base_url() ?>admin/app_setting">App Setting</a></li>
                            <li><a href="<?= base_url() ?>admin/manage_slider">Manage Slider</a></li>
                       </ul> 
                    </li>
                    
                     <li>
                        <a href="javascript:void(0)"><i class="sidebar-item-icon ti-list"></i>
                            <span class="nav-label">Notice Management</span><i class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-2-level collapse">
                                <li><a href="<?= base_url() ?>admin/notify">Add Notification</a></li>
                                <!--<li><a href="<?= base_url() ?>admin/view_notification">View Notification</a></li>-->
                           </ul>  
                    </li>
                     <li>
                        
                        <a href="<?= base_url() ?>admin/winning_prediction"><i class="sidebar-item-icon ti-widget"></i>
                            <span class="nav-label">Winning Prediction</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="sidebar-item-icon ti-list"></i>
                        <span class="nav-label">Starline Management</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="<?= base_url() ?>admin/bid-history">Bid History</a>
                            </li>
                       </ul>  
                    </li>
                  
                    
                    <!--<li>-->
                    <!--    <a href="<?//= base_url() ?>admin/add_wallet"><i class="sidebar-item-icon ti-widget"></i>-->
                    <!--        <span class="nav-label">Add Points</span>-->
                    <!--    </a>-->
                    <!--</li>-->
                    
                    <!-- <li>-->
                    <!--    <a href="javascript:void(0)"><i class="sidebar-item-icon ti-list"></i>-->
                    <!--        <span class="nav-label"> Charts</span><i class="fa fa-angle-left arrow"></i></a>-->
                    <!--        <ul class="nav-2-level collapse">-->
                    <!--        <li>-->
                         <!--        <a href="<?//= base_url() ?>admin/add_chart">Add Chart</a> -->
                    <!--        </li>-->
                    <!--        <li>-->
                            <!--     <a href="<?//= base_url() ?>admin/view_chart">List Charts</a>  --> 
                    <!--        </li>-->
                            
                    <!--       </ul>  -->
                    <!--</li>-->
                    
                    
                    
                    
                     
                     
                    
                   
                   
                         
                </ul>
                <div class="sidebar-footer">
                    <a style="width: 100% !important;" href="<?= base_url() ?>admin/logout"><i class="sidebar-item-icon ti-power-off"></i>
                            <span class="nav-label">Logout</span>
                    </a>
                </div>
            </div>
        </nav>
        <!-- END SIDEBAR-->