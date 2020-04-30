<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])) return; ?>

<div class="section">
    <div class="layout">
        <div class="clinic-detail__audio">
            <? foreach ($arResult['ITEMS'] as $audio): ?>
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
</div>
