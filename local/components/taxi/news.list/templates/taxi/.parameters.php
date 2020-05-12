<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(//API_Key
    "CLIENT_ID"=>array(
        "PARENT" => "BASE",
        "TYPE" => "STRING",
        "DEFAULT" => "",
        "NAME" =>"ID клиента"
    ),
    "API_KEY"=>array(
        "PARENT" => "BASE",
        "TYPE" => "STRING",
        "DEFAULT" => "",
        "NAME" =>"Ключ к АПИ"
    ),
    "API_LIST_URL"=>array(
        "PARENT" => "BASE",
        "TYPE" => "STRING",
        "DEFAULT" => "",
        "NAME" =>"УРЛ АПИ список и по ID водителя"
    ),
    "API_TRANSACTIONS_URL"=>array(
        "PARENT" => "BASE",
        "TYPE" => "STRING",
        "DEFAULT" => "",
        "NAME" =>"УРЛ АПИ транзакции"
    ),
    "EMAIL_TO"=>array(
        "PARENT" => "BASE",
        "TYPE" => "STRING",
        "DEFAULT" => "",
        "NAME" =>"Email куда отправлять документы"
    ),
    "DRIVER_ID"=>array(
        "PARENT" => "BASE",
        "TYPE" => "STRING",
        "DEFAULT" => "",
        "NAME" =>"ID водителя"
    ),


    "DISPLAY_DATE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_NAME" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PICTURE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PREVIEW_TEXT" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
);
?>
