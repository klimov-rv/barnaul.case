<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("page_template", "is-container-fix is-page-main-event");
$APPLICATION->SetTitle("Главное событие в городе");
?>
<article class="main_event">
	<div class="container">
		<span class="welcome_text">
			Барнаул – один из крупнейших сибирских городов и столица Алтайского края. Город расположен в равнинной местности, одновременно на двух реках: реке Барнаулке и левом берегу полноводной сибирской реки Обь, берущей начала в горах Алтая. Большая часть города располагается в Ленточном бору, где берет начало реликтовый ленточный сосновый бор – уникальная растительная зона, не встречающаяся больше нигде на планете. Количество солнечных дней в Барнауле – 230 дней, почти столько же, как в Крыму. </span>
		<div class="welcome_grid row is-grid">
			<div class="cell-12">
				<h5 class="section__title">Экскурсии от Анны Казанцевой </h5>
			</div>
			<div class="welcome_grid-left cell-9 cell-7-md cell-12-m">
				<p>
					Напоминаем, 23 сентября в честь Всемирного дня туризма пройдёт квест-экскурсия «Живые символы Барнаула».У участников квеста появится возможность найти «следы животных» в истории Барнаула. Квест-экскурсия дважды (12:00 и 15:00) стартует от Демидовской площади. В ходе игры группам предстоит найти живой символ города Барнаула, участники получат ценные призы на память. Чтобы попасть на квест, нужно записаться по телефону63-35-75, либо подойти к палатке Туристского информационного центра на улице Мало-Тобольской в эту субботу. Чтобы попасть на квест, нужно записаться по телефону63-35-75, либо подойти к палатке Туристского информационного центра на улице Мало-Тобольской в эту субботу. Чтобы попасть на квест, нужно записаться по телефону63-35-75, либо подойти к палатке Туристского информационного центра на улице Мало-Тобольской в эту субботу.
				</p>
				<p>
					Напоминаем, 23 сентября в честь Всемирного дня туризма пройдёт квест-экскурсия «Живые символы Барнаула».У участников квеста появится возможность найти «следы животных» в истории Барнаула. Квест-экскурсия дважды (12:00 и 15:00) стартует от Демидовской площади. В ходе игры группам предстоит найти живой символ города Барнаула, участники получат ценные призы на память.Чтобы попасть на квест, нужно записаться по телефону63-35-75, либо подойти к палатке Туристского информационного центра на <a href="/">
						улице Мало-Тобольской в эту субботу. </a>
				</p>
				<p>
					<b>Напоминаем, 23 сентября в честь Всемирного дня туризма пройдёт квест-экскурсия:</b>
				</p>
				<ul>
					<li> «Живые символы Барнаула».У участников квеста появится возможность найти «следы животных» в истории Барнаула. </li>
					<li>
						Квест-экскурсия дважды (12:00 и 15:00) стартует от Демидовской площади. В ходе игры группам предстоит найти живой символ города Барнаула, участники получат ценные призы на память.</li>
					<li>
						Чтобы попасть на квест, нужно записаться по телефону63-35-75, либо подойти к палатке Туристского информационного центра на улице Мало-Тобольской в эту субботу. </li>
				</ul>
				<p>
				</p>
				<div class="article_link">
					<span class="article_link-inner">
						Подробная информация на странице фестиваля Вконтакте: <a href="https://vk.com/altaitourismday" target="_blank" rel="noopener noreferrer">https://vk.com/altaitourismday</a> </span>
				</div>
			</div>
			<div class="main-event__sidebar cell-3 cell-5-md cell-12-m">
				<div class="col">

					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/about-barnaul/main_event/include_images.php"
						)
					); ?>
				</div>
			</div>
		</div>
	</div>
</article>

<? $APPLICATION->IncludeComponent(
	"bitrix:news",
	"gallery",
	array(
		"IBLOCK_ID" => "10",
		"COMPONENT_TEMPLATE" => "gallery",
		"IBLOCK_TYPE" => "data",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(0 => "", 1 => "",),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PROPERTY_CODE" => array(0 => "", 1 => "",),
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(0 => "", 1 => "",),
		"LIST_PROPERTY_CODE" => array(0 => "", 1 => "",),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "6",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "more",
		"PAGER_TITLE" => "Новости",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"USE_SHARE" => "N",
		"VARIABLE_ALIASES" => array("SECTION_ID" => "SECTION_ID", "ELEMENT_ID" => "ELEMENT_ID",)
	)
); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>