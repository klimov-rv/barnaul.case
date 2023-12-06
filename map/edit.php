
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Рисование линии на карте</title>
<!-- Подключаем API  карт 2.x  -->
<script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
<script src="http://yandex.st/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
        // Как только будет загружен API и готов DOM, выполняем инициализацию
        ymaps.ready(init);

        function init () {
            // Создание экземпляра карты и его привязка к контейнеру с
            // заданным id ("map")
            var myMap = new ymaps.Map('map', {
                    // При инициализации карты, обязательно нужно указать
                    // ее центр и коэффициент масштабирования
                    center: [52.508959,83.250358], // Нижний Новгород
                    zoom: 8,
                    behaviors: ["default", "scrollZoom"]
                });
 myMap.controls.add('typeSelector',{'left': 100});
        myMap.controls.add('zoomControl');
	    myMap.controls.add('mapTools');

				var polyline = new ymaps.Polyline([], {}, {
					strokeColor: '#ff0000',
                    strokeWidth: 5 // ширина линии
                });

			myMap.geoObjects.add(polyline);
			polyline.editor.startEditing();
			polyline.editor.startDrawing();


$('input').attr('disabled', false);

            // Обработка нажатия на любую кнопку.
            $('input').click(
                function () {
                    // Отключаем кнопки, чтобы на карту нельзя было
                    // добавить более одного редактируемого объекта (чтобы в них не запутаться).
                    $('input').attr('disabled', true);

                    polyline.editor.stopEditing();

					printGeometry(polyline.geometry.getCoordinates());

                });

        }

// Выводит массив координат геообъекта в <div id="geometry">
        function printGeometry (coords) {
            $('#geometry').html(stringify(coords));

            function stringify (coords) {
                var res = '';
                if ($.isArray(coords)) {
                    res = '[ ';
                    for (var i = 0, l = coords.length; i < l; i++) {
                        if (i > 0) {
                            res += ', ';
                        }
                        res += stringify(coords[i]);
                    }
                    res += ' ]';
                } else if (typeof coords == 'number') {
                    res = coords.toPrecision(6);
                } else if (coords.toString) {
                    res = coords.toString();
                }

                return res;
            }
        }


    </script>
</head>

<body>
Для начала редактирования кликните по карте<br />
<div id="map" style="width:800px; height:600px"></div>
<input type="button" value="Завершить редактирование" id="stopEditPolyline"/> <br />
<textarea id="geometry" style="width: 400px; height: 100px;"></textarea>
</body>
</html>
