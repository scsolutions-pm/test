
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo site_url('category'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> <?php echo lang('home'); ?></a> <a href="#" class="current"><?php echo lang('edit_track_type'); ?></a> </div>
    </div>
    <!--End-breadcrumbs-->
    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2"></div>
            <div class="span8">
             <?php if(!empty($Success)) {?>
             <div class="alert alert-info alert-block">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading"><?php echo lang('success'); ?>!</h4>
                <?php echo $Success; ?> 
            </div>
            <?php } ?>  
            <?php if(!empty($Error)) {?>
            <div class="alert alert-error alert-block">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading"><?php echo lang('error'); ?>!</h4>
                <?php echo $Error; ?> 
            </div>
            <?php } ?>
            <?php if(validation_errors() != false) { ?>
            <div class="alert alert-error alert-block">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading" style="margin-bottom: 5px;"><?php echo lang('errors'); ?>!</h4>
                <?php echo validation_errors(); ?>
            </div>
            <?php } ?>
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5><?php echo lang('edit_track_type'); ?></h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="" method="post" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label"><?php echo lang('track_type_name'); ?> :</label>

                            <div class="controls">
                                <input type="text" class="span11" placeholder="Enter Title" name="tracktype_name" value="<?php echo set_value('title', $tracktype->tracktype_name); ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo lang('track_type_description'); ?></label>
                            <div class="controls">
                                <textarea class="span11" name="tracktype_description"><?php echo set_value('tracktype_description', $tracktype->tracktype_description ); ?></textarea>
                            </div>
                        </div>
                   <!--      <div class="control-group">
                            <label class="control-label">tracktype Image :</label>
                            <div class="controls">
                                <img height="100" width="100" src="<?php echo base_url(); ?>/uploads/tracktype_img/<?php echo $tracktype->image; ?>" id="show_image"><br><br>   
                                <div class="uploader" id="uniform-category_image">
                                    <input type="file" name="tracktypefile" id="tracktypefile" class="span11" size="19" style="opacity: 0;">
                                </div>
                                <input type="hidden" id="image" name="image" value="<?php echo $tracktype->image; ?>">
                            </div>
                        </div> -->
                        <div class="control-group">
                          <label class="control-label"><?php echo lang('status'); ?> :</label>
                          <div class="controls">
                            <select name="tracktype_status">
                              <option value="1"<?php echo set_select('tracktype_status',1); 
                              if($tracktype->tracktype_status == 1){ echo "selected";}?>><?php echo lang('active'); ?></option>
                              <option value="0"<?php echo set_select('tracktype_status',0); if($tracktype->tracktype_status == 0){ echo "selected";}?>><?php echo lang('deactive'); ?></option>
                          </select>
                      </div>
                  </div>
                  <div class="form-actions">
                    <button type="submit" class="btn btn-success pull-right"><?php echo lang('save'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!--end-main-container-part