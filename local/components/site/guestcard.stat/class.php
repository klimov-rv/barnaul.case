<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class GuestcardCheck extends CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        $result = array(
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => isset($arParams["CACHE_TIME"]) ?$arParams["CACHE_TIME"]: 36000000,
            "GUESTCARD_IBLOCK_ID" => intval($arParams["GUESTCARD_IBLOCK_ID"]),
        );
        return $result;
    }

    public function executeComponent()
    {
        CModule::IncludeModule('iblock');

        // Получения колическва созданных и активных карт гостя
        $this->arResult["GUESTCARD_CNT"] = 0;
        $this->arResult["GUESTCARD_ACTIVE_CNT"] = 0;
        $dbItems = \Bitrix\Iblock\ElementTable::getList(array(
            'select' => array('ID', 'NAME', 'ACTIVE'),
            'filter' => array('IBLOCK_ID' => $this->arParams["GUESTCARD_IBLOCK_ID"])
        ));
        while ($arItem = $dbItems->fetch()){
            $this->arResult["GUESTCARD_CNT"] ++;
            if($arItem["ACTIVE"]=="Y")
                $this->arResult["GUESTCARD_ACTIVE_CNT"] ++;

        }

        // Список пользователей, которые проверяли карты гостя
        $result = \Bitrix\Main\UserTable::getList(array(
            'select' => array('ID','LOGIN', "UF_CHECKED_QR"),
            'filter' => array('!UF_CHECKED_QR' => 0),
        ));

        while ($arUser = $result->fetch()) {
            $this->arResult["USERS"][] = $arUser;
        }

        $this->includeComponentTemplate();
    }

}?>
