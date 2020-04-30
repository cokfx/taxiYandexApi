<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?php header('Content-type: text/plain');
header('Content-Disposition: attachment; filename="assign file content"');
/* assign file content to a PHP Variable $content */ echo "assign file content to a PHP Variable $content "; ?>

<? include_once __DIR__ . '/../Driver.php';/*
if ($_REQUEST['act'] = 'download' && $_REQUEST['id']) {

    $elemId = $_REQUEST['id'];
    $res[$elemId]=Driver::getBaseDriverById($elemId);

    header('Content-Type: text/plain; charset=utf-8');
    header('Content-Type: application/octet-stream');
    header('Content-disposition: attachment; filename='.$res[$elemId]['PROPERTY_102']." ".$res[$elemId]['PROPERTY_102'].'.txt');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: private');
    echo $res;
    exit();

}*/


/*$resultat = implode("\r\n", $_SESSION['resultat']);
header('Content-Type: text/plain; charset=utf-8');
header('Content-Type: application/octet-stream');
header('Content-disposition: attachment; filename=«јя¬ ј_є'.$_SESSION['number'].'.txt');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: private');
echo $resultat;
exit();*/


/*header('Content-type: text/plain');
header('Content-Disposition: attachment;
            filename="<name for the created file>"');
/*
assign file content to a PHP Variable $content
*/
//echo $content;*/

/*$n_file =$no_fichier . '.acp005';
header('Content-Disposition: attachment; filename="'.$n_file.'"');
header('Content-Type: text/html; charset=utf-8');
header('Content-Length: ' . strlen($fichier));
header('Connection: close');
echo $fichier;*/

/*header('Content-disposition: attachment; filename=gen.txt');
header('Content-type: text/plain');
// далее записываем в файл текст
echo "'это перва€ строка скачиваемого файла \r\n";
echo " это ¬“ќ–јя строка скачиваемого файла";*/
