<?
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

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
echo (__DIR__ );
?>
<?
//require_once (__DIR__ . '/ipgeobase/ipgeobase.php');

$gb = new IPGeoBase();
//$data = $gb->getRecord($_SERVER['REMOTE_ADDR']);


