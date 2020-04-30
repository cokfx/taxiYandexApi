<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$menuList = array();
$lev = 0;
$lastInd = 0;
$parents = array();
foreach ($arResult as $arItem) {
    $lev = $arItem['DEPTH_LEVEL'];

    if ($arItem['IS_PARENT']) {
        $arItem['ITEMS'] = array();
    }

    if ($lev == 1) {
        $menuList[] = $arItem;
        $lastInd = count($menuList)-1;
        $parents[$lev] = &$menuList[$lastInd];
    } else {
        $parents[$lev-1]['ITEMS'][] = $arItem;
        $lastInd = count($parents[$lev-1]['ITEMS'])-1;
        $parents[$lev] = &$parents[$lev-1]['ITEMS'][$lastInd];
    }
}
$arResult = $menuList;
