<?if(!check_bitrix_sessid()) return;?>
<?
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/cab.extfeedbackform/install/index.php");

if($ex = $APPLICATION->GetException()):
	$message = new CAdminMessage(GetMessage("MOD_UNINST_ERR"), $ex);
	echo $message->Show();
else:
	echo CAdminMessage::ShowNote(GetMessage("MOD_UNINST_OK"));
endif;
?>
<form action="<?echo $APPLICATION->GetCurPage()?>">
	<input type="hidden" name="lang" value="<?echo LANG?>" />
	<input type="submit" name="" value="<?echo GetMessage("MOD_BACK")?>" />
</form>