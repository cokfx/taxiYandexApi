<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arParams['IBLOCK_ELEMENT_ID'] = isset($arParams['IBLOCK_ELEMENT_ID']) ? intval($arParams['IBLOCK_ELEMENT_ID']) : 0;

$arParams['SAVE_TO_IB'] = ($arParams['SAVE_TO_IB'] == 'N') ? false: true; //default 'Y'
$arParams['SEND_MESSAGE'] = ($arParams['SEND_MESSAGE'] == 'Y') ? true: false; //default 'N'
$arParams['USER_SEND_MESSAGE'] = ($arParams['USER_SEND_MESSAGE'] == 'Y') ? true: false; //default 'N'

$arParams['INPUT_AS_PASSWORD_CONFIRM'] = ($arParams['INPUT_AS_PASSWORD_CONFIRM'] == 'N') ? false: true; //default 'Y'
$arParams['USE_CAPTCHA_REFRESH'] = ($arParams['USE_CAPTCHA_REFRESH'] == 'N') ? false: true; //default 'Y'

//send message params
$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
if(strlen($arParams["EVENT_NAME"]) <= 0)
	$arParams["EVENT_NAME"] = "CAB_EXT_FEEDBACK_FORM_EVENT";
$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if(strlen($arParams["EMAIL_TO"]) <= 0)
	$arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
	
//send message to user params
$arParams["USER_EVENT_NAME"] = trim($arParams["USER_EVENT_NAME"]);
if(strlen($arParams["USER_EVENT_NAME"]) <= 0)
	$arParams["USER_EVENT_NAME"] = "CAB_EXT_FEEDBACK_FORM_EVENT_TO_USER";

$arResult["ELEMENT_FILES"] = array();	
$arResult["ELEMENT_FILES_ID"] = array();	

$arResult["MESSAGE"] = htmlspecialchars($_REQUEST['strIMessage'.$arParams['COMPONENT_ID']]);
//--------------------------------------
						
if (CModule::IncludeModule('cab.extfeedbackform') && CModule::IncludeModule("iblock"))
{
	$CabExFeedbackForm = new CCabExFeedbackForm;

	if($arParams["IBLOCK_ID"] > 0)
	{
		$arIBlock = CIBlock::GetArrayByID($arParams["IBLOCK_ID"]);
	}

	$arParams["MAX_FILE_SIZE"] = intval($arParams["MAX_FILE_SIZE"]);
	$arParams["PREVIEW_TEXT_USE_HTML_EDITOR"] = $arParams["PREVIEW_TEXT_USE_HTML_EDITOR"] === "Y" && CModule::IncludeModule("fileman");
	$arParams["DETAIL_TEXT_USE_HTML_EDITOR"] = $arParams["DETAIL_TEXT_USE_HTML_EDITOR"] === "Y" && CModule::IncludeModule("fileman");
	$arParams["RESIZE_IMAGES"] = $arParams["RESIZE_IMAGES"]==="Y";
	$arParams["FIELD_ERROR_POSITION"] = $arParams["FIELD_ERROR_POSITION"]==="Y";

	if(!is_array($arParams["PROPERTY_CODES"]))
	{
		$arParams["PROPERTY_CODES"] = array();
	}
	else
	{
		foreach($arParams["PROPERTY_CODES"] as $i=>$k)
			if(strlen($k) <= 0)
				unset($arParams["PROPERTY_CODES"][$i]);
	}
	
	$arParams["PROPERTY_CODES_REQUIRED"] = is_array($arParams["PROPERTY_CODES_REQUIRED"]) ? $arParams["PROPERTY_CODES_REQUIRED"] : array();
	foreach($arParams["PROPERTY_CODES_REQUIRED"] as $key => $value)
		if(strlen(trim($value)) <= 0)
			unset($arParams["PROPERTY_CODES_REQUIRED"][$key]);

	$arParams["USER_MESSAGE_ADD"] = trim($arParams["USER_MESSAGE_ADD"]);
	if(strlen($arParams["USER_MESSAGE_ADD"]) <= 0)
		$arParams["USER_MESSAGE_ADD"] = GetMessage("EFBF_USER_MESSAGE_ADD_DEFAULT");
		
	$arParams["STATUS"] = array("ANY");

	if(!is_array($arParams["GROUPS"]))
		$arParams["GROUPS"] = array();

	$arGroups = $USER->GetUserGroupArray();

	$bAllowAccess = !$arParams["GROUPS"] || count(array_intersect($arGroups, $arParams["GROUPS"])) > 0 || $USER->IsAdmin();

	$arResult["MAIN_ERRORS"] = array();
	$arResult["ERRORS"] = array();

	if ($bAllowAccess)
	{
		//get iblock element
		if($arParams['IBLOCK_ELEMENT_ID']){
			$arOrder = array('ID' => 'DESC');
			$arFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'ID' => $arParams['IBLOCK_ELEMENT_ID']);
			$arSelectMain = array('NAME', 'TAGS', 'DATE_ACTIVE_FROM', 'DATE_ACTIVE_TO', 'IBLOCK_SECTION', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'DETAIL_TEXT', 'DETAIL_PICTURE');
			$arSelect = array('IBLOCK_ID', 'ID');
			
			$arElem = CIBlockElement::GetList($arOrder, $arFilter, false, false, array_merge($arSelect, $arSelectMain))->Fetch();

			//������������� �� ���������������� ����
			foreach($arSelectMain as $key){
				if(!isset($arParams['PREDEFINED_'.$key]) || !$arParams['PREDEFINED_'.$key]){
					$arParams['PREDEFINED_'.$key] = $arElem[$key];
				}
			}

			//read element properties
			$arPropSingle = array(); $arPropSingleSelect = array();
			$arPropMultiple = array(); $arPropMultipleSelect = array();
			$rsProp = CIBlockProperty::GetList(Array(), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arParams["IBLOCK_ID"]));
			while($arr = $rsProp->Fetch())
			{
				if (in_array($arr["PROPERTY_TYPE"], array("E","G","L", "N", "S", "F")))
				{
					$ar = array(
						'CODE' => $arr['CODE'],
						'TYPE' => $arr['PROPERTY_TYPE'],
						'USER_TYPE' => $arr['USER_TYPE']						
					);
					
					if($arr['PROPERTY_TYPE'] == 'E')
						$fld = 'PROPERTY_'.$arr['CODE'].'.ID';
					else
						$fld = 'PROPERTY_'.$arr['CODE'];					
					
					if($arr['MULTIPLE'] == 'Y')
					{
						$arPropMultiple[] = $ar; 
						$arPropMultipleSelect[] = $fld;
					}
					else
					{
						$arPropSingle[] = $ar;
						$arPropSingleSelect[] = $fld;
					}						
				}
			}

			//read single properties
			$arElem = CIBlockElement::GetList($arOrder, $arFilter, false, false, array_merge($arSelect, $arPropSingleSelect))->Fetch();

			foreach($arPropSingle as $idx => $data){
				$key = $data['CODE'];
				if(!isset($arParams['PREDEFINED_PROP_'.$key]) || !$arParams['PREDEFINED_PROP_'.$key]){				
					if($data['TYPE'] == 'F') 
					{
						$value = $arElem['PROPERTY_'.$key.'_VALUE'];
						$arResult['ELEMENT_FILES_ID'][$value] = $arElem['PROPERTY_'.$key.'_VALUE_ID'];
					}	
					elseif($data['USER_TYPE'] == 'HTML') $value = $arElem['PROPERTY_'.$key.'_VALUE']['TEXT'];
					elseif($data['TYPE'] == 'L') $value = $arElem['PROPERTY_'.$key.'_ENUM_ID'];
					elseif($data['TYPE'] == 'E') $value = $arElem['PROPERTY_'.$key.'_ID'];
					else $value = $arElem['PROPERTY_'.$key.'_VALUE'];
					
					//��������� �� ���������������� ������������� �����
					$arParams['PREDEFINED_PROP_'.$key] = $value;					
				}
				
				if($data['USER_TYPE'] != 'EList' && in_array($data['TYPE'], array('L', 'E', 'G'))) 
					$arParams['LIST_NOT_ESTABLISHED_PROP_'.$key] = isset($arParams['LIST_NOT_ESTABLISHED_PROP_'.$key]) ? $arParams['LIST_NOT_ESTABLISHED_PROP_'.$key]: 'Y';
			}
			
			//read multiple properties
			foreach($arPropMultiple as $idx => $data){
				$key = $data['CODE'];
				if(!isset($arParams['PREDEFINED_PROP_'.$key]) || !$arParams['PREDEFINED_PROP_'.$key]){
				
					if($data['TYPE'] == 'L') $arOrder = array('PROPERTYSORT_'.$key => 'ASC');
					elseif($data['TYPE'] == 'E') $arOrder = array('PROPERTYSORT_'.$key.'.ID' => 'ASC');
					else $arOrder = array('PROPERTY_'.$key => 'ASC');				
				
					$arRes = CIBlockElement::GetList($arOrder, $arFilter, false, false, array_merge($arSelect, array($arPropMultipleSelect[$idx])));
					$ar = array();
					while($arElem = $arRes->Fetch()){
						if($data['TYPE'] == 'F') 
						{							
							$value = $arElem['PROPERTY_'.$key.'_VALUE'];
							$arResult['ELEMENT_FILES_ID'][$value] = $arElem['PROPERTY_'.$key.'_VALUE_ID'];
						}	
						elseif($data['USER_TYPE'] == 'HTML') $value = $arElem['PROPERTY_'.$key.'_VALUE']['TEXT'];
						elseif($data['TYPE'] == 'L') $value = $arElem['PROPERTY_'.$key.'_ENUM_ID'];
						elseif($data['TYPE'] == 'E') $value = $arElem['PROPERTY_'.$key.'_ID'];
						else $value = $arElem['PROPERTY_'.$key.'_VALUE'];
					
						$ar[] = $value;
					}
					//������������� �� ���������������� ������������� �����
					$arParams['PREDEFINED_PROP_'.$key] = implode('|', $ar);
				}
			}
		}

		// get iblock sections list
		$rsIBlockSectionList = CIBlockSection::GetList(
			array("left_margin"=>"asc"),
			array(
				"ACTIVE"=>"Y",
				"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
			),
			false,
			array("ID", "NAME", "DEPTH_LEVEL")
		);
                
		$arResult["SECTION_LIST"] = array();
		while ($arSection = $rsIBlockSectionList->GetNext())
		{
			$arSection["NAME"] = str_repeat(" . ", $arSection["DEPTH_LEVEL"]).$arSection["NAME"];
			$arResult["SECTION_LIST"][$arSection["ID"]] = array(
				"VALUE" => $arSection["NAME"]
			);
		}

		$COL_COUNT = intval($arParams["DEFAULT_INPUT_SIZE"]);
		if($COL_COUNT < 1)
			$COL_COUNT = 30;
		// customize "virtual" properties
		$arResult["PROPERTY_LIST"] = array();
		$arResult["PROPERTY_LIST_FULL"] = array(
			"NAME" => array(
				"PROPERTY_TYPE" => "S",
				"MULTIPLE" => "N",
				"COL_COUNT" => $COL_COUNT,
			),

			"TAGS" => array(
				"PROPERTY_TYPE" => "S",
				"MULTIPLE" => "N",
				"COL_COUNT" => $COL_COUNT,
			),

			"DATE_ACTIVE_FROM" => array(
				"PROPERTY_TYPE" => "S",
				"MULTIPLE" => "N",
				"USER_TYPE" => "DateTime",
			),

			"DATE_ACTIVE_TO" => array(
				"PROPERTY_TYPE" => "S",
				"MULTIPLE" => "N",
				"USER_TYPE" => "DateTime",
			),

			"IBLOCK_SECTION" => array(
				"PROPERTY_TYPE" => "L",
				"ROW_COUNT" => "8",
				"MULTIPLE" => $arParams["MAX_LEVELS"] == 1 ? "N" : "Y",
				"ENUM" => $arResult["SECTION_LIST"],
			),

			"PREVIEW_TEXT" => array(
				"PROPERTY_TYPE" => ($arParams["PREVIEW_TEXT_USE_HTML_EDITOR"]? "HTML": "T"),
				"MULTIPLE" => "N",
				"ROW_COUNT" => "5",
				"COL_COUNT" => $COL_COUNT,
			),
			"PREVIEW_PICTURE" => array(
				"PROPERTY_TYPE" => "F",
				"FILE_TYPE" => "jpg, gif, bmp, png, jpeg",
				"MULTIPLE" => "N",
			),
			"DETAIL_TEXT" => array(
				"PROPERTY_TYPE" => ($arParams["DETAIL_TEXT_USE_HTML_EDITOR"]? "HTML": "T"),
				"MULTIPLE" => "N",
				"ROW_COUNT" => "5",
				"COL_COUNT" => $COL_COUNT,
			),
			"DETAIL_PICTURE" => array(
				"PROPERTY_TYPE" => "F",
				"FILE_TYPE" => "jpg, gif, bmp, png, jpeg",
				"MULTIPLE" => "N",
			),
		);
		
		//������ ��� ���������� ����� 
		$arOrder = array();
		foreach ($arResult["PROPERTY_LIST_FULL"] as $key => $arr){
			$arOrder[$key] = (isset($arParams['ORDER_'.$key]) && $arParams['ORDER_'.$key] !== '') ? intval($arParams['ORDER_'.$key]) : 500;
		}
		
		// get iblock property list
		$rsIBLockPropertyList = CIBlockProperty::GetList(array("sort"=>"asc", "name"=>"asc"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arParams["IBLOCK_ID"], 'SECTION_ID' => 0));
		while ($arProperty = $rsIBLockPropertyList->GetNext())
		{
			if ($arProperty["PROPERTY_TYPE"] == "G"){
				$rsIBlockSectionList = CIBlockSection::GetList(
					array("left_margin"=>"asc"),
					array(
						"ACTIVE"=>"Y",
						"IBLOCK_ID"=>$arProperty["LINK_IBLOCK_ID"],
					),
					false,
					array("ID", "NAME", "DEPTH_LEVEL")
				);
				
				while ($arSection = $rsIBlockSectionList->GetNext())
				{
					$arSection["NAME"] = str_repeat(" . ", $arSection["DEPTH_LEVEL"]).$arSection["NAME"];
					$arProperty["ENUM"][$arSection["ID"]] = $arSection;
				}
			}			
		
			if ($arProperty["PROPERTY_TYPE"] == "E")
			{
				$rsElement = CIBlockElement::GetList(
					array("SORT"=>"ASC", "NAME" => "ASC"), 
					array("ACTIVE"=>"Y", 'IBLOCK_ID' => $arProperty["LINK_IBLOCK_ID"]), 
					false, false, 
					array("ID", "NAME"));
				$arProperty["ENUM"] = array();
				while ($arElement = $rsElement->GetNext())
				{
					$arProperty["ENUM"][$arElement["ID"]] = $arElement;
				}				
			}
			// get list of property enum values
			if ($arProperty["PROPERTY_TYPE"] == "L")
			{
				$rsPropertyEnum = CIBlockProperty::GetPropertyEnum($arProperty["ID"], Array('sort' => 'asc', 'value' => 'asc'));
				$arProperty["ENUM"] = array();
				while ($arPropertyEnum = $rsPropertyEnum->GetNext())
				{
					$arProperty["ENUM"][$arPropertyEnum["ID"]] = $arPropertyEnum;
				}
			}

			if ($arProperty["PROPERTY_TYPE"] == "T")
			{
				if (empty($arProperty["COL_COUNT"])) $arProperty["COL_COUNT"] = "30";
				if (empty($arProperty["ROW_COUNT"])) $arProperty["ROW_COUNT"] = "5";
			}

			if(strlen($arProperty["USER_TYPE"]) > 0 )
			{
				$arUserType = CIBlockProperty::GetUserType($arProperty["USER_TYPE"]);

				if($arProperty['MULTIPLE'] == 'Y'){
				
					if($arProperty['USER_TYPE_SETTINGS']['multiple'] == 'Y' && $arProperty['USER_TYPE_SETTINGS']['size'] > 0  && array_key_exists("GetPublicEditHTMLMulty", $arUserType))
						$arProperty["GetPublicEditHTML"] = $arUserType["GetPublicEditHTMLMulty"];
					elseif(array_key_exists("GetPublicEditHTML", $arUserType))
						$arProperty["GetPublicEditHTML"] = $arUserType["GetPublicEditHTML"];
						
				}elseif(array_key_exists("GetPublicEditHTML", $arUserType))
					$arProperty["GetPublicEditHTML"] = $arUserType["GetPublicEditHTML"];
				else
					$arProperty["GetPublicEditHTML"] = false;
			}
			else
			{
				$arProperty["GetPublicEditHTML"] = false;
			}

			// add property to edit-list
			if (in_array('PROP_'.$arProperty["CODE"], $arParams["PROPERTY_CODES"]))
				$arOrder['PROP_'.$arProperty["CODE"]] = (isset($arParams['ORDER_'.'PROP_'.$arProperty["CODE"]]) && $arParams['ORDER_'.'PROP_'.$arProperty["CODE"]] !== '') ? intval($arParams['ORDER_'.'PROP_'.$arProperty["CODE"]]) : 500;

			$arResult["PROPERTY_LIST_FULL"]['PROP_'.$arProperty["CODE"]] = $arProperty;
		}
		
		//��������� ������� �����
		asort($arOrder);

		// add them to edit-list
		foreach($arOrder as $key => $value){
			if (in_array($key, $arParams["PROPERTY_CODES"])) $arResult["PROPERTY_LIST"][] = $key;
		}		

		$arPrep = array();		
		//process predefined values
		foreach ($arResult["PROPERTY_LIST_FULL"] as $key => $arProperty){
			if($arProperty['USER_TYPE'] == 'EList' && $arProperty['USER_TYPE_SETTINGS']['multiple'] == 'Y')
				$arPrep[$key] = array(explode('|', $arParams['PREDEFINED_'.$key]));
			else 
				$arPrep[$key] = explode('|', $arParams['PREDEFINED_'.$key]);
			
			if ($arProperty["PROPERTY_TYPE"] == "F" && isset($arParams['PREDEFINED_'.$key])){
				foreach($arPrep[$key] as $file_id)
				{
					if($arFile = CFile::GetFileArray($file_id)){
						$arFile["IS_IMAGE"] = CFile::IsImage($arFile["FILE_NAME"], $arFile["CONTENT_TYPE"]);
						$arResult["ELEMENT_FILES"][$file_id] = $arFile;
					}
				}
			}
		}
		$arParams['PREDEFINED'] = $arPrep;	
	}

	if ($bAllowAccess)
	{                       
		// process POST data
		if (check_bitrix_sessid() && (!empty($_REQUEST["efbf_submit"]) || !empty($_REQUEST["iblock_apply"])) && $arParams['COMPONENT_ID'] == $_REQUEST['component_id'])
		{
			$arProperties = $_REQUEST["PROPERTY"];

			$arUpdateValues = array();
			$arUpdatePropertyValues = array();
			
			// process properties list
			foreach ($arParams["PROPERTY_CODES"]  as $i => $propertyID)
			{
				$arPropertyValue = $arProperties[$propertyID];
				// check if property is a real property, or element field
				if (strpos($propertyID, 'PROP_') === 0)
				{
					if(in_array($propertyID, $arParams['USE_TEXT_FOR_HTML']) && $arResult["PROPERTY_LIST_FULL"][$propertyID]['USER_TYPE'] == 'HTML'){
						if ($arResult["PROPERTY_LIST_FULL"][$propertyID]['MULTIPLE'] == 'Y'){
							$arUpdatePropertyValues[$propertyID] = array();
							foreach($arPropertyValue as $key => $value){
								$arUpdatePropertyValues[$propertyID][] = array('VALUE' => array('TYPE' => 'HTML', 'TEXT' => $value));
							}
						}else{
							$arUpdatePropertyValues[$propertyID] = array('VALUE' => array('TYPE' => 'HTML', 'TEXT' => $arPropertyValue[0]));
						}						
					}
					// for non-file properties
					elseif ($arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] != "F")
					{
						if($arResult["PROPERTY_LIST_FULL"][$propertyID]['USER_TYPE'] == "EList" && 
						  $arResult["PROPERTY_LIST_FULL"][$propertyID]['USER_TYPE_SETTINGS']['multiple'] == 'Y') $arPropertyValue = $arPropertyValue[0]['VALUE'];
					
						// for multiple properties
						if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
						{
							$arUpdatePropertyValues[$propertyID] = array();

							if (!is_array($arPropertyValue))
							{
								$arUpdatePropertyValues[$propertyID][] = $arPropertyValue;
							}
							else
							{
								foreach ($arPropertyValue as $key => $value)
								{
									$pt = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];
									if (
										$pt == "L" && intval($value) > 0
										|| 
										$pt != "L" && !empty($value)
									)
									{
										$arUpdatePropertyValues[$propertyID][] = $value;
									}
								}
							}
						}
						// for single properties
						else
						{
							if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] != "L" &&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] != "E" &&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] != "G" )
								$arUpdatePropertyValues[$propertyID] = $arPropertyValue[0];
							else
								$arUpdatePropertyValues[$propertyID] = $arPropertyValue;
						}
					}
					// for file properties
					else
					{
						$arUpdatePropertyValues[$propertyID] = array();
						foreach ($arPropertyValue as $key => $value)
						{
							$arFile = $_FILES["PROPERTY_FILE_".$propertyID."_".$key];
							$arFile["del"] = $_REQUEST["DELETE_FILE"][$propertyID][$key] == "Y" ? "Y" : "";							
							if(isset($arFile["error"]) && $arFile["error"] == 4){
								if($arFile["del"] == 'Y') $arUpdatePropertyValues[$propertyID][$value] = array('del' => $arFile["del"]);
							}else{
								if(!$value) $value = $key;
								$arUpdatePropertyValues[$propertyID][$value] = $arFile;

								if((($arParams["MAX_FILE_SIZE"] > 0) && ($arFile["size"] > $arParams["MAX_FILE_SIZE"])) || in_array($arFile["error"], array(1,2)))
									$arResult["ERRORS"][$propertyID] = str_replace('#FILENAME#', $arFile["name"], GetMessage("EFBF_ERROR_FILE_TOO_LARGE"));
							}								
						}

						if (count($arUpdatePropertyValues[$propertyID]) == 0)
							unset($arUpdatePropertyValues[$propertyID]);
					}
				}
				else
				{
					// for "virtual" properties
					if ($propertyID == "IBLOCK_SECTION")
					{
						if (!is_array($arProperties[$propertyID]))
							$arProperties[$propertyID] = array($arProperties[$propertyID]);
						$arUpdateValues[$propertyID] = $arProperties[$propertyID];

						if ($arParams["MAX_LEVELS"] > 0 && count($arUpdateValues[$propertyID]) > $arParams["MAX_LEVELS"])
						{
							$arResult["ERRORS"][$propertyID] = str_replace("#MAX_LEVELS#", $arParams["MAX_LEVELS"], GetMessage("IBLOCK_ADD_MAX_LEVELS_EXCEEDED"));
						}
					}
					else
					{
						if($arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "F")
						{
							$arFile = $_FILES["PROPERTY_FILE_".$propertyID."_0"];							
							$arFile["del"] = $_REQUEST["DELETE_FILE"][$propertyID][0] == "Y" ? "Y" : "";														
							
							if(isset($arFile["error"]) && $arFile["error"] == 4){
								if($arFile["del"] == 'Y') $arUpdateValues[$propertyID] = array('del' => $arFile["del"]);
							}else{								
								$arUpdateValues[$propertyID] = $arFile;
								
								if((($arParams["MAX_FILE_SIZE"] > 0) && ($arFile["size"] > $arParams["MAX_FILE_SIZE"])) || in_array($arFile["error"], array(1,2)))
									$arResult["ERRORS"][$propertyID] = str_replace('#FILENAME#', $arFile["name"], GetMessage("EFBF_ERROR_FILE_TOO_LARGE"));
							}							
						}
						elseif($arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "HTML")
						{
							if($propertyID == "DETAIL_TEXT")
								$arUpdateValues["DETAIL_TEXT_TYPE"] = "html";
							if($propertyID == "PREVIEW_TEXT")
								$arUpdateValues["PREVIEW_TEXT_TYPE"] = "html";
							$arUpdateValues[$propertyID] = $arProperties[$propertyID][0];
						}
						else
						{
							if($propertyID == "DETAIL_TEXT")
								$arUpdateValues["DETAIL_TEXT_TYPE"] = "text";
							if($propertyID == "PREVIEW_TEXT")
								$arUpdateValues["PREVIEW_TEXT_TYPE"] = "text";
							$arUpdateValues[$propertyID] = $arProperties[$propertyID][0];
						}
					}
				}
			}

			// check required properties
			foreach ($arParams["PROPERTY_CODES_REQUIRED"] as $key => $propertyID)
			{
				$propertyValue = (strpos($propertyID, 'PROP_') === 0) ? $arUpdatePropertyValues[$propertyID] : $arUpdateValues[$propertyID];

				$bError = false;				

				//Files check
				if ($arResult["PROPERTY_LIST_FULL"][$propertyID]['PROPERTY_TYPE'] == 'F')
				{
					//New element
					$bError = true;
					if(is_array($propertyValue))
					{
						if(array_key_exists("tmp_name", $propertyValue) && array_key_exists("size", $propertyValue))
						{
							if($propertyValue['size'] > 0)
							{
								$bError = false;
							}
						}
						else
						{
							foreach ($propertyValue as $arFile)
							{
								if ($arFile['size'] > 0)
								{
									$bError = false;
									break;
								}
							}
						}
					}
				}
				elseif($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "HTML"){

					$bError = true;
					if($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
						foreach($propertyValue as $value)
						{
							$txt = trim(strip_tags($value['VALUE']['TEXT']));
							if(strlen($txt) > 0)
							{
								$bError = false;
								break;
							}
						}
					else{
						foreach($propertyValue as $value)
						{
							$txt = trim(strip_tags($value['TEXT']));
							if(strlen($txt) > 0)
							{
								$bError = false;
								break;
							}
						}
					}
				}
				//multiple property
				elseif (
					$arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" || 
					$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "L" ||
					$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "E"
				)
				{
					if(is_array($propertyValue))
					{
						$bError = true;
						foreach($propertyValue as $value)
						{
							if(strlen($value) > 0)
							{
								$bError = false;
								break;
							}
						}
					}
					elseif(strlen($propertyValue) <= 0)
					{
						$bError = true;
					}
				}
				//single
				elseif (is_array($propertyValue) && array_key_exists("VALUE", $propertyValue))
				{
					if(strlen($propertyValue["VALUE"]) <= 0)
						$bError = true;
				}
				elseif (!is_array($propertyValue))
				{
					if(strlen($propertyValue) <= 0)
						$bError = true;
				}

				if ($bError)
				{
					$arResult["ERRORS"][$propertyID] = str_replace("#PROPERTY_NAME#", 															 
					!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : 
					((strpos($propertyID, 'PROP_') === 0) ? $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] : GetMessage("IBLOCK_FIELD_".$propertyID)), 
					GetMessage("EFBF_ADD_ERROR_REQUIRED"));
				}
			}

			//check correct input all fields
			foreach ($arResult["PROPERTY_LIST"]  as $propertyID)
			{
				//if has error message earlier tnen continue
				if(isset($arResult["ERRORS"][$propertyID]) && !empty($arResult["ERRORS"][$propertyID])) continue;
			
				$propertyValue = (strpos($propertyID, 'PROP_') === 0) ? $arUpdatePropertyValues[$propertyID] : $arUpdateValues[$propertyID];

				$bvError = false;
				
				$regexp = isset($arParams['VALID_'.$propertyID]) ? $arParams['VALID_'.$propertyID] : '';

				if($regexp){
					if(is_array($propertyValue)){
						foreach($propertyValue as $val){
							if(!preg_match('/'.$regexp.'/', trim($val), $matches)){
								$bvError = true;
								break;
							}
						}
					}else{
						if(!preg_match('/'.$regexp.'/', trim($propertyValue), $matches)) $bvError = true;										
					}
				}
				
				$arValidCheckRes['ERROR_MSG'] = '';
				//if has no error then call event
				if(!$bvError)
				{
					$arFieldCheckParams = array(
						'PROPERTY_ID' => $propertyID,
						'VALUE' => $propertyValue,
						'ERROR' => false,
						'ERROR_MSG' => '',
					);
					$arValidCheckRes = $CabExFeedbackForm->OnFormFieldCheck($arFieldCheckParams);
					$bvError = $arValidCheckRes['ERROR'];
				}
				
				//for password field
				if(!$bvError && $arParams['INPUT_AS_PASSWORD_CONFIRM'] && ($propertyID == $arParams['INPUT_AS_PASSWORD'])){
					if($propertyValue != $_REQUEST['PROPERTY'][$propertyID.'_CONFIRM'][0]){
						$arValidCheckRes['ERROR'] = true;
						$arValidCheckRes['ERROR_MSG'] = GetMessage('EFBF_INPUT_VALUES_NOT_EQUAL');
						$bvError = true;
					}
				}

				if ($bvError)
				{
					$errmsg = (isset($arParams['ERRMSG_'.$propertyID]) && trim($arParams['ERRMSG_'.$propertyID]) != '') ? $arParams['ERRMSG_'.$propertyID] : GetMessage("EFBF_ADD_ERROR_VALID");
					
					if($arValidCheckRes['ERROR_MSG']) $errmsg = $arValidCheckRes['ERROR_MSG'];

					$arResult["ERRORS"][$propertyID] = str_replace("#PROPERTY_NAME#", 
					!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : 
					((strpos($propertyID, 'PROP_') === 0) ? $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] : GetMessage("IBLOCK_FIELD_".$propertyID)),
					$errmsg);
				}				
			}
			

			// check captcha
			if ($arParams["USE_CAPTCHA"] == "Y" && !$USER->IsAuthorized())
			{
				if (!$APPLICATION->CaptchaCheckCode($_REQUEST["captcha_word"], $_REQUEST["captcha_sid"]))
				{
					$arResult["ERRORS"]['CAPTCHA'] = GetMessage("EFBF_FORM_WRONG_CAPTCHA");
				}
			}

			if (count($arResult["ERRORS"]) == 0 && count($arResult["MAIN_ERRORS"]) == 0)
			{
				if ($arParams["ELEMENT_ASSOC"] == "PROPERTY_ID")
					$arUpdatePropertyValues[$arParams["ELEMENT_ASSOC_PROPERTY"]] = $USER->GetID();
				$arUpdateValues["MODIFIED_BY"] = $USER->GetID();
				
				//������������� ���������������� ��������
				foreach($arParams['PREDEFINED'] as $prop_id => $value){
					if($arResult["PROPERTY_LIST_FULL"][$prop_id]['PROPERTY_TYPE'] == 'F') continue;					
					
					if(strpos($prop_id, 'PROP_') === 0){						
						if($arResult["PROPERTY_LIST_FULL"][$prop_id]['USER_TYPE'] == 'HTML')
						{
							if($arResult["PROPERTY_LIST_FULL"][$prop_id]['MULTIPLE'] == 'Y'){
								$arValue = array();
								foreach($value as $vv){
									$arValue[] = array('VALUE' => array('TYPE' => 'HTML', 'TEXT' => $vv));
								}
								$value = $arValue;
							}else $value = array('VALUE' => array('TYPE' => 'HTML', 'TEXT' => $value[0]));						
						}else{						
							if($arResult["PROPERTY_LIST_FULL"][$prop_id]['MULTIPLE'] != 'Y') $value = $value[0];
						}
						
						if(!isset($arUpdatePropertyValues[$prop_id])) $arUpdatePropertyValues[$prop_id] = $value;
					}else{					
						if(!isset($arUpdateValues[$prop_id])) $arUpdateValues[$prop_id] = $value[0];
					}					
				}

				//������������ ����� PROP_<NAME>
				$arUpdatePropertyValuesEx = array();
				foreach($arUpdatePropertyValues as $key => $value){
					$arUpdatePropertyValuesEx[str_replace('PROP_', '', $key)] = $value;
				}				

				$arUpdateValues["PROPERTY_VALUES"] = $arUpdatePropertyValuesEx;

		
				$arUpdateValues["IBLOCK_ID"] = $arParams["IBLOCK_ID"];

				// set activity start date for new element to current date
				if (strlen($arUpdateValues["DATE_ACTIVE_FROM"]) <= 0)
				{
					$arUpdateValues["DATE_ACTIVE_FROM"] = ConvertTimeStamp(false, "FULL");
				}			
				
				//user
				$arUserParams = array(
					'ID' => '',
					'FIO' => GetMessage('EFBF_USER_ANONIM'),
				);
				if($userid = $arUpdateValues["MODIFIED_BY"]){
					$ar = CUser::GetById($userid)->Fetch();
					$arUserParams['ID'] = $userid;
					$arUserParams['FIO'] = trim($ar['LAST_NAME'].' '.$ar['NAME'].' '.$ar['SECOND_NAME']);
				}
				
				$arMessageParams = array();
				//message values
				if($arParams['SEND_MESSAGE'] || $arParams['USER_SEND_MESSAGE']){
					$arFields = $arUpdateValues;

					$arFields['USER_ID'] = $arUserParams['ID'];
					$arFields['USER_FIO'] = $arUserParams['FIO'];
					
					foreach($arFields['PROPERTY_VALUES'] as $prop => $val){
						$arProp = $arResult["PROPERTY_LIST_FULL"]['PROP_'.$prop];
						
						if($arProp["GetPublicEditHTML"] && $arProp["USER_TYPE"] == 'DateTime') 
							$prop_type = "USER_TYPE_DATE_TIME";
						elseif($arProp["GetPublicEditHTML"] && $arProp["USER_TYPE"] == 'HTML') 
							$prop_type = "USER_TYPE_HTML";
						else 
							$prop_type = $arProp["PROPERTY_TYPE"];

						if($prop_type == "USER_TYPE_DATE_TIME"){
							$ar = array();
							if($arProp["MULTIPLE"] == "Y"){
								foreach($val as $item){
									if($_val = trim($item['VALUE'])) $ar[] = $_val;
								}										
							}else{
								if($_val = trim($val['VALUE'])) $ar[] = $_val;
							}
							
							$arFields['PROPERTY_'.$prop.'_TEXT'] = implode("\n", $ar);
						}

						if($prop_type == "USER_TYPE_HTML"){
							$ar = array();
							$type = 'text';
							if($arProp["MULTIPLE"] == "Y"){
								foreach($val as $item){
									if($_val = trim($item['VALUE']['TEXT'])){
										$type = $item['VALUE']['TYPE'];									
										$ar[] = $_val;
									}	
								}										
							}else{								
								if($_val = trim($val['VALUE']['TEXT'])) {
									$type = $val['VALUE']['TYPE'];
									$ar[] = $_val;
								}
							}
							
							$arFields['PROPERTY_'.$prop.'_TEXT'] = implode(($type == 'html')?"<br/>" : "\n", $ar);
						}

						if($prop_type == "S"){									
							$ar = array();
							if($arProp["MULTIPLE"] == "Y"){
								$ar = $val;	
							}elseif($val = trim($val)){
								$ar[] = $val;
							}
							
							$arFields['PROPERTY_'.$prop.'_TEXT'] = implode("\n", $ar);
						}

						if($prop_type == "F"){
							$ar = array();
							if($arProp["MULTIPLE"] == "Y"){
								foreach($val as $file){
									if($file['error'] == 0) $ar[] = $file['name'];
								}										
							}else{
								if($file['error'] == 0) $ar[] = $file['name'];
							}
							
							$arFields['PROPERTY_'.$prop.'_COUNT'] = count($ar);
							$arFields['PROPERTY_'.$prop.'_TEXT'] = implode("\n", $ar);
						}

						if($prop_type == "G"){
							$ar = array();
							if($arProp["MULTIPLE"] == "Y"){
								$arFields['PROPERTY_'.$prop.'_TEXT'] = '';										
								
								$_val = array(); foreach($val as $vv) if($vv = intval($vv)) $_val[] = $vv;
								if($_val){
									$rsSection = CIBlockSection::GetList(
										array("left_margin"=>"asc"),
										array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arProp["LINK_IBLOCK_ID"], 'ID' => $_val),
										false,
										array("ID", "NAME", "DEPTH_LEVEL")
									);
									while($arSection = $rsSection->Fetch()) $ar[] = $arSection['NAME'];
								}
							}elseif($val = intval($val)){
								$arSection = CIBlockSection::GetList(
									array("left_margin"=>"asc"),
									array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arProp["LINK_IBLOCK_ID"], 'ID' => $val),
									false,
									array("ID", "NAME", "DEPTH_LEVEL")
								)->Fetch();
								$ar[] = $arSection['NAME'];
							}
							
							$arFields['PROPERTY_'.$prop.'_TEXT'] = implode("\n", $ar);
						}							
					
						if($prop_type == "E"){
							$ar = array();

							if($arProp['USER_TYPE'] == 'EList' && $arProp['USER_TYPE_SETTINGS']['multiple'] == 'N'){
								foreach($val as &$vv) $vv = $vv['VALUE'];
							}

							if($arProp["MULTIPLE"] == "Y"){
								$arFields['PROPERTY_'.$prop.'_TEXT'] = '';										
								$_val = array(); foreach($val as $vv) if($vv = intval($vv)) $_val[] = $vv;
								if($_val){
									$rsElement = CIBlockElement::GetList(array('SORT' => 'ASC', 'NAME' => 'ASC'), array("ACTIVE"=>"Y", 'IBLOCK_ID' => $arProp["LINK_IBLOCK_ID"], 'ID' => $_val));
									while($arElement = $rsElement->Fetch()) $ar[] = $arElement['NAME'];
								}
							}else{
								if($val = intval($val)){
									$arElement = CIBlockElement::GetList(array('SORT' => 'ASC', 'NAME' => 'ASC'), array("ACTIVE"=>"Y", 'IBLOCK_ID' => $arProp["LINK_IBLOCK_ID"], 'ID' => $val))->Fetch();
									$ar[] = $arElement['NAME'];
								}
							}
							
							$arFields['PROPERTY_'.$prop.'_TEXT'] = implode("\n", $ar);
						}							
					
						if($prop_type == "L"){
							$ar = array();
							if($arProp["MULTIPLE"] == "Y"){							
								$arFields['PROPERTY_'.$prop.'_TEXT'] = '';
								foreach($val as $value){
									if($value = intval($value)){
										$arPropEnum = CIBlockProperty::GetPropertyEnum($arProp["ID"], Array('sort' => 'asc', 'value' => 'asc'), array('ID' => $value))->Fetch();
										$ar[] = $arPropEnum['VALUE'];
									}
								}
							}else{
								if($val = intval($val)){
									$arPropEnum = CIBlockProperty::GetPropertyEnum($arProp["ID"], Array('sort' => 'asc', 'value' => 'asc'), array('ID' => $val))->Fetch();
									$ar[] = $arPropEnum['VALUE'];
								}
							}
							
							$arFields['PROPERTY_'.$prop.'_TEXT'] = implode("\n", $ar);
						}							
					
						$arFields['PROPERTY_'.$prop] = $val;
					}	
					unset($arFields['PROPERTY_VALUES']);
					
					$arFields["EMAIL_TO"] = $arParams["EMAIL_TO"];

					if($arParams["USER_EMAIL_FROM_PROP"]){
						$arFields["USER_EMAIL_TO"] = $arFields['PROPERTY_'.str_replace('PROP_', '', $arParams["USER_EMAIL_FROM_PROP"])];
					}else{
						$arFields["USER_EMAIL_TO"] = $USER->GetEmail();
					}
					
					$arMessageParams = array(
						'VALUES' => $arFields,
						'PARAMS' => array(
							'EVENT_MESSAGE_ID' => $arParams['EVENT_MESSAGE_ID'],
							'USER_EVENT_MESSAGE_ID' => $arParams['USER_EVENT_MESSAGE_ID'],
							'EVENT_NAME' => $arParams['EVENT_NAME'],
							'USER_EVENT_NAME' => $arParams['USER_EVENT_NAME'],
							'SITE_ID' => SITE_ID,
						),
					);
				}	
				
				$arWriteIBParams = array();
				//ib element values
				if($arParams['SAVE_TO_IB']){
					$arWriteIBParams = array(
						'VALUES' => $arUpdateValues,
						'PARAMS' => array(
							'RESIZE_IMAGES' => $arParams['RESIZE_IMAGES'],
						),
						'RESULT' => array(
							'IBLOCK_ELEMENT_ID' => $arParams['IBLOCK_ELEMENT_ID'],
						),
					);
				}

				if(!$CabExFeedbackForm->OnFormSubmit($arParams['FORM_CODE'], $arParams['SAVE_TO_IB'], $arParams['SEND_MESSAGE'], $arParams['USER_SEND_MESSAGE'], $arWriteIBParams, $arMessageParams, $arUserParams)){
					$s_err = $CabExFeedbackForm->LAST_ERROR;
					$arResult["MAIN_ERRORS"][] = ($s_err) ? $s_err : GetMessage('EFBF_ERROR');
				}else{
					$arResult["MESSAGE"] = $arParams["USER_MESSAGE_ADD"];
					
					if($arParams['IBLOCK_ELEMENT_ID']){
						$sRedirectUrl = $APPLICATION->GetCurPageParam("strIMessage".$arParams['COMPONENT_ID']."=".urlencode($arResult["MESSAGE"]), array("strIMessage"), $get_index_page=false);
						LocalRedirect($sRedirectUrl);					
						exit();
					}
				}
			}
		}

		//prepare data for form
		$arResult["PROPERTY_REQUIRED"] = is_array($arParams["PROPERTY_CODES_REQUIRED"]) ? $arParams["PROPERTY_CODES_REQUIRED"] : array();
		
		$arResult['HAS_ERROR'] = count($arResult["ERRORS"]) > 0 || count($arResult["MAIN_ERRORS"]) > 0;

		// prepare form data if some errors occured
		if ($arResult['HAS_ERROR'])
		{
			foreach ($arUpdateValues as $key => $value)
			{
				if ($key == "IBLOCK_SECTION")
				{
					$arResult["ELEMENT"][$key] = array();
					if(!is_array($value))
					{
						$arResult["ELEMENT"][$key][] = array("VALUE" => htmlspecialchars($value));
					}
					else
					{
						foreach ($value as $vkey => $vvalue)
						{
							$arResult["ELEMENT"][$key][$vkey] = array("VALUE" => htmlspecialchars($vvalue));
						}
					}
				}
				elseif ($key == "PROPERTY_VALUES")
				{
					//Skip
				}
				elseif ($arResult["PROPERTY_LIST_FULL"][$key]["PROPERTY_TYPE"] == "F")
				{
					//Skip

					/*$arResult["ELEMENT"][$key] = $value['name'];*/
				}
				elseif ($arResult["PROPERTY_LIST_FULL"][$key]["PROPERTY_TYPE"] == "HTML")
				{
					$arResult["ELEMENT"][$key] = $value;
				}
				else
				{
					$arResult["ELEMENT"][$key] = htmlspecialchars($value);
				}
			}

			foreach ($arUpdatePropertyValues as $key => $value)
			{				
				if($arResult["PROPERTY_LIST_FULL"][$key]['USER_TYPE'] == 'EList' && $arResult["PROPERTY_LIST_FULL"][$key]['USER_TYPE_SETTINGS']['multiple'] == 'Y')
				{
					$arResult["ELEMENT_PROPERTIES"][$key][0] = array(
						'VALUE' => $value,
						'~VALUE' => $value,
					);
				}
				elseif ($arResult["PROPERTY_LIST_FULL"][$key]["PROPERTY_TYPE"] != "F")
				{
					$arResult["ELEMENT_PROPERTIES"][$key] = array();
					
					if($arResult["PROPERTY_LIST_FULL"][$key]["USER_TYPE"] == "HTML" && in_array($key, $arParams['USE_TEXT_FOR_HTML']))
					{						
						if($arResult["PROPERTY_LIST_FULL"][$key]['MULTIPLE'] == 'Y'){
							foreach($value as $idx => $vv){
								$arResult["ELEMENT_PROPERTIES"][$key][$idx] = array(
									'~VALUE' => $vv['VALUE']['TEXT'],
									'VALUE' => htmlspecialchars($vv['VALUE']['TEXT']),
								);	
							}
						}else{
							$arResult["ELEMENT_PROPERTIES"][$key][] = array(
								'~VALUE' => $value['VALUE']['TEXT'],
								'VALUE' => htmlspecialchars($value['VALUE']['TEXT']),
							);	
						}						
					}
					else
					{					
						if(!is_array($value))
						{
							$value = array(
								array("VALUE" => $value),
							);
						}
						foreach($value as $vv)
						{
							if(is_array($vv))
							{
								if(array_key_exists("VALUE", $vv))
									$arResult["ELEMENT_PROPERTIES"][$key][] = array(
										"~VALUE" => $vv["VALUE"],
										"VALUE" => htmlspecialchars($vv["VALUE"]),
									);
								else
									$arResult["ELEMENT_PROPERTIES"][$key][] = array(
										"~VALUE" => $vv,
										"VALUE" => $vv,
									);
							}
							else
							{
								$arResult["ELEMENT_PROPERTIES"][$key][] = array(
									"~VALUE" => $vv,
									"VALUE" => htmlspecialchars($vv),
								);
							}
						}
					}
				}
			}
		}

		// prepare captcha
		if ($arParams["USE_CAPTCHA"] == "Y" && !$USER->IsAuthorized())
		{
			$arResult["CAPTCHA_CODE"] = htmlspecialchars($APPLICATION->CaptchaGetCode());
		}

		$this->IncludeComponentTemplate();		
	}
	if (!$bAllowAccess)
	{
		$APPLICATION->AuthForm("");
	}
}
?>