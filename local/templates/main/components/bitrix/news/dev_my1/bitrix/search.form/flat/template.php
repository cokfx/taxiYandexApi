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
$this->setFrameMode(true); ?>
<div class="search-form">

    <form action="<?= $arResult["FORM_ACTION"] ?>">
        <? if ($arParams["USE_SUGGEST"] === "Y"): ?><? $APPLICATION->IncludeComponent(
            "bitrix:search.suggest.input",
            "",
            array(
                "NAME" => "q",
                "VALUE" => "",
                "INPUT_SIZE" => 15,
                "DROPDOWN_SIZE" => 10,
            ),
            $component, array("HIDE_ICONS" => "Y")
        ); ?><? else: ?>


        <div class="input-group search-form_inputgroup col-md-12">

            <div class=" search-form_inputgroup-searchtext col-md-6">
                <input class="form-control" type="text" name="q" value="" size="15" maxlength="50"
                       aria-describedby="button-addon1"/>
            </div>
            <div class="input-group-prepend search-form_inputgroup-submit col-md-6">

                <input id="button-addon1" class="btn btn-outline-secondary " name="s" type="submit"
                       value="<?= GetMessage("BSF_T_SEARCH_BUTTON"); ?>"/>
            </div>

            <? endif; ?>&nbsp;

        </div>

    </form>
</div>
