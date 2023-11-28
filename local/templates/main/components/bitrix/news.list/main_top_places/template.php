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
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/main-top-places.css"));
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/slider-panel.css"));
?>
<div class="x3-block <?if($arParams["BLOCK_BG"]=="Y"):?>x3-block--bg<?endif;?>">
    <div class="container">
        <h2 class="x3-block__title anim-slideUp"><?=$arParams["BLOCK_NAME"]?></h2>
        <div class="x3-b-slider <?if($arParams["BLOCK_TYPE"]=="TOP"):?>x3-b-slider--top <?endif;?>">
            <div class="swiper-wrapper">
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="x3-b-slide swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <?if($arParams["BLOCK_TYPE"]!="TOP"):?>
                            <div class="x3-b-slide__date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
                        <?endif;?>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <img loading="lazy" src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" />
                            <?if($arParams["BLOCK_TYPE"]=="TOP"):?>
                                <?if(!empty($arItem["PROPERTIES"]["SALE"]["VALUE"])):?>
                                    <span class="x3-b-slide__sale">
                                        <span>
                                            <span>
                                                <?=$arItem["PROPERTIES"]["SALE"]["VALUE"]?>
                                            </span>
                                        </span>
                                        <span class="x3-b-slide__sale-text">
                                            скидка
                                        </span>
                                    </span>
                                <?elseif(!empty($arItem["PROPERTIES"]["PARTNER"]["VALUE"])):?>
                                    <span class="x3-b-slide__partner">
                                        <svg aria-hidden="true" width="104" height="99">
                                            <use xlink:href="#partner-icon-svg"></use>
                                        </svg>
                                    </span>
                                <?endif;?>
                                <span class="x3-b-slide__name">
                                    <?=$arItem["NAME"]?>
                                </span>
                            <?endif;?>
                        </a>

                        <?if($arParams["BLOCK_TYPE"]!="TOP"):?>
                            <a class="x3-b-slide__name2" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                <?=$arItem["NAME"]?>
                            </a>
                        <?endif;?>
                    </div>
                <?endforeach;?>
            </div>

            <div class="x3-b-slider__panel">
                <div class="x3-b-slider__btn">
                    <?if($arParams["BLOCK_TYPE"]!="TOP"):?>
                        <a href="<?=$arResult["LIST_PAGE_URL"]?>" class="x3-btn svg-right">
                            Показать все события
                            <svg aria-hidden="true" width="19" height="15">
                                <use xlink:href="#arrow-right-svg"></use>
                            </svg>
                        </a>
                    <?else:?>
                        <a href="/objects/?popular=y" class="x3-btn svg-right">
                            Показать все
                            <svg aria-hidden="true" width="19" height="15">
                                <use xlink:href="#arrow-right-svg"></use>
                            </svg>
                        </a>
                    <?endif;?>
                </div>
                <div class="x3-b-slider__counter-wrap">
                    <div class="x3-b-slider__counter">
                        <span class="x3-b-slider__active">01</span>/<span class="x3-b-slider__count">0<?=count($arResult["ITEMS"])?></span>
                    </div>
                    <div class="x3-b-slider__pagination"></div>
                    <div class="x3-b-slider__total">0<?=count($arResult["ITEMS"])?></div>
                </div>
                <div class="x3-b-slider__controls">
                    <div class="x3-b-slider__prev svg-zoom">
                        <svg aria-hidden="true" width="15" height="26">
                            <use xlink:href="#slider-prev-svg"></use>
                        </svg>
                    </div>
                    <div class="x3-b-slider__next svg-zoom">
                        <svg aria-hidden="true" width="15" height="26">
                            <use xlink:href="#slider-next-svg"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>