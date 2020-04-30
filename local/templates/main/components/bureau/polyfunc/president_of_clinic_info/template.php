<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="accordion__imageContainer" style="background-image: url(<?=$arParams['~IMAGE_LINK']?>); background-repeat: no-repeat;"></div>
<div class="accordion__content">
    <div class="accordion__topBar">
        <div class="formatedTexts">
            <h2><?=$arParams['~NAME']?></h2>
            <p><?=$arParams['~DESCRIPTION']?></p>
        </div>
    </div>
    <div class="accordion__bottomBar">
        <div class="accordion__bottomBar--empty">
            <label class="accordion__check" for="checkbox-president"><span></span><span></span></label>
        </div>
        <div class="formatedTexts"><div class="formatedTexts"><span><?=$arParams['~POSITION']?></span></div>   </div>
    </div>
</div>