<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
* @var array $arResult
* @var array $arParams
*/
\Site\Main\Css::showInlineCssBlock(array(SITE_TEMPLATE_PATH . "/css/main-map.css"));

$APPLICATION->AddHeadString('<script> var rubs = null, map_ways = [],  map_ways_objs = [], map_ways_info = [], map_reg_objs = [], map_reg_info = [], map_reg_coord= []; '.$arResult["SECTIONS_FOR_MAP"].'</script>',true);
$APPLICATION->AddHeadScript('https://api-maps.yandex.ru/2.0-stable/?load=package.full&lang=ru-RU');
?>

<div class="x3-map">
    <div class="container">
        <h2 class="x3-map__title">Карта города</h2>
        <div class="x3-map__search">
            <input type="text" id="x3-map-input" autocomplete="off"  />
            <div id="x3-map-result" class="x3-map__result"></div>
        </div>
        <a href="#" class="x3-map__filter-btn x3-btn svg-zoom js-map-filter">
            <svg aria-hidden="true" width="21" height="21">
                <use xlink:href="#filter-svg"></use>
            </svg>
            Фильтр по категориям
        </a>
        <div class="x3-map__sections-wrap x3-map-filter">
            <a href="#" class="x3-map-filter__close x3-map-filter__mobile js-close-filter">
                <svg aria-hidden="true" width="15" height="15">
                    <use xlink:href="#close-svg"></use>
                </svg>
            </a>
            <div class="x3-map-filter__title x3-map-filter__mobile">
                Категории
            </div>
            <ul id="x3-map-sections" class="x3-map__sections">
                <?$prevLevel = 0;?>
                <?foreach ($arResult["ITEMS"] as $arItem):?>
                    <?if($arItem['ELEMENT_CNT']!=0 || $arItem['DEPTH_LEVEL']==1):?>
                        <?if($prevLevel==1 && $arItem['DEPTH_LEVEL'] == 1):?>
                            </ul></li>
                        <?endif;?>
                        <?if($prevLevel>1 && $arItem['DEPTH_LEVEL'] == 1):?>
                            </li></ul>
                        <?endif;?>
                        <?if($arItem['DEPTH_LEVEL']==1):?>
                            <li>
                                <span class="x3-map-filter__level1">
                                    <?=$arItem['NAME']?>
                                    <svg aria-hidden="true" width="27" height="15">
                                        <use xlink:href="#arrow-bottom-svg"></use>
                                    </svg>
                                </span>
                                <ul>
                        <?else:?>
                            <li>
                                <a class="map_obj_list" href="javascript: void(0);" id="ch_<?=$arItem['ID']?>" data-cnt="<?=$arItem["ELEMENT_CNT"]?>">
                                    <?if(!empty($arItem["UF_ICONMAP"])):?>
                                        <img src="<?=CFile::GetPath($arItem["UF_ICONMAP"])?>" alt="icons">
                                    <?endif;?>
                                    <?=$arItem['NAME']?>
                                </a>
                            </li>
                        <?endif;?>
                        <?$prevLevel = $arItem['DEPTH_LEVEL'];?>
                    <?endif;?>
                <?endforeach;?>

                <?for ($i = $prevLevel; $i >= 1; $i--):?>
                    <?if($i!=1):?>
                        </li></ul>
                    <?else:?>
                        </li>
                        <li class="x3-map__clear">
                            <a href="#" class="svg-zoom">
                                Сбросить фильтр
                                <svg aria-hidden="true" width="8" height="8">
                                    <use xlink:href="#close-svg"></use>
                                </svg>
                            </a>
                        </li>
                        </ul>
                    <?endif;?>
                <?endfor;?>
            </ul>
            <div class="x3-map-filter__mobile x3-map-filter__btn x3-btn js-close-filter">
                Показать <span></span>
            </div>
            <a href="#" class="x3-map-filter__clear x3-map-filter__mobile svg-zoom">
                <svg aria-hidden="true" width="8" height="8">
                    <use xlink:href="#close-svg"></use>
                </svg>
                Сбросить фильтр
            </a>
        </div>
    </div>

    <div class="x3-map__wrap">
        <div id="x3-map-wrap"></div>
    </div>
</div>