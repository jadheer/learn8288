<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('uploads/others/favicon.png'); ?>">

        <title>Skillsswear</title>

        <!-- App css -->
        <?= link_tag('assets/js/summernote/summernote.css') ?> 
        <?= link_tag('assets/css/bootstrap.min.css') ?>
        <?= link_tag('assets/css/core.css') ?>
        <?= link_tag('assets/css/components.css') ?>
        <?= link_tag('assets/css/icons.css') ?>
        <?= link_tag('assets/css/pages.css') ?>
        <?= link_tag('assets/css/menu.css') ?>
        <?= link_tag('assets/css/responsive.css') ?>
        <?= link_tag('assets/js/switchery/switchery.min.css') ?>
        <?= link_tag('assets/js/bootstrap-sweetalert/sweet-alert.css') ?> 
        <?= link_tag('assets/js/datatables/jquery.dataTables.min.css') ?>

        <script src="<?= base_url('assets/js/modernizr.min.js'); ?> "></script>

    </head>


    <body>


        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- Logo container-->
                    <div class="logo">
                        <!-- Text Logo -->
                        <!--<a href="index.html" class="logo">-->
                            <!--Zircos-->
                        <!--</a>-->
                        <!-- Image Logo -->
                        <a href="index.html" class="logo">
                            <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo" height="40">
                        </a>

                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras">

                        <ul class="nav navbar-nav navbar-right pull-right">

                            <li class="dropdown navbar-c-items">
                                <a href="#" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo base_url('assets/images/users/avatar-1.jpg'); ?>" alt="user-img" class="img-circle"> </a>
                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                    <li><?= anchor('Admin_authentication/logout','<i class="ti-power-off m-r-5"></i> Logout'); ?></li>
                                </ul>

                            </li>
                        </ul>
                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>
                    <!-- end menu-extras -->

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li class="has-submenu">
                                <?= anchor('admin/dashboard','<i class="mdi mdi-view-dashboard"></i>Dashboard'); ?>
                            </li>

                            <?php if($this->session->userdata('role') == 'SUP'){ ?>

                            <li class="has-submenu">
                                <a href="#"><i class="mdi mdi-account-multiple"></i>Manage Course</a>
                                <ul class="submenu">
                                    <li>
                                        <?= anchor('admin_functions/new_product','Manage Main Category'); ?>
                                    </li>
                                    <li>
                                        <?= anchor('admin_functions/sub_category','Manage Sub Category'); ?>
                                    </li>
                                    <li>
                                        <?= anchor('admin_functions/class_room_training','Manage Classroom Training'); ?>
                                    </li>
                                    <li>
                                        <?= anchor('admin_functions/online_training','Manage Online Training'); ?>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="mdi mdi-account-multiple"></i>Manage Center</a>
                                <ul class="submenu">
                                    <li>
                                        <?= anchor('admin_functions/new_country','Manage Country'); ?>
                                    </li>
                                    <li>
                                        <?= anchor('admin_functions/centers','Manage Centers'); ?>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="mdi mdi-account-multiple"></i>Manage CMS</a>
                                <ul class="submenu">
                                    <li>
                                        <?= anchor('admin_functions/course_cms','Manage Course CMS'); ?>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="mdi mdi-upload"></i>Purchase</a>
                                <ul class="submenu">
                                    <li><?= anchor('admin_functions/orders','Orders'); ?></li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="mdi mdi-upload"></i>CMS</a>
                                <ul class="submenu">
                                    <li><?= anchor('admin_functions/popular_courses','Most Popular Course'); ?></li>
                                </ul>
                            </li>

                            <?php } ?>

                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->