<?	
	if($_REQUEST['AJAX_CALL'] != 'Y'){
		$template_folder = $this->__template->__folder;
		
		switch($arParams['NEED_JQUERY']){
			case 'BITRIX_JQUERY' : 
				CUtil::InitJSCore(Array("jquery"));
				break;
			case 'EXISTS_JQUERY' : 
				break;
			default:
				$APPLICATION->AddHeadScript('/bitrix/js/cab.misc/jquery-1.6.1.js');
		}
	}
?>