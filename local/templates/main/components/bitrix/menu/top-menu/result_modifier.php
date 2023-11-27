<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var array $arResult */
global $APPLICATION;

$arMenuSec = array();
CModule::IncludeModule("iblock");
$arFilter = array('IBLOCK_ID' => 4, "<DEPTH_LEVEL" => 3, "ACTIVE" => "Y");
$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'), $arFilter, false, array("NAME", "DEPTH_LEVEL", "LEFT_MARGIN", "RIGHT_MARGIN", "SECTION_PAGE_URL"));
while ($arSect = $rsSect->GetNext()) {
    $isParent = ($arSect["RIGHT_MARGIN"] - $arSect["LEFT_MARGIN"] == 1) ? false : true;
    $arMenuSec[] = array(
        "TEXT" => $arSect["NAME"],
        "DEPTH_LEVEL" => $arSect["DEPTH_LEVEL"],
        "LINK" => $arSect["SECTION_PAGE_URL"],
        "IS_PARENT" => $isParent,
        "PERMISSION" => "X",
        "SELECTED" => ($arSect["SECTION_PAGE_URL"] == $APPLICATION->GetCurPage()) ? true : false,
    );
}
$arResult = array_merge($arMenuSec, $arResult); 
foreach ($arResult as &$arItem) {
    if ($arItem["LINK"] == "/marshruty/")
        $arItem["LINK"] = "/ekskursii/";
    if ($arItem["LINK"] == "/about-barnaul/")
        $arItem["LINK"] = "/about-barnaul/barnaul-turistiheskii/";
}
