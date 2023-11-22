<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/form.css"));
?>

<div class="x3-form" id="x3-form">
    <?if(!empty($arResult["ERROR_MESSAGE"])):?>
        <?foreach($arResult["ERROR_MESSAGE"] as $v)
            ShowError($v);?>
    <?endif;?>
    <?if($arResult["OK_MESSAGE"] <> ''):?>
        <div class="x3-form__message">
            <br><?=$arResult["OK_MESSAGE"]?><br><br><br>
            <div class="x3-header__logo" style="display: flex; justify-content: center">
                <a href="/" class="x3-logo <? if ($APPLICATION->GetCurPage(false) == '/'): ?>x3-logo--white<?endif;?>">
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
        </div>
    <?else:?>
        <form action="<?=POST_FORM_ACTION_URI?>" method="POST">
            <?=bitrix_sessid_post()?>
            <div class="x3-form__item">
                <input type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>" placeholder="<?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>" <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?>required<?endif;?>>
            </div>
            <div class="x3-form__item">
                <input type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>" placeholder="<?=GetMessage("MFT_EMAIL")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>" <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?>required<?endif;?>>
            </div>
            <div class="x3-form__item">
            <textarea name="MESSAGE" rows="5" cols="40" placeholder="<?=GetMessage("MFT_MESSAGE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>" <?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?>required<?endif;?>><?=$arResult["MESSAGE"]?></textarea>
            </div>

            <?if($arParams["USE_CAPTCHA"] == "Y"):?>
                <div class="x3-form__item x3-form__captcha">
                    <div class="x3-form__captcha-img">
                        <div class="x3-form__label"><?=GetMessage("MFT_CAPTCHA")?></div>
                        <input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
                    </div>
                    <div class="x3-form__code">
                        <div class="x3-form__label"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
                        <input type="text" name="captcha_word" size="30" maxlength="50" value="" required>
                    </div>
                </div>
            <?endif;?>
            <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
            <div class="x3-form-check">
                <input type="checkbox" name="form-agrement" id="form-agrement">
                <label class="x3-form-check__label" for="form-agrement">Согласие с <a href="/politika/" target="_blank">политикой обработки персональных данных</a></label>
            </div>

            <div class="x3-block-center">
                <input type="submit" name="submit" class="x3-btn" disabled value="<?=GetMessage("MFT_SUBMIT")?>">
            </div>
        </form>
    <?endif;?>
</div>