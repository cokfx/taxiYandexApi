<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])) return; ?>

<div class="services layout">
    <div class="services__head js-services__head">
        <h1 class="services__sectionName"><?=$APPLICATION->GetTitle(false)?></h1>
        <div class="services__showAll"><span class="color-skyBlue">Показать всё</span></div>
    </div>
    <div class="services__products--heightCut">
        <div class="services__products js-services__products js-services__products--heightIndicator">
            <? foreach ($arResult['ITEMS'] as $item): ?>
            <a class="services__products-item product" href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>
            <? endforeach; ?>
        </div>
    </div>
</div>