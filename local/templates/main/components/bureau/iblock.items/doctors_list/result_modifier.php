<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

use \Bureau\Site\Constant;
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

    $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(
        Constant::DOCTORS_IBLOCK_ID,
        $item['ID']
    );
    $metaTags = $ipropValues->getValues();
    $item['PICTURE_ALT'] = $metaTags['ELEMENT_PREVIEW_PICTURE_FILE_ALT'];
}