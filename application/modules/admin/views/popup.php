<!-- main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo site_url('admin'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i><?php echo lang('home'); ?></a> </div>
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
                        <h5><?php echo lang("change_popup"); ?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="<?php echo base_url('admin/update_popup'); ?>" method="post"  class="form-horizontal" >
                            <div class="control-group">
                                <label class="control-label"><?php echo lang("choose_select"); ?></label>
                                <div class="controls">
                                    <select class="chzn-select form-control" name="track_id" id="track_id" required="require">
                                        <?php foreach ($music as $ms) { ?>
                                            <option <?php
                                            echo set_select('track_id', $ms['album_id']);
                                            if ($ms['album_id'] == $popup_id->track_id) {
                                                echo "selected";
                                            }
                                            ?>    
                                                value="<?php echo $ms['album_id']; ?>" ><?php echo $ms['album_name']; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!--                            <div class="form-actions text-center">
                                                             <button type="submit" class="btn btn-success pull-right">Import</button>
                                                            <input type="submit" class="btn btn-success" name="submit" value="Update">                       
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