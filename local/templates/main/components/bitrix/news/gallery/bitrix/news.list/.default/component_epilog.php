<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->SetTitle($arResult['PAGE_TITLE']);
if($arResult["ADD_SECTION_IN_BREADCRUMBS"])
    $APPLICATION->AddChainItem($arResult['PAGE_TITLE'], "");