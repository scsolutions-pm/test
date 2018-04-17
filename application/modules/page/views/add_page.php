
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo site_url('page'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> <?php echo lang('home'); ?></a> <a href="#" class="current"><?php echo lang('add_page'); ?></a> </div>
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
                        <h5>Add Blog</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('page_title'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter Title" name="page_title" value="<?php echo set_value('page_title'); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('page_content'); ?></label>
                                <div class="controls span11">     
                                    <?php
                                    echo $this->ckeditor->editor("page_content", "");
                                    ?>      
                                </div>
                            </div> 
                            <!--                            <div class="control-group">
                                                            <label class="control-label">Page Content</label>
                                                            <div class="controls">
                                                                <textarea class="span11" name="page_content"><?php //echo set_value('page_content');   ?></textarea>
                                                            </div>
                                                        </div>-->
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
<script>

    CKEDITOR.replace('page_content');

</script>

<!--end-main-container-part