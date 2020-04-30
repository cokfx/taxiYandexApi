<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if(empty($arResult['ITEMS']))
    return;

foreach ($arResult['ITEMS'] as &$item) {
    $arResult['SERVICES'][mb_substr($item['NAME'], 0, 1)][] = $item;
}
unset($item);

$arResult['COLUMNS'] = [];
$colCount = round(count($arResult['ITEMS'])/4);
$col = 1;
$i = 0;
foreach ($arResult['ITEMS'] as $item) {
	$i++;
	if($i>$colCount){
		$i = 0;
		$col++;
	}
	$arResult['COLUMNS'][$col][] = $item;
}