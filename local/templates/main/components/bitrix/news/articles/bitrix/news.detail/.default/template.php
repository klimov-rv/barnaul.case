<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/articles-detail.css"));
?>

<div class="x3-article">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
        <div class="x3-article__img">
            <img src="<?=$arResult["DETAIL_PICTURE"]["src"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"/>
        </div>
	<?endif?>

    <?if(!empty($arResult["DETAIL_TEXT"])):?>
        <div class="x3-article__text">
            <?=$arResult["DETAIL_TEXT"]?>
        </div>
    <?endif;?>
    <?if(!empty($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTOS"]["VALUE"])):?>
        <div class="x3-article__photo-wrap">
            <div class="x3-article__photos">
                <?foreach($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as $photo):?>
                    <a href="<?=$photo["FULL"]?>">
                        <img loading="lazy" src="<?=$photo["PREVIEW"]["src"]?>" alt="">
                    </a>
                <?endforeach;?>
            </div>
            <?if($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTOS"]["VALUE"]>4):?>
                <div class="x3-article__photos-more">
                    <a href="#" class="x3-btn js-more-photo svg-bottom">
                        <span>Развернуть</span>
                        <svg aria-hidden="true" width="15" height="20">
                            <use xlink:href="#arrow-down2-svg"></use>
                        </svg>
                    </a>
                </div>
            <?endif;?>
        </div>
    <?endif;?>

    <div class="x3-article__bottom">
        <a href="<?=$arResult["LIST_PAGE_URL"]?>" class="x3-btn svg-left">
            <svg aria-hidden="true" width="19" height="15">
                <use xlink:href="#arrow-left2-svg"></use>
            </svg>
            Вернуться к списку
        </a>
        <div class="x3-article__share">
            Поделиться:
            <script src="https://yastatic.net/share2/share.js"></script>
            <div class="ya-share2" data-curtain data-services="vkontakte,odnoklassniki,telegram"></div>
        </div>
    </div>
</div>

<?if(!empty($arResult["DISPLAY_ACTIVE_FROM"])):?>
    <?$this->SetViewTarget('article-date');?>
        <div class="x3-article-date">
            <?=$arResult["DISPLAY_ACTIVE_FROM"]?>
        </div>
    <?$this->EndViewTarget();?>
<?endif;?>