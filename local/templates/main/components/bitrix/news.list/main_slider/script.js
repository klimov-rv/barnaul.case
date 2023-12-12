$(function(){
    const mainSwiper = new Swiper('.x3-slider__wrap', {
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

    mainSwiper.on('slideChange', function () {
        $(".x3-slider__active").text( PrependZeros(this.realIndex + 1, 2) );
        $(".x3-slider__count").text( PrependZeros(this.el.childElementCount-2, 2) );
        $(".x3-slider__total").text( PrependZeros(this.el.childElementCount-2, 2) );
    });

    // ���������� �������� ����
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
});

