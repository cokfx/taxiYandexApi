<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
if(empty($arResult['SECTIONS'])) return;
?>

<div class="formatedTexts">
    <h2>Лицензии</h2>
    <? foreach ($arResult['SECTIONS'] as $key => $licenseCategory): ?>
    <p id="license-<?=$licenseCategory['ID']?>"><?=$licenseCategory['~NAME']?></p>
    <ul>
        <? foreach($licenseCategory['ITEMS'] as $license): ?>
        <li><a class="zoom-picture" href="<?=\CFile::ResizeImageGet($license['DETAIL_PICTURE'], array('width' => 1200, 'height' => 800)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>" data-fancybox><img class="zoom-img" src="<?=\CFile::ResizeImageGet($license['PREVIEW_PICTURE'], array('width' => 190, 'height' => 266)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>" alt="<?=$license['~NAME']?>"></a>
        </li>
        <? endforeach; ?>
    </ul>
    <? endforeach; ?>
</div>