/**
 * Created by Кирилл on 18.08.2015.
 */
$(document).ready(function () {

    $("#myTab a").click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        if($('#pages-tab').length > 0){
            $('#pages-tab').val($(this).attr('href'));
        }
        if($('#category-tab').length > 0){
            $('#category-tab').val($(this).attr('href'));
        }
        if($('#blindform-tab').length > 0){
            $('#blindform-tab').val($(this).attr('href'));
        }
    });

    $(function () {
        $("#sortable").sortable({
            cancel: '.empty, .edit_menu',
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

                var str = '';
                $('.sortitem').each(function(){
                    str = str + "," +$(this).attr('data-id')

                });
                str = str.substring(1);
                $.ajax({
                    type: "GET",
                    url: 'save_sort',
                    data: "sort=" + str ,
                    success: function (msg) {
                        //console.log(msg);
                    }
                });
                //$('.first, .end').css({'display':'none'});
            },
            /*start: function (event, ui) {
                //var next = ui.next();
                console.log(event);
            },
            change: function(event, ui){
                console.log(event.target);
            }*/
        });
        $("#sortable").disableSelection();

        $("#sort").sortable({
            cancel: '.empty, .indBlockContainer',
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

    /*$('#sortable').bind('DOMNodeInserted DOMNodeRemoved', function(event) {
        //var blockId = $(this).attr('data-id');
        $(this).children().css({'border-top':'1px solid black'});
        console.log($(this).children());
    });*/

    $(document).on('click','.imgPrev', function () {
        var val = $(this).next().val();
        $('#menu-icon').val(val);
        $('#myModal').modal('hide');
        $("#imgPreview").html('');
        $(this).clone().prependTo("#imgPreview");
    });

    $('.imgPrevPage').on('click', function () {
        var val = $(this).next().val();
        $('#pages-images').val(val);
        $('#myModal').modal('hide');
        $("#imgPreview").html('');
        //console.log($(this).clone());
        $(this).clone().prependTo("#imgPreview");
    });
    $('.imgPrevCat').on('click', function () {
        var val = $(this).next().val();
        $('#category-images').val(val);
        $('#myModal').modal('hide');
        $("#imgPreview").html('');
        $(this).clone().prependTo("#imgPreview");
    });

    $('.imgPrevMenu').on('click', function () {
        var val = $(this).next().val();
        $('#category-images').val(val);
        $('#myModal').modal('hide');
        $("#imgPreview").html('');
        $(this).clone().prependTo("#imgPreview");
    });
    $('.imgPrevMenuC').on('click', function () {
        var val = $(this).next().val();
        $('#category-images').val(val);
        $('#myModal').modal('hide');
        $("#imgPreview").html('');
        $(this).clone().prependTo("#imgPreview");
    });
    $(document).on('click','.imgPrev', function () {
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
        $("#imgPreview").append('<div class="imgadd"><img class="PrevImg" src="' + val + '" width="150px" alt="" /><input type="hidden" id="#valimg"  name="blind_image[]" value="' + val + '*0"><a class="del_img btn btn-warning" href = "#">Удалить</a><a href = "#" class = "osn btn btn-warning">Основное</a></div');
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
        $('.osn').html('Основное');
        $('.osn').removeAttr('disabled');
        $('.osn').removeClass('btn-default');
        $('.osn').addClass('btn-warning');



        $(this).html('Основное');
        $(this).removeClass('btn-warning');
        $(this).addClass('btn-default');
        $(this).attr('disabled','disabled');

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
        $('#t_' + idPag).append('<tr class="itemPage" page-id="' + idPag + '" materials-id="' + title + '" item-type="zagolovok"><td colspan="7">' + title + '</td><td><a class="delSuplies" href="#">Удалить</a></td></tr>');
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

           // $('#myTab1').append('<li class="active"><a href="#panel' + linkName + '">' + val + '</a><span page-id="' + linkName + '" class="delPages">x</span></li>');
            $('#myTab1').append('<li class="active"><a href="#panel' + linkName + '"><input id-page="' + linkName + '" type="text" class="insetName" value="' + val + '" /></a><span page-id="' + linkName + '" class="delPages">x</span></li>');
            $('#divTabContent').append('<div id="panel' + linkName + '" class="tabPanel activeMy"><h3>' + val + '</h3><table class="table table-bordered" id="t_' + linkName + '"></table><a page-id="' + linkName + '"data-toggle="modal" data-target="#myModal4" href="#" class="attachMaterialList">Прикрепить материалы списком</a> | <a page-id="' + linkName + '"data-toggle="modal" data-target="#myModal3" href="#" class="attachMaterial">Прикрепить материал</a> | <a class="attachZag" data-toggle="modal" data-target="#myModal2" href = "#" page-id="' + linkName + '">Добавить заголовок</a><div id="publishMaterials' + linkName + '"></div><input id="input_' + linkName + '" type="hidden" name="infoPage[]" value="' + linkName + '"></div>');
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
        return false;
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
        $(this).parent().parent().clone().appendTo('#t_' + pageId);
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
        return false;
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
                    $('#sort').append('<li class="published" data-type="ind_' + msg + '">Индивидуальный блок (' + name + ') | <a class="editIndBlock" data-block-id="' + msg + '" href="#">Редактировать</a> | <a class="delCustBlock" href="#">Удалить</a></li>');
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

                    $('#indBlockName').val('');
                    $('#indBlockCode').val('');
                    $('#indBlockStyle').val('');
                    alert('Блок добавлен.');
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
        if(confirm('Удалить блок?')){
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
        }
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

    $(document).on('click','.imgPrev', function () {
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

    //редактирование индивидуальных блоков
    $(document).on('click','.editIndBlock', function(){
        var block_id = $(this).attr('data-block-id');
        var block = $(this).parent();

        $.ajax({
            url: '/secure/create_block_form',
            type: 'POST',
            data: {blockId: block_id},
        })
        .done(function(e) {
           // console.log(e);
            if($('.indBlockContainer').length > 0){
                $('.indBlockContainer').remove();
            }
            block.append(e);
        })
        .fail(function() {
            console.log("error");
        })

        return false;
    })
    //сохраняем изменения в индивидуальном блоке
    $(document).on('click','.saveBtn', function(){
        var style = $(this).prev().val();
        var code = $(this).prev().prev().val();
        var id = $(this).attr('data-block-id');

        $.ajax({
            url: '/secure/save_block_form',
            type: 'POST',
            data: {
                blockId: id,
                blockStyle: style,
                blockCode: code},
        })
        .done(function() {
            // console.log(e);
            $('.indBlockContainer').remove();
        })
        .fail(function() {
            console.log("error");
        })
    })

    $(document).on('click','.cancelBtn', function(){
        if($('.indBlockContainer').length > 0){
            $('.indBlockContainer').remove();
        }
    });

    $('.undock').on('click', function(){
        var idMat = $(this).attr('id-mat');
        var idPage = $(this).attr('id-page');
        $(this).parent().remove();
        $.ajax({
            type: "GET",
            url: 'change_sup',
            data: "id_mat=" + idMat + "&id_page=" + idPage,
            success: function (msg) {
                console.log(msg);
            }
        });
        return false;
    });


     $('#insetName').on('click', function(){
        return false;
    });

    $('.allBlindToSuplies').on('click', function(){
        $(this).prev().slideToggle('slow');
        $(this).text('Скрыть');
        return false;
    });

    /*$('#insetName').bind('focusout', function(){
        alert('123');
        var val = $(this).val();
        var pageId = $(this).attr('id-page');
        $('#input_' + pageId).val(val);
        $('.itemPage').each(function () {
            var pId = $(this).attr('page-id');
            if (pageId == pId) {
                var mId = $(this).attr('materials-id');
                var iTp = $(this).attr('item-type');
                var valInp = $('#input_' + pageId).val();
                $('#input_' + pageId).val(valInp + '*' + mId + '_' + iTp);
            }
        });
        return false;
    });/*/

   /* $('.insetName').live('focusout', function(){
        alert('Вы нажали на элемент "foo"');
    });*/
    $(document).on('focusout','.insetName',function(){
        var val = $(this).val();
        val = val.replace(/\s+/g, '_');
        var pageId = $(this).attr('id-page');
        $('#input_' + pageId).val(val);
        $('.itemPage').each(function () {
            var pId = $(this).attr('page-id');
            if (pageId == pId) {
                var mId = $(this).attr('materials-id');
                var iTp = $(this).attr('item-type');
                var valInp = $('#input_' + pageId).val();
                $('#input_' + pageId).val(valInp + '*' + mId + '_' + iTp);
            }
        });
        return false;;
    });


    $(document).on('click','.attachMaterialList',function(){
        var id = $(this).attr('page-id');
        $('#curentPageIdListMat').attr('page-id',id);
    });

    $(document).on('click','#addArticleMaterials',function(){
        //alert('123');
        var val = $('.articleMaterials').val().replace(/\n/g, ",");

        var pageId = $('#curentPageIdListMat').attr('page-id');

        $.ajax({
            type: "GET",
            url: 'publ_materials',
            data: "val=" + val + "&id_page=" + pageId,
            success: function (msg) {
                $('#t_' + pageId).append(msg);
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
            }
        });
        $('.articleMaterials').val('');
        $('#myModal4').modal('hide');
        return false;
    });

    $('.selectOnecolorAlt').on('click', function(){
        var idColor = $(this).attr('color');
        var vColor = $(this).attr('color-v');
        $('#colorId').val(idColor);
        $(this).parent().slideToggle();
        $(this).parent().prev().css({'background':vColor});
        $(this).parent().prev().text('');
        //$('.form-control').focus();
        var e = jQuery.Event("keydown", { keyCode: 13 });    //enter
        jQuery(".form-control").trigger(e);

    });

    $('.option_item').bind('focusout', function () {
        var key = $(this).attr('data-key');
        var value = $(this).val();
        $.ajax({
            type: "GET",
            url: 'change_option',
            data: "val=" + value + "&key=" + key,
            success: function (msg) {
                console.log(msg);
            }
        });
    });

    $('.editMenu').on('click', function(){
        $('.edit_menu').remove();
        var id = $(this).attr('data-menu-id');
        var parent = $(this).parent();
        $.ajax({
            type: "GET",
            url: 'edit_menu',
            data: "id=" + id,
            success: function (msg) {
                //console.log(msg);
                parent.append(msg);
            }
        });
        return false;
    });

    $(document).on('click', '#saveMenu', function(){
        var id = $(this).attr('data-id');
        var name = $('#menu_name').val();
        var url = $('#menu_url').val();
        var descr = $('#menu_descr').val();
        var icon = $('.imgPrevMenu').attr('src');
        $.ajax({
            type: "GET",
            url: 'save_menu',
            data: "id=" + id + "&name=" + name + "&url=" + url + "&descr=" + descr + "&icon=" + icon,
            success: function (msg) {
                //console.log(msg);
                //parent.append(msg);
                $('.edit_menu').remove();
            }
        });
        return false;
    });

    $(document).on('click', '#closeMenu', function(){
        $('.edit_menu').remove();

        return false;
    });

    $('.insetName').keypress(function(key) {
        if((key.charCode == 92) ||(key.charCode == 47) || (key.charCode == 33) || (key.charCode == 64) || (key.charCode == 34) || (key.charCode == 35) || (key.charCode == 60) || (key.charCode == 62) || (key.charCode == 94) || (key.charCode == 42) || (key.charCode == 40) || (key.charCode == 41) || (key.charCode == 59) || (key.charCode == 58) || (key.charCode == 38)|| (key.charCode == 96) || (key.charCode == 126)|| (key.charCode == 63)|| (key.charCode == 124)|| (key.charCode == 44) || (key.charCode == 46) ||(key.charCode == 36) ||(key.charCode == 37)){
            alert('Символ запрещен к вводу.Символы /|,.!@#$%^&*():;~`\'\\ запрещены для ввода. Используйте знак №');
            return false;
        }
    });
    $('#blindform-pagename').keypress(function(key) {
        var array = [92,47,33,64];
        var k = key.charCode;
        if((key.charCode == 92) ||(key.charCode == 47) || (key.charCode == 33) || (key.charCode == 64) || (key.charCode == 34) || (key.charCode == 35) || (key.charCode == 60) || (key.charCode == 62) || (key.charCode == 94) || (key.charCode == 42) || (key.charCode == 40) || (key.charCode == 41) || (key.charCode == 59) || (key.charCode == 58) || (key.charCode == 38)|| (key.charCode == 96) || (key.charCode == 126)|| (key.charCode == 63)|| (key.charCode == 124)|| (key.charCode == 44) || (key.charCode == 46) ||(key.charCode == 36) ||(key.charCode == 37)){
            alert('Символ запрещен к вводу.Символы /|,.!@#$%^&*():;~`\'\\ запрещены для ввода. Используйте знак №');
            return false;
        }

    });

});

