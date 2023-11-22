<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
* @var array $arResult
*/
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/main-instruction.css"));
?>
<div class="x3-card-instuction">
    <div class="container">
        <h2 class="anim-slideUp"></h2>
        <div class="x3-instuction">
            <ol>
                <li class="x3-instuction__step1">
                    <div>
                        <span><a href="/guestcard/">Заполни<br> форму</a></span>
                        Заполнить несколько несложных полей
                    </div>
                </li>
                <li class="x3-instuction__step2">
                    <div>
                        <span>Скачай<br> карту ГОСТЯ</span>
                        Она будет в твоем телефоне или на почте
                    </div>
                </li>
                <li class="x3-instuction__step3">
                    <div>
                        <span>Покажи <br>в организации <br>партнере</span>
                    </div>
                </li>
                <li class="x3-instuction__step4">
                    <div>
                        <span>Получи <br>скидку</span>
                        Скидка 5, 10, 15%, комплимент от шеф-повара, другие доп. услуги
                    </div>
                </li>
            </ol>
            <img class="x3-instuction__guestcard" src="<?=$this->__component->__template->__folder?>/images/card.png" alt="guest card">
            <img class="x3-instuction__girl1" src="<?=$this->__component->__template->__folder?>/images/girl_left.png" alt="start">
            <img class="x3-instuction__girl2" src="<?=$this->__component->__template->__folder?>/images/girl_right.png" alt="finish">
        </div>
    </div>
</div>

<style>
    .x3-card-instuction {
        background-image:   url("<?=$this->__component->__template->__folder?>/images/instruction_bg_left.png"),
                            url("<?=$this->__component->__template->__folder?>/images/instruction_bg_right.png");
        background-position: -25px 370px, right bottom;
        background-repeat: no-repeat, no-repeat;
    }
</style>
