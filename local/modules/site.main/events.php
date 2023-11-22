<?php
use \Bitrix\Main\EventManager;

$eventManager = EventManager::getInstance();

$currentNamespace = '\Site\Main';

/* Проверка уникальности e-mail заявки перед ее сохранением */
AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("SaveRequest", "OnBeforeIBlockElementAddHandler"));
/* Генерация qr-кода и отправки его на почту клиента */
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("SaveRequest", "OnAfterIBlockElementAddHandler"));

class SaveRequest
{
    function OnBeforeIBlockElementAddHandler(&$arFields)
    {
        if($arFields["IBLOCK_ID"]==IBLOCK_ID_REQUEST){
            CModule::IncludeModule("iblock");
            $arSelectRequest = Array("ID", "IBLOCK_ID", "NAME");
            $arFilterRequest = Array("IBLOCK_ID"=>1, "ACTIVE_DATE"=>"Y", "PROPERTY_EMAIL"=>$arFields["PROPERTY_VALUES"][4]);
            $cnt = CIBlockElement::GetList(Array(), $arFilterRequest, Array(), Array(), $arSelectRequest);

            if($cnt!=0){
                global $APPLICATION;
                $APPLICATION->throwException("На этот e-mail уже зарегистрирована активная карта");
                return false;
            }

            // Для фамилии сохраняется только первая буква
            $arFields["PROPERTY_VALUES"][1] = mb_substr($arFields["PROPERTY_VALUES"][1],0,1);
        }
    }

    function OnAfterIBlockElementAddHandler(&$arFields)
    {
        if($arFields["IBLOCK_ID"]==IBLOCK_ID_REQUEST && $arFields["ID"]>0){
            CModule::IncludeModule("iblock");
            CModule::IncludeModule("file");

            $requestHash = md5($arFields["ID"].$arFields["NAME"]);

            $el = new CIBlockElement;

            // создание карты гостя с qr-кодом
            $QrCodeUrl = $_SERVER["SERVER_NAME"]."/check-guestcard/?request-hash=".$requestHash;
            $QrCodeImg = Site\Main\Guestcard::createQrCode($QrCodeUrl, $requestHash);

            // Добавление карты гостя в качестве preview_picture элемента
            $arFieldsRequest = array();
            $arFieldsRequest['PREVIEW_PICTURE'] = CFile::MakeFileArray($QrCodeImg);
            $arFieldsRequest['PREVIEW_PICTURE']["del"] = "Y";
            $el->Update($arFields["ID"], $arFieldsRequest);

            // Удаление файла карты гостя из временной папки
            imagedestroy($QrCodeImg);

            // Заполнение хэша элеиента
            CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array("HASH" => $requestHash));

            $arFieldsMail = array(
				//"NAME" => $arFields["NAME"],
                "EMAIL_TO"    => $arFields["PROPERTY_VALUES"][4],
                "IBLOCK_ID" => $arFields["IBLOCK_ID"],
                "ID" => $arFields["ID"],
                "DATE_ACTIVE_FROM" => FormatDate("d.m.Y", strtotime($arFields["DATE_ACTIVE_FROM"])),
                "DATE_ACTIVE_TO" => $arFields["DATE_ACTIVE_TO"],
            );

            CEvent::Send("GUESTCARD_CREATED", "s1", $arFieldsMail, "N", "", array($QrCodeImg));
        }
    }
}