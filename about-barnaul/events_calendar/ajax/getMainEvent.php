<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (CModule::IncludeModule("iblock")) {
	if (!empty($_POST['DateFrom'])) {
		$main_event = [];
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

		if (!empty($all_events)) {
			foreach ($all_events as $key => $arEvent) :
				if (!empty($arEvent["PROPERTIES"]["IS_EVENT_MAIN"]["VALUE"])) :
					$main_event['name'] = $arEvent['NAME'];
					$main_event['preview_pic'] = CFile::ResizeImageGet($arEvent['PREVIEW_PICTURE'], array('width' => 190, 'height' => 130), BX_RESIZE_IMAGE_EXACT);
				endif;
			endforeach;

			if (!empty($main_event)) { ?>
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
		<? 	}
		}
	}
} else {
	ShowError("ajax Post error");
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
