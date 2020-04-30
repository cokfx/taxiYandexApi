<?php

use \Bureau\Site\Tools;
use \Bureau\Site\Constant;
use \Bureau\Site\Entities\IBlockEntity;

foreach ($arResult['ITEMS'] as $item) {
    if(!empty($item['PROPERTIES']['LEFT_BLOCK_DOCTOR']['VALUE'])) {
        $doctorsIDs[] = $item['PROPERTIES']['LEFT_BLOCK_DOCTOR']['VALUE'];
    }
}

if(empty($doctorsIDs))
    return;

$specialtiesHLBL = Tools::compileEntityByName('MedicalSpecialties')->getDataClass();
$specialtiesRes = $specialtiesHLBL::getList([
    'select' => ['UF_XML_ID', 'UF_NAME']
]);
while($specialty = $specialtiesRes->fetch()) {
    $specialties[$specialty['UF_XML_ID']] = $specialty['UF_NAME'];
}

$ibEntityDoctorsHeir = IBlockEntity::GetInstanceOfHeirByIblockID(
    Constant::DOCTORS_IBLOCK_ID
);
$doctorsArr = $ibEntityDoctorsHeir->InstancesArrayByFilter(['IBLOCK_ID' => Constant::DOCTORS_IBLOCK_ID, 'ID' => $doctorsIDs]);

foreach ($doctorsArr as $ibEntityDoctor) {
    $iterator = 0;
    $specialtiesText = '';
    foreach ($ibEntityDoctor->GetProperty('SPECIALTY') as $specialtyCode) {
        if(++$iterator > 1)
            $specialtiesText .= ', ';
        $specialtiesText .= mb_strtolower($specialties[$specialtyCode]);
    }
    $doctor = $ibEntityDoctor->GetData();
    $doctor['SPECIALTY'] = $specialtiesText;
    $nameArr = explode(' ', $ibEntityDoctor->GetField('NAME'), 2);
    $doctor['SURNAME'] = $nameArr[0];
    $doctor['INITIALS'] = $nameArr[1];
    $arResult['DOCTORS'][$ibEntityDoctor->ibElementID] = $doctor;
}