<?
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "IBlockAfterSave");
//require($_SERVER["DOCUMENT_ROOT"]."/local/components/taxi/contracts/createContract.php");
//require
require(__DIR__.'/../vendor/autoload.php');

function pretty_print($in,$opened = true,$die=false,$description1){
    if($opened)
        $opened = ' open';
    if(is_object($in) or is_array($in)){
        echo '<div style="margin-left: 30%;">';
        echo '<div>'.$description1.'</div>';
        echo '<details'.$opened.'>';

        echo '<summary>';
        echo (is_object($in)) ? 'Object {'.count((array)$in).'}':'Array ['.count($in).']';
        echo '</summary>';
        pretty_print_rec($in, $opened);
        echo '</details>';
        echo '</div>';
        if ($die){
            die();
        }
    }
}
function pretty_print_rec($in, $opened, $margin = 10){
    if(!is_object($in) && !is_array($in))
        return;

    foreach($in as $key => $value){
        if(is_object($value) or is_array($value)){

            echo '<details style="margin-left:'.$margin.'px" '.$opened.'>';
            echo '<summary>';
            echo (is_object($value)) ? $key.' {'.count((array)$value).'}':$key.' ['.count($value).']';
            echo '</summary>';
            pretty_print_rec($value, $opened, $margin+10);
            echo '</details>';
        }
        else{
            switch(gettype($value)){
                case 'string':
                    $bgc = 'red';
                    break;
                case 'integer':
                    $bgc = 'green';
                    break;
            }
            echo '<div style="margin-left:'.$margin.'px">'.$key . ' : <span style="color:'.$bgc.'">' . $value .'</span> ('.gettype($value).')</div>';
        }
    }
}
?>
