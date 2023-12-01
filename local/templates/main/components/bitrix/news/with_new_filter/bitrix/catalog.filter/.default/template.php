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
?>


<!-- filter -->
<div class="x3-sec-filter layout__filter hide-m">
    <div class="filter-wrap">
        <div class="filter-title">
            <div class="filter-toggle">
								<span class="filter-title-inner">
									Вид кухни <i class="filter-count-selected"></i>
								</span>
                <svg aria-hidden="true" width="11" height="7">
                    <use xlink:href="#arrow-down-svg"></use>
                </svg>
            </div>
            <div class="filter-popup">
                <ul class="curr_filter_values">
                    <div class="row filter-checbox-item">
                        <input type="checkbox" id="chk1" />
                        <label title="Азиатская" for="chk1">Азиатская</label>
                    </div>
                    <div class="row filter-checbox-item">
                        <input type="checkbox" id="chk2" />
                        <label title="Русская" for="chk2">Русская</label>
                    </div>
                    <div class="row filter-checbox-item">
                        <input type="checkbox" id="chk3" />
                        <label title="Европейская" for="chk3">Европейская</label>
                    </div>
                    <div class="row filter-checbox-item">
                        <input type="checkbox" id="chk4" />
                        <label title="Азиатская" for="chk4">Азиатская</label>
                    </div>
                </ul>
                <button class="btn-main filter-apply" type="button">
                    Применить
                </button>
            </div>
        </div>
    </div>
    <div class="filter-wrap">
        <div class="filter-title">
            <div class="filter-toggle">
								<span class="filter-title-inner">
									Cредний чек
								</span>
                <svg aria-hidden="true" width="11" height="7">
                    <use xlink:href="#arrow-down-svg"></use>
                </svg>
            </div>
            <div class="filter-popup">
                <input value="0,100" type="range" multiple>
                <div class="range-slider-input row is-grid flex-center">
                    <div class="cell-6">
                        <input class="input-field input-range" name="price_min" placeholder="500" value="500" data-range-from="">
                    </div>
                    <div class="cell-6">
                        <input class="input-field input-range" name="price_max" placeholder="13000" value="13000" data-range-to="">
                    </div>
                </div>
                <button class="btn-main filter-apply" type="button">
                    Применить
                </button>
            </div>
        </div>
    </div>
    <div class="filter-wrap">
        <div class="filter-title">
            <div class="filter-toggle">
								<span class="filter-title-inner">
									Особенности <i class="filter-count-selected"></i>
								</span>
                <svg aria-hidden="true" width="11" height="7">
                    <use xlink:href="#arrow-down-svg"></use>
                </svg>
            </div>
            <div class="filter-popup">
                <ul class="curr_filter_values">
                    <div class="row filter-checbox-item">
                        <input type="checkbox" id="chk1-1" />
                        <label title="Азиатская" for="chk1-1">Все</label>
                    </div>
                    <div class="row filter-checbox-item">
                        <input type="checkbox" id="chk1-2" />
                        <label title="Русская" for="chk1-2">Рестораны</label>
                    </div>
                    <div class="row filter-checbox-item">
                        <input type="checkbox" id="chk1-3" />
                        <label title="Европейская" for="chk1-3">Кафе</label>
                    </div>
                </ul>
                <button class="btn-main filter-apply" type="button">
                    Применить
                </button>
            </div>
        </div>
    </div>
</div>
<!-- end of filter -->

