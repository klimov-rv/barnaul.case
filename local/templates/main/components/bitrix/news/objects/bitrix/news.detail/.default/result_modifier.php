<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
/** @var array $arResult */
/** @var array $arParams */

if($arResult['DETAIL_PICTURE']){
    $arResult["BANNERS"][0]["IMG400"] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width'=>400,'height'=>241), BX_RESIZE_IMAGE_EXACT);
    $arResult["BANNERS"][0]["IMG948"] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width'=>948,'height'=>571), BX_RESIZE_IMAGE_EXACT);
}

// �������
if (is_array($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"]))
{
    foreach($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as $key => $banner)
    {
        $arResult["BANNERS"][$key+1]["IMG400"] = CFile::ResizeImageGet($banner, array('width' => 400, 'height' => 241), BX_RESIZE_IMAGE_EXACT, true);
        $arResult["BANNERS"][$key+1]["IMG948"] = CFile::ResizeImageGet($banner, array('width' => 948, 'height' => 571), BX_RESIZE_IMAGE_EXACT, true);
    }
}

//foreach($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as &$photo) {
//    $photo = array(
//        "FULL" => CFile::GetPath($photo),
//        "PREVIEW" => CFile::ResizeImageGet($photo, array('width'=>276,'height'=>166), BX_RESIZE_IMAGE_EXACT),
//    );
//}

$SectionRes=CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult["IBLOCK_ID"], "ID"=>$arResult["IBLOCK_SECTION_ID"]),false, Array("UF_ICONMAP"));
if($arSection=$SectionRes->GetNext()){
    $arResult["ICON_MAP"] = CFile::GetPath($arSection["UF_ICONMAP"]);
}

$arResult["BACK_LINK"] = ($arParams["OBJECTS_TYPE"] !="type2") ? $arResult["SECTION_URL"] : $arResult["LIST_PAGE_URL"];

$this->getComponent()->setResultCacheKeys(["NAME"]);