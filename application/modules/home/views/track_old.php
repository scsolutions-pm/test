<div class="gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <button type="button" style="display: none" id="resetCheckbox"value="Reset">Reset</button>
            <div class="filter1">
                <ul>
                    <?php foreach ($tracktypes as $type) { ?>
                        <li>
                            <label>
                                <input type="checkbox" class="checkbox" id ="tracktype_check_<?php echo $type['tracktype_id'] ?>" name="tracktype" value="<?php echo $type['tracktype_id'] ?>">
                                <?php $tcount = countcolumn($type['tracktype_id'], 'tracktype_id', 'gm_music'); ?>
                                <span class="label-text"><?php echo $type['tracktype_name'] ?>  <span>(<?php echo $tcount; ?>)</span></span>
                            </label>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <h4 class="filter-head"><?php echo lang('interpret'); ?></h4>
            <div class="filter" id="style-1">
                <ul>
                    <?php foreach ($interpreters as $int) { ?>
                        <li>
                            <label>
                                <input type="checkbox" class="checkbox" id = "interpret_check" name="interpret" value="<?php echo $int['interpreter_id'] ?>">
                          <?php $icount = countcolumn($int['interpreter_id'], 'interpreter_id', 'gm_music'); ?>
                                <span class="label-text"><?php echo $int['interpreter_name'] ?> (<span id="interpret_<?php echo $int['interpreter_id'] ?>"><?php echo $icount; ?></span>)
                            </span>
                            </label>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <h4 class="filter-head"><?php echo lang('album'); ?></h4>
            <div class="filter" id="style-1">
                <ul>
                    <?php foreach ($albums as $alb) { ?>
                        <li>
                            <label>
                                <input type="checkbox" class="checkbox" id = "album_check" name="album" value="<?php echo $alb['album_id'] ?>">
                                <?php $acount = countcolumn($alb['album_id'], 'album_id', 'gm_music'); ?>
                                <span class="label-text"><?php echo $alb['album_name'] ?> <span>(<?php echo $acount; ?>)</span></span>
                            </label>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <h4 class="filter-head"><?php echo lang('category'); ?></h4>
            <div class="filter" id="style-1">
                <ul>
                    <?php foreach ($categories as $cat) { ?>
                        <li>
                            <label>
                                <input type="checkbox" class="checkbox" id = "category_check" name="category" value="<?php echo $cat['category_id'] ?>">
                                <?php $ccount = countcolumn($cat['category_id'], 'category_id', 'gm_music'); ?>
                                <span class="label-text"><?php echo $cat['category_name'] ?> <span>(<?php echo $ccount; ?>)</span></span>
                            </label>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <h4 class="filter-head"><?php echo lang('year'); ?></h4>
            <div class="filter1 btm-filter" id="style-1">
                <p>
                    <label for="amount"><?php echo lang('year'); ?>:</label>
                    <input type="text" id="amount" name="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>
                <div class="checkbox" id="slider-range"></div>                        
                <img src="<?php echo base_url() ?>assets/img/img/mt.png" class="renge-img">
            </div>
        </div>
        <div class="col-md-9">
            <div class="reasult">
                <div class="search">
<!--                    <input type="text" class="form-control search" placeholder="Was suchen Sie?">-->
                    <input type="text" id="keySearch"  name="keySearch" class="form-control" placeholder="<?php echo lang('What_are_you_looking_for?'); ?>">        
                    <ul class="dropdown-menu txtKeySearch" style="margin-left:15px;margin-right:0px;" role="menu" aria-labelledby="dropdownMenu" id="DropdownKeySearch"></ul>
                </div>
            </div>
            </br></br></br>
            <div class="filter-result style-1" id="musictrack">
                <?php
                //echo '<pre>';
                //  print_r($tracks);

                foreach ($albums as $value) {

                    if (!empty($value['album_interpret'])) {
                        $trackArray = explode(',', $value['album_interpret']);
                        $prefix = $intlist = '';
                        foreach ($trackArray as $track) {
                            $intlist .= $prefix . '' . namefromid($track, 'gm_interpreter', 'interpreter_description') . '';
                            $prefix = ', ';
                        }
                        $intlist = $intlist;
                    } else {
                        $intlist = '';
                    }
                    ?>
                    <div class="col-md-4">
                        <div class="heightdiv">  
                            <a href="<?php echo base_url(); ?>home/albumDetails/<?php echo $value['album_id']; ?>"">
                                <img height="150" width="150" src="<?php echo base_url(); ?>/uploads/category_img/<?php echo $value['album_image']; ?>" /></a>

                            <h4><?php echo $value['album_name']; ?></h4>
                            <p> <?php echo $intlist; ?></p></div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
</div>
</br>

<footer>
    <p><?php echo lang('copyright'); ?></p>

    <div class="bts-popup" role="alert">
        <div class="bts-popup-container">
            <?php //print_r($popupDetail); ?>
            <img alt="" width="100" src="<?php echo base_url(); ?>/uploads/category_img/<?php echo $popupDetail->album_image; ?>" >
<!--            <img src="http://goodmusic.online/wp-content/uploads/2017/07/sonet-gb-lp-00602527338118cv_300-150x150.jpg" alt="" width="100" />-->
            <h3><?php echo lang('album_des_tages'); ?></h3>
            <h6><?php echo $popupDetail->album_name; ?></h6>
<h6><?php echo $popupDetail->album_description; ?></h6>
            <a href="#0" class="bts-popup-close img-replace">Close</a>
        </div>
    </div>

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

    <script>
        jQuery(function () {
            jQuery("#slider-range").slider({
                range: true,
                min: 1949,
                max: 2018,
                values: [1949, 2018],
                slide: function (event, ui) {
                    jQuery("#amount").val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
                }
            });
            jQuery("#amount").val(jQuery("#slider-range").slider("values", 0) +
                    " - " + jQuery("#slider-range").slider("values", 1));
        });
    </script>
     <script>
                $(window).scroll(function () {
                    var scroll = $(window).scrollTop();
                    if (scroll >= 100) {
                        $(".navbar-brand img").addClass("fix-logo");
                    } else {
                        $(".navbar-brand img").removeClass("fix-logo");
                    }
                });

                $(window).scroll(function () {
                    var scroll = $(window).scrollTop();
                    if (scroll >= 100) {
                        $(".navbar").addClass("fix-header");
                    } else {
                        $(".navbar").removeClass("fix-header");
                    }
                });

            </script>
            
    <script>
        $(document).ready(function ($) {
            //    localStorage.setItem('firstVisit', '1');
            $(function ()
            {
                if (sessionStorage.getItem('shown') === null)
                {
                    $(".bts-popup").delay(1500).addClass('is-visible');
                    sessionStorage.setItem('shown', true);
                }
                //Close element.
                $(".bts-popup").click(function ()
                {
                    $(this).removeClass('is-visible');
                });
            });

            //            window.onload = function () {
            //                $(".bts-popup").delay(1500).addClass('is-visible');
            //            }
            //open popup
            $('.bts-popup-trigger').on('click', function (event) {
                event.preventDefault();
                $('.bts-popup').addClass('is-visible');
            });
            //close popup
            $('.bts-popup').on('click', function (event) {
                if ($(event.target).is('.bts-popup-close') || $(event.target).is('.bts-popup')) {
                    event.preventDefault();
                    $(this).removeClass('is-visible');
                }
            });
            //close popup when clicking the esc keyboard button
            $(document).keyup(function (event) {
                if (event.which == '27') {
                    $('.bts-popup').removeClass('is-visible');
                }
            });
        });
    </script>

</footer>
</body>
</html>
