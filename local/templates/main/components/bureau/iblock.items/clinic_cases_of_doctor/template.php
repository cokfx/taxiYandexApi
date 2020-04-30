<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<?
if(empty($arResult['ITEMS'])):
    return; endif;
?>

<? if ($arParams['IS_AJAX_REQUEST'] != 'Y'): ?>
<div class="section">
    <div class="layout">
        <div class="doctor-cart__cases">
            <div class="cases">
                <div class="cases__title">Клинические случаи</div>
                <div class="cases__articles">
<? endif; ?>
                <? foreach ($arResult['ITEMS'] as $item): ?>
                    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="article">
                        <div class="article__content">
                            <div class="article__container">
                                <div class="article__container--edit">
                                    <div class="formatedTexts">
                                        <div></div>
                                        <div><?=$item['NAME']?></div>
                                        <? if(!empty($item['~PREVIEW_TEXT'])): ?>
                                        <div>
                                            <div>
                                                <?=$item['~PREVIEW_TEXT_TYPE'] == 'text' ? '<p>' . str_replace("\r\n", "<br />", $item['~PREVIEW_TEXT']) . '</p>' : $item['~PREVIEW_TEXT']?>
                                            </div>
                                        </div>
                                        <? endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="article__source">
                                <div class="formatedTexts"></div>
                            </div>
                        </div>
                    </a>
                <? endforeach; ?>

<? if ($arParams['IS_AJAX_REQUEST'] != 'Y'): ?>
                </div>
                <div class="cases__footer">
                    <div class="cases__item"><a href="/klinicheskie-sluchai/">все клинические случаи</a></div>
<? else: ?>
    #AJAX_DELIMITER#
<? endif; ?>
<? if ($arParams['SHOW_PAGENAV'] == 'Y' && $arResult['NAV_CUSTOM']['CURRENT_PAGE'] < $arResult['NAV_CUSTOM']['PAGES_COUNT']):?>
    <div class="cases__item">
        <a href="javascript:void(0);" class="js-load-more"
           data-link="<?= $APPLICATION->GetCurPageParam('page=' . ($arResult['NAV_CUSTOM']['CURRENT_PAGE'] + 1), array('page'), false); ?>"
           data-subject="DoctorClinicCases"
           data-container-selector=".cases__articles">Показать ещё</a>
    </div>
<? endif; ?>
<? if ($arParams['IS_AJAX_REQUEST'] != 'Y'): ?>
                </div>
                <div class="cases__btns">
                    <button class="button button--lg" onclick="window.location.href='/nashi-vrachi/'">другие врачи клиники</button>
                </div>
            </div>
        </div>
    </div>
</div>
<? endif; ?>