<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])): ?>
    <h2>По вашему запросу новости не найдены.</h2>
<? return; endif; ?>

<? if ($arParams['IS_AJAX_REQUEST'] != 'Y'): ?>
    <?$APPLICATION->IncludeComponent("bureau:polyfunc", "timeline", Array(
        "IBLOCK_ID" => $arResult['IBLOCK']['ID'],	// Инфоблок
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_TAG" => "iblock_id_" . $arResult['IBLOCK']['ID']
    ),
        false
    );?>
    <div class="cards-news__list">
<? endif; ?>

    <ul class="cards-news__row cards-news__row--withIcon">
        <? foreach ($arResult['ITEMS'] as $item): ?>
            <a href="<?=$item['DETAIL_PAGE_URL']?>" class="article">
                <? if($item['PREVIEW_PICTURE']): ?>
                    <div class="article__img" style="background-image: url(<?=\CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width'=>1024, 'height' => 768), BX_RESIZE_IMAGE_EXACT)['src']?>); background-position: 50% 50%; background-repeat: no-repeat;"></div>
                <? endif; ?>
                <div class="article__content">
                    <div class="article__container">
                        <div class="article__container--edit">
                            <div class="formatedTexts">
                                <div><?= mb_strtolower(FormatDateFromDB($item['ACTIVE_FROM'], 'j F Y')) ?></div>
                                <div><?=$item['NAME']?></div>
                                <div>
                                    <div>
                                        <?=$item['~PREVIEW_TEXT_TYPE'] == 'text' ? '<p>' . str_replace("\r\n", "<br />", $item['~PREVIEW_TEXT']) . '</p>' : $item['~PREVIEW_TEXT']?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="article__source">
                        <div class="formatedTexts"></div>
                    </div>
                </div>
            </a>
            <? if(++$iterator % 2 == 0) echo '</ul><ul class="cards-news__row cards-news__row--withIcon">'; ?>
        <? endforeach; ?>
    </ul>

<? if ($arParams['IS_AJAX_REQUEST'] != 'Y'): ?>
    </div>
<? else: ?>
    #AJAX_DELIMITER#
<? endif; ?>

<? if ($arParams['SHOW_PAGENAV'] == 'Y' && $arResult['NAV_CUSTOM']['CURRENT_PAGE'] < $arResult['NAV_CUSTOM']['PAGES_COUNT']):?>
    <div class="layout news-load-more">
        <div class="news__btns js-load-more"
             data-link="<?= $APPLICATION->GetCurPageParam('page=' . ($arResult['NAV_CUSTOM']['CURRENT_PAGE'] + 1), array('page'), false); ?>"
             data-subject="News"
             data-container-selector=".cards-news__list">
            <button class="news__btn button"><?=$arParams['LOAD_MORE_TEXT'] ?: 'еще новости'?></button>
        </div>
    </div>
<? endif; ?>
