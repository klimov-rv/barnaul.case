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
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/excursion.css"));
?>
<div class="x3-excursions">
    <a href="/ekskursii/audioekskursii/" class="audio-link__wrap">
        <div class="audio-link">
            <div class="audio-link__title">Аудиоэкскурсии</div>
            <div class="audio-link__icon">
                <svg aria-hidden="true" width="58" height="58">
                    <use xlink:href="#icon-trip-audio"></use>
                </svg>
            </div>
        </div>
    </a>
    <? foreach ($arResult["ITEMS"] as $arItem) : ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="x3-excursions__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="x3-excursions__img">
                <? if (!empty($arItem["PREVIEW_PICTURE"])) : ?>
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["src"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" />
                <? else : ?>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/images/no_image.png" alt="">
                <? endif; ?>
            </div>
            <div class="x3-excursions__info">
                <div class="x3-excursions__title"><?= $arItem["NAME"] ?></div>
                <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]) : ?>
                    <div class="x3-excursions__preview"><?= $arItem["PREVIEW_TEXT"]; ?></div>
                <? endif; ?>
            </div>
        </div>
    <? endforeach; ?>
</div>