<?php
$arrSettings = include __DIR__ . '/settings.php';
$arrConfig = $arrSettings['arrConfig'];
$dbOptions = $arrSettings['db'];
include(__DIR__ . '/../../../../../../vendor/autoload.php');
include __DIR__ . '/ApiData.php';// работа с данными водителей
use Data\ApiData;

// ------------------PDO connection-----------------
$pdo = new \PDO(
    'mysql:host=' . $dbOptions['DBHost'] . ';dbname=' . $dbOptions['DBName'],
    $dbOptions['DBLogin'],
    $dbOptions['DBPassword']
);
$pdo->exec('SET NAMES UTF8');
// ------------------get settings-----------------

$id1 = 670;
$query = "SELECT * FROM `b_iblock_element_prop_s20` IBLOCK_ELEMENT_ID=:id;";
$params = [':id' => $id1];
$sth = $pdo->prepare($query);
$stm = $sth->execute($params);
$arrSets= $sth->fetchAll();

//---------------------------------------------------

$driver_profile_id = "71bb388cc57941dca0ad42e2b4029731";//Прохоренко
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
//----------------------get driver profile by ID-----------------
$arrApiById = ApiData::getApiDriverById($HttpHeader, $apiUrlList, $parkID, $driver_profile_id);
//----------------------get All driver profiles-----------------
$arrApiAll = ApiData::getAllDrivers($apiUrlList, $CLIENT_ID, $API_KEY);

$driverBalance = $arrApiById['driver_profiles'][0]['accounts'][0]['balance'];

//----------------------get date time-----------------
$currDate = getdate();
if (strlen($currDate['mon']) < 2) {
    $currDate['mon'] = '0' . $currDate['mon'];
}
if (strlen($currDate['seconds']) < 2) {
    $currDate['seconds'] = '0' . $currDate['seconds'];
}
if (strlen($currDate['minutes']) < 2) {
    $currDate['minutes'] = '0' . $currDate['minutes'];
}

$currDay = $currDate['mday'] . '.' . $currDate['mon'] . '.' . $currDate['year'];
$currTime = $currDate['hours'] . ':' . $currDate['minutes'] . ':' . $currDate['seconds'];

//--------------creating payment doc --------------------------

file_put_contents('file.txt', '1CClientBankExchange
ВерсияФормата=1.02
Кодировка=Windows
Отправитель=Бухгалтерия предприятия, редакция 3.0
Получатель=
ДатаСоздания=' . $currDay . '
ВремяСоздания=' . $currTime . '
ДатаНачала=17.04.2020
ДатаКонца=27.04.2020
РасчСчет=40802810800000596267' . "\n");

foreach ($arrApiAll['driver_profiles'] as $i => $item) {
    if (floatval($item['accounts'][0]['balance']) > 100) {

        $id = $item['accounts'][0]['id'];
        //----------------PDO get data from base-----------------------

        $query = "SELECT * FROM `b_iblock_element_prop_s17` WHERE PROPERTY_71=:id;";
        $params = [':id' => $id];
        $sth = $pdo->prepare($query);
        $stm = $sth->execute($params);
        $arrAmmounts[$item['accounts'][0]['id']]['data'] = $sth->fetchAll();
        $arrAmmounts[$item['accounts'][0]['id']]['amount'] = 100 - floatval($item['accounts'][0]['balance']);
        $arrAmmounts[$item['accounts'][0]['id']]['payment'] = floatval($item['accounts'][0]['balance']) - 100;

    }

}
$cnt=0;
foreach ($arrAmmounts as $i => $ammount) {
$cnt++;
    $payAmmount = $ammount['payment'];
    $payInfo = $ammount['data'][0];
    $recipient=$ammount['data'][0]['PROPERTY_73'].' '.$ammount['data'][0]['PROPERTY_74'].' '.$ammount['data'][0]['PROPERTY_75'];

    $middleText = 'СекцияДокумент=Платежное поручение
Номер=964'.$cnt.'
Дата=' . $currDay . '
Сумма=' . $payAmmount . '
ПлательщикСчет=40802810800000596267
Плательщик=ИНН 325502595143 ИП Прохоренко Андрей Петрович
ПлательщикИНН=325502595143
ПлательщикКПП=
Плательщик1=ИП Прохоренко Андрей Петрович
ПлательщикРасчСчет=40802810800000596267
ПлательщикБанк1=АО &quot;ТИНЬКОФФ БАНК&quot;
ПлательщикБанк2=
ПлательщикБИК=044525974
ПлательщикКорсчет=30101810145250000974
ПолучательСчет='.$ammount['data'][0]['PROPERTY_76'].'
Получатель='.$recipient.'
ПолучательКПП=
Получатель1='.$recipient.'
ПолучательРасчСчет=40817810907290041354
ПолучательБанк1='.$ammount['data'][0]['PROPERTY_78'].'
ПолучательБанк2=Москва
ПолучательБИК='.$ammount['data'][0]['PROPERTY_77'].'
ПолучательКорсчет='.$ammount['data'][0]['PROPERTY_79'].'
ВидПлатежа=
ВидОплаты=01
Код=
НазначениеПлатежа=Выплаты по агентскому договору № 599/С537 от 2019-09-22. НДС не облагается.
НазначениеПлатежа1=Выплаты по агентскому договору № 599/С537 от 2019-09-22. НДС не облагается.
Очередность=5
КонецДокумента ' . "\n";

    file_put_contents('file.txt', $middleText, FILE_APPEND);

}


file_put_contents('file.txt', 'КонецФайла', FILE_APPEND);

//------------------Send Mail PHPMailer---------------
use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->CharSet = 'utf-8';
$body = "ИЗ крона";
$mail->SetFrom('name@yourdomain.com', 'First Last');
$mail->AddAddress("230267@bk.ru", "John Doe");
$mail->Subject = "ИЗ крона";
$mail->addAttachment('file.txt', 'file.txt');        // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);

$mail->Body = $body;

if (!$mail->Send()) {
    echo "Ошибка отправки письма: " . $mail->ErrorInfo;
} else {
    echo "Письмо отправленно!";
}
//----------------------Send Mail End-------------------

print_r($arrSets);






