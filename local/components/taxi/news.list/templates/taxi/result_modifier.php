<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
require_once __DIR__ . '/includes/ApiData.php';

use Data\ApiData;

/*$configArray = [


    'CURLOPT_URL_LIST' => 'https://fleet-api.taxi.yandex.net/v1/parks/driver-profiles/list',
    'CURLOPT_URL_TRANSACTIONS' => 'https://fleet-api.taxi.yandex.net/v2/parks/driver-profiles/transactions',
    'PARK_ID' => 'e19d549e69f548c6b4aad5bae570b4ba',
    'Client_ID' => 'taxi/park/e19d549e69f548c6b4aad5bae570b4ba',
    'API_Key' => 'WDk/JSTplDJldWoDRpkmBPYUflHoczTiT',

    'to_post_adress' => '230267@bk.ru',
    'from_post_adress' => '230267av@ya.ru',
];*/

$CLIENT_ID = $arParams['CLIENT_ID'];//$API_KEY
$API_KEY = $arParams['API_KEY'];
?>
<?//$arParams['CLIENT_ID']
$getAllDrivers = ApiData::getAllDrivers($arParams['API_LIST_URL'], $CLIENT_ID, $API_KEY)['driver_profiles'];
$cntApiDrivers = count($getAllDrivers);
$cntBaseDrivers = count($arResult['ITEMS']);

if ($cntApiDrivers > $cntBaseDrivers) {

    foreach ($arResult['ITEMS'] as $i => $profile) {
        $arrBaseAllKeys[$profile['PROPERTIES']['ID_FROM_YT']['VALUE']] = $profile['PROPERTIES']['ID_FROM_YT']['VALUE'];
        $arrBaseAllId[$profile['PROPERTIES']['ID_FROM_YT']['VALUE']] = $profile['ID'];
    }

    foreach ($getAllDrivers as $i => $profile) {
        $arrApiAllKeys[$profile['driver_profile']['id']] = $profile['driver_profile']['id'];
        if (!$arrBaseAllKeys[$profile['driver_profile']['id']]) {
            $arrDif[] = $profile;
        }
    }

    if (\Bitrix\Main\Loader::includeModule('iblock')) {

        $el = new CIBlockElement;
        foreach ($arrDif as $i => $item) {
            $driverName = $item['driver_profile']['last_name'] . " " . $item['driver_profile']['first_name'] . " " . $item['driver_profile']['middle_name'];
            $iblockId = 17;
            $PROP = array();
            $PROP['ID_FROM_YT'] = $item['driver_profile']['id'];
            $arLoadProductArray = Array(
                "IBLOCK_ID" => $iblockId,
                "NAME" => $driverName,
                "PROPERTY_VALUES" => $PROP,
            );

            if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                $arResult['SINCHR']['ADD'][] = "Добавлен новый водитель: " . $driverName;
                //echo "Добавлен новый водитель: " . $driverName;

                // echo '<br>';
            } else {
                echo "Error: " . $el->LAST_ERROR;
            }

        }

    }

} elseif ($cntApiDrivers < $cntBaseDrivers) {

    echo "deleteDriverInBase()";
    foreach ($arResult['ITEMS'] as $i => $profile) {
        $arrBaseAllKeys[$profile['PROPERTIES']['ID_FROM_YT']['VALUE']] = $profile['PROPERTIES']['ID_FROM_YT']['VALUE'];
        $arrBaseAllId[$profile['PROPERTIES']['ID_FROM_YT']['VALUE']] = $profile['ID'];
    }

    foreach ($getAllDrivers as $i => $profile) {
        $arrApiAllKeys[$profile['driver_profile']['id']] = $profile['driver_profile']['id'];
    }
    $arrDif = array_diff_key($arrBaseAllId, $arrApiAllKeys);

    if (\Bitrix\Main\Loader::includeModule('iblock')) {

        foreach ($arrDif as $i => $item) {

            $DEL_ID = CIBlockElement::Delete($item);
            if ($DEL_ID) {
                $arResult['SINCHR']['DEL'][] = 'Удален - ' . $item;
                //echo 'Удален - ' . $item . '<br>';
            }

        }

    }

} else {

    $arResult['SINCHR'] = "Синхронизовано";

}

pretty_print($arrDif, false, false, "Description");


