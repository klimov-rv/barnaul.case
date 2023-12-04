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
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/objects-detail.css"));
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/main-slider.css"));
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/objects-slider.css"));

$historical_obj_id = intval($arResult["PROPERTIES"]["HISTORICAL_LINE_ID"]["VALUE"]);
$legend = $arResult["PROPERTIES"]["LEGEND"]["VALUE"]["TEXT"];
$coefficient = 5 * $historical_obj_id;
$coefficient2 = $coefficient + 3;
 
if (!empty($arResult["PROPERTIES"]["IS_HISTORICAL_LINE_OBJECT"]["VALUE"])) : {

        // выбираем из общего списка исторических объектов предыдущий и следующий

        $arSelect = array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_IS_HISTORICAL_LINE_OBJECT", "PROPERTY_HISTORICAL_LINE_ID", "CODE");
        $arFilter = array("IBLOCK_ID" => 4, "PROPERTY_IS_HISTORICAL_LINE_OBJECT_VALUE" => 'Да', "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);

        $cntPrev = $historical_obj_id - 1;
        $cntNext = $historical_obj_id + 1;
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            if (intval($arFields["PROPERTY_HISTORICAL_LINE_ID_VALUE"]) === $cntNext) {
                $linkNext = $arFields["DETAIL_PAGE_URL"];
                $titleNext = $arFields["NAME"];
            } elseif (intval($arFields["PROPERTY_HISTORICAL_LINE_ID_VALUE"]) === $cntPrev) {
                $linkPrev = $arFields["DETAIL_PAGE_URL"];
                $titlePrev = $arFields["NAME"];
            }
        }
?>

        <div class="historical-object__hero">
            <div class="hero-line">
                <svg aria-hidden="true" width="100%" height="100%">
                    <use xlink:href="#hist-hero-line"></use>
                </svg>

                <div class="hide-svg-line" style="background: linear-gradient(90deg, rgba(255, 255, 255, 0) <?= $coefficient ?>%, rgba(242, 242, 242, 1) <?= $coefficient ?>%, rgba(242, 242, 242, 1) 100%)">
                </div>
            </div>

            <style>
                .hero-line {
                    height: 100%;
                    width: 100%;
                }

                .hide-svg-line {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                }
            </style>
            <div class="hero-bg" style="background-image: url(/upload/historical_line/detail_bg/<?= $arResult["CODE"] ?>.png)">
            </div>
            <div class="hero__headline">
                <? if ($linkPrev) : ?>
                    <a href="<?= $linkPrev ?>" class="hero__headline_btn btn_previous">
                        <div class="hero__headline_btn__wrapper">
                            <svg aria-hidden="true" width="16" height="12">
                                <use xlink:href="#arrow-left"></use>
                            </svg>
                            <span>
                                <?= $titlePrev ?>
                            </span>
                        </div>
                    </a>
                <? endif; ?>
                <div class="container">
                    <div class="row">
                        <div class="push-1 cell-10 push-2-s cell-8-s">
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
                    </div>
                </div>
                <? if ($linkNext) : ?>
                    <a href="<?= $linkNext ?>" class="hero__headline_btn btn_next">
                        <div class="hero__headline_btn__wrapper">
                            <span>
                                <?= $titleNext ?>
                            </span>
                            <svg aria-hidden="true" width="16" height="12">
                                <use xlink:href="#arrow-right"></use>
                            </svg>
                        </div>
                    </a>
                <? endif; ?>
            </div>
            <div class="container">
                <div class="row hero__body">
                    <div class="hero__body_left push-1 cell-6 cell-6-lg cell-7-md push-0-md cell-12-s">
                        <h1 class="page-title">
                            <? $APPLICATION->ShowTitle(false) ?>
                        </h1>
                        <div class="row">
                            <div class="cell-10 cell-12-s">
                                <span class="page-hero-description">
                                    <?= $arResult["PREVIEW_TEXT"] ?>
                                </span>
                                <? $APPLICATION->IncludeFile($templateFolder . '/include_facts/facts_point_' . $historical_obj_id . '.php');
                                // $APPLICATION->IncludeFile($templateFolder . '/include_facts/fact1-1.php', Array( "settings" => $settingsList )); 
                                ?>
                            </div>
                        </div>

                        <? if (!empty($arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"])) : ?>
                            <address>
                                <svg aria-hidden="true" width="13" height="19">
                                    <use xlink:href="#icon-geo"></use>
                                </svg>
                                <span class="page-hero-address">
                                    <?= $arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"] ?>
                                </span><br />
                            </address>
                        <? endif; ?>

                    </div>
                    <div class="hero__body_right push-1 cell-4 push-0-lg cell-5-md cell-12-s">
                        <? if ($legend !== '') : ?>
                            <div class="page-hero-block">

                                <div class="page-hero-block__legend-title">легенда</div>
                                <span class="page-hero-block__legend">
                                    <?= $legend ?>
                                </span>
                            </div>
                        <? endif; ?>
                        <div class="page-hero__btn-gallery">
                            <a class="white-btn popup-with-zoom-anim" href="#hero-gallery">
                                <span>
                                    Фотогалерея
                                </span>
                                <svg aria-hidden="true" width="20" height="20">
                                    <use xlink:href="#galery-btn-icon"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="hero-gallery" class="hero-modal modal-container zoom-anim-dialog mfp-hide">
            <div class="row">
                <div class="cell-12 hero-gallery__popup">
                    <h2 class="gallery-title">
                        <? $APPLICATION->ShowTitle(false) ?>
                    </h2>
                    <div class="swiper gallery-slider">
                        <div class="swiper-wrapper">
                            <? foreach ($arResult["BANNERS"] as $key => $arItem) : ?>
                                <div class=" swiper-slide">
                                    <img loading="lazy" src="<?= $arItem["IMG948"]["src"] ?>" alt="">
                                </div>
                            <? endforeach; ?>
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
        </div>

    <? }
else : ?>

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
                            <svg aria-hidden="true" width="104" height="99">
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
                <? if (!empty($arResult["PROPERTIES"]["AVERAGE_CHECK_NUM"]["VALUE"])) : ?>
                    <div class="x3-object__param x3-object__param--noicon">
                        <span class="x3-object__title">Средний чек: </span>
                        <span class="x3-object__price"><?= $arResult["PROPERTIES"]["AVERAGE_CHECK_NUM"]["VALUE"] ?> рублей</span>
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
<? endif; ?>