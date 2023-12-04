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
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/sections-filter.css"));

?>

<div class="x3-sec-filter">
    <ul>
        <li><a href="<?= $arResult["SECTION"]["PATH"][0]["SECTION_PAGE_URL"] ?>" <? if ($arResult["NOT_ACTIVE_SECTION"]) : ?>class="_active" <? endif; ?>>Все</a></li>
        <? foreach ($arResult["SECTIONS"] as $arSection) : ?>
            <? if ($arSection["DEPTH_LEVEL"] > 1) : ?>
                <li>
                    <a href="<?= $arSection["SECTION_PAGE_URL"] ?>" <? if ($arSection["ACTIVE_SECTION"]) : ?>class="_active" <? endif; ?>>
                        <? if (!empty($arSection["UF_ICONMAP"])) : ?>
                            <img src="<?= CFile::GetPath($arSection["UF_ICONMAP"]) ?>" alt="">
                        <? endif; ?>
                        <?= $arSection["NAME"] ?>
                    </a>
                </li>
            <? endif; ?>
        <? endforeach; ?>
    </ul>
</div>