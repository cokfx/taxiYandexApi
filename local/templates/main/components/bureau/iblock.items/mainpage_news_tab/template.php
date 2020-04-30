<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])) return; ?>

<div class="actual__forLabel3 forLabel3">
    <div class="forLabel3__list layout">
        <div class="forLabel3__row">
            <? foreach ($arResult['ITEMS'] as $item): ?>
            <a class="article" href="<?=$item['DETAIL_PAGE_URL']?>">
                <div class="article__img" style="background-image: url(<?=\CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width'=>1024, 'height' => 768), BX_RESIZE_IMAGE_EXACT)['src']?>); background-position: 50% 50%; background-repeat: no-repeat;"></div>
                <div class="article__content">
                    <div class="article__container">
                        <div class="article__container--edit">
                            <div class="formatedTexts">
                                <div><?= mb_strtolower(FormatDateFromDB($item['ACTIVE_FROM'], 'j F Y')) ?></div>
                                <div><?=$item['NAME']?></div>
                                <div>
                                    <div>
                                        <p><?=$item['PREVIEW_TEXT']?></p>
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
            <? endforeach; ?>
        </div>
        <div class="forLabel3__button center"><a class="button button--lg" href="/press-tsentr/novosti-i-sobytiya/">все новости и события</a></div>
    </div>
</div>