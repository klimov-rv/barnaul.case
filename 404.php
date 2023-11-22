<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("");
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/404.css"));
?>

<div class="x3-404">
    <img src="<?=SITE_TEMPLATE_PATH?>/images/404.jpg" alt="404">
    <h1>Страница не найдена</h1>
    <ul>
        <li><span>Возможно, файл удален</span></li>
        <li><span>Возможно, вы перешли по ссылке с другого сайта, содержащего неправильный или устаревший адрес страницы (URL)</span></li>
        <li><span>Возможно, вы неправильно ввели адрес в браузере</span></li>
    </ul>
    <a class="x3-btn svg-left" href="/">
        <svg aria-hidden="true" width="19" height="15">
            <use xlink:href="#arrow-left2-svg"></use>
        </svg>
        Перейти на главную
    </a>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>