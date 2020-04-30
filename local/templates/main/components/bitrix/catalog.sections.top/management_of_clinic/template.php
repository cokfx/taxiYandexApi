<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(empty($arResult['SECTIONS'])) return;
?>

<? foreach ($arResult['SECTIONS'] as $key => $topManager): ?>
    <div class="accordion">
        <input id="checkbox-<?=$key?>" type="checkbox"<? if(false && !empty($topManager['~DESCRIPTION'])): ?> checked<? endif; ?>>
        <div class="accordion__container">
            <div class="accordion__imageContainer" style="background-image: url(<?=\CFile::ResizeImageGet($topManager['PICTURE'], array('width'=>500, 'height' => 1000)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>); background-repeat: no-repeat;"></div>
            <div class="accordion__content">
                <div class="accordion__topBar">
                    <div class="formatedTexts">
                        <h2><?=$topManager['~NAME']?></h2>
                        <p><?=$topManager['~UF_MANAGER_POSITION']?></p>
                        <p><?=$topManager['~UF_MANAGER_PREV_TEXT']?></p>
                    </div>
                </div>
                <div class="accordion__bottomBar">
                    <div class="accordion__bottomBar--empty">
                        <? if(!empty($topManager['~DESCRIPTION'])): ?>
                        <label class="accordion__check" for="checkbox-<?=$key?>"><span></span><span></span></label>
                        <? endif; ?>
                    </div>
                    <div class="formatedTexts"><div class="formatedTexts"><span><?=$topManager['~UF_MANAGER_DEPARTMNT']?></span></div>   </div>
                </div>
            </div>
        </div>
        <div class="accordion__drop">
            <div class="accordion__drop--padding blockText">
                <div class="accordion__education">
                    <div class="formatedTexts">
                        <?=$topManager['~DESCRIPTION_TYPE'] == 'text' ? '<p>' . str_replace("\r\n", "<br />", $topManager['~DESCRIPTION']) . '</p>' : $topManager['~DESCRIPTION']?>
                    </div>
                </div>
                <div class="accordion__management">
                    <div class="formatedTexts">
                        <ul>
                            <? foreach($topManager['ITEMS'] as $manager2nd): ?>
                                <li>
                                    <div>
                                        <? if(!empty($manager2nd['PREVIEW_PICTURE'])): ?>
                                        <img src="<?=\CFile::ResizeImageGet($manager2nd['PREVIEW_PICTURE'], array('width' => 300, 'height' => 800)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>" alt="<?=$manager2nd['~NAME']?>">
                                        <? endif; ?>
                                    </div>
                                    <div>
                                        <span><?=$manager2nd['~NAME']?></span>
                                        <span><?=$manager2nd['PROPERTIES']['POSITION']['~VALUE']?></span>
                                        <?=$manager2nd['~PREVIEW_TEXT_TYPE'] == 'text' ? '<p>' . str_replace("\r\n", "<br />", $manager2nd['~PREVIEW_TEXT']) . '</p>' : $manager2nd['~PREVIEW_TEXT']?>
                                    </div>
                                </li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? endforeach; ?>