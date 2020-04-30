<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])): ?>
    <h2>По вашему запросу врачи не найдены.</h2>
<? return; endif; ?>

<? if ($arParams['IS_AJAX_REQUEST'] != 'Y'): ?>
    <div class="doctors__wrap">
<? endif; ?>

    <? foreach ($arResult['ITEMS'] as $item): ?>
        <div class="doctor shuffle-name1">
            <div class="doctor__card">
                <a href="<?=$item['DETAIL_PAGE_URL']?>" class="doctor__card-link">
                    <div class="doctor__pic">
                    <? if($item['PREVIEW_PICTURE']): ?>
                        <img class="doctor__img" src="<?=\CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width'=>300, 'height' => 1000)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>" alt="<?=$item['PICTURE_ALT']?>">
                    <? endif; ?>
                    </div>
                    <div class="doctor__descr">
                        <? if(!empty($item['PROPERTIES']['VIDEO']['VALUE'])): ?>
                            <div class="doctor__video"><span class="icon icon--play"></span></div>
                        <? endif; ?>
                        <div class="doctor__post"><?=($item['PROPERTIES']['SPECIALTY_EXTENDED']['VALUE'] ?: $arResult['SPECIALTIES'][reset($item['PROPERTIES']['SPECIALTY']['VALUE'])])?></div>
                        <div class="doctor__name name">
                            <div class="name__surname"><?=$item['SURNAME']?></div>
                            <div class="name__firstname"><?=$item['INITIALS']?></div>
                        </div>
                        <? if($item['EXPERIENCE']): ?>
                            <div class="doctor__exper">Стаж <?=\Bureau\Site\Tools::plural($item['EXPERIENCE'], null, ['год', 'года', 'лет'])?></div>
                        <? endif; ?>
                        <div class="doctor__text"><?=($item['~PREVIEW_TEXT'] ?: $item['PROPERTIES']['ACADEMIC_DEGREE']['VALUE'])?></div>
                    </div>
                </a>
                <?/*<div class="doctor__appoint" onclick="window.location.href='/zapisatsya-na-priem/?doctorID=<?=$item['ID']?>'">Ближайшая запись на прием<br> 27 августа</div>*/?><a class="doctor__link" href="/zapisatsya-na-priem/?doctorID=<?=$item['ID']?>">Записаться на прием</a>
            </div>
        </div>
    <? endforeach; ?>

<? if ($arParams['IS_AJAX_REQUEST'] != 'Y'): ?>
    </div>
<? else: ?>
    #AJAX_DELIMITER#
<? endif; ?>

<? if ($arParams['SHOW_PAGENAV'] == 'Y' && $arResult['NAV_CUSTOM']['CURRENT_PAGE'] < $arResult['NAV_CUSTOM']['PAGES_COUNT']):?>
    <div class="doctors__buttons">
        <a class="button button--empty button--xl js-load-more"
           href="javascript:void(0);"
           data-link="<?= $APPLICATION->GetCurPageParam('page=' . ($arResult['NAV_CUSTOM']['CURRENT_PAGE'] + 1), array('page'), false); ?>"
           data-subject="Doctors"
           data-container-selector=".doctors__wrap"
        >показать ещё</a>
    </div>
<? endif; ?>