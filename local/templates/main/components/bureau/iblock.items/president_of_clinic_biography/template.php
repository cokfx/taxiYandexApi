<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])) return; ?>

<div class="accordion__timeline">
    <div class="formatedTexts">
        <ul>
            <? foreach ($arResult['ITEMS'] as $item): ?>
            <li><span class="accordion__timeline-date"><?=$item['NAME']?></span>
                <?=$item['~PREVIEW_TEXT_TYPE'] == 'text' ? '<p>' . str_replace("\r\n", "<br />", $item['~PREVIEW_TEXT']) . '</p>' : $item['~PREVIEW_TEXT']?>
            </li>
            <? endforeach; ?>
        </ul>
    </div>
</div>