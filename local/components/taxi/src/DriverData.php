<?php


class DriverData
{
    public $httpHeader;
    private $arrConfig;

    function __construct($Client_ID, $API_Key, $arrConfig)
    {
        $this->httpHeader = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "X-Client-ID:" . $Client_ID,
            "X-API-Key:" . $API_Key,
            //'Park ID: e19d549e69f548c6b4aad5bae570b4ba',
            "X-Accept-Language:en"
        );
        $this->arrConfig = $arrConfig;
    }

    /**
     * @return mixed
     */
    public function getArrConfig()
    {
        return $this->arrConfig;
    }

    /**
     * @return array
     */
    public function getHttpHeader()
    {
        return $this->httpHeader;
    }

    // все водители из апи яндекс
    private static function getApiAllDrivers($HttpHeader, $apiUrl)
    {
        $queryDriverAllMin = '{"fields":{"car":[],"park":[],"driver_profile":["first_name","last_name","middle_name","phones","id"],"account":["id","balance","balance_limit","currency"]},"query":{"park":{"id":"e19d549e69f548c6b4aad5bae570b4ba"}}}';

        //$HttpHeader = $this->HttpHeader;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $queryDriverAllMin,

            CURLOPT_HTTPHEADER => $HttpHeader,
        ));

        $output = curl_exec($curl);

        curl_close($curl);

        return $arrApiAll = json_decode($output, true);
    }


    // разница между массивами водителей из базы сайта и яндекс такси апи
    public function getArrayDiff($arrBase, $HttpHeader, $apiUrl)
    {
        foreach ($arrBase['ITEMS'] as $i => $profile) {
            $arrBaseAllKeys[$profile['PROPERTY_71']] = $profile['PROPERTY_71'];
        }
        foreach (self::getApiAllDrivers($HttpHeader, $apiUrl)['driver_profiles'] as $i => $profile) {
            $arrApiAllKeys[$profile['driver_profile']['id']] = $profile['driver_profile']['id'];
            if (!$arrBaseAllKeys[$profile['driver_profile']['id']]) {
                $arrDif[] = $profile;
            }
        }
        return $arrDif;
    }

    public function getArrayDiff1($arrBase, $HttpHeader, $apiUrl)
    {
        $arrApiDrivers = self::getApiAllDrivers($HttpHeader, $apiUrl)['driver_profiles'];
        $arrBaseDrivers = $arrBase['ITEMS'];

        $cntApiDrivers = count($arrApiDrivers);
        $cntBaseDrivers = count($arrBaseDrivers);

        if ($cntBaseDrivers < $cntApiDrivers) {

            foreach ($arrBaseDrivers as $i => $profile) {
                $arrBaseAllKeys[$profile['PROPERTY_71']] = $profile['PROPERTY_71'];
            }
            foreach ($arrApiDrivers as $i => $profile) {
                $arrApiAllKeys[$profile['driver_profile']['id']] = $profile['driver_profile']['id'];
                if (!$arrBaseAllKeys[$profile['driver_profile']['id']]) {
                    $arrDif[] = $profile;
                }
            }

            //self::addDrivers($arrDif);
            //return $arrDif;
        } elseif ($cntBaseDrivers > $cntApiDrivers) {
            foreach ($arrBaseDrivers as $i => $profile) {
                $arrBaseAllKeys[$profile['PROPERTY_71']] = $profile['PROPERTY_71'];
                $arrBaseAllId[$profile['PROPERTY_71']] = $profile['ID'];
            }

            foreach ($arrApiDrivers as $i => $profile) {
                $arrApiAllKeys[$profile['driver_profile']['id']] = $profile['driver_profile']['id'];
            }
            $arrDif = array_diff_key($arrBaseAllId, $arrApiAllKeys);

            self::deleteDrivers($arrDif);

            //return $arrDif;
        } else {
            return "Синхронизовано";
        }

    }


// добавление водителя(ей) из апи если их нет на сайте
    static function addDrivers($arrDif)
    {

        if (\Bitrix\Main\Loader::includeModule('iblock')) {

            $el = new CIBlockElement;
            foreach ($arrDif as $i => $item) {
                $driverName = $item['driver_profile']['last_name'] . " " . $item['driver_profile']['first_name'] . " " . $item['driver_profile']['middle_name'];
                $iblockId = 17;
                $PROP = array();
                $PROP[71] = $item['driver_profile']['id'];
                $arLoadProductArray = Array(
                    "IBLOCK_ID" => $iblockId,
                    "NAME" => $driverName,
                    "PROPERTY_VALUES" => $PROP,
                );

                if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                    echo "Добавлен новый водитель: " . $driverName;
                    echo '<br>';
                } else {
                    echo "Error: " . $el->LAST_ERROR;
                }

            }

        }


    }

    // удаление водителя(ей) из апи если их нет на сайте
    static function deleteDrivers($arrDif)
    {

        if (\Bitrix\Main\Loader::includeModule('iblock')) {


            foreach ($arrDif as $i => $item) {

                $DEL_ID = CIBlockElement::Delete($item);

                echo 'Удален - ' . $DEL_ID . '<br>';

            }

        }


    }
//=========================================================

    // водитель по его ID из апи яндекс
    public static function getApiDriverById1($HttpHeader, $apiUrl, $parkID, $driver_profile_id)
    {
        $queryDriverByIDMin = array(
            "fields" => Array(
                "car" => Array(),

                "park" => Array(),

                "driver_profile" => Array("first_name", "last_name", "middle_name", "phones", "id"),

                "account" => Array("id", "balance", "balance_limit", "currency")

            ),
            "query" => Array(
                "park" => Array(
                    "id" => $parkID,
                    "driver_profile" => Array(
                        "id" => Array($driver_profile_id)

                    )

                )

            )

        );
        //{"fields":{"car":[],"park":[],"driver_profile":["first_name","last_name","middle_name","phones","id"],"account":["id","balance","balance_limit","currency"]},"query":{"park":{"id":"e19d549e69f548c6b4aad5bae570b4ba","driver_profile":{"id":["71bb388cc57941dca0ad42e2b4029731"]}}}}
        //$queryDriverByIDMin = '{"fields":{"car":[],"park":[],"driver_profile":["first_name","last_name","middle_name","phones","id"],"account":["id","balance","balance_limit","currency"]},"query":{"park":{"id":"e19d549e69f548c6b4aad5bae570b4ba","driver_profile":{"id":["71bb388cc57941dca0ad42e2b4029731"]}}}}';// Прохоренко
        $queryDriverByIDMin = json_encode($queryDriverByIDMin);// Прохоренко

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $queryDriverByIDMin,
            CURLOPT_HTTPHEADER => $HttpHeader,
        ));

        $output = curl_exec($curl);

        curl_close($curl);

        return $arrApiAll = json_decode($output, true);
    }

    // балланс водителя из АПИ

    public static function getApiDriverBalance($HttpHeader, $apiUrl, $parkID, $driver_profile_id)
    {

        $arrApiDriverById = self::getApiDriverById1($HttpHeader, $apiUrl, $parkID, $driver_profile_id);

        if (!empty($arrApiDriverById['driver_profiles'][0]['accounts'])) {

            return $arrApiDriverById['driver_profiles'][0]['accounts'][0]['balance'];

        }

    }

    // подготовка запроса транзакции

    private static function transferPrepair($balance, $driver_profile_id = "71bb388cc57941dca0ad42e2b4029731", $ostatok = 100)
    {
        //71bb388cc57941dca0ad42e2b4029731
        //self::getApiDriverById();
        $amount =  strval($ostatok-$balance);
        $queryTransByID = array(
            "amount" => "-" . $amount . "",
            "category_id" => "partner_service_manual",
            "currency_code" => "RUB",
            "description" => "Test",
            "driver_profile_id" => $driver_profile_id,
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
            CURLOPT_URL => "https://fleet-api.taxi.yandex.net/v2/parks/driver-profiles/transactions",
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

        $output = curl_exec($curl);

        curl_close($curl);


        return $arrApiAll = json_decode($output, true);
    }



}