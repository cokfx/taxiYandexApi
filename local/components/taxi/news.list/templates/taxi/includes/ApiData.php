<?php


namespace Data;


class ApiData
{
    public static function getAllDrivers($apiUrl, $CLIENT_ID, $API_KEY)//,$CLIENT_ID,$API_KEY
    {
        $queryDriverAllMin = '{"fields":{"car":[],"park":[],"driver_profile":["first_name","last_name","middle_name","phones","id"],"account":["id","balance","balance_limit","currency"]},"query":{"park":{"id":"e19d549e69f548c6b4aad5bae570b4ba"}}}';

        $HttpHeader = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "X-Client-ID: $CLIENT_ID",//taxi/park/e19d549e69f548c6b4aad5bae570b4ba
            "X-API-Key:$API_KEY",
            //'Park ID: e19d549e69f548c6b4aad5bae570b4ba',
            "X-Accept-Language:en"
        );

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

    // водитель по его ID из апи яндекс
    public static function getApiDriverById($HttpHeader,$apiUrl, $parkID, $driver_profile_id)
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

}