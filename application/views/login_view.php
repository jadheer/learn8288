<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>Skillsswear - Admin Dashboard Login</title>

        <!-- App css -->
        <?= link_tag('assets/css/bootstrap.min.css') ?>
        <?= link_tag('assets/css/core.css') ?>
        <?= link_tag('assets/css/components.css') ?>
        <?= link_tag('assets/css/icons.css') ?>
        <?= link_tag('assets/css/pages.css') ?>
        <?= link_tag('assets/css/menu.css') ?>
        <?= link_tag('assets/css/responsive.css') ?>

        <script src="<?= base_url('assets/js/modernizr.min.js'); ?> "></script>

    </head>


    <body class="bg-transparent">

        <!-- HOME -->
        <section>
            <div class="container-alt">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="m-t-40 account-pages">
                                <div class="text-center account-logo-box">
                                    <h2 class="text-uppercase">
                                        <a href="index.html" class="text-success">
                                            <span><img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Logo" height="45"></span>
                                        </a>
                                    </h2>
                                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                </div>
                                <div class="account-content">

                                      <?php echo form_open('Admin_authentication/admin_login',['class'=>'form-horizontal']); ?>

                                        <?php if( $error = $this->session->flashdata('login_failed') ) { ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-dismissible alert-danger">
                                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                        <?php echo $error; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                              <?php echo form_input(['name'=>'email','class'=>'form-control','placeholder'=>'Enter Email','required'=>'required','value'=>set_value('email')]); ?>
                                                <?php echo form_error('email'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                              <?php echo form_input(['name'=>'password','class'=>'form-control','type'=>'password','placeholder'=>'Enter Password','required'=>'required','value'=>set_value('password')]); ?>
                                                <?php echo form_error('password'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit">Log In</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->

                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->

        <!-- jQuery  -->
        <script src="<?= base_url('assets/js/jquery.min.js'); ?> "></script>
        <script src="<?= base_url('assets/js/bootstrap.min.js'); ?> "></script>
        <script src="<?= base_url('assets/js/detect.js'); ?> "></script>
        <script src="<?= base_url('assets/js/fastclick.js'); ?> "></script>
        <script src="<?= base_url('assets/js/jquery.blockUI.js'); ?> "></script>
        <script src="<?= base_url('assets/js/waves.js'); ?> "></script>
        <script src="<?= base_url('assets/js/jquery.slimscroll.js'); ?> "></script>
        <script src="<?= base_url('assets/js/jquery.scrollTo.min.js'); ?> "></script>
        <script src="<?= base_url('assets/pages/jquery.dashboard.js'); ?> "></script>
        <script src="<?= base_url('assets/js/jquery.core.js'); ?> "></script>
        <script src="<?= base_url('assets/js/jquery.app.js'); ?> "></script>

    </body>

</html>