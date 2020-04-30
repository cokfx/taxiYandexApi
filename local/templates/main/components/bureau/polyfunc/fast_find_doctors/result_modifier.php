<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

use \Bureau\Site\Constant;

$doctorsIbEntityHeir = \Bureau\Site\Entities\IBlockEntity::GetInstanceOfHeirByIblockID(Constant::DOCTORS_IBLOCK_ID);
$ibDoctors = $doctorsIbEntityHeir->InstancesArrayByFilter($arParams['ADDITIONAL_FILTER'] ?: [], false, ['NAME' => 'ASC']);
foreach ($ibDoctors as $ibDoctor) {
    $arResult['DOCTORS'][] = [
        'ID' => $ibDoctor->GetField('ID'),
        'NAME' => $ibDoctor->GetField('NAME'),
    ];
}