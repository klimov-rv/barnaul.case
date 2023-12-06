const is_array = (mixed_var) => {
    return Array.isArray(mixed_var);
};

const empty = (mixed_var) => {
    return (mixed_var === "" || mixed_var === 0 || mixed_var === "0" || mixed_var === null || mixed_var === false || (is_array(mixed_var) && mixed_var.length === 0) || mixed_var === undefined);
};

var map, placemarks, clusterer,
    points,
    spoints,

    way_on_map = null,
    sel_way = 0,
    sel_region = 0,
    clusterer = null,
    params = [],
    search_length = 0;


function MyMap() {
}
MyMap.prototype = {

    init: function () {
        this.map = new ymaps.Map('x3-map-wrap', {
            center: [53.35451615083649, 83.72724894482427],
            zoom: 12
        });
    },
    getPoints: function (param) {
        $.getJSON('/map/getMap.php', function (json, status) {
            this.cpoints = this.handlePoints(json);
        });
    },


    handlePoints: function (response) {
        var points = [];
        for (const property in response) {
            points.push(response[property]);
        }
        return points;
    },

    setPoints: function (id_rub, insearch, init) {
        this.map.balloon.close();
        if (id_rub != 0) {
            sel_way = 0;
            sel_region = 0;
            params[id_rub] = (params[id_rub] == 0) ? id_rub : 0;
        }

        if (clusterer !== null) { // clear marker clusterer
            clusterer.removeAll();
            this.map.geoObjects.remove(clusterer);
            yPoint = [];
        }

        if (way_on_map !== null && sel_way == 0) {
            this.map.geoObjects.remove(way_on_map);
        }

        clusterer = new ymaps.Clusterer({
            gridSize: 50, // Размер кластерной сетки (объекты попавшие в данную сетку будут кластеризоваться)
            clusterBalloonWidth: 900, // Ширина блока с контентом в балуне
            balloonMinWidth: 300, // Ширина балуна
            clusterBalloonHeight: 350, // Высота балуна
            clusterBalloonSidebarWidth: 300, // Ширина правой стороны балуна (список меток)
            clusterIconLayout: 'default#pieChart',
            // Ширина линий-разделителей секторов и внешней обводки диаграммы.
            clusterIconPieChartStrokeWidth: 0,
        });

        points = (insearch) ? spoints : this.cpoints;


        var geoObjects = points.map(function (point) {
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
                iconLayout: 'default#image',
                iconImageHref: image, // картинка иконки
                iconImageSize: [32, 37], // размеры картинки
                iconImageOffset: [-16, -37], // смещение картинки
                iconColor: iconColorForCluster,
            });
            return placemark;
        });

        clusterer.add(geoObjects);
        this.map.geoObjects.add(clusterer);


    },

    goSearch: function (val) {
        se_len = val.length;
        if (se_len != search_length && se_len > 2) {

            if (way_on_map !== null && sel_way != 0) {
                this.map.geoObjects.remove(way_on_map);
            }

            $('#help-visibility').click();
            $("#al_rubs").hide();
            $("#search_result").show();

            $("#search_result").html('<img src="/map/img/ajax.gif" alt="загрузка" style="margin: 5px 0 0 80px;" />');
            $.post(
                "/map/getSearch.php",
                {
                    'act': 'search',
                    'w': val
                }).done(function (sp) {
                    MapHelp(1);
                    sp = JSON.parse(sp);
                    spoints = sp;
                    this.setPoints(0, 1);
                    li = '';

                    for (p in sp) {
                        li += '<li class="r_' + sp[p].ir + '" rel="' + p + '"><a href="' + sp[p].nur + '">' + sp[p].n + '</a></li>';
                    }

                    if (li == '') {
                        $("#search_result").html('<h4 style="text-align: center; margin-top: 30px;">По вашему запросу ничего не найдено<br /><br /> <a href="javascript: void(0);" onclick="$(\'#search_field\').focus();$(\'#search_field\').val(\'\');">искать заново</a></h4>');
                    } else {
                        $("#search_result").html('<ul>' + li + '</ul>');
                        $("#search_result a").click(function () {
                            MapHelp(1);
                            i = $(this).parent().attr('rel');
                            this.map.setCenter([points[i].lo, points[i].la], 12, {
                                duration: 100,
                                checkZoomRange: true,
                                callback: function () {
                                    var projection = this.map.options.get('projection');
                                    var position = yPoint[i].geometry.getCoordinates();
                                    var pc = this.map.converter.globalToPage(projection.toGlobalPixels(position, this.map.getZoom()));
                                    this.showInfo(true, this.eq(i), pc);
                                }
                            });
                            return false;
                        });
                    }
                },
                    'json'
                );
        } else if (se_len != 1) {
            $("#search_result").hide();
            $("#al_rubs").show();

            this.setPoints(0);
        }
    },

    initSearch: function () {
        $("#search_field").keyup(function (e) {

            this.goSearch($(this).val());

        });

    },
}


$(document).ready(function () {
    ymaps.ready(MyMap.init);
});




