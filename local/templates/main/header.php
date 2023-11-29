<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<!DOCTYPE html>
<html lang="ru" class="no-js">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <? $APPLICATION->ShowHead() ?>
    <title><? $APPLICATION->ShowTitle() ?></title>

    <?

    use Site\Main\Css;

    Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/template.css"));
    Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/vendor.min.css"));
    Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/app.min.css"));

    if ($APPLICATION->GetCurPage(false) == '/') {
        CJSCore::RegisterExt(
            "scrollAnimate",
            array(
                "js" =>     SITE_TEMPLATE_PATH . "/js/scrollAnimate.js",
                "css" =>    SITE_TEMPLATE_PATH . "/css/scrollAnimate.css",
            )
        );
        CJSCore::Init(array("scrollAnimate"));
    }

    CJSCore::RegisterExt(
        "magnificPopup",
        array(
            "js" => SITE_TEMPLATE_PATH . "/libs/magnific_popup/magnific-popup.js",
            "css" => SITE_TEMPLATE_PATH . "/libs/magnific_popup/magnific-popup.css",
            "rel" => array("jquery3"),
        )
    );
    CJSCore::RegisterExt(
        "jquery-validation",
        array(
            "js" =>    SITE_TEMPLATE_PATH . "/libs/jquery-validation-1.19.3.js",
            "rel" =>   array('jquery3'),
        )
    );
    CJSCore::RegisterExt(
        "inputmask",
        array(
            "js" =>    SITE_TEMPLATE_PATH . "/libs/jquery.inputmask.min.js",
            "rel" =>   array('jquery3'),
        )
    );
    CJSCore::RegisterExt(
        "swiper",
        array(
            "js" => SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.js",
            "css" => SITE_TEMPLATE_PATH . "/libs/swiper/swiper-bundle.min.css",
            "rel" => array("jquery3"),
        )
    );
    CJSCore::RegisterExt(
        "select2",
        array(
            "js" => SITE_TEMPLATE_PATH . "/libs/select2/select2.full.min.js",
            "css" => SITE_TEMPLATE_PATH . "/libs/select2/select2.min.css",
            "rel" => array("jquery3"),
        )
    );
    ?>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            for (var j = 0; j < document.scripts.length; j++) {
                if (document.scripts[j].src === r) {
                    return;
                }
            }
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(92189144, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/92189144" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->

</head>

<body>
    <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
    <?
    if ($APPLICATION->GetCurPage(false) == '/') : {
            $wrap_class = 'site-wrap--main';
        }
    elseif ($APPLICATION->GetCurPage(false) == '/objects/where_visit/istoricheskaya-liniya/') : {
            $wrap_class = 'is-container-fix is-page-historical-line';
        }
    elseif ($APPLICATION->GetCurPage(false) == '/about-barnaul/main_event/') : {
            $wrap_class = 'is-container-fix is-page-main-event';
        }
    endif;
    ?>

    <div <? if ($APPLICATION->GetCurPage(false) != '/check-guestcard/') : ?>style="background-image: url('<? $APPLICATION->ShowProperty("BG") ?>')" <? endif; ?> class="site-wrap <?= $wrap_class ?>" id="page">
        <header class="site-header <? if ($APPLICATION->GetCurPage(false) == '/') : ?>header-main<? endif; ?>">
            <div class="container">
                <div class="x3-header">
                    <div class="x3-header__logo">
                        <a href="/" class="x3-logo <? if ($APPLICATION->GetCurPage(false) == '/') : ?>x3-logo--white<? endif; ?>">
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
                    </div>
                    <div class="x3-header__menu">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "top-menu",
                            array(
                                "ROOT_MENU_TYPE" => "top",
                                "MAX_LEVEL" => "2",
                                "CHILD_MENU_TYPE" => "left",
                                "USE_EXT" => "Y",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array()
                            )
                        ); ?>
                    </div>
                    <div class="x3-header__search x3-search">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:search.form",
                            "search",
                            array(
                                "PAGE" => "#SITE_DIR#search/index.php",
                                "USE_SUGGEST" => "N"
                            )
                        ); ?>
                    </div>
                    <div class="x3-header__btn">
                        <a href="/feedback/" class="x3-btn">Свяжитесь с нами</a>
                    </div>
                </div>

            </div>
        </header>
        <div class="site-content  <? if ($APPLICATION->GetCurPage(false) == '/') : ?>site-content--main<? endif; ?> <? $APPLICATION->ShowProperty("page_template") ?>">
            <?


            if ($APPLICATION->GetCurPage(false) !== '/') : ?>
                <? if (
                    ($APPLICATION->GetCurPage(false) == '/objects/where_visit/istoricheskaya-liniya/') ||
                    ($APPLICATION->GetCurPage(false) == '/about-barnaul/main_event/') ||
                    ($APPLICATION->GetCurPage(false) == '/about-barnaul/events_calendar/')
                ) : { ?>

                        <div class="container">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:breadcrumb",
                                "breadcrumbs",
                                array(
                                    "PATH" => "",
                                    "SITE_ID" => "s1",
                                    "START_FROM" => "0"
                                )
                            ); ?>
                            <? $APPLICATION->ShowViewContent('article-date'); ?>
                            <h1 class="page-title"><? $APPLICATION->ShowTitle(false) ?></h1>
                        </div>

                    <?
                    }
                else : ?>
                    <div class="container">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:breadcrumb",
                            "breadcrumbs",
                            array(
                                "PATH" => "",
                                "SITE_ID" => "s1",
                                "START_FROM" => "0"
                            )
                        ); ?>
                        <? $APPLICATION->ShowViewContent('article-date'); ?>
                        <h1 class="page-title"><? $APPLICATION->ShowTitle(false) ?></h1>
                        <div class="site-content-wrap">
                        <? endif; ?>

                        <!-- на всех страницах кроме главной -->
                        <? Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/app.min.js"); ?>

                        <!-- bubble -->
                        <div class="bubble_card bubble_card__container">
                            <button class="bubble_card__close">
                                <svg aria-hidden="true" width="15" height="15">
                                    <use xlink:href="#close-svg"></use>
                                </svg>
                            </button>
                            <div class="bubble_card__wrap">
                                <div class="bubble_card__card">
                                    <img src="/upload/cart_guest.png" alt="Карта гостя">
                                </div>
                            </div>
                            <div class="bubble_card__right">
                                <div class="bubble_card__question">Что такое карта гостя?</div>
                                <div class="bubble_card__btn">
                                    <a href="/#card-info" class="bubble_card__btn_a">Узнать</a>
                                </div>
                            </div>
                        </div>
                        <!-- end of bubble -->

                    <? endif; ?>