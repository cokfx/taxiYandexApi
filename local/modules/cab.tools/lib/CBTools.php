<?php


//namespace Cab\Tools;
\Bitrix\Main\Loader::includeModule('main');


class CBTools
{
    public static function pretty_print($in, $opened = false)
    {
        if ($opened)
            $opened = ' open';
        if (is_object($in) or is_array($in)) {
            echo '<div style="margin-left: 30%;">';
            echo '<details' . $opened . '>';
            echo '<summary>';
            echo (is_object($in)) ? 'Object {' . count((array)$in) . '}' : 'Array [' . count($in) . ']';
            echo '</summary>';
            self::pretty_print_rec($in, $opened);
            echo '</details>';
            echo '</div>';
        }
    }

    private static function pretty_print_rec($in, $opened, $margin = 10)
    {
        if (!is_object($in) && !is_array($in))
            return;

        foreach ($in as $key => $value) {
            if (is_object($value) or is_array($value)) {

                echo '<details style="margin-left:' . $margin . 'px" ' . $opened . '>';
                echo '<summary>';
                echo (is_object($value)) ? $key . ' {' . count((array)$value) . '}' : $key . ' [' . count($value) . ']';
                echo '</summary>';
                static::pretty_print_rec($value, $opened, $margin + 10);
                echo '</details>';
            } else {
                switch (gettype($value)) {
                    case 'string':
                        $bgc = 'red';
                        break;
                    case 'integer':
                        $bgc = 'green';
                        break;
                }
                echo '<div style="margin-left:' . $margin . 'px">' . $key . ' : <span style="color:' . $bgc . '">' . $value . '</span> (' . gettype($value) . ')</div>';
            }
        }
    }

    public static function CurrPage()
    {
        global $APPLICATION;
        echo $page = $APPLICATION->GetCurPage();
    }

    public static function url()
    {
        $url = $_SERVER['REDIRECT_URL'];

        return $url;
    }
    public static function arg($offset = -1)
    {
        $args = array();
        $url = explode('/', self::url());
        foreach ($url as $u) {
            if (trim($u)) {
                $args[] = $u;
            }
        }

        if ($offset >= 0) {
            return $args[$offset];
        } else {
            return $args;
        }
    }

    public function reflectionFunc($func){
        $funcReflector = new ReflectionFunction($func);
        echo $funcReflector->getFileName().'<br>';
        echo $funcReflector->getStartLine().'<br>';
        echo $funcReflector->getEndLine().'<br>';
    }

    public function reflectionObj($obj){
        $reflector = new \ReflectionObject($obj);
        $properties = $reflector->getProperties();
        var_dump($properties);
    }

    public static function elemGetList(){
        echo '$arElem = CIBlockElement::GetList($arOrder, $arFilter, false, false,$arSelect)->Fetch();';
    }


}