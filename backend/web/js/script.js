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

    $(document).on('click', '.toPublick', function () {
        if ($(this).parent().hasClass('noPublick')) {
            $(this).parent().removeClass('noPublick');
            $(this).parent().addClass('published');
            $(this).text('Скрыть');
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

        var bloksAll = '';
        $('.sortAll').each(function () {
            bloksAll = bloksAll + ',' + $(this).attr('data-type');
        });
        bloksAll = bloksAll.substring(1);
        $('.sortBlockAll').val(bloksAll);
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
        $('.imgadd').each(function () {
            var v = $(this).children('input').val();
            v = v.slice(0, -2);
            v = v + "*0";
            $(this).children('input').val(v);
        });
        var value = $(this).prev().prev().val();
        value = value.slice(0, -2);
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
        $('#menu-icon').val('');
        return false;
    });

    $(document).on('click', '#addTitle', function () {
        var title = $('#titleB').val();
        $('#myModal2').modal('hide');
        $('#titleB').val('');
        var idPag = $('#curentPageIdTitle').attr('page-id');
        // $('#t_'+idPag).append('<tr class="itemPage" page-id="'+idPag+'" materials-id="'+title+'" item-type="zagolovok"><td colspan="7">'+title+'</td><td><a class="delSuplies" href="#">Удалить</a></td></tr>');
        $('#t_' + idPag).prepend('<tr class="itemPage" page-id="' + idPag + '" materials-id="' + title + '" item-type="zagolovok"><td colspan="7">' + title + '</td><td><a class="delSuplies" href="#">Удалить</a></td></tr>');
        var pageId = idPag;
        $('#input_' + pageId).val(pageId);
        $('.itemPage').each(function () {
            var pId = $(this).attr('page-id');
            if (pageId == pId) {
                var mId = $(this).attr('materials-id');
                var iTp = $(this).attr('item-type');
                var valInp = $('#input_' + pageId).val();
                $('#input_' + pageId).val(valInp + '*' + mId + '_' + iTp);
            }
        });

    });

    $(document).on('click', '.attachZag', function () {
        var id = $(this).attr('page-id');
        $('#curentPageIdTitle').attr('page-id', id);
        return false;
    });

    $(document).on('click', '#delTitle', function () {
        $(this).parent().remove();
        return false;
    });

    $('.targetBlanc').on('click', function () {
        window.open(this.href);
        return false;
    });

    $('#validMy').on('click', function () {
        $('#validMsg').html('');
        $('input').each(function () {
            var val = $(this).val();
            if (!val) {
                var label = $(this).prev().text();
                if (label != '') {
                    $('#validMsg').append('<div style="color: Red">Поле <b>' + label + '</b> не может быть пустым</div>');
                }
            }
        });
    });

    $(document).on('click', '#addPage', function () {
        var val = $('#blindform-pagename').val();
        if (val != '') {
            var linkName = val.replace(/\s+/g, '_');
            $('#myTab1 li').each(function () {
                $(this).removeClass('active');
            });
            $('.tabPanel').each(function () {
                //$(this).removeClass('in');
                $(this).removeClass('activeMy');
            });

            $('#myTab1').append('<li class="active"><a href="#panel' + linkName + '">' + val + '</a><span page-id="' + linkName + '" class="delPages">x</span></li>');
            $('#divTabContent').append('<div id="panel' + linkName + '" class="tabPanel activeMy"><h3>' + val + '</h3><table class="table table-bordered" id="t_' + linkName + '"></table><a page-id="' + linkName + '"data-toggle="modal" data-target="#myModal3" href="#" class="attachMaterial">Прикрепить материал</a> | <a class="attachZag" data-toggle="modal" data-target="#myModal2" href = "#" page-id="' + linkName + '">Добавить заголовок</a><div id="publishMaterials' + linkName + '"></div><input id="input_' + linkName + '" type="hidden" name="infoPage[]" value="' + val + '"></div>');
            $('#blindform-pagename').val('');
        }
        return false;
    });

    $(document).on('click', '.delPages', function () {
        var id = $(this).attr('page-id');
        $(this).parent().remove();
        $(this).remove();
        $('#panel' + id).remove();
        var k = 0;
        $('#myTab1 li').each(function () {
            if (k == 0) {
                $(this).addClass('active');
                var tabId = $(this).children('a').attr('href');
                $(tabId).addClass('activeMy');
            }
            k++;
        });
        $.ajax({
            type: "GET",
            url: 'del_page_blind',
            data: "id=" + id,
            success: function (msg) {
                //console.log(msg);
            }
        });
        return false;
    });

    $(document).on('click', '.pageLink li', function () {
        $('#myTab1 li').each(function () {
            $(this).removeClass('active');
        });
        $('.tabPanel').each(function () {
            $(this).removeClass('activeMy');
        });
        $(this).addClass('active');
        var tabId = $(this).children('a').attr('href');
        $(tabId).addClass('activeMy');
    });


    $(document).on('click', '.addSuplies', function () {
        var idMat = $(this).attr('id-materials');
        var pageId = $('#curentPageId').attr('page-id');
        $('#input_' + pageId).val(pageId);
        $(this).removeClass('addSuplies');
        $(this).addClass('delSuplies');
        $(this).parent().parent().addClass('itemPage');
        $(this).text('Открепить');
        $(this).parent().parent().attr('page-id', pageId);
        $(this).parent().parent().attr('materials-id', idMat);
        $(this).parent().parent().attr('item-type', 'materials');
        $(this).parent().parent().clone().prependTo('#t_' + pageId);
        $(this).parent().parent().removeClass('itemPage');
        $(this).removeClass('delSuplies');
        $(this).addClass('addSuplies');
        $(this).text('Прикрепить');
        // $('#publishMaterials'+pageId).append('<div class="itemPage" page-id="'+pageId+'" materials-id="'+idMat+'" item-type="materials"></div>');
        $('.itemPage').each(function () {
            var pId = $(this).attr('page-id');
            if (pageId == pId) {
                var mId = $(this).attr('materials-id');
                var iTp = $(this).attr('item-type');
                var valInp = $('#input_' + pageId).val();
                $('#input_' + pageId).val(valInp + '*' + mId + '_' + iTp);
            }
        });

        return false
    });

    $(document).on('click', '.delSuplies', function () {
        $(this).parent().parent().remove();
        var pageId = $(this).parent().parent().attr('page-id');
        $('#input_' + pageId).val(pageId);
        $('.itemPage').each(function () {
            var pId = $(this).attr('page-id');
            if (pageId == pId) {
                var mId = $(this).attr('materials-id');
                var iTp = $(this).attr('item-type');
                var valInp = $('#input_' + pageId).val();
                $('#input_' + pageId).val(valInp + '*' + mId + '_' + iTp);
            }
        });

    });

    $(document).on('click', '.attachMaterial', function () {
        var id = $(this).attr('page-id');
        $('#curentPageId').attr('page-id', id);
        return false;
    });


    $('#addCustBlock').on('click', function () {
        if ($('#pages-blokc_id').length > 0) {
            var blockId = $('#pages-blokc_id').val();
            var blockName = $('#pages-blokc_id :selected').text();
        }
        else {
            var blockId = $('#category-blokc_id').val();
            var blockName = $('#category-blokc_id :selected').text();
        }


        $('#sort').append('<li class="published sortAll" data-type="yes_' + blockId + '">' + blockName + ' | <a class="toPublick" href="#">Скрыть</a> | <a class="delCustBlock" href="#">Удалить</a></li>');
        var bloks = '';
        $('.published').each(function () {
            bloks = bloks + ',' + $(this).attr('data-type');
        });
        bloks = bloks.substring(1);
        $('.sortBlock').val(bloks);

        var bloksAll = '';
        $('.sortAll').each(function () {
            bloksAll = bloksAll + ',' + $(this).attr('data-type');
        });
        bloksAll = bloksAll.substring(1);
        $('.sortBlockAll').val(bloksAll);
        return false;
    });

    $('#addIndBlock').on('click', function () {
        var name = $('#indBlockName').val();
        var code = $('#indBlockCode').val();
        var style = $('#indBlockStyle').val();
        if (name != '') {
            $.ajax({
                type: "POST",
                url: '/secure/add_ind_block',
                data: "name=" + name + "&code=" + code + "&style=" + style,
                success: function (msg) {
                    $('#sort').append('<li class="published" data-type="ind_' + msg + '">Индивидуальный блок (' + name + ') | <a target="_blank" href="/secure/block/block/update?id=' + msg + '">Редактировать</a> | <a class="delCustBlock" href="#">Удалить</a></li>');
                    var bloks = '';
                    $('.published').each(function () {
                        bloks = bloks + ',' + $(this).attr('data-type');
                    });
                    bloks = bloks.substring(1);
                    $('.sortBlock').val(bloks);

                    var bloksAll = '';
                    $('.sortAll').each(function () {
                        bloksAll = bloksAll + ',' + $(this).attr('data-type');
                    });
                    bloksAll = bloksAll.substring(1);
                    $('.sortBlockAll').val(bloksAll);
                }
            });
        }
        else {
            alert('Поле имя не заполненно');
        }

        /*$('#sort').append('<li class="published" data-type="ind">Индивидуальный блок | <a class="delCustBlock" href="#">Удалить</a></li>');
         var bloks = '';
         $('.published').each(function () {
         bloks = bloks + ',' + $(this).attr('data-type');
         });
         bloks = bloks.substring(1);
         $('.sortBlock').val(bloks);*/
        return false;
    });

    /*$('#addCustBlock').on('click', function(){
     var blockId = $('#pages-blokc_id').val();
     var blockName = $('#pages-blokc_id :selected').text();
     $('#sort').append('<li class="published" data-type="yes_' + blockId + '">' + blockName + ' | <a class="delCustBlock" href="#">Удалить</a></li>');
     var bloks = '';
     $('.published').each(function () {
     bloks = bloks + ',' + $(this).attr('data-type');
     });
     bloks = bloks.substring(1);
     $('.sortBlock').val(bloks);
     return false;
     });*/

    $(document).on('click', '.delCustBlock', function () {
        $(this).parent().remove();
        var bloks = '';
        $('.published').each(function () {
            bloks = bloks + ',' + $(this).attr('data-type');
        });
        bloks = bloks.substring(1);
        $('.sortBlock').val(bloks);

        var bloksAll = '';
        $('.sortAll').each(function () {
            bloksAll = bloksAll + ',' + $(this).attr('data-type');
        });
        bloksAll = bloksAll.substring(1);
        $('.sortBlockAll').val(bloksAll);
        return false;
    });

    $('.codeInput').bind('focusout', function () {
        var val = $(this).val();
        var id = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: 'change_sup',
            data: "code_val=" + val + "&id=" + id,
            success: function (msg) {
                console.log(msg);
            }
        });
    });

    $('.priceInput').bind('focusout', function () {
        var val = $(this).val();
        var id = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: 'change_sup',
            data: "price_val=" + val + "&id=" + id,
            success: function (msg) {
                console.log(msg);
            }
        });
    });

    $('.widthInput').bind('focusout', function () {
        var val = $(this).val();
        var id = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: 'change_sup',
            data: "width_val=" + val + "&id=" + id,
            success: function (msg) {
                //console.log(msg);
            }
        });
    });

    $('.matSelect').on('change', function(){
        var val = $(this).val();
        var id = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: 'change_sup',
            data: "mat_val=" + val + "&id=" + id,
            success: function (msg) {
                console.log(msg);
            }
        });
    });

    $('.blindSelect').on('change', function(){
        var val = $(this).val();
        var id = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: 'change_sup',
            data: "blind_val=" + val + "&id=" + id,
            success: function (msg) {
                console.log(msg);
            }
        });
    });

    $('.selectColor').on('click', function(){
       $(this).next().slideToggle('slow');
    });

    $('.selectOnecolor').on('click', function(){
       var id = $(this).attr('data-id');
       var idSup = $(this).attr('data-sup-id');
        var color = $(this).attr('color');
        $(this).parent().prev().css({'background':color})
        $(this).parent().slideToggle('slow');
        $.ajax({
            type: "GET",
            url: 'change_sup',
            data: "color_val=" + id + "&id=" + idSup,
            success: function (msg) {
                console.log(msg);
            }
        });
    });

    $('.openModalSup').on('click', function(){
       var id = $(this).attr('data-sup-id');
        $('#selectImgId').attr('data-id', id);
    });

    $('.imgPrev').on('click', function () {
        var val = $(this).next().val();
        var id = $('#selectImgId').attr('data-id');
        $('#supImg_' + id).attr('src',val);
        $('#myModal').modal('hide');
        $("#imgPreview").html('');
        if($('.supImg').length > 0){
            $.ajax({
                type: "GET",
                url: 'change_sup',
                data: "img_val=" + val + "&id=" + id,
                success: function (msg) {
                    console.log(msg);
                }
            });
        }
    });

});

