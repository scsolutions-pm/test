       <div class="container">
            <div class="center-logo">
                <img src="<?php echo base_url() ?>assets/img/img/big-logo.jpg" alt="logo">
<!--<img src="img/big-logo.jpg">-->
            </div>
        </div>
        </br>
        <div class="container">
            <div class="gallery-slider">
                <h3><?php echo lang('welcome_to_goodmusic_online'); ?></h3>
            </div>
            </br></br>
        </div>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="well"> 
                        <div id="myCarousel" class="carousel slide">
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="row">
                                        <?php foreach ($albums as $i => $value) { ?>
                                            <?php if (($i > 0) && ($i % 3 == 0)) { ?>
                                                <div class="col-md-3 <?php echo $i; ?> "><a href="#" class="thumbnail"><img src="<?php echo base_url(); ?>/uploads/category_img/<?php echo $value['album_image']; ?>" alt="Image" width="150" height="150" /></a></div>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="row">
                                            <?php } ?>
                                            <div class="col-md-3"><a href="#" class="thumbnail"><img src="<?php echo base_url(); ?>/uploads/category_img/<?php echo $value['album_image']; ?>" alt="Image" width="150" height="150"  target=""/></a></div>  
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--/carousel-inner-->

                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                        </div><!--/myCarousel-->
                    </div><!--/well-->   
                </div>
            </div>
        </div>

        <div class="container">
            <a href="<?php echo base_url() ?>tracks"><h2 class="heading"><?php echo lang('browse_here'); ?></h2></a>
            <div class="col-md-offset-2  col-md-8">
 <div class="pera"><?php //echo lang('browse_our_rich_repertoire_of_music');
            echo($homedetail->page_content);
            ?></div>
        </div>
        </div>
        </br></br>

        <div class="container">
            <div class="row">
                <div class="more-info">
                    <div class="col-md-4">
                        <img src="<?php echo base_url() ?>assets/img/img/shop.jpg">
                        <h4><?php echo lang('for_sound_carrier_streaming'); ?></h4>
                    </div>
                    <div class="col-md-4">
                        <img src="<?php echo base_url() ?>assets/img/img/apple.jpg">
                        <h4><?php echo lang('for_sound_recording_download'); ?></h4>
                    </div>
                    <div class="col-md-4">
                        <img src="<?php echo base_url() ?>assets/img/img/north.jpg">
                        <h4><?php echo lang('for_sheet_music_download'); ?></h4>
                    </div>
                </div>
            </div>

        </div> 
        </br></br></br></br>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <img src="<?php echo base_url() ?>assets/img/img/amazon.jpg">
                    <img src="<?php echo base_url() ?>assets/img/img/amazon-book.jpg">
                    <img src="<?php echo base_url() ?>assets/img/img/apple.jpg">
                    <img src="<?php echo base_url() ?>assets/img/img/sheet.jpg">
                </div>

                <div class="col-md-2">
                    <img src="<?php echo base_url() ?>assets/img/img/apple.jpg">
                    <img src="<?php echo base_url() ?>assets/img/img/qobuz.jpg">
                    <img src="<?php echo base_url() ?>assets/img/img/ibook.jpg">
                </div>

                <div class="col-md-2">
                    <img src="<?php echo base_url() ?>assets/img/img/music1.jpg">
                    <img src="<?php echo base_url() ?>assets/img/img/shop.jpg">
                    <img src="<?php echo base_url() ?>assets/img/img/googleplay.jpg">
                </div>

                <div class="col-md-2">
                    <img src="<?php echo base_url() ?>assets/img/img/deezar.jpg">
                    <img src="<?php echo base_url() ?>assets/img/img/tidal.jpg">
                    <img src="<?php echo base_url() ?>assets/img/img/music.jpg">
                </div>

                <div class="col-md-2">
                    <img src="<?php echo base_url() ?>assets/img/img/googleplay-or.jpg">
                    <img src="<?php echo base_url() ?>assets/img/img/vimeo.jpg">
                    <img src="<?php echo base_url() ?>assets/img/img/notifa.jpg">
                </div>

                <div class="col-md-2">
                    <img src="<?php echo base_url() ?>assets/img/img/juke.jpg">
                    <img src="<?php echo base_url() ?>assets/img/img/youtube.jpg">
                    <img src="<?php echo base_url() ?>assets/img/img/north.jpg">
                </div>
            </div>
        </div>

        <footer>
            <p><?php echo lang('copyright'); ?></p>
            <style type="text/css">
                #navbar-logo{
                    display: none;
                }
            </style>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                $(document).ready(function () {
                    $('#myCarousel').carousel({
                        interval: 10000
                    })
                });
            </script>
        </footer>
</html>
