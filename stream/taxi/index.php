<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Такси");

?>
<?/*
$arEventFields = array(
    "ID"                  => $CONTRACT_ID,
    "MESSAGE"             => $mess,
    "EMAIL_TO"            => implode(",", $EMAIL_TO),
    "ADMIN_EMAIL"         => implode(",", $ADMIN_EMAIL),
    "ADD_EMAIL"           => implode(",", $ADD_EMAIL),
    "STAT_EMAIL"          => implode(",", $VIEW_EMAIL),
    "EDIT_EMAIL"          => implode(",", $EDIT_EMAIL),
    "OWNER_EMAIL"         => implode(",", $OWNER_EMAIL),
    "BCC"                 => implode(",", $BCC),
    "INDICATOR"           => GetMessage("AD_".strtoupper($arContract["LAMP"]."_CONTRACT_STATUS")),
    "ACTIVE"              => $arContract["ACTIVE"],
    "NAME"                => $arContract["NAME"],
    "DESCRIPTION"         => $description,
    "MAX_SHOW_COUNT"      => $arContract["MAX_SHOW_COUNT"],
    "SHOW_COUNT"          => $arContract["SHOW_COUNT"],
    "MAX_CLICK_COUNT"     => $arContract["MAX_CLICK_COUNT"],
    "CLICK_COUNT"         => $arContract["CLICK_COUNT"],
    "BANNERS"             => $arContract["BANNER_COUNT"],
    "DATE_SHOW_FROM"      => $arContract["DATE_SHOW_FROM"],
    "DATE_SHOW_TO"        => $arContract["DATE_SHOW_TO"],
    "DATE_CREATE"         => $arContract["DATE_CREATE"],
    "CREATED_BY"          => $CREATED_BY,
    "DATE_MODIFY"         => $arContract["DATE_MODIFY"],
    "MODIFIED_BY"         => $MODIFIED_BY
);
$arrSITE =  CAdvContract::GetSiteArray($CONTRACT_ID);
CEvent::Send("ADV_CONTRACT_INFO", $arrSITE, $arEventFields);
*/?>


<?$APPLICATION->IncludeComponent(
    "taxi:news.list",
    "taxi",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "Y",
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
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array("",""),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "17",
        "IBLOCK_TYPE" => "taxi",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "9999",
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
        "PROPERTY_CODE" => array("DRIVER_ID","DRIVER_YT","DRIVER_DATE_AGREE","FIRST_NAME_PAYEE","MIDDLE_NAME_PAYEE","PAYEE","DRIVER_PHONES","LAST_NAME_PAYEE",""),
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "SHOW_404" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>