
<!--Footer-part-->
<!-- <div class="row-fluid">
  <div id="footer" class="span12"> 2017-2018 &copy; Good Music. Design by Salsar cybersolution</div> -->
</div>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script> 
<script type="text/javascript">var base_url = "<?php echo base_url(); ?>";</script>
<!-- Autocomplete google api -->
<script src="http://maps.googleapis.com/maps/api/js?libraries=places&region=in&key=AIzaSyCA6Z_vZLjsXJ77eBszOzgtdOMaz_tOCCE" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.ui.custom.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/jquery.uniform.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/matrix.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/matrix.tables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/wysihtml5-0.3.0.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ajaxfileupload.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/static/time-picker/dist/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckfinder/ckfinder.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>

<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/mycustom.js"></script>
<script>
    $('.textarea_editor').wysihtml5();

    $(document).ready(function () {
        //  $(".chzn-select").chosen();

        /////  MUSIC FORM VALIDATION
        $("#musicForm").validate({
            rules: {
                track_name: "required",
                album_track_number: "required",
                year: "required",
                //  language: "required",
//                category_id: {
//                    required: true,
//                }
            },
            messages: {
                track_name: "Please enter Track Name",
                album_track_number: "Please enter Track Number",
                year: "Please enter Year",
                //language: "Please enter your language",
//                category_id: {
//                    required: 'Please select at least 1 category.'
//                }
            }
        });
        /////   MUSIC FORM VALIDATION    

        /////   ALBUM FORM VALIDATION
        $("#albumForm").validate({
            rules: {
                album_name: "required",
                album_description: "required",
                //  language: "required",
            },
            messages: {
                album_name: "Please enter Album Name",
                 album_description: "Please enter Album Description",
                // language: "Please enter your language",
            }
        });
        /////   ALBUM FORM VALIDATION 
    });

    // Chosen validation
    $('.chosen-select').chosen();
    $.validator.setDefaults({ignore: ":hidden:not(select)"});

// validation of chosen on change
    if ($("select.chosen-select").length > 0) {
        $("select.chosen-select").each(function () {
            if ($(this).attr('required') !== undefined) {
                $(this).on("change", function () {
                    $(this).valid();
                });
            }
        });
    }

// validation

//  $('#musicForm').validate({
//        errorPlacement: function (error, element) {
//            console.log("placement");
//            if (element.is("select.chosen-select")) {
//                console.log("placement for chosen");
//                // placement for chosen
//                element.next("div.chzn-container").append(error);
//            } else {
//                // standard placement
//                error.insertAfter(element);
//            }
//        }
//    });
    
//    $('#albumForm').validate({
//        errorPlacement: function (error, element) {
//            console.log("placement");
//            if (element.is("select.chosen-select")) {
//                console.log("placement for chosen");
//                // placement for chosen
//                element.next("div.chzn-container").append(error);
//            } else {
//                // standard placement
//                error.insertAfter(element);
//            }
//        }
//    });
    
//      $('#musicUploadForm').validate({
//        errorPlacement: function (error, element) {
//            console.log("placement");
//            if (element.is("select.chosen-select")) {
//                console.log("placement for chosen");
//                // placement for chosen
//                element.next("div.chzn-container").append(error);
//            } else {
//                // standard placement
//                error.insertAfter(element);
//            }
//        }
//    });

</script>

<style>
    .error {
        color: red;
    }
</style>

</body>
</html>
