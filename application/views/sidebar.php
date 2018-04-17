<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> </a>
    <ul>
        <li>
            <a href="<?php echo base_url(); ?>admin">
                <i class="icon icon-inbox"></i> 
                <span><?php echo lang('dashboard');  ?></span>
            </a>
        </li> 
        <li> 
            <a href="<?php echo site_url('music'); ?>">
                <i class="icon icon-inbox"></i> <span class="uppercase"><?php echo lang('music');  ?></span>
            </a> 
        </li> 
        <li> 
            <a href="<?php echo site_url('category'); ?>">
                <i class="icon icon-inbox"></i> <span class="uppercase"><?php echo lang('category');  ?></span>
            </a> 
        </li> 
        <li> 
            <a href="<?php echo site_url('album'); ?>">
                <i class="icon icon-inbox"></i> <span class="uppercase"><?php echo lang('album');  ?></span>
            </a> 
        </li> 
        <li> 
            <a href="<?php echo site_url('tracktype'); ?>">
                <i class="icon icon-inbox"></i> <span class="uppercase"><?php echo lang('tracktype');  ?></span>
            </a> 
        </li> 
        <li> 
            <a href="<?php echo site_url('interpreter'); ?>">
                <i class="icon icon-inbox"></i> <span class="uppercase"><?php echo lang('interpreter');  ?></span>
            </a> 
        </li> 
        <li> 
            <a href="<?php echo site_url('page'); ?>">
                <i class="icon icon-inbox"></i> <span class="uppercase"><?php echo lang('page');  ?></span>
            </a> 
        </li> 
    </ul>
</div>
<!--sidebar-menu-->
<!-- Below is common modal code change in it reflect at multiple places...(so be careful) -->
<div class="modal fade" id="commmonModal" tabindex="-1" role="dialog" aria-labelledby="myEditModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center" id="commmonModalHeading"></h4>
            </div>
            <div class="modal-body" id="commmonModalBody">
                <!-- Dynamic content goes here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>