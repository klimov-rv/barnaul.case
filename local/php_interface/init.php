<?php
\Bitrix\Main\Loader::includeModule("site.main");

function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}


function getIblockElement2($iblockElementId)
{
    if (\CModule::IncludeModule("iblock")) {
        $arOrder = [];
        $arFilter = ['ID' => $iblockElementId];
        $arGroupBy = false;
        $arNavStartParams = false;
        $arSelectFields = ['ID', '*'];
        $dbRes = \CIBlockElement::GetList(
            $arOrder,
            $arFilter,
            $arGroupBy,
            $arNavStartParams,
            $arSelectFields
        );
        $element = $dbRes->Fetch();
        $propsDbres = \CIBlockElement::GetProperty($element['IBLOCK_ID'], $iblockElementId, "sort", "asc", array(">ID" => 1));
        $i = 0;
        while ($prop = $propsDbres->GetNext()) {
            $i = !isset($element['PROPS'][$prop['CODE']]) ? 0 : $i + 1;
            $element['PROPS'][$prop['CODE']]['NAME'] = $prop['NAME'];
            $element['PROPS'][$prop['CODE']]['TYPE'] = $prop['PROPERTY_TYPE'];
            $element['PROPS'][$prop['CODE']]['ACTIVE'] = $prop['ACTIVE'];
            $element['PROPS'][$prop['CODE']]['VALUES'][$i] = [
                'VALUE' => $prop['VALUE'],
                'DESCRIPTION' => $prop['DESCRIPTION'],
            ];
            if ($prop['PROPERTY_TYPE'] == 'F')
                $element['PROPS'][$prop['CODE']]['VALUE'][$i]['PATH'] = \CFile::GetPath(intval($prop['VALUE']));
        }
        console_log($element);
        return $element;
    }
}
