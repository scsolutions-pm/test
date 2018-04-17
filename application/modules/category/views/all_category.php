<div id="content">
    <div id="content-header">
       <div id="breadcrumb"><a href="<?php echo site_url('category'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> <?php echo lang('home'); ?></a> <a href="#" class="current"><?php echo lang('category'); ?></a> </div>
        <h1><?php echo lang('all_category'); ?><a class="addnew" href="<?php echo base_url(); ?>category/addEditcategory"><button class="btn btn-inverse"><?php echo lang('add_category'); ?></button></a></h1>
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
        <div class="row-fluid">
            <div class="span12">       
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5><?php echo lang('all_category'); ?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table" id="usertable">
                            <thead>
                                <tr>
                                    <th><?php echo lang('sno'); ?></th>
                                    <th><?php echo lang('title'); ?></th>
                                    <!-- <th>category Image</th> -->
                                    <th><?php echo lang('description'); ?></th>
                                    <th><?php echo lang('action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;
                            foreach ($categories as $row) {?>
                                <tr class="gradeX">
                                    <td class="center"><?php echo $i; ?></td>
                                    <td class="center"><?php echo $row['category_name']; ?></td>
                                    <!-- <td class="center"> <img height="100" width="100" src="<?php echo base_url(); ?>/uploads/category_img/<?php echo $row['image']; ?>"></td> -->
                                    <td class="center"><?php echo $row['category_description'];?></td>
                                    <td><a href="<?php echo base_url(); ?>category/addEditcategory/<?php echo $row['category_id'];?>"><button class='btn btn-primary btn-mini'><?php echo lang('edit'); ?></button></a>
                                    <!-- <button class='btn btn-danger btn-mini delete_entry' data-col="user_id" data-attr="<?php echo $row['category_id']?>" data-atr="gm_user" data-tablename="gm_category">Delete</button> -->
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