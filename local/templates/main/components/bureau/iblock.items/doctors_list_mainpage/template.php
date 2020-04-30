<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])): ?>
<? return; endif; ?>


<div class="doctors layout">
    <div class="doctors__cards<?=$arParams['IS_MOBILE_VERSION'] ? ' swiper-container' : ''?>">
        <? if($arParams['IS_MOBILE_VERSION']): ?>
            <div class="swiper-wrapper">
        <? endif; ?>
        <? foreach ($arResult['ITEMS'] as $item): ?>
            <? if($arParams['IS_MOBILE_VERSION']): ?>
                <div class="swiper-slide">
            <? endif; ?>
        <div class="doctors__card-item doctorCard"><a class="doctorCard-link" href="<?=$item['DETAIL_PAGE_URL']?>">
            <? if($item['PREVIEW_PICTURE']): ?>
                <div class="doctorCard__face"><img data-lazy-img="<?=\CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width'=>300, 'height' => 1000)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>"></div>
            <? endif; ?>
                <div class="doctorCard__textContainer">
                    <? if(!empty($item['PROPERTIES']['VIDEO']['VALUE'])): ?>
                    <div class="doctor__video"><span class="icon icon--play"></span></div>
                    <? endif; ?>
                    <div class="doctorCard__type"><?=$arResult['SPECIALTIES'][reset($item['PROPERTIES']['SPECIALTY']['VALUE'])]?></div>
                    <div class="doctorCard__names">
                        <div class="doctorCard__name1"><?=$item['SURNAME']?></div>
                        <div class="doctorCard__name2"><?=$item['INITIALS']?></div>
                    </div>
                    <? if($item['EXPERIENCE']): ?>
                    <div class="doctorCard__experiens">Стаж <?=\Bureau\Site\Tools::plural($item['EXPERIENCE'], null, ['год', 'года', 'лет'])?></div>
                    <? endif; ?>
                    <div class="doctorCard__descri"><?=$item['~PREVIEW_TEXT']?></div>
                </div>
            </a><a class="doctorCard__order" href="/zapisatsya-na-priem/?doctorID=<?=$item['ID']?>">Записаться на прием</a></div>
            <? if($arParams['IS_MOBILE_VERSION']): ?>
                </div>
            <? endif; ?>
        <? endforeach; ?>
        <? if($arParams['IS_MOBILE_VERSION']): ?>
            </div>
        <? endif; ?>
    </div>
    <? if($arParams['IS_MOBILE_VERSION']): ?>
        <div class="swiper-pagination"></div>
    <? endif; ?>
    <div class="doctors__allDoctors center">
        <a href="/nashi-vrachi/"><div class="doctors__allDoctors-btn button color-lightBlue">Все врачи клиники</div></a>
    </div>
</div>