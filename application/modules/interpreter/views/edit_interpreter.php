
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo site_url('interpreter'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Interpreter</a> </div>
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
                        <h4 class="alert-heading">Success!</h4>
                        <?php echo $Success; ?> 
                    </div>
                <?php } ?>  
                <?php if (!empty($Error)) { ?>
                    <div class="alert alert-error alert-block">
                        <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading">Error!</h4>
                        <?php echo $Error; ?> 
                    </div>
                <?php } ?>
                <?php if (validation_errors() != false) { ?>
                    <div class="alert alert-error alert-block">
                        <a class="close" data-dismiss="alert" href="#">×</a>
                        <h4 class="alert-heading" style="margin-bottom: 5px;">Errors!</h4>
                        <?php echo validation_errors(); ?>
                    </div>
                <?php } ?>
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Edit interpreter</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="post" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Interpreter :</label>

                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter Title" name="interpreter_name" value="<?php echo set_value('interpreter_name', $interpreter->interpreter_name); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    <textarea class="span11" name="interpreter_description"><?php echo set_value('interpreter_description', $interpreter->interpreter_description); ?></textarea>
                                </div>
                            </div>
                            <!--    <div class="control-group">
                                   <label class="control-label">interpreter Image :</label>
                                   <div class="controls">
                                       <img height="100" width="100" src="<?php echo base_url(); ?>/uploads/interpreter_img/<?php echo $interpreter->image; ?>" id="show_image"><br><br>   
                                       <div class="uploader" id="uniform-category_image">
                                           <input type="file" name="interpreterfile" id="interpreterfile" class="span11" size="19" style="opacity: 0;">
                                       </div>
                                       <input type="hidden" id="image" name="image" value="<?php echo $interpreter->image; ?>">
                                   </div>
                               </div> -->
                            <div class="control-group">
                                <label class="control-label">Status :</label>
                                <div class="controls">
                                    <select name="interpreter_status">
                                        <option value="1"<?php
                                        echo set_select('interpreter_status', 1);
                                        if ($interpreter->interpreter_status == 1) {
                                            echo "selected";
                                        }
                                        ?>>Active</option>
                                        <option value="0"<?php
                                        echo set_select('interpreter_status', 0);
                                        if ($interpreter->interpreter_status == 0) {
                                            echo "selected";
                                        }
                                        ?>>Deactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success pull-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end-main-container-part