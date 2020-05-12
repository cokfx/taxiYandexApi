<?php
$arrConfig = (require __DIR__ . '/settings.php')['arrConfig'];
require(__DIR__ . '/../../../../../../vendor/autoload.php');
include_once __DIR__ . '/ApiData.php';// ������ � ������� ���������
require __DIR__ . '/Db.php';

use Data\{Db, ApiData};

/*$configArray = [
'CURLOPT_URL_LIST' => 'https://fleet-api.taxi.yandex.net/v1/parks/driver-profiles/list',
'CURLOPT_URL_TRANSACTIONS' => 'https://fleet-api.taxi.yandex.net/v2/parks/driver-profiles/transactions',
'PARK_ID' => 'e19d549e69f548c6b4aad5bae570b4ba',
'Client_ID' => 'taxi/park/e19d549e69f548c6b4aad5bae570b4ba',
'API_Key' => 'WDk/JSTplDJldWoDRpkmBPYUflHoczTiT',

'to_post_adress' => '230267@bk.ru',
'from_post_adress' => '230267av@ya.ru',
'ostatok' => 860.9900
];*/

$driver_profile_id = "71bb388cc57941dca0ad42e2b4029731";//����������
$ostatok = $arrConfig['ostatok'] = 850.9900;

$ostatok = $configArray['ostatok'];
if ($balance > $ostatok) {
    $amount = $ostatok - $balance;
}


file_put_contents('file.txt', '1CClientBankExchange
�������������=1.02
���������=Windows
�����������=����������� �����������, �������� 3.0
����������=
������������=17.04.2020
�������������=12:05:01
����������=17.04.2020
���������=27.04.2020
��������=40802810800000596267' . "\n");

file_put_contents('file.txt', '��������������=��������� ���������
�����=964
����=17.04.2020
�����=59.64
��������������=40802810800000596267
����������=��� 325502595143 �� ���������� ������ ��������
�������������=325502595143
�������������=
����������1=�� ���������� ������ ��������
������������������=40802810800000596267
��������������1=�� &quot;�������� ����&quot;
��������������2=
�������������=044525974
�����������������=30101810145250000974
��������������=40817810907290041354
����������=��������� ���� ������������
�������������=
����������1=��������� ���� ������������
������������������=40817810907290041354
��������������1=�� &quot;�����-����&quot;
��������������2=������
�������������=044525593
�����������������=30101810200000000593
����������=
���������=01
���=
�����������������=������� �� ���������� �������� � 599/�537 �� 2019-09-22. ��� �� ����������.
�����������������1=������� �� ���������� �������� � 599/�537 �� 2019-09-22. ��� �� ����������.
�����������=5
�������������� ' . "\n", FILE_APPEND);

file_put_contents('file.txt', '����������', FILE_APPEND);

$queryTransByID = array(
    "amount" => strval($amount),
    "category_id" => "partner_service_manual",
    "currency_code" => "RUB",
    "description" => "Test",
    "driver_profile_id" => strval($driver_profile_id),
    "park_id" => "e19d549e69f548c6b4aad5bae570b4ba"
);

$queryTransByID = json_encode($queryTransByID);

$idempotenceKey = uniqid('', true);
$httpHeader = array(
    "Accept: application/json",
    "Content-Type: application/json",
    "X-Client-ID:taxi/park/e19d549e69f548c6b4aad5bae570b4ba",
    "X-API-Key:WDk/JSTplDJldWoDRpkmBPYUflHoczTiT",
    "X-Idempotency-Token: $idempotenceKey",
    "X-Accept-Language:en"
);
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $arrConfig['CURLOPT_URL_TRANSACTIONS'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $queryTransByID,
    CURLOPT_HTTPHEADER => $httpHeader,
));
//CURLOPT_POSTFIELDS => '{"amount":"-2.0000","category_id":"partner_service_manual","currency_code":"RUB","description":"Test","driver_profile_id":"71bb388cc57941dca0ad42e2b4029731","park_id":"e19d549e69f548c6b4aad5bae570b4ba"}',

$output = curl_exec($curl);

curl_close($curl);


$arrApiAll = json_decode($output, true);


//------------------Send Mail---------------
use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->CharSet = 'utf-8';
$body = $balance;
$mail->SetFrom('name@yourdomain.com', 'First Last');
$mail->AddAddress("230267@bk.ru", "John Doe");
$mail->Subject = $balance;
$mail->addAttachment('file.txt', 'file.txt');        // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);

$mail->Body = $body;

if (!$mail->Send()) {
    echo "������ �������� ������: " . $mail->ErrorInfo;
} else {
    echo "������ �����������!";
}
?>