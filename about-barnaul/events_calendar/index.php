<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Календарь событий");


$all_events = [];
$types_events = [
	'' => 		['event_title' => '', 			'event_tag' => 'all', 			'btn_title' => 'Все события', 	'btn_filter' => '*',],
	'141' => 	['event_title' => 'Праздники', 	'event_tag' => 'holidays', 		'btn_title' => 'Праздники', 	'btn_filter' => 'event-holidays',],
	'142' => 	['event_title' => 'Конкурсы', 	'event_tag' => 'competitions', 	'btn_title' => 'Конкурсы', 		'btn_filter' => 'event-competitions',],
	'143' => 	['event_title' => 'Спектакли', 	'event_tag' => 'performances', 	'btn_title' => 'Спектакли', 	'btn_filter' => 'event-performances',],
	'144' => 	['event_title' => 'Выставки', 	'event_tag' => 'exhibitions', 	'btn_title' => 'Выставки', 		'btn_filter' => 'event-exhibitions',],
	'145' => 	['event_title' => 'Экскурсии', 	'event_tag' => 'excursions', 	'btn_title' => 'Экскурсии', 	'btn_filter' => 'event-excursions',],
	'146' => 	['event_title' => 'Концерты', 	'event_tag' => 'concerts', 		'btn_title' => 'Концерты', 		'btn_filter' => 'event-concerts',],
	'147' => 	['event_title' => 'Спорт', 		'event_tag' => 'sport', 		'btn_title' => 'Спорт', 		'btn_filter' => 'event-sport',],
];

$now = new DateTime();
$currentMonth = date('m');
$currentYear = date('Y');
$DateFrom = "01." . $currentMonth . "." . $currentYear;
$DateTo = "31." . $currentMonth . "." . $currentYear;
$order = ['SORT' => 'ASC'];
$filter = [
	"ACTIVE" => "Y",
	"IBLOCK_ID" => 5,
	">=DATE_ACTIVE_FROM" => ConvertDateTime($DateFrom, "DD.MM.YYYY") . " 00:00:00",
	"<=DATE_ACTIVE_FROM" => ConvertDateTime($DateTo, "DD.MM.YYYY") . " 23:59:59",
];

$rows = CIBlockElement::GetList($order, $filter);

while ($row = $rows->fetch()) {
	$row['PROPERTIES'] = [];
	$all_events[$row['ID']] = &$row;
	unset($row);
}

?>

<section class="container">

	<div class="iso-filter layout__iso-filter row">
		<? foreach ($types_events as $key => $arEventBtn) : ?>
			<div class="iso-filter__btn iso-filter__btn_<?= $arEventBtn['event_tag'] ?> <?= $retVal = ($key === '') ? 'is-checked' : ''; ?>" data-filter="<?= $arEventBtn['btn_filter'] ?>">
				<div class="iso-filter-title"><?= $arEventBtn['btn_title'] ?></div>
			</div>
		<? endforeach; ?>
	</div>
	<!-- end of iso-filter -->
	<div class="row is-grid">
		<div class="cell-4 cell-6-lg cell-12-sm">
			<div id="calendar">
				<script type="text/template" id="template-calendar">
					<div class="clndr-controls">
						<div class="clndr-previous-button">
							<svg aria-hidden="true" width="16" height="12">
								<use xlink:href="#arrow-left"></use>
							</svg>
						</div>
						<div class='month'><%= month %> <%= year %></div> 
						<div class="clndr-next-button">
							<svg aria-hidden="true" width="16" height="12">
								<use xlink:href="#arrow-right"></use>
							</svg>
						</div>
					</div>
					<div class="clndr-grid">
						<div class="days-of-the-week">
						<% _.each(daysOfTheWeek, function(day) { %>
							<div class="header-day"><%= day %></div>
						<% }); %>
						</div>
						<div class="days">
						<% _.each(days, function(day) { %>
							<div class="<%= day.classes %>"><%= day.day %></div>
						<% }); %>
						</div>
					</div>
					<!-- <div class="clndr-today-button">Today</div> -->
				</script>
			</div>
			<div class="widget widget__main-event">
				<div class="row widget__grid">
					<div class="cell-5 hide-sm">
						<div class="widget__img">
							<img src="/img/small__img1.jpg" alt="">
							<div class="widget__img_text">
								событие месяца
							</div>
						</div>
					</div>
					<div class="cell-7 cell-12-sm widget__info">
						<div class="widget__title hide-sm">
							Поздравляем с днём туризма!
						</div>
						<button class="btn-main widget__btn">
							<span>Главные события месяца</span>
							<svg aria-hidden="true" width="16" height="12">
								<use xlink:href="#arrow-right2"></use>
							</svg>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="cell-8 cell-6-lg cell-12-sm">
			<div class="event-list grid">
				<?


				CIBlockElement::GetPropertyValuesArray($all_events, $filter['IBLOCK_ID'], $filter);

				unset($rows, $filter, $order);
				?>

				<? foreach ($all_events as $key => $arEvent) : ?>
					<?
					$ev_key = $arEvent['PROPERTIES']['EVENT_TYPE']['VALUE_ENUM_ID'];

					$interval = $now->diff(new DateTime($arEvent['DATE_ACTIVE_FROM']));
					if ($interval->d > 1) {
						$ev_time = FormatDate("H:i", MakeTimeStamp($arEvent['DATE_ACTIVE_FROM']));
						if ($ev_time === '00:00') {
							$ev_time = '';
						}
						$ev_date = FormatDate("d F", MakeTimeStamp($arEvent['DATE_ACTIVE_FROM']));
					} else {
						$ev_time = '';
						$ev_date = FormatDate("X", MakeTimeStamp($arEvent['DATE_ACTIVE_FROM']) + CTimeZone::GetOffset());
					};
					?>
					<a class="event-list__item event-item popup-with-zoom-anim event-<?= $types_events[$ev_key]['event_tag'] ?> row" href="#event-dialog">

						<div class="cell-3 cell-12-m">
							<div class="event-item__date_wrap">
								<span class="event-item__time"><?= $ev_time ?></span>
								<span class="event-item__date"><?= $ev_date ?></span>
							</div>
						</div>
						<div class="cell-7 cell-12-m">
							<div class="event-item__title_wrap">
								<span class="event-item__type"><?= $arEvent['PROPERTIES']['EVENT_TYPE']['VALUE'] ?></span>
								<span class="event-item__title"><?= $arEvent['NAME'] ?></span>
							</div>
						</div>
						<div class="cell-2 hide-m">
							<div class="event__btn_wrap">
								<div class="event-item__btn">
									<svg aria-hidden="true" width="40" height="40">
										<use xlink:href="#arrow-right3"></use>
									</svg>
								</div>
							</div>
						</div>
						<?
						//= $arEvent['ID'] 
						?>
						<? if (!empty($arEvent["PROPERTIES"]["IS_EVENT_MAIN"]["VALUE"])) : ?>
							<div class="starred-event">
								<svg class="starred-event__star" aria-hidden="true" width="100%" height="100%">
									<use xlink:href="#starred-icon"></use>
								</svg>
								<span class="starred-event__text">Главное событие месяца</span>
							</div>
						<? endif; ?>
					</a>

				<? endforeach; ?>
				<!-- <a class="event-list__item event-item popup-with-zoom-anim event-competitions event-of-the-month row" href="#event-dialog">
					<div class="starred-event">
						<svg class="starred-event__star" aria-hidden="true" width="100%" height="100%">
							<use xlink:href="#starred-icon"></use>
						</svg>
						<span class="starred-event__text">Главное событие месяца</span>
					</div>
					<div class="cell-3 cell-12-m">
						<div class="event-item__date_wrap">
							<span class="event-item__time"> </span>
							<span class="event-item__date"> 5 октября</span>
						</div>
					</div>
					<div class="cell-7 cell-12-m">
						<div class="event-item__title_wrap">
							<span class="event-item__type">Конкурсы</span>
							<span class="event-item__title"> Национальный фотоконкурс</span>
						</div>
					</div>
					<div class="cell-2 hide-m">
						<div class="event__btn_wrap">
							<div class="event-item__btn">
								<svg aria-hidden="true" width="40" height="40">
									<use xlink:href="#arrow-right3"></use>
								</svg>
							</div>
						</div>
					</div>
				</a>
				<a class="event-list__item event-item popup-with-zoom-anim event-holidays row" href="#event-dialog">
					<div class="cell-3 cell-12-m">
						<div class="event-item__date_wrap">
							<span class="event-item__time">14:00</span>
							<span class="event-item__date"> 5 октября</span>
						</div>
					</div>
					<div class="cell-7 cell-12-m">
						<div class="event-item__title_wrap">
							<span class="event-item__type">Праздники</span>
							<span class="event-item__title"> День фармацевта: первые аптеки Барнаула</span>
						</div>
					</div>
					<div class="cell-2 hide-m">
						<div class="event__btn_wrap">
							<div class="event-item__btn">
								<svg aria-hidden="true" width="40" height="40">
									<use xlink:href="#arrow-right3"></use>
								</svg>
							</div>
						</div>
					</div>
				</a>
				<a class="event-list__item event-item popup-with-zoom-anim event-performances row" href="#event-dialog">
					<div class="cell-3 cell-12-m">
						<div class="event-item__date_wrap">
							<span class="event-item__time">14:00</span>
							<span class="event-item__date"> 5 октября</span>
						</div>
					</div>
					<div class="cell-7 cell-12-m">
						<div class="event-item__title_wrap">
							<span class="event-item__type">Праздники</span>
							<span class="event-item__title"> День фармацевта: первые аптеки Барнаула</span>
						</div>
					</div>
					<div class="cell-2 hide-m">
						<div class="event__btn_wrap">
							<div class="event-item__btn">
								<svg aria-hidden="true" width="40" height="40">
									<use xlink:href="#arrow-right3"></use>
								</svg>
							</div>
						</div>
					</div>
				</a>
				<a class="event-list__item event-item popup-with-zoom-anim event-exhibitions row" href="#event-dialog">
					<div class="cell-3 cell-12-m">
						<div class="event-item__date_wrap">
							<span class="event-item__time">14:00</span>
							<span class="event-item__date"> 5 октября</span>
						</div>
					</div>
					<div class="cell-7 cell-12-m">
						<div class="event-item__title_wrap">
							<span class="event-item__type">Праздники</span>
							<span class="event-item__title"> День фармацевта: первые аптеки Барнаула</span>
						</div>
					</div>
					<div class="cell-2 hide-m">
						<div class="event__btn_wrap">
							<div class="event-item__btn">
								<svg aria-hidden="true" width="40" height="40">
									<use xlink:href="#arrow-right3"></use>
								</svg>
							</div>
						</div>
					</div>
				</a>
				<a class="event-list__item event-item popup-with-zoom-anim event-excursions row" href="#event-dialog">
					<div class="cell-3 cell-12-m">
						<div class="event-item__date_wrap">
							<span class="event-item__time">14:00</span>
							<span class="event-item__date"> 5 октября</span>
						</div>
					</div>
					<div class="cell-7 cell-12-m">
						<div class="event-item__title_wrap">
							<span class="event-item__type">Праздники</span>
							<span class="event-item__title"> День фармацевта: первые аптеки Барнаула</span>
						</div>
					</div>
					<div class="cell-2 hide-m">
						<div class="event__btn_wrap">
							<div class="event-item__btn">
								<svg aria-hidden="true" width="40" height="40">
									<use xlink:href="#arrow-right3"></use>
								</svg>
							</div>
						</div>
					</div>
				</a>
				<a class="event-list__item event-item popup-with-zoom-anim event-concerts row" href="#event-dialog">
					<div class="cell-3 cell-12-m">
						<div class="event-item__date_wrap">
							<span class="event-item__time">14:00</span>
							<span class="event-item__date"> 5 октября</span>
						</div>
					</div>
					<div class="cell-7 cell-12-m">
						<div class="event-item__title_wrap">
							<span class="event-item__type">Праздники</span>
							<span class="event-item__title"> Денис Мацуев предтавляет: диалог поколений</span>
						</div>
					</div>
					<div class="cell-2 hide-m">
						<div class="event__btn_wrap">
							<div class="event-item__btn">
								<svg aria-hidden="true" width="40" height="40">
									<use xlink:href="#arrow-right3"></use>
								</svg>
							</div>
						</div>
					</div>
				</a>
				<a class="event-list__item event-item popup-with-zoom-anim event-sport row" href="#event-dialog">
					<div class="cell-3 cell-12-m">
						<div class="event-item__date_wrap">
							<span class="event-item__time">12:00, 15:00</span>
							<span class="event-item__date"> 5 октября</span>
						</div>
					</div>
					<div class="cell-7 cell-12-m">
						<div class="event-item__title_wrap">
							<span class="event-item__type">Концерт</span>
							<span class="event-item__title"> «Живые символы Барнаула»</span>
						</div>
					</div>
					<div class="cell-2 hide-m">
						<div class="event__btn_wrap">
							<div class="event-item__btn">
								<svg aria-hidden="true" width="40" height="40">
									<use xlink:href="#arrow-right3"></use>
								</svg>
							</div>
						</div>
					</div>
				</a> -->
			</div>
		</div>
	</div>
</section>

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
		"PREVIEW_TRUNCATE_LEN" => "",
		"SEF_MODE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
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