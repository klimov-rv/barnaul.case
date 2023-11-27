<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? \Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/top-menu.css")); ?>

<? if (!empty($arResult)) : ?>
    <div class="x3-tmenu <? if ($APPLICATION->GetCurPage(false) == '/') : ?>x3-tmenu--white<? endif; ?>">
        <div class="x3-tmenu__icon">
            <svg aria-hidden="true" width="20" height="15">
                <use xlink:href="#menu-svg"></use>
            </svg>
        </div>
        <div class="x3-tmenu__wrap">
            <div class="x3-tmenu__mobile">
                <div class="x3-tmenu__btn">

                </div>
                <button class="x3-tmenu__close">
                    <svg aria-hidden="true" width="15" height="15">
                        <use xlink:href="#close-svg"></use>
                    </svg>
                </button>
            </div>
            <ul class="x3-tmenu__list">
                <?
                $previousLevel = 0;
                foreach ($arResult as $arItem) : ?>

                    <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) : ?>
                        <?= str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
                    <? endif ?>

                    <? if ($arItem["IS_PARENT"]) : ?>
                        <? console_log($arItem) ?>
                        <? if ($arItem["DEPTH_LEVEL"] == 1) : ?>

                            <li <? if ($arItem["SELECTED"]) : ?> class="item-selected" <? endif ?>>
                                <a href="<?= $arItem["LINK"] ?>">
                                    <?= $arItem["TEXT"] ?>
                                    <svg aria-hidden="true" width="11" height="7">
                                        <use xlink:href="#arrow-down-svg"></use>
                                    </svg>
                                </a>
                                <ul>
                                <? else : ?>
                                    <li<? if ($arItem["SELECTED"]) : ?> class="item-selected" <? endif ?>><a href="<?= $arItem["LINK"] ?>" class="parent"><?= $arItem["TEXT"] ?></a>
                                        <ul>
                                        <? endif ?>

                                    <? else : ?>

                                        <? if ($arItem["PERMISSION"] > "D") : ?>

                                            <? if ($arItem["DEPTH_LEVEL"] == 1) : ?>
                                                <li><a href="<?= $arItem["LINK"] ?>" class="<? if ($arItem["SELECTED"]) : ?>root-item-selected<? else : ?>root-item<? endif ?>"><?= $arItem["TEXT"] ?></a></li>
                                            <? else : ?>
                                                <li<? if ($arItem["SELECTED"]) : ?> class="item-selected" <? endif ?>><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                            </li>
                        <? endif ?>

                    <? else : ?>

                        <? if ($arItem["DEPTH_LEVEL"] == 1) : ?>
                            <li><a href="" class="<? if ($arItem["SELECTED"]) : ?>root-item-selected<? else : ?>root-item<? endif ?>" title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?= $arItem["TEXT"] ?></a></li>
                        <? else : ?>
                            <li><a href="" class="denied" title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?= $arItem["TEXT"] ?></a></li>
                        <? endif ?>

                    <? endif ?>

                <? endif ?>

                <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

            <? endforeach ?>

            <? if ($previousLevel > 1) : //close last item tags
            ?>
                <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
            <? endif ?>
            </ul>
        </div>
    </div>
<? endif ?>