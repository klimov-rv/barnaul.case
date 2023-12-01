<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
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
if (CModule::IncludeModule("iblock")) {
	if (!empty($_POST['DateFrom'])) {
		$DateFrom = $_POST['DateFrom'];
		$DateTo = $_POST['DateTo'];
		$order = ['SORT' => 'ASC'];
		$filter = [
			"ACTIVE" => "Y",
			"IBLOCK_ID" => 5,
			">=DATE_ACTIVE_FROM" => $DateFrom . " 00:00:00",
			"<=DATE_ACTIVE_FROM" => $DateTo . " 23:59:59",
		];

		$rows = CIBlockElement::GetList($order, $filter);

		while ($row = $rows->fetch()) {
			$row['PROPERTIES'] = [];
			$all_events[$row['ID']] = &$row;
			unset($row);
		}

		CIBlockElement::GetPropertyValuesArray($all_events, $filter['IBLOCK_ID'], $filter);

		unset($rows, $filter, $order);
	}
	if (!empty($all_events)) {
		foreach ($all_events as $key => $arEvent) :

			$ev_key = $arEvent['PROPERTIES']['EVENT_TYPE']['VALUE_ENUM_ID'];

			$ev_time = FormatDate("H:i", MakeTimeStamp($arEvent['DATE_ACTIVE_FROM']));
			if ($ev_time === '00:00') {
				$ev_time = '';
			}
			$ev_date = FormatDate("d F", MakeTimeStamp($arEvent['DATE_ACTIVE_FROM'])); ?>

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

		<? endforeach;
	} else { ?>
		нет событий
<?  }
} else
	ShowError("ajax Post error");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
