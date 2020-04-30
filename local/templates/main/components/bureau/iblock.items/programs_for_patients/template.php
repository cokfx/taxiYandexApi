<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])): ?>
    <h2>По вашему запросу программы не найдены.</h2>
    <? return; endif; ?>

<? if ($arParams['IS_AJAX_REQUEST'] != 'Y'): ?>
<? endif; ?>
    <? foreach ($arResult['ITEMS'] as $key => $item): ?>
    <?
        $buyLink = '/patsientam/programmy-obsluzhivaniya-dlya-patsientov/kupit-programmu/';
        $buyLink .= '?program=' . $item['ID'];
        //$buyLink .= '&price=' . $item['PROPERTIES']['PRICE']['VALUE'];
		
    ?>
    <div class="accordion">
        <input id="checkbox-<?=$key?>" type="checkbox">
        <div class="accordion__container">
            <div class="accordion__imageContainer" style="<? if($item['PREVIEW_PICTURE']): ?>background-image: url(<?=\CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width'=>370, 'height' => 1000)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>); background-repeat: no-repeat;<? endif; ?>"></div>
            <div class="accordion__content">
                <div class="accordion__topBar">
                    <div class="formatedTexts">
                        <h2><?=$item['~NAME']?></h2>
                        <p><?=$item['~PREVIEW_TEXT']?></p>
                    </div>
					<?if(!empty($item['PROPERTIES']['DETAIL_TEXT']['VALUE'])):?>
						<div class="formatedTexts">
							<a href="<?=$item['DETAIL_PAGE_URL']?>">Подробнее о программе</a>
						</div>
					<?endif?>
                </div>
                <div class="accordion__bottomBar">
                    <div class="accordion__bottomBar--empty">
                        <? if($item['DETAIL_TEXT']): ?>
                        <label class="accordion__check" for="checkbox-<?=$key?>"><span></span><span></span></label>
                        <? endif; ?>
                    </div>
					
					<?if(!empty($item['PROPERTIES']['PRICE']['VALUE']) && intval($item['PROPERTIES']['PRICE']['VALUE']) > 0):?>
						<div class="formatedTexts"><div></div><div>Расчетная сумма от <span><?=number_format($item['PROPERTIES']['PRICE']['VALUE'], 0, false, ' ')?> Р</span> <a href="<?=$buyLink?>&yoFrom=0&yoTo=100" data-baselink="<?=$buyLink?>" class="yo-modifiable-link">уточнить</a></div>   </div>
					<?endif?>
                </div>
            </div>
        </div>
        <div class="accordion__drop">
            <div class="accordion__drop--padding blockText">
                <? if($item['DETAIL_TEXT']): ?>
                    <div class="formatedTexts">
                        <div>
                            <?=$item['~DETAIL_TEXT']?>
                        </div>
                    </div>
                <? endif; ?>
                <div class="accordion__sell">
                    <? if(!empty($item['PROPERTIES']['FILES']['VALUE'])): ?>
                    <div class="accordion__sell--container">
                        <? foreach ($item['PROPERTIES']['FILES']['VALUE'] as $key => $fileID): ?>
                            <?
                                $fileArr = \CFile::GetFileArray($fileID);
                                if(!empty($item['PROPERTIES']['FILES']['DESCRIPTION'][$key]))
                                    $fileName = $item['PROPERTIES']['FILES']['DESCRIPTION'][$key];
                                else
                                    $fileName = pathinfo($fileArr['ORIGINAL_NAME'])['filename'];
                            ?>
                        <a class="card__file link link--icon file" href="<?=$fileArr['SRC']?>" target="_blank"><span
                                    class="icon icon--file-pdf file__img"></span><span
                                    class="link__text link__text--icon-pdf file__name"><?=$fileName?></span></a>
                        <? endforeach; ?>
                    </div>
                    <? endif; ?>
                    <div class="accordion__sell--btn">
                        <a class="button yo-modifiable-link" href="<?=$buyLink?>&yoFrom=0&yoTo=100" data-baselink="<?=$buyLink?>">уточнить</a>
                    </div>
                </div>
                <label class="buttonClose" for="checkbox-<?=$key?>"><span>Свернуть</span></label>
            </div>
        </div>
    </div>
<? endforeach; ?>

<? if ($arParams['IS_AJAX_REQUEST'] != 'Y'): ?>
<? endif; ?>