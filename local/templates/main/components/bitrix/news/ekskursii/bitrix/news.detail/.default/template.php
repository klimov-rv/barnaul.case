<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
// \Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/objects-detail.css"));
// \Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/main-slider.css"));
// \Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/objects-slider.css"));

// $historical_obj_id = intval($arResult["PROPERTIES"]["HISTORICAL_LINE_ID"]["VALUE"]);
// $legend = $arResult["PROPERTIES"]["LEGEND"]["VALUE"]["TEXT"]; 
// console_log($coefficient); 

?>


<section class="audio-tours__obzor container row">
    <div class="cell-5 cell-12-lg ">
        <div class="audio-tours__player">
            <div class="audio-player-slot">
                <div class="audio-player headline__player">
                    <div id="loading"></div>
                    <div id="playBtn" class="audio-player__play">
                        <svg aria-hidden="true" width="45" height="45">
                            <use xlink:href="#player-play-btn"></use>
                        </svg>
                    </div>
                    <div id="pauseBtn" class="audio-player__pause">
                        <svg aria-hidden="true" width="45" height="45">
                            <use xlink:href="#player-pause-btn"></use>
                        </svg>
                    </div>
                    <div class="audio-player__info">
                        <div id="startbar" class="audio-player__startbar">
                            <span class="start_title">Слушать аудиоэкскурсию</span>
                        </div>
                        <!-- Audio Info -->
                        <div id="title">
                            <span id="track"></span>
                        </div>
                        <div class="progress-track">
                            <div id="progress"></div>
                        </div>
                        <div class="audio-player__footer progress-time">
                            <div id="timer">0:00</div>
                            <div id="duration">0:00</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="audio-player-controls">
                <div id="prevBtn"></div>
                <div id="nextBtn"></div>
            </div>
            <div class="audio-player-playlist">
                <div id="list"></div>
            </div>
        </div>
        <div class="audio-tours__text">
            Барнаул в конце 19 века стал крупным купеческим центром Сибири. История
            города того
            времени связана с фамилиями наиболее успешных купцов и предпринимателей. К их числу можно отнести династию
            Суховых. Суховы владели большой частью городской недвижимости, им принадлежали кирпичный, кожевенный и
            свечной заводы.
        </div>
        <div class="audio-tours__tabs">
            <div class="tabs-controls js-tabs-controls" data-tabs-container>
                <div class="tabs-item">
                    <button data-tab-anchor="1" type="button" name="button" class="js-accordion-item tabs-trigger">
                        <span class="accordion-title">Точка 1. Стелла трудовой доблести</span>
                        <span class="accordion-icon accordion-icon_play">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-audio-play"></use>
                            </svg>
                        </span>
                        <span class="accordion-icon accordion-icon_pause">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-audio-pause"></use>
                            </svg>
                        </span>
                        <span class="accordion-icon accordion-icon_youtube">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-youtube"></use>
                            </svg>
                        </span>
                        <span class="accordion-icon accordion-icon_rutube">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-rutube"></use>
                            </svg>
                        </span>
                    </button>
                    <div data-tab-target="1" class="tabs-target">
                        <div class="tab-media tab-media_hide" id="tab-media-1">
                            <audio src="https://html5book.ru/examples/media/track.mp3" controls loop>
                        </div>
                        <p>
                            Как парк эта территория возникла в Барнауле относительно недавно –
                            в тридцатые годы прошлого века. А уже в 1950-ых годах в парке была открыта сельскохозяйственная
                            выставка – Алтайская ВДНХ. Помимо выставочных павильонов здесь были созданы пруд, летний кинотеатр
                            и
                            кафе. После развала СССР выставка закрылась.
                        </p>
                        <p>
                            Сегодня Нагорный парк – одна из главных достопримечательностей города, наиболее популярное и
                            благоустроенное место для прогулок.
                            Но большую часть своей истории он провёл в совсем другом статусе…
                        </p>
                        <p>
                            После эпидемии чумы, разразившейся в России в 1771 году, указом Сената были запрещены похороны при
                            городских церквях. Местные власти приняли решение о создании нового, Нагорного кладбища, именно
                            здесь. Рядом разместились Татарское и Протестантское кладбища. Умерших хоронили как бесплатно,
                            так и за деньги. Плату взимали с тех. кто хотел похоронить родственника поближе к церкви. Храм,
                            который сегодня находится в парке, – это копия кирпичного, построенного вместо сгоревшей
                            деревянной
                            церкви в середине XIX века. Среди похороненных есть самоубийца, атеисты и даже женщина – сотрудник
                            ВЧК.
                        </p>
                        <p>
                            А еще раньше, в первые годы строительства города и до создания кладбища, здесь собирались строить
                            кремль для защиты от ДжунгАрского ханства. В итоге крепость построили на другом берегу Оби, в
                            Белоярске.
                        </p>
                        <p>
                            …Придя в Нагорный парк обязательно обратите внимание на большие буквы «БАРНАУЛ». К ним можно
                            подойти
                            и сфотографироваться! А если сделать на их фоне селфи, то надпись не исказится.
                        </p>
                        <div class="tabs-close-btn">
                            <span>Свернуть</span>
                            <svg aria-hidden="true" width="11" height="7">
                                <use xlink:href="#arrow-down-svg"></use>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="tabs-item">
                    <button data-tab-anchor="2" type="button" name="button" class="js-accordion-item tabs-trigger">
                        <span class="accordion-title">Точка 2. Объект такой</span>
                        <span class="accordion-icon accordion-icon_play">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-audio-play"></use>
                            </svg>
                        </span>
                        <span class="accordion-icon accordion-icon_pause">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-audio-pause"></use>
                            </svg>
                        </span>
                        <span class="accordion-icon accordion-icon_youtube">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-youtube"></use>
                            </svg>
                        </span>
                        <span class="accordion-icon accordion-icon_rutube">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-rutube"></use>
                            </svg>
                        </span>
                    </button>
                    <div data-tab-target="2" class="tabs-target">
                        <div class="tab-media tab-media_hide" id="tab-media-2">
                            <audio src="/resources/audio/80s_vibe.mp3" controls loop>
                                <p>Your browser does not support the audio element.</p>
                            </audio>
                        </div>
                        <p>
                            Содержимое второй вкладки
                        </p>
                        <div class="tabs-close-btn">
                            <span>Свернуть</span>
                            <svg aria-hidden="true" width="11" height="7">
                                <use xlink:href="#arrow-down-svg"></use>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="tabs-item">
                    <button data-tab-anchor="3" type="button" name="button" class="js-accordion-item tabs-trigger">
                        <span class="accordion-title">Точка 3. Объект такой</span>
                        <span class="accordion-icon accordion-icon_play">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-audio-play"></use>
                            </svg>
                        </span>
                        <span class="accordion-icon accordion-icon_pause">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-audio-pause"></use>
                            </svg>
                        </span>
                        <span class="accordion-icon accordion-icon_youtube">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-youtube"></use>
                            </svg>
                        </span>
                        <span class="accordion-icon accordion-icon_rutube">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-rutube"></use>
                            </svg>
                        </span>
                    </button>
                    <div data-tab-target="3" class="tabs-target">
                        Содержимое третьей вкладки
                        <div class="tab-media " id="tab-media-3">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/PR4EHK4P544?si=fDHed4vNyCrfZOGD" srcdomain="youtube" title="" frameborder="0"></iframe>
                        </div>
                        <div class="tabs-close-btn">
                            <span>Свернуть</span>
                            <svg aria-hidden="true" width="11" height="7">
                                <use xlink:href="#arrow-down-svg"></use>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="tabs-item">
                    <button data-tab-anchor="4" type="button" name="button" class="js-accordion-item tabs-trigger">
                        <span class="accordion-title">Точка 4. Объект c видео Rutube</span>
                        <span class="accordion-icon accordion-icon_play">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-audio-play"></use>
                            </svg>
                        </span>
                        <span class="accordion-icon accordion-icon_pause">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-audio-pause"></use>
                            </svg>
                        </span>
                        <span class="accordion-icon accordion-icon_youtube">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-youtube"></use>
                            </svg>
                        </span>
                        <span class="accordion-icon accordion-icon_rutube">
                            <svg aria-hidden="true" width="100%" height="100%">
                                <use xlink:href="#media-rutube"></use>
                            </svg>
                        </span>
                    </button>
                    <div data-tab-target="4" class="tabs-target">
                        Содержимое четвёртой вкладки
                        <div class="tab-media " id="tab-media-4">
                            <iframe width="560" height="315" src="https://rutube.ru/play/embed/6d9b102a6754d118b5153c78b319a82a" srcdomain="rutube" frameBorder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                        </div>
                        <!--     
                      <iframe id='my-player' src="https://rutube.ru/play/embed/{id_video_params}" style='height:auto;'> 
                      </iframe> 
                      { 
                          type: 'player:play', 
                          data: {} 
                      } 
                    
                    <script type="text/javascript">
                    function doCommand() {
                      var player = document.getElementById('my-player');
                      player.contentWindow.postMessage(JSON.stringify({CommandJSON}), '*');
                    }
                    </script> -->
                        <div class="tabs-close-btn">
                            <span>Свернуть</span>
                            <svg aria-hidden="true" width="11" height="7">
                                <use xlink:href="#arrow-down-svg"></use>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cell-6 push-1 cell-12-lg push-0-lg">
        <div class="slider__block">
            <div class="swiper image-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="#">
                            <img loading="lazy" src="/img/slider/slide_audio_1.jpg" alt="">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="#">
                            <img loading="lazy" src="/img/slider/slide_audio_2.jpg" alt="">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="#">
                            <img loading="lazy" src="/img/slider/slide3.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="swiper-controls">
                    <div class="swiper-fractions">
                        <div class="swiper-active-slide"></div>
                        <div class="swiper-count-slides"></div>
                    </div>
                    <div class="swiper-scrollbar-holder">
                        <div class="swiper-scrollbar"></div>
                    </div>
                    <div class="swiper-count-total"></div>
                    <div class="swiper-arrows">
                        <div class="swiper-button-prev">
                            <svg aria-hidden="true" width="15" height="26">
                                <use xlink:href="#slider-prev-svg"></use>
                            </svg>
                        </div>
                        <div class="swiper-button-next">
                            <svg aria-hidden="true" width="15" height="26">
                                <use xlink:href="#slider-next-svg"></use>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="object">
    <div class="x3-object__top">
        <div class="x3-object__img x3-slider">
            <div class="x3-object__img-in">
                <? if (isset($arResult["BANNERS"]) && is_array($arResult["BANNERS"])) : ?>
                    <div class="x3-object__slider swiper-container">
                        <div class="swiper-wrapper">
                            <? foreach ($arResult["BANNERS"] as $key => $arItem) : ?>
                                <div class="x3-object__slider-item swiper-slide">
                                    <picture>
                                        <source media="(max-width: 400px)" srcset="<?= $arItem["IMG400"]["src"] ?>" type="image/jpg">
                                        <img src="<?= $arItem["IMG948"]["src"] ?>" alt="">
                                    </picture>
                                </div>
                            <? endforeach; ?>
                        </div>
                        <div class="x3-slider__panel">
                            <div class="container">
                                <? if (count($arResult["BANNERS"]) > 1) : ?>
                                    <div class="x3-slider__counter-wrap">
                                        <div class="x3-slider__counter">
                                            <span class="x3-slider__active">01</span>/<span class="x3-slider__count"><? if (count($arResult["BANNERS"]) < 10) : ?>0<? endif; ?><?= count($arResult["BANNERS"]) ?></span>
                                        </div>
                                        <div class="x3-slider__pagination"></div>
                                        <div class="x3-slider__total"><? if (count($arResult["BANNERS"]) < 10) : ?>0<? endif; ?><?= count($arResult["BANNERS"]) ?></div>
                                    </div>

                                    <div class="x3-slider__controls">
                                        <div class="x3-slider__prev svg-zoom">
                                            <svg aria-hidden="true" width="15" height="26">
                                                <use xlink:href="#slider-prev-svg"></use>
                                            </svg>
                                        </div>
                                        <div class="x3-slider__next svg-zoom">
                                            <svg aria-hidden="true" width="15" height="26">
                                                <use xlink:href="#slider-next-svg"></use>
                                            </svg>
                                        </div>
                                    </div>
                                <? endif; ?>
                            </div>
                        </div>
                    </div>
                <? elseif ($arParams["OBJECTS_TYPE"] != "type2") : ?>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/no_image_big.png" alt="" style="margin-bottom: 30px;">
                <? endif; ?>
                <? if (!empty($arResult["DISPLAY_PROPERTIES"]["PARTNER"]["VALUE"])) : ?>
                    <span class="x3-objects__partner">
                        <svg aria-hidden="true" width="104" height="108">
                            <use xlink:href="#partner-icon-svg"></use>
                        </svg>
                    </span>
                <? endif; ?>

                <? if (!empty($arResult["PROPERTIES"]["STARS"]["VALUE"]) && $arResult["PROPERTIES"]["STARS"]["VALUE"] != "Без звезд") : ?>
                    <div class="x3-objects__stars" style="position:absolute; top: 20px; right: 20px; z-index: 1;">
                        <svg aria-hidden="true" width="120" height="30">
                            <use xlink:href="#star-<?= $arResult["PROPERTIES"]["STARS"]["VALUE"] ?>-icon-svg"></use>
                        </svg>
                    </div>
                <? elseif ($arResult["PROPERTIES"]["STARS"]["VALUE"] == "Без звезд") : ?>
                    <div class="x3-objects__stars" style="position:absolute; top: 20px; right: 20px; z-index: 1;">
                        <svg aria-hidden="true" width="90" height="20">
                            <use xlink:href="#star-0-icon-svg"></use>
                        </svg>
                    </div>
                <? endif; ?>

                <? if (
                    !empty($arResult["DISPLAY_PROPERTIES"]["GIFT"]["VALUE"]) ||
                    !empty($arResult["DISPLAY_PROPERTIES"]["SALE"]["VALUE"]) ||
                    !empty($arResult["DISPLAY_PROPERTIES"]["DELIVERY"]["VALUE"]) ||
                    !empty($arResult["DISPLAY_PROPERTIES"]["TAKEAWEY"]["VALUE"])
                ) : ?>
                    <ul class="x3-objects__icons">
                        <? if (!empty($arResult["DISPLAY_PROPERTIES"]["GIFT"]["VALUE"])) : ?>
                            <li>
                                <svg aria-hidden="true" width="77" height="77">
                                    <use xlink:href="#gift-icon-svg"></use>
                                </svg>
                                <span><?= $arResult["DISPLAY_PROPERTIES"]["GIFT"]["VALUE"] ?></span>
                            </li>
                        <? endif; ?>
                        <? if (!empty($arResult["DISPLAY_PROPERTIES"]["SALE"]["VALUE"])) : ?>
                            <li>
                                <svg aria-hidden="true" width="76" height="77">
                                    <use xlink:href="#sale-icon-svg"></use>
                                </svg>
                                <span>Скидка <?= $arResult["DISPLAY_PROPERTIES"]["SALE"]["VALUE"] ?>%</span>
                            </li>
                        <? endif; ?>
                        <? if (!empty($arResult["DISPLAY_PROPERTIES"]["DELIVERY"]["VALUE"])) : ?>
                            <li>
                                <svg aria-hidden="true" width="76" height="77">
                                    <use xlink:href="#delivery-icon-svg"></use>
                                </svg>
                                <span>Доставка</span>
                            </li>
                        <? endif; ?>
                        <? if (!empty($arResult["DISPLAY_PROPERTIES"]["TAKEAWEY"]["VALUE"])) : ?>
                            <li>
                                <svg aria-hidden="true" width="76" height="77">
                                    <use xlink:href="#takeawey-icon-svg"></use>
                                </svg>
                                <span>Самовывоз</span>
                            </li>
                        <? endif; ?>
                    </ul>
                <? endif; ?>
            </div>
        </div>
        <div class="x3-object__info">
            <? if (!empty($arResult["DISPLAY_PROPERTIES"]["CUISINE"]["VALUE"])) : ?>
                <div class="x3-object__param x3-object__param--noicon">
                    <span class="x3-object__title">Вид кухни: </span><br>
                    <? foreach ($arResult["DISPLAY_PROPERTIES"]["CUISINE"]["VALUE"] as $key => $cuisine) : ?>
                        <? if ($key != 0) : ?>, <? endif; ?><?= $cuisine ?>
                    <? endforeach; ?>
                </div>
            <? endif; ?>
            <? if (!empty($arResult["DISPLAY_PROPERTIES"]["AVERAGE_CHECK"]["VALUE"])) : ?>
                <div class="x3-object__param x3-object__param--noicon">
                    <span class="x3-object__title">Средний чек: </span>
                    <span class="x3-object__price"><?= $arResult["DISPLAY_PROPERTIES"]["AVERAGE_CHECK"]["VALUE"] ?></span>
                </div>
            <? endif; ?>
            <? if (!empty($arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"])) : ?>
                <div class="x3-object__param">
                    <svg aria-hidden="true" width="17" height="23">
                        <use xlink:href="#geo-svg"></use>
                    </svg>
                    <?= $arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"] ?>
                </div>
            <? endif; ?>
            <? if (!empty($arResult["DISPLAY_PROPERTIES"]["PHONE"]["VALUE"])) : ?>
                <div class="x3-object__param">
                    <svg aria-hidden="true" width="22" height="22">
                        <use xlink:href="#phone-svg"></use>
                    </svg>
                    <?= $arResult["DISPLAY_PROPERTIES"]["PHONE"]["VALUE"] ?>
                </div>
            <? endif; ?>
            <? if (!empty($arResult["DISPLAY_PROPERTIES"]["WORK_TIME"]["VALUE"])) : ?>
                <div class="x3-object__param">
                    <svg aria-hidden="true" width="23" height="23">
                        <use xlink:href="#time-svg"></use>
                    </svg>
                    <?= html_entity_decode($arResult["DISPLAY_PROPERTIES"]["WORK_TIME"]["VALUE"]) ?>
                </div>
            <? endif; ?>
            <? if (!empty($arResult["DISPLAY_PROPERTIES"]["EMAIL"]["VALUE"])) : ?>
                <div class="x3-object__param">
                    <svg aria-hidden="true" width="20" height="15">
                        <use xlink:href="#mail-svg"></use>
                    </svg>
                    <?= $arResult["DISPLAY_PROPERTIES"]["EMAIL"]["VALUE"] ?>
                </div>
            <? endif; ?>
            <? if (!empty($arResult["DISPLAY_PROPERTIES"]["SITE"]["VALUE"])) : ?>
                <div class="x3-object__param">
                    <svg aria-hidden="true" width="20" height="20">
                        <use xlink:href="#www-svg"></use>
                    </svg>
                    <a href="<?= $arResult["DISPLAY_PROPERTIES"]["SITE"]["VALUE"] ?>" target="_blank"><?= $arResult["DISPLAY_PROPERTIES"]["SITE"]["VALUE"] ?></a>
                </div>
            <? endif; ?>

            <div class="x3-object__soc">
                <? if (!empty($arResult["DISPLAY_PROPERTIES"]["SOC_VK"]["VALUE"])) : ?>
                    <a href="<?= $arResult["DISPLAY_PROPERTIES"]["SOC_VK"]["VALUE"] ?>" target="_blank">
                        <svg aria-hidden="true" width="23" height="13">
                            <use xlink:href="#soc-vk-svg"></use>
                        </svg>
                    </a>
                <? endif; ?>
                <? if (!empty($arResult["DISPLAY_PROPERTIES"]["SOC_OK"]["VALUE"])) : ?>
                    <a href="<?= $arResult["DISPLAY_PROPERTIES"]["SOC_OK"]["VALUE"] ?>" target="_blank">
                        <svg aria-hidden="true" width="12" height="19">
                            <use xlink:href="#soc-ok-svg"></use>
                        </svg>
                    </a>
                <? endif; ?>
                <? if (!empty($arResult["DISPLAY_PROPERTIES"]["SOC_TG"]["VALUE"])) : ?>
                    <a href="<?= $arResult["DISPLAY_PROPERTIES"]["SOC_TG"]["VALUE"] ?>" target="_blank">
                        <svg aria-hidden="true" width="20" height="18">
                            <use xlink:href="#soc-tg-svg"></use>
                        </svg>
                    </a>
                <? endif; ?>
            </div>
        </div>
    </div>

    <div class="x3-object__detail <? if (empty($arResult["BANNERS"])) : ?>x3-object__detail--m0<? endif; ?>">

        <? if (!empty($arResult["PROPERTIES"]["YOUTUBE"]["VALUE"])) : ?>
            <iframe width="100%" height="500" src="<?= $arResult["PROPERTIES"]["YOUTUBE"]["VALUE"] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
        <? endif; ?>

        <?= $arResult["DETAIL_TEXT"] ?>
    </div>

    <?/*if(!empty($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTOS"]["VALUE"])):?>
        <div class="x3-object__photo-wrap">
            <div class="x3-object__photos">
                <?foreach($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as $photo):?>
                    <a href="<?=$photo["FULL"]?>">
                        <img loading="lazy" src="<?=$photo["PREVIEW"]["src"]?>" alt="">
                    </a>
                <?endforeach;?>
            </div>
            <?if($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTOS"]["VALUE"]>4):?>
                <div class="x3-object__photos-more">
                    <a href="#" class="x3-btn js-more-photo">
                        <span>Развернуть</span>
                        <svg aria-hidden="true" width="15" height="20">
                            <use xlink:href="#arrow-down2-svg"></use>
                        </svg>
                    </a>
                </div>
            <?endif;?>
        </div>
    <?endif;*/ ?>

    <? if (!empty($arResult["PROPERTIES"]["LOCATION_MAP"]["VALUE"])) : ?>
        <div class="x3-object__map">
            <div class="x3-object__map-title">Как добраться?</div>
            <div class="x3-map">
                <div id="map_object" style="width:100%; height:100%;"></div>
            </div>
            <?
            $ex = explode(",", $arResult["PROPERTIES"]["LOCATION_MAP"]["~VALUE"]); ?>
            <script src="//api-maps.yandex.ru/2.0/?load=package.standard,package.geoObjects&lang=ru-RU&scroll=false" type="text/javascript"></script>

            <script>
                ymaps.ready(init);

                function init() {
                    var myMap = new ymaps.Map("map_object", {
                            center: [<?= $ex[0] ?>, <?= $ex[1] + 0.01 ?>],
                            zoom: 15,
                            behaviors: ["default", "scrollZoom"],
                        }),

                        myPlacemark1 = new ymaps.Placemark([<?= $ex[0] ?>, <?= $ex[1] ?>], {
                            iconContent: '<?= $arResult["NAME"] ?>',
                            balloonContentBody: '<div class="mapobj_info"><div class="map_inf"><?= $arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"] ?></div></div>',
                        }, {
                            iconImageHref: '<?= $arResult["ICON_MAP"] ?>',
                            iconImageSize: [48, 52],
                            iconImageOffset: [-24, -52]
                        })
                    myMap.geoObjects
                        .add(myPlacemark1);

                    window.onresize = function() {
                        onResizeMap();
                    };

                    function onResizeMap() {
                        if ($(window).width() > '992') {
                            myMap.setCenter([<?= $ex[0] ?>, <?= $ex[1] + 0.015 ?>]);
                            var pixelCenter2 = myMap.getGlobalPixelCenter('map_page');
                        } else {
                            myMap.setCenter([<?= $ex[0] ?>, <?= $ex[1] ?>]);
                        }
                    }
                    onResizeMap();
                }
            </script>
        </div>
    <? endif; ?>

    <div class="x3-object__bottom">
        <a href="<?= $arResult["BACK_LINK"] ?>" class="x3-btn svg-left">
            <svg aria-hidden="true" width="19" height="15">
                <use xlink:href="#arrow-left2-svg"></use>
            </svg>
            Вернуться к списку
        </a>
        <div class="x3-object__share">
            Поделиться:
            <script src="https://yastatic.net/share2/share.js"></script>
            <div class="ya-share2" data-curtain data-services="vkontakte,odnoklassniki,telegram"></div>
        </div>
    </div>

</div>
<?  ?>