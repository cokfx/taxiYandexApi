<?php
//include_once __DIR__ . '/../../../config/config.php';
include_once __DIR__ . '/../../../src/DriverData.php';// работа с данными водителей
include_once __DIR__ . '/../../../src/Driver.php';// работа с данными водителей

$configArray = [


    'CURLOPT_URL_LIST' => 'https://fleet-api.taxi.yandex.net/v1/parks/driver-profiles/list',
    'CURLOPT_URL_TRANSACTIONS' => 'https://fleet-api.taxi.yandex.net/v2/parks/driver-profiles/transactions',
    'PARK_ID' => 'e19d549e69f548c6b4aad5bae570b4ba',
    'Client_ID' => 'taxi/park/e19d549e69f548c6b4aad5bae570b4ba',
    'API_Key' => 'WDk/JSTplDJldWoDRpkmBPYUflHoczTiT',

    'to_post_adress'=>'230267@bk.ru',
    'from_post_adress'=>'230267av@ya.ru',
];

$driver_profile_id="71bb388cc57941dca0ad42e2b4029731";//Прохоренко

//---добавление водителя в базу приложения из базы Яндекс Такси платформы-------

//Driver::addDrivers($arResult);


$driver= new DriverData($configArray['Client_ID'],$configArray['API_Key'],$configArray);

$httpHeader=$driver->httpHeader;
   //print_r($driver->getArrConfig());
$driverId="71bb388cc57941dca0ad42e2b4029731";//Прохоренко Андрей

// добавление удаление данных из яндекс платформы
DriverData::getArrayDiff1($arResult,$httpHeader,$configArray['CURLOPT_URL_LIST']);





