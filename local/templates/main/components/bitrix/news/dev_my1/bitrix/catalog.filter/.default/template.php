<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get">
    <? foreach ($arResult["ITEMS"] as $arItem):
        if (array_key_exists("HIDDEN", $arItem)):
            echo $arItem["INPUT"];
        endif;
    endforeach; ?>
    <div class="row filter-content-inpts ">

        <div class="col-md-12"><?= GetMessage("IBLOCK_FILTER_TITLE") ?></div>

        <? foreach ($arResult["ITEMS"] as $i => $arItem): ?>
            <? if (!array_key_exists("HIDDEN", $arItem)): ?>
                <div class="filter-content-inpts_item">
                    <div class="col-md-6"><?= $arItem["NAME"] ?>:</div>
                    <div id="inpt_fltr<?= $i; ?>" class="col-md-6 filter-input"><?= $arItem["INPUT"] ?></div>
                </div>
            <? endif ?>
        <? endforeach; ?>

        <input type="submit" name="set_filter" value="<?= GetMessage("IBLOCK_SET_FILTER") ?>"/>
        <input type="hidden" name="set_filter" value="Y"/>&nbsp;&nbsp;
        <input type="submit" name="del_filter" value="<?= GetMessage("IBLOCK_DEL_FILTER") ?>"/>

    </div>
</form>
