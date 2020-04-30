<?
class CEFBF_Stat
{
	function err_mess()
	{
		$module_id = "cab.extfeedbackform ";
		return "<br>Module: ".$module_id."<br>Class: CEFBF_Forms<br>File: ".__FILE__;
	}
	
	function GetCommonValues($arFilter = array()){
		global $DB;

		if(is_array($arFilter['FORM_CODE'])){
			foreach($val as &$item) $item = $DB->ForSql($item);
			
			$arSqlSearch[] = "(m.FORM_CODE='".implode("' || m.FORM_CODE='", $arFilter['FORM_CODE'])."')";
		}else{
			$arSqlSearch[] = "m.FORM_CODE='".$DB->ForSql($arFilter['FORM_CODE'])."'";
		}
		
		$strSqlSearch = '';
		if($arSqlSearch) $strSqlSearch = ' and ('.implode(') and (', $arSqlSearch).') ';
		
		$strSql = "
			SELECT
				count(m.ID) 									TOTAL_CNT,
				sum(if(to_days(curdate())=to_days(m.DT),1,0))	TODAY_CNT,
				sum(if(to_days(curdate())-to_days(m.DT)=1,1,0))	YESTERDAY_CNT,
				sum(if(to_days(curdate())-to_days(m.DT)=2,1,0))	B_YESTERDAY_CNT
			FROM
				cab_efbf_messages m
			WHERE 1=1 $strSqlSearch
		";
		
		$result = false;
		$rs = $DB->Query($strSql);
		if($rs)
		{
			if($result = $rs->Fetch())
			{
				foreach($result as $key=>$value)
					$result[$key] = intval($value);
			}
		}
		return $result;
	}
	
	function DynamicDays($d1, $d2, $FORM_CODE){
		$cnt = 0;
		if($res = self::GetDailyList(array('DATE1' => $d1, 'DATE2' => $d2, 'FORM_CODE' => $FORM_CODE)))
			$cnt = $res->SelectedRowsCount();
		
		return $cnt;
	}
	
	//���������� ������� �� ���� �� ������
	function GetDailyList($arFilter = Array()){
		global $DB;
		
		$arSqlSearch = Array();
		$strSqlSearch = "";
		
		foreach ($arFilter as $key => $val){
			$key = strtoupper($key);
			switch($key){
			case "DATE1":
				if (CheckDateTime($val))
					$arSqlSearch[] = "m.dt>=".$DB->CharToDateFunction($val, "SHORT");
				break;
			case "DATE2":
				if (CheckDateTime($val))
					$arSqlSearch[] = "m.dt<".$DB->CharToDateFunction($val, "SHORT")." + INTERVAL 1 DAY";
				break;
			case "FORM_CODE":
				if(is_array($val)){
					foreach($val as &$item) $item = $DB->ForSql($item);
					
					$arSqlSearch[] = "(m.FORM_CODE='".implode("' || m.FORM_CODE='", $val)."')";
				}else{
					$arSqlSearch[] = "m.FORM_CODE='".$DB->ForSql($val)."'";
				}
				break;
			}
		}
		
		if($arSqlSearch) $strSqlSearch = ' and ('.implode(') and (', $arSqlSearch).') ';
		
		$strSqlOrder = "ORDER BY m.FORM_CODE asc, m.DT asc";
		
		$strSql = "
			SELECT 
				count(m.id) as CNT,
				DATE(m.DT) as DT,
				DAYOFMONTH(m.DT) DAY,
				MONTH(m.DT) MONTH,
				YEAR(m.DT) YEAR,
				WEEKDAY(m.DT) WDAY,
				m.FORM_CODE as FORM_CODE,
				f.NAME as FORM_NAME
			FROM
				cab_efbf_messages m
				LEFT JOIN cab_efbf_forms f on f.CODE=m.FORM_CODE
			WHERE 1=1 $strSqlSearch
			GROUP BY DATE(m.DT), DAYOFMONTH(m.DT), MONTH(m.DT), YEAR(m.DT), WEEKDAY(m.DT), m.FORM_CODE, f.NAME
			$strSqlOrder
		";		

		$res = $DB->Query($strSql);
		
		return $res;
	}
}
?>