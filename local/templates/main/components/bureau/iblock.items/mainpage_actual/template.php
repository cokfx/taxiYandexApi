<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS']))
    return;
?>

<div class="forLabel1__carousel swiper-container">
    <div class="swiper-wrapper">
        <? foreach ($arResult['ITEMS'] as $item): ?>
            <?
            $doctor = $arResult['DOCTORS'][$item['PROPERTIES']['LEFT_BLOCK_DOCTOR']['VALUE']];
            ?>
            <div class="swiper-slide">
            <div class="forLabel1__content doctorCarousel layout">
                <div>
                    <div class="doctorCarousel__face">
                    <?
                        if($item['PREVIEW_PICTURE'])
                            $pictureID = $item['PREVIEW_PICTURE'];
                        elseif($doctor['FIELDS']['PREVIEW_PICTURE'])
                            $pictureID = $doctor['FIELDS']['PREVIEW_PICTURE'];
                        else
                            $pictureID = false;
                        if($pictureID):
                    ?>
                        <img data-lazy-img="<?=\CFile::ResizeImageGet($pictureID, array('width'=>350, 'height' => 1000)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>">
                        <? endif; ?>
                    </div>
                    <div class="doctorCarousel__names">
                        <div class="doctorCarousel__name1"><?=$doctor['SURNAME']?></div>
                        <div class="doctorCarousel__name2"><?=$doctor['INITIALS']?></div>
                    </div>
                    <div class="doctorCarousel__aboutType color-grey"><?=$item['PROPERTIES']['DOCTOR_DESCRIPTION']['VALUE'] ?: $doctor['SPECIALTY']?></div>
                </div>
                <div class="doctorCarousel__content">
                    <div class="doctorCarousel__contentHead">
                        <div class="doctorCarousel__type sectionName"><?=$item['~NAME']?></div>
                        <div class="doctorCarousel__arrowSliderNavigation">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                    <p class="doctorCarousel__descri"><?=$item['~PREVIEW_TEXT']?></p>
                    <div class="doctorCarousel__contentFooter">
                        <div class="doctorCarousel__pagination swiper-pagination"></div>
                        <div class="doctorCarousel__order bg-skyBlue color-white button button--lg" onclick="window.location.href='/zapisatsya-na-priem/?doctorID=<?=$item['PROPERTIES']['LEFT_BLOCK_DOCTOR']['VALUE']?>'">
                            Записаться на прием
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <? endforeach; ?>
    </div>
</div>