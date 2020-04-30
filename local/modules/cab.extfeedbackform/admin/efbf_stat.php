<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
$MODULE_ID = 'cab.extfeedbackform';
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/$MODULE_ID/prolog.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/$MODULE_ID/include.php");

IncludeModuleLangFile(__FILE__);

//права достпа
$EFBF_RIGHT = $APPLICATION->GetGroupRight($MODULE_ID);
if($EFBF_RIGHT=="D")
	$APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

//подключаем массив цветов модуля 
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/$MODULE_ID/colors.php");

$arFindCodes = array();
$res = CEFBF_Forms::GetList(array('NAME' => 'ASC'), array());
while($ar = $res->fetch()){
	$arFindCodes[$ar['CODE']] = '['.$ar['CODE'].'] '.$ar['NAME'];
	$ar_find_codes["REFERENCE"][] = '['.$ar['CODE'].'] '.$ar['NAME'];
	$ar_find_codes["REFERENCE_ID"][] = $ar['CODE'];
	$find_codes_def[] = $ar['CODE'];
}	

/*--------------------------------------------------------------*/
$FilterArr = Array(
	"find_date1",
	"find_date2",
	"find_codes",
);

$sTableID = "efbf_by_date";
$oSort = new CAdminSorting($sTableID);
$lAdmin = new CAdminList($sTableID, $oSort);

$lAdmin->InitFilter($FilterArr);
if(!$find_codes) $find_codes = $find_codes_def;

$arFilter = Array(
	"DATE1"	=> $find_date1,
	"DATE2"	=> $find_date2,
	"FORM_CODE" => $find_codes,
);

$arrStat = CEFBF_Stat::GetDailyList($arFilter);

$rsData = new CAdminResult($arrStat, $sTableID); //var_dump($arrStat);
$rsData->NavStart();
$lAdmin->NavText($rsData->GetNavPrint(GetMessage('VSS_DATE_TABLE_TITLE')));

$arHeaders[]=
	array(	"id"	=>"CODE",
		"content"	=>GetMessage('EFBF_FORM'),
		"sort"		=>"dt",
		"align"		=>"left",
		"default"	=>true
	);
$arHeaders[]=
	array(	"id"	=>"DATE",
		"content"	=>GetMessage('EFBF_DATE'),
		"sort"		=>"dt",
		"align"		=>"left",
		"default"	=>true
	);
$arHeaders[]=
	array(	"id"	=>"CNT",
		"content"	=>GetMessage('EFBF_CNT'),
		"sort"		=>"",
		"align"		=>"left",
		"default"	=>true
	);

$lAdmin->AddHeaders($arHeaders);
while($arRes = $rsData->NavNext(true, "f_"))
{
	$row =& $lAdmin->AddRow($f_DT, $arRes);
	
	$row->AddViewField("CODE", '['.$f_FORM_CODE.'] '.$f_FORM_NAME);
	$row->AddViewField("DATE", $f_DT);
	$row->AddViewField("CNT", $f_CNT);
}

$arFooter = array();
$arFooter[] = array(
	"title"=>GetMessage("VSS_LIST_SELECTED"),
	"value"=>$rsData->SelectedRowsCount(),
	);
$lAdmin->AddFooter($arFooter);

/*--------------------------------------------------------------*/
$lAdmin->BeginPrologContent();
echo CAdminMessage::ShowMessage($strError);

$iGraphWidth = 550;
$iGraphHeight = 300;

?>
<div>
	<div>
		<img src="/bitrix/admin/<?=ADMIN_MODULE_NAME?>_efbf_stat_graph.php?<?=GetFilterParams($FilterArr)?>&width=<?=$iGraphWidth?>&height=<?=$iGraphHeight?>&rand=<?=rand()?>&find_graph_type=date" width="<?=$iGraphWidth?>" height="<?=$iGraphHeight?>">
		<div style="padding: 0 0 10px 0;">
		<table class="legend" cellpadding="2" cellspacing="0" border="0">
			<?foreach($find_codes as $key => $code):?>
			<tr>
				<td valign="center"><img src="/bitrix/admin/<?=ADMIN_MODULE_NAME?>_efbf_stat_graph_legend.php?color=<?=$arrColor[$key]?>" width="45" height="2"></td>
				<td nowrap class="bx-gadgets"><img src="/bitrix/images/1.gif" width="3" height="1"><?=$arFindCodes[$code]?></td>
			</tr>
			<?endforeach;?>
		</table>
		</div>
	</div>	
</div>
<div style="clear:left"></div>
<?
$lAdmin->EndPrologContent();
/*--------------------------------------------------------------*/
?>
<div id="blockstat">
<?
$lAdmin->AddAdminContextMenu(array());
$lAdmin->CheckListMode();

$APPLICATION->SetTitle(GetMessage("UF_PAGE_TITLE"));
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/cab.extfeedbackform/include/logo.php");
/*--------------------------------------------------------------*/

$FilterFields[] = GetMessage("EFBF_F_FORMS");

$filter = new CAdminFilter(
	$sTableID."_filter_id",
	$FilterFields
);
?>

<form name="form1" method="POST" action="<?=$APPLICATION->GetCurPage()?>?">
<input type="hidden" name="lang" value="<?=htmlspecialchars(LANGUAGE_ID)?>">
<?$filter->Begin();
?>
<tr valign="center">
	<td width="0%" nowrap><?echo GetMessage("EFBF_F_PERIOD")." (".CSite::GetDateFormat("SHORT")."):"?></td>
	<td width="0%" nowrap><?echo CalendarPeriod("find_date1", $find_date1, "find_date2", $find_date2, "form1", "Y")?></td>
</tr>
<tr valign="center">
	<td width="0%" nowrap><?echo GetMessage("EFBF_F_FORMS")?></td>
	<td width="0%" nowrap>
	<?echo SelectBoxMFromArray("find_codes[]", $ar_find_codes, $find_codes, "", false, "11", 'id="find_codes"');?>
	</td>
</tr>
<?
$filter->Buttons();
?>
<input type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("EFBF_F_FIND")?>" title="<?=GetMessage("EFBF_F_FIND_TITLE")?>">
<input type="submit" name="del_filter" value="<?=GetMessage("EFBF_F_CLEAR")?>" title="<?=GetMessage("EFBF_F_CLEAR_TITLE")?>">
<?
$filter->End();
?>
</form>

<?
/*--------------------------------------------------*/

$lAdmin->DisplayList();
?>
</div><!-- id="blockstat" -->
<style>
#blockstat .legend{
	font-size: 12px;
}
</style>


<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
?>