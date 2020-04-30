<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
    if(!$arResult['HAS_ANY_ITEM'])
        return;
?>
<div id="media-materials-audio" class="media-materials">
    <div class="media-materials__title">Аудиоматериалы</div>
    <ul class="media-materials__blocksList">
        <? foreach ($arResult['SECTIONS'] as $section): ?>
        <li class="media-materials__container media-materials__radio">
            <div class="media-materials__subTitle"><?=$section['NAME']?></div>
            <div class="media-materials__cards">
                <div class="media-materials__row">
                    <? foreach ($section['ITEMS'] as $audio): ?>
                    <div class="article">
                        <div class="article__content">
                            <div class="article__container">
                                <div class="article__container--edit">
                                    <div class="article__audio">
                                        <audio class="article__player" src="<?=\CFile::GetPath($audio['PROPERTIES']['AUDIO_FILE']['VALUE'])?>" preload="auto" controls="" controlsList="nodownload"></audio>
                                    </div>
                                    <div class="formatedTexts">
                                        <div>
                                            <p><?=$audio['NAME']?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="article__source">
                                <div class="formatedTexts">
                                    <div><span><?=$audio['DATE_ACTIVE_FROM']?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <? endforeach; ?>
                </div>
            </div>
        </li>
        <? endforeach; ?>
    </ul>
</div>