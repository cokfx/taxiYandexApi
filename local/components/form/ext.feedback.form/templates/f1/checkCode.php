<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('iblock');

if ($_POST['eid']) {

    $eid = $_POST['eid'];//iblock_id: iblock_id
    $iblock_id = $_POST['iblock_id'];
    $arSort = array();
    $arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => $iblock_id, 'ID' => $_REQUEST['eid']);
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
    $name = $arRes['PROPERTY_FIRST_NAME_F1_VALUE'] . ' ' . $arRes['PROPERTY_LAST_NAME_F1_VALUE'];
    $pass = $_POST['pass'];
    $login = $arRes['PROPERTY_EMAIL_F1_VALUE'];


    $user = new CUser;
    $arFields = array(
        "NAME" => $arRes['NAME'],
        "LOGIN" => $login,
        "EMAIL" => $login,
        "ACTIVE" => "Y",
        "PASSWORD" => $pass,
        "CONFIRM_PASSWORD" => $pass,
        "GROUP_ID" => array(3),
        "LID" => SITE_ID
    );
    $new_user_ID = $user->Add($arFields);
    if ($new_user_ID) {
        echo $new_user_ID;
    }else{
        echo $pass.'  '.$name.' '.$login;
    }


}


