<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/cab.extfeedbackform/prolog.php");

ClearVars(); //очистка глобальных переменных с префиксом (default = str_)

$EFBF_RIGHT = $APPLICATION->GetGroupRight("cab.extfeedbackform");
if($EFBF_RIGHT=="D") $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/cab.extfeedbackform/include.php");

IncludeModuleLangFile(__FILE__);
$err_mess = "File: ".__FILE__."<br>Line: ";

$aTabs = array(
	array("DIV" => "edit1", "TAB" => GetMessage("EFBF_FORM_PROP"), "ICON" => "main_channel_edit", "TITLE" => GetMessage("EFBF_FORM_PROP_TITLE")),
);

$tabControl = new CAdminTabControl("tabControl", $aTabs);
$message = null;
$bVarsFromForm = false;

/********************************************************************
				Functions
********************************************************************/
function CheckFields() 
{
	global $DB, $NAME, $CODE, $err_mess, $ID;
	$str = "";
	$CODE = trim($CODE);
	
	if (strlen(trim($NAME))<=0) 
		$aMsg[] = array("id"=>"NAME", "text"=>GetMessage("EFBF_FORGOT_NAME"));

	if (strlen($CODE)<=0) 
		$aMsg[] = array("id"=>"CODE", "text"=>GetMessage("EFBF_FORGOT_CODE"));
	else
	{
		if (preg_match("/[^a-z_0-9]/is", $CODE, $matches))
			$aMsg[] = array("id"=>"CODE", "text"=>GetMessage("EFBF_INCORRECT_CODE")); 
		else
		{
			$arFilter = array(
				"CODE"				=> $CODE, 
				"CODE_EXACT_MATCH"	=> "Y"
				);
				
			if($ID)	$arFilter['ID'] = '~'.$ID;

			$a = CEFBF_Forms::GetList(array(), $arFilter);
			if ($ar = $a->Fetch()) 
				$aMsg[] = array("id"=>"CODE", "text"=>str_replace("#CODE#", $ar["CODE"], GetMessage("EFBF_CODE_ALREADY_IN_USE")));
		}
	}
	if(!empty($aMsg))
	{
		$e = new CAdminException($aMsg);
		$GLOBALS["APPLICATION"]->ThrowException($e);
		return false;
	}

	return true;
}


/********************************************************************
				Actions 
********************************************************************/
$ID = intval($ID);

if ((strlen($save)>0 || strlen($apply)>0) && $REQUEST_METHOD=="POST" && $EFBF_RIGHT>="W" && check_bitrix_sessid())
{
	if (CheckFields())
	{
		$DB->PrepareFields("cab_efbf_forms");
		
		$arFields = array(
			"CODE"		=> "upper('".$str_CODE."')",
			"NAME"	=> "'".$str_NAME."'",
		);

        if ($ID>0) {
            $DB->Update("cab_efbf_forms",$arFields,"WHERE ID='".$ID."'",$err_mess.__LINE__);
        }
        else 
        {
            $ID = $DB->Insert("cab_efbf_forms",$arFields, $err_mess.__LINE__);
            $new = "Y";
        }
		
		if (strlen($save)>0) 
			LocalRedirect("cab.extfeedbackform_efbf_forms.php?lang=".LANGUAGE_ID);
		else 
			LocalRedirect($APPLICATION->GetCurPage()."?lang=".LANGUAGE_ID."&ID=".$ID."&".$tabControl->ActiveTabParam());		
	}
	else
	{
		$str_CODE=htmlspecialchars($CODE);
		$str_NAME=htmlspecialchars($NAME);
		
		if($e = $APPLICATION->GetException()) $message = new CAdminMessage(GetMessage("EFBF_GOT_ERROR"), $e);
		
		$bVarsFromForm = true;
	}
}


if(!$bVarsFromForm){
	$form = CEFBF_Forms::GetByID($ID);
	if (!($form && $form->ExtractFields()))
	{
		$ID=0; 
	}
}

if (strlen($strError)>0) $DB->InitTableVarsForEdit("cab_efbf_forms", "", "str_");

$sDocTitle = ($ID>0) ? str_replace("#ID#", $ID, GetMessage("EFBF_FORM_EDIT_RECORD")) : GetMessage("EFBF_FORM_NEW_RECORD");
$APPLICATION->SetTitle($sDocTitle);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

/********************************************************************
				Form
********************************************************************/
$aMenu = array();
$aMenu[] = array(
	"TEXT"	=> GetMessage("EFBF_FORMS_LIST"),
	"TITLE" => GetMessage("EFBF_FORMS_LIST_TITLE"),
	"LINK"	=> "/bitrix/admin/cab.extfeedbackform_efbf_forms.php?lang=".LANGUAGE_ID,
	"ICON" => "btn_list"
);

if ($ID>0)
{
	if ($EFBF_RIGHT=="W")
	{
        $aMenu[] = array(
            "TEXT"	=> GetMessage("EFBF_FORM_CREATE"),
            "TITLE"	=> GetMessage("EFBF_FORM_CREATE_TITLE"),
            "LINK"	=> "/bitrix/admin/cab.extfeedbackform_efbf_forms_edit.php?lang=".LANGUAGE_ID,
            "ICON" => "btn_new");

		$aMenu[] = array(
			"TEXT"	=> GetMessage("EFBF_FORM_DELETE"), 
			"TITLE"	=> GetMessage("EFBF_FORM_DELETE_TITLE"),
			"LINK"	=> "javascript:if(confirm('".GetMessage("EFBF_FORM_DELETE_RECORD_CONFIRM")."')) window.location='/bitrix/admin/cab.extfeedbackform_efbf_forms.php?action=delete&ID=".$ID."&".bitrix_sessid_get()."&lang=".LANGUAGE_ID."';",
			"ICON" => "btn_delete"
			);
	}
/*
	$aMenu[] = array(
		"NEWBAR" => "Y"
		);
*/		
}

$context = new CAdminContextMenu($aMenu);
$context->Show();

if($message) echo $message->Show();

?>
<form method="POST" action="<?=$APPLICATION->GetCurPage()?>" name="post_form">
<?=bitrix_sessid_post()?>
<input type="hidden" name="ID" value=<?=$ID?>>
<input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
<?
$tabControl->Begin();
?>
<?
//********************
//General Tab
//********************
$tabControl->BeginNextTab();
?>
	<tr>
		<td><span class="required">*</span><?=GetMessage("EFBF_NAME")?></td>
		<td><input type="text" name="NAME" size="60" maxlength="255" value="<?=$str_NAME?>"></td>
	</tr>
	<tr>
		<td><span class="required">*</span><?=GetMessage("EFBF_CODE")?></td>
		<td><input type="text" name="CODE" size="20" maxlength="255" value="<?=$str_CODE?>"></td>
	</tr>
<?
$tabControl->Buttons(array("disabled"=>($EFBF_RIGHT<"W"), "back_url"=>"cab.extfeedbackform_efbf_forms.php?lang=".LANGUAGE_ID));
$tabControl->End();
?>


</form>
<?
$tabControl->ShowWarnings("post_form", $message);
?>
<?echo BeginNote();?>
<span class="required">*</span> - <?echo GetMessage("REQUIRED_FIELDS")?>
<?echo EndNote();?>
<?
require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php"); 
?>