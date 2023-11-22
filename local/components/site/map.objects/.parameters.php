<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
    "GROUPS" => array(
    ),
	"PARAMETERS" => array(
        "IBLOCK_OBJECTS_ID" => array(
            "NAME" => GetMessage("IBLOCK_OBJECTS_ID"),
            "TYPE" => "STRING",
        ),
        "SHOW_LEVEL" => array(
            "NAME" => GetMessage("SHOW_LEVEL"),
            "TYPE" => "STRING",
        ),
        "CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
        "CACHE_GROUPS" => array(
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => GetMessage("B_BPR_CACHE_GROUPS"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ),
	),
);