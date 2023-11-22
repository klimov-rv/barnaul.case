<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);
?>
<? if ($APPLICATION->GetCurPage(false) !== '/') : ?>
    <? if ($APPLICATION->GetCurPage(false) !== '/objects/where_visit/istoricheskaya-liniya/') : ?>
        </div>
        </div>
    <? endif; ?>
<? endif; ?>
</div>
<div class="clear-footer"></div>
</div>

<footer class="x3-footer">
    <div class="container">
        <div class="x3-footer__logo">
            <a href="/" class="x3-logo x3-logo--dark">
                <span class="x3-logo__img">
                    <svg aria-hidden="true" width="43" height="51">
                        <use xlink:href="#logo-svg"></use>
                    </svg>
                </span>
                <span class="x3-logo__text">
                    Барнаул
                    <span>город в Сибири</span>
                </span>
            </a>
            <div class="x3-footer__copyright">
                Все права защищены © 2003– <?= date('Y'); ?>
            </div>
        </div>
        <div class="x3-footer__contacts">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => SITE_TEMPLATE_PATH . "/include/footer-cont.php"
                )
            ); ?>
            <div class="x3-footer__soc">
                <a href="https://vk.com/barnaultourism" target="_blank">
                    <svg aria-hidden="true" width="23" height="13">
                        <use xlink:href="#soc-vk-svg"></use>
                    </svg>
                </a>
                <a href="https://ok.ru/group/70000000849849" target="_blank">
                    <svg aria-hidden="true" width="12" height="19">
                        <use xlink:href="#soc-ok-svg"></use>
                    </svg>
                </a>
                <a href="https://t.me/barnaultourism" target="_blank">
                    <svg aria-hidden="true" width="20" height="18">
                        <use xlink:href="#soc-tg-svg"></use>
                    </svg>
                </a>
            </div>
        </div>
        <div class="x3-footer__dev">
            Разработка сайта:
            <a href="https://x3group.ru/">
                <svg aria-hidden="true" width="82" height="32">
                    <use xlink:href="#dev-logo-svg"></use>
                </svg>
            </a>
        </div>
    </div>
</footer>



<?

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/vendor.min.js");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/common.js");
?>
<? CJSCore::Init(array("jquery3")); ?>
<script>
    $(function() {
        $('.common-svg-icons').load('<?= SITE_TEMPLATE_PATH ?>/svg.html');
    });
</script>

<a id="x3Top" title="Наверх" href="#">&#10148;</a>
<div class="common-svg-icons"></div>

</body>

</html>