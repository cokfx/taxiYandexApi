<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?php
namespace Data;

class Driver
{
    private static $httpHeader = array(
        "Accept: application/json",
        "Content-Type: application/json",
        "X-Client-ID:taxi/park/e19d549e69f548c6b4aad5bae570b4ba",
        "X-API-Key:WDk/JSTplDJldWoDRpkmBPYUflHoczTiT",
        //'Park ID: e19d549e69f548c6b4aad5bae570b4ba',
        "X-Accept-Language:en"
    );

    private static $queryDriverAllMin = '{"fields":{"car":[],"park":[],"driver_profile":["first_name","last_name","middle_name","phones","id"],"account":["id","balance","balance_limit","currency"]},"query":{"park":{"id":"e19d549e69f548c6b4aad5bae570b4ba"}}}';


    private static $queryDriverByIDMin = '{"fields":{"car":[],"park":[],"driver_profile":["first_name","last_name","middle_name","phones","id"],"account":["id","balance","balance_limit","currency"]},"query":{"park":{"id":"e19d549e69f548c6b4aad5bae570b4ba","driver_profile":{"id":["71bb388cc57941dca0ad42e2b4029731"]}}}}';// Прохоренко

    private static $CURLOPT_URL = 'https://fleet-api.taxi.yandex.net/v1/parks/driver-profiles/list';

    // Все водители из апи яндекс
    private static function getApiAllDrivers()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::$CURLOPT_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => self::$queryDriverAllMin,
            //{"driver_profile":{"id": "a6c44b91c10d09ca36d490ea66dfaba7"}}
            //},
            CURLOPT_HTTPHEADER => self::$httpHeader,
        ));

        $output = curl_exec($curl);

        curl_close($curl);

        return $arrApiAll = json_decode($output, true);
    }

    // водитель по его ID из апи яндекс
    private static function getApiDriverById($parkID , $driver_profile_id)
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
            CURLOPT_URL => self::$CURLOPT_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $queryDriverByIDMin,
            CURLOPT_HTTPHEADER => self::$httpHeader,
        ));

        $output = curl_exec($curl);

        curl_close($curl);

        return $arrApiAll = json_decode($output, true);
    }



    static function getBaseDriverById($idElem)
    {
        if (\Bitrix\Main\Loader::includeModule('iblock')) {

            $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
            $arFilter = Array("IBLOCK_ID" => 17, "ID" => $idElem);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            while ($ob = $res->Fetch()) {
                $arRes[$ob['ID']] = $ob;
            }


        }
        return $arRes;
    }

    static function getArrayDiff($arrBase)
    {
        foreach ($arrBase['ITEMS'] as $i => $profile) {
            $arrBaseAllKeys[$profile['PROPERTY_71']] = $profile['PROPERTY_71'];
        }
        foreach (self::getApiAllDrivers()['driver_profiles'] as $i => $profile) {
            $arrApiAllKeys[$profile['driver_profile']['id']] = $profile['driver_profile']['id'];
            if (!$arrBaseAllKeys[$profile['driver_profile']['id']]) {
                $arrDif[] = $profile;
            }

        }
        return $arrDif;

    }

    static function addDrivers($arrBase)
    {
        if (!empty($arrDif = self::getArrayDiff($arrBase))) {
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

    }

    static function getArrayApiAllDrivers()
    {

        pretty_print(self::getApiAllDrivers(), false);

    }










    public static function addTrasferById($driver_profile_id, $ostatok)
    {
        $ammount = self::ammountPrepairById($driver_profile_id, $ostatok);

        self::transferPrepair($driver_profile_id, $ammount);

    }

    static function ammountPrepairById($driver_profile_id = "71bb388cc57941dca0ad42e2b4029731", $ostatok = 993.25)
    {

        $a = self::getApiDriverById();
        $accounts = $a['driver_profiles'][0];

        if (count($accounts) > 1) {
            foreach ($accounts as $i => $account) {
                if (floatval($account['balance']) > 100) {
                    $ammount = floatval($account['balance']) - $ostatok;
                    $ammounts[] = $ammount;
                }

            }

        } else {
            if (floatval($accounts[0]['balance']) > 100) {
                $ammounts = floatval($accounts[0]['balance']);

            }
        }
        $balance = floatval($a['driver_profiles'][0]['accounts'][0]['balance']) - $ostatok;

        return $balance;
    }

    private static function transferPrepair($apiId, $ostatok)
    {
        //71bb388cc57941dca0ad42e2b4029731
        self::getApiDriverById();

        $queryTransByID = array(
            "amount" => "-" . $ostatok . "",
            "category_id" => "partner_service_manual",
            "currency_code" => "RUB",
            "description" => "Test",
            "driver_profile_id" => "71bb388cc57941dca0ad42e2b4029731",
            "park_id" => "e19d549e69f548c6b4aad5bae570b4ba"
        );

        $queryTransByID = json_encode($queryTransByID);
        /* $queryTransByID = '{
         "amount":"-1",
             "category_id":"partner_service_manual",
             "currency_code":"RUB",
             "description": "Test",
             "driver_profile_id": "71bb388cc57941dca0ad42e2b4029731",
             "park_id": "e19d549e69f548c6b4aad5bae570b4ba"
         }';*/
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
            //{"driver_profile":{"id": "a6c44b91c10d09ca36d490ea66dfaba7"}}
            //},
            CURLOPT_HTTPHEADER => $httpHeader,
        ));

        $output = curl_exec($curl);

        curl_close($curl);

        echo '<pre>';
        print_r(json_decode($output, true));
        echo '</pre>';
        return $arrApiAll = json_decode($output, true);
    }


}