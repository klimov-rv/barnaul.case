<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
/** @var array $arResult */

foreach($arResult["ITEMS"] as &$arItem){
    if($arItem['PREVIEW_PICTURE']){
        $arItem['PREVIEW_PICTURE'] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>453,'height'=>273), BX_RESIZE_IMAGE_EXACT);
    }
}
 