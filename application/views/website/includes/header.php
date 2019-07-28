<!DOCTYPE html>
<html>

<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- set the HandheldFriendly -->
    <meta name="HandheldFriendly" content="True">
    <!-- set the description -->
    <meta name="description" content="#">
    <!-- set the Keyword -->
    <meta name="keywords" content="">
    <meta name="author" content="#">
    <!-- set the page title -->
    <title>Skillsswear - Where Career Begins</title>
    
    <link rel="shortcut icon" href="images/favicon.png">
    
    <!-- include google roboto font cdn link -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <!-- include the site bootstrap stylesheet -->
    <?= link_tag('website_assets/css/bootstrap.css') ?>
    <!-- include the site stylesheet -->
    <?= link_tag('website_assets/css/plugins.css') ?>
    <!-- include the site stylesheet -->
    <?= link_tag('website_assets/css/colors.css') ?>
    <!-- include the site stylesheet -->
    <?= link_tag('website_assets/style.css') ?>
    <!-- include the site responsive stylesheet -->
    <?= link_tag('website_assets/css/responsive.css') ?>
    <?= link_tag('website_assets/css/date-picker.css') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <!-- main container of all the page elements -->
    <div id="wrapper">
        <!-- <span style="background-image: url(images/01-Home-1.jpg);position: absolute; left: 0; top: -228px; bottom: 0; right: 0; z-index: 2; opacity: 0.4; pointer-events: none;"></span> -->
        <!-- header of the page -->

        <header id="page-header" class="page-header-stick">
            <!-- top bar -->
            <div class="top-bar bg-dark text-gray">
                <div class="container">
                    <div class="row top-bar-holder">
                        <div class="col-xs-9 col">
                            <!-- bar links -->
                            <ul class="font-lato list-unstyled bar-links">
                                <li>
                                    <a href="tel:+611234567890">
                                        <strong class="dt element-block text-capitalize hd-phone">Call :</strong>
                                        <strong class="dd element-block hd-phone">+(61) 123 456 7890</strong>
                                        <i class="fas fa-phone-square hd-up-phone hidden-sm hidden-md hidden-lg"><span class="sr-only">phone</span></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:&#069;&#120;&#097;&#109;&#112;&#108;&#101;&#064;&#100;&#111;&#109;&#097;&#105;&#110;&#046;&#099;&#111;&#109;">
                                        <strong class="dt element-block text-capitalize hd-phone">Email :</strong>
                                        <strong class="dd element-block hd-phone">&#069;&#120;&#097;&#109;&#112;&#108;&#101;&#064;&#100;&#111;&#109;&#097;&#105;&#110;&#046;&#099;&#111;&#109;</strong>
                                        <i class="fas fa-envelope-square hd-up-phone hidden-sm hidden-md hidden-lg"><span class="sr-only">email</span></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-3 col justify-end">
                            <!-- user links -->
                            <ul class="list-unstyled user-links fw-bold font-lato">
                                <li><a href="#popup1" class="lightbox">Login</a> <span class="sep">|</span> <a href="#popup2" class="lightbox">Register</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header holder -->
            <div class="header-holder">

                <div class="container">
                    <div class="row">
                        <div class="col-xs-4 col-sm-3">
                            <!-- logo -->
                            <div class="logo">
                                <a href="<?=(base_url())?>">
                                    <img class="hidden-xs" src="<?php echo base_url('website_assets/images/logo.png'); ?>" alt="studylms">
                                    <img class="hidden-sm hidden-md hidden-lg" src="<?php echo base_url('website_assets/images/logo-dark.png'); ?>" alt="studylms">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-9 static-block">

            <?php
                $sub_category_list = $this->Website_functions_model->get_sub_category_list();
                $newOptionKey = [];
                $newKey = 0;
                $arr_categories = [];
                $i=0;
                foreach ($sub_category_list as $obj_success_story => $optionValue) {
                    if(!in_array($optionValue->main_category_id,$newOptionKey)){
                        ++$newKey;
                        $i=0;
                        $arr_categories[$newKey]["main_category_id"] = $optionValue->main_category_id;
                        $arr_categories[$newKey]["main_category_name"] = $optionValue->main_category_name;
                        $newOptionKey[]  = $optionValue->main_category_id;
                    }
                    $arr_categories[$newKey]['courses'][$i]["sub_category_id"] = $optionValue->sub_category_id;
                    $arr_categories[$newKey]['courses'][$i]["sub_category_name"] = $optionValue->sub_category_name;
                    $arr_categories[$newKey]['courses'][$i]["slug"] = $optionValue->slug;
                    $i++;
                }
            ?>

                            <div class="navbar2">
                              <div class="dropdown2">
                                <button class="dropbtn2">COURSES
                                  <i class="fa fa-caret-down"></i>
                              </button>

                              <div class="dropdown-content">
                                 <div class="panel-group course" id="accordion" role="tablist" aria-multiselectable="true">
                                    <!-- panel -->
                                    <?php $i=0; foreach ($arr_categories as $categories) { ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading<?=($i)?>">
                                            <h4 class="panel-title fw-normal">
                                                <a class="accOpener element-block" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=($i)?>" aria-expanded="false" aria-controls="collapseOne"><?=($categories['main_category_name'])?></a>
                                            </h4>
                                        </div>
                                        <div id="collapse<?=($i)?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=($i)?>">
                                            <div class="panel-body">
                                                <p>
                                                    <ul class="listDefault list-unstyled">
                                                        <?php foreach ($categories['courses'] as $course) { ?>
                                                        <li> <a href="<?=(base_url())?>course/<?=($course['slug'])?>"> <?=($course['sub_category_name'])?></a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++; } ?>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <!-- nav -->
                    <nav id="nav" class="navbar navbar-default">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!-- navbar collapse -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <!-- main navigation -->
                            <ul class="nav navbar-nav navbar-right main-navigation text-uppercase font-lato">
                                <li><a href="<?=(base_url())?>">Home</a></li>
                                <li><a href="<?=(base_url())?>aboutus">About Us</a></li>
                                <li><a href="<?=(base_url())?>corporate-training">Corporate Training</a></li>
                                <li><a href="<?=(base_url())?>refer-and-earn">Refer and Earn</a></li>
                                <li><a href="<?=(base_url())?>contact-us">Contact Us</a></li>
                            </ul>
                        </div>
                        <!-- navbar form -->
                        <form action="#" class="navbar-form navbar-search-form navbar-right">
                            <a class="fas fa-search search-opener" role="button" data-toggle="collapse" href="#searchCollapse" aria-expanded="false" aria-controls="searchCollapse"><span class="sr-only">search opener</span></a>
                            <!-- search collapse -->
                            <div class="collapse search-collapse" id="searchCollapse">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Search &hellip;">
                                    <button type="button" class="fas fa-search btn"><span class="sr-only">search</span></button>
                                </div>
                            </div>
                        </form>
                    </nav>

                </div>
            </div>
        </div>
    </div>
</header>

<div class="popup-holder">
    <div id="popup1" class="lightbox-demo">
        <form action="#" class="user-log-form">
            <h2>Login Form</h2>
            <div class="form-group">
                <input type="text" class="form-control element-block" placeholder="Username or email address *">
            </div>
            <div class="form-group">
                <input type="password" class="form-control element-block" placeholder="Password *">
            </div>
            <div class="btns-wrap">
                <div class="wrap">
                    <label for="rem" class="custom-check-wrap fw-normal font-lato">
                        <input type="checkbox" id="rem" class="customFormReset">
                        <span class="fake-label element-block">Remember me</span>
                    </label>
                    <button type="submit" class="btn btn-theme btn-warning fw-bold font-lato text-uppercase">Login</button>
                </div>
                <div class="wrap text-right">
                    <p>
                        <a href="#" class="forget-link">Lost your Password?</a>
                    </p>
                </div>
            </div>
        </form>
    </div>
    <div id="popup2" class="lightbox-demo">
        <form action="#" class="user-log-form">
            <h2>Register Form</h2>
            <div class="form-group">
                <input type="email" class="form-control element-block" placeholder="Email address *">
            </div>
            <div class="form-group">
                <input type="password" class="form-control element-block" placeholder="Password *">
            </div>
            <div class="btns-wrap">
                <div class="wrap">
                    <button type="submit" class="btn btn-theme btn-warning fw-bold font-lato text-uppercase">Register</button>
                </div>
            </div>
        </form>
    </div>
</div>