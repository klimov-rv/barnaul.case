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

$rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'ID' => $arResult["VARIABLES"]["SECTION_ID"]));
if ($arSection = $rsSections->GetNext()) {
	$sectionName = $arSection['NAME'];
	$sSectionName = $arSection['NAME'];
	$parentSection = (!empty($arSection['IBLOCK_SECTION_ID'])) ? $arSection['IBLOCK_SECTION_ID'] : $arResult["VARIABLES"]["SECTION_ID"];
}

$arSections = CIBlockSection::GetNavChain(false, $arResult["VARIABLES"]["SECTION_ID"], ['ID', 'NAME', 'DEPTH_LEVEL'], true);

if ($arSections[0]["ID"] == 1)
	$sectionImg = "/upload/bg/eat.png";
elseif ($arSections[0]["ID"] == 2)
	$sectionImg = "/upload/bg/stay.png";
elseif ($arSections[0]["ID"] == 3)
	$sectionImg = "/upload/bg/visit.png";

$APPLICATION->SetPageProperty("BG", $sectionImg);
?>

<? if ($arParams["USE_RSS"] == "Y") : ?>
	<?
	$rss_url = CComponentEngine::makePathFromTemplate($arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["rss_section"], array_map("urlencode", $arResult["VARIABLES"]));
	if (method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="' . $rss_url . '" href="' . $rss_url . '" />');
	?>
	<a href="<?= $rss_url ?>" title="rss" target="_self"><img alt="RSS" src="<?= $templateFolder ?>/images/gif-light/feed-icon-16x16.gif" border="0" align="right" /></a>
<? endif ?>

<? if ($arParams["USE_SEARCH"] == "Y") : ?>
	<?= GetMessage("SEARCH_LABEL") ?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:search.form",
		"flat",
		array(
			"PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"]
		),
		$component
	); ?>
	<br />
<? endif ?>

<? if ($arParams["USE_FILTER"] == "Y") : ?>
	<? if (
		$arResult["VARIABLES"]["SECTION_CODE_PATH"] === "where_eat" ||
		$arResult["VARIABLES"]["SECTION_CODE_PATH"] === "where_stay"  ||
		$arResult["VARIABLES"]["SECTION_CODE_PATH"] === "where_visit"
	) : ?><!--  where_stay, page_url === souvenirs -->
		<? $APPLICATION->IncludeComponent(
			"bitrix:catalog.smart.filter",
			"new_smart_filter",
			array(
				"CACHE_GROUPS" => "Y",	// Учитывать права доступа
				"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
				"CACHE_TYPE" => "A",	// Тип кеширования
				"DISPLAY_ELEMENT_COUNT" => "N",	// Показывать количество
				"FILTER_NAME" => "arrFilter",	// Имя выходящего массива для фильтрации
				"FILTER_VIEW_MODE" => "vertical",	// Вид отображения
				"IBLOCK_ID" => "4",	// Инфоблок
				"IBLOCK_TYPE" => "data",	// Тип инфоблока
				"PAGER_PARAMS_NAME" => "arrPager",	// Имя массива с переменными для построения ссылок в постраничной навигации
				"POPUP_POSITION" => "left",	// Позиция для отображения всплывающего блока с информацией о фильтрации
				"PREFILTER_NAME" => "smartPreFilter",	// Имя входящего массива для дополнительной фильтрации элементов
				"SAVE_IN_SESSION" => "Y",	// Сохранять установки фильтра в сессии пользователя
				"SECTION_CODE" => "where_eat",	// Код раздела
				"SECTION_CODE_PATH" => "",	// Путь из символьных кодов раздела
				"SECTION_DESCRIPTION" => "-",	// Описание
				"SECTION_ID" => $parentSection,	// ID раздела инфоблока
				"SECTION_TITLE" => "-",	// Заголовок
				"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
				"SEF_RULE" => "",	// Правило для обработки
				"SMART_FILTER_PATH" => "",	// Блок ЧПУ умного фильтра
				"TEMPLATE_THEME" => "blue",	// Цветовая тема
				"XML_EXPORT" => "N",	// Включить поддержку Яндекс Островов
			),
			false
		); ?>
		<br />
	<? else :
		if ($arParams["POPULAR"] != "y" && $arParams["OBJECTS_TYPE"] != "type2") :
			$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"sections_filter",
				array(
					"ADD_SECTIONS_CHAIN" => "N",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"COMPONENT_TEMPLATE" => "sections_filter",
					"COUNT_ELEMENTS" => "Y",
					"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
					"FILTER_NAME" => $arParams["FILTER_NAME"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"SECTION_CODE" => $arParams["SECTION_CODE"],
					"SECTION_FIELDS" => array(
						0 => "",
						1 => "",
					),
					"SECTION_ID" => $parentSection,
					"SECTION_URL" => "",
					"SECTION_USER_FIELDS" => array(
						0 => "UF_ICONMAP",
						1 => "",
					),
					"SHOW_PARENT_NAME" => "Y",
					"TOP_DEPTH" => "2",
					"VIEW_MODE" => "LINE"
				),
				false
			);
		endif; 	 ?>
	<? endif; ?>
<? endif; ?>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"",
	array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NEWS_COUNT" => $arParams["NEWS_COUNT"],
		"SORT_BY1" => $arParams["SORT_BY1"],
		"SORT_ORDER1" => $arParams["SORT_ORDER1"],
		"SORT_BY2" => $arParams["SORT_BY2"],
		"SORT_ORDER2" => $arParams["SORT_ORDER2"],
		"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => 'N',
		"SECTION_NAME" => $sectionName,
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],

		"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
		"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
	),
	$component
); ?>