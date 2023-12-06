<?php
define("ADMIN_SECTION",false);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;


if(CModule::IncludeModule("iblock"))
{




$res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>IntVal(4), "ACTIVE"=>"Y"), false, Array("nPageSize"=>1000),Array("ID", "*"));

$json = array();

function GetPoints($res,&$json) {

while($ob = $res->GetNextElement()){
 $arProps = $ob->GetProperties();

 if ($arProps['LOCATION_MAP']['VALUE']) {

    $arFields = $ob->GetFields();

    $ex = explode(",",$arProps['LOCATION_MAP']['VALUE']);
    $arFields['NAME'] = $arFields['NAME'];//iconv('cp1251', 'utf-8',  $arFields['NAME']);
    $arFields['PREVIEW_TEXT'] = $arFields['PREVIEW_TEXT'];//iconv('cp1251', 'utf-8',  $arFields['PREVIEW_TEXT']);
    if ($ex[0] && $ex[1]) {


       $img = CFile::GetByID($arFields["PREVIEW_PICTURE"]);

           //var_dump( $img);
       $pic = ($img)?$img->arResult[0]['SUBDIR'].'/'.$img->arResult[0]['FILE_NAME']:'';

		$json[ $arFields["ID"] ] =
                    array(
                        'id' => $arFields["ID"],
                        'lo' => $ex[0],
                        'la' => $ex[1],
                        'ph' => $pic,
                        'po' => 1,
                        'ir' => $arFields['IBLOCK_SECTION_ID'],
                        'n' => $arFields['NAME'],
                        'm' => $arFields['PREVIEW_TEXT'],
                        'nur' => $arFields['DETAIL_PAGE_URL'],
                        'ico' => $p['icon'],
                        'pr' => $arProps['PARTNER']['VALUE'],
                        );

    }

 }

}

}

GetPoints($res,$json);
}

echo json_encode($json);



