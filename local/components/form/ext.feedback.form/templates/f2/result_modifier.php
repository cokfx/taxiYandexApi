<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('iblock');

if ($_REQUEST['action'] == 'redir1' && $_REQUEST['eid']) {



        $arSort = array();
        $arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => $arParams['IBLOCK_ID'],'ID'=>$_REQUEST['eid']);
        $arSelect = array(
            'ID',
            'NAME',
            'PROPERTY_FIRST_NAME_F1',
            'PROPERTY_LAST_NAME_F1',
            'PROPERTY_EMAIL_F1',
        );
        $res = CIBlockElement::getList($arSort, $arFilter, false, false, $arSelect);
        if ($row = $res->fetch()) {
            $arRes = $row;

        }
    pretty_print($arRes, false, false, "Uswr");
    /*$user     = new CUser;
    $arFields = array(
        "NAME" => $name,
        "LOGIN" => $login,
        "EMAIL" => $email,
        "PHONE_NUMBER" => $phone,
        "LID" => "ru",
        "ACTIVE" => "Y",
        "PASSWORD" => $pass,
        "CONFIRM_PASSWORD" => $pass,
        "GROUP_ID" => array(10, 11)
    );
    $new_user_ID    = $user->Add($arFields);*/



}


