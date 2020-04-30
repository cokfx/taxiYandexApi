<?
IncludeModuleLangFile(__FILE__);
Class cab_extfeedbackform extends CModule
{
	const MODULE_ID = 'cab.extfeedbackform';
	var $MODULE_ID = 'cab.extfeedbackform';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $strError = '';
	var $EventName = 'CAB_EXT_FEEDBACK_FORM_EVENT';
	var $UserEventName = 'CAB_EXT_FEEDBACK_FORM_EVENT_TO_USER';
	var $errors = false;

	function __construct()
	{
		$arModuleVersion = array();
		include(dirname(__FILE__)."/version.php");
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage("cab.extfeedbackform_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("cab.extfeedbackform_MODULE_DESC");

		$this->PARTNER_NAME = GetMessage("cab.extfeedbackform_PARTNER_NAME");
		$this->PARTNER_URI = GetMessage("cab.extfeedbackform_PARTNER_URI");
	}

	function InstallDB($arParams = array()){
		global $DB, $DBType, $APPLICATION;
		
		$this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/".self::MODULE_ID."/install/db/".$DBType."/install.sql");
		
		if($this->errors !== false)
		{
			$APPLICATION->ThrowException(implode("<br>", $this->errors));
			return false;
		}		
		
		RegisterModuleDependences('main', 'OnBuildGlobalMenu', self::MODULE_ID, 'CCabExFeedbackForm', 'OnBuildGlobalMenu');
		return true;
	}

	function UnInstallDB($arParams = array()){
		global $DB, $DBType, $APPLICATION;
	
		UnRegisterModuleDependences('main', 'OnBuildGlobalMenu', self::MODULE_ID, 'CCabExFeedbackForm', 'OnBuildGlobalMenu');
		
		if(isset($arParams['savedata']) && $arParams['savedata'] == 'Y'){}
			//save data
		else{
			//remove data
			$this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/".self::MODULE_ID."/install/db/".$DBType."/uninstall.sql");
		}

		if($this->errors !== false)
		{
			$APPLICATION->ThrowException(implode("<br>", $this->errors));
			return false;
		}
		
		return true;

	}

	function InstallEvents()
	{
		global $APPLICATION;
		
		//����� ���� ��������� �������
		if($ar = CEventType::GetList(array('TYPE_ID' => $this->EventName))->Fetch()) $EventTypeId = $ar['ID'];		
		if($ar = CEventType::GetList(array('TYPE_ID' => $this->UserEventName))->Fetch()) $UserEventTypeId = $ar['ID'];		
		
		if(!$EventTypeId){
			//��������� ��� ��������� �������
			$et = new CEventType;
			$arParams = array(
				"LID"           => SITE_ID,
				"EVENT_NAME"    => $this->EventName,
				"NAME"          => GetMessage(self::MODULE_ID."_EVENT_NAME"),
				"DESCRIPTION"   => GetMessage(self::MODULE_ID."_EVENT_DESCRIPTION"),
			);
			if(!$EventTypeId = $et->Add($arParams)){
				$this->errors[] = $et->LAST_ERROR;
			}	
		}		
		
		if(!$UserEventTypeId){
			//��������� ��� ��������� ������� ��� �������� ��������� ������������
			$et = new CEventType;
			$arParams = array(
				"LID"           => SITE_ID,
				"EVENT_NAME"    => $this->UserEventName,
				"NAME"          => GetMessage(self::MODULE_ID."_USER_EVENT_NAME"),
				"DESCRIPTION"   => GetMessage(self::MODULE_ID."_USER_EVENT_DESCRIPTION"),
			);
			if(!$UserEventTypeId = $et->Add($arParams)){
				$this->errors[] = $et->LAST_ERROR;
			}	
		}		
		
		$arSite = array();
		$res = CSite::GetList($by, $order, array('ACTIVE' => 'Y'));
		while($ar = $res->Fetch()){
			$arSite[] = $ar['ID'];
		}		
				
		if($EventTypeId) {
			//������ ������� ��� ��������� �������
			if($ar = CEventMessage::GetList($by, $order, array('TYPE_ID' => $this->EventName))->Fetch()) $EventMessageId = $ar['ID'];			
		
			if(!$EventMessageId){
				//��������� ������ ��� ��������� �������
				$emess = new CEventMessage;
				
				$arParams = array(
					'ACTIVE' => 'Y',
					'EVENT_NAME' => $this->EventName,
					"LID"        => $arSite,
					"EMAIL_FROM" => '#DEFAULT_EMAIL_FROM#',
					"EMAIL_TO"	 => '#EMAIL_TO#',
					"SUBJECT"	 => GetMessage(self::MODULE_ID."_EVENT_TEMPLATE_SUBJECT"),
					"BODY_TYPE"  => 'text',
					"MESSAGE"  	 => GetMessage(self::MODULE_ID."_EVENT_TEMPLATE_MESSAGE"),
				);
				
				if(!$EventMessageId = $emess->Add($arParams)){
					$this->errors[] = $emess->LAST_ERROR;
				}
			}
		}else{
			$this->errors[] = $et->LAST_ERROR;
		}

		if($UserEventTypeId) {
			//������ ������� ��� ��������� �������
			if($ar = CEventMessage::GetList($by, $order, array('TYPE_ID' => $this->UserEventName))->Fetch()) $UserEventMessageId = $ar['ID'];			
		
			if(!$UserEventMessageId){
				//��������� ������ ��� ��������� �������
				$emess = new CEventMessage;
				
				$arParams = array(
					'ACTIVE' => 'Y',
					'EVENT_NAME' => $this->UserEventName,
					"LID"        => $arSite,
					"EMAIL_FROM" => '#DEFAULT_EMAIL_FROM#',
					"EMAIL_TO"	 => '#USER_EMAIL_TO#',
					"SUBJECT"	 => GetMessage(self::MODULE_ID."_USER_EVENT_TEMPLATE_SUBJECT"),
					"BODY_TYPE"  => 'text',
					"MESSAGE"  	 => GetMessage(self::MODULE_ID."_USER_EVENT_TEMPLATE_MESSAGE"),
				);
				
				if(!$EventMessageId = $emess->Add($arParams)){
					$this->errors[] = $emess->LAST_ERROR;
				}
			}
		}else{
			$this->errors[] = $et->LAST_ERROR;
		}

		if($this->errors !== false){
			$APPLICATION->ThrowException(implode("<br>", $this->errors));
			return false;
		}		
	
		return true;
	}

	function UnInstallEvents($arParams = array())
	{	
		if(isset($arParams['savedata']) && $arParams['savedata'] == 'Y'){
			//save data
		}else{
			//������� �������� �������
			$emessage = new CEventMessage; 
			
			$res = CEventMessage::GetList($by, $order, array('TYPE_ID' => $this->EventName));
			while($ar = $res->Fetch()) {
				$emessage->Delete(intval($ar['ID']));		
			}
			
			$res = CEventMessage::GetList($by, $order, array('TYPE_ID' => $this->UserEventName));
			while($ar = $res->Fetch()) {
				$emessage->Delete(intval($ar['ID']));		
			}
			
			//������� ��� ��������� �������
			$et = new CEventType;
			$et->Delete($this->EventName);
			
			$et = new CEventType;
			$et->Delete($this->UserEventName);
		}
		
		return true;
	}

	function InstallFiles($arParams = array())
	{
		//�������
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || $item == 'menu.php')
						continue;
					file_put_contents($file = $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::MODULE_ID.'_'.$item,
					'<'.'? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/'.self::MODULE_ID.'/admin/'.$item.'");?'.'>');
				}
				closedir($dir);
			}
		}
		
		//���� �������
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/themes/.default'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/themes/.default/'.$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}		
		
		//js ������� (�����)
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/js'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/js/'.$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}		
		
		$src_fn = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/themes/.default/cab.extfeedbackform.css';
		$dest_fn = $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default/cab.extfeedbackform.css";
		copy($src_fn, $dest_fn);
		
		//����������
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/public/components'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/'.$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}		
		
		//������
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/gadgets'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/gadgets/'.$item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}
		
		return true;
	}

	function UnInstallFiles($arParams = array())
	{
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::MODULE_ID.'_'.$item);
				}
				closedir($dir);
			}
		}
		
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/themes/.default'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || !is_dir($p0 = $p.'/'.$item))
						continue;

					$dir0 = opendir($p0);
					while (false !== $item0 = readdir($dir0))
					{
						if ($item0 == '..' || $item0 == '.')
							continue;
						DeleteDirFilesEx('/bitrix/themes/.default/'.$item.'/'.$item0);
					}
					closedir($dir0);
				}
				closedir($dir);
			}
		}		
		
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/public/components'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || !is_dir($p0 = $p.'/'.$item))
						continue;

					$dir0 = opendir($p0);
					while (false !== $item0 = readdir($dir0))
					{
						if ($item0 == '..' || $item0 == '.')
							continue;
						DeleteDirFilesEx('/bitrix/components/'.$item.'/'.$item0);
					}
					closedir($dir0);
				}
				closedir($dir);
			}
		}		
		
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/gadgets'))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					if (is_dir($p0 = $p.'/'.$item))
					{
						$dir0 = opendir($p0);
						while (false !== $item0 = readdir($dir0))
						{
							if ($item0 == '..' || $item0 == '.')
								continue;
							DeleteDirFilesEx('/bitrix/gadgets/'.$item.'/'.$item0);
						}
						closedir($dir0);
					}
					else
						unlink($p);
				}
				closedir($dir);
			}
		}
		
		$dest_fn = $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default/cab.extfeedbackform.css";
		unlink($dest_fn);
		
		return true;
	}

	function DoInstall(){
		global $APPLICATION, $step;
	
		$step = IntVal($step);
		
		if ($step < 2){
			$APPLICATION->IncludeAdminFile(
				GetMessage(self::MODULE_ID."_INSTALL_TITLE"),
				$_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/inst1.php"
			);
		} elseif ($step == 2) {				
			$this->InstallFiles();
			$this->InstallDB();
			$this->InstallEvents();
			
			if($this->errors === false){
				RegisterModule(self::MODULE_ID);
			} else {
				$this->UnInstallEvents(array("savedata" => 'Y'));
				$this->UnInstallFiles(array("savedata" => 'Y'));
				$this->UnInstallDB(array("savedata" => 'Y'));
				COption::RemoveOption(self::MODULE_ID);
			}
			
		
			$APPLICATION->IncludeAdminFile(
				GetMessage(self::MODULE_ID."_INSTALL_TITLE"),
				$_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/inst2.php"
			);			
		}		
	}

	function DoUninstall(){
		global $APPLICATION, $step;
		
		$RIGHT = $APPLICATION->GetGroupRight(self::MODULE_ID);
		if ($RIGHT=="W")
		{
			if ($step < 2){
				$APPLICATION->IncludeAdminFile(
					GetMessage(self::MODULE_ID."_DELETE_TITLE"),
					$_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/uninst1.php"
				);
			} elseif ($step == 2) {		
				$this->UnInstallEvents(array(
					"savedata" => $_REQUEST["savedata"],
				));

				UnRegisterModule(self::MODULE_ID);			
				
				$this->UnInstallFiles(array(
					"savedata" => $_REQUEST["savedata"],
				));
				
				$this->UnInstallDB(array(
					"savedata" => $_REQUEST["savedata"],
				));
				
				//������� ��� ����������� ��������� ������
				COption::RemoveOption(self::MODULE_ID);

				$APPLICATION->IncludeAdminFile(
					GetMessage(self::MODULE_ID."_DELETE_TITLE"),
					$_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/uninst2.php"
				);
			}	
		}
	}
}
?>
