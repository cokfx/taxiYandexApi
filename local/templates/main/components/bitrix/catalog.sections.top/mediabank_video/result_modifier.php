<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["SECTIONS"] as &$section) {
    if(!empty($section['ITEMS']))
        $arResult['HAS_ANY_ITEM'] = true;
    else
        continue;
    if(!$section['UF_VIDEO_SHOW_SMALL'])
        $arResult['BIG_ICONS'][] = $section;
    else
        $arResult['SMALL_ICONS'][] = $section;
}

