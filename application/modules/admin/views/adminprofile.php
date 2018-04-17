<!-- main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo site_url('admin'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i><?php echo lang('home'); ?></a> <a href="#" class="current"><?php echo lang('edit_profile'); ?></a> </div>
    </div>
    <!--End-breadcrumbs-->
    <!--Action boxes-->
    <div class="container-fluid">        
        <div class="row-fluid">
            <div class="span2"></div>
            <div class="span8">
                <?php if(!empty($Success)) { ?>
                <div class="alert alert-success alert-block">
                    <a class="close" data-dismiss="alert" href="#">×</a>
                    <h4 class="alert-heading"><?php echo lang('success'); ?>!</h4>
                    <?php echo $Success; ?> 
                </div>
                <?php } ?>  
                <?php if(!empty($Error)) { ?>
                <div class="alert alert-error alert-block">
                    <a class="close" data-dismiss="alert" href="#">×</a>
                    <h4 class="alert-heading"><?php echo lang('error'); ?>!</h4>
                    <?php echo $Error; ?> 
                </div>
                <?php } ?>
                <?php if(validation_errors() != false) { ?>
                <div class="alert alert-error alert-block">
                    <a class="close" data-dismiss="alert" href="#">×</a>
                    <h4 class="alert-heading" style="margin-bottom:5px;"><?php echo lang('errors'); ?>!</h4>
                    <?php echo validation_errors(); ?>
                </div>
                <?php } ?>
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5><?php echo lang('edit_profile');?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="<?php echo site_url('admin/editAdminProfile'); ?>" method="post" class="form-horizontal">
                        <!-- <div class="control-group">
                                <label class="control-label">Profile Image :</label>
                                <div class="controls">
                                    <img height="100" width="100" src="<?php echo base_url('uploads/profile_pic/thumb/'.$user->profile_pic); ?>" id="show_image"><br><br>   
                                    <div class="uploader" id="uniform-userfile">
                                        <input type="file" name="userfile1" id="userfile1" class="span11" size="19" style="opacity: 0;">
                                        <span class="filename">No file selected</span>
                                        <span class="action">Choose File</span>
                                    </div>
                                    <input type="hidden" id="profile_pic" name="profile_pic" value="<?php echo $user->profile_pic; ?>">
                                </div>
                            </div> -->
                            <div class="control-group">
                                <label class="control-label"><?php echo  lang('first_name');?>:</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="First Name" name="firstname" value="<?php echo set_value('firstname', $user->firstname); ?>" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('last_name');?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Last Name" name="lastname" value="<?php echo set_value('lastname', $user->lastname); ?>" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('email');?> :</label>
                                <div class="controls">
                                    <input type="email" class="span11" placeholder="Email" name="email" value="<?php echo set_value('email', $user->email); ?>" required>
                                </div>
                            </div>
                            <div class="form-actions">
                             <button type="submit" class="btn btn-success pull-right"><?php echo lang("update");?></button>
                             <!-- <input type="submit" value="Submit"> -->
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
</div>
<!--end-main-container-part