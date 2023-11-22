<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arResult["NavPageCount"] > 1):?>

    <?if ($arResult["NavPageNomer"]+1 <= $arResult["nEndPage"]):?>
        <?
        $plus = $arResult["NavPageNomer"]+1;
        $url = $arResult["sUrlPathParams"] . "PAGEN_".$arResult["NavNum"]."=".$plus;
        ?>

        <div class="load-more-items x3-btn svg-bottom" data-url="<?=$url?>">
            Посмотреть еще
            <svg aria-hidden="true" width="15" height="19">
                <use xlink:href="#arrow-down2-svg"></use>
            </svg>
        </div>

    <?endif?>

<?endif?>