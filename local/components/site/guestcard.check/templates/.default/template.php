<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
* @var array $arResult
*/
?>

<div class="guestcard-info">
    <?if($arResult["REQUEST"]["CNT"]):?>
        <span class="guestcard-ok"><?=GetMessage("GUESTCARD_OK")?></span>
    <?else:?>
        <span class="guestcard-ok"><?=GetMessage("GUESTCARD_ERROR")?></span>
    <?endif;?>
</div>