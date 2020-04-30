<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])) return; ?>

<div class="section bg-light-blue">
    <div class="layout">
        <div class="doctor-cart__videos">
            <? foreach ($arResult['ITEMS'] as $item): ?>
            <a class="article" href="<?=$item['DETAIL_PAGE_URL']?>">
                <div class="article__img video-btn" style="background-image: url(<?=CFile::GetPath($item['~PREVIEW_PICTURE'])?>); background-position: 50% 50%; background-repeat: no-repeat;"></div>
                <div class="article__content">
                    <div class="article__container">
                        <div class="article__container--edit">
                            <div class="formatedTexts">
                                <div></div>
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
                        <div class="formatedTexts"><div><div><?=$item['PROPERTIES']['DURATION']['VALUE']?></div></div><div><span><?=$item['ACTIVE_FROM']?></span></div></div>
                    </div>
                </div>
            </a>
            <? endforeach; ?>
        </div>
    </div>
</div>