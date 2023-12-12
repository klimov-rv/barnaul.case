$(function () {
    // Magnific popup на дополнительные изображения
    $('.x3-object__photos').each(function () {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled: true
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
        loop: true,
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
        $(".x3-slider__active").text(PrependZeros(e.realIndex + 1, 2));
        $(".x3-slider__count").text(PrependZeros(e.slides.length - 2, 2));
        $(".x3-slider__total").text(PrependZeros(e.slides.length - 2, 2));
    });

    // Добавление ведущего нуля
    var PrependZeros = function (str, len, seperator) {
        if (typeof str === 'number' || Number(str)) {
            str = str.toString();
            return (len - str.length > 0) ? new Array(len + 1 - str.length).join('0') + str : str;
        }
        else {
            var spl = str.split(seperator || ' ')
            for (var i = 0; i < spl.length; i++) {
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

document.addEventListener('DOMContentLoaded', () => {
    //popup gallery
    $('.popup-with-zoom-anim').click(function () {
        if ($('.gallery-slider').length > 0) {

            // TODO: пофиксить слайдер по первому открытию попапа magnific (не всегда инициализируется верно)

            function lazyInitSwiper() {
                var setPagination = function (e) {
                    var activeSlide = e.realIndex + 1;
                    var totlaSlides = e.el.querySelectorAll('.swiper-slide').length;
                    $(".swiper-active-slide").text(activeSlide);
                    $(".swiper-count-slides").text(totlaSlides);
                    $(".swiper-count-total").text(totlaSlides);
                }

                var gallerySwiper = new Swiper(".gallery-slider", {
                    init: false,
                    speed: 1000,
                    lazy: true,
                    slidesPerView: "auto",
                    spaceBetween: 30,
                    loop: false,
                    scrollbar: {
                        el: '.gallery-slider .swiper-scrollbar',
                    },
                    pagination: {
                        el: '.gallery-slider .swiper-fractions',
                        type: 'fraction',
                    },
                    navigation: {
                        nextEl: '.gallery-slider .swiper-button-next',
                        prevEl: '.gallery-slider .swiper-button-prev',
                    },
                    on: {
                        init: function () {
                            setPagination(this);
                        },
                    },
                });

                gallerySwiper.on('slideChange', function () {
                    setPagination(this);
                });

                function waitSwiper() {
                    gallerySwiper.init();
                    gallerySwiper.pagination.update();
                    if (!gallerySwiper.$el[0].classList.contains('showin')) {
                        gallerySwiper.$el[0].classList.add('showin');
                    }
                }
                setTimeout(waitSwiper, 350);
            }
            setTimeout(lazyInitSwiper, 350);
        }
    });

    // audio player
    var elms = ['track', 'timer', 'duration', 'playBtn', 'pauseBtn', 'prevBtn', 'nextBtn', 'playlistBtn', 'volumeBtn', 'progress', 'startbar', 'wave', 'loading', 'playlist', 'list', 'volume', 'barEmpty', 'barFull', 'sliderBtn'];
    elms.forEach(function (elm) {
        window[elm] = document.getElementById(elm);
    });
    
    var audioSrc = document.querySelector('.data-audio-src').getAttribute('data-audio-src');
    var player = new Player([
        {
            title: 'audio',
            file: audioSrc,
            howl: null
        },
    ]);

    // Bind our player controls.
    playBtn.addEventListener('click', function () {
        player.play();
    });
    startbar.addEventListener('click', function () {
        player.play();
    });
    pauseBtn.addEventListener('click', function () {
        player.pause();
    });

});
