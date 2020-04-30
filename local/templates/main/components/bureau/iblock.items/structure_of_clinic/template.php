<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])) return; ?>

<div class="regenerative-medicine__links">
    <ul class="links-services__list">
        <? foreach ($arResult['ITEMS'] as $item): ?>
        <li class="links-services__item"><a class="links-services__link" href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a></li>
        <? endforeach; ?>
    </ul>
    <div class="regenerative-medicine__btn">
        <div class="regenerative-medicine__btnBox js-btn-showAll"><span class="color-skyBlue">Показать всё</span></div>
    </div>
</div>