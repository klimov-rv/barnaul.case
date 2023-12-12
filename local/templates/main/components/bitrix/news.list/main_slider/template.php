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
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/main-slider.css"));
?>
<div class="x3-slider">
    <div class="x3-slider__wrap">
        <div class="swiper-wrapper">
            <? foreach ($arResult["ITEMS"] as $arItem) : ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="x3-slider__item x3-slide swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["src"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" />
                    <div class="x3-slide__data">
                        <div class="container">
                            <div class="row">
                                <div class="x3-slide__info cell-6 push-6">
                                    <div class="x3-slide__name"><?= $arItem["NAME"] ?></div>
                                    <a href="<?= $arItem["PROPERTIES"]["SLIDER_LINK"]["VALUE"] ?>" class="x3-slide__btn x3-btn"><?= $arItem["PROPERTIES"]["BUTTON_TITLE"]["VALUE"] ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
        <div class="x3-slider__panel">
            <div class="container">
                <div class="x3-slider__counter-wrap">
                    <div class="x3-slider__counter">
                        <span class="x3-slider__active">01</span>/<span class="x3-slider__count">0<?= count($arResult["ITEMS"]) ?></span>
                    </div>
                    <div class="x3-slider__pagination"></div>
                    <div class="x3-slider__total">0<?= count($arResult["ITEMS"]) ?></div>
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
            </div>
        </div>
    </div>
</div>