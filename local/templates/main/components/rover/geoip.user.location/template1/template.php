<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use \Bitrix\Main\Localization\Loc;


echo $ip = $_SERVER['REMOTE_ADDR'];

//$city = $SxGeo->getCity($ip);

//if ($_REQUEST['T'] == 'Y') {
    echo '<pre>';
    //print_r($arResult);
    //print_r($arParams);
    echo '</pre>';
    //die();

//}
?>

<section>
  <?
  echo 'Сервер' . $_SERVER['REMOTE_ADDR'];
  use Bitrix\Main\Loader,
      \Bitrix\Main\Service\GeoIp\Data,
      Rover\GeoIp\Location;
  //print_r(\Bitrix\Main\Service\GeoIp\MaxMind::getSupportedLanguages()). '<br>' ;

  if (Loader::includeModule('rover.geoip')){
      try{
          $currIP=Location::getCurIp();
          echo 'ваш ip: ' . $currIP . '<br><br>'; // текущий ip

          $location = Location::getInstance($currIP); // yandex.ru

          echo 'ip: '                 . $location->getIp() . '<br>';          // 5.255.255.88
          echo 'город: '              . $location->getCityName() . '<br>';        // Москва
          echo 'iso-код страны: '     . $location->getCountryCode() . '<br>';     // RU
          echo 'название страны: '    . $location->getCountryName() . '<br>'; // Россия
          echo 'id страны в Битриксе: '    . $location->getCountryId() . '<br>'; // 1
          echo 'регион: '             . $location->getRegionName() . '<br>';      // Москва
          echo 'iso-код региона: '    . $location->getRegionCode() . '<br>';      //
          echo 'округ: '              . $location->getDistrict() . '<br>';    // Центральный федеральный округ
          echo 'широта: '             . $location->getLat() . '<br>';         // 55.755787
          echo 'долгота: '            . $location->getLng() . '<br>';         // 37.617634
          echo 'диапазон адресов: '   . $location->getInetnum() . '<br>';     // 5.255.252.0 - 5.255.255.255
          echo 'сервис: '             . $location->getService() . '<br><br>';     // IpGeoBase

          //$location->setLanguage('en');
          //$location->reload(Location::getCurIp()); // google.ru


      } catch (\Exception $e) {
          echo $e->getMessage();
      }
  } else
      echo 'Модуль GeoIp Api не установлен';
  ?>



</section>
</script>