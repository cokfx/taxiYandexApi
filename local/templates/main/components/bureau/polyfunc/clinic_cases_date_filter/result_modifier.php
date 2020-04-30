<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$ibHelper = \Bureau\Site\Entities\IBlockEntity::GetInstanceOfHeirByIblockID($arParams['IBLOCK_ID']);
$ibEntFirstItem = reset($ibHelper->InstancesArrayByFilter(['ACTIVE' => 'Y'], false, ['ACTIVE_FROM' => 'ASC'], 1));
$firstDate = $ibEntFirstItem->GetField('ACTIVE_FROM');
$firstYear = FormatDateFromDB($firstDate, 'Y');
$currentYear = date('Y');
for ($year = $currentYear; $year >= $firstYear; $year--) {
    $arResult['YEARS'][] = $year;
}