
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo site_url('music'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> <?php echo lang('home'); ?></a> <a href="#" class="current"><?php echo lang('edit_music'); ?></a> </div>
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
                        <h5><?php echo lang('edit_music'); ?></h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="" method="post" id="musicForm" name="musicForm" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('track_name'); ?> <span style="color:red">*</span> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter Title" name="track_name" value="<?php echo set_value('track_name', $music->track_name); ?>"> 
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('album_track_number'); ?> <span style="color:red">*</span> :</label>
                                <div class="controls">
                                    <input type="text" name="album_track_number" value="<?php echo set_value('album_track_number', $music->album_track_number); ?>" class="span11" placeholder="Enter Album Track number" >
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('album'); ?> <span style="color:red">*</span> :</label>
                                <?php
                                $music_albums = $music->album_id;
                                $albm = explode(",", $music_albums);
                                ?>
                                <div class="controls">
                                    <select name="album_id[]" class="chzn-select form-control" multiple="true" required="require">
                                        <?php foreach ($albums as $album) { ?>
                                            <option <?php echo set_select('album_id', $album['album_id']); ?> <?php
                                            if (in_array($album['album_id'], $albm)) {
                                                echo "selected";
                                            }
                                            ?>  value="<?php echo $album['album_id']; ?>" ><?php echo $album['album_name']; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('interpreter'); ?> <span style="color:red">*</span> : </label>
                                <?php
                                $music_interpreters = $music->interpreter_id;
                                $intprt = explode(",", $music_interpreters);
                                ?>
                                <div class="controls">
                                <select name="interpreter_id[]" class="chzn-select form-control" multiple="true" required="require">
                                        <?php foreach ($interpreters as $interpreter) { ?>
                                            <option <?php echo set_select('interpreter_id', $interpreter['interpreter_id']); ?> <?php
                                            if (in_array($interpreter['interpreter_id'], $intprt)) {
                                                echo "selected";
                                            }
                                            ?>  value="<?php echo $interpreter['interpreter_id']; ?>" ><?php echo $interpreter['interpreter_name']; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('category'); ?> <span style="color:red">*</span> : </label>
                                <?php
                                $music_categories = $music->category_id;
                                $ctgry = explode(",", $music_categories);
                                ?>
                                <div class="controls">
                                    <select name="category_id[]" class="chzn-select form-control" multiple="true" required="require">
                                        <?php foreach ($categories as $category) { ?>
                                            <option <?php echo set_select('category_id', $category['category_id']); ?> <?php
                                            if (in_array($category['category_id'], $ctgry)) {
                                                echo "selected";
                                            }
                                            ?>  value="<?php echo $category['category_id']; ?>" ><?php echo $category['category_description']; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('tracktype'); ?> <span style="color:red">*</span> : </label>
                                <?php
                                $music_tracktypes = $music->tracktype_id;
                                $trktype = explode(",", $music_tracktypes);
                                ?>
                                <div class="controls">
                                    <select name="tracktype_id[]" class="chzn-select form-control" multiple="true" required="require">
                                        <?php foreach ($tracktypes as $tracktype) { ?>
                                            <option <?php echo set_select('tracktype_id', $tracktype['tracktype_id']); ?> <?php
                                            if (in_array($tracktype['tracktype_id'], $trktype)) {
                                                echo "selected";
                                            }
                                            ?>  value="<?php echo $tracktype['tracktype_id']; ?>" ><?php echo $tracktype['tracktype_name']; ?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <hr>                           
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('isrc'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter ISRC" name="isrc" value="<?php echo set_value('isrc', $music->isrc); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('authors'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter authors" name="authors" value="<?php echo set_value('authors', $music->authors); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('language'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter language" name="language" value="<?php echo set_value('language', $music->language); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('publishing_company'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter publishing company" name="publishing_company" value="<?php echo set_value('publishing_company', $music->publishing_company); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('arranger'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter arranger" name="arranger" value="<?php echo set_value('arranger', $music->arranger); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('producer'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter producer" name="producer" value="<?php echo set_value('producer', $music->producer); ?>">
                                </div>
                            </div>

                                                        <!--                            <div class="control-group">
                                                            <label class="control-label">Artist Name :</label>
                                                            <div class="controls">
                                                                <input type="text" class="span11" placeholder="Enter Title" name="artist_name" value="<?php //echo set_value('artist_name', $music->artist_name);           ?>">
                                                            </div>
                                                        </div>-->

                            <!--    <div class="control-group">
                                   <label class="control-label">interpreter :</label>
                                   <div class="controls">
                                       <input type="text" class="span11" placeholder="Enter interpreter" name="interpreter" value="<?php //echo set_value('interpreter', $music->interpreter); ?>">
                                   </div>
                               </div> -->

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('year'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter Year" name="year" value="<?php echo set_value('year', $music->year); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('duration'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter duration" name="duration" value="<?php echo set_value('duration', $music->duration); ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('amazon_music'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter amazon music" name="amazon_music" value="<?php echo set_value('amazon_music', $music->amazon_music); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('apple_itunes'); ?>  :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter apple itunes" name="apple_itunes" value="<?php echo set_value('apple_itunes', $music->apple_itunes); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('apple_music'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter apple music" name="apple_music" value="<?php echo set_value('apple_music', $music->apple_music); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('deezer'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter deezer" name="deezer" value="<?php echo set_value('deezer', $music->deezer); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('google_play_music'); ?>:</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter google play music" name="google_play_music" value="<?php echo set_value('google_play_music', $music->google_play_music); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('juke'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter Juke" name="juke" value="<?php echo set_value('juke', $music->juke); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('microsoft'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter microsoft" name="microsoft" value="<?php echo set_value('microsoft', $music->microsoft); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('musicload'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter musicload" name="musicload" value="<?php echo set_value('musicload', $music->musicload); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('napster'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter napster" name="napster" value="<?php echo set_value('napster', $music->napster); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('qobuz'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter qobuz" name="qobuz" value="<?php echo set_value('qobuz', $music->qobuz); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('spotify'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter spotify" name="spotify" value="<?php echo set_value('spotify', $music->spotify); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('tidal'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter tidal" name="tidal" value="<?php echo set_value('tidal', $music->tidal); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('vimeo'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter vimeo" name="vimeo" value="<?php echo set_value('vimeo', $music->vimeo); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('youtube'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter youtube" name="youtube" value="<?php echo set_value('youtube', $music->youtube); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('amazon_books'); ?>:</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter amazon books" name="amazon_books" value="<?php echo set_value('amazon_books', $music->amazon_books); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('apple_books'); ?>:</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter apple books" name="apple_books" value="<?php echo set_value('apple_books', $music->apple_books); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('google_play_books'); ?>:</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter google play books" name="google_play_books" value="<?php echo set_value('google_play_books', $music->google_play_books); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('music_notes'); ?>:</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter music notes" name="music_notes" value="<?php echo set_value('music_notes', $music->music_notes); ?>">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo lang('notafina'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter notafina" name="notafina" value="<?php echo set_value('notafina', $music->notafina); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('note_download'); ?> :</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter note download" name="note_download" value="<?php echo set_value('note_download', $music->note_download); ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('sheet_music_plus'); ?>:</label>
                                <div class="controls">
                                    <input type="text" class="span11" placeholder="Enter sheet music plus" name="sheet_music_plus" value="<?php echo set_value('sheet_music_plus', $music->sheet_music_plus); ?>">
                                </div>
                            </div>

                            <!--          <div class="control-group">
                                         <label class="control-label">Music Image :</label>
                                         <div class="controls">
                                             <img height="100" width="100" src="<?php echo base_url(); ?>/uploads/category_img/<?php echo $music->music_image; ?>" id="show_image"><br><br>   
                                             <div class="uploader" id="uniform-music_image">
                                                 <input type="file" name="userfile" id="userfile" class="span11" size="19" style="opacity: 0;">
                                             </div>
                                             <input type="hidden" id="music_image" name="music_image" value="<?php echo $music->music_image; ?>">
                                         </div>
                                     </div> -->
                            <div class="control-group">
                                <label class="control-label"><?php echo lang('status'); ?> :</label>
                                <div class="controls">
                                    <select name="music_status">
                                        <option value="1"<?php
                                        echo set_select('music_status', 1);
                                        if ($music->music_status == 1) {
                                            echo "selected";
                                        }
                                        ?>><?php echo lang('active'); ?></option>
                                        <option value="0"<?php
                                        echo set_select('music_status', 0);
                                        if ($music->music_status == 0) {
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