<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?php
ob_start();
global $elemId;

if ($_REQUEST['act'] = 'update' && $_REQUEST['id']) {

    $elemId = $_REQUEST['id'];
}
?>

<?
$APPLICATION->IncludeComponent(
    "taxi:ext.feedback.form",
    "taxi",
    array(
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "COMPONENT_ID" => "",
        "COMPONENT_TEMPLATE" => "taxi",
        "CUSTOM_TITLE_CAPTCHA" => "",
        "CUSTOM_TITLE_CAPTCHA_INPUT" => "",
        "CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
        "CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
        "CUSTOM_TITLE_DETAIL_PICTURE" => "",
        "CUSTOM_TITLE_DETAIL_TEXT" => "",
        "CUSTOM_TITLE_IBLOCK_SECTION" => "",
        "CUSTOM_TITLE_NAME" => "ФИО",
        "CUSTOM_TITLE_PREVIEW_PICTURE" => "",
        "CUSTOM_TITLE_PREVIEW_TEXT" => "",
        "CUSTOM_TITLE_PROP_DRIVER_DATE_AGREE" => "Дата подписания",
        "CUSTOM_TITLE_PROP_DRIVER_ID" => "ID п.п",
        "CUSTOM_TITLE_PROP_DRIVER_PHONES" => "Телефон",
        "CUSTOM_TITLE_PROP_DRIVER_YT" => "ID яндекс",
        "CUSTOM_TITLE_TAGS" => "",
        "DATA-TABLE-COL1-WIDTH" => "40%",
        "DATA-TABLE-COL2-WIDTH" => "60%",
        "DATA-TABLE-LABEL-ALIGN-H" => "l-align",
        "DATA-TABLE-LABEL-ALIGN-V" => "c-valign",
        "DATA-TABLE-WIDTH" => "100%",
        "DEFAULT_INPUT_SIZE" => "30",
        "DETAIL_TEXT_USE_HTML_EDITOR" => "N",
        "EFBF_FORM_WIDTH" => "",
        "ELEMENT_ASSOC" => "CREATED_BY",
        "ERROR_MESSAGES_POSITION" => "UNDER",
        "FIELD_ERRMSG" => "N",
        "FIELD_ERROR_POSITION" => "Y",
        "FIELD_ORDER" => "Y",
        "FIELD_PREDEF" => "N",
        "FIELD_SELF_NAMES" => "N",
        "FIELD_VALID" => "N",
        "FILES_MIN_CNT_PROP_DS_FILES" => "5",
        "FILES_MIN_CNT_PROP_S_FILES" => "5",
        "FORM_CODE" => "",
        "FORM_NAME" => "",
        "GROUPS" => array(
        ),
        "IBLOCK_ELEMENT_ID" => $elemId,
        "IBLOCK_ID" => "26",
        "IBLOCK_TYPE" => "taxi",
        "INPUT_AS_PASSWORD" => "",
        "INPUT_AS_PASSWORD_CONFIRM" => "Y",
        "LIST_NOT_ESTABLISHED_PROP_SEL" => "Y",
        "MAX_FILE_SIZE" => "0",
        "MAX_LEVELS" => "100000",
        "NEED_JQUERY" => "CAB_JQUERY",
        "ORDER_DATE_ACTIVE_FROM" => "500",
        "ORDER_DATE_ACTIVE_TO" => "500",
        "ORDER_DETAIL_PICTURE" => "500",
        "ORDER_DETAIL_TEXT" => "500",
        "ORDER_IBLOCK_SECTION" => "500",
        "ORDER_NAME" => "5",
        "ORDER_PREVIEW_PICTURE" => "500",
        "ORDER_PREVIEW_TEXT" => "500",
        "ORDER_PROP_DRIVER_BALANCE" => "500",
        "ORDER_PROP_DRIVER_BANK" => "70",
        "ORDER_PROP_DRIVER_BANK_BIK" => "60",
        "ORDER_PROP_DRIVER_DATE_AGREE" => "10",
        "ORDER_PROP_DRIVER_ID" => "500",
        "ORDER_PROP_DRIVER_KOR_SCHET" => "80",
        "ORDER_PROP_DRIVER_PAYMENT_ACCOUNT" => "50",
        "ORDER_PROP_DRIVER_PHONES" => "7",
        "ORDER_PROP_DRIVER_YT" => "500",
        "ORDER_PROP_FIRST_NAME_PAYEE" => "30",
        "ORDER_PROP_FILE_AGREE_URL" => "90",
        "ORDER_PROP_ID_ELEMENT" => "500",
        "ORDER_PROP_LAST_NAME_PAYEE" => "20",
        "ORDER_PROP_MIDDLE_NAME_PAYEE" => "40",
        "ORDER_PROP_PAYEE" => "500",
        "ORDER_TAGS" => "500",
        "PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
        "PROPERTY_CODES" => array(
            0 => "NAME",
            1 => "PROP_DRIVER_DATE_AGREE",
            2 => "PROP_LAST_NAME_PAYEE",
            3 => "PROP_FIRST_NAME_PAYEE",
            4 => "PROP_MIDDLE_NAME_PAYEE",
            5 => "PROP_DRIVER_PAYMENT_ACCOUNT",
            6 => "PROP_DRIVER_BANK_BIK",
            7 => "PROP_DRIVER_BANK",
            8 => "PROP_DRIVER_KOR_SCHET",
            9 => "PROP_ID_ELEMENT",
            10 => "PROP_DRIVER_PHONES",
            11 =>'PROP_FILE_AGREE_URL'
        ),
        "PROPERTY_CODES_REQUIRED" => array(),
        "REDIRECT_URL" => "/taxi/",
        "RESIZE_IMAGES" => "N",
        "SAVE_TO_IB" => "Y",
        "SEND_MESSAGE" => "N",
        "USER_MESSAGE_ADD" => "",
        "USER_SEND_MESSAGE" => "N",
        "USE_CAPTCHA" => "N",
        "USE_CAPTCHA_REFRESH" => "Y",
        "USE_TEXT_FOR_HTML" => array(
        )
    ),
    false
);?>
<?php
$html = ob_get_contents();
ob_end_clean();

$res = array(
    'html' => $html,

);
//echo \Bitrix\Main\Web\Json::encode($res);
die();