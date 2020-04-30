<?php if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<? if(empty($arResult['ITEMS'])) return; ?>

<ul class="add-menu__list add-menu__awards-list">
    <? foreach ($arResult['ITEMS'] as $item): ?>
    <li class="add-menu__awards-item">
        <div class="add-menu__awards-pic"><img class="add-menu__awards-img" src="<?=CFile::GetPath($item['PROPERTIES']['BURGER_MENU_ICON']['VALUE'])?>"></div>
        <div class="add-menu__awards-text"><?=$item['PROPERTIES']['BURGER_MENU_TEXT']['VALUE']?></div>
    </li>
    <? endforeach; ?>
</ul><a class="add-menu__awards-link" href="/o-klinike/nagrady-sertifikaty-litsenzii-svidetelstva/">Все награды</a>