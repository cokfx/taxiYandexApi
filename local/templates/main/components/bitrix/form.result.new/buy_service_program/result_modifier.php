<?
use \Bureau\Site as S;
use \Bureau\Site\Constant;

if (in_array($arParams['CACHE_TYPE'], ['A', 'Y']) && defined('BX_COMP_MANAGED_CACHE') && is_object($GLOBALS['CACHE_MANAGER']))
{
    $cp =& $this->__component;
    if (strlen($cp->__cachePath))
    {
        $cacheManager = \Bitrix\Main\Application::getInstance()->getTaggedCache();
        if (defined('BX_COMP_MANAGED_CACHE')) {
            $cacheManager->startTagCache($cp->__cachePath);
            $cacheManager->registerTag('iblock_id_' . Constant::PROGRAMS_FOR_PATIENTS_IBLOCK_ID);
            $cacheManager->endTagCache();
        }
    }
}

$arResult['FORM_RESULT'] = null;
$arResult['FORM_SUCCESS'] = false;
//$arResult['SHEDULE_ITEMS'] = array();
//$arResult['SERVICE_ITEM'] = null;


if(!empty($arResult['FORM_ERRORS_TEXT'])){
	$arResult['FORM_ERRORS_TEXT'] = str_replace("Ошибка! ", "", $arResult['FORM_ERRORS_TEXT']);
}

$isFormSuccess = ($_GET['WEB_FORM_ID'] == $arResult['arForm']['ID'] && $_GET['formresult'] == 'addok' && is_numeric($_GET['RESULT_ID']))?true:false;

//  Добавление отправленных значений при успешной отправке
if($isFormSuccess){
	$arAnswers = CFormResult::GetDataByID(
		intval($_REQUEST['RESULT_ID']),
		null,
		$arFormResult,
		$arAnswers2
	);

	if($arFormResult){
		$arFormResult['ANSWERS'] = $arAnswers;
		$arResult['FORM_RESULT'] = $arFormResult;
		$arResult['FORM_SUCCESS'] = true;
	}
}

// Результат формы при отправке AJAX-ом
if(S\Tools::isAjax() && (isset($_REQUEST['web_form_submit']) || $isFormSuccess)){
	$APPLICATION->RestartBuffer();
	$result = new S\Result();

	if($arResult["isFormNote"] == "Y"){
		$result->error[] = $arResult["FORM_NOTE"];
	}
	if($arResult["isFormErrors"] == "Y"){
		$result->setError($arResult["FORM_ERRORS_TEXT"]);
	}

	if($isFormSuccess){
		$result->setSuccess($arResult);
	}else{
		$result->setData($arResult);
	}

	/*
	echo "<pre>".var_export($_REQUEST, true)."</pre>";
	echo "<pre>".var_export($result->getArray(), true)."</pre>";
	echo "<pre>".var_export($arResult, true)."</pre>";
	*/
	echo $result->getJSON();
	die();
}
/*
if($arResult['arForm']['SID'] == 'SIGNUP_WEBINAR' && is_numeric($arParams['WEBINAR_ID']) && $arParams['WEBINAR_ID'] > 0){
	S\Helper::compileEntityByName('EventShedule');
	$ob = \EventSheduleTable::getList(array(
		'select' => array(
			'ID', 'UF_EVENT_ID', 'UF_DATE', 'UF_FROM', 'UF_TO', 'EVENT.ID', 'EVENT.CODE', 'EVENT.NAME', 'EVENT.IBLOCK_ID'
		),
		'filter' => array(
			//'=PROPERTY.CODE' => 'IS_WEBINAR',
			'>UF_DATE' => new \Bitrix\Main\Type\DateTime(),
			'=EVENT.ACTIVE' => 'Y',
			'=EVENT.ID' => intval($arParams['WEBINAR_ID']),
		),
		'order' => array(
			'UF_DATE' => 'ASC',
			'UF_FROM' => 'ASC',
		),
		'runtime' => array(
			'EVENT' => array(
				'data_type' => '\Bitrix\Iblock\ElementTable',
				'reference' => array(
					'=this.UF_EVENT_ID' => 'ref.ID'
				),
				'join_type' => 'inner'
			),
		),
	));

	$eventIds = array();
	while($arItem = $ob->fetch()){
		$arResult['SHEDULE_ITEMS'][] = $arItem;
	}
}

if($arResult['arForm']['SID'] == 'REQUEST_SERVICE' && is_numeric($arParams['SERVICE_ID']) && $arParams['SERVICE_ID'] > 0){
	S\Helper::compileEntityByName('ServiceItem');

	$arResult['SERVICE_ITEM'] = \ServiceItemTable::getRow(array(
		'filter' => array('ID'=>$arParams['SERVICE_ID']),
	));
}
*/

//  Добавление параметра ncc=1 для отключения композита при отправке формы
$regAction = "/(.*action=\")([^\"]*)(\".*)/i";
if(preg_match($regAction, $arResult["FORM_HEADER"])) {
	$action = preg_replace($regAction, "$2", $arResult["FORM_HEADER"]);
	$query = parse_url($action, PHP_URL_QUERY);
	if ($query) {
		$action .= '&ncc=1';
	} else {
		$action .= '?ncc=1';
	}
	/*
	$action = "/ajax/form.php?WEB_FORM_ID=".$arResult['arForm']['ID'];
    */
	$arResult["FORM_HEADER"] = preg_replace($regAction, "$1".$action."$3", $arResult["FORM_HEADER"]);
}