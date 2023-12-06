<?
define("ADMIN_SECTION",false);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;

if(CModule::IncludeModule("iblock"))
{
        $IBLOCK_ID = 4;  //TODO: Это из параметров компонента нужно забирать

        $arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y', '!DEPTH_LEVEL'=>1);
        $db_list = CIBlockSection::GetList(Array(), $arFilter, true,array("UF_ICONMAP"));

        while($ar_result = $db_list->GetNext())
        {
            $img = ($ar_result["UF_ICONMAP"])?CFile::GetByID($ar_result["UF_ICONMAP"]):'';
            $pic = ($img)?$img->arResult[0]['SUBDIR'].'/'.$img->arResult[0]['FILE_NAME']:'';

            $ar_tab = array(
               "n" =>  $ar_result['NAME'],
               "i" =>  $pic
            );

            $cat[$ar_result['ID']] = $ar_tab;
        }
}

echo ' rubs = '. json_encode($cat).'; ';
