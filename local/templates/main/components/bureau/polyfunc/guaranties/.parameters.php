<?php

$set = array(
	'FILE_NAME' => 'Название файла',
	'FILE_LINK' => 'Ссылка на файл относительно корня сайта'
);

$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 35,
		'ROWS' => 1
	);
}
