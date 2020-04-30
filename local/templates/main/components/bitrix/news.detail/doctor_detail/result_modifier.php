<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

use \Bureau\Site\Constant;
use \Bureau\Site\Entities\IBlockEntity;

if(empty($arResult['PREVIEW_PICTURE'])) {
    $doctorDetail = IBlockEntity::GetInstanceOfHeirByIblockID(
        Constant::DOCTORS_IBLOCK_ID
    )->GetInstanceByBitrixID($arResult['ID']);
    $arResult['PREVIEW_PICTURE'] = $doctorDetail->GetField('PREVIEW_PICTURE');
}

if($arResult['PROPERTIES']['MEDICAL_PRACTICE_BEGIN_YEAR']['VALUE'] > 1930 && $arResult['PROPERTIES']['MEDICAL_PRACTICE_BEGIN_YEAR']['VALUE'] < date('Y'))
    $arResult['EXPERIENCE'] = date('Y') - $arResult['PROPERTIES']['MEDICAL_PRACTICE_BEGIN_YEAR']['VALUE'];

if(empty($arResult['PROPERTIES']['SPECIALTY_EXTENDED']['VALUE'])) {
    $specialtiesHLBL = \Bureau\Site\Tools::compileEntityByName('MedicalSpecialties')->getDataClass();
    $specialtiesRes = $specialtiesHLBL::getList([
        'select' => ['ID', 'UF_XML_ID', 'UF_NAME'],
        'filter' => ['UF_XML_ID' => $arResult['PROPERTIES']['SPECIALTY']['VALUE']]
    ]);
    while ($hlblSpecialty = $specialtiesRes->fetch()) {
        $specialiesNames[] = $hlblSpecialty['UF_NAME'];
    }
    $arResult['SPECIALTIES_FORMATTED'] = implode(', ', $specialiesNames);
}

$this->__component->SetResultCacheKeys(array("PROPERTIES"));