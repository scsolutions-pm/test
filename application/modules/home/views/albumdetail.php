<div class="container">
    <h3 class="upr" style="" class="view-detail"><?php echo $albumdetail->album_name; ?></h3>
</div>
</br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="search innersearch">
          <!--  <input type="text" class="form-control search" placeholder="Was suchen Sie?">-->
                <input type="text" id="keySearch"  name="keySearch" class="form-control" placeholder="<?php echo lang('What_are_you_looking_for?'); ?>">        
                <ul class="dropdown-menu  dropdown-menu-new txtKeySearch" style="margin-left:15px;margin-right:0px;" role="menu" aria-labelledby="dropdownMenu" id="DropdownKeySearch"></ul>
            </div>
        </div>
    </div>
</div>
</br>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="detail-area">
                <h2> <?php
                    if (!empty($albumdetail->album_interpret)) {
                        $trackArray = explode(',', $albumdetail->album_interpret);
                        $prefix = $list1 = '';
                        foreach ($trackArray as $track) {
                            $list1 .= $prefix . '' . namefromid($track, 'gm_interpreter', 'interpreter_description') . '';
                            $prefix = ', ';
                        }
                        // echo($list1);
                    } else {
                        // echo '';
                    }
                    ?></h2><br>
                <h5><?php
                    if (!empty($albumdetail->album_kategorien)) {
                        $trackArray = explode(',', $albumdetail->album_kategorien);
                        $prefix = $list2 = '';
                        foreach ($trackArray as $track) {
                            $list2 .= $prefix . '' . namefromid($track, 'gm_category', 'category_name') . '';
                            $prefix = ', ';
                        }
                        //  echo($list2);
                    } else {
                        //echo '';
                    }
                    ?></h5>
                <span class="bold uppercase"><h2><?php echo namefromid($albumdetail->album_interpret, 'gm_interpreter', 'interpreter_description'); ?></h2></span>
                <span class="bold uppercase"><?php echo lang('label'); ?> : <p><?php echo $albumdetail->label; ?></p></span>
                <?php if (!empty($albumdetail->album_EAN)) { ?>
                    <span class="bold">EAN : <p><?php echo $albumdetail->album_EAN; ?></p></span></br>
                <?php } ?>
                <h5><i> <?php echo lang("for_more_details"); ?></i></h5>
                <ol>
                    <?php
//echo "<pre>"; print_r($albumtracks);
                    foreach ($albumtracks as $tracks) {
                        ?>
                        <li> 
                            <?php 
                                //   $track_names = explode(" ",$tracks['track_name']);
                                //   $strss = implode("-",$track_names);
                             ?>
                            <a href = "<?php echo base_url(); ?>home/trackDetails/<?php  echo urlencode($tracks['track_slug']); ?>" style="color:#000"><?php echo $tracks['track_name']; ?></a></li>
                    <?php }
                    ?></ol>
                    <ul class="next-link">
                        <?php if (!empty($albumdetail->amazon_music_album)) { ?>
                            <a target="_blank" href='<?php echo $albumdetail->amazon_music_album; ?>' ><li><?php echo lang('amazon_music_album'); ?></li></a>
                        <?php } ?>
                        <?php if (!empty($albumdetail->apple_itunes_album)) { ?>
                            <a target="_blank" href='<?php echo $albumdetail->apple_itunes_album; ?>'><li><?php echo lang('apple_itunes_album'); ?></li></a>
                        <?php } ?>
                        <?php if (!empty($albumdetail->apple_music_album)) { ?>
                            <a target="_blank" href='<?php echo $albumdetail->apple_music_album; ?>'><li><?php echo lang('apple_music_album'); ?></li></a>
                        <?php } ?>
                        <?php if (!empty($albumdetail->deezer_album)) { ?>
                            <a target="_blank" href='<?php echo $albumdetail->deezer_album; ?>'><li><?php echo lang('deezer_album'); ?></li></a>
                        <?php } ?>
                        <?php if (!empty($albumdetail->google_play_music_album)) { ?>
                            <a target="_blank" href='<?php echo $albumdetail->google_play_music_album; ?>'><li><?php echo lang('google_play_music_album'); ?></li></a>
                        <?php } ?>
                        <?php if (!empty($albumdetail->juke_album)) { ?>
                            <a target="_blank" href='<?php echo $albumdetail->juke_album; ?>'><li><?php echo lang('juke_album'); ?></li></a>
                        <?php } ?>
                        <?php if (!empty($albumdetail->napster_album)) { ?>
                            <a target="_blank" href='<?php echo $albumdetail->napster_album; ?>'><li><?php echo lang('napster_album'); ?></li></a>
                        <?php } ?>
                        <?php if (!empty($albumdetail->qobuz_album)) { ?>
                            <a target="_blank" href='<?php echo $albumdetail->qobuz_album; ?>'><li><?php echo lang('qobuz_album'); ?></li></a>
                        <?php } ?>
                               <?php if (!empty($albumdetail->spotify_album)) { ?>
                            <a target="_blank" href='<?php echo $albumdetail->spotify_album; ?>'><li><?php echo lang('spotify_album'); ?></li></a>
                        <?php } ?>
                        <?php if (!empty($albumdetail->tidal_album)) { ?>
                            <a target="_blank" href='<?php echo $albumdetail->tidal_album; ?>'><li><?php echo lang('tidal_album'); ?></li></a>
                        <?php } ?>
                    </ul>
            </div>
        </div>
        <div class="col-md-3">
            <img src="<?php echo base_url(); ?>/uploads/category_img/<?php echo $albumdetail->album_image; ?>" style=" width: 253px;
                 height: 253px;"/><br><br>   
        </div>
    </div>
</div>
</br>

<footer>
    <p><?php echo lang('copyright'); ?></p>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js'></script>
    <script src="<?php echo base_url(); ?>assets/js/mycustom.js"></script>

    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
    </script>

    <script>
        $(document).ready(function () {
            $('#myCarousel').carousel({
                interval: 10000
            })
        });
    </script>
</footer>
</body>

</html>
