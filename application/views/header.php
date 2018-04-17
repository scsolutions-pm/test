<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
        <!-- <link rel="shortcut icon" href="http://localhost/talent/assets/img/lg.jpg"> -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/uniform.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-style.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-media.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap-wysihtml5.css">
        <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/sweetalert.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/static/time-picker/dist/bootstrap-clockpicker.min.css">
    </head>
    <body>
        <!--Header-part-->
        <div id="header">
		<img src="<?php echo base_url();?>assets/img/img/goodmusic-logo.png" width="230">
           <!--  <h1><?php echo lang('good_music'); ?></h1> -->
        </div>
        <!--close-Header-part--> 
        <!--top-Header-menu-->
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav">
                <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text"><?php echo lang('welcome_admin'); ?></span><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url(); ?>admin/adminprofile"><i class="icon-user"></i> <?php echo lang('my_profile'); ?></a>
                        </li>
                    </ul>
                </li>

                <li class=""><a title="" href="<?php echo base_url(); ?>admin/changePwd"><i class="icon icon-cog"></i> <span class="text"><?php echo lang('account_settings'); ?></span></a>
                </li>

                <li class=""><a title="" href="<?php echo base_url(); ?>login/logout"><i class="icon icon-share-alt"></i> <span class="text"><?php echo lang('logout'); ?></span></a>
                </li>
            </ul>

            <ul class="nav pull-right top-menu">
                <!-- user login dropdown start-->
                <li>
                    <a href="<?php echo base_url(); ?>admin/langSetting/de"><img class="languageClass <?php
                        if ($this->session->userdata('d_language') == "de,german") {
                            echo "lactive";
                        }
                        ?>" src="<?php echo base_url(); ?>assets/img/language/germen.jpg" height="20" width="20">
                    </a> 
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>admin/langSetting/en"> 
                        <img class="languageClass <?php
                        if ($this->session->userdata('d_language') == "en,english") {
                            echo "lactive";
                        }
                        ?>" src="<?php echo base_url(); ?>assets/img/language/usa.jpg" height="20" width="20">
                    </a>
                </li>
            </ul>
        </div>
        <!--close-top-Header-menu-->
        <!--start-top-serch-->
       <!--  <div id="search">
            <input type="text" placeholder="Search here..."/>
            <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
        </div> -->
        <!--close-top-serch-->