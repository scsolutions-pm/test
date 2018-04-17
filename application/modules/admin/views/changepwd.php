<!-- main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo site_url('admin'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> <?php echo lang('home'); ?></a> <a href="#" class="current"><?php echo lang("change_your_password"); ?></a> </div>
    </div>
    <!--End-breadcrumbs-->
    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2"></div>
            <div class="span8">
                <?php if (!empty($Success)) { ?>
                <div class="alert alert-info alert-block">
                    <a class="close" data-dismiss="alert" href="#">×</a>
                    <h4 class="alert-heading"><?php echo lang('success'); ?>!</h4>
                    <?php echo $Success; ?> 
                </div>
                <?php } ?>  
                <?php if (!empty($Error)) { ?>
                <div class="alert alert-error alert-block">
                    <a class="close" data-dismiss="alert" href="#">×</a>
                    <h4 class="alert-heading"><?php echo lang('error'); ?>!</h4>
                    <?php echo $Error; ?> 
                </div>
                <?php } ?>
                <?php if (validation_errors() != false) { ?>
                <div class="alert alert-error alert-block">
                    <a class="close" data-dismiss="alert" href="#">×</a>
                    <h4 class="alert-heading" style="margin-bottom: 5px;"><?php echo lang('errors'); ?>!</h4>
                    <?php echo validation_errors(); ?>
                </div>
                <?php } ?>
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5><?php lang("change_password"); ?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="<?php echo base_url('admin/editSettingaccount') ?>" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label"><?php echo lang("change_password"); ?> :</label>
                                <div class="controls">
                                    <input type="password" class="span11" placeholder="Old Password" name="opassword"  value="<?php echo set_value('opassword');?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang("new_password"); ?> :</label>
                                <div class="controls">
                                    <input type="password" class="span11" placeholder="New Password" name="npassword" value="<?php echo set_value('npassword'); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang("confirm_password"); ?> :</label>
                                <div class="controls">
                                    <input type="password" class="span11" placeholder="Confirm Password" name="cpassword" value="<?php echo set_value('cpassword'); ?>">
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success pull-right"><?php echo lang("change"); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end-main-container-part