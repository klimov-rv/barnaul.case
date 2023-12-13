<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var array $arResult */
/** @var array $arParams */

if ($arResult['DETAIL_PICTURE']) {
    $arResult["BANNERS"][0]["IMG400"] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width' => 400, 'height' => 241), BX_RESIZE_IMAGE_EXACT);
    $arResult["BANNERS"][0]["IMG948"] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width' => 948, 'height' => 571), BX_RESIZE_IMAGE_EXACT);
}

// �������
if (is_array($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"])) {
    foreach ($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as $key => $banner) {
        $arResult["BANNERS"][$key + 1]["IMG400"] = CFile::ResizeImageGet($banner, array('width' => 400, 'height' => 241), BX_RESIZE_IMAGE_EXACT, true);
        $arResult["BANNERS"][$key + 1]["IMG948"] = CFile::ResizeImageGet($banner, array('width' => 948, 'height' => 571), BX_RESIZE_IMAGE_EXACT, true);
    }
}

$SectionRes = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arResult["IBLOCK_ID"], "ID" => $arResult["IBLOCK_SECTION_ID"]), false, array("UF_ICONMAP"));
if ($arSection = $SectionRes->GetNext()) {
    $arResult["ICON_MAP"] = CFile::GetPath($arSection["UF_ICONMAP"]);
}

$audio_ID = $arResult["PROPERTIES"]["HISTORICAL_LINE_POINT_AUDIO"]["VALUE"];
if ($audio_ID) {
    $elProps = CIBlockElement::GetByID($audio_ID)->GetNextElement()->GetProperties();
    $arResult['MEDIA_SRC'] = $elProps['MEDIA_SRC'];
}

$fast_facts = [];
$facts = $arResult["PROPERTIES"]["HISTORICAL_LINE_POINT_FACTS"];
$res = CIBlockElement::GetList(array("SORT" => "ASC"), array("ID" => $facts['VALUE'], "ACTIVE" => "Y"));
while ($ar_fields = $res->GetNext()) {
    console_log($ar_fields);
    array_push($fast_facts, [
        "ICON" => CFile::GetPath($ar_fields['PREVIEW_PICTURE']),
        "DISPLAY_HTML" => strip_tags(trim($ar_fields["PREVIEW_TEXT"]), '<div><span>'),
    ]);
}

console_log($fast_facts);
$arResult['FAST_FACTS'] = $fast_facts;

if (!in_array($arElement["WF_STATUS_ID"], $arParams["STATUS"])) {
    echo ShowError(GetMessage("IBLOCK_ADD_ACCESS_DENIED"));
    $bAllowAccess = false;
}

$arResult["BACK_LINK"] = ($arParams["OBJECTS_TYPE"] != "type2") ? $arResult["SECTION_URL"] : $arResult["LIST_PAGE_URL"];

$this->getComponent()->setResultCacheKeys(["NAME"]);
