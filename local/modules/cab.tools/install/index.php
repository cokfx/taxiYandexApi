<?php


IncludeModuleLangFile(__FILE__);

use \Bitrix\Main\ModuleManager;

Class Cab_tools extends CModule
{

    var $MODULE_ID = "cab.tools";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $errors;

    function __construct()
    {
        //$arModuleVersion = array();
        $this->MODULE_VERSION = "1.0.0";
        $this->MODULE_VERSION_DATE = "28.03.2020";
        https://dev.sokolov.ru/jewelry-shops/RU/Sankt-Peterburg/?country=RU&city=Sankt-Peterburg
        $this->MODULE_NAME = "Пример модуля tools";
        $this->MODULE_DESCRIPTION = "Тестовый модуль для разработчиков, можно использовать как основу для разработки новых модулей для 1С:Битрикс";
    }

    function DoInstall()
    {
        $this->InstallDB();
        $this->InstallEvents();
        $this->InstallFiles();
        RegisterModule("cab.tools");
        return true;
    }

    function DoUninstall()
    {
        $this->UnInstallDB();
        $this->UnInstallEvents();
        $this->UnInstallFiles();
        UnRegisterModule("cab.tools");
        return true;
    }

    function InstallDB()
    {
        /*global $DB;
        $this->errors = false;
        $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/cab.tools/install/db/install.sql");
        if (!$this->errors) {

            return true;
        } else*/
            //return $this->errors;
        return true;
    }

    function UnInstallDB()
    {
        /*global $DB;
        $this->errors = false;
        $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/cab.tools/install/db/install.sql");
        if (!$this->errors) {

            return true;
        } else*/
        //return $this->errors;
        return true;
    }

   /* function UnInstallDB()
    {
        global $DB;
        $this->errors = false;
        $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . "/local/modules/cab.tools/install/db/uninstall.sql");
        if (!$this->errors) {
            return true;
        } else
            return $this->errors;
    }*/

    function InstallEvents()
    {
        return true;
    }

    function UnInstallEvents()
    {
        return true;
    }

    function InstallFiles()
    {
        return true;
    }

    function UnInstallFiles()
    {
        return true;
    }
}
