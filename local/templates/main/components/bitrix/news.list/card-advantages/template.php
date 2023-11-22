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
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/main-advantages.css"));
?>
<ul class="x3-card-advantages">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="x3-card-advantages__icon">
            <?=html_entity_decode($arItem["PROPERTIES"]["ICON"]["VALUE"])?>
        </div>
        <div class="x3-card-advantages__num <?if(!empty($arItem["PROPERTIES"]["NUM_CHAR"]["VALUE"])):?>x3-card-advantages__num--more<?endif;?>">
            <?=$arItem["PROPERTIES"]["NUM"]["VALUE"]?>
        </div>
        <div class="x3-card-advantages__text">
            <?=html_entity_decode($arItem["NAME"])?>
        </div>
    </li>
<?endforeach;?>
</ul>
