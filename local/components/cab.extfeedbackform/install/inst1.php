<?IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/cab.extfeedbackform/install/index.php");?>
<form action="<?echo $APPLICATION->GetCurPage()?>">
<?=bitrix_sessid_post()?>
	<input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
	<input type="hidden" name="id" value="cab.extfeedbackform">
	<input type="hidden" name="install" value="Y">
	<input type="hidden" name="step" value="2">
	
	<input type="submit" name="inst" value="<?echo GetMessage("MOD_INST_RUN")?>">
</form>