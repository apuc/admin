$(function () {
    $('.content').insertBefore('.hfooter');
    $('.content p:gt(0)').hide();
    $('.content .readmore').click(function () {
        if ($(this).hasClass('active')) {
            $('.content p:gt(0)').slideUp('fast');
            $(this).removeClass('active').text('Читать полностью');
        } else {
            $('.content p:gt(0)').slideDown('fast');
            $(this).addClass('active').text('Свернуть');
        }
        return false;
    });
    $(document).click(function(event) {
        if ($(event.target).closest(".text.active").length) return;
        $('.text .readmore.active').click();
        event.stopPropagation();
    });
    $('.text .readmore').click(function () {
        var text = $(this).closest('.text');
        if ($(this).hasClass('active')) {
            text.find('.fulltext').slideUp('fast',function(){
                text.removeClass('active');
            });
            $(this).removeClass('active').text('Читать полностью');
        } else {
            $('.text .readmore.active').click();
            text.addClass('active');
            text.find('.fulltext').slideDown('fast');
            $(this).addClass('active').text('Свернуть');
        }
        return false;
    });
   $('.topblock form input[type="text"],.advantages.inner form input[type="text"]').mask("+7 (999) 999-99-99");
    $('.products-line .category').hover(function () {
        var category = $(this);
        if (category.hasClass('top-left'))
            $('.products .categories .top-left').show();
        else if (category.hasClass('top-right'))
            $('.products .categories .top-right').show();
        else if (category.hasClass('bottom-left'))
            $('.products .categories .bottom-left').show();
        else if (category.hasClass('bottom-center'))
            $('.products .categories .bottom-center').show();
        else if (category.hasClass('bottom-right'))
            $('.products .categories .bottom-right').show();
        $('.products .bg').show();
    });
    $('.products .categories .category-content').mouseleave(function () {
        $('.products .categories .category-content,.products .bg').hide();
    });
    var overflowtimeout;

    function setOverflow(block, status) {
        $(block).css('overflow', status);
    }

    $('.catalog .catalog_blocks .category').hover(function () {
        var block = $(this);
        overflowtimeout = setTimeout(function () {
            setOverflow(block, 'visible');
        }, 300);
    }, function () {
        $(this).css('overflow', 'hidden');

        var wrapper = $(this).find('.list_wrapper');
        var button = $(this).find('.showall');
        var height = 193;
        var top = 0;
        wrapper.css('top','');
        wrapper.find('.product:gt(3)').slideUp('fast');
        button.html('показать все').css('margin-right','');
        wrapper.removeClass('active');
        
        clearTimeout(overflowtimeout);
    });
    $('.page .title .hidepage').click(function () {
        $('.text .readmore.active').click();
        var title = $(this).closest('.title');
        var span = title.find('span');
        var spantext = span.text();
        var page = $(this).closest('.page').find('.item');
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            span.html(spantext.replace('(скрыта)', ''));
            $(this).text('Скрыть');
            page.slideDown('fast');
        } else {
            $(this).addClass('active');
            span.html(spantext + ' (скрыта)');
            $(this).text('Показать');
            page.slideUp('fast');
        }
        return false;
    });
    $('.tooltip').tooltipster({
        delay: 0,
        speed: 0,
        interactive: true,
        minWidth: 300,
        maxWidth: 300
    });
    $('.clients .carousel').jcarousel();
    $('.clients .next').click(function () {
        $('.clients .carousel').jcarousel('scroll', '+=1');
        return false;
    });
    $('.clients .prev').click(function () {
        $('.clients .carousel').jcarousel('scroll', '-=1');
        return false;
    });
    $('.category_page .page .item .right .select').click(function(){
            $('.text .readmore.active').click();
        $('.popup').css('top',$(window).scrollTop());
        $('.popup,.background').fadeIn('fast');
        return false;
    });
    $('.background,.popup .close').click(function(){
        $('.popup,.background').fadeOut('fast');
        return false;
    });

    $('.list_wrapper').each(function(){
        $(this).find('.product:gt(3)').hide();
    });
    $('.list_wrapper .showall').click(function(){
        var wrapper = $(this).closest('.list_wrapper');
        if (wrapper.hasClass('active')) {
            var height = 193;
            var top = 0;
            wrapper.css('top','');
            wrapper.find('.product:gt(3)').slideUp('fast');
            $(this).html('показать все').css('margin-right','');
            wrapper.removeClass('active');
        } else {
            var height = wrapper.find('.product').length*36+49;
            var top = 193-height;
            wrapper.css('top',top);
            wrapper.find('.product:gt(3)').slideDown('fast');
            $(this).html('свернуть').css('margin-right',25);
            wrapper.addClass('active');
        }
        return false;
    });
});