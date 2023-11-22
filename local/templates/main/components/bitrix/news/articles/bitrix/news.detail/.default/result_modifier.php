<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
/** @var array $arResult */

if($arResult['DETAIL_PICTURE']){
    $arResult['DETAIL_PICTURE'] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width'=>1100,'height'=>662), BX_RESIZE_IMAGE_EXACT);
}

foreach($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as &$photo) {
    $photo = array(
        "FULL" => CFile::GetPath($photo),
        "PREVIEW" => CFile::ResizeImageGet($photo, array('width'=>267,'height'=>160), BX_RESIZE_IMAGE_EXACT),
    );
}