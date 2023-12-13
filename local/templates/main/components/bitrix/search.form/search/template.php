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
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/search.css"));
?>
<div class="x3-search__icon svg-rotate">
    <svg aria-hidden="true" width="21" height="20">
        <use xlink:href="#search-svg"></use>
    </svg>
</div>
<div class="x3-search-panel">
    <div class="x3-search-panel__wrap">
        <form action="<?=$arResult["FORM_ACTION"]?>">
            <input type="text" name="q" value="" size="15" maxlength="50" placeholder="Введите запрос" />
        </form>
        <span class="x3-search-panel__text">Нажмите Enter для поиска или Esc для отмены</span>
        <button class="x3-search-panel__close">
            <svg aria-hidden="true" width="15" height="15">
                <use xlink:href="#close-svg"></use>
            </svg>
        </button>
    </div>
</div>