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
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/objects-list.css"));

?>
<div class="objects-list items-list">
    <? foreach ($arResult["ITEMS"] as $arItem) : ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="objects-list__item item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <a class="objects-list__img" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                <? if (!empty($arItem["PREVIEW_PICTURE"])) : ?>
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["src"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" />
                <? else : ?>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/no_image.png" alt="">
                <? endif; ?>

                <? if (!empty($arItem["DISPLAY_PROPERTIES"]["PARTNER"]["VALUE"])) : ?>
                    <span class="objects-list__partner">
                        <svg aria-hidden="true" width="104" height="99">
                            <use xlink:href="#partner-icon-svg"></use>
                        </svg>
                    </span>
                <? endif; ?>

                <? if (
                    !empty($arItem["DISPLAY_PROPERTIES"]["GIFT"]["VALUE"]) ||
                    !empty($arItem["DISPLAY_PROPERTIES"]["SALE"]["VALUE"]) ||
                    !empty($arItem["DISPLAY_PROPERTIES"]["DELIVERY"]["VALUE"]) ||
                    !empty($arItem["DISPLAY_PROPERTIES"]["TAKEAWEY"]["VALUE"])
                ) : ?>
                    <ul class="objects-list__icons">
                        <? if (!empty($arItem["DISPLAY_PROPERTIES"]["GIFT"]["VALUE"])) : ?>
                            <li>
                                <svg aria-hidden="true" width="77" height="77">
                                    <use xlink:href="#gift-icon-svg"></use>
                                </svg>
                                <span><?= $arItem["DISPLAY_PROPERTIES"]["GIFT"]["VALUE"] ?></span>
                            </li>
                        <? endif; ?>
                        <? if (!empty($arItem["DISPLAY_PROPERTIES"]["SALE"]["VALUE"])) : ?>
                            <li>
                                <svg aria-hidden="true" width="76" height="77">
                                    <use xlink:href="#sale-icon-svg"></use>
                                </svg>
                                <span>Скидка <?= $arItem["DISPLAY_PROPERTIES"]["SALE"]["VALUE"] ?>%</span>
                            </li>
                        <? endif; ?>
                        <? if (!empty($arItem["DISPLAY_PROPERTIES"]["DELIVERY"]["VALUE"])) : ?>
                            <li>
                                <svg aria-hidden="true" width="76" height="77">
                                    <use xlink:href="#delivery-icon-svg"></use>
                                </svg>
                                <span>Доставка</span>
                            </li>
                        <? endif; ?>
                        <? if (!empty($arItem["DISPLAY_PROPERTIES"]["TAKEAWEY"]["VALUE"])) : ?>
                            <li>
                                <svg aria-hidden="true" width="76" height="77">
                                    <use xlink:href="#takeawey-icon-svg"></use>
                                </svg>
                                <span>Самовывоз</span>
                            </li>
                        <? endif; ?>
                    </ul>
                <? endif; ?>

                <? if (!empty($arItem["DISPLAY_PROPERTIES"]["STARS"]["VALUE"]) && $arItem["DISPLAY_PROPERTIES"]["STARS"]["VALUE"] != "Без звезд") : ?>
                    <span class="objects-list__stars">
                        <svg aria-hidden="true" width="<?= $arItem["DISPLAY_PROPERTIES"]["STARS"]["VALUE"] * 16 + 12 ?>" height="21">
                            <use xlink:href="#star-<?= $arItem["DISPLAY_PROPERTIES"]["STARS"]["VALUE"] ?>-icon-svg"></use>
                        </svg>
                    </span>
                <? elseif ($arItem["DISPLAY_PROPERTIES"]["STARS"]["VALUE"] == "Без звезд") : ?>
                    <span class="objects-list__stars">
                        <svg aria-hidden="true" width="89" height="20">
                            <use xlink:href="#star-0-icon-svg"></use>
                        </svg>
                    </span>
                <? endif; ?>

                <? if (!empty($arItem["PROPERTIES"]["IS_HISTORICAL_LINE_OBJECT"]["VALUE"])) : ?>
                    <div class="objects-list__historical_point">
                        <svg class="objects-list__historical_star" aria-hidden="true" width="100%" height="100%">
                            <use xlink:href="#starred-icon"></use>
                        </svg>
                        <span class="objects-list__historical_text">Исторический объект</span>
                    </div>
                <? endif; ?>

            </a>
            <? if (!empty($arItem["NAME"])) : ?>
                <div class="objects-list__name">
                    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                        <?= $arItem["NAME"] ?>
                    </a>
                </div>
            <? endif; ?>

            <ul class="objects-list__props">
                <? if (!empty($arItem["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"])) : ?>
                    <li>Адрес: <span><?= $arItem["DISPLAY_PROPERTIES"]["ADDRESS"]["VALUE"] ?></span></li>
                <? endif; ?>
                <? if (!empty($arItem["DISPLAY_PROPERTIES"]["AVERAGE_CHECK"]["VALUE"])) : ?>
                    <li>Средний чек: <span class="objects-list__price"><?= $arItem["DISPLAY_PROPERTIES"]["AVERAGE_CHECK"]["VALUE"] ?></span></li>
                <? endif; ?>
            </ul>

        </div>
    <? endforeach; ?>
</div>

<div class="news-more-btn">
    <?= $arResult["NAV_STRING"] ?>
</div>