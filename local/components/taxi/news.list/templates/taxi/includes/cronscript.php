<?php
$arrSettings = include __DIR__ . '/settings.php';
$arrConfig = $arrSettings['arrConfig'];
$dbOptions = $arrSettings['db'];
include(__DIR__ . '/../../../../../../vendor/autoload.php');
include __DIR__ . '/ApiData.php';// работа с данными водителей
use Data\ApiData;

$pdo = new \PDO(
    'mysql:host=' . $dbOptions['DBHost'] . ';dbname=' . $dbOptions['DBName'],
    $dbOptions['DBLogin'],
    $dbOptions['DBPassword']
);
$pdo->exec('SET NAMES UTF8');

/*$arrConfig = [
'CURLOPT_URL_LIST' => 'https://fleet-api.taxi.yandex.net/v1/parks/driver-profiles/list',
'CURLOPT_URL_TRANSACTIONS' => 'https://fleet-api.taxi.yandex.net/v2/parks/driver-profiles/transactions',
'PARK_ID' => 'e19d549e69f548c6b4aad5bae570b4ba',
'Client_ID' => 'taxi/park/e19d549e69f548c6b4aad5bae570b4ba',
'API_Key' => 'WDk/JSTplDJldWoDRpkmBPYUflHoczTiT',

'to_post_adress' => '230267@bk.ru',
'from_post_adress' => '230267av@ya.ru',
'ostatok' => 860.9900
];*/

$driver_profile_id = "71bb388cc57941dca0ad42e2b4029731";//ѕрохоренко
$ostatok = $arrConfig['ostatok'];
$ostatok = 850.9900;
$apiUrlList = $arrConfig['CURLOPT_URL_LIST'];
$parkID = $arrConfig['PARK_ID'];
$CLIENT_ID = $arrConfig['Client_ID'];
$API_KEY = $arrConfig['API_Key'];

$HttpHeader = array(
    "Accept: application/json",
    "Content-Type: application/json",
    "X-Client-ID: $CLIENT_ID",//taxi/park/e19d549e69f548c6b4aad5bae570b4ba
    "X-API-Key:$API_KEY",//WDk/JSTplDJldWoDRpkmBPYUflHoczTiT
    "X-Accept-Language:en"
);

$arrApiById = ApiData::getApiDriverById($HttpHeader, $apiUrlList, $parkID, $driver_profile_id);

$arrApiAll = ApiData::getAllDrivers($apiUrlList, $CLIENT_ID, $API_KEY);

$driverBalance = $arrApiById['driver_profiles'][0]['accounts'][0]['balance'];

foreach ($arrApiAll['driver_profiles'] as $i => $item) {
    if (floatval($item['accounts'][0]['balance']) > 100) {

        $id = $item['accounts'][0]['id'];
        $query = "SELECT * FROM `b_iblock_element_prop_s17` WHERE PROPERTY_71=:id;";
        $params = [':id' => $id];
        $sth = $pdo->prepare($query);
        $stm = $sth->execute($params);
        $arrAmmounts[$item['accounts'][0]['id']]['data'] = $sth->fetchAll();
        $arrAmmounts[$item['accounts'][0]['id']]['amount'] = 100 - floatval($item['accounts'][0]['balance']);
    }
}

print_r($arrAmmounts);






