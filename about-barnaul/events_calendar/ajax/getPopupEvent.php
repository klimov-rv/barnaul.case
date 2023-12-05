<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

include __DIR__ . '/../event_types.php';

if (CModule::IncludeModule("iblock")) {
	if (!empty($_POST['eventID'])) {

		$arEvent = getIblockElement($_POST['eventID']);
		$ev_key = $arEvent['PROPERTIES']['EVENT_TYPE']['VALUE_ENUM_ID'];

		$interval = (new DateTime())->diff(new DateTime($arEvent['DATE_ACTIVE_FROM']));

		if ($interval->d > 1) {
			$ev_time = FormatDate("H:i", MakeTimeStamp($arEvent['DATE_ACTIVE_FROM'])) . ', ';
			if ($ev_time === '00:00') {
				$ev_time = '';
			}
			$ev_date = FormatDate("d F", MakeTimeStamp($arEvent['DATE_ACTIVE_FROM']));
		} else {
			$ev_time = '';
			$ev_date = FormatDate("x", MakeTimeStamp($arEvent['DATE_ACTIVE_FROM']) + CTimeZone::GetOffset(), mktime(23, 59, 59));
		};
		$display_ev['date'] = $ev_time . $ev_date;



		$display_ev['NAME'] = $arEvent['NAME'];
		if ($arEvent['DETAIL_PICTURE']) {
			$display_ev['DETAIL_PICTURE'] = CFile::ResizeImageGet($arEvent['DETAIL_PICTURE'], array('width' => 1100, 'height' => 662), BX_RESIZE_IMAGE_EXACT);
		}


		$display_ev['DETAIL_TEXT'] = $arEvent['DETAIL_TEXT'];
		if (!empty($arEvent['PROPERTIES']['MORE_INFO']['VALUE']['TEXT'])) {
			$display_ev['HAVE_MORE_INFO'] = true;
			if ($arEvent['PROPERTIES']['MORE_INFO']['USER_TYPE'] === "HTML") {
				$display_ev['MORE_INFO'] = htmlspecialchars_decode($arEvent['PROPERTIES']['MORE_INFO']['VALUE']['TEXT']);
			} else {
				$display_ev['MORE_INFO'] = $arEvent['PROPERTIES']['MORE_INFO']['VALUE']['TEXT'];
			}
		} else {
			$display_ev['HAVE_MORE_INFO'] = false;
		}

		if (!empty($arEvent['PROPERTIES']['TICKET_PRICE']['VALUE'])) {
			$display_ev['HAVE_PRICE'] = true;
			$display_ev['TICKET_PRICE'] = $arEvent['PROPERTIES']['TICKET_PRICE']['VALUE'] . ' руб.';
		} else {
			$display_ev['HAVE_PRICE'] = false;
		}
	}
	if (!empty($display_ev)) {
?>

		<div class="row">
			<div class="cell-6 cell-9-lg cell-11-sm event-dialog__info">
				<div class="event-dialog__info_date"> <?= $display_ev['date'] ?></div>
				<div class="event-dialog__info_type event-<?= $types_events[$ev_key]['event_tag'] ?>"><?= $types_events[$ev_key]['event_title'] ?></div>
			</div>
		</div>
		<h3 class="event-dialog__header window-title">
			<?= $display_ev['NAME'] ?>

			<? if ($_POST['eventIsMain'] === "Да") { ?>
				<div class="starred-event">
					<svg class="starred-event__star" aria-hidden="true" width="100%" height="100%">
						<use xlink:href="#starred-icon"></use>
					</svg>
					<span class="starred-event__text">Главное событие месяца</span>
				</div>
			<? } ?>
		</h3>
		<div class="row is-grid event-dialog__grid">
			<div class="cell-5 cell-12-m">
				<div class="event-dialog__img">
					<img src="<?= $display_ev["DETAIL_PICTURE"]["src"] ?>" alt="">
				</div>
				<? if ($display_ev['HAVE_PRICE']) { ?>
					<div class="event-dialog__ticket">
						<div class="dialog__ticket_tizer">
							<div class="tizer_top">
								Стоимость участия:
							</div>
							<div class="dialog__ticket_price">
								<?= $display_ev['TICKET_PRICE'] ?>
							</div>
						</div>
						<div class="dialog__ticket_bage">
							15+
						</div>
					</div>
				<? } ?>
			</div>
			<div class="cell-7 cell-12-m event-dialog__text">
				<?= $display_ev['DETAIL_TEXT'] ?>
				<? if ($display_ev['HAVE_MORE_INFO']) { ?>
					<div class="article_link">
						<span class="article_link-inner">
							<?= $display_ev['MORE_INFO'] ?>
						</span>
					</div>
				<? } ?>
			</div>
		</div>
		</div>
	<?
	} else { ?>
		<div class="err">
			ошибка получения события <?= $_POST['eventID'] ?>
		</div>
<?  }
} else
	ShowError("ajax Post error");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
