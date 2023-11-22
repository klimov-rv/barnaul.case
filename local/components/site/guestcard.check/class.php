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
        if(!empty($_GET["request-hash"])){
            CModule::IncludeModule('iblock');
            // Проверка наличия активной заявки с хэшем = $_GET["request-hash"]
            $requestHash = $_GET["request-hash"];
            $arSelectElems = array (
                "ID",
                "NAME",
            );
            $arFilterElems = array (
                "IBLOCK_ID" => $this->arParams["GUESTCARD_IBLOCK_ID"],
                "PROPERTY_HASH" => $requestHash,
				//"ACTIVE_DATE" => "Y",
            );
            $resRequest = CIBlockElement::GetList(array(), $arFilterElems, false, false, $arSelectElems);
            while($arRequest = $resRequest->GetNext()){
                $this->arResult["REQUEST"]["CNT"] +=1;
                $this->arResult["REQUEST"]["ID"] = $arRequest["ID"];
            }

            if($this->arResult["REQUEST"]["CNT"]==1) {

                // Получение количества отсканированных ранее qr-кодов данным пользователем
                $cntQr = 0;
                global $USER;
                $arFilter = array("ID" => $USER->GetID());
                $arParamsQr["SELECT"] = array("UF_CHECKED_QR");
                $arRes = CUser::GetList($by,$desc,$arFilter,$arParamsQr);
                if ($res = $arRes->Fetch()) {
                    $cntQr = $res["UF_CHECKED_QR"];
                }

                // Увеличение количества отсканированных пользователем qr-кодов на 1
                $obEl = new CIBlockElement();
                $boolResult = $obEl->Update($this->arResult["REQUEST"]["ID"], array('ACTIVE' => 'Y'));
                $user = new CUser;
                $r = $cntQr + 1;
                $fields = Array(
                    "UF_CHECKED_QR"  => $r,
                );
                $user->Update($USER->GetID(), $fields);
            }
        }

        $this->includeComponentTemplate();
    }

}?>
