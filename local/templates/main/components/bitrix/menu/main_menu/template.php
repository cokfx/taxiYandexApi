<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
$headerPhone = \Bureau\Site\Tools::getModuleOptions()['header_phone'] ?: "74959950033";
$emergencyPhone = \Bureau\Site\Tools::getModuleOptions()['emergency_phone'] ?: "74952290003";
$headerPhone = \Bureau\Site\Tools::ReformatPhone($headerPhone);
$emergencyPhone = \Bureau\Site\Tools::ReformatPhone($emergencyPhone);
?>

<header id="header-menu" class="header header--inner js-submenu-container">
    <? $APPLICATION->IncludeFile('include/live_search.php'); ?>
    <div id="header__box" class="header__box">
        <div class="layout layout--header">
            <div class="header__container">
                <div class="headerTop">
                    <div class="header__burger js-showMenuTrigger"><span class="header__burger-bar"></span><span
                                class="header__burger-bar"></span><span class="header__burger-bar"></span></div>
                    <div class="header__phone">
                        <div class="phone">
                            <div class="phone__time">Круглосуточно</div>
                            <a class="phone__number"
                               href="tel:<?= preg_replace('/[^0-9]/', '', $headerPhone) ?>"><span><?= str_replace(')', ')</span><span class="phone__number--big">', $headerPhone) ?></span></a>
                            <div class="phone__description">We speak English</div>
                        </div>
                        <div class="phone">
                            <div class="phone__time">Круглосуточно</div>
                            <a class="phone__number"
                               href="tel:<?= preg_replace('/[^0-9]/', '', $emergencyPhone) ?>"><span><?= str_replace(')', ')</span><span class="phone__number--big">', $emergencyPhone) ?></span></a>
                            <div class="phone__description">Скорая помощь</div>
                        </div>
                    </div><!-- <a href="/"><img class="header__logo" src="/static/images/logo.svg"></a> -->
                    <? $APPLICATION->IncludeFile('include/header_contacts.php'); ?>
                    <noindex><a href="https://my.medicina.ru/auth/" target="_blank" rel="nofollow">
                            <div class="header__signUp"></div>
                        </a></noindex>
                    <div class="header__quickButtons"><a class="header__quickButtons-item quickButton js-popup"
                                                         href="#order" title="Записаться на прием"><img
                                    src="/static/images/calendar.svg"></a><a
                                class="header__quickButtons-item quickButton js-popup" href="#search-doctor"
                                title="Найти врача"><img src="/static/images/find_doctor.svg"></a><a
                                class="header__quickButtons-item quickButton js-popup" href="#callback"
                                title="Заказать звонок"><img src="/static/images/call_back.svg"></a></div>
                </div>
                <!-- <div class="headerMid">
                    <div class="headerMid__text"></div>
                </div> -->
                <!-- <nav class="headerNav">
                    <ul class="headerNav__list">
                        <? foreach ($arResult as $key => $arItem): ?>
                            <li class="headerNav__item<? if ($arItem['SELECTED']): ?>  active<? endif; ?><? if (!empty($arItem['ITEMS'])): ?> js-trigger-submenu<? endif; ?>" <? if (!empty($arItem['ITEMS'])): ?>data-submenu-id="header-nav-submenu-<?= $arItem['PARAMS']['section_id'] ?: $key ?>"<? endif; ?>><a href="<? if (empty($arItem['ITEMS'])): ?><?= $arItem['LINK'] ?><? else: ?>javascript:void(0)<? endif; ?>"><?= $arItem['TEXT'] ?></a></li>
                        <? endforeach; ?>
                    </ul>
                </nav>-->
            </div>
        </div>
    </div>

    <?
    $burgerMenu = $APPLICATION->IncludeComponent("bitrix:menu", "burger_menu", Array(
        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
        "CHILD_MENU_TYPE" => "subsections",    // Тип меню для остальных уровней
        "DELAY" => "N",    // Откладывать выполнение шаблона меню
        "MAX_LEVEL" => "2",    // Уровень вложенности меню
        "MENU_CACHE_GET_VARS" => array(    // Значимые переменные запроса
            0 => "",
        ),
        "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
        "MENU_CACHE_TYPE" => "N",    // Тип кеширования
        "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
        "ROOT_MENU_TYPE" => "burger",    // Тип меню для первого уровня
        "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
        "RETURN" => "Y"
    ),
        false
    );
    $menuList = array();
    $lev = 0;
    $lastInd = 0;
    $parents = array();
    foreach ($burgerMenu as $arItem) {
        $lev = $arItem['DEPTH_LEVEL'];

        if ($arItem['IS_PARENT']) {
            $arItem['ITEMS'] = array();
        }

        if ($lev == 1) {
            $menuList[] = $arItem;
            $lastInd = count($menuList) - 1;
            $parents[$lev] = &$menuList[$lastInd];
        } else {
            $parents[$lev - 1]['ITEMS'][] = $arItem;
            $lastInd = count($parents[$lev - 1]['ITEMS']) - 1;
            $parents[$lev] = &$parents[$lev - 1]['ITEMS'][$lastInd];
        }
    }
    $burgerMenu = $menuList;
    $arResult = array_merge($arResult, $burgerMenu);
    ?>

    <? foreach ($arResult as $key => $arItem): ?>
        <? if (!empty($arItem['ITEMS'])): ?>
            <div id="header-nav-submenu-<?= $arItem['PARAMS']['section_id'] ?: $key ?>"
                 class="submenu js-submenu submenu-header">
                <div class="submenu__container"><img class="submenu__img" src="<?= $arItem['PARAMS']['note_image'] ?>">
                    <div class="submenu__padding layout">
                        <div class="submenu__topBar">
                            <div class="submenu__title sectionName"><?= $arItem['TEXT'] ?></div>
                            <div class="submenu__about blockText"><?= $arItem['PARAMS']['description'] ?></div>
                            <div class="closeBtn"><span></span></div>
                        </div>
                        <div class="submenu__bottomBar js-submenu__bottomBar">
                            <div class="submenu__links blockText">
                                <? foreach ($arItem['ITEMS'] as $key2 => $arSubItem): ?>
                                    <div class="submenu__item<? if (!empty($arSubItem['ITEMS'])): ?> js-submenu__item<? endif; ?>"<? if (!empty($arSubItem['ITEMS'])): ?> data-hideBlock-id="hideblock-<?= $key . '-' . $key2 ?>"<? endif; ?>>
                                        <a href="<? if (empty($arSubItem['ITEMS'])): ?><?= $arSubItem['LINK'] ?><? else: ?>javascript:void(0)<? endif; ?>"
                                           class="submenu__link<? if ($arSubItem['SELECTED']): ?> active<? endif; ?>"><?= $arSubItem['TEXT'] ?></a><? if (!empty($arSubItem['ITEMS'])): ?>
                                            <span class="submenu__item--arrow"></span><? endif; ?></div>
                                <? endforeach; ?>
                            </div>
                            <? foreach ($arItem['ITEMS'] as $key2 => $arSubItem): ?>
                                <? if (!empty($arSubItem['ITEMS'])): ?>
                                    <div class="submenu__links-additional js-add-drop"
                                         id="hideblock-<?= $key . '-' . $key2 ?>">
                                        <div class="submenu__links-box">
                                            <div class="submenu__links-container">
                                                <? foreach ($arSubItem['ITEMS'] as $key3 => $arLastDepth): ?>
                                                    <a class="submenu__link-additional<? if ($arLastDepth['SELECTED']): ?> active<? endif; ?>"
                                                       href="<?= $arLastDepth['LINK'] ?>"><?= $arLastDepth['TEXT'] ?></a>
                                                <? endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <? endif; ?>
                            <? endforeach; ?>
                            <div class="submenu__congratulation">
                                <div class="submenu__congratulation--name"><?= $arItem['PARAMS']['note_title'] ?></div>
                                <div class="submenu__congratulation--text blockText"><?= $arItem['PARAMS']['note_text'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <? endif; ?>
    <? endforeach; ?>
</header>