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

    <?= GetMessage("IBLOCK_FILTER_TITLE") ?>

    <input class="form-control" type="text" name="arrFilter_ff[NAME]"  value=""><br>
    <input class="form-control" type="text" name="arrFilter_ff[PREVIEW_TEXT]"  value=""><br>
    <input class="form-control" type="text" name="arrFilter_ff[DETAIL_TEXT]"  value=""><br>

    <input class="btn btn-primary" type="submit" name="set_filter" value="<?= GetMessage("IBLOCK_SET_FILTER") ?>"/><br>
    <input  type="hidden" name="set_filter" value="Y"/>
    <input class="btn btn-primary" type="submit" name="del_filter" value="<?= GetMessage("IBLOCK_DEL_FILTER") ?>"/>



</form>
