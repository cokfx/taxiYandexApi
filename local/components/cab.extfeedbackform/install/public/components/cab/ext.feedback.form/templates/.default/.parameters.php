<?
	$arJqueryVariants = array(
		"CAB_JQUERY" => GetMessage('TP_CAB_JQUERY'),
		"BITRIX_JQUERY" => GetMessage('TP_BITRIX_JQUERY'),	
		"EXISTS_JQUERY" => GetMessage('TP_EXISTS_JQUERY'),
	);
	
	$arErrMsgPos = array(
		"UNDER" => GetMessage('TP_ERR_MSG_POS_UNDER'),
		"FLOAT" => GetMessage('TP_ERR_MSG_POS_FLOAT'),	
	);
	
	$arDataTblLabelAlignH = array(
		"l-align" => GetMessage('TP_DTL-ALIGN-LEFT'),
		"c-align" => GetMessage('TP_DTL-ALIGN-HCENTER'),	
		"r-align" => GetMessage('TP_DTL-ALIGN-RIGHT'),	
	);
	
	$arDataTblLabelAlignV = array(
		"t-valign" => GetMessage('TP_DTL-ALIGN-TOP'),
		"c-valign" => GetMessage('TP_DTL-ALIGN-VCENTER'),	
		"b-valign" => GetMessage('TP_DTL-ALIGN-BOTTOM'),	
	);
	
	$arTemplateParameters = array(
		"NEED_JQUERY" => Array(
			"PARENT" => "JQUERY",
			"NAME" => GetMessage("TP_NEED_JQUERY"),
			"TYPE" => "LIST",
			"VALUES" => $arJqueryVariants,
		),
	
		"EFBF_FORM_WIDTH" => Array(
			"PARENT" => "TEMPLTE",
			"NAME" => GetMessage("TP_EFBF_FORM_WIDTH"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),		
	
		"DATA-TABLE-WIDTH" => Array(
			"PARENT" => "TEMPLTE",
			"NAME" => GetMessage("TP_DATA-TABLE-WIDTH"),
			"TYPE" => "STRING",
			"DEFAULT" => "100%",
		),		
	
		"DATA-TABLE-COL1-WIDTH" => Array(
			"PARENT" => "TEMPLTE",
			"NAME" => GetMessage("TP_DATA-TABLE-COL1-WIDTH"),
			"TYPE" => "STRING",
			"DEFAULT" => "40%",
		),		

		"DATA-TABLE-COL2-WIDTH" => Array(
			"PARENT" => "TEMPLTE",
			"NAME" => GetMessage("TP_DATA-TABLE-COL2-WIDTH"),
			"TYPE" => "STRING",
			"DEFAULT" => "60%",
		),	
		
		"DATA-TABLE-LABEL-ALIGN-H" => Array(
			"PARENT" => "TEMPLTE",
			"NAME" => GetMessage("TP-DATA-TABLE-LABEL-ALIGN-H"),
			"TYPE" => "LIST",
			"VALUES" => $arDataTblLabelAlignH,
			"DEFAULT" => 'l-align',
		),	
		
		"DATA-TABLE-LABEL-ALIGN-V" => Array(
			"PARENT" => "TEMPLTE",
			"NAME" => GetMessage("TP-DATA-TABLE-LABEL-ALIGN-V"),
			"TYPE" => "LIST",
			"VALUES" => $arDataTblLabelAlignV,
			"DEFAULT" => 'c-valign',
		),	
		
		"FIELD_ERROR_POSITION" => array(
			"PARENT" => "TEMPLTE",
			"NAME" => GetMessage("TP_FIELD_ERROR_POSITION"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"REFRESH" => "Y",
		),
	
	);
	
	if($arCurrentValues['FIELD_ERROR_POSITION'] == 'Y'){
		$arTemplateParameters["ERROR_MESSAGES_POSITION"] = Array(
			"PARENT" => "TEMPLTE",
			"NAME" => GetMessage("TP_ERROR_MESSAGES_POSITION"),
			"TYPE" => "LIST",
			"VALUES" => $arErrMsgPos,
		);	
	}
?>