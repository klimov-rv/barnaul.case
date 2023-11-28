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
?>
<section class="row main-event__gallery">
    <div class="container">
        <div class="cell-12">
            <h5 class="section__title">Галерея</h5>
        </div>
        <div class="cell-12 row is-grid items-list">
            <? foreach ($arResult["ITEMS"] as $arItem) : ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                if (!$arItem["PREVIEW_PICTURE"]) {
                    $arItem["PREVIEW_PICTURE"]["src"] =  SITE_TEMPLATE_PATH . '/images/no_image.png';
                }
                ?>
                <div class="cell-4 cell-6-m cell-12-xs main-event__gallery-item item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <!-- <a href="/guestcard/" class="x3-slide__btn x3-btn">Получить карту</a> magnific popup -->
                    <div class="main-event__gallery-img">
                        <img src="<?= $arItem["PREVIEW_PICTURE"]["src"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" />
                    </div>
                </div>
            <? endforeach; ?>
        </div>
        <?= $arResult["NAV_STRING"] ?>
    </div>
</section>