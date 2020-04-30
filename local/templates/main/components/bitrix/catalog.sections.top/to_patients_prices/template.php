<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);
if(empty($arResult['SECTIONS'])) return;
?>

<div class="price__accordions">
    <? foreach ($arResult['SECTIONS'] as $key => $serviceCategory): ?>
    <div class="accordion-service-00<?=++$key?>">
        <div class="accordion">
            <input id="checkbox-<?=$key?>" type="checkbox">
            <div class="accordion__container">
                <div class="accordion__content">
                    <div class="accordion__topBar">
                        <div class="formatedTexts">
                            <span><?=$serviceCategory['~UF_PRICES_SECT_CODE']?></span>
                            <h2><?=$serviceCategory['~NAME']?></h2>
                        </div>
                    </div>
                    <div class="accordion__bottomBar">
                        <div class="accordion__bottomBar--empty">
                            <label class="accordion__check" for="checkbox-<?=$key?>"><span></span><span></span></label>
                        </div>
                        <div class="formatedTexts">   </div>
                    </div>
                </div>
            </div>
            <? if(!empty($serviceCategory['ITEMS'])): ?>
            <div class="accordion__drop">
                <div class="formatedTexts">
                    <table>
                        <tbody>
                        <tr>
                            <th>Код</th>
                            <th>Название</th>
                            <th>Цена (руб.)</th>
                            <th></th>
                        </tr>
                        <? foreach($serviceCategory['ITEMS'] as $serviceItem): ?>
                            <tr>
                                <td><?=$serviceItem['PROPERTIES']['CODE']['~VALUE']?></td>
                                <td><?=$serviceItem['NAME']?></td>
                                <td><?=$serviceItem['PROPERTIES']['PRICE']['~VALUE']?></td>
                                <td>
                                    <div class="important__icon hint hint--left" aria-label=<?=$serviceItem['PREVIEW_TEXT']?>>
                                        <div class="icon icon--guarantee-i"></div>
                                    </div>
                                </td>
                            </tr>
                        <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <? endif; ?>
        </div>
    </div>
    <? endforeach; ?>
</div>
