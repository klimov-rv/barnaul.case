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
console_log($arResult);

?>


<section class="audio-tours__obzor row">
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
            <?= $arResult["DETAIL_TEXT"] ?>
        </div>
        <div class="audio-tours__tabs">
            <div class="tabs-controls js-tabs-controls" data-tabs-container>

                <? foreach ($arResult["AUDIO_POINTS"] as $key => $arItem) : ?>
                    <div class="tabs-item">
                        <button data-tab-anchor="<?= ($key + 1) ?>" type="button" name="button" class="js-accordion-item tabs-trigger">
                            <span class="accordion-title"><?= $arItem["NAME"] ?> </span>
                            <? if ($arItem["MEDIA_TYPE"] === 'audio') { ?>
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
                            <? } else { ?>
                                <span class="accordion-icon accordion-icon_<?= $arItem["MEDIA_TYPE"] ?>">
                                    <svg aria-hidden="true" width="100%" height="100%">
                                        <use xlink:href="#media-<?= $arItem["MEDIA_TYPE"] ?>"></use>
                                    </svg>
                                </span>
                            <? }   ?>
                        </button>
                        <div data-tab-target="<?= ($key + 1) ?>" class="tabs-target">
                            <div class="tab-media <? if ($arItem["MEDIA_TYPE"] === 'audio') { ?>tab-media_hide<? } ?>" id="tab-media-<?= ($key + 1) ?>">
                                <?= $arItem["MEDIA_INCLUDE"] ?>
                            </div>
                            <?= $arItem["DETAIL_TEXT"] ?>
                            <div class="tabs-close-btn">
                                <span>Свернуть</span>
                                <svg aria-hidden="true" width="11" height="7">
                                    <use xlink:href="#arrow-down-svg"></use>
                                </svg>
                            </div>
                        </div>


                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
    <div class="cell-6 push-1 cell-12-lg push-0-lg slider-fix">
        <? if (isset($arResult["BANNERS"]) && is_array($arResult["BANNERS"])) : ?>
            <div class="slider__block">
                <div class="swiper image-slider">
                    <div class="swiper-wrapper">
                        <? foreach ($arResult["BANNERS"] as $key => $arItem) : ?>

                            <div class="swiper-slide">
                                <a href="#">
                                    <img loading="lazy" src="<?= $arItem["IMG948"]["src"] ?>" alt="">
                                </a>
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
        <? endif; ?>
    </div>
</section>