<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$headerPhone = \Bureau\Site\Tools::getModuleOptions()['header_phone'] ?: "74959950033";
$emergencyPhone = \Bureau\Site\Tools::getModuleOptions()['emergency_phone'] ?: "74952290003";
$headerPhone = \Bureau\Site\Tools::ReformatPhone($headerPhone);
$emergencyPhone = \Bureau\Site\Tools::ReformatPhone($emergencyPhone);
?>

<div class="siteTitle js-submenu-container<?=$arParams['IS_MOBILE_VERSION'] ? '' : ' js-siteTitle js-submenu-title'?>">
    <div class="siteTitle__BG">
        <div class="siteTitle__BG--bg"></div>
    </div>
    <div class="siteHeader__container">
        <? $APPLICATION->IncludeFile('include/live_search.php'); ?>
        <header class="header js-headBG">
            <div class="layout layout--header header__inner">
                <? if($arParams['IS_MOBILE_VERSION']): ?>
                <div class="siteHeader">
                    <div class="siteHeader__burger js-showMenuTrigger"><span class="siteHeader__burder-item"></span><span class="siteHeader__burder-item"></span><span class="siteHeader__burder-item"></span></div><img class="siteHeader__logo" src="/static/images/logo.svg"><noindex><a class="siteHeader__signUp" href="https://my.medicina.ru/auth/" target="_blank" rel="nofollow"></a></noindex>
                </div>
                <? else: ?>
                <div class="siteHeader js-siteHeader">
                    <div class="siteHeader__burger js-showMenuTrigger"><span
                                class="siteHeader__burder-item"></span><span
                                class="siteHeader__burder-item"></span><span class="siteHeader__burder-item"></span>
                    </div>
                    <div class="siteHeader__phones">
                        <div class="siteHeader__phones-item phone js-phone">
                            <div class="phone__time">Круглосуточно</div>
                            <a class="phone__number" href="tel:<?=preg_replace('/[^0-9]/', '', $headerPhone)?>"><span><?=str_replace(')', ')</span><span class="phone__number--big">', $headerPhone)?></span></a>
                            <div class="phone__description">We speak English</div>
                        </div>
                        <div class="siteHeader__phones-item phone js-phone">
                            <div class="phone__time">Круглосуточно</div>
                            <a class="phone__number" href="tel:<?=preg_replace('/[^0-9]/', '', $emergencyPhone)?>"><span><?=str_replace(')', ')</span><span class="phone__number--big">', $emergencyPhone)?></span></a>
                            <div class="phone__description">Скорая помощь</div>
                        </div>
                    </div>
                    <img class="siteHeader__logo js-siteHeader__logo" src="/static/images/logo.svg">
                    <div class="siteHeader__buttons">
                        <div class="siteHeader__buttons-box">
                            <div class="siteHeader__buttons-item tooltip-open js-siteHeader__address-open">Адрес</div>
                            <div class="siteHeader__address tooltip js-tooltip js-siteHeader__address">
                                <div class="tooltip__body">
                                    <div class="tooltip__descr">
                                        <p>г. Москва, 2-й Тверской-Ямской переулок, дом 10, Метро «Маяковская» <span>(5 мин. пешком)</span></p>
                                        <p><a class="link" href="/kontakty/">Контакты</a><a class="link" href="/kontakty/#map">Схема проезда</a></p>
                                    </div>
                                    <div class="tooltip__close js-tooltip-close">
                                        <div class="closeBtn"><span></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="siteHeader__buttons-box">
                            <div class="siteHeader__buttons-item tooltip-open js-siteHeader__workTime-open">Режим работы</div>
                            <div class="siteHeader__workTime tooltip js-tooltip js-siteHeader__workTime">
                                <div class="tooltip__body">
                                    <div class="tooltip__title">График работы клиники «Медицина»</div>
                                    <div class="tooltip__descr">
                                        <p>C понедельника по пятницу — 08-00—21-00</p>
                                        <p>В субботу — 09-00—19-00</p>
                                        <p>В воскресенье — 09-00—15-00</p>
                                        <p><a class="link" href="/kontakty/">Контакты</a><a class="link" href="/kontakty/#map">Схема проезда</a></p>
                                    </div>
                                    <div class="tooltip__close js-tooltip-close">
                                        <div class="closeBtn"><span></span></div>
                                    </div>
                                </div>
                                <?/*<div class="tooltip__footer">
                                    <div class="tooltip__footer-title">внимание</div><a class="link" href="javascript:void(0);">Ознакомьтесь с изменением графика работы клиники на майские праздники</a>
                                </div>*/?>
                            </div>
                        </div><?/*<a class="siteNav__search js-liveSearchOpen" href="javascript:void(0);" data-live-search="is-top"><span class="icon icon--search"></span></a><a class="siteHeader__buttons-item siteHeader__buttons-item--lang" href="<?=$APPLICATION->GetCurDir() == '/english_version/' ? '/' : '/english_version/'?>"><?=$APPLICATION->GetCurDir() == '/english_version/' ? 'Ru' : 'En'?></a>*/?>
						<a class="siteNav__search js-liveSearchOpen" href="javascript:void(0);" data-live-search="is-top"><span class="icon icon--search"></span></a><a class="siteHeader__buttons-item siteHeader__buttons-item--lang" href="http://en.medicina.ru/">En</a>
                    </div>
                    <noindex><a class="siteHeader__signUp" href="https://my.medicina.ru/auth/" target="_blank" rel="nofollow"><div class="siteHeader__signUp"></div></a></noindex>
                    <div class="siteHeader__quickButtons js-siteHeader__quickButtons"><a class="siteHeader__quickButtons-item quickButton js-popup" href="#order" title="Записаться на прием"><img class="quickButton__image" src="/static/images/calendar.svg">
                            <div class="quickButton__text js-quickButton__text">Записаться на прием</div></a><a class="siteHeader__quickButtons-item quickButton js-popup" href="#search-doctor" title="Найти врача"><img class="quickButton__image" src="/static/images/find_doctor.svg">
                            <div class="quickButton__text js-quickButton__text">Найти врача</div></a><a class="siteHeader__quickButtons-item quickButton js-popup" href="#callback" title="Заказать звонок"><img class="quickButton__image" src="/static/images/call_back.svg">
                            <div class="quickButton__text js-quickButton__text">Заказать звонок</div></a></div>
                </div>
                <? endif; ?>
            </div>
        </header>

        <? foreach($arResult as $key => $arItem): ?>
            <? if(!empty($arItem['ITEMS'])): ?>
                <div id="header-nav-submenu-<?=$arItem['PARAMS']['section_id'] ?: $key?>" class="submenu js-submenu submenu-header">
                    <div class="submenu__container"><img class="submenu__img" src="<?=$arItem['PARAMS']['note_image']?>">
                        <div class="submenu__padding layout">
                            <div class="submenu__topBar">
                                <div class="submenu__title sectionName"><?=$arItem['TEXT']?></div>
                                <div class="submenu__about blockText"><?=$arItem['PARAMS']['description']?></div>
                                <div class="closeBtn"><span></span></div>
                            </div>
                            <div class="submenu__bottomBar js-submenu__bottomBar">
                                <div class="submenu__links blockText">
                                    <? foreach($arItem['ITEMS'] as $key2 => $arSubItem): ?>
                                        <div class="submenu__item<? if(!empty($arSubItem['ITEMS'])): ?> js-submenu__item<? endif; ?>"<? if(!empty($arSubItem['ITEMS'])): ?> data-hideBlock-id="hideblock-<?=$key . '-' . $key2?>"<? endif; ?>>
                                            <a href="<? if(empty($arSubItem['ITEMS'])): ?><?=$arSubItem['LINK']?><? else: ?>javascript:void(0)<? endif; ?>" class="submenu__link<? if($arSubItem['SELECTED']): ?> active<? endif; ?>"><?=$arSubItem['TEXT']?></a>
                                            <? if(!empty($arSubItem['ITEMS'])): ?><span class="submenu__item--arrow"></span><? endif; ?>
                                        </div>
                                    <? endforeach; ?>
                                </div>
                                <? foreach($arItem['ITEMS'] as $key2 => $arSubItem): ?>
                                    <? if(!empty($arSubItem['ITEMS'])): ?>
                                        <div class="submenu__links-additional js-add-drop" id="hideblock-<?=$key . '-' . $key2?>">
                                            <div class="submenu__links-box">
                                                <div class="submenu__links-container">
                                                    <? foreach($arSubItem['ITEMS'] as $key3 => $arLastDepth): ?>
                                                        <a class="submenu__link-additional<? if($arLastDepth['SELECTED']): ?> active<? endif; ?>" href="<?=$arLastDepth['LINK']?>"><?=$arLastDepth['TEXT']?></a>
                                                    <? endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <? endif; ?>
                                <? endforeach; ?>
                                <div class="submenu__congratulation">
                                    <div class="submenu__congratulation--name"><?=$arItem['PARAMS']['note_title']?></div>
                                    <div class="submenu__congratulation--text blockText"><?=$arItem['PARAMS']['note_text']?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <? endif; ?>
        <? endforeach; ?>
    </div>
    <? if(!$arParams['IS_MOBILE_VERSION']): ?>
    <div class="deletedHeader"></div>
    <? endif; ?>
    <div class="siteTitle__brand layout layout--header">
        <div class="siteTitle__brandType js-siteTitle__brandType">Клиника</div>
        <div class="siteTitle__brandName js-siteTitle__brandName">Медицина</div>
    </div>
    <div class="siteTitle__brandDescription js-siteTitle__brandDescription">Все лучшее в медицине!</div>
    <div class="siteTitle__buttons js-siteTitle__buttons">
        <a href="/zapisatsya-na-priem/"><div class="siteTitle__buttons-item js-siteTitle__buttons-item button button--lg">Записаться на прием</div></a>
    </div>
    <? if(!$arParams['IS_MOBILE_VERSION']): ?>
    <nav class="siteNav__container js-siteNav__container">
        <div class="layout layout--header">
            <ul class="siteNav js-siteNav">
                <? foreach($arResult as $key => $arItem): ?>
                    <li class="siteNav__item<? if($arItem['SELECTED']): ?>  active<? endif; ?><? if(!empty($arItem['ITEMS'])): ?> js-trigger-submenu<? endif; ?>" <? if(!empty($arItem['ITEMS'])): ?>data-submenu-id="header-nav-submenu-<?=$arItem['PARAMS']['section_id'] ?: $key?>"<? endif; ?>><a class="siteNav__link" href="<? if(empty($arItem['ITEMS'])): ?><?=$arItem['LINK']?><? else: ?>javascript:void(0)<? endif; ?>"><?=$arItem['TEXT']?></a></li>
                <? endforeach; ?>
            </ul>
            <?/*<a class="siteNav__search js-liveSearchOpen" href="javascript:void(0);" data-live-search="is-bottom"><span
                        class="icon icon--search"></span></a>*/?>
        </div>
    </nav>
    <? else: ?>
    <div class="siteHeader__quickButtons"><a class="siteHeader__quickButtons-item quickButton js-popup" href="#order"><img class="quickButton__image" src="/static/images/calendar.svg">
            <div class="quickButton__text js-quickButton__text">Записаться на прием</div></a><a class="siteHeader__quickButtons-item quickButton js-popup" href="#search-doctor"><img class="quickButton__image" src="/static/images/find_doctor.svg">
            <div class="quickButton__text js-quickButton__text">Найти врача</div></a><a class="siteHeader__quickButtons-item quickButton js-popup" href="#callback"><img class="quickButton__image" src="/static/images/call_back.svg">
            <div class="quickButton__text js-quickButton__text">Заказать звонок</div></a></div>
        <div class="siteHeader__phones">
            <div class="siteHeader__phones-item phone js-phone">
                <div class="phone__time">Круглосуточно</div>
                <a class="phone__number" href="tel:<?=preg_replace('/[^0-9]/', '', $headerPhone)?>"><span><?=str_replace(')', ')</span><span class="phone__number--big">', $headerPhone)?></span></a>
                <div class="phone__description">We speak English</div>
            </div>
            <div class="siteHeader__phones-item phone js-phone">
                <div class="phone__time">Круглосуточно</div>
                <a class="phone__number" href="tel:<?=preg_replace('/[^0-9]/', '', $emergencyPhone)?>"><span><?=str_replace(')', ')</span><span class="phone__number--big">', $emergencyPhone)?></span></a>
                <div class="phone__description">Скорая помощь</div>
            </div>
        </div>
    <? endif; ?>
</div>