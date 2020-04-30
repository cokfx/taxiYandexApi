<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult['SPECIALTIES'] as $specialty) {
    $GLOBALS['SPECIALTIES_CODES'][] = $specialty['CODE'];
}