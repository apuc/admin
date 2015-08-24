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
                $('.published').each(function(){
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
        if($(this).parent().hasClass('noPublick')){
            $(this).parent().removeClass('noPublick');
            $(this).parent().addClass('published');
            $(this).text('Снять публикацию');
        }
        else {
            $(this).parent().removeClass('published');
            $(this).parent().addClass('noPublick');
            $(this).text('Опубликовать');
        }
        return false;
    });
});
