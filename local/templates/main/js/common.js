$(function(){
    // Фиксация шапки при прокрутке
    var $element = $('.site-header');
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        var headerHeight = ($(window).width() < 1460) ? 91 : 125;

        if (scroll > headerHeight) {
            $element.addClass("header-main--fixed");
        } else {
            $element.removeClass("header-main--fixed");
        }
    });

    // Перенос кнопки "Свяжитесь с нами" при ресайзе
    resizedw();
    function resizedw(){
        if ($(window).width() < 1460) {
            $( $(".x3-header__btn .x3-btn")).appendTo( ".x3-tmenu__btn" );
        } else {
            $( $(".x3-tmenu__btn .x3-btn")).appendTo( ".x3-header__btn" );
        }
    }
    var doit;
    window.onresize = function(){
        clearTimeout(doit);
        doit = setTimeout(resizedw, 100);
    };

    // Обернуть все таблицы с классом .table-scroll в div.table-scroll (прокрутка на мобильных)
    $("table.table-scroll").each(function(){
        $(this).wrapAll("<div class='table-scroll'></div>");
    });

    // Прокручивает страницу вверх при нажатии на кнопку
    $(window).scroll(function() {
        var height = $(window).scrollTop();
        if (height > 100) {
            $('#x3Top').fadeIn();
        } else {
            $('#x3Top').fadeOut();
        }
    });
    $(document).ready(function() {
        $("#x3Top").click(function(event) {
            event.preventDefault();
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        });

    });

});