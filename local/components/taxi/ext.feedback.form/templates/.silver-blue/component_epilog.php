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
				$APPLICATION->AddHeadScript('/bitrix/js/orion.misc/jquery-1.6.1.js');
		}

		$APPLICATION->AddHeadScript('/bitrix/js/orion.misc/radiobox/radiobox.js');			
		$APPLICATION->AddHeadScript('/bitrix/js/orion.misc/checkbox/checkbox.js');		
		$APPLICATION->AddHeadScript('/bitrix/js/orion.misc/cusel/js/cusel-2.5_1.js');		
		$APPLICATION->AddHeadScript('/bitrix/js/orion.misc/cusel/js/cusel-multiple-0.9_1.js');		
		
		$APPLICATION->AddHeadString('<link rel="stylesheet" type="text/css" href="'.$template_folder.'/css/checkbox.css">', true);
		$APPLICATION->AddHeadString('<link rel="stylesheet" type="text/css" href="'.$template_folder.'/css/radiobox.css">', true);		
		$APPLICATION->AddHeadString('<link rel="stylesheet" type="text/css" href="'.$template_folder.'/css/cusel.css">', true);
		$APPLICATION->AddHeadString('<link rel="stylesheet" type="text/css" href="'.$template_folder.'/css/cusel-multiple.css">', true);
		
	}
?>