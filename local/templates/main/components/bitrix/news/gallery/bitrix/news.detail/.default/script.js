$(function(){
    // Magnific popup на дополнительные изображения
    $('.x3-object__photos').each(function() {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled:true
            }
        });
    });

    // Слайдер
    var objectSwiper = new Swiper('.x3-object__slider', {
        speed: 2000,
        effect: "fade",
        autoplay: {
            delay: 5000,
        },
        loop:true,
        pagination: {
            el: ".x3-slider__pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".x3-slider__next",
            prevEl: ".x3-slider__prev",
        },
    });

    objectSwiper.on('slideChange', function (e) {
        $(".x3-slider__active").text( PrependZeros(e.realIndex + 1, 2) );
        $(".x3-slider__count").text( PrependZeros(e.slides.length - 2, 2) );
        $(".x3-slider__total").text( PrependZeros(e.slides.length - 2, 2) );
    });

    // Добавление ведущего нуля
    var PrependZeros = function (str, len, seperator) {
        if (typeof str === 'number' || Number(str)) {
            str = str.toString();
            return (len - str.length > 0) ? new Array(len + 1 - str.length).join('0') + str : str;
        }
        else {
            var spl = str.split(seperator || ' ')
            for (var i = 0 ; i < spl.length; i++) {
                if (Number(spl[i]) && spl[i].length < len) {
                    spl[i] = PrependZeros(spl[i], len)
                }
            }
            return spl.join(seperator || ' ');
        }
    };

    // Высота блока с дополнительными изображениями равна 1 линии
    /*var photoHeight = $(".x3-object__photos a").eq(0).height();
    $(".x3-object__photos").css("maxHeight", photoHeight);

    $(".js-more-photo").click(function(){
        $(".x3-object__photos").toggleClass("_show");
        if($(".x3-object__photos._show").length) {
            $(this).find("span").text("Свернуть");
        }else{
            $(this).find("span").text("Развернуть");
        }
        return false;
    });*/
});

