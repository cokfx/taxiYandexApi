<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<ul class="add-menu__list">
    <? foreach($arResult as $key => $arItem): ?>
    <li class="add-menu__item<? if(!empty($arItem['ITEMS'])): ?> add-menu__item--add js-showSubmenuTrigger<? endif; ?><? if($arItem['SELECTED']): ?>  active<? endif; ?>" data-add-menu-id="add-menu-<?=$key?>"><a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?><? if(!empty($arItem['ITEMS'])): ?><div class="add-menu__item-arrow"></div><? endif; ?></a>
        <? if(!empty($arItem['ITEMS'])): ?>
        <div class="add-menu__drop js-menu-drop" id="add-menu-<?=$key?>">
            <ul class="add-menu__drop-list">
                <? foreach($arItem['ITEMS'] as $key2 => $arSubItem): ?>
                    <li class="add-menu__drop-item<? if($arSubItem['SELECTED']): ?> active<? endif; ?><? if(!empty($arSubItem['ITEMS'])): ?> js-showSubmenuInner<? endif; ?>"<? if(!empty($arSubItem['ITEMS'])): ?> data-add-menu-id="add-submenu-<?=$key2?>"<? endif; ?>>
                        <a href="<? if(empty($arSubItem['ITEMS'])): ?><?=$arSubItem['LINK']?><? else: ?>javascript:void(0)<? endif; ?>"><?=$arSubItem['TEXT']?><? if(!empty($arSubItem['ITEMS'])): ?><div class="add-menu__item-arrow add-menu__item-arrow-inner"></div><? endif; ?></a>
                        <? if(!empty($arSubItem['ITEMS'])): ?>
                        <div class="add-menu__drop js-menu-drop-inner" id="add-submenu-<?=$key2?>">
                            <ul class="add-menu__drop-list add-menu__drop-list-inner">
                            <? foreach($arSubItem['ITEMS'] as $key => $arLastDepth): ?>
                                <li class="add-menu__drop-item<? if($arLastDepth['SELECTED']): ?> active<? endif; ?>"><a href="<?=$arLastDepth['LINK']?>"><?=$arLastDepth['TEXT']?></a></li>
                            <? endforeach; ?>
                            </ul>
                        </div>
                        <? endif; ?>
                    </li>
                <? endforeach; ?>
            </ul>
        </div>
        <? endif; ?>
    </li>
    <? endforeach; ?>
</ul>