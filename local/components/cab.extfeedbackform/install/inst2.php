<?if(!check_bitrix_sessid()) return;?>
<?
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/cab.extfeedbackform/install/index.php");

if($ex = $APPLICATION->GetException()):
	$message = new CAdminMessage(GetMessage("MOD_INST_ERR"), $ex);
	echo $message->Show();
else:
	echo CAdminMessage::ShowNote(GetMessage("MOD_INST_OK"));
	echo '<br/>';
	echo '<span style="font:13px Tahoma">';
	echo GetMessage('MOD_INFO');
	echo '</span>';
	echo '<br/>';
	echo '<br/>';
endif;
?>
<form action="<?echo $APPLICATION->GetCurPage()?>">
	<input type="hidden" name="lang" value="<?echo LANG?>" />
	<input type="submit" name="" value="<?echo GetMessage("MOD_BACK")?>" />
</form>