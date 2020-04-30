<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$httpHeader = array(
    "Accept: application/json",
    "Content-Type: application/json",
    "X-Client-ID:taxi/park/e19d549e69f548c6b4aad5bae570b4ba",
    "X-API-Key:WDk/JSTplDJldWoDRpkmBPYUflHoczTiT",
    //'Park ID: e19d549e69f548c6b4aad5bae570b4ba',
    "X-Accept-Language:en"
);
$queryDriverAll='{
"fields": {
    "car": [],
    "park": [],
    "driver_profile": [
        "first_name",
        "last_name",
        "middle_name",
        "phones",
        "id"
    ],
    "account": [
        "id",
        "balance",
        "balance_limit",
        "currency"
    ]
},
"query": 
        {"park":
            
            {"id": "e19d549e69f548c6b4aad5bae570b4ba"}
        }
     }';

$queryDriverByID='{
"fields": {
"driver_profile": []
},
"query": 
        {"park":
            
            {"id": "e19d549e69f548c6b4aad5bae570b4ba","driver_profile":{"id": ["71bb388cc57941dca0ad42e2b4029731"]}}
        }
     }';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://fleet-api.taxi.yandex.net/v1/parks/driver-profiles/list",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $queryDriverAll,
    //{"driver_profile":{"id": "a6c44b91c10d09ca36d490ea66dfaba7"}}
    //},
    CURLOPT_HTTPHEADER => $httpHeader,
));

$output = curl_exec($curl);

curl_close($curl);

$arrApiAll = json_decode($output, true);
