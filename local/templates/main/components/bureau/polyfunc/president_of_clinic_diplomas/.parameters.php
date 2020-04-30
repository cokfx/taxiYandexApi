<?php

$set = array(
	'FILE_LINK_1' => 'Ссылка на файл №1 относительно корня сайта',
	'FILE_LINK_2' => 'Ссылка на файл №2 относительно корня сайта'
);

$arTemplateParameters = array();
foreach ($set as $k => $val) {
	$arTemplateParameters[$k] = array(
		'NAME' => $val,
		'COLS' => 35,
		'ROWS' => 1
	);
}
