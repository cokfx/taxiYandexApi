<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])) return; ?>

<div class="actual__forLabel2 forLabel2">
    <div class="forLabel2__list layout">
        <? foreach ($arResult['ITEMS'] as $item): ?>
        <div class="forLabel2__item"><a class="article" href="<?=$item['DETAIL_PAGE_URL']?>">
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
                            <?foreach ($item['PROPERTIES']['DOCTORS']['VALUE'] as $doctorID): ?>
                                <div><span><?=$arResult['DOCTORS'][$doctorID]?></span></div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div></a>
        </div>
        <? endforeach; ?>
        <div class="forLabel2__button center"><a class="button button--lg" href="/klinicheskie-sluchai/">все клинические случаи</a></div>
    </div>
</div>