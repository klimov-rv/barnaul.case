<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if(!empty($_REQUEST["hash"])){
    $arSelect = Array("ID", "IBLOCK_ID", "PREVIEW_PICTURE");
    $arFilter = Array("IBLOCK_ID"=>IBLOCK_ID_REQUEST, "PROPERTY_HASH"=>$_REQUEST["hash"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        $arResult["QUESTCARD_IMG"] = CFile::GetPath($arFields["PREVIEW_PICTURE"]);
    }
}



