<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Проверка карты гостя");
?>

<?$APPLICATION->IncludeComponent(
	"site:guestcard.check",
	"",
	Array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "180",
		"CACHE_TYPE" => "N",
		"GUESTCARD_IBLOCK_ID" => "1",
		"NEWS_IBLOCK_ID" => "",
		"PRODUCTS_IBLOCK_ID" => "",
		"USER_PROPERTY_NEWS" => ""
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>