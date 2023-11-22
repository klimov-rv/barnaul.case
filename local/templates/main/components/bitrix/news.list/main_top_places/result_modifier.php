<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
/** @var array $arResult */
/** @var array $arParams */

foreach($arResult["ITEMS"] as &$arItem){
    if($arItem['PREVIEW_PICTURE']){
        $arItem['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>453,'height'=>273), BX_RESIZE_IMAGE_EXACT);
    }
}

$arResult["LIST_PAGE_URL"] = ($arParams["BLOCK_TYPE"]!="TOP") ? $arResult["LIST_PAGE_URL"] : "/popular/";