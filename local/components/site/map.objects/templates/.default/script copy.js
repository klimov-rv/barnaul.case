const is_array = (mixed_var) => {
    return Array.isArray(mixed_var);
};

const empty = (mixed_var) => {
    return (mixed_var === "" || mixed_var === 0 || mixed_var === "0" || mixed_var === null || mixed_var === false || (is_array(mixed_var) && mixed_var.length === 0) || mixed_var === undefined);
};
var map,
    points,
    cpoints,
    spoints,
    way_on_map = null,
    sel_way = 0,
    sel_region = 0,
    group = null,
    params = [],
    search_length = 0,
    balloon = null; //in minutes

var options = {
    zoom: 12,
    cLat: 53.35451615083649, // center
    cLng: 83.72724894482427
}

function MyMap() {
}
MyMap.prototype = {

    getPoints: function (param) {
        var m = this;
        $.getJSON('/map/getMap.php?' + param, function (json, s) {
            cpoints = json;
            console.log(cpoints);
            m.setPoints(0, 0, 1);
        });

    },

    SetRubs: function () {

        //this.showInfo(false); // hide popup if visible
    },

    setPoints: function (id_rub, insearch, init) {

        map.balloon.close();
        if (id_rub != 0) {
            sel_way = 0;
            sel_region = 0;
            params[id_rub] = (params[id_rub] == 0) ? id_rub : 0;

        }

        points = (insearch) ? spoints : cpoints;

        var m = this;
        //this.showInfo(false); // hide popup if visible
        if (group !== null) { // clear marker group
            group.removeAll();
            map.geoObjects.remove(group);
            yPoint = [];
        }
        if (way_on_map !== null && sel_way == 0) {
            map.geoObjects.remove(way_on_map);
        }

        var color = 'green';

        group = new ymaps.Clusterer();
        group.options.set({
            gridSize: 50, // Размер кластерной сетки (объекты попавшие в данную сетку будут кластеризоваться)
            clusterBalloonWidth: 900, // Ширина блока с контентом в балуне
            balloonMinWidth: 300, // Ширина балуна
            clusterBalloonHeight: 350, // Высота балуна
            clusterBalloonSidebarWidth: 300, // Ширина правой стороны балуна (список меток)
            clusterIconLayout: 'default#pieChart',
            // Ширина линий-разделителей секторов и внешней обводки диаграммы.
            clusterIconPieChartStrokeWidth: 0,
        });

        for (p in points) {
            if (
                params[points[p].ir] != 0 ||
                (id_rub == 0 && points[p].po == 1 && sel_way == 0 && sel_region == 0) ||
                insearch == 1 ||
                (sel_way != 0 && map_ways_objs[sel_way][points[p].id] == 1) ||
                (sel_region != 0 && map_reg_objs[sel_region][points[p].id] == 1)

            ) {
                if ((init && points[p].po == 1) || !init) {

                    if (!empty(points[p]) && !empty(points[p].ir) && !empty(rubs[points[p].ir]) && !empty(rubs[points[p].ir]['i'])) {
                        var image = '/upload/' + rubs[points[p].ir]['i'];
                    } else {
                        var image = 'https://api-maps.yandex.ru/2.0.35/images/b87da66ef0c9c83eab04b13bb99d2599.png';
                    }
                    if (points[p].ph != "/") {
                        ph = '<img width="200" src="/upload/' + points[p].ph + '" alt="" />';
                    } else {
                        ph = '<img width="200" src="/map/img/no_image.png" alt="" />';
                    }

                    var partner = "";
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

                    if (!empty(points[p].pr)) {
                        partner = '<img class="map_img_partner" width="75" height="75" src="/map/img/partner.png" alt="" />';
                    }
                    group.add(new ymaps.Placemark(
                        // Координаты метки
                        [points[p].lo, points[p].la],
                        {
                            clusterCaption: points[p].n,
                            hintContent: points[p]['n'],
                            balloonContentBody: '<div class="mapobj_info"><div class="map_forimg"><a href="' + points[p].nur + '">' + partner + '' + ph + '</a></div><div class="map_inf"><div class="mapobj_tit_wrap"><a class="mapobj_tit" href="' + points[p].nur + '">' + points[p].n + '</a></div><span>' +/*rubs[ points[p].ir ].n*/'' + '</span><div class="map_description">' + points[p].m + '</div><a href="' + points[p].nur + '" class="map-window__btn">Подробнее</a></div></div>',
                        }, {
                            hideIconOnBalloonOpen: true,
                            balloonMaxWidth: 260,
                            balloonMinWidth: 260, // Ширина балуна
                            iconLayout: 'default#image',
                            iconImageHref: image, // картинка иконки
                            iconImageSize: [32, 37], // размеры картинки
                            iconImageOffset: [-16, -37], // смещение картинки
                            iconColor: iconColorForCluster,
                        })
                    );
                }



            }
        }

        map.geoObjects.add(group); // add yandex group overlay

    },

    goSearch: function (val) {
        se_len = val.length;
        var m = this;
        if (se_len != search_length && se_len > 2) {

            //$("#x3-map-sections").hide(); 
        }
    },

    initSearch: function () {
        var m = this;
        $("#x3-map-input").keyup(function (e) {

            m.goSearch($(this).val());

        });

    },

    init: function () {

        var m = this;



        map = new ymaps.Map('x3-map-wrap', {
            center: [53.35451615083649, 83.72724894482427],
            zoom: 12
        });


        map.controls.add('typeSelector', { 'left': 100 });
        map.controls.add('zoomControl');
        map.controls.add('mapTools');

        map.events.add('mousedown', function () {
            MapHelp(1);
        });
        map.events.add('boundschange', function () {
            MapHelp(1);
        });
        MyMap.SetRubs();
        MyMap.getPoints('');
        MyMap.initSearch();

    }

}

var MyMap = new MyMap;

function MapHelp(t) {

    rel = $("#map_helplink").attr("rel");
    if (t == 0 && rel == 0) {
        $(".help").show();
        $("#map_helplink").html("Скрыть подсказки").attr("rel", 1);
    } else {

        $(".help").hide();
        $("#map_helplink").html("Показать подсказки").attr("rel", 0);

    }

}

$(document).ready(function () {

    ymaps.ready(MyMap.init);

    $(".x3-map-filter__level1").click(function () {
        $(this).parent("li").toggleClass("_open");
        $(this).next("ul").slideToggle();
        return false;
    });

});

