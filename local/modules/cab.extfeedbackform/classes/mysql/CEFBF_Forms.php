<?
class CEFBF_Forms
{
	function err_mess()
	{
		$module_id = "cab.extfeedbackform ";
		return "<br>Module: ".$module_id."<br>Class: CEFBF_Forms<br>File: ".__FILE__;
	}
	
	function GetList($arSort = array(), $arFilter=Array()){
		global $DB;
		$err_mess = (CEFBF_Forms::err_mess())."<br>Function: GetList<br>Line: ";
		
		$arSqlSearch = Array();
		$strSqlSearch = "";
		if (is_array($arFilter))
		{
			foreach ($arFilter as $key => $val)
			{
				if(is_array($val))
				{
					if(count($val) <= 0)
						continue;
				}
				else
				{
					if( (strlen($val) <= 0) || ($val === "NOT_REF") )
						continue;
				}
				$match_value_set = array_key_exists($key."_EXACT_MATCH", $arFilter);
				$key = strtoupper($key);
				switch($key)
				{
					case "ID":
						$arSqlSearch[] = GetFilterQuery("F.ID",$val,'N');
						break;
					case "NAME":
						$match = ($arFilter[$key."_EXACT_MATCH"]=="Y" && $match_value_set) ? "N" : "Y";
						$arSqlSearch[] = GetFilterQuery("F.NAME",$val,$match);
						break;
					case "CODE":
						$match = ($arFilter[$key."_EXACT_MATCH"]=="Y" && $match_value_set) ? "N" : "Y";
						$arSqlSearch[] = GetFilterQuery("F.CODE",$val,$match);
						break;
				}
			}
		}
		
		$arSqlOrder = array();
		foreach($arSort as $key => $val){
			$arSqlOrder[] = 'F.'.$key.' '.$val;
		}
		
		if($arSqlOrder) 
			$strSqlOrder = implode(',', $arSqlOrder);
		else
			$strSqlOrder = 'F.ID ASC';
			
		$strSqlSearch = GetFilterSqlSearch($arSqlSearch);
		$strSql = "
			SELECT F.ID, F.CODE, F.NAME
			FROM cab_efbf_forms F
			WHERE $strSqlSearch
			ORDER BY ".$strSqlOrder;
		$res = $DB->Query($strSql, false, $err_mess.__LINE__);	
		return $res;
	}
	
	function GetById($ID){
		$err_mess = (CEFBF_Forms::err_mess())."<br>Function: GetByID<br>Line: ";
		global $DB;
		
		$ID = intval($ID);
		if ($ID <= 0) return ;
		
		$res = CEFBF_Forms::GetList(array(), array("ID" => $ID));
		return $res;
	}
	
	function Delete($ID)
	{
		global $DB;
		$err_mess = (CEFBF_Forms::err_mess())."<br>Function: Delete<br>Line: ";

		$ID = intval($ID);
		if ($ID <= 0)return true;
		
		$res = $DB->Query("DELETE FROM cab_efbf_forms WHERE ID=".$ID, false, $err_mess.__LINE__);
		return $res;
	}	
}
?>