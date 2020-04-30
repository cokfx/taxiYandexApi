<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>

    <nav class="add-menu js-add-menu">
        <div class="add-menu__container">
            <div class="closeButton js-showMenuTrigger"><span></span></div>
            <div class="add-menu__icons">
                <div class="add-menu__icon">
                    <a href="http://en.medicina.ru/">
                        <div class="header__contacts-item--lang">En</div>
                    </a>
                    <? /*
                <a href="<?=$APPLICATION->GetCurDir() == '/english_version/' ? '/' : '/english_version/'?>"><div class="header__contacts-item--lang"><?=$APPLICATION->GetCurDir() == '/english_version/' ? 'Ru' : 'En'?></div></a>
				*/ ?>
                </div>
                <div class="add-menu__icon icon icon--search js-liveSearchOpen" data-live-search="is-top"></div>
            </div>
            <div class="add-menu__content">
                <div class="add-menu__right">

                    <div style="color: #fff;">
                        <?
                        //echo '<pre>';
                        // print_r($arResult);
                        //print_r($arParams);
                        //echo '</pre>';
                        ?>
                    </div>

                    <ul class="add-menu__list">
                        <? foreach ($arResult as $key => $arItem): ?>
                            <li class="add-menu__item<? if (!empty($arItem['ITEMS'])): ?> add-menu__item--add js-showSubmenuTrigger<? endif; ?><? if ($arItem['SELECTED']): ?>  active<? endif; ?>"<? if (!empty($arItem['ITEMS'])): ?> data-add-menu-id="humburger-menu-<?= $key ?>"<? endif; ?>>
                                <a href="<?= $arItem['LINK'] ?>"><?= $arItem['TEXT'] ?><? if (!empty($arItem['ITEMS'])): ?>
                                        <div class="add-menu__item-arrow"></div><? endif; ?></a>
                                <? if (!empty($arItem['ITEMS'])): ?>
                                    <div id="humburger-menu-<?= $key ?>" class="add-menu__drop js-menu-drop">
                                        <ul class="add-menu__drop-list">
                                            <? foreach ($arItem['ITEMS'] as $key => $arSubItem): ?>
                                                <li class="add-menu__drop-item<? if ($arSubItem['SELECTED']): ?> active<? endif; ?>">
                                                    <a href="<?= $arSubItem['LINK'] ?>"><?= $arSubItem['TEXT'] ?></a>
                                                </li>
                                            <? endforeach; ?>
                                        </ul>
                                    </div>
                                <? endif; ?>
                            </li>
                        <? endforeach; ?>
                    </ul>


                </div>

                <? foreach ($arResult as $key => $arItem): ?>
                    <? if (!empty($arItem['ITEMS'])): ?>
                        <div class="add-menu__left js-slide-block">
                            <ul class="add-menu__list-add">
                                <? foreach ($arItem['ITEMS'] as $key => $arSubItem): ?>
                                    <li class="add-menu__item-add<? if ($arSubItem['SELECTED']): ?> active<? endif; ?>">
                                        <a href="<?= $arSubItem['LINK'] ?>"><?= $arSubItem['TEXT'] ?></a></li>
                                <? endforeach; ?>
                            </ul>
                            <div class="add-menu__service">
                                <div class="add-menu__service-pic">
                                    <div class="add-menu__service-img">
                                        <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/burger_submenu_1.php') ?>
                                    </div>
                                </div>
                                <div class="add-menu__service-title">
                                    <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/burger_submenu_2.php') ?>
                                </div>
                                <div class="add-menu__service-text">
                                    <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/burger_submenu_3.php') ?>
                                </div>
                            </div>
                        </div>
                    <? endif; ?>
                <? endforeach; ?>
            </div>
        </div>
    </nav>
<? endif ?>
