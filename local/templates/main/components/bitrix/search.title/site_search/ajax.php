<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if(!empty($arResult["CATEGORIES"])): ?>
    <div class="live-search__result js-live-search__result">
        <ul class="live-search__list js-live-search__list">
            <?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
                <? if(++$iterator > 1): ?>
                    <?/*<hr />*/?>
                <? endif; ?>
                <?foreach($arCategory["ITEMS"] as $i => $arItem):?>
                    <? if(!$arItem['IS_PRICE']): ?>
                        <li class="live-search__item js-live-search__item">
                            <a href="<?echo $arItem["URL"]?>">
                                <div class="layout layout--header"><?=$arItem["NAME"]?></div>
                            </a>
                        </li>
                    <? else: ?>
                        <li class="live-search__item js-live-search__item">
                            <div class="layout layout--header">
                                <div class="live-search__table">
                                    <div class="live-search__table-item"><b>Код:</b> <?=$arItem['CODE']?></div>
                                    <div class="live-search__table-item"><?=$arItem["NAME"]?></div>
                                    <div class="live-search__table-item"><b>Цена:</b> <?=$arItem['PRICE']?> руб.</div>
                                </div>
                            </div>
                        </li>
                    <? endif; ?>
                <?endforeach;?>
            <?endforeach;?>
        </ul>
    </div>
<? endif; ?>