<!-- main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo site_url('admin'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i><?php echo lang('home'); ?></a> <a href="#" class="current"><?php echo lang("edit_profile"); ?></a> </div>
    </div>
    <!--End-breadcrumbs-->
    <!--Action boxes-->
    <div class="container-fluid">  
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

        <div class="row-fluid">
            <div class="span2"></div>
            <div class="span8">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5><?php echo lang("select_table_to_import_in"); ?></h5>
                        <h7 style="float: right;padding-top: 8px;padding-right: 24px;"><small>(<a href="<?php echo base_url(); ?>uploads/demo_data.csv" download><?php echo lang("download_format"); ?></a>)</small></h7>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="<?php echo site_url('admin/import_data'); ?>" method="post" class="form-horizontal" name="upload_excel" enctype="multipart/form-data">
                            <div class="control-group">
                                <label  class="control-label"><?php echo lang("choose_select"); ?></label>
                                <div class="controls">
                                    <select autocomplete="off" class="form-control" id="table_name" name="table_name" required="required">
<!--                                        <option value="-1">-- <?php //echo lang("select_table");   ?>--</option>-->
<!--                                        <option value="album"><?php //echo lang("album");   ?></option>-->
                                        <option value="category"><?php echo lang("category"); ?></option>
                                        <option value="interpreter"><?php echo lang("interpret"); ?></option>
                                        <option value="tracktype"><?php echo lang("tracktype"); ?></option>
                                    </select>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="file"><?php echo lang("excel_file"); ?></label>
                                    <input type="file" id="file" name="file" required />
                                    <p class="help-block text-center"><?php echo lang("please_upload"); ?></p>
                                </div>
                            </div>
                            <!--                            <div class="form-actions text-center">
                                                             <button type="submit" class="btn btn-success pull-right">Import</button>
                                                            <input type="submit" class="btn btn-success" name="Upload">                       
                                                        </div>-->
                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-info"><?php echo lang('update'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end-main-container-part