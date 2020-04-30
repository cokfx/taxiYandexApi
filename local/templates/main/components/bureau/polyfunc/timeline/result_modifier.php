<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$ibHelper = \Bureau\Site\Entities\IBlockEntity::GetInstanceOfHeirByIblockID($arParams['IBLOCK_ID']);
$ibEntFirstItem = reset($ibHelper->InstancesArrayByFilter(['ACTIVE' => 'Y'], false, ['ACTIVE_FROM' => 'ASC'], 1));
$firstDate = $ibEntFirstItem->GetField('ACTIVE_FROM');
$firstYear = FormatDateFromDB($firstDate, 'Y');
$firstMonth = FormatDateFromDB($firstDate, 'n');
$currentYear = date('Y');
for ($year = $currentYear; $year >= $firstYear; $year--) {
    if($year == $currentYear)
        $endMonth = date('n');
    else
        $endMonth = 12; // december
    if($year == $firstYear)
        $startMonth = $firstMonth;
    else
        $startMonth = 1; // january
    for ($month = $startMonth; $month <= $endMonth; $month++) {
        $arResult[$year][] = $month;
    }

}