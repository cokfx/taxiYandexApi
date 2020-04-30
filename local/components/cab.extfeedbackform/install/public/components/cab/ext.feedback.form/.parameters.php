<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule('cab.extfeedbackform') || !CModule::IncludeModule("iblock"))
	return;
	
$arIBlockType = CIBlockParameters::GetIBlockTypes();	

if($arCurrentValues["IBLOCK_ID"] > 0)
{
	$arIBlock = CIBlock::GetArrayByID($arCurrentValues["IBLOCK_ID"]);
}

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arFieldsAsPassword = array('' => GetMessage('CP_NOT_SEL_VALUE'));
$arHtmlFieldsAsText = array();

$arProperty_LNSF = array(
	"NAME" => GetMessage("IBLOCK_ADD_NAME"),
	"TAGS" => GetMessage("IBLOCK_ADD_TAGS"),
	"DATE_ACTIVE_FROM" => GetMessage("IBLOCK_ADD_ACTIVE_FROM"),
	"DATE_ACTIVE_TO" => GetMessage("IBLOCK_ADD_ACTIVE_TO"),
	"IBLOCK_SECTION" => GetMessage("IBLOCK_ADD_IBLOCK_SECTION"),
	"PREVIEW_TEXT" => GetMessage("IBLOCK_ADD_PREVIEW_TEXT"),
	"PREVIEW_PICTURE" => GetMessage("IBLOCK_ADD_PREVIEW_PICTURE"),
	"DETAIL_TEXT" => GetMessage("IBLOCK_ADD_DETAIL_TEXT"),
	"DETAIL_PICTURE" => GetMessage("IBLOCK_ADD_DETAIL_PICTURE"),
);

foreach($arProperty_LNSF as $key => $value){
	$arPropertyData[$key] = array(
		'PROPERTY_TYPE' => 'S',
	);
}

$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
while ($arr=$rsProp->Fetch())
{
	$prop_key = 'PROP_'.$arr["CODE"]; 
	
	if($arr['PROPERTY_TYPE'] == 'S' && $arr['USER_TYPE'] == 'UserID') $arProperty[$prop_key] = "[".$arr["CODE"]."] ".$arr["NAME"];
	
	if (in_array($arr["PROPERTY_TYPE"], array("E","G","L", "N", "S", "F")))
	{		
		$arProperty_LNSF[$prop_key] = "[".$arr["CODE"]."] ".$arr["NAME"];
		if($arr["PROPERTY_TYPE"] == 'S' && $arr['MULTIPLE'] == 'N' && $arr['USER_TYPE'] == '') $arFieldsAsPassword[$prop_key] = $arProperty_LNSF[$prop_key];
		if($arr['USER_TYPE'] == 'HTML') $arHtmlFieldsAsText[$prop_key] = $arProperty_LNSF[$prop_key];
		
		//���������� ��� � ��������
		$arPropertyData[$prop_key] = $arr;
		switch($arr["PROPERTY_TYPE"]){
			case 'L':
				$rsPropertyEnum = CIBlockProperty::GetPropertyEnum($arr["ID"], Array('sort' => 'asc', 'value' => 'asc'));
				$arPropertyData[$prop_key]['ENUM'] = array('' => GetMessage('CP_NOT_SEL_VALUE'));
				while ($arPropertyEnum = $rsPropertyEnum->GetNext())
				{
					$arPropertyData[$prop_key]["ENUM"][$arPropertyEnum["ID"]] = $arPropertyEnum['VALUE'];
				}
			
				break;
			default:	
		}		
	}
}

$arGroups = array();
$rsGroups = CGroup::GetList($by="c_sort", $order="asc", Array("ACTIVE" => "Y"));
while ($arGroup = $rsGroups->Fetch())
{
	$arGroups[$arGroup["ID"]] = $arGroup["NAME"];
}

$arUserLink = array("CREATED_BY" => GetMessage("IBLOCK_CREATED_BY"), "PROPERTY_ID" => GetMessage("IBLOCK_PROPERTY_ID"));


$arComponentParameters = array(
	"GROUPS" => array(
		"MESSAGE" => array(
			"NAME" => GetMessage("IBLOCK_MESSAGE"),
			"SORT" => "100",
		),	
		"USER_MESSAGE" => array(
			"NAME" => GetMessage("IBLOCK_USER_MESSAGE"),
			"SORT" => "100",
		),	
		"PARAMS" => array(
			"NAME" => GetMessage("IBLOCK_PARAMS"),
			"SORT" => "200"
		),
		"PARAMS_FILES" => array(
			"NAME" => GetMessage("IBLOCK_PARAMS_FILES"),
			"SORT" => "210"
		),
		"PARAMS_LIST" => array(
			"NAME" => GetMessage("IBLOCK_PARAMS_LIST"),
			"SORT" => "220"
		),
		"PARAMS_PASSW" => array(
			"NAME" => GetMessage("IBLOCK_PARAMS_PASSW"),
			"SORT" => "230"
		),
		"PARAMS_CAPCHA" => array(
			"NAME" => GetMessage("IBLOCK_PARAMS_CAPCHA"),
			"SORT" => "240"
		),
		"ACCESS" => array(
			"NAME" => GetMessage("IBLOCK_ACCESS"),
			"SORT" => "400",
		),
		"FIELDS" => array(
			"NAME" => GetMessage("IBLOCK_FIELDS"),
			"SORT" => "300",
		),
		"TITLES" => array(
			"NAME" => GetMessage("IBLOCK_TITLES"),
			"SORT" => "1000",			
		),
		"ORDER" => array(
			"NAME" => GetMessage("IBLOCK_ORDER"),
			"SORT" => "1010",
		),
		"VALID" => array(
			"NAME" => GetMessage("IBLOCK_VALIDATOR"),
			"SORT" => "1020",
		),
		"ERRMESSAGES" => array(
			"NAME" => GetMessage("IBLOCK_ERR_MESSAGES"),
			"SORT" => "1025",
		),
		"PREDEFINED" => array(
			"NAME" => GetMessage("IBLOCK_PREDEFINED"),
			"SORT" => "1030",
		),
		"JQUERY" => array(
			"NAME" => GetMessage("CP_EFBF_APPLY_JQUERY"),
			"SORT" => "3000",
		),
		"TEMPLTE" => array(
			"NAME" => GetMessage("CP_EFBF_TEMPLTE"),
			"SORT" => "4000",
		),
	),

	"PARAMETERS" => array(
		"AJAX_MODE" => Array(),
		
		"FORM_NAME" => array(
			"NAME" => GetMessage("CP_EFBF_FORM_NAME"), 
			"TYPE" => "STRING",
			"DEFAULT" => GetMessage("CP_EFBF_FORM_NAME_DEF"), 
			"PARENT" => "TEMPLTE",
		),
		
		"IBLOCK_TYPE" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),

		"IBLOCK_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_IBLOCK"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),

		"IBLOCK_ELEMENT_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("IBLOCK_IBLOCK_ELEMENT_ID"),
			"TYPE" => "STRING",
		),

		"PROPERTY_CODES" => array(
			"PARENT" => "FIELDS",
			"NAME" => GetMessage("IBLOCK_PROPERTY"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_LNSF,
		),

		"PROPERTY_CODES_REQUIRED" => array(
			"PARENT" => "FIELDS",
			"NAME" => GetMessage("IBLOCK_PROPERTY_REQUIRED"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arProperty_LNSF,
		),

		"GROUPS" => array(
			"PARENT" => "ACCESS",
			"NAME" => GetMessage("IBLOCK_GROUPS"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arGroups,
		),
		"ELEMENT_ASSOC" => array(
			"PARENT" => "ACCESS",
			"NAME" => GetMessage("IBLOCK_ELEMENT_ASSOC"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arUserLink,
			"REFRESH" => "Y",
			"DEFAULT" => "CREATED_BY",
		),		
		
		"SEND_MESSAGE" => Array(
			"PARENT" => "MESSAGE",
			"NAME" => GetMessage("T_SEND_MESSAGE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		
		"USER_SEND_MESSAGE" => Array(
			"PARENT" => "USER_MESSAGE",
			"NAME" => GetMessage("T_USER_SEND_MESSAGE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		
		"FIELD_SELF_NAMES" => Array(
			"PARENT" => "TITLES",
			"NAME" => GetMessage("T_FIELD_SELF_NAMES"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		
		"FIELD_ORDER" => Array(
			"PARENT" => "ORDER",
			"NAME" => GetMessage("T_FIELD_ORDER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		
		"FIELD_VALID" => Array(
			"PARENT" => "VALID",
			"NAME" => GetMessage("T_FIELD_VALID"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		
		"FIELD_ERRMSG" => Array(
			"PARENT" => "ERRMESSAGES",
			"NAME" => GetMessage("T_FIELD_ERRMSG"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		
		"FIELD_PREDEF" => Array(
			"PARENT" => "PREDEFINED",
			"NAME" => GetMessage("T_FIELD_PREDEF"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y",
		),
		
	),
);

$arComponentParameters['PARAMETERS'] = array_merge($arComponentParameters['PARAMETERS'], CCabExFeedbackForm::GetEFBFParameters($arCurrentValues, $arProperty_LNSF, $arPropertyData, $arFieldsAsPassword, $arHtmlFieldsAsText, $arProperty));
?>