<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.js" integrity="sha512-Dm5UxqUSgNd93XG7eseoOrScyM1BVs65GrwmavP0D0DujOA8mjiBfyj71wmI2VQZKnnZQsSWWsxDKNiQIqk8sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <style>
     .side-menu .nav-2-level>li>a{
         padding: 7px 10px 7px 40px;
     }
 </style> 
 <!-- START SIDEBAR-->
 <nav class="page-sidebar" id="sidebar" >
            <div id="sidebar-collapse">
                <ul class="side-menu metismenu">
                    <li class="active">
                        <a href="<?= base_url() ?>admin/index"><i class="sidebar-item-icon ti-home"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                   <li>
                       <a href="<?= base_url() ?>admin/view_users"><i class="sidebar-item-icon bx bxs-user-detail"></i>
                            <span class="nav-label">User Management</span>
                        </a>
                    </li>
                     <li>
                          <a href="<?= base_url() ?>admin/declare_result/matka"><i class="sidebar-item-icon bx bx-bullseye"></i>
                            <span class="nav-label">Declare Result</span>
                        </a>
                    </li>
                     <li>
                        
                            
                        </li>
                        <li>
                        <a href="<?= base_url() ?>report/winning_prediction/matka"><i class="sidebar-item-icon bx bx-bullseye"></i>
                                <span class="nav-label">Winning Prediction</span>
                            </a>

                  
                    <!--  <a href="javascript:void(0)"><i class="sidebar-item-icon ti-list"></i>-->
                    <!--        <span class="nav-label">Declare Result</span><i class="fa fa-angle-left arrow"></i></a>-->
                    <!--        <ul class="nav-2-level collapse">-->
                    <!--            <li>-->
                    <!--                <a href="<?= base_url() ?>admin/matka/list">Live Updates</a>-->
                    <!--            </li>-->
                                <!-- <li>-->
                                <!--    <a href="<?= base_url() ?>admin/result_declartion">Result Declaration </a>-->
                                <!--</li>-->
                    <!--       </ul>  -->
                    <!--</li>-->
                  
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
                    <!--<li>-->
                      
                   
                    <!--<li>-->
                        
                    <!--    <a href="<?php echo base_url(); ?>admin/report/"><i class="sidebar-item-icon ti-widget"></i>-->
                    <!--        <span class="nav-label">Download report</span>-->
                    <!--    </a>-->
                    <!--</li>-->
                    
                       
                                
                           </li>
                    <li>
                        <a href="<?= base_url() ?>admin/gamedata/game"><i class="sidebar-item-icon bx bx-file"></i>
                            <span class="nav-label">Report Management</span><i class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-2-level collapse">
                                <!--<li>-->
                                <!--    <a href="<?= base_url() ?>admin/gamedata">Game Data</a>-->
                                <!--</li>-->
                                <li>
                                    <a href="<?= base_url() ?>report/user_bid_history/matka">Users Bid History</a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>report/customer_sale_report/matka">Customer Sale Report</a>
                                </li>
                                
                                <li>
                                    <a  href="<?= base_url()?>report/winning_report/matka">Winning Report</a>
                                </li>
                                <li>
                                    <a href="<?= base_url()?>report/transfer_point_request">Transfer Point Report</a>
                                </li>
                                <li>
                                    <a href="<?= base_url()?>report/bid_winning_report">Bid Win Report</a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>report/withdraw_report">Withdraw Report</a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>report/deposit_history">Auto Deposit History</a>
                                </li>
                                  

                                <!--<li>-->
                                <!--    <a href="#">Add Fund Report</a>-->
                                <!--</li>-->
                            </ul>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0)"><i class="sidebar-item-icon bx bx-wallet"></i>
                            <span class="nav-label">Wallet Management</span><i class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-2-level collapse">
                                <li>
                                    <a href="<?= base_url() ?>admin/add_point_req">Fund Request</a>
                                    <!--<a href="<?= base_url() ?>admin/add_point_req">Add Points Request</a>-->
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>admin/withdraw_point_req">Withdraw  Request</a>
                                </li>
                                 <li>
                                    <!--<a href="<?= base_url() ?>admin/add_wallet">Add Points</a>-->
                                    <a href="<?= base_url() ?>admin/add_wallet">Add Fund (User Wallet)</a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>report/bid_revert">Bid Revert</a>
                                </li>
                                <!--<li>-->
                                <!--    <a href="<?= base_url() ?>admin/user_passbook">User Passbook</a>-->
                                <!--</li>-->
                            </ul>  
                    </li>
                    
                    <li>
                        <a href="javascript:void(0)"><i class="sidebar-item-icon bx bx-bullseye"></i>
                            <span class="nav-label">Game Management</span><i class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-2-level collapse">
                                <li>
                                    <a href="<?= base_url() ?>admin/matka/list">Game Name</a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>admin/market_gamerate/matka">Game Rates</a>
                                </li>
                                <!--<li>-->
                                <!--    <a href="<?= base_url() ?>admin/gamerate">Game Rates</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <a href="<?= base_url() ?>admin/market_gamerate">Market Game Rates</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                <!--    <a href="<?= base_url() ?>admin/starline_gamerate">Starline Game Rates</a>-->
                                <!--</li>-->
                            </ul>  
                    </li>
                    
                    <li>
                        <a href="javascript:void(0)">
                            <i class="sidebar-item-icon bx bx-bullseye"></i>
                            <span class="nav-label">Game & Numbers</span><i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="nav-2-level collapse">
                        	<li><a href="<?= base_url('Admin/game_number_data')?>/single-digit">Single Digit</a></li>
    				      	<li><a href="<?= base_url('Admin/game_number_data')?>/jodi-digit">Jodi Digit</a> </li> 
    						<li><a href="<?= base_url('Admin/game_number_data')?>/single-pana">Single Pana</a> </li> 
    					   	<li><a href="<?= base_url('Admin/game_number_data')?>/double-pana">Double Pana</a> </li> 
    					    <li><a href="<?= base_url('Admin/game_number_data')?>/tripple-pana/">Tripple Pana</a> </li> 
    						<li><a href="<?= base_url('Admin/game_number_data')?>/half-sangam">Half Sangam</a> </li> 
    					   
    						<li><a href="<?= base_url('Admin/game_number_data')?>/full-sangam">Full Sangam</a> </li>  
                            <!--<li>-->
                            <!--    <a href="<?= base_url() ?>Game_dashboard/market_load">-->
                            <!--        <span class="nav-label">Market Load</span>-->
                            <!--    </a>-->
                            <!--</li>-->
                            <!--<li>-->
                            <!--    <a href="<?= base_url() ?>Game_dashboard/starline_load">-->
                            <!--        <span class="nav-label">Starline Load</span>-->
                            <!--    </a>-->
                            <!--</li>-->
                        </ul>
                    </li>
                    
                   
                    <li>
                        <a href="javascript:void(0)"><i class="sidebar-item-icon bx bx-cog"></i>
                            <span class="nav-label">Setting</span><i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="nav-2-level collapse">
                            <li><a href="<?= base_url() ?>admin/app_setting">Main Settings</a></li>
    						<li><a href="<?= base_url() ?>admin/contact_setting">Contact Settings</a></li>
    						<!--<li><a href="#">Clear Data</a></li>-->
    						<li><a href="<?= base_url() ?>admin/manage_slider">Slider Images</a></li>
    						<li><a href="<?= base_url() ?>admin/how_to_play">How To Play</a> </li>
                            <!--<li><a href="<?= base_url() ?>admin/app_setting">App Setting</a></li>-->
                            <!--<li><a href="<?= base_url() ?>admin/manage_slider">Manage Slider</a></li>-->
                       </ul> 
                     </li>
                    
                     <li>
                        <a href="javascript:void(0)"><i class="sidebar-item-icon bx bx-cog"></i>
                            <span class="nav-label">Notice Management</span><i class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-2-level collapse">
                                <li><a href="<?= base_url()?>admin/view_notification">Notice Management</a> </li>
    					     	<li><a href="<?= base_url() ?>admin/notify">Send Notification</a> </li>
                                <!--<li><a href="<?= base_url() ?>admin/notify">Add Notification</a></li>-->
                                <!--<li><a href="<?= base_url() ?>admin/view_notification">View Notification</a></li>-->
                           </ul>  
                          
                    </li>
                     <li>
                        <a href="javascript:void(0)"><i class="sidebar-item-icon bx bx-file"></i>
                            <span class="nav-label">Starline Management</span><i class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-2-level collapse">
                                	<li><a href="<?= base_url()?>report/starline">Game Name</a></li>
            						<li><a href="<?= base_url() ?>admin/market_gamerate/starline">Game Rates</a></li>
            						<li><a href="<?= base_url()?>report/user_bid_history/starline">Bid History</a></li>
            						<li><a href="<?= base_url()?>admin/declare_result/starline">Declare Result</a></li>
            					    <li><a href="<?= base_url()?>admin/result_history/starline">Result History</a></li>
            						<li><a href="<?= base_url()?>report/customer_sale_report/starline">Starline Sale report</a></li>
            						<li><a href="<?= base_url() ?>report/winning_report/starline">Starline Winning report</a></li>
            						<li><a href="<?= base_url()?>report/winning_prediction/starline">Starline Winning Prediction</a></li>
            						
                              
                           </ul>  
                         
                    </li>
                    <li>
                        <a href="javascript:void(0)"><i class="sidebar-item-icon bx bx-file"></i>
                            <span class="nav-label"> Gali Deshawar Section</span><i class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-2-level collapse">
                                	<li><a href="<?= base_url()?>admin/dmatka/list">Game Name</a></li>
            						<li><a href="<?=base_url()?>admin/market_gamerate/dmatka">Game Rates</a></li>
            						<li><a href="<?= base_url()?>report/user_bid_history/dmatka">Bid History</a></li>
            						<li><a href="<?= base_url()?>admin/declare_result/dmatka">Declare Result</a></li>
            						<li><a href="<?= base_url()?>admin/result_history/dmatka">Result History</a></li>
            						<li><a href="<?= base_url()?>report/customer_sale_report/dmatka">Gali Desawar Sell Report</a></li>
            						<li><a href="<?= base_url() ?>report/winning_report/dmatka">Gali Desawar Winning Report</a></li>
            						<li><a href="<?= base_url()?>report/winning_prediction/dmatka">Gali Desawar Winning Prediction</a></li>
            						
                              
                           </ul>  
                         
                  <!--  </li>-->
                    <!--  <li>-->
                    <!--    <a href="<?= base_url() ?>admin/starline"><i class="sidebar-item-icon bx bx-file"></i>-->
                    <!--        <span class="nav-label">Starline Manegement</span>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <li>
                          <a href="<?= base_url() ?>admin/user_enquiry"><i class="sidebar-item-icon bx bxs-user-detail"></i>
                            <span class="nav-label">Users Query</span>
                        </a>
                    </li>
                    <!-- <li>-->
                    <!--    <a href="javascript:void(0)"><i class="sidebar-item-icon ti-list"></i>-->
                    <!--        <span class="nav-label">Update Mobile</span><i class="fa fa-angle-left arrow"></i></a>-->
                    <!--        <ul class="nav-2-level collapse">-->
                    <!--            <li>-->
                    <!--                <a href="<?= base_url() ?>admin/update_mobile">Update Mobile</a>-->
                    <!--            </li>-->
                    <!--       </ul>  -->
                    <!--</li>-->
                 
                    
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