<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var array $arResult */
/** @var array $arParams */
// CModule::IncludeModule("iblock");

if ($arResult['DETAIL_PICTURE']) {
    $arResult["BANNERS"][0]["IMG400"] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width' => 400, 'height' => 241), BX_RESIZE_IMAGE_EXACT);
    $arResult["BANNERS"][0]["IMG948"] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'], array('width' => 948, 'height' => 571), BX_RESIZE_IMAGE_EXACT);
}

// �������
if (is_array($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"])) {
    foreach ($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as $key => $banner) {
        $arResult["BANNERS"][$key + 1]["IMG400"] = CFile::ResizeImageGet($banner, array('width' => 400, 'height' => 241), BX_RESIZE_IMAGE_EXACT, true);
        $arResult["BANNERS"][$key + 1]["IMG948"] = CFile::ResizeImageGet($banner, array('width' => 948, 'height' => 571), BX_RESIZE_IMAGE_EXACT, true);
    }
}


if (is_array($arResult["PROPERTIES"]["AUDIO_POINTS"]["VALUE"])) {

    $i = 0;
    foreach ($arResult["PROPERTIES"]["AUDIO_POINTS"]["VALUE"] as $key => $audio_point) {

        $arFilter = array("IBLOCK_ID" => 7, "ID" => $audio_point);
        $res = CIBlockElement::GetList(array(), $arFilter);
        if ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();

            if ($arProps["MEDIA_SRC"]["VALUE"] !== '') {
                $wrap1 = '<audio preload="metadata" src="';
                $wrap2 = '" controls="" loop=""><p>Ваш браузер не поддерживает аудио</p></audio>';
                $media_src = $arProps["MEDIA_SRC"]["VALUE"];
                $media_to_include = $wrap1 . $media_src . $wrap2;
                $media_type = 'audio';
                $video_id = 'none';

                $arResult["AUDIO_POINTS"][$i]['NAME'] = $arFields['NAME'];
                $arResult["AUDIO_POINTS"][$i]['ID'] = $arFields['ID'];
                $arResult["AUDIO_POINTS"][$i]['DETAIL_TEXT'] = $arFields['DETAIL_TEXT'];
                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $media_src, $youtube);
                if ($youtube) {
                    $wrap1 = '<iframe width="560" height="315" srcfull="';
                    $wrap2 = '" srcdomain="youtube" video_id="' . $youtube[1] . '" title="" frameborder="0"></iframe>';
                    $media_to_include = $wrap1 . $media_src . $wrap2;

                    $video_id = $youtube[1];
                    $media_type = 'youtube';
                }
                preg_match('/(rutube.ru)/', $media_src, $rutube);
                if ($rutube) {
                    $wrap1 = '<iframe width="560" height="315" srcfull="';
                    $wrap2 = '" srcdomain="rutube" frameBorder="0" allow="clipboard-write; autoplay" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                    $media_to_include = $wrap1 . $media_src . $wrap2;
                    $video_id = $rutube[1];
                    $media_type = 'rutube';
                }
                $arResult["AUDIO_POINTS"][$i]['MEDIA_INCLUDE'] = $media_to_include;
                $arResult["AUDIO_POINTS"][$i]['MEDIA_TYPE'] = $media_type;
                $arResult["AUDIO_POINTS"][$i]['rutube'] = $rutube;
                $arResult["AUDIO_POINTS"][$i]['youtube'] = $youtube;
                $arResult["AUDIO_POINTS"][$i]['video_id'] = $video_id;
                $arResult["AUDIO_POINTS"][$i]['media_src'] = $media_src;
                $i++;
            }
        }
    }
}


//foreach($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as &$photo) {
//    $photo = array(
//        "FULL" => CFile::GetPath($photo),
//        "PREVIEW" => CFile::ResizeImageGet($photo, array('width'=>276,'height'=>166), BX_RESIZE_IMAGE_EXACT),
//    );
//}

$SectionRes = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arResult["IBLOCK_ID"], "ID" => $arResult["IBLOCK_SECTION_ID"]), false, array("UF_ICONMAP"));
if ($arSection = $SectionRes->GetNext()) {
    $arResult["ICON_MAP"] = CFile::GetPath($arSection["UF_ICONMAP"]);
}

$arResult["BACK_LINK"] = ($arParams["OBJECTS_TYPE"] != "type2") ? $arResult["SECTION_URL"] : $arResult["LIST_PAGE_URL"];

$this->getComponent()->setResultCacheKeys(["NAME"]);
