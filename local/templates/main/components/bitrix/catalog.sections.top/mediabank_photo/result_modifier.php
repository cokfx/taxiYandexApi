<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["SECTIONS"] as &$section) {
    if(!empty($section['ITEMS']))
        $arResult['HAS_ANY_ITEM'] = true;
    else
        continue;
    foreach ($section['ITEMS'] as &$photo) {
        if(!empty($photo['PROPERTIES']['NAME_IS_FULL_NAME_OF_DOCTOR']['VALUE'])) {
            $nameArr = explode(' ', $photo['NAME'], 2);
            $photo['SURNAME'] = $nameArr[0];
            $photo['INITIALS'] = $nameArr[1];
        }
    }
    if(!$section['UF_PHOTO_SHOW_SMALL'])
        $arResult['BIG_ICONS'][] = $section;
    else
        $arResult['SMALL_ICONS'][] = $section;
}

