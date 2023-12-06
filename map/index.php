<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "карта Алтая, объекты Алтая, культурные объекты Алтая, географические объекты Алтая, районы Алтая");
$APPLICATION->SetTitle("Карта");
$APPLICATION->SetPageProperty("description", "Карта - visitaltai.info");

$APPLICATION->SetAdditionalCSS("/map/style.css");
//$APPLICATION->AddHeadScript('http://yandex.st/jquery/1.7.0/jquery.min.js');
$APPLICATION->AddHeadString('<script> var rubs = null, map_ways = [],  map_ways_objs = [], map_ways_info = [], map_reg_objs = [], map_reg_info = [], map_reg_coord= []; </script><script type="text/javascript" src="/map/rubs.php"></script>',true);

$APPLICATION->AddHeadScript('/map/map.js');

$APPLICATION->AddHeadScript('https://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU');


if(CModule::IncludeModule("iblock"))
{

    $rubs = array(
                "Где остановиться" => array(12),
                "Объекты природы" => array(7, 13),
                "Объекты истории и культуры" => array(7, 14),
                "Объекты развлечений" => array(7, 905),
                "Где поесть" => array(157),
                );

   foreach ($rubs as $val=>$ar) {

        $iblockID = $ar[0];
        $cats = $ar[1];

        //$items = GetIBlockSectionList($ar[0], $cats, Array("sort"=>"asc"), );
        if(empty($cats)){
        	$items = CIBlockSection::GetList(Array("sort"=>"asc"), Array('IBLOCK_ID'=>$iblockID, 'GLOBAL_ACTIVE'=>'Y'), true, Array("UF_ICONMAP"));
        }else{
        	$items = CIBlockSection::GetList(Array("sort"=>"asc"), Array('IBLOCK_ID'=>$iblockID, 'SECTION_ID'=>$cats, 'GLOBAL_ACTIVE'=>'Y'), true, Array("UF_ICONMAP"));
        }
        

        $cat[$iblockID]['n'] = iconv('cp1251', 'utf-8',$val);

        $li1 .= '<li><strong>'.$val.'</strong>';
        $opt .= '<option disabled="true">'.$val.'</option>';

        while($arItem = $items->GetNext()) {

			$img = CFile::GetPath($arItem["UF_ICONMAP"]);

            $ar_tab = array(
                           "id" => $arItem['ID'],
                           "name" =>  iconv('cp1251', 'utf-8', $arItem['NAME'])
                           );
            $li2 .= '<li><img src="'.$img.'" alt="icons"></img><a class="map_obj_list" href="javascript: void(0);" id="ch_'.$arItem['ID'].'">'.$arItem['NAME'].'</a></li>';
            $opt .= '<option value="'.$ar[0].'_'.$arItem['ID'].'">--- '.$arItem['NAME'].'</option>';
            $cat[$iblockID]['obj'][$arItem['ID']] = $ar_tab;
        }
        if ($li2) $li1 .= '<ul>'.$li2.'</ul>';
        $li1 .= '</li>';
        unset($li2);
   }

	$rubs = json_encode($cat);
}

?>


<div class="alx-map-wrap">
	<div id="map_div"></div>
	<div class="alx-map-content">
		<div id="top_search">
			<input type="text"  placeholder="Поиск по карте" id="search_field" autocomplete="off"  />
		</div>
		<div id="sidebar">
			<ul id="al_rubs"><?=$li1?></ul>
			<div id="search_result" style="display: none;"></div>
		</div>
		<a id="map_objadd_btn" href="javascript: void(0);" onclick="$('#info_win_add').show();" class="alx-top-bar__btn alx-btn alx-btn--green">
            <span class="alx-btn__main">Рекомендовать объект</span>
            <span class="alx-btn__color"></span>
            <span class="alx-btn__next">Рекомендовать объект</span>
        </a>
	</div>
	<a id="map_helplink" rel="0" href="javascript: MapHelp(0);">Показать подсказки</a>

	<div class="help tip1">
		<h4>Поиск по карте</h4>
		<ol>
		    <li>Поиск объектов по их названию</li>
		    <li>Введите название объекта и он появится на карте</li>
		</ol>
	</div>
	<div class="help tip2">
	    <h4>Каталог объектов</h4>
	    <span>Выберите один или несколько разделов, объекты из которых Вы хотели увидеть на карте  </span>
	</div>

	<div class="help tip3">
	    <h4>Добавить новый объект</h4>
	    <span>Нажав на указанную ссылку, Вы сможете добавить новый объект на карту и в каталог</span>
	</div>
	<div class="help tip4">
	    <h4>Скрыть подсказки</h4>
	    <span>Нажав на эту ссылку, Вы скроете все подсказки</span>
	</div>

	<div id="info_win_add" style="display: none;">
	    <div id="info_win_sec">
	   	<a href="javascript: void(0);" onclick=" AddFormClose();"><img class="map_close" src="/map/img/close.png" alt="закрыть" /></a>
	    <h3>Рекомендовать объект</h3>
	        <div id="map_add_step_1">
	        <ul>
	            <li><input type="text" id="obj_name" name="obj_name" placeholder="Название объекта" /></li>
	            <li><select id="obj_rub"><?=$opt?></select></li>
	            <li class="obj_about-wrap"><textarea id="obj_about" placeholder="Краткое описание"></textarea></li>
	            <li><input type="text" id="obj_adres" name="obj_adres" placeholder="Адрес" /></li>
	            <li><input type="text" id="obj_doehat" name="obj_doehat" placeholder="Как доехать" /></li>
	            <li><label class="obj_step-label" style="font-weight: bold;">Этап №1 из 2</label><input type="button" onclick="SendObj(1);" value="Далее" /></li>
	        </ul>
	        </div>
	        <div id="map_add_step_2" style="display: none;">
	        <input type="hidden" value="" id="map_coords" />
	        <ul>
	            <li>Кликните по карте чтобы отметить объект</li>
	            <li><div id="add_map"></div></li>
	            <li><label style="font-weight: bold;">Этап №2 из 2</label><input type="button" onclick="SendObj(2);" value="Отправить" /></li>
	        </ul>

	        </div>
	         <div id="map_add_step_3" style="display: none;">&nbsp;&nbsp;&nbsp;Ваш объект добавлен, спасибо</div>


	    </div>
	</div> 
</div>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>