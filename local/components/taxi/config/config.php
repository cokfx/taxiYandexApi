<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>

<?php
$configArray = [
    'CURLOPT_URL_LIST' => 'https://fleet-api.taxi.yandex.net/v1/parks/driver-profiles/list',
    'CURLOPT_URL_TRANSACTIONS' => 'https://fleet-api.taxi.yandex.net/v2/parks/driver-profiles/transactions',
    'PARK_ID' => 'e19d549e69f548c6b4aad5bae570b4ba',
    'Client_ID' => 'taxi/park/e19d549e69f548c6b4aad5bae570b4ba',
    'API_Key' => 'WDk/JSTplDJldWoDRpkmBPYUflHoczTiT',

    'to_post_adress' => '230267@bk.ru',
    'from_post_adress' => '230267av@ya.ru',
    'ostatok'=>915.9900
];
?>