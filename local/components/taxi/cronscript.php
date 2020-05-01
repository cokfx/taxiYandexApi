<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?
require_once __DIR__.'/news.list/templates/taxi/Driver.php';
$driverId="71bb388cc57941dca0ad42e2b4029731";//Прохоренко Андрей
Driver::addTrasferById($driverId,990.25);

?>
