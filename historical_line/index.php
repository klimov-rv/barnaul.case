<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Историческая линия");
$APPLICATION->SetPageProperty("page_template", "is-container-fix is-page-historical-line");
$APPLICATION->AddChainItem("Объекты", "/objects/where_visit/");
$APPLICATION->AddChainItem("Историческая линия");

?>

<div class="trip__stripe">
    <div class="container">
        <div class="row">
            <div class="cell-4 trip__stage">
                <div class="big_font">2 км</div>
                <div class="small_font">
                    протяженность кольцевого маршрута
                </div>
                <div class="trip-stage-icon">
                    <!-- <svg aria-hidden="true" width="48" height="48"> -->
                    <svg aria-hidden="true" width="100%" height="100%">
                        <use xlink:href="#stage1-trip"></use>
                    </svg>
                </div>
                <div class="trip__stage-divider">
                    <svg aria-hidden="true" width="64" height="120">
                        <use xlink:href="#stage-divider"></use>
                    </svg>
                </div>
            </div>
            <div class="cell-4 trip__stage">
                <div class="big_font">1 часа <div class="big_font_subtext">около</div>
                </div>
                <div class="small_font">
                    продолжительность экскурсий с аудиогидом
                </div>
                <div class="trip-stage-icon">
                    <!-- <svg aria-hidden="true" width="55" height="55"> -->
                    <svg aria-hidden="true" width="100%" height="100%">
                        <use xlink:href="#stage2-trip"></use>
                    </svg>
                </div>
                <div class="trip__stage-divider">
                    <svg aria-hidden="true" width="64" height="120">
                        <use xlink:href="#stage-divider"></use>
                    </svg>
                </div>
            </div>
            <div class="cell-4 trip__stage">
                <div class="big_font">20</div>
                <div class="small_font">
                    информационных конструкций с QR-кодом
                </div>
                <div class="trip-stage-icon">
                    <!-- <svg aria-hidden="true" width="48" height="48"> -->
                    <svg aria-hidden="true" width="100%" height="100%">
                        <use xlink:href="#stage3-trip"></use>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="trip__map">

    <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => SITE_TEMPLATE_PATH . "/include/historical_line_map.php"
        )
    );
    ?>
</div>
<div class="container container_relative">

    <!-- // зум карты расположен здесь для фикса z-index перекрытия -->
    <div class="zoom_container">
        <div class="zoom_limiter">
            <svg id="zoom_viewBox" width="100%" height="100%"></svg>
        </div>
    </div>

    <!-- точки с аудио -->
    <div class="trip__points row">
        <?
        $arSelect = array(
            "ID",
            "IBLOCK_ID",
            "NAME",
            "DETAIL_PAGE_URL",
            "PROPERTY_IS_HISTORICAL_LINE_OBJECT",
            "PROPERTY_HISTORICAL_LINE_ID",
            "PROPERTY_HISTORICAL_LINE_POINT_IMG",
            "PROPERTY_HISTORICAL_LINE_POINT_TEXT",
            "CODE"
        );
        $arFilter = array("IBLOCK_ID" => 4, "PROPERTY_IS_HISTORICAL_LINE_OBJECT_VALUE" => 'Да', "ACTIVE" => "Y");
        $res = CIBlockElement::GetList(array("PROPERTY_HISTORICAL_LINE_ID" => "ASC"), $arFilter, false, array(), $arSelect);

        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            console_log($arFields);
        ?>
            <div data-audio-id="<?= $arFields["PROPERTY_HISTORICAL_LINE_ID_VALUE"] ?>" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
                <a href="<?= $arFields["DETAIL_PAGE_URL"] ?>" class="point__img">
                    <img src="<?= CFile::GetPath($arFields["PROPERTY_HISTORICAL_LINE_POINT_IMG_VALUE"]) ?>" alt="">
                </a>
                <div class="point__number_wrap">
                    <div class="point__number">
                        <div class="point__number_current"><?= $arFields["PROPERTY_HISTORICAL_LINE_ID_VALUE"] ?></div>
                    </div>
                    <div class="point__audio">
                        <svg aria-hidden="true" width="58" height="58">
                            <use xlink:href="#icon-trip-audio"></use>
                        </svg>
                    </div>
                </div>
                <a class="point__place-name" href="<?= $arFields["DETAIL_PAGE_URL"] ?>">
                    <?= $arFields["NAME"] ?>
                </a>
                <div class="point__place-info">
                    <?= $arFields["PROPERTY_HISTORICAL_LINE_POINT_TEXT_VALUE"] ?>
                </div>
            </div>

        <?
        }
        ?>


    </div>
</div>
<div class="audio-tours__player">
    <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => SITE_TEMPLATE_PATH . "/include/player.php"
        )
    );
    ?>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const pageHavePlayer = document.querySelector('.audio-player');

        if (pageHavePlayer) { // плейлист со страницы "Историческая линия"

            arMedia = [
                '1-univermag-torgovogo-doma-sukhova-synovya.mp3',
                '2-nagornyy-park.mp3',
                '3-dispetcherskiy-runkt-tramvaev.mp3',
                '4-botanicheskiy-sad.mp3',
                '5-narodnyy-dom.mp3',
                '6-zdanie-instrumentalnogo-magazina.mp3',
                '7-zdanie-kantselyarii-kolyvano-voskresenskogo-zavoda.mp3',
                '8-kompleks-sooruzheniy-serebroplavilnogo-zavoda.mp3',
                '9-demidovskaya-ploshchad-1.mp3',
                '10-zdanie-chertyezhnoy.mp3',
                '11-zdanie-gornoy-laboratorii.mp3',
                '12-zdanie-apteki.mp3',
                '13-upravlenie-altayskogo-okruga.mp3',
                '14-ploshchad-svobody.mp3',
                '15-ulitsa-pushkina.mp3',
                '16-teatr-kukol-skazka-i-kinoteatr-sibir.mp3',
                '17-skver-imeni-pushkina.mp3',
                '18-prospekt-lenina-2-0.mp3',
                '19-ulitsa-lva-tolstogo.mp3',
                '20-ulitsa-malo-tobolskaya.mp3',
            ];
            var playlist = []

            if (arMedia.length > 0) {
                arMedia.forEach((filename, id) => {
                    playlist.push({
                        title: filename,
                        file: "/historical_line/audio/" + filename,
                        howl: null
                    });
                });
            }

            // console.log(playlist);
            var audioBtns = document.querySelectorAll('.point__audio');
            var player = new Player(playlist);

            audioBtns.forEach((item, idx) => {
                item.addEventListener('click', e => {

                    var el = e.target.closest('.audio-list-cell');
                    var audioID = el.getAttribute('data-audio-id');
                    var currBtn = el.querySelector('.point__audio use').getAttribute('xlink:href');
                    if (currBtn === '#icon-trip-audio') {

                        var imageTags = document.querySelectorAll(".point__audio use");
                        imageTags.forEach((imageTag) => {
                            var xlinkHref = imageTag.getAttribute("xlink:href");
                            if (xlinkHref === "#media-audio-pause") {
                                imageTag.setAttribute('xlink:href', '#icon-trip-audio');
                            }
                        });

                        el.querySelector('.point__audio use').setAttribute('xlink:href', '#media-audio-pause');
                        player.skipTo(parseInt(audioID) - 1);

                    } else {
                        el.querySelector('.point__audio use').setAttribute('xlink:href', '#icon-trip-audio');
                        player.pause();
                    }
                });
            });
        }
    });
</script>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>