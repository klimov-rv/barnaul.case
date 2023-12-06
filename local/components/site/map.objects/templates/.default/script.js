const is_array = (mixed_var) => {
    return Array.isArray(mixed_var);
};

const empty = (mixed_var) => {
    return (mixed_var === "" || mixed_var === 0 || mixed_var === "0" || mixed_var === null || mixed_var === false || (is_array(mixed_var) && mixed_var.length === 0) || mixed_var === undefined);
};

var map;
var placemarks = [];
var clusterer;

ymaps.ready(init);

function init() {
    map = new ymaps.Map('x3-map-wrap', {
        center: [53.35451615083649, 83.72724894482427],
        zoom: 12
    });
    clusterer = new ymaps.Clusterer({
        gridSize: 50, // Размер кластерной сетки (объекты попавшие в данную сетку будут кластеризоваться)
        clusterBalloonWidth: 600, // Ширина блока с контентом в балуне
        balloonMinWidth: 300, // Ширина балуна
        clusterBalloonHeight: 350, // Высота балуна
        clusterBalloonSidebarWidth: 300, // Ширина правой стороны балуна (список меток)
        clusterIconLayout: 'default#pieChart',
        // Ширина линий-разделителей секторов и внешней обводки диаграммы.
        clusterIconPieChartStrokeWidth: 0,
    });
    getPointsData(); // assume this function fetches the points data
    function handleResponse(response) {
        var allPoints = [];
        for (const property in response) {
            allPoints.push(response[property]);
        }
        console.log(allPoints);

        var geoObjects = allPoints.map(function (point) {
            var image, ph, partner;
            if (!empty(point) && !empty(point.ir) && !empty(rubs[point.ir]) && !empty(rubs[point.ir]['i'])) {
                var image = '/upload/' + rubs[point.ir]['i'];
            } else {
                var image = 'https://api-maps.yandex.ru/2.0.35/images/b87da66ef0c9c83eab04b13bb99d2599.png';
            }
            if (point.ph != "/") {
                var ph = '<img width="200" src="/upload/' + point.ph + '" alt="" />';
            } else {
                var ph = '<img width="200" src="/map/img/no_image.png" alt="" />';
            }
            var iconColorForCluster = '#e08f40';
            if (
                image === '/upload/uf/1d0/s21ggzhgq9y57y0fh8yj0exgpns2xypr/001.svg' ||
                image === '/upload/uf/658/hx01270eypqtkzcejn976ciegoyrhr6e/001.svg'
            ) {
                // оранжевый 
                iconColorForCluster = '#e08f40';

            } else if (
                image === '/upload/uf/1d4/4q7k9whuckvwk38bcfz76pkcj4yyzoes/1.svg' ||
                image === '/upload/uf/74b/266mkks091pjaa2q1lzsh0bfxa7mfg6h/1.svg' ||
                image === '/upload/uf/8f7/wc83l5xyytlcqmv7ygzew0l4fjdylnpv/1.svg' ||
                image === '/upload/uf/1e1/bi7gvm9zr5nbcq5hvtb7hv9xmohibyn8/1.svg'
            ) {
                // зелёный 
                iconColorForCluster = '#5a9d32';
            } else if (
                image === '/upload/uf/14c/l1an6vc8vmom6stc5jrdlsgp2uwumi2k/1.svg' ||
                image === '/upload/uf/60f/y46yvyhta8co6baiq9c34jfex6fc0o3r/1.svg'
            ) {
                // коричневый
                iconColorForCluster = '#9c8762';
            }

            if (!empty(point.pr)) {
                partner = '<img class="map_img_partner" width="75" height="75" src="/map/img/partner.png" alt="" />';
            }
            var placemark = new ymaps.Placemark([point.lo, point.la], {
                clusterCaption: point.n,
                hintContent: point['n'],
                balloonContentBody: '<div class="mapobj_info"><div class="map_forimg"><a href="' + point.nur + '">' + partner + '' + ph + '</a></div><div class="map_inf"><div class="mapobj_tit_wrap"><a class="mapobj_tit" href="' + point.nur + '">' + point.n + '</a></div><span>' +/*rubs[ point.ir ].n*/'' + '</span><div class="map_description">' + point.m + '</div><a href="' + point.nur + '" class="map-window__btn">Подробнее</a></div></div>',
            }, {
                hideIconOnBalloonOpen: true,
                balloonMaxWidth: 260,
                balloonMinWidth: 260, // Ширина балуна
                iconImageHref: image, // картинка иконки
                iconImageSize: [32, 37], // размеры картинки
                iconImageOffset: [-16, -37], // смещение картинки
                iconColor: iconColorForCluster,
            });

            placemark.events.add('mapchange', function () {
                if (clusterer.has(placemark)) {
                    console.log('point enter clusterer');
                    placemark.options.set('iconColor', iconColorForCluster);
                } else {
                    console.log('point leave clusterer');
                    placemark.options.set('iconImageHref', image);
                }
            });


            return placemark;
        });

        clusterer.add(geoObjects);
        map.geoObjects.add(clusterer);
        map.setBounds(map.geoObjects.getBounds(), {
            checkZoomRange: true
        });
    }

    // Sample function to fetch points from the server
    function getPointsData() {
        // Assuming this is your previous getPoints function
        $.getJSON('/map/getMap.php', function (json, status) {
            handleResponse(json);
        });
    }
}

