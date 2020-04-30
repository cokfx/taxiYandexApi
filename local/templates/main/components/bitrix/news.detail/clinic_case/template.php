<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="section">
    <div class="layout">
        <div class="sectionName">
            <h1><?=$arResult['NAME']?></h1>
        </div>
    </div>
</div>
<div class="section">
    <div class="layout">
        <div class="clinic-detail__authors">
            <div class="authors">
                <div class="authors__date"><?= mb_strtolower($arResult['DISPLAY_ACTIVE_FROM']) ?></div>
                <div class="authors__container">
                    <? if($arResult['DETAIL_PICTURE']): ?>
                    <div class="authors__pic"><img class="authors__img" src="<?=$arResult['DETAIL_PICTURE']['SRC']?>"></div>
                    <? endif; ?>
                    <? if(!empty($arResult['PROPERTIES']['DOCTORS']['VALUE'])): ?>
                    <div class="authors__content">
                        <?
                        foreach ($arResult['PROPERTIES']['DOCTORS']['VALUE'] as $doctorID):
                            $doctor = $arResult['DOCTORS'][$doctorID];
                        ?>
                        <div class="authors__author">
                            <div class="authors__author-name"><span><?=$doctor['SURNAME']?></span> <?=$doctor['INITIALS']?></div>
                            <div class="authors__author-post"><?=$doctor['SPECIALTY']?></div>
                            <div class="authors__author-detail"><a href="<?=$doctor['FIELDS']['DETAIL_PAGE_URL']?>">Подробнее о враче</a></div>
                        </div>
                        <? endforeach; ?>
                    </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="layout">
        <div class="clinic-detail__article">
            <div class="formatedTexts">
                <? if(strlen($arResult['~DETAIL_TEXT']) > 3): ?>
                    <?=$arResult['~DETAIL_TEXT_TYPE'] == 'text' ? '<div><p>' . str_replace("\r\n", "<br />", $arResult['~DETAIL_TEXT']) . '</p></div>' : $arResult['~DETAIL_TEXT']?>
                <? else: ?>
                    <?=$arResult['~PREVIEW_TEXT_TYPE'] == 'text' ? '<p>' . str_replace("\r\n", "<br />", $arResult['~PREVIEW_TEXT']) . '</p>' : $arResult['~PREVIEW_TEXT']?>
                <? endif; ?>
            </div>
        </div>
    </div>
</div>

<? if(!empty($arResult['PROPERTIES']['VIDEO']['VALUE'])): ?>
<?$APPLICATION->IncludeComponent("bureau:iblock.items", "clinic_case_videos", Array(
    "ADDITIONAL_FILTER" => ['ID' => $arResult['PROPERTIES']['VIDEO']['VALUE']],	// Условие отображения элементов
    "CACHE_TIME" => "3600",	// Время кеширования (сек.)
    "CACHE_TYPE" => "A",	// Тип кеширования
    "COUNT" => "10000",	// Количество для показа
    "DATE_ACTIVE_CONDITION" => "Y",	// Учитывать активность по дате
    "GET_LINKED_ELEMENTS" => "N",	// Выбрать связанные элементы
    "IBLOCK_ID" => "35",	// Инфоблок
    "IBLOCK_TYPE" => "press_centre",	// Тип инфоблока
    "PAGER_DESC_NUMBERING" => "Объекты",	// Название объектов в постраничной навигации
    "SECTION_ID" => "",	// Раздел
    "SET_TITLE" => "N",	// Устанавливать заголовок страницы
    "SHOW_DATETIME" => "datetime",	// Показывать дату и время
    "SHOW_PAGENAV" => "N",	// Показывать постраничную навигацию
    "SHOW_PROPERTIES" => array(	// Показывать свойства
        0 => "11",
        1 => "12",
    ),
    "SHOW_SECTION_NAME" => "N",	// Включать название раздела в название
    "SORT_FIELD" => "timestamp_x",	// Сортировка элементов
    "SORT_ORDER" => "desc",	// Направление сортировки
),
    false
);?>
<? endif; ?>

<? if(!empty($arResult['PROPERTIES']['AUDIO']['VALUE'])): ?>
    <?$APPLICATION->IncludeComponent("bureau:iblock.items", "clinic_case_audio", Array(
        "ADDITIONAL_FILTER" => ['ID' => $arResult['PROPERTIES']['AUDIO']['VALUE']],	// Условие отображения элементов
        "CACHE_TIME" => "3600",	// Время кеширования (сек.)
        "CACHE_TYPE" => "A",	// Тип кеширования
        "COUNT" => "1000",	// Количество для показа
        "DATE_ACTIVE_CONDITION" => "Y",	// Учитывать активность по дате
        "GET_LINKED_ELEMENTS" => "N",	// Выбрать связанные элементы
        "IBLOCK_ID" => "36",
        "IBLOCK_TYPE" => "press_centre",
        "PAGER_DESC_NUMBERING" => "Объекты",	// Название объектов в постраничной навигации
        "SECTION_ID" => "",	// Раздел
        "SET_TITLE" => "N",	// Устанавливать заголовок страницы
        "SHOW_DATETIME" => "datetime",	// Показывать дату и время
        "SHOW_PAGENAV" => "N",	// Показывать постраничную навигацию
        "SHOW_PROPERTIES" => "",	// Показывать свойства
        "SHOW_SECTION_NAME" => "N",	// Включать название раздела в название
        "SORT_FIELD" => "sort",	// Сортировка элементов
        "SORT_ORDER" => "asc",	// Направление сортировки
    ),
        false
    );?>
<? endif; ?>

<? if(!empty($arResult['PROPERTIES']['FILES']['VALUE']) || !empty($arResult['PROPERTIES']['NOTICES']['VALUE'])): ?>
<div class="section">
    <div class="layout">
        <? if(!empty($arResult['PROPERTIES']['FILES']['VALUE'])): ?>
        <div class="clinic-detail__files">
        <?
            foreach ($arResult['PROPERTIES']['FILES']['VALUE'] as $fileID):
                $fileArr = \CFile::GetFileArray($fileID);
                $fileName = mb_pathinfo($fileArr['ORIGINAL_NAME'], PATHINFO_FILENAME);
                $extension = pathinfo($fileArr['ORIGINAL_NAME'], PATHINFO_EXTENSION);
        ?>
            <a class="card__file link link--icon file" href="<?=$fileArr['SRC']?>"><span class="icon icon--file-pdf file__img">
                         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 39 48">
<path fill="none" stroke="#0F6CB6" stroke-width="2" stroke-miterlimit="10" d="M5 2.6C5 1.7 5.7 1 6.6 1h23.6L38 8.9v36.5c0 .9-.7 1.6-1.6 1.6H6.6c-.9 0-1.6-.7-1.6-1.6V2.6z" />
<path fill="none" stroke="#0F6CB6" stroke-width="2" stroke-miterlimit="10" d="M30 1.9v5.4c0 .9.7 1.6 1.6 1.6H38" />
<path fill="#0F6CB6" d="M23.4 40H1.6C.7 40 0 39.3 0 38.4v-7.8c0-.9.7-1.6 1.6-1.6h21.8c.9 0 1.6.7 1.6 1.6v7.8c0 .9-.7 1.6-1.6 1.6z" />
<text fill="#fff" x="5px" y="37px" class="file-type-svg"><?=$extension?></text>
</svg></span><span class="link__text link__text--icon-pdf file__name"><?=$fileName?></span></a>
            <? endforeach; ?>
        </div>
        <? endif; ?>
        <? if(!empty($arResult['PROPERTIES']['NOTICES']['VALUE'])): ?>
        <div class="clinic-detail__result">
            <? foreach ($arResult['PROPERTIES']['NOTICES']['VALUE'] as $key => $title): ?>
                <div class="clinic-detail__consent"><span><?=$title?>:</span> <?=$arResult['PROPERTIES']['NOTICES']['DESCRIPTION'][$key]?></div>
            <? endforeach; ?>
        </div>
        <? endif; ?>
    </div>
</div>
<? endif; ?>