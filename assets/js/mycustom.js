$(document).ready(function () {

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

    $(document).on('change', '#userfile', function () {
        readURL(this);
        $.ajaxFileUpload({
            url: base_url + 'album/album_image',
            secureuri: false,
            fileElementId: 'userfile',
            // dataType: 'json',
            success: function (data, status) {
                console.log(data);
                if (data.status != 'Error')
                {
                    $('#album_image').val(data.msg);
                    swal("Album Image successfully saved", "", "success");
                } else {
                    swal(data.msg);
                }
            }
        });
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#show_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('click', '.delete_entry', function () {
        var id = $(this).attr('data-attr');
        var name = $(this).attr('data-tablename');
        var parent = $(this).parent().parent();
        swal({
            title: "Are you sure?",
            text: 'To Delete',
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Delete it!",
            cancelButtonText: "No, Cancel !",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: base_url + 'home/delete_entry',
                            type: "POST",
                            data: ({id: id, name: name}),
                            success: function (data) {
                                if (data == 1) {
                                    parent.remove();
                                    swal("Deleted!", "Entry has been deleted.", "success");
                                } else {
                                    swal("Cancelled", data, "error");
                                }
                            }
                        });
                    } else {
                        swal("Cancelled", "Your entry is safe :)", "error");
                    }
                });
    });

    $(document).ready(function () {
        $(".dataTables_processing").html('No data found in the server');
        var parent = '';
        $('#forgetsubmit').click(function (event) {
            event.preventDefault();
            var email = $("#email_id").val();
            $.ajax({
                url: base_url + 'login/forgotpass',
                type: "POST",
                dataType: 'json',
                data: ({email: email}),
                success: function (response) {
                    if (response.status == 'error') {
                        $("#errorMsg").removeClass('text-success');
                        $("#errorMsg").addClass('text-danger');
                        $("#errorMsg").html(response.msg);
                    } else if (response.status == 'success') {
                        $("#errorMsg").removeClass('text-danger');
                        $("#errorMsg").addClass('text-success');
                        $("#errorMsg").html(response.msg);
                    }
                }
            });
            return false;
        });
    });

    $('.checkbox').on('click', function () {
        // alert('test hello');
        var tracks = [];
        var inter = [];
        var album = [];
        var category = [];
        var yearrange = $("#amount").val();

        var years = yearrange.split(" - ");
        var yearafter = years[0];
        var yearbefore = years[1];
//            $.each($("input[name='tracktype']:checked"), function(){            
//                tracks.push($(this).val());
//            });
        $('input:checkbox[name=tracktype]:checked').each(function ()
        {
            tracks.push($(this).val());
        });

        $('input:checkbox[name=interpret]:checked').each(function ()
        {
            inter.push($(this).val());
        });

        $('input:checkbox[name=album]:checked').each(function ()
        {
            album.push($(this).val());
        });

        $('input:checkbox[name=category]:checked').each(function ()
        {
            category.push($(this).val());
        });
        //  alert("Selection are: " + tracks.join(", ")+ inter.join(", "));
        $.ajax({
            //  url: '<?php echo base_url();?>admin/searchresults',
            url: base_url + 'home/searchresults',
            type: "POST",
            //   dataType: 'json',
            data: ({tracks: tracks, inter: inter, album: album, category: category, yearafter: yearafter, yearbefore: yearbefore}),
            success: function (result) {
                // console.log(result);
//                 $.each(result, function (index, value) {
//                });
                $("#musictrack").empty();
                // var obj =  JSON.stringify(result);
                var obj2 = jQuery.parseJSON(result);
                //alert(obj2.filtereddats);
                $("#musictrack").html(obj2.searchresult);
            },
            error: function (error) {
                console.log(error);
            }
        });

        if ($('.myAllCheckBox').is(":checked")) {
            $('#resetCheckbox').css('display', 'block');
        } else {
            $('#resetCheckbox').css('display', 'none');
        }
    });

    $('#resetCheckbox').on('click', function () {
        // $('input[type="checkbox"]').attr('checked', false);
        $('input[type="checkbox"]:checked').each(function ()
        {
            // alert($(this).val());
            //  $(this).removeAttr('checked');
            //$(this).attr('checked', false);
//             $('input:checkbox').removeAttr('checked');
            $('input').filter(':checkbox').prop('checked', false);
            location.reload();
        });
//input[type="checkbox"]:checked + .label-text::before
    });

    $("#keySearch").keyup(function () {
        $.ajax({
            url: base_url + 'home/GetByKeywordNew',
            type: "POST",
            data: {
                keyword: $("#keySearch").val()
            },
            success: function (html) {
                // console.log(html);
                if (html != '') {
                    $('#DropdownKeySearch').empty();
                    //$('#keySearch').attr("data-toggle", "dropdown");
                    //$('#DropdownKeySearch').dropdown('toggle');
                    $('#DropdownKeySearch').show();
                    //$('#DropdownKeySearch').html(html);
                    var obj2 = jQuery.parseJSON(html);
                    //alert(obj2.filtereddats);
                    $("#DropdownKeySearch").html(obj2.datas);
                }
            }
        });
    });

    $("body").mouseup(function () {
        $("#DropdownKeySearch").hide();
    });

    $('ul.txtKeySearch').on('click', 'li a', function () {
        $('#keySearch').val($(this).text());
    });
});

$('.countcheck').on('click', function () {
    var tracks = [];
    var inter = [];
    var album = [];
    var category = [];
    var yearrange = $("#amount").val();

    var years = yearrange.split(" - ");
    var yearafter = years[0];
    var yearbefore = years[1];

    //            $.each($("input[name='tracktype']:checked"), function(){            
    //                tracks.push($(this).val());
    //            });
    $('input:checkbox[name=tracktype]:checked').each(function ()
    {
        tracks.push($(this).val());
    });

    $('input:checkbox[name=interpret]:checked').each(function ()
    {
        inter.push($(this).val());
    });

    $('input:checkbox[name=album]:checked').each(function ()
    {
        album.push($(this).val());
    });

    $('input:checkbox[name=category]:checked').each(function ()
    {
        category.push($(this).val());
    });
    //  alert("Selection are: " + tracks.join(", ")+ inter.join(", "));
    $.ajax({
        //  url: '<?php echo base_url();?>admin/searchresults',
        url: base_url + 'home/searchcount',
        type: "POST",
        //   dataType: 'json',
        data: ({tracks: tracks, inter: inter, album: album, category: category, yearafter: yearafter, yearbefore: yearbefore}),
        success: function (result) {
            // console.log(result);
            // $.each(result, function (index, value) {
            // });
            $("#musictrack").empty();
            $("#musictrack").html(result);
        },
        error: function (error) {
            console.log(error);
        }
    });
});