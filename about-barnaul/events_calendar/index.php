<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Календарь событий");
$APPLICATION->SetPageProperty("page_template", "is-container-fix is-page-calendar-events");

include __DIR__ . '/event_types.php';

$folder_path = \Bitrix\Main\IO\Path::getDirectory($_SERVER['SCRIPT_NAME']);

$arr_all_events = [];
$arr_month_events = [];

$calendar_events = [];
$main_event = [];

$currentMonth = date('m');
$currentYear = date('Y');

$DateFrom = "01." . $currentMonth . $currentYear;
$DateTo = "31." . $currentMonth . $currentYear;
// $DateFrom = "01." . $currentMonth . "." . $currentYear;
// $DateTo = "31." . $currentMonth . "." . $currentYear;

$order = ['SORT' => 'ASC'];
$filter = [
	"ACTIVE" => "Y",
	"IBLOCK_ID" => 5,
];

$rows = CIBlockElement::GetList($order, $filter);

while ($row = $rows->fetch()) {
	$row['PROPERTIES'] = [];
	$arr_all_events[$row['ID']] = &$row;
	unset($row);
}

CIBlockElement::GetPropertyValuesArray($arr_all_events, $filter['IBLOCK_ID'], $filter);


$filter = [
	"ACTIVE" => "Y",
	"IBLOCK_ID" => 5,
	">=DATE_ACTIVE_FROM" => ConvertDateTime($DateFrom, "DD.MM.YYYY") . " 00:00:00",
	"<=DATE_ACTIVE_FROM" => ConvertDateTime($DateTo, "DD.MM.YYYY") . " 23:59:59",
];


$rows = CIBlockElement::GetList($order, $filter);

while ($row = $rows->fetch()) {
	$row['PROPERTIES'] = [];
	$arr_month_events[$row['ID']] = &$row;
	unset($row);
}

CIBlockElement::GetPropertyValuesArray($arr_month_events, $filter['IBLOCK_ID'], $filter);

console_log($arr_month_events);

if (!empty($arr_all_events)) :
	foreach ($arr_all_events as $key => $arEvent) :
		if (!empty($arEvent["PROPERTIES"]["IS_EVENT_MAIN"]["VALUE"])) :
			$main_event['name'] = $arEvent['NAME'];
			$main_event['preview_pic'] = CFile::ResizeImageGet($arEvent['PREVIEW_PICTURE'], array('width' => 190, 'height' => 130), BX_RESIZE_IMAGE_EXACT);
		endif;

		array_push(
			$calendar_events,
			[
				'date' => date("Y-m-d", MakeTimeStamp($arEvent['DATE_ACTIVE_FROM'])),
				'title' => $arEvent['NAME']
			]
		);
	endforeach;
endif;

$rows = CIBlockElement::GetList($order, $filter);

while ($row = $rows->fetch()) {
	$row['PROPERTIES'] = [];
	$arr_all_events[$row['ID']] = &$row;
	unset($row);
}

CIBlockElement::GetPropertyValuesArray($arr_all_events, $filter['IBLOCK_ID'], $filter);

unset($rows, $filter, $order);
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
			<div class="widget_wrap">
				<? if (!empty($main_event)) { ?>
					<div class="widget widget__main-event">
						<div class="row widget__grid">
							<div class="cell-5 hide-sm">
								<div class="widget__img">
									<img src="<?= $main_event['preview_pic']['src'] ?>" alt="">
									<div class="widget__img_text">
										событие месяца
									</div>
								</div>
							</div>
							<div class="cell-7 cell-12-sm widget__info">
								<div class="widget__title hide-sm">
									<?= $main_event['name'] ?>
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
				<? } ?>
			</div>
		</div>
		<div class="cell-8 cell-6-lg cell-12-sm">
			<div class="event-list grid">
				<? if (!empty($arr_month_events)) {
					foreach ($arr_month_events as $key => $arEvent) : ?>
						<?

						$ev_key = $arEvent['PROPERTIES']['EVENT_TYPE']['VALUE_ENUM_ID'];
						$interval = (new DateTime())->diff(new DateTime($arEvent['DATE_ACTIVE_FROM']));

						if ($interval->d > 1) {
							$ev_time = FormatDate("H:i", MakeTimeStamp($arEvent['DATE_ACTIVE_FROM']));
							if ($ev_time === '00:00') {
								$ev_time = '';
							}
							$ev_date = FormatDate("d F", MakeTimeStamp($arEvent['DATE_ACTIVE_FROM']));
						} else {
							$ev_time = '';
							$ev_date = FormatDate("x", MakeTimeStamp($arEvent['DATE_ACTIVE_FROM']) + CTimeZone::GetOffset(), mktime(23, 59, 59));
						};

						?>
						<a ev_id="<?= $arEvent['ID'] ?>" ev_is_main="<?= $arEvent["PROPERTIES"]["IS_EVENT_MAIN"]["VALUE"] ?>" class="event-list__item event-item popup-with-zoom-anim event-<?= $types_events[$ev_key]['event_tag'] ?> row" href="#event-dialog">

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

					<? endforeach;
				} else { ?>
					нет событий
				<?  }  ?>
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


<div id="event-dialog" class="event-modal modal-container zoom-anim-dialog mfp-hide">
</div>

<script>
	// filter-isotope 
	$.getScript('<?= $folder_path ?>/ajax/filter.js');

	function updateEventsMonth(from, to, monthID) {

		$.ajax({
			type: 'POST',
			dataType: 'html',
			url: '<?= $folder_path ?>/ajax/getMonthEvents.php',
			data: 'DateFrom=' + from + '&DateTo=' + to,
			beforeSend: function() {
				$(window).trigger('before-ajax-load-trigger');
				$('.event-list').html('Загрузка...');
			},
			success: function(response) {
				$('.event-list').html(response);
				$.getScript('<?= $folder_path ?>/ajax/filter.js');
				$(window).trigger('after-ajax-load-trigger');
				return response;
			}
		})
	}
	// TODO тут нужен только monthID + можно облегчить запрос
	function updateMainEvent(from, to) {

		$.ajax({
			type: 'POST',
			dataType: 'html',
			url: '<?= $folder_path ?>/ajax/getMainEvent.php',
			data: 'DateFrom=' + from + '&DateTo=' + to,
			beforeSend: function() {
				$('.widget_wrap').html('Загрузка...');
			},
			success: function(response) {
				$('.widget_wrap').html(response);
				return response;
			}
		})
	}

	// календарь
	if ($('#calendar').length > 0) {

		moment.locale('ru');

		var currMonthNum = moment().month();

		var events_data = '<? echo json_encode($calendar_events); ?>';
		var js_events_data = JSON.parse(events_data);

		var eventArray = js_events_data;

		$('#calendar').clndr({
			events: eventArray,
			clickEvents: {
				nextMonth: function() {

					var nexrMonth = currMonthNum + 1;
					var DateFrom = '01.' + moment().month(nexrMonth).format("MM.YYYY");
					var DateTo = '31.' + moment().month(nexrMonth).format("MM.YYYY");

					updateEventsMonth(DateFrom, DateTo);
					updateMainEvent(DateFrom, DateTo);

					currMonthNum = nexrMonth;
				},
				previousMonth: function() {

					var prevMonth = currMonthNum - 1;
					var DateFrom = '01.' + moment().month(prevMonth).format("MM.YYYY");
					var DateTo = '31.' + moment().month(prevMonth).format("MM.YYYY");

					updateEventsMonth(DateFrom, DateTo);
					updateMainEvent(DateFrom, DateTo);

					currMonthNum = prevMonth;
				},
			},
			template: $('#template-calendar').html(),
		});
	}

	function popupEventBind() {

		$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',

			fixedContentPos: false,
			fixedBgPos: true,

			overflowY: 'auto',

			closeBtnInside: true,
			preloader: false,

			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});

		var evItems = document.querySelectorAll('.popup-with-zoom-anim');
		evItems.forEach((item, idx) => {
			item.addEventListener('click', e => {
				var eventID = e.target.closest('.event-list__item').getAttribute('ev_id');
				var eventIsMain = e.target.closest('.event-list__item').getAttribute('ev_is_main');

				if (!e.target.closest('.filter-popup')) {
					$.ajax({
						type: 'POST',
						dataType: 'html',
						url: '<?= $folder_path ?>/ajax/getPopupEvent.php',
						data: 'eventID=' + eventID + '&eventIsMain=' + eventIsMain,
						beforeSend: function() {
							$('#event-dialog').html('Загрузка...');
						},
						success: function(response) {
							$('#event-dialog').html(response);
							return response;
						}
					})
					$('#event-dialog').html('Загрузка...');
				};
			});
		});
	}
	popupEventBind();

	// trigger destroy ?
	$(window).on('after-ajax-load-trigger', function() {
		popupEventBind();
	});
</script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>