<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
    if(!$arResult['HAS_ANY_ITEM'])
        return;
?>
<div id="media-materials-video" class="media-materials">
    <div class="media-materials__title">Видеоматериалы</div>
    <ul class="media-materials__blocksList">
        <? foreach ($arResult['BIG_ICONS'] as $section): ?>
        <li class="media-materials__container media-materials__tv">
            <div class="media-materials__subTitle"><?=$section['NAME']?></div>
            <div class="media-materials__cards">
                <div class="media-materials__row">
                    <? foreach ($section['ITEMS'] as $video): ?>
                    <a class="article" href="<?=$video['DETAIL_PAGE_URL']?>">
                        <div class="article__img video-btn" style="background-image: url(<?=\CFile::ResizeImageGet($video['PREVIEW_PICTURE'], array('width'=>397, 'height' => 246), BX_RESIZE_IMAGE_EXACT)['src']?>); background-position: 50% 50%; background-repeat: no-repeat;"></div>
                        <div class="article__content">
                            <div class="article__container">
                                <div class="article__container--edit">
                                    <div class="formatedTexts">
                                        <div></div>
                                        <div><?=$video['NAME']?></div>
                                        <div>
                                            <div>
                                                <p><?=$video['PREVIEW_TEXT']?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="article__source">
                                <div class="formatedTexts"><? if(!empty($video['PROPERTIES']['DURATION']['VALUE'])): ?><div><div><?=$video['PROPERTIES']['DURATION']['VALUE']?></div></div><? endif; ?><div><span><?=$video['DATE_ACTIVE_FROM']?></span></div></div>
                            </div>
                        </div>
                    </a>
                    <? endforeach; ?>
                </div>
            </div>
        </li>
        <? endforeach; ?>
        <? foreach ($arResult['SMALL_ICONS'] as $section): ?>
        <li class="media-materials__container media-materials__roll">
            <div class="media-materials__subTitle"><?=$section['NAME']?></div>
            <div class="media-materials__row">
                <? foreach ($section['ITEMS'] as $video): ?>
                <a class="article" href="<?=$video['DETAIL_PAGE_URL']?>">
                    <div class="article__img video-btn" style="background-image: url(<?=\CFile::ResizeImageGet($video['PREVIEW_PICTURE'], array('width'=>230, 'height' => 190), BX_RESIZE_IMAGE_EXACT)['src']?>); background-position: 50% 50%; background-repeat: no-repeat;"></div>
                    <div class="article__content">
                        <div class="article__container">
                            <div class="article__container--edit">
                                <div class="formatedTexts">
                                    <div></div>
                                    <div><?=$video['NAME']?></div>
                                    <div>
                                        <div>
                                            <p><?=$video['PREVIEW_TEXT']?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="article__source">
                            <div class="formatedTexts"><? if(!empty($video['PROPERTIES']['DURATION']['VALUE'])): ?><div><div><?=$video['PROPERTIES']['DURATION']['VALUE']?></div></div><? endif; ?><div><span><?=$video['DATE_ACTIVE_FROM']?></span></div></div>
                        </div>
                    </div>
                </a>
                <? endforeach; ?>
            </div>
        </li>
        <? endforeach; ?>
    </ul>
</div>