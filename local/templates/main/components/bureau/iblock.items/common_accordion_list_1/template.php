<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])) return; ?>

<div class="<?=$arParams['CONTAINER_CLASS']?>">
    <? foreach ($arResult['ITEMS'] as $key => $item): ?>
        <<?
            if(!empty($item['PROPERTIES']['HAS_MENU_ITEM_AND_DETAIL_PAGE']['~VALUE']))
                echo 'a href="' . $item['DETAIL_PAGE_URL'] . '""';
            else
                echo 'div'
        ?> class="accordion<?
            foreach($item['PROPERTIES'] as $prop) {
                // if list
                if($prop['PROPERTY_TYPE'] == 'L') {
                    if($prop['MULTIPLE'] == 'Y') {
                        foreach ($prop['VALUE_ENUM_ID'] as $enumVal) {
                            echo ' js-bx-enum-val-' . $enumVal;
                        }
                    } else {
                        echo ' js-bx-enum-val-' . $prop['VALUE_ENUM_ID'];
                    }
                    break;
                }
            }
        ?>">
            <input id="checkbox-<?=$key?>" type="checkbox" >
            <div id="award-<?=$item['ID']?>" class="accordion__container">
                <div class="accordion__imageContainer" style="background-image: url(<?=\CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width'=>800, 'height' => 800)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>); background-repeat: no-repeat;"></div>
                <div class="accordion__content">
                    <div class="accordion__topBar">
                        <div class="formatedTexts">
                            <h2><?=$item['NAME']?></h2>
                            <? if(!empty($item['PROPERTIES']['GRAY_TEXT']['~VALUE'])): ?>
                                <p>
                                    <?=$item['PROPERTIES']['GRAY_TEXT']['~VALUE']?>
                                </p>
                            <? endif; ?>
                            <?=$item['~PREVIEW_TEXT_TYPE'] == 'text' ? '<p>' . str_replace("\r\n", "<br />", $item['~PREVIEW_TEXT']) . '</p>' : $item['~PREVIEW_TEXT']?>
                        </div>
                    </div>
                    <div class="accordion__bottomBar">
                        <div class="accordion__bottomBar--empty">
                        <? if(!empty($item['~DETAIL_TEXT']) &&
                            empty($item['PROPERTIES']['HAS_MENU_ITEM_AND_DETAIL_PAGE']['~VALUE'])
                        ): ?>
                            <label class="accordion__check" for="checkbox-<?=$key?>"><span></span><span></span></label>
                        <? endif; ?>
                        </div>
                        <div class="formatedTexts">
                            <? if(!empty($item['PROPERTIES']['BLUE_TEXT']['~VALUE'])): ?>
                            <div class="formatedTexts">
                                <?=$item['PROPERTIES']['BLUE_TEXT']['~VALUE']?>
                            </div>
                            <? endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion__drop">
                <? if(empty($item['PROPERTIES']['HAS_MENU_ITEM_AND_DETAIL_PAGE']['~VALUE'])): ?>
                <div class="accordion__drop--padding blockText">
                    <div class="formatedTexts">
                        <?=$item['~DETAIL_TEXT_TYPE'] == 'text' ? '<p>' . str_replace("\r\n", "<br />", $item['~DETAIL_TEXT']) . '</p>' : $item['~DETAIL_TEXT']?>
                    </div>
                </div>
                <? endif; ?>
            </div>
        </<?
            if(!empty($item['PROPERTIES']['HAS_MENU_ITEM_AND_DETAIL_PAGE']['~VALUE']))
                echo 'a';
            else
                echo 'div'
            ?>>
    <? endforeach; ?>
</div>