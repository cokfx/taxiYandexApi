<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetPageProperty("title", htmlspecialcharsbx(COption::GetOptionString("main", "site_name", "Bitrix24")));
?>
<? $_SERVER["DOCUMENT_ROOT"] = "/home/c/cok23/caytex.ru/public_html";

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>