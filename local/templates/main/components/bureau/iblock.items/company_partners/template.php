<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])): ?>
    <h2>Список на данный момент заполняется...</h2>
    <? return; endif; ?>

<ul class="company-partners__list">
    <? foreach ($arResult['ITEMS'] as $item): ?>
        <? if($item['PREVIEW_PICTURE']): ?>
        <li class="company-partners__item">
            <div class="infoCards">
                <div class="infoCards__pic"><img class="infoCards__img" src="<?=\CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width'=>300, 'height' => 100)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>" alt="<?=$item['NAME']?>"></div>
                <div class="infoCards__name"><?=$item['NAME']?></div>
            </div>
        </li>
        <? else: ?>
        <li class="company-partners__item">
            <div class="infoCards">
                <div class="infoCards__name"><?=$item['NAME']?></div>
            </div>
        </li>
        <? endif; ?>
    <? endforeach; ?>
</ul>