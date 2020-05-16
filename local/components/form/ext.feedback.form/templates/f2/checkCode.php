<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('iblock');

if($_POST['eid']){
    $eid=$_POST['eid'];
    echo $eid;
}

