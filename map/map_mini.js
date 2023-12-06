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
		    zoom: 8.4,
		    cLat: 52.508959, // center
		    cLng: 83.250358
        }

function MyMap() {

}
MyMap.prototype = {

  getPoints: function(param, callback) {

    var m = this;
		$.getJSON('/map/getMap.php?'+param, function(json, s) {
			cpoints = json;
			m.setPoints(0);
      if (callback) callback();
		});

	},

  SetRubs: function() {

    $("#al_rubs a.map_obj_list").each(function(){
       id = $(this).attr("id").split("_")[1];
       params[id] = ($(this).hasClass('act'))?id:0;
    });

    $("#al_rubs a.map_obj_list").click(function(){
        $("#al_rubs a.map_way_list").removeClass('act');
        $("#al_rubs a.map_region_list").removeClass('act');
        id = $(this).attr("id").split("_")[1];
        MyMap.setPoints(id);
        (params[id] != undefined && params[id] != 0) ? $(this).addClass("act"):$(this).removeClass("act");
        return false;
    });

    $("#al_rubs a.map_way_list").click(function(){
        $("#al_rubs a").removeClass('act');

        for (key in params) {
          params[key] = 0;
        }
        id = $(this).attr("id").split("_")[1];
        MyMap.setWay(id);
        
        $(this).addClass("act");
        return false;
    });

    $("#al_rubs a.map_region_list").click(function(){
        $("#al_rubs a").removeClass('act');


        for (key in params) {
          params[key] = 0;
        }
        id = $(this).attr("id").split("_")[1];
        MyMap.setRegion(id);
        $(this).addClass("act");
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

	setPoints: function(id_rub,insearch) {
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
		balloonMinWidth: 615, // Ширина балуна
		clusterBalloonHeight: 115, // Высота балуна
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



                if (rubs[points[p].ir]['i'] != '') {

                    var image = '/upload/'+rubs[points[p].ir]['i'];

                } else {
                    var image = 'http://api-maps.yandex.ru/2.0.35/images/b87da66ef0c9c83eab04b13bb99d2599.png';
                }

                if (points[p].ph) {
                    ph = '<img width="100" src="/upload/'+points[p].ph+'" alt="" />';
                } else {
                 ph = '<img width="100" src="/map/img/white.png" alt="" />';
                }

                group.add(new ymaps.Placemark(
                // Координаты метки
                [points[p].lo, points[p].la],
                {
                clusterCaption: points[p].n,
                hintContent: points[p]['n'],
                balloonContentBody: '<div class="mapobj_info"><div class="map_forimg"><a href="'+points[p].nur+'">'+ph + '</a><br /> '+rubs[ points[p].ir ].n+'</div><div class="map_inf"><a class="mapobj_tit" href="'+points[p].nur+'">'+points[p].n+'</a><p>'+points[p].m+'</p><a href="'+points[p].nur+'" class="map_more">Подробнее</a></div></div>',
                }, {
                hideIconOnBalloonOpen: true,
                balloonMaxWidth: 355,
                	balloonMinWidth: 355, // Ширина балуна
                iconImageHref: image, // картинка иконки
                iconImageSize: [32, 37], // размеры картинки
                iconImageOffset: [-16, -37] // смещение картинки
                }));


            }




		}




	   map.geoObjects.add(group); // add yandex group overlay

	},

    init: function() {

      var m = this;
     
      map = new ymaps.Map('map_div', {
          center: [options.cLat, options.cLng],
          zoom: options.zoom,
          behaviors: ["default", "scrollZoom"]
      },{dragInertia: false});
      
      map.controls.add('typeSelector',{'left': 100});
      map.controls.add('zoomControl');
      map.controls.add('mapTools');
      MyMap.SetRubs();
      
      
      MyMap.getPoints('', function(){
        $('#wa_'+obj_id).click();
      });
     
   }
}

var MyMap = new MyMap;
var add_map;


$(document).ready(function(){

    ymaps.ready(MyMap.init);
    

});

