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
        <div data-audio-id="1" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_01.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">1</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Универмаг торгового дома «Д.Н. Сухова сыновья»
            </div>
            <div class="point__place-info">
                Крупнейшее торговое здание Барнаула конца ХIХ века
            </div>
        </div>

        <div data-audio-id="2" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_02.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">2</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Нагорный парк
            </div>
            <div class="point__place-info">
                Главная видовая точка Барнаула. С его террас открывается панорамный вид на город и реку Обь. Отличное место для неспешных прогулок и спокойного отдыха.

            </div>
        </div>

        <div data-audio-id="3" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_03.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">3</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Здание диспетчерской
            </div>
            <div class="point__place-info">
                Уникальное здание, построенное в стиле конструктивизма – диспетчерский пункт трамваев и одновременно остановочный павильон в форме трамвайной кабины.

            </div>
        </div>

        <div data-audio-id="4" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_04.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">4</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Ботанический сад
            </div>
            <div class="point__place-info">
                Самый старый парк Барнаула. Еще раньше – аптекарский огород, где выращивались лекарственные растения для лечения горных офицеров.
            </div>
        </div>

        <div data-audio-id="5" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_05.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">5</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Народный дом
            </div>
            <div class="point__place-info">Народный дом являлся центром общественно-культурной жизни дореволюционного Барнаула. В настоящее время здесь расположена Государственная филармония Алтайского края.
            </div>
        </div>

        <div data-audio-id="6" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_06.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">6</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Здание инструментального магазина
            </div>
            <div class="point__place-info">
                Здесь хранились инструменты и материалы для рудников, заводов и лабораторий Колывано-Воскресенского (Алтайского) горного округа, а также находилась казна Барнаульского сереброплавильного завода. Именно отсюда караваны с серебром ежегодно отправлялись в Санкт-Петербург.
            </div>
        </div>

        <div data-audio-id="7" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_07.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">7</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Здание канцелярии Колывано-Воскресенского завода
            </div>
            <div class="point__place-info">
                Первое каменное двухэтажное здание города. В первом здании канцелярии, которое не дошло до наших дней, работал изобретатель первой в России паросиловой установки и первого в мире двухцилиндрового парового двигателя Иван Иванович Ползунов.
            </div>
        </div>

        <div data-audio-id="8" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_08.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">8</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Комплекс сооружений Сереброплавильного завода
            </div>
            <div class="point__place-info">
                Это единственный сохранившийся в России промышленный комплекс по производству серебра XVIII века. Завод был построен Акинфием Демидовым для выплавки меди и серебра из алтайский руд. Город Барнаул создавался и развивался вокруг завода.
            </div>
        </div>

        <div data-audio-id="9" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_09.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">9</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Демидовская площадь
            </div>
            <div class="point__place-info">
                Демидовская площадь – одна из старейших площадей города, культурный и деловой центр Барнаула XX века. Здесь находится обелиск, посвященный 100-летию горнорудного производства на Алтае.

            </div>
        </div>

        <div data-audio-id="10" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_10.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">10</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Здание чертёжной
            </div>
            <div class="point__place-info">
                Здесь проектировались алтайские заводы, рудники и населённые пункты.
            </div>
        </div>

        <div data-audio-id="11" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_11.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">11</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Здание горной лаборатории
            </div>
            <div class="point__place-info">
                Здание построено для лаборатории сереброплавильного завода. Здесь проводились анализы сплавов меди, серебра и золота. В 1913-1915 годах здание приспособили под музей.

            </div>
        </div>

        <div data-audio-id="12" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_12.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">12</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Здание аптеки
            </div>
            <div class="point__place-info">
                Горная аптека – одно из первых кирпичных зданий Барнаула. Здесь изготавливали лекарства на базе лесных растений, которые выращивались напротив, в аптекарском огороде.
            </div>
        </div>

        <div data-audio-id="13" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_13.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">13</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Управление Алтайского округа
            </div>
            <div class="point__place-info">
                Деревянное одноэтажное здание главного управления Алтайского горного округа – образец деревянного административного зодчества конца XIX века.
            </div>
        </div>

        <div data-audio-id="14" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_14.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">14</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Площадь Свободы
            </div>
            <div class="point__place-info">
                Историческое название площади Свободы – Соборная. Свое наименование она получила благодаря Петропавловскому собору. Это был один из первых храмов города, имел статус главной церкви Колывано-Воскресенского горного округа.
            </div>
        </div>

        <div data-audio-id="15" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_15.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">15</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Улица Пушкина
            </div>
            <div class="point__place-info">
                Первоначально – Иркутская линия – одна из самых старых улиц города. Именно здесь проживал изобретатель первой в России паровой машины Иван Иванович Ползунов.
            </div>
        </div>

        <div data-audio-id="16" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_16.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">16</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Театр кукол «Сказка» и концертный зал «Сибирь»
            </div>
            <div class="point__place-info">
                Театр кукол и концертный зал «Сибирь» являются современными объектами культуры в Алтайском крае.
            </div>
        </div>

        <div data-audio-id="17" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_17.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">17</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Сквер имени Пушкина
            </div>
            <div class="point__place-info">
                Здесь находится памятник Пушкину, который открыли к 200 летней годовщине поэта в 1999 году. А ранее на этом месте располагался «Пассаж Смирнова» – самый большой торговый объект Барнаула начала XX века.
            </div>
        </div>

        <div data-audio-id="18" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_18.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">18</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Проспект Ленина
            </div>
            <div class="point__place-info">
                Одна из старейших улиц Барнаула. Проспект является главным местом прогулок для жителей и гостей города.
            </div>
        </div>

        <div data-audio-id="19" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_19.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">19</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Улица Льва Толстого
            </div>
            <div class="point__place-info">
                Современная улица Льва Толстого являлась главной купеческой улицей города. Здесь располагались торговые лавки и дома купцов.
            </div>
        </div>

        <div data-audio-id="20" class="audio-list-cell cell-fifth cell-3-lg cell-4-md cell-6-sm cell-12-xs">
            <div class="point__img">
                <img src="/upload/historical_line/points/point_20.png" alt="">
            </div>
            <div class="point__number_wrap">
                <div class="point__number">
                    <div class="point__number_current">20</div>
                </div>
                <div class="point__audio">
                    <svg aria-hidden="true" width="58" height="58">
                        <use xlink:href="#icon-trip-audio"></use>
                    </svg>
                </div>
            </div>
            <div class="point__place-name">
                Улица Мало-Тобольская
            </div>
            <div class="point__place-info">
                Старейшая торговая улица Барнаула, именно здесь была расположена первая торговая площадь города. В настоящее время является единственной пешеходной улицей города.

            </div>
        </div>
    </div>
</div>
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

            // var mapPointsPlayBtns = document.querySelectorAll('.duplicate_point_el');

            // mapPointsPlayBtns.forEach((item, idx) => {
            //     item.addEventListener('click', e => {
            //         var btnId = e.target.getAttribute('data-point-id')
            //         audioBtns.forEach((item, idx) => {

            //             var el = item.closest('.audio-list-cell');
            //             var audioID = el.getAttribute('data-audio-id');
            //             console.log(audioID === btnId);
            //         })
            //     })
            // })
        }
    });
</script>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>