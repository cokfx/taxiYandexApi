<?
try{
$db=new PDO ("mysql:dbname=cok23_b24;host=localhost","cok23_b24","Zxcvbn230267", array(    // Наименование базы; Хост; Имя пользователя; Пароль.
PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8",
PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ,
PDO::ATTR_ERRMODE=>TRUE
));
}catch(PDOExeception $e){

echo 'Подключение не удалось: ' . $e->getMessage();

}// b_iblock_element  b_iblock_element_prop_s17

