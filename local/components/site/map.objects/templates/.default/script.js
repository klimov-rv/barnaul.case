function is_array(mixed_var) {
    return (mixed_var instanceof Array);
}
function empty(mixed_var) {
    return (mixed_var === "" || mixed_var === 0 || mixed_var === "0" || mixed_var === null || mixed_var === false || (is_array(mixed_var) && mixed_var.length === 0) || mixed_var === undefined);
}
var map = null,
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

    getPoints: function(param) {

        var m = this;
        $.getJSON('/map/getMap.php?'+param, function(json, s) {
            cpoints = json;
            m.setPoints(0,0,1);
        });

    },

    SetRubs: function() {

        $("#x3-map-sections a.map_obj_list").each(function(){
            id = $(this).attr("id").split("_")[1];
            params[id] = ($(this).hasClass('act'))?id:0;
        });

        $("#x3-map-sections a.map_obj_list").click(function(){
            $("#x3-map-sections a.map_way_list").removeClass('act');
            $("#x3-map-sections a.map_region_list").removeClass('act');
            id = $(this).attr("id").split("_")[1];
            MyMap.setPoints(id);
            (params[id] != undefined && params[id] != 0) ? $(this).addClass("act"):$(this).removeClass("act");

            // Количество выбранных элементов
            var objectsCnt = 0;
            $(".x3-map__sections a.act").each(function(){
                objectsCnt += $(this).data("cnt");
            });
            $(".js-close-filter span").text(objectsCnt);
            return false;
        });

        $("#x3-map-sections a.map_way_list").click(function(){
            $("#x3-map-sections a").removeClass('act');

            for (key in params) {
                params[key] = 0;
            }
            id = $(this).attr("id").split("_")[1];
            MyMap.setWay(id);
            $(this).addClass("act");
            return false;
        });
        $("#x3-map-sections a.map_region_list").click(function(){
            $("#x3-map-sections a").removeClass('act');


            for (key in params) {
                params[key] = 0;
            }
            id = $(this).attr("id").split("_")[1];
            MyMap.setRegion(id);
            $(this).addClass("act");
            return false;
        });

        $(".x3-map__clear a, .x3-map-filter__clear").click(function(){
            $(".x3-map__sections li a.act").each(function(){
                $(this).removeClass("act");
            });

            $(".x3-map-filter__btn span").text("");

            MyMap.setPoints(0);
            for (key in params) {
                params[key] = 0;
            }
            return false;
        });

        $(".js-map-filter").click(function(){
            $(".x3-map__sections-wrap").show();
            return false;
        });

        $(".js-close-filter").click(function(){
            $(".x3-map__sections-wrap").hide();
            return false;
        });

    },

    setRegion: function (id) {

        var m = this;
        map.balloon.close();
        if (group !== null) { // clear marker group
            if (group !== null) {
                group.removeAll();
                map.geoObjects.remove(group);
                yPoint = [];
            }
            if (way_on_map !== null) {

                map.geoObjects.remove(way_on_map);

            }
            way_on_map = null;
            sel_way = 0;

            if ( map_reg_objs[id] ) {
                sel_region = id;
                // alert( map_ways[id]);


                MyMap.setPoints(0,0);

                if (map_reg_coord[id]) {
                    map.balloon.open(map_reg_coord[id], map_reg_info[id]  );
                }

            }

        }



    },
    setWay: function (id) {

        map.balloon.close();
        var m = this;
        if (group !== null) { // clear marker group
            if (group !== null) {
                group.removeAll();
                map.geoObjects.remove(group);
                yPoint = [];
            }
            if (way_on_map !== null) {

                map.geoObjects.remove(way_on_map);
            }

            sel_region = 0;
            if ( map_ways[id] ) {
                sel_way = id;
                // alert( map_ways[id]);

                way_on_map = new ymaps.Polyline(map_ways[id],{ hintContent: "Линия маршрута"}, {
                    strokeColor: '#ff0000',
                    strokeWidth: 3
                });
                map.geoObjects.add(way_on_map);
                MyMap.setPoints(0,0);

                map.balloon.open(map_ways[id][0], map_ways_info[id]  );

            }

        }

    },

    setPoints: function(id_rub,insearch,init) {

        map.balloon.close();
        if (id_rub != 0) {
            sel_way = 0;
            sel_region = 0;
            params[id_rub] = (params[id_rub] == 0)?id_rub:0;

        }

        points = (insearch)?spoints:cpoints;

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

        var  color = 'green';

        group = new ymaps.Clusterer();
        group.options.set({
            gridSize: 50, // Размер кластерной сетки (объекты попавшие в данную сетку будут кластеризоваться)
            clusterBalloonWidth: 600, // Ширина блока с контентом в балуне
            balloonMinWidth: 300, // Ширина балуна
            clusterBalloonHeight: 350, // Высота балуна
            clusterBalloonSidebarWidth: 300, // Ширина правой стороны балуна (список меток)
        });

        for (p in points){
            if (
                params[points[p].ir] != 0 ||
                (id_rub == 0 && points[p].po == 1 && sel_way == 0 && sel_region == 0) ||
                insearch == 1 ||
                (sel_way != 0 && map_ways_objs[sel_way][points[p].id] == 1) ||
                (sel_region != 0 && map_reg_objs[sel_region][points[p].id] == 1)

            ) {
                if((init && points[p].po==1) || !init) {

                    if(!empty(points[p]) &&  !empty(points[p].ir) && !empty(rubs[points[p].ir]) && !empty(rubs[points[p].ir]['i'])){
                        var image = '/upload/'+rubs[points[p].ir]['i'];
                    } else {
                        var image = 'https://api-maps.yandex.ru/2.0.35/images/b87da66ef0c9c83eab04b13bb99d2599.png';
                    }
                    if (points[p].ph != "/") {
                        ph = '<img width="200" src="/upload/'+points[p].ph+'" alt="" />';
                    } else {
                        ph = '<img width="200" src="/map/img/no_image.png" alt="" />';
                    }

                    var partner = "";
                    if (!empty(points[p].pr)) {
                        partner = '<img class="map_img_partner" width="75" height="75" src="/map/img/partner.png" alt="" />';
                    }
                    group.add(new ymaps.Placemark(
                        // Координаты метки
                        [points[p].lo, points[p].la],
                        {
                            clusterCaption: points[p].n,
                            hintContent: points[p]['n'],
                            balloonContentBody: '<div class="mapobj_info"><div class="map_forimg"><a href="'+points[p].nur+'">'+partner+''+ph + '</a></div><div class="map_inf"><div class="mapobj_tit_wrap"><a class="mapobj_tit" href="'+points[p].nur+'">'+points[p].n+'</a></div><span>'+/*rubs[ points[p].ir ].n*/''+'</span><div class="map_description">'+points[p].m+'</div><a href="'+points[p].nur+'" class="map-window__btn">Подробнее</a></div></div>',
                        },{
                            hideIconOnBalloonOpen: true,
                            balloonMaxWidth: 260,
                            balloonMinWidth: 260, // Ширина балуна
                            iconImageHref: image, // картинка иконки
                            iconImageSize: [32, 37], // размеры картинки
                            iconImageOffset: [-16, -37] // смещение картинки
                        })
                    );
                }



            }
        }

        map.geoObjects.add(group); // add yandex group overlay

    },
    goSearch: function(val) {
        se_len = val.length;
        var m = this;
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
                    'act':'search',
                    'w':val
                }).done(function(sp){
                    MapHelp(1);
                    sp = JSON.parse(sp);
                    spoints = sp;
                    m.setPoints(0,1);
                    li = '';

                    for (p in sp) {
                        li += '<li class="r_'+sp[p].ir+'" rel="'+p+'"><a href="'+sp[p].nur+'">'+sp[p].n+'</a></li>';
                    }

                    if (li == '') {
                        $("#x3-map-result").html('<h4 style="text-align: center; margin-top: 30px;">По вашему запросу ничего не найдено<br /><br /> <a href="javascript: void(0);" onclick="$(\'#x3-map-input\').focus();$(\'#x3-map-input\').val(\'\');">искать заново</a></h4>');
                    } else {
                        $("#x3-map-result").html('<ul>'+li+'</ul>');
                        $("#x3-map-result a").click(function(){
                            MapHelp(1);
                            i = $(this).parent().attr('rel');
                            map.setCenter([points[i].lo,points[i].la],12,{
                                duration: 100,
                                checkZoomRange: true,
                                callback: function() {
                                    var projection = map.options.get('projection');
                                    var position = yPoint[i].geometry.getCoordinates();
                                    var pc = map.converter.globalToPage(projection.toGlobalPixels(position,map.getZoom()));
                                    m.showInfo(true, m.eq(i),pc);
                                }
                            });
                            return false;
                        });
                    }
                },
                'json'
            );
        } else if (se_len != 1) {
            $("#x3-map-result").hide();
            $("#x3-map-sections").show();

            m.setPoints(0);
        }
    },

    initSearch: function() {
        var m = this;
        $("#x3-map-input").keyup(function(e){

            m.goSearch($(this).val());

        });

    },


    init: function() {

        var m = this;


        map = new ymaps.Map('x3-map-wrap', {
            center: [options.cLat, options.cLng],
            zoom: options.zoom,
            behaviors: ["default", "scrollZoom"],
        },{dragInertia: false});


        map.controls.add('typeSelector',{'left': 100});
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
var add_map;

function AddFormClose() {

    $('#info_win_add').hide();
    $("#map_add_step_1").show();
    $("#map_add_step_2").hide();
    $("#map_add_step_3").hide();
    add_map.destroy();
    $("#map_coords").val('');
    $("#obj_name").val('');
    $("#obj_about").val('');
    $("#obj_adres").val('');
    $("#obj_doeha").val('');
}

function SendObj(t) {

    $(".er").removeClass("er");

    er = 0;
    name = jQuery.trim($("#obj_name").val());
    rub = $("#obj_rub").val();
    about = jQuery.trim($("#obj_about").val());
    adres = jQuery.trim($("#obj_adres").val());
    doehat = jQuery.trim($("#obj_doehat").val());
    map_coords = jQuery.trim($("#map_coords").val());


    if (t == 1) {
        if (name.length == 0) {
            $("#obj_name").addClass("er");
            er = 1;
        }
        if (about.length == 0) {
            $("#obj_about").addClass("er");
            er = 1;
        }
        if (er == 0) {
            $("#map_add_step_1").hide();
            $("#map_add_step_3").hide();
            $("#map_add_step_2").show();


            add_map = new ymaps.Map('add_map', {
                center: [52.508959, 83.250358],
                zoom:7,
                behaviors: ["default", "scrollZoom"]
            },{dragInertia: false});

            add_map.controls.add('typeSelector',{'left': 100});
            add_map.controls.add('zoomControl');
            add_map.controls.add('mapTools');

            add_map.events.add('click',function(e){
                if(add_map.balloon.isOpen()) {
                    add_map.balloon.close();
                    jQuery('#map_coords').val('');
                }
                var coords = e.get('coordPosition');
                add_map.balloon.open(coords, {
                    contentBody: "Объект расположен тут!",
                });
                jQuery('#map_coords').val(coords[0].toPrecision(6) + ',' +coords[1].toPrecision(6));

            });


            //



        }
    }

    if (t == 2) {

        if (map_coords.length == 0) {
            er = 1;
            alert("Вам надо отметить объект на карте");
        }

    }

    if (er == 0 && t == 2) {
        $("#map_add_step_1").hide();
        $("#map_add_step_2").hide();
        $("#map_add_step_3").show();
        $.post("/map/ajax.php",
            {
                'act':'save_obj',
                'name':name,
                'rub':rub,
                'adres':adres,
                'doehat':doehat,
                'coords':map_coords,
                'about':about
            },
            function(data){

            }
        );




    }

}

function MapHelp(t) {

    rel = $("#map_helplink").attr("rel");
    if (t == 0 && rel == 0) {
        $(".help").show();
        $("#map_helplink").html("Скрыть подсказки").attr("rel",1);
    } else {

        $(".help").hide();
        $("#map_helplink").html("Показать подсказки").attr("rel",0);

    }

}

$(document).ready(function(){

    ymaps.ready(MyMap.init);

    $(".x3-map-filter__level1").click(function(){
        $(this).parent("li").toggleClass("_open");
        $(this).next("ul").slideToggle();
        return false;
    });

});

