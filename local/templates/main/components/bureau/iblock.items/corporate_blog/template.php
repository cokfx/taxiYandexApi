<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])) return; ?>

<div class="blog__cards">
    <div class="blog__name">Последнее в блоге</div>
    <ul class="blog__list">
        <? foreach ($arResult['ITEMS'] as $key => $item): ?>
        <a class="article" href="<?=$item['DETAIL_PAGE_URL']?>">
            <div class="article__img" style="background-image: url(<?=\CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width'=>800, 'height' => 800)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>); background-position: 50% 50%; background-repeat: no-repeat;"></div>
            <div class="article__content">
                <div class="article__container">
                    <div class="article__container--edit">
                        <div class="formatedTexts">
                            <div><?= mb_strtolower(FormatDateFromDB($item['ACTIVE_FROM'], 'j F Y')) ?></div>
                            <div><?=$item['NAME']?></div>
                            <div><div><?=$item['~PREVIEW_TEXT_TYPE'] == 'text' ? '<p>' . str_replace("\r\n", "<br />", $item['~PREVIEW_TEXT']) . '</p>' : $item['~PREVIEW_TEXT']?></div></div>
                        </div>
                    </div>
                </div>
                <div class="article__source">
                    <div class="formatedTexts"></div>
                </div>
            </div>
        </a>
        <? endforeach; ?>
    </ul>
</div>