<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS']))
    return;
?>


<div class="print-materials__content">
    <ul class="media-materials__cards">
        <? foreach ($arResult['ITEMS'] as $item): ?>
            <li class="photo-materials">
            <div class="photo-materials__box">
                <div class="photo-materials__img"><a class="zoom-picture" href="<?=\CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width'=>1280, 'height' => 720))['src']?>" data-fancybox><img class="zoom-img" src="<?=\CFile::ResizeImageGet($item['PREVIEW_PICTURE'], array('width'=>199, 'height' => 169), BX_RESIZE_IMAGE_EXACT)['src']?>" alt="<?=$item['NAME']?>"></a>
                </div>
                <div class="photo-materials__name"><?=$item['NAME']?></div>
            </div>
            <div class="photo-materials__footer">
                <?
                if(!empty($item['PROPERTIES']['FILE']['VALUE'])):
                    $fileArr = \CFile::GetFileArray($item['PROPERTIES']['FILE']['VALUE']);
                    $fileName = mb_pathinfo($fileArr['ORIGINAL_NAME'], PATHINFO_FILENAME);
                    $extension = pathinfo($fileArr['ORIGINAL_NAME'], PATHINFO_EXTENSION);
                ?>
                    <span class="photo-materials__date">Формат .<?=$extension?>, <?=\Bureau\Site\Tools::bytesToSize($fileArr['FILE_SIZE'])?></span><a class="photo-materials__link" href="<?=$fileArr['SRC']?>"><span class="icon icon--download"></span></a>
                <? endif; ?>
            </div>
        </li>
        <? endforeach; ?>
    </ul>
</div>