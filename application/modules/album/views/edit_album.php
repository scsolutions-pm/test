<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo site_url('album'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> <?php echo lang('home'); ?></a> <a href="#" class="current"><?php echo lang('edit_album'); ?></a> </div>
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
                        <h5><?php echo lang('edit_album'); ?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="post" id="albumForm" name="albumForm" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label"> <?php echo lang('album_name'); ?> <span style="color:red">*</span> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter Album Name " name="album_name" value="<?php echo set_value('album_name', $album->album_name); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('album_description'); ?> <span style="color:red">*</span> :</label>
                                <div class="controls">
                                    <textarea class="span11" name="album_description"><?php echo set_value('album_description', $album->album_description); ?></textarea>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('album_interpret'); ?> <span style="color:red">*</span> : </label>
                                <?php
                                $music_interpreters = $album->album_interpret;
                                $intprt = explode(",", $music_interpreters);
                                ?>
                                <div class="controls">
                                    <select name="album_interpret[]" class="chzn-select form-control" multiple="true" required="require">
                                        <?php foreach ($interpreters as $interpreter) { ?>
                                            <option <?php echo set_select('album_interpret', $interpreter['interpreter_id']); ?> <?php
                                            if (in_array($interpreter['interpreter_id'], $intprt)) {
                                                echo "selected";
                                            }
                                            ?>  value="<?php echo $interpreter['interpreter_id']; ?>" ><?php echo $interpreter['interpreter_name']; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('album_category'); ?> <span style="color:red">*</span> :</label>
                                <?php
                                $music_categories = $album->album_kategorien;
                                $ctgry = explode(",", $music_categories);
                                ?>
                                <div class="controls">
                                    <select name="album_kategorien[]" class="chzn-select form-control" multiple="true" required="require">
                                        <?php foreach ($categories as $category) { ?>
                                            <option <?php echo set_select('album_kategorien', $category['category_id']); ?> <?php
                                            if (in_array($category['category_id'], $ctgry)) {
                                                echo "selected";
                                            }
                                            ?>  value="<?php echo $category['category_id']; ?>" ><?php echo $category['category_name']; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('album_EAN'); ?> :</label>
                                <div class="controls">
                                    <input type="text" name="album_EAN" class="span11" placeholder="Enter Album EAN" value="<?php echo set_value('album_EAN', $album->album_EAN); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('amazon_music_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" name="amazon_music_album" class="span11" placeholder="Enter Title" value="<?php echo set_value('amazon_music_album', $album->amazon_music_album); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('apple_itunes_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" name="apple_itunes_album" class="span11" placeholder="Enter Title" value="<?php echo set_value('apple_itunes_album', $album->apple_itunes_album); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('apple_music_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" name="apple_music_album" class="span11" placeholder="Enter Title" value="<?php echo set_value('apple_music_album', $album->apple_music_album); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('deezer_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" name="deezer_album" class="span11" placeholder="Enter Title" value="<?php echo set_value('deezer_album', $album->deezer_album); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('google_play_music_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" name="google_play_music_album" class="span11" placeholder="Enter Title" value="<?php echo set_value('google_play_music_album', $album->google_play_music_album); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('juke_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" name="juke_album" class="span11" placeholder="Enter Title" value="<?php echo set_value('juke_album', $album->juke_album); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('microsoft_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter microsoft_album" name="microsoft_album" value="<?php echo set_value('microsoft_album', $album->microsoft_album); ?>">
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label"><?php echo lang('musicload_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter musicload_album" name="musicload_album" value="<?php echo set_value('musicload_album', $album->musicload_album); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('napster_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter Title" name="napster_album" value="<?php echo set_value('napster_album', $album->napster_album); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('qobuz_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter qobuz_album" name="qobuz_album" value="<?php echo set_value('qobuz_album', $album->qobuz_album); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('spotify_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter spotify_album" name="spotify_album" value="<?php echo set_value('spotify_album', $album->spotify_album); ?>">
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('tidal_album'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter tidal_album" name="tidal_album" value="<?php echo set_value('tidal_album', $album->tidal_album); ?>">
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label"><?php echo lang('label'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter Label" name="Label" value="<?php echo set_value('label', $album->label); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('label_code'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter label_code" name="label_code" value="<?php echo set_value('label_code', $album->label_code); ?>">
                                </div>
                            </div>

                            <!--      <div class="control-group">
                                     <label class="control-label">album Image :</label>
                                     <div class="controls">
                                         <img height="100" width="100" src="<?php echo base_url(); ?>/uploads/album_img/<?php echo $album->image; ?>" id="show_image"><br><br>   
                                         <div class="uploader" id="uniform-category_image">
                                             <input type="file" name="albumfile" id="albumfile" class="span11" size="19" style="opacity: 0;">
                                         </div>
                                         <input type="hidden" id="image" name="image" value="<?php echo $album->image; ?>">
                                     </div>
                                 </div> -->

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('album_image'); ?> :</label>
                                <div class="controls">
                                    <img height="100" width="100" src="<?php echo base_url(); ?>/uploads/category_img/<?php echo $album->album_image; ?>" id="show_image"><br><br>   
                                    <div class="uploader" id="uniform-album_image">
                                        <input type="file" name="userfile" id="userfile" class="span11" size="19" style="opacity: 0;">
                                    </div>
                                    <input type="hidden" id="album_image" name="album_image" value="<?php echo $album->album_image; ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('status'); ?> :</label>
                                <div class="controls">
                                    <select name="album_status">
                                        <option value="1"<?php
                                        echo set_select('album_status', 1);
                                        if ($album->album_status == 1) {
                                            echo "selected";
                                        }
                                        ?>><?php echo lang('active'); ?></option>
                                        <option value="0"<?php
                                        echo set_select('album_status', 0);
                                        if ($album->album_status == 0) {
                                            echo "selected";
                                        }
                                        ?>><?php echo lang('deactive'); ?></option>
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