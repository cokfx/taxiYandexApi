<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])) return; ?>

<div class="usefull__accordions">
    <? foreach ($arResult['ITEMS'] as $idx => $item): ?>
    <div class="accordion">
        <input id="checkbox-<?=$idx?>" type="checkbox">
        <div class="accordion__container">
            <div class="accordion__content">
                <div class="accordion__topBar">
                    <div class="formatedTexts">
                        <h2><?=$item['NAME']?></h2>
                    </div>
                </div>
                <div class="accordion__bottomBar">
                    <div class="accordion__bottomBar--empty">
                        <label class="accordion__check" for="checkbox-<?=$idx?>"><span></span><span></span></label>
                    </div>
                    <div class="formatedTexts">   </div>
                </div>
            </div>
        </div>
        <div class="accordion__drop">
            <div class="accordion__drop--padding blockText">
                <div class="accordion__about"<? if(empty($item['PROPERTIES']['FILES']['VALUE'])): ?> style="border: none"<? endif; ?>>
                    <div class="formatedTexts">
                        <?=$item['~PREVIEW_TEXT_TYPE'] == 'text' ? '<p>' . str_replace("\r\n", "<br />", $item['~PREVIEW_TEXT']) . '</p>' : $item['~PREVIEW_TEXT']?>
                    </div>
                </div>
                <? if(!empty($item['PROPERTIES']['FILES']['VALUE'])): ?>
                <div class="accordion__files">
                    <? foreach ($item['PROPERTIES']['FILES']['VALUE'] as $key => $fileID): ?>
                    <div class="accordion__files--item"><a class="card__file link link--icon file" href="<?=CFile::GetPath($fileID)?>"><span class="icon icon--file-pdf file__img"></span><span class="link__text link__text--icon-pdf file__name"><?=$item['PROPERTIES']['FILES']['~DESCRIPTION'][$key]?></span></a>
                    </div>
                    <? endforeach; ?>
                </div>
                <? endif; ?>
            </div>
        </div>
    </div>
    <? endforeach; ?>
</div>