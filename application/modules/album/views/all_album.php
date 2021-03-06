<div id="content">
    <div id="content-header">
        <div id="breadcrumb"><a href="<?php echo site_url('album'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> <?php echo lang('home'); ?></a> <a href="#" class="current"><?php echo lang('album'); ?></a> </div>
        <h1><?php echo lang('all_album'); ?><a class="addnew" href="<?php echo base_url(); ?>album/addEditAlbum"><button class="btn btn-inverse"><?php echo lang('add_album'); ?></button></a></h1>
    </div>
    <div class="container-fluid">
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
        <hr>
        
        <form action="<?php echo base_url(); ?>album/upload_album_data/" method="post" class="form-horizontal" name="upload_excel" enctype="multipart/form-data">  
            <!-- /.col -->
            <div class="col-md-12">
<!--                <div class="col-md-3 control-group">
                    <label  class="control-label"><?php //echo lang('interpreter'); ?></label>
                    <div class="controls">
                        <select autocomplete="off" class="chzn-select form-control" multiple="true" id="interpreter_id" name="interpreter_id[]" required="">
                             <option value="">-- Select Interpreter --</option>
                             <?php foreach ($interpreters as $interpreter) { ?>
                                <option <?php //echo set_select('interpreter_id', $interpreter['interpreter_id']); ?>  value="<?php //echo $interpreter['interpreter_id']; ?>" ><?php //echo $interpreter['interpreter_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 control-group">
                    <label  class="control-label"><?php //echo lang('category'); ?></label>
                    <div class="controls">
                        <select class="chzn-select form-control" multiple="true" name="category_id[]" required="">
                             <option value="">-- Select Category --</option>
                             <?php foreach ($categories as $category) { ?>
                                <option <?php// echo set_select('category_id', $category['category_id']); ?>  value="<?php// echo $category['category_id']; ?>" ><?php// echo $category['category_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>-->
                
            </div>
            <h5 class="text-left"><?php echo lang("import_excel"); ?></h5>
            <div class="col-md-12">
                <div class="controls">
                    <input type="file" name="file" id="file" class="form-control" value="" style="padding: 3px;" required>
                    <input type="submit" name="import" class="btn btn-info" value="Upload"><br>
                    <small>(<a href="<?php echo base_url(); ?>uploads/album_upload_data.xlsx" download><?php echo lang('download_format'); ?></a>)</small>
                </div>
            </div>   
        </form> 
        <div class="row-fluid">
            <div class="span12">       
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table" id="usertable">
                            <thead>
                                <tr>
                                    <th><?php echo lang('sno'); ?></th>
                                    <th><?php echo lang('title'); ?></th>
                                  <!--   <th>album Image</th> -->
                                    <th><?php echo lang('description'); ?></th>
                                    <th><?php echo lang('action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;
                            foreach ($albums as $row) {?>
                                <tr class="gradeX">
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center"><?php echo $row['album_name']; ?></td>
                                 <!--    <td class="center"> <img height="100" width="100" src="<?php echo base_url(); ?>/uploads/album_img/<?php echo $row['image']; ?>"></td> -->
                                    <td class="center"><?php echo $row['album_description'];?></td>
                                    <td><a href="<?php echo base_url(); ?>album/addEditalbum/<?php echo $row['album_id'];?>"><button class='btn btn-primary btn-mini'><?php echo lang('edit'); ?></button></a>
                                    <!-- <button class='btn btn-danger btn-mini delete_entry' data-col="user_id" data-attr="<?php echo $row['album_id']?>" data-atr="users" data-tablename="gm_album">Delete</button> -->
                                    </td>
                                </tr>
                            <?php $i++;
                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>