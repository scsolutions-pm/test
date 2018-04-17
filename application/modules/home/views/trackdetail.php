<div class="container">
    <h3 class="view-detail"><?php echo $trackdetail->track_name; ?></h3>
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
                <span class="bold"><?php echo lang('album'); ?> : <p><?php
                        if (!empty($trackdetail->album_id)) {
                            $trackArray = explode(',', $trackdetail->album_id);
                            //  print_r($trackArray);
                            $prefix = $list = '';
                            foreach ($trackArray as $track) {
                                $list .= $prefix . "<a href = '" . base_url() . "home/albumDetails/". namefromAlbumId($track)."'>" . namefromid($track, 'gm_album', 'album_name') . "</a>";
                                $prefix = '| ';
                            }
                            echo $list;
                        } else {
                            echo '';
                        }
                        ?>
                    </p></span>
                <span class="bold"><?php echo lang('interpreter'); ?> : <p> <?php
                        if (!empty($trackdetail->interpreter_id)) {
                            //  echo $trackdetail->interpreter_id;
                            $intArray = explode(',', $trackdetail->interpreter_id);
                           //   print_r($intArray);
                            $prefix = $ilist = '';
                            foreach ($intArray as $int) {
                                $int_name = namefromid($int, 'gm_interpreter', 'interpreter_name');
                                if (!empty($int_name)) {
                                    $ilist .= $prefix . '' . $int_name . '';
                                    $prefix = ' & ';
                                } else {
                                    $int_name = 'N/A';
                                    $ilist .= $prefix . '' . $int_name . '';
                                    $prefix = ' & ';
                                }
                            }
                            echo $ilist;
//                                                                                      
                        } else {
                            echo 'No';
                        }
                        ?></p></span>
                <span class="bold"><?php echo lang('category'); ?> : <p><?php
                    if (!empty($trackdetail->category_id)) {
                        $catArray = explode(',', $trackdetail->category_id);
                        $prefix = $clist = '';
                        foreach ($catArray as $cat) {
                            $clist .= $prefix . '' . namefromid($cat, 'gm_category', 'category_name') . '';
                            $prefix = ', ';
                        }
                        echo $clist;
//                                                                                      
                    } else {
                        echo 'No';
                    }
                    ?></p></span>
                <?php if (!empty($trackdetail->year)) { ?>
                    <span class="bold"><?php echo lang('year'); ?> : <p><?php echo $trackdetail->year; ?></p></span>
                <?php } ?>
                <?php if (!empty($trackdetail->isrc)) { ?>
                    <span class="bold"><?php echo lang('authors'); ?> :<p> <?php echo $trackdetail->authors; ?></p></span>
                <?php } ?>
                <?php if (!empty($trackdetail->arranger)) { ?>
                    <span class="bold"><?php echo lang('arranger'); ?> :<p> <?php echo $trackdetail->arranger; ?></p> </span>
                <?php } ?>
                <?php if (!empty($trackdetail->producer)) { ?>
                    <span class="bold"><?php echo lang('producer'); ?> :<p> <?php echo $trackdetail->producer; ?></p> </span>
                <?php } ?>
                <?php if (!empty($trackdetail->publishing_company)) { ?>
                    <span class="bold"><?php echo lang('publishing_company'); ?> : <p> <?php echo $trackdetail->publishing_company; ?></p> </span>
                <?php } ?>
                <?php if (!empty($trackdetail->duration)) { ?>
                    <span class="bold"><?php echo lang('duration'); ?> : <p><?php echo $trackdetail->duration; ?></p></span>
                <?php } ?>
                <?php if (!empty($trackdetail->language)) { ?>
                    <span class="bold"><?php echo lang('language'); ?> :<p> <?php echo $trackdetail->language; ?></p></span>
                <?php } ?>
                <?php if (!empty($trackdetail->isrc)) { ?>
                    <span class="bold"><?php echo lang('isrc'); ?> : <p><?php echo $trackdetail->isrc; ?></p></span>
                <?php } ?>
                <?php if (!empty($trackdetail->label)) { ?>
                    <span class="bold"><?php echo lang('label'); ?> : <p><?php echo 'VEAC' ?></p></span>
                <?php } ?>

                <ul class="next-link">
                    <?php if (!empty($trackdetail->amazon_music)) { ?>
                        <a target="_blank" href='<?php echo $trackdetail->amazon_music; ?>'><li><?php echo lang('amazon_music'); ?></li></a>
                    <?php } ?>
                    <?php if (!empty($trackdetail->apple_itunes)) { ?>
                        <a target="_blank" href='<?php echo $trackdetail->apple_itunes; ?>'><li><?php echo lang('apple_itunes'); ?></li></a>
                    <?php } ?>
                    <?php if (!empty($trackdetail->apple_music)) { ?>
                        <a target="_blank" href='<?php echo $trackdetail->apple_music; ?>'><li><?php echo lang('apple_music'); ?></li></a>
                    <?php } ?>
                    <?php if (!empty($trackdetail->deezer)) { ?>
                        <a target="_blank" href='<?php echo $trackdetail->deezer; ?>'><li><?php echo lang('deezer'); ?></li></a>
                    <?php } ?>
                    <?php if (!empty($trackdetail->google_play_music)) { ?>
                        <a target="_blank" href='<?php echo $trackdetail->google_play_music; ?>'><li><?php echo lang('google_play_music'); ?></li></a>
                    <?php } ?>
                    <?php if (!empty($trackdetail->juke)) { ?>
                        <a target="_blank" href='<?php echo $trackdetail->juke; ?>'><li><?php echo lang('juke'); ?></li></a>
                    <?php } ?>
                    <?php if (!empty($trackdetail->napster)) { ?>
                        <a target="_blank" href='<?php echo $trackdetail->napster; ?>'><li><?php echo lang('napster'); ?></li></a>
                    <?php } ?>
                    <?php if (!empty($trackdetail->qobuz)) { ?>
                        <a target="_blank" href='<?php echo $trackdetail->qobuz; ?>'><li><?php echo lang('qubuz'); ?></li></a>
                    <?php } ?>
                    <?php if (!empty($trackdetail->spotify)) { ?>
                        <a target="_blank" href='<?php echo $trackdetail->spotify; ?>'><li><?php echo lang('spotify'); ?></li></a>
                    <?php } ?>
                    <?php if (!empty($trackdetail->tidal)) { ?>
                        <a target="_blank" href='<?php echo $trackdetail->tidal; ?>'><li><?php echo lang('tidal'); ?></li></a>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <!-- <div class="col-md-3">
            <img  src="<?php echo base_url(); ?>/uploads/category_img/<?php //echo $trackdetail->music_image;            ?>"><br><br>   
        </div> -->
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
