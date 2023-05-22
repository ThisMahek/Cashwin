<?php
if ($this->session->userdata('email') == "" && $this->session->userdata('login') != true && $this->session->userdata('role_id') != 1) {
    redirect('administrator/index');
}
?>

<!-- Menu aside start -->
<div class="main-menu">
    <div class="main-menu-header">
        <ul class="nav-left-new">
            <li>
                <a id="collapse-menu" href="http://jannat.projects.anshuwap.com/" target="_blank" title="Home">
                    <i class="ti-home"></i>
                </a>
            </li>
            <li>
                <a class="main-search morphsearch-search" href="<?php echo base_url(); ?>administrator/update-profile"
                    title="Profile">
                    <i class="ti-user   "></i>
                </a>
            </li>
            <li>
                <a class="main-search morphsearch-search" href="<?php echo base_url(); ?>administrator/change-password"
                    title="Change Password">
                    <i class="fa fa-key"></i>
                </a>
            </li>
            <li>
                <a class="main-search morphsearch-search" href="<?php echo base_url(); ?>administrator/logout"
                    title="Logout">
                    <i class="fa fa-sign-out"></i>
                </a>
            </li>

        </ul>
    </div>
    <div class="main-menu-content">
        <ul class="main-navigation">
            <li class="nav-item has-class">
                <a href="<?php echo base_url(); ?>administrator/dashboard">
                    <i class="ti-home"></i>
                    <span data-i18n="nav.basic-components.main">Dashboard</span>
                </a>
            </li>

            <li class="nav-item ">
                <a href="<?php echo base_url(); ?>administrator/starline">
                    <i class="tree-1"></i>
                    <span>Starline</span>
                </a>
            </li>

            <!--<?php if ($this->session->userdata('role') == '1'): ?>-->
                <!--<li class="nav-item">-->
                <!--    <a href="#!">-->
                <!--        <i class="ti-user"></i>-->
                <!--        <span>Users</span>-->
                <!--    </a>-->
                <!--    <ul class="tree-1">-->
                <!--        <li><a href="<?php echo base_url(); ?>administrator/users/add-user">Add User</a></li>-->
                <!--        <li><a href="<?php echo base_url(); ?>administrator/users/users">Users</a></li>-->
                <!--    </ul>-->
                <!--</li>-->
                <!--<?php endif; ?>-->

            <li class="nav-item">
                <a href="#!">
                    <i class='fa fa-th-large'></i>
                    <span data-i18n="nav.basic-components.main">Live Updates</span>
                </a>
                <ul class="tree-1">
                    <?php if ($this->session->userdata('role') == '1'): ?>
                        <!--<li><a href="<?php echo base_url(); ?>administrator/matka/add" data-i18n="nav.basic-components.alert">Add Live Updates</a></li>-->

                        <li><a href="<?php echo base_url(); ?>administrator/matka/list"
                                data-i18n="nav.basic-components.breadcrumbs">Live Updates</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo base_url(); ?>administrator/matka/member_list"
                                data-i18n="nav.basic-components.breadcrumbs">Live Updates</a></li>
                    <?php endif; ?>

                </ul>
            </li>

            <li class="nav-item">
                <a href="#!">
                    <i class='fa fa-th-large'></i>
                    <span data-i18n="nav.basic-components.main">View Details</span>
                </a>
                <ul class="tree-1">
                    <li><a href="<?php echo base_url(); ?>administrator/view_users"
                            data-i18n="nav.basic-components.breadcrumbs">View Users</a></li>
                    <li><a href="<?php echo base_url(); ?>administrator/notify"
                            data-i18n="nav.basic-components.breadcrumbs">Add Notification</a></li>
                    <li><a href="<?php echo base_url(); ?>administrator/add_wallet"
                            data-i18n="nav.basic-components.breadcrumbs">Add points</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#!">
                    <i class='fa fa-th-large'></i>
                    <span data-i18n="nav.basic-components.main">Point Request</span>
                </a>
                <ul class="tree-1">
                    <li><a href="<?php echo base_url(); ?>administrator/add_point_req"
                            data-i18n="nav.basic-components.breadcrumbs">Add Points Request</a></li>
                    <li><a href="<?php echo base_url(); ?>administrator/withdraw_point_req"
                            data-i18n="nav.basic-components.alert">Withdraw Point Request</a></li>
                    <!-- <li><a href="<?php echo base_url(); ?>administrator/add_wallet" data-i18n="nav.basic-components.breadcrumbs">Add points</a></li>-->
                </ul>
            </li>

            <?php if ($this->session->userdata('role') == '1'): ?>
                <li class="nav-item">
                    <a href="#!">
                        <i class="ti-menu"></i>
                        <span data-i18n="nav.basic-components.main">Charts</span>
                    </a>
                    <ul class="tree-1">
                        <li><a href="<?php echo base_url(); ?>administrator/add_chart"
                                data-i18n="nav.basic-components.alert">Add Chart</a></li>
                        <!--  <li><a href="<?php echo base_url(); ?>administrator/edit_chart" data-i18n="nav.basic-components.alert">Update Chart</a></li> -->
                        <li><a href="<?php echo base_url(); ?>administrator/view_chart"
                                data-i18n="nav.basic-components.breadcrumbs">List Charts</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#!">
                        <i class="ti-menu"></i>
                        <span data-i18n="nav.basic-components.main">Update Mobile</span>
                    </a>
                    <ul class="tree-1">
                        <li><a href="<?php echo base_url(); ?>administrator/update_mobile"
                                data-i18n="nav.basic-components.alert">Update Mobile</a></li>
                    </ul>
                </li>
            <?php endif; ?>
            <!--  <li class="nav-item">
                        <a href="#!">
                            <i class="ti-layout-slider"></i>
                            <span data-i18n="nav.basic-components.main">Sliders</span>
                        </a>
                        <ul class="tree-1">
                            <li><a href="<?php echo base_url(); ?>administrator/sliders/create" data-i18n="nav.basic-components.alert">Add slider</a></li>
                            <li><a href="<?php echo base_url(); ?>administrator/sliders" data-i18n="nav.basic-components.breadcrumbs">List slider</a></li>
                        </ul>
                    </li> -->



        </ul>
    </div>
</div>
<!-- Menu aside end -->
<!-- Main-body start -->
<!-- Main-body start -->
<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->

        <?php if ($this->session->flashdata('success')): ?>
            <?php echo '<div class="alert alert-success icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Success! &nbsp;&nbsp;</strong>' . $this->session->flashdata('success') . '</p></div>'; ?>
        <?php endif; ?>
        <?php if ($this->session->flashdata('danger')): ?>
            <?php echo '<div class="alert alert-danger icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Error! &nbsp;&nbsp;</strong>' . $this->session->flashdata('danger') . '</p></div>'; ?>
        <?php endif; ?>

        <?php if (validation_errors() != null): ?>
            <?php echo '<div class="alert alert-warning icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Alert! &nbsp;&nbsp;</strong>' . validation_errors() . '</p></div>'; ?>
        <?php endif; ?>

        <?php if ($this->session->flashdata('match_old_password')): ?>
            <?php echo '<p class="alert alert-success">' . $this->session->flashdata('match_old_password') . '</p>'; ?>
        <?php endif; ?>