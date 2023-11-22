<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "gallery",
    array(
        "IBLOCK_ID" => "10",
        "IBLOCK_TYPE" => "data",
        "COMPONENT_TEMPLATE" => "gallery",
        "IBLOCKS" => array(
            0 => "10",
        ),
        "NEWS_COUNT" => "6",
        "IBLOCK_SORT_BY" => "SORT",
        "IBLOCK_SORT_ORDER" => "ASC",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "FILTER_NAME" => "arrFilter",
        "IBLOCK_URL" => "",
        "DETAIL_URL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "CHECK_DATES" => "Y",
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "CACHE_FILTER" => "N",
        "PREVIEW_TRUNCATE_LEN" => "",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
    ),
    false
);
