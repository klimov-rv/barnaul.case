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
?>
<? $ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"",
	array(
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" => $arParams["USE_SHARE"],
		"SHARE_HIDE" => $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
		'STRICT_SECTION_CHECK' => (isset($arParams['STRICT_SECTION_CHECK']) ? $arParams['STRICT_SECTION_CHECK'] : ''),
		"OBJECTS_TYPE" => $arParams["OBJECTS_TYPE"],
	),
	$component
); ?>

<?
// бэкграунд секции
$rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => IBLOCK_ID_OBJECTS, '=CODE' => $arResult["VARIABLES"]["SECTION_CODE"]), array("ID"));
if ($arSection = $rsSections->Fetch()) {
	$arSections = CIBlockSection::GetNavChain(false, $arSection["ID"], ['ID'], true);
}

if (count($arSections) > 1) {
	if ($arSections[0]["ID"] == 1)
		$bgImg = "/upload/bg/eat.png";
	elseif ($arSections[0]["ID"] == 2)
		$bgImg = "/upload/bg/stay.png";
	elseif ($arSections[0]["ID"] == 3)
		$bgImg = "/upload/bg/visit.png";
}

// перезаписываем бэкграунд исторического объекта и определяем класс шаблона страницы для шапки 

if ($arResult['VARIABLES']['ELEMENT_CODE'] === 'univermag-torgovogo-doma-d-n-sukhova-synovya') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '1');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'nagornyy-park') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '2');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'dispetcherskiy-punkt-tramvaev-ploshchad-svobody') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '3');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'aptekarskiy-sad') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '4');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'narodnyy-dom') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '5');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'zdanie-instrumentalnogo-magazina') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '6');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'zdanie-kantselyarii-kolyvano-voskresenskogo-zavoda') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '7');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'kompleks-sooruzheniy-serebroplavilnogo-zavoda') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '8');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'demidovskaya-ploshchad') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '9');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'zdanie-chertyezhnoy') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '10');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'zdanie-gornoy-laboratorii') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '11');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'zdanie-apteki') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '12');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'upravlenie-altayskogo-okruga') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '13');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'sobornaya-ploshchad') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '14');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'ulitsa-pushkina') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '15');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'teatr-kukol-skazka-i-kontsertnyy-zal-sibir') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '16');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'skver-imeni-pushkina') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '17');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'prospekt-lenina') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '18');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'ulitsa-lva-tolstogo') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '19');
} elseif ($arResult['VARIABLES']['ELEMENT_CODE'] === 'ulitsa-malo-tobolskaya') {
	$bgImg = "none";
	$APPLICATION->SetPageProperty("page_template", 'history-obj');
	$APPLICATION->SetPageProperty("history_obj_id", '20');
}
$APPLICATION->SetPageProperty("BG", $bgImg);

?>
