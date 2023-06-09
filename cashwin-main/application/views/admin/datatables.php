<?php
include('includes/header.php');
include('includes/sidebar.php');
?>

<div class="content-wrapper">
            
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                        <h5 class="font-strong mb-4">DATATABLE</h5>
                        <div class="flexbox mb-4">
                            <div class="flexbox">
                                <label class="mb-0 mr-2">Type:</label>
                                <select class="selectpicker show-tick form-control" id="type-filter" title="Please select" data-style="btn-solid" data-width="150px">
                                    <option value="">All</option>
                                    <option>Shipped</option>
                                    <option>Completed</option>
                                    <option>Pending</option>
                                    <option>Canceled</option>
                                </select>
                            </div>
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
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th>Date</th>
                                        <th class="no-sort"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <a href="javascript:;">#1254</a>
                                        </td>
                                        <td>Becky Brooks</td>
                                        <td>$457</td>
                                        <td>
                                            <span class="badge badge-success badge-pill">Shipped</span>
                                        </td>
                                        <td>Paid</td>
                                        <td>17.05.2018</td>
                                        <td>
                                            <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <a href="javascript:;">#1253</a>
                                        </td>
                                        <td>Emma Johnson</td>
                                        <td>$1200</td>
                                        <td>
                                            <span class="badge badge-success badge-pill">Shipped</span>
                                        </td>
                                        <td>Paid</td>
                                        <td>17.05.2018</td>
                                        <td>
                                            <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            <a href="javascript:;">#1252</a>
                                        </td>
                                        <td>Noah Williams</td>
                                        <td>$780</td>
                                        <td>
                                            <span class="badge badge-primary badge-pill">Pending</span>
                                        </td>
                                        <td>Paid</td>
                                        <td>16.05.2018</td>
                                        <td>
                                            <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>
                                            <a href="javascript:;">#1251</a>
                                        </td>
                                        <td>Sophia Jones</td>
                                        <td>$105</td>
                                        <td>
                                            <span class="badge badge-success badge-pill">Completed</span>
                                        </td>
                                        <td>Paid</td>
                                        <td>15.05.2018</td>
                                        <td>
                                            <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>
                                            <a href="javascript:;">#1250</a>
                                        </td>
                                        <td>Jacob Brown</td>
                                        <td>$40</td>
                                        <td>
                                            <span class="badge badge-primary badge-pill">Pending</span>
                                        </td>
                                        <td>_</td>
                                        <td>12.05.2018</td>
                                        <td>
                                            <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>
                                            <a href="javascript:;">#1249</a>
                                        </td>
                                        <td>James Davis</td>
                                        <td>$78</td>
                                        <td>
                                            <span class="badge badge-success badge-pill">Shipped</span>
                                        </td>
                                        <td>Paid</td>
                                        <td>12.05.2018</td>
                                        <td>
                                            <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>
                                            <a href="javascript:;">#1248</a>
                                        </td>
                                        <td>Ava Wilson</td>
                                        <td>$1450</td>
                                        <td>
                                            <span class="badge badge-danger badge-pill">Canceled</span>
                                        </td>
                                        <td>_</td>
                                        <td>11.05.2018</td>
                                        <td>
                                            <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>
                                            <a href="javascript:;">#1247</a>
                                        </td>
                                        <td>Ethan Taylor</td>
                                        <td>$390</td>
                                        <td>
                                            <span class="badge badge-success badge-pill">Completed</span>
                                        </td>
                                        <td>Paid</td>
                                        <td>10.05.2018</td>
                                        <td>
                                            <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>
                                            <a href="javascript:;">#1246</a>
                                        </td>
                                        <td>Emily Thomas</td>
                                        <td>$850</td>
                                        <td>
                                            <span class="badge badge-success badge-pill">Completed</span>
                                        </td>
                                        <td>Paid</td>
                                        <td>10.05.2018</td>
                                        <td>
                                            <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>
                                            <a href="javascript:;">#1245</a>
                                        </td>
                                        <td>Noah Moore</td>
                                        <td>$220</td>
                                        <td>
                                            <span class="badge badge-danger badge-pill">Canceled</span>
                                        </td>
                                        <td>_</td>
                                        <td>09.05.2018</td>
                                        <td>
                                            <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>
                                            <a href="javascript:;">#1244</a>
                                        </td>
                                        <td>Mia Anderson</td>
                                        <td>$90</td>
                                        <td>
                                            <span class="badge badge-success badge-pill">Completed</span>
                                        </td>
                                        <td>Paid</td>
                                        <td>08.05.2018</td>
                                        <td>
                                            <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>
                                            <a href="javascript:;">#1243</a>
                                        </td>
                                        <td>Amelia Harris</td>
                                        <td>$670</td>
                                        <td>
                                            <span class="badge badge-success badge-pill">Completed</span>
                                        </td>
                                        <td>Paid</td>
                                        <td>08.05.2018</td>
                                        <td>
                                            <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>
                                            <a href="javascript:;">#1242</a>
                                        </td>
                                        <td>Sofia Jackson</td>
                                        <td>$1120</td>
                                        <td>
                                            <span class="badge badge-success badge-pill">Completed</span>
                                        </td>
                                        <td>Paid</td>
                                        <td>07.05.2018</td>
                                        <td>
                                            <a class="text-muted font-16" href="javascript:;"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13">2018 © <b>Adminca</b> - Save your time, choose the best</div>
                <div>
                    <a class="px-3 pl-4" href="http://themeforest.net/item/adminca-responsive-bootstrap-4-3-angular-4-admin-dashboard-template/20912589" target="_blank">Purchase</a>
                    <a class="px-3" href="http://admincast.com/adminca/documentation.html" target="_blank">Docs</a>
                </div>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
</div>
        <?php include('includes/footer.php') ?>