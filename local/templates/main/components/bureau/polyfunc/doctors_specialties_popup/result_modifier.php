<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

use \Bureau\Site\Tools;

$specialtiesHLBL = Tools::compileEntityByName('MedicalSpecialties')->getDataClass();
$specialtiesRes = $specialtiesHLBL::getList([
    'select' => ['UF_XML_ID', 'UF_NAME'],
    'filter' => ['!UF_SHOW_IN_PUBLIC_FL' => false],
    'order' => ['UF_NAME']
]);
while($specialty = $specialtiesRes->fetch()) {
    $arResult['SPECIALTIES'][mb_substr($specialty['UF_NAME'], 0, 1)][] = [
        'NAME' => $specialty['UF_NAME'],
        'CODE' => $specialty['UF_XML_ID'],
    ];
}