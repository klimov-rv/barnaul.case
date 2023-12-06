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
    });
    getPointsData(); // assume this function fetches the points data
    function handleResponse(response) {
        var allPoints = [];
        for (const property in response) {
            allPoints.push(response[property]);
        }

        var geoObjects = allPoints.map(function (point) {
            var image, ph, partner;
            if (!empty(point) && !empty(point.ir) && !empty(rubs[point.ir]) && !empty(rubs[point.ir]['i'])) {
                image = '/upload/' + rubs[point.ir]['i'];
            } else {
                image = 'https://api-maps.yandex.ru/2.1.77/images/layout/default.png';
            }

            if (point.ph !== "/") {
                ph = '<img width="200" src="/upload/' + point.ph + '" alt="" />';
            } else {
                ph = '<img width="200" src="/map/img/no_image.png" alt="" />';
            }

            if (!empty(point.pr)) {
                partner = '<img class="map_img_partner" width="75" height="75" src="/map/img/partner.png" alt="" />';
            }

            var placemark = new ymaps.Placemark(
                [point.lo, point.la],
                {
                    clusterCaption: point.n,
                    hintContent: point['n'],
                    balloonContentBody: '<div class="mapobj_info"><div class="map_forimg"><a href="' + point.nur + '">' + partner + '' + ph + '</a></div><div class="map_inf"><div class="mapobj_tit_wrap"><a class="mapobj_tit" href="' + point.nur + '">' + point.n + '</a></div><span>' +/*rubs[ point.ir ].n*/'' + '</span><div class="map_description">' + point.m + '</div><a href="' + point.nur + '" class="map-window__btn">Подробнее</a></div></div>'
                },
                {
                    hideIconOnBalloonOpen: true,
                    balloonMaxWidth: 260,
                    balloonMinWidth: 260,
                    iconLayout: 'default#image',
                    iconImageHref: image,
                    iconImageSize: [32, 37],
                    iconImageOffset: [-16, -37]
                }
            );

            return placemark;
        });

        clusterer.add(geoObjects);
        map.geoObjects.add(clusterer);
        map.setBounds(map.geoObjects.getBounds(), {
            checkZoomRange: true
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

