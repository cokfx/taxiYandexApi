<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?php



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

    static function getBaseDriverById($idElem)
    {
        if (\Bitrix\Main\Loader::includeModule('iblock')) {

            $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
            $arFilter = Array("IBLOCK_ID" => 26, "ID" => $idElem);
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
            $arrBaseAllKeys[$profile['PROPERTY_103']] = $profile['PROPERTY_103'];
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
                    $iblockId = 26;
                    $PROP = array();
                    $PROP[103] = $item['driver_profile']['id'];
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
        \Cab\Tools\CBTools::pretty_print(self::getApiAllDrivers());

    }

    static function getArrayApiDriverById()
    {
        \Cab\Tools\CBTools::pretty_print(self::getApiDriverById());

    }

    private static function getApiDriverById()
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
            CURLOPT_POSTFIELDS => self::$queryDriverByIDMin,
            CURLOPT_HTTPHEADER => self::$httpHeader,
        ));

        $output = curl_exec($curl);

        curl_close($curl);

        return $arrApiAll = json_decode($output, true);
    }

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
}