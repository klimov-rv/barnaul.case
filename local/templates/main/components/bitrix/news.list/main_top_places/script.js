$(function(){

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

    // Заполнении панели пагинации
    var setPagination = function(e) {
        var activeSlide = parseInt(e.realIndex / e.params.slidesPerGroup) + 1;
        var totlaSlides = Math.ceil((e.slides.length - 2 * e.params.slidesPerGroup) / e.params.slidesPerGroup);
        $(".x3-b-slider__active").text( PrependZeros(activeSlide, 2) );
        $(".x3-b-slider__count").text( PrependZeros(totlaSlides, 2) );
        $(".x3-b-slider__total").text( PrependZeros(totlaSlides, 2) );
    }

    const bSwiper = new Swiper('.x3-b-slider', {
        slidesPerView: 1,
        spaceBetween: 15,
        slidesPerGroup: 1,
        freeMode: true,
        loop: true,
        speed: 1500,
        pagination: {
            el: ".x3-b-slider__pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".x3-b-slider__next",
            prevEl: ".x3-b-slider__prev",
        },
        breakpoints: {
            540: {
                slidesPerView: 2,
                slidesPerGroup: 2,
                spaceBetween: 32,
            },
            980: {
                slidesPerView: 3,
                slidesPerGroup: 3,
                spaceBetween: 32,
            },
        },
        on: {
            init: function () {
                setPagination(this);
            },
            slideChange: function () {
                setPagination(this);
            },
        },
    });

});

