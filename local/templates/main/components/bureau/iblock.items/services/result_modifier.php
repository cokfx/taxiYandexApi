<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if(empty($arResult['ITEMS']))
    return;

foreach ($arResult['ITEMS'] as &$item) {
    $arResult['SERVICES'][mb_substr($item['NAME'], 0, 1)][] = $item;
}