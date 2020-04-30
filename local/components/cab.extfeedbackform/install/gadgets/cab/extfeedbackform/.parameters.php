<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$MODULE_ID = 'cab.extfeedbackform';

$arForms = array();
if(CModule::IncludeModule($MODULE_ID)){
	$res = CEFBF_Forms::GetList(array('NAME' => 'ASC'), array());
	while($ar = $res->Fetch()){
		$arForms[$ar['CODE']] = '['.$ar['CODE'].'] '.$ar['NAME'];
	}
}

$arParameters = Array(
	"PARAMETERS"=> Array(), //���������, ����� ��� ���� �������������
	
	//���������, ���������� ��� ������� ������������
	"USER_PARAMETERS"=> Array(
		//������ ������, ������� ������ ��������� ������
		"HIDE_GRAPH" => Array(
			"NAME" => GetMessage("GD_CAB_EFBF_P_HIDE_GRAPH"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"REFRESH" => "Y"
		),
		
		//�����
		"FORM_CODES"=> array(
			"NAME" => GetMessage("GD_CAB_EFBF_P_FORMS"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arForms,
		),		
	)
);

if (
	!is_array($arAllCurrentValues)
	|| !array_key_exists("HIDE_GRAPH", $arAllCurrentValues)
	|| $arAllCurrentValues["HIDE_GRAPH"]["VALUE"] != "Y"
)
{
	//������ �� N ���-�� ���� �����
	$arParameters["USER_PARAMETERS"]["GRAPH_DAYS"]	= array(
		"NAME" => GetMessage("GD_CAB_EFBF_P_GRAPH_DAYS"),
		"TYPE" => "STRING",
		"DEFAULT" => "30"
	);

	//������
	$arParameters["USER_PARAMETERS"]["GRAPH_WIDTH"]	= array(
		"NAME" => GetMessage("GD_CAB_EFBF_P_GRAPH_WIDTH"),
		"TYPE" => "STRING",
		"DEFAULT" => "500"
	);

	//������
	$arParameters["USER_PARAMETERS"]["GRAPH_HEIGHT"]	= array(
		"NAME" => GetMessage("GD_CAB_EFBF_P_GRAPH_HEIGHT"),
		"TYPE" => "STRING",
		"DEFAULT" => "300"
	);	
}
?>