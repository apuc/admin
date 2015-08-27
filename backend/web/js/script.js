/**
 * Created by Кирилл on 18.08.2015.
 */
$(document).ready(function () {

    $("#myTab a").click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $(function () {
        $("#sortable").sortable({
            cancel: '.empty',
            cursor: 'move',
            stop: function (event, ui) {
                var el = ui.item.context;
                var parentId = $(el).parent().parent().attr('data-id');
                var id = $(el).attr('data-id');

                $(el).attr('data-parent-id', parentId);

                $.ajax({
                    type: "GET",
                    url: 'update_el',
                    data: "id=" + id + "&parent_id=" + parentId,
                    success: function (msg) {
                        //console.log(msg);
                    }
                });


                var all = $(el).parent('#sortable');
                console.log(all.context);
                $(all).each(function () {
                    console.log('123');
                });
            }
        });
        $("#sortable").disableSelection();

        $("#sort").sortable({
            cancel: '.empty',
            cursor: 'move',
            stop: function (event, ui) {
                var bloks = '';
                $('.published').each(function () {
                    bloks = bloks + ',' + $(this).attr('data-type');
                });
                bloks = bloks.substring(1);
                $('.sortBlock').val(bloks);
            }
        });
        $("#sort").disableSelection();

        /*$("#sortable_1").sortable({
         connectWith: '#sortable_2',
         connectWith: '#sortable_3'
         });
         $("#sortable_1").disableSelection();*/

        /*$(".sortable").sortable();
         $(".sortable").disableSelection();*/
    });

    $('.imgPrev').on('click', function () {
        var val = $(this).next().val();
        $('#menu-icon').val(val);
        $('#myModal').modal('hide');
        $("#imgPreview").html('');
        $(this).clone().prependTo("#imgPreview");
    });

    $(document).on('click', '.imgPrev', function () {
        var val = $(this).next().val();
        $('#pages-images').val(val);
        $('#myModal').modal('hide');
        $("#imgPreview").html('');
        $(this).clone().prependTo("#imgPreview");
    });
    $(document).on('click', '.imgPrev', function () {
        var val = $(this).next().val();
        $('#category-images').val(val);
        $('#myModal').modal('hide');
        $("#imgPreview").html('');
        $(this).clone().prependTo("#imgPreview");
    });
    $('.imgPrev').on('click', function () {
        var val = $(this).next().val();
        $('#supplies-images').val(val);
        $('#myModal').modal('hide');
        $("#imgPreview").html('');
        $(this).clone().prependTo("#imgPreview");
    });

    $(document).on('click', '.imgPrev', function () {
        var val = $(this).next().val();
        $('#supplies-images').val(val);
        $('#myModal').modal('hide');
        $("#imgPreview").html('');
        $(this).clone().prependTo("#imgPreview");
    });

    $('#htmlForm').ajaxForm({
        success: function (data) {
            $('.mediaWrap').html(data);
        }
    });

    $('#supplies-color').on('change', function () {
        var color = $('#supplies-color option:selected').text();
        if ($(this).val() == '0') {
            $('#colorP').css({'background-color': '#fff'});
        }
        else {
            $('#colorP').css({'background-color': color});
        }
    });

    $('#specialBlockToggle').on('click', function () {
        $('#specialBlock').slideToggle('slow');
    });

    $('.toPublick').on('click', function () {
        if ($(this).parent().hasClass('noPublick')) {
            $(this).parent().removeClass('noPublick');
            $(this).parent().addClass('published');
            $(this).text('Снять публикацию');
        }
        else {
            $(this).parent().removeClass('published');
            $(this).parent().addClass('noPublick');
            $(this).text('Опубликовать');
        }
        var bloks = '';
        $('.published').each(function () {
            bloks = bloks + ',' + $(this).attr('data-type');
        });
        bloks = bloks.substring(1);
        $('.sortBlock').val(bloks);
        return false;
    });

    $(document).on('click', '.PrevImg', function () {
        var val = $(this).next().val();
        $('#supplies-images').val(val);
        $('#myModal').modal('hide');
        $("#imgPreview").append('<div class="imgadd"><img class="PrevImg" src="' + val + '" width="150px" alt="" /><input type="hidden" id="#valimg"  name="blind_image[]" value="' + val + '*0"><a class="del_img" href = "#">Удалить</a><a href = "#" class = "osn">Сделать основным</a></div');
        //$(this).clone().prependTo("#imgPreview");
    });

    $(document).on('click', '.osn', function () {
        $('.imgadd').each(function(){
            var v = $(this).children('input').val();
            v = v.slice(0,-2);
            v = v + "*0";
            $(this).children('input').val(v);
        });
        var value = $(this).prev().prev().val();
        value = value.slice(0,-2);
        value = value + "*1";
        $(this).prev().prev().val(value);
        $('.osn').html('Сделать основным');
        $(this).html('Основное');

        return false;
    });

    $(document).on('click', '.del_img', function () {
        /*$(this).prev().prev().remove();
        $(this).prev().remove();
        $(this).next().remove();
        $(this).remove();*/
        $(this).parent().remove();
        return false;
    });
    $(document).on('click', '.del_img_pages', function () {
        $('#imgPreview').html("<div class='imgEmpty'>Изображение</div>");
        $('#pages-images').val('');
        $('#category-images').val('');
        $('#supplies-images').val('');
        return false;
    });

    $(document).on('click', '#addTitle', function () {
        var title = $('#titleB').val();
        var id = $('#selmat').val();
        var val = $('#selmat :selected').text();
        $('#myModal2').modal('hide');
        $('#titleB').val('');
        console.log(val);
        $('#addinp').append('<div style = "margin-top:5px;">' + title + ' заголовок будет вставлен перед ' + val + '<input type="hidden" name="blindTitle[]"  value="' + id + '*' + title + '"/> | <a href="#" id="delTitle">Удалить</a> </div>');
    });

    $(document).on('click', '#delTitle', function () {
        $(this).parent().remove();
        return false;
    });

});
