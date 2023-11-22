<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class MapObjects extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $result = array(
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => isset($arParams["CACHE_TIME"]) ?$arParams["CACHE_TIME"]: 36000000,
            "IBLOCK_OBJECTS_ID" => intval($arParams["IBLOCK_OBJECTS_ID"]),
            "SHOW_LEVEL" => intval($arParams["SHOW_LEVEL"]),
        );
        return $result;
    }

    public function executeComponent()
    {
        CModule::IncludeModule('iblock');

        // Получение списка разделов объектов
        $arFilterElems = array (
            "IBLOCK_ID" => $this->arParams["IBLOCK_OBJECTS_ID"],
            'GLOBAL_ACTIVE'=>'Y',
            '>DEPTH_LEVEL'=> $this->arParams["SHOW_LEVEL"],
            "ELEMENT_SUBSECTIONS" => "N",
            "CNT_ACTIVE" => "Y",
        );
        $items = CIBlockSection::GetList(Array("left_margin"=>"asc"), $arFilterElems, true, Array("ID", "NAME", "DEPTH_LEVEL", "UF_ICONMAP"));

        while($arItem = $items->GetNext()) {
            if($arItem['ELEMENT_CNT'] >= 0) {
                // Для построения списка разделов
                $this->arResult["ITEMS"][] = $arItem;

                // Для карты
                $img = ($arItem["UF_ICONMAP"])?CFile::GetByID($arItem["UF_ICONMAP"]):'';
                $pic = ($img)?$img->arResult[0]['SUBDIR'].'/'.$img->arResult[0]['FILE_NAME']:'';
                $ar_tab = array(
                    "n" =>  $arItem['NAME'],
                    "i" =>  $pic
                );
                $sections[$arItem['ID']] = $ar_tab;
            }
        }
        $this->arResult["SECTIONS_FOR_MAP"] =  ' rubs = '. json_encode($sections).'; ';

        $this->includeComponentTemplate();
    }

}?>
