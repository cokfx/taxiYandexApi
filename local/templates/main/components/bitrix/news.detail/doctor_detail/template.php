<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>


<div class="section">
    <div class="doctor-cart__container">
        <div class="doctor-cart__visible-b">
            <div class="layout">
                <div class="visible-b">
                    <div class="visible-b__breadcrumb"><a href="/nashi-vrachi/">назад</a></div>
                    <div class="visible-b__about">
                        <div class="visible-b__short-info">
                            <div class="sectionName">
                                <h1><?=$arResult['NAME']?></h1>
                            </div>
                            <div class="short-info">
                                <div class="short-info__pic" style="background-image: url(<?=\CFile::ResizeImageGet($arResult['PREVIEW_PICTURE'], array('width'=>381, 'height' => 1000)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>);" data-alt="<?=$arResult['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?>"></div>
                                <div class="short-info__text">
                                    <div class="short-info__title"><?=$arResult['PROPERTIES']['SPECIALTY_EXTENDED']['VALUE'] ?: $arResult['SPECIALTIES_FORMATTED']?></div>
                                    <div class="formatedTexts">
                                        <p><?=$arResult['PROPERTIES']['ACADEMIC_DEGREE']['VALUE']?></p>
                                        <?=$arResult['~PREVIEW_TEXT_TYPE'] == 'text' ? '<p>' . str_replace("\r\n", "<br />", $arResult['~PREVIEW_TEXT']) . '</p>' : $arResult['~PREVIEW_TEXT']?>
                                    </div>
                                    <? if($arResult['EXPERIENCE']): ?>
                                    <div class="short-info__exp">Стаж <?=\Bureau\Site\Tools::plural($arResult['EXPERIENCE'], null, ['год', 'года', 'лет'])?></div>
                                    <? endif; ?>
                                    <div class="short-info__btns">
                                        <div class="short-info__box">
                                            <button class="button button--lg short-info__btn" onclick="window.location.href='/zapisatsya-na-priem/?doctorID=<?=$arResult['ID']?>'">записаться на прием</button>
                                            <? if(!empty($arResult['PROPERTIES']['DETAIL_INFO_TEXT_1']['~VALUE']['TYPE'] || $arResult['PROPERTIES']['DETAIL_INFO_PHOTOS']['~VALUE'] || $arResult['PROPERTIES']['DETAIL_INFO_TEXT_2']['~VALUE']['TEXT'])): ?>
                                            
                                            <? endif; ?>

                                            <a class="button button--lg short-info__btn js-popup" href="#review-doctor">оставить отзыв</a>
                                            <a class="short-info__slide js-dropTrigger" href="javascript:void(0);">Подробная информация</a>
                                           <!--  <a class="short-info__slide js-dropTrigger" href="javascript:void(0);">Подробная информация</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="visible-b__additional-info">
                            <div class="formatedTexts">
                                <?=$arResult['~DETAIL_TEXT_TYPE'] == 'text' ? '<div><p>' . str_replace("\r\n", "<br />", $arResult['~DETAIL_TEXT']) . '</p></div>' : $arResult['~DETAIL_TEXT']?>
                            </div>
                            <a class="short-info__slide js-dropTrigger" href="javascript:void(0);">Подробная информация</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="doctor-cart__drop">
            <div class="layout">
                <? if(!empty($arResult['PROPERTIES']['DETAIL_INFO_TEXT_1']['~VALUE']['TYPE'])): ?>
                <div class="formatedTexts">
                    <?=$arResult['PROPERTIES']['DETAIL_INFO_TEXT_1']['~VALUE']['TYPE'] == 'TEXT' ? '<div><p>' . str_replace("\r\n", "<br />", $arResult['PROPERTIES']['DETAIL_INFO_TEXT_1']['~VALUE']['TEXT']) . '</p></div>' : $arResult['PROPERTIES']['DETAIL_INFO_TEXT_1']['~VALUE']['TEXT']?>
                </div>
                <? endif; ?>
                
                <? if(!empty($arResult['PROPERTIES']['DETAIL_INFO_PHOTOS']['~VALUE'])): ?>
                <div class="doctor-cart__drop-picture">
                    <? foreach ($arResult['PROPERTIES']['DETAIL_INFO_PHOTOS']['~VALUE'] as $key => $imgID): ?>
                    <div class="drop-picture"><a class="zoom-picture" href="<?=\CFile::ResizeImageGet($imgID, array('width'=>1920, 'height' => 1080)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>" data-fancybox><img class="zoom-img" src="<?=\CFile::ResizeImageGet($imgID, array('width'=>140, 'height' => 200)/*, BX_RESIZE_IMAGE_EXACT*/)['src']?>" alt="Документ"></a><span><?=$arResult['PROPERTIES']['DETAIL_INFO_PHOTOS']['~DESCRIPTION'][$key]?></span>
                    </div>
                    <? endforeach; ?>
                </div>
                <? endif; ?>
                <? if(!empty($arResult['PROPERTIES']['DETAIL_INFO_TEXT_2']['~VALUE']['TEXT'])): ?>
                <div class="formatedTexts">
                    <?=$arResult['PROPERTIES']['DETAIL_INFO_TEXT_2']['~VALUE']['TYPE'] == 'TEXT' ? '<div><p>' . str_replace("\r\n", "<br />", $arResult['PROPERTIES']['DETAIL_INFO_TEXT_2']['~VALUE']['TEXT']) . '</p></div>' : $arResult['PROPERTIES']['DETAIL_INFO_TEXT_2']['~VALUE']['TEXT']?>
                </div>
                <? endif; ?>
                <?
				global $docCommentFilter;
                $docCommentFilter= array("=PROPERTY_CD" => $arResult['CODE'] );?>
				<?/*$APPLICATION->IncludeComponent(
                "bitrix:news.list", 
                "cooments", 
                array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "COMPONENT_TEMPLATE" => "cooments",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "N",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "FILTER_NAME" => "docCommentFilter",
                    "FORM_NAME" => "Оставить отзыв о враче",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "43",
                    "IBLOCK_TYPE" => "comments",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "4",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER1" => "DESC",
                    "SORT_ORDER2" => "ASC",
                    "STRICT_SECTION_CHECK" => "N",
                    "REDIRECT_URL" => "https://www.medicina.devvr.buroburo.ru/spasibo-za-soobshchenie-o-zapisi-na-priyem/"
                    
                ),
                false
);*/?>
            </div>
        </div>
    </div>
</div>

<div class="popup layout layout--popup" id="review-doctor">
          <div class="popup__wrap">
           <?$APPLICATION->IncludeComponent(
                "cokol:ext.form",
                "comments", 
                array(
                    "AJAX_MODE" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "Y",
                    "AJAX_OPTION_STYLE" => "Y",
                    "COMPONENT_ID" => "comm",
                    "DATA-TABLE-COL1-WIDTH" => "",
                    "DATA-TABLE-COL2-WIDTH" => "100%",
                    "DATA-TABLE-LABEL-ALIGN-H" => "l-align",
                    "DATA-TABLE-LABEL-ALIGN-V" => "c-valign",
                    "DATA-TABLE-WIDTH" => "100%",
                    "DEFAULT_INPUT_SIZE" => "30",
                    "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
                    "EFBF_FORM_WIDTH" => "100%",
                    "ELEMENT_ASSOC" => "CREATED_BY",
                    "EMAIL_TO" => "230267@bk.ru",
                    "ERROR_MESSAGES_POSITION" => "UNDER",
                    "EVENT_MESSAGE_ID" => array(
                    ),
                    "FIELD_ERRMSG" => "N",
                    "FIELD_ERROR_POSITION" => "Y",
                    "FIELD_ORDER" => "Y",
                    "FIELD_PREDEF" => "N",
                    "FIELD_SELF_NAMES" => "Y",
                    "FIELD_VALID" => "Y",
                    "FORM_CODE" => "",
                    "FORM_NAME" => "Оставить отзыв о враче",
                    "GROUPS" => array(
                        0 => "2",
                    ),
                    "IBLOCK_ELEMENT_ID" => "",
                    "IBLOCK_ID" => "43",
                    "IBLOCK_TYPE" => "comments",
                    "INPUT_AS_PASSWORD" => "",
                    "INPUT_AS_PASSWORD_CONFIRM" => "N",
                    "MAX_FILE_SIZE" => "0",
                    "MAX_LEVELS" => "100000",
                    "NEED_JQUERY" => "ORION_JQUERY",
                    "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
                    "PROPERTY_CODES" => array(
                        0 => "NAME",
                        1 => "PREVIEW_TEXT",
                        2 => "PROP_CD",
                        3 => "PROP_MED_CARD_NUMB",
                        4 => "PROP_PSPP",
                        5 => "PROP_OPDP",
                        6 => "PROP_PHONE",
                        7 => "PROP_EMAIL",
                    ),
                    "PROPERTY_CODES_REQUIRED" => array(
                        0 => "NAME",
                        1 => "PREVIEW_TEXT",
                        2 => "PROP_CD",
                        3 => "PROP_MED_CARD_NUMB",
                        4 => "PROP_PSPP",
                        5 => "PROP_OPDP",
                        6 => "PROP_PHONE",
                        7 => "PROP_EMAIL",
                    ),
                    "RESIZE_IMAGES" => "N",
                    "SAVE_TO_IB" => "Y",
                    "SEND_MESSAGE" => "Y",
                    "USER_MESSAGE_ADD" => "",
                    "USER_SEND_MESSAGE" => "N",
                    "USE_CAPTCHA" => "Y",
                    "USE_CAPTCHA_REFRESH" => "Y",
                    "USE_TEXT_FOR_HTML" => array(
                    ),
                    "COMPONENT_TEMPLATE" => "comments",
                    "LIST_NOT_ESTABLISHED_PROP_PSP" => "Y",
                    "CUSTOM_TITLE_NAME" => "ФИО",
                    "CUSTOM_TITLE_TAGS" => "",
                    "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
                    "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
                    "CUSTOM_TITLE_IBLOCK_SECTION" => "",
                    "CUSTOM_TITLE_PREVIEW_TEXT" => "Сообщение (Текст отзыва)",
                    "CUSTOM_TITLE_PREVIEW_PICTURE" => "Сообщение",
                    "CUSTOM_TITLE_DETAIL_TEXT" => "",
                    "CUSTOM_TITLE_DETAIL_PICTURE" => "",
                    "CUSTOM_TITLE_PROP_CD" => "",
                    "CUSTOM_TITLE_PROP_MED_CARD_NUMB" => "Номер медицинской карты",
                    "CUSTOM_TITLE_PROP_PSP" => " Подтверждение согласия на публикацию",
                    "CUSTOM_TITLE_PROP_OPD" => "Согласие на обработку персональных данных",
                    "CUSTOM_TITLE_PROP_MASSAGE" => "",
                    "CUSTOM_TITLE_PROP_PHONE" => "Телефон",
                    "CUSTOM_TITLE_PROP_EMAIL" => "Электронная почта",
                    "CUSTOM_TITLE_CAPTCHA" => "Каптча",
                    "CUSTOM_TITLE_CAPTCHA_INPUT" => "Строка ввода кода каптчи",
                    "LIST_NOT_ESTABLISHED_PROP_OPD" => "Y",
                    "ORDER_NAME" => "10",
                    "ORDER_TAGS" => "500",
                    "ORDER_DATE_ACTIVE_FROM" => "500",
                    "ORDER_DATE_ACTIVE_TO" => "500",
                    "ORDER_IBLOCK_SECTION" => "500",
                    "ORDER_PREVIEW_TEXT" => "100",
                    "ORDER_PREVIEW_PICTURE" => "500",
                    "ORDER_DETAIL_TEXT" => "500",
                    "ORDER_DETAIL_PICTURE" => "500",
                    "ORDER_PROP_CD" => "500",
                    "ORDER_PROP_MED_CARD_NUMB" => "20",
                    "ORDER_PROP_PSP" => "200",
                    "ORDER_PROP_OPD" => "500",
                    "ORDER_PROP_MASSAGE" => "500",
                    "ORDER_PROP_PHONE" => "70",
                    "ORDER_PROP_EMAIL" => "59",
                    "LIST_NOT_ESTABLISHED_PROP_" => "Y",
                    "CUSTOM_TITLE_PROP_" => "",
                    "ORDER_PROP_" => "500",
                    "LIST_NOT_ESTABLISHED_PROP_PSPP" => "Y",
                    "LIST_NOT_ESTABLISHED_PROP_OPDP" => "Y",
                    "CUSTOM_TITLE_PROP_PSPP" => "",
                    "CUSTOM_TITLE_PROP_OPDP" => "",
                    "ORDER_PROP_PSPP" => "500",
                    "ORDER_PROP_OPDP" => "500",
                    "VALID_NAME" => "",
                    "VALID_TAGS" => "",
                    "VALID_DATE_ACTIVE_FROM" => "",
                    "VALID_DATE_ACTIVE_TO" => "",
                    "VALID_IBLOCK_SECTION" => "",
                    "VALID_PREVIEW_TEXT" => "",
                    "VALID_PREVIEW_PICTURE" => "",
                    "VALID_DETAIL_TEXT" => "",
                    "VALID_DETAIL_PICTURE" => "",
                    "VALID_PROP_CD" => "",
                    "VALID_PROP_MED_CARD_NUMB" => "",
                    "VALID_PROP_PHONE" => "",
                    "VALID_PROP_EMAIL" => "",
                    "REDIRECT_URL" => "https://www.medicina.devvr.buroburo.ru/spasibo-za-soobshchenie-o-zapisi-na-priyem/"
                ),
                false
            );?>
            
          </div>
        </div>