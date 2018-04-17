<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title ;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link rel='stylesheet' href='https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    </head>
    <body>
        <div class="container example2">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar2">
                            <span class="sr-only"><?php echo lang('toggle_navigation'); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo base_url(); ?>"><img id="navbar-logo" src="<?php echo base_url(); ?>assets/img/img/goodmusic-logo.png" alt='online music'/>
                        </a>
                    </div>

                    <ul class="nav pull-right lang-menu">
                        <li>
                            <a href="<?php echo base_url(); ?>home/langSetting/en"> 
                                <img class="languageClass <?php
                                if ($this->session->userdata('d_language') == "en,english") {
                                    echo "lactive";
                                }
                                ?>" src="<?php echo base_url(); ?>assets/img/language/usa.jpg">
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>home/langSetting/de"><img class="languageClass <?php
                                if ($this->session->userdata('d_language') == "de,german") {
                                   echo "lactive";
                                }
                                ?>" src="<?php echo base_url(); ?>assets/img/language/germen.jpg">
                            </a> 
                        </li>
                    </ul>

                    <div id="navbar2" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="<?php
                            if ($this->uri->segment(1) == "home") {
                                echo "active";
                            }
                            ?>"><a href="<?php echo base_url() ?>home"><span class="uppercase"><?php echo lang('home'); ?></span></a></li>
                            <li class="<?php
                            if ($this->uri->segment(1) == "tracks") {
                                echo "active";
                            }
                            ?>"><a href="<?php echo base_url() ?>tracks"><span class="uppercase"><?php echo lang('browse_here'); ?></span></a></li>
                        </ul>
                    </div>

<!--                    <select onchange="javascript:window.location.href = '<?php echo base_url(); ?>home/langSetting/' + this.value;">
                        <option value="en" <?php // if ($this->session->userdata('d_language') == 'en,english') echo 'selected="selected"';   ?>><?php echo lang('english'); ?></option>
                        <option value="de" <?php //if ($this->session->userdata('d_language') == 'de,german') echo 'selected="selected"';   ?>><?php echo lang('german'); ?></option>   
                    </select>-->
                    <!--/.nav-collapse -->
                </div>
                <!--/.container-fluid -->
            </nav>
        </div>
