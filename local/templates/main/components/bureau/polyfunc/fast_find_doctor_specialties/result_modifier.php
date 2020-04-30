<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

use \Bureau\Site\Tools;

$specialtiesHLBL = Tools::compileEntityByName('MedicalSpecialties')->getDataClass();
$specialtiesRes = $specialtiesHLBL::getList([
    'select' => ['UF_XML_ID', 'UF_NAME', 'UF_MIS_ID'],
    'filter' => array_merge(['!UF_SHOW_IN_PUBLIC_FL' => false], $arParams['ADDITIONAL_FILTER'] ?: []),
    'order' => ['UF_NAME']
]);
while($specialty = $specialtiesRes->fetch()) {
    $arResult['SPECIALTIES'][] = [
        'NAME' => $specialty['UF_NAME'],
        'CODE' => $specialty['UF_XML_ID'],
        //'MIS_ID' => $specialty['UF_MIS_ID']
    ];
}