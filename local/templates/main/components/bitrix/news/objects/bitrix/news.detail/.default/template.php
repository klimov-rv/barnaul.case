<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>

<div class="object">
    <div class="x3-object__top">
        <div class="x3-object__img x3-slider">
            <div class="x3-object__img-in">
                <?if (isset($arResult["BANNERS"]) && is_array($arResult["BANNERS"])):?>
                    <div class="x3-object__slider swiper-container">
                        <div class="swiper-wrapper">
                            <?foreach($arResult["BANNERS"] as $key => $arItem):?>
                                <div class="x3-object__slider-item swiper-slide">
                                    <picture>
                                        <source media="(max-width: 400px)" srcset="<?=$arItem["IMG400"]["src"]?>" type="image/jpg">
                                        <img src="<?=$arItem["IMG948"]["src"]?>" alt="">
                                    </picture>
                                </div>
                            <?endforeach;?>
                        </div>
                        <div class="x3-slider__panel">
                            <div class="container">
                                <?if(count($arResult["BANNERS"])>1):?>
                                    <div class="x3-slider__counter-wrap">
                                        <div class="x3-slider__counter">
                                            <span class="x3-slider__active">01</span>/<span class="x3-slider__count"><?if(count($arResult["BANNERS"])<10):?>0<?endif;?><?=count($arResult["BANNERS"])?></span>
                                        </div>
                                        <div class="x3-slider__pagination"></div>
                                        <div class="x3-slider__total"><?if(count($arResult["BANNERS"])<10):?>0<?endif;?><?=count($arResult["BANNERS"])?></div>
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
                                <?endif;?>
                            </div>
                        </div>
                    </div>
                <?elseif($arParams["OBJECTS_TYPE"]!="type2"):?>
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/no_image_big.png" alt="" style="margin-bottom: 30px;">
                <?endif;?>
                <?if(!empty($arResult["DISPLAY_PROPERTIES"]["PARTNER"]["VALUE"])):?>
                    <span class="x3-objects__partner">
                    <svg aria-hidden="true" width="104" height="108">
                        <use xlink:href="#partner-icon-svg"></use>
                    </svg>
                </span>
                <?endif;?>

                <?if(!empty($arResult["PROPERTIES"]["STARS"]["VALUE"]) && $arResult["PROPERTIES"]["STARS"]["VALUE"]!="Без звезд"):?>
                    <div class="x3-objects__stars" style="position:absolute; top: 20px; right: 20px; z-index: 1;">
                        <svg aria-hidden="true" width="120" height="30">
                            <use xlink:href="#star-<?=$arResult["PROPERTIES"]["STARS"]["VALUE"]?>-icon-svg"></use>
                        </svg>
                    </div>
                <?elseif($arResult["PROPERTIES"]["STARS"]["VALUE"]=="Без звезд"):?>
                    <div class="x3-objects__stars" style="position:absolute; top: 20px; right: 20px; z-index: 1;">
                        <svg aria-hidden="true" width="90" height="20">
                            <use xlink:href="#star-0-icon-svg"></use>
                        </svg>
                    </div>
                <?endif;?>

                <?if(   !empty($arResult["DISPLAY_PROPERTIES"]["GIFT"]["VALUE"]) ||
                    !empty($arResult["DISPLAY_PROPERTIES"]["SALE"]["VALUE"]) ||
                    !empty($arResult["DISPLAY_PROPERTIES"]["DELIVERY"]["VALUE"]) ||
                    !empty($arResult["DISPLAY_PROPERTIES"]["TAKEAWEY"]["VALUE"])
                ):?>
                    <ul class="x3-objects__icons">
                        <?if(!empty($arResult["DISPLAY_PROPERTIES"]["GIFT"]["VALUE"])):?>
                            <li>
                                <svg aria-hidden="true" width="77" height="77">
                                    <use xlink:href="#gift-icon-svg"></use>
                                </svg>
                                <span><?=$arResult["DISPLAY_PROPERTIES"]["GIFT"]["VALUE"]?></span>
                            </li>
                        <?endif;?>
                        <?if(!empty($arResult["DISPLAY_PROPERTIES"]["SALE"]["VALUE"])):?>
                            <li>
                                <svg aria-hidden="true" width="76" height="77">
                                    <use xlink:href="#sale-icon-svg"></use>
                                </svg>
                                <span>Скидка <?=$arResult["DISPLAY_PROPERTIES"]["SALE"]["VALUE"]?>%</span>
                            </li>
                        <?endif;?>
                        <?if(!empty($arResult["DISPLAY_PROPERTIES"]["DELIVERY"]["VALUE"])):?>
                            <li>
                                <svg aria-hidden="true" width="76" height="77">
                                    <use xlink:href="#delivery-icon-svg"></use>
                                </svg>
                                <span>Доставка</span>
                            </li>
                        <?endif;?>
                        <?if(!empty($arResult["DISPLAY_PROPERTIES"]["TAKEAWEY"]["VALUE"])):?>
                            <li>
                                <svg aria-hidden="true" width="76" height="77">
                                    <use xlink:href="#takeawey-icon-svg"></use>
                                </svg>
                                <span>Самовывоз</span>
                            </li>
                        <?endif;?>
                    </ul>
                <?endif;?>
            </div>
        </div>
        <div class="x3-object__info">
            <?if(!empty($arResult["DISPLAY_PROPERTIES"]["CUISINE"]["VALUE"])):?>
                <div class="x3-object__param x3-object__param--noicon">
                    <span class="x3-object__title">Вид кухни: </span><br>
                    <?foreach ($arResult["DISPLAY_PROPERTIES"]["CUISINE"]["VALUE"] as $key => $cuisine):?>
                        <?if($key!=0):?>, <?endif;?><?=$cuisine?>
                    <?endforeach;?>
                </div>
            <?endif;?>
            <?if(!empty($arResult["DISPLAY_PROPERTIES"]["AVERAGE_CHECK"]["VALUE"])):?>
                <div class="x3-object__param x3-object__param--noicon">
                    <span class="x3-object__title">Средний чек:  </span>
                    <span class="x3-object__price"><?=$arResult["DISPLAY_PROPERTIES"]["AVERAGE_CHECK"]["VALUE"]?></span>
                </div>
            <?endif;?>
            <?if(!empty($arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"])):?>
                <div class="x3-object__param">
                    <svg aria-hidden="true" width="17" height="23">
                        <use xlink:href="#geo-svg"></use>
                    </svg>
                    <?=$arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"]?>
                </div>
            <?endif;?>
            <?if(!empty($arResult["DISPLAY_PROPERTIES"]["PHONE"]["VALUE"])):?>
                <div class="x3-object__param">
                    <svg aria-hidden="true" width="22" height="22">
                        <use xlink:href="#phone-svg"></use>
                    </svg>
                    <?=$arResult["DISPLAY_PROPERTIES"]["PHONE"]["VALUE"]?>
                </div>
            <?endif;?>
            <?if(!empty($arResult["DISPLAY_PROPERTIES"]["WORK_TIME"]["VALUE"])):?>
                <div class="x3-object__param">
                    <svg aria-hidden="true" width="23" height="23">
                        <use xlink:href="#time-svg"></use>
                    </svg>
                    <?=html_entity_decode($arResult["DISPLAY_PROPERTIES"]["WORK_TIME"]["VALUE"])?>
                </div>
            <?endif;?>
            <?if(!empty($arResult["DISPLAY_PROPERTIES"]["EMAIL"]["VALUE"])):?>
                <div class="x3-object__param">
                    <svg aria-hidden="true" width="20" height="15">
                        <use xlink:href="#mail-svg"></use>
                    </svg>
                    <?=$arResult["DISPLAY_PROPERTIES"]["EMAIL"]["VALUE"]?>
                </div>
            <?endif;?>
            <?if(!empty($arResult["DISPLAY_PROPERTIES"]["SITE"]["VALUE"])):?>
                <div class="x3-object__param">
                    <svg aria-hidden="true" width="20" height="20">
                        <use xlink:href="#www-svg"></use>
                    </svg>
                    <a href="<?=$arResult["DISPLAY_PROPERTIES"]["SITE"]["VALUE"]?>" target="_blank"><?=$arResult["DISPLAY_PROPERTIES"]["SITE"]["VALUE"]?></a>
                </div>
            <?endif;?>

            <div class="x3-object__soc">
                <?if(!empty($arResult["DISPLAY_PROPERTIES"]["SOC_VK"]["VALUE"])):?>
                    <a href="<?=$arResult["DISPLAY_PROPERTIES"]["SOC_VK"]["VALUE"]?>" target="_blank">
                        <svg aria-hidden="true" width="23" height="13">
                            <use xlink:href="#soc-vk-svg"></use>
                        </svg>
                    </a>
                <?endif;?>
                <?if(!empty($arResult["DISPLAY_PROPERTIES"]["SOC_OK"]["VALUE"])):?>
                <a href="<?=$arResult["DISPLAY_PROPERTIES"]["SOC_OK"]["VALUE"]?>" target="_blank">
                    <svg aria-hidden="true" width="12" height="19">
                        <use xlink:href="#soc-ok-svg"></use>
                    </svg>
                </a>
                <?endif;?>
                <?if(!empty($arResult["DISPLAY_PROPERTIES"]["SOC_TG"]["VALUE"])):?>
                <a href="<?=$arResult["DISPLAY_PROPERTIES"]["SOC_TG"]["VALUE"]?>" target="_blank">
                    <svg aria-hidden="true" width="20" height="18">
                        <use xlink:href="#soc-tg-svg"></use>
                    </svg>
                </a>
                <?endif;?>
            </div>
        </div>
    </div>

    <div class="x3-object__detail <?if(empty($arResult["BANNERS"])):?>x3-object__detail--m0<?endif;?>">

        <?if(!empty($arResult["PROPERTIES"]["YOUTUBE"]["VALUE"])):?>
            <iframe width="100%" height="500" src="<?=$arResult["PROPERTIES"]["YOUTUBE"]["VALUE"]?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
        <?endif;?>

        <?=$arResult["DETAIL_TEXT"]?>
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
    <?endif;*/?>

    <? if (!empty($arResult["PROPERTIES"]["LOCATION_MAP"]["VALUE"])):?>
    <div class="x3-object__map">
        <div class="x3-object__map-title">Как добраться?</div>
        <div class="x3-map">
            <div id="map_object" style="width:100%; height:100%;"></div>
        </div>
        <?
        $ex = explode(",",$arResult["PROPERTIES"]["LOCATION_MAP"]["~VALUE"]);?>
        <script src="//api-maps.yandex.ru/2.0/?load=package.standard,package.geoObjects&lang=ru-RU&scroll=false" type="text/javascript"></script>

        <script>
            ymaps.ready(init);
            function init() {
                var myMap = new ymaps.Map("map_object", {
                        center: [<?=$ex[0]?>,<?=$ex[1]+0.01?>],
                        zoom: 15,
                        behaviors: ["default", "scrollZoom"],
                    }),

                    myPlacemark1 = new ymaps.Placemark([<?=$ex[0]?>,<?=$ex[1]?>], {
                        iconContent: '<?=$arResult["NAME"]?>',
                        balloonContentBody: '<div class="mapobj_info"><div class="map_inf"><?=$arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"]?></div></div>',
                    }, {
                        iconImageHref: '<?=$arResult["ICON_MAP"]?>',
                        iconImageSize: [48, 52],
                        iconImageOffset: [-24, -52]
                    })
                myMap.geoObjects
                    .add(myPlacemark1);

                window.onresize = function () {
                    onResizeMap();
                };
                function onResizeMap() {
                    if ($(window).width() > '992') {
                        myMap.setCenter([<?=$ex[0]?>,<?=$ex[1]+0.015?>]);
                        var pixelCenter2 = myMap.getGlobalPixelCenter('map_page');
                    } else {
                        myMap.setCenter([<?=$ex[0]?>,<?=$ex[1]?>]);
                    }
                } onResizeMap();
            }
        </script>
    </div>
    <? endif;?>

    <div class="x3-object__bottom">
        <a href="<?=$arResult["BACK_LINK"]?>" class="x3-btn svg-left">
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