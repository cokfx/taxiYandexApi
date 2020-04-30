<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
$MODULE_ID = 'cab.extfeedbackform';

//���������� ������ 
if(!CModule::IncludeModule($MODULE_ID)) return false;

//��������� ����� ������� � ������
if($GLOBALS["APPLICATION"]->GetGroupRight($MODULE_ID)=="D") return false;

//���������� ������ ������ ������ 
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$MODULE_ID."/colors.php");

/*
$arGadgetParams - ������ � ����������� �������; 
*/

$arFindCodes = array();
$res = CEFBF_Forms::GetList(array('NAME' => 'ASC'), array());
while($ar = $res->Fetch()) $arFindCodes[$ar['CODE']] = $ar['NAME'];

if(!$arGadgetParams["FORM_CODES"])
	foreach($arFindCodes as $code => $name) $arGadgetParams["FORM_CODES"][] = $code;

//���������� ������ ��������� �����, ��������� �� ��������� ��������
$arGadgetParams["RND_STRING"] = randString(8);

$arGadgetParams["HIDE_GRAPH"] = ($arGadgetParams["HIDE_GRAPH"] == "Y" ? "Y" : "N");

if ($arGadgetParams["HIDE_GRAPH"] != "Y")
{	//����������� �� ���-�� ���� �� 0 �� 400
	if (intval($arGadgetParams["GRAPH_DAYS"]) <= 0 || intval($arGadgetParams["GRAPH_DAYS"]) > 400)
		$arGadgetParams["GRAPH_DAYS"] = 30;

	//������ ������ ������ 
	$arGadgetParams["GRAPH_PARAMS"] = array("CNT");

	//����������� �� ������ �� 50 �� 1000
	if (intval($arGadgetParams["GRAPH_WIDTH"]) <= 50 || intval($arGadgetParams["GRAPH_WIDTH"]) > 1000)
		$arGadgetParams["GRAPH_WIDTH"] = 500;
		
	//����������� �� ������ �� 50 �� 1000	
	if (intval($arGadgetParams["GRAPH_HEIGHT"]) <= 50 || intval($arGadgetParams["GRAPH_HEIGHT"]) > 1000)
		$arGadgetParams["GRAPH_HEIGHT"] = 300;
}

$now_date = GetTime(time()); //�������
$yesterday_date = GetTime(time()-86400); //�����
$bef_yesterday_date = GetTime(time()-172800); //���������

//�������� ���������� ������
foreach($arGadgetParams["FORM_CODES"] as $key => $code){
	$arFilter = array('FORM_CODE' => $code);
	$arComm[$key] = CEFBF_Stat::GetCommonValues($arFilter);
	$arRows[$key] = array("NAME" => $arFindCodes[$code]/*, "LINK" => "event_log.php"*/);	
}

//���������� ������ �� ��������� ������
$arFilter = array('FORM_CODE' => $arGadgetParams["FORM_CODES"]);
$arComm[] = CEFBF_Stat::GetCommonValues($arFilter);
$arRows[] = array("NAME" => GetMessage("GD_CAB_EFBF_CNT")/*, "LINK" => "event_log.php"*/);


//����������� ���� ���������, �����, ������� � "��������" ������� (����)
$date_beforeyesterday = ConvertTimeStamp(AddToTimeStamp(array("DD" => -2, "MM" => 0, "YYYY" => 0, "HH" => 0, "MI" => 0, "SS" => 0), mktime(0, 0, 0, date("n"), date("j"), date("Y"))), "SHORT");
$date_yesterday = ConvertTimeStamp(AddToTimeStamp(array("DD" => -1, "MM" => 0, "YYYY" => 0, "HH" => 0, "MI" => 0, "SS" => 0), mktime(0, 0, 0, date("n"), date("j"), date("Y"))), "SHORT");
$date_today = ConvertTimeStamp(mktime(0, 0, 0, date("n"), date("j"), date("Y")), "SHORT");

if ($arGadgetParams["HIDE_GRAPH"] != "Y")
{
	$iGraphWidth = $arGadgetParams["GRAPH_WIDTH"];
	$iGraphHeight = $arGadgetParams["GRAPH_HEIGHT"];
	
	//��������� ���� �� �������, ������ �� �������� ����������
	$dateGraph1 = ConvertTimeStamp(AddToTimeStamp(array("DD" => -($arGadgetParams["GRAPH_DAYS"]), "MM" => 0, "YYYY" => 0, "HH" => 0, "MI" => 0, "SS" => 0), time()), "SHORT");
	//�������� ���� �� �������
	$dateGraph2 = ConvertTimeStamp(time(), "SHORT");

	//�������� ������ ������ �� ����
	$days = CEFBF_Stat::DynamicDays($dateGraph1, $dateGraph2, $arGadgetParams["FORM_CODES"]);

	if ($days < 2)
		//��� ���-�� ������ ������ 2-� ���� ���������� ��������� � ������������� ���-�� ������
		CAdminMessage::ShowMessage(GetMessage("STAT_NOT_ENOUGH_DATA"));
	else
	{		
		$strGraphParams .= "find_date1=".$dateGraph1."&find_date2=".$dateGraph2.'&find_codes[]='.implode('&find_codes[]=', $arGadgetParams["FORM_CODES"]);		
		?>
		<img src="/bitrix/admin/<?=$MODULE_ID?>_efbf_stat_graph.php?<?=$strGraphParams?>&width=<?=$iGraphWidth?>&height=<?=$iGraphHeight?>&rand=<?=rand()?>&find_graph_type=date" width="<?=$iGraphWidth?>" height="<?=$iGraphHeight?>">
		<div style="padding: 0 0 10px 0;">
		<table cellpadding="2" cellspacing="0" border="0">
			<?foreach($arGadgetParams["FORM_CODES"] as $key => $code):?>
			<tr>
				<td valign="center"><img src="/bitrix/admin/<?=$MODULE_ID?>_efbf_stat_graph_legend.php?color=<?=$arrColor[$key]?>" width="45" height="2"></td>
				<td nowrap class="bx-gadgets"><img src="/bitrix/images/1.gif" width="3" height="1"><?=$arFindCodes[$code]?></td>
			</tr>
			<?endforeach;?>
			
		</table>
		</div>
		<?
	}
}
?>
<!-- ������� �������� � �������: 1 �������� -->
<script type="text/javascript">
	var gdSaleTabControl_<?=$arGadgetParams["RND_STRING"]?> = false;
</script>
<div class="bx-gadgets-tabs-wrap" id="bx_gd_tabset_stat_<?=$arGadgetParams["RND_STRING"]?>">
	<div class="bx-gadgets-tabs">
		<span onclick="gdSaleTabControl_<?=$arGadgetParams["RND_STRING"]?>.SelectTab(this)" id="bx_gd_stat_common_<?=$arGadgetParams["RND_STRING"]?>" class="bx-gadgets-tab-wrap bx-gadgets-tab-active bx-gadgets-tab-first">
			<span class="bx-gadgets-tab-left"></span>
			<span class="bx-gadgets-tab-text"><?=GetMessage("GD_CAB_EFBF_TAB_COMMON")?></span>
			<span class="bx-gadgets-tab-right"></span>
		</span>
	</div>
	<div class="bx-gadgets-tabs-cont">
		<div id="bx_gd_stat_common_<?=$arGadgetParams["RND_STRING"]?>_content" style="display: block;" class="bx-gadgets-tab-container">
			<table class="bx-gadgets-table">
				<tbody>
					<tr>
						<th>&nbsp;</th>
						<th><?=GetMessage("GD_CAB_EFBF_TODAY")?><br><?=$now_date?></th>
						<th><?=GetMessage("GD_CAB_EFBF_YESTERDAY")?><br><?=$date_yesterday?></th>
						<th><?=GetMessage("GD_CAB_EFBF_B_YESTERDAY")?><br><?=$date_beforeyesterday?></th>
						<th><?=GetMessage("GD_CAB_EFBF_TOTAL")?></th>
					</tr>
					<?
					$RowsLastIdx = count($arRows)-1;
					$b = ''; $_b = '';
					foreach($arRows as $key => $arRow):
						$row_code = 'CNT';
						if($RowsLastIdx == $key){$b = '<b>'; $_b = '</b>';}
						?>
						<tr>
							<td><?=$b.$arRow["NAME"].$_b?></td>
							<?
							if (array_key_exists("TODAY_".$row_code, $arComm[$key])):?>
								<td align="center"><?=$b?>
									<?if (array_key_exists("LINK", $arRow)):?>
										<a href="/bitrix/admin/<?=$arRow["LINK"]?>?find_date1=<?=$date_today?>&find_date2=<?=$date_today?><?=$strFilterSite?>&set_filter=Y&lang=<?=LANGUAGE_ID?>">
									<?endif;?>
										<?=intval($arComm[$key]["TODAY_".$row_code])?>
									<?if (array_key_exists("LINK", $arRow)):?></a><?endif;?>
									<?=$_b?>
								</td><?
							else:
								?><td>&nbsp;</td><?
							endif;
							?>
							<?
							if (array_key_exists("YESTERDAY_".$row_code, $arComm[$key])):
								?><td align="center"><?=$b?><?if (array_key_exists("LINK", $arRow)):?><a href="/bitrix/admin/<?=$arRow["LINK"]?>?find_date1=<?=$date_yesterday?>&find_date2=<?=$date_yesterday?><?=$strFilterSite?>&set_filter=Y&lang=<?=LANGUAGE_ID?>"><?endif;?><?=intval($arComm[$key]["YESTERDAY_".$row_code])?><?if (array_key_exists("LINK", $arRow)):?></a><?endif;?><?=$_b?></td><?
							else:
								?><td>&nbsp;</td><?
							endif;
							?>
							<?
							if (array_key_exists("B_YESTERDAY_".$row_code, $arComm[$key])):
								?><td align="center"><?=$b?><?if (array_key_exists("LINK", $arRow)):?><a href="/bitrix/admin/<?=$arRow["LINK"]?>?find_date1=<?=$date_beforeyesterday?>&find_date2=<?=$date_beforeyesterday?><?=$strFilterSite?>&set_filter=Y&lang=<?=LANGUAGE_ID?>"><?endif;?><?=intval($arComm[$key]["B_YESTERDAY_".$row_code])?><?if (array_key_exists("LINK", $arRow)):?></a><?endif;?><?=$_b?></td><?
							else:
								?><td>&nbsp;</td><?
							endif;
							?>
							<?
							if (array_key_exists("TOTAL_".$row_code, $arComm[$key])):
								?><td align="center"><?=$b?><?if (array_key_exists("LINK", $arRow)):?><a href="/bitrix/admin/<?=$arRow["LINK"]?><?=$strFilterSite?>?set_filter=Y&lang=<?=LANGUAGE_ID?>"><?endif;?><?=intval($arComm[$key]["TOTAL_".$row_code])?><?if (array_key_exists("LINK", $arRow)):?></a><?endif;?><?=$_b?></td><?
							else:
								?><td>&nbsp;</td><?
							endif;
							?>
						</tr>
						<?
					endforeach;
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	BX.ready(function(){
		gdSaleTabControl_<?=$arGadgetParams["RND_STRING"]?> = new gdTabControl('bx_gd_tabset_stat_<?=$arGadgetParams["RND_STRING"]?>');
	});
</script>