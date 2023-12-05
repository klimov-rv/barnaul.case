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

});

document.addEventListener('DOMContentLoaded', () => {

    const pageHavePlayer = document.querySelector('.audio-player');

    if (pageHavePlayer) {// плейлист со страницы "Аудиоэкскурсий"
        var tabItems = document.querySelectorAll('.tabs-item');

        var playlist = []

        if (tabItems.length > 0) {
            tabItems.forEach((tabItem, id) => {

                if (tabItem.querySelector('AUDIO')) {
                    var audioItem = tabItem.querySelector('AUDIO');
                    playlist.push({
                        title: "audio in tab " + (parseInt(id) + 1),
                        file: audioItem.currentSrc,
                        howl: null
                    });
                } else {
                    playlist.push({
                        title: "skip audio in tab " + (parseInt(id) + 1),
                        file: 'skip',
                        howl: null
                    });
                }
            });
        }
        var player = new Player(playlist);
    }

    $('.js-tabs-controls').dataTabs({
        event: 'click',
        initOpenTab: false,
        pauseVideoAudio: false,
        state: 'accordion',
        jqMethodOpen: 'slideDown',
        jqMethodClose: 'slideUp',

        onTab: (self, $anchor, $target) => {
            // выключаем все видео в закрытых вкладках
            self.$targets.each(function (index, el) {
                if (el.classList.contains('is-tab-close') && el.querySelector('IFRAME')) {
                    var iframePrev = el.querySelector('IFRAME');
                    var fullSrc = iframePrev.getAttribute('srcfull');
                    var srcWithoutQuery = fullSrc.split('?')[0];
                    iframePrev.setAttribute("src", srcWithoutQuery + "?&amp;autoplay=0");
                };

                if (el.classList.contains('is-tab-active') && el.querySelector('IFRAME')) {
                    var iframeActive = el.querySelector('IFRAME');
                    var fullSrc = iframeActive.getAttribute('srcfull');
                    var srcWithoutQuery = fullSrc.split('?')[0]
                    console.log(srcWithoutQuery);
                    iframeActive.setAttribute("src", srcWithoutQuery + "?si=fDHed4vNyCrfZOGD&amp;autoplay=1");
                }

                if (el.classList.contains('is-tab-close') && el.querySelector('AUDIO')) {
                    player.pause();
                }
                if (el.classList.contains('is-tab-active') && el.querySelector('AUDIO')) {
                    player.pause();
                    player.skipTo(self.states.activeIndex);
                }
            });
            // var isAudio = skip.find((i) => i === self.states.activeIndex + 1 /* +1 потому что в индексе 0 - аудио по умолчанию */) === undefined;

            // player.pause(); 
        },
    });


    // доп кнопка "свернуть"
    var closeTabs = document.querySelectorAll('.tabs-close-btn');

    closeTabs.forEach((item, idx) => {
        item.addEventListener('click', e => {
            if (e.target.closest('.tabs-item')) {
                var currTab = e.target.closest('.tabs-item');
                currTab.querySelector('.js-accordion-item').click();
            }
        });
    });

    if ($('.image-slider').length > 0) {

        var setPagination = function (e) {
            var activeSlide = e.realIndex + 1;
            var totlaSlides = e.el.querySelectorAll('.swiper-slide').length;
            $(".swiper-active-slide").text(activeSlide);
            $(".swiper-count-slides").text(totlaSlides);
            $(".swiper-count-total").text(totlaSlides);
        }
        var mainSwiper = new Swiper(".image-slider", {
            slidesPerView: 1,
            slidesPerGroupSkip: 1,
            speed: 3000,
            autoplay: true,
            pauseOnMouseEnter: true,
            effect: "fade",

            scrollbar: {
                el: '.image-slider .swiper-scrollbar',
            },
            pagination: {
                el: '.image-slider .swiper-fractions',
                type: 'fraction',
            },
            navigation: {
                nextEl: '.image-slider .swiper-button-next',
                prevEl: '.image-slider .swiper-button-prev',
            },
            on: {
                init: function () {
                    setPagination(this);
                },
            },
        });

        mainSwiper.on('slideChange', function () {
            setPagination(this);
        });
    }

});
