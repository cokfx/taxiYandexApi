<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
    if(!$arResult['HAS_ANY_ITEM'])
        return;
?>
<div id="media-materials-photo" class="media-materials">
    <div class="media-materials__title">Фотоматериалы</div>
    <ul class="media-materials__blocksList">
        <? foreach ($arResult['BIG_ICONS'] as $section): ?>
        <li class="media-materials__container media-materials__building">
            <div class="media-materials__subTitle"><?=$section['NAME']?></div>
            <ul class="media-materials__cards">
                <? foreach ($section['ITEMS'] as $photo): ?>
                <li class="photo-materials">
                    <div class="photo-materials__box">
                        <div class="photo-materials__img"><a class="zoom-picture" href="<?=\CFile::ResizeImageGet($photo['PREVIEW_PICTURE'], array('width'=>1280, 'height' => 720))['src']?>" data-fancybox><img class="zoom-img" src="<?=\CFile::ResizeImageGet($photo['PREVIEW_PICTURE'], array('width'=>293, 'height' => 248), BX_RESIZE_IMAGE_EXACT)['src']?>" alt="Внешний вид больницы"></a>
                        </div>
                        <div class="photo-materials__name"><?=$photo['NAME']?></div>
                    </div>
                    <div class="photo-materials__footer"> <span class="photo-materials__date"><?=$photo['DATE_ACTIVE_FROM']?></span><? if(!empty($photo['PREVIEW_PICTURE']['SRC'])): ?><a class="photo-materials__link" href="<?=$photo['PREVIEW_PICTURE']['SRC']?>" target="_blank"><span class="icon icon--download"></span></a><? endif; ?></div>
                </li>
                <? endforeach; ?>
            </ul>
        </li>
        <? endforeach; ?>
        <? foreach ($arResult['SMALL_ICONS'] as $section): ?>
        <li class="media-materials__container media-materials__management">
            <div class="media-materials__subTitle"><?=$section['NAME']?></div>
            <ul class="media-materials__cards">
                <? foreach ($section['ITEMS'] as $photo): ?>
                <li class="photo-materials">
                    <div class="photo-materials__box">
                        <div class="photo-materials__img"><a class="zoom-picture" href="<?=\CFile::ResizeImageGet($photo['PREVIEW_PICTURE'], array('width'=>1280, 'height' => 720))['src']?>" data-fancybox><img class="zoom-img" src="<?=\CFile::ResizeImageGet($photo['PREVIEW_PICTURE'], array('width'=>190, 'height' => 179), BX_RESIZE_IMAGE_EXACT)['src']?>" alt="<?=$photo['NAME']?>"></a>
                        </div>
                        <div class="photo-materials__name">
                            <? if($photo['SURNAME']): ?>
                            <span><?=$photo['SURNAME']?></span> <?=$photo['INITIALS']?>
                            <? else: ?>
                                <?=$photo['NAME']?>
                            <? endif; ?>
                        </div>
                        <? if(!empty($photo['PROPERTIES']['DESCRIPTION']['VALUE'])): ?>
                        <div class="photo-materials__post"><?=$photo['PROPERTIES']['DESCRIPTION']['VALUE']?></div>
                        <? endif; ?>
                    </div>
                    <div class="photo-materials__footer"> <span class="photo-materials__date"><?=$photo['DATE_ACTIVE_FROM']?></span><? if(!empty($photo['PREVIEW_PICTURE']['SRC'])): ?><a class="photo-materials__link" href="<?=$photo['PREVIEW_PICTURE']['SRC']?>" target="_blank"><span class="icon icon--download"></span></a><? endif; ?></div>
                </li>
                <? endforeach; ?>
            </ul>
        </li>
        <? endforeach; ?>
    </ul>
</div>