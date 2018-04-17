<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo site_url('category'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> <?php echo lang('home'); ?></a> <a href="#" class="current"><?php echo lang('add_album'); ?></a> </div>
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
                        <h5><?php echo lang('add_album'); ?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="post" id="albumForm" name="albumForm" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('album_name'); ?> <span style="color:red">*</span> :</label>
                                <div class="controls">
                                    <input type="text" name="album_name" class="span11" placeholder="Enter Title" value="<?php echo set_value('album_name'); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('album_description'); ?> <span style="color:red">*</span> :</label>
                                <div class="controls">
                                    <textarea class="span11" name="album_description"><?php echo set_value('album_description'); ?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('album_interpret'); ?> <span style="color:red">*</span> :</label>
                                <div class="controls">
                                    <select autocomplete="off" name="album_interpret[]" id="album_interpret" class="chzn-select form-control" multiple="true" required="true">
                                        <?php foreach ($interpreters as $interpreter) { ?>
                                            <option <?php echo set_select('album_interpret', $interpreter['interpreter_id']); ?>  value="<?php echo $interpreter['interpreter_id']; ?>" ><?php echo $interpreter['interpreter_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label  class="control-label"><?php echo lang('album_category'); ?> <span style="color:red">*</span> :</label>
                                <div class="controls">
                                    <select name="album_kategorien[]" id="album_kategorien" class="chzn-select form-control" multiple="true" required="true">
                                        <?php foreach ($categories as $category) { ?>
                                            <option <?php echo set_select('album_kategorien', $category['category_id']); ?>  value="<?php echo $category['category_id']; ?>" ><?php echo $category['category_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('album_EAN'); ?> :</label>
                                <div class="controls">
                                    <input type="text" name="album_EAN" value="<?php echo set_value('album_EAN'); ?>" class="span11" placeholder="Enter EAN number">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('amazon_music_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" name="amazon_music_album" value="<?php echo set_value('amazon_music_album'); ?>" class="span11" placeholder="Enter amazon music album">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('apple_itunes_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" name="apple_itunes_album" value="<?php echo set_value('apple_itunes_album'); ?>" class="span11" placeholder="Enter apple itunes album">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('apple_music_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" name="apple_music_album" value="<?php echo set_value('apple_music_album'); ?>" class="span11" placeholder="Enter apple music album">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('deezer_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" name="deezer_album" value="<?php echo set_value('deezer_album'); ?>" class="span11" placeholder="Enter deezer album">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('google_play_music_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" name="google_play_music_album" value="<?php echo set_value('google_play_music_album'); ?>" class="span11" placeholder="Enter google play music album">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('juke_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" name="juke_album" value="<?php echo set_value('juke_album'); ?>" class="span11" placeholder="Enter juke album">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('microsoft_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter microsoft album" name="microsoft_album" value="<?php echo set_value('microsoft_album'); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('musicload_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter musicload_album" name="musicload_album" value="<?php echo set_value('musicload_album'); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('napster_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter napster album" name="napster_album" value="<?php echo set_value('napster_album'); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('qobuz_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter qobuz album" name="qobuz_album" value="<?php echo set_value('qobuz_album'); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('spotify_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter spotify album" name="spotify_album" value="<?php echo set_value('spotify_album'); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('tidal_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter tidal album" name="tidal_album" value="<?php echo set_value('tidal_album'); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('label'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter Label" name="label" value="<?php echo set_value('label'); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('label_code'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter label code" name="label_code" value="<?php echo set_value('label_code'); ?>">
                                </div>
                            </div>

                            <!--  <div class="control-group">
                                 <label class="control-label">album Image :</label>
                                 <div class="controls">
                                     <img height="100" width="100" src="<?php echo base_url('assets/img/no_image.png'); ?>" id="show_image"><br><br>   
                                     <div class="uploader" id="uniform-category_image">
                                         <input type="file" name="albumfile" id="albumfile" class="span11" required="" size="19" style="opacity: 0;">
                                         <span class="filename">No file selected</span>
                                         <span class="action">Choose File</span>
                                     </div>
                                     <input type="hidden" id="image" name="image">
                                 </div>
                             </div>
                            -->
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('album_image'); ?> :</label>
                                <div class="controls">
                                    <img height="100" width="100" src="<?php echo base_url('assets/img/no_image.png'); ?>" id="show_image"><br><br>   
                                    <div class="uploader" id="uniform-category_image">
                                        <input type="file" name="userfile" id="userfile" class="span11" required="" size="19" style="opacity: 0;">
                                        <span class="filename"><?php echo lang('no_file_selected'); ?></span>
                                        <span class="action"><?php echo lang('choose_file'); ?></span>
                                    </div>
                                    <input type="hidden" id="album_image" name="album_image">
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