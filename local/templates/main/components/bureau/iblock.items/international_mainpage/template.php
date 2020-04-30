<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])) return; ?>

<ul class="partners__list">
    <? foreach ($arResult['ITEMS'] as $key => $item): ?>
    <li class="partners__item partner">
        <div class="partner__pic" data-lazy-bg="url(<?=\CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width'=>500, 'height' => 1000)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>) 50% 35%/cover no-repeat"></div>
        <div class="partner__container">
            <div class="partner__inner">
                <div class="partner__name"><?=$item['NAME']?></div>
                <p class="partner__biograph"><?=$item['~PREVIEW_TEXT_TYPE'] == 'text' ? str_replace("\r\n", "<br />", $item['~PREVIEW_TEXT']) : $item['~PREVIEW_TEXT']?></p>
            </div>
            <? if(!empty($item['PROPERTIES']['BLUE_TEXT']['~VALUE'])): ?>
                <div class="partner__spec"><?=$item['PROPERTIES']['BLUE_TEXT']['~VALUE']?></div>
            <? endif; ?>
        </div>
    </li>
    <? endforeach; ?>
</ul>