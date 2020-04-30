<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

use \Bureau\Site\Tools;

if(empty($arResult['ITEMS']))
    return;

$specialtiesHLBL = Tools::compileEntityByName('MedicalSpecialties')->getDataClass();
$specialtiesRes = $specialtiesHLBL::getList([
    'select' => ['UF_XML_ID', 'UF_NAME']
]);
while($specialty = $specialtiesRes->fetch()) {
    $arResult['SPECIALTIES'][$specialty['UF_XML_ID']] = $specialty['UF_NAME'];
}

foreach ($arResult['ITEMS'] as &$item) {
    $nameArr = explode(' ', $item['NAME'], 2);
    $item['SURNAME'] = $nameArr[0];
    $item['INITIALS'] = $nameArr[1];
    if($item['PROPERTIES']['MEDICAL_PRACTICE_BEGIN_YEAR']['VALUE'] > 1930 && $item['PROPERTIES']['MEDICAL_PRACTICE_BEGIN_YEAR']['VALUE'] < date('Y'))
        $item['EXPERIENCE'] = date('Y') - $item['PROPERTIES']['MEDICAL_PRACTICE_BEGIN_YEAR']['VALUE'];
}