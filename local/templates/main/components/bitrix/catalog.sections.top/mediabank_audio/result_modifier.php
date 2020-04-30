<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["SECTIONS"] as &$section) {
    if(!empty($section['ITEMS']))
        $arResult['HAS_ANY_ITEM'] = true;
}

