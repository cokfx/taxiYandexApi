<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])): ?>
    <h2>По вашему запросу клинические случаи не найдены.</h2>
    <? return; endif; ?>

<? if ($arParams['IS_AJAX_REQUEST'] != 'Y'): ?>
    <div class="clinic__cards">
        <ul class="clinic__list">
<? endif; ?>

    <? foreach ($arResult['ITEMS'] as $item): ?>
        <a href="<?=$item['DETAIL_PAGE_URL']?>" class="article">
            <div class="article__content">
                <div class="article__container">
                    <div class="article__container--edit">
                        <div class="formatedTexts">
                            <div><?= mb_strtolower(FormatDateFromDB($item['ACTIVE_FROM'], 'j F Y')) ?></div>
                            <div><?=$item['NAME']?></div>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="article__source">
                    <div class="formatedTexts">
                        <? if($item['PROPERTIES']['ONLY_FOR_SPECIALISTS']['VALUE']): ?>
                            <div><div>Только для специалистов</div></div>
                        <? elseif(!empty($item['PROPERTIES']['DOCTORS']['VALUE'])): ?>
                            <?foreach ($item['PROPERTIES']['DOCTORS']['VALUE'] as $doctorID): ?>
                                <div><span><?=$arResult['DOCTORS'][$doctorID]?></span></div>
                            <? endforeach; ?>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </a>
    <? endforeach; ?>

<? if ($arParams['IS_AJAX_REQUEST'] != 'Y'): ?>
        </ul>
    </div>
<? else: ?>
    #AJAX_DELIMITER#
<? endif; ?>

<? if ($arParams['SHOW_PAGENAV'] == 'Y' && $arResult['NAV_CUSTOM']['CURRENT_PAGE'] < $arResult['NAV_CUSTOM']['PAGES_COUNT']):?>
    <div class="clinic__button">
        <button class="button button--lg js-load-more"
                data-link="<?= $APPLICATION->GetCurPageParam('page=' . ($arResult['NAV_CUSTOM']['CURRENT_PAGE'] + 1), array('page'), false); ?>"
                data-subject="ClinicCases"
                data-container-selector=".clinic__list">показать ещё</button>
    </div>
<? endif; ?>