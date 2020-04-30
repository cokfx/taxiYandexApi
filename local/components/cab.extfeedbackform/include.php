<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/cab.extfeedbackform/prolog.php");

global $DBType;
IncludeModuleLangFile(__FILE__);

CModule::AddAutoloadClasses(
	'cab.extfeedbackform',
	array(
		'CEFBF_Forms' => 'classes/'.$DBType."/CEFBF_Forms.php",
		'CEFBF_Stat' => 'classes/'.$DBType."/CEFBF_Stat.php",
	)
);

Class CCabExFeedbackForm
{
	var $arEventsCheckFields;
	var $LAST_ERROR = '';	
	
	function OnFormSubmit($FormCode = '', $bWriteToIB = true, $bSendMessage = true, $bUserSendMessage = true, $arWriteToIBParams = array(), $arSendMessageParams = array(), $arUser = array()){	
		global $DB;

		/***************** Event OnBeforeFormProcess *******************/
		$arEventParams = array(
			'FORM_CODE' => $FormCode,
			'USER' => $arUser,
			'WRITE_TO_IB' => $bWriteToIB,
			'SEND_MESSAGE' => $bSendMessage,
			'USER_SEND_MESSAGE' => $bUserSendMessage,
			'WRITE_TO_IB_PARAMS' => $arWriteToIBParams,
			'SEND_MESSAGE_PARAMS' => $arSendMessageParams,
			'ERROR' => false,
			'ERROR_MSG' => '',
		);

		$events = GetModuleEvents("cab.extfeedbackform", "OnBeforeFormProcess");
		while ($arEvent = $events->Fetch())
		{
			$arEventParams = ExecuteModuleEventEx($arEvent, array($arEventParams));
			$this->LAST_ERROR = $arEventParams['ERROR_MSG'];
			if($arEventParams['ERROR']) return false;
		}
		/***************** /Event ******************************************/		
		$element_id = '';
		$arWriteToIBParams = $arEventParams['WRITE_TO_IB_PARAMS'];
		$arSendMessageParams = $arEventParams['SEND_MESSAGE_PARAMS'];
		$action = ($arWriteToIBParams['RESULT']['IBLOCK_ELEMENT_ID']) ? 'edit' : 'add';
		
		if($arEventParams['WRITE_TO_IB'])
		{
			//write to infoblock
			$oElement = new CIBlockElement();
			if($action == 'add')
			{
				if(!$element_id = $oElement->Add($arWriteToIBParams['VALUES'], false, true, $arWriteToIBParams['PARAMS']["RESIZE_IMAGES"]))
				{
					$this->LAST_ERROR = $oElement->LAST_ERROR;
					return false;
				}			
				
				$arWriteToIBParams['RESULT']['IBLOCK_ELEMENT_ID'] = $element_id;
			}
			else
			{
				$flds = $arWriteToIBParams['VALUES'];
				$element_id = $arWriteToIBParams['RESULT']['IBLOCK_ELEMENT_ID'];

				if(!$oElement->Update($element_id, $flds, false, true, $arWriteToIBParams['PARAMS']["RESIZE_IMAGES"]))
				{
					$this->LAST_ERROR = $oElement->LAST_ERROR; echo $this->LAST_ERROR;
					return false;					
				}
			}
		}

		//write statistic if 'add' action
		if($action == 'add'){
			$arFields = array(
				'DT' => $DB->GetNowFunction(),
				'USERID' => intval($arEventParams['USER']['ID']),
				'FORM_CODE' => "'".$DB->ForSql($FormCode)."'",
				'ELEMENT_ID' => intval($element_id),
				'SEND_MSG' => ($arEventParams['SEND_MESSAGE']) ? 1: 0,
			);
			$DB->Insert("cab_efbf_messages",$arFields, $err_mess.__LINE__);
		}
		
		if($arEventParams['SEND_MESSAGE'])
		{
			/***************** Event OnBeforeSendMessage *******************/
			$arEventParams['WRITE_TO_IB_PARAMS'] = $arWriteToIBParams;
			$arEventParams['SEND_MESSAGE_PARAMS'] = $arSendMessageParams;
			
			$events = GetModuleEvents("cab.extfeedbackform", "OnBeforeSendMessage");
			while ($arEvent = $events->Fetch())
			{
				$arEventParams = ExecuteModuleEventEx($arEvent, array($arEventParams));
				$this->LAST_ERROR = $arEventParams['ERROR_MSG'];
				if($arEventParams['ERROR']) return false;
			}
			$arWriteToIBParams = $arEventParams['WRITE_TO_IB_PARAMS'];
			$arSendMessageParams = $arEventParams['SEND_MESSAGE_PARAMS'];			
			/***************** /Event ******************************************/
			
			$arParams = $arSendMessageParams['PARAMS'];
			$arFields = $arSendMessageParams['VALUES'];			
			$arFields['IBLOCK_ELEMENT_ID'] = $element_id;
			
			$arEmailTo = explode(',', $arFields['EMAIL_TO']);
			
			foreach($arEmailTo as $email){
				$arFields['EMAIL_TO'] = trim($email);

				//send email
				if(!empty($arParams["EVENT_MESSAGE_ID"]))
				{
					foreach($arParams["EVENT_MESSAGE_ID"] as $v)
						if(IntVal($v) > 0)
							CEvent::Send($arParams["EVENT_NAME"], $arParams['SITE_ID'], $arFields, "N", IntVal($v));
				}
				else
					CEvent::Send($arParams["EVENT_NAME"], $arParams['SITE_ID'], $arFields);
			}	
		}
		
		if($arEventParams['USER_SEND_MESSAGE'])
		{
			/***************** Event OnBeforeUserSendMessage *******************/
			$arEventParams['WRITE_TO_IB_PARAMS'] = $arWriteToIBParams;
			$arEventParams['SEND_MESSAGE_PARAMS'] = $arSendMessageParams;
			
			$events = GetModuleEvents("cab.extfeedbackform", "OnBeforeUserSendMessage");
			while ($arEvent = $events->Fetch())
			{
				$arEventParams = ExecuteModuleEventEx($arEvent, array($arEventParams));
				$this->LAST_ERROR = $arEventParams['ERROR_MSG'];
				if($arEventParams['ERROR']) return false;
			}
			$arWriteToIBParams = $arEventParams['WRITE_TO_IB_PARAMS'];
			$arSendMessageParams = $arEventParams['SEND_MESSAGE_PARAMS'];			
			/***************** /Event ******************************************/				
		
			$arParams = $arSendMessageParams['PARAMS'];
			$arFields = $arSendMessageParams['VALUES'];			
			$arFields['IBLOCK_ELEMENT_ID'] = $element_id;
			
			//send email
			if(!empty($arParams["USER_EVENT_MESSAGE_ID"]))
			{
				foreach($arParams["USER_EVENT_MESSAGE_ID"] as $v)
					if(IntVal($v) > 0)
						CEvent::Send($arParams["USER_EVENT_NAME"], $arParams['SITE_ID'], $arFields, "N", IntVal($v));
			}
			else
				CEvent::Send($arParams["USER_EVENT_NAME"], $arParams['SITE_ID'], $arFields);
		}
		
		/***************** Event OnAfterFormProcess *******************/
		$arEventParams['WRITE_TO_IB_PARAMS'] = $arWriteToIBParams;
		$arEventParams['SEND_MESSAGE_PARAMS'] = $arSendMessageParams;
		
		$events = GetModuleEvents("cab.extfeedbackform", "OnAfterFormProcess");
		while ($arEvent = $events->Fetch())
		{
			$arEventParams = ExecuteModuleEventEx($arEvent, array($arEventParams));
			$this->LAST_ERROR = $arEventParams['ERROR_MSG'];
			if($arEventParams['ERROR']) return false;
		}
		/***************** /Event ******************************************/		
		
		return true;
	}
	
	//correct user input check events
	function OnFormFieldCheck($arEventParams)
	{
		if(!$this->arEventsCheckFields){
			$res = GetModuleEvents("cab.extfeedbackform", "OnFormFieldCheck");
			while ($arEvent = $res->Fetch()) $this->arEventsCheckFields[] = $arEvent;
		}
		
		foreach ($this->arEventsCheckFields as $arEvent)
		{
			$arEventParams = ExecuteModuleEventEx($arEvent, array($arEventParams));
			if($arEventParams['ERROR']) return $arEventParams;
		}
		
		return $arEventParams;
	}

	function OnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
	{				
		$MODULE_ID = basename(dirname(__FILE__));
		
		$arSubItems = array(
			'text' => GetMessage('efbf_group'),
			'url' => $MODULE_ID.'_efbf_index.php',
			'more_url' => array(
			),
			'module_id' => $MODULE_ID,
			"title" => "",
			"items_id" => "cab_soft_efbf_group",
			"icon" => 'efbf_menu_icon',
			"items" => array(
				array(
					'text' => GetMessage('efbf_form'),
					'url' => $MODULE_ID.'_efbf_forms.php',
					'more_url' => array(
						$MODULE_ID.'_efbf_forms_edit.php',
					),
					'module_id' => $MODULE_ID,
					"title" => "",
					"items_id" => "cab_soft_efbf_form",
					"icon" => 'efbf_forms_menu_icon',
					"page_icon" => 'efbf_forms_page_icon',
				),				
				array(
					'text' => GetMessage('efbf_stat'),
					'url' => $MODULE_ID.'_efbf_stat.php',
					'more_url' => array(
					),
					'module_id' => $MODULE_ID,
					"title" => "",
					"items_id" => "cab_soft_efbf_stat",
					"icon" => 'efbf_stat_menu_icon',
					"page_icon" => 'efbf_stat_page_icon',
				),				
			),
		);
		
		$arCabSoftMenu = array();
		//����� �������� ���� ����� ����
		foreach($aModuleMenu as &$item){
			if($item['items_id'] == 'cab_soft_menu' && $item['parent_menu'] = 'global_menu_services'){
				$arCabSoftMenu = $item;
				break;
			}
		}
		unset($item);
		
		if(!$arCabSoftMenu){
			//���� �� �����, �� ���������
			$arCabSoftMenu = array(
				'parent_menu' => 'global_menu_services',
				'text' => GetMessage('efbf_company'),
				'url' => '',//$MODULE_ID.'_efbf_index.php', //$MODULE_ID.'_company.php',
				'more_url' => array(
				),
				'module_id' => $MODULE_ID,
				"title" => "",
				"items_id" => "cab_soft_menu",
				"icon" => 'cab_soft_menu_icon',
				"items" => array($arSubItems),
			);
		
			$aModuleMenu[] = $arCabSoftMenu;
		}else{
			//���� �����, �� ��������� ������ �������� 2-�� ������
			$arCabSoftMenu['items'][] = $arSubItems;
		}		

		//������������� url cab_soft_menu �� ������ ������� � ������
		foreach($aModuleMenu as &$item){
			if($item['items_id'] == 'cab_soft_menu'){
				$item = $arCabSoftMenu;
				$item['url'] = $arCabSoftMenu['items'][0]['url'];
				break;
			}
		}
		unset($item);
	}
	
	function GetEFBFParameters($arCurrentValues, $arProperty_LNSF, $arPropertyData, $arFieldsAsPassword, $arHtmlFieldsAsText, $arProperty){
		$arFieldsAsEmail = $arFieldsAsPassword;
		$arVirtualProperties = $arProperty_LNSF;
	
		$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));

		//message events
		$arFilter = Array("TYPE_ID" => "CAB_EXT_FEEDBACK_FORM_EVENT", "ACTIVE" => "Y");
		if($site !== false) $arFilter["LID"] = $site;
			
		$arEvent = Array();
		$dbType = CEventMessage::GetList($by="ID", $order="DESC", $arFilter);
		while($arType = $dbType->GetNext())
			$arEvent[$arType["ID"]] = "[".$arType["ID"]."] ".$arType["SUBJECT"];
			
		//message to user events
		$arFilter = Array("TYPE_ID" => "CAB_EXT_FEEDBACK_FORM_EVENT_TO_USER", "ACTIVE" => "Y");
		if($site !== false) $arFilter["LID"] = $site;
			
		$arEventUser = Array();
		$dbType = CEventMessage::GetList($by="ID", $order="DESC", $arFilter);
		while($arType = $dbType->GetNext())
			$arEventUser[$arType["ID"]] = "[".$arType["ID"]."] ".$arType["SUBJECT"];

		//form codes	
		$arFormCodes = array('' => GetMessage('CP_NOT_SEL_VALUE'));
		$res = CEFBF_Forms::GetList(array('NAME' => 'ASC'), array());
		while($ar = $res->Fetch()){
			$arFormCodes[$ar['CODE']] = '['.$ar['CODE'].'] '.$ar['NAME'];
		}
	
		if ($arCurrentValues["SEND_MESSAGE"] == "Y"){
			$arParameters["EMAIL_TO"] = array(
				"NAME" => GetMessage("P_EMAIL_TO"), 
				"TYPE" => "STRING",
				"DEFAULT" => htmlspecialchars(COption::GetOptionString("main", "email_from")), 
				"PARENT" => "MESSAGE",
			);
			
			$arParameters["EVENT_MESSAGE_ID"] = array(
				"NAME" => GetMessage("P_EMAIL_TEMPLATES"), 
				"TYPE"=>"LIST", 
				"VALUES" => $arEvent,
				"DEFAULT"=>"", 
				"MULTIPLE"=>"Y", 
				"COLS"=>25, 
				"PARENT" => "MESSAGE",
			);
		}

		if ($arCurrentValues["USER_SEND_MESSAGE"] == "Y"){
			$arParameters["USER_EMAIL_FROM_PROP"] = array(
				"NAME" => GetMessage("P_USER_EMAIL_TO_FROM_PROP"), 
				"TYPE" => "LIST",
				"VALUES" => $arFieldsAsEmail,
				"PARENT" => "USER_MESSAGE",
			);
			
			$arParameters["USER_EVENT_MESSAGE_ID"] = array(
				"NAME" => GetMessage("P_USER_EMAIL_TEMPLATES"), 
				"TYPE"=>"LIST", 
				"VALUES" => $arEventUser,
				"DEFAULT"=>"", 
				"MULTIPLE"=>"Y", 
				"COLS"=>25, 
				"PARENT" => "USER_MESSAGE",
			);
		}

		if ($arCurrentValues["ELEMENT_ASSOC"] == "PROPERTY_ID")
		{
			$arParameters["ELEMENT_ASSOC_PROPERTY"] = array(
				"PARENT" => "ACCESS",
				"NAME" => GetMessage("IBLOCK_ELEMENT_ASSOC_PROPERTY"),
				"TYPE" => "LIST",
				"MULTIPLE" => "N",
				"VALUES" => $arProperty,
				"ADDITIONAL_VALUES" => "Y",
			);
		}

		$arParameters["MAX_LEVELS"] = array(
			"PARENT" => "ACCESS",
			"NAME" => GetMessage("IBLOCK_MAX_LEVELS"),
			"TYPE" => "TEXT",
			"DEFAULT" => "100000",
		);

		$arParameters["SAVE_TO_IB"] = array(
			"PARENT" => "PARAMS",
			"NAME" => GetMessage("CP_EFBF_SAVE_TO_IB"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => 'Y',
		);

		$arParameters["COMPONENT_ID"] = array(
			"PARENT" => "PARAMS",
			"NAME" => GetMessage("CP_EFBF_COMPONENT_ID"),
			"TYPE" => "STRING",
		);

		$arParameters["FORM_CODE"] = array(
			"PARENT" => "PARAMS",
			"NAME" => GetMessage("CP_EFBF_FORM_CODE"),
			"TYPE" => "LIST",
			"VALUES" => $arFormCodes,
		);

		$arParameters["USE_CAPTCHA"] = array(
			"PARENT" => "PARAMS_CAPCHA",
			"NAME" => GetMessage("IBLOCK_USE_CAPTCHA"),
			"TYPE" => "CHECKBOX",
		);

		$arParameters["USE_CAPTCHA_REFRESH"] = array(
			"PARENT" => "PARAMS_CAPCHA",
			"NAME" => GetMessage("IBLOCK_USE_CAPTCHA_REFRESH"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => 'Y',
		);

		$arParameters["USER_MESSAGE_ADD"] = array(
			"PARENT" => "PARAMS",
			"NAME" => GetMessage("IBLOCK_USER_MESSAGE_ADD"),
			"TYPE" => "TEXT",
		);

		$arParameters["RESIZE_IMAGES"] = array(
			"PARENT" => "PARAMS",
			"NAME" => GetMessage("CP_BIEAF_RESIZE_IMAGES"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		);

		$arParameters["DEFAULT_INPUT_SIZE"] = array(
			"PARENT" => "PARAMS",
			"NAME" => GetMessage("IBLOCK_DEFAULT_INPUT_SIZE"),
			"TYPE" => "TEXT",
			"DEFAULT" => 30,
		);

		$arParameters["INPUT_AS_PASSWORD"] = array(
			"PARENT" => "PARAMS_PASSW",
			"NAME" => GetMessage("CP_EFBF_INPUT_AS_PASSWORD"),
			"TYPE" => "LIST",
			"VALUES" => $arFieldsAsPassword,
		);
		$arParameters["INPUT_AS_PASSWORD_CONFIRM"] = array(
			"PARENT" => "PARAMS_PASSW",
			"NAME" => GetMessage("CP_EFBF_INPUT_AS_PASSWORD_CONFIRM"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => 'Y',
		);

		$arParameters["MAX_FILE_SIZE"] = array(
			"PARENT" => "PARAMS_FILES",
			"NAME" => GetMessage("IBLOCK_MAX_FILE_SIZE"),
			"TYPE" => "TEXT",
			"DEFAULT" => "0",
		);

		$arParameters["PREVIEW_TEXT_USE_HTML_EDITOR"] = array(
			"PARENT" => "ACCESS",
			"NAME" => GetMessage("CP_BIEAF_PREVIEW_TEXT_USE_HTML_EDITOR"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		);

		$arParameters["DETAIL_TEXT_USE_HTML_EDITOR"] = array(
			"PARENT" => "ACCESS",
			"NAME" => GetMessage("CP_BIEAF_DETAIL_TEXT_USE_HTML_EDITOR"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		);

		$arParameters["USE_TEXT_FOR_HTML"] = array(
			"PARENT" => "ACCESS",
			"NAME" => GetMessage("CP_BIEAF_USER_TEXT_FOR_HTML"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arHtmlFieldsAsText
		);
		
		foreach ($arProperty_LNSF as $key => $title)
		{
			$arProp = $arPropertyData[$key];
			if($arProp['PROPERTY_TYPE'] == 'F' && $arProp['MULTIPLE'] == 'Y')
				$arParameters["FILES_MIN_CNT_".$key] = array(
					"PARENT" => "PARAMS_FILES",
					"NAME" => $title.', '.GetMessage("CP_MIN_CNT"),
					"TYPE" => "STRING",
					"DEFAULT" => $arProp['MULTIPLE_CNT'],
				);
			if($arProp['USER_TYPE'] != 'EList' && in_array($arProp['PROPERTY_TYPE'], array('L','E','G')) && $arProp['MULTIPLE'] == 'N')
				$arParameters["LIST_NOT_ESTABLISHED_".$key] = array(
					"PARENT" => "PARAMS_LIST",
					"NAME" => $title.' ('.GetMessage("CP_NOT_ESTABLISHED").')',
					"TYPE" => "CHECKBOX",
					"DEFAULT" => 'Y',
				);
		}
		

		if ($arCurrentValues["FIELD_SELF_NAMES"] == "Y"){
			$arSelfNamesMode = array(
				'&nbsp;' => GetMessage('CP_EFBF_BLANK'),
			);

			foreach ($arVirtualProperties as $key => $title)
			{
				$arParameters["CUSTOM_TITLE_".$key] = array(
					"PARENT" => "TITLES",
					"NAME" => $title,
					"TYPE" => "LIST",
					"VALUES" => $arSelfNamesMode,
					"ADDITIONAL_VALUES" => "Y",
				);
			}
			//��� ������
			$arParameters["CUSTOM_TITLE_CAPTCHA"] = array(
				"PARENT" => "TITLES",
				"NAME" => GetMessage('CP_EFBF_CAPTCHA_TITLE'),
				"TYPE" => "LIST",
				"VALUES" => $arSelfNamesMode,
				"ADDITIONAL_VALUES" => "Y",
			);
			$arParameters["CUSTOM_TITLE_CAPTCHA_INPUT"] = array(
				"PARENT" => "TITLES",
				"NAME" => GetMessage('CP_EFBF_CAPTCHA_INPUT_TITLE'),
				"TYPE" => "LIST",
				"VALUES" => $arSelfNamesMode,
				"ADDITIONAL_VALUES" => "Y",
			);	
		}

		if ($arCurrentValues["FIELD_ORDER"] == "Y"){
			foreach ($arProperty_LNSF as $key => $title)
			{
				$arParameters["ORDER_".$key] = array(
					"PARENT" => "ORDER",
					"NAME" => $title,
					"TYPE" => "STRING",
					"DEFAULT" => ($arPropertyData[$key]['SORT']) ? $arPropertyData[$key]['SORT'] : 500,
				);
			}
		}

		$arValidExpPreDefined = array(
			'^[a-zA-Z'.GetMessage("CP_EFBF_REG_EXP_CYR_LOW").GetMessage("CP_EFBF_REG_EXP_CYR_HIGH").']+$' => GetMessage('CP_EFBF_REG_EXP_STRING'),
			'^[a-zA-Z'.GetMessage("CP_EFBF_REG_EXP_CYR_LOW").GetMessage("CP_EFBF_REG_EXP_CYR_HIGH").'\-_ \s]+$' => GetMessage('CP_EFBF_REG_EXP_STRING_EX'),
			
			'^[0-9]+$' => GetMessage('CP_EFBF_REG_EXP_NUM'),
			'^[0-9\s]+$' => GetMessage('CP_EFBF_REG_EXP_NUM_EX'),
			'^\-?\d+(\.\d{0,})?$' => GetMessage('CP_EFBF_REG_EXP_NUM_FLOAT'),
			'^\-?\d+(,\d{0,})?$' => GetMessage('CP_EFBF_REG_EXP_NUM_FLOAT1'),
			
			'^[a-zA-Z0-9]+$' => GetMessage('CP_EFBF_REG_EXP_STR_NUM_LAT'),
			'^['.GetMessage("CP_EFBF_REG_EXP_CYR_LOW").GetMessage("CP_EFBF_REG_EXP_CYR_HIGH").'a-zA-Z0-9]+$' => GetMessage('CP_EFBF_REG_EXP_STR_NUM_LAT_CYR'),
			
			'^([0-1]\d|2[0-3])(:[0-5]\d){2}$' => GetMessage('CP_EFBF_REG_EXP_TIME'),
			
			'^(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}$' => GetMessage('CP_EFBF_REG_EXP_DATE1'),	
			'^(0[1-9]|1[0-9]|2[0-9]|3[01])\.(0[1-9]|1[012])\.[0-9]{4}$' => GetMessage('CP_EFBF_REG_EXP_DATE2'),	

			'^[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$' => GetMessage('CP_EFBF_REG_EXP_DATE3'),
			'^[0-9]{4}\.(0[1-9]|1[012])\.(0[1-9]|1[0-9]|2[0-9]|3[01])$' => GetMessage('CP_EFBF_REG_EXP_DATE4'),
			
			'^(\+?\d{1}\s?)?(\d{10})$' => GetMessage('CP_EFBF_REG_EXP_NUM_MOBILE'),
			'^(\(\d{4}\)\s?)?(\d{6})$' => GetMessage('CP_EFBF_REG_EXP_NUM_PHONE1'),
			'^[0-9a-zA-Z_\.-]+@[0-9a-zA-Z\.-]+$' => 'EMAIL',	
			'^([1-9])+(?:-?\d){4,}$' => 'ICQ',	
				
			'^[0-9]{13,16}$' => GetMessage('CP_EFBF_REG_EXP_NUM_CARD'),
			
			'^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$' => GetMessage('CP_EFBF_REG_EXP_DOMEN'),
			'^(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?$' => 'URL',
		);

		if ($arCurrentValues["FIELD_VALID"] == "Y"){
			foreach ($arProperty_LNSF as $key => $title)
			{
				if(in_array($arPropertyData[$key]['PROPERTY_TYPE'], array('S', 'N')))
				$arParameters["VALID_".$key] = array(
					"PARENT" => "VALID",
					"NAME" => $title,
					//"TYPE" => "STRING",
					"TYPE" => "LIST",
					"VALUES" => $arValidExpPreDefined,
					"ADDITIONAL_VALUES" => "Y",
				);
			}
		}

		if ($arCurrentValues["FIELD_ERRMSG"] == "Y"){
			foreach ($arProperty_LNSF as $key => $title)
			{
				$arParameters["ERRMSG_".$key] = array(
					"PARENT" => "ERRMESSAGES",
					"NAME" => $title,
					"TYPE" => "STRING",
				);
			}
		}

		if ($arCurrentValues["FIELD_PREDEF"] == "Y"){
			foreach ($arProperty_LNSF as $key => $title)
			{
				$arr = array(
					"PARENT" => "PREDEFINED",
					"NAME" => $title,
				);
				
				switch($arPropertyData[$key]['PROPERTY_TYPE']){
					case 'S': ;
						$arr["TYPE"] = "STRING";
						break;
					case 'L': ;
						$arr["TYPE"] = "LIST";
						$arr["MULTIPLE"] = $arPropertyData[$key]['MULTIPLE'];
						$arr["VALUES"] = $arPropertyData[$key]['ENUM'];
						break;
					default:
						$arr["TYPE"] = "STRING";
				}
					
				$arParameters["PREDEFINED_".$key] = $arr;
			}
		}
		
		return $arParameters;
	}	
}	
?>
