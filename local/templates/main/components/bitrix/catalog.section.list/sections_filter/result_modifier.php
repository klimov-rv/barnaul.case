<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
/** @var array $arResult */

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$uri = new \Bitrix\Main\Web\Uri($request->getRequestUri());
$arResult["NOT_ACTIVE_SECTION"] = true;
foreach($arResult["SECTIONS"] as $key => &$arSection){
    if($arSection["SECTION_PAGE_URL"] == $uri->getPath()) {
        $arSection["ACTIVE_SECTION"] = true;
        $arResult["NOT_ACTIVE_SECTION"] = false;
    }
    if(0 == $arResult['SECTIONS'][$key]['ELEMENT_CNT']) {
        unset($arResult['SECTIONS'][$key]);
    }
}