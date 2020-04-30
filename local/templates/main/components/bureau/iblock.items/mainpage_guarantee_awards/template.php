<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])) return; ?>

<div class="guarantee__awards js-guarantee__awards awards">
    <h3 class="awards__head blockName">Клиника с международным признанием в центре Москвы</h3>
    <div class="awards__container">
        <? foreach ($arResult['ITEMS'] as $item): ?>
        <div class="awards__item award">
            <div class="award__pic"><img class="award__image" src="" data-lazy-img="<?=CFile::GetPath($item['PROPERTIES']['MAIN_PAGE_ICON']['VALUE'])?>">
            </div>
            <div class="award__content">
                <div class="award__name itemName"><?=$item['PROPERTIES']['MAIN_PAGE_TEXT']['VALUE']?></div>
                <a class="award__link js-siteHeader__reward<?=++$iterator?>-open tooltip-open" href="javascript:void(0)">Подробнее о награде</a>
                <div class="siteHeader__address tooltip js-siteHeader__reward<?=$iterator?> js-tooltip">
                    <div class="tooltip__body">
                        <div class="tooltip__descr">
                            <p><?=$item['PREVIEW_TEXT']?></p>
                            <p class="tooltip__link"><a class="link" href="/o-klinike/nagrady-sertifikaty-litsenzii-svidetelstva/#award-<?=$item['ID']?>">Читать далее</a></p>
                        </div>
                        <div class="tooltip__close js-tooltip-close">
                            <div class="closeBtn"><span></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <? endforeach; ?>
        <div class="awards__item award">
            <div class="award__pic award__pic--flag"><img class="award__image" src="" data-lazy-img="/static/images/flagAward.png"></div>
            <div class="award__content">
                <div class="award__name itemName">Участник программы государственных гарантий бесплатного оказания гражданам медицинской помощи</div><a class="award__link js-siteHeader__reward2-open tooltip-open" href="javascript:void(0);">Подробнее</a>
                <div class="siteHeader__address tooltip js-tooltip js-siteHeader__reward2">
                    <div class="tooltip__body">
                        <div class="tooltip__descr">
                            <p>Участник программы государственных гарантий бесплатного оказания гражданам медицинской помощи</p>
                            <p class="tooltip__link"><noindex><a class="link" href="http://bus.gov.ru/pub/independentRating/list" rel="nofollow">Читать далее</a></noindex></p>
                        </div>
                        <div class="tooltip__close js-tooltip-close">
                            <div class="closeBtn"><span></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="awards__footer"><a class="awards__linkToAll" href="/o-klinike/nagrady-sertifikaty-litsenzii-svidetelstva/">Все награды</a>
    </div>
</div>