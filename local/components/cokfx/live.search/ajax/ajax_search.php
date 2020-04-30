<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
?>

<?
if ((CModule::IncludeModule('search')) && (CModule::IncludeModule('iblock'))) {
    $q = $_REQUEST['q'];
    $ibId = $_REQUEST['iblock'];
    $obSearch = new CSearch;
    $obSearch->Search(array(
            "QUERY" => $q,
            "SITE_ID" => LANG,
            "MODULE_ID" => 'iblock',
            "CHECK_DATES" => 'Y',
            "PARAM2" => $ibId// IBLOCK_ID
        )
    );
    $result = array();
    while ($res = $obSearch->GetNext()) {
        $id = $res['ITEM_ID'];
        $resi = CIBlockElement::GetByID($id);
        if ($ar_res = $resi->GetNext()) {
            $arrResi['sectID'] = $ar_res['IBLOCK_SECTION_ID'];
        }
        $resS = CIBlockSection::GetByID($arrResi['sectID']);
        if ($ar_resS = $resS->GetNext()) {
            $sectionName = $ar_resS['NAME'];
            $sectionID = $ar_resS['ID'];
        }

        //если нашли раздел:
        if (stripos($id, 'S') !== false) {
            $result_item['TITLE'] = $res['TITLE'];
            $result_item['URL'] = $res['URL'];
            $result_item['BODY_FORMATED'] = $res['TITLE_FORMATED'];
            $result_item['SECTION_NAME'] = $sectionName;
            $result_item['SECTION_ID'] = $sectionID;
            $result[] = $result_item;
        } //если S-ки нету, то
        else {
            $result_item['TITLE'] = $res['TITLE'];
            $result_item['URL'] = $res['URL'];
            $result_item['BODY_FORMATED'] = $res['BODY_FORMATED'];
            $result_item['SECTION_NAME'] = $sectionName;
            $result_item['SECTION_ID'] = $sectionID;
            $result[] = $result_item;

        }
    }
    foreach ($result as $i => $item) {
        $arSects[$item['SECTION_ID']]['NAME'] = $item['SECTION_NAME'];
        $arSects[$item['SECTION_ID']]['HTML'][] = $item;
    } ?>
    <? ob_start(); ?>
    <div class="live-search">
        <?php
        foreach ($arSects as $k => $arSect) {
            ?>
            <h3><?= $arSect['NAME']; ?></h3>
            <? foreach ($arSect['HTML'] as $l => $item): ?>
            <?$arr=explode('?',$arSect['HTML']);?>
                <a href="<?= $arr[1] ?>" class="live-search__item">

                    <div class="live-search__item-inner">
                        <h4 class="live-search__item-name">
                    <span class="live-search__item-hl">
                        <?= $item['TITLE']; ?>
                    </span>
                        </h4>
                        <?= $item['BODY_FORMATED']; ?>
                    </div>
                </a>
            <? endforeach; ?>
            <hr>
        <? } ?>

    </div>
    <?
    $html = ob_get_contents();
    ob_end_clean();
    $res = array(
        'html' => $html
    );
    //echo json_encode($arSects);
    echo \Bitrix\Main\Web\Json::encode($res);
    die();
}
?>
