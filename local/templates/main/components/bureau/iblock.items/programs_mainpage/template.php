<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])): ?>
    <? return; endif; ?>

<div class="individual__programmsContainer">
    <? foreach ($arResult['ITEMS'] as $key => $item): ?>
    <a class="individual__programms-item program" href="/patsientam/programmy-obsluzhivaniya-dlya-patsientov/">
        <div class="program__head blockName color-skyBlue"><?=$item['~NAME']?></div>
        <div class="program__text"><?=$item['~PREVIEW_TEXT']?></div>
    </a>
    <? endforeach; ?>
</div>