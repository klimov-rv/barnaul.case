<?php
define("ADMIN_SECTION", false);
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;

$DB->Query("SET NAMES 'cp1251'");
$DB->Query('SET collation_connection = "cp1251_general_ci"');
if (CModule::IncludeModule("iblock")) {
    if ($_POST['act'] == 'save_obj') {

        $name = iconv('utf-8', 'cp1251', $_POST['name']);
        $rub = $_POST['rub'];
        $about = iconv('utf-8', 'cp1251', $_POST['about']);
        $adres = iconv('utf-8', 'cp1251', $_POST['adres']);
        $doehat = iconv('utf-8', 'cp1251', $_POST['doehat']);
        $coords = $_POST['coords'];
        $ex = explode("_", $rub);

        if (($ex[0] == 7 || $ex[0] == 12) && is_numeric($ex[1]) && $name && $about) {

            $el = new CIBlockElement;

            $PROP = array();
            if ($ex[0] == 7) {
                $PROP[40] = $coords;
                $PROP[22] = $adres . ' ' . $doehat;
            } elseif ($ex[0] == 12) {
                $PROP[57] = $coords;
                $PROP[58] = $adres . ' ' . $doehat;
            }

            $arLoadProductArray = array(
                "MODIFIED_BY" => '',            // элемент изменен текущим пользователем
                "IBLOCK_SECTION_ID" => $ex[1],  // элемент лежит в корне раздела
                "IBLOCK_ID" => $ex[0],
                "PROPERTY_VALUES" => $PROP,
                "NAME" => $name,
                "ACTIVE" => "",                 // активен
                "PREVIEW_TEXT" => $about
            );

            if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                $arEventFields = array(
                    "ID" => $PRODUCT_ID,
                    "LINK" => $_SERVER["SERVER_NAME"] . "/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=" . $ex[0] . "&type=objects&lang=ru&ID=" . $PRODUCT_ID,
                );
                CEvent::Send("ADD_MAP_OBJECT", "s1", $arEventFields);
            }

        }
    }
}





