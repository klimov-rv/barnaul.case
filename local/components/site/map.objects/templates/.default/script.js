const is_array = (mixed_var) => {
    return Array.isArray(mixed_var);
};

const empty = (mixed_var) => {
    return (mixed_var === "" || mixed_var === 0 || mixed_var === "0" || mixed_var === null || mixed_var === false || (is_array(mixed_var) && mixed_var.length === 0) || mixed_var === undefined);
};

var map, placemarks, clusterer, points,

    way_on_map = null,
    sel_way = 0,
    sel_region = 0,
    clusterer = null,
    params = [],
    search_length = 0;


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

function MyMap() {
}

MyMap.prototype = {

    init: function () {
        map = new ymaps.Map('x3-map-wrap', {
            center: [53.35451615083649, 83.72724894482427],
            zoom: 12
        });
        MyMap.setFilterEvents();
        MyMap.getPoints();
    },

    getPoints: function (param) {
        $.getJSON('/map/getMap.php', function (json, status) {
            if (status === 'success') {
                MyMap.points = MyMap.handleResPoints(json);
                MyMap.setPoints(0, json, true);
            }
        });
    },

    handleResPoints: function (response) {
        var arPoints = [];
        for (const prop in response) {
            arPoints.push(response[prop]);
        }
        return arPoints;
    },

    setPoints: function (id_rub, points = { ...MyMap.points }, init = false, isSearch = false) {
        points = JSON.parse(JSON.stringify((!is_array(points)) ? MyMap.adaptPointsArray(points) : points));
        map.balloon.close();
        if (id_rub != 0) {
            sel_way = 0;
            sel_region = 0;
            params[id_rub] = (params[id_rub] == 0) ? id_rub : 0;
        }
        if (clusterer !== null) { // clear marker clusterer
            clusterer.removeAll();
            map.geoObjects.remove(clusterer);
            yPoint = [];
        }

        if (way_on_map !== null && sel_way == 0) {
            map.geoObjects.remove(way_on_map);
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

        var geoObjects = points.map(function (this_point) {
            var image, ph, partner = "";
            if (
                params[this_point.ir] != 0 ||
                (id_rub == 0 && this_point.po == 1) || isSearch
            ) {
                if ((init && this_point.po == 1) || !init) {
                    if (!empty(this_point) && !empty(this_point.ir) && !empty(rubs[this_point.ir]) && !empty(rubs[this_point.ir]['i'])) {
                        var image = '/upload/' + rubs[this_point.ir]['i'];
                    } else {
                        var image = 'https://api-maps.yandex.ru/2.0.35/images/b87da66ef0c9c83eab04b13bb99d2599.png';
                    }
                    if (this_point.ph != "/") {
                        var ph = '<img width="200" src="/upload/' + this_point.ph + '" alt="" />';
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
                        image === '/upload/uf/8f7/wc83l5xyytlcqmv7ygzew0l4fjdylnpv/1.svg'
                    ) {
                        // зелёный 
                        iconColorForCluster = '#5a9d32';
                    } else if (
                        image === '/upload/uf/14c/l1an6vc8vmom6stc5jrdlsgp2uwumi2k/1.svg' ||
                        image === '/upload/uf/60f/y46yvyhta8co6baiq9c34jfex6fc0o3r/1.svg' ||
                        image === '/upload/uf/1e1/bi7gvm9zr5nbcq5hvtb7hv9xmohibyn8/1.svg'
                    ) {
                        // коричневый
                        iconColorForCluster = '#9c8762';
                    }

                    if (!empty(this_point.pr)) {
                        partner = '<img class="map_img_partner" width="75" height="75" src="/map/img/partner_new.png" alt="" />';
                    }

                    var placemark = new ymaps.Placemark([this_point.lo, this_point.la], {
                        clusterCaption: this_point.n,
                        hintContent: this_point['n'],
                        balloonContentBody: '<div class="mapobj_info"><div class="map_forimg"><a href="' + this_point.nur + '">' + partner + '' + ph + '</a></div><div class="map_inf"><div class="mapobj_tit_wrap"><a class="mapobj_tit" href="' + this_point.nur + '">' + this_point.n + '</a></div><span>' +/*rubs[ this_point.ir ].n*/'' + '</span><div class="map_description">' + this_point.m + '</div><a href="' + this_point.nur + '" class="map-window__btn">Подробнее</a></div></div>',
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
                    clusterer.add(placemark);
                    return placemark;
                }
            }

        });
        if (!empty(geoObjects)) {
            map.geoObjects.add(clusterer);
        }


    },

    adaptPointsArray: function (objPoints) {
        var arPoints = [];
        for (const el in objPoints) {
            arPoints.push(objPoints[el]);
        }
        console.log(objPoints);
        console.log(MyMap.points);
        return arPoints;
    },

    goSearch: function (val) {
        se_len = val.length;
        if (se_len != search_length && se_len > 2) {

            if (way_on_map !== null && sel_way != 0) {
                map.geoObjects.remove(way_on_map);
            }

            $('#help-visibility').click();
            //$("#x3-map-sections").hide();
            $("#x3-map-result").show();

            $("#x3-map-result").html('<img src="/map/img/ajax.gif" alt="загрузка" style="margin: 5px 0 0 80px;" />');
            $.post(
                "/map/getSearch.php",
                {
                    'act': 'search',
                    'w': val
                }).done(function (arResPoints) {
                    MapHelp(1);

                    arResPoints = (!is_array(arResPoints)) ? MyMap.adaptPointsArray(JSON.parse(arResPoints)) : JSON.parse(arResPoints);
                    MyMap.setPoints(0, arResPoints, false, true);
                    li = '';
                    for (point of arResPoints) {
                        li += '<li class="r_' + point.ir + '" rel="' + point + '"><a href="' + point.nur + '">' + point.n + '</a></li>';
                    }

                    if (li == '') {
                        $("#x3-map-result").html('<h4 style="text-align: center; margin-top: 30px;">По вашему запросу ничего не найдено<br /><br /> <a href="javascript: void(0);" onclick="$(\'#x3-map-input\').focus();$(\'#x3-map-input\').val(\'\');">искать заново</a></h4>');
                    } else {
                        $("#x3-map-result").html('<ul>' + li + '</ul>');
                        $("#x3-map-result a").click(function () {
                            MapHelp(1);
                            i = $(this).parent().attr('rel');
                            map.setCenter([points[i].lo, points[i].la], 12, {
                                duration: 100,
                                checkZoomRange: true,
                                callback: function () {
                                    var projection = map.options.get('projection');
                                    var position = yPoint[i].geometry.getCoordinates();
                                    var pc = map.converter.globalToPage(projection.toGlobalPixels(position, map.getZoom()));
                                    MyMap.showInfo(true, MyMap.eq(i), pc);
                                }
                            });
                            return false;
                        });
                    }
                },
                    'json'
                );
        } else if (se_len < 2) {
            $("#x3-map-result").hide();
            $("#x3-map-sections").show();
            console.log(MyMap.points);
            MyMap.setPoints(0, MyMap.points, true);
        }
    },

    setFilterEvents: function () {

        function checkArrayForZero(arr) {
            let nonEmptyCount = 0;
            let allZeros = true;

            for (let i = 0; i < arr.length; i++) {
                if (arr[i] !== undefined && arr[i] !== null) {
                    nonEmptyCount++;
                    if (arr[i] !== 0) {
                        allZeros = false;
                    }
                }
            }

            return allZeros;
        }

        $("#x3-map-input").keyup(function (e) {
            MyMap.goSearch($(this).val());
        });

        $("#x3-map-sections a.map_obj_list").each(function () {
            id = $(this).attr("id").split("_")[1];
            params[id] = ($(this).hasClass('act')) ? id : 0;
        });

        $("#x3-map-sections a.map_obj_list").click(function () {
            $("#x3-map-sections a.map_way_list").removeClass('act');
            $("#x3-map-sections a.map_region_list").removeClass('act');
            id = $(this).attr("id").split("_")[1];
            MyMap.setPoints(id);
            (params[id] != undefined && params[id] != 0) ? $(this).addClass("act") : $(this).removeClass("act");

            if (checkArrayForZero(params)) {
                MyMap.setPoints(0, MyMap.points, true);
            }

            // Количество выбранных элементов
            var objectsCnt = 0;
            $(".x3-map__sections a.act").each(function () {
                objectsCnt += $(this).data("cnt");
            });
            $(".js-close-filter span").text(objectsCnt);
            return false;
        });

        $("#x3-map-sections a.map_way_list").click(function () {
            $("#x3-map-sections a").removeClass('act');

            for (key in params) {
                params[key] = 0;
            }
            id = $(this).attr("id").split("_")[1];
            MyMap.setWay(id);
            $(this).addClass("act");
            return false;
        });

        $("#x3-map-sections a.map_region_list").click(function () {
            $("#x3-map-sections a").removeClass('act');


            for (key in params) {
                params[key] = 0;
            }
            id = $(this).attr("id").split("_")[1];
            MyMap.setRegion(id);
            $(this).addClass("act");
            return false;
        });

        $(".x3-map__clear a, .x3-map-filter__clear").click(function () {
            $(".x3-map__sections li a.act").each(function () {
                $(this).removeClass("act");
            });

            $(".x3-map-filter__btn span").text("");

            MyMap.setPoints(0, MyMap.points, true);
            for (key in params) {
                params[key] = 0;
            }
            return false;
        });

        $(".js-map-filter").click(function () {
            $(".x3-map__sections-wrap").show();
            return false;
        });

        $(".js-close-filter").click(function () {
            $(".x3-map__sections-wrap").hide();
            return false;
        });

    },
}

var MyMap = new MyMap;

$(document).ready(function () {

    ymaps.ready(MyMap.init);

    $(".x3-map-filter__level1").click(function () {
        $(this).parent("li").toggleClass("_open");
        $(this).next("ul").slideToggle();
        return false;
    });

});

