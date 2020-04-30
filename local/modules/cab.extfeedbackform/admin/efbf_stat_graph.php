<?
define("STOP_STATISTICS", true);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
$MODULE_ID = 'cab.extfeedbackform';

//подключаем модуль 
if(!CModule::IncludeModule($MODULE_ID)) return false;

//проверяем права доступа к модулю
$EFBF_RIGHT = $APPLICATION->GetGroupRight($MODULE_ID);
if($EFBF_RIGHT=="D")
	$APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/$MODULE_ID/colors.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/img.php");

$width = intval($_GET["width"]);
$max_width = 550;
if($width <= 0 || $width > $max_width) $width = $max_width;

$height = intval($_GET["height"]);
$max_height = 400;
if($height <= 0 || $height > $max_height) $height = $max_height;

// create image canvas
$ImageHandle = CreateImageHandle($width, $height, "FFFFFF", true);

$colorFFFFFF = ImageColorAllocate($ImageHandle,255,255,255);
ImageFill($ImageHandle, 0, 0, $colorFFFFFF);

$arrX=Array();
$arrY=Array();
$arrayX=Array();
$arrayY=Array();

$M['WEEKDAY_0'] = "Sun";
$M['WEEKDAY_1'] = "Mon";
$M['WEEKDAY_2'] = "Tue";
$M['WEEKDAY_3'] = "Wed";
$M['WEEKDAY_4'] = "Thu";
$M['WEEKDAY_5'] = "Fri";
$M['WEEKDAY_6'] = "Sat";

$M['MONTH_1'] = "Jan";
$M['MONTH_2'] = "Feb";
$M['MONTH_3'] = "Mar";
$M['MONTH_4'] = "Apr";
$M['MONTH_5'] = "May";
$M['MONTH_6'] = "June";
$M['MONTH_7'] = "Jule";
$M['MONTH_8'] = "Aug";
$M['MONTH_9'] = "Sep";
$M['MONTH_10'] = "Oct";
$M['MONTH_11'] = "Nov";
$M['MONTH_12'] = "Dec";

/******************************************************
                Plot data
*******************************************************/

if(!$find_codes){
	$find_codes = array();
	$res = CEFBF_Forms::GetList(array('NAME' => 'ASC'), array());
	while($ar = $res->fetch()) $find_codes = $ar['CODE'];	
}

$arFilter = Array(
	"DATE1" => $find_date1,
	"DATE2" => $find_date2,
);
$arrTTF_FONT = array();

if ($find_graph_type == "date"){
	$arrX = array();
	$arrY_cnt = array();
	foreach($find_codes as $key => $code){
		$arFilter['FORM_CODE'] = $code;
		
		$rsDays = CEFBF_Stat::GetDailyList($arFilter);
		$DaysCnt = $rsDays->SelectedRowsCount();
		$arPrevData = array('CNT' => 0);
		while($arData = $rsDays->Fetch())
		{
			$date = mktime(0, 0, 0, $arData["MONTH"], $arData["DAY"], $arData["YEAR"]);
			$date_tmp = 0;
			// when dates come not in order
			$next_date = AddTime($prev_date, 1, "D");
			if(($date > $next_date) && (intval($prev_date) > 0))
			{
				// fill date gaps
				$date_tmp = $next_date;
				while($date_tmp < $date)
				{
					$arrX[$key][] = $date_tmp;
					//$arrY_cnt[] = $arPrevData['CNT'];
					$arrY_cnt[$key][] = 0;

					$date_tmp = AddTime($date_tmp,1,"D");
				}
			}
			$arrX[$key][] = $date;
			$arrY_cnt[$key][] = intval($arData["CNT"]);

			$prev_date = $date;
			$arPrevData = $arData;
		}

		if($arrX[$key]){
			$arrX_MM[] = min($arrX[$key]);
			$arrX_MM[] = max($arrX[$key]);
		}		
		
		if($arrY_cnt[$key]){
			$arrY_MM[] = min($arrY_cnt[$key]);
			$arrY_MM[] = max($arrY_cnt[$key]);
		}
	}

	/******************************************************
				axis X
	*******************************************************/

	$arrayX = GetArrayX($arrX_MM, $MinX, $MaxX, 10);

	/******************************************************
				axis Y
	*******************************************************/

	$arrY = array();
	$arrY = array_merge($arrY, $arrY_cnt);

	$arrayY = GetArrayY($arrY_MM, $MinY, $MaxY);
	if(($MaxY - $MinY) < 10) $arrayY = GetArrayY($arrY_MM, $MinY, $MaxY, 'Y', true);
	
	DrawCoordinatGrid($arrayX, $arrayY, $width, $height, $ImageHandle, "FFFFFF", "B1B1B1", "000000", 15, 2, $arrTTF_FONT);

	/******************************************************
			data plot
	*******************************************************/
	foreach($find_codes as $key => $code){	
		Graf($arrX[$key], $arrY_cnt[$key], $ImageHandle, $MinX, $MaxX, $MinY, $MaxY, $arrColor[$key], "N");
	}
}

/******************************************************
		send image to client
*******************************************************/

ShowImageHeader($ImageHandle);
?>