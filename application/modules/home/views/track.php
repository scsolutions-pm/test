<div class="gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <button type="button" style="display: none" id="resetCheckbox" value="Reset" ><?php echo lang('reset'); ?></button>
            <div class="filter1">
                <ul>
                    <?php foreach ($tracktypes as $type) { ?>
                        <li>
                            <label>
                               <!--  <input type="checkbox" class="checkboxnew"   name="tracktype" id="tracktypes_<?php //echo $type['tracktype_id']                           ?>" onclick="searchResults('tracktypes','<?php //echo $type['tracktype_id']                           ?>')" > -->
                                <input class="myAllCheckBox" type="checkbox" name="checkbox" id="tracktypes_<?php echo $type['tracktype_id'] ?>" onclick="searchResults('tracktypes', '<?php echo $type['tracktype_id'] ?>')">
                                <?php $tcount = countcolumn($type['tracktype_id'], 'tracktype_id', 'gm_music'); ?>
                                <span class="label-text"><?php echo $type['tracktype_name'] ?>  <span class="tracktypes all">(<?php echo $tcount; ?>)</span></span>
                            </label>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <h4 class="filter-head uppercase"><?php echo lang('interpreter'); ?></h4>
            <div class="filter" id="style-1">
                <ul>
                    <?php foreach ($interpreters as $int) { ?>
                        <li>
                            <label>
                               <!--  <input type="checkbox" class="checkboxnew" id = "interpret_check" name="interpret" value="<?php //echo $int['interpreter_id']                           ?>"> -->
                                <input class="myAllCheckBox" id="interpret_<?php echo $int['interpreter_id'] ?>" type="checkbox" name="checkbox" onclick="searchResults('interpret', '<?php echo $int['interpreter_id'] ?>')">
                                <?php $icount = countcolumn($int['interpreter_id'], 'interpreter_id', 'gm_music'); ?>
                                <span class="label-text"><?php echo $int['interpreter_name'] ?> (<span id="interpret_<?php echo $int['interpreter_id'] ?>"  class="interpreters all"><?php echo $icount; ?></span>)
                                </span>
                            </label>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <h4 class="filter-head uppercase"><?php echo lang('album'); ?></h4>
            <div class="filter" id="style-1">
                <ul>
                    <?php foreach ($albums as $alb) { ?>
                        <li>
                            <label>
                                <!-- <input type="checkbox" class="checkboxnew" id = "album_check" name="album" value="<?php //echo $alb['album_id']                           ?>"> -->
                                <input class="myAllCheckBox" id="album_<?php echo $alb['album_id'] ?>" type="checkbox" name="checkbox" onclick="searchResults('album', '<?php echo $alb['album_id'] ?>')">
                                <?php $acount = countcolumn($alb['album_id'], 'album_id', 'gm_music'); ?>
                                <span class="label-text"><?php echo $alb['album_name'] ?> <span class="albums all">(<?php echo $acount; ?>)</span></span>
                            </label>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <h4 class="filter-head uppercase"><?php echo lang('category'); ?></h4>
            <div class="filter" id="style-1">
                <ul>
                    <?php foreach ($categories as $cat) { ?>
                        <li>
                            <label>
                                <!-- <input type="checkbox" class="checkboxnew" id = "category_check" name="category" value="<?php //echo $cat['category_id']                           ?>"> -->
                                <input class="myAllCheckBox" id="category_<?php echo $cat['category_id'] ?>" type="checkbox" name="checkbox" onclick="searchResults('category', '<?php echo $cat['category_id'] ?>')">
                                <?php $ccount = countcolumn($cat['category_id'], 'category_id', 'gm_music');
                                ?>
                                <span class="label-text"><?php echo $cat['category_name'] ?> <span  class="categories all">(<?php echo $ccount; ?>)</span></span>
                            </label>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <h4 class="filter-head uppercase"><?php echo lang('year'); ?></h4>
            <div class="filter1 btm-filter" id="style-1">
                <p>
<!--                    <label for="amount"><?php //echo lang('year'); ?>:</label>-->
                    <input type="text" id="amount" name="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>
                <div class="checkboxnew" id="slider-range" onclick="searchResults('', '')"></div>                        
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
            <div class="style-1 filter-result" id="filter-result">
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
                    <div class="col-md-4 loadcol">
                        <div class="heightdiv">  
    <!--                   <input type="hidden" name="alb_id" value="<?php //echo $value['album_id'];                          ?>"/>-->
                            <a href="<?php echo base_url(); ?>home/albumDetails/<?php echo namefromAlbumId($value['album_id']); ?>">
                                <img class="filterimg" height="150" width="150" src="<?php echo base_url(); ?>/uploads/category_img/<?php echo $value['album_image']; ?>" /></a>
                            <h4><?php echo $value['album_name']; ?></h4>
                            <p><?php echo $intlist; //$value['album_interpret'];        ?>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <a href="#" id="loadMore"><?php echo lang('load_more'); ?></a>

<!--            <p class="totop"> 
     <a href="#top">Back to top</a> 
 </p>-->
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
             <h6><?php echo namefromid($popupDetail->album_interpret, 'gm_interpreter', 'interpreter_description'); ?></h6>
            <a href="#0" class="bts-popup-close img-replace"><?php echo lang('close'); ?></a>
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
                // alert(localStorage.getItem('shown'));
                if (localStorage.getItem('shown') === null)
                {
                    //$(".bts-popup").delay(1500).addClass('is-visible');
                    $(".bts-popup").addClass("is-visible");
                    localStorage.setItem('shown', true);
                } else {
                    $(this).removeClass('is-visible');
                }
                //Close element.
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

    <!-- Vijay Code -->
    <script>

        $(document).ready(function () {
            $(function () {
                $(".loadcol").slice(0, 12).show();
                $("#loadMore").on('click', function (e) {
                    e.preventDefault();
                    $(".loadcol:hidden").slice(0, 15).slideDown();
                    //alert($(".loadcol:hidden").length);
                    if ($(".loadcol:hidden").length == 0) {
                        $("#loadMore").hide();
                    }
                });
            });

//            $('a[href=#top]').click(function () {
//                $('body,html').animate({
//                    scrollTop: 0
//                }, 600);
//                return false;
//            });
//            $(window).scroll(function () {
//                if ($(this).scrollTop() > 50) {
//                    $('.totop a').fadeIn();
//                } else {
//                    $('.totop a').fadeOut();
//                }
//            });

            $('#myCarousel').carousel({
                interval: 10000
            })
        });
    </script>

    <script>
        jQuery(document).ready(function ($) {
            window.onload = function () {
                $(".bts-popup").delay(1500).addClass('is-visible');
            }
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
    <input type="hidden" name="mySerachType"  id="mySerachType" value="">  
    <input type="hidden" name="tracktypes_id" id="tracktypes_id" value="">
    <input type="hidden" name="interpret_id"  id="interpret_id" value="">
    <input type="hidden" name="album_id"  id="album_id" value="">
    <input type="hidden" name="category_id"   id="category_id" value="">      
    <script type="text/javascript">
        function searchResults(type, id) {
            if ($('.myAllCheckBox').is(":checked")) {
                $('#resetCheckbox').css('display', 'block');
            } else {
                $('#resetCheckbox').css('display', 'none');
            }

            var mySerachTypes = $("#mySerachType").val();
            var tracktypes_id = $("#tracktypes_id").val();
            var interpret_id = $("#interpret_id").val();
            var album_id = $("#album_id").val();
            var category_id = $("#category_id").val();

            if (mySerachTypes == '') {
                $("#mySerachType").val(type);
            } else if (mySerachTypes.indexOf(type) == -1) {
                $("#mySerachType").val(mySerachTypes + ',' + type);
            } else {
                $("#mySerachType").val(mySerachTypes);
            }

            //Track Types     
            if ($("#" + type + "_" + id).is(":checked")) {
                if (type == 'tracktypes') {
                    if (tracktypes_id == '') {
                        $("#tracktypes_id").val(id);
                    } else if (tracktypes_id.indexOf(id) == -1) {
                        $("#tracktypes_id").val(tracktypes_id + '|' + id);
                    } else {
                        $("#tracktypes_id").val(tracktypes_id);
                    }
                }
            } else {
                if (type == 'tracktypes') {
                    var tracktypes_id = $("#tracktypes_id").val();
                    var tracktypes_ids = tracktypes_id.split('|');
                    var newArr_t = $(tracktypes_ids).not([id]).get();
                    var result_t = newArr_t.join("|");
                    $("#tracktypes_id").val(result_t);
                }
            }

            //interpret
            if ($("#" + type + "_" + id).is(":checked")) {
                if (type == 'interpret') {
                    if (interpret_id == '') {
                        $("#interpret_id").val(id);
                        // alert(id);
                    } else if (interpret_id.indexOf(id) == -1) {
                        $("#interpret_id").val(interpret_id + '|' + id);
                        // alert(interpret_id+'|'+id);
                    } else {
                        $("#interpret_id").val(interpret_id);
                        //alert(interpret_id);
                    }
                }
            } else {
                if (type == 'interpret') {
                    var interpret_id = $("#interpret_id").val();
                    var interpret_ids = interpret_id.split('|');
                    var newArr_i = $(interpret_ids).not([id]).get();
                    var result_i = newArr_i.join("|");
                    $("#interpret_id").val(result_i);
                    //alert(result_i);
                }
            }

            //album
            if ($("#" + type + "_" + id).is(":checked")) {
                if (type == 'album') {
                    if (album_id == '') {
                        $("#album_id").val(id);
                    } else if (album_id.indexOf(id) == -1) {
                        $("#album_id").val(album_id + '|' + id);
                    } else {
                        $("#album_id").val(album_id);
                    }
                }
            } else {
                if (type == 'album') {
                    var album_id = $("#album_id").val();
                    var album_ids = album_id.split('|');
                    var newArr_a = $(album_ids).not([id]).get();
                    var result_a = newArr_a.join("|");
                    $("#album_id").val(result_a);
                }
            }

            //category
            if ($("#" + type + "_" + id).is(":checked")) {
                if (type == 'category') {
                    if (category_id == '') {
                        $("#category_id").val(id);
                    } else if (category_id.indexOf(id) == -1) {
                        $("#category_id").val(category_id + '|' + id);
                    } else {
                        $("#category_id").val(category_id);
                    }
                }
            } else {
                if (type == 'category') {
                    var category_id = $("#category_id").val();
                    var category_ids = category_id.split('|');
                    var newArr_c = $(category_ids).not([id]).get();
                    var result_c = newArr_c.join("|");
                    $("#category_id").val(result_c);
                }
            }

            var mySerachTypes_n = $("#mySerachType").val();
            var tracktypes_id_n = $("#tracktypes_id").val();
            var interpret_id_n = $("#interpret_id").val();
            var album_id_n = $("#album_id").val();
            var category_id_n = $("#category_id").val();
            var amount = $("#amount").val();
            $.ajax({
                type: "POST",
                url: '<?php echo base_url() ?>home/newSearchResult/',
                data: {
                    mySerachTypess: mySerachTypes_n,
                    tracktypes_ids: tracktypes_id_n,
                    interpret_ids: interpret_id_n,
                    album_ids: album_id_n,
                    category_ids: category_id_n,
                    amounts: amount
                },
                dataType: "html",
                success: function (result)
                {
                    var obj = jQuery.parseJSON(result);
                    $('#filter-result').html(obj.myresult);
                    $(".loadcol:hidden").slice(0, 15).slideDown();
                    if ($(".loadcol:hidden").length == 0) {
                        $("#loadMore").hide();
                    }
                    else{
                         $("#loadMore").show();
                    }
                    // alert(obj.mySerachTypess);   
                }
            });
        }
    </script>
    <style>
        /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
        .loadcol {
            display:none;
        }
        .totop {
            position: fixed;
            bottom: 10px;
            right: 20px;
        }
        .totop a {
            display: none;
        }
        a, a:visited {
            color: #33739E;
            text-decoration: none;
            display: block;
            margin: 10px 0;
        }
        a:hover {
            text-decoration: none;
        }
        #loadMore {
            padding: 10px;
            text-align: center;
            background-color: #EBEBEB;
            color: #666;
            border-width: 0 1px 1px 0;
            border-style: solid;
            border-color: #fff;
            box-shadow: 0 1px 1px #ccc;
            transition: all 600ms ease-in-out;
            -webkit-transition: all 600ms ease-in-out;
            -moz-transition: all 600ms ease-in-out;
            -o-transition: all 600ms ease-in-out;
        }
        #loadMore:hover {
            background-color: #EBEBEB;
            color: #666;
        }
    </style>
</footer>
</body>
</html>
